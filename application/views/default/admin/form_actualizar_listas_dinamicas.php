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
				<a href="<?php echo base_url('admin/sliders?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
					Listas Dinámicas | <?php echo $tipo; ?> </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<?php $padre = verificar_variable('GET','padre',0); if(!empty($padre)){ ?>
					<a href="<?php echo base_url('admin/listas_dinamicas?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
						<?php $categoria_padre = $this->GeneralModel->detalles('sliders',['ID_SLIDER'=>$padre]); ?>
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
		<form action="<?php echo base_url('admin/listas_dinamicas/actualizar') ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="Identificador" value="<?php echo $lista['ID']; ?>">
			<input type="hidden" name="Tipo" value="<?php echo $lista['TIPO_OBJETOS_HIJOS']; ?>">
			<input type="hidden" name="Valor" value="<?php echo $lista['VARIABLES']; ?>">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Actualizar Lista <?php echo $tipo; ?>
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
												<label for="ListaTitulo">Título</label>
												<input type="text" class="form-control" name="ListaTitulo" required value="<?php echo $lista['LISTA_TITULO']; ?>">
											</div>
											<div class="form-group">
												<label for="ListaSubtitulo">Subtítulo</label>
												<input type="text" class="form-control" name="ListaSubtitulo" value="<?php echo $lista['LISTA_SUBTITULO']; ?>">
											</div>
											<div class="form-group">
												<label for="Limite">Cantidad límite de publicaciones</label>
												<input type="text" class="form-control" name="Limite" value="<?php echo $lista['LIMITE']; ?>">
											</div>
											<div class="form-group">
												<label for="Columnas">Columnas por fila</label>
												<select class="form-control" name="Columnas">
													<option value="1"  <?php if($lista['COLUMNAS']=='1'){ echo 'selected'; } ?>>1</option>
													<option value="2"  <?php if($lista['COLUMNAS']=='2'){ echo 'selected'; } ?>>2</option>
													<option value="3"  <?php if($lista['COLUMNAS']=='3'){ echo 'selected'; } ?>>3</option>
													<option value="4"  <?php if($lista['COLUMNAS']=='4'){ echo 'selected'; } ?>>4</option>
													<option value="6"  <?php if($lista['COLUMNAS']=='6'){ echo 'selected'; } ?>>6</option>
													<option value="12"  <?php if($lista['COLUMNAS']=='12'){ echo 'selected'; } ?>>12</option>
												</select>
											</div>
											<div class="form-group">
												<label for="OrdenarPor">Ordenar Por</label>
												<select class="form-control" name="OrdenarPor">
													<option value="">Ninguno</option>
												<?php if($tipo=='publicaciones'){ ?>
													<option value="PUBLICACION_TITULO ASC" <?php if($lista['ORDENAR_POR']=='PUBLICACION_TITULO ASC'){ echo 'selected'; } ?>>Alfabético A-Z</option>
													<option value="PUBLICACION_TITULO DESC" <?php if($lista['ORDENAR_POR']=='PUBLICACION_TITULO DESC'){ echo 'selected'; } ?>>Alfabético Z-A</option>
													<option value="FECHA_PUBLICACION DESC" <?php if($lista['ORDENAR_POR']=='FECHA_PUBLICACION DESC'){ echo 'selected'; } ?>>Fecha de Publicación (Más nuevos primero)</option>
													<option value="FECHA_PUBLICACION ASC" <?php if($lista['ORDENAR_POR']=='FECHA_PUBLICACION ASC'){ echo 'selected'; } ?>>Fecha de Publicación (Más antiguos primero)</option>
													<option value="ORDEN ASC" <?php if($lista['ORDENAR_POR']=='ORDEN ASC'){ echo 'selected'; } ?>>Orden Personalizado</option>
													<?php } ?>
													<?php if($tipo=='usuarios'){ ?>
														<option value="USUARIO_NOMBRE ASC" <?php if($lista['ORDENAR_POR']=='USUARIO_NOMBRE ASC'){ echo 'selected'; } ?>>Alfabético A-Z</option>
														<option value="USUARIO_NOMBRE DESC" <?php if($lista['ORDENAR_POR']=='USUARIO_NOMBRE DESC'){ echo 'selected'; } ?>>Alfabético Z-A</option>
														<option value="FECHA_REGISTRO DESC" <?php if($lista['ORDENAR_POR']=='FECHA_REGISTRO DESC'){ echo 'selected'; } ?>>Fecha de Registro (Más nuevos primero)</option>
														<option value="FECHA_REGISTRO ASC" <?php if($lista['ORDENAR_POR']=='FECHA_REGISTRO ASC'){ echo 'selected'; } ?>>Fecha de Registro (Más antiguos primero)</option>
														<?php } ?>
													<?php if($tipo=='categorias'){ ?>
														<option value="CATEGORIA_NOMBRE ASC" <?php if($lista['ORDENAR_POR']=='CATEGORIA_NOMBRE ASC'){ echo 'selected'; } ?>>Alfabético A-Z</option>
														<option value="CATEGORIA_NOMBRE DESC" <?php if($lista['ORDENAR_POR']=='CATEGORIA_NOMBRE DESC'){ echo 'selected'; } ?>>Alfabético Z-A</option>
														<option value="ORDEN ASC" <?php if($lista['ORDENAR_POR']=='ORDEN ASC'){ echo 'selected'; } ?>>Orden Personalizado</option>
														<?php } ?>
												</select>
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
													<option value="activo" <?php if($lista['ESTADO']=='activo'){ echo 'selected'; } ?>>Activo</option>
													<option value="inactivo" <?php if($lista['ESTADO']=='inactivo'){ echo 'selected'; } ?>>Inactivo</option>
												</select>
											</div>
											<hr>
											<h6>Categoria</h6>
											<?php
												$id_categorias_seleccionadas = array();
												$id_categorias_seleccionadas[] = $lista['ID_CATEGORIA'];
												$tipos_publicaciones = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>$tipo],'','','');
												foreach($tipos_publicaciones as $tipo_pub){
													echo '<p><b>-'.$tipo_pub->TIPO_NOMBRE_PLURAL.'</b></p>';
													multinivel($tipo_pub->TIPO_NOMBRE,'radio',$id_categorias_seleccionadas,0);
												}

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
