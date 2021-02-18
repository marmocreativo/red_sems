<div class="row mb-4 carpetas-cont">
	<div class="col-12">
		<h5>Carpetas</h5>
	</div>
	<?php foreach($categorias as $categoria){ ?>
	<div class="col-12 col-sm-6 col-md-4 mb-3">
		<a href="<?php echo base_url('repositorio?categoria='.$categoria->ID_CATEGORIA.'&orden_cat'.$consulta['orden_cat'].'&busqueda'.$consulta['busqueda']); ?>">
			<div class="card single-promo-card single-promo-hover text-center shadow-sm">
				<div class="card-header p-0">
						<img src="<?php echo base_url('contenido/img/categorias/'.$categoria->IMAGEN); ?>?v=1" class="d-block img-fluid" alt="">
				</div>
				<div class="card-body d-flex justify-content-between">
					<a class="d-block">
					<p class="h6" title="<?php echo $categoria->CATEGORIA_NOMBRE; ?>"><i class="fa fa-folder"></i> <?php echo character_limiter($categoria->CATEGORIA_NOMBRE,22); ?></p>
					</a>
				</div>
			</div>
		</a>
	</div>
	<?php } ?>
</div>

<div class="row archivos-cont">
	<div class="col-12">
		<h5>Archivos</h5>
	</div>
	<?php foreach($archivos as $archivo){ ?>
		<div class="col-12 col-sm-6 col-md-4">
			<a href="<?php echo base_url('repositorio/recurso/'.$archivo->ID); ?>">
				<div class="single-service rec-webtxt">
					<div class="genric-btn default circle"><img src="<?php echo base_url('assets/redsems'); ?>/img/web-txt-icn.png"><?php echo $archivo->TIPO_RECURSO; ?></div>
					<div class="cbp-vm-title">
						<h5><?php echo $archivo->TITULO; ?></h5>
						<div class="cbp-vm-price"><?php echo $archivo->CREADOR; ?></div>
					</div>
					<div class="cbp-vm-details">
						<?php echo $archivo->DESCRIPCION; ?>
					</div>
				</div>
			</a>
			</div>
	<?php } ?>
</div>
