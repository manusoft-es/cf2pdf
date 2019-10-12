<?php
session_start();
defined('ABSPATH') or die('No tienes permiso para hacer eso');
/*
 *  Métodos para crear la tabla con los formularios del panel de administración.
 */

// Si la clase WP_List_Table no ha sido cargada la insertamos
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH.'wp-admin/includes/class-wp-list-table.php');
}

// Clase secundaria que extiende de 'WP_List_Table'
class manusoft_cf2pdf_data_list_table extends WP_List_Table {
    function get_columns() {
        $indexes = manusoft_cf2pdf_get_indexes($_GET['id']);
        $form_type = manusoft_cf2pdf_get_form_type($_GET['id']);
        
        $columns = [];
        $columns['cb'] = '<input type="checkbox" />';
        $columns['id'] = '<b>#</b>';
        if ($form_type == NULL) {
            foreach ($indexes as $index) {
                if (strpos($index,"-attachment") === false && strpos($index,"-inline") === false) {
                    $columns[$index] = '<b>'.str_replace("your-","",$index).'</b>';
                }
            }
        } else if ($form_type == 'consentimiento') {
            $columns['nombre_nino_a'] = '<b>Nombre del niño/a</b>';
            $columns['nombre_padre_madre'] = '<b>Nombre del padre/madre</b>';
            $columns['dni_padre_madre'] = '<b>DNI del padre/madre</b>';
            $columns['tratamiento_imagenes'] = '<b>Autorización</b>';
            $columns['fecha'] = '<b>Fecha de la cumplimentación</b>';
            $columns['firma'] = '<b>Firma</b>';
        } else if ($form_type == 'banco') {
            $columns['familia'] = '<b>Familia</b>';
            $columns['importe'] = '<b>Importe</b>';
            $columns['titular'] = '<b>Titular</b>';
            $columns['dni'] = '<b>DNI del titular</b>';
            $columns['num_cuenta'] = '<b>Número de cuenta</b>';
            $columns['firma'] = '<b>Firma</b>';
        } else if ($form_type == 'inscripcion') {
            $columns['nombre_nino_a'] = '<b>Nombre del niño/a</b>';
            $columns['rama'] = '<b>Rama</b>';
            $columns['fecha_ingreso'] = '<b>Fecha de ingreso</b>';
            $columns['nombre_padre'] = '<b>Nombre del padre</b>';
            $columns['tlf_movil_padre'] = '<b>Tlf. móvil del padre</b>';
            $columns['nombre_madre'] = '<b>Nombre de la madre</b>';
            $columns['tlf_movil_madre'] = '<b>Tlf. móvil de la madre</b>';
            $columns['firma'] = '<b>Firma</b>';
        } else if ($form_type == 'medico') {
            $columns['fecha_cumplimentacion'] = '<b>Fecha de cumplimentación</b>';
            $columns['nombre'] = '<b>Nombre</b>';
            $columns['fecha_nacimiento'] = '<b>Fecha de nacimiento</b>';
            $columns['nombre_padre'] = '<b>Nombre del padre/madre</b>';
            $columns['firma'] = '<b>Firma</b>';
        }
        $columns['download'] = '<b>Descargar</b>';
        $columns['delete'] = '<b>Eliminar</b>';
        return $columns;
    }
    
    function prepare_items() {
        $columns = $this->get_columns();
        $hidden = array();
        $perPage = 5;
        $currentPage = $this->get_pagenum();
        $count_datas = manusoft_cf2pdf_count_data($_GET['id']);
        $totalItems = $count_datas;
        $this->set_pagination_args(array(
            'total_items' => $totalItems,
            'per_page' => $perPage
            ));
        
        $sortable = array();
        
        $this->_column_headers = array($columns,$hidden,$sortable);
        $this->items = manusoft_cf2pdf_get_data($_GET['id'],$perPage,$currentPage);
        $this->process_bulk_action();
    }
    
    function get_bulk_actions() {
        $actions = array(
            'download_varios' => 'Descargar en PDF'
            );
        return $actions;
    }
    
    function process_bulk_action() {
        //Detect when a bulk action is being triggered...
        if( 'download_varios' === $this->current_action() ) {
            $_SESSION['action'] = 'download_varios';
        }
    }
    
    function column_cb($item) {
        return sprintf(
            '<input type="checkbox" name="datas[]" value="%s" />',
            $item['form_id']
            );
    }
    
    function column_default($item,$column_name) {
        switch ($column_name) {
            case 'id':
                return $item['form_id'];
            case 'download':
                //return '<a href="?page=manusoft-cf2pdf/pdf-templates/manusoft_cf2pdf_default_template.php">Descargar en PDF</a>';
                $_SESSION['start'] = "1";
                $_SESSION['data'][$item['form_id']] = $item;
                $_SESSION['form_title'] = get_the_title($_GET['id']);
                $config = manusoft_cf2pdf_get_cofig_data();
                if ($config != NULL) {
                    foreach ($config as $key => $value) {
                        $_SESSION['config'][$key] = $value;
                    }
                }
                $form_type = manusoft_cf2pdf_get_form_type($_GET['id']);
                if ($form_type == NULL) {
                    return '<a href="'.plugins_url().'/manusoft-cf2pdf/pdf-templates/manusoft_cf2pdf_default_template.php?id='.$item['form_id'].'" target="_blank">Descargar en PDF</a>';
                } else if ($form_type == 'consentimiento') {
                    return '<a href="'.plugins_url().'/manusoft-cf2pdf/pdf-templates/manusoft_cf2pdf_consentimiento_template.php?id='.$item['form_id'].'" target="_blank">Descargar en PDF</a>';
                } else if ($form_type == 'banco') {
                    return '<a href="'.plugins_url().'/manusoft-cf2pdf/pdf-templates/manusoft_cf2pdf_banco_template.php?id='.$item['form_id'].'" target="_blank">Descargar en PDF</a>';
                } else if ($form_type == 'inscripcion') {
                    return '<a href="'.plugins_url().'/manusoft-cf2pdf/pdf-templates/manusoft_cf2pdf_inscripcion_template.php?id='.$item['form_id'].'" target="_blank">Descargar en PDF</a>';
                } else if ($form_type == 'medico') {
                    return '<a href="'.plugins_url().'/manusoft-cf2pdf/pdf-templates/manusoft_cf2pdf_medico_template.php?id='.$item['form_id'].'" target="_blank">Descargar en PDF</a>';
                }
            case 'delete':
                return sprintf('<a class="delete_link" href="?page=%s&action=%s&id=%s&data_id=%s&paged=%s">Eliminar</a>',$_REQUEST['page'],'delete',$_GET['id'],$item['form_id'],$this->get_pagenum());
            case $column_name:
                if (is_array($item[$column_name])) {
                    return implode(",",$item[$column_name]);
                } else {
                    if (preg_match("/^((http|https):\/\/?)[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|\/?))$/",str_replace("&#047;", "/", $item[$column_name]))) {
                        return '<a target="_blank" href="'.str_replace("&#047;", "/", $item[$column_name]).'">Ver enlace</a>';
                    } else {
                        return $item[$column_name];
                    }
                }
            default:
                return print_r($item,true); //Show the whole array for troubleshooting purposes
        }
    }
}
?>
