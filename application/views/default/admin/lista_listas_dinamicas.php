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
				<a href="<?php echo base_url('admin/sliders?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
					Listas Dinámicas | <?php echo $tipo; ?> </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<?php $padre = verificar_variable('GET','padre',0); if(!empty($padre)){ ?>
					<a href="<?php echo base_url('admin/listas_dinamicas?tipo='.$tipo); ?>" class="kt-subheader__breadcrumbs-link">
						<?php $categoria_padre = $this->GeneralModel->detalles('categorias',['ID_CATEGORIA'=>$padre]); ?>
						<?php echo $categoria_padre['CATEGORIA_NOMBRE']; ?> </a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
				<?php } ?>




				<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
			</div>
		</div>
		<div class="kt-subheader__toolbar">
			<div class="btn-group btn-group" role="group" aria-label="Barra de tareas">
          <a href="<?php echo base_url('admin/listas_dinamicas/crear?tipo='.$tipo); ?>" class="btn btn-success"> <i class="fa fa-plus"></i> Nuevo</a>
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
						Listas Dinámicas <?php echo $tipo; ?>
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
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
						      		<th>Titulo</th>
											<th>Tipo</th>
											<th>Categoria</th>
											<th>Límite</th>
											<th>Ordenar por</th>
											<th>No. de Columnas</th>
											<th class="text-right">Controles</th>
						    	</tr>
						  	</thead>
						  	<tbody class="ui-sortable" data-tabla="listas_dinamicas" data-columna="ID">
								<?php foreach($listas as $lista){ ?>
						    	<tr id="item-<?php echo $lista->ID; ?>" class="ui-sortable-handle">
						      	<th scope="row"><?php echo $lista->ID; ?></th>
						      	<td><?php echo $lista->LISTA_TITULO; ?></td>
										<td><?php echo $lista->TIPO_OBJETOS_HIJOS; ?></td>
										<td><?php echo $lista->ID_CATEGORIA; ?></td>
										<td><?php echo $lista->LIMITE; ?></td>
										<td><?php echo $lista->ORDENAR_POR; ?></td>
										<td><?php echo $lista->COLUMNAS; ?></td>
										<td>
											<div class="btn-group float-right" role="group">
                      <a href="<?php echo base_url('admin/listas_dinamicas/actualizar?id='.$lista->ID); ?>" class="btn btn-sm btn-warning" title="Editar"> <span class="fa fa-pencil-alt"></span> </a>
                      <button data-enlace='<?php echo base_url('admin/listas_dinamicas/borrar?id='.$lista->ID); ?>' class="btn btn-sm btn-danger borrar_entrada" title="Eliminar"> <span class="fa fa-trash"></span> </button>
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
