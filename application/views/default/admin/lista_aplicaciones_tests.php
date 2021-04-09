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
					Categorias | <?php echo $tipo; ?> </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<?php $padre = verificar_variable('GET','padre',0); if(!empty($padre)){ ?>
					<a href="<?php echo base_url('admin/categorias?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
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
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Aplicaciones al Exámen | <b><?php echo $test['TITULO']; ?></b>
						</h3>
					</div>
					<div class="kt-portlet__head-toolbar">
						<div class="btn-group float-right">

						</div>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="row">
						<div class="col-2">
							<div class="card">
								<div class="card-header">
									<h3 class="h4"><small>Controles</small><br> <?php echo $test['TITULO']; ?></h3>
								</div>
								<div class="card-body">
									<table class="table">
										<tbody>
											<tr>
												<td>Idioma</td>
												<td><?php echo $test['IDIOMA']; ?></td>
											</tr>
											<tr>
												<td>Aplicaciones Totales</td>
												<td><?php echo $cantidad_aplicaciones_totales; ?></td>
											</tr>
											<tr>
												<td>Aplicaciones Finalizadas</td>
												<td><?php echo $cantidad_aplicaciones_finalizadas; ?></td>
											</tr>
											<tr>
												<td>Aplicaciones Canceladas</td>
												<td><?php echo $cantidad_aplicaciones_canceladas; ?></td>
											</tr>
										</tbody>
									</table>
									<hr>
									<h4>Crear nuevas solicitudaes</h4>
									<form class="" action="<?php echo base_url('admin/tests/crear_aplicaciones'); ?>" method="post">
										<input type="hidden" name="IdTest" value="<?php echo $test['ID_TEST'] ?>">
										<div class="form-group">
											<label for="CantidadAplicaciones">Cantidad de Aplicaciones</label>
											<input type="number" class="form-control" name="CantidadAplicaciones" value="1">
										</div>
										<div class="form-group">
											<label for="FechaExamen">Fecha de Disponibilidad</label>
											<input type="text" class="form-control datepicker" name="FechaExamen" autocomplete="off" required value="<?php echo date('d-m-Y'); ?>">
										</div>
										<div class="form-group">
											<label for="FechaVigencia">Fecha de Vigencia</label>
											<input type="text" class="form-control datepicker" name="FechaVigencia" autocomplete="off" required value="<?php echo date('d-m-Y',strtotime('tomorrow')); ?>">
										</div>

										<button type="submit" class="btn btn-primary" name="button">Crear</button>
									</form>
								</div>
							</div>
						</div>
						<div class="col-10">
							<table class="table table-sm table-striped">
							  	<thead>
							    	<tr>
							      		<th>#</th>
							      		<th>Clave</th>
												<th>Nombre</th>
												<th>Correo</th>
												<th>Teléfono</th>
												<th>Fecha disponible</th>
							      		<th>Fecha Vigencia</th>
												<th>Inicio</th>
												<th>Final</th>
												<th>Calificación</th>
												<th>Estado</th>
												<th class="text-right">Controles</th>
							    	</tr>
							  	</thead>
							  	<tbody class="" data-tabla="publicaciones" data-columna="ID_PUBLICACION">
									<?php foreach($aplicaciones as $aplicacion){ ?>
							    	<tr>
							      	<td><?php echo $aplicacion->ID; ?></td>
							      	<td><?php echo $aplicacion->CLAVE; ?></td>
											<td><?php echo $aplicacion->NOMBRE.' '.$aplicacion->APELLIDOS; ?></td>
											<td><?php echo $aplicacion->CORREO; ?></td>
											<td><?php echo $aplicacion->TELEFONO; ?></td>
											<td><?php echo date('d/m/Y',strtotime($aplicacion->FECHA_EXAMEN)); ?></td>
											<td><?php echo date('d/m/Y',strtotime($aplicacion->FECHA_VIGENCIA)); ?></td>
											<td><?php if(!empty($aplicacion->INICIO)){ echo date('d/m/Y H:i:s',strtotime($aplicacion->INICIO)); }; ?></td>
											<td><?php if(!empty($aplicacion->FINAL)){ echo date('d/m/Y H:i:s',strtotime($aplicacion->FINAL)); }; ?></td>
											<td><?php echo $aplicacion->CALIFICACION; ?></td>
							      	<td>
												<?php switch($aplicacion->ESTADO){
													case 'pendiente':
														echo 'Pendiente';
														break;
													case 'activa':
														echo 'Activa';
														break;
													case 'finalizada':
														echo 'Finalizada';
														break;
													case 'cancelada':
														echo 'Cancelada';
														break;
												} ?>
											</td>
											<td>
												<div class="btn-group float-right" role="group">
	                      	<a href="<?php echo base_url('admin/tests/actualizar_aplicacion?id='.$aplicacion->ID."&consulta=".base64_encode(json_encode($consulta))); ?>" class="btn btn-sm btn-warning" title="Editar"> <span class="fa fa-pencil-alt"></span> </a>
	                      	<button data-enlace='<?php echo base_url('admin/tests/borrar_test?id='.$aplicacion->ID."&consulta=".base64_encode(json_encode($consulta))); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar"> <span class="fa fa-trash"></span> </button>
	                    </div>
											</td>
							    	</tr>
									<?php } ?>
							  	</tbody>
							</table>
						</div>
					</div>
				</div>
				<!--end::Form-->
				<div class="kt-portlet__foot">
				</div>
			</div>
		<!--end::Portlet-->
	</div>

	<!-- end:: Content -->
