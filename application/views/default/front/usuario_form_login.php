<!-- Main -->
<div class="contenido-principal">
	<div class="row justify-content-center mt-5">
		<div class="col-12 col-sm-8 col-md-6 col-lg-4">
				<?php retro_alimentacion(); ?>
			<form class="border rounded p-5" action="<?php echo base_url('login/iniciar_sesion');?>" method="post">
				<input type="hidden" name="UrlRedirect" value="<?php echo verificar_variable('GET','url_redirect',''); ?>">
				<h3 class="mb-4 text-center">Inicia Sesión</h3>
				<div class="form-group">
					<label for="UsuarioCorreo"> Correo</label>
					<input type="email" class="form-control" id="UsuarioCorreo" name="UsuarioCorreo" placeholder="Tu correo electrónico">
				</div>
				<div class="form-group">
					<label for="UsuarioPass"> Contraseña</label>
					<input type="password" class="form-control" id="UsuarioPass" name="UsuarioPass" placeholder="Contraseña">
				</div>
				<button type="submit" class="btn btn-success btn-round btn-block shadow-sm">Iniciar Sesión</button>
				<div class="row mt-4">
					<div class="col-12 col-sm-6">
						<a class="btn btn-block btn-link" href="<?php echo base_url('login/recuperar_pass');?>"> <span class="fa fa-question-circle"></span> Olvidé mi contraseña</a>
					</div>
					<div class="col-12 col-sm-6">
						<!--<a class="btn btn-block btn-link" href="<?php echo base_url('usuarios/crear');?>"> <span class="fa fa-pen-square"></span> Registrarme</a>-->
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End Main -->
