<?php
defined('ABSPATH') or die('No tienes permiso para hacer eso.');

// 'Ajax action' para guardar la configuración en base de datos
function manusoft_cf2pdf_save_config() {
    isset($_GET['nombre_grupo']) ? $nombre_grupo = sanitize_text_field($_GET['nombre_grupo']) : $nombre_grupo = "";
    isset($_GET['cif_grupo']) ? $cif_grupo = sanitize_text_field($_GET['cif_grupo']) : $cif_grupo = "";
    isset($_GET['email_grupo']) ? $email_grupo = sanitize_text_field($_GET['email_grupo']) : $email_grupo = "";
    isset($_GET['direccion_grupo']) ? $direccion_grupo = sanitize_text_field($_GET['direccion_grupo']) : $direccion_grupo = "";
    isset($_GET['poblacion_grupo']) ? $poblacion_grupo = sanitize_text_field($_GET['poblacion_grupo']) : $poblacion_grupo = "";
    isset($_GET['provincia_grupo']) ? $provincia_grupo = sanitize_text_field($_GET['provincia_grupo']) : $provincia_grupo = "";
    isset($_GET['cp_grupo']) ? $cp_grupo = sanitize_text_field($_GET['cp_grupo']) : $cp_grupo = "";
    
    $data = array(
        'nombre_grupo' => $nombre_grupo,
        'cif_grupo' => $cif_grupo,
        'email_grupo' => $email_grupo,
        'direccion_grupo' => $direccion_grupo,
        'poblacion_grupo' => $poblacion_grupo,
        'provincia_grupo' => $provincia_grupo,
        'cp_grupo' => $cp_grupo
    );
    
    if (count(manusoft_cf2pdf_get_cofig_data()) > 0) {
        $db_result = manusoft_cf2pdf_update_config_data($data);
    } else {
        $db_result = manusoft_cf2pdf_insert_config_data($data);
    }
    wp_send_json_success(array('result' => $db_result));
}
add_action('wp_ajax_manusoft_cf2pdf_save_config', 'manusoft_cf2pdf_save_config');

// Método para obtener los datos de configuración
function manusoft_cf2pdf_get_cofig_data() {
    global $wpdb;
    $table = $wpdb->prefix.'manusoft_cf2pdf_config';
    $update_result = $wpdb->get_row("SELECT * FROM ".$table.";","ARRAY_A");
    return $update_result;
}

// Método para insertar los datos de configuración
function manusoft_cf2pdf_insert_config_data($data) {
    global $wpdb;
    $table = $wpdb->prefix.'manusoft_cf2pdf_config';
    $insert_result = $wpdb->insert($table,$data);
    
    $query = "ALTER TABLE ".$table."
                ADD url_img_sup varchar(255) DEFAULT NULL,
                ADD url_img_lat_sup varchar(255) DEFAULT NULL,
                ADD url_img_lat_inf varchar(255) DEFAULT NULL,
                ADD txt_lat varchar(255) DEFAULT NULL,
                ADD txt_inf varchar(255) DEFAULT NULL";
    $alter_result = $wpdb->query($query);
    
    return $insert_result." ## ".$alter_result;
}

// Método para actualizar los datos de configuración
function manusoft_cf2pdf_update_config_data($data) {
    global $wpdb;
    $table = $wpdb->prefix.'manusoft_cf2pdf_config';
    $where = array(
        'id' => 1
    );
    $result = $wpdb->update($table,$data,$where);
    return $result;
}
?>