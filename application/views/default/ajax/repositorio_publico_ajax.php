<div class="row mb-4">
	<div class="col-12">
		<h5>Carpetas</h5>
	</div>
	<?php foreach($categorias as $categoria){ ?>
	<div class="col-12 col-sm-6 col-md-4 mb-3">
			<div class="card single-promo-card single-promo-hover text-center shadow-sm">
				<div class="card-header p-0">
						<img src="<?php echo base_url('contenido/img/categorias/'.$categoria->IMAGEN); ?>?v=1" class="d-block img-fluid" alt="">
				</div>
				<div class="card-body d-flex justify-content-between">
					<a href="<?php echo base_url('repositorio?categoria='.$categoria->ID_CATEGORIA.'&orden_cat'.$consulta['orden_cat'].'&busqueda'.$consulta['busqueda']); ?>" class="d-block">
					<p class="h6" title="<?php echo $categoria->CATEGORIA_NOMBRE; ?>"><i class="fa fa-folder"></i> <?php echo character_limiter($categoria->CATEGORIA_NOMBRE,22); ?></p>
					</a>
				</div>
			</div>
	</div>
	<?php } ?>
</div>

<div class="row">
	<div class="col-12">
		<h5>Archivos</h5>
	</div>
	<?php foreach($archivos as $archivo){ ?>
	<div class="col-12 col-sm-3 mb-4">
		<?php
		$tipo_archivo = 'archivo';
		$icono = 'fa fa-folder';
		if($archivo->TIPO_PUBLICACION=='video'){
			$tipo_archivo = 'video';
			$icono = 'fab fa-youtube';
		}
			//Obtengo el archivo
			$ultima_galeria = $this->GeneralModel->detalles_orden('galerias',['ID_OBJETO'=>$archivo->ID_PUBLICACION],'ID_GALERIA desc');
			$multimedia = $this->GeneralModel->detalles('multimedia',['ID_MULTIMEDIA'=>$ultima_galeria['ID_MULTIMEDIA']]);
		?>
			<div class="card single-promo-card single-promo-hover text-center shadow-sm" title="<?php echo $archivo->PUBLICACION_TITULO; ?>">
				<div class="card-body p-0 text-center">
					<?php if($tipo_archivo=='archivo'){ ?>
					<a href="#" data-toggle="modal" data-target="#descargar-<?php echo $archivo->ID_PUBLICACION; ?>">
					<?php } ?>
					<?php if($tipo_archivo=='video'){ ?>
						<a href="<?php echo base_url('video/'.$archivo->ID_PUBLICACION); ?>">
					<?php } ?>
					<img src="<?php echo base_url('contenido/img/publicaciones/'.$archivo->IMAGEN); ?>" class="img-fluid" alt="">
					<div class="p-3 d-flex justify-content-between">
						<p class="h6"><?php echo ellipsize($archivo->PUBLICACION_TITULO,15); ?></p>
					</div>
					</a>
				</div>
			</div>
			<?php if($tipo_archivo=='archivo'){ ?>
			<div class="modal fade" id="descargar-<?php echo $archivo->ID_PUBLICACION; ?>" tabindex="-1" role="dialog" aria-labelledby="descargar-<?php echo $archivo->ID_PUBLICACION; ?>" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Descargar</h5>
						</div>
						<div class="modal-body">
							<h5>Hola <?php echo $_SESSION['usuario']['nombre']; ?>!</h5>
							<p>Gracias por usar nuestros servicios puedes descargar el archivo dando click en el siguiente botón</p>
							<hr>
							<a href="<?php echo base_url('contenido/docs/'.$multimedia['ARCHIVO']); ?>" class="btn btn-primary btn-block registrar_descarga"
								data-id-publicacion="<?php echo $archivo->ID_PUBLICACION; ?>"
								data-id-usuario="<?php echo $_SESSION['usuario']['id']; ?>"
								data-nombre="<?php echo $_SESSION['usuario']['nombre']; ?>"
								data-apellidos="<?php echo $_SESSION['usuario']['apellidos']; ?>"
								download="<?php echo $archivo->PUBLICACION_TITULO ?>"> <i class="fa fa-download"></i> Descargar</a>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
	</div>
	<?php } ?>
</div>
