<?php
defined('ABSPATH') or die('No tienes permiso para hacer eso.');

$config_data = manusoft_cf2pdf_get_cofig_data();
if (check_initial_config()) {
    $config['url_img_sup'] != "" ? $header_url = $config['url_img_sup'] : $header_url = plugins_url('/manusoft-cf2pdf/images/notfound.png');
    $config['url_img_lat_sup'] != "" ? $lateral_sup_url = $config['url_img_lat_sup'] : $lateral_sup_url = plugins_url('/manusoft-cf2pdf/images/notfound.png');
    $config['url_img_lat_inf'] != "" ? $lateral_inf_url = $config['url_img_lat_inf'] : $lateral_inf_url = plugins_url('/manusoft-cf2pdf/images/notfound.png');
    $lateral_text = $config['txt_lat'];
    $footer_text = $config['txt_inf'];
}
?>
<div id="manusoft_cf2pdf_config" class="wrap">
	<h1 class="wp-heading-inline">CF7 to PDF - Configuración</h1>
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
		<?php if (check_initial_config()) { ?>
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
		<?php } ?>
			<div id="postbox-container-2" class="postbox-container">
				<div class="postbox">
					<h2 class="hndle ui-sortable-handle">
						<span>Configuración inicial</span>
					</h2>
					<div id="manusoft_cf2pdf_config_inicial" class="inside">
						<table class="form-table">
							<tr>
								<th scope="row">
									<label for="nombre_grupo">Nombre del grupo o asociación</label>
								</th>
								<td>
									<input type="text" id="nombre_grupo" name="nombre_grupo" class="regular-text" value="<?php echo $config_data['nombre_grupo']; ?>" />
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="cif_grupo">CIF</label>
								</th>
								<td>
									<input type="text" id="cif_grupo" name="cif_grupo" maxlength="9" size="9" class="regular-text" value="<?php echo $config_data['cif_grupo']; ?>" />
									<p class="description" id="cif_grupo-description"><small>El CIF debe estar formado por una letra (A,B,C,D,E,F,G,H,J,K,L,M,N,P,Q,R,S,U,V,W) seguida de 7 dígitos y por otra letra (de la A a la J) o número al final. (Ejemplo: A1234567B o A12345678)</small></p>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="email_grupo">Email</label>
								</th>
								<td>
									<input type="email" id="email_grupo" name="email_grupo" class="regular-text ltr" value="<?php echo $config_data['email_grupo']; ?>" />
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="direccion_grupo">Dirección</label>
								</th>
								<td>
									<textarea id="direccion_grupo" name="direccion_grupo" rows="3" cols="40" maxlength="255" class="code"><?php echo $config_data['direccion_grupo']; ?></textarea>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="poblacion_grupo">Población</label>
								</th>
								<td>
									<input type="text" id="poblacion_grupo" name="poblacion_grupo" class="regular-text" value="<?php echo $config_data['poblacion_grupo']; ?>" />
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="provincia_grupo">Provincia</label>
								</th>
								<td>
									<input type="text" id="provincia_grupo" name="provincia_grupo" class="regular-text" value="<?php echo $config_data['provincia_grupo']; ?>" />
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="cp_grupo">Código postal</label>
								</th>
								<td>
									<input type="text" id="cp_grupo" name="cp_grupo" maxlength="6" size="6" class="regular-text" value="<?php echo $config_data['cp_grupo']; ?>" />
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>