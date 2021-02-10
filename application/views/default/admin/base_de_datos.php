<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Escritorio </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="<?php echo base_url('admin'); ?>" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Inicio </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>


				<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
			</div>
		</div>
		<div class="kt-subheader__toolbar">
			<div class="kt-subheader__wrapper">

			</div>
		</div>
	</div>

	<!-- end:: Subheader -->

	<!-- begin:: Content -->
	<div class="kt-content" id="kt_content">
		<?php retro_alimentacion(); ?>
		<div class="row">
			<div class="col-12 col-sm-4">
				<div class="kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
					<div class="kt-portlet__head kt-portlet__head--noborder">
						<div class="kt-portlet__head-label">
						   <h3 class="kt-portlet__head-title">
				           Respaldar Base de datos
				       </h3>
						</div>
						<div class="kt-portlet__head-toolbar">

						</div>
					</div>
					<div class="kt-portlet__body">
						<p>Crea un respaldo completo de la base de datos listo para descargar</p>
						<a class="btn btn-success" href="<?php echo base_url('admin/base_de_datos/respaldar'); ?>"> <i class="fa fa-download"></i> Descargar respaldo</a>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-4">
				<div class="kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
					<div class="kt-portlet__head kt-portlet__head--noborder">
						<div class="kt-portlet__head-label">
						   <h3 class="kt-portlet__head-title">
				           Restaurar Base de datos
				       </h3>
						</div>
						<div class="kt-portlet__head-toolbar">

						</div>
					</div>
					<div class="kt-portlet__body">
						<form class="" action="<?php echo base_url('admin/base_de_datos/restaurar'); ?>" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="zip_file">Seleccionar Respaldo</label>
								<input type="file" name="zip_file" class="form-control" accept="application/x-zip-compressed">
							</div>
							<button type="submit" class="btn btn-warning" name="button"><i class="fa fa-upload"></i> Subir Respaldo</button>
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- end:: Content -->
