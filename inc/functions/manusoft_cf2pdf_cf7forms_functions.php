<?php
// Función para obtener el ID del formulario por defecto cuyo '_manusoft_form_type' se pasa como parámetro
function manusoft_cf2pdf_get_default_id_form($default_type) {
    global $wpdb;
    $table_postmeta = $wpdb->prefix."postmeta";
    $default_id_form = $wpdb->get_var("SELECT post_id FROM ".$table_postmeta." WHERE meta_key = '_manusoft_form_type' AND meta_value = '".$default_type."';");
    return $default_id_form;
}

// Creación de los formularios de ContactForm7 por defecto
function manusoft_cf2pdf_create_forms() {
    manusoft_cf2pdf_create_consentimiento_form();
    manusoft_cf2pdf_create_inscripcion_form();
    manusoft_cf2pdf_create_medico_form();
    manusoft_cf2pdf_create_banco_form();
}
// Creación de los formularios de ContactForm7 por defecto
function manusoft_cf2pdf_update_forms() {
    manusoft_cf2pdf_update_consentimiento_form();
    manusoft_cf2pdf_update_inscripcion_form();
    manusoft_cf2pdf_update_medico_form();
    manusoft_cf2pdf_update_banco_form();
}

// Creación del formulario "Consentimiento Tratamiento de Datos de Carácter Personal"
function manusoft_cf2pdf_create_consentimiento_form() {
    global $wpdb;
    $check_error = false;
    $table_post = $wpdb->prefix."posts";
    $table_postmeta = $wpdb->prefix."postmeta";
    $data = array(
        'post_author' => 1,
        'post_date' => date('Y-m-d H:i:s'),
        'post_date_gmt' => date('Y-m-d H:i:s'),
        'post_content' => manusoft_cf2pdf_get_consentimiento_content(),
        'post_title' => 'Consentimiento tratamiento de datos de carácter personal',
        'comment_status' => 'closed',
        'ping_status' => 'closed',
        'post_name' => 'consentimiento-tratamient-de-datos-de-caracter-personal',
        'post_modified' => date('Y-m-d H:i:s'),
        'post_modified_gmt' => date('Y-m-d H:i:s'),
        'guid' => '',
        'post_type' => 'wpcf7_contact_form'
    );
    $insert_result = $wpdb->insert($table_post,$data);
    $id = $wpdb->insert_id;
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error en la creación del formulario 'Consentimiento tratamiento de datos de caracter personal'");
    }
    
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_additional_settings',
        'meta_value' => ''
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_additional_settings' en postmeta para 'Consentimiento tratamiento de datos de caracter personal'");
    }
    
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_locale',
        'meta_value' => 'es_ES'
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_locale' en postmeta para 'Consentimiento tratamiento de datos de caracter personal'");
    }
    
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_messages',
        'meta_value' => 'a:23:{s:12:"mail_sent_ok";s:44:"Muchas gracias por rellenar este formulario.";s:12:"mail_sent_ng";s:88:"Hubo un error intentando enviar el formulario. Por favor inténtelo de nuevo más tarde.";s:16:"validation_error";s:74:"Uno o más campos tienen un error. Por favor revise e inténtelo de nuevo.";s:4:"spam";s:85:"Hubo un error intentando enviar tu mensaje. Por favor inténtalo de nuevo más tarde.";s:12:"accept_terms";s:71:"Debe aceptar los términos y condiciones antes de enviar el formulario.";s:16:"invalid_required";s:24:"El campo es obligatorio.";s:16:"invalid_too_long";s:28:"El campo es demasiado largo.";s:17:"invalid_too_short";s:28:"El campo es demasiado corto.";s:12:"invalid_date";s:34:"El formato de fecha es incorrecto.";s:14:"date_too_early";s:50:"La fecha es anterior a la más temprana permitida.";s:13:"date_too_late";s:50:"La fecha es posterior a la más tardía permitida.";s:13:"upload_failed";s:46:"Hubo un error desconocido subiendo el archivo.";s:24:"upload_file_type_invalid";s:51:"No tiene permisos para subir archivos de este tipo.";s:21:"upload_file_too_large";s:31:"El archivo es demasiado grande.";s:23:"upload_failed_php_error";s:43:"Se ha producido un error subiendo la imagen";s:14:"invalid_number";s:36:"El formato de número no es válido.";s:16:"number_too_small";s:45:"El número es menor que el mínimo permitido.";s:16:"number_too_large";s:45:"El número es mayor que el máximo permitido.";s:23:"quiz_answer_not_correct";s:44:"La respuesta al cuestionario no es correcta.";s:17:"captcha_not_match";s:37:"El código introducido es incorrecto.";s:13:"invalid_email";s:70:"La dirección de correo electrónico que ha introducido no es válida.";s:11:"invalid_url";s:21:"La URL no es válida.";s:11:"invalid_tel";s:38:"El número de teléfono no es válido.";}'
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_messages' en postmeta para 'Consentimiento tratamiento de datos de caracter personal'");
    }
    
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_mail_2',
        'meta_value' => 'a:9:{s:6:"active";b:0;s:7:"subject";s:0:"";s:6:"sender";s:0:"";s:9:"recipient";s:0:"";s:4:"body";s:0:"";s:18:"additional_headers";s:0:"";s:11:"attachments";s:0:"";s:8:"use_html";b:0;s:13:"exclude_blank";b:0;}'
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_mail_2' en postmeta para 'Consentimiento tratamiento de datos de caracter personal'");
    }
    
    $form = manusoft_cf2pdf_get_consentimiento_form();
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_form',
        'meta_value' => $form
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_form' en postmeta para 'Consentimiento tratamiento de datos de caracter personal'");
    }
    
    $mail = manusoft_cf2pdf_get_consentimiento_mail();
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_mail',
        'meta_value' => $mail
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_mail' en postmeta para 'Consentimiento tratamiento de datos de caracter personal'");
    }
    
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_manusoft_form_type',
        'meta_value' => 'consentimiento'
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_manusoft_form_type' en postmeta para 'Consentimiento tratamiento de datos de caracter personal'");
    }
    return $check_error;
}

// Actualización del formulario "Consentimiento Tratamiento de Datos de Carácter Personal"
function manusoft_cf2pdf_update_consentimiento_form() {
    $consentimiento_id = manusoft_cf2pdf_get_default_id_form('consentimiento');
    if ($consentimiento_id != NULL) {
        global $wpdb;
        $check_error = false;
        $table_post = $wpdb->prefix."posts";
        $table_postmeta = $wpdb->prefix."postmeta";
        $data = array(
            'post_author' => 1,
            'post_date' => date('Y-m-d H:i:s'),
            'post_date_gmt' => date('Y-m-d H:i:s'),
            'post_content' => manusoft_cf2pdf_get_consentimiento_content(),
            'post_title' => 'Consentimiento tratamiento de datos de carácter personal',
            'comment_status' => 'closed',
            'ping_status' => 'closed',
            'post_name' => 'consentimiento-tratamient-de-datos-de-caracter-personal',
            'post_modified' => date('Y-m-d H:i:s'),
            'post_modified_gmt' => date('Y-m-d H:i:s'),
            'guid' => '',
            'post_type' => 'wpcf7_contact_form'
        );
        $where = array ( 'ID' => $consentimiento_id );
        $update_result = $wpdb->update($table_post,$data,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error en la actualización del formulario 'Consentimiento tratamiento de datos de caracter personal'");
        }
        
        $data_postmeta = array(
            'meta_value' => ''
        );
        $where = array (
            'meta_key' => '_additional_settings',
            'post_id' => $consentimiento_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_additional_settings' en postmeta para 'Consentimiento tratamiento de datos de caracter personal'");
        }
        
        $data_postmeta = array(
            'meta_value' => 'es_ES'
        );
        $where = array (
            'meta_key' => '_locale',
            'post_id' => $consentimiento_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_locale' en postmeta para 'Consentimiento tratamiento de datos de caracter personal'");
        }
        
        $data_postmeta = array(
            'meta_value' => 'a:23:{s:12:"mail_sent_ok";s:44:"Muchas gracias por rellenar este formulario.";s:12:"mail_sent_ng";s:88:"Hubo un error intentando enviar el formulario. Por favor inténtelo de nuevo más tarde.";s:16:"validation_error";s:74:"Uno o más campos tienen un error. Por favor revise e inténtelo de nuevo.";s:4:"spam";s:85:"Hubo un error intentando enviar tu mensaje. Por favor inténtalo de nuevo más tarde.";s:12:"accept_terms";s:71:"Debe aceptar los términos y condiciones antes de enviar el formulario.";s:16:"invalid_required";s:24:"El campo es obligatorio.";s:16:"invalid_too_long";s:28:"El campo es demasiado largo.";s:17:"invalid_too_short";s:28:"El campo es demasiado corto.";s:12:"invalid_date";s:34:"El formato de fecha es incorrecto.";s:14:"date_too_early";s:50:"La fecha es anterior a la más temprana permitida.";s:13:"date_too_late";s:50:"La fecha es posterior a la más tardía permitida.";s:13:"upload_failed";s:46:"Hubo un error desconocido subiendo el archivo.";s:24:"upload_file_type_invalid";s:51:"No tiene permisos para subir archivos de este tipo.";s:21:"upload_file_too_large";s:31:"El archivo es demasiado grande.";s:23:"upload_failed_php_error";s:43:"Se ha producido un error subiendo la imagen";s:14:"invalid_number";s:36:"El formato de número no es válido.";s:16:"number_too_small";s:45:"El número es menor que el mínimo permitido.";s:16:"number_too_large";s:45:"El número es mayor que el máximo permitido.";s:23:"quiz_answer_not_correct";s:44:"La respuesta al cuestionario no es correcta.";s:17:"captcha_not_match";s:37:"El código introducido es incorrecto.";s:13:"invalid_email";s:70:"La dirección de correo electrónico que ha introducido no es válida.";s:11:"invalid_url";s:21:"La URL no es válida.";s:11:"invalid_tel";s:38:"El número de teléfono no es válido.";}'
        );
        $where = array (
            'meta_key' => '_messages',
            'post_id' => $consentimiento_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_messages' en postmeta para 'Consentimiento tratamiento de datos de caracter personal'");
        }
        
        $data_postmeta = array(
            'meta_value' => 'a:9:{s:6:"active";b:0;s:7:"subject";s:0:"";s:6:"sender";s:0:"";s:9:"recipient";s:0:"";s:4:"body";s:0:"";s:18:"additional_headers";s:0:"";s:11:"attachments";s:0:"";s:8:"use_html";b:0;s:13:"exclude_blank";b:0;}'
        );
        $where = array (
            'meta_key' => '_mail_2',
            'post_id' => $consentimiento_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_mail_2' en postmeta para 'Consentimiento tratamiento de datos de caracter personal'");
        }
        
        $form = manusoft_cf2pdf_get_consentimiento_form();
        $data_postmeta = array(
            'meta_value' => $form
        );
        $where = array (
            'meta_key' => '_form',
            'post_id' => $consentimiento_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_form' en postmeta para 'Consentimiento tratamiento de datos de caracter personal'");
        }
        
        $mail = manusoft_cf2pdf_get_consentimiento_mail();
        $data_postmeta = array(
            'meta_value' => $mail
        );
        $where = array (
            'meta_key' => '_mail',
            'post_id' => $consentimiento_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_mail' en postmeta para 'Consentimiento tratamiento de datos de caracter personal'");
        }
        
        $data_postmeta = array(
            'meta_value' => 'consentimiento'
        );
        $where = array (
            'meta_key' => '_manusoft_form_type',
            'post_id' => $consentimiento_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_manusoft_form_type' en postmeta para 'Consentimiento tratamiento de datos de caracter personal'");
        }
        return $check_error;
    } else {
        manusoft_cf2pdf_create_consentimiento_form();
    }
}

