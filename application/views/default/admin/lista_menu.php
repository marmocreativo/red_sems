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
				<a href="<?php echo base_url('admin/menu'); ?>" class="kt-subheader__breadcrumbs-link">
					Menu </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>




				<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
			</div>
		</div>
	</div>

	<!-- end:: Subheader -->

	<!-- begin:: Content -->
	<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
		<?php retro_alimentacion(); ?>

		<div class="row">
			<div class="col-12 col-md-4">
				<!--begin::Portlet-->
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								Agregar Enlace
							</h3>
						</div>
						<div class="kt-portlet__head-toolbar">
						</div>
					</div>
					<div class="kt-portlet__body">
						<!--begin::Section-->
						<div class="kt-section">
							<div class="kt-section__content">
								<!-- Publicaciones -->
								<?php $tipos_publicaciones = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'publicaciones'],'','',''); ?>
					      <?php foreach($tipos_publicaciones as $tipo_publicacion){ ?>
									<h5><?php echo $tipo_publicacion->TIPO_NOMBRE_PLURAL; ?></h5>
									<form class="form-inline" action="<?php echo base_url('admin/menu_crear'); ?>" method="post">
										<input type="hidden" name="TipoElemento" value="enlace_externo">
										<input type="hidden" name="MenuGrupo" value="<?php echo $grupo; ?>">
										<input type="hidden" name="Etiqueta" value="<?php echo $tipo_publicacion->TIPO_NOMBRE_PLURAL; ?>">
										<input type="hidden" class="form-control" name="Enlace" value="<?php echo base_url('tipo/'.$tipo_publicacion->TIPO_NOMBRE); ?>">
										<div class="form-group">
											<label for="Enlace">Todas las <?php echo $tipo_publicacion->TIPO_NOMBRE_PLURAL; ?></label>
										</div>
											<button type="submit"class="btn btn-primary btn-sm ml-auto"> <i class="fa fa-plus"></i> Añadir</button>
									</form>
									<hr>
									<div class="card">
										<div class="card-header">
											<p class="float-left">Categorias</p>
											<button type="button" class="btn btn-sm btn-clean float-right" name="button" data-toggle="collapse" data-target="#categorias_<?php echo $tipo_publicacion->TIPO_NOMBRE; ?>"
												aria-expanded="false" aria-controls="categorias_<?php echo $tipo_publicacion->TIPO_NOMBRE; ?>"> <i class="fa fa-chevron-down"></i> </button>
										</div>
										<div class="card-body collapse" id='categorias_<?php echo $tipo_publicacion->TIPO_NOMBRE; ?>'>
											<form class="" action="<?php echo base_url('admin/menu_crear'); ?>" method="post">
												<input type="hidden" name="TipoElemento" value="categoria">
												<input type="hidden" name="MenuGrupo" value="principal">
												<?php
													$id_categorias_seleccionadas = array();
													multinivel($tipo_publicacion->TIPO_NOMBRE,'radio',$id_categorias_seleccionadas,0);
												?>
												<div class="btn-group">
													<button type="submit"class="btn btn-primary btn-sm"> <i class="fa fa-save"></i> Agregar</button>
												</div>
											</form>
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<p class="float-left">Publicaciones</p>
											<button type="button" class="btn btn-sm btn-clean float-right" name="button" data-toggle="collapse" data-target="#publicaciones_<?php echo $tipo_publicacion->TIPO_NOMBRE; ?>"
												aria-expanded="false" aria-controls="publicaciones_<?php echo $tipo_publicacion->TIPO_NOMBRE; ?>"> <i class="fa fa-chevron-down"></i> </button>
										</div>
										<div class="card-body collapse" id='publicaciones_<?php echo $tipo_publicacion->TIPO_NOMBRE; ?>'>
											<form class="" action="<?php echo base_url('admin/menu_crear'); ?>" method="post">
												<input type="hidden" name="TipoElemento" value="publicacion">
												<input type="hidden" name="MenuGrupo" value="<?php echo $grupo; ?>">
												<?php
													$publicaciones = $this->GeneralModel->lista('publicaciones','',['TIPO'=>$tipo_publicacion->TIPO_NOMBRE,'ESTADO'=>'activo'],'ORDEN ASC','','');
												?>
												<div class="form-group">
													<select class="form-control" name="IdPublicacion">
													<?php foreach($publicaciones as $publicacion){ ?>
														<option value="<?php echo $publicacion->ID_PUBLICACION; ?>"><?php echo $publicacion->PUBLICACION_TITULO; ?></option>
													<?php } ?>
													</select>
												</div>
												<div class="btn-group">
													<button type="submit"class="btn btn-primary btn-sm"> <i class="fa fa-save"></i> Agregar</button>
												</div>
											</form>
										</div>
									</div>
									<hr>
								<?php } ?>
								<!-- Enlace Libre -->
								<h6>Otros</h6>
									<form class="form-inline" action="<?php echo base_url('admin/menu_crear'); ?>" method="post">
										<input type="hidden" name="TipoElemento" value="enlace_externo">
										<input type="hidden" name="MenuGrupo" value="<?php echo $grupo; ?>">
										<input type="hidden" name="Etiqueta" value="Contacto">
										<input type="hidden" class="form-control" name="Enlace" value="<?php echo base_url('contacto'); ?>">
										<div class="form-group">
											<label for="Enlace">Página de contacto</label>
										</div>
											<button type="submit"class="btn btn-primary btn-sm ml-auto"> <i class="fa fa-plus"></i> Añadir</button>
									</form>
									<hr>
									<form class="form-inline" action="<?php echo base_url('admin/menu_crear'); ?>" method="post">
										<input type="hidden" name="TipoElemento" value="enlace_externo">
										<input type="hidden" name="MenuGrupo" value="<?php echo $grupo; ?>">
										<input type="hidden" name="Etiqueta" value="Todas las categorias">
										<input type="hidden" class="form-control" name="Enlace" value="<?php echo base_url('tipo/-'); ?>">
										<div class="form-group">
											<label for="Enlace">Indice de Categorías</label>
										</div>
											<button type="submit"class="btn btn-primary btn-sm ml-auto"> <i class="fa fa-plus"></i> Añadir</button>
									</form>
									<hr>
								<div class="card">
									<div class="card-header">
										<h6 class="float-left">Enlace Libre</h6>
										<button type="button" class="btn btn-sm btn-clean float-right" name="button" data-toggle="collapse" data-target="#enlace_externo" aria-expanded="false" aria-controls="enlace_externo"> <i class="fa fa-chevron-down"></i> </button>
									</div>
									<div class="card-body collapse" id='enlace_externo'>
										<form class="" action="<?php echo base_url('admin/menu_crear'); ?>" method="post">
											<input type="hidden" name="TipoElemento" value="enlace_externo">
											<input type="hidden" name="MenuGrupo" value="<?php echo $grupo; ?>">
											<div class="form-group">
												<label for="Etiqueta">Etiqueta</label>
												<input type="text" class="form-control" name="Etiqueta" value="">
											</div>
											<div class="form-group">
												<label for="Enlace">Enlace</label>
												<input type="text" class="form-control" name="Enlace" value="">
											</div>
											<div class="btn-group">
												<button type="submit"class="btn btn-primary btn-sm"> <i class="fa fa-save"></i> Guardar</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!--end::Section-->
					</div>
					<!--end::Form-->
				</div>
				<!--end::Portlet-->
			</div>
			<div class="col-12 col-md-8">
				<!--begin::Portlet-->
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								Menú
							</h3>
						</div>
						<div class="kt-portlet__head-toolbar">

						</div>
					</div>
					<div class="kt-portlet__body">
						<!--begin::Section-->
						<div class="kt-section">
							<div class="kt-section__content">
								<?php
								function administrador_menu($grupo,$nivel = 0) {
									  $CI =& get_instance();
									$elementos = $CI->GeneralModel->lista('menu','',['MENU_PADRE'=>$nivel,'TIPO'=>$grupo],'ORDEN ASC','','');
									if($nivel==0){ $clase_lista = "menu-sortable"; $clase_colapsable = 'collapse'; }else{ $clase_lista = ""; $clase_colapsable = 'collapse';}
									//Creo la lista del menú

									echo "<ol class='".$clase_lista."'>";
									//Por cada resultado reviso si tienen elementos hijos
									foreach($elementos as $nivel){
										$elementos_hijos = $CI->GeneralModel->lista('menu','',['MENU_PADRE'=>$nivel->ID_MENU,'TIPO'=>$grupo],'ORDEN ASC','','');

										echo "<li class='list-group-item' id='elementos_".$nivel->ID_MENU."'>";
											echo '<div class="mb-3">'.$nivel->MENU_ETIQUETA;
												echo ' | <button type="button" class="btn btn-sm btn-outline-warning" data-toggle="collapse" data-target="#elemento_'.$nivel->ID_MENU.'" name="button"><i class="fa fa-pencil-alt"></i></button>';
												echo '<button data-enlace="'.base_url('admin/menu_borrar?id='.$nivel->ID_MENU).'" class="btn btn-sm btn-outline-danger ml-2 borrar_entrada" title="Eliminar"> <span class="fa fa-trash"></span> </button></div>';
												echo "<div class='".$clase_colapsable."' id='elemento_".$nivel->ID_MENU."'>";
												echo '
													<form class="mb-3" action="'.base_url('admin/menu_actualizar').'" method="post">
													<input type="hidden" name="Identificador" value="'.$nivel->ID_MENU.'">
														<div class="form-group">
															<label for="Etiqueta">Etiqueta</label>
															<input type="text" class="form-control" name="Etiqueta" value="'.$nivel->MENU_ETIQUETA.'">
														</div>
														<div class="form-group">
															<label for="Enlace">Enlace</label>
															<input type="text" class="form-control" name="Enlace" value="'.$nivel->MENU_ENLACE.'">
														</div>
														<button type="submit"class="btn btn-primary btn-sm"> <i class="fa fa-save"></i> Actualizar</button>
													</form>
												';
												echo "</div>";
											if(!empty($elementos_hijos)) {
												administrador_menu($grupo,$nivel->ID_MENU);
											}
										echo "</li>";
									}
									echo "</ol>";
								}
								administrador_menu($grupo,0);
								?>
							</div>
						</div>
						<!--end::Section-->
					</div>
					<!--end::Form-->
				</div>
				<!--end::Portlet-->
			</div>
		</div>

	</div>

	<!-- end:: Content -->
