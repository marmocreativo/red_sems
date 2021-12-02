
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
								</div>
							</div>
              <?php $datos_archivo =  pathinfo(base_url("contenido/docs/".$archivo['ARCHIVO']));  ?>
							<a class="genric-btn primary e-large" download='<?php echo $archivo['CADIDO'].'_'.$archivo['NOMENCLATURA'].'_v'.$archivo['VERSION'].'.'.$datos_archivo['extension']; ?>' href="<?php echo base_url('contenido/docs/'.$archivo['ARCHIVO']); ?>" style="width:100%">Descarga el recurso</a>
							<hr>
              <h3>Danos tu opinión respecto al archivo</h3>
              <div class="row mt-3">
              <div class="col">
                  <div class="card mb-3">
                    <div class="card-body">
                      <form class="" action="<?php echo base_url('repositorio/calificacion') ?>" method="post">
                        <input type="hidden" name="IdArchivo" value="<?php echo $archivo['ID']?>">
                        <label for="EstrellasCalificacion">Fomenta el logro de tu aprendizaje.</label>
                        <div class="estrellas"><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a></div>
                        <input type="hidden" name="EstrellasCalificacion" id="EstrellasCalificacion" value="5">
                        <hr>
                        <label for="EstrellasCalificacion">Es suficiente para la comprensión del tema.</label>
                        <div class="estrellas"><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a></div>
                        <input type="hidden" name="EstrellasCalificacion" id="EstrellasCalificacion" value="5">
                        <hr>
                        <label for="EstrellasCalificacion">La información es clara y organizada.</label>
                        <div class="estrellas"><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a></div>
                        <input type="hidden" name="EstrellasCalificacion" id="EstrellasCalificacion" value="5">
                        <hr>
                        <label for="EstrellasCalificacion">Es creativo e innovador.</label>
                        <div class="estrellas"><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a></div>
                        <input type="hidden" name="EstrellasCalificacion" id="EstrellasCalificacion" value="5">
                        <hr>
                        <label for="EstrellasCalificacion">Es intuitivo.</label>
                        <div class="estrellas"><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a></div>
                        <input type="hidden" name="EstrellasCalificacion" id="EstrellasCalificacion" value="5">
                        <hr>
                        <label for="EstrellasCalificacion">Es de calidad.</label>
                        <div class="estrellas"><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a><a href="#" class="far fa-star text-warning fa-2x"></a></div>
                        <input type="hidden" name="EstrellasCalificacion" id="EstrellasCalificacion" value="5">
                        <div class="form-group">
                          <label for="Nombre">Nombre</label>
                          <input type="text" class="form-control" name="Nombre" value="">
                        </div>
                        <div class="form-group">
                          <label for="Comentario">Comentario</label>
                          <textarea class="form-control" name="Comentario" rows="2" cols="80" required=""></textarea>
                        </div>
                        <button aria-label="Calificar" type="submit" class="btn btn-primary float-right" name="button"> <i class="fa fa-star"></i> Agregar comentario</button>
                      </form>
                    </div>
                  </div>
              </div>
            </div>
  		</div>
      <div class="col-12 col-sm-4">
        <div class="card opiniones-serv" id="calificacion">
                  <div class="card-body">
                    <h5 class="card-title">Calificación del recurso</h5>
                    <?php
                      $cantidad_comentarios = $this->GeneralModel->conteo('comentarios','','',['ID_OBJETO'=>$archivo['ID']],'');
                      $estrellas_5 = $this->GeneralModel->conteo('comentarios','','',['ID_OBJETO'=>$archivo['ID'],'COMENTARIO_CALIFICACION'=>'5'],'');
                      $estrellas_4 = $this->GeneralModel->conteo('comentarios','','',['ID_OBJETO'=>$archivo['ID'],'COMENTARIO_CALIFICACION'=>'4'],'');
                      $estrellas_3 = $this->GeneralModel->conteo('comentarios','','',['ID_OBJETO'=>$archivo['ID'],'COMENTARIO_CALIFICACION'=>'3'],'');
                      $estrellas_2 = $this->GeneralModel->conteo('comentarios','','',['ID_OBJETO'=>$archivo['ID'],'COMENTARIO_CALIFICACION'=>'2'],'');
                      $estrellas_1 = $this->GeneralModel->conteo('comentarios','','',['ID_OBJETO'=>$archivo['ID'],'COMENTARIO_CALIFICACION'=>'1'],'');

                      $total_estrellas = 0;

                      $total_estrellas += ($estrellas_5*5);
                      $total_estrellas += ($estrellas_4*4);
                      $total_estrellas += ($estrellas_3*3);
                      $total_estrellas += ($estrellas_2*2);
                      $total_estrellas += ($estrellas_1*1);

                      if($cantidad_comentarios==0){
                        $promedio = 5;
                      }else{
                        $promedio = $total_estrellas / $cantidad_comentarios;
                      }


                      $estrella_completa = $promedio;
                      $estrella_incompleta = 5-$promedio;


                    ?>
                    <h2 class="h1" style="display:inline;"><?php echo number_format($promedio,1); ?></h2>
                    <?php for($i=1; $i<=$estrella_completa; $i++){ ?> <i class="fa fa-star fa-2x text-primary"></i> <?php } ?>
                    <?php for($i=1; $i<=$estrella_incompleta; $i++){ ?> <i class="far fa-star fa-2x text-primary"></i> <?php } ?>
                     <br>
                      <a data-toggle="collapse" href="#detalles_calificaciones" role="button" aria-expanded="false" aria-controls="detalles_calificaciones">Ver más detalles</a>
                      <div class="collapse" id="detalles_calificaciones">
                      <div class="row">
                        <div class="col">
                          <ul class=" list-unstyled rating m-0">
                             <i class="fa fa-star"></i><i class="far fa-star"></i>  <i class="far fa-star"></i>  <i class="far fa-star"></i>  <i class="far fa-star"></i>                           </ul>
                        </div>
                        <div class="col-7">
                          <div class="progress">
                            <div class="progress-bar bg-primary-8" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <ul class=" list-unstyled rating m-0">
                             <i class="fa fa-star"></i>  <i class="fa fa-star"></i><i class="far fa-star"></i>  <i class="far fa-star"></i>  <i class="far fa-star"></i>                           </ul>
                        </div>
                        <div class="col-7">
                          <div class="progress">
                            <div class="progress-bar bg-primary-8" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <ul class=" list-unstyled rating m-0">
                             <i class="fa fa-star"></i>  <i class="fa fa-star"></i>  <i class="fa fa-star"></i><i class="far fa-star"></i>  <i class="far fa-star"></i>                           </ul>
                        </div>
                        <div class="col-7">
                          <div class="progress">
                          <div class="progress-bar bg-primary-8" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <ul class=" list-unstyled rating m-0">
                             <i class="fa fa-star"></i>  <i class="fa fa-star"></i>  <i class="fa fa-star"></i>  <i class="fa fa-star"></i>                              <i class="far fa-star"></i>                           </ul>
                        </div>
                        <div class="col-7">
                          <div class="progress">
                            <div class="progress-bar bg-primary-8" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <ul class=" list-unstyled rating m-0">
                             <i class="fa fa-star"></i>  <i class="fa fa-star"></i>  <i class="fa fa-star"></i>  <i class="fa fa-star"></i>  <i class="fa fa-star"></i>                                                       </ul>
                        </div>
                        <div class="col-7">
                          <div class="progress">
                            <div class="progress-bar bg-primary-8" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php $comentarios = $this->GeneralModel->lista('comentarios','',['ID_OBJETO'=>$archivo['ID']],'','',''); ?>
                    <?php foreach($comentarios as $comentario){ ?>
                      <div class="list-group">
                          <li class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                              <ul class="rating pl-0">
                                <?php for($i=1; $i<=$comentario->COMENTARIO_CALIFICACION; $i++){ ?> <li class="fa fa-star text-primary"></li> <?php } ?>
                                <?php for($i=1; $i<=(5-$comentario->COMENTARIO_CALIFICACION); $i++){ ?> <li class="far fa-star text-primary"></li> <?php } ?>
                              </ul>
                              <small><?php echo $comentario->FECHA_REGISTRO ?></small>
                            </div>
                            <h5 class="mb-1"><?php echo $comentario->USUARIO_NOMBRE ?></h5>
                            <p class="mb-1"><?php echo $comentario->USUARIO_IP ?></p>
                          </li>
                        </div>
                    <?php } ?>
                </div>
              </div>
      </div>
  	</div>
  </div>
</div>
<!-- End Main -->
