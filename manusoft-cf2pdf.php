<?php
/*
Plugin Name: ManuSoft - Contact Form 7 to PDF
Plugin URI: https://github.com/manusoft-es/manusoft-cf2pdf
Description: Plugin para convertir registros de Contact Form 7 a PDF
Version: 1.1
Author: ManuSoft.es
Author URI: https://www.manusoft.es
*/
defined('ABSPATH') or die('No tienes permiso para hacer eso.');

require_once plugin_dir_path(__FILE__).'inc/functions/manusoft_cf2pdf_functions.php';
require_once plugin_dir_path(__FILE__).'inc/functions/manusoft_cf2pdf_config_functions.php';
require_once plugin_dir_path(__FILE__).'inc/functions/manusoft_cf2pdf_cf7_functions.php';
require_once plugin_dir_path(__FILE__).'inc/functions/manusoft_cf2pdf_forms_functions.php';
require_once plugin_dir_path(__FILE__).'inc/functions/manusoft_cf2pdf_cf7forms_functions.php';
require_once plugin_dir_path(__FILE__).'inc/classes/manusoft_cf2pdf_forms_class.php';
require_once plugin_dir_path(__FILE__).'inc/functions/manusoft_cf2pdf_data_functions.php';
require_once plugin_dir_path(__FILE__).'inc/classes/manusoft_cf2pdf_data_class.php';

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
              cp_grupo int(6) unsigned NOT NULL,
              cuota int unsigned NOT NULL,
              periodicidad varchar(255) COLLATE 'utf8_spanish_ci' NOT NULL
            ) ENGINE='InnoDB' COLLATE 'utf8_spanish_ci';";
    require_once( ABSPATH."wp-admin/includes/upgrade.php");
    dbDelta($sql);
}

// Modificación de la tabla con los datos de configuración para incluir los datos de la plantilla
function manusoft_cf2pdf_alter_config_table() {
    global $wpdb;
    $table = $wpdb->prefix.'manusoft_cf2pdf_config';
    $query = "ALTER TABLE ".$table."
                    ADD url_img_sup varchar(255) DEFAULT NULL,
                    ADD url_img_lat_sup varchar(255) DEFAULT NULL,
                    ADD url_img_lat_inf varchar(255) DEFAULT NULL,
                    ADD txt_lat varchar(520) DEFAULT NULL,
                    ADD txt_inf varchar(880) DEFAULT NULL";
    $alter_result = $wpdb->query($query);
    return $alter_result;
}

// Creación de tabla con los datos de los registros de los formularios
function manusoft_cf2pdf_create_data_table() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE ".$wpdb->prefix."manusoft_cf2pdf_data (
            form_id bigint(20) NOT NULL AUTO_INCREMENT,
            form_post_id bigint(20) NOT NULL,
            form_value longtext NOT NULL,
            form_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            PRIMARY KEY  (form_id)
        ) $charset_collate;";
    require_once( ABSPATH."wp-admin/includes/upgrade.php");
    dbDelta($sql);
}

// Método a ejecutar al desactivar el plugin
register_deactivation_hook( __FILE__, 'manusoft_cf2pdf_desactivacion' );
function manusoft_cf2pdf_desactivacion() {
    //manusoft_cf2pdf_delete_config_table();
    //manusoft_cf2pdf_delete_data_table();
}

// Borrado de tabla con los datos de configuración
function manusoft_cf2pdf_delete_config_table() {
    global $wpdb;
    $query = "DROP TABLE IF EXISTS ".$wpdb->prefix."manusoft_cf2pdf_config;";
    $wpdb->get_var($query);
}

// Borrado de tabla con los datos de configuración
function manusoft_cf2pdf_delete_data_table() {
    global $wpdb;
    $query = "DROP TABLE IF EXISTS ".$wpdb->prefix."manusoft_cf2pdf_data;";
    $wpdb->get_var($query);
}

/*
 *  ##############################################################
 *  ############################ LOG #############################
 *  ##############################################################
 */
// Función para escribir en el log
function manusoft_cf2pdf_error_log($texto) {
    $log = fopen(plugin_dir_path(__FILE__).'log/errores_'.date("Ym").'.log','a');
    fwrite($log,"[".current_time('r')."]: $texto\r\n");
    fclose($log);
}

// Función para leer del log
function manusoft_cf2pdf_get_error_log() {
    if (file_exists(plugin_dir_path(__FILE__).'log/errores_'.date("Ym").'.log')) {
        $log = file_get_contents(plugin_dir_path(__FILE__).'log/errores_'.date("Ym").'.log');
        if ($log === false) {
            $log = "Error al acceder al log";
        }
    } else {
        $log = "No se han producido errores.";
    }
    return $log;
}

/*
 *  ##############################################################
 *  ########################## SESSIONS ##########################
 *  ##############################################################
 */
// Función que borra todas las sesiones al cerrar sesión
function destroy_sessions() {
    session_destroy();
}
add_action('wp_logout', 'destroy_sessions');
?>