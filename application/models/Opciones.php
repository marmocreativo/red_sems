<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Opciones extends CI_Model {

 function lista(){
  $this->db->from('opciones');
  $query = $this->db->get();
  return $query->result();
 }

}
?>
