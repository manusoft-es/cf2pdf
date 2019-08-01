<?php
defined('ABSPATH') or die('No tienes permiso para hacer eso.');
$config = manusoft_cf2pdf_get_cofig_data();
if ($config != NULL) {
  $config['url_img_sup'] != "" ? $header_url = $config['url_img_sup'] : $header_url = plugins_url('/images/notfound.png', __DIR__);
  $config['url_img_lat_sup'] != "" ? $lateral_sup_url = $config['url_img_lat_sup'] : $lateral_sup_url = plugins_url('/images/notfound.png', __DIR__);
  $config['url_img_lat_inf'] != "" ? $lateral_inf_url = $config['url_img_lat_inf'] : $lateral_inf_url = plugins_url('/images/notfound.png', __DIR__);
  $config['url_img_inf'] != "" ? $footer_url = $config['url_img_inf'] : $footer_url = plugins_url('/images/notfound.png', __DIR__);
  $lateral_text = $config['txt_lat'];
  $footer_text = $config['txt_inf'];
} else {
  $header_url = plugins_url('/images/notfound.png', __DIR__);
  $lateral_sup_url = plugins_url('/images/notfound.png', __DIR__);
  $lateral_inf_url = plugins_url('/images/notfound.png', __DIR__);
  $footer_url = plugins_url('/images/notfound.png', __DIR__);
  $lateral_text = "";
  $footer_text = "";
}
?>
<div id="manusoft_cf2pdf_config" class="wrap">
  <h1 class="wp-heading-inline">CF7 to PDF - Configuración de la plantilla PDF</h1>
  <hr class="wp-header-end">
  <div id="poststuff">
    <span id="manusoft_cf2pdg_messages"></span>
    <div id="post-body" class="columns-2">
      <div id="postbox-container-1" class="postbox-container">
        <div id="manusoft_cf2pdf_guardar" class="postbox">
          <h2 class="hndle ui-sortable-handle">
            <span>Guardar</span>
          </h2>
          <div class="inside">
            <button id="manusoft_cf2pdf_guardar_button" class="button button-primary button-large">Guardar configuración</button>
          </div>
        </div>
      </div>
      <div id="postbox-container-2" class="postbox-container">
        <div class="postbox">
          <h2 class="hndle ui-sortable-handle">
            <span>Encabezado</span>
          </h2>
          <div id="manusoft_cf2pdf_header" class="inside">
            <div>
              <p class="post-attributes-label-wrapper"><b>Selecciona la imagen del encabezado de la plantilla PDF:</b></p>
              <div class="manusoft_cf2pdf_image_preview">
                <?php
                  echo '<img id="manusoft_cf2pdf_header_preview" width="150" height="150" src="'.$header_url.'" />';
                ?>
              </div>
              <div class="manusoft_cf2pdf_image_input">
                <input type="text" name="header_url" id="manusoft_cf2pdf_header_url" value="<?php if ($config['url_img_sup'] != "") { echo $header_url; } ?>" />
                <input type="button" class="button-secondary" id="manusoft_cf2pdf_header_button" value="Subir imagen" />
              </div>
            </div>
          </div>
        </div>
        <div class="postbox">
          <h2 class="hndle ui-sortable-handle">
            <span>Lateral</span>
          </h2>
          <div id="manusoft_cf2pdf_lateral" class="inside">
            <div style="width:100%;">
              <table>
                <tr>
                  <td id="manusoft_cf2pdf_lateral_sup_image">
                    <p class="post-attributes-label-wrapper"><b>Selecciona la imagen superior del lateral de la plantilla PDF:</b></p>
                    <div class="manusoft_cf2pdf_image_preview">
                      <?php
                        echo '<img id="manusoft_cf2pdf_lateral_sup_preview" width="150" height="150" src="'.$lateral_sup_url.'" />';
                      ?>
                    </div>
                    <div class="manusoft_cf2pdf_image_input">
                      <input type="text" name="lateral_sup_url" id="manusoft_cf2pdf_lateral_sup_url" value="<?php if ($config['url_img_lat_sup'] != "") { echo $lateral_sup_url; } ?>" />
                      <input type="button" class="button-secondary" id="manusoft_cf2pdf_lateral_sup_button" value="Subir imagen" />
                    </div>
                  </td>
                  <td id="manusoft_cf2pdf_lateral_inf_image">
                    <p class="post-attributes-label-wrapper"><b>Selecciona la imagen inferior del lateral de la plantilla PDF:</b></p>
                    <div class="manusoft_cf2pdf_image_preview">
                      <?php
                        echo '<img id="manusoft_cf2pdf_lateral_inf_preview" width="150" height="150" src="'.$lateral_inf_url.'" />';
                      ?>
                    </div>
                    <div class="manusoft_cf2pdf_image_input">
                      <input type="text" name="lateral_inf_url" id="manusoft_cf2pdf_lateral_inf_url" value="<?php if ($config['url_img_lat_inf'] != "") { echo $lateral_inf_url; } ?>"/>
                      <input type="button" class="button-secondary" id="manusoft_cf2pdf_lateral_inf_button" value="Subir imagen" />
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" id="manusoft_cf2pdf_lateral_txt">
                    <p class="post-attributes-label-wrapper"><b>Introduce el texto del lateral de la plantilla PDF:</b></p>
                    <textarea id="manusoft_cf2pdf_lateral_text" name="lateral_text" rows="5" maxlength="520" style="width:100%;"><?php echo $lateral_text; ?></textarea>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="postbox">
          <h2 class="hndle ui-sortable-handle">
            <span>Pie</span>
          </h2>
          <div id="manusoft_cf2pdf_footer" class="inside">
            <div style="width:100%;">
              <table>
                <tr>
                  <td id="manusoft_cf2pdf_footer_image">
                    <p class="post-attributes-label-wrapper"><b>Selecciona la imagen del pie de la plantilla PDF:</b></p>
                    <div class="manusoft_cf2pdf_image_preview">
                      <?php
                        echo '<img id="manusoft_cf2pdf_footer_preview" width="150" height="150" src="'.$footer_url.'" />';
                      ?>
                    </div>
                    <div class="manusoft_cf2pdf_image_input">
                      <input type="text" name="footer_url" id="manusoft_cf2pdf_footer_url" value="<?php if ($config['url_img_inf'] != "") { echo $footer_url; } ?>" />
                      <input type="button" class="button-secondary" id="manusoft_cf2pdf_footer_button" value="Subir imagen" />
                    </div>
                  </td>
                  <td id="manusoft_cf2pdf_footer_textarea">
                    <p class="post-attributes-label-wrapper"><b>Introduce el texto del pie de la plantilla PDF:</b></p>
                    <textarea id="manusoft_cf2pdf_footer_text" name="footer_text" rows="5" maxlength="880" style="width:100%;"><?php echo $footer_text; ?></textarea>
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
