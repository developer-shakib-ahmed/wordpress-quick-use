<?php 

#--------------- Add extends class of WP_Widget ---------------#
class about_me_widget extends WP_Widget{

	// __construct()
	public function __construct(){
		parent::__construct('about_me_widget', __('About Me Widget', 'about_me_widget'), array(
			'description'	=>	__('Easy About Me Widget', 'about_me_widget'),
		));
	}

	// form()
	public function form($instance){

		#-------------- form content --------------------------#
		if(isset($instance['title'])){
			$title = $instance['title'];
		}
		if(isset($instance['image'])){
			$image = $instance['image'];
		}
		if(isset($instance['myonoffswitch'])){
			$myonoffswitch = $instance['myonoffswitch'];
		}
		if(isset($instance['description'])){
			$description = $instance['description'];
		}
		if(isset($instance['auto_p_tag'])){
			$auto_p_tag = $instance['auto_p_tag'];
		}
		if(isset($instance['test'])){
			$test = $instance['test'];
		}
		#-------------- form content --------------------------#


		#-------------- social media icons --------------------#
		if(isset($instance['facebook'])){
			$facebook = $instance['facebook'];
		}
		if(isset($instance['twitter'])){
			$twitter = $instance['twitter'];
		}
		if(isset($instance['google_plus'])){
			$google_plus = $instance['google_plus'];
		}
		if(isset($instance['youtube'])){
			$youtube = $instance['youtube'];
		}
		if(isset($instance['linkedin'])){
			$linkedin = $instance['linkedin'];
		}
		if(isset($instance['xing'])){
			$xing = $instance['xing'];
		}
		if(isset($instance['foursquare'])){
			$foursquare = $instance['foursquare'];
		}
		if(isset($instance['vimeo'])){
			$vimeo = $instance['vimeo'];
		}
		if(isset($instance['instagram'])){
			$instagram = $instance['instagram'];
		}
		if(isset($instance['pinterest'])){
			$pinterest = $instance['pinterest'];
		}
		if(isset($instance['dribbble'])){
			$dribbble = $instance['dribbble'];
		}
		if(isset($instance['flickr'])){
			$flickr = $instance['flickr'];
		}
		if(isset($instance['github'])){
			$github = $instance['github'];
		}
		if(isset($instance['behance'])){
			$behance = $instance['behance'];
		}
		if(isset($instance['tumblr'])){
			$tumblr = $instance['tumblr'];
		}
		if(isset($instance['whatsapp'])){
			$whatsapp = $instance['whatsapp'];
		}
		if(isset($instance['soundcloud'])){
			$soundcloud = $instance['soundcloud'];
		}
		if(isset($instance['rss'])){
			$rss = $instance['rss'];
		}
		if(isset($instance['envelope'])){
			$envelope = $instance['envelope'];
		}
		if(isset($instance['skype'])){
			$skype = $instance['skype'];
		}
		if(isset($instance['phone'])){
			$phone = $instance['phone'];
		}
		#-------------- social media icons --------------------#



		#-------------- custom social media icons -------------#
		if(isset($instance['custom_icons'])){
			$custom_icons = $instance['custom_icons'];
		}
		#-------------- custom social media icons -------------#


	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input
				name="<?php echo $this->get_field_name('title'); ?>"
				id="<?php echo $this->get_field_id('title'); ?>"
				value="<?php if(isset($title)) echo $title; ?>"
				class="widefat"
				type="text"
			/>
		</p>
		<p>
			<?php if(!empty($image)) : ?>
				<?php $image = $image ?>
			<?php else: ?>
				<?php $image = PLUGIN_URL.'/admin/img/default-image.png'; ?>
			<?php endif; ?>

			<div class="display_image">
				<img src="<?php echo $image; ?>" alt="Image">
			</div>

			<input
				name="<?php echo $this->get_field_name('image'); ?>"
				id="<?php echo $this->get_field_id('image'); ?>"
				value="<?php if(isset($image)) echo $image; ?>"
				class="widefat image_receive"
				type="hidden"
			/>
		</p>
		<div id="btn_area">
			<div class="left">
				<a id="image_upload" class="button button-secondary">Insert Image</a>
			</div>
			<div class="right">
				<div class="onoffswitch">
			    <input 
				    name="<?php echo $this->get_field_name('myonoffswitch'); ?>"
				    id="<?php echo $this->get_field_id('myonoffswitch'); ?>"
				    value="1"
				    <?php if(isset($myonoffswitch)) checked( $myonoffswitch, 1); ?>
				    class="onoffswitch-checkbox"
				    type="checkbox"
			    />
			    <label class="onoffswitch-label" for="<?php echo $this->get_field_id('myonoffswitch'); ?>">
			        <span class="onoffswitch-inner"></span>
			        <span class="onoffswitch-switch"></span>
			    </label>
				</div>
			</div>
		</div>
		<p>
			<label for="<?php echo $this->get_field_id('description'); ?>">Description:</label>			
			<textarea
				name="<?php echo $this->get_field_name('description'); ?>"
				id="<?php echo $this->get_field_id('description'); ?>"
				class="widefat"
				rows="10"><?php if(isset($description)) echo $description; ?></textarea>
		</p>
		<p>
			<input
				name="<?php echo $this->get_field_name('auto_p_tag'); ?>"
				id="<?php echo $this->get_field_id('auto_p_tag'); ?>"
				value="1"
				<?php if(isset($auto_p_tag)) checked( $auto_p_tag, 1 ); ?>
				type="checkbox"
			/>
			<label for="<?php echo $this->get_field_id('auto_p_tag'); ?>">Automatically add p tag!</label>
		</p>

		<!-- Start .about_me_social_icon -->
		<div class="about_me_social_icon">
		<h4>Social Media Buttons</h4>

		<div class="default_icons">
		<p>
			<label for="<?php echo $this->get_field_id('facebook'); ?>"><i class="fa fa-facebook-square"></i>Facebook</label>
			<input
				name="<?php echo $this->get_field_name('facebook'); ?>"
				id="<?php echo $this->get_field_id('facebook'); ?>"
				value="<?php if(isset($facebook)) echo $facebook; ?>"
				class="widefat"
				type="url"
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('twitter'); ?>"><i class="fa fa-twitter-square"></i>Twitter</label>
			<input
				name="<?php echo $this->get_field_name('twitter'); ?>"
				id="<?php echo $this->get_field_id('twitter'); ?>"
				value="<?php if(isset($twitter)) echo $twitter; ?>"
				class="widefat"
				type="url"
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('google_plus'); ?>"><i class="fa fa-google-plus-square"></i>Google Plus</label>
			<input
				name="<?php echo $this->get_field_name('google_plus'); ?>"
				id="<?php echo $this->get_field_id('google_plus'); ?>"
				value="<?php if(isset($google_plus)) echo $google_plus; ?>"
				class="widefat"
				type="url"
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('youtube'); ?>"><i class="fa fa-youtube-square"></i>YouTube</label>
			<input
				name="<?php echo $this->get_field_name('youtube'); ?>"
				id="<?php echo $this->get_field_id('youtube'); ?>"
				value="<?php if(isset($youtube)) echo $youtube; ?>"
				class="widefat"
				type="url"
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('envelope'); ?>"><i class="fa fa-envelope"></i>E-mail</label>
			<input
				name="<?php echo $this->get_field_name('envelope'); ?>"
				id="<?php echo $this->get_field_id('envelope'); ?>"
				value="<?php if(isset($envelope)) echo $envelope; ?>"
				class="widefat"
				type="url"
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('skype'); ?>"><i class="fa fa-skype"></i>Skype</label>
			<input
				name="<?php echo $this->get_field_name('skype'); ?>"
				id="<?php echo $this->get_field_id('skype'); ?>"
				value="<?php if(isset($skype)) echo $skype; ?>"
				class="widefat"
				type="url"
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('phone'); ?>"><i class="fa fa-phone-square"></i>Contact Number</label>
			<input
				name="<?php echo $this->get_field_name('phone'); ?>"
				id="<?php echo $this->get_field_id('phone'); ?>"
				value="<?php if(isset($phone)) echo $phone; ?>"
				class="widefat"
				type="url"
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('linkedin'); ?>"><i class="fa fa-linkedin-square"></i>LinkedIn</label>
			<input
				name="<?php echo $this->get_field_name('linkedin'); ?>"
				id="<?php echo $this->get_field_id('linkedin'); ?>"
				value="<?php if(isset($linkedin)) echo $linkedin; ?>"
				class="widefat"
				type="url"
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('xing'); ?>"><i class="fa fa-xing-square"></i>XING</label>
			<input
				name="<?php echo $this->get_field_name('xing'); ?>"
				id="<?php echo $this->get_field_id('xing'); ?>"
				value="<?php if(isset($xing)) echo $xing; ?>"
				class="widefat"
				type="url"
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('foursquare'); ?>"><i class="fa fa-foursquare"></i>Foursquare</label>
			<input
				name="<?php echo $this->get_field_name('foursquare'); ?>"
				id="<?php echo $this->get_field_id('foursquare'); ?>"
				value="<?php if(isset($foursquare)) echo $foursquare; ?>"
				class="widefat"
				type="url"
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('vimeo'); ?>"><i class="fa fa-vimeo-square"></i>Vimeo</label>
			<input
				name="<?php echo $this->get_field_name('vimeo'); ?>"
				id="<?php echo $this->get_field_id('vimeo'); ?>"
				value="<?php if(isset($vimeo)) echo $vimeo; ?>"
				class="widefat"
				type="url"
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('instagram'); ?>"><i class="fa fa-instagram"></i>Instagram</label>
			<input
				name="<?php echo $this->get_field_name('instagram'); ?>"
				id="<?php echo $this->get_field_id('instagram'); ?>"
				value="<?php if(isset($instagram)) echo $instagram; ?>"
				class="widefat"
				type="url"
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('pinterest'); ?>"><i class="fa fa-pinterest-square"></i>Pinterest</label>
			<input
				name="<?php echo $this->get_field_name('pinterest'); ?>"
				id="<?php echo $this->get_field_id('pinterest'); ?>"
				value="<?php if(isset($pinterest)) echo $pinterest; ?>"
				class="widefat"
				type="url"
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('dribbble'); ?>"><i class="fa fa-dribbble"></i>Dribbble</label>
			<input
				name="<?php echo $this->get_field_name('dribbble'); ?>"
				id="<?php echo $this->get_field_id('dribbble'); ?>"
				value="<?php if(isset($dribbble)) echo $dribbble; ?>"
				class="widefat"
				type="url"
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('flickr'); ?>"><i class="fa fa-flickr"></i>Flickr</label>
			<input
				name="<?php echo $this->get_field_name('flickr'); ?>"
				id="<?php echo $this->get_field_id('flickr'); ?>"
				value="<?php if(isset($flickr)) echo $flickr; ?>"
				class="widefat"
				type="url"
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('github'); ?>"><i class="fa fa-github-square"></i>GitHub</label>
			<input
				name="<?php echo $this->get_field_name('github'); ?>"
				id="<?php echo $this->get_field_id('github'); ?>"
				value="<?php if(isset($github)) echo $github; ?>"
				class="widefat"
				type="url"
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('behance'); ?>"><i class="fa fa-behance-square"></i>Behance</label>
			<input
				name="<?php echo $this->get_field_name('behance'); ?>"
				id="<?php echo $this->get_field_id('behance'); ?>"
				value="<?php if(isset($behance)) echo $behance; ?>"
				class="widefat"
				type="url"
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('tumblr'); ?>"><i class="fa fa-tumblr-square"></i>Tumblr</label>
			<input
				name="<?php echo $this->get_field_name('tumblr'); ?>"
				id="<?php echo $this->get_field_id('tumblr'); ?>"
				value="<?php if(isset($tumblr)) echo $tumblr; ?>"
				class="widefat"
				type="url"
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('whatsapp'); ?>"><i class="fa fa-whatsapp"></i>WhatsApp</label>
			<input
				name="<?php echo $this->get_field_name('whatsapp'); ?>"
				id="<?php echo $this->get_field_id('whatsapp'); ?>"
				value="<?php if(isset($whatsapp)) echo $whatsapp; ?>"
				class="widefat"
				type="url"
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('soundcloud'); ?>"><i class="fa fa-soundcloud"></i>SoundCloud</label>
			<input
				name="<?php echo $this->get_field_name('soundcloud'); ?>"
				id="<?php echo $this->get_field_id('soundcloud'); ?>"
				value="<?php if(isset($soundcloud)) echo $soundcloud; ?>"
				class="widefat"
				type="url"
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('rss'); ?>"><i class="fa fa-rss-square"></i>RSS</label>
			<input
				name="<?php echo $this->get_field_name('rss'); ?>"
				id="<?php echo $this->get_field_id('rss'); ?>"
				value="<?php if(isset($rss)) echo $rss; ?>"
				class="widefat"
				type="url"
			/>
		</p>
		</div><!-- End .default_icons -->
		<p>
			<a id="custom_icons" class="button button-reset">Custom Icon Field</a>
		</p>
		<div class="custom_icons">
			<label for="<?php echo $this->get_field_id('custom_icons'); ?>">Custom Social Icons:</label>
			<textarea
				name="<?php echo $this->get_field_name('custom_icons'); ?>"
				id="<?php echo $this->get_field_id('custom_icons'); ?>"
				class="widefat"
				rows="5"><?php if(isset($custom_icons)) echo $custom_icons; ?></textarea>

			<b style="display:block;">For use: </b><code>[custom_icon url="#" icon="home"]</code>
		</div>
		</div><!-- End .about_me_social_icone -->
	<?php
	}

