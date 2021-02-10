<!--begin: User Bar -->
<div class="kt-header__topbar-item kt-header__topbar-item--user">
  <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
    <div class="kt-header__topbar-user">
      <span class="kt-header__topbar-welcome kt-hidden-mobile">Hola,</span>
      <span class="kt-header__topbar-username kt-hidden-mobile"><?php echo $_SESSION['usuario']['nombre']; ?></span>
      <img class="kt-hidden" alt="Pic" src="<?php echo base_url('assets/metronic/'); ?>media/users/default.jpg" />

      <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
      <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">M</span>
    </div>
  </div>
  <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

    <!--begin: Head -->
    <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(<?php echo base_url('assets/metronic/'); ?>media/misc/bg-1.jpg)">
      <div class="kt-user-card__avatar">
        <img class="kt-hidden" alt="Pic" src="<?php echo base_url('assets/metronic/'); ?>media/users/default.jpg" />

        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
        <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success"><?php echo $_SESSION['usuario']['nombre'][0]; ?></span>
      </div>
      <div class="kt-user-card__name">
        <?php echo $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']; ?>
      </div>
    </div>

    <!--end: Head -->

    <!--begin: Navigation -->
    <div class="kt-notification">
      <a href="<?php echo base_url('admin/usuarios/actualizar?id='.$_SESSION['usuario']['id']); ?>" class="kt-notification__item">
        <div class="kt-notification__item-icon">
          <i class="flaticon2-calendar-3 kt-font-success"></i>
        </div>
        <div class="kt-notification__item-details">
          <div class="kt-notification__item-title kt-font-bold">
            Mi perfil
          </div>
          <div class="kt-notification__item-time">
            configuración y estatus
          </div>
        </div>
      </a>
      <div class="kt-notification__custom">
        <a href="<?php echo base_url('login/cerrar_sesion'); ?>" class="btn btn-label-brand btn-sm btn-bold">Cerrar Sesión</a>
      </div>
    </div>

    <!--end: Navigation -->
  </div>
</div>

<!--end: User Bar -->
