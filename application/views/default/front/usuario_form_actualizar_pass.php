<!------------------------------------------
HEADER
------------------------------------------->
<div class="jumbotron jumbotron-fluid mb-3 pb-4 bg-primary overlay overlay-black position-relative" style="background-size:cover; background-position: center; background-image:url(<?php echo base_url('assets/img/main_bg.jpg'); ?>">
	<div class="container text-white h-100 tofront">
		<div class="row align-items-center justify-content-center text-center">
			<div class="col-md-10">
				<h1 class="titulo-pagina">  Hola <?php echo $_SESSION['usuario']['nombre']; ?></h1>
			</div>
		</div>
	</div>
</div>
<!-- End Header -->
<!-- Main -->
<div class="contenido_principal">
    <div class="container pt-5 pb-5">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-5">
          <div class="card">
            <div class="card-header">
              <h4> Cambiar Contraseña</h4>
            </div>
            <div class="card-body">
              <?php retro_alimentacion(); ?>
              <form class="" action="<?php echo base_url('usuarios/actualizar_pass');?>" method="post">
                <div class="form-group">
                  <label for="UsuarioPassActual">Contraseña Actual</label>
                  <input type="password" class="form-control" id="UsuarioPassActual" name="UsuarioPassActual" placeholder="Contraseña Actual">
                </div>
                 <div class="form-group">
                   <label for="UsuarioPass">Nueva Contraseña</label>
                   <input type="password" class="form-control" id="UsuarioPass" name="UsuarioPass" placeholder="Nueva Contraseña">
                 </div>
                 <div class="form-group">
                   <label forPassUsu="ario">Confirmar Nueva Contraseña</label>
                   <input type="password" class="form-control" id="UsuarioPassConf" name="UsuarioPassConf" placeholder="Confirmar contraseña">
                 </div>
                 <hr>
                 <button type="submit" class="btn btn-primary float-right"> <span class="fa fa-save"></span> Guardar</button>
               </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
