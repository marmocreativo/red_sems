<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| OPCIONES GLOBALES
| -------------------------------------------------------------------------
|
*/

if ( ! function_exists('opciones_default'))
{
    function opciones_default()
    {
      $CI =& get_instance();

      $opciones_raw = $CI->opciones->lista();
      $opciones = array();

      foreach($opciones_raw as $op_raw){
        if(!isset($opciones[$op_raw->OPCION_NOMBRE])){
          $opciones[$op_raw->OPCION_NOMBRE] = $op_raw->OPCION_VALOR;
        }else{
          $opciones[$op_raw->OPCION_NOMBRE] = $_SESSION[$op_raw->OPCION_NOMBRE];
        }
      }
      return $opciones;
    }
}
/*
| -------------------------------------------------------------------------
| VERIFICAR MANTENIMIENTO
| -------------------------------------------------------------------------
|
*/

if ( ! function_exists('verificar_mantenimiento'))
{
	 /*
	  Función que revisa si existe una sesión de usuario creada
	  */
	  function verificar_mantenimiento($opcion_mantenimiento)
	  {
  		$CI =& get_instance();

      if(isset($opcion_mantenimiento)&&!empty($opcion_mantenimiento)){
        if($opcion_mantenimiento=='si'){
          return TRUE;
        }else{
          return FALSE;
        }
      }else{
        return FALSE;
      }
	  }
  }

/*
| -------------------------------------------------------------------------
| VERIFICAR SESION
| -------------------------------------------------------------------------
|
*/

if ( ! function_exists('verificar_sesion'))
{
	 /*
	  Función que revisa si existe una sesión de usuario creada
	  */
	  function verificar_sesion($tiempo)
	  {
  		$CI =& get_instance();
  		// Reviso que exista la funci�n del usuario
  		if(isset($_SESSION['usuario'])&&!empty($_SESSION['usuario'])){
  		  // verifico el tiempo de sesi�n
  		  if(strtotime($_SESSION['usuario']['ultima_actividad']) <= strtotime('-'.$tiempo.' Minutes')){
  			// si ha pasado mucho tiempo:
  			// Madno un mensaje, destruyo la sesi�n y retorno falso
  			$CI->session->set_flashdata('mensaje', 'Tu sesi�n se ha cerrado por falta de actividad');
  			session_destroy();
  			return FALSE;
  		  }else{
  			// de lo contrario
  			// Actualizo el tiempo de actividad retorno true
  			$_SESSION['usuario']['ultima_actividad'] = date('Y-m-d H:i:s');
  			return TRUE;
  		  }
  		}else{
  		  // No hay sesi�n de usuario retorno false
  		  return FALSE;
  		}
	  }
  }

  /*
  | -------------------------------------------------------------------------
  | VERIFICAR PERMISOS
  | -------------------------------------------------------------------------
  |
  */

  if ( ! function_exists('verificar_permiso'))
  {
	  /*
		Verifico si el tipo de usuario est� permitido en un controlador
	  */
	  function verificar_permiso($permisos)
	  {
		// creo una llave y la coloco en 0
		$llave = 0;
		// recorro el array de los permisos
		foreach($permisos as $permiso){
		  //Si alguno de los permisos es igual al tipo de usuario de mi sesi�n le sumo 1 a mi llave
		  if($permiso == $_SESSION['usuario']['tipo_usuario']) { $llave ++; }
		}
		// Si la llave es mayor que cero retorno TRUE
		if($llave > 0){ return TRUE; }else{ return FALSE; }
	  }
  }

  /*
  | -------------------------------------------------------------------------
  | INICIAR SESION
  | -------------------------------------------------------------------------
  |
  */
  if ( ! function_exists('iniciar_sesion'))
  {
	  /*
	  Función para iniciar sesion
	  */
	  function iniciar_sesion($parametros){
		 $CI =& get_instance();
		$datos_del_usuario = array(
		  'usuario'=> array(
			'id'  => $parametros['ID_USUARIO'],
			'nombre'  => $parametros['USUARIO_NOMBRE'],
			'apellidos'  => $parametros['USUARIO_APELLIDOS'],
			'correo'  => $parametros['USUARIO_CORREO'],
			'tipo_usuario'  => $parametros['TIPO'],
			'ultima_actividad'  => date('Y-m-d H:i:s'),
		  )
		);
		$CI->session->set_userdata($datos_del_usuario);
	  }
  }

  /*
  | -------------------------------------------------------------------------
  | RETROALIMENTACION
  | -------------------------------------------------------------------------
  |
  */
