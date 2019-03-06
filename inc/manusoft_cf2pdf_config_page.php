<?php
defined('ABSPATH') or die('No tienes permiso para hacer eso.');
?>
<div class="wrap">
  <h1 class="wp-heading-inline">CF2PDF - Configuración de la plantilla PDF</h1>
  <hr class="wp-header-end">
  <div id="poststuff">
    <div id="postbox-container-cf2pdf-config" class="postbox-container">
      <div id="side-sortables" class="meta-box-sortables ui-sortable">
        <div class="postbox">
          <h2 class="hndle ui-sortable-handle">
            <span>Encabezado</span>
          </h2>
          <div class="inside">
            <p class="post-attributes-label-wrapper">Selecciona la imagen del encabezado de la plantilla PDF:</p>
            <div class="manusoft_cf2pdf_header_preview">
              <?php
                $image_id = get_option('manusoft_cf2pdf_image_id');
                if (intval($image_id) > 0) {
                  echo wp_get_attachment_image($image_id, 'medium', false, array('id'=>'manusoft_cf2pdf_preview_header'));
                } else {
                  echo '<img id="manusoft_cf2pdf_preview_header" width="150" height="150" src="'.plugins_url('/images/notfound.png', __DIR__).'" />';
                }
              ?>
            </div>
            <div class="manusoft_cf2pdf_header_input">
              <input type="text" name="upload_image" id="manusoft_cf2pdf_upload_image" value="" size='40' />
              <input type="button" class='button-secondary' id="manusoft_cf2pdf_upload_image_button" value="Subir imagen" />
            </div>
          </div>
        </div>
        <div class="postbox">
          <h2 class="hndle ui-sortable-handle">
            <span>Lateral</span>
          </h2>
          <div class="inside">
            <p class="post-attributes-label-wrapper">Selecciona la imagen superior del lateral de la plantilla PDF:</p>
            <input type="file" /><br>
            <p class="post-attributes-label-wrapper">Selecciona la imagen inferior del lateral de la plantilla PDF:</p>
            <input type="file" /><br>
            <p class="post-attributes-label-wrapper">Introduce el texto del lateral de la plantilla PDF:</p>
            <textarea rows="5" style="width:100%;"></textarea>
          </div>
        </div>
        <div class="postbox">
          <h2 class="hndle ui-sortable-handle">
            <span>Pie</span>
          </h2>
          <div class="inside">
            <p class="post-attributes-label-wrapper">Selecciona la imagen del pie de la plantilla PDF:</p>
            <input type="file" />
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
