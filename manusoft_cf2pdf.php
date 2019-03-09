<?php
/*
Plugin Name: Contact Form to PDF
Plugin URI: https://www.manusoft.es
Description: Plugin para convertir registros de Contact Form 7 a PDF - ManuSoft.es
Version: 1.0
Author: Manu Cabello
Author URI: https://www.manusoft.es
*/
defined('ABSPATH') or die('No tienes permiso para hacer eso.');

require_once plugin_dir_path(__FILE__).'inc/manusoft_cf2pdf_functions.php';

// Insercción del fichero con CSS privado propio
function load_manusoft_cf2pdf_admin_style() {
  wp_register_style('manusoft_cf2pdf_style', plugins_url('/css/manusoft_cf2pdf_admin_style.css', __FILE__));
  wp_enqueue_style('manusoft_cf2pdf_style');
  wp_enqueue_style('thickbox');
}
add_action('admin_enqueue_scripts', 'load_manusoft_cf2pdf_admin_style');

// Insercción de ficheros y librerías JavaScript
function load_manusoft_cf2pdf_admin_script() {
  wp_enqueue_media();
  wp_enqueue_script('manusoft_cf2pdf_media_js', plugins_url('/js/manusoft_cf2pdf_media_upload.js', __FILE__), array('jquery'), '0.1');
  wp_enqueue_script('manusoft_cf2pdf_admin_js', plugins_url('/js/manusoft_cf2pdf_admin_script.js', __FILE__));
}
add_action('admin_enqueue_scripts', 'load_manusoft_cf2pdf_admin_script');

// Método a ejecutar al activar el plugin
register_activation_hook( __FILE__, 'manusoft_cf2pdf_activacion' );
function manusoft_cf2pdf_activacion() {
  manusoft_cf2pdf_create_config_table();
}

// Método a ejecutar al desactivar el plugin
register_deactivation_hook( __FILE__, 'manusoft_cf2pdf_desactivacion' );
function manusoft_cf2pdf_desactivacion() {
  manusoft_cf2pdf_delete_config_table();
}

// Creación de tabla de los datos de configuración
function manusoft_cf2pdf_create_config_table() {
  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();
  $sql = "CREATE TABLE ".$wpdb->prefix."manusoft_cf2pdf_config (
            id bigint(11) NOT NULL AUTO_INCREMENT,
            url_img_sup varchar(255) DEFAULT NULL,
            url_img_lat_sup varchar(255) DEFAULT NULL,
            url_img_lat_inf varchar(255) DEFAULT NULL,
            txt_lat varchar(255) DEFAULT NULL,
            url_img_inf varchar(255) DEFAULT NULL,
            txt_inf varchar(255) DEFAULT NULL,
            PRIMARY KEY (id)
          ) ".$charset_collate.";";
  require_once( ABSPATH."wp-admin/includes/upgrade.php");
  dbDelta($sql);
}

// Borrado de tabla de los datos de configuración
function manusoft_cf2pdf_delete_config_table() {
  global $wpdb;
  $query = "DROP TABLE IF EXISTS ".$wpdb->prefix."manusoft_cf2pdf_config;";
  $wpdb->get_var($query);
}
?>