if ( ! function_exists('retro_alimentacion'))
{
    function retro_alimentacion()
    {
      $CI =& get_instance();
      /*
      Ejemplos de Mensajes de retroalimentación
      $this->session->set_flashdata('alerta', 'Algo salio mal');
      $this->session->set_flashdata('advertencia', 'Algo salio mal');
      $this->session->set_flashdata('exito', 'Algo salio mal');
      $this->session->set_flashdata('mensaje', 'Algo salio mal');
      */
      if(!null==$CI->session->flashdata()){
        if(isset($_SESSION['alerta'])){
            echo '<div class="alert alert-danger alert-dismissible text-center">';
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>';
            echo '<p class="alert-heading"><i class="fa fa-exclamation-triangle"></i><br> ';
            echo $_SESSION['alerta'].'</p>';
            echo '</div> <hr>';
        }
        if(isset($_SESSION['advertencia'])){
            echo '<div class="alert alert-warning alert-dismissible text-center">';
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>';
            echo '<p class="alert-heading"><i class="fa fa-exclamation-circle"></i><br> ';
            echo $_SESSION['advertencia'].'</p>';
            echo '</div> <hr>';
        }
        if(isset($_SESSION['exito'])){
            echo '<div class="alert alert-success alert-dismissible text-center">';
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>';
            echo '<p class="alert-heading"><i class="fa fa-check-circle"></i><br> ';
            echo $_SESSION['exito'].'</p>';
            echo '</div> <hr>';
        }
        if(isset($_SESSION['mensaje'])){
            echo '<div class="alert alert-secondary alert-dismissible text-center">';
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>';
            echo '<p class="alert-heading"><i class="fa fa-info-circle"></i><br> ';
            echo $_SESSION['mensaje'].'</p>';
            echo '</div> <hr>';
        }
      }

      // Alertas de Formulario
      if(!empty(validation_errors())){
        echo '<div class="alert alert-danger">';
          echo validation_errors();
        echo '</div> <hr>';
       }
    }
}

/*
| -------------------------------------------------------------------------
| GENERADOR ALEATORIO
| -------------------------------------------------------------------------
|
*/
if ( ! function_exists('generador_aleatorio'))
{
    function generador_aleatorio($longitud)
    {
      $CI =& get_instance();
      $length = $longitud;
      $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }
}

/*
| -------------------------------------------------------------------------
| CREADOR DE TIMESTAMPS
| -------------------------------------------------------------------------
|
*/
if ( ! function_exists('creador_timestamp'))
{
    function creador_timestamp($fecha,$hora)
    {
      $CI =& get_instance();
      $fecha = date('Y-m-d', strtotime($fecha));
      $hora = date('H:i:s', strtotime($hora));
      $fecha_raw = $fecha.' '.$hora;
      return $fecha_raw;
    }
}

