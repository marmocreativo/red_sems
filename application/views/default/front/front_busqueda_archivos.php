<!------------------------------------------
HEADER
------------------------------------------->
<div class="jumbotron jumbotron-fluid mb-3 pb-4 bg-primary overlay overlay-black position-relative" style="background-size:cover; background-position: center; background-image:url(<?php echo base_url('assets/img/main_bg.jpg'); ?>">
	<div class="container text-white h-100 tofront">
		<div class="row align-items-center justify-content-center text-center">
			<div class="col-md-10">
				<h1 class="titulo-pagina"> Resultados de la busqueda</h1>
				<p><b>términos de busqueda: </b><?php echo $this->input->get('busqueda'); ?></p>

        <!-- AddToAny BEGIN -->
        <div class="a2a_kit a2a_kit_size_32 a2a_default_style d-flex justify-content-center">
        <a class="a2a_button_facebook"></a>
        <a class="a2a_button_twitter"></a>
        <a class="a2a_button_whatsapp"></a>
        <a class="a2a_button_pinterest"></a>
        </div>
        <script async src="https://static.addtoany.com/menu/page.js"></script>
        <!-- AddToAny END -->
			</div>
		</div>
	</div>
</div>
<!-- End Header -->

<!-- Main -->
<div class="container">
	<div class="row">
		<div class="col">
				<div class="p-2 d-flex justify-content-end">
					<form class="form-inline" action="<?php echo base_url('busqueda'); ?>" method="get" enctype="multipart/form-data">
						<div class="form-group mr-2">
							<select class="form-control" name="tipo">
								<?php $tipos_publicaciones = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'publicaciones'],'','',''); ?>
								<?php foreach($tipos_publicaciones as $tipo_pub){ ?>
									<option value="<?php echo $tipo_pub->TIPO_NOMBRE; ?>" <?php if(isset($_GET['tipo'])&&$_GET['tipo']==$tipo_pub->TIPO_NOMBRE){ echo 'selected'; } ?>><?php echo $tipo_pub->TIPO_NOMBRE_PLURAL; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group mr-2">
							<select class="form-control" name="orden">
								<option value="">Ordenar por</option>
								<option value="ORDEN ASC" <?php if(isset($_GET['orden'])&&$_GET['orden']=='ORDEN ASC'){ echo 'selected'; } ?>>Orden Personalizado</option>
								<option value="PUBLICACION_TITULO ASC" <?php if(isset($_GET['orden'])&&$_GET['orden']=='PUBLICACION_TITULO ASC'){ echo 'selected'; } ?>>Alfabético A-Z</option>
								<option value="PUBLICACION_TITULO DESC" <?php if(isset($_GET['orden'])&&$_GET['orden']=='PUBLICACION_TITULO DESC'){ echo 'selected'; } ?>>Alfabético Z-A</option>
								<option value="FECHA_ACTUALIZACION ASC" <?php if(isset($_GET['orden'])&&$_GET['orden']=='FECHA_ACTUALIZACION ASC'){ echo 'selected'; } ?>>Actualizado mas antiguo</option>
								<option value="FECHA_ACTUALIZACION DESC" <?php if(isset($_GET['orden'])&&$_GET['orden']=='FECHA_ACTUALIZACION DESC'){ echo 'selected'; } ?>>Actualizado mas reciente</option>
								<option value="FECHA_PUBLICACION ASC" <?php if(isset($_GET['orden'])&&$_GET['orden']=='FECHA_PUBLICACION ASC'){ echo 'selected'; } ?>>Fecha Publicación mas antiguos</option>
								<option value="FECHA_PUBLICACION DESC" <?php if(isset($_GET['orden'])&&$_GET['orden']=='FECHA_PUBLICACION DESC'){ echo 'selected'; } ?>>Fecha Publicación mas recientes</option>
							</select>
						</div>
						<div class="form-group mr-2">
							<select class="form-control" name="mostrar_por_pagina">
								<option value="">mostrar por página</option>
								<option value="<?php echo $op['cantidad_publicaciones_por_pagina'] ?>" <?php if(isset($_GET['mostrar_por_pagina'])&&$_GET['mostrar_por_pagina']==$op['cantidad_publicaciones_por_pagina']){ echo 'selected'; } ?>>Mostrar <?php echo $op['cantidad_publicaciones_por_pagina'] ?></option>
								<option value="<?php echo $op['cantidad_publicaciones_por_pagina']*2; ?>" <?php if(isset($_GET['mostrar_por_pagina'])&&$_GET['mostrar_por_pagina']==$op['cantidad_publicaciones_por_pagina']*2){ echo 'selected'; } ?>>Mostrar <?php echo $op['cantidad_publicaciones_por_pagina']*2; ?></option>
								<option value="<?php echo $op['cantidad_publicaciones_por_pagina']*5; ?>" <?php if(isset($_GET['mostrar_por_pagina'])&&$_GET['mostrar_por_pagina']==$op['cantidad_publicaciones_por_pagina']*5){ echo 'selected'; } ?>>Mostrar <?php echo $op['cantidad_publicaciones_por_pagina']*5; ?></option>
								<option value="<?php echo $op['cantidad_publicaciones_por_pagina']*10; ?>" <?php if(isset($_GET['mostrar_por_pagina'])&&$_GET['mostrar_por_pagina']==$op['cantidad_publicaciones_por_pagina']*10){ echo 'selected'; } ?>>Mostrar <?php echo $op['cantidad_publicaciones_por_pagina']*10; ?></option>
							</select>
						</div>
						<div class="form-group mr-2">
							<input type="text" class="form-control" name="busqueda" value="<?php echo verificar_variable('GET','busqueda',''); ?>" placeholder="Buscar">
						</div>
						<button type="submit" class="btn btn-primary"> <i class="fa fa-search"></i> Buscar</button>

					</form>
				</div>
		</div>
	</div>
</div>
<div class="contenido-principal">
  <div class="container pt-5 pb-5">
  	<div class="row justify-content-center">
  		<div class="col-12">
        <div class="row">
          <?php foreach($publicaciones as $publicacion){ ?>
            <div class="col-12 col-sm-6 col-md-3 mb-4">
              <div class="card">
                <a href="<?php echo base_url($publicacion->URL); ?>">
                <img src="<?php echo base_url('contenido/img/publicaciones/'.$publicacion->IMAGEN); ?>" class="card-img-top" alt="...">
                <div class="card-body text-center">
                  <h5 class="card-title"><?php echo $publicacion->PUBLICACION_TITULO ?></h5>
                  <p class="card-text"><?php echo word_limiter($publicacion->PUBLICACION_RESUMEN, 10); ?></p>
                </div>
                </a>
              </div>
            </div>
          <?php } ?>
    			<?php if(empty($publicaciones)){ echo '<div class="col text-center"><h5 class="text-center">Lo sentimos por el momento no hay publicaciones en esta categoría</h5></div>'; } ?>
        </div>
				<?php if($cantidad_paginas>1){ ?>
				<div class="row justify-content-md-center">
					<div class="col-2">
						<a href="<?php echo base_url('busqueda?'.$consulta_anterior); ?>" class="btn btn-outline-primary btn-block <?php if($pagina == 1){ echo 'disabled'; } ?>"> <i class="fa fa-chevron-left"></i> Anterior</a>
					</div>
					<div class="col-2">
						<form class="enviar_enter" action="<?php echo base_url('busqueda'); ?>" method="get">
							<input type="hidden" name="tipo" value="<?php echo $consulta['tipo'] ?>">
							<input type="hidden" name="orden" value="<?php echo $consulta['orden'] ?>">
							<input type="hidden" name="mostrar_por_pagina" value="<?php echo $consulta['mostrar_por_pagina'] ?>">
							<input type="hidden" name="busqueda" value="<?php echo $consulta['busqueda'] ?>">
							<div class="form-group">
								<div class="input-group">
									<input type="number" class="form-control" name="pagina" value="<?php echo $pagina; ?>" min="1" max="<?php echo $cantidad_paginas; ?>">
									<div class="input-group-append">
										<span class="input-group-text">/<?php echo $cantidad_paginas; ?></span>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="col-2">
						<a href="<?php echo base_url('busqueda?'.$consulta_siguiente); ?>" class="btn btn-outline-primary btn-block <?php if($pagina == $cantidad_paginas){ echo 'disabled'; } ?>"> Siguiente <i class="fa fa-chevron-right"></i> </a>
					</div>
				</div>
				<?php } ?>
  		</div>

  	</div>

  </div>
</div>
<!-- End Main -->
