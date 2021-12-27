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
										<li class="breadcrumb-item active" aria-current="page"><?php echo $categoria['CATEGORIA_NOMBRE']; ?></li>
			            <?php } ?>

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
							<!-- Subir archivo de gran tamaño --><div class="dropdown">
									<button class="btn btn-warning btn-block mb-4 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fa fa-upload"></i> Subir archivo (<?php echo ini_get('upload_max_filesize'); ?> max.)
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<button class="dropdown-item" data-toggle="modal" data-target="#archivo_pdf">PDFs</button>
										<button class="dropdown-item" data-toggle="modal" data-target="#archivo_epub">Epubs</button>
										<button class="dropdown-item" data-toggle="modal" data-target="#archivo_imagenes">Imágenes</button>
										<button class="dropdown-item" data-toggle="modal" data-target="#archivo_infografias">Infografías</button>
										<button class="dropdown-item" data-toggle="modal" data-target="#archivo_videos">Videos</button>
										<button class="dropdown-item" data-toggle="modal" data-target="#archivo_audios">Audios</button>
										<button class="dropdown-item" data-toggle="modal" data-target="#archivo_paginasweb">Páginas web</button>
										<button class="dropdown-item" data-toggle="modal" data-target="#archivo_archivostexto">Archivo de texto</button>
										<button class="dropdown-item" data-toggle="modal" data-target="#archivo_software">Software/Aplicaciónes</button>
									</div>
								</div>
								<!-- PDF -->
								<div class="modal fade" id="archivo_pdf" tabindex="-1" role="dialog" aria-labelledby="archivo_pdf" aria-hidden="true">
								  <div class="modal-dialog modal-lg" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title">Subir archivo PDF</h5>
								      </div>
								      <div class="modal-body">
												<div id="mensaje_subir_archivo_pesado"></div>
								        <form class="" action="<?php echo base_url('admin/repositorio/crear_archivo'); ?>" method="post" enctype="multipart/form-data">
													<input type="hidden" name="categoria" value="<?php echo $consulta['categoria']; ?>">
													<input type="hidden" name="orden_cat" value="<?php echo $consulta['orden_cat']; ?>">
													<input type="hidden" name="busqueda" value="<?php echo $consulta['busqueda']; ?>">
													<input type="hidden" name="TipoRecurso" value="Pdf">
													<div class="row">
														<div class="col">
															<h4>¿Qué necesitas?</h4>
															<ul>
																<li>Archivo del guión original con la solicitud en documento de texto o pdf</li>
																<li>Captura de pantalla de la portada para que funcione como miniatura</li>
																<li>Archivo final en PDF recomendamos un peso máximo de 20Mb</li>
																<li>URL de los archivos editables</li>
															</ul>
															<hr>
															<div class="form-group">
																<label for="ArchivoGuion" data-toggle="tooltip" data-placement="top" title="Escribe los telas de los que trata el archivo">URL del guión original (Google Drive)</label>
																<input type="text" class="form-control" name="ArchivoGuion" value="">
															</div>
															<div class="form-group">
																<label for="Imagen">Imágen miniatura</label>
																<input type="file" id="Imagen" class="form-control" name="Imagen" value="">
															</div>

															<div class="form-group">
																<label for="UrlEditable" data-toggle="tooltip" data-placement="top" title="Escribe los telas de los que trata el archivo">URL de archivos editables (Google Drive)</label>
																<input type="text" class="form-control" name="UrlEditable" value="">
															</div>
															<div class="form-group">
																<label for="file">Archivo Final</label>
																<input type="file" id="Archivo" class="form-control" name="file" value="" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-4">
															<h4>Generales</h4>
															<div class="form-group">
																<label for="Titulo" data-toggle="tooltip" data-placement="top" title="Escribe un título que resuma el contenido del archivo, puedes usar mayúsculas, acentos y signos especiales">Titulo (Nombre amigable)</label>
																<input type="text" class="form-control" name="Titulo" value="" required>
															</div>
															<div class="form-group">
																<label for="Cadido" data-toggle="tooltip" data-placement="top" title="Agrega el código CADIDO del archivo en caso de existir">CADIDO</label>
																<input type="text" class="form-control" name="Cadido" value="" required>
															</div>
															<div class="form-group">
																<label for="Nomenclatura" data-toggle="tooltip" data-placement="top" title="Debería ser igual que el título sin embargo evita los acentos, signos especiales y sustituye los espacios por guión bajo">Nomenclatura (Sin espacios ni caracteres especiales)</label>
																<input type="text" class="form-control" name="Nomenclatura" value="" required>
															</div>
															<div class="form-group">
																<label for="Descripcion" data-toggle="tooltip" data-placement="top" title="Describe con mas detalle el contenido del archivo">Descripción</label>
																<textarea class="form-control" name="Descripcion" rows="5"></textarea>
															</div>
														</div>
														<div class="col-4">
															<h4>Dublin Core</h4>
															<div class="form-group">
																<label for="Tema" data-toggle="tooltip" data-placement="top" title="Escribe los temas de los que trata el archivo">Tema (Palabras clave)</label>
																<textarea class="form-control" id='Tema' name="Tema" rows="5"></textarea>
															</div>

															<div class="form-group">
																<label for="Cobertura" data-toggle="tooltip" data-placement="top" title="Define el espacio o tiempo que cubre el archivo, Ej. 'México siglo XX', si no se conoce la cobertura puede dejarse en blanco">Cobertura</label>
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
																<select  class="form-control" name="TituloCurso" >
																	<option value="">Selecciona curso</option>
																	<?php
																		$cursos = $this->GeneralModel->lista('categorias','',['TIPO_OBJETO'=>'archivo', 'CATEGORIA_PADRE'=>'0'],'CATEGORIA_NOMBRE ASC','','');
																		foreach($cursos as $curso){
																			echo '<option value="'.$curso->CATEGORIA_NOMBRE.'" >'.$curso->CATEGORIA_NOMBRE.'</option>';
																	} ?>
																</select>
															</div>
															<div class="form-group">
																<label for="AreasConocimiento" data-toggle="tooltip" data-placement="top" title="Selecciona las áreas del conocimiento que cubre el archivo">Áreas del conocimiento</label>
																<?php $areas_conocimiento = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'areas_conocimientos'],'','',''); ?>
																<textarea class="form-control" name="AreasConocimiento" id='AreasConocimiento' rows="5"><?php foreach($areas_conocimiento as $areas){ echo $areas->TIPO_NOMBRE.', ';} ?></textarea>
															</div>
															<div class="form-group">
																<label for="PropositoDidactico" data-toggle="tooltip" data-placement="top" title="Descibe el propósito didáctico que busque alcanzar el archivo">Propósito didáctico</label>
																<input type="text" class="form-control" name="PropositoDidactico" value="">
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
								<!-- Epub -->
								<div class="modal fade" id="archivo_epub" tabindex="-1" role="dialog" aria-labelledby="archivo_epub" aria-hidden="true">
								  <div class="modal-dialog modal-lg" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title">Subir archivo EPUB</h5>
								      </div>
								      <div class="modal-body">
												<div id="mensaje_subir_archivo_pesado"></div>
												<form class="" action="<?php echo base_url('admin/repositorio/crear_archivo'); ?>" method="post" enctype="multipart/form-data">
													<input type="hidden" name="categoria" value="<?php echo $consulta['categoria']; ?>">
													<input type="hidden" name="orden_cat" value="<?php echo $consulta['orden_cat']; ?>">
													<input type="hidden" name="busqueda" value="<?php echo $consulta['busqueda']; ?>">
													<input type="hidden" name="TipoRecurso" value="Epub">
													<div class="row">
														<div class="col">
															<h4>¿Qué necesitas?</h4>
															<ul>
																<li>URL del guión original con la solicitud en documento de texto o pdf</li>
																<li>Captura de pantalla de la portada para que funcione como miniatura</li>
																<li>Archivo final en formato EPUB recomendamos un peso máximo de 20Mb</li>
																<li>URL de los archivos editables</li>
															</ul>
															<hr>
															<div class="form-group">
																<label for="ArchivoGuion" data-toggle="tooltip" data-placement="top" title="Escribe los telas de los que trata el archivo">URL del guión original (Google Drive)</label>
																<input type="text" class="form-control" name="ArchivoGuion" value="">
															</div>
															<div class="form-group">
																<label for="Imagen">Imágen miniatura</label>
																<input type="file" id="Imagen" class="form-control" name="Imagen" value="">
															</div>

															<div class="form-group">
																<label for="UrlEditable" data-toggle="tooltip" data-placement="top" title="Escribe los telas de los que trata el archivo">URL de archivos editables (Google Drive)</label>
																<input type="text" class="form-control" name="UrlEditable" value="">
															</div>
															<div class="form-group">
																<label for="file">Archivo Final</label>
																<input type="file" id="Archivo" class="form-control" name="file" value="" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-4">
															<h4>Generales</h4>
															<div class="form-group">
																<label for="Titulo" data-toggle="tooltip" data-placement="top" title="Escribe un título que resuma el contenido del archivo, puedes usar mayúsculas, acentos y signos especiales">Titulo (Nombre amigable)</label>
																<input type="text" class="form-control" name="Titulo" value="" required>
															</div>
															<div class="form-group">
																<label for="Cadido" data-toggle="tooltip" data-placement="top" title="Agrega el código CADIDO del archivo en caso de existir">CADIDO</label>
																<input type="text" class="form-control" name="Cadido" value="" required>
															</div>
															<div class="form-group">
																<label for="Nomenclatura" data-toggle="tooltip" data-placement="top" title="Debería ser igual que el título sin embargo evita los acentos, signos especiales y sustituye los espacios por guión bajo">Nomenclatura (Sin espacios ni caracteres especiales)</label>
																<input type="text" class="form-control" name="Nomenclatura" value="" required>
															</div>
															<div class="form-group">
																<label for="Descripcion" data-toggle="tooltip" data-placement="top" title="Describe con mas detalle el contenido del archivo">Descripción</label>
																<textarea class="form-control" name="Descripcion" rows="5"></textarea>
															</div>
														</div>
														<div class="col-4">
															<h4>Dublin Core</h4>
															<div class="form-group">
																<label for="Tema" data-toggle="tooltip" data-placement="top" title="Escribe los temas de los que trata el archivo">Tema (Palabras clave)</label>
																<textarea class="form-control" id='Tema' name="Tema" rows="5"></textarea>
															</div>

															<div class="form-group">
																<label for="Cobertura" data-toggle="tooltip" data-placement="top" title="Define el espacio o tiempo que cubre el archivo, Ej. 'México siglo XX', si no se conoce la cobertura puede dejarse en blanco">Cobertura</label>
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
																<select  class="form-control" name="TituloCurso" >
																	<option value="">Selecciona curso</option>
																	<?php
																		$cursos = $this->GeneralModel->lista('categorias','',['TIPO_OBJETO'=>'archivo', 'CATEGORIA_PADRE'=>'0'],'CATEGORIA_NOMBRE ASC','','');
																		foreach($cursos as $curso){
																			echo '<option value="'.$curso->CATEGORIA_NOMBRE.'" >'.$curso->CATEGORIA_NOMBRE.'</option>';
																	} ?>
																</select>
															</div>
															<div class="form-group">
																<label for="AreasConocimiento" data-toggle="tooltip" data-placement="top" title="Selecciona las áreas del conocimiento que cubre el archivo">Áreas del conocimiento</label>
																<?php $areas_conocimiento = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'areas_conocimientos'],'','',''); ?>
																<textarea class="form-control" name="AreasConocimiento" id='AreasConocimiento' rows="5"><?php foreach($areas_conocimiento as $areas){ echo $areas->TIPO_NOMBRE.', ';} ?></textarea>
															</div>
															<div class="form-group">
																<label for="PropositoDidactico" data-toggle="tooltip" data-placement="top" title="Descibe el propósito didáctico que busque alcanzar el archivo">Propósito didáctico</label>
																<input type="text" class="form-control" name="PropositoDidactico" value="">
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
								<!-- Imágenes -->
								<div class="modal fade" id="archivo_imagenes" tabindex="-1" role="dialog" aria-labelledby="archivo_imagenes" aria-hidden="true">
								  <div class="modal-dialog modal-lg" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title">Subir archivo de imágen</h5>
								      </div>
											<div class="modal-body">
												<div id="mensaje_subir_archivo_pesado"></div>
												<form class="" action="<?php echo base_url('admin/repositorio/crear_archivo'); ?>" method="post" enctype="multipart/form-data">
													<input type="hidden" name="categoria" value="<?php echo $consulta['categoria']; ?>">
													<input type="hidden" name="orden_cat" value="<?php echo $consulta['orden_cat']; ?>">
													<input type="hidden" name="busqueda" value="<?php echo $consulta['busqueda']; ?>">
													<input type="hidden" name="TipoRecurso" value="Imagen">
													<div class="row">
														<div class="col">
															<h4>¿Qué necesitas?</h4>
															<ul>
																<li>URL del guión original con la solicitud en documento de texto o pdf</li>
																<li>Archivo final en formato JPG, PNG, GIF o TIFF recomendamos un peso máximo de 20Mb</li>
																<li><strong>el tamaño de la imágen no debe superar los 3000 px en ningúna de sus dos dimensiones.</strong></li>
																<li>URL de los archivos editables</li>
															</ul>
															<hr>
															<div class="form-group">
																<label for="ArchivoGuion" data-toggle="tooltip" data-placement="top" title="Escribe los telas de los que trata el archivo">URL del guión original (Google Drive)</label>
																<input type="text" class="form-control" name="ArchivoGuion" value="">
															</div>
																<input type="hidden" id="Imagen" class="form-control" name="Imagen" value="">
															<div class="form-group">
																<label for="UrlEditable" data-toggle="tooltip" data-placement="top" title="Escribe los telas de los que trata el archivo">URL de archivos editables (Google Drive)</label>
																<input type="text" class="form-control" name="UrlEditable" value="">
															</div>
															<div class="form-group">
																<label for="file">Archivo Final</label>
																<input type="file" id="Archivo" class="form-control" name="file" value="" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-4">
															<h4>Generales</h4>
															<div class="form-group">
																<label for="Titulo" data-toggle="tooltip" data-placement="top" title="Escribe un título que resuma el contenido del archivo, puedes usar mayúsculas, acentos y signos especiales">Titulo (Nombre amigable)</label>
																<input type="text" class="form-control" name="Titulo" value="" required>
															</div>
															<div class="form-group">
																<label for="Cadido" data-toggle="tooltip" data-placement="top" title="Agrega el código CADIDO del archivo en caso de existir">CADIDO</label>
																<input type="text" class="form-control" name="Cadido" value="" required>
															</div>
															<div class="form-group">
																<label for="Nomenclatura" data-toggle="tooltip" data-placement="top" title="Debería ser igual que el título sin embargo evita los acentos, signos especiales y sustituye los espacios por guión bajo">Nomenclatura (Sin espacios ni caracteres especiales)</label>
																<input type="text" class="form-control" name="Nomenclatura" value="" required>
															</div>
															<div class="form-group">
																<label for="Descripcion" data-toggle="tooltip" data-placement="top" title="Describe con mas detalle el contenido del archivo">Descripción</label>
																<textarea class="form-control" name="Descripcion" rows="5"></textarea>
															</div>
														</div>
														<div class="col-4">
															<h4>Dublin Core</h4>
															<div class="form-group">
																<label for="Tema" data-toggle="tooltip" data-placement="top" title="Escribe los temas de los que trata el archivo">Tema (Palabras clave)</label>
																<textarea class="form-control" id='Tema' name="Tema" rows="5"></textarea>
															</div>

															<div class="form-group">
																<label for="Cobertura" data-toggle="tooltip" data-placement="top" title="Define el espacio o tiempo que cubre el archivo, Ej. 'México siglo XX', si no se conoce la cobertura puede dejarse en blanco">Cobertura</label>
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
																<select  class="form-control" name="TituloCurso" >
																	<option value="">Selecciona curso</option>
																	<?php
																		$cursos = $this->GeneralModel->lista('categorias','',['TIPO_OBJETO'=>'archivo', 'CATEGORIA_PADRE'=>'0'],'CATEGORIA_NOMBRE ASC','','');
																		foreach($cursos as $curso){
																			echo '<option value="'.$curso->CATEGORIA_NOMBRE.'" >'.$curso->CATEGORIA_NOMBRE.'</option>';
																	} ?>
																</select>
															</div>
															<div class="form-group">
																<label for="AreasConocimiento" data-toggle="tooltip" data-placement="top" title="Selecciona las áreas del conocimiento que cubre el archivo">Áreas del conocimiento</label>
																<?php $areas_conocimiento = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'areas_conocimientos'],'','',''); ?>
																<textarea class="form-control" name="AreasConocimiento" id='AreasConocimiento' rows="5"><?php foreach($areas_conocimiento as $areas){ echo $areas->TIPO_NOMBRE.', ';} ?></textarea>
															</div>
															<div class="form-group">
																<label for="PropositoDidactico" data-toggle="tooltip" data-placement="top" title="Descibe el propósito didáctico que busque alcanzar el archivo">Propósito didáctico</label>
																<input type="text" class="form-control" name="PropositoDidactico" value="">
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
								<!-- Infografías -->
								<div class="modal fade" id="archivo_infografias" tabindex="-1" role="dialog" aria-labelledby="archivo_infografias" aria-hidden="true">
								  <div class="modal-dialog modal-lg" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title">Subir archivo Infografía</h5>
								      </div>
											<div class="modal-body">
												<div id="mensaje_subir_archivo_pesado"></div>
												<form class="" action="<?php echo base_url('admin/repositorio/crear_archivo'); ?>" method="post" enctype="multipart/form-data">
													<input type="hidden" name="categoria" value="<?php echo $consulta['categoria']; ?>">
													<input type="hidden" name="orden_cat" value="<?php echo $consulta['orden_cat']; ?>">
													<input type="hidden" name="busqueda" value="<?php echo $consulta['busqueda']; ?>">
													<input type="hidden" name="TipoRecurso" value="Epub">
													<div class="row">
														<div class="col">
															<h4>¿Qué necesitas?</h4>
															<ul>
																<li>URL del guión original con la solicitud en documento de texto o pdf</li>
																<li>Archivo final en formato JPG, PNG, GIF, TIFF recomendamos un peso máximo de 20Mb</li>
																<li>Ya que las infografías pueden llegar a ser muy grandes o extensas es importante tener una versión mas pequeña o recortada para que funcione como miniatura</li>
																<li>URL de los archivos editables</li>
															</ul>
															<hr>
															<div class="form-group">
																<label for="ArchivoGuion" data-toggle="tooltip" data-placement="top" title="Escribe los telas de los que trata el archivo">URL del guión original (Google Drive)</label>
																<input type="text" class="form-control" name="ArchivoGuion" value="">
															</div>
															<div class="form-group">
																<label for="Imagen">Imágen miniatura</label>
																<input type="file" id="Imagen" class="form-control" name="Imagen" value="">
															</div>

															<div class="form-group">
																<label for="UrlEditable" data-toggle="tooltip" data-placement="top" title="Escribe los telas de los que trata el archivo">URL de archivos editables (Google Drive)</label>
																<input type="text" class="form-control" name="UrlEditable" value="">
															</div>
															<div class="form-group">
																<label for="file">Archivo Final</label>
																<input type="file" id="Archivo" class="form-control" name="file" value="" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-4">
															<h4>Generales</h4>
															<div class="form-group">
																<label for="Titulo" data-toggle="tooltip" data-placement="top" title="Escribe un título que resuma el contenido del archivo, puedes usar mayúsculas, acentos y signos especiales">Titulo (Nombre amigable)</label>
																<input type="text" class="form-control" name="Titulo" value="" required>
															</div>
															<div class="form-group">
																<label for="Cadido" data-toggle="tooltip" data-placement="top" title="Agrega el código CADIDO del archivo en caso de existir">CADIDO</label>
																<input type="text" class="form-control" name="Cadido" value="" required>
															</div>
															<div class="form-group">
																<label for="Nomenclatura" data-toggle="tooltip" data-placement="top" title="Debería ser igual que el título sin embargo evita los acentos, signos especiales y sustituye los espacios por guión bajo">Nomenclatura (Sin espacios ni caracteres especiales)</label>
																<input type="text" class="form-control" name="Nomenclatura" value="" required>
															</div>
															<div class="form-group">
																<label for="Descripcion" data-toggle="tooltip" data-placement="top" title="Describe con mas detalle el contenido del archivo">Descripción</label>
																<textarea class="form-control" name="Descripcion" rows="5"></textarea>
															</div>
														</div>
														<div class="col-4">
															<h4>Dublin Core</h4>
															<div class="form-group">
																<label for="Tema" data-toggle="tooltip" data-placement="top" title="Escribe los temas de los que trata el archivo">Tema (Palabras clave)</label>
																<textarea class="form-control" id='Tema' name="Tema" rows="5"></textarea>
															</div>

															<div class="form-group">
																<label for="Cobertura" data-toggle="tooltip" data-placement="top" title="Define el espacio o tiempo que cubre el archivo, Ej. 'México siglo XX', si no se conoce la cobertura puede dejarse en blanco">Cobertura</label>
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
																<select  class="form-control" name="TituloCurso" >
																	<option value="">Selecciona curso</option>
																	<?php
																		$cursos = $this->GeneralModel->lista('categorias','',['TIPO_OBJETO'=>'archivo', 'CATEGORIA_PADRE'=>'0'],'CATEGORIA_NOMBRE ASC','','');
																		foreach($cursos as $curso){
																			echo '<option value="'.$curso->CATEGORIA_NOMBRE.'" >'.$curso->CATEGORIA_NOMBRE.'</option>';
																	} ?>
																</select>
															</div>
															<div class="form-group">
																<label for="AreasConocimiento" data-toggle="tooltip" data-placement="top" title="Selecciona las áreas del conocimiento que cubre el archivo">Áreas del conocimiento</label>
																<?php $areas_conocimiento = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'areas_conocimientos'],'','',''); ?>
																<textarea class="form-control" name="AreasConocimiento" id='AreasConocimiento' rows="5"><?php foreach($areas_conocimiento as $areas){ echo $areas->TIPO_NOMBRE.', ';} ?></textarea>
															</div>
															<div class="form-group">
																<label for="PropositoDidactico" data-toggle="tooltip" data-placement="top" title="Descibe el propósito didáctico que busque alcanzar el archivo">Propósito didáctico</label>
																<input type="text" class="form-control" name="PropositoDidactico" value="">
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
								<!-- Videos -->
								<div class="modal fade" id="archivo_videos" tabindex="-1" role="dialog" aria-labelledby="archivo_videos" aria-hidden="true">
								  <div class="modal-dialog modal-lg" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title">Subir Videos de YouTube</h5>
								      </div>
											<div class="modal-body">
												<div id="mensaje_subir_archivo_pesado"></div>
												<form class="" action="<?php echo base_url('admin/repositorio/crear_archivo'); ?>" method="post" enctype="multipart/form-data">
													<input type="hidden" name="categoria" value="<?php echo $consulta['categoria']; ?>">
													<input type="hidden" name="orden_cat" value="<?php echo $consulta['orden_cat']; ?>">
													<input type="hidden" name="busqueda" value="<?php echo $consulta['busqueda']; ?>">
													<input type="hidden" name="TipoRecurso" value="Video">
													<div class="row">
														<div class="col">
															<h4>¿Qué necesitas?</h4>
															<ul>
																<li>URL del guión original con la solicitud en documento de texto o pdf</li>
																<li>Enlace del video publicado en YouTube</li>
																<li>URL de los archivos editables</li>
															</ul>
															<hr>
															<div class="form-group">
																<label for="ArchivoGuion" data-toggle="tooltip" data-placement="top" title="Escribe los telas de los que trata el archivo">URL del guión original (Google Drive)</label>
																<input type="text" class="form-control" name="ArchivoGuion" value="">
															</div>
																<input type="hidden" id="Imagen" class="form-control" name="Imagen" value="">

															<div class="form-group">
																<label for="UrlEditable" data-toggle="tooltip" data-placement="top" title="Escribe los telas de los que trata el archivo">URL de archivos editables (Google Drive)</label>
																<input type="text" class="form-control" name="UrlEditable" value="">
															</div>
															<div class="form-group">
																<label for="file">Archivo Final (Enlace Youtube)</label>
																<input type="text" id="Archivo" class="form-control" name="file" value="" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-4">
															<h4>Generales</h4>
															<div class="form-group">
																<label for="Titulo" data-toggle="tooltip" data-placement="top" title="Escribe un título que resuma el contenido del archivo, puedes usar mayúsculas, acentos y signos especiales">Titulo (Nombre amigable)</label>
																<input type="text" class="form-control" name="Titulo" value="" required>
															</div>
															<div class="form-group">
																<label for="Cadido" data-toggle="tooltip" data-placement="top" title="Agrega el código CADIDO del archivo en caso de existir">CADIDO</label>
																<input type="text" class="form-control" name="Cadido" value="" required>
															</div>
															<div class="form-group">
																<label for="Nomenclatura" data-toggle="tooltip" data-placement="top" title="Debería ser igual que el título sin embargo evita los acentos, signos especiales y sustituye los espacios por guión bajo">Nomenclatura (Sin espacios ni caracteres especiales)</label>
																<input type="text" class="form-control" name="Nomenclatura" value="" required>
															</div>
															<div class="form-group">
																<label for="Descripcion" data-toggle="tooltip" data-placement="top" title="Describe con mas detalle el contenido del archivo">Descripción</label>
																<textarea class="form-control" name="Descripcion" rows="5"></textarea>
															</div>
														</div>
														<div class="col-4">
															<h4>Dublin Core</h4>
															<div class="form-group">
																<label for="Tema" data-toggle="tooltip" data-placement="top" title="Escribe los temas de los que trata el archivo">Tema (Palabras clave)</label>
																<textarea class="form-control" id='Tema' name="Tema" rows="5"></textarea>
															</div>

															<div class="form-group">
																<label for="Cobertura" data-toggle="tooltip" data-placement="top" title="Define el espacio o tiempo que cubre el archivo, Ej. 'México siglo XX', si no se conoce la cobertura puede dejarse en blanco">Cobertura</label>
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
																<select  class="form-control" name="TituloCurso" >
																	<option value="">Selecciona curso</option>
																	<?php
																		$cursos = $this->GeneralModel->lista('categorias','',['TIPO_OBJETO'=>'archivo', 'CATEGORIA_PADRE'=>'0'],'CATEGORIA_NOMBRE ASC','','');
																		foreach($cursos as $curso){
																			echo '<option value="'.$curso->CATEGORIA_NOMBRE.'" >'.$curso->CATEGORIA_NOMBRE.'</option>';
																	} ?>
																</select>
															</div>
															<div class="form-group">
																<label for="AreasConocimiento" data-toggle="tooltip" data-placement="top" title="Selecciona las áreas del conocimiento que cubre el archivo">Áreas del conocimiento</label>
																<?php $areas_conocimiento = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'areas_conocimientos'],'','',''); ?>
																<textarea class="form-control" name="AreasConocimiento" id='AreasConocimiento' rows="5"><?php foreach($areas_conocimiento as $areas){ echo $areas->TIPO_NOMBRE.', ';} ?></textarea>
															</div>
															<div class="form-group">
																<label for="PropositoDidactico" data-toggle="tooltip" data-placement="top" title="Descibe el propósito didáctico que busque alcanzar el archivo">Propósito didáctico</label>
																<input type="text" class="form-control" name="PropositoDidactico" value="">
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
								<!-- Audios -->
								<div class="modal fade" id="archivo_audios" tabindex="-1" role="dialog" aria-labelledby="archivo_audios" aria-hidden="true">
								  <div class="modal-dialog modal-lg" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title">Subir archivo de audio</h5>
								      </div>
											<div class="modal-body">
												<div id="mensaje_subir_archivo_pesado"></div>
												<form class="" action="<?php echo base_url('admin/repositorio/crear_archivo'); ?>" method="post" enctype="multipart/form-data">
													<input type="hidden" name="categoria" value="<?php echo $consulta['categoria']; ?>">
													<input type="hidden" name="orden_cat" value="<?php echo $consulta['orden_cat']; ?>">
													<input type="hidden" name="busqueda" value="<?php echo $consulta['busqueda']; ?>">
													<input type="hidden" name="TipoRecurso" value="Audio">
													<div class="row">
														<div class="col">
															<h4>¿Qué necesitas?</h4>
															<ul>
																<li>URL del guión original con la solicitud en documento de texto o pdf</li>
																<li>Imágen representativa para que funcione como miniatura</li>
																<li>Archivo final en formato MP3, WAV o AAC  recomendamos un peso máximo de 20Mb</li>
																<li>URL de los archivos editables</li>
															</ul>
															<hr>
															<div class="form-group">
																<label for="ArchivoGuion" data-toggle="tooltip" data-placement="top" title="Escribe los telas de los que trata el archivo">URL del guión original (Google Drive)</label>
																<input type="text" class="form-control" name="ArchivoGuion" value="">
															</div>
															<div class="form-group">
																<label for="Imagen">Imágen miniatura</label>
																<input type="file" id="Imagen" class="form-control" name="Imagen" value="">
															</div>

															<div class="form-group">
																<label for="UrlEditable" data-toggle="tooltip" data-placement="top" title="Escribe los telas de los que trata el archivo">URL de archivos editables (Google Drive)</label>
																<input type="text" class="form-control" name="UrlEditable" value="">
															</div>
															<div class="form-group">
																<label for="file">Archivo Final</label>
																<input type="file" id="Archivo" class="form-control" name="file" value="" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-4">
															<h4>Generales</h4>
															<div class="form-group">
																<label for="Titulo" data-toggle="tooltip" data-placement="top" title="Escribe un título que resuma el contenido del archivo, puedes usar mayúsculas, acentos y signos especiales">Titulo (Nombre amigable)</label>
																<input type="text" class="form-control" name="Titulo" value="" required>
															</div>
															<div class="form-group">
																<label for="Cadido" data-toggle="tooltip" data-placement="top" title="Agrega el código CADIDO del archivo en caso de existir">CADIDO</label>
																<input type="text" class="form-control" name="Cadido" value="" required>
															</div>
															<div class="form-group">
																<label for="Nomenclatura" data-toggle="tooltip" data-placement="top" title="Debería ser igual que el título sin embargo evita los acentos, signos especiales y sustituye los espacios por guión bajo">Nomenclatura (Sin espacios ni caracteres especiales)</label>
																<input type="text" class="form-control" name="Nomenclatura" value="" required>
															</div>
															<div class="form-group">
																<label for="Descripcion" data-toggle="tooltip" data-placement="top" title="Describe con mas detalle el contenido del archivo">Descripción</label>
																<textarea class="form-control" name="Descripcion" rows="5"></textarea>
															</div>
														</div>
														<div class="col-4">
															<h4>Dublin Core</h4>
															<div class="form-group">
																<label for="Tema" data-toggle="tooltip" data-placement="top" title="Escribe los temas de los que trata el archivo">Tema (Palabras clave)</label>
																<textarea class="form-control" id='Tema' name="Tema" rows="5"></textarea>
															</div>

															<div class="form-group">
																<label for="Cobertura" data-toggle="tooltip" data-placement="top" title="Define el espacio o tiempo que cubre el archivo, Ej. 'México siglo XX', si no se conoce la cobertura puede dejarse en blanco">Cobertura</label>
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
																<select  class="form-control" name="TituloCurso" >
																	<option value="">Selecciona curso</option>
																	<?php
																		$cursos = $this->GeneralModel->lista('categorias','',['TIPO_OBJETO'=>'archivo', 'CATEGORIA_PADRE'=>'0'],'CATEGORIA_NOMBRE ASC','','');
																		foreach($cursos as $curso){
																			echo '<option value="'.$curso->CATEGORIA_NOMBRE.'" >'.$curso->CATEGORIA_NOMBRE.'</option>';
																	} ?>
																</select>
															</div>
															<div class="form-group">
																<label for="AreasConocimiento" data-toggle="tooltip" data-placement="top" title="Selecciona las áreas del conocimiento que cubre el archivo">Áreas del conocimiento</label>
																<?php $areas_conocimiento = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'areas_conocimientos'],'','',''); ?>
																<textarea class="form-control" name="AreasConocimiento" id='AreasConocimiento' rows="5"><?php foreach($areas_conocimiento as $areas){ echo $areas->TIPO_NOMBRE.', ';} ?></textarea>
															</div>
															<div class="form-group">
																<label for="PropositoDidactico" data-toggle="tooltip" data-placement="top" title="Descibe el propósito didáctico que busque alcanzar el archivo">Propósito didáctico</label>
																<input type="text" class="form-control" name="PropositoDidactico" value="">
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
								<!-- Páginas web -->
								<div class="modal fade" id="archivo_paginasweb" tabindex="-1" role="dialog" aria-labelledby="archivo_paginasweb" aria-hidden="true">
								  <div class="modal-dialog modal-lg" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title">Subir archivo Página web, HTML o SCORM</h5>
								      </div>
											<div class="modal-body">
												<div id="mensaje_subir_archivo_pesado"></div>
												<form class="" action="<?php echo base_url('admin/repositorio/crear_archivo'); ?>" method="post" enctype="multipart/form-data">
													<input type="hidden" name="categoria" value="<?php echo $consulta['categoria']; ?>">
													<input type="hidden" name="orden_cat" value="<?php echo $consulta['orden_cat']; ?>">
													<input type="hidden" name="busqueda" value="<?php echo $consulta['busqueda']; ?>">
													<input type="hidden" name="TipoRecurso" value="Página web">
													<div class="row">
														<div class="col">
															<h4>¿Qué necesitas?</h4>
															<ul>
																<li>URL del guión original con la solicitud en documento de texto o pdf</li>
																<li>Captura de pantalla para que funcione como miniatura</li>
																<li>Archivo final en formato ZIP que contenga todas los archivos, imágenes anexos que pueda requerir el archivo, recomendamos un peso máximo de 20Mb</li>
																<li>URL de los archivos editables</li>
															</ul>
															<hr>
															<div class="form-group">
																<label for="ArchivoGuion" data-toggle="tooltip" data-placement="top" title="Escribe los telas de los que trata el archivo">URL del guión original (Google Drive)</label>
																<input type="text" class="form-control" name="ArchivoGuion" value="">
															</div>
															<div class="form-group">
																<label for="Imagen">Imágen miniatura</label>
																<input type="file" id="Imagen" class="form-control" name="Imagen" value="">
															</div>

															<div class="form-group">
																<label for="UrlEditable" data-toggle="tooltip" data-placement="top" title="Escribe los telas de los que trata el archivo">URL de archivos editables (Google Drive)</label>
																<input type="text" class="form-control" name="UrlEditable" value="">
															</div>
															<div class="form-group">
																<label for="file">Archivo Final</label>
																<input type="file" id="Archivo" class="form-control" name="file" value="" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-4">
															<h4>Generales</h4>
															<div class="form-group">
																<label for="Titulo" data-toggle="tooltip" data-placement="top" title="Escribe un título que resuma el contenido del archivo, puedes usar mayúsculas, acentos y signos especiales">Titulo (Nombre amigable)</label>
																<input type="text" class="form-control" name="Titulo" value="" required>
															</div>
															<div class="form-group">
																<label for="Cadido" data-toggle="tooltip" data-placement="top" title="Agrega el código CADIDO del archivo en caso de existir">CADIDO</label>
																<input type="text" class="form-control" name="Cadido" value="" required>
															</div>
															<div class="form-group">
																<label for="Nomenclatura" data-toggle="tooltip" data-placement="top" title="Debería ser igual que el título sin embargo evita los acentos, signos especiales y sustituye los espacios por guión bajo">Nomenclatura (Sin espacios ni caracteres especiales)</label>
																<input type="text" class="form-control" name="Nomenclatura" value="" required>
															</div>
															<div class="form-group">
																<label for="Descripcion" data-toggle="tooltip" data-placement="top" title="Describe con mas detalle el contenido del archivo">Descripción</label>
																<textarea class="form-control" name="Descripcion" rows="5"></textarea>
															</div>
														</div>
														<div class="col-4">
															<h4>Dublin Core</h4>
															<div class="form-group">
																<label for="Tema" data-toggle="tooltip" data-placement="top" title="Escribe los temas de los que trata el archivo">Tema (Palabras clave)</label>
																<textarea class="form-control" id='Tema' name="Tema" rows="5"></textarea>
															</div>

															<div class="form-group">
																<label for="Cobertura" data-toggle="tooltip" data-placement="top" title="Define el espacio o tiempo que cubre el archivo, Ej. 'México siglo XX', si no se conoce la cobertura puede dejarse en blanco">Cobertura</label>
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
																<select  class="form-control" name="TituloCurso" >
																	<option value="">Selecciona curso</option>
																	<?php
																		$cursos = $this->GeneralModel->lista('categorias','',['TIPO_OBJETO'=>'archivo', 'CATEGORIA_PADRE'=>'0'],'CATEGORIA_NOMBRE ASC','','');
																		foreach($cursos as $curso){
																			echo '<option value="'.$curso->CATEGORIA_NOMBRE.'" >'.$curso->CATEGORIA_NOMBRE.'</option>';
																	} ?>
																</select>
															</div>
															<div class="form-group">
																<label for="AreasConocimiento" data-toggle="tooltip" data-placement="top" title="Selecciona las áreas del conocimiento que cubre el archivo">Áreas del conocimiento</label>
																<?php $areas_conocimiento = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'areas_conocimientos'],'','',''); ?>
																<textarea class="form-control" name="AreasConocimiento" id='AreasConocimiento' rows="5"><?php foreach($areas_conocimiento as $areas){ echo $areas->TIPO_NOMBRE.', ';} ?></textarea>
															</div>
															<div class="form-group">
																<label for="PropositoDidactico" data-toggle="tooltip" data-placement="top" title="Descibe el propósito didáctico que busque alcanzar el archivo">Propósito didáctico</label>
																<input type="text" class="form-control" name="PropositoDidactico" value="">
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
								<!-- Archivo de texto -->
								<div class="modal fade" id="archivo_presentacion" tabindex="-1" role="dialog" aria-labelledby="archivo_presentacion" aria-hidden="true">
								  <div class="modal-dialog modal-lg" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title">Subir archivo de presentaciones</h5>
								      </div>
											<div class="modal-body">
												<div id="mensaje_subir_archivo_pesado"></div>
												<form class="" action="<?php echo base_url('admin/repositorio/crear_archivo'); ?>" method="post" enctype="multipart/form-data">
													<input type="hidden" name="categoria" value="<?php echo $consulta['categoria']; ?>">
													<input type="hidden" name="orden_cat" value="<?php echo $consulta['orden_cat']; ?>">
													<input type="hidden" name="busqueda" value="<?php echo $consulta['busqueda']; ?>">
													<input type="hidden" name="TipoRecurso" value="Presentación">
													<div class="row">
														<div class="col">
															<h4>¿Qué necesitas?</h4>
															<ul>
																<li>URL del guión original con la solicitud en documento de texto o pdf</li>
																<li>Captura de pantalla para que funcione como miniatura</li>
																<li>Archivo final en formato PPT o PPTX recomendamos un peso máximo de 20Mb</li>
																<li>URL de los archivos editables</li>
															</ul>
															<hr>
															<div class="form-group">
																<label for="ArchivoGuion" data-toggle="tooltip" data-placement="top" title="Escribe los telas de los que trata el archivo">URL del guión original (Google Drive)</label>
																<input type="text" class="form-control" name="ArchivoGuion" value="">
															</div>
															<div class="form-group">
																<label for="Imagen">Imágen miniatura</label>
																<input type="file" id="Imagen" class="form-control" name="Imagen" value="">
															</div>

															<div class="form-group">
																<label for="UrlEditable" data-toggle="tooltip" data-placement="top" title="Escribe los telas de los que trata el archivo">URL de archivos editables (Google Drive)</label>
																<input type="text" class="form-control" name="UrlEditable" value="">
															</div>
															<div class="form-group">
																<label for="file">Archivo Final</label>
																<input type="file" id="Archivo" class="form-control" name="file" value="" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-4">
															<h4>Generales</h4>
															<div class="form-group">
																<label for="Titulo" data-toggle="tooltip" data-placement="top" title="Escribe un título que resuma el contenido del archivo, puedes usar mayúsculas, acentos y signos especiales">Titulo (Nombre amigable)</label>
																<input type="text" class="form-control" name="Titulo" value="" required>
															</div>
															<div class="form-group">
																<label for="Cadido" data-toggle="tooltip" data-placement="top" title="Agrega el código CADIDO del archivo en caso de existir">CADIDO</label>
																<input type="text" class="form-control" name="Cadido" value="" required>
															</div>
															<div class="form-group">
																<label for="Nomenclatura" data-toggle="tooltip" data-placement="top" title="Debería ser igual que el título sin embargo evita los acentos, signos especiales y sustituye los espacios por guión bajo">Nomenclatura (Sin espacios ni caracteres especiales)</label>
																<input type="text" class="form-control" name="Nomenclatura" value="" required>
															</div>
															<div class="form-group">
																<label for="Descripcion" data-toggle="tooltip" data-placement="top" title="Describe con mas detalle el contenido del archivo">Descripción</label>
																<textarea class="form-control" name="Descripcion" rows="5"></textarea>
															</div>
														</div>
														<div class="col-4">
															<h4>Dublin Core</h4>
															<div class="form-group">
																<label for="Tema" data-toggle="tooltip" data-placement="top" title="Escribe los temas de los que trata el archivo">Tema (Palabras clave)</label>
																<textarea class="form-control" id='Tema' name="Tema" rows="5"></textarea>
															</div>

															<div class="form-group">
																<label for="Cobertura" data-toggle="tooltip" data-placement="top" title="Define el espacio o tiempo que cubre el archivo, Ej. 'México siglo XX', si no se conoce la cobertura puede dejarse en blanco">Cobertura</label>
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
																<select  class="form-control" name="TituloCurso" >
																	<option value="">Selecciona curso</option>
																	<?php
																		$cursos = $this->GeneralModel->lista('categorias','',['TIPO_OBJETO'=>'archivo', 'CATEGORIA_PADRE'=>'0'],'CATEGORIA_NOMBRE ASC','','');
																		foreach($cursos as $curso){
																			echo '<option value="'.$curso->CATEGORIA_NOMBRE.'" >'.$curso->CATEGORIA_NOMBRE.'</option>';
																	} ?>
																</select>
															</div>
															<div class="form-group">
																<label for="AreasConocimiento" data-toggle="tooltip" data-placement="top" title="Selecciona las áreas del conocimiento que cubre el archivo">Áreas del conocimiento</label>
																<?php $areas_conocimiento = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'areas_conocimientos'],'','',''); ?>
																<textarea class="form-control" name="AreasConocimiento" id='AreasConocimiento' rows="5"><?php foreach($areas_conocimiento as $areas){ echo $areas->TIPO_NOMBRE.', ';} ?></textarea>
															</div>
															<div class="form-group">
																<label for="PropositoDidactico" data-toggle="tooltip" data-placement="top" title="Descibe el propósito didáctico que busque alcanzar el archivo">Propósito didáctico</label>
																<input type="text" class="form-control" name="PropositoDidactico" value="">
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
								<!-- Archivo de texto -->
								<div class="modal fade" id="archivo_archivostexto" tabindex="-1" role="dialog" aria-labelledby="archivo_archivostexto" aria-hidden="true">
								  <div class="modal-dialog modal-lg" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title">Subir archivo de texto</h5>
								      </div>
											<div class="modal-body">
												<div id="mensaje_subir_archivo_pesado"></div>
												<form class="" action="<?php echo base_url('admin/repositorio/crear_archivo'); ?>" method="post" enctype="multipart/form-data">
													<input type="hidden" name="categoria" value="<?php echo $consulta['categoria']; ?>">
													<input type="hidden" name="orden_cat" value="<?php echo $consulta['orden_cat']; ?>">
													<input type="hidden" name="busqueda" value="<?php echo $consulta['busqueda']; ?>">
													<input type="hidden" name="TipoRecurso" value="Archivos de texto">
													<div class="row">
														<div class="col">
															<h4>¿Qué necesitas?</h4>
															<ul>
																<li>URL del guión original con la solicitud en documento de texto o pdf</li>
																<li>Captura de pantalla para que funcione como miniatura</li>
																<li>Archivo final en formato DOC o DOCX recomendamos un peso máximo de 20Mb</li>
																<li>URL de los archivos editables</li>
															</ul>
															<hr>
															<div class="form-group">
																<label for="ArchivoGuion" data-toggle="tooltip" data-placement="top" title="Escribe los telas de los que trata el archivo">URL del guión original (Google Drive)</label>
																<input type="text" class="form-control" name="ArchivoGuion" value="">
															</div>
															<div class="form-group">
																<label for="Imagen">Imágen miniatura</label>
																<input type="file" id="Imagen" class="form-control" name="Imagen" value="">
															</div>

															<div class="form-group">
																<label for="UrlEditable" data-toggle="tooltip" data-placement="top" title="Escribe los telas de los que trata el archivo">URL de archivos editables (Google Drive)</label>
																<input type="text" class="form-control" name="UrlEditable" value="">
															</div>
															<div class="form-group">
																<label for="file">Archivo Final</label>
																<input type="file" id="Archivo" class="form-control" name="file" value="" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-4">
															<h4>Generales</h4>
															<div class="form-group">
																<label for="Titulo" data-toggle="tooltip" data-placement="top" title="Escribe un título que resuma el contenido del archivo, puedes usar mayúsculas, acentos y signos especiales">Titulo (Nombre amigable)</label>
																<input type="text" class="form-control" name="Titulo" value="" required>
															</div>
															<div class="form-group">
																<label for="Cadido" data-toggle="tooltip" data-placement="top" title="Agrega el código CADIDO del archivo en caso de existir">CADIDO</label>
																<input type="text" class="form-control" name="Cadido" value="" required>
															</div>
															<div class="form-group">
																<label for="Nomenclatura" data-toggle="tooltip" data-placement="top" title="Debería ser igual que el título sin embargo evita los acentos, signos especiales y sustituye los espacios por guión bajo">Nomenclatura (Sin espacios ni caracteres especiales)</label>
																<input type="text" class="form-control" name="Nomenclatura" value="" required>
															</div>
															<div class="form-group">
																<label for="Descripcion" data-toggle="tooltip" data-placement="top" title="Describe con mas detalle el contenido del archivo">Descripción</label>
																<textarea class="form-control" name="Descripcion" rows="5"></textarea>
															</div>
														</div>
														<div class="col-4">
															<h4>Dublin Core</h4>
															<div class="form-group">
																<label for="Tema" data-toggle="tooltip" data-placement="top" title="Escribe los temas de los que trata el archivo">Tema (Palabras clave)</label>
																<textarea class="form-control" id='Tema' name="Tema" rows="5"></textarea>
															</div>

															<div class="form-group">
																<label for="Cobertura" data-toggle="tooltip" data-placement="top" title="Define el espacio o tiempo que cubre el archivo, Ej. 'México siglo XX', si no se conoce la cobertura puede dejarse en blanco">Cobertura</label>
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
																<select  class="form-control" name="TituloCurso" >
																	<option value="">Selecciona curso</option>
																	<?php
																		$cursos = $this->GeneralModel->lista('categorias','',['TIPO_OBJETO'=>'archivo', 'CATEGORIA_PADRE'=>'0'],'CATEGORIA_NOMBRE ASC','','');
																		foreach($cursos as $curso){
																			echo '<option value="'.$curso->CATEGORIA_NOMBRE.'" >'.$curso->CATEGORIA_NOMBRE.'</option>';
																	} ?>
																</select>
															</div>
															<div class="form-group">
																<label for="AreasConocimiento" data-toggle="tooltip" data-placement="top" title="Selecciona las áreas del conocimiento que cubre el archivo">Áreas del conocimiento</label>
																<?php $areas_conocimiento = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'areas_conocimientos'],'','',''); ?>
																<textarea class="form-control" name="AreasConocimiento" id='AreasConocimiento' rows="5"><?php foreach($areas_conocimiento as $areas){ echo $areas->TIPO_NOMBRE.', ';} ?></textarea>
															</div>
															<div class="form-group">
																<label for="PropositoDidactico" data-toggle="tooltip" data-placement="top" title="Descibe el propósito didáctico que busque alcanzar el archivo">Propósito didáctico</label>
																<input type="text" class="form-control" name="PropositoDidactico" value="">
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
								<!-- Software -->
								<div class="modal fade" id="archivo_software" tabindex="-1" role="dialog" aria-labelledby="archivo_software" aria-hidden="true">
								  <div class="modal-dialog modal-lg" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title">Subir sowftware o aplicaciones</h5>
								      </div>
											<div class="modal-body">
												<div id="mensaje_subir_archivo_pesado"></div>
												<form class="" action="<?php echo base_url('admin/repositorio/crear_archivo'); ?>" method="post" enctype="multipart/form-data">
													<input type="hidden" name="categoria" value="<?php echo $consulta['categoria']; ?>">
													<input type="hidden" name="orden_cat" value="<?php echo $consulta['orden_cat']; ?>">
													<input type="hidden" name="busqueda" value="<?php echo $consulta['busqueda']; ?>">
													<input type="hidden" name="TipoRecurso" value="Software/Aplicación">
													<div class="row">
														<div class="col">
															<h4>¿Qué necesitas?</h4>
															<ul>
																<li>URL del guión original con la solicitud en documento de texto o pdf</li>
																<li>Captura de pantalla para que funcione como miniatura</li>
																<li>Archivos EXE o MSI comprimidos en un archivo ZIP con contraseña para descomprimir recomendamos un peso máximo de 20Mb</li>
																<li>La contraseña debe ser agregada en la descripción para que sea accesible por los usuarios que lo descarguen</li>
																<li>URL de los archivos editables</li>
															</ul>
															<hr>
															<div class="form-group">
																<label for="ArchivoGuion" data-toggle="tooltip" data-placement="top" title="Escribe los telas de los que trata el archivo">URL del guión original (Google Drive)</label>
																<input type="text" class="form-control" name="ArchivoGuion" value="">
															</div>
															<div class="form-group">
																<label for="Imagen">Imágen miniatura</label>
																<input type="file" id="Imagen" class="form-control" name="Imagen" value="">
															</div>

															<div class="form-group">
																<label for="UrlEditable" data-toggle="tooltip" data-placement="top" title="Escribe los telas de los que trata el archivo">URL de archivos editables (Google Drive)</label>
																<input type="text" class="form-control" name="UrlEditable" value="">
															</div>
															<div class="form-group">
																<label for="file">Archivo Final</label>
																<input type="file" id="Archivo" class="form-control" name="file" value="" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-4">
															<h4>Generales</h4>
															<div class="form-group">
																<label for="Titulo" data-toggle="tooltip" data-placement="top" title="Escribe un título que resuma el contenido del archivo, puedes usar mayúsculas, acentos y signos especiales">Titulo (Nombre amigable)</label>
																<input type="text" class="form-control" name="Titulo" value="" required>
															</div>
															<div class="form-group">
																<label for="Cadido" data-toggle="tooltip" data-placement="top" title="Agrega el código CADIDO del archivo en caso de existir">CADIDO</label>
																<input type="text" class="form-control" name="Cadido" value="" required>
															</div>
															<div class="form-group">
																<label for="Nomenclatura" data-toggle="tooltip" data-placement="top" title="Debería ser igual que el título sin embargo evita los acentos, signos especiales y sustituye los espacios por guión bajo">Nomenclatura (Sin espacios ni caracteres especiales)</label>
																<input type="text" class="form-control" name="Nomenclatura" value="" required>
															</div>
															<div class="form-group">
																<label for="Descripcion" data-toggle="tooltip" data-placement="top" title="Describe con mas detalle el contenido del archivo">Descripción</label>
																<textarea class="form-control" name="Descripcion" rows="5"></textarea>
															</div>
														</div>
														<div class="col-4">
															<h4>Dublin Core</h4>
															<div class="form-group">
																<label for="Tema" data-toggle="tooltip" data-placement="top" title="Escribe los temas de los que trata el archivo">Tema (Palabras clave)</label>
																<textarea class="form-control" id='Tema' name="Tema" rows="5"></textarea>
															</div>

															<div class="form-group">
																<label for="Cobertura" data-toggle="tooltip" data-placement="top" title="Define el espacio o tiempo que cubre el archivo, Ej. 'México siglo XX', si no se conoce la cobertura puede dejarse en blanco">Cobertura</label>
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
																<select  class="form-control" name="TituloCurso" >
																	<option value="">Selecciona curso</option>
																	<?php
																		$cursos = $this->GeneralModel->lista('categorias','',['TIPO_OBJETO'=>'archivo', 'CATEGORIA_PADRE'=>'0'],'CATEGORIA_NOMBRE ASC','','');
																		foreach($cursos as $curso){
																			echo '<option value="'.$curso->CATEGORIA_NOMBRE.'" >'.$curso->CATEGORIA_NOMBRE.'</option>';
																	} ?>
																</select>
															</div>
															<div class="form-group">
																<label for="AreasConocimiento" data-toggle="tooltip" data-placement="top" title="Selecciona las áreas del conocimiento que cubre el archivo">Áreas del conocimiento</label>
																<?php $areas_conocimiento = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'areas_conocimientos'],'','',''); ?>
																<textarea class="form-control" name="AreasConocimiento" id='AreasConocimiento' rows="5"><?php foreach($areas_conocimiento as $areas){ echo $areas->TIPO_NOMBRE.', ';} ?></textarea>
															</div>
															<div class="form-group">
																<label for="PropositoDidactico" data-toggle="tooltip" data-placement="top" title="Descibe el propósito didáctico que busque alcanzar el archivo">Propósito didáctico</label>
																<input type="text" class="form-control" name="PropositoDidactico" value="">
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