/*
| -------------------------------------------------------------------------
| Verificar una variable
| -------------------------------------------------------------------------
|
*/
if ( ! function_exists('verificar_variable'))
{
  function verificar_variable($tipo,$nombre,$valor_defecto){
    $CI =& get_instance();
    switch ($tipo) {
      case 'GET':
          if(null !== ($CI->input->get($nombre))&&!empty($CI->input->get($nombre))){
            return $CI->input->get($nombre);
          }else{
            return $valor_defecto;
          }
        break;
      case 'POST':
          if(null !== ($CI->input->post($nombre))&&!empty($CI->input->post($nombre))){
            return $CI->input->post($nombre);
          }else{
            return $valor_defecto;
          }
        break;
      case 'SESSION':
          if(isset($_SESSION[$nombre])&&!empty($_SESSION[$nombre])){
            return $_SESSION[$nombre];
          }else{
            return $valor_defecto;
          }
        break;
    }
  }
}

/*
| -------------------------------------------------------------------------
| Verificar una variable
| -------------------------------------------------------------------------
|
*/
if ( ! function_exists('vista_especializada'))
{
  function vista_especializada($dispositivo,$subcarpeta,$clase_contenido,$tabla,$tipo){
    $vista_especializada = $dispositivo.$subcarpeta.$clase_contenido.$tabla.$tipo;
    $vista_general = $dispositivo.$subcarpeta.$clase_contenido.$tabla;
    if (is_file(APPPATH.'views/'.$vista_especializada.'.php')) {
      return $vista_especializada;
    }else{
      return $vista_general;
    }
  }
}
/*
| -------------------------------------------------------------------------
| Verificar una URL
| -------------------------------------------------------------------------
|
*/
if ( ! function_exists('existe_url'))
{
  function existe_url($tabla,$objeto,$url,$id){
    $CI =& get_instance();
    $parametros_and = array();
    $parametros_and['URL']=$url;
    if(!empty($id)){
      switch ($objeto) {
        case 'categoria':
            $parametros_and['ID_CATEGORIA !=']=$id;
          break;
        case 'publicacion':
            $parametros_and['ID_PUBLICACION !=']=$id;
          break;
      }
    }
    $url_existe = $CI->GeneralModel->lista($tabla,'',$parametros_and,'','','');
    if(!empty($url_existe)){
      return true;
    }else{
      return false;
    }
  }
}

/*
| -------------------------------------------------------------------------
| Subir Imagen
| -------------------------------------------------------------------------
|
*/
if ( ! function_exists('subir_imagen'))
{
  function subir_imagen($archivo,$ancho,$alto,$corte,$extension,$tipo_imagen,$calidad,$nombre,$destino)
  {
    $imagen = 'default.jpg';
    // Defino el tipo de imágen
    if(empty($extension)&&empty($tipo_imagen)){
      $extension = '.jpg';
      $tipo_imagen = 'image/jpeg';
    }
    // Si existe el archivo
    if(!empty($archivo)){
      $CI =& get_instance();
      $CI->load->library('SimpleImage');
      $caught = false;
      $imagen = $nombre.$extension;
      if($corte=='corte'){
        try {
          $CI->simpleimage->fromFile($archivo)
          ->autoOrient()
          ->thumbnail($ancho, $alto)
          ->toFile($destino.$nombre.$extension, $tipo_imagen, $calidad);
        }catch(Exception $err) {
          // Handle errors
          echo $err->getMessage();
        }
      }
      if($corte=='encaje'){
        try {
          $CI->simpleimage->fromFile($archivo)
          ->autoOrient()
          ->bestFit($ancho, $alto)
          ->toFile($destino.$nombre.$extension, $tipo_imagen, $calidad);
        }catch(Exception $err) {
          // Handle errors
          echo $err->getMessage();
        }
      }

      if($caught){
        $imagen = 'default.jpg';
      }
    }else{
      $imagen = 'default.jpg';
    }
    return $imagen;
  }
}
/*
| -------------------------------------------------------------------------
| Checkbox - radio multinivel
| -------------------------------------------------------------------------
|
*/
if ( ! function_exists('multinivel'))
{
  function multinivel($tipo,$funcion,$array_seleccionadas,$nivel = 0) {
    $CI =& get_instance();
    $categorias = $CI->GeneralModel->lista('categorias','',['CATEGORIA_PADRE'=>$nivel,'TIPO'=>$tipo],'ORDEN ASC','','');
    $clase_lista = "";
    //Creo la lista del menú
    echo "<ul class='".$clase_lista."'>";
    //Por cada resultado reviso si tienen elementos hijos
    foreach($categorias as $nivel){
      $categorias_hijas = $CI->GeneralModel->lista('categorias','',['CATEGORIA_PADRE'=>$nivel->ID_CATEGORIA,'TIPO'=>$tipo],'ORDEN ASC','','');

      echo "<li>";
        switch ($funcion) {
          case 'checkbox':
            echo '<label class="form-check-label" >';
              echo '<input type="checkbox" class="form-check-input" name="CategoriasObjeto[]" value="'.$nivel->ID_CATEGORIA.'"';
              if(!empty($array_seleccionadas)){
                if(in_array($nivel->ID_CATEGORIA,$array_seleccionadas)){ echo "checked"; }
              }
              echo '>';
            echo $nivel->CATEGORIA_NOMBRE;
            echo "</label>";
            break;
          case 'radio':
            echo '<label class="form-radio-label" >';
              echo '<input type="radio" class="form-check-input" name="CategoriasObjeto[]" value="'.$nivel->ID_CATEGORIA.'"';
              if(!empty($array_seleccionadas)){
                if(in_array($nivel->ID_CATEGORIA,$array_seleccionadas)){ echo "checked"; }
              }
              echo '>';
            echo $nivel->CATEGORIA_NOMBRE;
            echo "</label>";
            break;

          default:
            echo $nivel->CATEGORIA_NOMBRE;
            break;
        }

        if(!empty($categorias_hijas)) {
          multinivel($tipo,$funcion,$array_seleccionadas,$nivel->ID_CATEGORIA);
        }
      echo "</li>";
    }
    echo "</ul>";
  }
}

