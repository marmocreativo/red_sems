<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Repositorio extends CI_Controller {
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
		if(!verificar_permiso(['administrador','produccion','diseno_instrucional','comunicacion'])){
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

		$this->load->library('ftp');
		// Cargo los modelos
		// Variables Globales

			$this->data['tipo'] = 'archivo';

		// reviso si existe la vista especializada


		// Título General
		$this->data['titulo']  = 'Repositorio | Administrador | '.$this->data['op']['titulo_sitio'];
		ini_set('MAX_EXECUTION_TIME', '-1');
	}

	public function index()
	{
		// Inicializo Variables
		$this->data['consulta']=array();
		$this->data['consulta']['categoria'] = verificar_variable('GET','categoria','0');
		$this->data['consulta']['orden_cat'] = verificar_variable('GET','orden_cat','ORDEN ASC');
		$this->data['consulta']['busqueda'] = verificar_variable('GET','busqueda','');
		// Cargo Vistas

		$this->data['detalle_categoria'] = $this->GeneralModel->detalles('categorias',['ID_CATEGORIA'=>$this->data['consulta']['categoria']]);
		$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
		$this->load->view('default'.$this->data['dispositivo'].'/admin/repositorio',$this->data);
		$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
	}

	public function crear_carpeta()
	{
		$titulo = convert_accented_characters($this->input->post('NombreCategoria'));
		$url = url_title($titulo,'-',TRUE);
		$url.'-'.url_title(generador_aleatorio(4),'-',TRUE);


		/*
		PROCESO DE LA IMAGEN
		*/
		$imagen = 'default.jpg';

		$id_borrador = generador_aleatorio(4);

		$parametros = array(
			'CATEGORIA_NOMBRE' => $this->input->post('NombreCategoria'),
			'URL' => $url,
			'CATEGORIA_DESCRIPCION' => '',
			'IMAGEN' => $imagen,
			'CATEGORIA_PADRE' => $this->input->post('categoria'),
			'CATEGORIA_NIVEL' => '0',
			'VISIBLE' => 'visible',
			'TIPO_OBJETO' => 'archivo',
			'TIPO' => 'archivo',
			'ESTADO' => 'activo',
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

		$this->session->set_flashdata('exito', 'Carpeta creada');
		redirect(base_url('admin/repositorio?categoria='.$this->input->post('categoria').'&orden_cat='.$this->input->post('orden_cat').'&busqueda='.$this->input->post('busqueda')));
	}

	public function actualizar_carpeta()
	{

		$titulo = convert_accented_characters($this->input->post('NombreCategoria'));
		$url = url_title($titulo,'-',TRUE);
		$url.'-'.url_title(generador_aleatorio(4),'-',TRUE);


		/*
		PROCESO DE LA IMAGEN
		*/
		$imagen = $this->input->post('ImagenActual');

		$parametros = array(
			'CATEGORIA_NOMBRE' => $this->input->post('NombreCategoria'),
			'URL' => $url,
			'IMAGEN' => $imagen
		);
		$categoria_id = $this->GeneralModel->actualizar('categorias',['ID_CATEGORIA'=>$this->input->post('Identificador')],$parametros);

		$this->session->set_flashdata('exito', 'Carpeta actualizada');
		redirect(base_url('admin/repositorio?categoria='.$this->input->post('categoria').'&orden_cat='.$this->input->post('orden_cat').'&busqueda='.$this->input->post('busqueda')));

	}

	public function crear_archivo()
	{
		
		if(isset($_FILES['file']['name'])&&!empty($_FILES['file']['name'])&& $_FILES['file']['error'] == 0){
			$nombre_archivo = 'archivo-'.uniqid();
			$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
			$config['upload_path']          = 'contenido/docs/';
			$config['allowed_types']        = '*';
			$config['file_name']						=	$nombre_archivo;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('file'))
			 {
				 $error = array('error' => $this->upload->display_errors());
				 echo 'Ha ocurrido un error al subir el archivo';
				 echo '<pre>';
				 var_dump($error);
				 echo '</pre>';
			 }else{

				 if(!empty($_FILES['Imagen']['name'])){
 					$archivo = $_FILES['Imagen']['tmp_name'];
 					$ancho = 300;
 					$alto = 300;
 					$corte = 'corte';
 					$extension = '.jpg';
 					$tipo_imagen = 'image/jpeg';
 					$calidad = 80;
 					$nombre = 'publicacion-'.uniqid();
 					$destino = $this->data['op']['ruta_imagenes'].'publicaciones/';
 					// Subo la imagen y obtengo el nombre Default si va vacía
 					$imagen = subir_imagen($archivo,$ancho,$alto,$corte,$extension,$tipo_imagen,$calidad,$nombre,$destino);
 				}else{
 					$imagen = 'default.jpg';
 				}

					$parametros = array(
						'TITULO' => $this->input->post('Titulo'),
						'CADIDO' => $this->input->post('Cadido'),
						'NOMENCLATURA' => $this->input->post('Nomenclatura'),
						'DESCRIPCION' => $this->input->post('Descripcion'),
						'TEMA' =>  $this->input->post('Tema'),
						'TIPO_RECURSO' =>  $this->input->post('TipoRecurso'),
						'FORMATO' =>  $ext,
						'COBERTURA' => $this->input->post('Cobertura'),
						'DERECHOS' => $this->input->post('Derechos'),
						'TITULO_CURSO' => $this->input->post('TituloCurso'),
						'PROPOSITO_DIDACTICO' => $this->input->post('PropositoDidactico'),
						'ARCHIVO' => $nombre_archivo.'.'.$ext,
						'ARCHIVO_EDITABLE' => $this->input->post('UrlEditable'),
						'VERSION' => '1',
						'IMAGEN' => $imagen,
						'FECHA_CREACION' => date('Y-m-d H:i:s'),
						'ESTADO' => 'activo',
					);
					$archivo_id = $this->GeneralModel->crear('archivos',$parametros);
					// Asigno a categoría
					$parametros = array(
						'ID_CATEGORIA' => $_POST['categoria'],
						'ID_OBJETO' => $archivo_id,
						'TIPO' => 'archivo',
						'TIPO_OBJETO' => 'archivo',
					);
					// Creo la relación de categorías
					$this->GeneralModel->crear('categorias_objetos',$parametros);

					//Extra datos publicación
					$parametros_meta = array(
						'ID_OBJETO'=>$archivo_id,
						'DATO_NOMBRE'=>'meta_autor',
						'DATO_VALOR'=>$_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'],
						'TIPO_OBJETO'=>'archivo',
					);

					$this->GeneralModel->crear('extra_datos',$parametros_meta);
			 }

			 // Si se subió el archivo
			 $this->session->set_flashdata('exito', 'Archivo subido correctamente');
			redirect('admin/repositorio?categoria='.$_POST['categoria']);
		 }else{
			 $this->session->set_flashdata('alerta', 'No se ha podido subir el archivo');
			 redirect('admin/repositorio?categoria='.$_POST['categoria']);
		 }

	}

	public function borrar_carpeta(){
		// Borro metadatos
		$this->GeneralModel->borrar('extra_datos',['ID_OBJETO'=>$_GET['id'],'TIPO_OBJETO'=>'categoria']);
		// Borro categorias
		$this->GeneralModel->borrar('categorias_objetos',['ID_OBJETO'=>$_GET['id'],'TIPO_OBJETO'=>'categoria']);

		// Borro publicación
		$this->GeneralModel->borrar('categorias',['ID_CATEGORIA'=>$_GET['id']]);
		// Mensaje Feedback
		$this->session->set_flashdata('exito', 'Carpeta borrada');
		//  Redirecciono
		redirect(base_url('admin/repositorio?categoria='.$_GET['categoria'].'&orden_cat='.$_GET['orden_cat'].'&busqueda='.$_GET['busqueda']));
	}

	public function borrar_archivo(){
		// Borro metadatos
		$this->GeneralModel->borrar('extra_datos',['ID_OBJETO'=>$_GET['id'],'TIPO_OBJETO'=>'archivo']);
		// Borro categorias
		$this->GeneralModel->borrar('categorias_objetos',['ID_OBJETO'=>$_GET['id'],'TIPO_OBJETO'=>'archivo']);

		// Borro publicación
		$this->GeneralModel->borrar('archivos',['ID'=>$_GET['id']]);
		// Mensaje Feedback
		$this->session->set_flashdata('exito', 'Archivo borrado');
		//  Redirecciono
		redirect(base_url('admin/repositorio?categoria='.$_GET['categoria'].'&orden_cat='.$_GET['orden_cat'].'&busqueda='.$_GET['busqueda']));
	}

}