	// widget()
	public function widget($args, $instance){
		#-------------- widget arguments -------------------#
		$before_widget = $args['before_widget'];
		$before_title = $args['before_title'];
		$after_title  = $args['after_title'];
		$after_widget  = $args['after_widget'];
		#-------------- widget arguments -------------------#



		#-------------- social media icons -----------------#
		$facebook = $instance['facebook'];
		$twitter = $instance['twitter'];
		$google_plus = $instance['google_plus'];
		$youtube = $instance['youtube'];
		$envelope = $instance['envelope'];
		$skype = $instance['skype'];
		$phone = $instance['phone'];
		$linkedin = $instance['linkedin'];
		$xing = $instance['xing'];
		$foursquare = $instance['foursquare'];
		$vimeo = $instance['vimeo'];
		$instagram = $instance['instagram'];
		$pinterest = $instance['pinterest'];
		$dribbble = $instance['dribbble'];
		$flickr = $instance['flickr'];
		$github = $instance['github'];
		$behance = $instance['behance'];
		$tumblr = $instance['tumblr'];
		$whatsapp = $instance['whatsapp'];
		$soundcloud = $instance['soundcloud'];
		$rss = $instance['rss'];



		#-------------- custom social media icons -------------#
		$custom_icons = $instance['custom_icons'];
		function custom_social_media_icon_shortcode($atts){
			extract(shortcode_atts(array( 'url' => '', 'icon' => '' ), $atts, 'custom_icon'));
			return '<li><a href="'.$url.'"><i class="fa fa-'.$icon.'"></i></a></li>';
		}
		add_shortcode('custom_icon', 'custom_social_media_icon_shortcode');
		// for use: [custom_icon url="" icon="" color=""]
		#-------------- custom social media icons -------------#

		$icon_count = 0;
		
		if(!empty($facebook)){
			$facebook = '<li><a title="Facebook" href="'.$facebook.'"><i class="fa fa-facebook-square"></i></a></li>';
			$icon_count = 1;
		}

		if(!empty($twitter)){
			$twitter = '<li><a title="Twitter" href="'.$twitter.'"><i class="fa fa-twitter-square"></i></a></li>';
			$icon_count = 1;
		}

		if(!empty($google_plus)){
			$google_plus = '<li><a title="Google +" href="'.$google_plus.'"><i class="fa fa-google-plus-square"></i></a></li>';
			$icon_count = 1;
		}

		if(!empty($youtube)){
			$youtube = '<li><a title="YouTube" href="'.$youtube.'"><i class="fa fa-youtube-square"></i></a></li>';
			$icon_count = 1;
		}

		if(!empty($envelope)){
			$envelope = '<li><a title="E-mail" href="mailto:'.$envelope.'"><i class="fa fa-envelope"></i></a></li>';
			$icon_count = 1;
		}

		if(!empty($skype)){
			$skype = '<li><a title="Skype" href="tel:'.$skype.'"><i class="fa fa-skype"></i></a></li>';
			$icon_count = 1;
		}

		if(!empty($phone)){
			$phone = '<li><a title="Contact Number" href="tel:'.$phone.'"><i class="fa fa-phone-square"></i></a></li>';
			$icon_count = 1;
		}

		if(!empty($linkedin)){
			$linkedin = '<li><a title="LinkedIn" href="'.$linkedin.'"><i class="fa fa-linkedin-square"></i></a></li>';
			$icon_count = 1;
		}

		if(!empty($xing)){
			$xing = '<li><a title="XING" href="'.$xing.'"><i class="fa fa-xing-square"></i></a></li>';
			$icon_count = 1;
		}

		if(!empty($foursquare)){
			$foursquare = '<li><a title="Foursquare" href="'.$foursquare.'"><i class="fa fa-foursquare"></i></a></li>';
			$icon_count = 1;
		}

		if(!empty($vimeo)){
			$vimeo = '<li><a title="Vimeo" href="'.$vimeo.'"><i class="fa fa-vimeo-square"></i></a></li>';
			$icon_count = 1;
		}

		if(!empty($instagram)){
			$instagram = '<li><a title="Instagram" href="'.$instagram.'"><i class="fa fa-instagram"></i></a></li>';
			$icon_count = 1;
		}

		if(!empty($pinterest)){
			$pinterest = '<li><a title="Pinterest" href="'.$pinterest.'"><i class="fa fa-pinterest-square"></i></a></li>';
			$icon_count = 1;
		}

		if(!empty($dribbble)){
			$dribbble = '<li><a title="Dribbble" href="'.$dribbble.'"><i class="fa fa-dribbble"></i></a></li>';
			$icon_count = 1;
		}

		if(!empty($flickr)){
			$flickr = '<li><a title="Flickr" href="'.$flickr.'"><i class="fa fa-flickr"></i></a></li>';
			$icon_count = 1;
		}

		if(!empty($github)){
			$github = '<li><a title="Git Hub" href="'.$github.'"><i class="fa fa-github-square"></i></a></li>';
			$icon_count = 1;
		}

		if(!empty($behance)){
			$behance = '<li><a title="Behance" href="'.$behance.'"><i class="fa fa-behance-square"></i></a></li>';
			$icon_count = 1;
		}

		if(!empty($tumblr)){
			$tumblr = '<li><a title="Tumblr" href="'.$tumblr.'"><i class="fa fa-tumblr-square"></i></a></li>';
			$icon_count = 1;
		}

		if(!empty($whatsapp)){
			$whatsapp = '<li><a title="Whats App" href="'.$whatsapp.'"><i class="fa fa-whatsapp"></i></a></li>';
			$icon_count = 1;
		}

		if(!empty($soundcloud)){
			$soundcloud = '<li><a title="Sound Cloud" href="'.$soundcloud.'"><i class="fa fa-soundcloud"></i></a></li>';
			$icon_count = 1;
		}

		if(!empty($rss)){
			$rss = '<li><a title="RSS" href="'.$rss.'"><i class="fa fa-rss-square"></i></a></li>';
			$icon_count = 1;
		}

		if(!empty($custom_icons)){
			$custom_icons = do_shortcode( $custom_icons );
			$icon_count = 1;
		}

		if($icon_count == 1){
			$social_icon = '<div class="about_me_social_icon"><ul>'.$facebook.$twitter.$google_plus.$youtube.$envelope.$skype.$phone.$linkedin.$xing.$foursquare.$vimeo.$instagram.$pinterest.$dribbble.$flickr.$github.$behance.$tumblr.$whatsapp.$soundcloud.$rss.$custom_icons.'</ul></div>';
		}else{
			$social_icon = '';
		}
		#-------------- social media icons -----------------#


		#-------------- widget content ---------------------#
		$title = $instance['title'];
		$image = $instance['image'];
		$description = $instance['description'];

		if(isset($instance['auto_p_tag'])){
			$auto_p_tag = $instance['auto_p_tag'];
		}

		if(isset($instance['myonoffswitch'])){
			$myonoffswitch = $instance['myonoffswitch'];
		}

		if($title == null){ $title = 'About Me Widget'; }else{ $title = $title; }

		if(isset($myonoffswitch)){ $image = ''; }else{ $image = '<img class="about_me" src="'.$image.'" alt="Image">'; }

		if(isset($auto_p_tag)){ $description = wpautop( $description ); }else{ $description = $description; }

		$content =  $image . $description . $social_icon;	

		echo $before_widget . $before_title . $title . $after_title . $content . $after_widget;
		#-------------- widget content ---------------------#
	}

	// update()

}
#--------------- Add extends class of WP_Widget ---------------#



#--------------- widget register hook -------------------------#
function about_me_widget_register(){
	register_widget('about_me_widget');
}
add_action('widgets_init', 'about_me_widget_register');
#--------------- widget register hook -------------------------#



#-------------- End all function of this plugin ---------------#