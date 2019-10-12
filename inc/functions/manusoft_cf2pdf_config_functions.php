<?php
defined('ABSPATH') or die('No tienes permiso para hacer eso.');

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

// 'Ajax action' para guardar la configuración en base de datos
function manusoft_cf2pdf_save_config() {
    $check_data = true;
    //isset($_GET['nombre_grupo']) && $_GET['nombre_grupo'] != "" && preg_match('/^[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1\s]+$/', $_GET['nombre_grupo']) ? $nombre_grupo = sanitize_text_field($_GET['nombre_grupo']) : $check_data = false;
    isset($_GET['nombre_grupo']) && $_GET['nombre_grupo'] != "" ? $nombre_grupo = sanitize_text_field($_GET['nombre_grupo']) : $check_data = false;
    isset($_GET['cif_grupo']) && ($_GET['cif_grupo'] == "" || preg_match('/^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/', $_GET['cif_grupo'])) ? $cif_grupo = sanitize_text_field($_GET['cif_grupo']) : $check_data = false;
    isset($_GET['email_grupo']) && $_GET['email_grupo'] != "" && preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $_GET['email_grupo']) ? $email_grupo = sanitize_text_field($_GET['email_grupo']) : $check_data = false;
    //isset($_GET['direccion_grupo']) && $_GET['direccion_grupo'] != "" && preg_match('/^[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1\º\ª\,\.\:\;\\\/]*)*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1\s\º\ª\,\.\:\;\\\/]+$/', $_GET['direccion_grupo']) ? $direccion_grupo = sanitize_text_field($_GET['direccion_grupo']) : $check_data = false;
    isset($_GET['direccion_grupo']) && $_GET['direccion_grupo'] != "" ? $direccion_grupo = sanitize_text_field($_GET['direccion_grupo']) : $check_data = false;
    //isset($_GET['poblacion_grupo']) && $_GET['poblacion_grupo'] != "" && preg_match('/^[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1\s]+$/', $_GET['poblacion_grupo']) ? $poblacion_grupo = sanitize_text_field($_GET['poblacion_grupo']) : $check_data = false;
    isset($_GET['poblacion_grupo']) && $_GET['poblacion_grupo'] != "" ? $poblacion_grupo = sanitize_text_field($_GET['poblacion_grupo']) : $check_data = false;
    //isset($_GET['provincia_grupo']) && $_GET['provincia_grupo'] != "" && preg_match('/^[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1\s]+$/', $_GET['provincia_grupo']) ? $provincia_grupo = sanitize_text_field($_GET['provincia_grupo']) : $check_data = false;
    isset($_GET['provincia_grupo']) && $_GET['provincia_grupo'] != "" ? $provincia_grupo = sanitize_text_field($_GET['provincia_grupo']) : $check_data = false;
    isset($_GET['cp_grupo']) && $_GET['cp_grupo'] != "" && preg_match('/^(\d{5})$/', $_GET['cp_grupo']) ? $cp_grupo = sanitize_text_field($_GET['cp_grupo']) : $check_data = false;
    isset($_GET['cuota']) && $_GET['cuota'] != "" && preg_match('/^\d{0,}$/', $_GET['cuota']) ? $cuota = sanitize_text_field($_GET['cuota']) : $check_data = false;
    isset($_GET['periodicidad']) && ($_GET['periodicidad'] == "Mensual" || $_GET['periodicidad'] == "Anual") ? $periodicidad = sanitize_text_field($_GET['periodicidad']) : $check_data = false;
    
    if (check_initial_config()) {
        isset($_GET['header_url']) ? $header_url = sanitize_text_field($_GET['header_url']) : $header_url = "";
        isset($_GET['lateral_sup_url']) ? $lateral_sup_url = sanitize_text_field($_GET['lateral_sup_url']) : $lateral_sup_url = "";
        isset($_GET['lateral_inf_url']) ? $lateral_inf_url = sanitize_text_field($_GET['lateral_inf_url']) : $lateral_inf_url = "";
        isset($_GET['lateral_text']) ? $lateral_text = sanitize_text_field($_GET['lateral_text']) : $lateral_text = "";
        isset($_GET['footer_text']) ? $footer_text = sanitize_text_field($_GET['footer_text']) : $footer_text = "";
    }
    
    if ($check_data) {
        if (check_initial_config()) {
            $data = array(
                'nombre_grupo' => $nombre_grupo,
                'cif_grupo' => $cif_grupo,
                'email_grupo' => $email_grupo,
                'direccion_grupo' => $direccion_grupo,
                'poblacion_grupo' => $poblacion_grupo,
                'provincia_grupo' => $provincia_grupo,
                'cp_grupo' => $cp_grupo,
                'cuota' => $cuota,
                'periodicidad' => $periodicidad,
                
                'url_img_sup' => $header_url,
                'url_img_lat_sup' => $lateral_sup_url,
                'url_img_lat_inf' => $lateral_inf_url,
                'txt_lat' => $lateral_text,
                'txt_inf' => $footer_text
            );
        } else {
            $data = array(
                'nombre_grupo' => $nombre_grupo,
                'cif_grupo' => $cif_grupo,
                'email_grupo' => $email_grupo,
                'direccion_grupo' => $direccion_grupo,
                'poblacion_grupo' => $poblacion_grupo,
                'provincia_grupo' => $provincia_grupo,
                'cp_grupo' => $cp_grupo,
                'cuota' => $cuota,
                'periodicidad' => $periodicidad
            );
        }
        
        if (count(manusoft_cf2pdf_get_cofig_data()) > 0) {
            $db_result = manusoft_cf2pdf_update_config_data($data);
        } else {
            $db_result = manusoft_cf2pdf_insert_config_data($data);
        }
        wp_send_json_success(array('result' => $db_result));
    } else {
        wp_send_json_success(array('result' => false));
    }
}
add_action('wp_ajax_manusoft_cf2pdf_save_config', 'manusoft_cf2pdf_save_config');

// Método para obtener los datos de configuración
function manusoft_cf2pdf_get_cofig_data() {
    global $wpdb;
    $table = $wpdb->prefix.'manusoft_cf2pdf_config';
    $update_result = $wpdb->get_row("SELECT * FROM ".$table." WHERE id =  1;","ARRAY_A");
    return $update_result;
}

// Método para insertar los datos de configuración
function manusoft_cf2pdf_insert_config_data($data) {
    global $wpdb;
    $table = $wpdb->prefix.'manusoft_cf2pdf_config';
    $insert_result = $wpdb->insert($table,$data);
    if ($insert_result) {
        $alter_result = manusoft_cf2pdf_alter_config_table();
        $create_data_result = manusoft_cf2pdf_create_data_table();
        manusoft_cf2pdf_create_forms();
    } else {
        $alter_result = "insert_error";
    }
    return $insert_result." ## ".$alter_result." ## ".$create_data_result;
}

// Método para actualizar los datos de configuración
function manusoft_cf2pdf_update_config_data($data) {
    global $wpdb;
    $table = $wpdb->prefix.'manusoft_cf2pdf_config';
    $where = array(
        'id' => 1
    );
    $result = $wpdb->update($table,$data,$where);
    $form_result = manusoft_cf2pdf_update_forms();
    return $result." ".$form_result;
}
?>