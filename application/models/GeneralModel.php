<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GeneralModel extends CI_Model {

  function __construct()
  {
      parent::__construct();
      // Función Construct
  }

  /*
    * Conteo de las entradas
 */
  function conteo($tabla,$tablas_join,$parametros_or,$parametros_and,$agrupar){
    // Si envio datos Join
    if(!empty($tablas_join)&&!empty($tablas_join)){
      $alias = '';
      foreach($tablas_join as $tabla_join => $condicion_join){
        if($tabla_join=='extra_datos'){
          $alias .= 'extra_datos.TIPO_OBJETO as META_TIPO_OBJETO';
        }
        if($tabla_join=='categorias_objetos'){
          $alias .= ', categorias_objetos.TIPO as CATEGORIA_TIPO';
        }
        $this->db->join($tabla_join, $condicion_join);
      }
      $this->db->select($tabla.'.*',$alias);
    }
	   if(!empty($agrupar)){
      $this->db->group_by($agrupar);
    }
    // Parametros
    if(!empty($parametros_or)){
      $this->db->group_start();
      $this->db->or_like($parametros_or);
      $this->db->group_end();
    }
    if(!empty($parametros_and)){
      $this->db->group_start();
      $this->db->where($parametros_and);
      $this->db->group_end();
    }

    $query = $this->db->count_all_results($tabla);
    return $query;
  }
  /*
    * Enlisto todas las entradas
 */
 function lista($tabla,$parametros_or,$parametros_and,$orden,$limite,$offset){

   if(!empty($parametros_or)){
     $this->db->group_start();
     $this->db->or_like($parametros_or);
     $this->db->group_end();
   }
   if(!empty($parametros_and)){
     $this->db->group_start();
     $this->db->where($parametros_and);
     $this->db->group_end();
   }
   if(!empty($orden)){
     $this->db->order_by($orden);
   }
   if(!empty($limite)){
     $this->db->limit($limite,$offset);
   }
    $query = $this->db->get($tabla);
    return $query->result();
  }
  /*
    * Enlisto todas las entradas
 */
  function lista_join($tabla,$tablas_join,$parametros_or,$parametros_and,$orden,$limite,$offset,$agrupar){
    // Join
    if($tabla=='publicaciones'){
      $this->db->select('publicaciones.*, publicaciones.TIPO AS TIPO_PUBLICACION');
    }

    if(!empty($tablas_join)){

      foreach($tablas_join as $tabla_join => $condicion_join){
        $this->db->join($tabla_join, $condicion_join);
      }
    }

    // Parametros
    if(!empty($parametros_or)){
      $this->db->group_start();
      $this->db->or_like($parametros_or);
      $this->db->group_end();
    }
    if(!empty($parametros_and)){
      $this->db->group_start();
      $this->db->where($parametros_and);
      $this->db->group_end();
    }
    if(!empty($orden)){
      $this->db->order_by($orden);
    }
    if(!empty($limite)){
      $this->db->limit($limite,$offset);
    }
    $this->db->group_by($agrupar);
    $query = $this->db->get($tabla);
    return $query->result();
  }
  /*
    * Enlisto las entradas de forma agrupada por una columna
 */
 function lista_agrupada($tabla,$parametros_or,$parametros_and,$orden,$agrupar){

   if(!empty($parametros_or)){
     $this->db->group_start();
     $this->db->or_like($parametros_or);
     $this->db->group_end();
   }
   if(!empty($parametros_and)){
     $this->db->group_start();
     $this->db->where($parametros_and);
     $this->db->group_end();
   }
   if(!empty($orden)){
     $this->db->order_by($orden);
   }
   if(!empty($agrupar)){
     $this->db->group_by($agrupar);
   }
    $query = $this->db->get($tabla);
    return $query->result();
  }
  /*
    * Funciones de Verificación
  */
  public function campo_existe($tabla,$parametros){
    $this->db->where($parametros);
    $query = $this->db->get($tabla);
    if ($query->num_rows() > 0){
        return true;
    }else{
        return false;
    }
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($tabla,$parametros){
    return $this->db->get_where($tabla,$parametros)->row_array();
  }

  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles_orden($tabla,$parametros,$orden){
    $this->db->order_by($orden);
    return $this->db->get_where($tabla,$parametros)->row_array();
  }
  /*
    *Obtener solo una cierta cantidad de campos
  */
  function detalles_especificos($tabla,$select,$parametros){
    $this->db->select($select);
    return $this->db->get_where($tabla,$parametros)->row_array();
  }


  function verificar_uri($tabla,$parametros){
    $usuario = $this->db->get_where($tabla,$parametros)->row_array();
    if(!empty($usuario)){ return TRUE; }else{ return FALSE; }
  }
  /*
    * Creo una nueva entrada usando los parámetros
  */
  function crear($tabla,$parametros){
    $this->db->insert($tabla,$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($tabla,$identificadores,$parametros){
    $this->db->where($identificadores);
    return $this->db->update($tabla,$parametros);
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($tabla,$parametros){
    return $this->db->delete($tabla,$parametros);
  }

  /*
    * Interruptor cambia el estado de una entrada de activo a inactivo
    * $id es el identificador de la entrada
    * $activo es el estado actual de la entrada
 */
  function activar($tabla,$parametros,$estado_actual){

    switch($estado_actual){
      case "activo":
        $estado_final = "inactivo";
      break;
      case "inactivo":
        $estado_final = "activo";
      break;
      default:
        $estado_final = "activo";
      break;
    }

    $this->db->where($parametros);
    return $this->db->update($tabla,array('ESTADO'=>$estado_final));
  }
  /*
    * Estadísticas
  */
  /*
  * Más Vistos
  */
  function mas_vistos($parametros_and,$limite){
    $this->db->select('*');
     $this->db->select('COUNT(ID) as cantidad_total');
     $this->db->from('vistas');
     $this->db->order_by('cantidad_total','desc');
     if(!empty($parametros_and)){
       $this->db->where($parametros_and);
      }
     $this->db->limit($limite);
     $this->db->group_by(['TITULO']);
     $datos = $this->db->get()->result_array();
   return $datos;
  }

  /*
  *Conteo algo
  */

  function conteo_elementos($tabla,$parametros){
      $this->db->where($parametros);
      $query = $this->db->get($tabla);
      return $query->num_rows();
  }

  /*
  * Vistas por día
  */
  function conteo_vistas_por_dia($parametros_and,$limite){
    $this->db->select('*');
     $this->db->select('COUNT(ID) as cantidad_total');
     $this->db->from('vistas');
     $this->db->order_by('cantidad_total','desc');
     if(!empty($parametros_and)){
       $this->db->where($parametros_and);
      }
      if(!empty($limite)){
       $this->db->limit($limite);
      }
     $this->db->group_by(['FECHA']);
     $datos = $this->db->get()->row_array();
   return $datos;
  }

  /*
  * Aumentar una vista
  */
  function aumentar_visita($parametros_and){
    $this->db->set('CONTEO', 'CONTEO+1', FALSE);
    $this->db->where($parametros_and);
    $this->db->update('vistas');
  }


}
?>
