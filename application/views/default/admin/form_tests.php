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
		<form action="<?php echo base_url('admin/tests/crear_test') ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="Tipo" value="<?php echo $tipo; ?>">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Crear Test <?php echo $tipo; ?>
						</h3>
					</div>
					<div class="kt-portlet__head-toolbar">
						<div class="btn-group float-right">
							<button type="submit" class="btn btn-primary" name="Guardar" value="Salir"> <i class="fa fa-save"></i> Guardar y continuar</button>
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
												<label for="Titulo">Titulo</label>
												<input type="text" class="form-control" name="Titulo" value="" required>
											</div>
											<div class="form-group">
												<label for="Resumen">Resumen</label>
												<textarea name="Resumen" class="form-control TextEditorSmall" rows="8"></textarea>
											</div>
											<div class="form-group">
												<label for="Instrucciones">Instrucciones</label>
												<textarea name="Instrucciones" class="form-control TextEditorSmall" rows="8"></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="card">
										<div class="card-body">
											<div class="form-group">
												<label for="Estado">Estado <span class="badge badge-pill badge-info" data-toggle="tooltip" data-placement="top" title="Si unexámen no está activo no se podrá acceder a el"> <i class="fa fa-question-circle"></i> </span> </label>
												<select class="form-control" name="Estado">
													<option value="activo">Activo</option>
													<option value="inactivo">Inactivo</option>
												</select>
											</div>
											<div class="form-group">
												<label for="Idioma">Idioma <span class="badge badge-pill badge-info" data-toggle="tooltip" data-placement="top" title="Se usará para cargar el idioma de la interfáz"> <i class="fa fa-question-circle"></i> </span> </label>
												<select class="form-control" name="Idioma">
													<option value="es">Español</option>
													<option value="en">Ingles</option>
													<option value="fr">Frances</option>
												</select>
											</div>
											<div class="form-group">
												<label for="Listenning">Sección de Listening <span class="badge badge-pill badge-info" data-toggle="tooltip" data-placement="top" title="Activa o desactiva el área de Listening del exámen"> <i class="fa fa-question-circle"></i> </span> </label>
												<select class="form-control" name="Listenning">
													<option value="no">No</option>
													<option value="si">Si</option>
												</select>
											</div>
											<div class="form-group">
												<label for="Tiempo">Tiempo límite (min.)</label>
												<div class="input-group mb-3">
												  <input type="number" name="Tiempo" step="1" class="form-control" value="120">
												  <div class="input-group-append">
												    <span class="input-group-text">min</span>
												  </div>
												</div>
											</div>
											<hr>
												<div class="form-group">
													<label for="Imagen">Imágen</label>
													<input type="file" class="form-control" name="Imagen" value="" accept="image/*">
												</div>
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
						<button type="submit" class="btn btn-primary" name="Guardar" value="Salir"> <i class="fa fa-save"></i> Guardar y continuar</button>
					</div>
				</div>
			</div>
		</form>
		<!--end::Portlet-->
	</div>

	<!-- end:: Content -->
