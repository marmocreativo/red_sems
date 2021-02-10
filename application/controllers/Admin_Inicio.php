<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Inicio extends CI_Controller {
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
		$this->data['tipo'] = verificar_variable('GET','tipo','');
		// Título General
		$this->data['titulo']  = 'Administrador | '.$this->data['op']['titulo_sitio'];

		// Cargo los modelos
	}
	public function index()
	{
		// Datos Generales
		$this->data['fecha_inicio'] = date('Y-m-d', strtotime('-30 days'));
		$this->data['fecha_final'] = date('Y-m-d');

		if(isset($_GET['fecha_inicio'])&&!empty($_GET['fecha_inicio'])){ $this->data['fecha_inicio'] = $_GET['fecha_inicio']; }
		if(isset($_GET['fecha_final'])&&!empty($_GET['fecha_final'])){ $this->data['fecha_final'] = $_GET['fecha_final']; }

		$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
		$this->load->view('default'.$this->data['dispositivo'].'/admin/pagina_inicio',$this->data);
		$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
	}
	public function opciones()
	{
		$this->form_validation->set_rules('Opciones[]', 'Opciones', 'required');
		if($this->form_validation->run())
    {
			foreach($_POST['Opciones']as $opcion => $valor){
				$parametros = array(
					'OPCION_VALOR' => $valor,
	      );
				// Creo Actualizo la opción
				$this->GeneralModel->actualizar('opciones',['OPCION_NOMBRE'=>$opcion],$parametros);
			}

			// Redirecciono
			$this->session->set_flashdata('exito', 'Publicación creada correctamente');
      redirect(base_url('admin/opciones'));

    }else{

			// Reviso la vista especializada
			$this->data['vista'] = 'default'.$this->data['dispositivo'].'/admin/lista_opciones';
			$this->data['grupos_opciones'] = $this->GeneralModel->lista_agrupada('opciones','','','OPCION_TIPO DESC','OPCION_TIPO');

			// Cargo Vistas
			$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
			$this->load->view($this->data['vista'],$this->data);
			$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
		}
	}
	public function crear_opcion()
	{
		$this->form_validation->set_rules('OpcionNombre', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));
		$this->form_validation->set_rules('OpcionValor', 'Valor', 'required', array( 'required' => 'Debes designar el %s.' ));
		$this->form_validation->set_rules('OpcionTipo', 'Tipo', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El tipo no puede superar los 255 caracteres' ));
		$this->form_validation->set_rules('OpcionInput', 'Input', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El Input no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
	  {

	    $parametros = array(
				'OPCION_NOMBRE' => $this->input->post('OpcionNombre'),
				'OPCION_VALOR' => $this->input->post('OpcionValor'),
				'OPCION_INPUT' => $this->input->post('OpcionInput'),
				'OPCION_TIPO' => $this->input->post('OpcionTipo'),
				'ORDEN' => 0
	    );
			// Creo la publicacion
	    $tipo_id = $this->GeneralModel->crear('opciones',$parametros);

			// Redirecciono
			$this->session->set_flashdata('exito', 'Opción variable creada correctamente');
	    redirect(base_url('admin/opciones'));



	  }else{

			// Reviso la vista especializada
			$this->data['vista'] = 'default'.$this->data['dispositivo'].'/admin/form_opciones';
			$this->data['grupos_opciones'] = $this->GeneralModel->lista_agrupada('opciones','','','OPCION_TIPO DESC','OPCION_TIPO');

			// Cargo Vistas
			$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
			$this->load->view($this->data['vista'],$this->data);
			$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
		}
	}
	public function actualizar_opcion()
	{
		$this->form_validation->set_rules('OpcionNombre', 'Nombre', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El nombre no puede superar los 255 caracteres' ));
		$this->form_validation->set_rules('OpcionValor', 'Valor', 'required', array( 'required' => 'Debes designar el %s.' ));
		$this->form_validation->set_rules('OpcionTipo', 'Tipo', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El tipo no puede superar los 255 caracteres' ));
		$this->form_validation->set_rules('OpcionInput', 'Input', 'required|max_length[255]', array( 'required' => 'Debes designar el %s.', 'max_length' => 'El Input no puede superar los 255 caracteres' ));

		if($this->form_validation->run())
	  {

	    $parametros = array(
				'OPCION_NOMBRE' => $this->input->post('OpcionNombre'),
				'OPCION_VALOR' => $this->input->post('OpcionValor'),
				'OPCION_INPUT' => $this->input->post('OpcionInput'),
				'OPCION_TIPO' => $this->input->post('OpcionTipo'),
	    );
			// Creo la publicacion
	    $this->GeneralModel->actualizar('opciones',['ID'=>$this->input->post('Identificador')],$parametros);

			// Redirecciono
			$this->session->set_flashdata('exito', 'Opción variable actualizada correctamente');
	    redirect(base_url('admin/opciones'));



	  }else{

			// Reviso la vista especializada
			$this->data['vista'] = 'default'.$this->data['dispositivo'].'/admin/form_actualizar_opciones';
			$this->data['grupos_opciones'] = $this->GeneralModel->lista_agrupada('opciones','','','OPCION_TIPO DESC','OPCION_TIPO');
			$this->data['opcion'] = $this->GeneralModel->detalles('opciones',['ID'=>$_GET['id']]);

			// Cargo Vistas
			$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
			$this->load->view($this->data['vista'],$this->data);
			$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
		}
	}
	public function borrar_opcion()
	{
		$opcion = $this->GeneralModel->detalles('opciones',['ID'=>$_GET['id']]);

      // check if the institucione exists before trying to delete it
      if(isset($opcion['ID']))
      {
					// Borro la categoría
          $this->GeneralModel->borrar('opciones',['ID'=>$_GET['id']]);
					// Mensaje Feedback
					$this->session->set_flashdata('exito', 'Opción variable borrada');
					//  Redirecciono
          redirect(base_url('admin/opciones'));
      } else {
				// Mensaje Feedback
				$this->session->set_flashdata('alerta', 'La Opción que intentaste borrar no existe');
				//  Redirecciono
         redirect(base_url('admin/opciones'));
			}
	}
	public function menu()
	{
		// Reviso la vista especializada
		$this->data['vista'] = 'default'.$this->data['dispositivo'].'/admin/lista_menu';
		$this->data['grupo'] = verificar_variable('GET','grupo','principal');

		// Cargo Vistas
		$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
		$this->load->view($this->data['vista'],$this->data);
		$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
	}
	public function menu_crear()
	{
		$this->form_validation->set_rules('TipoElemento', 'Tipo de Elemento', 'required', array( 'required' => 'Debes designar el %s.' ));

		if($this->form_validation->run())
    {
			$parametros = array(
				'MENU_PADRE' => 0,
				'TIPO' => $this->input->post('MenuGrupo'),
				'ORDEN' => 0,
      );

			switch ($this->input->post('TipoElemento')) {
				case 'categoria':
					$categoria = $this->GeneralModel->detalles('categorias',['ID_CATEGORIA'=>$_POST['CategoriasObjeto'][0]]);
					$etiqueta = $categoria['CATEGORIA_NOMBRE'];
					$enlace = base_url('categoria/'.$categoria['URL']);
					$parametros['MENU_ETIQUETA'] = $etiqueta;
					$parametros['MENU_ENLACE'] = $enlace;
					break;
				case 'publicacion':
					$publicacion = $this->GeneralModel->detalles('publicaciones',['ID_PUBLICACION'=>$_POST['IdPublicacion']]);
					$etiqueta = $publicacion['PUBLICACION_TITULO'];
					$enlace = base_url($publicacion['URL']);
					$parametros['MENU_ETIQUETA'] = $etiqueta;
					$parametros['MENU_ENLACE'] = $enlace;
					break;
				case 'enlace_externo':
					$etiqueta = $_POST['Etiqueta'];
					$enlace = $_POST['Enlace'];
					$parametros['MENU_ETIQUETA'] = $etiqueta;
					$parametros['MENU_ENLACE'] = $enlace;
					break;
			}


			// Creo el
      $this->GeneralModel->crear('menu',$parametros);

			// Redirecciono
			$this->session->set_flashdata('exito', 'Enlace creado correctamente');
      redirect(base_url('admin/menu?grupo='.$_POST['MenuGrupo']));

    }else{

			$this->session->set_flashdata('alerta', 'No has enviado un enlace válido');
      redirect(base_url('admin/menu?grupo='.$_POST['MenuGrupo']));
		}
	}
	public function menu_actualizar()
	{
		$this->form_validation->set_rules('Enlace', 'Enlace', 'required', array( 'required' => 'Debes designar el %s.' ));

		if($this->form_validation->run())
    {
			$parametros = array(
				'MENU_ETIQUETA'=>$_POST['Etiqueta'],
				'MENU_ENLACE'=>$_POST['Enlace'],
      );

			// Actualizo el menú
      $this->GeneralModel->actualizar('menu',['ID_MENU'=>$this->input->post('Identificador')],$parametros);

			// Redirecciono
			$this->session->set_flashdata('exito', 'Enlace actualizado correctamente');
      redirect(base_url('admin/menu'));

    }else{

			$this->session->set_flashdata('alerta', 'No has enviado un enlace válido');
      redirect(base_url('admin/menu'));
		}
	}
	public function menu_borrar()
	{
		$menu = $this->GeneralModel->detalles('menu',['ID_MENU'=>$_GET['id']]);

      // check if the institucione exists before trying to delete it
      if(isset($menu['ID_MENU']))
      {
				// Si tiene elementos HIJOS los mando al inicio
					$this->GeneralModel->actualizar('menu',['MENU_PADRE'=>$menu['ID_MENU'],'TIPO'=>$menu['TIPO']],['MENU_PADRE'=>0]);
					// Borro la categoría
          $this->GeneralModel->borrar('menu',['ID_MENU'=>$_GET['id']]);
					// Mensaje Feedback
					$this->session->set_flashdata('exito', 'Enlace borrado');
					//  Redirecciono
          redirect(base_url('admin/menu'));
      } else {
				// Mensaje Feedback
				$this->session->set_flashdata('alerta', 'La Entrada que intentaste borrar no existe');
				//  Redirecciono
         redirect(base_url('admin/menu'));
			}
	}

}
