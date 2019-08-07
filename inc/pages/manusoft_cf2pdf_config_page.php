<?php
defined('ABSPATH') or die('No tienes permiso para hacer eso.');

$config_data = manusoft_cf2pdf_get_cofig_data();
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
						<span>Configuración de la plantilla general</span>
					</h2>
					<div id="manusoft_cf2pdf_plantilla" class="inside">
						TEST
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
									<input type="text" id="cp_grupo" name="cp_grupo" class="regular-text" value="<?php echo $config_data['cp_grupo']; ?>" />
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>