function manusoft_cf2pdf_get_consentimiento_content() {
    $config_data = manusoft_cf2pdf_get_cofig_data();
    $content = "
                <div class=\"row\">
                	<div class=\"col-md-12\">
                		<h4>CONSENTIMIENTO TRATAMIENTO DE DATOS DE CARÁCTER PERSONAL</h4>
                	</div>
                </div>
                <div class=\"row\">
                	<div class=\"col-md-12\">
                		<h4>".strtoupper($config_data['nombre_grupo'])."</h4>
                			<p>
                				CIF: ".strtoupper($config_data['cif_grupo'])."
                				DIRECCIÓN: ".strtoupper($config_data['direccion_grupo'])."
                				POBLACIÓN: ".strtoupper($config_data['cp_grupo'])." ".strtoupper($config_data['poblacion_grupo'])." (".strtoupper($config_data['provincia_grupo']).")
                				<a href=\"mailto:".$config_data['email_grupo']."\">".$config_data['email_grupo']."</a>
                			</p>
                		</div>
                </div>
                <div class=\"row\">
                	<div class=\"col-md-12\">
                		<p style=\"text-align:justify\">
                			En cumplimiento del RGPD UE 2016/679 de Protección de Datos de Carácter Personal le informamos de que sus datos personales pasarán a formar parte de los sistemas de información de ".strtoupper($config_data['nombre_grupo'])." cuya finalidad es la gestión de los datos de los integrantes para su coordinación integral y su control, así como el envío de comunicaciones.
                			La legitimación del tratamiento se basa en la aplicación del artículo 6.1a del citado RGPD, por la que el interesado otorga a ".strtoupper($config_data['nombre_grupo'])." el consentimiento para el tratamiento de sus datos personales. Los datos que nos ha proporcionado se conservarán mientras no solicite su supresión o cancelación y siempre que resulten adecuados, pertinentes y limitados a lo necesario para los fines para los que sean tratados.
                			Sus datos no serán comunicados a terceros salvo en las excepciones previstas por obligaciones legales.
                		</p>
                	</div>
                </div>
                <div class=\"row\" style=\"margin: 30px 0px 30px 0px;\">
                	<div class=\"col-md-12\">
                    [checkbox tratamiento_imagenes \"Autorizo la captación y difusión de imágenes durante las actividades realizadas por el grupo.\"]
                	</div>
                </div>
                <div class=\"row\">
                	<div class=\"col-md-12\">
                		<p style=\"text-align:justify;\">
                        Podrá ejercitar su derecho a solicitar el acceso a sus datos, la rectificación o supresión, la limitación del tratamiento, la oposición del tratamiento o la portabilidad de los datos, dirigiendo un escrito junto a la copia de su DNI a en la siguiente dirección: <a href=\"mailto:".$config_data['email_grupo']."\">".$config_data['email_grupo']."</a>
                    </p>
                    <p style=\"text-align:justify;\">
                        En caso de disconformidad, Vd. tiene derecho a elevar una reclamación ante la Agencia Española de Protección de Datos (<a href=\"www.agpd.es\">www.agpd.es</a>).
                    </p>
                    <p style=\"text-align:justify;\">
                    	He sido informado y autorizo expresamente el tratamiento de mi hijo/a:
                    </p>
                	</div>
                </div>
                <div class=\"row\">
                	<div class=\"col-md-12\" style=\"margin: 30px 0px 30px 0px;\">
                		<strong>DATOS DEL NIÑO/A</strong>
                	</div>
                </div>
                <div class=\"row\">
                	<div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                    <label>Nombre y apellidos:</label>
                    [text* nombre_nino_a]
                	</div>
                </div>
                <div class=\"row\">
                	<div class=\"col-md-12\" style=\"margin: 30px 0px 30px 0px;\">
                    <strong>DATOS DEL PADRE O MADRE</strong><br>
                	</div>
                </div>
                <div class=\"row\">
                	<div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                    <label>Nombre y apellidos:</label>
                    [text* nombre_padre_madre]
                	</div>
                </div>
                <div class=\"row\">
                	<div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                    <label>DNI:</label>
                    [text* dni_padre_madre]
                	</div>
                </div>
                <div class=\"row\">
                	<div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                    <label>Fecha:</label>
                    [date* fecha]
                	</div>
                </div><br>
                <div class=\"row\">
                	<div class=\"col-md-12\">
                    <label>Firma:</label>
                    [signature* firma cols:400]
                	</div>
                </div>
                <br>
                [submit \"Enviar\"]
                1
                Consentimiento Tratamiento de Datos de Carácter Personal
                ".$config_data['email_grupo']."
                ".$config_data['email_grupo']."
                De: [nombre_nino_a]
                Padre/Madre: [nombre_padre_madre]
                Fecha: [fecha]
                    
                ------------------------------------
                    
                Este correo ha sido enviado desde el formulario de la web de ".strtoupper($config_data['nombre_grupo'])." ".get_site_url()."
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                Muchas gracias por rellenar este formulario.
                Hubo un error intentando enviar el formulario. Por favor inténtelo de nuevo más tarde.
                Uno o más campos tienen un error. Por favor revise e inténtelo de nuevo.
                Hubo un error intentando enviar tu mensaje. Por favor inténtalo de nuevo más tarde.
                Debe aceptar los términos y condiciones antes de enviar el formulario.
                El campo es obligatorio.
                El campo es demasiado largo.
                El campo es demasiado corto.
                El formato de fecha es incorrecto.
                La fecha es anterior a la más temprana permitida.
                La fecha es posterior a la más tardía permitida.
                Hubo un error desconocido subiendo el archivo.
                No tiene permisos para subir archivos de este tipo.
                El archivo es demasiado grande.
                Se ha producido un error subiendo la imagen
                El formato de número no es válido.
                El número es menor que el mínimo permitido.
                El número es mayor que el máximo permitido.
                La respuesta al cuestionario no es correcta.
                El código introducido es incorrecto.
                La dirección de correo electrónico que ha introducido no es válida.
                La URL no es válida.
                El número de teléfono no es válido.
    ";
    return $content;
}

function manusoft_cf2pdf_get_consentimiento_form() {
    $config_data = manusoft_cf2pdf_get_cofig_data();
    $form = "
                <div class=\"row\">
                	<div class=\"col-md-12\">
                		<h4>CONSENTIMIENTO TRATAMIENTO DE DATOS DE CARÁCTER PERSONAL</h4>
                	</div>
                </div>
                <div class=\"row\">
                	<div class=\"col-md-12\">
                		<h4>".strtoupper($config_data['nombre_grupo'])."</h4>
                			<p>
                				CIF: ".strtoupper($config_data['cif_grupo'])."
                				DIRECCIÓN: ".strtoupper($config_data['direccion_grupo'])."
                				POBLACIÓN: ".strtoupper($config_data['cp_grupo'])." ".strtoupper($config_data['poblacion_grupo'])." (".strtoupper($config_data['provincia_grupo']).")
                				<a href=\"mailto:".$config_data['email_grupo']."\">".$config_data['email_grupo']."</a>
                			</p>
                		</div>
                </div>
                <div class=\"row\">
                	<div class=\"col-md-12\">
                		<p style=\"text-align:justify\">
                			En cumplimiento del RGPD UE 2016/679 de Protección de Datos de Carácter Personal le informamos de que sus datos personales pasarán a formar parte de los sistemas de información de ".strtoupper($config_data['nombre_grupo'])." cuya finalidad es la gestión de los datos de los integrantes para su coordinación integral y su control, así como el envío de comunicaciones.
                			La legitimación del tratamiento se basa en la aplicación del artículo 6.1a del citado RGPD, por la que el interesado otorga a ".strtoupper($config_data['nombre_grupo'])." el consentimiento para el tratamiento de sus datos personales. Los datos que nos ha proporcionado se conservarán mientras no solicite su supresión o cancelación y siempre que resulten adecuados, pertinentes y limitados a lo necesario para los fines para los que sean tratados.
                			Sus datos no serán comunicados a terceros salvo en las excepciones previstas por obligaciones legales.
                		</p>
                	</div>
                </div>
                <div class=\"row\" style=\"margin: 30px 0px 30px 0px;\">
                	<div class=\"col-md-12\">
                    [checkbox tratamiento_imagenes \"Autorizo la captación y difusión de imágenes durante las actividades realizadas por el grupo.\"]
                	</div>
                </div>
                <div class=\"row\">
                	<div class=\"col-md-12\">
                		<p style=\"text-align:justify;\">
                        Podrá ejercitar su derecho a solicitar el acceso a sus datos, la rectificación o supresión, la limitación del tratamiento, la oposición del tratamiento o la portabilidad de los datos, dirigiendo un escrito junto a la copia de su DNI a en la siguiente dirección: <a href=\"mailto:".$config_data['email_grupo']."\">".$config_data['email_grupo']."</a>
                    </p>
                    <p style=\"text-align:justify;\">
                        En caso de disconformidad, Vd. tiene derecho a elevar una reclamación ante la Agencia Española de Protección de Datos (<a href=\"www.agpd.es\">www.agpd.es</a>).
                    </p>
                    <p style=\"text-align:justify;\">
                    	He sido informado y autorizo expresamente el tratamiento de mi hijo/a:
                    </p>
                	</div>
                </div>
                <div class=\"row\">
                	<div class=\"col-md-12\" style=\"margin: 30px 0px 30px 0px;\">
                		<strong>DATOS DEL NIÑO/A</strong>
                	</div>
                </div>
                <div class=\"row\">
                	<div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                    <label>Nombre y apellidos:</label>
                    [text* nombre_nino_a]
                	</div>
                </div>
                <div class=\"row\">
                	<div class=\"col-md-12\" style=\"margin: 30px 0px 30px 0px;\">
                    <strong>DATOS DEL PADRE O MADRE</strong><br>
                	</div>
                </div>
                <div class=\"row\">
                	<div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                    <label>Nombre y apellidos:</label>
                    [text* nombre_padre_madre]
                	</div>
                </div>
                <div class=\"row\">
                	<div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                    <label>DNI:</label>
                    [text* dni_padre_madre]
                	</div>
                </div>
                <div class=\"row\">
                	<div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                    <label>Fecha:</label>
                    [date* fecha]
                	</div>
                </div><br>
                <div class=\"row\">
                	<div class=\"col-md-12\">
                    <label>Firma:</label>
                    [signature* firma cols:400]
                	</div>
                </div>
                <br>
                [submit \"Enviar\"]
    ";
    return $form;
}

function manusoft_cf2pdf_get_consentimiento_mail() {
    $config_data = manusoft_cf2pdf_get_cofig_data();
    $email_array = array(
        'active' => 1,
        'subject' => "Consentimiento Tratamiento de Datos de Carácter Personal",
        'sender' => $config_data['email_grupo'],
        'recipient' => $config_data['email_grupo'],
        'body' => "De: [nombre_nino_a]
Padre/Madre: [nombre_padre_madre]
Fecha: [fecha]

------------------------------------

Este correo ha sido enviado desde el formulario de la web de ".strtoupper($config_data['nombre_grupo'])." ".get_site_url(),
        'additional_headers' => "",
        'attachments' => "",
        'use_html' => 0,
        'exclude_blank' => 0
    );
    $email = serialize($email_array);
    return $email;
}

// Creación del formulario "Solicitud de inscripción"
function manusoft_cf2pdf_create_inscripcion_form() {
    global $wpdb;
    $check_error = false;
    $table_post = $wpdb->prefix."posts";
    $table_postmeta = $wpdb->prefix."postmeta";
    $data = array(
        'post_author' => 1,
        'post_date' => date('Y-m-d H:i:s'),
        'post_date_gmt' => date('Y-m-d H:i:s'),
        'post_content' => manusoft_cf2pdf_get_inscripcion_content(),
        'post_title' => 'Solicitud de inscripción',
        'comment_status' => 'closed',
        'ping_status' => 'closed',
        'post_name' => 'solicitud-de-inscripcion',
        'post_modified' => date('Y-m-d H:i:s'),
        'post_modified_gmt' => date('Y-m-d H:i:s'),
        'guid' => '',
        'post_type' => 'wpcf7_contact_form'
    );
    $insert_result = $wpdb->insert($table_post,$data);
    $id = $wpdb->insert_id;
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error en la creación del formulario 'Solicitud de inscripción'");
    }
    
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_additional_settings',
        'meta_value' => ''
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_additional_settings' en postmeta para 'Solicitud de inscripción'");
    }
    
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_locale',
        'meta_value' => 'es_ES'
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_locale' en postmeta para 'Solicitud de inscripción'");
    }
    
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_messages',
        'meta_value' => 'a:23:{s:12:"mail_sent_ok";s:44:"Muchas gracias por rellenar este formulario.";s:12:"mail_sent_ng";s:88:"Hubo un error intentando enviar el formulario. Por favor inténtelo de nuevo más tarde.";s:16:"validation_error";s:74:"Uno o más campos tienen un error. Por favor revise e inténtelo de nuevo.";s:4:"spam";s:85:"Hubo un error intentando enviar tu mensaje. Por favor inténtalo de nuevo más tarde.";s:12:"accept_terms";s:71:"Debe aceptar los términos y condiciones antes de enviar el formulario.";s:16:"invalid_required";s:24:"El campo es obligatorio.";s:16:"invalid_too_long";s:28:"El campo es demasiado largo.";s:17:"invalid_too_short";s:28:"El campo es demasiado corto.";s:12:"invalid_date";s:34:"El formato de fecha es incorrecto.";s:14:"date_too_early";s:50:"La fecha es anterior a la más temprana permitida.";s:13:"date_too_late";s:50:"La fecha es posterior a la más tardía permitida.";s:13:"upload_failed";s:46:"Hubo un error desconocido subiendo el archivo.";s:24:"upload_file_type_invalid";s:51:"No tiene permisos para subir archivos de este tipo.";s:21:"upload_file_too_large";s:31:"El archivo es demasiado grande.";s:23:"upload_failed_php_error";s:43:"Se ha producido un error subiendo la imagen";s:14:"invalid_number";s:36:"El formato de número no es válido.";s:16:"number_too_small";s:45:"El número es menor que el mínimo permitido.";s:16:"number_too_large";s:45:"El número es mayor que el máximo permitido.";s:23:"quiz_answer_not_correct";s:44:"La respuesta al cuestionario no es correcta.";s:17:"captcha_not_match";s:37:"El código introducido es incorrecto.";s:13:"invalid_email";s:70:"La dirección de correo electrónico que ha introducido no es válida.";s:11:"invalid_url";s:21:"La URL no es válida.";s:11:"invalid_tel";s:38:"El número de teléfono no es válido.";}'
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_messages' en postmeta para 'Solicitud de inscripción'");
    }
    
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_mail_2',
        'meta_value' => 'a:9:{s:6:"active";b:0;s:7:"subject";s:0:"";s:6:"sender";s:0:"";s:9:"recipient";s:0:"";s:4:"body";s:0:"";s:18:"additional_headers";s:0:"";s:11:"attachments";s:0:"";s:8:"use_html";b:0;s:13:"exclude_blank";b:0;}'
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_mail_2' en postmeta para 'Solicitud de inscripción'");
    }
    
    $form = manusoft_cf2pdf_get_inscripcion_form();
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_form',
        'meta_value' => $form
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_form' en postmeta para 'Solicitud de inscripción'");
    }
    
    $mail = manusoft_cf2pdf_get_inscripcion_mail();
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_mail',
        'meta_value' => $mail
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_mail' en postmeta para 'Solicitud de inscripción'");
    }
    
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_manusoft_form_type',
        'meta_value' => 'inscripcion'
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_manusoft_form_type' en postmeta para 'Solicitud de inscripción'");
    }
}

