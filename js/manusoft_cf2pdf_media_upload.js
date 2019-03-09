jQuery(document).ready( function($) {
  jQuery('input#manusoft_cf2pdf_header_button').click(function(e) {
    e.preventDefault();
    open_wp_media_frame('manusoft_cf2pdf_header_url','manusoft_cf2pdf_header_preview')
  });
  jQuery('input#manusoft_cf2pdf_lateral_sup_button').click(function(e) {
    e.preventDefault();
    open_wp_media_frame('manusoft_cf2pdf_lateral_sup_url','manusoft_cf2pdf_lateral_sup_preview')
  });
  jQuery('input#manusoft_cf2pdf_lateral_inf_button').click(function(e) {
    e.preventDefault();
    open_wp_media_frame('manusoft_cf2pdf_lateral_inf_url','manusoft_cf2pdf_lateral_inf_preview')
  });
  jQuery('input#manusoft_cf2pdf_footer_button').click(function(e) {
    e.preventDefault();
    open_wp_media_frame('manusoft_cf2pdf_footer_url','manusoft_cf2pdf_footer_preview')
  });
});

function open_wp_media_frame(url_id, image_id) {
  var image_frame;
  if (image_frame) {
    image_frame.open();
  }
  image_frame = wp.media({
    title:'Seleccionar imagen',
    multiple:false,
    library: {
      type:'image',
    }
  });

  image_frame.on('close',function() {
    var selection = image_frame.state().get('selection');
    var id = "";
    selection.each(function(attachment) {
      id = attachment['id'];
    });
    manusoft_cf2pdf_refresh_image(id,url_id,image_id);
  });

  image_frame.on('open',function() {
    var selection = image_frame.state().get('selection');
    var ids = jQuery('input#'+url_id).val().split(',');
    ids.forEach(function(id) {
      var attachment = wp.media.attachment(id);
      attachment.fetch();
      selection.add(attachment ? [attachment] : []);
    });
  });

  image_frame.open();
}

function manusoft_cf2pdf_refresh_image(id,url_id,image_id) {
  var data = {
    action:'manusoft_cf2pdf_get_image',
    id:id
  };
  jQuery.get(ajaxurl,data,function(response) {
    if (response.success === true) {
      jQuery('#'+image_id).replaceWith(response.data.image);
      jQuery('input#'+url_id).val(response.data.url);
    } else {
      alert("Algo ha fallado");
    }
  });
}
