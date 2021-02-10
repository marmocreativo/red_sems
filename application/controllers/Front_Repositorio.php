<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_Repositorio extends CI_Controller {
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

		// Inicializo Variables
		$this->data['consulta']=array();
		$this->data['consulta']['categoria'] = verificar_variable('GET','categoria','0');
		$this->data['consulta']['orden_cat'] = verificar_variable('GET','orden_cat','ORDEN ASC');
		$this->data['consulta']['busqueda'] = verificar_variable('GET','busqueda','');

		// Open Tags
		$this->data['titulo']  = $this->data['op']['titulo_sitio'];
		$this->data['descripcion']  = $this->data['op']['acerca_sitio'];
		$this->data['imagen']  = base_url('assets/img/share_default.jpg');

		$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_principal',$this->data);
		$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/repositorio',$this->data);
		$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_principal',$this->data);

		// Vistas
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
		$mostrar_por_pagina = verificar_variable('GET','mostrar_por_pagina',$this->data['op']['cantidad_archivos_por_pagina']);
		$this->data['consulta']['mostrar_por_pagina'] = $mostrar_por_pagina;
		$pagina = verificar_variable('GET','pagina','1');
		$this->data['consulta']['pagina'] = $pagina;
		$agrupar = 'archivos.ID';
		// Genero los parametros AND
		$parametros_and['archivos.ESTADO']='activo';

		$tablas_join = array();
		$tablas_join['extra_datos'] = 'extra_datos.ID_OBJETO = archivos.ID';

			$tablas_join['categorias_objetos'] = 'categorias_objetos.ID_OBJETO = archivos.ID';
			$parametros_and['categorias_objetos.ID_CATEGORIA']=$this->data['categoria']['ID_CATEGORIA'];

		// paginador
		$this->data['pub_totales'] = $this->GeneralModel->conteo('archivos',$tablas_join,$parametros_or,$parametros_and,$agrupar);
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
		$this->data['archivos'] = $this->GeneralModel->lista_join('archivos',$tablas_join,$parametros_or,$parametros_and,$orden,$mostrar_por_pagina,$this->data['offset'],$agrupar);


		// Open Tags
		$this->data['titulo']  = $this->data['categoria']['CATEGORIA_NOMBRE'].' | Categoria | '.$this->data['op']['titulo_sitio'];
		$this->data['descripcion']  = $this->data['categoria']['CATEGORIA_DESCRIPCION'];
		$this->data['imagen']  = base_url('contenido/img/categorias/'.$this->data['categoria']['IMAGEN']);
		//vista especializada
		$this->data['vista'] = vista_especializada($this->data['op']['plantilla'].$this->data['dispositivo'],'/front/front_','lista_','archivos','_'.$this->data['tipo']);

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
		$mostrar_por_pagina = verificar_variable('GET','mostrar_por_pagina',$this->data['op']['cantidad_archivos_por_pagina']);
		$this->data['consulta']['mostrar_por_pagina'] = $mostrar_por_pagina;
		$pagina = verificar_variable('GET','pagina','1');
		$this->data['consulta']['pagina'] = $pagina;
		$agrupar = 'archivos.ID_PUBLICACION';
		$busqueda = verificar_variable('GET','busqueda','');
		$this->data['consulta']['busqueda'] = $busqueda;
		// Expando la busqueda y genero los $parametros_or
		if(!empty($busqueda)){
			$parametros_or['archivos.TITULO']=$busqueda;
			$parametros_or['archivos.DESCRIPCION']=$busqueda;
			$parametros_or['archivos.TEMA']=$busqueda;
		}
		// Genero los parametros AND
		$parametros_and['archivos.ESTADO']='activo';

		$tablas_join = array();
		$tablas_join['extra_datos'] = 'extra_datos.ID_OBJETO = archivos.ID';

		// paginador
		$this->data['pub_totales'] = $this->GeneralModel->conteo('archivos',$tablas_join,$parametros_or,$parametros_and,$agrupar);
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
		$this->data['archivos'] = $this->GeneralModel->lista_join('archivos',$tablas_join,$parametros_or,$parametros_and,$orden,$mostrar_por_pagina,$this->data['offset'],$agrupar);


		// Open Tags
		$this->data['titulo']  = 'Resultados de busqueda | '.$busqueda;
		$this->data['descripcion']  = $busqueda;
		$this->data['imagen']  = $this->data['imagen']  = base_url('assets/img/share_default.jpg');
		//vista especializada
		$this->data['vista'] = vista_especializada($this->data['op']['plantilla'].$this->data['dispositivo'],'/front/front_','busqueda_','archivos','_'.$this->data['tipo']);

		$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_principal',$this->data);
		$this->load->view($this->data['vista'],$this->data);
		$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_principal',$this->data);

	}

	public function archivo()
	{
		// Verifico el switch de mantenimiento
		if(verificar_mantenimiento($this->data['op']['modo_mantenimiento'])){ redirect(base_url('mantenimiento')); }

		// Datos Generales
		$this->data['archivo']  = $this->GeneralModel->detalles('archivos',['URL'=>$this->uri->segment(1, 0)]);
		$this->data['extra'] = $this->GeneralModel->lista('extra_datos','',['ID_OBJETO'=>$this->data['archivo']['ID'],'TIPO_OBJETO'=>'archivo'],'','','');
		$this->data['extra_datos'] = array(); foreach($this->data['extra'] as $m){ $this->data['extra_datos'][$m->DATO_NOMBRE]= $m->DATO_VALOR; }

		// Open Tags
		$this->data['titulo']  = $this->data['archivo']['TITULO'].' | '.$this->data['op']['titulo_sitio'];
		$this->data['descripcion']  = $this->data['archivo']['DESCRIPCION'];
		$this->data['imagen']  = base_url('contenido/img/archivos/'.$this->data['archivo']['IMAGEN']);
		//vista especializada
		$this->data['vista'] = vista_especializada($this->data['op']['plantilla'].$this->data['dispositivo'],'/front/front_','detalles_','archivo','_'.$this->data['tipo']);


		// Cargo Vistas
		if(empty($this->data['archivo'])){
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_principal',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/404',$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_principal',$this->data);
		}else{
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/headers/header_principal',$this->data);
			$this->load->view($this->data['vista'],$this->data);
			$this->load->view($this->data['op']['plantilla'].$this->data['dispositivo'].'/front/footers/footer_principal',$this->data);
		}
	}
}
