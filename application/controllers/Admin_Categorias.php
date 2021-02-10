<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Categorias extends CI_Controller {
	public function __construct(){
		parent::__construct();
		// Cargo las Opciones
		$this->data['op'] = opciones_default();

		// Verifico Sesión
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}
		// Verifico Permiso
		if(!verificar_permiso(['administrador'])){
			$this->session->set_flashdata('alerta', 'No tienes permiso de entrar en esa sección');
			redirect(base_url('usuario'));
		}


		// reviso el dispositivo
		if($this->agent->is_mobile()){
			//$this->data['dispositivo']  = "mobile";
			$this->data['dispositivo']  = "";
		}else{
			$this->data['dispositivo']  = "";
		}
		// Cargo los modelos
		// Variables Globales
		$this->data['padre'] = verificar_variable('GET','padre','0');

		if(!empty($this->data['padre'])){
			$detalles_categoria = $this->GeneralModel->detalles_especificos('categorias',['TIPO_OBJETO','TIPO'],['ID_CATEGORIA'=>$this->data['padre']]);
			$this->data['tipo'] = $detalles_categoria['TIPO'];
			$this->data['tipo_objeto'] = $detalles_categoria['TIPO_OBJETO'];
		}else{
			$this->data['tipo'] = verificar_variable('GET','tipo','pagina');
			$this->data['tipo_objeto'] = verificar_variable('GET','tipo_objeto','publicacion');
		}
		// reviso si existe la vista especializada


		// Título General
		$this->data['titulo']  = 'Categorías | Administrador | '.$this->data['op']['titulo_sitio'];
	}

	public function index()
	{
		// Inicializo Variables
		$this->data['consulta']=array();
		$parametros_or = array();
		$parametros_and = array();
		// Las categorías pueden cargar dos tipos de objetos, publicaciones o usuarios, así que se debe de especificar de lo contrario se asume publicación como tipo básico
		$tipo_objeto = $this->data['tipo_objeto'];
		$this->data['consulta']['tipo_objeto'] = $tipo_objeto;
		// Tipo de categoría lo que carga los formularios con estilos especiales, se busca el tipo básico
		$tipo = $this->data['tipo'];
		$this->data['consulta']['tipo'] = $tipo;
		$padre = $this->data['padre'];
		$this->data['consulta']['padre'] = $padre;
		$orden = verificar_variable('GET','orden','ORDEN ASC');
		$this->data['consulta']['orden'] = $orden;
		$mostrar_por_pagina = verificar_variable('GET','mostrar_por_pagina',$this->data['op']['cantidad_publicaciones_por_pagina']);
		$this->data['consulta']['mostrar_por_pagina'] = $mostrar_por_pagina;
		$pagina = verificar_variable('GET','pagina','1');
		$this->data['consulta']['pagina'] = $pagina;
		$agrupar = 'categorias.ID_CATEGORIA';
		$busqueda = verificar_variable('GET','busqueda','');
		$this->data['consulta']['busqueda'] = $busqueda;
		// Expando la busqueda y genero los $parametros_or
		if(!empty($busqueda)){
			$parametros_or['categorias.CATEGORIA_NOMBRE']=$busqueda;
			$parametros_or['categorias.CATEGORIA_DESCRIPCION']=$busqueda;
			$parametros_or['extra_datos.DATO_VALOR']=$busqueda;
		}
		// Genero los parametros AND
		$parametros_and['categorias.ESTADO !=']='papelera';
		$parametros_and['categorias.CATEGORIA_PADRE']=$padre;
		$parametros_and['categorias.TIPO_OBJETO']=$tipo_objeto;
		$parametros_and['categorias.TIPO']=$tipo;
		$parametros_and['extra_datos.TIPO_OBJETO']='categoria';

		$tablas_join = array(
			'extra_datos' => 'extra_datos.ID_OBJETO = categorias.ID_CATEGORIA'
		);

		// Busco si hay una vista especializada para el tipo
		$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','lista_','categorias','_'.$this->data['tipo']);

		// paginador
		$this->data['pub_totales'] = $this->GeneralModel->conteo('categorias',$tablas_join,$parametros_or,$parametros_and,$agrupar);
		$this->data['pub_por_pagina'] = $mostrar_por_pagina;
		$this->data['cantidad_paginas'] = ceil($this->data['pub_totales']/$this->data['pub_por_pagina']);
		$this->data['pagina'] = $pagina;

		// Página siguiente
		if($this->data['pagina']!=$this->data['cantidad_paginas']){
			$this->data['pagina_siguiente']=$this->data['pagina'] +1;
		}else{
			$this->data['pagina_siguiente']=$this->data['pagina'];
		}
		// Página Anterior
		if($this->data['pagina']!=1){
			$this->data['pagina_anterior']=$this->data['pagina'] -1;
		}else{
			$this->data['pagina_anterior']=$this->data['pagina'];
		}
		// Offset
		if($this->data['pagina']!=1){
			$this->data['offset'] =$this->data['pub_por_pagina']*($this->data['pagina']-1);
		}else{
			$this->data['offset']='';
		}
		// Consultas rápidas
		$this->data['consulta_actual'] = 'tipo_objeto='.$tipo_objeto.'&tipo='.$tipo.'&padre='.$padre.'&orden='.$orden.'&mostrar_por_pagina='.$mostrar_por_pagina.'&pagina='.$pagina.'&busqueda='.$busqueda;
		$this->data['consulta_siguiente'] = 'tipo_objeto='.$tipo_objeto.'&tipo='.$tipo.'&padre='.$padre.'&orden='.$orden.'&mostrar_por_pagina='.$mostrar_por_pagina.'&pagina='.$this->data['pagina_siguiente'].'&busqueda='.$busqueda;
		$this->data['consulta_anterior'] = 'tipo_objeto='.$tipo_objeto.'&tipo='.$tipo.'&padre='.$padre.'&orden='.$orden.'&mostrar_por_pagina='.$mostrar_por_pagina.'&pagina='.$this->data['pagina_anterior'].'&busqueda='.$busqueda;

		// Consulta
		$this->data['categorias'] = $this->GeneralModel->lista_join('categorias',$tablas_join,$parametros_or,$parametros_and,$orden,$mostrar_por_pagina,$this->data['offset'],$agrupar);

		// Cargo Vistas
		$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
		$this->load->view($this->data['vista'],$this->data);
		$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);


	}

	public function papelera()
	{
		// Inicializo Variables
		$this->data['consulta']=array();
		$parametros_or = array();
		$parametros_and = array();
		// Las categorías pueden cargar dos tipos de objetos, publicaciones o usuarios, así que se debe de especificar de lo contrario se asume publicación como tipo básico
		$tipo_objeto = $this->data['tipo_objeto'];
		$this->data['consulta']['tipo_objeto'] = $tipo_objeto;
		// Tipo de categoría lo que carga los formularios con estilos especiales, se busca el tipo básico
		$tipo = $this->data['tipo'];
		$this->data['consulta']['tipo'] = $tipo;
		$padre = $this->data['padre'];
		$this->data['consulta']['padre'] = $padre;
		$orden = verificar_variable('GET','orden','ORDEN ASC');
		$this->data['consulta']['orden'] = $orden;
		$mostrar_por_pagina = verificar_variable('GET','mostrar_por_pagina',$this->data['op']['cantidad_publicaciones_por_pagina']);
		$this->data['consulta']['mostrar_por_pagina'] = $mostrar_por_pagina;
		$pagina = verificar_variable('GET','pagina','1');
		$this->data['consulta']['pagina'] = $pagina;
		$agrupar = 'categorias.ID_CATEGORIA';
		$busqueda = verificar_variable('GET','busqueda','');
		$this->data['consulta']['busqueda'] = $busqueda;
		// Expando la busqueda y genero los $parametros_or
		if(!empty($busqueda)){
			$parametros_or['categorias.CATEGORIA_NOMBRE']=$busqueda;
			$parametros_or['categorias.CATEGORIA_DESCRIPCION']=$busqueda;
			$parametros_or['extra_datos.DATO_VALOR']=$busqueda;
		}
		// Genero los parametros AND
		$parametros_and['categorias.ESTADO']='papelera';
		$parametros_and['categorias.TIPO_OBJETO']=$tipo_objeto;
		$parametros_and['categorias.TIPO']=$tipo;
		$parametros_and['extra_datos.TIPO_OBJETO']='categoria';

		$tablas_join = array(
			'extra_datos' => 'extra_datos.ID_OBJETO = categorias.ID_CATEGORIA'
		);

		// Busco si hay una vista especializada para el tipo
		$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','lista_','categorias','_'.$this->data['tipo']);

		// paginador
		$this->data['pub_totales'] = $this->GeneralModel->conteo('categorias',$tablas_join,$parametros_or,$parametros_and,$agrupar);
		$this->data['pub_por_pagina'] = $mostrar_por_pagina;
		$this->data['cantidad_paginas'] = ceil($this->data['pub_totales']/$this->data['pub_por_pagina']);
		$this->data['pagina'] = $pagina;

		// Página siguiente
		if($this->data['pagina']!=$this->data['cantidad_paginas']){
			$this->data['pagina_siguiente']=$this->data['pagina'] +1;
		}else{
			$this->data['pagina_siguiente']=$this->data['pagina'];
		}
		// Página Anterior
		if($this->data['pagina']!=1){
			$this->data['pagina_anterior']=$this->data['pagina'] -1;
		}else{
			$this->data['pagina_anterior']=$this->data['pagina'];
		}
		// Offset
		if($this->data['pagina']!=1){
			$this->data['offset'] =$this->data['pub_por_pagina']*($this->data['pagina']-1);
		}else{
			$this->data['offset']='';
		}
		// Consultas rápidas
		$this->data['consulta_actual'] = 'tipo_objeto='.$tipo_objeto.'&tipo='.$tipo.'&padre='.$padre.'&orden='.$orden.'&mostrar_por_pagina='.$mostrar_por_pagina.'&pagina='.$pagina.'&busqueda='.$busqueda;
		$this->data['consulta_siguiente'] = 'tipo_objeto='.$tipo_objeto.'&tipo='.$tipo.'&padre='.$padre.'&orden='.$orden.'&mostrar_por_pagina='.$mostrar_por_pagina.'&pagina='.$this->data['pagina_siguiente'].'&busqueda='.$busqueda;
		$this->data['consulta_anterior'] = 'tipo_objeto='.$tipo_objeto.'&tipo='.$tipo.'&padre='.$padre.'&orden='.$orden.'&mostrar_por_pagina='.$mostrar_por_pagina.'&pagina='.$this->data['pagina_anterior'].'&busqueda='.$busqueda;

		// Consulta
		$this->data['categorias'] = $this->GeneralModel->lista_join('categorias',$tablas_join,$parametros_or,$parametros_and,$orden,$mostrar_por_pagina,$this->data['offset'],$agrupar);

		// Cargo Vistas
		$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
		$this->load->view($this->data['vista'],$this->data);
		$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);


	}

	public function crear()
	{

		if(isset($_GET['consulta'])&&!empty($_GET['consulta'])){
			$consulta = json_decode(base64_decode($_GET['consulta']));
		}else{
				$consulta->tipo_objeto = '';
				$consulta->tipo = '';
				$consulta->padre = '';
				$consulta->orden = '';
				$consulta->mostrar_por_pagina = '';
				$consulta->pagina = '';
				$consulta->busqueda = '';
		}

		$imagen = 'default.jpg';
		$id_borrador = generador_aleatorio(4);
		$parametros = array(
			'CATEGORIA_NOMBRE' => 'Borrador '.$id_borrador,
			'URL' => 'borrador-'.$id_borrador,
			'CATEGORIA_DESCRIPCION' => '',
			'IMAGEN' => $imagen,
			'CATEGORIA_PADRE' => $this->input->get('padre'),
			'CATEGORIA_NIVEL' => '0',
			'VISIBLE' => 'invisible',
			'TIPO_OBJETO' => $this->input->get('tipo_objeto'),
			'TIPO' => $this->input->get('tipo'),
			'ESTADO' => 'inactivo',
			'ORDEN' => 0,
		);
		$categoria_id = $this->GeneralModel->crear('categorias',$parametros);

		//Extra autor
		$parametros_meta = array(
			'ID_OBJETO'=>$categoria_id,
			'DATO_NOMBRE'=>'meta_autor',
			'DATO_VALOR'=>$_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'],
			'TIPO_OBJETO'=>'categoria',
		);

		$this->GeneralModel->crear('extra_datos',$parametros_meta);

		//Extra Ordenar
		$parametros_meta = array(
			'ID_OBJETO'=>$categoria_id,
			'DATO_NOMBRE'=>'ordenar_por',
			'DATO_VALOR'=>'PUBLICACION_TITULO ASC',
			'TIPO_OBJETO'=>'categoria',
		);

		$this->GeneralModel->crear('extra_datos',$parametros_meta);

		//Extra columnas
		$parametros_meta = array(
			'ID_OBJETO'=>$categoria_id,
			'DATO_NOMBRE'=>'columnas',
			'DATO_VALOR'=>'col-sm-3',
			'TIPO_OBJETO'=>'categoria',
		);

		// Reenvio consulta
		$consulta = base64_encode(json_encode($consulta));

		$this->GeneralModel->crear('extra_datos',$parametros_meta);

		$this->session->set_flashdata('exito', 'Borrador creado correctamente');
		redirect(base_url('admin/categorias/actualizar?id='.$categoria_id.'&consulta='.$consulta));
	}
	public function actualizar()
	{

		$this->form_validation->set_rules('CategoriaNombre', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {
			// Datos de consulta anterior
			if(isset($_POST['consulta'])&&!empty($_POST['consulta'])){
				$consulta = json_decode(base64_decode($_POST['consulta']));
			}else{
					$consulta->tipo_objeto = '';
					$consulta->tipo = '';
					$consulta->padre = '';
					$consulta->orden = '';
					$consulta->mostrar_por_pagina = '';
					$consulta->pagina = '';
					$consulta->busqueda = '';
			}


			/*
			PROCESO DE LA IMAGEN
			*/
			if(!empty($_FILES['Imagen']['name'])){

				$archivo = $_FILES['Imagen']['tmp_name'];
				$ancho = $this->data['op']['ancho_imagenes_publicaciones'];
				$alto = $this->data['op']['alto_imagenes_publicaciones'];
				$corte = 'corte';
				$extension = '.jpg';
				$tipo_imagen = 'image/jpeg';
				$calidad = 80;
				$nombre = 'categoria-'.uniqid();
				$destino = $this->data['op']['ruta_imagenes'].'categorias/';
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen = subir_imagen($archivo,$ancho,$alto,$corte,$extension,$tipo_imagen,$calidad,$nombre,$destino);

			}else{
				$imagen = $this->input->post('ImagenActual');
			}

			// nivel y padre
			if(isset($_POST['CategoriasObjeto'])){
				if($_POST['CategoriasObjeto'][0]==0){
					$nivel = 1;
					$padre = $_POST['CategoriasObjeto'][0];
				}else{
					$detalles_categoria_padre = $this->GeneralModel->detalles_especificos('categorias',['CATEGORIA_NIVEL'],['ID_CATEGORIA'=>$_POST['CategoriasObjeto'][0]]);
					$nivel = $detalles_categoria_padre['CATEGORIA_NIVEL']+1;
					$padre = $_POST['CategoriasObjeto'][0];
				}
			}else{
				$nivel = 1;
				$padre = 0;
			}
			$parametros = array(
				'CATEGORIA_NOMBRE' => $this->input->post('CategoriaNombre'),
				'URL' => $this->input->post('Url'),
				'CATEGORIA_DESCRIPCION' => $this->input->post('CategoriaDescripcion'),
				'IMAGEN' => $imagen,
				'CATEGORIA_PADRE' => $padre,
				'CATEGORIA_NIVEL' =>$nivel,
				'VISIBLE' => $this->input->post('Visible'),
				'TIPO' => $this->input->post('Tipo'),
				'ESTADO' => $this->input->post('Estado'),
				'ORDEN' => $this->input->post('Orden'),
      );

      $this->GeneralModel->actualizar('categorias',['ID_CATEGORIA'=>$this->input->post('Identificador')],$parametros);

			// Borro los metadatos existentes
			$this->GeneralModel->borrar('extra_datos',['ID_OBJETO'=>$this->input->post('Identificador'),'TIPO_OBJETO'=>'categoria']);
			// Extra Datos
			if(!empty($_POST['Extra'])){
				foreach($_POST['Extra'] as $nombre => $valor){
					$parametros_meta = array(
						'ID_OBJETO'=>$this->input->post('Identificador'),
						'DATO_NOMBRE'=>$nombre,
						'DATO_VALOR'=>$valor,
						'TIPO_OBJETO'=>'categoria',
					);
					// Creo las entradas a la galeria
					$this->GeneralModel->crear('extra_datos',$parametros_meta);
				}
			}

			// Mensaje Feedback
			$this->session->set_flashdata('exito', 'Categoría actualizada correctamente');
			//  Redirecciono
			switch ($this->input->post('Guardar')) {
				case 'Continuar':
					redirect(base_url('admin/categorias/actualizar?id='.$this->input->post('Identificador').'&consulta='.$_GET['consulta']));
					break;
				default:
					redirect(base_url('admin/categorias?tipo_objeto='.$consulta->tipo_objeto.'&tipo='.$consulta->tipo.'&padre='.$consulta->padre.'&orden='.$consulta->orden.'&mostrar_por_pagina='.$consulta->mostrar_por_pagina.'&pagina='.$consulta->pagina.'&busqueda='.$consulta->busqueda));
					break;
			}


    }else{

			$this->data['categoria'] = $this->GeneralModel->detalles('categorias',['ID_CATEGORIA'=>$_GET['id']]);
			$this->data['tipo'] = $this->data['categoria']['TIPO'];
			$this->data['padre'] = $this->data['categoria']['CATEGORIA_PADRE'];
			$this->data['extra'] = $this->GeneralModel->lista('extra_datos','',['ID_OBJETO'=>$_GET['id'],'TIPO_OBJETO'=>'categoria'],'','','');
			$this->data['extra_datos'] = array(); foreach($this->data['extra'] as $m){ $this->data['extra_datos'][$m->DATO_NOMBRE]= $m->DATO_VALOR; }
			// Reviso la vista especializada
			$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','form_actualizar_','categorias','_'.$this->data['tipo']);

			// Cargo Vistas
			$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
			$this->load->view($this->data['vista'],$this->data);
			$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
		}

	}
	public function activar()
	{
		// Decodifico la consulta
		$consulta = json_decode(base64_decode($_GET['consulta']));
		// switch para activar o desactivar elemento usando el "estado" envio el estado actual
		$this->GeneralModel->activar('categorias',['ID_CATEGORIA'=>$_GET['id']],$_GET['estado']);
		// Obtengo los datos de la categoria
		$categoria = $this->GeneralModel->detalles('categorias',['ID_CATEGORIA'=>$_GET['id']]);

		// Mensaje Feedback
		$this->session->set_flashdata('exito', 'Categoría actualizada correctamente');
		redirect(base_url('admin/categorias?tipo_objeto='.$consulta->tipo_objeto.'&tipo='.$consulta->tipo.'&padre='.$consulta->padre.'&orden='.$consulta->orden.'&mostrar_por_pagina='.$consulta->mostrar_por_pagina.'&pagina='.$consulta->pagina.'&busqueda='.$consulta->busqueda));
	}
	public function borrar()
	{
		// Decodifico la consulta
		$consulta = json_decode(base64_decode($_GET['consulta']));
		// switch para activar o desactivar elemento usando el "estado" envio el estado actual
		$parametros = array(
			'ESTADO'=>'papelera'
		);
		$this->GeneralModel->actualizar('categorias',['ID_CATEGORIA'=>$_GET['id']],$parametros);

		// Mensaje Feedback
		$this->session->set_flashdata('exito', 'Categoría enviada a la papelera');
		redirect(base_url('admin/categorias?tipo_objeto='.$consulta->tipo_objeto.'&tipo='.$consulta->tipo.'&padre='.$consulta->padre.'&orden='.$consulta->orden.'&mostrar_por_pagina='.$consulta->mostrar_por_pagina.'&pagina='.$consulta->pagina.'&busqueda='.$consulta->busqueda));
	}
	public function borrar_permanente()
	{
		$categoria = $this->GeneralModel->detalles('categorias',['ID_CATEGORIA'=>$_GET['id']]);

        // check if the institucione exists before trying to delete it
        if(isset($categoria['ID_CATEGORIA']))
        {
						// Borro la categoría
            $this->GeneralModel->borrar('categorias',['ID_CATEGORIA'=>$_GET['id']]);

						// Bucle hijas segundo nivel
						$categorias_hijas_2 = $this->GeneralModel->lista('categorias','',['CATEGORIA_PADRE'=>$_GET['id']],'','','');
						if(!empty($categorias_hijas_2)){
							foreach($categorias_hijas_2 as $cat_hijas_2){
								// Bucle hijas tercer nivel
								$categorias_hijas_3 = $this->GeneralModel->lista('categorias','',['CATEGORIA_PADRE'=>$cat_hijas_2->ID_CATEGORIA],'','','');
								if(!empty($categorias_hijas_3)){
									foreach($categorias_hijas_3 as $cat_hijas_3){
											// Borro la categorías de tercer nivel
										$this->GeneralModel->borrar('categorias',['ID_CATEGORIA'=>$cat_hijas_3->ID_CATEGORIA]);
									}
								}
									// Borro la categoría segundo Nivel
								$this->GeneralModel->borrar('categorias',['ID_CATEGORIA'=>$cat_hijas_2->ID_CATEGORIA]);
							}
						}


						$this->GeneralModel->borrar('categorias',['CATEGORIA_PADRE'=>$_GET['id']]);
						// Mensaje Feedback
						$this->session->set_flashdata('exito', 'Categorías borradas');
						//  Redirecciono
            redirect(base_url('admin/categorias?tipo='.$categoria['TIPO'].'&padre='.$categoria['CATEGORIA_PADRE']));
        } else {
					// Mensaje Feedback
					$this->session->set_flashdata('alerta', 'La Entrada que intentaste borrar no existe');
					//  Redirecciono
	         redirect(base_url('admin/categorias'));
				}
	}
}
