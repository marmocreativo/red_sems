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
				<a href="<?php echo base_url('admin/usuarios?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
					Usuarios | <?php echo $tipo; ?> </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<?php $padre = verificar_variable('GET','padre',0); if(!empty($padre)){ ?>
					<a href="<?php echo base_url('admin/usuarios?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
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
		<form action="<?php echo base_url('admin/usuarios/crear') ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="Tipo" value="<?php echo $tipo; ?>">
			<input type="hidden" name="consulta" value="<?php echo verificar_variable('GET','consulta',''); ?>">
			<input type="hidden" name="Extra[secreto]" value="<?php if(isset($extra_datos['secreto'])){ echo $extra_datos['secreto']; }else{ echo generador_aleatorio(6); } ?>">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Registrar <?php echo $tipo; ?>
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
												<label for="UsuarioNombre">Nombre</label>
												<input type="text" class="form-control" name="UsuarioNombre" value="" required>
											</div>
											<div class="form-group">
												<label for="UsuarioApellidos">Apellidos</label>
												<input type="text" class="form-control" name="UsuarioApellidos" value="" >
											</div>
											<div class="form-group">
												<label for="UsuarioCorreo">Correo</label>
												<input type="text" class="form-control" name="UsuarioCorreo" value="" required>
											</div>
											<div class="form-group">
												<label for="UsuarioPass">Contraseña</label>
												<input type="password" class="form-control" name="UsuarioPass" value="" required>
											</div>
											<div class="form-group">
												<label for="UsuarioPassConf">Confirmar Contraseña</label>
												<input type="password" class="form-control" name="UsuarioPassConf" value="" required>
											</div>
											<div class="form-group">
												<label for="UsuarioTelefono">Teléfono</label>
												<input type="text" class="form-control" name="UsuarioTelefono" value="">
											</div>
											<div class="form-check">
												<label class="form-check-label" for="UsuarioListaDeCorreo">
						 					 <input type="checkbox" class="form-check-input" name="UsuarioListaDeCorreo">
						 					 Lista de Correo</label>
						 				 </div>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-3">
									<div class="card">
										<div class="card-body">
											<div class="form-group">
												<label for="Estado">Estado</label>
												<select class="form-control" name="Estado">
													<option value="activo">Activo</option>
													<option value="inactivo">Inactivo</option>
												</select>
											</div>
											<div class="form-group">
												<label for="UsuarioFechaNacimiento">Fecha Nacimiento</label>
												<input type="text" class="form-control datepicker" name="UsuarioFechaNacimiento" value="">
											</div>
											<input type="hidden" name="FechaRegistro" value="<?php echo date('d-m-Y'); ?>">
											<hr>
											<h6>Grupos / Categorías</h6>
											<?php $categorias_1 = $this->GeneralModel->lista('categorias','',['TIPO'=>$tipo,'CATEGORIA_PADRE'=>0],'','',''); ?>
											<ul>
												<?php foreach($categorias_1 as $categoria){ ?>
												<li>
												    <label class="form-check-label" >
															<input type="checkbox" class="form-check-input" name="CategoriasObjeto[]" value="<?php echo $categoria->ID_CATEGORIA; ?>">
												    	<?php echo $categoria->CATEGORIA_NOMBRE; ?></label>
													<?php $categorias_2 = $this->GeneralModel->lista('categorias','',['TIPO'=>$tipo,'CATEGORIA_PADRE'=>$categoria->ID_CATEGORIA],'','',''); ?>
													<?php if(!empty($categorias_2)){ ?>
														<ul>
														<?php foreach($categorias_2 as $categoria){ ?>
															<li>
																<label class="form-check-label" >
																	<input type="checkbox" class="form-check-input" name="CategoriasObjeto[]" value="<?php echo $categoria->ID_CATEGORIA; ?>">
														    	<?php echo $categoria->CATEGORIA_NOMBRE; ?></label>
																<?php $categorias_3 = $this->GeneralModel->lista('categorias','',['TIPO'=>$tipo,'CATEGORIA_PADRE'=>$categoria->ID_CATEGORIA],'','',''); ?>
																<?php if(!empty($categorias_3)){ ?>
																	<ul>
																	<?php foreach($categorias_3 as $categoria){ ?>
																		<li>
																			<label class="form-check-label" >
																				<input type="checkbox" class="form-check-input" name="CategoriasObjeto[]" value="<?php echo $categoria->ID_CATEGORIA; ?>">
																	    	<?php echo $categoria->CATEGORIA_NOMBRE; ?></label>
																		</li>
																	<?php }// Bucle Categorias Nivel 3 ?>
																	</ul>
																<?php }// Condición subcategorias vacias 3?>
															</li>
														<?php }// Bucle Categorias Nivel 2 ?>
														</ul>
													<?php }// Condición subcategorias vacias 2?>
												</li>
											<?php } ?>
											</ul>
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
