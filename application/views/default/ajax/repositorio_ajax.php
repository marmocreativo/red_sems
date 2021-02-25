<?php $lista_usuarios = $this->GeneralModel->lista('usuarios','',['ESTADO'=>'activo'],'USUARIO_NOMBRE ASC','',''); ?>
<div class="row mb-4">
	<div class="col-12">
		<h5>Carpetas</h5>
	</div>
	<?php foreach($categorias as $categoria){ ?>
		<div class="col-12 col-sm-6 col-md-4 mb-3">
				<div class="card single-promo-card single-promo-hover text-center shadow-sm">
					<div class="card single-promo-card single-promo-hover text-center shadow-sm">
						<div class="card-body d-flex justify-content-between">
							<a href="<?php echo base_url('repositorio?categoria='.$categoria->ID_CATEGORIA.'&orden_cat'.$consulta['orden_cat'].'&busqueda'.$consulta['busqueda'].'&busqueda_curso'.$consulta['busqueda_curso'].'&busqueda_recurso'.$consulta['busqueda_recurso']); ?>" class="d-block">
							<p class="h4" title="<?php echo $categoria->CATEGORIA_NOMBRE; ?>"><i class="fa fa-folder"></i> <?php echo character_limiter($categoria->CATEGORIA_NOMBRE,22); ?></p>
							</a>
						</div>
					</div>
					<div class="card-footer">
						<ul class="list-inline">
							  <li class="list-inline-item"><a href="#" data-toggle="modal" class="dropdown-item" data-target="#editar-<?php echo $categoria->ID_CATEGORIA; ?>"><i class="fa fa-pencil"></i>Editar</a></li>
							  <li class="list-inline-item"><a class="dropdown-item" href="<?php echo base_url('admin/repositorio/borrar_carpeta?id='.$categoria->ID_CATEGORIA.'&categoria='.$consulta['categoria'].'&orden_cat='.$consulta['orden_cat'].'&busqueda='.$consulta['busqueda']); ?>"><i class="fa fa-trash"></i> Borrar</a></li>
							</ul>
					</div>
				</div>
				<!-- Formulario -->
				<div class="modal fade" id="editar-<?php echo $categoria->ID_CATEGORIA; ?>" tabindex="-1" role="dialog" aria-labelledby="descargar-<?php echo $categoria->ID_CATEGORIA; ?>" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Editar</h5>
							</div>
							<div class="modal-body">
								<form class="" action="<?php echo base_url('admin/repositorio/actualizar_carpeta'); ?>" method="post" enctype="multipart/form-data">
									<input type="hidden" name="Identificador" value="<?php echo $categoria->ID_CATEGORIA; ?>">
									<input type="hidden" name="Tipo" value="archivo">
									<input type="hidden" name="categoria" value="<?php echo verificar_variable('GET','categoria','0');; ?>">
									<input type="hidden" name="orden_cat" value="<?php echo verificar_variable('GET','orden_cat','');; ?>">
									<input type="hidden" name="busqueda" value="<?php echo verificar_variable('GET','busqueda','');; ?>">
									<input type="hidden" name="ImagenActual" value="<?php echo $categoria->IMAGEN; ?>">
									<div class="form-group">
										<label for="NombreCategoria">Nombre de la carpeta</label>
										<input type="text" class="form-control" name="NombreCategoria" value="<?php echo character_limiter($categoria->CATEGORIA_NOMBRE,22); ?>">
									</div>
									<hr>
									<button type="submit" name="button" class="btn btn-primary">Actualizar</button>
								</form>
							</div>
						</div>
					</div>
				</div>
		</div>

	<?php } ?>
</div>

<div class="row">
	<div class="col-12">
		<h5>Archivos</h5>
	</div>
	<?php foreach($archivos as $archivo){ ?>
	<div class="col-12 col-sm-3 mb-4">
			<div class="card">
				<div class="card-body p-0 text-center">
					<img src="<?php echo base_url('contenido/img/publicaciones/'.$archivo->IMAGEN); ?>" class="img-fluid" alt="">
					<div class="p-3 d-flex justify-content-between">
						<p class="h6"> <?php echo character_limiter($archivo->TITULO,22); ?></p>

						<button class="btn btn-sm btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <i class="fas fa-ellipsis-v"></i>
					  </button>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					    <a class="dropdown-item" href="<?php echo base_url('admin/repositorio/borrar_archivo?id='.$archivo->ID.'&categoria='.verificar_variable('GET','categoria','0').'&orden_cat='.$consulta['orden_cat'].'&busqueda='.$consulta['busqueda']); ?>"><i class="fa fa-trash"></i> Borrar</a>
					  </div>
					</div>
					<hr>
				</div>
			</div>
	</div>
	<?php } ?>
</div>
