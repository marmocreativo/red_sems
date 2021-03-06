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
					Tipos | <?php echo $tipo; ?> </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<?php $padre = verificar_variable('GET','padre',0); if(!empty($padre)){ ?>
					<a href="<?php echo base_url('admin/tipos?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
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
		<form action="<?php echo base_url('admin/cupones/crear') ?>" method="post" enctype="multipart/form-data">
			<div class="kt-portlet col-6">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Crear Cupón
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
								<div class="col-8">
									<div class="form-group">
										<label for="CuponCodigo">Código Cupón</label>
										<input type="text" class="form-control" name="CuponCodigo" value="" required>
									</div>
									<div class="row">
										<div class="col">
											<div class="form-group">
												<label for="CuponDescuento">Descuento Cupón</label>
												<input type="number" class="form-control" name="CuponDescuento" value="" required>
											</div>
										</div>
										<div class="col-3">
											<div class="form-group">
												<label for="CuponFuncion">Tipo</label>
												<select class="form-control" name="CuponFuncion">
													<option value="porcentaje">%</option>
													<option value="importe">$ </option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<div class="form-group">
												<label for="FechaPublicacion">Fecha Publicación</label>
												<input type="text" class="form-control datepicker" name="FechaPublicacion" value="">
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label for="FechaVigencia">Fecha Vigencia</label>
												<input type="text" class="form-control datepicker" name="FechaVigencia" value="">
											</div>
										</div>
									</div>
								</div>
								<div class="col-4">
									<div class="form-group">
										<label for="Estado">Estado</label>
										<select class="form-control" name="Estado">
											<option value="activo">Activo</option>
											<option value="inactivo">Inactivo</option>
										</select>
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
