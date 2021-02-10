<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_Inicio extends CI_Controller {
	public function __construct(){
	parent::__construct();
		// Cargo las Opciones
		$this->data['op'] = opciones_default();

		// Verifico Sesión


		// reviso el dispositivo
		if($this->agent->is_mobile()){
			//$this->data['dispositivo']  = "mobile";
			$this->data['dispositivo']  = "";
		}else{
			$this->data['dispositivo']  = "";
		}
		// Cargo los modelos
		$this->load->model('UsuariosModel');
		$this->load->model('AutenticacionModel');
		// Variables Globales

		//Titulo
		$this->data['titulo']  = 'Autenticación de usuarios';

	}

	public function index()
	{
		// Open Tags
		$this->data['titulo']  = 'Usuarios | '.$this->data['op']['titulo_sitio'];
		$this->data['descripcion']  = $this->data['op']['acerca_sitio'];
		$this->data['imagen']  = base_url('assets/img/share_default.jpg');

		// Inicio Sesión
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}
		// Datos Generales
		$this->data['titulo']  = 'Panel de Usuario';
		// Vistas
		$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_principal',$this->data);
		$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/pagina_inicio',$this->data);
		$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_principal',$this->data);
	}
	public function crear()
	{
		// Open Tags
		$this->data['titulo']  = 'Usuarios | '.$this->data['op']['titulo_sitio'];
		$this->data['descripcion']  = $this->data['op']['acerca_sitio'];
		$this->data['imagen']  = base_url('assets/img/share_default.jpg');

		/*
		+ Validación de formulario
		*/

		$this->form_validation->set_rules('UsuarioNombre', 'Nombre', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('UsuarioApellidos', 'Apellidos', 'required', array('required' => 'Debes escribir tus %s.'));
		$this->form_validation->set_rules('UsuarioCorreo', 'Correo Electrónico', 'required|valid_email|is_unique[usuarios.USUARIO_CORREO]', array(
			'required' => 'Debes escribir tu %s.',
			'valid_email' => 'Debes escribir una dirección de correo valida.',
			'is_unique' => 'La dirección de correo ya está registrada'
		));
		$this->form_validation->set_rules('UsuarioPass', 'Contraseña', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('UsuarioPassConf', 'Contraseña Confirmación', 'required|matches[UsuarioPass]', array(
			'required' => 'Debes confirmar la Contraseña',
			'matches' => 'La confirmación de la contraseña no coincide.'
		));

		// FOrmulario Válido
		if($this->form_validation->run()){
			/*
			+ Éxito de validación de formulario
			*/
			// Creo el identificador Único
			$id_usuario = uniqid('', true);
			if(!$this->GeneralModel->campo_existe('usuarios',['ID_USUARIO'=>$id_usuario])){
				$id_usuario = uniqid('', true);
			}

			// Creo la contraseña
			$pass = password_hash($this->input->post('UsuarioPass'), PASSWORD_DEFAULT);

			$parametros = [
				'ID_USUARIO' => $id_usuario,
				'USUARIO_NOMBRE' => $this->input->post('UsuarioNombre'),
				'USUARIO_APELLIDOS' => $this->input->post('UsuarioApellidos'),
				'USUARIO_CORREO' => $this->input->post('UsuarioCorreo'),
				'USUARIO_TELEFONO' => $this->input->post('UsuarioTelefono'),
				'USUARIO_PASSWORD' => $pass,
				'FECHA_REGISTRO' => date('Y-m-d H:i:s'),
				'FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
				'TIPO' => 'usuario'
			];

			$usuario_id = $this->GeneralModel->crear('usuarios',$parametros);

			if(!empty($_POST['Extra'])){
				foreach($_POST['Extra'] as $nombre => $valor){
					$parametros_meta = array(
						'ID_OBJETO'=>$id_usuario,
						'DATO_NOMBRE'=>$nombre,
						'DATO_VALOR'=>$valor,
						'TIPO_OBJETO'=>'usuario',
					);
					// Creo las entradas a la galeria
					$this->GeneralModel->crear('extra_datos',$parametros_meta);
				}
			}

			/*
			| -------------------------------------------------------------------------
			| PREPARO CORREO ELECTRÓNICO
			| -------------------------------------------------------------------------
			|
			*/
			// Parametros de correo

			$config['protocol']    = 'smtp';
			$config['smtp_host']    = $this->data['op']['mailer_host'];
			$config['smtp_port']    = $this->data['op']['mailer_port'];
			$config['smtp_timeout'] = '7';
			$config['smtp_user']    = $this->data['op']['mailer_user'];
			$config['smtp_pass']    = $this->data['op']['mailer_pass'];

			$config['charset']    = 'utf-8';
			$config['mailtype'] = 'html'; // or html
			$config['validation'] = TRUE; // bool whether to validate email or not

			/*
			| -------------------------------------------------------------------------
			| /PREPARO CORREO ELECTRÓNICO
			| -------------------------------------------------------------------------
			|
			*/

			$this->data['info'] = array();
			$this->data['info']['Imagen'] = 'banner-crem-recuperar';
			$this->data['info']['Titulo'] = 'Bienvenido a '.$this->data['op']['titulo_sitio'];
			$this->data['info']['Usuario'] = $this->input->post('UsuarioNombre').' '.$this->input->post('UsuarioApellidos');
			$this->data['info']['Mensaje'] = 'Tu registro con nosotros está completo, podrás disfrutar de los beneficios de nuestro Acervo de Contenido Gráfico CREM.';
			$this->data['info']['TextoBoton'] = 'Iniciar sesión';
			$this->data['info']['EnlaceBoton'] = base_url('login');
			$this->data['info']['MensajeSecundario'] = 'Es un placer servirte si tienes dudas o comentarios, escríbenos a <a href="mailto:'.$this->data['op']['correo_sitio'].'">'.$this->data['op']['correo_sitio'].'</a>';
			$this->data['info']['Despedida'] = '';
			$this->data['info']['Contacto'] = '';

			$mensaje = $this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/emails/mensaje_general',$this->data,true);
			$this->email->initialize($config);

			$this->email->from($this->data['op']['mailer_user'], $this->data['op']['titulo_sitio']);
			$this->email->to($this->input->post('UsuarioCorreo'));

			$this->email->subject('Bienvenido a '.$this->data['op']['titulo_sitio']);
			$this->email->message($mensaje);
			// envio el correo
			if($this->email->send()){
				// Genero la retroalimentacion
				$this->session->set_flashdata('exito', 'Tu registro se completó correctamente, ahora puedes iniciar sesión, te enviamos un correo de confirmación');
			}else{
				// Genero la retroalimentacion
				$this->session->set_flashdata('advertencia', 'Tu registro se completó correctamente, ahora puedes iniciar sesión, no pudimos enviar un correo de confirmación');
			}

			// redirecciono
			redirect(base_url('login'));
		}else{
			// Si no hay formulario cargo vistas básicas
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_principal',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/usuario_form_usuario',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_principal',$this->data);
		}

	}
	public function actualizar()
	{
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}

		// Open Tags
		$this->data['titulo']  = 'Usuarios | '.$this->data['op']['titulo_sitio'];
		$this->data['descripcion']  = $this->data['op']['acerca_sitio'];
		$this->data['imagen']  = base_url('assets/img/share_default.jpg');

		/*
		+ Validación de formulario
		*/

		$this->form_validation->set_rules('UsuarioNombre', 'Nombre', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('UsuarioApellidos', 'Apellidos', 'required', array('required' => 'Debes escribir tus %s.'));
		$this->form_validation->set_rules('UsuarioCorreo', 'Correo Electrónico', 'required|valid_email', array(
			'required' => 'Debes escribir tu %s.',
			'valid_email' => 'Debes escribir una dirección de correo valida.',
			'is_unique' => 'La dirección de correo ya está registrada'
		));
		// reviso si está marcada la casilla de lista de correo
		if(!null==$this->input->post('UsuarioListaDeCorreo')){ $lista_correo = 'si'; }else{ $lista_correo = 'no'; }

		if($this->form_validation->run())
		{
			$parametros = array(
				'USUARIO_NOMBRE' => $this->input->post('UsuarioNombre'),
				'USUARIO_APELLIDOS' => $this->input->post('UsuarioApellidos'),
				'USUARIO_CORREO' => $this->input->post('UsuarioCorreo'),
				'USUARIO_TELEFONO' => $this->input->post('UsuarioTelefono'),
				'USUARIO_LISTA_DE_CORREO' => $lista_correo,
				'USUARIO_FECHA_NACIMIENTO' => $this->input->post('UsuarioFechaNacimiento'),
				'FECHA_ACTUALIZACION' => date('Y-m-d H:i:s')
			);

			$this->GeneralModel->actualizar('usuarios',['ID_USUARIO'=>$_SESSION['usuario']['id']],$parametros);

			// Borro los metadatos existentes
			$this->GeneralModel->borrar('extra_datos',['ID_OBJETO'=>$_SESSION['usuario']['id'],'TIPO_OBJETO'=>'publicacion']);

			if(!empty($_POST['Extra'])){
				foreach($_POST['Extra'] as $nombre => $valor){
					$parametros_meta = array(
						'ID_OBJETO'=>$_SESSION['usuario']['id'],
						'DATO_NOMBRE'=>$nombre,
						'DATO_VALOR'=>$valor,
						'TIPO_OBJETO'=>'usuario',
					);
					// Creo las entradas a la galeria
					$this->GeneralModel->crear('extra_datos',$parametros_meta);
				}
			}

			// Genero la retroalimentacion
			$this->session->set_flashdata('exito', 'Perfil actualizado');
			// redirecciono
			redirect(base_url('usuarios/actualizar'));
		}else{
			// Si no hay formulario cargo vistas básicas
			$this->data['usuario'] = $this->GeneralModel->detalles('usuarios',['ID_USUARIO'=>$_SESSION['usuario']['id']]);
			// Extra datos
			$this->data['extra'] = $this->GeneralModel->lista('extra_datos','',['ID_OBJETO'=>$_SESSION['usuario']['id'],'TIPO_OBJETO'=>'usuario'],'','','');
			$this->data['extra_datos'] = array(); foreach($this->data['extra'] as $m){ $this->data['extra_datos'][$m->DATO_NOMBRE]= $m->DATO_VALOR; }

			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_principal',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/usuario_form_actualizar_usuario',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_principal',$this->data);
		}
	}
	public function actualizar_pass()
	{
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}
		// Open Tags
		$this->data['titulo']  = 'Usuarios | '.$this->data['op']['titulo_sitio'];
		$this->data['descripcion']  = $this->data['op']['acerca_sitio'];
		$this->data['imagen']  = base_url('assets/img/share_default.jpg');


		$this->form_validation->set_rules('UsuarioPassActual', 'Contraseña Actual', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('UsuarioPass', 'Contraseña', 'required', array('required' => 'Debes escribir tu %s.'));
		$this->form_validation->set_rules('UsuarioPassConf', 'Contraseña Confirmación', 'required|matches[UsuarioPass]', array(
			'required' => 'Debes confirmar la Contraseña',
			'matches' => 'La confirmación de la contraseña no coincide.'
		));

		if($this->form_validation->run())
		{

			if($this->AutenticacionModel->verificar_password($_SESSION['usuario']['correo'],$this->input->post('UsuarioPassActual'))){
				$id = $_SESSION['usuario']['id'];
				$pass = password_hash($this->input->post('UsuarioPass'), PASSWORD_DEFAULT);
				$parametros = array(
					'USUARIO_PASSWORD' => $pass
				);
				// Actualizo la contraseña
				$this->AutenticacionModel->restaurar_pass($id,$parametros);
				$this->session->set_flashdata('exito', 'Contraseña Actualizada');
				redirect(base_url('usuarios/actualizar'));
			}else{
				// Repido proceso
				$this->session->set_flashdata('alerta', 'Tu contraseña actual no coincide con la que nos proporcionaste');
				redirect(base_url('usuarios/actualizar_pass'));
			}
			//$usuario_id = $this->UsuariosModel->actualizar($_SESSION['usuario']['id'],$parametros);
			//
		}else{
			$this->data['usuario'] = $this->GeneralModel->detalles('usuarios',['ID_USUARIO'=>$_SESSION['usuario']['id']]);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_principal',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/usuario_form_actualizar_pass',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_principal',$this->data);
		}
	}
}
