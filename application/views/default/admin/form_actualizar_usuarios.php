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
		<form action="<?php echo base_url('admin/usuarios/actualizar') ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="consulta" value="<?php echo verificar_variable('GET','consulta',''); ?>">
			<input type="hidden" name="Identificador" value="<?php echo $usuario['ID_USUARIO']; ?>">
			<input type="hidden" name="Tipo" value="<?php echo $usuario['TIPO']; ?>">
			<input type="hidden" name="Extra[secreto]" value="<?php if(isset($extra_datos['secreto'])){ echo $extra_datos['secreto']; }else{ echo generador_aleatorio(6); } ?>">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Actualizar <?php echo $tipo; ?>
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
												<input type="text" class="form-control" name="UsuarioNombre" value="<?php echo $usuario['USUARIO_NOMBRE']; ?>" required>
											</div>
											<div class="form-group">
												<label for="UsuarioApellidos">Apellidos</label>
												<input type="text" class="form-control" name="UsuarioApellidos" value="<?php echo $usuario['USUARIO_APELLIDOS']; ?>" >
											</div>
											<div class="row">
											<div class="form-group col-md-6">
													<!-- Label -->
													<label class="pb-1">
															Compañía
													</label>
													<!-- Input group -->
													<div class="input-group input-group-merge">
															<input type="text" class="form-control" name="Extra[compania]" placeholder="Indique su empresa u organización" value="<?php if(isset($extra_datos['compania'])){ echo $extra_datos['compania']; } ?>">
													</div>
											</div>

											<div class="form-group col-md-6">
													<!-- Label -->
													<label class="pb-1">
															Puesto
													</label>
													<!-- Input group -->
													<div class="input-group input-group-merge">
															<input type="text" class="form-control" name="Extra[puesto]" placeholder="Indique su puesto" value="<?php if(isset($extra_datos['puesto'])){ echo $extra_datos['puesto']; } ?>">
													</div>
											</div>
											</div>
											<div class="form-group">
												<label for="UsuarioCorreo">Correo</label>
												<input type="text" class="form-control" name="UsuarioCorreo" value="<?php echo $usuario['USUARIO_CORREO']; ?>" required autocomplete="new-password">
											</div>
											<div class="form-group">
													<!-- Label -->
													<label class="pb-1">
															Dirección completa
													</label>
													<!-- Input group -->
													<div class="input-group input-group-merge">
															<input type="text" class="form-control" name="Extra[direccion]"  placeholder="Indique su dirección" value="<?php if(isset($extra_datos['direccion'])){ echo $extra_datos['direccion']; } ?>">
													</div>
											</div>

											<div class="row">
											<div class="form-group col-md-6">
													<!-- Label -->
													<label class="pb-1">
															Código Postal
													</label>
													<!-- Input group -->
													<div class="input-group input-group-merge">
															<input type="text" class="form-control" name="Extra[codigo_postal]" placeholder="Ingrese su Código Postal" value="<?php if(isset($extra_datos['codigo_postal'])){ echo $extra_datos['codigo_postal']; } ?>">
													</div>
											</div>

											<!-- Password -->
											<div class="form-group col-md-6">
													<!-- Label -->
													<label class="pb-1">
															País
													</label>
													<!-- Input group -->
													<div class="input-group input-group-merge">
															<input type="text" class="form-control" name="Extra[pais]" laceholder="Ingrese su País" value="<?php if(isset($extra_datos['compania'])){ echo $extra_datos['pais']; } ?>">
													</div>
											</div>
											</div>
											<small class="text-warning">Dejar los campos de contraseña vacíos a menos que se desee cambiar la contraseña</small>
											<div class="form-group">
												<label for="UsuarioPass">Contraseña</label>
												<input type="password" class="form-control" name="UsuarioPass" value="" autocomplete="new-password">
											</div>
											<div class="form-group">
												<label for="UsuarioPassConf">Confirmar Contraseña</label>
												<input type="password" class="form-control" name="UsuarioPassConf" value="" autocomplete="new-password">
											</div>
											<div class="form-group">
												<label for="UsuarioTelefono">Teléfono</label>
												<input type="text" class="form-control" name="UsuarioTelefono" value="<?php echo $usuario['USUARIO_TELEFONO']; ?>">
											</div>
											<div class="form-check">
												<label class="form-check-label" for="UsuarioListaDeCorreo" >
						 					 <input type="checkbox" class="form-check-input" name="UsuarioListaDeCorreo" <?php if($usuario['USUARIO_LISTA_DE_CORREO']=='si'){ echo 'checked'; } ?>>
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
													<option value="activo" <?php if($usuario['ESTADO']=='activo'){ echo 'checked'; } ?>>Activo</option>
													<option value="inactivo" <?php if($usuario['ESTADO']=='inactivo'){ echo 'checked'; } ?>>Inactivo</option>
												</select>
											</div>
											<div class="form-group">
												<label for="UsuarioFechaNacimiento">Fecha Nacimiento</label>
												<input type="text" class="form-control datepicker" name="UsuarioFechaNacimiento" value="<?php echo $usuario['USUARIO_FECHA_NACIMIENTO']; ?>">
											</div>
											<input type="hidden" name="FechaRegistro" value="<?php echo date('d-m-Y'); ?>">
											<hr>
											<h6>Grupos / Categorías</h6>
											<?php
											$categorias_seleccionadas = $this->GeneralModel->lista('categorias_objetos','',['TIPO'=>$tipo,'ID_OBJETO'=>$usuario['ID_USUARIO']],'','','');
												$id_categorias_seleccionadas = array();
												foreach($categorias_seleccionadas as $categoria){
													$id_categorias_seleccionadas[] = $categoria->ID_CATEGORIA;
												}
												multinivel($tipo,'checkbox',$id_categorias_seleccionadas,0);
											?>
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
