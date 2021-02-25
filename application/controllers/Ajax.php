<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ajax extends CI_Controller {
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

	}

	/*------ Funciones de repositorio ------*/
	public function vista_repositorio()
	{
		//parametros categorias
		$categoria = verificar_variable('GET','categoria','0');
		$parametros_cat_or = array();
		$parametros_cat_and = array();
		$orden_cat = 'categorias.CATEGORIA_NOMBRE ASC';
		$busqueda = verificar_variable('GET','busqueda','');
		$agrupar_cat = 'categorias.ID_CATEGORIA';
		$tablas_join_cat = array(
		);

		if(!empty($busqueda)){
			$parametros_cat_or['categorias.CATEGORIA_NOMBRE']=$busqueda;
			$parametros_cat_or['categorias.CATEGORIA_DESCRIPCION']=$busqueda;
		}else{
			$parametros_cat_and['categorias.CATEGORIA_PADRE']=$categoria;
		}

		$parametros_cat_and['categorias.ESTADO']='activo';
		$parametros_cat_and['categorias.TIPO_OBJETO']='archivo';
		$parametros_cat_and['categorias.TIPO']='archivo';

		$this->data['categorias'] = $this->GeneralModel->lista_join('categorias',$tablas_join_cat,$parametros_cat_or,$parametros_cat_and,$orden_cat,'','',$agrupar_cat);

		// parametros de archivos
		$parametros_pub_or = array();
		$parametros_pub_and = array();
		$orden_pub = 'archivos.TITULO ASC';
		$agrupar_pub = 'archivos.ID';

		$tablas_join_pub = array(
			'categorias_objetos' => 'categorias_objetos.ID_OBJETO = archivos.ID'
		);

		if(!empty($busqueda)){
			$parametros_pub_or['archivos.TITULO']=$busqueda;
			$parametros_pub_or['archivos.DESCRIPCION']=$busqueda;
		}else{
			$parametros_pub_and['categorias_objetos.ID_CATEGORIA']=$categoria;
		}

		$parametros_pub_and['archivos.ESTADO']='activo';

		$this->data['archivos'] = $this->GeneralModel->lista_join('archivos',$tablas_join_pub,$parametros_pub_or,$parametros_pub_and,$orden_pub,'','',$agrupar_pub);

		$this->load->view('default'.$this->data['dispositivo'].'/ajax/repositorio_ajax',$this->data);
	}

	public function vista_repositorio_publico()
	{
		//parametros categorias
		$categoria = verificar_variable('GET','categoria','0');
		$parametros_cat_or = array();
		$parametros_cat_and = array();
		$orden_cat = verificar_variable('GET','orden_cat','CATEGORIA_NOMBRE ASC');
		$busqueda = verificar_variable('GET','busqueda','');
		$agrupar_cat = 'categorias.ID_CATEGORIA';
		$tablas_join_cat = array();

		if(!empty($busqueda)){
			$parametros_cat_or['categorias.CATEGORIA_NOMBRE']=$busqueda;
			$parametros_cat_or['categorias.CATEGORIA_DESCRIPCION']=$busqueda;
		}else{
			$parametros_cat_and['categorias.CATEGORIA_PADRE']=$categoria;
		}

		$parametros_cat_and['categorias.ESTADO']='activo';
		$parametros_cat_and['categorias.TIPO_OBJETO']='archivo';
		$parametros_cat_and['categorias.TIPO']='archivo';

		$this->data['categorias'] = $this->GeneralModel->lista_join('categorias',$tablas_join_cat,$parametros_cat_or,$parametros_cat_and,$orden_cat,'','',$agrupar_cat);

		// parametros de archivos
		$parametros_pub_or = array();
		$parametros_pub_and = array();
		$busqueda_curso = verificar_variable('GET','busqueda_curso','');
		$busqueda_recurso = verificar_variable('GET','busqueda_recurso','');
		$orden_pub = verificar_variable('GET','orden_pub','TITULO ASC');
		$agrupar_pub = 'archivos.ID';

		$tablas_join_pub = array(
			'categorias_objetos' => 'categorias_objetos.ID_OBJETO = archivos.ID'
		);

		if(!empty($busqueda)){
			$parametros_pub_or['archivos.TITULO']=$busqueda;
			$parametros_pub_or['archivos.DESCRIPCION']=$busqueda;
			$parametros_pub_or['archivos.TEMA']=$busqueda;
		}
		$parametros_pub_or['archivos.TITULO_CURSO']=$busqueda_curso;
		$parametros_pub_or['archivos.TIPO_RECURSO']=$busqueda_recurso;
		$parametros_pub_and['archivos.ESTADO']='activo';
		
		/* echo 'ajax.php - $busqueda:'.$busqueda.'<br>';
		echo 'ajax.php - $busqueda_curso:'.$busqueda_curso.'<br>';
		echo 'ajax.php - $busqueda_recurso:'.$busqueda_recurso.'<br><br>';
		*/
		
		$this->data['archivos'] = $this->GeneralModel->lista_join('archivos',$tablas_join_pub,$parametros_pub_or,$parametros_pub_and,$orden_pub,'','',$agrupar_pub);

		$this->load->view('default'.$this->data['dispositivo'].'/ajax/repositorio_publico_ajax',$this->data);
	}


	/*------ /Funciones de repositorio ------*/

	public function url_amigable()
	{
		$titulo = convert_accented_characters($this->input->get('url'));
		$url = url_title($titulo,'-',TRUE);

		if (existe_url($_GET['tabla'],$_GET['objeto'],$url,$_GET['id'])){
			echo $url.'-'.url_title(generador_aleatorio(4),'-',TRUE);
		}else{
			echo $url;
		}
	}

	public function lista_paises()
	{
		$paises = $this->GeneralModel->lista('direcciones_paises','',['ESTADO'=>'activo'],'PAIS_NOMBRE ASC','','');
		foreach($paises as $pais){
			echo '<option value="'.$pais->PAIS_NOMBRE.'" data-id-pais="'.$pais->ID_PAIS.'">'.$pais->PAIS_NOMBRE.'</option>';
		}
	}
	public function lista_estados()
	{
		$estados = $this->GeneralModel->lista('direcciones_estados','',['ID_PAIS'=>$_GET['id_pais'],'ESTADO'=>'activo'],'ESTADO_NOMBRE ASC','','');
		foreach($estados as $estado){
			echo '<option value="'.$estado->ESTADO_NOMBRE.'" data-id-estado="'.$estado->ID_ESTADO.'">'.$estado->ESTADO_NOMBRE.'</option>';
		}
	}

	public function lista_municipios()
	{
		$municipios = $this->GeneralModel->lista('direcciones_municipios','',['ID_ESTADO'=>$_GET['id_estado'],'ESTADO'=>'activo'],'MUNICIPIO_NOMBRE ASC','','');
		foreach($municipios as $municipio){
			echo '<option value="'.$municipio->MUNICIPIO_NOMBRE.'" >'.$municipio->MUNICIPIO_NOMBRE.'</option>';
		}
	}

	public function multimedia_ajax()
	{
		$this->data['multimedia'] = $this->GeneralModel->lista('multimedia','',['TIPO_ARCHIVO'=>$_GET['tipo']],'ID_MULTIMEDIA DESC','','');
		$this->load->view('default'.$this->data['dispositivo'].'/ajax/galeria_'.$_GET['tipo'].'_ajax',$this->data);
	}

	public function galeria_ajax()
	{
		$this->data['multimedia'] = $this->GeneralModel->lista_join('galerias',['multimedia'=>'galerias.ID_MULTIMEDIA = multimedia.ID_MULTIMEDIA'],'',
		[
			'galerias.ID_OBJETO'=>$_GET['id'],
			'galerias.TIPO_ARCHIVO'=>$_GET['tipo'],
			'galerias.TIPO_OBJETO'=>$_GET['tipo_objeto']
		],
			'galerias.ORDEN ASC','','','');
		$this->load->view('default'.$this->data['dispositivo'].'/ajax/galeria_'.$_GET['tipo'].'_ajax',$this->data);
	}

	public function actualizar_multimedia()
	{
		$parametros = array(
			'TITULO'=>$_POST['titulo'],
			'RESUMEN'=>$_POST['resumen'],
			'ARCHIVO'=>$_POST['archivo'],
		);

		$this->GeneralModel->actualizar('multimedia',['ID_MULTIMEDIA'=>$this->input->post('id')],$parametros);
	}

	public function borrar_multimedia()
	{
		$this->GeneralModel->borrar('multimedia',['ID_MULTIMEDIA'=>$_GET['id_multimedia']]);
		$this->GeneralModel->borrar('galerias',['ID_MULTIMEDIA'=>$_GET['id_multimedia']]);
	}

	public function select_objetos_relaciones()
	{
		switch ($_GET['objeto']) {
			case 'publicaciones':
					$this->data['publicaciones'] = $this->GeneralModel->lista_join('publicaciones','','',['TIPO'=>$_GET['tipo']],'PUBLICACION_TITULO ASC','','','');
				break;
			case 'usuarios':
					$this->data['usuarios'] = $this->GeneralModel->lista_join('usuarios','','',['TIPO'=>$_GET['tipo']],'USUARIO_NOMBRE ASC','','','');
				break;

			default:
				$this->data['publicaciones'] = $this->GeneralModel->lista_join('publicaciones','','',['TIPO'=>$_GET['tipo']],'PUBLICACION_TITULO ASC','','','');
				break;
		}

		$this->load->view('default'.$this->data['dispositivo'].'/ajax/select_'.$_GET['objeto'].'_relaciones_ajax',$this->data);
	}


	public function reordenar()
	{
		//var_dump($_GET);
		$i = 0;
		parse_str($_GET['objetos'],$objetos);
		foreach ( $objetos['item'] as $identificador) {
			$this->GeneralModel->actualizar($_GET['tabla'],[$_GET['columna']=>$identificador],['ORDEN'=>$i]);
		    $i++;
		}
		//
	}


	public function reordenar_menu()
	{
		//var_dump($_GET);

		$i = 0;
		parse_str($_GET['objetos'],$objetos);
		var_dump($objetos);
		foreach ( $objetos['elementos'] as $identificador => $padre) {

			$this->GeneralModel->actualizar('menu',['ID_MENU'=>$identificador],['MENU_PADRE'=>$padre,'ORDEN'=>$i]);
		    $i++;
		}
		//
	}

	public function vistas_por_dia()
	{
		$d = array();
		for($i = 0; $i < 35; $i++){
	    $d[] = date("Y-m-d", strtotime('today -31 days +'. $i .' days'));
		}
		$vistas_x_fecha = array();
		foreach($d as $d){
			$vistas = $this->GeneralModel->conteo_vistas_por_dia(['FECHA'=>$d],'');
			$fecha_dia = intval(date('U',strtotime($d)));
			if($vistas['cantidad_total']!=0){
				$vistas_x_fecha[]=[$fecha_dia,intval($vistas['cantidad_total'])];
			}else{
				$vistas_x_fecha[]=[$fecha_dia,0];
			}

		}
		$grafica['label']='Vistas de los últimos 35 días';
		$grafica['data'] = $vistas_x_fecha;
		$respuesta = json_encode($vistas_x_fecha);
		echo $respuesta;
	}
}
