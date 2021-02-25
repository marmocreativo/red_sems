<!-- Main -->
<div class="contenido-principal">
  <div class="container-fluid">
		<div class="row mt-3">
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
						<?php } ?>
						<li class="breadcrumb-item active" aria-current="page"><?php echo $categoria['CATEGORIA_NOMBRE']; ?></li>
				  </ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-md-9">
				<div class="contenedor_repositorio_publico"
				data-categoria='<?php echo $consulta['categoria']; ?>'
				data-orden_cat='<?php echo $consulta['orden_cat']; ?>'
				data-busqueda='<?php echo $consulta['busqueda']; ?>'
				data-busqueda_curso='<?php echo $consulta['busqueda_curso']; ?>'
				data-busqueda_recurso='<?php echo $consulta['busqueda_recurso']; ?>'
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
			<div class="col-12 col-md-3">
				<div class="single-widget search-widget turquesa-fnd">
						<h3 class="text-white">Nueva búsqueda</h3>
						<form action="<?php echo base_url('repositorio'); ?>" method="get" class="search-form-area">
							<div class="row justify-content-center form-wrap">
								<div class="col-12 form-cols">
									<input type="text" class="form-control" name="busqueda" placeholder="Busca un recurso">
								</div>
								<div class="col-12 form-cols pt-10">
									<div class="default-select" id="default-selects">
										<select class="col-12" name="busqueda_curso">
											<option value="0">Selecciona curso</option>
											<option value="Curso_de_prueba">Curso_de_prueba</option>
											<option value="Evolucion_y_procesos_biologicos_SCORM">Evolucion_y_procesos_biologicos_SCORM</option>
											<option value="M7_Prepa_en_Linea-SEP">M7_Prepa_en_Linea-SEP</option>
											<option value="Modulo_14">Modulo_14</option>
											<option value="M16_Evolucion_y_sus_repercusiones_sociales">M16_Evolucion_y_sus_repercusiones_sociales</option>
										</select>
									</div>
								</div>
								<div class="col-12 form-cols pt-10">
									<div class="default-select" id="default-selects2">
										<select class="col-12" name="busqueda_recurso">
											<option value="0">Selecciona recurso</option>
											<option value="Imagen">Imagen</option>
											<option value="Pdf">Pdf</option>
											<option value="Epub">Epub</option>
										</select>
									</div>
								</div>
								<div class="col-12 form-cols pt-10">
										<button type="submit" class="btn btn-info btn-block">
											<span class="lnr lnr-magnifier"></span> Buscar
										</button>
								</div>
							</div>
						</form>
					</div>
			</div>
		</div>
  </div>
</div>
<!-- End Main -->
