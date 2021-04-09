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
		<form action="<?php echo base_url('admin/tests/actualizar_seccion') ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="Identificador" value="<?php echo $seccion['ID']; ?>">
			<input type="hidden" name="ImagenActual" value="<?php echo $seccion['IMAGEN']; ?>">
			<input type="hidden" name="AudioActual" value="<?php echo $seccion['AUDIO']; ?>">
			<input type="hidden" name="IdTest" value="<?php echo $test['ID_TEST']; ?>">
			<input type="hidden" name="Area" value="<?php echo $seccion['AREA']; ?>">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Actualizar | <?php echo $test['TITULO']; ?>
						</h3>
					</div>
					<div class="kt-portlet__head-toolbar">
						<div class="btn-group float-right">
							<button type="submit" class="btn btn-primary" name="Guardar" value="Salir"> <i class="fa fa-save"></i> Guardar y continuar</button>
						</div>
					</div>
				</div>
				<div class="kt-portlet__body">
					<!--begin::Section-->
					<div class="kt-section">
						<div class="kt-section__content">
							<div class="row">
								<div class="col-12 col-md-8">
									<div class="card">
										<div class="card-body">
											<div class="form-group">
												<label for="Titulo">Titulo</label>
												<input type="text" class="form-control" name="Titulo" value="<?php echo $seccion['TITULO']; ?>">
											</div>
											<div class="form-group">
												<label for="Instrucciones">Instrucciones</label>
												<textarea name="Instrucciones" class="form-control TextEditorSmall" rows="8"><?php echo $seccion['INSTRUCCIONES']; ?></textarea>
											</div>
											<hr>
											<?php if(!empty($seccion['IMAGEN'])){ ?>
												<audio src="<?php echo base_url('contenido/docs/'.$test['AUDIO']); ?>"
												       autoplay>
												  Tu navegador no soporta Audio HTML5
												</audio>
											<?php } ?>
											<div class="form-group">
												<label for="Audio">Audio</label>
												<input type="file" class="form-control" name="Audio" value="" accept="audio/*">
											</div>
											<hr>
											<?php if(!empty($seccion['IMAGEN'])){ ?>
											<img src="<?php echo base_url('contenido/img/test/'.$test['IMAGEN']); ?>" alt="">
											<?php } ?>
											<div class="form-group">
												<label for="Imagen">Imágen</label>
												<input type="file" class="form-control" name="Imagen" value="" accept="image/*">
											</div>
											<div class="form-group">
												<label for="SegundosPorPregunta">Segundos por Pregunta</label>
												<input type="number" class="form-control" name="SegundosPorPregunta" value="<?php echo $seccion['SEGUNDOS_POR_PREGUNTA']; ?>">
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
						<button type="submit" class="btn btn-primary" name="Guardar" value="Salir"> <i class="fa fa-save"></i> Guardar y continuar</button>
					</div>
				</div>
			</div>
		</form>
		<!--end::Portlet-->
	</div>

	<!-- end:: Content -->
