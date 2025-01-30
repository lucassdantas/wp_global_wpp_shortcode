<?php 
function custom_whatsapp_settings_page() {
  add_menu_page(
      'Configuração do WhatsApp',
      'WhatsApp Shortcode',
      'manage_options',
      'custom-whatsapp-settings',
      'custom_whatsapp_settings_page_html',
      'dashicons-whatsapp',
      20
  );
}
add_action('admin_menu', 'custom_whatsapp_settings_page');

function custom_whatsapp_settings_page_html() {
  if (!current_user_can('manage_options')) return;

  // Verifica se o formulário foi enviado e valida o nonce
  if (isset($_POST['custom_whatsapp_phone']) && check_admin_referer('custom_whatsapp_save_settings', 'custom_whatsapp_nonce')) {
      $sanitized_phone = sanitize_text_field(wp_unslash($_POST['custom_whatsapp_phone']));
      update_option('custom_whatsapp_phone', $sanitized_phone);
      echo '<div class="updated"><p>Número atualizado com sucesso!</p></div>';
  }
  
  $phone_number = get_option('custom_whatsapp_phone', '');
  ?>
  <div class="wrap">
      <h1>Configuração do WhatsApp</h1>
      <form method="post">
          <?php wp_nonce_field('custom_whatsapp_save_settings', 'custom_whatsapp_nonce'); ?>
          <label for="custom_whatsapp_phone">Número do WhatsApp:</label>
          <input type="text" id="custom_whatsapp_phone" name="custom_whatsapp_phone" value="<?php echo esc_attr($phone_number); ?>" />
          <button type="submit" class="button button-primary">Salvar</button>
      </form>
      
      <hr>
      <h2>Como utilizar esse plugin?</h2>
      <p>Nas URLs, utilize o shortcode <code>[ld_whatsapp_link]</code> para exibir apenas o número do WhatsApp, sem espaço e outros caracteres. <br>
          Esse shortcode possui o parâmetro <code>text</code> para inserir uma mensagem diferente da padrão, que é "Olá, estive em seu site e gostaria de ajuda."
          Para modificar o texto, utilize <code>[ld_whatsapp_link text='seu texto aqui']</code>.
      </p>
      <p>Nos textos, utilize o shortcode <code>[ld_show_whatsapp_number]</code> para exibir o número da forma como você escreveu no input acima.</p>
      <hr> 
      <h2>💙 Apoie este projeto!</h2>
      <p>Se você gosta deste plugin e quer ajudar no seu desenvolvimento, considere apoiar com qualquer valor:</p>
      <p><a href="https://apoia.se/dev_dantas" target="_blank" class="button button-secondary">Apoiar no Apoia.se</a></p>
  </div>
  <?php
}
?>
