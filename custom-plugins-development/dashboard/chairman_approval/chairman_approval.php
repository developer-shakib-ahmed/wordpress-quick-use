<?php

#--------------- Add Chairman Role ----------------#
add_role( 'chairman', 'Chairman', array( 'read' => true ));
#--------------- Add Chairman Role ----------------#


#--------------- Add Approval Menu ----------------#
function chairman_submenu_add(){
    
    $Admin = current_user_can( 'manage_options' );
    $Chairman = current_user_can( 'chairman' );
    
    if( $Admin or $Chairman ){
        add_menu_page( 'Chairman Approval', 'Approval', 'read', 'chairman-approval', 'chairman_submenu_callback', 'dashicons-thumbs-up', 4 );       
    }

    // Callback
    function chairman_submenu_callback(){
    ?>
    <div class="wrap">
        <h1 style="margin-bottom: 15px;" class="wp-heading-inline">চেয়ারম্যান অনুমোদন</h1>
        <?php echo $roles; ?>
        <table id="approveWait" class="wp-list-table widefat fixed striped posts">
            <thead>
                <tr>
                    <th style="width: 40px;" id="" class="manage-column">No</th>
                    <th style="" id="" class="manage-column">অনুমোদনের নাম</th>
                    <th style="" id="" class="manage-column">অনুমোদনের ধরণ</th>
                    <th style="" id="" class="manage-column">অনুমোদন</th>
                </tr>
            </thead>
            <tbody id="the-list">
                <?php
                    $No = 0;
                    $Posts = get_posts(array(
                        'post_type'      => array( 'post', 'citizen', 'tradelicense', 'oarish', 'otherservice', 'deathcertificate', 'cc', 'unmarried', 'landless', 'reconstructed', 'annualincome', 'samename', 'disability', 'religion', 'permit', 'capp', 'fdomfighter', 'fighteradopted', 'lowincome', 'tc_app' ),
                        'posts_per_page' => -1,
                        'post_status' => 'pending',
                        'meta_key'       => 'approve_key',
                        'meta_value'     => 'Approved',
                        'meta_compare'   => 'NOT EXISTS',
                    ));
                ?>
                <?php if( ! empty($Posts)) : ?>
                    <?php 
                        foreach ($Posts as $post) :
                        $No++;
                        $ID = $post->ID;
                        $approved = get_post_meta( $ID, 'approve_key', true );
                    ?>
                    <tr id="post-<?php echo $ID; ?>">
                        <td><?php echo ( $No < 10 ) ? '0'.$No : $No; ?></td>
                        <td>
                            <b><?php echo $post->post_title; ?></b>
                            <br><?php echo $approved; ?>
                        </td>
                        <td>
                            <?php
                                $PostType = $post->post_type;
                                switch( $PostType ){
                                    case 'citizen':
                                        echo 'নাগরিক সনদ';
                                        break;
                                    case 'tradelicense':
                                        echo 'ট্রেড লাইসেন্স';
                                        break;
                                    case 'oarish':
                                        echo 'ওয়ারিশ কায়েম সার্টিফিকেট';
                                        break;
                                    case 'otherservice':
                                        echo 'অন্যান্য সনদ';
                                        break;
                                    case 'deathcertificate':
                                        echo 'মৃত্যু সনদ';
                                        break;
                                    case 'cc':
                                        echo 'চারিত্রিক সনদ';
                                        break;
                                    case 'unmarried':
                                        echo 'অবিবাহিত সনদ';
                                        break;
                                    case 'landless':
                                        echo 'ভূমিহীন সনদ';
                                        break;
                                    case 'reconstructed':
                                        echo 'পুনঃ বিবাহ না হওয়া সনদ';
                                        break;
                                    case 'annualincome':
                                        echo 'বার্ষিক আয়ের সনদ';
                                        break;
                                    case 'samename':
                                        echo 'একই নামের প্রত্যয়নের সনদ';
                                        break;
                                    case 'disability':
                                        echo 'প্রতিবন্ধী প্রত্যয়নের সনদ';
                                        break;
                                    case 'religion':
                                        echo 'সনাতন ধর্মাবলম্বী সনদ';
                                        break;
                                    case 'permit':
                                        echo 'অনুমতি পত্র সনদ';
                                        break;
                                    case 'capp':
                                        echo 'প্রত্যয়ন পত্র সনদ';
                                        break;
                                    case 'fdomfighter':
                                        echo 'মুক্তিযোদ্ধা সনদ';
                                        break;
                                    case 'fighteradopted':
                                        echo 'মুক্তিযোদ্ধা পোষ্য সনদ';
                                        break;
                                    case 'lowincome':
                                        echo 'স্বল্প আয়ের প্রত্যয়নপত্রের সনদ';
                                        break;
                                    case 'tc_app':
                                        echo 'স্থানান্তর প্রত্যয়নপত্রের সনদ';
                                        break;
                                    default:
                                        echo ucwords($PostType);
                                }
                            ?>
                        </td>
                        <td>
                            <button class="button button-primary btnApprove" type="<?php echo $post->post_type; ?>" id="<?php echo $ID; ?>">Approved</button>
                            <span class="spinner"></span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr id="post-no">
                        <td colspan="2" style="color:#e74c3c; font-style:italic; font-weight:bold;">No Post Was Found!</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th style="width: 40px;" id="" class="manage-column">No</th>
                    <th style="" id="" class="manage-column">অনুমোদনের নাম</th>
                    <th style="" id="" class="manage-column">অনুমোদনের ধরণ</th>
                    <th style="" id="" class="manage-column">অনুমোদন</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <?php
    }

}
add_action( 'admin_menu', 'chairman_submenu_add' );
#--------------- Add Approval Menu ----------------#


