<!-- begin:: Aside Menu -->
<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
  <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
    <ul class="kt-menu__nav ">
      <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('admin'); ?>" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-dashboard"></i><span class="kt-menu__link-text">Escritorio</span></a></li>
      <!-- Menú -->
      <!--
      <li class="kt-menu__section ">
        <h4 class="kt-menu__section-text">Menú</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
      </li>
      <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('admin/menu?grupo=principal'); ?>" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-list-2"></i><span class="kt-menu__link-text">Menú Principal</span></a></li>
      <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('admin/menu?grupo=sociales'); ?>" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-list-2"></i><span class="kt-menu__link-text">Menú Redes</span></a></li>
      -->
      <!-- Publicaciones -->
      <!--
      <li class="kt-menu__section ">
        <h4 class="kt-menu__section-text">Publicaciones</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
      </li>
      <?php $tipos_publicaciones = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'publicaciones'],'','',''); ?>
      <?php foreach($tipos_publicaciones as $tipo_publicacion){ ?>
        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon fa fa-file"></i><span class="kt-menu__link-text"><?php echo $tipo_publicacion->TIPO_NOMBRE_PLURAL; ?></span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
          <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
            <ul class="kt-menu__subnav">
              <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text"><?php echo $tipo_publicacion->TIPO_NOMBRE_PLURAL; ?></span></span></li>
              <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('admin/categorias?tipo_objeto=publicaciones&tipo='.$tipo_publicacion->TIPO_NOMBRE); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Categorías de <?php echo $tipo_publicacion->TIPO_NOMBRE_PLURAL; ?></span></a></li>
              <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('admin/publicaciones?tipo='.$tipo_publicacion->TIPO_NOMBRE); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Lista de <?php echo $tipo_publicacion->TIPO_NOMBRE_PLURAL; ?></span></a></li>
            </ul>
          </div>
        </li>
      <?php } ?>
      -->
      <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('admin/repositorio'); ?>" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-file"></i><span class="kt-menu__link-text">Repositorio / Archivos</span></a></li>
      <!-- Sliders -->

      <li class="kt-menu__section ">
        <h4 class="kt-menu__section-text">Accesos directos</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
      </li>
      <?php $tipos_publicaciones = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'sliders'],'','',''); ?>
      <?php foreach($tipos_publicaciones as $tipo_publicacion){ ?>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('admin/sliders?tipo='.$tipo_publicacion->TIPO_NOMBRE); ?>" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-images"></i><span class="kt-menu__link-text"><?php echo $tipo_publicacion->TIPO_NOMBRE_PLURAL; ?></span></a></li>
      <?php } ?>

      <!-- Sliders -->
      <!--
      <li class="kt-menu__section ">
        <h4 class="kt-menu__section-text">Listas Dinámicas</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
      </li>
      <?php $tipos_publicaciones = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'listas_dinamicas'],'','',''); ?>
      <?php foreach($tipos_publicaciones as $tipo_publicacion){ ?>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('admin/listas_dinamicas?tipo='.$tipo_publicacion->TIPO_NOMBRE); ?>" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-grip-horizontal"></i><span class="kt-menu__link-text"><?php echo $tipo_publicacion->TIPO_NOMBRE_PLURAL; ?></span></a></li>
      <?php } ?>
      -->
      <!-- Usuarios -->
      <li class="kt-menu__section ">
        <h4 class="kt-menu__section-text">Usuarios</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
      </li>
      <?php $tipos_publicaciones = $this->GeneralModel->lista('tipos','',['TIPO_OBJETO'=>'usuarios'],'','',''); ?>
      <?php foreach($tipos_publicaciones as $tipo_publicacion){ ?>
        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon fa fa-users"></i><span class="kt-menu__link-text"><?php echo $tipo_publicacion->TIPO_NOMBRE_PLURAL; ?></span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
          <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
            <ul class="kt-menu__subnav">
              <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text"><?php echo $tipo_publicacion->TIPO_NOMBRE_PLURAL; ?></span></span></li>
              <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('admin/categorias?tipo_objeto=usuarios&tipo='.$tipo_publicacion->TIPO_NOMBRE); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Categorías de <?php echo $tipo_publicacion->TIPO_NOMBRE_PLURAL; ?></span></a></li>
              <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('admin/usuarios?tipo='.$tipo_publicacion->TIPO_NOMBRE); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Lista de <?php echo $tipo_publicacion->TIPO_NOMBRE_PLURAL; ?></span></a></li>
            </ul>
          </div>
        </li>
      <?php } ?>
      <!-- Combinaciones -->
      <li class="kt-menu__section ">
        <h4 class="kt-menu__section-text">Configuraciones</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
      </li>
      <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('admin/opciones'); ?>" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-settings"></i><span class="kt-menu__link-text">Opciones</span></a></li>
      <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('admin/tipos'); ?>" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-map"></i><span class="kt-menu__link-text">Tipos</span></a></li>
      <!--
      <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('admin/relaciones'); ?>" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-arrows"></i><span class="kt-menu__link-text">Relaciones</span></a></li>
      -->
      <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('admin/base_de_datos'); ?>" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-database"></i><span class="kt-menu__link-text">Base de datos</span></a></li>
    </ul>
  </div>
</div>

<!-- end:: Aside Menu -->
