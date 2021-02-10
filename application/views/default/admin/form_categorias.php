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
		<form action="<?php echo base_url('admin/categorias/crear') ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="Tipo" value="<?php echo $tipo; ?>">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Crear Categoría <?php echo $tipo; ?>
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
													data-id=""
													value="" required>
											</div>
											<div class="form-group">
												<label for="Url">URL Amigable <small class="text-warning">Auto completado por el sistema</small> </label>
												<input type="text" class="form-control UrlAmigableResultado" name="Url" value="" required>
											</div>
											<div class="form-group">
												<label for="CategoriaDescripcion">Descripción</label>
												<textarea name="CategoriaDescripcion" class="form-control TextEditor" rows="8"></textarea>
											</div>
										</div>
									</div>
									<div class="card mt-3">
										<div class="card-body">
											<h6> <i class="fa fa-cogs"></i> Extra Datos</h6>
											<!--
											<div class="form-group">
												<label for="Extra[color]">Color</label>
												<input type="text" class="form-control ColorPicker" name="Extra[color]" autocomplete="no">
											</div>
											<div class="form-group">
												<label for="Extra[icono]">Icono</label>
												<input type="text" class="form-control IconPicker" name="Extra[icono]" autocomplete="no">
											</div>
											-->
											<div class="form-group">
												<label for="Extra[OrdenarPor]">Ordenar Por</label>
												<select class="form-control" name="Extra[OrdenarPor]">
													<option value="PUBLICACION_TITULO ASC">Alfabético A-Z</option>
													<option value="PUBLICACION_TITULO DESC">Alfabético Z-A</option>
													<option value="FECHA_PUBLICACION DESC">Fecha de Publicación (Más nuevos primero)</option>
													<option value="FECHA_PUBLICACION ASC">Fecha de Publicación (Más antiguos primero)</option>
													<option value="ORDEN ASC">Orden Personalizado</option>
												</select>
											</div>
											<div class="form-group">
												<label for="Extra[Columnas]">Columnas por fila</label>
												<select class="form-control" name="Extra[Columnas]">
													<option value="col-sm-6">2</option>
													<option value="col-sm-4">3</option>
													<option value="col-sm-3" selected>4</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="card">
										<div class="card-body">
											<div class="form-group">
												<label for="Estado">Estado <span class="badge badge-pill badge-info" data-toggle="tooltip" data-placement="top" title="Si una categoría no está Activa no será visible para los usuarios bajo ninguna circunstancia"> <i class="fa fa-question-circle"></i> </span> </label>
												<select class="form-control" name="Estado">
													<option value="activo">Activo</option>
													<option value="inactivo">Inactivo</option>
												</select>
											</div>
											<div class="form-group">
												<label for="Visible">Visibilidad <span class="badge badge-pill badge-info" data-toggle="tooltip" data-placement="top" title="Las categorías Invisibles no se mostrarán en el mapa de categorías global pero se pueden utilizar para otras funciones del sistema como las listas dinámicas"> <i class="fa fa-question-circle"></i> </span></label>
												<select class="form-control" name="Visible">
													<option value="visible">Visible</option>
													<option value="invisible">Invisible</option>
												</select>
											</div>
											<hr>
												<img src="<?php echo base_url('contenido/img/categorias/default.jpg'); ?>" alt="" class="img-fluid mx-auto mb-2">
												<div class="form-group">
													<label for="Imagen">Imágen</label>
													<input type="file" class="form-control" name="Imagen" value="" accept="image/*">
												</div>
												<hr>
												<h6>Categoria Padre</h6>
												<?php
													$id_categorias_seleccionadas = array();
														$id_categorias_seleccionadas[] = $padre;
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
