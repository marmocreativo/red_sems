<!------------------------------------------
HEADER
------------------------------------------->
<div class="jumbotron jumbotron-fluid mb-3 pb-4 bg-primary overlay overlay-black position-relative" style="background-size:cover; background-position: center; background-image:url(<?php echo base_url('assets/img/main_bg.jpg'); ?>">
	<div class="container text-white h-100 tofront">
		<div class="row align-items-center justify-content-center text-center">
			<div class="col-md-10">
				<h1 class="titulo-slider">  Contáctanos</h1>
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
  		<div class="col-12 col-sm-7">
  			<article>
            <h4><?php echo $op['titulo_sitio']; ?></h4>
            <p> <i class="fa fa-phone"></i> <?php echo $op['telefono_sitio']; ?></p>
            <p> <i class="fa fa-envelope"></i> <?php echo $op['correo_sitio']; ?></p>
            <p> <i class="fa fa-map-marker"></i> <?php echo $op['direccion_sitio']; ?></p>
            <hr>
          <?php echo $op['mapa_google']; ?>
  			</article>
  		</div>
      <div class="col-12 col-sm-5">
        <h6>Contáctanos</h6>
        <form action="<?php echo base_url('enviar_mensaje'); ?>" method="post">
          <input type="hidden" name="UrlRedirect" value="<?php echo base_url(uri_string().'?'.$_SERVER['QUERY_STRING']); ?>">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="Nombre">Nombre</label>
                <input type="text" class="form-control" id="Nombre" name="Nombre">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="Correo">E-mail</label>
                <input type="text" class="form-control" id="Correo" name="Correo">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="Telefono">Teléfono</label>
                <input type="text" class="form-control" id="Telefono" name="Telefono">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="Mensaje">Mensaje</label>
                <textarea id="Mensaje" name="Mensaje" class="form-control" rows="8"></textarea>
              </div>
            </div>
            <div class="col-sm-12 text-center">
              <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar mensaje</button>
            </div>
          </div>
        </form>
      </div>
  	</div>
  </div>
</div>
<!-- End Main -->
