<?php
 
/**
 * custom option and settings
 */
function pswas_settings_init() {
    // Register a new setting for "pswas" page.
    register_setting( 'pswas', 'pswas_options' );
 

    // Register a new section in the "pswas" page.
    add_settings_section(
        'pswas_section_developers',
        __( 'PSWAS Setting Section', 'pswas' ), 'pswas_section_developers_callback',
        'pswas'
    );


    // Get the value of the settings
    $options = get_option( 'pswas_options' );


    // Register a new field in the "pswas_section_developers" section, inside the "pswas" page.
    add_settings_field(
      'pswas_select_style',
      __( 'Select Style', 'pswas' ),
      'pswas_select_style_cb',
      'pswas',
      'pswas_section_developers',
      array(
        'label_for'         => 'pswas_select_style',
        'class'             => 'pswas_row',
        'pswas_custom_data' => 'custom',
      )
    );


    // Register a new field in the "pswas_section_developers" section, inside the "pswas" page.
    if($options["pswas_select_style"] == "grid"){
      add_settings_field(
        'pswas_enable_masonry',
        __( 'Enable Masonry', 'pswas' ),
        'pswas_enable_masonry_cb',
        'pswas',
        'pswas_section_developers',
        array(
          'label_for'         => 'pswas_enable_masonry',
          'class'             => 'pswas_row',
          'pswas_custom_data' => 'custom',
        )
      );
    }


}
 
/**
 * Register our pswas_settings_init to the admin_init action hook.
 */
add_action( 'admin_init', 'pswas_settings_init' );

 
 
/**
 * Developers section callback function.
 *
 * @param array $args  The settings array, defining title, id, callback.
 */
function pswas_section_developers_callback( $args ) {
    ?>
    <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'In this setting section you can modify any option whatever you want.', 'pswas' ); ?></p>
    <?php
}
 
/**
 * Select Style callbakc function.
 *
 * WordPress has magic interaction with the following keys: label_for, class.
 * - the "label_for" key value is used for the "for" attribute of the <label>.
 * - the "class" key value is used for the "class" attribute of the <tr> containing the field.
 * Note: you can add custom key value pairs to be used inside your callbacks.
 *
 * @param array $args
 */

function pswas_select_style_cb( $args ) {
  // Get the value of the setting we've registered with register_setting()
  $options = get_option( 'pswas_options' );
  
  ?>
    <select
      id="<?php echo esc_attr( $args['label_for'] ); ?>"
      data-custom="<?php echo esc_attr( $args['pswas_custom_data'] ); ?>"
      name="pswas_options[<?php echo esc_attr( $args['label_for'] ); ?>]">

      <option
        value="grid"
        <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'grid', false ) ) : ( '' ); ?>>
      <?php esc_html_e( 'Grid', 'pswas' ); ?></option>

      <option
        value="carousel"
        <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'carousel', false ) ) : ( '' ); ?>>
          <?php esc_html_e( 'Carousel', 'pswas' ); ?></option>
    </select>

    <p class="description">
        <?php esc_html_e( '', 'pswas' ); ?>
    </p>

  <?php
}


/**
 * Eanble Masonry callbakc function.
 */
function pswas_enable_masonry_cb( $args ) {
  // Get the value of the setting we've registered with register_setting()
  $options = get_option( 'pswas_options' );
  
  ?>
    <input
      type="checkbox"
      id="<?php echo esc_attr( $args['label_for'] ); ?>"
      name="pswas_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
      value="1"
      <?php echo isset( $options[ $args['label_for'] ] ) ? ( checked( $options[ $args['label_for'] ], '1', false ) ) : ( '' ); ?>/>
      <label for="<?php echo esc_attr( $args['label_for'] ); ?>">Yes / No</label>

    <p class="description">
        <?php esc_html_e( '', 'pswas' ); ?>
    </p>

  <?php
}





/**
 * Add the top level menu page.
 */
function pswas_options_page() {
    add_menu_page(
        'Post show with any style',
        'PSWAS Options',
        'manage_options',
        'pswas',
        'pswas_options_page_html'
    );
}
add_action( 'admin_menu', 'pswas_options_page' );



/**
 * Top level menu callback function
 */
function pswas_options_page_html() {
  // check user capabilities
  if ( ! current_user_can( 'manage_options' ) ) {
      return;
  }

  // add error/update messages

  // check if the user have submitted the settings

  // WordPress will add the "settings-updated" $_GET parameter to the url
  
  if ( isset( $_GET['settings-updated'] ) ) {
      // add settings saved message with the class of "updated"
      add_settings_error( 'pswas_messages', 'pswas_message', __( 'Settings Saved', 'pswas' ), 'updated' );
  }

  // show error/update messages
  settings_errors( 'pswas_messages' );

  ?>


  <div class="wrap">
      <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
      <form action="options.php" method="post">
          <?php
            // output security fields for the registered setting "pswas"
            settings_fields( 'pswas' );
            
            // output setting sections and their fields
            // (sections are registered for "pswas", each field is registered to a specific section)
            do_settings_sections( 'pswas' );
            
            // output save settings button
            submit_button( 'Save Settings' );
          ?>
      </form>
  </div>
  <?php
}