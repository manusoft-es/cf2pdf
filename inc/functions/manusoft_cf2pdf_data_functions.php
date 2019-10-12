<?php
defined('ABSPATH') or die('No tienes permiso para hacer eso.');

function manusoft_cf2pdf_get_data($form_id, $per_page = 5, $page_number = 1) {
    global $wpdb;
    $offset = ($page_number-1) == 0 ? 0 : ($page_number-1)*$per_page;
    $query = "SELECT
                    *
                FROM ".$wpdb->prefix."manusoft_cf2pdf_data
                WHERE form_post_id = '".$form_id."'
                ORDER BY form_date DESC
                LIMIT ".$per_page."
                OFFSET ".$offset;
    $datas = $wpdb->get_results($query,"ARRAY_A");
    
    $results = [];
    
    foreach ($datas as $data) {
        $result = [];
        $result['form_id'] = $data['form_id'];
        $values = maybe_unserialize($data['form_value']);
        $indexes = array_keys($values);
        foreach ($indexes as $index) {
            $result[$index] = $values[$index];
        }
        $result['form_date'] = date('d/m/Y H:i',strtotime($data['form_date']));
        array_push($results,$result);
    }
    return $results;
}

function manusoft_cf2pdf_get_data_by_id($data_id) {
    global $wpdb;
    $query = "SELECT * FROM ".$wpdb->prefix."manusoft_cf2pdf_data WHERE form_id = ".$data_id;
    return $wpdb->get_row($query,"ARRAY_A");
}

function manusoft_cf2pdf_delete_data($data_id) {
    global $wpdb;
    $table = $wpdb->prefix.'manusoft_cf2pdf_data';
    $res = $wpdb->delete($table, array('form_id' => $data_id));
    
    if ($res == 0) {
        return false;
    } else {
        return true;
    }
}

function manusoft_cf2pdf_get_indexes($form_id) {
    global $wpdb;
    $query = "SELECT
                    form_value
                FROM ".$wpdb->prefix."manusoft_cf2pdf_data
                WHERE form_post_id = '".$form_id."'
                ORDER BY form_id DESC
                LIMIT 1;";
    $result = maybe_unserialize($wpdb->get_row($query,"ARRAY_A")['form_value']);
    if ($result != null) {
        $indexes = array_keys($result);
    } else {
        $indexes = [];
    }
    return $indexes;
}

function manusoft_cf2pdf_count_data($form_id) {
    global $wpdb;
    $query = "SELECT COUNT(1) FROM ".$wpdb->prefix."manusoft_cf2pdf_data WHERE form_post_id = '".$form_id."';";
    return $wpdb->get_var($query);
}

function manusoft_cf2pdf_get_form_type($form_id) {
    global $wpdb;
    $query = "SELECT meta_value FROM ".$wpdb->prefix."postmeta WHERE post_id = ".$form_id." AND meta_key = '_manusoft_form_type';";
    return $wpdb->get_var($query);
}

?>
