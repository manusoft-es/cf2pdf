<?php
defined('ABSPATH') or die('No tienes permiso para hacer eso.');

// Hook the 'admin_menu' action hook, run the function named 'mfp_Add_My_Admin_Link()'
add_action( 'admin_menu', 'manusoft_cf2pdf_add_admin_links' );

// Add a new top level menu link to the ACP
function manusoft_cf2pdf_add_admin_links() {
  add_menu_page(
    'CF2PDF - Configuración',                                       // Título de la página
    'cf2pdf',                                                       // Texto a mostrar como enlace en el menú de administración de WordPress
    'manage_options',                                               // Permisos requeridos para mostrar el enlace
    plugin_dir_path(__FILE__).'/manusoft_cf2pdf_config_page.php'    // 'Slug' del fichero a mostrar cuando se haga click en el enlace
    //'',
    //'dashicons-groups',                                             // Icono en el menú
    //6                                                               // Posición en el menú
  );

  add_submenu_page(
    plugin_dir_path(__FILE__).'/manusoft_cf2pdf_config_page.php',   // 'Slug' del menú del que cuelga el submenú
    'CF2PDF - Configuración',                                       // Texto a mostrar en la etiqueta 'title' del enlace
    'Configuración',                                                // Texto a mostrar como enlace en el menú de administración de WordPress
    'manage_options',                                               // Permisos requeridos para mostrar el enlace
    plugin_dir_path(__FILE__).'/manusoft_cf2pdf_config_page.php'    // 'Slug' del fichero a mostrar cuando se haga click en el enlace del submenú
  );

  add_submenu_page(
    plugin_dir_path(__FILE__).'/manusoft_cf2pdf_config_page.php',   // 'Slug' del menú del que cuelga el submenú
    'CF2PDF - Formularios',                                         // Texto a mostrar en la etiqueta 'title' del enlace
    'Formularios',                                                  // Texto a mostrar como enlace en el menú de administración de WordPress
    'manage_options',                                               // Permisos requeridos para mostrar el enlace
    plugin_dir_path(__FILE__).'/manusoft_cf2pdf_forms_page.php'     // 'Slug' del fichero a mostrar cuando se haga click en el enlace del submenú
  );
}

// 'Ajax action' para actualizar la imagen
function manusoft_cf2pdf_get_image() {
    if(isset($_GET['id'])) {
        $image = wp_get_attachment_image(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT ), 'medium', false, array( 'id' => 'manusoft_cf2pdf_preview_header'));
        $url = wp_get_attachment_url($_GET['id']);
        $data = array(
            'image' => $image,
            'url' => $url,
        );
        wp_send_json_success($data);
    } else {
        wp_send_json_error();
    }
}
add_action('wp_ajax_manusoft_cf2pdf_get_image', 'manusoft_cf2pdf_get_image');
?>
