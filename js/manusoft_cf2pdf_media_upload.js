jQuery(document).ready( function($) {
  jQuery('input#manusoft_cf2pdf_upload_image_button').click(function(e) {
    e.preventDefault();
    var image_frame;
    if(image_frame){
      image_frame.open();
    }
    image_frame = wp.media({
      title: 'Select Media',
      multiple : false,
      library : {
        type : 'image',
      }
    });

    image_frame.on('close',function() {
      var selection =  image_frame.state().get('selection');
      var id = "";
      selection.each(function(attachment) {
        id = attachment['id'];
      });
      manusoft_cf2pdf_refresh_image(id);
    });

    image_frame.on('open',function() {
      var selection =  image_frame.state().get('selection');
      var ids = jQuery('input#manusoft_cf2pdf_upload_image').val().split(',');
      ids.forEach(function(id) {
        var attachment = wp.media.attachment(id);
        attachment.fetch();
        selection.add( attachment ? [ attachment ] : [] );
      });
    });

    image_frame.open();
  });
});

function manusoft_cf2pdf_refresh_image(the_id) {
  var data = {
    action: 'manusoft_cf2pdf_get_image',
    id: the_id
  };
  jQuery.get(ajaxurl, data, function(response) {
    if(response.success === true) {
      jQuery('#manusoft_cf2pdf_preview_header').replaceWith(response.data.image);
      jQuery('input#manusoft_cf2pdf_upload_image').val(response.data.url);
    }
  });
}
