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
				<a href="<?php echo base_url('admin/tipos?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
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
		<div class="kt-portlet col-6">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						Disponibilidad de <b><?php echo $transportista['TRANSPORTISTA_NOMBRE']; ?></b>
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<a href="<?php echo base_url('admin/transportistas'); ?>" class="btn btn-outline-primary">Volver a los transportistas</a>
				</div>
			</div>
			<div class="kt-portlet__body">
				<!--begin::Section-->
				<div class="kt-section">
					<div class="kt-section__content">
						<form class="" action="<?php echo base_url('admin/transportistas/crear_disponibilidad'); ?>" method="post">
							<input type="hidden" name="Identificador" value="<?php echo $transportista['ID_TRANSPORTISTA']; ?>">
							<div id="accordion">
							<?php foreach($paises as $pais){} ?>
                <div class="card">
                    <div class="card-header" id="pais-<?php echo $pais->ID_PAIS; ?>">
                      <h5 class="mb-0">
                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-<?php echo $pais->ID_PAIS; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $pais->ID_PAIS; ?>">
                          <?php echo $pais->PAIS_NOMBRE; ?> <i class="fa fa-caret-down"></i>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse-<?php echo $pais->ID_PAIS; ?>" class="collapse" aria-labelledby="collapse-<?php echo $pais->ID_PAIS; ?>" data-parent="#accordion" style="">
                      <div class="card-body">
                        <div class="form-check border-bottom mb-2 pb-2">
                          <input class="form-check-input control_estados_disponibilidad" type="checkbox" name="ControlPais-<?php echo $pais->ID_PAIS; ?>" id="ControlPais-<?php echo $pais->ID_PAIS; ?>" data-controla="pais-<?php echo $pais->ID_PAIS; ?>">
                          <label class="form-check-label" for="ControlPais-<?php echo $pais->ID_PAIS; ?>">
                            Todos
                          </label>
                        </div>
												<?php $estados = $this->GeneralModel->lista('direcciones_estados','',['ID_PAIS'=>$pais->ID_PAIS],'ESTADO_NOMBRE ASC','',''); ?>
                        <ul class="list-unstyled">
													<?php foreach($estados as $estado){ ?>
                          <li>
                            <div class="form-check">
                              <input
																class="form-check-input hijo_estados_disponibilidad pais-<?php echo $pais->ID_PAIS; ?>"
																type="checkbox"
																value="<?php echo $estado->ID_ESTADO; ?>"
																data-controlador="ControlPais-<?php echo $pais->ID_PAIS; ?>"
																name="EstadosDisponible[]"
																id="estado-<?php echo $estado->ID_ESTADO; ?>"
																<?php
																if (in_array($estado->ID_ESTADO, $estados_disponibles)) {
																	    echo "checked";
																	}
																?>
																>
                              <label class="form-check-label" for="estado-<?php echo $estado->ID_ESTADO; ?>">   <?php echo $estado->ESTADO_NOMBRE; ?> </label>
                            </div>
                          </li>
												<?php } ?>
                      	</ul>
                      </div>
                    </div>
                  </div>
              </div>
							<hr>
							<button type="submit" class="btn btn-primary d-block ml-auto" name="button">Actualizar disponibilidad</button>
						</form>
					</div>
				</div>
				<!--end::Section-->
			</div>
			<!--end::Form-->
		</div>
		<!--end::Portlet-->
	</div>

	<!-- end:: Content -->
