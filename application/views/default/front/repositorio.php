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
			<div class="col-10">
				<form class="form-inline mb-2" action="<?php echo base_url('repositorio'); ?>" method="get">
					<input type="text" class="form-control w-75 mr-2" name="busqueda" placeholder="Buscar..," value="<?php if(isset($_GET['busqueda'])){ echo $this->input->get('busqueda');} ?>">
					<button type="submit" name="button" class="btn secondary-solid-btn "> <i class="fa fa-search"></i> </button>
				</form>
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
			<div class="col-2">
				<div class="card bg-light text-center">
					<div class="card-body">
						<p class="dropdown-item">Hola <b><?php echo $_SESSION['usuario']['nombre']; ?></b></p>
			      <div class="dropdown-divider"></div>
			      <a class="btn secondary-solid-btn  btn-block mb-3" href="<?php echo base_url('usuarios/actualizar');?>"> <i class="far fa-id-card"></i> Mi Perfil</a>
			      <?php if($_SESSION['usuario']['tipo_usuario']=='administrador'){ ?>
			      <a class="btn secondary-solid-btn  btn-block mb-3" href="<?php echo base_url('admin'); ?>"> <i class="fa fa-lock"></i> Admin</a>
			      <?php } ?>
						<hr>
			      <a class="btn secondary-solid-btn  btn-block mb-3" href="<?php echo base_url('login/cerrar_sesion');?>"> <i class="fa fa-sign-out-alt"></i> Cerrar Sesión</a>
					</div>
				</div>
			</div>
		</div>
  </div>
</div>
<!-- End Main -->
