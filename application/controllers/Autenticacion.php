<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autenticacion extends CI_Controller {
	public function __construct(){
	parent::__construct();
		// Cargo las Opciones
		$this->data['op'] = opciones_default();

		// reviso el dispositivo
		if($this->agent->is_mobile()){
			//$this->data['dispositivo']  = "mobile";
			$this->data['dispositivo']  = "";
		}else{
			$this->data['dispositivo']  = "";
		}
		// Cargo los modelos
		$this->load->model('AutenticacionModel');
		// Variables Globales
		$this->data['titulo']  = 'Autenticación de usuarios';
	}

	public function index()
	{
		$this->data['titulo']  = 'Usuarios | '.$this->data['op']['titulo_sitio'];
		$this->data['descripcion']  = 'Autenticación de usuarios';
		$this->data['imagen']  = base_url('assets/img/share_default.jpg');

		if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			redirect(base_url('repositorio'));
		}else{
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_login',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/usuario_form_login',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_login',$this->data);
		}
	}
	public function iniciar_sesion()
	{
		$this->data['titulo']  = 'Usuarios | '.$this->data['op']['titulo_sitio'];
		$this->data['descripcion']  = 'Autenticación de usuarios';
		$this->data['imagen']  = base_url('assets/img/share_default.jpg');

		// Valido el Formulario
		$this->form_validation->set_rules('UsuarioCorreo', 'Correo Electrónico', 'required|valid_email', array( 'required' => 'Debes escribir tu %s.', 	'valid_email' => 'Debes escribir una dirección de correo valida.' ));
		$this->form_validation->set_rules('UsuarioPass', 'Contraseña', 'required', array('required' => 'Debes escribir tu %s.'));

		if($this->form_validation->run())
		{
				$correo = $this->input->post('UsuarioCorreo');
				$pass = $this->input->post('UsuarioPass');
			// Verifico si el correo está registrado y si coincide la contraseña
			if( $this->AutenticacionModel->verificar_registro($correo) && $this->AutenticacionModel->verificar_password($correo, $pass) ){
				// Si todo está correcto inicio sesión
				$parametros = $this->GeneralModel->detalles('usuarios',['USUARIO_CORREO'=>$correo]);
				if($parametros['ESTADO']!='activo'){
						// Mensaje de feedback
						$this->session->set_flashdata('alerta', 'Tu cuenta parece estar inactiva por favor contacta con nosotros.');
						// redirección
						redirect(base_url('login'));
				}else{
					// Función de Iniciar Sesión
					iniciar_sesion($parametros);
					// Reviso si hay redirección
					if(!null==$this->input->post('UrlRedirect') ){
						// redireccono a la URL anterior
						redirect($this->input->post('UrlRedirect'));
					}else{
						// Redirecciono al panel del usuario
						redirect(base_url('repositorio'));
					}
				}
			}else{
				// Mensaje de feedback
				$this->session->set_flashdata('alerta', 'Tu correo y contraseña no coinciden');
				// redirección
					// Si no coinciden vuelvo a cargar el formulario
					redirect(base_url('login'));
			}
		}else{
			// Si el formulario no se verifica cargo de nuevo el Login
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_login',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/usuario_form_login',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_login',$this->data);
		}
	}
	public function recuperar_pass()
	{
		$this->data['titulo']  = 'Usuarios | '.$this->data['op']['titulo_sitio'];
		$this->data['descripcion']  = 'Autenticación de usuarios';
		$this->data['imagen']  = base_url('assets/img/share_default.jpg');
		// Valido el Formulario
		$this->form_validation->set_rules('UsuarioCorreo', 'Correo Electrónico', 'required|valid_email', array( 'required' => 'Debes escribir tu %s.', 	'valid_email' => 'Debes escribir una dirección de correo valida.' ));

		if($this->form_validation->run())
		{
			$correo = $this->input->post('UsuarioCorreo');
			// Verifico si el correo está registrado y si coincide la contraseña
			if( $this->AutenticacionModel->verificar_registro($correo)){
				// Si todo está correcto inicio sesión
				$datos_usuario = $this->GeneralModel->detalles('usuarios',['USUARIO_CORREO'=>$correo]);

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

				// Datos para enviar por correo
				$this->data['info'] = array();
				$this->data['info']['Imagen'] = 'banner-crem-recuperar';
				$this->data['info']['Titulo'] = 'Recuperar Contraseña';
				$this->data['info']['Usuario'] = $datos_usuario['USUARIO_NOMBRE'].' '.$datos_usuario['USUARIO_APELLIDOS'];
				$this->data['info']['Mensaje'] = 'Has solicitado la restauración de tu contraseña, para poder hacerlo de clic en el siguiente botón.';
				$this->data['info']['TextoBoton'] = 'Restaurar Contraseña';
				$this->data['info']['EnlaceBoton'] = base_url('login/restaurar_pass?id='.$datos_usuario['ID_USUARIO'].'&clave='.$this->AutenticacionModel->crear_pin($datos_usuario['ID_USUARIO']));
				$this->data['info']['MensajeSecundario'] = 'Si no ha solicitado esta restauración ignore este mensaje. Si tiene dudas sobre la actividad de su cuenta contáctenos vía correo electrónico a <a href="mailto:'.$this->data['op']['correo_sitio'].'">'.$this->data['op']['correo_sitio'].'</a>';
				$this->data['info']['Despedida'] = '';
				$this->data['info']['Contacto'] = '';

				$mensaje = $this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/emails/mensaje_general',$this->data,true);
				$this->email->initialize($config);

				$this->email->from($this->data['op']['mailer_user'], $this->data['op']['titulo_sitio']);
				$this->email->to($correo);

				$this->email->subject('Recupera tu contraseña');
				$this->email->message($mensaje);
				// envio el correo

				// envio el correo
				if($this->email->send()){
					// Genero la retroalimentacion
					$this->session->set_flashdata('exito', 'Encontramos tu cuenta, te hemos enviado un correo con un enlace seguro para recuperar tu contraseña');
				}else{
					// Genero la retroalimentacion
					$this->session->set_flashdata('advertencia', 'Encontramos tu cuenta, pero no hemos podido enviar un correo seguro para recuperarla, por favor intentalo de nuevo');
				}
				// redirecciono
				redirect(base_url('login'));

			}else{
					// Si no coinciden vuelvo a cargar el formulario
					// Mensaje de feedback
					$this->session->set_flashdata('alerta', 'No encontramos ninguna cuenta con los datos que proporcionaste');
					// redirección
					redirect(base_url('login/recuperar_pass'));
			}
		}else{
			// Si el formulario no se verifica cargo de nuevo el Login
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_login',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/usuario_form_recuperar_pass',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_login',$this->data);
		}
	}
	public function restaurar_pass()
	{
		$this->data['titulo']  = 'Usuarios | '.$this->data['op']['titulo_sitio'];
		$this->data['descripcion']  = 'Autenticación de usuarios';
		$this->data['imagen']  = base_url('assets/img/share_default.jpg');
		// valido que tenga las variables id y clave en el GET
		if(isset($_GET['id'])&&!empty($_GET['id'])&&isset($_GET['clave'])&&!empty($_GET['clave'])){

			$id = $_GET['id'];
			$clave = $_GET['clave'];

			// Solo si el PIN es válido verifico el formulario
			// Valido el Formulario
			$this->form_validation->set_rules('UsuarioPass', 'Contraseña', 'required', array('required' => 'Debes escribir tu %s.'));
			$this->form_validation->set_rules('UsuarioPassConf', 'Contraseña Confirmación', 'required|matches[UsuarioPass]', array(
				'required' => 'Debes confirmar la Contraseña',
				'matches' => 'La confirmación de la contraseña no coincide.'
			));

			if($this->form_validation->run())
	    {
				// Si el formulario es válido creo el HASH de la contraseña
				$pass = password_hash($this->input->post('UsuarioPass'), PASSWORD_DEFAULT);
				$parametros = array(
					'USUARIO_PASSWORD' => $pass
	      );
				$this->AutenticacionModel->restaurar_pass($id,$parametros);
				$this->AutenticacionModel->desactivar_pin($id,$clave);
				// Mensaje de feedback
				$this->session->set_flashdata('exito', 'Tu contraseña ha sido restaurada correctamente');
				redirect(base_url('login'));
			}else{
				if($this->AutenticacionModel->verificar_pin($id,$clave)){
						// Si el formulario no se verifica cargo de nuevo el Login
						$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_login',$this->data);
						$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/usuario_form_restaurar_pass',$this->data);
						$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_login',$this->data);
				}else{
					// Mensaje de feedback
					$this->session->set_flashdata('alerta', 'El enlace que utilizaste no es válido.');
					// SI el PIN no es valido regreso y mando error
					redirect(base_url('login'));
				}
			}

		}else{
			// Si no tengo las variables definidas redirecciono directo al Login
			$this->session->set_flashdata('alerta', 'El enlace que utilizaste no es válido.');
			redirect(base_url('login'));
		}
	}
	public function cerrar_sesion()
	{
		// Login Form
		session_destroy();
		$this->session->set_flashdata('exito', 'Sesión cerrada correctamente');
		redirect(base_url('login'));
	}
}
