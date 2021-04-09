
<!-- Main -->
<div class="contenido-principal">
  <div class="container pb-5">
    <div class="row mt-3">
			<div class="col-12 banner-content"  id="busqueda-int">
            <form action="<?php echo base_url('repositorio'); ?>" method="get" class="search-form-area">
              <div class="row justify-content-center form-wrap">
                <div class="col-lg-4 form-cols">
                  <input type="text" class="form-control" name="busqueda" placeholder="Busca un recurso">
                </div>
                <div class="col-lg-3 form-cols">
                  <div class="default-select" id="default-selects">
                    <select name="busqueda_curso">
                    	<option value="0">Selecciona curso</option>
						<?php
							$cursos = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'cursos'],'TIPO_NOMBRE ASC','','');
							foreach($cursos as $curso){
								echo '<option value="'.$curso->ID.'" >'.$curso->TIPO_NOMBRE.'</option>';
						} ?>
					</select>
                  </div>
                </div>
                <div class="col-lg-3 form-cols">
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
                <div class="col-lg-2 form-cols">
                    <button type="submit" class="btn btn-info">
                      <span class="lnr lnr-magnifier"></span> Buscar
                    </button>
                </div>
              </div>
            </form>
			</div>
		</div>
		<?php retro_alimentacion(); ?>
  	<div class="row justify-content-center">
  		<div class="col-12 col-sm-8">
				<div class="single-post d-flex flex-row">
								<div class="details">
									<div class="title">
                    <div class="genric-btn default circle"><i class="fas fa-file-alt"></i></div>
										<div class="titles">
											<h5><?php echo $archivo['TITULO']; ?></h5>
										</div>
									</div>
                  <a class="btn-descarga primary e-large" target="_blank" href="<?php echo base_url('contenido/docs/'.$archivo['ARCHIVO']); ?>" style="width:100%"><i class="fas fa-download"></i> Descarga</a>
                  <?php if(verificar_permiso(['administrador','produccion','diseno_instrucional','comunicacion'])){ ?>
                  <a class="btn-editable" target="_blank" href="<?php echo $archivo['ARCHIVO_EDITABLE'] ?>" style="width:100%"><i class="fas fa-vector-square"></i> Ver Editable</a>
                  <?php } ?>
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
								</div>
							</div>

  		</div>
      <div class="col-12 col-sm-4" id="detalles-recurso">
          <p class="creador"><?php echo $archivo['CREADOR']; ?></p>
          <p class="colaborador"><?php echo $archivo['COLABORADOR']; ?></p>
          <p class="area-c-tag"><b>Áreas del conocimiento</b></p>
          <div class="icn-area area-hum"></div>
          <div class="icn-area area-social"></div>
          <div class="icn-area area-exp"></div>
          <div class="icn-area area-mate"></div>
          <div class="icn-area area-com"></div>
          <p id="fecha-c"><span class="fas fa-calendar-alt pr-2"></span> <b>Creado:</b> <?php echo $archivo['FECHA_CREACION']; ?></p>
          <p id="tema"><span class="fas fa-book pr-2"></span> <b>Tema:</b> <?php echo $archivo['TEMA']; ?></p>
          <p id="audiencia"><span class="fas fa-users pr-1"></span> <b>Curso:</b> <?php echo $archivo['TITULO_CURSO']; ?></p>
          <p id="alcance"><span class="fas fa-map-marker pr-1"></span> <b>Cobertura:</b> <?php echo $archivo['COBERTURA']; ?></p>
          <p id="idioma"><span class="fas fa-language pr-1"></span> <b>Idioma:</b> <?php echo $archivo['IDIOMA']; ?></p>
          <button type="button" class="btn btn-block btn-outline-secondary btn-citas" data-toggle="modal" data-target="#citasModal"><i class="fas fa-quote-right"></i> Citar este recurso</button>
          <button type="button" class="btn btn-block btn-outline-secondary btn-derechos" data-toggle="modal" data-target="#derechosModal"><i class="far fa-copyright"></i> Derechos</button>
          <p class="descripcion"><?php echo $archivo['DESCRIPCION']; ?></p>

***front detalles archivo <?=$archivo["ID"]?> envia a descarga  *** 
            <a class="genric-btn primary e-large"  href="<?php echo base_url('repositorio/decarga/'.$archivo['ID']); ?>" style="width:100%">Ir a descarga</a>

      </div>
  	</div>
  </div>

  <!-- Modal Derechos-->
<div class="modal fade" id="derechosModal" tabindex="-1" aria-labelledby="derechosModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="derechosModalLabel"><i class="far fa-copyright"></i> Derechos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span><?php echo $archivo['DERECHOS']; ?></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
 </div>
 <!-- Fin modal derechos -->

 <!-- Modal Citas-->
<div class="modal fade" id="citasModal" tabindex="-1" aria-labelledby="citasModalLabel" aria-hidden="true">
 <div class="modal-dialog">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="citasModalLabel"><i class="fas fa-quote-right"></i> Citas</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <div class="modal-body">
       <p>Apellido, inicial(es) del nombre (año). Nombre de la sección o artículo. En Nombre de la página web. https://url</p>
     <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
     </div>
   </div>
 </div>
</div>
<!-- Fin modal derechos -->
</div>
<!-- End Main -->
