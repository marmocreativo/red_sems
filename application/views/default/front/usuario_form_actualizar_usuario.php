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
<div class="contenido-principal">
    <div class="container pt-5 pb-5">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-8">
          <div class="card">
            <div class="card-header">
              <h4>Actualizar tus datos</h4>
            </div>
            <div class="card-body">
              <?php retro_alimentacion(); ?>
              <form class="" action="<?php echo base_url('usuarios/actualizar'); ?>" method="post">
                  <div class="row">
                    <div class="col">
                      <h3 class="h5">Datos Básicos</h3>
                       <div class="form-group">
                         <label for="UsuarioNombre">Nombre</label>
                         <input type="text" class="form-control" id="UsuarioNombre" name="UsuarioNombre" placeholder="" value="<?php if(empty(form_error('UsuarioNombre'))){ echo $usuario['USUARIO_NOMBRE']; } else { set_value('UsuarioNombre'); } ?>">
                       </div>
                       <div class="form-group">
                         <label for="UsuarioApellidos">Apellidos</label>
                         <input type="text" class="form-control" id="UsuarioApellidos" name="UsuarioApellidos" placeholder="" value="<?php if(empty(form_error('UsuarioApellidos'))){ echo $usuario['USUARIO_APELLIDOS']; } else { set_value('UsuarioApellidos'); } ?>">
                       </div>
                       <div class="form-group">
                         <label for="UsuarioCorreo">Correo</label>
                         <input type="email" class="form-control" id="UsuarioCorreo" name="UsuarioCorreo" placeholder="" value="<?php if(empty(form_error('UsuarioCorreo'))){ echo $usuario['USUARIO_CORREO']; } else { set_value('UsuarioCorreo'); } ?>">
                       </div>
                    </div>
                    <div class="col">
                      <div class="border p-2">
                        <h4 class="h5">Datos Personales</h4>
                        <div class="form-group">
                          <label for="UsuarioTelefono">Teléfono</label>
                          <input type="text" class="form-control" id="UsuarioTelefono" name="UsuarioTelefono" placeholder="" value="<?php if(empty(form_error('UsuarioTelefono'))){ echo $usuario['USUARIO_TELEFONO']; } else { set_value('UsuarioTelefono'); } ?> ">
                        </div>
                        <div class="form-group">
                          <label for="UsuarioFechaNacimiento">Fecha Nacimeinto</label>
                          <input type="date" class="form-control" id="UsuarioFechaNacimiento" name="UsuarioFechaNacimiento" placeholder="" value="<?php echo $usuario['USUARIO_FECHA_NACIMIENTO']; ?>">
                        </div>
                        <hr>
                        <div class="custom-control custom-checkbox my-1 mr-sm-2">
                          <input type="checkbox" class="custom-control-input" id="UsuarioListaDeCorreo" name="UsuarioListaDeCorreo" <?php if($usuario['USUARIO_LISTA_DE_CORREO']=='si'){ echo 'checked'; } ?>>
                          <label class="custom-control-label" for="UsuarioListaDeCorreo">Recibir publicidad por correo</label>
                        </div>
                      </div>
                    </div>
                  </div>
                <hr>
                <button type="submit" class="btn btn-primary ?> float-right" name="button"> <span class="fa fa-save"></span> Guardar</button>
              </form>
            </div>

          </div>
					<hr>
					<div class="card">
						<div class="card-body">
							<a class="btn btn-block btn-link" href="<?php echo base_url('usuarios/actualizar_pass'); ?>"> <i class="fa fa-lock"></i> Cambiar Contraseña</a>
						</div>
					</div>
        </div>
      </div>
    </div>
</div>
