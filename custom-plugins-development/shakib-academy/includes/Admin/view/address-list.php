<div class="wrap">
  <h1 class="wp-heading-inline"><?php _e('Address List', SK_ACADEMY_TEXTDOMAIN); ?></h1>

  <a href="<?php echo admin_url('/admin.php?page=shakib-academy&action=new') ?>" class="page-title-action"><?php _e('Add New', SK_ACADEMY_TEXTDOMAIN); ?></a>

  <?php if( isset( $_GET['inserted'] ) ) { ?>
    <div class="notice notice-success is-dismissible">
      <p><?php _e( 'New address has been inserted successfully!', SK_ACADEMY_TEXTDOMAIN ); ?></p>
    </div>
  <?php } ?>

  <?php if( isset( $_GET['deleted'] ) && $_GET['deleted'] == true ) { ?>
    <div class="notice notice-success is-dismissible">
      <p><?php _e( 'Address has been deleted successfully!', SK_ACADEMY_TEXTDOMAIN ); ?></p>
    </div>
  <?php } ?>

  <form action="" method="post">
    <?php
      $table = new Shakib\Academy\Admin\Address_List();
      $table->prepare_items();
      $table->display();
    ?>
  </form>
</div>