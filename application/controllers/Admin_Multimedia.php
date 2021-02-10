<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Multimedia extends CI_Controller {
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

		$this->data['tipo'] = verificar_variable('GET','tipo','imagen');

		// reviso si existe la vista especializada


		// Título General
		$this->data['titulo']  = 'Multimedia | Administrador | '.$this->data['op']['titulo_sitio'];
	}

	public function index()
	{
		// Parámetros de busqueda
		$parametros_or = array();
		$parametros_and = array();
		$orden = verificar_variable('GET','orden','ORDEN ASC');
		$parametros_and['TIPO']=verificar_variable('GET','tipo',$this->data['tipo']);

			// Reviso la vista especializada
		$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','lista_','multimedia','_'.$this->data['tipo']);


		// Cargo Vistas
		$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
		$this->load->view($this->data['vista'],$this->data);
		$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
	}
	public function cargar_imagen()
	{
		// Galeria

		if(isset($_FILES['file']['name'])&&!empty($_FILES['file']['name'])&& $_FILES['file']['error'] == 0){

			$archivo = $_FILES['file']['tmp_name'];
			$ancho = $this->data['op']['ancho_imagenes_publicaciones'];
			$alto = $this->data['op']['alto_imagenes_publicaciones'];
			$corte = 'encaje';
			$extension = '.jpg';
			$tipo_imagen = 'image/jpeg';
			$calidad = 80;
			$nombre = 'galeria-'.uniqid();
			$destino = $this->data['op']['ruta_imagenes'].'publicaciones/';
			$galeria = subir_imagen($archivo,$ancho,$alto,$corte,$extension,$tipo_imagen,$calidad,$nombre,$destino);

			$parametros = array(
				'ARCHIVO'=>$galeria,
				'TIPO_ARCHIVO'=>'imagen',
				'TITULO'=>'',
				'RESUMEN'=>'',
				'DESTINO'=>'',
				'ESTADO'=>'activo'
			);
			$id_multimedia = $this->GeneralModel->crear('multimedia',$parametros);

			if(!empty($_POST['id'])){
				$parametros_galeria = array(
					'ID_OBJETO' => $_POST['id'],
					'ID_MULTIMEDIA' => $id_multimedia,
					'TIPO_OBJETO' => $_POST['tipo_objeto'],
					'TIPO_ARCHIVO' => 'imagen',
					'ORDEN' => 0
				);
				$id_galerias = $this->GeneralModel->crear('galerias',$parametros_galeria);
			}

			// Creo las entradas a la galeria

		}
	}
	public function cargar_documento()
	{
		// Documentos
		if(isset($_FILES['file']['name'])&&!empty($_FILES['file']['name'])&& $_FILES['file']['error'] == 0){
			$nombre_archivo = 'adjunto-'.uniqid();
			$config['upload_path']          = 'contenido/docs/';
			$config['allowed_types']        = '*';
			$config['file_name']						=	$nombre_archivo;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('file'))
			 {
				 $error = array('error' => $this->upload->display_errors());
				 var_dump($error);
			 }else{
					$parametros = array(
						'ARCHIVO'=>$nombre_archivo.$this->upload->data('file_ext'),
						'TIPO_ARCHIVO'=>'documento',
						'TITULO'=>$_FILES['file']['name'],
						'RESUMEN'=>'',
						'DESTINO'=>'',
						'ESTADO'=>'activo'
					);
					$id_multimedia = $this->GeneralModel->crear('multimedia',$parametros);

					if(!empty($_POST['id'])){
						$parametros_galeria = array(
							'ID_OBJETO' => $_POST['id'],
							'ID_MULTIMEDIA' => $id_multimedia,
							'TIPO_OBJETO' => $_POST['tipo_objeto'],
							'TIPO_ARCHIVO' => 'documento',
							'ORDEN' => 0
						);
						$id_galerias = $this->GeneralModel->crear('galerias',$parametros_galeria);
					}
			 }
		 }
	}
	public function cargar_enlace()
	{
		$parametros = array(
			'ARCHIVO'=>$_POST['Archivo'],
			'TIPO_ARCHIVO'=>'enlace',
			'TITULO'=>$_POST['Titulo'],
			'RESUMEN'=>'',
			'DESTINO'=>$_POST['Destino'],
			'ESTADO'=>'activo'
		);
		$id_multimedia = $this->GeneralModel->crear('multimedia',$parametros);

		if(!empty($_POST['id'])){
			$parametros_galeria = array(
				'ID_OBJETO' => $_POST['id'],
				'ID_MULTIMEDIA' => $id_multimedia,
				'TIPO_OBJETO' => $_POST['tipo_objeto'],
				'TIPO_ARCHIVO' => 'enlace',
				'ORDEN' => 0
			);
			$id_galerias = $this->GeneralModel->crear('galerias',$parametros_galeria);
			redirect(base_url('admin/publicaciones/multimedia?id='.$_POST['id'].'&tipo=enlace'));
		}else{
			redirect(base_url('admin/multimedia?tipo=enlace'));
		}




	}
	public function cargar_youtube()
	{
		// Preparo URL de Youtube
		$url = $_POST['Archivo'];
		$url_parsed = parse_url($url);

		parse_str($url_parsed['query'],$variables);
		$video_id= $variables['v'];

		$parametros = array(
			'ARCHIVO'=>$video_id,
			'TIPO_ARCHIVO'=>'youtube',
			'TITULO'=>$_POST['Titulo'],
			'RESUMEN'=>'',
			'DESTINO'=>'',
			'ESTADO'=>'activo'
		);
		$id_multimedia = $this->GeneralModel->crear('multimedia',$parametros);

		if(!empty($_POST['id'])){
			$parametros_galeria = array(
				'ID_OBJETO' => $_POST['id'],
				'ID_MULTIMEDIA' => $id_multimedia,
				'TIPO_OBJETO' => $_POST['tipo_objeto'],
				'TIPO_ARCHIVO' => 'youtube',
				'ORDEN' => 0
			);
			$id_galerias = $this->GeneralModel->crear('galerias',$parametros_galeria);
			redirect(base_url('admin/publicaciones/multimedia?id='.$_POST['id'].'&tipo=youtube'));
		}else{
			redirect(base_url('admin/multimedia?tipo=youtube'));
		}
	}
	public function borrar()
	{
	}
}
