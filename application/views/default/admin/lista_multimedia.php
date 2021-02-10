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
			<div class="kt-portlet">
				<div class="kt-portlet__body">
					<!--begin::Section-->
					<div class="kt-section">
						<div class="kt-section__content">
							<div class="row">
								<div class="col-12 col-sm-4">
									<div class="card border-info">
										<div class="card-body" >
											<?php if($tipo=='imagen'){ ?> <div class="dropzone" id="Dropzone_multimedia" data-id='' data-tipo='<?php echo $tipo; ?>'></div> <?php } ?>
											<?php if($tipo=='documento'){ ?> <div class="dropzone" id="Dropzone_multimedia" data-id='' data-tipo='<?php echo $tipo; ?>'></div> <?php } ?>
											<?php if($tipo=='enlace'){ ?>
												<form class="" action="<?php echo base_url('admin/multimedia/cargar_'.$tipo); ?>" method="post">
													<input type="hidden" name="id" value="<?php echo verificar_variable('GET','id',''); ?>">
													<label for="">Añadir un enlace</label>
													<div class="form-group">
														<input type="text" class="form-control" name="Archivo" value="" required placeholder="URL del enlace">
													</div>
													<div class="form-group">
														<input type="text" class="form-control" name="Titulo" value="" required placeholder="Titulo">
													</div>
													<div class="form-group">
														<select class="form-control" name="Destino">
															<option value="_blank">Abrir en una nueva pestaña</option>
															<option value="_self">Abrir en una la misma pestaña</option>
														</select>
													</div>
													<button type="submit" class="btn btn-block btn-success" name="button"> <span class="fa fa-plus"></span> Añadir</button>
												</form>
											<?php } ?>
											<?php if($tipo=='youtube'){ ?>
												<form class="" action="<?php echo base_url('admin/multimedia/cargar_'.$tipo); ?>" method="post">
													<input type="hidden" name="id" value="<?php echo verificar_variable('GET','id',''); ?>">
													<label for="">Añadir un enlace</label>
													<div class="form-group">
														<input type="text" class="form-control" name="Archivo" value="" required placeholder="https://www.youtube.com/watch?v=">
													</div>
													<div class="form-group">
														<input type="text" class="form-control" name="Titulo" value="" placeholder="Titulo">
													</div>
													<button type="submit" class="btn btn-block btn-success" name="button"> <span class="fa fa-plus"></span> Añadir</button>
												</form>
											<?php } ?>
										</div>
									</div>
								</div>
								<div class="col-12 col-sm-8">
									<div class="card">
										<div class="card-body">
											<div class="multimedia_ajax" data-tipo='<?php echo $tipo; ?>'>
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
					</div>
				</div>
			</div>
		<!--end::Portlet-->
	</div>

	<!-- end:: Content -->
