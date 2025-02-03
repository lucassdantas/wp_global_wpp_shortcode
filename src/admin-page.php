<?php 
defined(constant_name: 'ABSPATH') or die();

function glphsh_settings_page() {
  add_menu_page(
      'Configuração do Celular',
      'Celular Shortcode',
      'manage_options',
      'global-phone-settings',
      'glphsh_settings_page_html',
      'dashicons-whatsapp',
      20
  );
}
add_action('admin_menu', 'glphsh_settings_page');

function glphsh_settings_page_html() {
  if (!current_user_can('manage_options')) return;

  // Verifica se o formulário foi enviado e valida o nonce
  if (isset($_POST['glphsh_phone']) && check_admin_referer('glphsh_save_settings', 'glphsh_nonce')) {
      $sanitized_phone = sanitize_text_field(wp_unslash($_POST['glphsh_phone']));
      update_option('glphsh_phone', $sanitized_phone);
      echo '<div class="updated"><p>Número atualizado com sucesso!</p></div>';
  }
  
  $phone_number = get_option('glphsh_phone', '');
  ?>
  <div class="wrap">
      <h1>Configuração do Celular</h1>
      <form method="post">
          <?php wp_nonce_field('glphsh_save_settings', 'glphsh_nonce'); ?>
          <label for="glphsh_phone">Número do Celular:</label>
          <input type="text" id="glphsh_phone" name="glphsh_phone" value="<?php echo esc_attr($phone_number); ?>" />
          <button type="submit" class="button button-primary">Salvar</button>
      </form>
      
      <hr>
      <h2>Como utilizar esse plugin?</h2>
      <p>Nas URLs, utilize o shortcode <code>[glphsh_phone_link]</code> para exibir apenas o número do Celular, sem espaço e outros caracteres. <br>
          Esse shortcode possui o parâmetro <code>text</code> para inserir uma mensagem para Whatsapp diferente da padrão, que é "Olá, estive em seu site e gostaria de ajuda."
          Para modificar o texto, utilize <code>[glphsh_phone_link text='seu texto aqui']</code>.
      </p>
      <p>Nos textos, utilize o shortcode <code>[glphsh_phone_number]</code> para exibir o número da forma como você escreveu no input acima.</p>
      <hr> 
      <h2>💙 Apoie este projeto!</h2>
      <p>Se você gosta deste plugin e quer ajudar no seu desenvolvimento, considere apoiar com qualquer valor:</p>
      <p><a href="https://apoia.se/dev_dantas" target="_blank" class="button button-secondary">Apoiar no Apoia.se</a></p>
  </div>
  <?php
}
?>
