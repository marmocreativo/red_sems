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
				<a href="<?php echo base_url('admin/opciones'); ?>" class="kt-subheader__breadcrumbs-link">
					Opciones </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>




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
		<form action="<?php echo base_url('admin/crear_opcion') ?>" method="post" enctype="multipart/form-data">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Crear Opción
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
												<label for="OpcionNombre">Nombre</label>
												<input type="text" class="form-control" name="OpcionNombre" value="" required>
												 <small class="form-text text-warning">Debe estar escrito solo en minúsculas sin espacios</small>
											</div>
											<div class="form-group">
												<label for="OpcionValor">Valor</label>
												<textarea class="form-control" name="OpcionValor" rows="8" required></textarea>
											</div>
											<div class="form-group">
												<label for="OpcionInput">Input</label>
												<select class="form-control" name="OpcionInput">
													<option value="varchar">Campo de texto</option>
													<option value="text">Área de texto</option>
													<option value="editor">Editor de texto</option>
													<option value="boolean">Interruptor</option>
												</select>
											</div>
											<div class="form-group">
												<label for="OpcionTipo">Tipos: <b><?php $i=0; foreach($grupos_opciones as $grupo){ echo $grupo->OPCION_TIPO.' | '; }?></b></label>
												<input type="text" class="form-control" name="OpcionTipo" value="" required>
												<small class="form-text text-warning">Debe estar escrito solo en minúsculas sin espacios</small>
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
