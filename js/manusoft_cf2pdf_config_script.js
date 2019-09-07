jQuery(document).ready( function($) {
	jQuery('#manusoft_cf2pdf_guardar_button').click(function(e) {
	    e.preventDefault();
	    
    	jQuery('input, textarea').css("border","none");

	    var nombre_grupo = jQuery('#nombre_grupo').val();
	    var cif_grupo = jQuery('#cif_grupo').val();
	    var email_grupo = jQuery('#email_grupo').val();
	    var direccion_grupo = jQuery('#direccion_grupo').val();
	    var poblacion_grupo = jQuery('#poblacion_grupo').val();
	    var provincia_grupo = jQuery('#provincia_grupo').val();
	    var cp_grupo = jQuery('#cp_grupo').val();
	    var cuota = jQuery('#cuota').val();
	    var periodicidad = jQuery('#periodicidad option:selected').val();
	    
	    var config_inicial = jQuery('#config_inicial').val();
	    if (config_inicial == "1") {
		    var header_url = jQuery('#manusoft_cf2pdf_header_url').val();
		    var lateral_sup_url = jQuery('#manusoft_cf2pdf_lateral_sup_url').val();
		    var lateral_inf_url = jQuery('#manusoft_cf2pdf_lateral_inf_url').val();
		    var lateral_text = jQuery('#manusoft_cf2pdf_lateral_text').val();
		    var footer_text = jQuery('#manusoft_cf2pdf_footer_text').val();
	    }
	    
	    var html_message = "";
    	jQuery('#manusoft_cf2pdf_nombre_grupo_messages').html("");
    	jQuery('#manusoft_cf2pdf_cif_grupo_messages').html("");
    	jQuery('#manusoft_cf2pdf_email_grupo_messages').html("");
    	jQuery('#manusoft_cf2pdf_direccion_grupo_messages').html("");
    	jQuery('#manusoft_cf2pdf_poblacion_grupo_messages').html("");
    	jQuery('#manusoft_cf2pdf_provincia_grupo_messages').html("");
    	jQuery('#manusoft_cf2pdf_cp_grupo_messages').html("");
    	jQuery('#manusoft_cf2pdf_cuota_messages').html("");
    	jQuery('#manusoft_cf2pdf_periodicidad_messages').html("");
	    
	    var check_data = true;
	    if (nombre_grupo == "") {
	    	check_data = false;
	    	jQuery('#nombre_grupo').css("border","solid 1px red");
	    	jQuery('#manusoft_cf2pdf_nombre_grupo_messages').html("<p style='color:red;'><small>Este campo no puede estar en blanco.</small></p>");
	    } else if (!nombre_grupo.match(/^[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1\s]+$/)) {
	    	check_data = false;
	    	jQuery('#nombre_grupo').css("border","solid 1px red");
	    	jQuery('#manusoft_cf2pdf_nombre_grupo_messages').html("<p style='color:red;'><small>Este campo solamente puede tener caracteres alfanuméricos y espacios.</small></p>");
	    }
	    if (cif_grupo != "" && !cif_grupo.match(/^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/)) {
	    	check_data = false;
	    	jQuery('#cif_grupo').css("border","solid 1px red");
	    	jQuery('#manusoft_cf2pdf_cif_grupo_messages').html("<p style='color:red;'><small>Este campo no cumple con el formato especificado.</small></p>");
	    }
	    if (email_grupo == "") {
	    	check_data = false;
	    	jQuery('#email_grupo').css("border","solid 1px red");
	    	jQuery('#manusoft_cf2pdf_email_grupo_messages').html("<p style='color:red;'><small>Este campo no puede estar en blanco.</small></p>");
	    } else if (!email_grupo.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
	    	check_data = false;
	    	jQuery('#email_grupo').css("border","solid 1px red");
	    	jQuery('#manusoft_cf2pdf_email_grupo_messages').html("<p style='color:red;'><small>Este campo no cumple con el formato especificado.</small></p>");
	    }
	    if (direccion_grupo == "") {
	    	check_data = false;
	    	jQuery('#direccion_grupo').css("border","solid 1px red");
	    	jQuery('#manusoft_cf2pdf_direccion_grupo_messages').html("<p style='color:red;'><small>Este campo no puede estar en blanco.</small></p>");
	    } else if (!direccion_grupo.match(/^[0-9a-zA-ZÀ-ÿ\u00f1\u00d1\º\ª\,\.\:\;\\\/]+(\s*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1\º\ª\,\.\:\;\\\/]*)*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1\s\º\ª\,\.\:\;\\\/]+$/)) {
	    	check_data = false;
	    	jQuery('#direccion_grupo').css("border","solid 1px red");
	    	jQuery('#manusoft_cf2pdf_direccion_grupo_messages').html("<p style='color:red;'><small>Este campo no puede estar en blanco.</small></p>");
	    }
	    if (poblacion_grupo == "") {
	    	check_data = false;
	    	jQuery('#poblacion_grupo').css("border","solid 1px red");
	    	jQuery('#manusoft_cf2pdf_poblacion_grupo_messages').html("<p style='color:red;'><small>Este campo no puede estar en blanco.</small></p>");
	    } else if (!poblacion_grupo.match(/^[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1\s]+$/)) {
	    	check_data = false;
	    	jQuery('#poblacion_grupo').css("border","solid 1px red");
	    	jQuery('#manusoft_cf2pdf_poblacion_grupo_messages').html("<p style='color:red;'><small>Este campo solamente puede tener caracteres alfanuméricos y espacios.</small></p>");
	    }
	    if (provincia_grupo == "") {
	    	check_data = false;
	    	jQuery('#provincia_grupo').css("border","solid 1px red");
	    	jQuery('#manusoft_cf2pdf_provincia_grupo_messages').html("<p style='color:red;'><small>Este campo no puede estar en blanco.</small></p>");
	    } else if (!provincia_grupo.match(/^[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1\s]+$/)) {
	    	check_data = false;
	    	jQuery('#provincia_grupo').css("border","solid 1px red");
	    	jQuery('#manusoft_cf2pdf_provincia_grupo_messages').html("<p style='color:red;'><small>Este campo solamente puede tener caracteres alfanuméricos y espacios.</small></p>");
	    }
	    if (cp_grupo == "") {
	    	check_data = false;
	    	jQuery('#cp_grupo').css("border","solid 1px red");
	    	jQuery('#manusoft_cf2pdf_cp_grupo_messages').html("<p style='color:red;'><small>Este campo no puede estar en blanco.</small></p>");
	    } else if (!cp_grupo.match(/^(\d{5})$/)) {
	    	check_data = false;
	    	jQuery('#cp_grupo').css("border","solid 1px red");
	    	jQuery('#manusoft_cf2pdf_cp_grupo_messages').html("<p style='color:red;'><small>Este campo debe estar formado únicamente por 6 dígitos.</small></p>");
	    }
	    if (cuota == "") {
	    	check_data = false;
	    	jQuery('#cuota').css("border","solid 1px red");
	    	jQuery('#manusoft_cf2pdf_cuota_messages').html("<p style='color:red;'><small>Este campo no puede estar en blanco.</small></p>");
	    } else if (!cuota.match(/^\d{0,}$/)) {
	    	check_data = false;
	    	jQuery('#cuota').css("border","solid 1px red");
	    	jQuery('#manusoft_cf2pdf_cuota_messages').html("<p style='color:red;'><small>Este campo debe estar formado únicamente por dígitos.</small></p>");
	    }
	    
	    if (check_data) {
		    if (config_inicial == "1") {
		    	var data = {
		    			action:'manusoft_cf2pdf_save_config',
		    			nombre_grupo:nombre_grupo,
		    			cif_grupo:cif_grupo,
		    			email_grupo:email_grupo,
		    			direccion_grupo:direccion_grupo,
		    			poblacion_grupo:poblacion_grupo,
		    			provincia_grupo:provincia_grupo,
		    			cp_grupo:cp_grupo,
		    			cuota:cuota,
		    			periodicidad:periodicidad,
		    			
		    			header_url:header_url,
	    				lateral_sup_url:lateral_sup_url,
	    				lateral_inf_url:lateral_inf_url,
	    				lateral_text:lateral_text,
	    				footer_text:footer_text
		    	};
		    } else {
		    	var data = {
		    			action:'manusoft_cf2pdf_save_config',
		    			nombre_grupo:nombre_grupo,
		    			cif_grupo:cif_grupo,
		    			email_grupo:email_grupo,
		    			direccion_grupo:direccion_grupo,
		    			poblacion_grupo:poblacion_grupo,
		    			provincia_grupo:provincia_grupo,
		    			cp_grupo:cp_grupo,
		    			cuota:cuota,
		    			periodicidad:periodicidad
		    	};
		    }
		    
		    jQuery.get(ajaxurl,data,function(response) {
	    		if (response.data.result !== false) {
	    			jQuery('#manusoft_cf2pdf_messages').html("<div class='notice notice-success'><p>La configuración se ha guardado correctamente.</p></div>");
	    			setTimeout(location.reload.bind(location), 3000);
	    		} else {
	    			jQuery('#manusoft_cf2pdf_messages').html("<div class='notice notice-error'><p>Ha ocurrido un error. Inténtalo de nuevo.</p></div>");
	    		}
		    });
	    } else {
	    	jQuery('#manusoft_cf2pdf_messages').html("<div class='notice notice-error'><p>Ha ocurrido un error.</p></div>");
	    }
	});
});