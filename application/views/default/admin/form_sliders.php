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
				<a href="<?php echo base_url('admin/sliders?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
					Sliders | <?php echo $tipo; ?> </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<?php $padre = verificar_variable('GET','padre',0); if(!empty($padre)){ ?>
					<a href="<?php echo base_url('admin/sliders?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
						<?php $categoria_padre = $this->GeneralModel->detalles('sliders',['ID_SLIDER'=>$padre]); ?>
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
		<form action="<?php echo base_url('admin/sliders/crear') ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="Tipo" value="<?php echo $tipo; ?>">
			<input type="hidden" name="Ancho" value="720">
			<input type="hidden" name="Alto" value="650">
			<input type="hidden" name="Extension" value=".jpg">
			<input type="hidden" name="TipoImagen" value="image/jpeg">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Crear Slider <?php echo $tipo; ?>
						</h3>
					</div>
					<div class="kt-portlet__head-toolbar">
							<button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Guardar</button>
					</div>
				</div>
				<div class="kt-portlet__body">
					<!--begin::Section-->
					<div class="kt-section">
						<div class="kt-section__content">
							<div class="row">
								<div class="col-12 col-md-9">
									<div class="card">
										<div class="card-body">
											<div class="form-group">
												<label for="SliderTitulo">Título</label>
												<input type="text" class="form-control" name="SliderTitulo" required>
											</div>
											<div class="form-group">
												<label for="SliderSubtitulo">Subtítulo</label>
												<input type="text" class="form-control" name="SliderSubtitulo" >
											</div>
											<div class="form-group">
												<label for="SliderTextoEnlace">Grupo</label>
												<select class="form-control" name="SliderTextoEnlace">
													<option value="netkey">Netkey</option>
													<option value="gettoknow">Get to know Panduit</option>
												</select>
											</div>
											<div class="form-group">
												<label for="SliderEnlace">Enlace</label>
												<input type="text" class="form-control" name="SliderEnlace" value="#" >
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-3">
									<div class="card">
										<div class="card-body">
											<div class="form-group">
												<label for="Estado">Estado</label>
												<select class="form-control" name="Estado">
													<option value="activo">Activo</option>
													<option value="inactivo">Inactivo</option>
												</select>
											</div>
											<hr>
											<img src="<?php echo base_url('contenido/img/publicaciones/default.jpg'); ?>" alt="" class="img-fluid mx-auto mb-2">
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
					<button type="submit" class="btn btn-success float-right"> <i class="fa fa-save"></i> Guardar</button>
				</div>
			</div>
		</form>
		<!--end::Portlet-->
	</div>

	<!-- end:: Content -->
