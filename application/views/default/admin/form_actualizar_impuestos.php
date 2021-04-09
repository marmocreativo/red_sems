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
		<form action="<?php echo base_url('admin/impuestos/actualizar') ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="Identificador" value="<?php echo $impuesto['ID_IMPUESTO']; ?>">
			<div class="kt-portlet col-6">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Crear Impuesto
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
										<label for="ImpuestoNombre">Nombre Impuesto</label>
										<input type="text" class="form-control" name="ImpuestoNombre" value="<?php echo $impuesto['IMPUESTO_NOMBRE']; ?>" required>
									</div>
									<div class="row">
										<div class="col">
											<div class="form-group">
												<label for="ImpuestoCantidad">Impuesto Cantidad <small>(Solo números)</small></label>
												<input type="number" class="form-control" name="ImpuestoCantidad" value="<?php echo $impuesto['IMPUESTO_CANTIDAD']; ?>" required>
											</div>
										</div>
										<div class="col-3">
											<div class="form-group">
												<label for="ImpuestoFuncion">Tipo</label>
												<select class="form-control" name="ImpuestoFuncion">
													<option value="porcentaje" <?php if($impuesto['IMPUESTO_FUNCION']=='porcentaje'){ echo 'selected'; } ?> >%</option>
													<option value="importe" <?php if($impuesto['IMPUESTO_FUNCION']=='importe'){ echo 'selected'; } ?> >$ </option>
												</select>
											</div>
										</div>
									</div>
									<?php $paises = $this->GeneralModel->lista('direcciones_paises','','','','',''); ?>
									<div class="form-group">
										<label for="IdPais">Pais al que aplica</label>
										<select class="form-control" name="IdPais">
											<?php foreach($paises as $pais){ ?>
											<option value="<?php echo $pais->ID_PAIS; ?>" <?php if($impuesto['ID_PAIS']==$pais->ID_PAIS){ echo 'selected'; } ?>><?php echo $pais->PAIS_NOMBRE; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-4">
									<div class="form-group">
										<label for="Estado">Estado</label>
										<select class="form-control" name="Estado">
											<option value="activo" <?php if($impuesto['ESTADO']=='activo'){ echo 'selected'; } ?>>Activo</option>
											<option value="inactivo" <?php if($impuesto['ESTADO']=='inactivo'){ echo 'selected'; } ?>>Inactivo</option>
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
