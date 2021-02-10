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
				<a href="<?php echo base_url('admin/usuarios?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
					Usuarios | <?php echo $tipo; ?> </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<?php $padre = verificar_variable('GET','padre',0); if(!empty($padre)){ ?>
					<a href="<?php echo base_url('admin/usuarios?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
						<?php $categoria_padre = $this->GeneralModel->detalles('categorias',['ID_CATEGORIA'=>$padre]); ?>
						<?php echo $categoria_padre['CATEGORIA_NOMBRE']; ?> </a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
				<?php } ?>




				<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
			</div>
		</div>
		<div class="kt-subheader__toolbar">
			<div class="btn-group btn-group" role="group" aria-label="Barra de tareas">
				<a href="<?php echo base_url('admin/usuarios/form_correo_pass?tipo='.$tipo); ?>" class="btn btn-outline-info" id="boton_enviar_correo"> <i class="fa fa-envelope"></i> Enviar correo</a>
				<button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#actualizar_usuarios"><i class="fa fa-upload"></i> Actualizar (excel) <?php echo ini_get('upload_max_filesize'); ?></button>
				<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#importar_usuarios"><i class="fa fa-upload"></i> Importar (excel) <?php echo ini_get('upload_max_filesize'); ?></button>
				<a href="<?php echo base_url('admin/usuarios/descargar_excel?tipo='.$tipo.'&consulta='.base64_encode(json_encode($consulta))); ?>" class="btn btn-info"> <i class="fa fa-download"></i> Descargar</a>
          <a href="<?php echo base_url('admin/usuarios/crear?tipo='.$tipo.'&consulta='.base64_encode(json_encode($consulta))); ?>" class="btn btn-success"> <i class="fa fa-plus"></i> Nuevo</a>
      </div>
		</div>
	</div>
	<div class="modal fade" id="importar_usuarios" tabindex="-1" role="dialog" aria-labelledby="importar_usuarios" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Importar usuarios mediante excel</h5>
				</div>
				<div class="modal-body">
					<form class="" action="<?php echo base_url('admin/usuarios/importar_excel'); ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="tipo" value="<?php echo verificar_variable('GET','tipo',''); ?>">
						<div class="form-group">
							<label for="file">Archivo</label>
							<input type="file" class="form-control" name="file" value="" required>
						</div>
						<button type="submit" class="btn btn-success" name="button">Subir</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="actualizar_usuarios" tabindex="-1" role="dialog" aria-labelledby="importar_usuarios" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Actualizar usuarios con excel</h5>
				</div>
				<div class="modal-body">
					<form class="" action="<?php echo base_url('admin/usuarios/actualizar_datos_excel'); ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="tipo" value="<?php echo verificar_variable('GET','tipo',''); ?>">
						<div class="form-group">
							<label for="file">Archivo</label>
							<input type="file" class="form-control" name="file" value="" required>
						</div>
						<button type="submit" class="btn btn-success" name="button">Subir</button>
					</form>
				</div>
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
						Usuarios <?php echo $tipo; ?>
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<form class="form-inline" action="<?php echo base_url('admin/usuarios'); ?>" method="get" enctype="multipart/form-data">
						<input type="hidden" name="categoria" value="<?php echo $consulta['categoria']; ?>">
						<input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
						<div class="form-group mr-2">
							<select class="form-control" name="orden">
								<option value="">Ordenar por</option>
								<option value="ORDEN ASC" <?php if(isset($_GET['orden'])&&$_GET['orden']=='ORDEN ASC'){ echo 'selected'; } ?>>Orden Personalizado</option>
								<option value="USUARIO_NOMBRE ASC" <?php if(isset($_GET['orden'])&&$_GET['orden']=='USUARIO_NOMBRE ASC'){ echo 'selected'; } ?>>Nombre A-Z</option>
								<option value="USUARIO_NOMBRE DESC" <?php if(isset($_GET['orden'])&&$_GET['orden']=='USUARIO_NOMBRE DESC'){ echo 'selected'; } ?>>Nombre Z-A</option>
								<option value="USUARIO_APELLIDOS ASC" <?php if(isset($_GET['orden'])&&$_GET['orden']=='USUARIO_APELLIDOS ASC'){ echo 'selected'; } ?>>Apellidos A-Z</option>
								<option value="USUARIO_APELLIDOS DESC" <?php if(isset($_GET['orden'])&&$_GET['orden']=='USUARIO_APELLIDOS DESC'){ echo 'selected'; } ?>>Apellidos Z-A</option>
								<option value="FECHA_REGISTRO ASC" <?php if(isset($_GET['orden'])&&$_GET['orden']=='FECHA_REGISTRO ASC'){ echo 'selected'; } ?>>Fecha Registro mas antiguos</option>
								<option value="FECHA_REGISTRO DESC" <?php if(isset($_GET['orden'])&&$_GET['orden']=='FECHA_REGISTRO DESC'){ echo 'selected'; } ?>>Fecha Registro mas recientes</option>
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
						      		<th>Nombre</th>
											<th>Correo</th>
											<th>Teléfono</th>
											<th>Compañia</th>
											<th>Puesto</th>
											<th>Dirección</th>
						      		<th>Registrado el</th>
											<th>Correo</th>
											<th>Status</th>
											<th class="text-right">Contoles</th>
						    	</tr>
						  	</thead>
						  	<tbody>
								<?php foreach($usuarios as $usuario){ ?>
									<?php
									$meta = $this->GeneralModel->lista('extra_datos','',['ID_OBJETO'=>$usuario->ID_USUARIO,'TIPO_OBJETO'=>'usuario'],'','','');
									$extra_datos = array(); foreach($meta as $m){ $extra_datos[$m->DATO_NOMBRE]= $m->DATO_VALOR; }
									?>
						    	<tr>
						      	<th scope="row"><?php echo $usuario->ID_USUARIO; ?></th>
						      	<td><?php echo $usuario->USUARIO_NOMBRE.' '.$usuario->USUARIO_APELLIDOS; ?></td>
										<td><?php echo $usuario->USUARIO_CORREO; ?></td>
										<td><?php echo $usuario->USUARIO_TELEFONO; ?></td>
										<td><?php if(isset($extra_datos['compania'])){ echo $extra_datos['compania']; } ?></td>
										<td><?php if(isset($extra_datos['puesto'])){ echo $extra_datos['puesto']; } ?></td>
										<td>
											<?php if(isset($extra_datos['direccion'])){ echo $extra_datos['direccion']; } ?><br>
											<?php if(isset($extra_datos['codigo_postal'])){ echo $extra_datos['codigo_postal']; } ?><br>
											<?php if(isset($extra_datos['pais'])){ echo $extra_datos['pais']; } ?>
										</td>
										<td><?php echo date('d/m/Y',strtotime($usuario->FECHA_REGISTRO)); ?></td>

										<td class="text-center">
											<?php if($usuario->USUARIO_LISTA_DE_CORREO=='si'){ ?>
												<span class="text-success"> <i class="fa fa-envelope"></i> </span>
											<?php }else{ ?>
												<span class="text-secondary"> <i class="fa fa-envelope"></i> </span>
											<?php } ?>
										</td>
						      	<td>
											<?php if($usuario->ESTADO=='activo'){ ?>
                      <a href="<?php echo base_url('admin/usuarios/activar')."?id=".$usuario->ID_USUARIO."&estado=".$usuario->ESTADO."&tipo=".$usuario->TIPO; ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
                    <?php }else{ ?>
                      <a href="<?php echo base_url('admin/usuarios/activar')."?id=".$usuario->ID_USUARIO."&estado=".$usuario->ESTADO."&tipo=".$usuario->TIPO; ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
                    <?php } ?>
										</td>
										<td>
											<div class="btn-group float-right" role="group">
                      <a href="<?php echo base_url('admin/usuarios/actualizar?id='.$usuario->ID_USUARIO); ?>" class="btn btn-sm btn-warning" title="Editar"> <span class="fa fa-pencil-alt"></span> </a>
                      <button data-enlace='<?php echo base_url('admin/usuarios/borrar?id='.$usuario->ID_USUARIO); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar"> <span class="fa fa-trash"></span> </button>
                    </div>
										</td>
						    	</tr>
								<?php } ?>
						  	</tbody>
						</table>
						<?php if($cantidad_paginas>1){ ?>
						<div class="row justify-content-md-center">
							<div class="col-2">
								<a href="<?php echo base_url('admin/usuarios/?'.$consulta_anterior); ?>" class="btn btn-outline-primary btn-block <?php if($pagina == 1){ echo 'disabled'; } ?>"> <i class="fa fa-chevron-left"></i> Anterior</a>
							</div>
							<div class="col-2">
								<form class="enviar_enter" action="<?php echo base_url('admin/usuarios'); ?>" method="get">
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
								<a href="<?php echo base_url('admin/usuarios/?'.$consulta_siguiente); ?>" class="btn btn-outline-primary btn-block <?php if($pagina == $cantidad_paginas){ echo 'disabled'; } ?>"> Siguiente <i class="fa fa-chevron-right"></i> </a>
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