#--------------- scripts register ----------------#
function chairman_approve_scripts(){
    wp_enqueue_script( 'approve-script', PLUGIN_URL . '/chairman_approval/chairman_approval.js', array('jquery'), '1.0', true );
    wp_localize_script( 'approve-script', 'approve_url', admin_url( 'admin-ajax.php' ) );
}
add_action( 'admin_enqueue_scripts', 'chairman_approve_scripts' );
#--------------- scripts register ----------------#


#--------------- Add Approval Ajax Action ----------------#
function chairman_approve_action(){

    $id = '';
    if(isset($_GET['id']))
        $id = sanitize_text_field( $_GET['id'] );

    add_post_meta( $id, 'approve_key', 'Approved', true );

    wp_die();
}
add_action( 'wp_ajax_approve', 'chairman_approve_action' );
add_action( 'wp_ajax_nopriv_approve', 'chairman_approve_action' );
#--------------- Add Approval Ajax Action ----------------#


#--------------- Add Approval Admin Column ----------------#
function chairman_approval_column_add(){

    $currentScreen = get_current_screen();
    $currentPostType = $currentScreen->post_type;
    
    function add_post_chairman_approve_column( $columns ){
        $approve_column = array();
        foreach($columns as $key => $date) {
            if ($key=='date'){
                $approve_column['chairman_approve'] = __( 'Approved' );
            }
            $approve_column[$key] = $date;
        }
        return $approve_column;
    }

    function display_post_chairman_approve_column( $column_name, $post_id ){
        switch($column_name){
            case 'chairman_approve':
                $approved = get_post_meta( $post_id, 'approve_key', true );
                if($approved){
                    echo '<strong id="approved" style="color:green;">'.$approved.'</strong>';
                }else{
                    echo '<strong id="unapproved" style="color:red;">Unapproved</strong>';
                }
            break;
        }
    }
    
    if( $currentPostType != 'post' && $currentPostType != 'ditty_news_ticker' ){
        add_action('manage_posts_custom_column', 'display_post_chairman_approve_column', 5, 2);
        add_filter('manage_posts_columns', 'add_post_chairman_approve_column', 5);
    }
}
add_action( 'admin_head', 'chairman_approval_column_add' );
#--------------- Add Approval Admin Column ----------------#


#--------------- Add Print Column ----------------#
function author_print_btn_column_add(){

    $currentScreen = get_current_screen();
    $currentPostType = $currentScreen->post_type;
    
    function add_post_author_print_column( $columns ){
        $approve_column = array();
        foreach($columns as $key => $date) {
            if ($key=='date'){
                $approve_column['author_print'] = __( 'Print' );
            }
            $approve_column[$key] = $date;
        }
        return $approve_column;
    }

    function display_post_author_print_column( $column_name, $post_id ){
        switch($column_name){
            case 'author_print':
                echo '<a target="_blank" class="button button-primary" href="'.get_preview_post_link().'">প্রিন্ট</a>';
            break;
        }
    }
    
    if( $currentPostType != 'post' && $currentPostType != 'ditty_news_ticker' ){
        add_action('manage_posts_custom_column', 'display_post_author_print_column', 5, 2);
        add_filter('manage_posts_columns', 'add_post_author_print_column', 5);
    }
}
add_action( 'admin_head', 'author_print_btn_column_add' );
#--------------- Add Print Column ----------------#


#--------------- Add role class to body ----------------#
function add_role_to_body($classes) {
    
    global $current_user;
    $user_role = array_shift($current_user->roles);
    
    $classes .= 'role-'. $user_role;
    return $classes;
}
add_filter('admin_body_class', 'add_role_to_body');
#--------------- Add role class to body ----------------#


#--------------- Add author new caps ----------------#
function add_author_new_caps() {
    $getAuthor = get_role( 'author' );
    $getAuthor->add_cap( 'edit_others_posts' );
}
add_action( 'admin_init', 'add_author_new_caps' );
#--------------- Add author new caps ----------------#


?>