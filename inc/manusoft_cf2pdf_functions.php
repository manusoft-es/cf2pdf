<?php
defined('ABSPATH') or die('No tienes permiso para hacer eso.');

// Hook the 'admin_menu' action hook, run the function named 'mfp_Add_My_Admin_Link()'
add_action( 'admin_menu', 'manusoft_cf2pdf_add_admin_links' );

// Add a new top level menu link to the ACP
function manusoft_cf2pdf_add_admin_links() {
  add_menu_page(
    'CF7 to PDF - Configuración',                                 // Título de la página
    'CF7 to PDF',                                                 // Texto a mostrar como enlace en el menú de administración de WordPress
    'manage_options',                                             // Permisos requeridos para mostrar el enlace
    plugin_dir_path(__FILE__).'/manusoft_cf2pdf_forms_page.php',  // 'Slug' del fichero a mostrar cuando se haga click en el enlace
    '',
    'dashicons-media-text',                                       // Icono en el menú
    30                                                            // Posición en el menú
  );

  add_submenu_page(
    plugin_dir_path(__FILE__).'/manusoft_cf2pdf_forms_page.php',  // 'Slug' del menú del que cuelga el submenú
    'CF7 to PDF - Formularios',                                   // Texto a mostrar en la etiqueta 'title' del enlace
    'Formularios',                                                // Texto a mostrar como enlace en el menú de administración de WordPress
    'manage_options',                                             // Permisos requeridos para mostrar el enlace
    plugin_dir_path(__FILE__).'/manusoft_cf2pdf_forms_page.php'   // 'Slug' del fichero a mostrar cuando se haga click en el enlace del submenú
  );

  add_submenu_page(
    plugin_dir_path(__FILE__).'/manusoft_cf2pdf_forms_page.php',  // 'Slug' del menú del que cuelga el submenú
    'CF7 to PDF - Configuración',                                 // Texto a mostrar en la etiqueta 'title' del enlace
    'Configuración',                                              // Texto a mostrar como enlace en el menú de administración de WordPress
    'manage_options',                                             // Permisos requeridos para mostrar el enlace
    plugin_dir_path(__FILE__).'/manusoft_cf2pdf_config_page.php'  // 'Slug' del fichero a mostrar cuando se haga click en el enlace del submenú
  );
}
?>
