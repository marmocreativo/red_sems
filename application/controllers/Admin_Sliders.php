<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Sliders extends CI_Controller {
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

		$this->data['tipo'] = verificar_variable('GET','tipo','principal');

		// reviso si existe la vista especializada


		// Título General
		$this->data['titulo']  = 'Sliders | Administrador | '.$this->data['op']['titulo_sitio'];
	}

	public function index()
	{
		// Parámetros de busqueda
		$parametros_or = array();
		$parametros_and = array();
		$orden = verificar_variable('GET','orden','ORDEN ASC');
		$parametros_and['TIPO']=verificar_variable('GET','tipo',$this->data['tipo']);

			// Reviso la vista especializada
		$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','lista_','sliders','_'.$this->data['tipo']);
		$this->data['sliders'] = $this->GeneralModel->lista('sliders',$parametros_or,$parametros_and,$orden,'','');


		// Cargo Vistas
		$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
		$this->load->view($this->data['vista'],$this->data);
		$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
	}
	public function crear()
	{
		$this->form_validation->set_rules('SliderTitulo', 'Titulo', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {
			/*
			PROCESO DE LA IMAGEN
			*/
			if(!empty($_FILES['Imagen']['name'])){

				$archivo = $_FILES['Imagen']['tmp_name'];
				$ancho = $this->input->post('Ancho');
				$alto = $this->input->post('Alto');
				$corte = 'corte';
				$extension = $this->input->post('Extension');
				$tipo_imagen = $this->input->post('TipoImagen');
				$calidad = 80;
				$nombre = 'slider-'.uniqid();
				$destino = $this->data['op']['ruta_imagenes'].'publicaciones/';
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen = subir_imagen($archivo,$ancho,$alto,$corte,$extension,$tipo_imagen,$calidad,$nombre,$destino);

			}else{
				$imagen = 'default.jpg';
			}

      $parametros = array(
				'SLIDER_TITULO' => $this->input->post('SliderTitulo'),
				'SLIDER_SUBTITULO' => $this->input->post('SliderSubtitulo'),
				'SLIDER_TEXTO_ENLACE' => $this->input->post('SliderTextoEnlace'),
				'SLIDER_ENLACE' => $this->input->post('SliderEnlace'),
				'IMAGEN' => $imagen,
				'TIPO' => $this->input->post('Tipo'),
				'ESTADO' => $this->input->post('Estado'),
				'ORDEN' => 0,
      );
			// Creo la publicacion
      $slider_id = $this->GeneralModel->crear('sliders',$parametros);

			// Redirecciono
			$this->session->set_flashdata('exito', 'Slider creado correctamente');
      redirect(base_url('admin/sliders?tipo='.$this->input->post('Tipo')));

    }else{

			// Reviso la vista especializada
			$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','form_','sliders','_'.$this->data['tipo']);

			// Cargo Vistas
			$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
			$this->load->view($this->data['vista'],$this->data);
			$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
		}
	}
	public function actualizar()
	{
		$this->form_validation->set_rules('SliderTitulo', 'Titulo', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {
			/*
			PROCESO DE LA IMAGEN
			*/
			if(!empty($_FILES['Imagen']['name'])){

				$archivo = $_FILES['Imagen']['tmp_name'];
				$ancho = $this->input->post('Ancho');
				$alto = $this->input->post('Alto');
				$corte = 'corte';
				$extension = $this->input->post('Extension');
				$tipo_imagen = $this->input->post('TipoImagen');
				$calidad = 80;
				$nombre = 'slider-'.uniqid();
				$destino = $this->data['op']['ruta_imagenes'].'publicaciones/';
				// Subo la imagen y obtengo el nombre Default si va vacía
				$imagen = subir_imagen($archivo,$ancho,$alto,$corte,$extension,$tipo_imagen,$calidad,$nombre,$destino);

			}else{
				$imagen = $this->input->post('ImagenActual');
			}


      $parametros = array(
				'SLIDER_TITULO' => $this->input->post('SliderTitulo'),
				'SLIDER_SUBTITULO' => $this->input->post('SliderSubtitulo'),
				'SLIDER_TEXTO_ENLACE' => $this->input->post('SliderTextoEnlace'),
				'SLIDER_ENLACE' => $this->input->post('SliderEnlace'),
				'IMAGEN' => $imagen,
				'TIPO' => $this->input->post('Tipo'),
				'ESTADO' => $this->input->post('Estado')
      );

			// Creo la publicacion
      $slider_id = $this->GeneralModel->actualizar('sliders',['ID_SLIDER'=>$this->input->post('Identificador')],$parametros);

			// Redirecciono
			$this->session->set_flashdata('exito', 'Slider actualizado correctamente');
      redirect(base_url('admin/sliders?tipo='.$this->input->post('Tipo')));

    }else{

			$this->data['slider'] = $this->GeneralModel->detalles('sliders',['ID_SLIDER'=>$_GET['id']]);
			$this->data['tipo'] = $this->data['slider']['TIPO'];

			// Reviso la vista especializada
			$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','form_actualizar_','sliders','_'.$this->data['tipo']);

			// Cargo Vistas
			$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
			$this->load->view($this->data['vista'],$this->data);
			$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
		}
	}
	public function detalles()
	{
		//$this->load->view('welcome_message');
		echo 'Publicaciones Detalles';
	}
	public function activar()
	{
		$this->GeneralModel->activar('sliders',['ID_SLIDER'=>$_GET['id']],$_GET['estado']);
		$slider = $this->GeneralModel->detalles('sliders',['ID_SLIDER'=>$_GET['id']]);

		// Mensaje Feedback
		$this->session->set_flashdata('exito', 'Slider actualizado correctamente');
		redirect(base_url('admin/sliders?tipo='.$slider['TIPO']));
	}
	public function borrar()
	{
		$slider = $this->GeneralModel->detalles('sliders',['ID_SLIDER'=>$_GET['id']]);

      // check if the institucione exists before trying to delete it
      if(isset($slider['ID_SLIDER']))
      {
					// Borro la categoría
          $this->GeneralModel->borrar('sliders',['ID_SLIDER'=>$_GET['id']]);
					// Mensaje Feedback
					$this->session->set_flashdata('exito', 'Slider borrado');
					//  Redirecciono
          redirect(base_url('admin/sliders?tipo='.$publicacion['TIPO'].'&padre='.$publicacion['PUBLICACION_PADRE']));
      } else {
				// Mensaje Feedback
				$this->session->set_flashdata('alerta', 'La Entrada que intentaste borrar no existe');
				//  Redirecciono
         redirect(base_url('admin/sliders'));
			}
	}
}
