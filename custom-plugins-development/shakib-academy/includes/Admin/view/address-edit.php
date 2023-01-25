<div class="wrap">
  <h1 class="wp-heading-inline"><?php _e('Edit Address', SK_ACADEMY_TEXTDOMAIN); ?></h1>

  <?php if( isset( $_GET['updated'] ) ) { ?>
    <div class="notice notice-success is-dismissible">
      <p><?php _e( 'Address has been updated successfully!', SK_ACADEMY_TEXTDOMAIN ); ?></p>
    </div>
  <?php } ?>

  <form action="" method="post">
    <table class="form-table">
      <tbody>
        <tr class="row <?php echo $this->has_error( 'name' ) ? 'form-invalid' : ''; ?>">
          <th scope="row">
            <label for="name"><?php _e('Name*', SK_ACADEMY_TEXTDOMAIN); ?></label>
          </th>
          <td>
            <input type="text" name="name" id="name" class="regular-text" value="<?php echo esc_attr( $address->name ); ?>">

            <?php if ( $this->has_error( 'name' ) ): ?>
              <p clsass="description error"><?php _e( $this->get_error( 'name' ), SK_ACADEMY_TEXTDOMAIN ); ?></p>
            <?php endif; ?>
          </td>
        </tr>

        <tr class="row <?php echo $this->has_error( 'name' ) ? 'form-invalid' : ''; ?>">
          <th scope="row">
            <label for="phone"><?php _e('Phone*', SK_ACADEMY_TEXTDOMAIN); ?></label>
          </th>
          <td>
            <input type="text" name="phone" id="phone" class="regular-text" value="<?php echo esc_attr( $address->phone ); ?>">

            <?php if ( $this->has_error( 'phone' ) ): ?>
              <p clsass="description error"><?php _e( $this->get_error( 'phone' ), SK_ACADEMY_TEXTDOMAIN ); ?></p>
            <?php endif; ?>
          </td>
        </tr>

        <tr>
          <th scope="row">
            <label for="address"><?php _e('Address', SK_ACADEMY_TEXTDOMAIN); ?></label>
          </th>
          <td>
            <textarea name="address" id="address" class="regular-text"><?php echo esc_textarea( $address->address ); ?></textarea>
          </td>
        </tr>
      </tbody>
    </table>

    <input type="hidden" name="id" value="<?php echo esc_attr( $address->id ); ?>">
    <?php wp_nonce_field('new-address'); ?>
    <?php submit_button(__('Save Changes', SK_ACADEMY_TEXTDOMAIN), 'primary', 'submit_address'); ?>
  </form>
</div>