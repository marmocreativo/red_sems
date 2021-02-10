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
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Galería de: <?php echo $tipo; ?>
						</h3>
					</div>
					<div class="kt-portlet__head-toolbar">
						<div class="btn-group float-right">
							<div class="btn-group float-right">

								<?php $tipos_multimedia= $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'multimedia'],'','',''); ?>
								<?php $i = 0; foreach($tipos_multimedia as $tipo_multimedia){ if($i%2){ $color_boton = 'btn-outline-dark';}else{ $color_boton = 'btn-outline-secondary'; } if($tipo_multimedia->TIPO_NOMBRE==$_GET['tipo']){ $color_boton = 'btn-warning';} ?>
								<a href="<?php echo base_url('admin/publicaciones/multimedia?tipo='.$tipo_multimedia->TIPO_NOMBRE.'&id='.$publicacion['ID_PUBLICACION']); ?>" class="btn <?php echo $color_boton; ?>"> <i class="fas fa-photo-video"></i> <?php echo $tipo_multimedia->TIPO_NOMBRE_PLURAL; ?></a>
								<?php $i++; } ?>
								<a href="<?php echo base_url('admin/publicaciones/actualizar?id='.$publicacion['ID_PUBLICACION']); ?>" class="btn btn-primary"> Volver a la publicación <i class="fa fa-chevron-right"></i> </a>
						</div>
					</div>
					</div>
				</div>
				<div class="kt-portlet__body">
					<!--begin::Section-->
					<div class="kt-section">
						<div class="kt-section__content">
							<div class="row">
								<div class="col-12 col-sm-4">
									<div class="media mb-3 border border-secondary p-2" style="border-style: dotted">
										<img src="<?php echo base_url('contenido/img/publicaciones/'.$publicacion['IMAGEN']); ?>" class="mr-3" alt="..." height="100px">
										<div class="media-body">
											<h5 class="mt-0"><?php echo $publicacion['PUBLICACION_TITULO']; ?></h5>
											<?php echo $publicacion['PUBLICACION_RESUMEN']; ?><br>
											<a href="<?php echo base_url('admin/publicaciones/actualizar?id='.$publicacion['ID_PUBLICACION']); ?>"> Volver a la publicación</a>
										</div>
									</div>
									<div class="card border-info">
										<div class="card-body" >
											<?php if($tipo=='imagen'){ ?>
												<div class="dropzone" id="Dropzone_multimedia"
													data-id='<?php echo $publicacion['ID_PUBLICACION']; ?>'
													data-tipo='<?php echo $tipo; ?>'
													data-tipo-objeto='<?php echo $publicacion['TIPO']; ?>'
													></div> <?php } ?>
											<?php if($tipo=='documento'){ ?>
												<div class="dropzone" id="Dropzone_multimedia"
													data-id='<?php echo $publicacion['ID_PUBLICACION']; ?>'
													data-tipo='<?php echo $tipo; ?>'
													data-tipo-objeto='<?php echo $publicacion['TIPO']; ?>'
													></div> <?php } ?>
											<?php if($tipo=='enlace'){ ?>
												<form class="" action="<?php echo base_url('admin/multimedia/cargar_'.$tipo); ?>" method="post">
													<input type="hidden" name="id" value="<?php echo verificar_variable('GET','id',''); ?>">
													<input type="hidden" name="tipo_objeto" value="<?php if(isset($publicacion['TIPO'])){ echo $publicacion['TIPO']; } ?>">
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
													<input type="hidden" name="tipo_objeto" value="<?php if(isset($publicacion['TIPO'])){ echo $publicacion['TIPO']; } ?>">
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
									<div class="card border-0">
										<div class="card-body border-0 p-0">
											<div class="galeria_ajax" data-id='<?php echo $publicacion['ID_PUBLICACION']; ?>' data-tipo='<?php echo $tipo; ?>' data-tipo-objeto='<?php echo $publicacion['TIPO']; ?>'>
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