// Actualización del formulario "Solicitud de inscripción"
function manusoft_cf2pdf_update_inscripcion_form() {
    $inscripcion_id = manusoft_cf2pdf_get_default_id_form('inscripcion');
    if ($inscripcion_id != NULL) {
        global $wpdb;
        $check_error = false;
        $table_post = $wpdb->prefix."posts";
        $table_postmeta = $wpdb->prefix."postmeta";
        $data = array(
            'post_author' => 1,
            'post_date' => date('Y-m-d H:i:s'),
            'post_date_gmt' => date('Y-m-d H:i:s'),
            'post_content' => manusoft_cf2pdf_get_inscripcion_content(),
            'post_title' => 'Solicitud de inscripción',
            'comment_status' => 'closed',
            'ping_status' => 'closed',
            'post_name' => 'solicitud-de-inscripcion',
            'post_modified' => date('Y-m-d H:i:s'),
            'post_modified_gmt' => date('Y-m-d H:i:s'),
            'guid' => '',
            'post_type' => 'wpcf7_contact_form'
        );
        $where = array ( 'ID' => $inscripcion_id );
        $update_result = $wpdb->update($table_post,$data,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error en la actualización del formulario 'Solicitud de inscripción'");
        }
        
        $data_postmeta = array(
            'meta_value' => ''
        );
        $where = array (
            'meta_key' => '_additional_settings',
            'post_id' => $inscripcion_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_additional_settings' en postmeta para 'Solicitud de inscripción'");
        }
        
        $data_postmeta = array(
            'meta_value' => 'es_ES'
        );
        $where = array (
            'meta_key' => '_locale',
            'post_id' => $inscripcion_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_locale' en postmeta para 'Solicitud de inscripción'");
        }
        
        $data_postmeta = array(
            'meta_value' => 'a:23:{s:12:"mail_sent_ok";s:44:"Muchas gracias por rellenar este formulario.";s:12:"mail_sent_ng";s:88:"Hubo un error intentando enviar el formulario. Por favor inténtelo de nuevo más tarde.";s:16:"validation_error";s:74:"Uno o más campos tienen un error. Por favor revise e inténtelo de nuevo.";s:4:"spam";s:85:"Hubo un error intentando enviar tu mensaje. Por favor inténtalo de nuevo más tarde.";s:12:"accept_terms";s:71:"Debe aceptar los términos y condiciones antes de enviar el formulario.";s:16:"invalid_required";s:24:"El campo es obligatorio.";s:16:"invalid_too_long";s:28:"El campo es demasiado largo.";s:17:"invalid_too_short";s:28:"El campo es demasiado corto.";s:12:"invalid_date";s:34:"El formato de fecha es incorrecto.";s:14:"date_too_early";s:50:"La fecha es anterior a la más temprana permitida.";s:13:"date_too_late";s:50:"La fecha es posterior a la más tardía permitida.";s:13:"upload_failed";s:46:"Hubo un error desconocido subiendo el archivo.";s:24:"upload_file_type_invalid";s:51:"No tiene permisos para subir archivos de este tipo.";s:21:"upload_file_too_large";s:31:"El archivo es demasiado grande.";s:23:"upload_failed_php_error";s:43:"Se ha producido un error subiendo la imagen";s:14:"invalid_number";s:36:"El formato de número no es válido.";s:16:"number_too_small";s:45:"El número es menor que el mínimo permitido.";s:16:"number_too_large";s:45:"El número es mayor que el máximo permitido.";s:23:"quiz_answer_not_correct";s:44:"La respuesta al cuestionario no es correcta.";s:17:"captcha_not_match";s:37:"El código introducido es incorrecto.";s:13:"invalid_email";s:70:"La dirección de correo electrónico que ha introducido no es válida.";s:11:"invalid_url";s:21:"La URL no es válida.";s:11:"invalid_tel";s:38:"El número de teléfono no es válido.";}'
        );
        $where = array (
            'meta_key' => '_messages',
            'post_id' => $inscripcion_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_messages' en postmeta para 'Solicitud de inscripción'");
        }
        
        $data_postmeta = array(
            'meta_value' => 'a:9:{s:6:"active";b:0;s:7:"subject";s:0:"";s:6:"sender";s:0:"";s:9:"recipient";s:0:"";s:4:"body";s:0:"";s:18:"additional_headers";s:0:"";s:11:"attachments";s:0:"";s:8:"use_html";b:0;s:13:"exclude_blank";b:0;}'
        );
        $where = array (
            'meta_key' => '_mail_2',
            'post_id' => $inscripcion_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_mail_2' en postmeta para 'Solicitud de inscripción'");
        }
        
        $form = manusoft_cf2pdf_get_inscripcion_form();
        $data_postmeta = array(
            'meta_value' => $form
        );
        $where = array (
            'meta_key' => '_form',
            'post_id' => $inscripcion_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_form' en postmeta para 'Solicitud de inscripción'");
        }
        
        $mail = manusoft_cf2pdf_get_inscripcion_mail();
        $data_postmeta = array(
            'meta_value' => $mail
        );
        $where = array (
            'meta_key' => '_mail',
            'post_id' => $inscripcion_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_mail' en postmeta para 'Solicitud de inscripción'");
        }
        
        $data_postmeta = array(
            'meta_value' => 'inscripcion'
        );
        $where = array (
            'meta_key' => '_manusoft_form_type',
            'post_id' => $inscripcion_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_manusoft_form_type' en postmeta para 'Solicitud de inscripción'");
        }
    } else {
        manusoft_cf2pdf_create_inscripcion_form();
    }
}

