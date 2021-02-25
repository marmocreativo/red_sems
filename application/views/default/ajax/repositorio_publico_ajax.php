<div class="row mb-4">
	<div class="col-12">
		<h5>Carpetas</h5>
<?php
/* echo 'repo_pub_ajax - get busqueda:'.verificar_variable('GET','busqueda','').'<br>';
echo 'repo_pub_ajax - consulta[busqueda]: '.$consulta['busqueda'].'<br>';
echo 'repo_pub_ajax - get busqueda_curso: '.$_GET["busqueda_curso"].'<br>';
echo 'repo_pub_ajax - consulta[busqueda_curso]: '.$consulta['busqueda_curso'].'<br><br>';
*/
?>
	</div>
	<?php foreach($categorias as $categoria){ ?>
	<div class="col-12 col-sm-6 col-md-4 mb-3">
		<a href="<?php echo base_url('repositorio?categoria='.$categoria->ID_CATEGORIA.'&orden_cat'.$consulta['orden_cat'].'&busqueda'.$consulta['busqueda'].'&busqueda_curso'.$consulta['busqueda_curso'].'&busqueda_recurso'.$consulta['busqueda_recurso']); ?>" class="d-block">
			<div class="card single-promo-card single-promo-hover text-center shadow-sm">
				<div class="card-header p-0">
						<img src="<?php echo base_url('contenido/img/categorias/'.$categoria->IMAGEN); ?>?v=1" class="d-block img-fluid" alt="">
				</div>
				<div class="card-body d-flex justify-content-between">
					<p class="h6" title="<?php echo $categoria->CATEGORIA_NOMBRE; ?>"><i class="fa fa-folder"></i> <?php echo character_limiter($categoria->CATEGORIA_NOMBRE,22); ?></p>
				</div>
			</div>
		</a>
	</div>
	<?php } ?>
</div>

<div class="row">
	<div class="col-12">
		<h5>Archivos</h5>
	</div>
	<?php foreach($archivos as $archivo){ ?>
		<div class="col-sm-12 col-lg-6">
			<a href="<?php echo base_url('repositorio/recurso/'.$archivo->ID); ?>">
				<div class="single-service rec-webtxt">
					<div class="genric-btn default circle"><i class="fas fa-file-alt"></i><?php echo $archivo->TIPO_RECURSO; ?></div>
					<div class="cbp-vm-title">
						<h5><?php echo $archivo->TITULO; ?></h5>
						<div class="cbp-vm-price"><?php echo $archivo->TITULO_CURSO; ?></div>
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
