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
				<a href="<?php echo base_url('admin/tipos?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
					Tipos | <?php echo $tipo; ?> </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<?php $padre = verificar_variable('GET','padre',0); if(!empty($padre)){ ?>
					<a href="<?php echo base_url('admin/tipos?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
						<?php $categoria_padre = $this->GeneralModel->detalles('categorias',['ID_CATEGORIA'=>$padre]); ?>
						<?php echo $categoria_padre['CATEGORIA_NOMBRE']; ?> </a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
				<?php } ?>




				<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
			</div>
		</div>
		<div class="kt-subheader__toolbar">
			<div class="btn-group btn-group" role="group" aria-label="Barra de tareas">
          <a href="<?php echo base_url('admin/divisas/crear'); ?>" class="btn btn-success"> <i class="fa fa-plus"></i> Nuevo</a>
      </div>
		</div>
	</div>

	<!-- end:: Subheader -->

	<!-- begin:: Content -->
	<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
		<?php retro_alimentacion(); ?>
		<!--begin::Portlet-->
		<div class="kt-portlet col-6">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						Divisas
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<form class="form-inline" action="<?php echo base_url('admin/divisas'); ?>" method="get" enctype="multipart/form-data">
						<input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
						<div class="form-group">
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
											<th>ISO</th>
						      		<th>Nombre</th>
											<th>Signo</th>
											<th>Tipo de cambio</th>
											<th>Principal</th>
											<th>Estado</th>
											<th class="text-right">Controles</th>
						    	</tr>
						  	</thead>
						  	<tbody>
								<?php foreach($divisas as $divisa){ ?>
						    	<tr>
						      	<th scope="row"><?php echo $divisa->ID_DIVISA; ?></th>
						      	<td><?php echo $divisa->DIVISA_ISO; ?></td>
										<td><?php echo $divisa->DIVISA_NOMBRE; ?></td>
										<td><?php echo $divisa->DIVISA_SIGNO; ?></td>
										<td><?php echo $divisa->DIVISA_CAMBIO; ?></td>
										<td>
											<?php if($divisa->DIVISA_PRINCIPAL=='si'){ ?>
	                      <a href="JavaScript:Void(0);" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
	                    <?php }else{ ?>
	                      <a href="<?php echo base_url('admin/divisas/principal')."?id=".$divisa->ID_DIVISA."&principal=".$divisa->DIVISA_PRINCIPAL; ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
	                    <?php } ?>
										</td>
										<td>
											<?php if($divisa->ESTADO=='activo'){ ?>
												<?php if($divisa->DIVISA_PRINCIPAL=='si'){ ?>
													<a href="JavaScript:Void(0);" class="btn btn-sm btn-outline-success" title="No puedes desactivar la divisa principal"> <span class="fa fa-check-circle"></span> </a>
												<?php }else{ ?>
													<a href="<?php echo base_url('admin/divisas/activar')."?id=".$divisa->ID_DIVISA."&estado=".$divisa->ESTADO; ?>" class="btn btn-sm btn-outline-success"> <span class="fa fa-check-circle"></span> </a>
												<?php } ?>

	                    <?php }else{ ?>
	                      <a href="<?php echo base_url('admin/divisas/activar')."?id=".$divisa->ID_DIVISA."&estado=".$divisa->ESTADO; ?>" class="btn btn-sm btn-outline-danger"> <span class="fa fa-times-circle"></span> </a>
	                    <?php } ?>
										</td>
										<td>
											<div class="btn-group float-right" role="group">
                      <a href="<?php echo base_url('admin/divisas/actualizar?id='.$divisa->ID_DIVISA); ?>" class="btn btn-sm btn-warning" title="Editar"> <span class="fa fa-pencil-alt"></span> </a>
											<?php if($divisa->DIVISA_PRINCIPAL=='no'){ ?>
                      <button data-enlace='<?php echo base_url('admin/divisas/borrar?id='.$divisa->ID_DIVISA); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar"> <span class="fa fa-trash"></span> </button>
											<?php } ?>
                    </div>
										</td>
						    	</tr>
								<?php } ?>
						  	</tbody>
						</table>
					</div>
				</div>
				<!--end::Section-->
			</div>
			<!--end::Form-->
		</div>
		<!--end::Portlet-->
	</div>

	<!-- end:: Content -->
