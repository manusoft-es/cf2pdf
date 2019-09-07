<?php
defined('ABSPATH') or die('No tienes permiso para hacer eso.');

if (!current_user_can('manage_options'))  {
    wp_die( __('No tienes suficientes permisos para acceder a esta página.') );
} else {
?>

<div id="manusoft_cf2pdf_forms" class="wrap">
	<h1 class="wp-heading-inline">CF7 to PDF - Log</h1>
	<hr class="wp-header-end">
	<div id="poststuff">
		<textarea rows="30" style="width:100%; padding:1%; color:#444; background:#fff;" disabled><?php echo manusoft_cf2pdf_get_error_log();?></textarea>
	</div>
</div>

<?php
}
?>
