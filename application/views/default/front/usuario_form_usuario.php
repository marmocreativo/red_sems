<!-- Main -->
<div class="contenido-principal">
	<?php retro_alimentacion(); ?>
	<div class="row justify-content-center mt-5">
		<div class="col-12 col-sm-8 col-md-4">
			<form class="border rounded p-5"  action="<?php echo base_url('usuarios/crear');?>" method="post">
				<h3 class="mb-4 text-center">Registrar Usuario</h3>
				<div class="row">
					<div class="col-12 col-md-6">
						 <div class="form-group">
							 <label for="UsuarioNombre">Nombre</label>
							 <input type="text" class="form-control" name="UsuarioNombre" placeholder="" value="<?=!form_error('UsuarioNombre')?set_value('UsuarioNombre'):''?>" required>
						 </div>
					</div>
					<div class="col-12 col-md-6">
						 <div class="form-group">
							 <label for="UsuarioApellidos">Apellidos</label>
							 <input type="text" class="form-control" name="UsuarioApellidos" placeholder="" value="<?=!form_error('UsuarioApellidos')?set_value('UsuarioApellidos'):''?>" required>
						 </div>
					</div>
				</div>
				 <div class="form-group">
					 <label for="UsuarioCorreo">Correo</label>
					 <input type="email" class="form-control" name="UsuarioCorreo" placeholder="" value="<?=!form_error('UsuarioCorreo')?set_value('UsuarioCorreo'):''?>" required>
				 </div>
				 <div class="row">
					 <div class="col-12 col-md-6">
						 <div class="form-group">
							 <label for="UsuarioPass">Contraseña</label>
							 <input type="password" class="form-control" name="UsuarioPass" placeholder="" required>
						 </div>
					 </div>
					 <div class="col-12 col-md-6">
						 <div class="form-group">
							 <label for="UsuarioPassConf">Confirma tu contraseña</label>
							 <input type="password" class="form-control"name="UsuarioPassConf" placeholder="" required>
						 </div>
					 </div>
				 </div>
				 <div class="form-check">
					 <input type="checkbox" class="form-check-input" name="TerminosyCondiciones" id="TerminosyCondiciones" required>
					 <label class="form-check-label" for="TerminosyCondiciones">Acepto los términos y condiciones</label>
				 </div>
				 <hr>
				<button type="submit" class="btn btn-success btn-round btn-block shadow-sm">Registrarme</button>
				<div class="row mt-4">
					<div class="col">
						<a class="btn btn-block btn-link" href="<?php echo base_url('login');?>"> <span class="fa fa-pen-square"></span> Iniciar Sesión</a>
					</div>
				</div>
        <nav class="nav justify-content-center nav-fill">

        </nav>
			</form>
		</div>
	</div>
</div>
<!-- End Main -->
