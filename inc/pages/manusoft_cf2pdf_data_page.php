<?php
defined('ABSPATH') or die('No tienes permiso para hacer eso.');

if (!current_user_can('manage_options'))  {
    wp_die( __('No tienes suficientes permisos para acceder a esta página.') );
} else {    
    $DataListTable = new manusoft_cf2pdf_data_list_table();
    $DataListTable->prepare_items();
    
    if ($DataListTable->current_action() == "download_varios") {
        session_start();
        $_SESSION['start'] = "1";        
        $index = 0;
        foreach ($_GET['datas'] as $data) {
            $_SESSION['data_varios'][$index] = unserialize(manusoft_cf2pdf_get_data_by_id($data)["form_value"]);
            $index++;
        }
        $config = manusoft_cf2pdf_get_cofig_data();
        if ($config != NULL) {
            foreach ($config as $key => $value) {
                $_SESSION['config'][$key] = $value;
            }
        }
        $form_type = manusoft_cf2pdf_get_form_type($_GET['id']);
        if ($form_type == NULL) {
            echo "<script>
                window.open('".plugins_url()."/manusoft-cf2pdf/pdf-templates/manusoft_cf2pdf_default_template.php?varios=1', '_blank');
              </script>";
        } else if ($form_type == 'consentimiento') {
            echo "<script>
                window.open('".plugins_url()."/manusoft-cf2pdf/pdf-templates/manusoft_cf2pdf_consentimiento_template.php?varios=1', '_blank');
              </script>";
        } else if ($form_type == 'banco') {
            echo "<script>
                window.open('".plugins_url()."/manusoft-cf2pdf/pdf-templates/manusoft_cf2pdf_banco_template.php?varios=1', '_blank');
              </script>";
        } else if ($form_type == 'inscripcion') {
            echo "<script>
                window.open('".plugins_url()."/manusoft-cf2pdf/pdf-templates/manusoft_cf2pdf_inscripcion_template.php?varios=1', '_blank');
              </script>";
        } else if ($form_type == 'medico') {
            echo "<script>
                window.open('".plugins_url()."/manusoft-cf2pdf/pdf-templates/manusoft_cf2pdf_medico_template.php?varios=1', '_blank');
              </script>";
        }
    } else if (isset($_GET['action']) && $_GET['action'] = 'delete') {
        $delete_result = manusoft_cf2pdf_delete_data($_GET['data_id']);
        if ($delete_result) {
            $delete_message = "<div class='notice manusoft_cf2pdf_updated'>El registro se ha eliminado correctamente.</div>";
        } else {
            $delete_message = "<div class='notice manusoft_cf2pdf_error'>Ha ocurrido un error eliminado el registro. Inténtalo de nuevo más tarde.</div>";
        }
        $DataListTable->prepare_items();
    }
?>

<div id="manusoft_cf2pdf_data" class="wrap">
	<h1 class="wp-heading-inline">CF7 to PDF - Registros</h1>
	<hr class="wp-header-end">
	<div id="poststuff">
		<span id="manusoft_cf2pdf_messages"><?php if (isset($delete_message)) { echo $delete_message; } ?></span>
        <form id="cfdb7-pdf-form" method="get">
        	<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
        	<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
			<?php $DataListTable->display(); ?>
		</form>
	</div>
</div>

<?php
}
?>
