<!DOCTYPE html>
	<html lang="es" >
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="icon" type="image/png" href="<?php echo base_url('assets/redsems'); ?>/favicon-196x196.png" sizes="196x196" />
		<link rel="icon" type="image/png" href="<?php echo base_url('assets/redsems'); ?>/favicon-96x96.png" sizes="96x96" />
		<link rel="icon" type="image/png" href="<?php echo base_url('assets/redsems'); ?>/favicon-32x32.png" sizes="32x32" />
		<link rel="icon" type="image/png" href="<?php echo base_url('assets/redsems'); ?>/favicon-16x16.png" sizes="16x16" />
		<link rel="icon" type="image/png" href="<?php echo base_url('assets/redsems'); ?>/favicon-128.png" sizes="128x128" />
		<!-- Author Meta -->
		<meta charset="UTF-8">
		<title><?php echo $titulo ?></title>

		<!-- OPEN GRAPH -->
		<meta property="og:url"  content="<?php echo current_url(); ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="<?php echo $titulo; ?>" />
		<meta property="og:description" content="<?php echo html_escape($descripcion); ?>" />
		<meta property="og:image" content="<?php echo $imagen; ?>" />

		<!-- Font Awesome Icons -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<link rel="stylesheet" href="<?php echo base_url('assets/redsems'); ?>/css/all.min.css">
		<link rel="stylesheet" href="<?php echo base_url('assets/redsems'); ?>/css/nice-select.css">
		<link rel="stylesheet" href="<?php echo base_url('assets/redsems'); ?>/css/animate.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/starrr/starrr.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
<!--[if (lt IE 9)]><script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/min/tiny-slider.helper.ie8.js"></script><![endif]-->
		<link rel="stylesheet" href="<?php echo base_url('assets/redsems'); ?>/css/main.css?v=<?php echo date('U'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/redsems'); ?>/css/custom.css?v=<?php echo date('U'); ?>">
		<!-- <link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet"> -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


		</head>
		<body>
			<div class="gobierno" style="background-color:#0b231e!important; padding-top:10px; padding-bottom:10px;">
				<div style="width:100%; max-width:1600px; margin:0 auto;">
					<nav class="navbar navbar-expand-lg navbar-dark">
								<a class="navbar-brand" href="https://www.gob.mx">
									<img src="https://framework-gb.cdn.gob.mx/landing/img/logoheader.svg" alt="logo gobierno de méxico" width="128px">
								</a>
					  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" data-parent="accordian-2">
					    <span class="navbar-toggler-icon"></span>
					  </button>

					  <div class="collapse navbar-collapse" id="navbarSupportedContent">
					    <ul class="navbar-nav ml-auto">
							<li class="nav-item">
					        <a class="nav-link" href="https://www.gob.mx/tramites" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					          Trámites
					        </a>
					      </li>
							<li class="nav-item">
					        <a class="nav-link" href="https://www.gob.mx/gobierno" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					          Gobierno
					        </a>
					      </li>
						<li class="nav-item pt-2">
					        <a class="text-white" href="https://www.gob.mx/busqueda?utf8=✓"><i class="fas fa-search"></i></a>
					      </li>
					    </ul>
					  </div>
					</nav>
				</div>
			</div>
			<!--------------------------------------
NAVBAR
--------------------------------------->
<div class="menu_principal" style="background-color:#041e18!important; padding-top:10px; padding-bottom:10px;">
	<div  style="width:100%; max-width:1600px; margin:0 auto;">
		<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: transparent;">
			<a class="navbar-brand" href="<?php echo base_url(); ?>"><?php echo $op['titulo_sitio']; ?></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<?php menu_principal('principal',0); ?>
				<ul class="navbar-nav ml-auto d-flex align-items-center">
					<?php $this->load->view($this->data['op']['plantilla'].$dispositivo.'/front/widgets/menu_usuarios'); ?>
				</ul>
			</div>
		</nav>
	</div>
</div>

<!-- End Navbar -->
