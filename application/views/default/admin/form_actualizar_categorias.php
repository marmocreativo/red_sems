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
					Categorias | <?php echo $tipo; ?> </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<?php $padre = verificar_variable('GET','padre',0); if(!empty($padre)){ ?>
					<a href="<?php echo base_url('admin/categorias?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
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
		<form action="<?php echo base_url('admin/categorias/actualizar') ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="consulta" value="<?php echo verificar_variable('GET','consulta',''); ?>">
			<input type="hidden" name="Identificador" value="<?php echo $categoria['ID_CATEGORIA'] ?>">
			<input type="hidden" name="Tipo" value="<?php echo $tipo; ?>">
			<input type="hidden" name="CategoriaPadre" value="<?php echo $categoria['CATEGORIA_PADRE'] ?>">
			<input type="hidden" name="CategoriaNivel" value="<?php echo $categoria['CATEGORIA_NIVEL'] ?>">
			<input type="hidden" name="ImagenActual" value="<?php echo $categoria['IMAGEN'] ?>">
			<input type="hidden" name="Orden" value="<?php echo $categoria['ORDEN'] ?>">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Actualizar Categoría <?php echo $tipo; ?>
						</h3>
					</div>
					<div class="kt-portlet__head-toolbar">
						<div class="btn-group float-right">
							<button type="submit" class="btn btn-success" name="Guardar" value="Continuar"> <i class="fa fa-save"></i> Solo Guardar</button>
							<button type="submit" class="btn btn-primary" name="Guardar" value="Salir"> <i class="fa fa-save"></i> Guardar y salir</button>
						</div>
					</div>
				</div>
				<div class="kt-portlet__body">
					<!--begin::Section-->
					<div class="kt-section">
						<div class="kt-section__content">
							<div class="row">
								<div class="col-12 col-md-8">
									<div class="card">
										<div class="card-body">
											<div class="form-group">
												<label for="CategoriaNombre">Nombre</label>
												<input type="text" class="form-control UrlAmigableOrigen" name="CategoriaNombre"
													data-tabla="categorias"
													data-objeto="categoria"
													data-id="<?php echo $categoria['ID_CATEGORIA'] ?>"
													value="<?php echo $categoria['CATEGORIA_NOMBRE'] ?>" required>
											</div>
											<div class="form-group">
												<label for="Url">URL Amigable <small class="text-warning">Auto completado por el sistema</small> </label>
												<input type="text" class="form-control UrlAmigableResultado" name="Url" value="<?php echo $categoria['URL'] ?>" required>
											</div>
											<div class="form-group">
												<label for="CategoriaDescripcion">Descripción</label>
												<textarea name="CategoriaDescripcion" class="form-control" rows="8"><?php echo $categoria['CATEGORIA_DESCRIPCION'] ?></textarea>
											</div>
										</div>
									</div>
									<div class="card mt-3">
										<div class="card-body">
											<h6> <i class="fa fa-cogs"></i> Extra Datos</h6>

											<!--
											<div class="form-group">
												<label for="Extra[color]">Color</label>
												<input type="text" class="form-control ColorPicker" autocomplete="no" name="Extra[color]" value="<?php if(isset($extra_datos['color'])){ echo $extra_datos['color']; } ?>">
											</div>
											<div class="form-group">
												<label for="Extra[icono]">Icono</label>
												<input type="text" class="form-control IconPicker" autocomplete="no" name="Extra[icono]" value="<?php if(isset($extra_datos['icono'])){ echo $extra_datos['icono']; } ?>">
											</div>
											-->
											<div class="form-group">
												<label for="Extra[ordenar_por]">Ordenar Por</label>
												<select class="form-control" name="Extra[ordenar_por]">
													<option value="PUBLICACION_TITULO ASC" <?php if(isset($extra_datos['ordenar_por'])&&$extra_datos['ordenar_por']=='PUBLICACION_TITULO ASC'){ echo 'selected'; } ?> >Alfabético A-Z</option>
													<option value="PUBLICACION_TITULO DESC" <?php if(isset($extra_datos['ordenar_por'])&&$extra_datos['ordenar_por']=='PUBLICACION_TITULO DESC'){ echo 'selected'; } ?> >Alfabético Z-A</option>
													<option value="FECHA_PUBLICACION DESC" <?php if(isset($extra_datos['ordenar_por'])&&$extra_datos['ordenar_por']=='FECHA_PUBLICACION DESC'){ echo 'selected'; } ?> >Fecha de Publicación (Más nuevos primero)</option>
													<option value="FECHA_PUBLICACION ASC" <?php if(isset($extra_datos['ordenar_por'])&&$extra_datos['ordenar_por']=='FECHA_PUBLICACION ASC'){ echo 'selected'; } ?> >Fecha de Publicación (Más antiguos primero)</option>
													<option value="ORDEN ASC" <?php if(isset($extra_datos['ordenar_por'])&&$extra_datos['ordenar_por']=='ORDEN ASC'){ echo 'selected'; } ?> >Orden Personalizado</option>
												</select>
											</div>
											<div class="form-group">
												<label for="Extra[columnas]">Columnas por fila</label>
												<select class="form-control" name="Extra[columnas]">
													<option value="col-sm-6" <?php if(isset($extra_datos['columnas'])&&$extra_datos['columnas']=='col-sm-6'){ echo 'selected'; } ?>>2</option>
													<option value="col-sm-4" <?php if(isset($extra_datos['columnas'])&&$extra_datos['columnas']=='col-sm-4'){ echo 'selected'; } ?>>3</option>
													<option value="col-sm-3" <?php if(isset($extra_datos['columnas'])&&$extra_datos['columnas']=='col-sm-3'){ echo 'selected'; } ?>>4</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="card">
										<div class="card-body">
											<div class="form-group">
												<label for="Estado">Estado</label>
												<select class="form-control" name="Estado">
													<option value="activo" <?php if($categoria['ESTADO']=='activo'){ echo 'selected'; } ?>>Activo</option>
													<option value="inactivo" <?php if($categoria['ESTADO']=='inactivo'){ echo 'selected'; } ?>>Inactivo</option>
												</select>
											</div><div class="form-group">
												<label for="Visible">Visibilidad</label>
												<select class="form-control" name="Visible">
													<option value="visible" <?php if($categoria['VISIBLE']=='visible'){ echo 'selected'; } ?>>Visible</option>
													<option value="invisible" <?php if($categoria['VISIBLE']=='invisible'){ echo 'selected'; } ?>>Invisible</option>
												</select>
											</div>
											<hr>
												<img src="<?php echo base_url('contenido/img/categorias/'.$categoria['IMAGEN']); ?>" alt="" class="img-fluid mx-auto mb-2">
												<div class="form-group">
													<label for="Imagen">Imágen</label>
													<input type="file" class="form-control" name="Imagen" value="" accept="image/*">
												</div>
											<hr>
											<img src="<?php echo base_url('contenido/img/categorias/'.$publicacion['IMAGEN_FONDO']); ?>" alt="" class="img-fluid mx-auto mb-2">
											<div class="form-group">
												<label for="ImagenFondo">Imágen Fondo <small class="text-danger"> Peso Máximo (<?php echo ini_get('upload_max_filesize'); ?>)</small></label>
												<input type="file" class="form-control" name="ImagenFondo" value="" accept="image/*">
											</div>
											<hr>
											<h6>Categoria Padre</h6>
											<?php
												$id_categorias_seleccionadas = array();
													$id_categorias_seleccionadas[] = $categoria['CATEGORIA_PADRE'];
												multinivel($tipo,'radio',$id_categorias_seleccionadas,0);
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
						<button type="submit" class="btn btn-success" name="Guardar" value="Continuar"> <i class="fa fa-save"></i> Solo Guardar</button>
						<button type="submit" class="btn btn-primary" name="Guardar" value="Salir"> <i class="fa fa-save"></i> Guardar y salir</button>
					</div>
				</div>
			</div>
		</form>
		<!--end::Portlet-->
	</div>

	<!-- end:: Content -->
