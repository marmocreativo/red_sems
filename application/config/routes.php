<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| RUTAS RESERVADAS
| -------------------------------------------------------------------------
|
*/
$route['default_controller'] = 'Front_Publicaciones';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
| -------------------------------------------------------------------------
| RUTAS AUTENTICACION
| -------------------------------------------------------------------------
|
*/
$route['login'] = 'Autenticacion';
$route['login/(:any)'] = 'Autenticacion/$1';

/*
| -------------------------------------------------------------------------
| RUTAS AJAX
| -------------------------------------------------------------------------
|
*/
$route['ajax'] = 'Ajax';
$route['ajax/(:any)'] = 'Ajax/$1';

/*
| -------------------------------------------------------------------------
| RUTAS ADMINISTRADOR
| -------------------------------------------------------------------------
|
*/
/* - Bases de datos - */
$route['admin/base_de_datos'] = 'Admin_Base_De_Datos';
$route['admin/base_de_datos/(:any)'] = 'Admin_Base_De_Datos/$1';
$route['admin/repositorio'] = 'Admin_Repositorio';
$route['admin/repositorio/(:any)'] = 'Admin_Repositorio/$1';

/* - Publicaciones - */
$route['admin/tipos'] = 'Admin_Tipos';
$route['admin/tipos/(:any)'] = 'Admin_Tipos/$1';
$route['admin/categorias'] = 'Admin_Categorias';
$route['admin/categorias/(:any)'] = 'Admin_Categorias/$1';
$route['admin/publicaciones'] = 'Admin_Publicaciones';
$route['admin/publicaciones/(:any)'] = 'Admin_Publicaciones/$1';
$route['admin/sliders'] = 'Admin_Sliders';
$route['admin/sliders/(:any)'] = 'Admin_Sliders/$1';
$route['admin/multimedia'] = 'Admin_Multimedia';
$route['admin/multimedia/(:any)'] = 'Admin_Multimedia/$1';
/* - Usuarios - */
$route['admin/usuarios'] = 'Admin_Usuarios';
$route['admin/usuarios/(:any)'] = 'Admin_Usuarios/$1';
/* - Página de inicio - */
$route['admin/listas_dinamicas'] = 'Admin_Listas_Dinamicas';
$route['admin/listas_dinamicas/(:any)'] = 'Admin_Listas_Dinamicas/$1';
$route['admin'] = 'Admin_Inicio';
$route['admin/(:any)'] = 'Admin_Inicio/$1';

/*
| -------------------------------------------------------------------------
| RUTAS USUARIOS
| -------------------------------------------------------------------------
|
*/
$route['usuarios'] = 'Usuarios_Inicio';
$route['usuarios/(:any)'] = 'Usuarios_Inicio/$1';

/*
| -------------------------------------------------------------------------
| RUTAS FRONTEND
| -------------------------------------------------------------------------
|
*/
$route['sitemap.xml'] = 'Front_Publicaciones/sitemap/';
$route['reparar_EN_CMS'] = 'Admin_Instalar';
$route['repositorio'] = 'Front_Repositorio';
$route['repositorio/calificacion'] = 'Front_Repositorio/calificacion';
$route['repositorio/recurso/(:any)'] = 'Front_Repositorio/recurso/$1';
$route['repositorio/decarga/(:any)'] = 'Front_Repositorio/descarga/$1';
$route['mantenimiento'] = 'Front_Publicaciones/mantenimiento';
$route['mensaje'] = 'Front_Publicaciones/mensaje/$1';
$route['contacto'] = 'Front_Publicaciones/contacto/$1';
$route['tipo/(:any)'] = 'Front_Publicaciones/tipo/$1';
$route['tipo/(:any)/(:num)'] = 'Front_Publicaciones/tipo/$1/$2';
$route['busqueda'] = 'Front_Publicaciones/busqueda';
$route['categoria/(:any)'] = 'Front_Publicaciones/categoria/$1';
$route['categoria/(:any)/(:num)'] = 'Front_Publicaciones/categoria/$1/$2';

$route['reaccionar'] = 'Front_Publicaciones/reaccionar/';
$route['(:any)'] = 'Front_Publicaciones/publicacion/';
