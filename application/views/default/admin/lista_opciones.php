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
		<form action="<?php echo base_url('admin/opciones') ?>" method="post" enctype="multipart/form-data">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Opciones
						</h3>
					</div>
					<div class="kt-portlet__head-toolbar">
							<a class="btn btn-outline-info" href="<?php echo base_url('admin/crear_opcion'); ?>"> <i class="fa fa-cogs"></i> Crear nueva opción variable</a>
							<button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Guardar Todas</button>
					</div>
				</div>
				<div class="kt-portlet__body">
					<!--begin::Section-->
					<div class="kt-section">
						<div class="kt-section__content">
							<div class="row">
								<div class="col-12">
									<div class="border border-danger p-3">
										<h6 class="text-danger"> <i class="fa fa-exclamation-circle fa-2x"></i> Sección avanzada, alterar o eliminar los valores de esta sección puede provocar que el sistema deje de funcionar.<br>Por favor contacte al desarrollador si tiene dudas.</h6>
									</div>
								</div>
								<div class="col-12 col-md-9">
									<div class="card">
										<div class="card-body">

											<ul class="nav nav-tabs" role="tablist">
												<?php $i=0; foreach($grupos_opciones as $grupo){ ?>
			                    <li class="nav-item">
			                        <a class="nav-link <?php if($i==0){ echo 'active'; } ?>" data-toggle="tab" href="#grupo_<?php echo $grupo->OPCION_TIPO; ?>"><?php echo $grupo->OPCION_TIPO; ?></a>
			                    </li>
												<?php $i++; } ?>
			                </ul>

			                <div class="tab-content">
												<?php $i=0; foreach($grupos_opciones as $grupo){ ?>
			                    <div class="tab-pane <?php if($i==0){ echo 'active'; } ?> ui-sortable" id="grupo_<?php echo $grupo->OPCION_TIPO; ?>" role="tabpanel" data-tabla="opciones" data-columna="ID">
														<?php $opciones = $this->GeneralModel->lista('opciones','',['OPCION_TIPO'=>$grupo->OPCION_TIPO],'ORDEN ASC','',''); ?>
														<?php foreach($opciones as $opcion){ ?>
															<div class="form-group" id="item-<?php echo $opcion->ID; ?>">
																<label for="Opciones[<?php echo $opcion->OPCION_NOMBRE; ?>]"><?php echo $opcion->OPCION_NOMBRE; ?></label>
																<?php if($opcion->OPCION_INPUT=='varchar'){ ?>
																	<input type="text" class="form-control" name="Opciones[<?php echo $opcion->OPCION_NOMBRE; ?>]" value="<?php echo $opcion->OPCION_VALOR; ?>" required>
																<?php } ?>
																<?php if($opcion->OPCION_INPUT=='text'){ ?>
																	<textarea  class="form-control" name="Opciones[<?php echo $opcion->OPCION_NOMBRE; ?>]" rows="5" required><?php echo $opcion->OPCION_VALOR; ?></textarea>
																<?php } ?>
																<?php if($opcion->OPCION_INPUT=='editor'){ ?>
																	<textarea  class="form-control TextEditor" name="Opciones[<?php echo $opcion->OPCION_NOMBRE; ?>]" rows="5" required><?php echo $opcion->OPCION_VALOR; ?></textarea>
																<?php } ?>
																<?php if($opcion->OPCION_INPUT=='boolean'){ ?>
																	<select class="form-control" name="Opciones[<?php echo $opcion->OPCION_NOMBRE; ?>]">
																		<option value="si" <?php if($opcion->OPCION_VALOR=='si'){ echo 'selected'; } ?>>Si</option>
																		<option value="no" <?php if($opcion->OPCION_VALOR=='no'){ echo 'selected'; } ?>>No</option>
																	</select>
																<?php } ?>
																<div class="btn-group float-right mt-2">
																	<a href="<?php echo base_url('admin/actualizar_opcion?id='.$opcion->ID); ?>" class="btn btn-sm btn-outline-warning"><i class="fa fa-pencil-alt"></i></a>
																	<button type="button" data-enlace='<?php echo base_url('admin/borrar_opcion?id='.$opcion->ID); ?>' class="btn btn-sm btn-outline-danger borrar_entrada" title="Eliminar"> <span class="fa fa-trash"></span> </button>
																</div>
															</div>
														<?php } ?>
			                    </div>
												<?php $i++; } ?>
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
