<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8"/>
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/img/apple-icon-76x76.png'); ?>">
<link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon-96x96.png'); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<title><?php echo $titulo ?></title>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>
<!-- OPEN GRAPH -->
	<meta property="og:url"  content="<?php echo current_url(); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?php echo $titulo; ?>" />
	<meta property="og:description" content="<?php echo html_escape($descripcion); ?>" />
	<meta property="og:image" content="<?php echo $imagen; ?>" />

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

<!-- Main CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!-- Animation CSS -->
<link href="<?php echo base_url('assets/css/'); ?>animate.css" rel="stylesheet"/>

<!-- Lightbox CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" />

<!-- Custom CSS -->
<link href="<?php echo base_url('assets/css/'); ?>estilos.css" rel="stylesheet"/>

</head>

<body>

<!--------------------------------------
NAVBAR
--------------------------------------->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/img/logo_menu.png'); ?>" alt="" class="img-fluid" style="max-height:50px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

</nav>
<!-- End Navbar -->
