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
		<form action="<?php echo base_url('admin/divisas/actualizar') ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="Identificador" value="<?php echo $divisa['ID_DIVISA']; ?>">
			<div class="kt-portlet col-6">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Crear Divisa
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
										<label for="DivisaNombre">Nombre divisa <small>Singular</small></label>
										<input type="text" class="form-control" name="DivisaNombre" value="<?php echo $divisa['DIVISA_NOMBRE']; ?>" required>
									</div>
									<div class="form-group">
										<label for="DivisaNombrePlural">Nombre divisa <small>Plural</small></label>
										<input type="text" class="form-control" name="DivisaNombrePlural" value="<?php echo $divisa['DIVISA_NOMBRE_PLURAL']; ?>" required>
									</div>
									<div class="form-group">
										<label for="DivisaIso">Código ISO divisa <small>Ej. MXN / USD</small></label>
										<input type="text" class="form-control" name="DivisaIso" value="<?php echo $divisa['DIVISA_ISO']; ?>" required>
									</div>
									<div class="form-group">
										<label for="DivisaSigno">Signo divisa <small>Ej. $</small></label>
										<input type="text" class="form-control" name="DivisaSigno" value="<?php echo $divisa['DIVISA_SIGNO']; ?>" required>
									</div>
									<div class="form-group">
										<label for="DivisaPosicionSigno">Posición del signo <small>Izquierda / derecha</small></label>
										<select class="form-control" name="DivisaPosicionSigno">
											<option value="izquierda" <?php if($divisa['DIVISA_POSICION_SIGNO']=='izquierda'){ echo 'selected'; } ?>>$xx.xx</option>
											<option value="derecha" <?php if($divisa['DIVISA_POSICION_SIGNO']=='derecha'){ echo 'selected'; } ?>>xx.xx€</option>
										</select>
									</div>
									<div class="form-group">
										<label for="DivisaCambio">Tipo de cambio <small>En relación a la divisa principal</small></label>
										<input type="number" min="0" step="0.01" class="form-control" name="DivisaCambio" value="<?php echo $divisa['DIVISA_CAMBIO']; ?>" required>
									</div>
								</div>
								<div class="col-4">
									<div class="form-group">
										<label for="Estado">Estado</label>
										<select class="form-control" name="Estado">
											<option value="activo" <?php if($divisa['ESTADO']=='activo'){ echo 'selected'; } ?>>Activo</option>
											<option value="inactivo" <?php if($divisa['ESTADO']=='inactivo'){ echo 'selected'; } ?>>Inactivo</option>
										</select>
									</div>
									<div class="form-group">
										<label for="DivisaPrincipal">Divisa Principal</label>
										<select class="form-control" name="DivisaPrincipal">
											<option value="no" <?php if($divisa['DIVISA_PRINCIPAL']=='no'){ echo 'selected'; } ?>>No</option>
											<option value="si" <?php if($divisa['DIVISA_PRINCIPAL']=='si'){ echo 'selected'; } ?>>Si</option>
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
