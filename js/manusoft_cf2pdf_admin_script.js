jQuery(document).ready( function($) {
  jQuery('#manusoft_cf2pdf_guardar_button').click(function(e) {
    e.preventDefault();

    var header_url = jQuery('#manusoft_cf2pdf_header_url').val();
    var lateral_sup_url = jQuery('#manusoft_cf2pdf_lateral_sup_url').val();
    var lateral_inf_url = jQuery('#manusoft_cf2pdf_lateral_inf_url').val();
    var lateral_text = jQuery('#manusoft_cf2pdf_lateral_text').val();
    var footer_url = jQuery('#manusoft_cf2pdf_footer_url').val();
    var footer_text = jQuery('#manusoft_cf2pdf_footer_text').val();

    var data = {
      action:'manusoft_cf2pdf_save_config',
      header_url:header_url,
      lateral_sup_url:lateral_sup_url,
      lateral_inf_url:lateral_inf_url,
      lateral_text:lateral_text,
      footer_url:footer_url,
      footer_text:footer_text
    };
    jQuery.get(ajaxurl,data,function(response) {
      if (response.data.result !== false) {
        alert("La configuración se ha guardado correctamente.");
        //jQuery('#manusoft_cf2pdg_messages').val("La configuración se ha guardado correctamente.");
      } else {
        alert("Ha ocurrido un error. Inténtalo de nuevo más tarde.");
        //jQuery('#manusoft_cf2pdg_messages').val("Ha ocurrido un error. Inténtalo de nuevo más tarde.");
      }
    });
  });
});
