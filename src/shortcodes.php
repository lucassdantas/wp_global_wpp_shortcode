<?php 
defined(constant_name: 'ABSPATH') or die();

// Shortcode para exibir o link do Celular formatado
function glphsh_phone_link($atts) {
  $phone_number = get_option('glphsh_phone', '');
  $phone_number = preg_replace('/\D/', '', $phone_number); // Remove todos os caracteres não numéricos
  
  $atts = shortcode_atts([
      'text' => 'Olá, estive em seu site e gostaria de ajuda.'
  ], $atts, 'glphsh_phone_link');
  
  $encoded_text = urlencode($atts['text']);
  
  return esc_url("https://api.whatsapp.com/send/?phone=$phone_number&text=$encoded_text&type=phone_number&app_absent=0");
}
add_shortcode('glphsh_phone_link', 'glphsh_phone_link');

// Shortcode para exibir o número do WhatsApp no frontend
function glphsh_phone_number(){
  $wpp_number = get_option('glphsh_phone', '');
  return esc_html($wpp_number);
}
add_shortcode('glphsh_phone_number', 'glphsh_phone_number');

