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
  isset($_GET['header_url']) ? $header_url = sanitize_text_field($_GET['header_url']) : $header_url = "";
  isset($_GET['lateral_sup_url']) ? $lateral_sup_url = sanitize_text_field($_GET['lateral_sup_url']) : $lateral_sup_url = "";
  isset($_GET['lateral_inf_url']) ? $lateral_inf_url = sanitize_text_field($_GET['lateral_inf_url']) : $lateral_inf_url = "";
  isset($_GET['lateral_text']) ? $lateral_text = sanitize_text_field($_GET['lateral_text']) : $lateral_text = "";
  isset($_GET['footer_url']) ? $footer_url = sanitize_text_field($_GET['footer_url']) : $footer_url = "";
  isset($_GET['footer_text']) ? $footer_text = sanitize_text_field($_GET['footer_text']) : $footer_text = "";

  $data = array(
    'url_img_sup' => $header_url,
    'url_img_lat_sup' => $lateral_sup_url,
    'url_img_lat_inf' => $lateral_inf_url,
    'txt_lat' => $lateral_text,
    'url_img_inf' => $footer_url,
    'txt_inf' => $footer_text
  );

  if (count(manusoft_cf2pdf_get_cofig_data()) > 0) {
    $insert_result = manusoft_cf2pdf_update_config_data($data);
  } else {
    $insert_result = manusoft_cf2pdf_insert_config_data($data);
  }
  wp_send_json_success(array('result' => $insert_result));
}
add_action('wp_ajax_manusoft_cf2pdf_save_config', 'manusoft_cf2pdf_save_config');

// Método para obtener los datos de configuración
function manusoft_cf2pdf_get_cofig_data() {
  global $wpdb;
  $table = $wpdb->prefix.'manusoft_cf2pdf_config';
  $result = $wpdb->get_row("SELECT * FROM ".$table." WHERE ID = '1';","ARRAY_A");
  return $result;
}

// Método para insertar los datos de configuración
function manusoft_cf2pdf_insert_config_data($data) {
  global $wpdb;
  $table = $wpdb->prefix.'manusoft_cf2pdf_config';
  $result = $wpdb->insert($table,$data);
  return $result;
}

// Método para actualizar los datos de configuración
function manusoft_cf2pdf_update_config_data($data) {
  global $wpdb;
  $table = $wpdb->prefix.'manusoft_cf2pdf_config';
  $where = array(
    'ID' => 1
  );
  $result = $wpdb->update($table,$data,$where);
  return $result;
}
?>
