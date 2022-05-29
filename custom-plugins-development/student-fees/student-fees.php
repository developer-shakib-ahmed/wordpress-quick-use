<?php 
/*
	Plugin Name: Student Fees
	Plugin URI:  https://www.aschool.org/wp-content/plugins/student-fees
	Description: This plugin allow to show up the students payment criteria.
	Version:     1.0.0
	Author:      Shakib Ahemd
	Author URI:  https://www.shakibahmed.com
	License:     GPL-2.0+
	License URI: http://www.gnu.org/licenses/gpl-2.0.txt

	This theme, like WordPress, is licensed under the GPL.
	Use it to make something cool, have fun, and share what you've learned with others.
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/


if( ! defined( 'ABSPATH' ) ){
	die( 'Hey, you can\'t access this file, you silly human!' );
}


// add student fees sub menu
function add_student_fees_submenu(){
	// Sub menu
	add_submenu_page( 'woocommerce', 'Student Fees', 'Student Fees', 'manage_options', 'student-fees', 'student_fees_page_callback' );

	// student fees page callback
	function student_fees_page_callback(){
	?>
		<div class="wrap">
			<h1 class="wp-heading-inline">Student Fees</h1>

			<?php global $woocommerce, $post; ?>

			<div class="tablenav top">
			    <div class="alignleft actions">
			    	<?php 
			    		if(isset($_GET['filter_std'])){
			    			$batch = '';
			    			  if(isset($_GET['std_batch']))
			    				$batch = $_GET['std_batch'];

			    			$type = '';
			    			  if(isset($_GET['std_type']))
			    				$type = $_GET['std_type'];
			    		}
			    	?>
			    	<form id="std_search" action="<?php echo admin_url( 'admin.php' ); ?>" method="get">
			    		<input type="hidden" name="page" value="student-fees" />
			    		<select name="std_batch" id="std_batch">
			    			<option value="">-- Select Batch --</option>
			    			<?php 
			    			$productCats = get_terms(array(
			    				'taxonomy'    => 'product_cat',
			    				'hide_empty'  => true,
    		        			'orderby'     => 'name', // count, name, date, title
    		        			'order'       => 'ASC', // ASC, DESC
    		        			'fields'      => 'all',
    		        		));

			    			foreach ( $productCats as $productCat ) {
			    				$catName = $productCat->name;
			    				$catSlug = $productCat->slug;
			    				$selected = $batch == $catSlug ? ' selected="selected"' : '';
			    				echo '<option '.$selected.' value="'.$catSlug.'">'.$catName.'</option>';
			    			}
			    			?>
			    		</select><!-- /#std_batch -->

			    		<select name="std_type" id="std_type">
			    			<option value="">-- Select Type --</option>
			    			<option <?php echo $type == 'registered' ? ' selected="selected"' : '';?> value="registered">Registered</option>
			    			<option <?php echo $type == 'running' ? ' selected="selected"' : '';?> value="running">Running</option>
			    			<option <?php echo $type == 'dropped' ? ' selected="selected"' : '';?> value="dropped">Dropped</option>
			    			<option <?php echo $type == 'completed' ? ' selected="selected"' : '';?> value="completed">Completed</option>
			    		</select><!-- /#std_type -->

			    		<input type="submit" name="filter_std" id="filter_std" class="button" value="Filter">
			    	</form>
			    </div>
			    <div class="tablenav-pages one-page">
			    	<span class="displaying-num">
						<script type="text/javascript">
							jQuery(document).ready(function(){
								jQuery('span.displaying-num').text( jQuery('span#totalStudents').text() );
							});
						</script>
			    	</span>
			    </div>
			    <br class="clear">
			</div><!-- /.tablenav -->

			<table class="wp-list-table widefat fixed striped posts">
			    <thead>
			        <tr>
			            <th style="width: 250px;" id="student_name" class="manage-column">STUDENT NAME</th>
			            <th style="width: 100px;" id="batch" class="manage-column">BATCH</th>
			            <th style="width: 100px;" id="type" class="manage-column">TYPE</th>
			            <th style="" id="fees" class="manage-column">FEES</th>
			        </tr>
			    </thead>

			    <tbody id="the-list">
			    	<?php
			    		// https://wordpress.stackexchange.com/questions/66486/return-all-users-with-a-specific-meta-key
			    		$students = get_users(array(
			    			'meta_query' => array(
			    				'relation' => 'AND',
			    				array(
			    					'key'     => 'type',
			    					'value'   => $type,
			    					'compare' => 'LIKE'
			    				),
			    				array(
			    					'key'     => 'batch',
			    					'value'   => $batch,
			    					'compare' => 'LIKE'
			    				),
			    			)
			    		));
			    	?>

			    	<?php if( ! empty($students)) : ?>
				    	<?php 
				    		foreach ($students as $student) :
			    			$studentID = $student->ID;
			    			$studentName = $student->display_name;
			    			$studentEmail = $student->user_email;
			    			$studentCapabilities = implode(', ', $student->roles);
			    			$studentType = $student->type;
			    			$studentBatch = $student->batch;
			    			++$totalStudents;
			    		?>
							<tr id="post-<?php echo $studentID; ?>">
								<td class="student_name">
									<strong style="text-transform: capitalize;"><?php echo $studentName;  ?></strong>
								</td>
								<td class="batch" style="text-transform: capitalize;"><?php echo $studentBatch; ?></td>
								<td class="type" style="text-transform: capitalize;"><?php echo $studentType; ?></td>
								<td class="fees">
								<?php 
									$studentInfo = wc_get_orders( array( 'customer' => $studentEmail ) );				
									foreach ($studentInfo as $info ) {
										$orderID =  $info->ID;
										$stdOrders = new WC_Order($orderID);
										$stdOrderItems = $stdOrders->get_items();
										$itemCount = count($stdOrderItems);
										$i = 0;
										foreach ( $stdOrderItems as $Item ) {
											$i++;
											$itemName = $Item->get_name();
											echo ( $itemCount === $i ) ? '<strong>'.$itemName.'</strong>' : '<strong>'.$itemName.'</strong>, ';
										}
									}
								?>
								</td>
							</tr>
			    		<?php endforeach; ?>			    		
			    		<?php else : ?>
			    			<tr id="post-no">
			    				<td colspan="4" style="color:#e74c3c; font-style:italic; font-weight:bold;">No Student Was Found!</td>
			    			</tr>
			    		<?php endif; ?>
			    	<span style="display: none;" id="totalStudents">
					<?php 
						$totalStudents = ( $totalStudents == 0 ) ? 0 : $totalStudents ;
						echo ( $totalStudents < 2 ) ? $totalStudents.' item' : $totalStudents.' items';
					?>
			    	</span>
			    </tbody>

			    <tfoot>
			        <tr>
			            <th id="student_name" class="manage-column">STUDENT NAME</th>
			            <th id="batch" class="manage-column">BATCH</th>
			            <th id="type" class="manage-column">TYPE</th>
			            <th id="fees" class="manage-column">FEES</th>
			        </tr>
			    </tfoot>

			</table><!-- /.wp-list-table -->

		</div><!-- /.wrap -->
	<?php
	}
}
add_action( 'admin_menu', 'add_student_fees_submenu' );


function student_academic_informations( $user ){
?>
  <h2>Academic Informations</h2>
  <table class="form-table">

    <tr>
      <th><label for="batch">Student Batch</label></th>
      <td>
        <?php
        	$batch = esc_attr( get_the_author_meta( 'batch', $user->ID ) );
        ?>
        <select class="regular-text" name="batch" id="batch">
        	<option value="no-batch">-- Select Batch --</option>
        	<?php 
        		$productCats = get_terms(array(
        			'taxonomy'    => 'product_cat',
        			'hide_empty'  => true,
        			'orderby'     => 'name', // count, name, date, title
        			'order'       => 'ASC', // ASC, DESC
        			'fields'      => 'all',
        		));

        		foreach ( $productCats as $productCat ) {
        			$catName = $productCat->name;
        			$catSlug = $productCat->slug;
        			echo '<option '.selected( $batch, $catSlug, false ).' value="'.$catSlug.'">'.$catName.'</option>';
        		}
        	?>
        </select>
        <p class="description">Select student batch name.</p>
      </td>
    </tr>

    <tr>
      <th><label for="type">Student Type</label></th>
      <td>
        <?php
        	$type = esc_attr( get_the_author_meta( 'type', $user->ID ) );
        ?>
        <select class="regular-text" name="type" id="type">
        	<option value="no-type">-- Select Type --</option>
        	<option <?php selected( $type, 'registered' ); ?> value="registered">Registered</option>
        	<option <?php selected( $type, 'running' ); ?> value="running">Running</option>
        	<option <?php selected( $type, 'dropped' ); ?> value="dropped">Dropped</option>
        	<option <?php selected( $type, 'completed' ); ?> value="completed">Completed</option>
        </select>		
        <p class="description">Select student type.</p>
      </td>
    </tr>

  </table>
<?php
}


// Callback function to save the data
function save_student_academic_informations( $user_id ){
  if ( !current_user_can( 'edit_user', $user_id ) ){
    return false;
  }else{
    update_usermeta( $user_id, 'batch', $_POST['batch'] );
    update_usermeta( $user_id, 'type', $_POST['type'] );
  }
}


// Hooks
add_action( 'show_user_profile', 'student_academic_informations' );
add_action( 'edit_user_profile', 'student_academic_informations' );
add_action( 'personal_options_update', 'save_student_academic_informations' );
add_action( 'edit_user_profile_update', 'save_student_academic_informations' );


// Scripts
function student_fees_admin_scripts(){
	$screen_id = get_current_screen()->id;
	if( $screen_id == 'woocommerce_page_student-fees' && is_admin() ){
		wp_enqueue_script( 'student-fees', plugins_url( 'assets/js/student-fees.js', __FILE__ ), array( 'jquery' ), '1.0', true );
		wp_localize_script( 'student-fees', 'ajax_std', admin_url( 'admin-ajax.php' ) );
	}
}
add_action( 'admin_head', 'student_fees_admin_scripts' );


?>