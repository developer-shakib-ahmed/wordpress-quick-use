<?php

/*
Plugin Name: Custom Plugin
Plugin URI: http://www.shakibahmed.com/plugins/custom-plugin
Author: Shakib Ahmed
Author URI: http://www.shakibahmed.com
Description: This is a demo description for CustomPlugin WordPress custom plugin.
Version: 1.0
Text Domain: custom_plugin
License: GPL2
*/

function admin_custom_files_for_test_widget(){
	wp_enqueue_media();
	wp_register_script( 
		'widget-custom-js',
		plugins_url('/admin/js/widget-custom.js', __FILE__),
		array('jquery'),
		'1.0'
	);
	wp_enqueue_script('widget-custom-js');

	wp_register_style('widget-custom-css', plugins_url('/admin/css/widget-custom.css', __FILE__), '', '1.0');
	wp_enqueue_style('widget-custom-css');
}
add_action('admin_enqueue_scripts', 'admin_custom_files_for_test_widget');

/*
	@see https://codex.wordpress.org/Widgets_API#Developing_Widgets
*/

class test_widget extends WP_Widget{

	// __construct()
	public function __construct(){
		parent::__construct(test_widget, 'Test Widget', array(
			'description'	=>	'This is test widget description.',
		));
	}

	// form()
	public function form($instance){
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">New Title:</label>
			<input
				name="<?php echo $this->get_field_name('title'); ?>"
				id="<?php echo $this->get_field_id('title'); ?>"
				value="<?php echo $instance['title']; ?>"
				class="widefat"
				type="text"
			/>
		</p>
		<p>
			<?php if($instance['image'] != null) : ?>
			<div style="" class="display_image">
				<img style="max-width: 100%; height: auto; border: 1px solid #e5e5e5;" src="<?php echo $instance['image'] ?>" alt="Author image">
			</div>
			<?php endif; ?>
			<input
				name="<?php echo $this->get_field_name('image'); ?>"
				id="<?php echo $this->get_field_id('image'); ?>"
				value="<?php echo $instance['image'] ?>"
				class="widefat image_receive"
				type="hidden"
			/>
		</p>
		<p>
			<a id="image_upload" class="button button-secondary">Insert Image</a>
			<a id="image_reset" class="button button-reset">Reset Image</a>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('description'); ?>">Description:</label>			
			<textarea
				name="<?php echo $this->get_field_name('description'); ?>"
				id="<?php echo $this->get_field_id('description'); ?>"
				class="widefat"
				rows="5"><?php echo $instance['description'] ?></textarea>
		</p>
		<p>
			<input
				name="<?php echo $this->get_field_name('auto_p_tag'); ?>"
				id="<?php echo $this->get_field_id('auto_p_tag'); ?>"
				value="1"
				<?php checked( $instance['auto_p_tag'], 1 ); ?>
				type="checkbox"
			>
			<label for="<?php echo $this->get_field_id('auto_p_tag'); ?>">Automatically add p tag!</label>
		</p>
		<p>
			<input
				name="<?php echo $this->get_field_name('test'); ?>"
				id="<?php echo $this->get_field_id('one'); ?>"
				value="1"
				<?php checked($instance['test'], 1); ?>
				type="radio"
			/>
			<label for="<?php echo $this->get_field_id('one'); ?>">Show Image Top: </label>
		</p>
		<p>
			<input
				name="<?php echo $this->get_field_name('test'); ?>"
				id="<?php echo $this->get_field_id('two'); ?>"
				value="2"
				<?php checked($instance['test'], 2); ?>
				type="radio"
			/>
			<label for="<?php echo $this->get_field_id('two'); ?>">Show Image Bottom: </label>
		</p>
	<?php
	}

	// widget()
	public function widget($args, $instance){

		$before_widget = $args['before_widget'];
		$before_title = $args['before_title'];
		$after_title  = $args['after_title'];
		$after_widget  = $args['after_widget'];

		$title = $instance['title'];
		$image = $instance['image'];
		$description = $instance['description'];
		$auto_p_tag = $instance['auto_p_tag'];
		$test = $instance['test'];

		if($title == null){
			$title = 'Test Widget';
		}else{
			$title = $title;
		}

		if($image == null){
			$image = '';
		}else{
			$image = '<img src="'.$image.'" alt="Test image">';
		}

		if(isset($auto_p_tag)){
			$description = wpautop( $description );
		}else{
			$description = $description;
		}

		if($test == 2){
			$content = $description . $image;
		}else{
			$content =  $image . $description;
		}		

		echo
		 $before_widget .
		  $before_title .
		   $title .
		  $after_title .		   
		   $content .
		 $after_widget;
	}

	// update()

}
function test_widget_register(){
	register_widget(test_widget);
}
add_action('widgets_init', 'test_widget_register');

?>