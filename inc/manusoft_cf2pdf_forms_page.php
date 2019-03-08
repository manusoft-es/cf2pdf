<?php
defined('ABSPATH') or die('No tienes permiso para hacer eso.');
?>
<div id="manusoft_cf2pdf_config" class="wrap">
  <div id="poststuff">
    <div id="post-body" class="columns-2">
      <div id="postbox-container-1" class="postbox-container">
        <div id="manusoft_cf2pdf_guardar_button" class="postbox">
          <h2 class="hndle ui-sortable-handle">
            <span>Guardar</span>
          </h2>
          <div class="inside">
            <input type="submit" name="guardar" class="button button-primary button-large" value="Guardar configuración" />
          </div>
        </div>
      </div>
      <div id="postbox-container-2" class="postbox-container">
        <div class="postbox">
          <h2 class="hndle ui-sortable-handle">
            <span>Encabezado</span>
          </h2>
          <div class="inside">
            <div id="manusoft_cf2pdf_header">
              <p class="post-attributes-label-wrapper">Selecciona la imagen del encabezado de la plantilla PDF:</p>
              <div class="manusoft_cf2pdf_image_preview">
                <?php
                  echo '<img id="manusoft_cf2pdf_header_preview" width="150" height="150" src="'.plugins_url('/images/notfound.png', __DIR__).'" />';
                ?>
              </div>
              <div class="manusoft_cf2pdf_image_input">
                <input type="text" name="header_url" id="manusoft_cf2pdf_header_url" value="" />
                <input type="button" class="button-secondary" id="manusoft_cf2pdf_header_button" value="Subir imagen" />
              </div>
            </div>
          </div>
        </div>
        <div class="postbox">
          <h2 class="hndle ui-sortable-handle">
            <span>Pie</span>
          </h2>
          <div class="inside">
            <div class="manusoft_cf2pdf_footer">
              <table>
                <tr>
                  <td>
                    <p class="post-attributes-label-wrapper">Selecciona la imagen del pie de la plantilla PDF:</p>
                    <div class="manusoft_cf2pdf_image_preview">
                      <?php
                        echo '<img id="manusoft_cf2pdf_footer_preview" width="150" height="150" src="'.plugins_url('/images/notfound.png', __DIR__).'" />';
                      ?>
                    </div>
                    <div class="manusoft_cf2pdf_image_input">
                      <input type="text" name="footer_url" id="manusoft_cf2pdf_footer_url" value="" />
                      <input type="button" class="button-secondary" id="manusoft_cf2pdf_footer_button" value="Subir imagen" />
                    </div>
                  </td>
                  <td>
                    <p class="post-attributes-label-wrapper">Introduce el texto del pie de la plantilla PDF:</p>
                    <textarea name="footer_text" rows="5" style="width:100%;"></textarea>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
