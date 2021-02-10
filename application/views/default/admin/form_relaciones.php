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
		<form action="<?php echo base_url('admin/relaciones/crear') ?>" method="post" enctype="multipart/form-data">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Crear Relación
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
											<?php $tipos_publicaciones = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'publicaciones'],'','',''); ?>
											<?php $tipos_usuarios = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'usuarios'],'','',''); ?>
											<div class="row">
												<div class="col">
													<div class="form-group">
														<label for="Objeto">Objeto A</label>
														<select class="form-control" name="Objeto">
															<option value="publicacion">Publicacion</option>
															<option value="usuario">Usuarios</option>
														</select>
													</div>
												</div>
												<div class="col">
													<div class="form-group">
														<label for="Tipo">Tipo A</label>
														<select class="form-control" name="Tipo">
															<optgroup label="Publicaciones">
																<?php foreach($tipos_publicaciones as $tipo_publicacion){ ?>
																	<option value="<?php echo $tipo_publicacion->TIPO_NOMBRE; ?>"><?php echo $tipo_publicacion->TIPO_NOMBRE_PLURAL; ?></option>
																<?php } ?>
														  </optgroup>
															<optgroup label="Usuarios">
																<?php foreach($tipos_usuarios as $tipo_usuario){ ?>
																	<option value="<?php echo $tipo_usuario->TIPO_NOMBRE; ?>"><?php echo $tipo_usuario->TIPO_NOMBRE_PLURAL; ?></option>
																<?php } ?>
														  </optgroup>
														</select>
													</div>
												</div>
												<div class="col">
													<div class="form-group">
														<label for="ObjetoRel">Objeto b</label>
														<select class="form-control" name="ObjetoRel">
															<option value="publicacion">Publicacion</option>
															<option value="usuario">Usuarios</option>
														</select>
													</div>
												</div>
												<div class="col">
													<div class="form-group">
														<label for="TipoRel">Tipo B</label>
														<select class="form-control" name="TipoRel">
															<optgroup label="Publicaciones">
																<?php foreach($tipos_publicaciones as $tipo_publicacion){ ?>
																	<option value="<?php echo $tipo_publicacion->TIPO_NOMBRE; ?>"><?php echo $tipo_publicacion->TIPO_NOMBRE_PLURAL; ?></option>
																<?php } ?>
															</optgroup>
															<optgroup label="Usuarios">
																<?php foreach($tipos_usuarios as $tipo_usuario){ ?>
																	<option value="<?php echo $tipo_usuario->TIPO_NOMBRE; ?>"><?php echo $tipo_usuario->TIPO_NOMBRE_PLURAL; ?></option>
																<?php } ?>
															</optgroup>
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col">
													<div class="form-group">
														<label for="NombreRelacionA">Nombre relación A-B</label>
														<input type="text" class="form-control" name="NombreRelacionA" value="" required>
													</div>
												</div>
												<div class="col">
													<div class="form-group">
														<label for="NombreRelacionB">Nombre relación B-A</label>
														<input type="text" class="form-control" name="NombreRelacionB" value="" required>
													</div>
												</div>
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
