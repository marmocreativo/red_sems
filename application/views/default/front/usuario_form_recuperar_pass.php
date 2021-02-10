<!-- Main -->
<div class="contenido-principal">
	<?php retro_alimentacion(); ?>
	<div class="row justify-content-center mt-5">
		<div class="col-12 col-sm-8 col-md-3">
			<form class="border rounded p-5" action="<?php echo base_url('login/recuperar_pass');?>" method="post">
				<h3 class="mb-4 text-center">Recuperar Contraseña</h3>
				<div class="form-group">
					<label for="UsuarioCorreo">Correo electrónico </label>
					<input type="email" class="form-control" id="UsuarioCorreo" name="UsuarioCorreo" placeholder="Tu correo electrónico">
				</div>
				<button type="submit" class="btn btn-success btn-round btn-block shadow-sm">Recuperar</button>
				<div class="row mt-4">
					<div class="col-12 col-sm-6">
						<a class="btn btn-block btn-link" href="<?php echo base_url('login');?>"> <span class="fa fa-pen-square"></span> Iniciar Sesión</a>
					</div>
					<div class="col-12 col-sm-6">
						<a class="btn btn-block btn-link" href="<?php echo base_url('usuarios/crear');?>"> <span class="fa fa-pen-square"></span> Registrarme</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- End Main -->
