<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				<?php echo $op['titulo_sitio'] ?> </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="<?php echo base_url('admin'); ?>" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="<?php echo base_url('admin'); ?>" class="kt-subheader__breadcrumbs-link">
					Administrador </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="<?php echo base_url('admin/categorias?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
					Publicaciones | <?php echo $tipo; ?> </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<?php $padre = verificar_variable('GET','padre',0); if(!empty($padre)){ ?>
					<a href="<?php echo base_url('admin/publicaciones?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
						<?php $categoria_padre = $this->GeneralModel->detalles('categorias',['ID_CATEGORIA'=>$padre]); ?>
						<?php echo $categoria_padre['CATEGORIA_NOMBRE']; ?> </a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
				<?php } ?>




				<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
			</div>
		</div>
		<div class="kt-subheader__toolbar">
			<div class="btn-group btn-group" role="group" aria-label="Barra de tareas">
      </div>
		</div>
	</div>

	<!-- end:: Subheader -->

	<!-- begin:: Content -->
	<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
		<?php retro_alimentacion(); ?>
		<!--begin::Portlet-->
		<form action="<?php echo base_url('admin/publicaciones/actualizar') ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="consulta" value="<?php echo verificar_variable('GET','consulta',''); ?>">
			<input type="hidden" name="Identificador" value="<?php echo $publicacion['ID_PUBLICACION']; ?>">
			<input type="hidden" name="Tipo" value="<?php echo $publicacion['TIPO']; ?>">
			<input type="hidden" name="Orden" value="<?php echo $publicacion['ORDEN']; ?>">
			<input type="hidden" name="PublicacionPrecio" value="<?php echo $publicacion['PUBLICACION_PRECIO']; ?>">
			<input type="hidden" name="ImagenActual" value="<?php echo $publicacion['IMAGEN']; ?>">
			<input type="hidden" name="ImagenFondoActual" value="<?php echo $publicacion['IMAGEN_FONDO']; ?>">
			<input type="hidden" name="AnchoImagen" value="<?php echo $op['ancho_imagenes_publicaciones'] ?>">
			<input type="hidden" name="AltoImagen" value="<?php echo $op['alto_imagenes_publicaciones'] ?>">
			<input type="hidden" name="AnchoImagenFondo" value="<?php echo $op['ancho_imagenes_fondo_publicaciones'] ?>">
			<input type="hidden" name="AltoImagenFondo" value="<?php echo $op['alto_imagenes_fondo_publicaciones'] ?>">
			<input type="hidden" name="Extra[meta_autor]" value="<?php if(isset($extra_datos['meta_autor'])){ echo $extra_datos['meta_autor']; } ?>">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
					</div>
					<div class="kt-portlet__head-toolbar">
						<div class="btn-group float-right">
							<button type="submit" class="btn btn-info" name="Guardar" value="relaciones"> <i class="fas fa-exchange-alt"></i> Relaciones</button>
							<?php $tipos_multimedia= $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'multimedia'],'','',''); ?>
							<?php $i = 0; foreach($tipos_multimedia as $tipo_multimedia){ if($i%2){ $color_boton = 'btn-outline-dark';}else{ $color_boton = 'btn-outline-secondary'; } ?>
								<button type="submit" class="btn <?php echo $color_boton; ?>" name="Guardar" value="<?php echo $tipo_multimedia->TIPO_NOMBRE; ?>"> <i class="fas fa-photo-video"></i> <?php echo $tipo_multimedia->TIPO_NOMBRE_PLURAL; ?></button>
							<?php $i++; } ?>
							<button type="submit" class="btn btn-success" name="Guardar" value="continuar"> <i class="fa fa-save"></i> Solo Guardar</button>
							<button type="submit" class="btn btn-primary" name="Guardar" value="salir"> <i class="fa fa-save"></i> Guardar y salir</button>
						</div>
					</div>
				</div>
				<div class="kt-portlet__body">
					<!--begin::Section-->
					<div class="kt-section">
						<div class="kt-section__content">
							<div class="row">
								<div class="col-12 col-md-10">
									<div class="card">
										<div class="card-body">
											<div class="form-group">
												<label for="PublicacionTitulo">Título</label>
												<input type="text" class="form-control UrlAmigableOrigen" name="PublicacionTitulo"
													data-tabla="publicaciones"
													data-objeto="publicacion"
													data-id="<?php echo $publicacion['ID_PUBLICACION'] ?>"
													value="<?php echo $publicacion['PUBLICACION_TITULO'] ?>" required>
											</div>
											<div class="form-group">
												<label for="Url">URL Amigable <small class="text-warning">Auto completado por el sistema</small> </label>
												<input type="text" class="form-control UrlAmigableResultado" name="Url" value="<?php echo $publicacion['URL'] ?>" required>
											</div>
											<div class="form-group">
												<label for="PublicacionResumen">Resumen</label>
												<textarea name="PublicacionResumen" class="form-control" rows="8"><?php echo $publicacion['PUBLICACION_RESUMEN'] ?></textarea>
											</div>
											<div class="form-group">
												<label for="PublicacionContenido">Contenido</label>
												<textarea name="PublicacionContenido" class="form-control TextEditor" rows="8"><?php echo $publicacion['PUBLICACION_CONTENIDO'] ?></textarea>
											</div>
											<div class="form-group">
												<label for="PublicacionKeywords">Keywords <small>Para busquedas</small></label>
												<textarea name="PublicacionKeywords" class="form-control" rows="8"><?php echo $publicacion['PUBLICACION_KEYWORDS'] ?></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-2">
									<div class="card">
										<div class="card-body">
											<div class="form-group">
												<label for="Estado">Estado</label>
												<select class="form-control" name="Estado">
													<option value="activo" <?php if($publicacion['ESTADO']=='activo'){ echo 'selected'; } ?>>Activo</option>
													<option value="inactivo" <?php if($publicacion['ESTADO']=='inactivo'){ echo 'selected'; } ?>>Inactivo</option>
												</select>
											</div>
											<div class="form-group">
												<label for="FechaPublicacion">Publicar el</label>
												<input type="text" class="form-control datepicker" name="FechaPublicacion" value="<?php echo date('d-m-Y',strtotime($publicacion['FECHA_PUBLICACION'])) ?>">
											</div>
											<input type="hidden" name="FechaRegistro" value="<?php echo date('d-m-Y',strtotime($publicacion['FECHA_REGISTRO'])) ?>">
											<hr>
											<img src="<?php echo base_url('contenido/img/publicaciones/'.$publicacion['IMAGEN']); ?>" alt="" class="img-fluid mx-auto mb-2">
											<div class="form-group">
												<label for="Imagen">Imágen <small class="text-danger"> Peso Máximo (<?php echo ini_get('upload_max_filesize'); ?>)</small></label>
												<input type="file" class="form-control" name="Imagen" value="" accept="image/*">
											</div>
											<hr>
											<img src="<?php echo base_url('contenido/img/publicaciones/'.$publicacion['IMAGEN_FONDO']); ?>" alt="" class="img-fluid mx-auto mb-2">
											<div class="form-group">
												<label for="ImagenFondo">Imágen Fondo <small class="text-danger"> Peso Máximo (<?php echo ini_get('upload_max_filesize'); ?>)</small></label>
												<input type="file" class="form-control" name="ImagenFondo" value="" accept="image/*">
											</div>
											<hr>
											<h6>Categorías</h6>
											<?php
											$categorias_seleccionadas = $this->GeneralModel->lista('categorias_objetos','',['TIPO'=>$tipo,'ID_OBJETO'=>$publicacion['ID_PUBLICACION']],'','','');
												$id_categorias_seleccionadas = array();
												foreach($categorias_seleccionadas as $categoria){
													$id_categorias_seleccionadas[] = $categoria->ID_CATEGORIA;
												}
												multinivel($tipo,'checkbox',$id_categorias_seleccionadas,0);
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end::Section-->
				</div>
				<!--end::Form-->
				<div class="kt-portlet__foot">
					<div class="btn-group float-right">
						<button type="submit" class="btn btn-success" name="Guardar" value="continuar"> <i class="fa fa-save"></i> Solo Guardar</button>
						<button type="submit" class="btn btn-primary" name="Guardar" value="salir"> <i class="fa fa-save"></i> Guardar y salir</button>
					</div>
				</div>
			</div>
		</form>
		<!--end::Portlet-->
	</div>

	<!-- end:: Content -->