/*
| -------------------------------------------------------------------------
| Menu Multinevel
| -------------------------------------------------------------------------
|
*/
if ( ! function_exists('menu_principal'))
{
  function menu_principal($grupo,$nivel = 0) {
    $CI =& get_instance();
    $elementos = $CI->GeneralModel->lista('menu','',['MENU_PADRE'=>$nivel,'TIPO'=>$grupo],'ORDEN ASC','','');
    if($nivel==0){
      $inicio_lista = "<ul class='navbar-nav mr-auto d-flex align-items-center'>";
      $fin_lista = "</ul>";
      $inicio_elemento_lista = '<li class="nav-item">';
      $fin_elemento_lista = '</li>';
    }else{
      $inicio_lista = '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
      $fin_lista = "</div>";
      $inicio_elemento_lista = '';
      $fin_elemento_lista = '';
    }
    //Creo la lista del menú
    echo $inicio_lista;
    //Por cada resultado reviso si tienen elementos hijos
    foreach($elementos as $nivel){
      $elementos_hijos =  $CI->GeneralModel->lista('menu','',['MENU_PADRE'=>$nivel->ID_MENU,'TIPO'=>$grupo],'ORDEN ASC','','');
      if(!empty($elementos_hijos)) {
        $clase_enlace = 'nav-link dropdown-toggle';
        $extas_dropdown = 'role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';
        $inicio_elemento_lista = '<li class="nav-item dropdown">';
      }else{
        if($nivel->MENU_PADRE==0){
          $clase_enlace = 'nav-link';
        }else{
          $clase_enlace = 'dropdown-item';
        }
        $extas_dropdown = '';
      }
      echo $inicio_elemento_lista;
        echo '<a class="'.$clase_enlace.'" href="'.$nivel->MENU_ENLACE.'" '.$extas_dropdown.'>'.$nivel->MENU_ETIQUETA.'</a>';
        if(!empty($elementos_hijos)) {
          menu_principal($grupo,$nivel->ID_MENU);
        }
      echo $fin_elemento_lista;
    }
    echo $fin_lista;
  }
}
