<?php
defined('ABSPATH') or die('No tienes permiso para hacer eso.');

// Método para obtener la lista de formularios del sistema
function manusoft_cf2pdf_get_all_forms() {
  global $wpdb;
  $query = "SELECT
              form_post_id as form_id,
              COUNT(form_post_id) as total
            FROM (
              SELECT
                form_post_id
              FROM ".$wpdb->prefix."manusoft_cf2pdf_data
            ) data
            GROUP BY form_post_id";
  $results = $wpdb->get_results($query,"ARRAY_A");
  return $results;
}

// Método para obtener los registros de un formulario cuyo ID se pasa como parámetro
function manusoft_cf2pdf_get_form_data($form_id) {
  global $wpdb;
  $query = "SELECT
              *
            FROM ".$wpdb->prefix."manusoft_cf2pdf_data
            WHERE form_post_id = '".$form_id."'";
  $results = $wpdb->get_results($query,"ARRAY_A");
  return $results;
}
?>