function manusoft_cf2pdf_get_inscripcion_content() {
    $config_data = manusoft_cf2pdf_get_cofig_data();
    $content = "
                <div class=\"row\">
                	<div class=\"col-md-12\" style=\"text-align:center;\">
                		<h4>SOLICITUD DE INSCRIPCIÓN A ".strtoupper($config_data['nombre_grupo'])."</h4>
                	</div>
                </div>
                <div class=\"row\">
                	<div class=\"col-md-12\">
                		<div class=\"row\" style=\"margin: 30px 0px 30px 0px;\">
                			<div class=\"col-md-12\">
                	    	<strong>DATOS PERSONALES DEL NIÑO/A</strong><br>
                			</div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-10\" style=\"margin-bottom:30px;\">
                				<label>Nombre y apellidos:</label>
                				[text* nombre_nino_a]
                	    </div>
                	    <div class=\"col-md-2\" style=\"margin-bottom:30px;\">
                				<label>Sexo:</label>
                				[select* sexo_nino_a include_blank \"Hombre\" \"Mujer\"]
                	    </div>
                		</div>
                		<div class=\"row\">
                	    <div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Fecha de nacimiento:</label>
                				[date* fecha_nacimiento_nino_a]
                	    </div>
                	    <div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>D.N.I.:</label>
                				[text* dni_nino_a]
                	    </div>
                			<div class=\"col-md-2\"></div>
                	    <div class=\"col-md-2\" style=\"margin-bottom:30px;\">
                				<label>Rama:</label>
                				[select* rama include_blank \"Castores\" \"Lobatos\" \"Rangers\" \"Pioneros\" \"Rutas\"]
                	    </div>
                		</div>
                		<div class=\"row\">
                	    <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                				<label>Dirección:</label>
                				[text* direccion_nino_a]
                	    </div>
                		</div>
                		<div class=\"row\">
                	    <div class=\"col-md-2\" style=\"margin-bottom:30px;\">
                				<label>Código Postal:</label>
                				[number* cp_nino_a]
                	    </div>
                	    <div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Localidad:</label>
                				[text* localidad_nino_a]
                	    </div>
                	    <div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Provincia:</label>
                				[text* provincia_nino_a]
                	    </div>
                		</div>
                		<div class=\"row\">
                	    <div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Teléfono fijo:</label>
                				[tel* tlf_fijo_nino_a]
                	    </div>
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Teléfono móvil:</label>
                				[tel tlf_movil_nino_a]
                	    </div>
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Seguridad Social:</label>
                				[text* seguridad_social_nino_a]
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-10\" style=\"margin-bottom:30px;\">
                				<label>Email:</label>
                				[email email_nino_a]
                	    </div>
                				<div class=\"col-md-2\" style=\"margin-bottom:30px;\">
                				<label>Fecha de ingreso:</label>
                				[date* fecha_ingreso]
                	    </div>
                		</div>
                		<div class=\"row\" style=\"margin: 30px 0px 30px 0px;\">
                			<div class=\"col-md-12\">
                				<hr>
                				<strong>DATOS FAMILIARES</strong>
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                				<label>Nombre y apellidos Padre o tutor:</label>
                				[text* nombre_padre]
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Fecha de nacimiento:</label>
                				[date* fecha_nacimiento_padre]
                	    </div>
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>D.N.I.:</label>
                		    [text* dni_padre]
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-10\" style=\"margin-bottom:30px;\">
                				<label>Dirección:</label>
                				[text* direccion_padre]
                	    </div>
                				<div class=\"col-md-2\" style=\"margin-bottom:30px;\">
                					<label>Código Postal:</label>
                					[number* cp_padre]
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Localidad:</label>
                				[text* localidad_padre]
                	    </div>
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Provincia:</label>
                				[text* provincia_padre]
                	    </div>
                				<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                					<label>Profesión:</label>
                					[text* profesion_padre]
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Teléfono fijo:</label>
                				[tel* tlf_fijo_padre]
                	    </div>
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Teléfono móvil:</label>
                				[tel* tlf_movil_padre]
                	    </div>
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Email:</label>
                				[email* email_padre]
                	    </div>
                		</div>
                		<hr>
                		<div class=\"row\">
                			<div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                	    	<label>Nombre y apellidos Madre o tutora:</label>
                	    	[text* nombre_madre]
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                	    	<label>Fecha de nacimiento:</label>
                	    	[date* fecha_nacimiento_madre]
                	    </div>
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                	    	<label>D.N.I.:</label>
                	    	[text* dni_madre]
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-10\" style=\"margin-bottom:30px;\">
                	    	<label>Dirección:</label>
                	    	[text* direccion_madre]
                	    </div>
                				<div class=\"col-md-2\" style=\"margin-bottom:30px;\">
                	    	<label>Código Postal:</label>
                	    	[number* cp_madre]
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                	    	<label>Localidad:</label>
                	    	[text* localidad_madre]
                	    </div>
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                	    	<label>Provincia:</label>
                	    	[text* provincia_madre]
                	    </div>
                	    <div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                	    	<label>Profesión:</label>
                	    	[text* profesion_madre]
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                	    	<label>Teléfono fijo:</label>
                	    	[tel* tlf_fijo_madre]
                	    </div>
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                	    	<label>Teléfono móvil:</label>
                	    	[tel* tlf_movil_madre]
                	    </div>
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                	    	<label>Email:</label>
                	    	[email* email_madre]
                	    </div>
                		</div>
                		<hr>
                		<div class=\"row\">
                			<div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                	    	<p>El envío de este formulario supone una solicitud para inscribir a su hijo/a a ".strtoupper($config_data['nombre_grupo'])." con sede en ".strtoupper($config_data['poblacion_grupo']).".</p>
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                	    	<label>Firma:</label>
                	    	[signature* firma cols:400]
                			</div>
                		</div>
                </div>
                <br>
                [submit \"Enviar\"]
                1
                Solicitud de inscripción
                ".$config_data['email_grupo']."
                ".$config_data['email_grupo']."
                Nombre: [nombre_nino_a]
                Fecha nacimiento: [fecha_nacimiento_nino_a]
                Rama: [rama]
                Nombre padre: [nombre_padre]
                Teléfono padre: [tlf_fijo_padre]
                Móvil padre: [tlf_movil_padre]
                Nombre: [nombre_madre]
                Teléfono madre: [tlf_fijo_madre]
                Móvil madre: [tlf_movil_madre]
                
                ------------------------------------
                
                Este correo ha sido enviado desde el formulario de la web de ".strtoupper($config_data['nombre_grupo'])." ".get_site_url()."
                
                
                
                
                
                
                
                
                
                
                
                
                
                Muchas gracias por rellenar este formulario.
                Hubo un error intentando enviar el formulario. Por favor inténtelo de nuevo más tarde.
                Uno o más campos tienen un error. Por favor revise e inténtelo de nuevo.
                Hubo un error intentando enviar tu mensaje. Por favor inténtalo de nuevo más tarde.
                Debe aceptar los términos y condiciones antes de enviar el formulario.
                El campo es obligatorio.
                El campo es demasiado largo.
                El campo es demasiado corto.
                El formato de fecha es incorrecto.
                La fecha es anterior a la más temprana permitida.
                La fecha es posterior a la más tardía permitida.
                Hubo un error desconocido subiendo el archivo.
                No tiene permisos para subir archivos de este tipo.
                El archivo es demasiado grande.
                Se ha producido un error subiendo la imagen
                El formato de número no es válido.
                El número es menor que el mínimo permitido.
                El número es mayor que el máximo permitido.
                La respuesta al cuestionario no es correcta.
                El código introducido es incorrecto.
                La dirección de correo electrónico que ha introducido no es válida.
                La URL no es válida.
                El número de teléfono no es válido.
    ";
    return $content;
}

function manusoft_cf2pdf_get_inscripcion_form() {
    $config_data = manusoft_cf2pdf_get_cofig_data();
    $form = "
                <div class=\"row\">
                    <div class=\"col-md-12\" style=\"text-align:center;\">
                		<h4>SOLICITUD DE INSCRIPCIÓN A ".strtoupper($config_data['nombre_grupo'])."</h4>
                	</div>
                </div>
                <div class=\"row\">
                	<div class=\"col-md-12\">
                		<div class=\"row\" style=\"margin: 30px 0px 30px 0px;\">
                			<div class=\"col-md-12\">
                	    	<strong>DATOS PERSONALES DEL NIÑO/A</strong><br>
                			</div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-10\" style=\"margin-bottom:30px;\">
                				<label>Nombre y apellidos:</label>
                				[text* nombre_nino_a]
                	    </div>
                	    <div class=\"col-md-2\" style=\"margin-bottom:30px;\">
                				<label>Sexo:</label>
                				[select* sexo_nino_a include_blank \"Hombre\" \"Mujer\"]
                	    </div>
                		</div>
                		<div class=\"row\">
                	    <div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Fecha de nacimiento:</label>
                				[date* fecha_nacimiento_nino_a]
                	    </div>
                	    <div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>D.N.I.:</label>
                				[text* dni_nino_a]
                	    </div>
                			<div class=\"col-md-2\"></div>
                	    <div class=\"col-md-2\" style=\"margin-bottom:30px;\">
                				<label>Rama:</label>
                				[select* rama include_blank \"Castores\" \"Lobatos\" \"Rangers\" \"Pioneros\" \"Rutas\"]
                	    </div>
                		</div>
                		<div class=\"row\">
                	    <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                				<label>Dirección:</label>
                				[text* direccion_nino_a]
                	    </div>
                		</div>
                		<div class=\"row\">
                	    <div class=\"col-md-2\" style=\"margin-bottom:30px;\">
                				<label>Código Postal:</label>
                				[number* cp_nino_a]
                	    </div>
                	    <div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Localidad:</label>
                				[text* localidad_nino_a]
                	    </div>
                	    <div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Provincia:</label>
                				[text* provincia_nino_a]
                	    </div>
                		</div>
                		<div class=\"row\">
                	    <div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Teléfono fijo:</label>
                				[tel* tlf_fijo_nino_a]
                	    </div>
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Teléfono móvil:</label>
                				[tel tlf_movil_nino_a]
                	    </div>
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Seguridad Social:</label>
                				[text* seguridad_social_nino_a]
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-10\" style=\"margin-bottom:30px;\">
                				<label>Email:</label>
                				[email email_nino_a]
                	    </div>
                				<div class=\"col-md-2\" style=\"margin-bottom:30px;\">
                				<label>Fecha de ingreso:</label>
                				[date* fecha_ingreso]
                	    </div>
                		</div>
                		<div class=\"row\" style=\"margin: 30px 0px 30px 0px;\">
                			<div class=\"col-md-12\">
                				<hr>
                				<strong>DATOS FAMILIARES</strong>
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                				<label>Nombre y apellidos Padre o tutor:</label>
                				[text* nombre_padre]
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Fecha de nacimiento:</label>
                				[date* fecha_nacimiento_padre]
                	    </div>
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>D.N.I.:</label>
                		    [text* dni_padre]
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-10\" style=\"margin-bottom:30px;\">
                				<label>Dirección:</label>
                				[text* direccion_padre]
                	    </div>
                				<div class=\"col-md-2\" style=\"margin-bottom:30px;\">
                					<label>Código Postal:</label>
                					[number* cp_padre]
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Localidad:</label>
                				[text* localidad_padre]
                	    </div>
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Provincia:</label>
                				[text* provincia_padre]
                	    </div>
                				<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                					<label>Profesión:</label>
                					[text* profesion_padre]
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Teléfono fijo:</label>
                				[tel* tlf_fijo_padre]
                	    </div>
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Teléfono móvil:</label>
                				[tel* tlf_movil_padre]
                	    </div>
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                				<label>Email:</label>
                				[email* email_padre]
                	    </div>
                		</div>
                		<hr>
                		<div class=\"row\">
                			<div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                	    	<label>Nombre y apellidos Madre o tutora:</label>
                	    	[text* nombre_madre]
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                	    	<label>Fecha de nacimiento:</label>
                	    	[date* fecha_nacimiento_madre]
                	    </div>
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                	    	<label>D.N.I.:</label>
                	    	[text* dni_madre]
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-10\" style=\"margin-bottom:30px;\">
                	    	<label>Dirección:</label>
                	    	[text* direccion_madre]
                	    </div>
                				<div class=\"col-md-2\" style=\"margin-bottom:30px;\">
                	    	<label>Código Postal:</label>
                	    	[number* cp_madre]
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                	    	<label>Localidad:</label>
                	    	[text* localidad_madre]
                	    </div>
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                	    	<label>Provincia:</label>
                	    	[text* provincia_madre]
                	    </div>
                	    <div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                	    	<label>Profesión:</label>
                	    	[text* profesion_madre]
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                	    	<label>Teléfono fijo:</label>
                	    	[tel* tlf_fijo_madre]
                	    </div>
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                	    	<label>Teléfono móvil:</label>
                	    	[tel* tlf_movil_madre]
                	    </div>
                			<div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                	    	<label>Email:</label>
                	    	[email* email_madre]
                	    </div>
                		</div>
                		<hr>
                		<div class=\"row\">
                			<div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                	    	<p>El envío de este formulario supone una solicitud para inscribir a su hijo/a a ".strtoupper($config_data['nombre_grupo'])." con sede en ".strtoupper($config_data['poblacion_grupo']).".</p>
                	    </div>
                		</div>
                		<div class=\"row\">
                			<div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                	    	<label>Firma:</label>
                	    	[signature* firma cols:400]
                			</div>
                		</div>
                </div>
                <br>
                [submit \"Enviar\"]
    ";
    return $form;
}

function manusoft_cf2pdf_get_inscripcion_mail() {
    $config_data = manusoft_cf2pdf_get_cofig_data();
    $email_array = array(
        'active' => 1,
        'subject' => "Solicitud de inscripción",
        'sender' => $config_data['email_grupo'],
        'recipient' => $config_data['email_grupo'],
        'body' => "Nombre: [nombre_nino_a]
Fecha nacimiento: [fecha_nacimiento_nino_a]
Rama: [rama]
Nombre padre: [nombre_padre]
Teléfono padre: [tlf_fijo_padre]
Móvil padre: [tlf_movil_padre]
Nombre: [nombre_madre]
Teléfono madre: [tlf_fijo_madre]
Móvil madre: [tlf_movil_madre]

------------------------------------

Este correo ha sido enviado desde el formulario de la web de ".strtoupper($config_data['nombre_grupo'])." ".get_site_url(),
        'additional_headers' => "",
        'attachments' => "",
        'use_html' => 0,
        'exclude_blank' => 0
    );
    $email = serialize($email_array);
    return $email;
}

// Creación del formulario "Datos Médicos"
function manusoft_cf2pdf_create_medico_form() {
    global $wpdb;
    $check_error = false;
    $table_post = $wpdb->prefix."posts";
    $table_postmeta = $wpdb->prefix."postmeta";
    $data = array(
        'post_author' => 1,
        'post_date' => date('Y-m-d H:i:s'),
        'post_date_gmt' => date('Y-m-d H:i:s'),
        'post_content' => manusoft_cf2pdf_get_medico_content(),
        'post_title' => 'Datos Médicos',
        'comment_status' => 'closed',
        'ping_status' => 'closed',
        'post_name' => 'datos-medicos',
        'post_modified' => date('Y-m-d H:i:s'),
        'post_modified_gmt' => date('Y-m-d H:i:s'),
        'guid' => '',
        'post_type' => 'wpcf7_contact_form'
    );
    $insert_result = $wpdb->insert($table_post,$data);
    $id = $wpdb->insert_id;
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error en la creación del formulario 'Datos Médicos'");
    }
    
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_additional_settings',
        'meta_value' => ''
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_additional_settings' en postmeta para 'Datos Médicos'");
    }
    
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_locale',
        'meta_value' => 'es_ES'
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_locale' en postmeta para 'Datos Médicos'");
    }
    
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_messages',
        'meta_value' => 'a:23:{s:12:"mail_sent_ok";s:44:"Muchas gracias por rellenar este formulario.";s:12:"mail_sent_ng";s:88:"Hubo un error intentando enviar el formulario. Por favor inténtelo de nuevo más tarde.";s:16:"validation_error";s:74:"Uno o más campos tienen un error. Por favor revise e inténtelo de nuevo.";s:4:"spam";s:85:"Hubo un error intentando enviar tu mensaje. Por favor inténtalo de nuevo más tarde.";s:12:"accept_terms";s:71:"Debe aceptar los términos y condiciones antes de enviar el formulario.";s:16:"invalid_required";s:24:"El campo es obligatorio.";s:16:"invalid_too_long";s:28:"El campo es demasiado largo.";s:17:"invalid_too_short";s:28:"El campo es demasiado corto.";s:12:"invalid_date";s:34:"El formato de fecha es incorrecto.";s:14:"date_too_early";s:50:"La fecha es anterior a la más temprana permitida.";s:13:"date_too_late";s:50:"La fecha es posterior a la más tardía permitida.";s:13:"upload_failed";s:46:"Hubo un error desconocido subiendo el archivo.";s:24:"upload_file_type_invalid";s:51:"No tiene permisos para subir archivos de este tipo.";s:21:"upload_file_too_large";s:31:"El archivo es demasiado grande.";s:23:"upload_failed_php_error";s:43:"Se ha producido un error subiendo la imagen";s:14:"invalid_number";s:36:"El formato de número no es válido.";s:16:"number_too_small";s:45:"El número es menor que el mínimo permitido.";s:16:"number_too_large";s:45:"El número es mayor que el máximo permitido.";s:23:"quiz_answer_not_correct";s:44:"La respuesta al cuestionario no es correcta.";s:17:"captcha_not_match";s:37:"El código introducido es incorrecto.";s:13:"invalid_email";s:70:"La dirección de correo electrónico que ha introducido no es válida.";s:11:"invalid_url";s:21:"La URL no es válida.";s:11:"invalid_tel";s:38:"El número de teléfono no es válido.";}'
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_messages' en postmeta para 'Datos Médicos'");
    }
    
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_mail_2',
        'meta_value' => 'a:9:{s:6:"active";b:0;s:7:"subject";s:0:"";s:6:"sender";s:0:"";s:9:"recipient";s:0:"";s:4:"body";s:0:"";s:18:"additional_headers";s:0:"";s:11:"attachments";s:0:"";s:8:"use_html";b:0;s:13:"exclude_blank";b:0;}'
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_mail_2' en postmeta para 'Datos Médicos'");
    }
    
    $form = manusoft_cf2pdf_get_medico_form();
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_form',
        'meta_value' => $form
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_form' en postmeta para 'Datos Médicos'");
    }
    
    $mail = manusoft_cf2pdf_get_medico_mail();
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_mail',
        'meta_value' => $mail
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_mail' en postmeta para 'Datos Médicos'");
    }
    
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_manusoft_form_type',
        'meta_value' => 'medico'
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_manusoft_form_type' en postmeta para 'Datos Médicos'");
    }
}

