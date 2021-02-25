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
				<a href="<?php echo base_url('admin/repositorio?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
					Repositorio | <?php echo $tipo; ?> </a>
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
	</div>

	<!-- end:: Subheader -->

	<!-- begin:: Content -->
	<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
		<?php retro_alimentacion(); ?>
		<!--begin::Portlet-->
		<div class="row">
			<div class="col-10">
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<nav aria-label="breadcrumb">
							  <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/repositorio'); ?>"> <i class="fa fa-home"></i> </a></li>
									<?php if(isset($_GET['categoria'])){ $categoria = $this->GeneralModel->detalles('categorias',['ID_CATEGORIA'=>$_GET['categoria']]);} //var_dump($categoria);?>
			            <?php if(isset($categoria)&&!empty($categoria)){ ?>
			              <!-- CATEGORIAS PADRE -->
			              <?php if($categoria['CATEGORIA_PADRE']!='0'){ ?>
			                <?php $categoria_padre = $this->GeneralModel->detalles('categorias',['ID_CATEGORIA'=>$categoria['CATEGORIA_PADRE']]); ?>
			                <?php if($categoria_padre['CATEGORIA_PADRE']!='0'){ ?>
			                  <?php $categoria_abuelo = $this->GeneralModel->detalles('categorias',['ID_CATEGORIA'=>$categoria_padre['CATEGORIA_PADRE']]); ?>
													<?php if($categoria_abuelo['CATEGORIA_PADRE']!='0'){ ?>
														<?php $categoria_bisabuelo = $this->GeneralModel->detalles('categorias',['ID_CATEGORIA'=>$categoria_abuelo['CATEGORIA_PADRE']]); ?>
														<li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/repositorio?categoria='.$categoria_bisabuelo['ID_CATEGORIA']); ?>" title="<?php echo $categoria_bisabuelo['CATEGORIA_NOMBRE']; ?>"><?php echo character_limiter($categoria_bisabuelo['CATEGORIA_NOMBRE'],10); ?></a></li>
													<?php } ?>
			                  <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/repositorio?categoria='.$categoria_abuelo['ID_CATEGORIA']); ?>" title="<?php echo $categoria_abuelo['CATEGORIA_NOMBRE']; ?>"><?php echo character_limiter($categoria_abuelo['CATEGORIA_NOMBRE'],10); ?></a></li>
			                <?php } ?>
			                <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/repositorio?categoria='.$categoria_padre['ID_CATEGORIA']); ?>" title="<?php echo $categoria_padre['CATEGORIA_NOMBRE']; ?>"><?php echo character_limiter($categoria_padre['CATEGORIA_NOMBRE'],10); ?></a></li>
			              <?php } ?>
			            <?php } ?>
			            <li class="breadcrumb-item active" aria-current="page"><?php echo $categoria['CATEGORIA_NOMBRE']; ?></li>
							  </ol>
							</nav>
						</div>
						<div class="kt-portlet__head-toolbar">
							<form class="form-inline mb-2" action="<?php echo base_url('admin/repositorio'); ?>" method="get">
								<input type="text" class="form-control w-75 mr-2" name="busqueda" placeholder="Buscar..," value="<?php if(isset($_GET['busqueda'])){ echo $this->input->get('busqueda');} ?>">
								<button type="submit" name="button" class="btn btn-primary "> <i class="fa fa-search"></i> </button>
							</form>
						</div>
					</div>
					<div class="kt-portlet__body">
						<!--begin::Section-->
						<div class="kt-section">
							<div class="kt-section__content">
								<div class="contenedor_repositorio"
								data-categoria='<?php echo $consulta['categoria']; ?>'
								data-orden_cat='<?php echo $consulta['orden_cat']; ?>'
								data-busqueda='<?php echo $consulta['busqueda']; ?>'
								>
									<div class="text-center">
										<i class="fa fa-spinner fa-pulse fa-4x"></i>
									</div>
								</div>
							</div>
						</div>
						<!--end::Section-->
					</div>
					<!--end::Form-->
				</div>
			</div>
			<div class="col-2">
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								Herramientas y propiedades
							</h3>
						</div>
					</div>
					<div class="kt-portlet__body">
						<!-- Nueva Carpeta -->
							<button type="button" class="btn btn-outline-success btn-block mb-4" data-toggle="modal" data-target="#nueva_carpeta"><i class="fa fa-folder"></i> Nueva Carpeta</button>
							<div class="modal fade" id="nueva_carpeta" tabindex="-1" role="dialog" aria-labelledby="nueva_carpeta" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLongTitle">Nueva carpeta</h5>
							      </div>
							      <div class="modal-body">
							        <form class="" action="<?php echo base_url('admin/repositorio/crear_carpeta'); ?>" method="post" enctype="multipart/form-data">
												<input type="hidden" name="categoria" value="<?php echo $consulta['categoria']; ?>">
												<input type="hidden" name="orden_cat" value="<?php echo $consulta['orden_cat']; ?>">
												<input type="hidden" name="busqueda" value="<?php echo $consulta['busqueda']; ?>">
							        	<div class="form-group">
													<input type="text" class="form-control" name="NombreCategoria" value="">
							        	</div>
												<button type="submit" class="btn btn-success" name="button">Crear</button>
							        </form>
							      </div>
							    </div>
							  </div>
							</div>
							<!-- Subir archivo de gran tamaño -->
								<button type="button" class="btn btn-warning btn-block mb-4" data-toggle="modal" data-target="#archivo_grande"><i class="fa fa-upload"></i> Subir arhivo (<?php echo ini_get('upload_max_filesize'); ?> max.)</button>
								<div class="modal fade" id="archivo_grande" tabindex="-1" role="dialog" aria-labelledby="archivo_grande" aria-hidden="true">
								  <div class="modal-dialog modal-lg" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title">Subir archivo</h5>
								      </div>
								      <div class="modal-body">
												<div id="mensaje_subir_archivo_pesado"></div>
								        <form class="" action="<?php echo base_url('admin/repositorio/crear_archivo'); ?>" method="post" enctype="multipart/form-data">
													<input type="hidden" name="categoria" value="<?php echo $consulta['categoria']; ?>">
													<input type="hidden" name="orden_cat" value="<?php echo $consulta['orden_cat']; ?>">
													<input type="hidden" name="busqueda" value="<?php echo $consulta['busqueda']; ?>">
													<div class="row">
														<div class="col-4">
															<h4>Generales</h4>
															<div class="form-group">
																<label for="file">Archivo</label>
																<input type="file" class="form-control" name="file" value="" required>
															</div>
															<div class="form-group">
																<label for="Titulo">Titulo (Nombre amigable)</label>
																<input type="text" class="form-control" name="Titulo" value="" required>
															</div>
															<div class="form-group">
																<label for="Cadido">CADIDO</label>
																<input type="text" class="form-control" name="Cadido" value="" required>
															</div>
															<div class="form-group">
																<label for="Nomenclatura">Nomenclatura (Sin espacios ni caracteres especiales)</label>
																<input type="text" class="form-control" name="Nomenclatura" value="" required>
															</div>
															<div class="form-group">
																<label for="Descripcion">Descripción</label>
																<textarea class="form-control" name="Descripcion" rows="5"></textarea>
															</div>
														</div>
														<div class="col-4">
															<h4>Dublin Core</h4>
															<div class="form-group">
																<label for="Tema">Tema (Palabras clave)</label>
																<textarea class="form-control" name="Tema" rows="5"></textarea>
															</div>
															<div class="form-group">
																<label for="TipoRecurso">Tipo de recurso</label>
																<select class="form-control" name="TipoRecurso">
																	<option value="">Selecciona</option>
																	<option value="Pdf">PDF</option>
																	<option value="Epub">Epub</option>
																	<option value="Imagen">Imágen</option>
																	<option value="Infografía">Infografía</option>
																	<option value="Video">Video</option>
																	<option value="Audio">Audio</option>
																</select>
															</div>

															<div class="form-group">
																<label for="Cobertura">Cobertura</label>
																<input type="text" class="form-control" name="Cobertura" value="">
															</div>
															<div class="form-group">
																<label for="Derechos">Derechos</label>
																<textarea class="form-control" name="Derechos" rows="5">ESTA OBRA SE DISTRIBUYE BAJO LOS TÉRMINOS Y CONDICIONES DE LA PRESENTE LICENCIA PÚBLICA DE CREATIVE COMMONS (“CCPL” O “LICENCIA”). LA OBRA ESTÁ PROTEGIDA POR LA LEY DEL DERECHO DE AUTOR Y/O POR CUALQUIER OTRA LEY QUE RESULTE APLICABLE. CUALQUIER USO DISTINTO DEL AUTORIZADO POR LA PRESENTE LICENCIA O POR LA LEY DEL DERECHO DE AUTOR ESTÁ PROHIBIDO.</textarea>
															</div>
														</div>
														<div class="col-4">
															<h4>Prepa en Línea</h4>
															<div class="form-group">
																<label for="TituloCurso">Título del Curso</label>
																<input type="text" class="form-control" name="TituloCurso" value="">
															</div>
															<div class="form-group">
																<label for="PropositoDidactico">Propósito didáctico</label>
																<input type="text" class="form-control" name="PropositoDidactico" value="">
															</div>
															<div class="form-group">
																<label for="UrlEditable">URL del archivo Editable</label>
																<input type="text" class="form-control" name="UrlEditable" value="">
															</div>
														</div>
													</div>
													<hr>
													<button type="submit" class="btn btn-success" name="button" id="boton_subir_archivo_pesado">Subir</button>
								        </form>
								      </div>
								    </div>
								  </div>
								</div>
					</div>
					<!--end::Form-->
				</div>
			</div>
		</div>
		<!--end::Portlet-->
	</div>

	<!-- end:: Content -->
