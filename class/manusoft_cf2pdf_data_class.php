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
    $columns = [];
    $columns['cb'] = '<input type="checkbox" />';
    $columns['id'] = '<b>#</b>';
    foreach (manusoft_cf2pdf_get_indexes($_GET['id']) as $index) {
      $columns[$index] = '<b>'.str_replace("your-","",$index).'</b>';
    }
    $columns['download'] = '<b>Descargar</b>';
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
          'delete' => 'Eliminar'
      );
      return $actions;
  }

  function process_bulk_action() {
      //Detect when a bulk action is being triggered...

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
        return '<a href="'.plugins_url().'/manusoft-cf2pdf/pdf-templates/manusoft_cf2pdf_default_template.php?id='.$item['form_id'].'" target="_blank">Descargar en PDF</a>';
      case $column_name:
        return $item[$column_name];
      default:
        return print_r($item,true); //Show the whole array for troubleshooting purposes
    }
  }

}
?>