// Actualización del formulario "Datos Médicos"
function manusoft_cf2pdf_update_medico_form() {
    $medico_id = manusoft_cf2pdf_get_default_id_form('medico');
    if ($medico_id != NULL) {
        global $wpdb;
        $check_error = false;
        $table_post = $wpdb->prefix."posts";
        $table_postmeta = $wpdb->prefix."postmeta";
        $data = array(
            'post_author' => 1,
            'post_date' => date('Y-m-d H:i:s'),
            'post_date_gmt' => date('Y-m-d H:i:s'),
            'post_content' => manusoft_cf2pdf_get_medico_content(),
            'post_title' => 'Datos Médicos',
            'comment_status' => 'closed',
            'ping_status' => 'closed',
            'post_name' => 'datos-medicos',
            'post_modified' => date('Y-m-d H:i:s'),
            'post_modified_gmt' => date('Y-m-d H:i:s'),
            'guid' => '',
            'post_type' => 'wpcf7_contact_form'
        );
        $where = array ( 'ID' => $medico_id );
        $update_result = $wpdb->update($table_post,$data,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error en la actualización del formulario 'Datos Médicos'");
        }
        
        $data_postmeta = array(
            'meta_value' => ''
        );
        $where = array (
            'meta_key' => '_additional_settings',
            'post_id' => $medico_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_additional_settings' en postmeta para 'Datos Médicos'");
        }
        
        $data_postmeta = array(
            'meta_value' => 'es_ES'
        );
        $where = array (
            'meta_key' => '_locale',
            'post_id' => $medico_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_locale' en postmeta para 'Datos Médicos'");
        }
        
        $data_postmeta = array(
            'meta_value' => 'a:23:{s:12:"mail_sent_ok";s:44:"Muchas gracias por rellenar este formulario.";s:12:"mail_sent_ng";s:88:"Hubo un error intentando enviar el formulario. Por favor inténtelo de nuevo más tarde.";s:16:"validation_error";s:74:"Uno o más campos tienen un error. Por favor revise e inténtelo de nuevo.";s:4:"spam";s:85:"Hubo un error intentando enviar tu mensaje. Por favor inténtalo de nuevo más tarde.";s:12:"accept_terms";s:71:"Debe aceptar los términos y condiciones antes de enviar el formulario.";s:16:"invalid_required";s:24:"El campo es obligatorio.";s:16:"invalid_too_long";s:28:"El campo es demasiado largo.";s:17:"invalid_too_short";s:28:"El campo es demasiado corto.";s:12:"invalid_date";s:34:"El formato de fecha es incorrecto.";s:14:"date_too_early";s:50:"La fecha es anterior a la más temprana permitida.";s:13:"date_too_late";s:50:"La fecha es posterior a la más tardía permitida.";s:13:"upload_failed";s:46:"Hubo un error desconocido subiendo el archivo.";s:24:"upload_file_type_invalid";s:51:"No tiene permisos para subir archivos de este tipo.";s:21:"upload_file_too_large";s:31:"El archivo es demasiado grande.";s:23:"upload_failed_php_error";s:43:"Se ha producido un error subiendo la imagen";s:14:"invalid_number";s:36:"El formato de número no es válido.";s:16:"number_too_small";s:45:"El número es menor que el mínimo permitido.";s:16:"number_too_large";s:45:"El número es mayor que el máximo permitido.";s:23:"quiz_answer_not_correct";s:44:"La respuesta al cuestionario no es correcta.";s:17:"captcha_not_match";s:37:"El código introducido es incorrecto.";s:13:"invalid_email";s:70:"La dirección de correo electrónico que ha introducido no es válida.";s:11:"invalid_url";s:21:"La URL no es válida.";s:11:"invalid_tel";s:38:"El número de teléfono no es válido.";}'
        );
        $where = array (
            'meta_key' => '_messages',
            'post_id' => $medico_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_messages' en postmeta para 'Datos Médicos'");
        }
        
        $data_postmeta = array(
            'meta_value' => 'a:9:{s:6:"active";b:0;s:7:"subject";s:0:"";s:6:"sender";s:0:"";s:9:"recipient";s:0:"";s:4:"body";s:0:"";s:18:"additional_headers";s:0:"";s:11:"attachments";s:0:"";s:8:"use_html";b:0;s:13:"exclude_blank";b:0;}'
        );
        $where = array (
            'meta_key' => '_mail_2',
            'post_id' => $medico_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_mail_2' en postmeta para 'Datos Médicos'");
        }
        
        $form = manusoft_cf2pdf_get_medico_form();
        $data_postmeta = array(
            'meta_value' => $form
        );
        $where = array (
            'meta_key' => '_form',
            'post_id' => $medico_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_form' en postmeta para 'Datos Médicos'");
        }
        
        $mail = manusoft_cf2pdf_get_medico_mail();
        $data_postmeta = array(
            'meta_value' => $mail
        );
        $where = array (
            'meta_key' => '_mail',
            'post_id' => $medico_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_mail' en postmeta para 'Datos Médicos'");
        }
        
        $data_postmeta = array(
            'meta_value' => 'medico'
        );
        $where = array (
            'meta_key' => '_manusoft_form_type',
            'post_id' => $medico_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_manusoft_form_type' en postmeta para 'Datos Médicos'");
        }
    } else {
        manusoft_cf2pdf_create_medico_form();
    }
}

