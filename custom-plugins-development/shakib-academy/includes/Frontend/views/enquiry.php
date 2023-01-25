<div class="sk-enquiry-wrap" id="sk-enquiry-form">
  <h2>Shakib Academy Enquiry Form</h2>

  <form action="" method="post">

    <div class="form-row">
      <label for="name"><?php _e( 'Name', SK_ACADEMY_TEXTDOMAIN ); ?></label>
      <input type="text" name="name" id="name" value="" required>
    </div>

    <div class="form-row">
      <label for="email"><?php _e( 'E-mail', SK_ACADEMY_TEXTDOMAIN ); ?></label>
      <input type="email" name="email" id="email" value="" required>
    </div>

    <div class="form-row">
      <label for="message"><?php _e( 'Name', SK_ACADEMY_TEXTDOMAIN ); ?></label>
      <textarea name="message" id="message" required></textarea>
    </div>

    <div class="form-row">
      <?php wp_nonce_field( 'sk-enquiry-form' ); ?>
      <input type="hidden" name="action" value="sk_enquiry_action">
      <input type="submit" name="send_enquiry" value="<?php esc_attr_e( 'Send Enquiry', SK_ACADEMY_TEXTDOMAIN ); ?>">
    </div>
  </form>
</div>