<?php $lista_usuarios = $this->GeneralModel->lista('usuarios','',['ESTADO'=>'activo'],'USUARIO_NOMBRE ASC','',''); ?>
<div class="row mb-4">
	<div class="col-12">
		<h5>Carpetas</h5>
	</div>
	<?php foreach($categorias as $categoria){ ?>
		<div class="col-12 col-sm-4 col-md-3 mb-3">
				<div class="card single-promo-card single-promo-hover text-center shadow-sm">
					<div class="card single-promo-card single-promo-hover text-center shadow-sm">
						<div class="card-body d-flex justify-content-between">
							<a href="<?php echo base_url('admin/repositorio?categoria='.$categoria->ID_CATEGORIA.'&orden_cat'.$consulta['orden_cat'].'&busqueda'.$consulta['busqueda'].'&busqueda_curso'.$consulta['busqueda_curso'].'&busqueda_recurso'.$consulta['busqueda_recurso']); ?>" class="d-block">
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
					<?php
						$url_imagen = base_url('contenido/img/publicaciones/'.$archivo->IMAGEN);
						if($archivo->TIPO_RECURSO=='Video'){
							$url_imagen = $archivo->IMAGEN;
						}
					 ?>
					<img src="<?php echo $url_imagen; ?>" class="img-fluid" alt="">
					<div class="p-3 d-flex justify-content-between">
						<p class="h6"> <?php echo character_limiter($archivo->TITULO,22); ?></p>

						<button class="btn btn-sm btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <i class="fas fa-ellipsis-v"></i>
					  </button>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					    <a class="dropdown-item" href=""><i class="fa fa-trash"></i> Borrar</a>
					  </div>
					</div>
				</div>
				<div class="card-footer">
					<ul class="list-inline">
							<li class="list-inline-item"><a href="#"  data-toggle="modal" class="dropdown-item" data-target="#editar-archivo-<?php echo $archivo->ID; ?>"><i class="fa fa-pencil"></i>Editar</a></li>
							<li class="list-inline-item"><a class="dropdown-item" href="<?php echo base_url('admin/repositorio/borrar_archivo?id='.$archivo->ID.'&categoria='.verificar_variable('GET','categoria','0').'&orden_cat='.$consulta['orden_cat'].'&busqueda='.$consulta['busqueda']); ?>"><i class="fa fa-trash"></i> Borrar</a></li>
						</ul>
				</div>
			</div>
			<!-- Formulario -->
			<div class="modal fade" id="editar-archivo-<?php echo $archivo->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="editar-archivo-<?php echo $archivo->ID; ?>" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Editar</h5>
						</div>
						<div class="modal-body">
							<form class="" action="<?php echo base_url('admin/repositorio/actualizar_archivo'); ?>" method="post" enctype="multipart/form-data">
								<input type="hidden" name="categoria" value="<?php echo $consulta['categoria']; ?>">
								<input type="hidden" name="orden_cat" value="<?php echo $consulta['orden_cat']; ?>">
								<input type="hidden" name="busqueda" value="<?php echo $consulta['busqueda']; ?>">
								<input type="hidden" name="Identificador" value="<?php echo $archivo->ID; ?>">
								<input type="hidden" name="ArchivoActual" value="<?php echo $archivo->ARCHIVO; ?>">
								<input type="hidden" name="ImagenActual" value="<?php echo $archivo->IMAGEN; ?>">
								<div class="row">
									<div class="col-4">
										<h4>Generales</h4>
										<div class="form-group">
											<label for="file">Archivo</label>
											<input type="file" class="form-control" name="file" value="">
										</div>
										<img src="<?php echo base_url('contenido/img/publicaciones/'.$archivo->IMAGEN) ?>" class="img-fluid" alt="">
										<div class="form-group">
											<label for="Imagen">Imágen miniatura</label>
											<input type="file" class="form-control" name="Imagen" value="">
										</div>
										<div class="form-group">
											<label for="Titulo">Titulo (Nombre amigable)</label>
											<input type="text" class="form-control" name="Titulo" value="<?php echo $archivo->TITULO; ?>" required>
										</div>
										<div class="form-group">
											<label for="Cadido">CADIDO</label>
											<input type="text" class="form-control" name="Cadido" value="<?php echo $archivo->CADIDO; ?>" required>
										</div>
										<div class="form-group">
											<label for="Nomenclatura">Nomenclatura (Sin espacios ni caracteres especiales)</label>
											<input type="text" class="form-control" name="Nomenclatura" value="<?php echo $archivo->NOMENCLATURA; ?>" required>
										</div>
										<div class="form-group">
											<label for="Descripcion">Descripción</label>
											<textarea class="form-control" name="Descripcion" rows="5"><?php echo $archivo->DESCRIPCION; ?></textarea>
										</div>
									</div>
									<div class="col-4">
										<h4>Dublin Core</h4>
										<div class="form-group">
											<label for="Tema">Tema (Palabras clave)</label>
											<textarea class="form-control" name="Tema" rows="5"><?php echo $archivo->TEMA; ?></textarea>
										</div>
										<div class="form-group">
											<label for="TipoRecurso">Tipo de recurso</label>
											<select class="form-control" name="TipoRecurso">
												<option value="">Selecciona</option>
												<option value="Pdf" <?php if($archivo->TIPO_RECURSO=='Pdf'){ echo 'selected'; }  ?>>PDF</option>
												<option value="Epub" <?php if($archivo->TIPO_RECURSO=='Epub'){ echo 'selected'; } ?>>Epub</option>
												<option value="Imagen" <?php if($archivo->TIPO_RECURSO=='Imagen'){ echo 'selected'; } ?>>Imágen</option>
												<option value="Infografía" <?php if($archivo->TIPO_RECURSO=='Infografía'){ echo 'selected'; } ?>>Infografía</option>
												<option value="Video" <?php if($archivo->TIPO_RECURSO=='Video'){ echo 'selected'; } ?>>Video</option>
												<option value="Audio" <?php if($archivo->TIPO_RECURSO=='Audio'){ echo 'selected'; } ?>>Audio</option>
											</select>
										</div>

										<div class="form-group">
											<label for="Cobertura">Cobertura</label>
											<input type="text" class="form-control" name="Cobertura" value="<?php echo $archivo->COBERTURA; ?>">
										</div>
										<div class="form-group">
											<label for="Derechos">Derechos</label>
											<textarea class="form-control" name="Derechos" rows="5"><?php echo $archivo->DERECHOS; ?></textarea>
										</div>
									</div>
									<div class="col-4">
										<h4>Prepa en Línea</h4>
										<div class="form-group">
											<label for="TituloCurso">Título del Curso</label>
											<select  class="form-control" name="TituloCurso" >
												<option value="0">Selecciona curso</option>
												<?php
													$cursos = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'cursos'],'TIPO_NOMBRE ASC','','');
													$seleccionado = '';
													foreach($cursos as $curso){
														if($archivo->TITULO_CURSO==$curso->ID){ $seleccionado = 'selected'; }
														echo '<option value="'.$curso->ID.'" '.$seleccionado.' >'.$curso->TIPO_NOMBRE.'</option>';
														$seleccionado = '';
												} ?>
											</select>
										</div>
										<div class="form-group">
											<label for="PropositoDidactico">Propósito didáctico</label>
											<input type="text" class="form-control" name="PropositoDidactico" value="<?php echo $archivo->PROPOSITO_DIDACTICO; ?>">
										</div>
										<div class="form-group">
											<label for="UrlEditable">URL del archivo Editable</label>
											<input type="text" class="form-control" name="UrlEditable" value="<?php echo $archivo->ARCHIVO_EDITABLE; ?>">
										</div>
									</div>
								</div>
								<hr>
								<button type="submit" class="btn btn-success" name="button" id="boton_subir_archivo_pesado">Actualizar</button>
							</form>
						</div>
					</div>
				</div>
			</div>
	</div>
	<?php } ?>
</div>
