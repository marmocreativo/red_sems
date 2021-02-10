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
		<form action="<?php echo base_url('admin/tipos/actualizar') ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="Identificador" value="<?php echo $tipos['ID']; ?>">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Actualizar Tipo <?php echo $tipo; ?>
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
												<label for="TipoNombre">Nombre en sistema</label>
												<input type="text" class="form-control" name="TipoNombre" value="<?php echo $tipos['TIPO_NOMBRE']; ?>" required>
												 <small class="form-text text-warning">Debe estar escrito solo en minúsculas sin espacios</small>
											</div>
											<div class="form-group">
												<label for="TipoNombreSingular">Nombre en Singular</label>
												<input type="text" class="form-control" name="TipoNombreSingular" value="<?php echo $tipos['TIPO_NOMBRE_SINGULAR']; ?>" required>
											</div>
											<div class="form-group">
												<label for="TipoNombrePlural">Nombre en Plural</label>
												<input type="text" class="form-control" name="TipoNombrePlural" value="<?php echo $tipos['TIPO_NOMBRE_PLURAL']; ?>" required>
											</div>
											<div class="form-group">
												<label for="TipoObjeto">Tipo</label>
												<input type="text" class="form-control" name="TipoObjeto" value="<?php echo $tipos['TIPO_OBJETO']; ?>" required>
												<small class="form-text text-warning">No modificar el valor por defecto, a menos que se desee crear un nuevo grupo de tipos</small>
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
