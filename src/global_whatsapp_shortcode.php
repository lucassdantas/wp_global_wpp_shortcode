<?php 

//shortcode to show whatsapp on url formats
function ld_custom_whatsapp_link_shortcode($atts) {
  $phone_number = get_option('custom_whatsapp_phone', '');
  $phone_number = preg_replace('/\D/', '', $phone_number); // Remove todos os caracteres não numéricos
  
  $atts = shortcode_atts([
      'text' => 'Olá, estive em seu site e gostaria de ajuda.'
  ], $atts, 'whatsapp_link');
  
  $encoded_text = urlencode($atts['text']);
  
  return "https://api.whatsapp.com/send/?phone=$phone_number&text=$encoded_text&type=phone_number&app_absent=0";
}
add_shortcode('ld_whatsapp_link', 'ld_custom_whatsapp_link_shortcode');

//shortcode to show whatsapp on frontend
function ld_show_whatsapp_number(){
  $wpp_number = get_option('custom_whatsapp_phone', ' ');
  return esc_html($wpp_number);
}

add_shortcode('ld_show_whatsapp_number', 'ld_show_whatsapp_number');
