<?php
/*
Plugin Name: Contact Form to PDF
Plugin URI: https://github.com/manusoft-es/manusoft-cf2pdf
Description: Plugin para convertir registros de Contact Form 7 a PDF
Version: 1.1
Author: ManuSoft.es
Author URI: https://www.manusoft.es
*/
defined('ABSPATH') or die('No tienes permiso para hacer eso.');

require_once plugin_dir_path(__FILE__).'inc/functions/manusoft_cf2pdf_functions.php';
require_once plugin_dir_path(__FILE__).'inc/functions/manusoft_cf2pdf_config_functions.php';

// Insercción de ficheros y librerías JavaScript
function load_manusoft_cf2pdf_admin_script() {
    wp_enqueue_media();
    wp_enqueue_script('manusoft_cf2pdf_config_js', plugins_url('/js/manusoft_cf2pdf_config_script.js', __FILE__));
}
add_action('admin_enqueue_scripts', 'load_manusoft_cf2pdf_admin_script');

// Método a ejecutar al activar el plugin
register_activation_hook( __FILE__, 'manusoft_cf2pdf_activacion' );
function manusoft_cf2pdf_activacion() {
    manusoft_cf2pdf_create_config_table();
}

// Creación de tabla con los datos de configuración
function manusoft_cf2pdf_create_config_table() {
    global $wpdb;
    $sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."manusoft_cf2pdf_config (
              id bigint(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
              nombre_grupo varchar(255) COLLATE 'utf8_spanish_ci' NOT NULL,
              cif_grupo varchar(9) COLLATE 'utf8_spanish_ci' NULL,
              email_grupo varchar(255) COLLATE 'utf8_spanish_ci' NOT NULL,
              direccion_grupo varchar(255) COLLATE 'utf8_spanish_ci' NOT NULL,
              poblacion_grupo varchar(255) COLLATE 'utf8_spanish_ci' NOT NULL,
              provincia_grupo varchar(255) COLLATE 'utf8_spanish_ci' NOT NULL,
              cp_grupo int(6) unsigned NOT NULL
            ) ENGINE='InnoDB' COLLATE 'utf8_spanish_ci';";
    require_once( ABSPATH."wp-admin/includes/upgrade.php");
    dbDelta($sql);
}

// Método a ejecutar al desactivar el plugin
register_deactivation_hook( __FILE__, 'manusoft_cf2pdf_desactivacion' );
function manusoft_cf2pdf_desactivacion() {
    manusoft_cf2pdf_delete_config_table();
}

// Borrado de tabla con los datos de configuración
function manusoft_cf2pdf_delete_config_table() {
    global $wpdb;
    $query = "DROP TABLE IF EXISTS ".$wpdb->prefix."manusoft_cf2pdf_config;";
    $wpdb->get_var($query);
}
?>