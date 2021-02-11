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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css">
<!--[if (lt IE 9)]><script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/min/tiny-slider.helper.ie8.js"></script><![endif]-->
		<link rel="stylesheet" href="<?php echo base_url('assets/redsems'); ?>/css/main.css">
		<link rel="stylesheet" href="<?php echo base_url('assets/redsems'); ?>/css/custom.css">
		<!-- <link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet"> -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


		</head>
		<body>

			<nav class="navbar navbar-inverse sub-navbar navbar-fixed-top">
						<div class="container">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#subenlaces">
									<span class="sr-only">Interruptor de Navegación</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="index.html">RED SEMS</a>
							</div>
							<div class="collapse navbar-collapse" id="subenlaces">
								<ul class="nav navbar-nav navbar-right">
									<li><a href="index.html">Inicio</a></li>
									<li class="dropdown">
										<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Secciones</a>
										<ul class="dropdown-menu" role="menu">
											<li><a href="#bienvenida">Bienvenida</a></li>
											<li><a href="#ejes-modelo">El Modelo Educativo</a></li>
											<li><a href="#recursos">Recursos</a></li>
											<li><a href="#inter">Información</a></li>
											<li><a href="#mas-vistos">Más Vistos</a></li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
						</nav><!-- #header -->
