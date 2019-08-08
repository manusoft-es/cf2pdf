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
	    
	    var html_message = "";
	    var check_data = true;
	    if (nombre_grupo == "") {
	    	check_data = false;
	    	jQuery('#nombre_grupo').css("border","solid 1px red");
	    	html_message = html_message+"<div class='notice notice-error'><p>'Nombre del grupo o asociación' no puede estar en blanco.</p></div>";
	    } else if (!nombre_grupo.match(/^[a-zA-Z0-9]{1,}$/)) {
	    	jQuery('#nombre_grupo').css("border","solid 1px red");
	    	check_data = false;
	    	html_message = html_message+"<div class='notice notice-error'><p>'Nombre del grupo o asociación' no puede estar en blanco.</p></div>";
	    }
	    if (cif_grupo != "" && !cif_grupo.match(/^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/)) {
	    	jQuery('#cif_grupo').css("border","solid 1px red");
	    	check_data = false;
	    	html_message = html_message+"<div class='notice notice-error'><p>'CIF' no cumple con el patrón de un CIF.</p></div>";
	    }
	    if (email_grupo == "") {
	    	jQuery('#email_grupo').css("border","solid 1px red");
	    	check_data = false;
	    	html_message = html_message+"<div class='notice notice-error'><p>'Email' no puede estar en blanco.</p></div>";
	    } else if (!email_grupo.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
	    	jQuery('#email_grupo').css("border","solid 1px red");
	    	check_data = false;
	    	html_message = html_message+"<div class='notice notice-error'><p>'Email' no cumple con el patrón de un email.</p></div>";
	    }
	    if (direccion_grupo == "") {
	    	jQuery('#direccion_grupo').css("border","solid 1px red");
	    	check_data = false;
	    	html_message = html_message+"<div class='notice notice-error'><p>'Dirección' no puede estar en blanco.</p></div>";
	    } else if (!direccion_grupo.match(/^[a-zA-Z0-9]{1,}$/)) {
	    	jQuery('#direccion_grupo').css("border","solid 1px red");
	    	check_data = false;
	    	html_message = html_message+"<div class='notice notice-error'><p>'Dirección' no puede estar en blanco.</p></div>";
	    }
	    if (poblacion_grupo == "") {
	    	jQuery('#poblacion_grupo').css("border","solid 1px red");
	    	check_data = false;
	    	html_message = html_message+"<div class='notice notice-error'><p>'Población' no puede estar en blanco.</p></div>";
	    } else if (!poblacion_grupo.match(/^[a-zA-Z0-9]{1,}$/)) {
	    	jQuery('#poblacion_grupo').css("border","solid 1px red");
	    	check_data = false;
	    	html_message = html_message+"<div class='notice notice-error'><p>'Población' no puede estar en blanco.</p></div>";
	    }
	    if (provincia_grupo == "") {
	    	jQuery('#provincia_grupo').css("border","solid 1px red");
	    	check_data = false;
	    	html_message = html_message+"<div class='notice notice-error'><p>'Provincia' no puede estar en blanco.</p></div>";
	    } else if (!provincia_grupo.match(/^[a-zA-Z0-9]{1,}$/)) {
	    	jQuery('#provincia_grupo').css("border","solid 1px red");
	    	check_data = false;
	    	html_message = html_message+"<div class='notice notice-error'><p>'Provincia' no puede estar en blanco.</p></div>";
	    }
	    if (cp_grupo == "") {
	    	jQuery('#cp_grupo').css("border","solid 1px red");
	    	check_data = false;
	    	html_message = html_message+"<div class='notice notice-error'><p>'Código postal' no puede estar en blanco.</p></div>";
	    } else if (!cp_grupo.match(/^(\d{6})$/)) {
	    	jQuery('#cp_grupo').css("border","solid 1px red");
	    	check_data = false;
	    	html_message = html_message+"<div class='notice notice-error'><p>'Código postal' debe estar formado únicamente por 6 dígitos.</p></div>";
	    }
	    
	    if (check_data) {
	    	var data = {
	    			action:'manusoft_cf2pdf_save_config',
	    			nombre_grupo:nombre_grupo,
	    			cif_grupo:cif_grupo,
	    			email_grupo:email_grupo,
	    			direccion_grupo:direccion_grupo,
	    			poblacion_grupo:poblacion_grupo,
	    			provincia_grupo:provincia_grupo,
	    			cp_grupo:cp_grupo
	    	};
		    
		    jQuery.get(ajaxurl,data,function(response) {
	    		if (response.data.result !== false) {
	    			jQuery('#manusoft_cf2pdg_messages').html("<div class='notice notice-success'><p>La configuración se ha guardado correctamente.</p></div>");
	    			setTimeout(location.reload.bind(location), 3000);
	    		} else {
	    			jQuery('#manusoft_cf2pdg_messages').html("<div class='notice notice-error'><p>Ha ocurrido un error. Inténtalo de nuevo más tarde.</p></div>");
	    		}
		    });
	    } else {
	    	jQuery('#manusoft_cf2pdg_messages').html(html_message);
	    }
	});
});