<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Escritorio </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="<?php echo base_url('admin'); ?>" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Inicio </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>


				<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
			</div>
		</div>
		<div class="kt-subheader__toolbar">
			<div class="kt-subheader__wrapper">

			</div>
		</div>
	</div>

	<!-- end:: Subheader -->

	<!-- begin:: Content -->
	<div class="kt-content" id="kt_content">

		<div class="row">
			<div class="col-6">
				<div class="row mb-4">
					<div class="col-12">
						<h5> <i class="fa fa-users"></i> Usuarios</h5>
					</div>
					<?php $tipos_publicaciones = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'usuarios'],'','',''); ?>
		      <?php foreach($tipos_publicaciones as $tipo_publicacion){ ?>
					<div class="col-6 mb-3">
						<div class="card">
							<div class="card-body">
								<h6><i class="fa fa-user"></i> <?php echo $tipo_publicacion->TIPO_NOMBRE_PLURAL; ?></h6>
								<?php $conteo = $this->GeneralModel->conteo_elementos('usuarios',['TIPO'=>$tipo_publicacion->TIPO_NOMBRE]); ?>
								<h2><?php echo $conteo; ?></h2>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="row mb-4">
					<div class="col-12">
						<h5> <i class="fa fa-file"></i> Publicaciones</h5>
					</div>
					<?php $tipos_publicaciones = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'publicaciones'],'','',''); ?>
		      <?php foreach($tipos_publicaciones as $tipo_publicacion){ ?>
					<div class="col-6 mb-3">
						<div class="card">
							<div class="card-body">
								<h6> <i class="fa fa-file"></i> <?php echo $tipo_publicacion->TIPO_NOMBRE_PLURAL; ?></h6>
								<?php $conteo = $this->GeneralModel->conteo_elementos('publicaciones',['TIPO'=>$tipo_publicacion->TIPO_NOMBRE]); ?>
								<h2><?php echo $conteo; ?></h2>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
			<div class="col-6">
			</div>
		</div>

	</div>
	<!-- end:: Content -->
