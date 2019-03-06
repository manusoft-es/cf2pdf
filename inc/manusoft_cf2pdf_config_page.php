<?php
defined('ABSPATH') or die('No tienes permiso para hacer eso.');
?>
<div class="wrap">
  <h1 class="wp-heading-inline">CF2PDF - Configuración de la plantilla PDF</h1>
  <hr class="wp-header-end">
  <form action="" method="post">
    <div id="poststuff">
      <div id="postbox-container-cf2pdf-config" class="postbox-container">
        <div id="side-sortables" class="meta-box-sortables ui-sortable">
          <div class="postbox">
            <h2 class="hndle ui-sortable-handle">
              <span>Encabezado</span>
            </h2>
            <div class="inside">
              <p class="post-attributes-label-wrapper">Selecciona la imagen del encabezado de la plantilla PDF:</p>
              <div class="manusoft_cf2pdf_header">
                <div class="manusoft_cf2pdf_image_preview">
                  <?php
                    echo '<img id="manusoft_cf2pdf_header_preview" width="150" height="150" src="'.plugins_url('/images/notfound.png', __DIR__).'" />';
                  ?>
                </div>
                <div class="manusoft_cf2pdf_image_input">
                  <input type="text" name="header_url" id="manusoft_cf2pdf_header_url" value="" size="40" />
                  <input type="button" class="button-secondary" id="manusoft_cf2pdf_header_button" value="Subir imagen" />
                </div>
              </div>
            </div>
          </div>
          <div class="postbox">
            <h2 class="hndle ui-sortable-handle">
              <span>Lateral</span>
            </h2>
            <div class="inside">
              <p class="post-attributes-label-wrapper">Selecciona la imagen superior del lateral de la plantilla PDF:</p>
              <div class="manusoft_cf2pdf_lateral_sup">
                <div class="manusoft_cf2pdf_image_preview">
                  <?php
                    echo '<img id="manusoft_cf2pdf_lateral_sup_preview" width="150" height="150" src="'.plugins_url('/images/notfound.png', __DIR__).'" />';
                  ?>
                </div>
                <div class="manusoft_cf2pdf_image_input">
                  <input type="text" name="lateral_sup_url" id="manusoft_cf2pdf_lateral_sup_url" value="" size="40" />
                  <input type="button" class="button-secondary" id="manusoft_cf2pdf_lateral_sup_button" value="Subir imagen" />
                </div>
              </div>
              <p class="post-attributes-label-wrapper">Selecciona la imagen inferior del lateral de la plantilla PDF:</p>
              <div class="manusoft_cf2pdf_lateral_inf">
                <div class="manusoft_cf2pdf_image_preview">
                  <?php
                    echo '<img id="manusoft_cf2pdf_lateral_inf_preview" width="150" height="150" src="'.plugins_url('/images/notfound.png', __DIR__).'" />';
                  ?>
                </div>
                <div class="manusoft_cf2pdf_image_input">
                  <input type="text" name="lateral_inf_url" id="manusoft_cf2pdf_lateral_inf_url" value="" size="40" />
                  <input type="button" class="button-secondary" id="manusoft_cf2pdf_lateral_inf_button" value="Subir imagen" />
                </div>
              </div>
              <p class="post-attributes-label-wrapper">Introduce el texto del lateral de la plantilla PDF:</p>
              <textarea name="lateral_text" rows="5" style="width:100%;"></textarea>
            </div>
          </div>
          <div class="postbox">
            <h2 class="hndle ui-sortable-handle">
              <span>Pie</span>
            </h2>
            <div class="inside">
              <p class="post-attributes-label-wrapper">Selecciona la imagen del pie de la plantilla PDF:</p>
              <div class="manusoft_cf2pdf_footer">
                <div class="manusoft_cf2pdf_image_preview">
                  <?php
                    echo '<img id="manusoft_cf2pdf_footer_preview" width="150" height="150" src="'.plugins_url('/images/notfound.png', __DIR__).'" />';
                  ?>
                </div>
                <div class="manusoft_cf2pdf_image_input">
                  <input type="text" name="footer_url" id="manusoft_cf2pdf_footer_url" value="" size="40" />
                  <input type="button" class="button-secondary" id="manusoft_cf2pdf_footer_button" value="Subir imagen" />
                </div>
              </div>
              <p class="post-attributes-label-wrapper">Introduce el texto del pie de la plantilla PDF:</p>
              <textarea name="footer_text" rows="5" style="width:100%;"></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
