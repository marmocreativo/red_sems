<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Publicaciones extends CI_Controller {
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

			$this->data['tipo'] = verificar_variable('GET','tipo','pagina');

		// reviso si existe la vista especializada


		// Título General
		$this->data['titulo']  = 'Publicaciones | Administrador | '.$this->data['op']['titulo_sitio'];
	}

	public function index()
	{
		// Inicializo Variables
		$this->data['consulta']=array();
		$parametros_or = array();
		$parametros_and = array();
		// Tipo de categoría lo que carga los formularios con estilos especiales, se busca el tipo básico
		$tipo = $this->data['tipo'];
		$this->data['consulta']['tipo'] = $tipo;
		$categoria = verificar_variable('GET','categoria','');
		$this->data['consulta']['categoria'] = $categoria;
		$orden = verificar_variable('GET','orden','ORDEN ASC');
		$this->data['consulta']['orden'] = $orden;
		$mostrar_por_pagina = verificar_variable('GET','mostrar_por_pagina',$this->data['op']['cantidad_publicaciones_por_pagina']);
		$this->data['consulta']['mostrar_por_pagina'] = $mostrar_por_pagina;
		$pagina = verificar_variable('GET','pagina','1');
		$this->data['consulta']['pagina'] = $pagina;
		$agrupar = 'publicaciones.ID_PUBLICACION';
		$busqueda = verificar_variable('GET','busqueda','');
		$this->data['consulta']['busqueda'] = $busqueda;
		// Expando la busqueda y genero los $parametros_or
		if(!empty($busqueda)){
			$parametros_or['publicaciones.PUBLICACION_TITULO']=$busqueda;
			$parametros_or['publicaciones.PUBLICACION_RESUMEN']=$busqueda;
			$parametros_or['extra_datos.DATO_VALOR']=$busqueda;
		}
		// Genero los parametros AND
		$parametros_and['publicaciones.ESTADO !=']='papelera';
		$parametros_and['publicaciones.TIPO']=$tipo;
		$parametros_and['extra_datos.TIPO_OBJETO']='publicacion';

		$tablas_join = array();
		$tablas_join['extra_datos'] = 'extra_datos.ID_OBJETO = publicaciones.ID_PUBLICACION';

		// Join con categoria
		if(!empty($categoria)){
			$tablas_join['categorias_objetos'] = 'categorias_objetos.ID_OBJETO = extra_datos.ID_OBJETO';
			$parametros_and['categorias_objetos.ID_CATEGORIA']=$categoria;
		}


		// Busco si hay una vista especializada para el tipo
		$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','lista_','publicaciones','_'.$this->data['tipo']);

		// paginador
		$this->data['pub_totales'] = $this->GeneralModel->conteo('publicaciones',$tablas_join,$parametros_or,$parametros_and,$agrupar);
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
		$this->data['consulta_actual'] = 'categoria='.$categoria.'&tipo='.$tipo.'&orden='.$orden.'&mostrar_por_pagina='.$mostrar_por_pagina.'&pagina='.$pagina.'&busqueda='.$busqueda;
		$this->data['consulta_siguiente'] = 'categoria='.$categoria.'&tipo='.$tipo.'&orden='.$orden.'&mostrar_por_pagina='.$mostrar_por_pagina.'&pagina='.$this->data['pagina_siguiente'].'&busqueda='.$busqueda;
		$this->data['consulta_anterior'] = 'categoria='.$categoria.'&tipo='.$tipo.'&orden='.$orden.'&mostrar_por_pagina='.$mostrar_por_pagina.'&pagina='.$this->data['pagina_anterior'].'&busqueda='.$busqueda;

		// Consulta
		$this->data['publicaciones'] = $this->GeneralModel->lista_join('publicaciones',$tablas_join,$parametros_or,$parametros_and,$orden,$mostrar_por_pagina,$this->data['offset'],$agrupar);

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
		// Tipo de categoría lo que carga los formularios con estilos especiales, se busca el tipo básico
		$tipo = $this->data['tipo'];
		$this->data['consulta']['tipo'] = $tipo;
		$categoria = verificar_variable('GET','categoria','');
		$this->data['consulta']['categoria'] = $categoria;
		$orden = verificar_variable('GET','orden','ORDEN ASC');
		$this->data['consulta']['orden'] = $orden;
		$mostrar_por_pagina = verificar_variable('GET','mostrar_por_pagina',$this->data['op']['cantidad_publicaciones_por_pagina']);
		$this->data['consulta']['mostrar_por_pagina'] = $mostrar_por_pagina;
		$pagina = verificar_variable('GET','pagina','1');
		$this->data['consulta']['pagina'] = $pagina;
		$agrupar = 'publicaciones.ID_PUBLICACION';
		$busqueda = verificar_variable('GET','busqueda','');
		$this->data['consulta']['busqueda'] = $busqueda;
		// Expando la busqueda y genero los $parametros_or
		if(!empty($busqueda)){
			$parametros_or['publicaciones.PUBLICACION_TITULO']=$busqueda;
			$parametros_or['publicaciones.PUBLICACION_RESUMEN']=$busqueda;
			$parametros_or['extra_datos.DATO_VALOR']=$busqueda;
		}
		// Genero los parametros AND
		$parametros_and['publicaciones.ESTADO']='papelera';
		$parametros_and['publicaciones.TIPO']=$tipo;
		$parametros_and['extra_datos.TIPO_OBJETO']='publicacion';

		$tablas_join = array();
		$tablas_join['extra_datos'] = 'extra_datos.ID_OBJETO = publicaciones.ID_PUBLICACION';

		// Join con categoria
		if(!empty($categoria)){
			$tablas_join['categorias_objetos'] = 'categorias_objetos.ID_OBJETO = extra_datos.ID_OBJETO';
			$parametros_and['categorias_objetos.ID_CATEGORIA']=$categoria;
		}


		// Busco si hay una vista especializada para el tipo
		$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','lista_','publicaciones','_'.$this->data['tipo']);

		// paginador
		$this->data['pub_totales'] = $this->GeneralModel->conteo('publicaciones',$tablas_join,$parametros_or,$parametros_and,$agrupar);
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
		$this->data['consulta_actual'] = 'categoria='.$categoria.'&tipo='.$tipo.'&orden='.$orden.'&mostrar_por_pagina='.$mostrar_por_pagina.'&pagina='.$pagina.'&busqueda='.$busqueda;
		$this->data['consulta_siguiente'] = 'categoria='.$categoria.'&tipo='.$tipo.'&orden='.$orden.'&mostrar_por_pagina='.$mostrar_por_pagina.'&pagina='.$this->data['pagina_siguiente'].'&busqueda='.$busqueda;
		$this->data['consulta_anterior'] = 'categoria='.$categoria.'&tipo='.$tipo.'&orden='.$orden.'&mostrar_por_pagina='.$mostrar_por_pagina.'&pagina='.$this->data['pagina_anterior'].'&busqueda='.$busqueda;

		// Consulta
		$this->data['publicaciones'] = $this->GeneralModel->lista_join('publicaciones',$tablas_join,$parametros_or,$parametros_and,$orden,$mostrar_por_pagina,$this->data['offset'],$agrupar);

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
			'PUBLICACION_TITULO' => 'Borrador '.$id_borrador,
			'URL' => 'borrador-'.$id_borrador,
			'PUBLICACION_RESUMEN' => '',
			'PUBLICACION_CONTENIDO' => '',
			'IMAGEN' => $imagen,
			'FECHA_REGISTRO' => date('Y-m-d H:i:s'),
			'FECHA_PUBLICACION' => date('Y-m-d H:i:s'),
			'TIPO' => $this->input->get('tipo'),
			'ESTADO' => 'inactivo',
			'ORDEN' => 0,
		);
		$publicacion_id = $this->GeneralModel->crear('publicaciones',$parametros);

		//Extra autor
		$parametros_meta = array(
			'ID_OBJETO'=>$publicacion_id,
			'DATO_NOMBRE'=>'meta_autor',
			'DATO_VALOR'=>$_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'],
			'TIPO_OBJETO'=>'publicacion',
		);

		// Creo las entradas a la galeria
		$this->GeneralModel->crear('extra_datos',$parametros_meta);

		// Consulta
		$consulta = base64_encode(json_encode($consulta));

		$this->session->set_flashdata('exito', 'Borrador creado correctamente');
		redirect(base_url('admin/publicaciones/actualizar?id='.$publicacion_id.'&consulta='.$consulta));
	}

	public function actualizar()
	{
		$this->form_validation->set_rules('PublicacionTitulo', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {
			if(isset($_POST['consulta'])&&!empty($_POST['consulta'])){
				$consulta = json_decode(base64_decode($_POST['consulta']));
			}else{
					$consulta->categoria = '';
					$consulta->tipo = '';
					$consulta->orden = '';
					$consulta->mostrar_por_pagina = '';
					$consulta->pagina = '';
					$consulta->busqueda = '';
			}

			/*
			PROCESO DE LA IMAGEN
			*/
			if(!empty($_FILES['Imagen']['name'])&& $_FILES['Imagen']['error'] == 0){

				$archivo = $_FILES['Imagen']['tmp_name'];
				// Ancho y Alto
				if(null!==$this->input->post('AnchoImagen')){
					$ancho = $this->input->post('AnchoImagen');
				}else{
					$ancho = $this->data['op']['ancho_imagenes_publicaciones'];
				}

				if(null!==$this->input->post('AltoImagen')){
					$alto = $this->input->post('AltoImagen');
				}else{
					$alto = $this->data['op']['alto_imagenes_publicaciones'];
				}
				$corte = 'corte';
				$extension = '.jpg';
				$tipo_imagen = 'image/jpeg';
				$calidad = 80;
				$nombre = 'publicacion-'.uniqid();
				$destino = $this->data['op']['ruta_imagenes'].'publicaciones/';
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen = subir_imagen($archivo,$ancho,$alto,$corte,$extension,$tipo_imagen,$calidad,$nombre,$destino);

			}else{
				$imagen = $this->input->post('ImagenActual');
			}

			/*
			PROCESO DE LA IMAGEN DE FONDO
			*/
			if(!empty($_FILES['ImagenFondo']['name'])&& $_FILES['ImagenFondo']['error'] == 0){

				$archivo = $_FILES['ImagenFondo']['tmp_name'];
				// Ancho y Alto
				if(null!==$this->input->post('AnchoImagenFondo')){
					$ancho = $this->input->post('AnchoImagenFondo');
				}else{
					$ancho = $this->data['op']['ancho_imagenes_fondo_publicaciones'];
				}

				if(null!==$this->input->post('AltoImagenFondo')){
					$alto = $this->input->post('AltoImagenFondo');
				}else{
					$alto = $this->data['op']['alto_imagenes_fondo_publicaciones'];
				}
				$corte = 'corte';
				$extension = '.jpg';
				$tipo_imagen = 'image/jpeg';
				$calidad = 80;
				$nombre = 'publicacion-fondo-'.uniqid();
				$destino = $this->data['op']['ruta_imagenes'].'publicaciones/';
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen_fondo = subir_imagen($archivo,$ancho,$alto,$corte,$extension,$tipo_imagen,$calidad,$nombre,$destino);

			}else{
				$imagen_fondo = $this->input->post('ImagenFondoActual');
			}

      $parametros = array(
				'PUBLICACION_TITULO' => $this->input->post('PublicacionTitulo'),
				'URL' => $this->input->post('Url'),
				'PUBLICACION_RESUMEN' => $this->input->post('PublicacionResumen'),
				'PUBLICACION_CONTENIDO' => $this->input->post('PublicacionContenido'),
				'PUBLICACION_KEYWORDS' => $this->input->post('PublicacionKeywords'),
				'IMAGEN' => $imagen,
				'IMAGEN_FONDO' => $imagen_fondo,
				'FECHA_REGISTRO' => date('Y-m-d 00:00:00', strtotime($this->input->post('FechaRegistro'))),
				'FECHA_PUBLICACION' => date('Y-m-d 00:00:00', strtotime($this->input->post('FechaPublicacion'))),
				'TIPO' => $this->input->post('Tipo'),
				'ESTADO' => $this->input->post('Estado'),
				'ORDEN' => $this->input->post('Orden'),
      );
			// Creo la publicacion
      $this->GeneralModel->actualizar('publicaciones',['ID_PUBLICACION'=>$this->input->post('Identificador')],$parametros);

			// Categorias

			// Borro las categorías existentes
			$this->GeneralModel->borrar('categorias_objetos',['ID_OBJETO'=>$this->input->post('Identificador'),'TIPO'=>$this->input->post('Tipo')]);

			if(isset($_POST['CategoriasObjeto'])&&!empty($_POST['CategoriasObjeto'])){
				foreach($_POST['CategoriasObjeto'] as $categoria){
					$parametros = array(
						'ID_CATEGORIA' => $categoria,
						'ID_OBJETO' => $this->input->post('Identificador'),
						'TIPO' => $this->input->post('Tipo'),
		      );
					// Creo la relación de categorías
		      $this->GeneralModel->crear('categorias_objetos',$parametros);
				}
			}

			// Borro los metadatos existentes
			$this->GeneralModel->borrar('extra_datos',['ID_OBJETO'=>$this->input->post('Identificador'),'TIPO_OBJETO'=>'publicacion']);
			// Extra Datos
			if(!empty($_POST['Extra'])){
				foreach($_POST['Extra'] as $nombre => $valor){
					$parametros_meta = array(
						'ID_OBJETO'=>$this->input->post('Identificador'),
						'DATO_NOMBRE'=>$nombre,
						'DATO_VALOR'=>$valor,
						'TIPO_OBJETO'=>'publicacion',
					);
					// Creo las entradas a la galeria
					$this->GeneralModel->crear('extra_datos',$parametros_meta);
				}
			}

			// Redirecciono
			$this->session->set_flashdata('exito', 'Publicación actualizada correctamente');
			switch ($this->input->post('Guardar')) {
				case 'continuar':
					redirect(base_url('admin/publicaciones/actualizar?id='.$this->input->post('Identificador').'&consulta='.base64_encode(json_decode($consulta))));
					break;
				case 'salir':
					redirect(base_url('admin/publicaciones?tipo='.$consulta->tipo.'&orden='.$consulta->orden.'&mostrar_por_pagina='.$consulta->mostrar_por_pagina.'&pagina='.$consulta->pagina.'&busqueda='.$consulta->busqueda));
					break;
				case 'relaciones':
					redirect(base_url('admin/publicaciones/relaciones?id='.$this->input->post('Identificador').$consulta->busqueda));
					break;
				default:
					redirect(base_url('admin/publicaciones/multimedia?tipo='.$this->input->post('Guardar').'&id='.$this->input->post('Identificador').'&consulta='.base64_encode(json_decode($consulta))));
					break;
			}

    }else{

			// Datos publicación
			$this->data['publicacion'] = $this->GeneralModel->detalles('publicaciones',['ID_PUBLICACION'=>$_GET['id']]);
			$this->data['tipo'] = $this->data['publicacion']['TIPO'];
			// Extra datos
			$this->data['extra'] = $this->GeneralModel->lista('extra_datos','',['ID_OBJETO'=>$_GET['id'],'TIPO_OBJETO'=>'publicacion'],'','','');
			$this->data['extra_datos'] = array(); foreach($this->data['extra'] as $m){ $this->data['extra_datos'][$m->DATO_NOMBRE]= $m->DATO_VALOR; }
			// Reviso la vista especializada
			$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','form_actualizar_','publicaciones','_'.$this->data['tipo']);

			// Cargo Vistas
			$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
			$this->load->view($this->data['vista'],$this->data);
			$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
		}
	}

	public function multimedia()
	{
		// Parámetros de busqueda
		$parametros_or = array();
		$parametros_and = array();
		$tipo = verificar_variable('GET','tipo','enlace');

		$this->data['publicacion'] = $this->GeneralModel->detalles('publicaciones',['ID_PUBLICACION'=>$_GET['id']]);
		// Extra datos
		$this->data['extra'] = $this->GeneralModel->lista('extra_datos','',['ID_OBJETO'=>$_GET['id'],'TIPO_OBJETO'=>'publicacion'],'','','');
		$this->data['extra_datos'] = array(); foreach($this->data['extra'] as $m){ $this->data['extra_datos'][$m->DATO_NOMBRE]= $m->DATO_VALOR; }

			// Reviso la vista especializada
		$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','lista_','multimedia_publicacion','_'.$this->data['tipo']);

		// Cargo Vistas
		$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
		$this->load->view($this->data['vista'],$this->data);
		$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
	}

	public function relaciones()
	{
		// Parámetros de busqueda
		$parametros_or = array();
		$parametros_and = array();
		$tipo = verificar_variable('GET','tipo','');
		$objeto = 'publicacion';
		$orden = verificar_variable('GET','orden','NOMBRE_RELACION ASC');
		$agrupar = '';

			// Reviso la vista especializada

		$this->data['publicacion'] = $this->GeneralModel->detalles('publicaciones',['ID_PUBLICACION'=>$_GET['id']]);


		// Primera busqueda
		$parametros_and['OBJETO'] = $objeto;
		$parametros_and['TIPO'] = $this->data['publicacion']['TIPO'];
		$parametros_and['OBJETO_REL'] = 'publicacion';
		$this->data['relaciones_publicaciones'] = $this->GeneralModel->lista('relaciones',$parametros_or,$parametros_and,$orden,'','');

		// Segunda busqueda
		$parametros_and = array();
		$parametros_and['OBJETO'] = $objeto;
		$parametros_and['TIPO'] = $this->data['publicacion']['TIPO'];
		$parametros_and['OBJETO_REL'] = 'usuario';
		$this->data['relaciones_usuarios'] = $this->GeneralModel->lista('relaciones',$parametros_or,$parametros_and,$orden,'','');

		// Extra datos
		$this->data['extra'] = $this->GeneralModel->lista('extra_datos','',['ID_OBJETO'=>$_GET['id'],'TIPO_OBJETO'=>'publicacion'],'','','');
		$this->data['extra_datos'] = array(); foreach($this->data['extra'] as $m){ $this->data['extra_datos'][$m->DATO_NOMBRE]= $m->DATO_VALOR; }

			// Reviso la vista especializada
		$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','lista_','relaciones_publicacion','_'.$this->data['tipo']);

		// Cargo Vistas
		$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
		$this->load->view($this->data['vista'],$this->data);
		$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
	}


	public function activar()
	{
		// Decodifico la consulta
		$consulta = json_decode(base64_decode($_GET['consulta']));
		// activar
		$this->GeneralModel->activar('publicaciones',['ID_PUBLICACION'=>$_GET['id']],$_GET['estado']);

		// Mensaje Feedback
		$this->session->set_flashdata('exito', 'Publicación actualizada correctamente');
		redirect(base_url('admin/publicaciones?categoria='.$consulta->categoria.'&tipo='.$consulta->tipo.'&orden='.$consulta->orden.'&mostrar_por_pagina='.$consulta->mostrar_por_pagina.'&pagina='.$consulta->pagina.'&busqueda='.$consulta->busqueda));
	}

	public function borrar()
	{
		// Decodifico la consulta
		$consulta = json_decode(base64_decode($_GET['consulta']));
		// activar
		$parametros = array(
			'ESTADO'=>'papelera'
		);
		$this->GeneralModel->actualizar('publicaciones',['ID_PUBLICACION'=>$_GET['id']],$parametros);

		// Mensaje Feedback
		$this->session->set_flashdata('exito', 'Publicación enviada a la papelería');
		redirect(base_url('admin/publicaciones?categoria='.$consulta->categoria.'&tipo='.$consulta->tipo.'&orden='.$consulta->orden.'&mostrar_por_pagina='.$consulta->mostrar_por_pagina.'&pagina='.$consulta->pagina.'&busqueda='.$consulta->busqueda));
	}


	public function borrar_permanente()
	{
		$publicacion = $this->GeneralModel->detalles('publicaciones',['ID_PUBLICACION'=>$_GET['id']]);

      // check if the institucione exists before trying to delete it
      if(isset($publicacion['ID_PUBLICACION']))
      {
					// Borro metadatos
					$this->GeneralModel->borrar('extra_datos',['ID_OBJETO'=>$publicacion['ID_PUBLICACION'],'TIPO_OBJETO'=>'publicacion']);
					// Borro categorias
					$this->GeneralModel->borrar('categorias_objetos',['ID_OBJETO'=>$publicacion['ID_PUBLICACION'],'TIPO_OBJETO'=>'publicacion']);

					// Borro publicación
          $this->GeneralModel->borrar('publicaciones',['ID_PUBLICACION'=>$_GET['id']]);
					// Mensaje Feedback
					$this->session->set_flashdata('exito', 'Publicación borrada');
					//  Redirecciono
          redirect(base_url('admin/publicaciones?tipo='.$publicacion['TIPO']));
      } else {
				// Mensaje Feedback
				$this->session->set_flashdata('alerta', 'La Entrada que intentaste borrar no existe');
				//  Redirecciono
         redirect(base_url('admin/publicaciones'));
			}
	}
}
