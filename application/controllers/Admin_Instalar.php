<?php
ini_set('max_execution_time', 0);
ini_set('memory_limit','2048M');
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Instalar extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function index()
	{
		if ($this->db->table_exists('opciones') )
		{
			$this->session->set_flashdata('advertencia', 'Ya existe una base de datos instalada');
			redirect(base_url());
		}
		else
		{
			$temp_line = '';
	    $lines = file('base_de_datos.sql');
	    foreach ($lines as $line)
	    {
	        if (substr($line, 0, 2) == '--' || $line == '' || substr($line, 0, 1) == '#')
	            continue;
	        $temp_line .= $line;
	        if (substr(trim($line), -1, 1) == ';')
	        {
	            $this->db->query($temp_line);
	            $temp_line = '';
	        }
	    }
			$this->session->set_flashdata('exito', 'Sitio Instalado correctamente');
			redirect(base_url());
		}

	}

}
