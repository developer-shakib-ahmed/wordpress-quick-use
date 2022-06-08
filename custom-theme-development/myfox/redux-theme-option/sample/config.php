<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "redux_demo";


    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /*
     *
     * --> Action hook examples
     *
     */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');


    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( '' ),//Version
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'MyFox', 'redux-framework-demo' ),
        'page_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => 35,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => 'http://irahul.xyz/myfox/wp-content/themes/myfox/img/Landing_page/heart.png',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => 'zboom_options',
        // Page slug used to denote the panel
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'system_info'          => false,
        // REMOVE

        //'compiler'             => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => __( 'Documentation', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => __( 'Support', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => __( 'Extensions', 'redux-framework-demo' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    // $args['share_icons'][] = array(
    //     'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
    //     'title' => 'Visit us on GitHub',
    //     'icon'  => 'el el-github'
    //     //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    // );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/md.shakibahmedrahul',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    // $args['share_icons'][] = array(
    //     'url'   => 'http://www.linkedin.com/company/redux-framework',
    //     'title' => 'Find us on LinkedIn',
    //     'icon'  => 'el el-linkedin'
    // );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '', 'redux-framework-demo' ), $v );
    } else {
        $args['intro_text'] = __( '', 'redux-framework-demo' );
    }

    // Add content after the form.
    $args['footer_text'] = __( '', 'redux-framework-demo' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    // -> START Basic Fields

    Redux::setSection( $opt_name, array(
        'title' => __( 'General Settings', 'redux-framework-demo' ),
        'id'    => 'g_settings',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-home',
        'fields'=> array(
            array(
                'id'       => 'body_background',
                'type'     => 'background',
                'output'   => array( 'body' ),
                'title'    => __( 'Body Background', 'redux-framework-demo' ),
                'subtitle' => __( 'Body background with image, color, etc.', 'redux-framework-demo' ),
                'default'   => '#FFFFFF',
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __( 'Logo Uploads', 'redux-framework-demo' ),
        'id'    => 'logo',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-picture'
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Main Logo', 'redux-framework-demo' ),
        'id'         => 'logo-main',
        'desc'       => __( '', 'redux-framework-demo' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'logo_upload',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Upload Logo', 'redux-framework-demo' ),
                'compiler' => 'true',
                //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc'     => __( '', 'redux-framework-demo' ),
                'subtitle' => __( 'Upload any media using the WordPress native uploader', 'redux-framework-demo' ),
                'default'  => array( 'url' => get_template_directory_uri().'/img/Landing_page/logo.png' ),
                //'hint'      => array(
                //    'title'     => 'Hint Title',
                //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                //)
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Fixed Logo', 'redux-framework-demo' ),
        'id'         => 'logo-fixed',
        'desc'       => __( '', 'redux-framework-demo' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'logo_upload2',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Upload Logo', 'redux-framework-demo' ),
                'compiler' => 'true',
                //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc'     => __( '', 'redux-framework-demo' ),
                'subtitle' => __( 'Upload any media using the WordPress native uploader', 'redux-framework-demo' ),
                'default'  => array( 'url' => get_template_directory_uri().'/img/TheFox/stick_logo.png' ),
                //'hint'      => array(
                //    'title'     => 'Hint Title',
                //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                //)
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'      => __( 'Layouts', 'redux-framework-demo' ),
        'id'         => 'blog_layout',
        'desc'       => __( '', 'redux-framework-demo' ),
        'subsection' => false,
        'icon'       => 'el el-list-alt',
        'fields'     => array(
            array(
                'id'       => 'blog_layouts',
                'type'     => 'image_select',
                'title'    => __( 'Layout Options for Blog Page', 'redux-framework-demo' ),
                'subtitle' => __( 'No validation can be done on this field type', 'redux-framework-demo' ),
                'desc'     => __( 'This uses some of the built in images, you can use them for layout options.', 'redux-framework-demo' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => 'Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '2' => array(
                        'alt' => 'Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    ),
                ),
                'default'  => '1'
            ),
        )
    ) );






    Redux::setSection( $opt_name, array(
        'id'     => 'style-css',
        'title'  => __( 'Custom CSS', 'redux-framework-demo' ),
        'icon'     => 'el el-edit',
        'desc'   => __( '', 'redux-framework-demo' ),
        'subsection' => false,
        'fields' => array(
            array(
                'id'       => 'custom_css',
                'type'     => 'ace_editor',
                'title'    => 'Custome Style',
                'subtitle' => __( 'Do you want change this default style? Yes, you can type here and customize you site also.', 'redux-framework-demo' ),
                'desc'     => __( 'You may add some css codes if you don\'t want to edit your style.css' , 'redux-framework-demo' ),
                'mode'     => 'css',
            ),            
            array(
                'id'   => 'opt-divide1',
                'type' => 'divide'
            ),
            array(
                'id'       => 'link_color',
                'type'     => 'link_color',
                'title'    => __( 'Links Color Option', 'redux-framework-demo' ),
                'subtitle' => __( 'Only color validation can be done on this field type', 'redux-framework-demo' ),
                'desc'     => __( 'This is the description field, again good for additional info.', 'redux-framework-demo' ),
                //'regular'   => false, // Disable Regular Color
                //'hover'     => false, // Disable Hover Color
                //'active'    => false, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                'default'  => array(
                    'regular' => '#aaa',
                    'hover'   => '#bbb',
                    'active'  => '#ccc',
                )
            ),            
            array(
                'id'   => 'opt-divide2',
                'type' => 'divide'
            ),
        )
    ) );


    // -> START  Button Set Sections
    Redux::setSection( $opt_name, array(
        'title' => __( 'Button Options', 'redux-framework-demo' ),
        'id'    => 'button',
        'icon'  => 'el el-cogs'
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __( 'Button Selections', 'redux-framework-demo' ),
        'id'    => 'button_select',
        'desc'  => __( '', 'redux-framework-demo' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'button_selects',
                'type'     => 'button_set',
                'title'    => __( 'Button Select', 'redux-framework-demo' ),
                'subtitle' => __( 'No validation can be done on this field type', 'redux-framework-demo' ),
                'desc'     => __( 'This is the description field, again good for additional info.', 'redux-framework-demo' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    'learn-more'    => 'LEARN MORE',
                    'load-more'     => 'LOAD MORE',
                    'quick-list'    => 'QUICK LIST',
                    'select-demo'   => 'SELECT DEMO',
                ),
                'default'  => 'learn-more'
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __( 'Learn More', 'redux-framework-demo' ),
        'id'    => 'learn_more',
        'desc'  => __( '', 'redux-framework-demo' ),
        'subsection' => true,
        'fields'     => array(                       
            array(
                'id'       => 'text',
                'type'     => 'text',
                'title'    => __( 'Button Name', 'redux-framework-demo' ),
                'subtitle' => __( 'This must be a Button Name.', 'redux-framework-demo' ),
                'desc'     => __( 'This is the description field, again good for additional info.', 'redux-framework-demo' ),
                'validate' => '',
                'default'  => 'Defualt Text',
            ),           
            array(
                'id'       => 'image',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Button Image', 'redux-framework-demo' ),
                'compiler' => 'true',
                //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc'     => __( '', 'redux-framework-demo' ),
                'subtitle' => __( 'Upload any media using the WordPress native uploader', 'redux-framework-demo' ),
                'default'  => array( 'url' => get_template_directory_uri().'/img/Landing_page/file_plus.png' ),
                //'hint'      => array(
                //    'title'     => 'Hint Title',
                //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                //)
            ),array(
                'id'       => 'border_style',
                'type'     => 'border',
                'title'    => __( 'Button Border Option', 'redux-framework-demo' ),
                'subtitle' => __( 'No validation can be done on this field type', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'output'   => array( '.solid_background .learn_btn a' ),
                // An array of CSS selectors to apply this font style to
                'desc'     => __( 'This is the description field, again good for additional info.', 'redux-framework-demo' ),
                'default'  => array(
                    'border-color'  => '#ddd',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                ),
            ),
            array(
                'id'       => 'lmb_text_color',
                'type'     => 'color',
                'title'    => __( 'Button Text Color', 'redux-framework-demo' ),
                'subtitle' => __( 'Pick a Text color for the footer (default: #FFFFFF).', 'redux-framework-demo' ),
                'default'  => '#FFFFFF',
                'validate' => 'color',
            ),
            array(
                'id'       => 'lmb_background_color',
                'type'     => 'color',
                'title'    => __( 'Button Background Color', 'redux-framework-demo' ),
                'subtitle' => __( 'Pick a background color for the footer (default: transparent).', 'redux-framework-demo' ),
                'default'  => 'transparent',
                'validate' => 'color',
            ),            
            array(
                'id'   => 'opt-required-divide-1',
                'type' => 'divide'
            ), 
            array(
                'id'       => 'hover_border_style',
                'type'     => 'border',
                'title'    => __( 'Button Hover Border Option', 'redux-framework-demo' ),
                'subtitle' => __( 'No validation can be done on this field type', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'output'   => array( '.solid_background .learn_btn a:hover' ),
                // An array of CSS selectors to apply this font style to
                'desc'     => __( 'This is the description field, again good for additional info.', 'redux-framework-demo' ),
                'default'  => array(
                    'border-color'  => '#222',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                ),
            ),
            array(
                'id'       => 'lmbh_text_color',
                'type'     => 'color',
                'title'    => __( 'Button Hover Text Color', 'redux-framework-demo' ),
                'subtitle' => __( 'Pick a Text color for the footer (default: #FFFFFF).', 'redux-framework-demo' ),
                'default'  => '#FFFFFF',
                'validate' => 'color',
            ),
            array(
                'id'       => 'lmbh_background_color',
                'type'     => 'color',
                'title'    => __( 'Button Hover Background Color', 'redux-framework-demo' ),
                'subtitle' => __( 'Pick a background color for the footer (default: #222222).', 'redux-framework-demo' ),
                'default'  => '#222222',
                'validate' => 'color',
            ),
        )
    ) );




    // -> START Footer Options Sections
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Footer Options', 'redux-framework-demo' ),
        'id'     => 'footer',
        'desc'   => __( '', 'redux-framework-demo' ),
        'subsection' => false,
        'icon'     => 'el el-tint',
        'fields' => array(
            array(
                'id'       => 'years',
                'type'     => 'text',
                'title'    => __( 'Years', 'redux-framework-demo' ),
                'subtitle' => __( '' ),
                'desc'     => __( 'This is the description field, again good for additional info.', 'redux-framework-demo' ),
                'validate' => '',
                'default'  => '2016',
            ),            
            array(
                'id'   => 'opt-divide-1',
                'type' => 'divide'
            ),
            array(
                'id'       => 'company_name',
                'type'     => 'text',
                'title'    => __( 'Company Name', 'redux-framework-demo' ),
                'subtitle' => __( '' ),
                'desc'     => __( 'This is the description field, again good for additional info.', 'redux-framework-demo' ),
                'validate' => '',
                'default'  => 'Company',
            ),
            array(
                'id'       => 'company_url',
                'type'     => 'text',
                'title'    => __( 'Company URL', 'redux-framework-demo' ),
                'subtitle' => __( '' ),
                'desc'     => __( 'This is the description field, again good for additional info.', 'redux-framework-demo' ),
                'validate' => 'url',
                'default'  => 'http://myfox.com',
            ),            
            array(
                'id'   => 'opt-divide-2',
                'type' => 'divide'
            ),
            array(
                'id'       => 'designer_name',
                'type'     => 'text',
                'title'    => __( 'Designer Name', 'redux-framework-demo' ),
                'subtitle' => __( '' ),
                'desc'     => __( 'This is the description field, again good for additional info.', 'redux-framework-demo' ),
                'validate' => '',
                'default'  => 'Designer',
            ),
            array(
                'id'       => 'designer_url',
                'type'     => 'text',
                'title'    => __( 'Designer URL', 'redux-framework-demo' ),
                'subtitle' => __( '' ),
                'desc'     => __( 'This is the description field, again good for additional info.', 'redux-framework-demo' ),
                'validate' => 'url',
                'default'  => 'http://designer.com',
            ),            
            array(
                'id'   => 'opt-divide-3',
                'type' => 'divide'
            ),
        )
    ) );


    // -> START Social Icons Sections
    Redux::setSection( $opt_name, array(
        'icon'            => 'el el-leaf',
        'title'           => __( 'Social Icons', 'redux-framework-demo' ),
        'desc'            => __( '<p class="description">This Section should be visible only in Customizer</p>', 'redux-framework-demo' ),
        'fields'          => array(
            array(
                'id'              => 'social_icons',
                'type'            => 'text',
                'title'           => __( 'Social Icons List', 'redux-framework-demo' ),
                'subtitle'        => __( '', 'redux-framework-demo' ),
                'desc'            => __( 'This Section should be visible only in Customizer.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'         => array(
                    '1' => 'Facebook',
                    '2' => 'Twitter',
                    '3' => 'Google Plus',
                    '4' => 'LinkedIn',
                    '5' => 'Instagram',
                    '6' => 'Dribbble',
                    '7' => 'RSS',
                ),
            ),
        )
    ) );


    // -> START Custom Post Category Sections
    Redux::setSection( $opt_name, array(
        'icon'            => 'el el-pencil',
        'title'           => __( 'Post Categories', 'redux-framework-demo' ),
        'desc'            => __( '', 'redux-framework-demo' ),
        'fields'          => array(
            array(
                'id'       => 'cat_select',
                'type'     => 'select',
                'data'     => 'category',
                'title'    => __( 'Select A Post Categories', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
            ),
        )
    ) );


    // -> START Customizer Only Sections
    Redux::setSection( $opt_name, array(
        'icon'            => 'el el-list-alt',
        'title'           => __( 'Customizer Only', 'redux-framework-demo' ),
        'desc'            => __( '<p class="description">This Section should be visible only in Customizer</p>', 'redux-framework-demo' ),
        'customizer_only' => true,
        'fields'          => array(
            array(
                'id'              => 'opt-customizer-only',
                'type'            => 'select',
                'title'           => __( 'Customizer Only Option', 'redux-framework-demo' ),
                'subtitle'        => __( 'The subtitle is NOT visible in customizer', 'redux-framework-demo' ),
                'desc'            => __( 'The field desc is NOT visible in customizer.', 'redux-framework-demo' ),
                'customizer_only' => true,
                //Must provide key => value pairs for select options
                'options'         => array(
                    '1' => 'Opt 1',
                    '2' => 'Opt 2',
                    '3' => 'Opt 3',
                    '3' => 'Opt 3',
                    '3' => 'Opt 3',
                    '3' => 'Opt 3'
                ),
                'default'         => '2'
            ),
        )
    ) );
/* ==========================================================================
    END ALL KIND OF REDUX SECTIONS HERE.... 
========================================================================== */



    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => __( 'Documentation', 'redux-framework-demo' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content'  => file_get_contents( dirname( __FILE__ ) . '/../README.md' )
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    function compiler_action( $options, $css, $changed_values ) {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r( $changed_values ); // Values that have changed since the last save
        echo "</pre>";
        //print_r($options); //Option values
        //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    function dynamic_section( $sections ) {
        //$sections = array();
        $sections[] = array(
            'title'  => __( 'Section via hook', 'redux-framework-demo' ),
            'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
            'icon'   => 'el el-paper-clip',
            // Leave this as a blank section, no options just some intro text set above.
            'fields' => array()
        );

        return $sections;
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    function change_arguments( $args ) {
        //$args['dev_mode'] = true;

        return $args;
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    function change_defaults( $defaults ) {
        $defaults['str_replace'] = 'Testing filter hook!';

        return $defaults;
    }

    // Remove the demo link and the notice of integrated demo from the redux-framework plugin
    function remove_demo() {

        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }