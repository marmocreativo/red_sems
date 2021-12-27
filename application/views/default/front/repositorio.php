<!-- Main -->
<div class="contenido-principal">
  <div class="container-fluid">
		<div class="row mt-3">
			<div class="col-12 banner-content"  id="busqueda-int">
          <h5>Nueva búsqueda</h5>
            <form action="<?php echo base_url('repositorio'); ?>" method="get" class="search-form-area">
              <div class="row justify-content-center form-wrap">
                <div class="col-lg-3 form-cols">
                  <input type="text" class="form-control" name="busqueda" placeholder="Busca un recurso">
                </div>
                <div class="col-lg-2 form-cols">
                  <div class="default-select" id="default-selects">
                    <select name="categoria">
                      <option value="">Curso</option>
                      <?php
                        $cursos = $this->GeneralModel->lista('categorias','',['TIPO_OBJETO'=>'archivo', 'CATEGORIA_PADRE'=>'0'],'','','');
                        foreach($cursos as $curso){
                          echo '<option value="'.$curso->ID_CATEGORIA.'" >'.$curso->CATEGORIA_NOMBRE.'</option>';
                        } ?>
                    </select>
                  </div>
                </div>
                <div class="col-lg-2 form-cols">
                  <div class="default-select" id="default-selects2">
                    <select name="busqueda_area">
                      <?php $areas_conocimiento = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'areas_conocimientos'],'','',''); ?>
                      <option value="">Área de conocimiento</option>
                      <?php foreach($areas_conocimiento as $area){ ?>
                        <option value="<?php echo $area->TIPO_NOMBRE;  ?>"><?php echo $area->TIPO_NOMBRE_PLURAL;  ?></option>
                      <?php } ?>
                      </select>
                  </div>
                </div>
                <div class="col-lg-2 form-cols">
                  <div class="default-select" id="default-selects2">
                    <select name="busqueda_recurso">
                      <?php $tipos_recurso = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'tipo_recurso'],'','',''); ?>
                      <option value="">Tipo de recurso</option>
                      <?php foreach($tipos_recurso as $tipo_recurso){ ?>
                        <option value="<?php echo $tipo_recurso->TIPO_NOMBRE;  ?>"><?php echo $tipo_recurso->TIPO_NOMBRE_PLURAL;  ?></option>
                      <?php } ?>
                      </select>
                  </div>
                </div>
                <div class="col-lg-2 form-cols">
                    <button type="submit" class="btn btn-info">
                      <span class="lnr lnr-magnifier"></span> Buscar
                    </button>
                </div>
              </div>
            </form>
			</div>
			<div class="col-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="<?php echo base_url('repositorio'); ?>"> <i class="fa fa-home"></i> </a></li>
						<?php if(isset($_GET['categoria'])){ $categoria = $this->GeneralModel->detalles('categorias',['ID_CATEGORIA'=>$_GET['categoria']]);} //var_dump($categoria);?>
						<?php if(isset($categoria)&&!empty($categoria)){ ?>
						  <!-- CATEGORIAS PADRE -->
						  <?php if($categoria['CATEGORIA_PADRE']!='0'){ ?>
							<?php $categoria_padre = $this->GeneralModel->detalles('categorias',['ID_CATEGORIA'=>$categoria['CATEGORIA_PADRE']]); ?>
							<?php if($categoria_padre['CATEGORIA_PADRE']!='0'){ ?>
							  <?php $categoria_abuelo = $this->GeneralModel->detalles('categorias',['ID_CATEGORIA'=>$categoria_padre['CATEGORIA_PADRE']]); ?>
													<?php if($categoria_abuelo['CATEGORIA_PADRE']!='0'){ ?>
														<?php $categoria_bisabuelo = $this->GeneralModel->detalles('categorias',['ID_CATEGORIA'=>$categoria_abuelo['CATEGORIA_PADRE']]); ?>
														<li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('repositorio?categoria='.$categoria_bisabuelo['ID_CATEGORIA']); ?>" title="<?php echo $categoria_bisabuelo['CATEGORIA_NOMBRE']; ?>"><?php echo character_limiter($categoria_bisabuelo['CATEGORIA_NOMBRE'],10); ?></a></li>
													<?php } ?>
							  <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('repositorio?categoria='.$categoria_abuelo['ID_CATEGORIA']); ?>" title="<?php echo $categoria_abuelo['CATEGORIA_NOMBRE']; ?>"><?php echo character_limiter($categoria_abuelo['CATEGORIA_NOMBRE'],10); ?></a></li>
							<?php } ?>
							<li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('repositorio?categoria='.$categoria_padre['ID_CATEGORIA']); ?>" title="<?php echo $categoria_padre['CATEGORIA_NOMBRE']; ?>"><?php echo character_limiter($categoria_padre['CATEGORIA_NOMBRE'],10); ?></a></li>
						  <?php } ?>
              <li class="breadcrumb-item active" aria-current="page"><?php echo $categoria['CATEGORIA_NOMBRE']; ?></li>
						<?php } ?>

				  </ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="contenedor_repositorio_publico"
				data-categoria='<?php echo $consulta['categoria']; ?>'
				data-orden_cat='<?php echo $consulta['orden_cat']; ?>'
				data-busqueda='<?php echo $consulta['busqueda']; ?>'
				data-busqueda_curso='<?php echo $consulta['busqueda_curso']; ?>'
				data-busqueda_recurso='<?php echo $consulta['busqueda_recurso']; ?>'
        data-busqueda_area='<?php echo $consulta['busqueda_area']; ?>'
				>
					<div class="text-center">
						<i class="fa fa-spinner fa-pulse fa-4x"></i>
					</div>
				</div>
<?php
/* echo 'repositorio.php - consulta[busqueda]: '.$consulta['busqueda'].'<br>';
echo 'repositorio.php - consulta[busqueda_curso]: '.$consulta['busqueda_curso'].'<br>';
echo 'repositorio.php - consulta[busqueda_recurso]: '.$consulta['busqueda_recurso'].'<br><br>'; */
?>
			</div>
		</div>
  </div>
</div>
<!-- End Main -->
