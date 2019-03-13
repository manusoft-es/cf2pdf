<?php
defined('ABSPATH') or die('No tienes permiso para hacer eso.');
if (!current_user_can('manage_options'))  {
    wp_die( __('No tienes suficientes permisos para acceder a esta página.') );
} else {
  $FormsListTable = new manusoft_cf2pdf_forms_list_table();
  $FormsListTable->prepare_items();
?>
<div id="manusoft_cf2pdf_forms" class="wrap">
  <h1 class="wp-heading-inline">CF7 to PDF - Formularios</h1>
  <hr class="wp-header-end">
  <div id="poststuff">
    <span id="manusoft_cf2pdg_messages"></span>
    <?php $FormsListTable->display(); ?>
  </div>
</div>
<?php
}
?>