function manusoft_cf2pdf_get_medico_content() {
    $config_data = manusoft_cf2pdf_get_cofig_data();
    $content = "
                <div class=\"row\">
                    <div class=\"col-md-12\">
                        <div class=\"row\">
                            <div class=\"col-md-12\" style=\"text-align:center;\">
                                <h4>INFORMACIÓN MÉDICA</h4>
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                                <label>Fecha de cumplimentación:</label>
                                [date* fecha_cumplimentacion]
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                                <label>Nombre y apellidos:</label>
                                [text* nombre]
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                                <label>Fecha de nacimiento:</label>
                                [date* fecha_nacimiento]
                            </div>
                            <div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                                <label>Peso (Kg):</label>
                                [number peso]
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                                <label>Enfermedades (indicar que tratamiento sigue en ese caso):</label>
                                [textarea* enfermedades]
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                                <label>Alergias (alimentos, medicamentos, ambientales, otros):</label>
                                [textarea* alergias]
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                                <label>Problemas leves comunes (frecuentes dolores de cabeza, resfriado, esguince de tobillo, dolor de espalda, etc.) y tratamiento que sigue en estos casos, tanto medicación como otros:</label>
                                [textarea* problemas_leves]
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                                <label>¿Requiere alguna atención especial? (Nocturnas, por carácter…)</label>
                                [textarea* atencion_especial]
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                                <label>Indíquenos  cualquier otra observación que debamos saber. Si es posible, adjuntar cualquier documento para completar la información anterior, como instrucción de tratamiento, autorización o informe médico.</label>
                                [textarea* otros]
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                                <h5>DECLARO:</h5>
                                [checkbox* declaro \"Que todos los datos anteriormente expuestos se corresponden con la realidad y que informaré de los cambios\"]
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                                <h5>AUTORIZO:</h5>
                                [checkbox* autorizo_1 \"A los responsables de la actividad, en caso de máxima urgencia, bajo conocimiento y prescripción de un facultativo, a tomar las decisiones médicas necesarias, si ha sido imposible mi localización.\"]
                                [checkbox* autorizo_2 \"Que el responsable scout administre la medicación detallada por los padres en esta autorización.\"]
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                                <label>Nombre del Padre, Madre o tutor:</label>
                                [text* nombre_padre]
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                                <label>Firma:</label>
                                [signature* firma cols:400]
                                <br>
                                [submit \"Enviar\"]
                            </div>
                        </div>
                    </div>
                </div>
                1
                Datos Médicos
                ".$config_data['email_grupo']."
                ".$config_data['email_grupo']."
                Nombre: [nombre]
                Fecha de cumplimentación: [fecha_cumplimentacion]
                
                ------------------------------------
                
                Este correo ha sido enviado desde el formulario de la web de ".strtoupper($config_data['nombre_grupo'])." ".get_site_url()."
                
                
                
                
                
                
                
                
                
                
                
                
                
                Muchas gracias por rellenar este formulario.
                Hubo un error intentando enviar el formulario. Por favor inténtelo de nuevo más tarde.
                Uno o más campos tienen un error. Por favor revise e inténtelo de nuevo.
                Hubo un error intentando enviar tu mensaje. Por favor inténtalo de nuevo más tarde.
                Debe aceptar los términos y condiciones antes de enviar el formulario.
                El campo es obligatorio.
                El campo es demasiado largo.
                El campo es demasiado corto.
                El formato de fecha es incorrecto.
                La fecha es anterior a la más temprana permitida.
                La fecha es posterior a la más tardía permitida.
                Hubo un error desconocido subiendo el archivo.
                No tiene permisos para subir archivos de este tipo.
                El archivo es demasiado grande.
                Se ha producido un error subiendo la imagen
                El formato de número no es válido.
                El número es menor que el mínimo permitido.
                El número es mayor que el máximo permitido.
                La respuesta al cuestionario no es correcta.
                El código introducido es incorrecto.
                La dirección de correo electrónico que ha introducido no es válida.
                La URL no es válida.
                El número de teléfono no es válido.
    ";
    return $content;
}

function manusoft_cf2pdf_get_medico_form() {
    $config_data = manusoft_cf2pdf_get_cofig_data();
    $form = "
            <div class=\"row\">
                <div class=\"col-md-12\">
                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"text-align:center;\">
                            <h4>INFORMACIÓN MÉDICA</h4>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                            <label>Fecha de cumplimentación:</label>
                            [date* fecha_cumplimentacion]
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                            <label>Nombre y apellidos:</label>
                            [text* nombre]
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                            <label>Fecha de nacimiento:</label>
                            [date* fecha_nacimiento]
                        </div>
                        <div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                            <label>Peso (Kg):</label>
                            [number peso]
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                            <label>Enfermedades (indicar que tratamiento sigue en ese caso):</label>
                            [textarea* enfermedades]
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                            <label>Alergias (alimentos, medicamentos, ambientales, otros):</label>
                            [textarea* alergias]
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                            <label>Problemas leves comunes (frecuentes dolores de cabeza, resfriado, esguince de tobillo, dolor de espalda, etc.) y tratamiento que sigue en estos casos, tanto medicación como otros:</label>
                            [textarea* problemas_leves]
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                            <label>¿Requiere alguna atención especial? (Nocturnas, por carácter…)</label>
                            [textarea* atencion_especial]
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                            <label>Indíquenos  cualquier otra observación que debamos saber. Si es posible, adjuntar cualquier documento para completar la información anterior, como instrucción de tratamiento, autorización o informe médico.</label>
                            [textarea* otros]
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                            <h5>DECLARO:</h5>
                            [checkbox* declaro \"Que todos los datos anteriormente expuestos se corresponden con la realidad y que informaré de los cambios\"]
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                            <h5>AUTORIZO:</h5>
                            [checkbox* autorizo_1 \"A los responsables de la actividad, en caso de máxima urgencia, bajo conocimiento y prescripción de un facultativo, a tomar las decisiones médicas necesarias, si ha sido imposible mi localización.\"]
                            [checkbox* autorizo_2 \"Que el responsable scout administre la medicación detallada por los padres en esta autorización.\"]
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                            <label>Nombre del Padre, Madre o tutor:</label>
                            [text* nombre_padre]
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                            <label>Firma:</label>
                            [signature* firma cols:400]
                            <br>
                            [submit \"Enviar\"]
                        </div>
                    </div>
                </div>
            </div>
    ";
    return $form;
}

function manusoft_cf2pdf_get_medico_mail() {
    $config_data = manusoft_cf2pdf_get_cofig_data();
    $email_array = array(
        'active' => 1,
        'subject' => "Datos Médicos",
        'sender' => $config_data['email_grupo'],
        'recipient' => $config_data['email_grupo'],
        'body' => "Nombre: [nombre]
Fecha de cumplimentación: [fecha_cumplimentacion]

------------------------------------

Este correo ha sido enviado desde el formulario de la web de ".strtoupper($config_data['nombre_grupo'])." ".get_site_url(),
        'additional_headers' => "",
        'attachments' => "",
        'use_html' => 0,
        'exclude_blank' => 0
    );
    $email = serialize($email_array);
    return $email;
}

// Creación del formulario "Domiciliación Bancaria"
function manusoft_cf2pdf_create_banco_form() {
    global $wpdb;
    $check_error = false;
    $table_post = $wpdb->prefix."posts";
    $table_postmeta = $wpdb->prefix."postmeta";
    $data = array(
        'post_author' => 1,
        'post_date' => date('Y-m-d H:i:s'),
        'post_date_gmt' => date('Y-m-d H:i:s'),
        'post_content' => manusoft_cf2pdf_get_banco_content(),
        'post_title' => 'Domiciliación Bancaria',
        'comment_status' => 'closed',
        'ping_status' => 'closed',
        'post_name' => 'domiciliacion-bancaria',
        'post_modified' => date('Y-m-d H:i:s'),
        'post_modified_gmt' => date('Y-m-d H:i:s'),
        'guid' => '',
        'post_type' => 'wpcf7_contact_form'
    );
    $insert_result = $wpdb->insert($table_post,$data);
    $id = $wpdb->insert_id;
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error en la creación del formulario 'Domiciliación Bancaria'");
    }
    
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_additional_settings',
        'meta_value' => ''
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_additional_settings' en postmeta para 'Domiciliación Bancaria'");
    }
    
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_locale',
        'meta_value' => 'es_ES'
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_locale' en postmeta para 'Domiciliación Bancaria'");
    }
    
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_messages',
        'meta_value' => 'a:23:{s:12:"mail_sent_ok";s:44:"Muchas gracias por rellenar este formulario.";s:12:"mail_sent_ng";s:88:"Hubo un error intentando enviar el formulario. Por favor inténtelo de nuevo más tarde.";s:16:"validation_error";s:74:"Uno o más campos tienen un error. Por favor revise e inténtelo de nuevo.";s:4:"spam";s:85:"Hubo un error intentando enviar tu mensaje. Por favor inténtalo de nuevo más tarde.";s:12:"accept_terms";s:71:"Debe aceptar los términos y condiciones antes de enviar el formulario.";s:16:"invalid_required";s:24:"El campo es obligatorio.";s:16:"invalid_too_long";s:28:"El campo es demasiado largo.";s:17:"invalid_too_short";s:28:"El campo es demasiado corto.";s:12:"invalid_date";s:34:"El formato de fecha es incorrecto.";s:14:"date_too_early";s:50:"La fecha es anterior a la más temprana permitida.";s:13:"date_too_late";s:50:"La fecha es posterior a la más tardía permitida.";s:13:"upload_failed";s:46:"Hubo un error desconocido subiendo el archivo.";s:24:"upload_file_type_invalid";s:51:"No tiene permisos para subir archivos de este tipo.";s:21:"upload_file_too_large";s:31:"El archivo es demasiado grande.";s:23:"upload_failed_php_error";s:43:"Se ha producido un error subiendo la imagen";s:14:"invalid_number";s:36:"El formato de número no es válido.";s:16:"number_too_small";s:45:"El número es menor que el mínimo permitido.";s:16:"number_too_large";s:45:"El número es mayor que el máximo permitido.";s:23:"quiz_answer_not_correct";s:44:"La respuesta al cuestionario no es correcta.";s:17:"captcha_not_match";s:37:"El código introducido es incorrecto.";s:13:"invalid_email";s:70:"La dirección de correo electrónico que ha introducido no es válida.";s:11:"invalid_url";s:21:"La URL no es válida.";s:11:"invalid_tel";s:38:"El número de teléfono no es válido.";}'
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_messages' en postmeta para 'Domiciliación Bancaria'");
    }
    
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_mail_2',
        'meta_value' => 'a:9:{s:6:"active";b:0;s:7:"subject";s:0:"";s:6:"sender";s:0:"";s:9:"recipient";s:0:"";s:4:"body";s:0:"";s:18:"additional_headers";s:0:"";s:11:"attachments";s:0:"";s:8:"use_html";b:0;s:13:"exclude_blank";b:0;}'
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_mail_2' en postmeta para 'Domiciliación Bancaria'");
    }
    
    $form = manusoft_cf2pdf_get_banco_form();
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_form',
        'meta_value' => $form
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_form' en postmeta para 'Domiciliación Bancaria'");
    }
    
    $mail = manusoft_cf2pdf_get_banco_mail();
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_mail',
        'meta_value' => $mail
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_mail' en postmeta para 'Domiciliación Bancaria'");
    }
    
    $data_postmeta = array(
        'post_id' => $id,
        'meta_key' => '_manusoft_form_type',
        'meta_value' => 'banco'
    );
    $insert_result = $wpdb->insert($table_postmeta,$data_postmeta);
    if ($insert_result === false) {
        $check_error = true;
        manusoft_cf2pdf_error_log("Error al insertar el registro '_manusoft_form_type' en postmeta para 'Domiciliación Bancaria'");
    }
}

// Actualización del formulario "Domiciliación Bancaria"
function manusoft_cf2pdf_update_banco_form() {
    $banco_id = manusoft_cf2pdf_get_default_id_form('banco');
    if ($banco_id != NULL) {
        global $wpdb;
        $check_error = false;
        $table_post = $wpdb->prefix."posts";
        $table_postmeta = $wpdb->prefix."postmeta";
        $data = array(
            'post_author' => 1,
            'post_date' => date('Y-m-d H:i:s'),
            'post_date_gmt' => date('Y-m-d H:i:s'),
            'post_content' => manusoft_cf2pdf_get_banco_content(),
            'post_title' => 'Domiciliación Bancaria',
            'comment_status' => 'closed',
            'ping_status' => 'closed',
            'post_name' => 'domiciliacion-bancaria',
            'post_modified' => date('Y-m-d H:i:s'),
            'post_modified_gmt' => date('Y-m-d H:i:s'),
            'guid' => '',
            'post_type' => 'wpcf7_contact_form'
        );
        $where = array ( 'ID' => $banco_id );
        $update_result = $wpdb->update($table_post,$data,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error en la actualización del formulario 'Domiciliación Bancaria'");
        }
        
        $data_postmeta = array(
            'meta_value' => ''
        );
        $where = array (
            'meta_key' => '_additional_settings',
            'post_id' => $banco_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_additional_settings' en postmeta para 'Domiciliación Bancaria'");
        }
        
        $data_postmeta = array(
            'meta_value' => 'es_ES'
        );
        $where = array (
            'meta_key' => '_locale',
            'post_id' => $banco_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_locale' en postmeta para 'Domiciliación Bancaria'");
        }
        
        $data_postmeta = array(
            'meta_value' => 'a:23:{s:12:"mail_sent_ok";s:44:"Muchas gracias por rellenar este formulario.";s:12:"mail_sent_ng";s:88:"Hubo un error intentando enviar el formulario. Por favor inténtelo de nuevo más tarde.";s:16:"validation_error";s:74:"Uno o más campos tienen un error. Por favor revise e inténtelo de nuevo.";s:4:"spam";s:85:"Hubo un error intentando enviar tu mensaje. Por favor inténtalo de nuevo más tarde.";s:12:"accept_terms";s:71:"Debe aceptar los términos y condiciones antes de enviar el formulario.";s:16:"invalid_required";s:24:"El campo es obligatorio.";s:16:"invalid_too_long";s:28:"El campo es demasiado largo.";s:17:"invalid_too_short";s:28:"El campo es demasiado corto.";s:12:"invalid_date";s:34:"El formato de fecha es incorrecto.";s:14:"date_too_early";s:50:"La fecha es anterior a la más temprana permitida.";s:13:"date_too_late";s:50:"La fecha es posterior a la más tardía permitida.";s:13:"upload_failed";s:46:"Hubo un error desconocido subiendo el archivo.";s:24:"upload_file_type_invalid";s:51:"No tiene permisos para subir archivos de este tipo.";s:21:"upload_file_too_large";s:31:"El archivo es demasiado grande.";s:23:"upload_failed_php_error";s:43:"Se ha producido un error subiendo la imagen";s:14:"invalid_number";s:36:"El formato de número no es válido.";s:16:"number_too_small";s:45:"El número es menor que el mínimo permitido.";s:16:"number_too_large";s:45:"El número es mayor que el máximo permitido.";s:23:"quiz_answer_not_correct";s:44:"La respuesta al cuestionario no es correcta.";s:17:"captcha_not_match";s:37:"El código introducido es incorrecto.";s:13:"invalid_email";s:70:"La dirección de correo electrónico que ha introducido no es válida.";s:11:"invalid_url";s:21:"La URL no es válida.";s:11:"invalid_tel";s:38:"El número de teléfono no es válido.";}'
        );
        $where = array (
            'meta_key' => '_messages',
            'post_id' => $banco_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_messages' en postmeta para 'Domiciliación Bancaria'");
        }
        
        $data_postmeta = array(
            'meta_value' => 'a:9:{s:6:"active";b:0;s:7:"subject";s:0:"";s:6:"sender";s:0:"";s:9:"recipient";s:0:"";s:4:"body";s:0:"";s:18:"additional_headers";s:0:"";s:11:"attachments";s:0:"";s:8:"use_html";b:0;s:13:"exclude_blank";b:0;}'
        );
        $where = array (
            'meta_key' => '_mail_2',
            'post_id' => $banco_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_mail_2' en postmeta para 'Domiciliación Bancaria'");
        }
        
        $form = manusoft_cf2pdf_get_banco_form();
        $data_postmeta = array(
            'meta_value' => $form
        );
        $where = array (
            'meta_key' => '_form',
            'post_id' => $banco_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_form' en postmeta para 'Domiciliación Bancaria'");
        }
        
        $mail = manusoft_cf2pdf_get_banco_mail();
        $data_postmeta = array(
            'meta_value' => $mail
        );
        $where = array (
            'meta_key' => '_mail',
            'post_id' => $banco_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_mail' en postmeta para 'Domiciliación Bancaria'");
        }
        
        $data_postmeta = array(
            'meta_value' => 'banco'
        );
        $where = array (
            'meta_key' => '_manusoft_form_type',
            'post_id' => $banco_id
        );
        $update_result = $wpdb->update($table_postmeta,$data_postmeta,$where);
        if ($update_result === false) {
            $check_error = true;
            manusoft_cf2pdf_error_log("Error al actualizar el registro '_manusoft_form_type' en postmeta para 'Domiciliación Bancaria'");
        }
    } else {
        manusoft_cf2pdf_create_banco_form();
    }
}

function manusoft_cf2pdf_get_banco_content() {
    $config_data = manusoft_cf2pdf_get_cofig_data();

    $content = "
                <div class=\"row\">
                    <div class=\"col-md-12\">
                        <div class=\"row\" style=\"margin: 30px 0px 30px 0px;\">
                            <div class=\"col-md-12\" style=\"text-align:center;\">
                                <h4>DOMICILIACIÓN BANCARIA</h4>
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                                <label>Familia:</label>
                                [text* familia]
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                                <p style=\"color:red;\">El importe es el resultado de multiplicar ".$config_data['cuota']." € (cuota de miembro del grupo) por el número de miembros que pertenecen al grupo.</p>
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                                <label>Importe (periodicidad ".strtoupper($config_data['periodicidad'])."):</label>
                                [number* importe]
                            </div>
                        </div>
                        <div class=\"row\" style=\"margin: 30px 0px 30px 0px;\">
                            <div class=\"col-md-12\" style=\"text-align:center;\">
                                <h4>ORDEN DE DOMICILIACIÓN DE ADEUDO DIRECTO</h4>
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-md-8\" style=\"margin-bottom:30px;\">
                                <label>Titular de la cuenta:</label>
                                [text* titular]
                            </div>
                            <div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                                <label>D.N.I.:</label>
                                [text* dni]
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                                <label>Número de cuenta IBAN <small>(mira tu talonario, libreta o extracto y cumplimenta los datos de la misma en su totalidad):</small></label>
                                [text* num_cuenta]
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                                <label>Firma del titular de la cuenta:</label>
                                [signature* firma cols:400]
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                                <label>Fecha:</label>
                                [date* fecha]
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                                <p>Mediante la firma de esta orden de domiciliación, el deudor autoriza a ".strtoupper($config_data['nombre_grupo'])." a efectuar los cargos que ahora se acuerdan en esta domiciliación.</p>
                            </div>
                        </div>
                    </div>
                    [submit \"Enviar\"]
                </div>
                1
                Domiciliación Bancaria
                ".$config_data['email_grupo']."
                ".$config_data['email_grupo']."
                Familia: [familia]
                Importe: [importe]
                Num. Cuenta: [num_cuenta]
                Fecha: [fecha]
                
                ------------------------------------
                
                Este correo ha sido enviado desde el formulario de la web de ".strtoupper($config_data['nombre_grupo'])." ".get_site_url()."
                
                
                
                
                
                
                
                
                
                
                
                
                
                Muchas gracias por rellenar este formulario.
                Hubo un error intentando enviar el formulario. Por favor inténtelo de nuevo más tarde.
                Uno o más campos tienen un error. Por favor revise e inténtelo de nuevo.
                Hubo un error intentando enviar tu mensaje. Por favor inténtalo de nuevo más tarde.
                Debe aceptar los términos y condiciones antes de enviar el formulario.
                El campo es obligatorio.
                El campo es demasiado largo.
                El campo es demasiado corto.
                El formato de fecha es incorrecto.
                La fecha es anterior a la más temprana permitida.
                La fecha es posterior a la más tardía permitida.
                Hubo un error desconocido subiendo el archivo.
                No tiene permisos para subir archivos de este tipo.
                El archivo es demasiado grande.
                Se ha producido un error subiendo la imagen
                El formato de número no es válido.
                El número es menor que el mínimo permitido.
                El número es mayor que el máximo permitido.
                La respuesta al cuestionario no es correcta.
                El código introducido es incorrecto.
                La dirección de correo electrónico que ha introducido no es válida.
                La URL no es válida.
                El número de teléfono no es válido.
    ";
    return $content;
}

function manusoft_cf2pdf_get_banco_form() {
    $config_data = manusoft_cf2pdf_get_cofig_data();
    $form = "
            <div class=\"row\">
                <div class=\"col-md-12\">
                    <div class=\"row\" style=\"margin: 30px 0px 30px 0px;\">
                        <div class=\"col-md-12\" style=\"text-align:center;\">
                            <h4>DOMICILIACIÓN BANCARIA</h4>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                            <label>Familia:</label>
                            [text* familia]
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                            <p style=\"color:red;\">El importe es el resultado de multiplicar ".$config_data['cuota']." € (cuota de miembro del grupo) por el número de miembros que pertenecen al grupo.</p>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                            <label>Importe (periodicidad ".strtoupper($config_data['periodicidad'])."):</label>
                            [number* importe]
                        </div>
                    </div>
                    <div class=\"row\" style=\"margin: 30px 0px 30px 0px;\">
                        <div class=\"col-md-12\" style=\"text-align:center;\">
                            <h4>ORDEN DE DOMICILIACIÓN DE ADEUDO DIRECTO</h4>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-8\" style=\"margin-bottom:30px;\">
                            <label>Titular de la cuenta:</label>
                            [text* titular]
                        </div>
                        <div class=\"col-md-4\" style=\"margin-bottom:30px;\">
                            <label>D.N.I.:</label>
                            [text* dni]
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                            <label>Número de cuenta IBAN <small>(mira tu talonario, libreta o extracto y cumplimenta los datos de la misma en su totalidad):</small></label>
                            [text* num_cuenta]
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                            <label>Firma del titular de la cuenta:</label>
                            [signature* firma cols:400]
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                            <label>Fecha:</label>
                            [date* fecha]
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"margin-bottom:30px;\">
                            <p>Mediante la firma de esta orden de domiciliación, el deudor autoriza a ".strtoupper($config_data['nombre_grupo'])." a efectuar los cargos que ahora se acuerdan en esta domiciliación.</p>
                        </div>
                    </div>
                </div>
                [submit \"Enviar\"]
            </div>
    ";
    return $form;
}

function manusoft_cf2pdf_get_banco_mail() {
    $config_data = manusoft_cf2pdf_get_cofig_data();
    $email_array = array(
        'active' => 1,
        'subject' => "Domiciliación Bancaria",
        'sender' => $config_data['email_grupo'],
        'recipient' => $config_data['email_grupo'],
        'body' => "Familia: [familia]
Importe: [importe] €
Num. Cuenta: [num_cuenta]
Fecha: [fecha]

------------------------------------

Este correo ha sido enviado desde el formulario de la web de ".strtoupper($config_data['nombre_grupo'])." ".get_site_url(),
        'additional_headers' => "",
        'attachments' => "",
        'use_html' => 0,
        'exclude_blank' => 0
    );
    $email = serialize($email_array);
    return $email;
}
?>