<?php if(isset($_GET['id'])){ ?>
	<div class="row">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Titulo</th>
					<th>URL</th>
					<th>Descripción</th>
					<th>Controles</th>
				</tr>
			</thead>
			<tbody class="ui-sortable" data-tabla="galerias" data-columna="ID_GALERIA">
				<?php foreach($multimedia as $multimedio){ ?>
					<tr id="item-<?php echo $multimedio->ID_GALERIA; ?>" class="ui-sortable-handle">
						<td>
							<h6 class="titulo-multimedia-<?php echo $multimedio->ID_MULTIMEDIA; ?>"><?php echo $multimedio->TITULO; ?></h6>
							<input type="text" class="form-control form-control-sm d-none form-titulo-multimedia-<?php echo $multimedio->ID_MULTIMEDIA; ?>" value="<?php echo $multimedio->TITULO; ?>">
						</td>
						<td>
							<a  class="archivo-multimedia-<?php echo $multimedio->ID_MULTIMEDIA; ?>" href="<?php echo $multimedio->ARCHIVO; ?>" target="_blank" title="<?php echo $multimedio->RESUMEN; ?>">
								<?php echo $multimedio->ARCHIVO; ?>
							</a>
							<input type="text" class="form-archivo-multimedia-<?php echo $multimedio->ID_MULTIMEDIA; ?> d-none" value="<?php echo $multimedio->ARCHIVO; ?>">
						</td>
						<td>
							<p class="resumen-multimedia-<?php echo $multimedio->ID_MULTIMEDIA; ?>">
								<?php echo $multimedio->RESUMEN; ?>
							</p>
							<textarea class="form-control form-control-sm d-none form-resumen-multimedia-<?php echo $multimedio->ID_MULTIMEDIA; ?>" rows="3"><?php echo $multimedio->RESUMEN; ?></textarea>
						</td>
						<td>
							<div class="btn-group mt-3 float-right">
								<button type="button" class="btn btn-outline-warning btn-sm editar_multimedia" name="button" data-id-objeto="<?php echo $multimedio->ID_MULTIMEDIA; ?>" title="Editar">
									<span class="mostrar_guardar-<?php echo $multimedio->ID_MULTIMEDIA; ?>"><i class="fa fa-pencil "></i></span>
									<span class="mostrar_guardar-<?php echo $multimedio->ID_MULTIMEDIA; ?> d-none"><i class="fa fa-save "></i> Guardar</span>
								</button>
								<button type="button" class="btn btn-outline-danger btn-sm borrar_multimedia" data-vista='galeria' data-id-multimedia="<?php echo $multimedio->ID_MULTIMEDIA; ?>" title="Borrar"> <i class="fa fa-trash "></i></button>
							</div>
						</td>
					</tr>
				<?php } ?>
			</tbody>

		</table>
	</div>

<?php }else{ ?>
	<div class="row ui-sortable" data-tabla="galerias" data-columna="ID_GALERIA">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Titulo</th>
					<th>URL</th>
					<th>Descripción</th>
					<th>Controles</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($multimedia as $multimedio){ ?>
					<tr>
						<td>
							<h6 class="titulo-multimedia-<?php echo $multimedio->ID_MULTIMEDIA; ?>"><?php echo $multimedio->TITULO; ?></h6>
							<input type="text" class="form-control form-control-sm d-none form-titulo-multimedia-<?php echo $multimedio->ID_MULTIMEDIA; ?>" value="<?php echo $multimedio->TITULO; ?>">
						</td>
						<td>
							<a  class="archivo-multimedia-<?php echo $multimedio->ID_MULTIMEDIA; ?>" href="<?php echo $multimedio->ARCHIVO; ?>" target="_blank" title="<?php echo $multimedio->RESUMEN; ?>">
								<?php echo $multimedio->ARCHIVO; ?>
							</a>
							<input type="text" class="form-archivo-multimedia-<?php echo $multimedio->ID_MULTIMEDIA; ?> d-none" value="<?php echo $multimedio->ARCHIVO; ?>">
						</td>
						<td>
							<p class="resumen-multimedia-<?php echo $multimedio->ID_MULTIMEDIA; ?>">
								<?php echo $multimedio->DESCRIPCION; ?>
							</p>
							<textarea class="form-control form-control-sm d-none form-resumen-multimedia-<?php echo $multimedio->ID_MULTIMEDIA; ?>" rows="3"><?php echo $multimedio->RESUMEN; ?></textarea>
						</td>
						<td>
							<div class="btn-group mt-3 float-right">
								<button type="button" class="btn btn-outline-warning btn-sm editar_multimedia" name="button" data-id-objeto="<?php echo $multimedio->ID_MULTIMEDIA; ?>" title="Editar">
									<span class="mostrar_guardar-<?php echo $multimedio->ID_MULTIMEDIA; ?>"><i class="fa fa-pencil "></i></span>
									<span class="mostrar_guardar-<?php echo $multimedio->ID_MULTIMEDIA; ?> d-none"><i class="fa fa-save "></i> Guardar</span>
								</button>
								<button type="button" class="btn btn-outline-danger btn-sm borrar_multimedia" data-vista='galeria' data-id-multimedia="<?php echo $multimedio->ID_MULTIMEDIA; ?>" title="Borrar"> <i class="fa fa-trash "></i></button>
							</div>
						</td>
					</tr>
				<?php } ?>
			</tbody>

		</table>
	</div>
<?php } ?>
