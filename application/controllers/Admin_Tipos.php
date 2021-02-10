<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Tipos extends CI_Controller {
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

			$this->data['tipo'] = verificar_variable('GET','tipo','publicaciones');
		// reviso si existe la vista especializada


		// Título General
		$this->data['titulo']  = 'Tipos de Publicaciones | Administrador | '.$this->data['op']['titulo_sitio'];
	}

	public function index()
	{
		// Parámetros de busqueda
		$parametros_or = array();
		$parametros_and = array();
		$orden = verificar_variable('GET','orden','');
		$agrupar = 'TIPO_OBJETO';
		$busqueda = verificar_variable('GET','busqueda','');
		if(!empty($busqueda)){ $parametros_or['TIPO_NOMBRE_PLURAL']=$busqueda; }
		$parametros_and['TIPO_OBJETO']=verificar_variable('GET','tipo',$this->data['tipo']);

			// Reviso la vista especializada
		$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','lista_','tipos','_'.$this->data['tipo']);
		$this->data['tipos'] = $this->GeneralModel->lista('tipos',$parametros_or,$parametros_and,$orden,'','');
		$this->data['grupos_tipos'] = $this->GeneralModel->lista_agrupada('tipos','','',$orden,$agrupar);


		// Cargo Vistas
		$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
		$this->load->view($this->data['vista'],$this->data);
		$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
	}
	public function crear()
	{
		$this->form_validation->set_rules('TipoNombre', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));
		$this->form_validation->set_rules('TipoNombrePlural', 'Nombre en Plural', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));
		$this->form_validation->set_rules('TipoObjeto', 'Objeto', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
	  {
			/*
			PROCESO DE LA IMAGEN
			*/

	    $parametros = array(
				'TIPO_NOMBRE' => $this->input->post('TipoNombre'),
				'TIPO_NOMBRE_SINGULAR' => $this->input->post('TipoNombreSingular'),
				'TIPO_NOMBRE_PLURAL' => $this->input->post('TipoNombrePlural'),
				'TIPO_OBJETO' => $this->input->post('TipoObjeto'),
	    );
			// Creo la publicacion
	    $tipo_id = $this->GeneralModel->crear('tipos',$parametros);

			// Redirecciono
			$this->session->set_flashdata('exito', 'Tipo creado correctamente');
	    redirect(base_url('admin/tipos?tipo='.$this->input->post('TipoObjeto')));



	  }else{

			// Reviso la vista especializada
			$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','form_','tipos','_'.$this->data['tipo']);

			// Cargo Vistas
			$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
			$this->load->view($this->data['vista'],$this->data);
			$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
		}
	}
	public function actualizar()
	{

			$this->form_validation->set_rules('TipoNombre', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));
			$this->form_validation->set_rules('TipoNombrePlural', 'Nombre en Plural', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));
			$this->form_validation->set_rules('TipoObjeto', 'Objeto', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

			if($this->form_validation->run())
		  {
				/*
				PROCESO DE LA IMAGEN
				*/

		    $parametros = array(
					'TIPO_NOMBRE' => $this->input->post('TipoNombre'),
					'TIPO_NOMBRE_SINGULAR' => $this->input->post('TipoNombreSingular'),
					'TIPO_NOMBRE_PLURAL' => $this->input->post('TipoNombrePlural'),
					'TIPO_OBJETO' => $this->input->post('TipoObjeto'),
		    );
				// Creo la publicacion
		    $this->GeneralModel->actualizar('tipos',['ID'=>$this->input->post('Identificador')],$parametros);

				// Redirecciono
				$this->session->set_flashdata('exito', 'Tipo creado correctamente');
		    redirect(base_url('admin/tipos?tipo='.$this->input->post('TipoObjeto')));



		  }else{

				// Reviso la vista especializada
				$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','form_actualizar_','tipos','_'.$this->data['tipo']);
				$this->data['tipos'] = $this->GeneralModel->detalles('tipos',['ID'=>$_GET['id']]);

				// Cargo Vistas
				$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
				$this->load->view($this->data['vista'],$this->data);
				$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
			}
	}
	public function borrar()
	{
		$tipo = $this->GeneralModel->detalles('tipos',['ID'=>$_GET['id']]);

      // check if the institucione exists before trying to delete it
      if(isset($tipo['ID']))
      {
					// Borro la categoría
          $this->GeneralModel->borrar('tipos',['ID'=>$_GET['id']]);
					// Mensaje Feedback
					$this->session->set_flashdata('exito', 'Tipo borrado');
					//  Redirecciono
          redirect(base_url('admin/tipos?tipo='.$tipo['TIPO_OBJETO']));
      } else {
				// Mensaje Feedback
				$this->session->set_flashdata('alerta', 'La Entrada que intentaste borrar no existe');
				//  Redirecciono
         redirect(base_url('admin/tipos'));
			}
	}
}
