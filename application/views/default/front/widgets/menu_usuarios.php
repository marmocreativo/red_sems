<?php
if(verificar_sesion($this->data['op']['tiempo_inactividad_sesion'])){ ?>
  <li class="nav-item dropdown">
    <a class="btn btn-outline-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     <i class="fa fa-user-check"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
      <p class="dropdown-item">Hola <b><?php echo $_SESSION['usuario']['nombre']; ?></b></p>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="<?php echo base_url('usuarios/actualizar');?>"> <i class="far fa-id-card"></i> Mi Perfil</a>
      <?php if($_SESSION['usuario']['tipo_usuario']=='administrador'){ ?>
      <a class="dropdown-item" href="<?php echo base_url('admin'); ?>"> <i class="fa fa-lock"></i> Administradores</a>
      <?php } ?>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="<?php echo base_url('login/cerrar_sesion');?>"> <i class="fa fa-sign-out-alt"></i> Cerrar Sesión</a>
    </div>
  </li>
<?php }else{ ?>
  <li class="nav-item dropdown">
    <a class="btn btn-outline-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-user"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="<?php echo base_url('login?url_redirect='.base_url(uri_string().'?'.$_SERVER['QUERY_STRING']));?>"> <i class="fa fa-user"></i> Iniciar sesión</a>
      <a class="dropdown-item" href="<?php echo base_url('usuarios/crear');?>"> <i class="fas fa-pencil-alt"></i> Registrarme</a>
    </div>
  </li>
<?php } ?>
