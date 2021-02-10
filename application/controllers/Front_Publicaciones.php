<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_Publicaciones extends CI_Controller {
	public function __construct(){
  parent::__construct();
		// Cargo las Opciones
		if (!$this->db->table_exists('opciones') ){
			redirect(base_url('reparar_EN_CMS'));
		}
		$this->data['op'] = opciones_default();

		// reviso el dispositivo
		if($this->agent->is_mobile()){
			//$this->data['dispositivo']  = "mobile";
			$this->data['dispositivo']  = "";
		}else{
			$this->data['dispositivo']  = "";
		}

		$this->data['tipo'] = verificar_variable('GET','tipo','');
	}

	public function index()
	{
		// Verifico el switch de mantenimiento
		if(verificar_mantenimiento($this->data['op']['modo_mantenimiento'])){ redirect(base_url('mantenimiento')); }

		// Open Tags
		$this->data['titulo']  = $this->data['op']['titulo_sitio'];
		$this->data['descripcion']  = $this->data['op']['acerca_sitio'];
		$this->data['imagen']  = base_url('assets/img/share_default.jpg');

		$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_principal',$this->data);
		$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/pagina_inicio',$this->data);
		$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_principal',$this->data);

		// Vistas
	}

	public function tipo()
	{
		// Verifico el switch de mantenimiento
		if(verificar_mantenimiento($this->data['op']['modo_mantenimiento'])){ redirect(base_url('mantenimiento')); }
		// Datos Generales
		$this->data['tipo'] = $this->uri->segment(2, 0);
		$this->data['categoria']  = $this->GeneralModel->detalles('tipos',['TIPO_NOMBRE'=>$this->data['tipo'],'TIPO_OBJETO'=>'publicaciones']);

		// Open Tags
		$this->data['titulo']  = $this->data['categoria']['TIPO_NOMBRE_PLURAL'].' | '.$this->data['op']['titulo_sitio'];
		$this->data['descripcion']  = $this->data['op']['acerca_sitio'];
		$this->data['imagen']  = base_url('assets/img/share_default.jpg');

		// Cargo Vistas
		if(empty($this->data['categoria'])){
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_principal',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/front_lista_categorias',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_principal',$this->data);
		}else{
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_principal',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/front_lista_tipos',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_principal',$this->data);
		}

	}
	public function categoria()
	{
		// Verifico el switch de mantenimiento
		if(verificar_mantenimiento($this->data['op']['modo_mantenimiento'])){ redirect(base_url('mantenimiento')); }

		// Datos Generales
		$this->data['categoria']  = $this->GeneralModel->detalles('categorias',['URL'=>$this->uri->segment(2, 0)]);
		$this->data['tipo'] = $this->data['categoria']['TIPO'];
		$this->data['extra'] = $this->GeneralModel->lista('extra_datos','',['ID_OBJETO'=>$this->data['categoria']['ID_CATEGORIA'],'TIPO_OBJETO'=>'categoria'],'','','');

		// Busco el orden desde un meta dato
		$extra_datos = array(); foreach($this->data['extra'] as $m){ $extra_datos[$m->DATO_NOMBRE]= $m->DATO_VALOR; }
		if(isset($extra_datos['ordenar_por'])&&!empty($extra_datos['ordenar_por'])){ $orden = $extra_datos['ordenar_por']; }else{ $orden = 'ORDEN ASC'; }


		// Inicializo Variables
		$this->data['consulta']=array();
		$parametros_or = array();
		$parametros_and = array();
		// Tipo de categoría lo que carga los formularios con estilos especiales, se busca el tipo básico
		$tipo = $this->data['tipo'];
		$this->data['consulta']['tipo'] = $tipo;
		$orden = verificar_variable('GET','orden','ORDEN ASC');
		$this->data['consulta']['orden'] = $orden;
		$mostrar_por_pagina = verificar_variable('GET','mostrar_por_pagina',$this->data['op']['cantidad_publicaciones_por_pagina']);
		$this->data['consulta']['mostrar_por_pagina'] = $mostrar_por_pagina;
		$pagina = verificar_variable('GET','pagina','1');
		$this->data['consulta']['pagina'] = $pagina;
		$agrupar = 'publicaciones.ID_PUBLICACION';
		// Genero los parametros AND
		$parametros_and['publicaciones.ESTADO']='activo';
		$parametros_and['publicaciones.TIPO']=$tipo;
		$parametros_and['publicaciones.FECHA_PUBLICACION <=']=date('Y-m-d H:m:i');

		$tablas_join = array();
		$tablas_join['extra_datos'] = 'extra_datos.ID_OBJETO = publicaciones.ID_PUBLICACION';

			$tablas_join['categorias_objetos'] = 'categorias_objetos.ID_OBJETO = publicaciones.ID_PUBLICACION';
			$parametros_and['categorias_objetos.ID_CATEGORIA']=$this->data['categoria']['ID_CATEGORIA'];

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
		$this->data['consulta_actual'] = 'categoria='.$this->data['categoria']['ID_CATEGORIA'].'&tipo='.$tipo.'&orden='.$orden.'&mostrar_por_pagina='.$mostrar_por_pagina.'&pagina='.$pagina;
		$this->data['consulta_siguiente'] = 'categoria='.$this->data['categoria']['ID_CATEGORIA'].'&tipo='.$tipo.'&orden='.$orden.'&mostrar_por_pagina='.$mostrar_por_pagina.'&pagina='.$this->data['pagina_siguiente'];
		$this->data['consulta_anterior'] = 'categoria='.$this->data['categoria']['ID_CATEGORIA'].'&tipo='.$tipo.'&orden='.$orden.'&mostrar_por_pagina='.$mostrar_por_pagina.'&pagina='.$this->data['pagina_anterior'];

		// Consulta
		$this->data['publicaciones'] = $this->GeneralModel->lista_join('publicaciones',$tablas_join,$parametros_or,$parametros_and,$orden,$mostrar_por_pagina,$this->data['offset'],$agrupar);


		// Open Tags
		$this->data['titulo']  = $this->data['categoria']['CATEGORIA_NOMBRE'].' | Categoria | '.$this->data['op']['titulo_sitio'];
		$this->data['descripcion']  = $this->data['categoria']['CATEGORIA_DESCRIPCION'];
		$this->data['imagen']  = base_url('contenido/img/categorias/'.$this->data['categoria']['IMAGEN']);
		//vista especializada
		$this->data['vista'] = vista_especializada($this->data['op']['plantilla'].$this->data['dispositivo'],'/front/front_','lista_','publicaciones','_'.$this->data['tipo']);

		// Cargo Vistas
		if(empty($this->data['categoria'])){
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_principal',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/front_lista_categorias',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_principal',$this->data);
		}else{
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_principal',$this->data);
			$this->load->view($this->data['vista'],$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_principal',$this->data);
		}

	}

	public function busqueda()
	{
		// Verifico el switch de mantenimiento
		if(verificar_mantenimiento($this->data['op']['modo_mantenimiento'])){ redirect(base_url('mantenimiento')); }

		// Datos Generales
		$this->data['tipo'] = verificar_variable('GET','tipo','pagina');

		// Inicializo Variables
		$this->data['consulta']=array();
		$parametros_or = array();
		$parametros_and = array();
		// Tipo de categoría lo que carga los formularios con estilos especiales, se busca el tipo básico
		$tipo = $this->data['tipo'];
		$this->data['consulta']['tipo'] = $tipo;
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
			$parametros_or['publicaciones.PUBLICACION_KEYWORDS']=$busqueda;
			$parametros_or['extra_datos.DATO_VALOR']=$busqueda;
		}
		// Genero los parametros AND
		$parametros_and['publicaciones.ESTADO']='activo';
		$parametros_and['publicaciones.TIPO']=$tipo;
		$parametros_and['publicaciones.FECHA_PUBLICACION <=']=date('Y-m-d H:m:i');

		$tablas_join = array();
		$tablas_join['extra_datos'] = 'extra_datos.ID_OBJETO = publicaciones.ID_PUBLICACION';

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
		$this->data['consulta_actual'] = 'tipo='.$tipo.'&orden='.$orden.'&mostrar_por_pagina='.$mostrar_por_pagina.'&pagina='.$pagina.'&busqueda='.$busqueda;
		$this->data['consulta_siguiente'] = 'tipo='.$tipo.'&orden='.$orden.'&mostrar_por_pagina='.$mostrar_por_pagina.'&pagina='.$this->data['pagina_siguiente'].'&busqueda='.$busqueda;
		$this->data['consulta_anterior'] = 'tipo='.$tipo.'&orden='.$orden.'&mostrar_por_pagina='.$mostrar_por_pagina.'&pagina='.$this->data['pagina_anterior'].'&busqueda='.$busqueda;

		// Consulta
		$this->data['publicaciones'] = $this->GeneralModel->lista_join('publicaciones',$tablas_join,$parametros_or,$parametros_and,$orden,$mostrar_por_pagina,$this->data['offset'],$agrupar);


		// Open Tags
		$this->data['titulo']  = 'Resultados de busqueda | '.$busqueda;
		$this->data['descripcion']  = $busqueda;
		$this->data['imagen']  = $this->data['imagen']  = base_url('assets/img/share_default.jpg');
		//vista especializada
		$this->data['vista'] = vista_especializada($this->data['op']['plantilla'].$this->data['dispositivo'],'/front/front_','busqueda_','publicaciones','_'.$this->data['tipo']);

		$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_principal',$this->data);
		$this->load->view($this->data['vista'],$this->data);
		$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_principal',$this->data);

	}

	public function publicacion()
	{
		// Verifico el switch de mantenimiento
		if(verificar_mantenimiento($this->data['op']['modo_mantenimiento'])){ redirect(base_url('mantenimiento')); }

		// Datos Generales
		$this->data['publicacion']  = $this->GeneralModel->detalles('publicaciones',['URL'=>$this->uri->segment(1, 0)]);
		$this->data['tipo'] = $this->data['publicacion']['TIPO'];
		$this->data['extra'] = $this->GeneralModel->lista('extra_datos','',['ID_OBJETO'=>$this->data['publicacion']['ID_PUBLICACION'],'TIPO_OBJETO'=>'publicacion'],'','','');
		$this->data['extra_datos'] = array(); foreach($this->data['extra'] as $m){ $this->data['extra_datos'][$m->DATO_NOMBRE]= $m->DATO_VALOR; }

		// Open Tags
		$this->data['titulo']  = $this->data['publicacion']['PUBLICACION_TITULO'].' | '.$this->data['op']['titulo_sitio'];
		$this->data['descripcion']  = $this->data['publicacion']['PUBLICACION_RESUMEN'];
		$this->data['imagen']  = base_url('contenido/img/publicaciones/'.$this->data['publicacion']['IMAGEN']);
		//vista especializada
		$this->data['vista'] = vista_especializada($this->data['op']['plantilla'].$this->data['dispositivo'],'/front/front_','detalles_','publicacion','_'.$this->data['tipo']);

		// Multimedia
		$tipos_publicaciones = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'multimedia'],'','','');

		$this->data['multimedia'] = array();

		foreach($tipos_publicaciones as $tipo_publicacion){
			$this->data['multimedia'][$tipo_publicacion->TIPO_NOMBRE] = $this->GeneralModel->lista_join(
				'galerias',
				['multimedia'=>'galerias.ID_MULTIMEDIA = multimedia.ID_MULTIMEDIA'],
				'',
				[
					'galerias.ID_OBJETO'=>$this->data['publicacion']['ID_PUBLICACION'],
					'galerias.TIPO_OBJETO'=>$this->data['publicacion']['TIPO'],
					'galerias.TIPO_ARCHIVO'=>$tipo_publicacion->TIPO_NOMBRE
				],'galerias.ORDEN ASC','','','');
		}


		// Cargo Vistas
		if(empty($this->data['publicacion'])){
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_principal',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/404',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_principal',$this->data);
		}else{
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_principal',$this->data);
			$this->load->view($this->data['vista'],$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_principal',$this->data);
		}
	}
	public function video()
	{
		// Verifico el switch de mantenimiento
		if(verificar_mantenimiento($this->data['op']['modo_mantenimiento'])){ redirect(base_url('mantenimiento')); }

		// Datos Generales
		$this->data['publicacion']  = $this->GeneralModel->detalles('publicaciones',['ID_PUBLICACION'=>$this->uri->segment(2, 0)]);
		$this->data['tipo'] = $this->data['publicacion']['TIPO'];
		$this->data['extra'] = $this->GeneralModel->lista('extra_datos','',['ID_OBJETO'=>$this->data['publicacion']['ID_PUBLICACION'],'TIPO_OBJETO'=>'publicacion'],'','','');
		$this->data['extra_datos'] = array(); foreach($this->data['extra'] as $m){ $this->data['extra_datos'][$m->DATO_NOMBRE]= $m->DATO_VALOR; }

		// Open Tags
		$this->data['titulo']  = $this->data['publicacion']['PUBLICACION_TITULO'].' | '.$this->data['op']['titulo_sitio'];
		$this->data['descripcion']  = $this->data['publicacion']['PUBLICACION_RESUMEN'];
		$this->data['imagen']  = base_url('contenido/img/publicaciones/'.$this->data['publicacion']['IMAGEN']);
		//vista especializada
		$this->data['vista'] = vista_especializada($this->data['op']['plantilla'].$this->data['dispositivo'],'/front/front_','detalles_','publicacion','_'.$this->data['tipo']);

		// Multimedia
		$tipos_publicaciones = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'multimedia'],'','','');

		$this->data['multimedia'] = array();

		foreach($tipos_publicaciones as $tipo_publicacion){
			$this->data['multimedia'][$tipo_publicacion->TIPO_NOMBRE] = $this->GeneralModel->lista_join(
				'galerias',
				['multimedia'=>'galerias.ID_MULTIMEDIA = multimedia.ID_MULTIMEDIA'],
				'',
				[
					'galerias.ID_OBJETO'=>$this->data['publicacion']['ID_PUBLICACION'],
					'galerias.TIPO_OBJETO'=>$this->data['publicacion']['TIPO'],
					'galerias.TIPO_ARCHIVO'=>$tipo_publicacion->TIPO_NOMBRE
				],'galerias.ORDEN ASC','','','');
		}


		// Cargo Vistas
		if(empty($this->data['publicacion'])){
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_principal',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/404',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_principal',$this->data);
		}else{
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_principal',$this->data);
			$this->load->view($this->data['vista'],$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_principal',$this->data);
		}
	}
	public function reaccionar()
	{
		if(!verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){
			$this->session->set_flashdata('alerta', 'Debes iniciar sesión para continuar');
			redirect(base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING'])));
		}

		$id_objeto = $_GET['id_objeto'];
		$id_usuario = $_SESSION['usuario']['id'];
		$id_tipo_objeto = $_GET['tipo_objeto'];
		$reaccion = $_GET['reaccion'];
		$url_redirect = $_GET['url_redirect'];

		if(!empty($id_objeto)&&!empty($id_usuario)&&!empty($id_tipo_objeto)&&!empty($reaccion)&&!empty($url_redirect)){
			$mi_reaccion = $this->GeneralModel->detalles('reacciones',['ID_OBJETO'=>$id_objeto,'TIPO_OBJETO'=>$id_tipo_objeto,'ID_USUARIO'=>$id_usuario,'REACCION'=>$reaccion]);

			if(empty($mi_reaccion)){
					$parametros = array(
						'ID_USUARIO'=>$id_usuario,
						'ID_OBJETO'=>$id_objeto,
						'TIPO_OBJETO'=>$id_tipo_objeto,
						'REACCION'=>$reaccion,
						'FECHA_CREACION'=>date('Y-m-d H:i:s'),
					);
					$reaccion_id = $this->GeneralModel->crear('reacciones',$parametros);
			}else{
				$this->GeneralModel->borrar('reacciones',['ID'=>$mi_reaccion['ID']]);
			}
			redirect($url_redirect);

		}else{
			if(empty($url_redirect)){
				$this->session->set_flashdata('alerta', 'Un error ocurrió, tu reacción no se guardó');
				redirect($url_redirect);
			}else{
				$this->session->set_flashdata('alerta', 'Un error ocurrió, tu reacción no se guardó');
				redirect(base_url());
			}
		}

	}
	public function contacto()
	{
		// Verifico el switch de mantenimiento
		if(verificar_mantenimiento($this->data['op']['modo_mantenimiento'])){ redirect(base_url('mantenimiento')); }

		// Datos Generales
		$this->data['tipo'] = 'tela';
		$this->data['titulo']  = 'Sucursales y Distribuidores'.' | '.$this->data['op']['titulo_sitio'];
		$this->data['descripcion']  = 'Contacta con nosotros';
		$this->data['imagen']  = base_url('assets/img/share_default.jpg');
		//vista especializada

		// Cargo Vistas
		$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_principal',$this->data);
		$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/front_contacto',$this->data);
		$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_principal',$this->data);
	}

	public function enviar_mensaje()
	{
		// Verifico el switch de mantenimiento
		if(verificar_mantenimiento($this->data['op']['modo_mantenimiento'])){ redirect(base_url('mantenimiento')); }

		// Datos para enviar por correo
		/*
  				$config['protocol']    = 'smtp';
  				$config['smtp_host']    = $this->data['op']['mailer_host'];
  				$config['smtp_port']    = $this->data['op']['mailer_port'];
  				$config['smtp_timeout'] = '7';
  				$config['smtp_user']    = $this->data['op']['mailer_user'];
  				$config['smtp_pass']    = $this->data['op']['mailer_pass'];
					*/
  				$config['charset']    = 'utf-8';
  				$config['mailtype'] = 'html'; // or html
  				$config['validation'] = TRUE; // bool whether to validate email or not


  			$this->data['info'] = array();
				$this->data['info']['Titulo'] = 'Mensaje de '.$_POST['Nombre'];
				$this->data['info']['Usuario'] = '';
				$this->data['info']['Mensaje'] = $_POST['Mensaje'];
				$this->data['info']['Mensaje'] .= '<p><b>Datos de contacto</b></p>';
				$this->data['info']['Mensaje'] .= '<p><b>Nombre:</b> '.$_POST['Nombre'].'</p>';
				$this->data['info']['Mensaje'] .= '<p><b>Correo:</b> '.$_POST['Correo'].'</p>';
				$this->data['info']['Mensaje'] .= '<p><b>Teléfono:</b> '.$_POST['Telefono'].'</p>';
				$this->data['info']['TextoBoton'] = '';
				$this->data['info']['EnlaceBoton'] = '';
				$this->data['info']['MensajeSecundario'] = 'A la brevedad nos pondremos en contacto';
				$this->data['info']['Despedida'] = 'Saludos!';
				$this->data['info']['Contacto'] = 'Puedes encontrarnos en '.$this->data['op']['correo_sitio'];

				$mensaje = $this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/emails/mensaje_general',$this->data,true);
				$this->email->initialize($config);

				$this->email->from($this->data['op']['mailer_user'], $this->data['op']['titulo_sitio']);
				$this->email->reply_to($_POST['Correo']);
				$this->email->to($this->data['op']['correo_sitio']);
				$this->email->cc($_POST['Correo']);

				$this->email->subject('Mensaje desde '.$this->data['op']['titulo_sitio']);
				$this->email->message($mensaje);
				// envio el correo
				if($this->email->send()){
					// Genero la retroalimentacion
					$this->session->set_flashdata('exito', 'Tu mensaje ha sido enviado, nos comunicaremos contigo a la brevedad');
					$this->email->print_debugger();
				}else{
					// Genero la retroalimentacion
					$this->session->set_flashdata('advertencia', 'No hemos podido enviar tu mensaje, inténtalo de nuevo mas tarde');
					$this->email->print_debugger();
				}
				// redirecciono
				redirect($_POST['UrlRedirect']);

	}

	public function mantenimiento()
	{

		// Verifico el switch de mantenimiento
		if(!verificar_mantenimiento($this->data['op']['modo_mantenimiento'])){ redirect(base_url()); }

		// Open Tags
		$this->data['titulo']  = 'Sitio en mantenimiento';
		$this->data['descripcion']  = 'Nuestro sitio web se encuentra en proceso de mantenimiento por favor vuelve pronto';
		$this->data['imagen']  = base_url('assets/img/share_default.jpg');

		// Cargo Vistas
		$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_login',$this->data);
		$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/mantenimiento',$this->data);
		$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_principal',$this->data);

		// Vistas
	}

	public function sitemap()
	{

		$this->data['categorias'] = $this->GeneralModel->lista('categorias','',['ESTADO'=>'activo'],'ID_CATEGORIA ASC','','');
		$this->data['publicaciones'] = $this->GeneralModel->lista('publicaciones','',['ESTADO'=>'activo'],'ID_PUBLICACION ASC','','');
		// Open Tags
		$this->data['titulo']  = $this->data['op']['titulo_sitio'];
		$this->data['descripcion']  = $this->data['op']['acerca_sitio'];
		$this->data['imagen']  = base_url('assets/img/share_default.jpg');

		$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/sitemap',$this->data);

		// Vistas
	}
}
