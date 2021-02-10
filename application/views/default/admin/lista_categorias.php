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
				<a href="<?php echo base_url('admin/categorias?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
					Categorias | <?php echo $tipo; ?> </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<?php $padre = verificar_variable('GET','padre',0); if(!empty($padre)){ ?>
					<a href="<?php echo base_url('admin/categorias?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
						<?php $categoria_padre = $this->GeneralModel->detalles('categorias',['ID_CATEGORIA'=>$padre]); ?>
						<?php echo $categoria_padre['CATEGORIA_NOMBRE']; ?> </a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
				<?php } ?>

			</div>
		</div>
		<div class="kt-subheader__toolbar">
			<div class="btn-group btn-group" role="group" aria-label="Barra de tareas">
					<a href="<?php echo base_url('admin/categorias/papelera'); ?>" class="btn btn-outline-danger"> <i class="fa fa-trash"></i> ver papelera</a>
          <a href="<?php echo base_url('admin/categorias/crear?tipo_objeto='.$tipo_objeto.'&tipo='.$tipo.'&padre='.$padre."&consulta=".base64_encode(json_encode($consulta))); ?>" class="btn btn-success"> <i class="fa fa-plus"></i> Nuevo</a>
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
					<form class="form-inline" action="<?php echo base_url('admin/categorias'); ?>" method="get" enctype="multipart/form-data">
						<input type="hidden" name="tipo_objeto" value="<?php echo $tipo_objeto; ?>">
						<input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
						<input type="hidden" name="padre" value="<?php echo $padre; ?>">
						<div class="form-group mr-2">
							<select class="form-control" name="orden">
								<option value="">Ordenar por</option>
								<option value="CATEGORIA_NOMBRE ASC" <?php if(isset($_GET['orden'])&&$_GET['orden']=='CATEGORIA_NOMBRE ASC'){ echo 'selected'; } ?>>Alfabético A-Z</option>
								<option value="CATEGORIA_NOMBRE DESC" <?php if(isset($_GET['orden'])&&$_GET['orden']=='CATEGORIA_NOMBRE DESC'){ echo 'selected'; } ?>>Alfabético Z-A</option>
								<option value="ORDEN ASC" <?php if(isset($_GET['orden'])&&$_GET['orden']=='ORDEN ASC'){ echo 'selected'; } ?>>Orden Personalizado</option>
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
						      		<th>Nombre</th>
											<th>Descripción</th>
						      		<th>Estado</th>
											<th class="text-right">Subcategorías</th>
											<th class="text-right">Controles</th>
						    	</tr>
						  	</thead>
						  	<tbody class="ui-sortable" data-tabla="categorias" data-columna="ID_CATEGORIA">
								<?php foreach($categorias as $categoria){ ?>
									<tr id="item-<?php echo $categoria->ID_CATEGORIA; ?>" class="ui-sortable-handle">
						      	<th scope="row"><?php echo $categoria->ID_CATEGORIA; ?></th>
										<td>
											<img src="<?php echo base_url('contenido/img/categorias/'.$categoria->IMAGEN); ?>" alt="" width="50px">
										</td>
										<?php $color = $this->GeneralModel->detalles('extra_datos',['DATO_NOMBRE'=>'color','ID_OBJETO'=>$categoria->ID_CATEGORIA,'TIPO_OBJETO'=>'categoria']); ?>
						      	<td><?php echo $categoria->CATEGORIA_NOMBRE; ?><br>
											<i style="display: block; width: 100%; height: 20px; background-color:<?php echo $color['DATO_VALOR']; ?>"></i>
										</td>
										<td><?php echo word_limiter($categoria->CATEGORIA_DESCRIPCION,10); ?></td>
						      	<td>
											<?php if($categoria->ESTADO=='activo'){ ?>
                      <a href="<?php echo base_url('admin/categorias/activar')."?id=".$categoria->ID_CATEGORIA."&estado=".$categoria->ESTADO."&consulta=".base64_encode(json_encode($consulta)); ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
                    <?php } ?>
										<?php if($categoria->ESTADO=='inactivo'){ ?>
                      <a href="<?php echo base_url('admin/categorias/activar')."?id=".$categoria->ID_CATEGORIA."&estado=".$categoria->ESTADO."&consulta=".base64_encode(json_encode($consulta)); ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
                    <?php } ?>
										<?php if($categoria->ESTADO=='papelera'){ ?>
                      <a href="<?php echo base_url('admin/categorias/activar')."?id=".$categoria->ID_CATEGORIA."&estado=inactivo&consulta=".base64_encode(json_encode($consulta)); ?>" class="btn btn-sm btn-outline-danger"> Restaurar </a>
                    <?php } ?>
										</td>
						      	<td class="text-right">
											<?php if($categoria->ESTADO!='papelera'){ ?>
											<a href="<?php echo base_url('admin/categorias/?tipo_objeto='.$consulta['tipo_objeto'].'&tipo='.$consulta['tipo'].'&padre='.$categoria->ID_CATEGORIA.'&orden='.$consulta['orden'].'&mostrar_por_pagina='.$consulta['mostrar_por_pagina'].'&busqueda='); ?>"
												class="btn btn-sm btn-info"> <i class="fa fa-list"></i> Subcategorias</a>
											<?php if($categoria->TIPO_OBJETO=='publicacion'){ ?>
											<a href="<?php echo base_url('admin/categorias/?tipo_objeto='.$consulta['tipo_objeto'].'&tipo='.$consulta['tipo'].'&padre='.$categoria->ID_CATEGORIA.'&orden='.$consulta['orden'].'&mostrar_por_pagina='.$consulta['mostrar_por_pagina'].'&busqueda='); ?>"
												class="btn btn-sm btn-info"> <i class="fa fa-list"></i> Contenido</a>
												<?php } ?>
											<?php } ?>
										</td>
										<td>
											<div class="btn-group float-right" role="group">
											<?php if($categoria->ESTADO!='papelera'){ ?>
                      	<a href="<?php echo base_url('admin/categorias/actualizar?id='.$categoria->ID_CATEGORIA."&consulta=".base64_encode(json_encode($consulta))); ?>" class="btn btn-sm btn-warning" title="Editar"> <span class="fa fa-pencil-alt"></span> </a>
												<button data-enlace='<?php echo base_url('admin/categorias/borrar?id='.$categoria->ID_CATEGORIA."&consulta=".base64_encode(json_encode($consulta))); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar"> <span class="fa fa-trash"></span> </button>
											<?php } ?>
										</div>
										</td>
						    	</tr>
								<?php } ?>
						  	</tbody>
						</table>
						<?php if($cantidad_paginas>1){ ?>
						<div class="row justify-content-md-center">
							<div class="col-2">
								<a href="<?php echo base_url('admin/categorias/?'.$consulta_anterior); ?>" class="btn btn-outline-primary btn-block <?php if($pagina == 1){ echo 'disabled'; } ?>"> <i class="fa fa-chevron-left"></i> Anterior</a>
							</div>
							<div class="col-2">
								<form class="enviar_enter" action="<?php echo base_url('admin/categorias'); ?>" method="get">
									<input type="hidden" name="tipo_objeto" value="<?php echo $consulta['tipo_objeto'] ?>">
									<input type="hidden" name="tipo" value="<?php echo $consulta['tipo'] ?>">
									<input type="hidden" name="padre" value="<?php echo $consulta['padre'] ?>">
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
								<a href="<?php echo base_url('admin/categorias/?'.$consulta_siguiente); ?>" class="btn btn-outline-primary btn-block <?php if($pagina == $cantidad_paginas){ echo 'disabled'; } ?>"> Siguiente <i class="fa fa-chevron-right"></i> </a>
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
