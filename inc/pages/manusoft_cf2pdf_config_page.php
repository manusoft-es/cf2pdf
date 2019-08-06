<?php
defined('ABSPATH') or die('No tienes permiso para hacer eso.');
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
									<input type="text" id="nombre_grupo" name="nombre_grupo" class="regular-text" />
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="cif_grupo">CIF</label>
								</th>
								<td>
									<input type="text" id="cif_grupo" name="cif_grupo" maxlength="9" size="9" class="regular-text" />
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="email_grupo">Email</label>
								</th>
								<td>
									<input type="email" id="email_grupo" name="email_grupo" class="regular-text ltr" />
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="direccion_grupo">Dirección</label>
								</th>
								<td>
									<textarea name="direccion_grupo" rows="3" cols="40" maxlength="255" class="code"></textarea>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="poblacion_grupo">Población</label>
								</th>
								<td>
									<input type="text" id="poblacion_grupo" name="poblacion_grupo" class="regular-text" />
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="provincia_grupo">Provincia</label>
								</th>
								<td>
									<input type="text" id="provincia_grupo" name="provincia_grupo" class="regular-text" />
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="cp_grupo">Código postal</label>
								</th>
								<td>
									<input type="text" id="cp_grupo" name="cp_grupo" class="regular-text" />
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>