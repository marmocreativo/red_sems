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
		<form class="" action="<?php echo base_url('admin/repositorio/actualizar_archivo'); ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="consulta" value="<?php echo verificar_variable('GET','consulta',''); ?>">
			<input type="hidden" name="Identificador" value="<?php echo $archivo['ID']; ?>">
			<input type="hidden" name="ArchivoActual" value="<?php echo $archivo['ARCHIVO']; ?>">
			<input type="hidden" name="ImagenActual" value="<?php echo $archivo['IMAGEN']; ?>">
			<input type="hidden" name="Formato" value="<?php echo $archivo['FORMATO']; ?>">
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
								<div class="col-4">
									<h4>Generales</h4>
									<div class="form-group">
										<label for="file">Archivo</label>
										<input type="file" class="form-control" name="file" value="" >
									</div>
									<div class="form-group">
										<label for="Imagen">Imágen miniatura</label>
										<input type="file" class="form-control" name="Imagen" value="">
									</div>
									<div class="form-group">
										<label for="Titulo">Titulo (Nombre amigable)</label>
										<input type="text" class="form-control" name="Titulo" value="<?php echo $archivo['TITULO']; ?>" required>
									</div>
									<div class="form-group">
										<label for="Cadido">CADIDO</label>
										<input type="text" class="form-control" name="Cadido" value="<?php echo $archivo['CADIDO']; ?>" >
									</div>
									<div class="form-group">
										<label for="Nomenclatura">Nomenclatura (Sin espacios ni caracteres especiales)</label>
										<input type="text" class="form-control" name="Nomenclatura" value="<?php echo $archivo['NOMENCLATURA']; ?>">
									</div>
									<div class="form-group">
										<label for="Descripcion">Descripción</label>
										<textarea class="form-control" name="Descripcion" rows="5"><?php echo $archivo['DESCRIPCION']; ?></textarea>
									</div>
								</div>
								<div class="col-4">
									<h4>Dublin Core</h4>
									<div class="form-group">
										<label for="Tema">Tema (Palabras clave)</label>
										<textarea class="form-control" name="Tema" rows="5"><?php echo $archivo['TEMA']; ?></textarea>
									</div>
									<div class="form-group">
										<label for="TipoRecurso">Tipo de recurso</label>
										<select class="form-control" name="TipoRecurso">
											<option value="">Selecciona</option>
											<?php
												$tipo_recursos = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'tipo_recurso'],'TIPO_NOMBRE ASC','','');


												foreach($tipo_recursos as $recurso){
													$seleccionado = '';
													if($recurso->ID==$archivo['TIPO_RECURSO']){ $seleccionado = 'selected';}
													echo '<option value="'.$curso->ID.'" '.$seleccionado.'>'.$curso->TIPO_NOMBRE.'</option>';
											} ?>
										</select>
									</div>

									<div class="form-group">
										<label for="Cobertura">Cobertura</label>
										<input type="text" class="form-control" name="Cobertura" value="<?php echo $archivo['COBERTURA']; ?>">
									</div>
									<div class="form-group">
										<label for="Derechos">Derechos</label>
										<textarea class="form-control" name="Derechos" rows="5"><?php echo $archivo['DERECHOS']; ?></textarea>
									</div>
								</div>
								<div class="col-4">
									<h4>Prepa en Línea</h4>
									<div class="form-group">
										<label for="TituloCurso">Título del Curso</label>
										<select  class="form-control" name="TituloCurso" >
											<option value="0">Selecciona curso</option>
											<?php
												$cursos = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'cursos'],'TIPO_NOMBRE ASC','','');
												foreach($cursos as $curso){
													$seleccionado = '';
													if($curso->ID==$archivo['TITULO_CURSO']){ $seleccionado = 'selected';}
													echo '<option value="'.$curso->ID.'" '.$seleccionado.'>'.$curso->TIPO_NOMBRE.'</option>';
											} ?>
										</select>
									</div>
									<div class="form-group">
										<label for="AreaConocimiento">Área del conocimiento</label>
										<select  class="form-control" name="AreaConocimiento" >
											<option value="">Selecciona un Área</option>
											<?php
												$areas = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'areas_conocimiento'],'TIPO_NOMBRE ASC','','');
												foreach($areas as $area){
													$seleccionado = '';
													if($area->TIPO_NOMBRE==$archivo['AREA_CONOCIMIENTO']){ $seleccionado = 'selected';}
													echo '<option value="'.$area->TIPO_NOMBRE.'" '.$seleccionado.'>'.$area->TIPO_NOMBRE_SINGULAR.'</option>';
											} ?>
										</select>
									</div>
									<div class="form-group">
										<label for="PropositoDidactico">Propósito didáctico</label>
										<input type="text" class="form-control" name="PropositoDidactico" value="<?php echo $archivo['PROPOSITO_DIDACTICO']; ?>">
									</div>
									<div class="form-group">
										<label for="UrlEditable">URL del archivo Editable</label>
										<input type="text" class="form-control" name="UrlEditable" value="<?php echo $archivo['ARCHIVO_EDITABLE']; ?>">
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
