<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Cargo librerías de composer
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin_Usuarios extends CI_Controller {
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
		// Cargo los modelos
		$this->load->model('AutenticacionModel');
		// Variables Globales
			$this->data['tipo'] = verificar_variable('GET','tipo','usuario');
		// reviso si existe la vista especializada


		// Título General
		$this->data['titulo']  = 'Usuarios | Administrador | '.$this->data['op']['titulo_sitio'];
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
		$orden = verificar_variable('GET','orden','FECHA_REGISTRO DESC');
		$this->data['consulta']['orden'] = $orden;
		$mostrar_por_pagina = verificar_variable('GET','mostrar_por_pagina',$this->data['op']['cantidad_publicaciones_por_pagina']);
		$this->data['consulta']['mostrar_por_pagina'] = $mostrar_por_pagina;
		$pagina = verificar_variable('GET','pagina','1');
		$this->data['consulta']['pagina'] = $pagina;
		$agrupar = 'usuarios.ID_USUARIO';
		$busqueda = verificar_variable('GET','busqueda','');
		$this->data['consulta']['busqueda'] = $busqueda;
		// Expando la busqueda y genero los $parametros_or
		if(!empty($busqueda)){
			$parametros_or['usuarios.USUARIO_NOMBRE']=$busqueda;
			$parametros_or['usuarios.USUARIO_APELLIDOS']=$busqueda;
			$parametros_or['usuarios.USUARIO_CORREO']=$busqueda;
		}
		// Genero los parametros AND
		$parametros_and['usuarios.TIPO']=$tipo;

		$tablas_join = array();
		$tablas_join['extra_datos'] = 'extra_datos.ID_OBJETO = usuarios.ID_USUARIO';

		// Join con categoria
		if(!empty($categoria)){
			$tablas_join['categorias_objetos'] = 'categorias_objetos.ID_OBJETO = usuarios.ID_USUARIO';
			$parametros_and['categorias_objetos.ID_CATEGORIA']=$categoria;
		}


		// Busco si hay una vista especializada para el tipo
		$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','lista_','usuarios','_'.$this->data['tipo']);

		// paginador
		$this->data['pub_totales'] = $this->GeneralModel->conteo('usuarios',$tablas_join,$parametros_or,$parametros_and,$agrupar);
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
		$this->data['usuarios'] = $this->GeneralModel->lista_join('usuarios',$tablas_join,$parametros_or,$parametros_and,$orden,$mostrar_por_pagina,$this->data['offset'],$agrupar);

		// Cargo Vistas

		$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
		$this->load->view($this->data['vista'],$this->data);
		$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
	}

	public function crear()
	{
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

		if($this->form_validation->run())
    {

			// Creo el identificador Único
			$id_usuario = uniqid('', true);
			if(!$this->GeneralModel->campo_existe('usuarios',['ID_USUARIO'=>$id_usuario])){
				$id_usuario = uniqid('', true);
			}

			if(isset($_POST['UsuarioListaDeCorreo'])){ $lista_correo = 'si'; }else{ $lista_correo = 'no'; }

			// Creo la contraseña
			$pass = password_hash($this->input->post('UsuarioPass'), PASSWORD_DEFAULT);

			$parametros = [
				'ID_USUARIO' => $id_usuario,
				'USUARIO_NOMBRE' => $this->input->post('UsuarioNombre'),
				'USUARIO_APELLIDOS' => $this->input->post('UsuarioApellidos'),
				'USUARIO_CORREO' => $this->input->post('UsuarioCorreo'),
				'USUARIO_TELEFONO' => $this->input->post('UsuarioTelefono'),
				'USUARIO_FECHA_NACIMIENTO' => date('Y-m-d', strtotime($this->input->post('UsuarioFechaNacimiento'))),
				'USUARIO_PASSWORD' => $pass,
				'FECHA_REGISTRO' => date('Y-m-d H:i:s'),
				'FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
				'TIPO' => $this->input->post('Tipo')
			];

			$usuario_id = $this->GeneralModel->crear('usuarios',$parametros);

			// Categorias
			if(isset($_POST['CategoriasObjeto'])&&!empty($_POST['CategoriasObjeto'])){
				foreach($_POST['CategoriasObjeto'] as $categoria){
					$parametros = array(
						'ID_CATEGORIA' => $categoria,
						'ID_OBJETO' => $usuario_id,
						'TIPO' => $this->input->post('Tipo'),
		      );
					// Creo la relación de categorías
		      $this->GeneralModel->crear('categorias_objetos',$parametros);
				}
			}

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

			// Redirecciono
			$this->session->set_flashdata('exito', 'Usuario creado correctamente');
      redirect(base_url('admin/usuarios?tipo='.$this->input->post('Tipo')));

    }else{

			// Reviso la vista especializada
			$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','form_','usuarios','_'.$this->data['tipo']);

			// Cargo Vistas
			$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
			$this->load->view($this->data['vista'],$this->data);
			$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
		}
	}
	public function actualizar()
	{

			$this->form_validation->set_rules('UsuarioNombre', 'Nombre', 'required', array('required' => 'Debes escribir tu %s.'));
			$this->form_validation->set_rules('UsuarioApellidos', 'Apellidos', 'required', array('required' => 'Debes escribir tus %s.'));
			$this->form_validation->set_rules('UsuarioCorreo', 'Correo Electrónico', 'required|valid_email', array(
				'required' => 'Debes escribir tu %s.',
				'valid_email' => 'Debes escribir una dirección de correo valida.'
			));
			$nuevo_pass = verificar_variable('POST','UsuarioPass','');
			if(!empty($nuevo_pass)){
				$this->form_validation->set_rules('UsuarioPass', 'Contraseña', 'required', array('required' => 'Debes escribir tu %s.'));
				$this->form_validation->set_rules('UsuarioPassConf', 'Contraseña Confirmación', 'required|matches[UsuarioPass]', array(
					'required' => 'Debes confirmar la Contraseña',
					'matches' => 'La confirmación de la contraseña no coincide.'
				));
			}

			if($this->form_validation->run())
	    {

				if(isset($_POST['UsuarioListaDeCorreo'])){ $lista_correo = 'si'; }else{ $lista_correo = 'no'; }



				$parametros = [
					'USUARIO_NOMBRE' => $this->input->post('UsuarioNombre'),
					'USUARIO_APELLIDOS' => $this->input->post('UsuarioApellidos'),
					'USUARIO_CORREO' => $this->input->post('UsuarioCorreo'),
					'USUARIO_TELEFONO' => $this->input->post('UsuarioTelefono'),
					'USUARIO_LISTA_DE_CORREO'=>$lista_correo,
					'USUARIO_FECHA_NACIMIENTO' => date('Y-m-d', strtotime($this->input->post('UsuarioFechaNacimiento'))),
					'FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
					'TIPO' => $this->input->post('Tipo')
				];
					$nuevo_pass = verificar_variable('POST','UsuarioPass','');
				if(!empty($nuevo_pass)){
					// Creo la contraseña
					$pass = password_hash($this->input->post('UsuarioPass'), PASSWORD_DEFAULT);
					$parametros['USUARIO_PASSWORD'] = $pass;
				}

				$this->GeneralModel->actualizar('usuarios',['ID_USUARIO'=>$this->input->post('Identificador')],$parametros);

				// Categorias
				// Borro las categorías existentes
				$this->GeneralModel->borrar('categorias_objetos',['ID_OBJETO'=>$this->input->post('Identificador'),'TIPO'=>$this->input->post('Tipo')]);
				// Genero las nuevas categorias
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
				$this->GeneralModel->borrar('extra_datos',['ID_OBJETO'=>$this->input->post('Identificador'),'TIPO_OBJETO'=>'usuario']);
				// Extra Datos
				if(!empty($_POST['Extra'])){
					foreach($_POST['Extra'] as $nombre => $valor){
						$parametros_meta = array(
							'ID_OBJETO'=>$this->input->post('Identificador'),
							'DATO_NOMBRE'=>$nombre,
							'DATO_VALOR'=>$valor,
							'TIPO_OBJETO'=>'usuario',
						);
						// Creo las entradas a la galeria
						$this->GeneralModel->crear('extra_datos',$parametros_meta);
					}
				}

				// Redirecciono
				$this->session->set_flashdata('exito', 'Usuario actualizado correctamente');
	      redirect(base_url('admin/usuarios?tipo='.$this->input->post('Tipo')));

	    }else{
				$this->data['usuario'] = $this->GeneralModel->detalles('usuarios',['ID_USUARIO'=>$_GET['id']]);
				$this->data['extra'] = $this->GeneralModel->lista('extra_datos','',['ID_OBJETO'=>$_GET['id'],'TIPO_OBJETO'=>'usuario'],'','','');
				$this->data['extra_datos'] = array(); foreach($this->data['extra'] as $m){ $this->data['extra_datos'][$m->DATO_NOMBRE]= $m->DATO_VALOR; }
				// Reviso la vista especializada
				$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','form_actualizar_','usuarios','_'.$this->data['tipo']);

				// Cargo Vistas
				$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
				$this->load->view($this->data['vista'],$this->data);
				$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
			}
	}
	public function relaciones()
	{
		// Parámetros de busqueda
		$parametros_or = array();
		$parametros_and = array();
		$tipo = verificar_variable('GET','tipo','');
		$objeto = 'usuario';
		$orden = verificar_variable('GET','orden','NOMBRE_RELACION ASC');
		$agrupar = '';

			// Reviso la vista especializada

		$this->data['usuario'] = $this->GeneralModel->detalles('usuarios',['ID_USUARIO'=>$_GET['id']]);


		// Primera busqueda
		$parametros_and['OBJETO'] = $objeto;
		$parametros_and['TIPO'] = $this->data['usuario']['TIPO'];
		$parametros_and['OBJETO_REL'] = 'publicacion';
		$this->data['relaciones_publicaciones'] = $this->GeneralModel->lista('relaciones',$parametros_or,$parametros_and,$orden,'','');

		// Segunda busqueda
		$parametros_and = array();
		$parametros_and['OBJETO'] = $objeto;
		$parametros_and['TIPO'] = $this->data['usuario']['TIPO'];
		$parametros_and['OBJETO_REL'] = 'usuario';
		$this->data['relaciones_usuarios'] = $this->GeneralModel->lista_join('relaciones','',$parametros_or,$parametros_and,$orden,'','',$agrupar);

		// Extra datos
		$this->data['extra'] = $this->GeneralModel->lista('extra_datos','',['ID_OBJETO'=>$_GET['id'],'TIPO_OBJETO'=>'publicacion'],'','','');
		$this->data['extra_datos'] = array(); foreach($this->data['extra'] as $m){ $this->data['extra_datos'][$m->DATO_NOMBRE]= $m->DATO_VALOR; }

			// Reviso la vista especializada
		$this->data['vista'] = vista_especializada('default'.$this->data['dispositivo'],'/admin/','lista_','relaciones_usuario','_'.$this->data['tipo']);

		// Cargo Vistas
		$this->load->view('default'.$this->data['dispositivo'].'/admin/header_principal',$this->data);
		$this->load->view($this->data['vista'],$this->data);
		$this->load->view('default'.$this->data['dispositivo'].'/admin/footer_principal',$this->data);
	}

	public function activar()
	{
		$this->GeneralModel->activar('usuarios',['ID_USUARIO'=>$_GET['id']],$_GET['estado']);
		$usuario = $this->GeneralModel->detalles('usuarios',['ID_USUARIO'=>$_GET['id']]);

		// Mensaje Feedback
		$this->session->set_flashdata('exito', 'Usuario actualizado correctamente');
		redirect(base_url('admin/usuarios?tipo='.$usuario['TIPO']));
	}
	public function borrar()
	{
		$usuario = $this->GeneralModel->detalles('usuarios',['ID_USUARIO'=>$_GET['id']]);

      // check if the institucione exists before trying to delete it
      if(isset($usuario['ID_USUARIO']))
      {
					// Borro la categoría
          $this->GeneralModel->borrar('usuarios',['ID_USUARIO'=>$_GET['id']]);
					// Mensaje Feedback
					$this->session->set_flashdata('exito', 'Usuario borrado');
					//  Redirecciono
          redirect(base_url('admin/usuarios?tipo='.$usuario['TIPO']));
      } else {
				// Mensaje Feedback
				$this->session->set_flashdata('alerta', 'La Entrada que intentaste borrar no existe');
				//  Redirecciono
         redirect(base_url('admin/usuarios'));
			}
	}

	public function borrar_tipo()
	{

      // check if the institucione exists before trying to delete it
      if(isset($_GET['tipo']))
      {
					// Borro la categoría
          $this->GeneralModel->borrar('usuarios',['TIPO'=>$_GET['tipo']]);
					// Mensaje Feedback
					$this->session->set_flashdata('exito', 'Usuario borrado');
					//  Redirecciono
          //redirect(base_url('admin/usuarios?tipo='.$usuario['TIPO']));
      } else {
				// Mensaje Feedback
				$this->session->set_flashdata('alerta', 'La Entrada que intentaste borrar no existe');
				//  Redirecciono
         //redirect(base_url('admin/usuarios'));
			}
	}

	public function descargar_excel()
	{

		$parametros_or = array();
		$parametros_and = array();
		$orden = verificar_variable('GET','orden','');
		$busqueda = verificar_variable('GET','busqueda','');
		if(!empty($busqueda)){ $parametros_or['USUARIO_NOMBRE']=$busqueda; }
		if(!empty($busqueda)){ $parametros_or['USUARIO_APELLIDOS']=$busqueda; }
		if(!empty($busqueda)){ $parametros_or['USUARIO_CORREO']=$busqueda; }
		$parametros_and['TIPO']=verificar_variable('GET','tipo',$this->data['tipo']);

			// Reviso la vista especializada
		$this->data['usuarios'] = $this->GeneralModel->lista('usuarios',$parametros_or,$parametros_and,$orden,'','');

		$spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
		// Estilos encabezado
		$sheet->getStyle('A2:O2')
		->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()
		->setARGB('3c8dbc');

		$spreadsheet->getActiveSheet()->getStyle('A2:O2')
    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

		$spreadsheet->getActiveSheet()->getStyle('A2:O2')
    ->getAlignment()->setWrapText(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);

		$sheet->setCellValue('A1', 'Usuarios tipo: '.$this->data['tipo']);
    $sheet->setCellValue('A2', 'ID_USUARIO');
		$sheet->setCellValue('B2', 'USUARIO_NOMBRE');
		$sheet->setCellValue('C2', 'USUARIO_APELLIDOS');
		$sheet->setCellValue('D2', 'USUARIO_CORREO');
		$sheet->setCellValue('E2', 'USUARIO_TELEFONO');
		$sheet->setCellValue('F2', 'USUARIO_COMPANIA');
		$sheet->setCellValue('G2', 'USUARIO_PUESTO');
		$sheet->setCellValue('H2', 'USUARIO_DIRECCION');
		$sheet->setCellValue('I2', 'USUARIO_CODIGO_POSTAL');
		$sheet->setCellValue('J2', 'USUARIO_PAIS');
		$sheet->setCellValue('K2', 'USUARIO_FECHA_NACIMIENTO');
		$sheet->setCellValue('L2', 'USUARIO_LISTA_DE_CORREO');
		$sheet->setCellValue('M2', 'FECHA_REGISTRO');
		$sheet->setCellValue('N2', 'FECHA_ACTUALIZACION');
		$sheet->setCellValue('O2', 'ESTADO');

		$i = 3;
		foreach($this->data['usuarios'] as $usuario){
			$meta = $this->GeneralModel->lista('extra_datos','',['ID_OBJETO'=>$usuario->ID_USUARIO,'TIPO_OBJETO'=>'usuario'],'','','');
			$extra_datos = array(); foreach($meta as $m){ $extra_datos[$m->DATO_NOMBRE]= $m->DATO_VALOR; }
			$compania = ''; if(isset($extra_datos['compania'])){ $compania = $extra_datos['compania']; }
			$puesto = ''; if(isset($extra_datos['puesto'])){ $puesto = $extra_datos['puesto']; }
			$direccion = ''; if(isset($extra_datos['direccion'])){ $direccion = $extra_datos['direccion']; }
			$codigo_postal = ''; if(isset($extra_datos['codigo_postal'])){ $codigo_postal = $extra_datos['codigo_postal']; }
			$pais = ''; if(isset($extra_datos['pais'])){ $pais = $extra_datos['pais']; }

			// Creo la fila con Excel
	    $sheet->setCellValue('A'.$i, $usuario->ID_USUARIO);
			$sheet->setCellValue('B'.$i, $usuario->USUARIO_NOMBRE);
			$sheet->setCellValue('C'.$i, $usuario->USUARIO_APELLIDOS);
			$sheet->setCellValue('D'.$i, $usuario->USUARIO_CORREO);
			$sheet->setCellValue('E'.$i, $usuario->USUARIO_TELEFONO);
			$sheet->setCellValue('F'.$i, $compania);
			$sheet->setCellValue('G'.$i, $puesto);
			$sheet->setCellValue('H'.$i, $direccion);
			$sheet->setCellValue('I'.$i, $codigo_postal);
			$sheet->setCellValue('J'.$i, $pais);
			$sheet->setCellValue('K'.$i, $usuario->USUARIO_FECHA_NACIMIENTO);
			$sheet->setCellValue('L'.$i, $usuario->USUARIO_LISTA_DE_CORREO);
			$sheet->setCellValue('M'.$i, $usuario->FECHA_REGISTRO);
			$sheet->setCellValue('N'.$i, $usuario->FECHA_ACTUALIZACION);
			$sheet->setCellValue('O'.$i, $usuario->ESTADO);
		$i ++;
		}

    $writer = new Xlsx($spreadsheet);

    $filename = 'usuarios'.date('d-m-Y H:i');

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output'); // download file
	}

	public function importar_excel()
	{
		$archivo_excel = $_FILES['file']['tmp_name'];
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($archivo_excel);

		$worksheet = $spreadsheet->getActiveSheet();
		$highestRow = $worksheet->getHighestRow(); // e.g. 10
		$highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
		$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5

		$usuarios = array();
		$i=0;
		for ($row = 2; $row <= $highestRow; ++$row) {
			// Datos generales
			$usuarios[$i]['nombre'] = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
			$usuarios[$i]['apellidos'] = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
			$usuarios[$i]['correo'] = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
			$usuarios[$i]['telefono'] = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
			$usuarios[$i]['acepto_correos'] = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
			$usuarios[$i]['fecha_registro'] = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
			// Extra data
			$usuarios[$i]['compania'] = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
			$usuarios[$i]['puesto'] = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
			$usuarios[$i]['direccion'] = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
			$usuarios[$i]['codigo_postal'] = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
			$usuarios[$i]['pais'] = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
			$i++;
		}

		if(!empty($usuarios)){
			foreach($usuarios as $usuario){

				// verifico si existe el correo
				$existe = $this->GeneralModel->campo_existe('usuarios',['USUARIO_CORREO'=>$usuario['correo']]);
				if(!$existe){

					$id_usuario = uniqid('', true);
					if(!$this->GeneralModel->campo_existe('usuarios',['ID_USUARIO'=>$id_usuario])){
						$id_usuario = uniqid('', true);
					}

					$pass = password_hash(generador_aleatorio(8), PASSWORD_DEFAULT);

					$parametros = [
						'ID_USUARIO' => $id_usuario,
						'USUARIO_NOMBRE' => $usuario['nombre'],
						'USUARIO_APELLIDOS' => $usuario['apellidos'],
						'USUARIO_CORREO' => $usuario['correo'],
						'USUARIO_TELEFONO' => $usuario['telefono'],
						'USUARIO_PASSWORD' => $pass,
						'FECHA_REGISTRO' => date('Y-m-d H:i:s', strtotime($usuario['fecha_registro'])),
						'FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
						'TIPO' => $this->input->post('tipo')
					];

					$this->GeneralModel->crear('usuarios',$parametros);

					// Compañia
					$parametros_meta = array(
						'ID_OBJETO'=>$id_usuario,
						'DATO_NOMBRE'=>'compania',
						'DATO_VALOR'=>$usuario['compania'],
						'TIPO_OBJETO'=>'usuario',
					);
					// Creo las entradas a la galeria
					$this->GeneralModel->crear('extra_datos',$parametros_meta);

					// Puesto
					$parametros_meta = array(
						'ID_OBJETO'=>$id_usuario,
						'DATO_NOMBRE'=>'puesto',
						'DATO_VALOR'=>$usuario['puesto'],
						'TIPO_OBJETO'=>'usuario',
					);
					// Creo las entradas a la galeria
					$this->GeneralModel->crear('extra_datos',$parametros_meta);

					// Dirección
					$parametros_meta = array(
						'ID_OBJETO'=>$id_usuario,
						'DATO_NOMBRE'=>'direccion',
						'DATO_VALOR'=>$usuario['direccion'],
						'TIPO_OBJETO'=>'usuario',
					);
					// Creo las entradas a la galeria
					$this->GeneralModel->crear('extra_datos',$parametros_meta);

					// Código Postal
					$parametros_meta = array(
						'ID_OBJETO'=>$id_usuario,
						'DATO_NOMBRE'=>'codigo_postal',
						'DATO_VALOR'=>$usuario['codigo_postal'],
						'TIPO_OBJETO'=>'usuario',
					);
					// Creo las entradas a la galeria
					$this->GeneralModel->crear('extra_datos',$parametros_meta);

					// País
					$parametros_meta = array(
						'ID_OBJETO'=>$id_usuario,
						'DATO_NOMBRE'=>'pais',
						'DATO_VALOR'=>$usuario['pais'],
						'TIPO_OBJETO'=>'usuario',
					);
					// Creo las entradas a la galeria
					$this->GeneralModel->crear('extra_datos',$parametros_meta);

				}
			}
		}

		redirect('admin/usuarios?tipo='.$this->input->post('tipo'));

	}

	public function actualizar_datos_excel()
	{
		$archivo_excel = $_FILES['file']['tmp_name'];
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($archivo_excel);

		$worksheet = $spreadsheet->getActiveSheet();
		$highestRow = $worksheet->getHighestRow(); // e.g. 10
		$highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
		$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5

		$usuarios = array();
		$i=0;
		for ($row = 2; $row <= $highestRow; ++$row) {
			// Datos generales
			$usuarios[$i]['nombre'] = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
			$usuarios[$i]['apellidos'] = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
			$usuarios[$i]['correo'] = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
			$usuarios[$i]['telefono'] = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
			$usuarios[$i]['acepto_correos'] = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
			$usuarios[$i]['fecha_registro'] = $worksheet->getCellByColumnAndRow(1, $row)->getFormattedValue();
			// Extra data
			$usuarios[$i]['compania'] = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
			$usuarios[$i]['puesto'] = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
			$usuarios[$i]['direccion'] = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
			$usuarios[$i]['codigo_postal'] = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
			$usuarios[$i]['pais'] = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
			$i++;
		}

		if(!empty($usuarios)){
			foreach($usuarios as $usuario){

				// verifico si existe el correo
				$existe = $this->GeneralModel->detalles('usuarios',['USUARIO_CORREO'=>$usuario['correo']]);
				if(!empty($existe)){

					$id_usuario = $existe['ID_USUARIO'];

					$parametros = [
						'USUARIO_NOMBRE' => $usuario['nombre'],
						'USUARIO_APELLIDOS' => $usuario['apellidos'],
						'USUARIO_CORREO' => $usuario['correo'],
						'USUARIO_TELEFONO' => $usuario['telefono'],
						'FECHA_REGISTRO' => date('Y-m-d H:i:s', strtotime($usuario['fecha_registro'])),
						'FECHA_ACTUALIZACION' => date('Y-m-d H:i:s')
					];

					$this->GeneralModel->actualizar('usuarios',['ID_USUARIO'=>$id_usuario],$parametros);

					// Compañia
					$parametros_meta = array(
						'DATO_VALOR'=>$usuario['compania'],
					);
					// Creo las entradas a la galeria
					$this->GeneralModel->actualizar('extra_datos',['ID_OBJETO'=>$id_usuario,'TIPO_OBJETO'=>'usuario','DATO_NOMBRE'=>'compania'],$parametros_meta);

					// Puesto
					$parametros_meta = array(
						'DATO_VALOR'=>$usuario['puesto'],
					);
					// Creo las entradas a la galeria
					$this->GeneralModel->actualizar('extra_datos',['ID_OBJETO'=>$id_usuario,'TIPO_OBJETO'=>'usuario','DATO_NOMBRE'=>'puesto'],$parametros_meta);

					// Dirección
					$parametros_meta = array(
						'DATO_VALOR'=>$usuario['direccion'],
					);
					// Creo las entradas a la galeria
					$this->GeneralModel->actualizar('extra_datos',['ID_OBJETO'=>$id_usuario,'TIPO_OBJETO'=>'usuario','DATO_NOMBRE'=>'direccion'],$parametros_meta);

					// Código Postal
					$parametros_meta = array(
						'DATO_VALOR'=>$usuario['codigo_postal'],
					);
					// Creo las entradas a la galeria
					$this->GeneralModel->actualizar('extra_datos',['ID_OBJETO'=>$id_usuario,'TIPO_OBJETO'=>'usuario','DATO_NOMBRE'=>'codigo_postal'],$parametros_meta);

					// País
					$parametros_meta = array(
						'DATO_VALOR'=>$usuario['pais'],
					);
					// Creo las entradas a la galeria
					$this->GeneralModel->actualizar('extra_datos',['ID_OBJETO'=>$id_usuario,'TIPO_OBJETO'=>'usuario','DATO_NOMBRE'=>'pais'],$parametros_meta);


				}

			}
		}

		redirect('admin/usuarios?tipo='.$this->input->post('tipo'));

	}

	public function form_correo_pass()
	{
		// Inicializo Variables
		$this->data['consulta']=array();
		$parametros_or = array();
		$parametros_and = array();
		// Tipo de categoría lo que carga los formularios con estilos especiales, se busca el tipo básico
		$tipo = verificar_variable('GET','tipo','usuario');
		$this->data['consulta']['tipo'] = $tipo;
		$agrupar = '';
		// Expando la busqueda y genero los $parametros_or
		// Genero los parametros AND
		$parametros_and['TIPO']=$tipo;
		$parametros_and['USUARIO_LISTA_DE_CORREO']='si';

		$tablas_join = array();



		// Consulta
		$usuarios= $this->GeneralModel->lista_join('usuarios','',$parametros_or,$parametros_and,'','','','');
		$no_usuarios = 0;
		$correos_enviados = 0;
		$correos_no_enviados = 0;

		echo 'Enviando...<br>';

		foreach($usuarios as $usuario){
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
			//$this->data['info']['Imagen'] = 'logo_mail';
			$this->data['info']['Imagen'] = 'renovamos_mail';
			$this->data['info']['Titulo'] = '¡Nos renovamos!';
			$this->data['info']['Usuario'] = $usuario->USUARIO_NOMBRE.' '.$usuario->USUARIO_APELLIDOS;
			$this->data['info']['Mensaje'] = '<p>Nos enorgullece presentar la nueva plataforma CREM, donde podrás continuar la descarga de contenido gráfico para tus campañas de comunicación sobre nuestras soluciones.</p><p>Para acceder a la nueva plataforma, te pedimos crear una contraseña y acceder con tu correo registrado.</p>';
			$this->data['info']['TextoBoton'] = 'Crear Contraseña';
			$this->data['info']['EnlaceBoton'] = base_url('login/restaurar_pass?id='.$usuario->ID_USUARIO.'&clave='.$this->AutenticacionModel->crear_pin($usuario->ID_USUARIO));
			$this->data['info']['MensajeSecundario'] = 'Gracias a ti seguimos creciendo. Si tiene dudas sobre la actividad de su cuenta contáctenos vía correo electrónico a <a href="mailto:'.$this->data['op']['correo_sitio'].'">'.$this->data['op']['correo_sitio'].'</a>';
			$this->data['info']['Despedida'] = '';
			$this->data['info']['Contacto'] = '';

			$mensaje = $this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/emails/mensaje_general',$this->data,true);
			$this->email->initialize($config);

			$this->email->from($this->data['op']['mailer_user'], $this->data['op']['titulo_sitio']);
			$this->email->to($usuario->USUARIO_CORREO);

			$this->email->subject('Nos renovamos');
			$this->email->message($mensaje);
			// envio el correo

			// envio el correo
			if($this->email->send()){
				$correos_enviados ++;
				echo 'Enviado a: <b>'.$usuario->USUARIO_CORREO.'</b><br>';
				$this->GeneralModel->actualizar('usuarios',['ID_USUARIO'=>$usuario->ID_USUARIO],['USUARIO_LISTA_DE_CORREO'=>'no']);
			}else{
				$correos_no_enviados ++;

			}
			$no_usuarios ++;
		}

		// Mensaje Feedback
		$this->session->set_flashdata('exito', 'Se han enviado los correos, de '.$no_usuarios.' Usuarios se enviaron '.$correos_enviados.' correos');
		redirect('admin/usuarios?tipo='.$this->input->get('tipo'));

	}
}
