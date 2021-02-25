
<!-- Main -->
<div class="contenido-principal">
  <div class="container pt-5 pb-5">
		<?php retro_alimentacion(); ?>
  	<div class="row justify-content-center">
  		<div class="col-12 col-sm-8">
				<div class="single-post d-flex flex-row">
								<div class="thumb">
									<img src="<?php echo base_url('assets/redsems'); ?>/img/pdf-icn.png" alt="">
								</div>
								<div class="details">
									<div class="title d-flex flex-row justify-content-between">
										<div class="titles">
											<h4><?php echo $archivo['TITULO']; ?></h4>
											<h5 class="creador"><?php echo $archivo['CREADOR']; ?></h5>
											<h5 class="colaborador"><?php echo $archivo['COLABORADOR']; ?></h5>
										</div>
									</div>
                  <div class="Archivo">
                    <?php if($archivo['FORMATO']=='pdf'){ ?>
                      <hr>
                      <embed src="<?php echo base_url('contenido/docs/'.$archivo['ARCHIVO']); ?>" width="100%" height="500"
                       type="application/pdf">
                    <?php } ?>
                    <?php if($archivo['FORMATO']=='jpg'||$archivo['FORMATO']=='jpeg'||$archivo['FORMATO']=='png'||$archivo['FORMATO']=='gif'||$archivo['FORMATO']=='svg'){ ?>
                      <hr>
                      <img src="<?php echo base_url('contenido/docs/'.$archivo['ARCHIVO']); ?>" class="img-fluid">
                    <?php } ?>
                  </div>
                  <hr>
									<p class="descripcion">
										<?php echo $archivo['DESCRIPCION']; ?>
									</p>
									<p id="fecha-c"><span class="fas fa-calendar-alt pr-2"></span> Creado: <?php echo $archivo['FECHA_CREACION']; ?></p>
									<p id="tema"><span class="fas fa-book pr-2"></span> Tema: <?php echo $archivo['TEMA']; ?></p>
									<p id="audiencia"><span class="fas fa-users pr-1"></span> Curso: <?php echo $archivo['TITULO_CURSO']; ?></p>
									<p id="alcance"><span class="fas fa-map-marker pr-1"></span> Cobertura: <?php echo $archivo['COBERTURA']; ?></p>
									<p id="idioma"><span class="fas fa-language pr-1"></span> Idioma: <?php echo $archivo['IDIOMA']; ?></p>
								</div>
							</div>
							<a class="genric-btn primary e-large" target="_blank" href="<?php echo base_url('contenido/docs/'.$archivo['ARCHIVO']); ?>" style="width:100%">Descarga el recurso</a>
              <?php if(verificar_permiso(['administrador','produccion','diseno_instrucional','comunicacion'])){ ?>
                <a class="btn btn-outline-primary" target="_blank" href="<?php echo $archivo['ARCHIVO_EDITABLE'] ?>" style="width:100%">Ver archivo Editable</a>
              <?php } ?>
							<hr>
							<div class="container-fluid job-experience">
								<h4 class="single-title">Derechos</h4>
								<ul>
									<li>
										<img src="img/pages/list.jpg" alt="">
										<span><?php echo $archivo['DERECHOS']; ?></span>
									</li>
								</ul>
							</div>

  		</div>
      <div class="col-12 col-sm-4">
				<div class="single-widget search-widget turquesa-fnd">
						<h3 class="text-white">Nueva búsqueda</h3>
						<form action="<?php echo base_url('repositorio'); ?>" method="get" class="serach-form-area">
							<div class="row justify-content-center form-wrap">
								<div class="col-12 form-cols">
									<input type="text" class="form-control" name="busqueda" placeholder="Busca un recurso">
								</div>
								<div class="col-12 form-cols pt-10">
									<div class="default-select" id="default-selects">
										<select name="busqueda_curso">
											<option value="0">Selecciona curso</option>
											<option value="Curso_de_prueba">Curso_de_prueba</option>
											<option value="Evolucion_y_procesos_biologicos_SCORM">Evolucion_y_procesos_biologicos_SCORM</option>
											<option value="M7_Prepa_en_Linea-SEP">M7_Prepa_en_Linea-SEP</option>
											<option value="Modulo_14">Modulo_14</option>
											<option value="M16_Evolucion_y_sus_repercusiones_sociales">M16_Evolucion_y_sus_repercusiones_sociales</option>
										</select>
									</div>
								</div>
								<div class="col-12 form-cols pt-10">
									<div class="default-select" id="default-selects2">
										<select name="busqueda_recurso">
                      <option value="">Selecciona recurso</option>
                      <option value="Pdf">PDF</option>
                      <option value="Epub">Epub</option>
                      <option value="Imagen">Imágen</option>
                      <option value="Infografía">Infografía</option>
                      <option value="Video">Video</option>
                      <option value="Audio">Audio</option>
										</select>
									</div>
								</div>
								<div class="col-12 form-cols pt-10">
										<button type="submit" class="btn btn-info btn-block">
											<span class="lnr lnr-magnifier"></span> Buscar
										</button>
								</div>
							</div>
						</form>
					</div>
      </div>
  	</div>
  </div>
</div>
<!-- End Main -->
