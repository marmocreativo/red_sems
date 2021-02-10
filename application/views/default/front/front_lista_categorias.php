<!------------------------------------------
HEADER
------------------------------------------->
<div class="jumbotron jumbotron-fluid mb-3 pb-4 bg-primary overlay overlay-black position-relative" style="background-size:cover; background-position: center; background-image:url(<?php echo base_url('assets/img/main_bg.jpg'); ?>">
	<div class="container text-white h-100 tofront">
		<div class="row align-items-center justify-content-center text-center">
			<div class="col-md-10">
				<h1 class="titulo-pagina">  Indice de Categorías</h1>
			</div>
		</div>
	</div>
</div>
<!-- End Header -->

<!-- Main -->
<div class="contenido-principal">
  <div class="container pt-5 pb-5">
    <?php $tipos_publicaciones = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'publicaciones'],'','',''); ?>
    <?php foreach($tipos_publicaciones as $tipo_publicacion){ ?>
		<div class="row">
			<?php $categorias_hijas = $this->GeneralModel->lista('categorias','',['TIPO'=>$tipo_publicacion->TIPO_NOMBRE,'CATEGORIA_PADRE'=>'0','ESTADO'=>'activo','VISIBLE'=>'visible'],'ORDEN ASC','',''); ?>
			<?php if(!empty($categorias_hijas)){ ?>
			<div class="col-12">
				<div class="text-center py-3">
		      <h2 class="h2 text-primary"><?php echo $tipo_publicacion->TIPO_NOMBRE_PLURAL ?></h2>
		    </div>
			</div>
			<?php foreach($categorias_hijas as $categoria_hij){ ?>
        <div class="col-12 col-sm-6">
					<!-- Featured Card Blog -->
					<a href="<?php echo base_url('categoria/'.$categoria_hij->URL); ?>">
						<div class="card flex-md-row mb-4 box-shadow">
							<div class="card-img-right flex-auto w-25 d-none d-md-block">
								<img class="img-fluid" src="<?php echo base_url('contenido/img/categorias/'.$categoria_hij->IMAGEN); ?>">
							</div>
						    <div class="card-body w-75 align-items-start">
						        <h4 class="mb-0">
						        	<?php echo $categoria_hij->CATEGORIA_NOMBRE ?>
						        </h4>
						        <p class="card-text mb-auto">
						            <?php echo word_limiter($categoria_hij->CATEGORIA_DESCRIPCION, 10); ?>
						        </p>
						    </div>
						</div>
					</a>
        </div>
      <?php } ?>
		<?php }// Condicional si existe ?>
		</div>
  <?php } // Termina bucle de tipos ?>
  </div>
</div>
<!-- End Main -->
