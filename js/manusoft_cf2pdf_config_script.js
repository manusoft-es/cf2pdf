jQuery(document).ready( function($) {
	jQuery('#manusoft_cf2pdf_guardar_button').click(function(e) {
	    e.preventDefault();

	    var nombre_grupo = jQuery('#nombre_grupo').val();
	    var cif_grupo = jQuery('#cif_grupo').val();
	    var email_grupo = jQuery('#email_grupo').val();
	    var direccion_grupo = jQuery('#direccion_grupo').val();
	    var poblacion_grupo = jQuery('#poblacion_grupo').val();
	    var provincia_grupo = jQuery('#provincia_grupo').val();
	    var cp_grupo = jQuery('#cp_grupo').val();

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
	    
	});
});