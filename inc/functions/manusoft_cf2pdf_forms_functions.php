<?php
defined('ABSPATH') or die('No tienes permiso para hacer eso.');

// Método para obtener la lista de formularios del sistema
function manusoft_cf2pdf_get_all_forms($per_page = 5, $page_number = 1) {
    global $wpdb;
    $offset = ($page_number-1) == 0 ? 0 : ($page_number-1)*$per_page;
    $query = "SELECT
                    p.ID as id,
                    p.post_title as name,
                    COUNT(data.form_post_id) as total
                FROM ".$wpdb->prefix."posts p
                LEFT JOIN ".$wpdb->prefix."manusoft_cf2pdf_data data ON (data.form_post_id = p.ID)
                WHERE p.post_type = 'wpcf7_contact_form'
                GROUP BY p.ID
                ORDER BY name
                LIMIT ".$per_page."
                OFFSET ".$offset;
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

// Método para obtener el html de un formulario cuyo ID se pasa como parámetro
function manusoft_cf2pdf_get_form_html($form_id) {
    global $wpdb;
    $query = "SELECT meta_value FROM ".$wpdb->prefix."postmeta WHERE post_id = ".$form_id." AND meta_key = '_form';";
    $result = $wpdb->get_var($query);
    return $result;
}
?>
