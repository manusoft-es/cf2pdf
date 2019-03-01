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
            <input type="file" />
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
