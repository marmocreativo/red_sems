<!-- Main -->
<div class="contenido-principal">
  <div class="container">
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
			<div class="col-12 col-md-8">
				<div class="contenedor_repositorio_publico"
				data-categoria='<?php echo $consulta['categoria']; ?>'
				data-orden_cat='<?php echo $consulta['orden_cat']; ?>'
				data-busqueda='<?php echo $consulta['busqueda']; ?>'
				>
					<div class="text-center">
						<i class="fa fa-spinner fa-pulse fa-4x"></i>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div class="single-widget search-widget turquesa-fnd">
						<h3 class="text-white">Nueva búsqueda</h3>
						<form action="<?php echo base_url('repositorio'); ?>" method="get" class="serach-form-area">
							<div class="row justify-content-center form-wrap">
								<div class="col-12 form-cols">
									<input type="text" class="form-control" name="busqueda" placeholder="Busca un recurso">
								</div>
								<div class="col-12 form-cols pt-10">
									<div class="default-select" id="default-selects">
										<select class="col-12">
											<option value="1">Tipo de recurso</option>
											<option value="2">Página web con texto</option>
											<option value="3">Página web con diversos recursos</option>
											<option value="4">Imagen</option>
											<option value="5">Video</option>
											<option value="1">Archivo de texto</option>
											<option value="2">Audio</option>
											<option value="3">Simuladores</option>
											<option value="4">Software/Aplicación</option>
											<option value="5">Video</option>
										</select>
									</div>
								</div>
								<div class="col-12 form-cols pt-10">
									<div class="default-select" id="default-selects2">
										<select class="col-12">
											<option value="1">Audiencia</option>
											<option value="2">Directores</option>
											<option value="3">Docentes</option>
											<option value="4">Tutores</option>
											<option value="5">Estudiantes</option>
											<option value="6">Padres de Familia</option>
											<option value="4">Responsables de Academia</option>
											<option value="5">Responsables de Subsistemas</option>
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
