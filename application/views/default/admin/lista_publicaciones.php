<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				<?php echo $op['titulo_sitio'] ?> </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="<?php echo base_url('admin'); ?>" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="<?php echo base_url('admin'); ?>" class="kt-subheader__breadcrumbs-link">
					Administrador </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="<?php echo base_url('admin/publicaciones?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
					Publicaciones | <?php echo $tipo; ?> </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<?php $padre = verificar_variable('GET','padre',0); if(!empty($padre)){ ?>
					<a href="<?php echo base_url('admin/publicaciones?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
						<?php $categoria_padre = $this->GeneralModel->detalles('categorias',['ID_CATEGORIA'=>$padre]); ?>
						<?php echo $categoria_padre['CATEGORIA_NOMBRE']; ?> </a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
				<?php } ?>




				<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
			</div>
		</div>
		<div class="kt-subheader__toolbar">
			<div class="btn-group btn-group" role="group" aria-label="Barra de tareas">
				<a href="<?php echo base_url('admin/publicaciones/papelera'); ?>" class="btn btn-outline-danger"> <i class="fa fa-trash"></i> ver papelera</a>
          <a href="<?php echo base_url('admin/publicaciones/crear?tipo='.$tipo."&consulta=".base64_encode(json_encode($consulta))); ?>" class="btn btn-success"> <i class="fa fa-plus"></i> Nuevo</a>
      </div>
		</div>
	</div>

	<!-- end:: Subheader -->

	<!-- begin:: Content -->
	<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
		<?php retro_alimentacion(); ?>
		<!--begin::Portlet-->
		<div class="kt-portlet">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						Mostrando <?php echo $pub_por_pagina; ?> de <?php echo $pub_totales; ?> | Página <?php echo $pagina; ?>
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<form class="form-inline" action="<?php echo base_url('admin/publicaciones'); ?>" method="get" enctype="multipart/form-data">
						<input type="hidden" name="categoria" value="<?php echo $consulta['categoria']; ?>">
						<input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
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
								<option value="ID_PUBLICACION ASC" <?php if(isset($_GET['orden'])&&$_GET['orden']=='ID_PUBLICACION ASC'){ echo 'selected'; } ?>>ID mas antiguos</option>
								<option value="ID_PUBLICACION DESC" <?php if(isset($_GET['orden'])&&$_GET['orden']=='ID_PUBLICACION DESC'){ echo 'selected'; } ?>>ID mas recientes</option>
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
						<button type="submit" class="btn btn-primary"> <i class="fa fa-search"></i> </button>

					</form>
				</div>
			</div>
			<div class="kt-portlet__body">
				<!--begin::Section-->
				<div class="kt-section">
					<div class="kt-section__content">
						<table class="table table-sm table-striped">
						  	<thead>
						    	<tr>
						      		<th>#</th>
											<th>Imágen</th>
						      		<th>Titulo</th>
											<th>Resumen</th>
											<th>Creado</th>
						      		<th>Publicado</th>
											<th>Actualizado</th>
											<th>Estado</th>
											<th class="text-right">Contoles</th>
						    	</tr>
						  	</thead>
						  	<tbody class="ui-sortable" data-tabla="publicaciones" data-columna="ID_PUBLICACION">
								<?php foreach($publicaciones as $publicacion){ ?>
						    	<tr id="item-<?php echo $publicacion->ID_PUBLICACION; ?>" class="ui-sortable-handle">
						      	<th scope="row"><?php echo $publicacion->ID_PUBLICACION; ?></th>
										<td>
											<img src="<?php echo base_url('contenido/img/publicaciones/'.$publicacion->IMAGEN); ?>" alt="" width="50px">
										</td>
						      	<td><?php echo word_limiter($publicacion->PUBLICACION_TITULO,10); ?></td>
										<td><?php echo word_limiter($publicacion->PUBLICACION_RESUMEN,10); ?></td>
										<td><?php echo date('d/m/Y',strtotime($publicacion->FECHA_REGISTRO)); ?></td>
										<td><?php echo date('d/m/Y',strtotime($publicacion->FECHA_PUBLICACION)); ?></td>
										<td><?php echo date('d/m/Y',strtotime($publicacion->FECHA_ACTUALIZACION)); ?></td>
						      	<td>
										<?php if($publicacion->ESTADO=='activo'){ ?>
                      <a href="<?php echo base_url('admin/publicaciones/activar')."?id=".$publicacion->ID_PUBLICACION."&estado=".$publicacion->ESTADO."&consulta=".base64_encode(json_encode($consulta)); ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
										<?php } ?>
										<?php if($publicacion->ESTADO=='inactivo'){ ?>
                      <a href="<?php echo base_url('admin/publicaciones/activar')."?id=".$publicacion->ID_PUBLICACION."&estado=".$publicacion->ESTADO."&consulta=".base64_encode(json_encode($consulta)); ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
										<?php } ?>
										<?php if($publicacion->ESTADO=='papelera'){ ?>
											<a href="<?php echo base_url('admin/publicaciones/activar')."?id=".$publicacion->ID_PUBLICACION."&estado=inactivo&consulta=".base64_encode(json_encode($consulta)); ?>" class="btn btn-sm btn-outline-danger"> Restaurar </a>
                    <?php } ?>
										</td>
										<td>
											<div class="btn-group float-right" role="group">
                      <a href="<?php echo base_url('admin/publicaciones/actualizar?id='.$publicacion->ID_PUBLICACION."&consulta=".base64_encode(json_encode($consulta))); ?>" class="btn btn-sm btn-warning" title="Editar"> <span class="fa fa-pencil-alt"></span> </a>
                      <button data-enlace='<?php echo base_url('admin/publicaciones/borrar?id='.$publicacion->ID_PUBLICACION."&consulta=".base64_encode(json_encode($consulta))); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar"> <span class="fa fa-trash"></span> </button>
                    </div>
										</td>
						    	</tr>
								<?php } ?>
						  	</tbody>
						</table>
						<?php if($cantidad_paginas>1){ ?>
						<div class="row justify-content-md-center">
							<div class="col-2">
								<a href="<?php echo base_url('admin/publicaciones/?'.$consulta_anterior); ?>" class="btn btn-outline-primary btn-block <?php if($pagina == 1){ echo 'disabled'; } ?>"> <i class="fa fa-chevron-left"></i> Anterior</a>
							</div>
							<div class="col-2">
								<form class="enviar_enter" action="<?php echo base_url('admin/publicaciones'); ?>" method="get">
									<input type="hidden" name="categoria" value="<?php echo $consulta['categoria'] ?>">
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
								<a href="<?php echo base_url('admin/publicaciones/?'.$consulta_siguiente); ?>" class="btn btn-outline-primary btn-block <?php if($pagina == $cantidad_paginas){ echo 'disabled'; } ?>"> Siguiente <i class="fa fa-chevron-right"></i> </a>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<!--end::Section-->
			</div>
			<!--end::Form-->
		</div>
		<!--end::Portlet-->
	</div>

	<!-- end:: Content -->
