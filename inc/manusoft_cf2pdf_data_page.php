<?php
defined('ABSPATH') or die('No tienes permiso para hacer eso.');
if (!current_user_can('manage_options'))  {
    wp_die( __('No tienes suficientes permisos para acceder a esta página.') );
} else {
  $DataListTable = new manusoft_cf2pdf_data_list_table();
  $DataListTable->prepare_items();
?>
<div id="manusoft_cf2pdf_data" class="wrap">
  <h1 class="wp-heading-inline">CF7 to PDF - Registros</h1>
  <hr class="wp-header-end">
  <div id="poststuff">
    <span id="manusoft_cf2pdf_messages"></span>
    <?php
      echo var_dump(manusoft_cf2pdf_get_cofig_data());
      $DataListTable->display();
    ?>
  </div>
</div>
<?php
}

?>
