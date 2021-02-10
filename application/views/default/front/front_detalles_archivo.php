<!------------------------------------------
HEADER
------------------------------------------->
<div class="jumbotron jumbotron-fluid mb-3 pb-4 bg-dark overlay overlay-black position-relative" style="background-size:cover; background-position: center; background-image:url(<?php echo base_url('contenido/img/publicaciones/'.$publicacion['IMAGEN_FONDO']); ?>">
	<div class="container text-white h-100 tofront">
		<div class="row align-items-center justify-content-center text-center">
			<div class="col-md-10">
				<h1 class="titulo-pagina">  <?php echo $publicacion['PUBLICACION_TITULO']; ?></h1>
			</div>
		</div>
	</div>
</div>
<!-- End Header -->

<!-- Main -->
<div class="contenido-principal">
  <div class="container pt-5 pb-5">
		<?php retro_alimentacion(); ?>
  	<div class="row justify-content-center">
  		<div class="col-12 col-sm-8">
  			<article class="mb-4">
  			<?php echo $publicacion['PUBLICACION_CONTENIDO']; ?>
  			</article>
				<div class="carrusel_imagenes">
					<?php foreach($multimedia as $tipo => $galeria){ ?>
						<?php foreach($galeria as $galeria){ ?>
							<?php if($tipo =='imagen'){ ?>
								<a class="item" href="<?php echo base_url('contenido/img/publicaciones/'.$galeria->ARCHIVO); ?>" data-gallery="galeria-slider" data-toggle="lightbox" title="<?php echo $galeria->TITULO; ?>">
									<img src="<?php echo base_url('contenido/img/publicaciones/'.$galeria->ARCHIVO); ?>" class="calcular_ancho" title="<?php echo $galeria->TITULO; ?>">
									<h5><?php echo $galeria->TITULO; ?></h5>
									<p><?php echo $galeria->RESUMEN; ?></p>
								</a>
							<?php }// </> vista imagen ?>
						<?php } ?>
					<?php } ?>
				</div>
				<?php foreach($multimedia as $tipo => $galeria){ ?>
					<div class="row mb-3">
						<?php foreach($galeria as $galeria){ ?>
							<?php if($tipo =='documento'){ ?>
								<div class="col-12 col-sm-3 p-1">
									<a href="<?php echo base_url('contenido/docs/'.$galeria->ARCHIVO); ?>" target="_blank">
									<div class="px-1 py-3 text-center">
												<?php
													$extension = explode('.',$galeria->ARCHIVO);
													switch ($extension[1]) {
														case 'doc': case 'docx': $icono = 'fas fa-file-word'; break;
														case 'pdf': $icono = 'fas fa-file-pdf'; break;
														case 'txt': $icono = 'fas fa-file-alt'; break;
														case 'jpg': case 'png': case 'gif': case 'webp': $icono = 'fas fa-file-image'; break;
														default: $icono = 'fas fa-file'; break;
													}
												?>
												<h1> <i class="<?php echo $icono; ?> fa-2x"></i> </h1>
												<h5 class="titulo-multimedia-<?php echo $galeria->ID_MULTIMEDIA; ?>"><?php echo $galeria->TITULO; ?></h5>
												<p class="resumen-multimedia-<?php echo $galeria->ID_MULTIMEDIA; ?>"><?php echo $galeria->RESUMEN; ?></p>
									</div>
									</a>
								</div>
							<?php }// </> vista documento ?>
							<?php if($tipo =='enlace'){ ?>
								<div class="col-4 p-1">
									<a href="<?php echo $galeria->ARCHIVO; ?>" target="_blank">
									<div class="px-1 py-3 text-center">
										<h5 class="titulo-multimedia-<?php echo $galeria->ID_MULTIMEDIA; ?>"><?php echo $galeria->TITULO; ?> <i class="fas fa-link"></i></h5>
										<p class="resumen-multimedia-<?php echo $galeria->ID_MULTIMEDIA; ?>"><?php echo $galeria->RESUMEN; ?></p>
									</div>
									</a>
								</div>
							<?php }// </> vista documento ?>
							<?php if($tipo =='youtube'){ ?>
								<div class="col-12 col-sm-6 p-1">
									<div class="px-1 py-3 text-center">
											<iframe width="100%" height="200" src="https://www.youtube.com/embed/<?php echo $galeria->ARCHIVO; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
											<hr>
												<h5 class="titulo-multimedia-<?php echo $galeria->ID_MULTIMEDIA; ?>"><?php echo $galeria->TITULO; ?></h5>
												<p class="resumen-multimedia-<?php echo $galeria->ID_MULTIMEDIA; ?>"><?php echo $galeria->RESUMEN; ?></p>
									</div>
								</div>
							<?php }// </> vista documento ?>
						<?php } ?>
					</div>
				<?php } ?>
  		</div>
      <div class="col-12 col-sm-4">
        <img src="<?php echo base_url('contenido/img/publicaciones/'.$publicacion['IMAGEN']); ?>" class="img-fluid" alt="">
					<hr>

					<h6> <i class="far fa-thumbs-up"></i> ¿Qué opinas?</h6>
					<?php
						if(isset($_SESSION['usuario'])){
							$mi_reaccion = $this->GeneralModel->detalles('reacciones',['ID_OBJETO'=>$publicacion['ID_PUBLICACION'],'TIPO_OBJETO'=>'publicacion','ID_USUARIO'=>$_SESSION['usuario']['id']]);
							$enlace_reaccion = base_url('reaccionar?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING']).'&id_objeto='.$publicacion['ID_PUBLICACION'].'&tipo_objeto=publicacion');
						}else{
							$mi_reaccion = null;
							$enlace_reaccion = base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING']));
						};
						if(!empty($mi_reaccion)){
							if($mi_reaccion['REACCION']=='me_gusta'){
								$boton_me_gusta = 'btn-primary';
								$boton_no_me_gusta = 'btn-outline-primary disabled ';
							}
							if($mi_reaccion['REACCION']=='no_me_gusta'){
								$boton_me_gusta = 'btn-outline-primary disabled ';
								$boton_no_me_gusta = 'btn-primary';
							}

						}else{
							$boton_me_gusta = 'btn-outline-primary';
							$boton_no_me_gusta = 'btn-outline-primary';
						}
					?>
					<div class="row">
						<div class="col p-1">
							<?php $cantidad_me_gusta = $this->GeneralModel->conteo('reacciones','','',['ID_OBJETO'=>$publicacion['ID_PUBLICACION'],'TIPO_OBJETO'=>'publicacion','REACCION'=>'me_gusta'],''); ?>
								<a href="<?php echo $enlace_reaccion; ?>&reaccion=me_gusta" class="btn <?php echo $boton_me_gusta ?> btn-block" alt="Me gusta"> <i class="far fa-thumbs-up"></i> <?php echo $cantidad_me_gusta; ?></a>
						</div>
						<div class="col p-1">
							<?php $cantidad_no_me_gusta = $this->GeneralModel->conteo('reacciones','','',['ID_OBJETO'=>$publicacion['ID_PUBLICACION'],'TIPO_OBJETO'=>'publicacion','REACCION'=>'no_me_gusta'],''); ?>
								<a href="<?php echo $enlace_reaccion; ?>&reaccion=no_me_gusta" class="btn <?php echo $boton_no_me_gusta ?> btn-block" alt="No me gusta"> <i class="far fa-thumbs-down"></i> <?php echo $cantidad_no_me_gusta; ?></a>
						</div>
					</div>
	        <hr>

					<h6> <i class="fa fa-share-alt"></i> Comparte</h6>
				<!-- AddToAny BEGIN -->
        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
        <a class="a2a_button_facebook"></a>
        <a class="a2a_button_twitter"></a>
        <a class="a2a_button_whatsapp"></a>
        <a class="a2a_button_pinterest"></a>
        </div>
        <script async src="https://static.addtoany.com/menu/page.js"></script>
        <!-- AddToAny END -->
      </div>
  	</div>
  </div>
</div>
<!-- End Main -->
