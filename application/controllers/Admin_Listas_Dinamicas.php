<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Listas_Dinamicas extends CI_Controller {
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
		$parametros_and['TIPO_OBJETOS_HIJOS']=verificar_variable('GET','tipo',$this->data['tipo']);

			// Reviso la vista especializada
		$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','lista_','listas_dinamicas','_'.$this->data['tipo']);
		$this->data['listas'] = $this->GeneralModel->lista('listas_dinamicas',$parametros_or,$parametros_and,$orden,'','');


		// Cargo Vistas
		$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
		$this->load->view($this->data['vista'],$this->data);
		$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
	}
	public function crear()
	{
		$this->form_validation->set_rules('ListaTitulo', 'Titulo', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {

			// Categoria a buscar
			if(isset($_POST['CategoriasObjeto'])){
					$id_categoria = $_POST['CategoriasObjeto'][0];
				}else{
					$id_categoria = 0;
				}
      $parametros = array(
				'LISTA_TITULO' => $this->input->post('ListaTitulo'),
				'LISTA_SUBTITULO' => $this->input->post('ListaSubtitulo'),
				'TIPO_OBJETOS_HIJOS' => $this->input->post('Tipo'),
				'ID_CATEGORIA' => $id_categoria,
				'LIMITE' => $this->input->post('Limite'),
				'ORDENAR_POR' => $this->input->post('OrdenarPor'),
				'COLUMNAS' => $this->input->post('Columnas'),
				'ESTADO' => $this->input->post('Estado')
      );
			// Creo la publicacion
      $lista_id = $this->GeneralModel->crear('listas_dinamicas',$parametros);

			// Redirecciono
			$this->session->set_flashdata('exito', 'Lista creada correctamente');
      redirect(base_url('admin/listas_dinamicas?tipo='.$this->input->post('Tipo')));

    }else{

			// Reviso la vista especializada
			$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','form_','listas_dinamicas','_'.$this->data['tipo']);

			// Cargo Vistas
			$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
			$this->load->view($this->data['vista'],$this->data);
			$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
		}
	}
	public function actualizar()
	{
		$this->form_validation->set_rules('ListaTitulo', 'Titulo', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
    {


			if(isset($_POST['CategoriasObjeto'])){
					$id_categoria = $_POST['CategoriasObjeto'][0];
				}else{
					$id_categoria = 0;
				}
			$parametros = array(
				'LISTA_TITULO' => $this->input->post('ListaTitulo'),
				'LISTA_SUBTITULO' => $this->input->post('ListaSubtitulo'),
				'TIPO_OBJETOS_HIJOS' => $this->input->post('Tipo'),
				'ID_CATEGORIA' => $id_categoria,
				'LIMITE' => $this->input->post('Limite'),
				'ORDENAR_POR' => $this->input->post('OrdenarPor'),
				'COLUMNAS' => $this->input->post('Columnas'),
				'ESTADO' => $this->input->post('Estado')
			);
			// Creo la publicacion
      $this->GeneralModel->actualizar('listas_dinamicas',['ID'=>$this->input->post('Identificador')],$parametros);

			// Redirecciono
			$this->session->set_flashdata('exito', 'Lista actualizado correctamente');
      redirect(base_url('admin/listas_dinamicas?tipo='.$this->input->post('Tipo')));

    }else{

			$this->data['lista'] = $this->GeneralModel->detalles('listas_dinamicas',['ID'=>$_GET['id']]);
			$this->data['tipo'] = $this->data['lista']['TIPO_OBJETOS_HIJOS'];

			// Reviso la vista especializada
			$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','form_actualizar_','listas_dinamicas','_'.$this->data['tipo']);

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
		$this->GeneralModel->activar('listas_dinamicas',['ID'=>$_GET['id']],$_GET['estado']);
		$lista = $this->GeneralModel->detalles('listas_dinamicas',['ID'=>$_GET['id']]);

		// Mensaje Feedback
		$this->session->set_flashdata('exito', 'Lista actualizada correctamente');
		redirect(base_url('admin/lista_listas_dinamicas?tipo='.$lista['TIPO_OBJETOS_HIJOS']));
	}
	public function borrar()
	{
		$lista = $this->GeneralModel->detalles('listas_dinamicas',['ID'=>$_GET['id']]);

      // check if the institucione exists before trying to delete it
      if(isset($lista['ID']))
      {
					// Borro la categoría
          $this->GeneralModel->borrar('listas_dinamicas',['ID'=>$_GET['id']]);
					// Mensaje Feedback
					$this->session->set_flashdata('exito', 'Lista borrada');
					//  Redirecciono
          redirect(base_url('admin/listas_dinamicas?tipo='.$lista['TIPO_OBJETOS_HIJOS']));
      } else {
				// Mensaje Feedback
				$this->session->set_flashdata('alerta', 'La Entrada que intentaste borrar no existe');
				//  Redirecciono
         redirect(base_url('admin/listas_dinamicas'));
			}
	}
}
