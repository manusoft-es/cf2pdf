<?php
defined('ABSPATH') or die('No tienes permiso para hacer eso.');

function manusoft_cf2pdf_before_send_mail( $form_tag ) {
  global $wpdb;
  $table_name = $wpdb->prefix.'manusoft_cf2pdf_data';
  $form = WPCF7_Submission::get_instance();
  if ($form) {
    $black_list = array(
                        '_wpcf7',
                        '_wpcf7_version',
                        '_wpcf7_locale',
                        '_wpcf7_unit_tag',
                        '_wpcf7_is_ajax_call','cfdb7_name',
                        '_wpcf7_container_post',
                        '_wpcf7cf_hidden_group_fields',
                        '_wpcf7cf_hidden_groups',
                        '_wpcf7cf_visible_groups',
                        '_wpcf7cf_options',
                        'g-recaptcha-response'
                      );
    $data = $form->get_posted_data();
    $form_data = array();
    $form_data['manusoft_cf2pdf_status'] = 'unread';
    foreach ($data as $key => $d) {
      if (!in_array($key,$black_list)) {
        $tmpD = $d;
        if (!is_array($d)) {
          $bl   = array('\"',"\'",'/','\\','"',"'");
          $wl   = array('&quot;','&#039;','&#047;', '&#092;','&quot;','&#039;');
          $tmpD = str_replace($bl, $wl, $tmpD );
        }
        $form_data[$key] = $tmpD;
      }
    }

    $form_post_id = $form_tag->id();
    $form_value   = serialize( $form_data );
    $form_date    = current_time('Y-m-d H:i:s');

    $data = array (
      'form_post_id' => $form_post_id,
      'form_value' => $form_value,
      'form_date' => $form_date
    );
    $wpdb->insert($table_name,$data);
  }
}
add_action('wpcf7_before_send_mail','manusoft_cf2pdf_before_send_mail');
?>
