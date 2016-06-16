<?php
/**
* Advertisement
*/
add_action('widgets_init', 'wi_ads_load_widgets');

function wi_ads_load_widgets()
{
	register_widget('WI_Widget_Ads');
}

class WI_Widget_Ads extends WP_Widget {
	
	function __construct() {
		$widget_ops = array('classname' => 'widget_ads', 'description' => __('Advertisement','wi'));
		$control_ops = array('width' => 250, 'height' => 350);
		parent::__construct('ads', __('Wi:Advertisement','wi'), $widget_ops, $control_ops);
	}
	
	function widget( $args, $instance) {
		extract($args);

		echo $before_widget;
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		if ( !empty( $title ) ) {	
			echo $before_title;
			echo $title ;
			echo $after_title;
		}
		
		echo '<div class="ad-container">';
		for ($i = 1; $i <= 6; $i++ ):
			
			$url = isset($instance['url-'.$i]) ? $instance['url-'.$i] : '';
			$width = isset($instance['width-'.$i]) ? $instance['width-'.$i] : '150';
			$target = isset($instance['target-'.$i]) ? $instance['target-'.$i] : '_blank';
			$image = isset($instance['image-'.$i]) ? $instance['image-'.$i] : '';
			$code = isset($instance['code-'.$i]) ? $instance['code-'.$i] : '';
			if ( !trim($image) && !trim($url) && !trim($code) ) continue;
			if ( trim($url) && !trim($image) ) $image = get_template_directory_uri().'/images/ad-placeholder/'.$width.'x'.$width.'.gif';
			
			echo '<div class="ad-cell ad-'.$width.'">';
			if (trim($code)) { echo trim($code); echo '</div>'; continue; }
			
			if (trim($url)) echo '<a href="'.esc_url(trim($url)).'" target="'.$target.'" rel="nofollow">';
			echo '<img src="'.$image.'" />';
			if (trim($url)) echo '</a>';
						
			echo '</div>';	// ad-cell

		endfor;
		echo '<div class="clearfix"></div></div>';	// ad-container
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;		
		return $new_instance;
	}

	function form( $instance ) {
	
		$title = isset ( $instance['title'] ) ? $instance['title'] : '';		
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>" style="display:inline-block;width:50px"><?php _e('Title:','wi'); ?></label>
			<input class="widefat" style="width:150px" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<?php
		for ($i = 1; $i <= 4; $i++ ):
			$url = isset($instance['url-'.$i]) ? $instance['url-'.$i] : '';
			$target = isset($instance['target-'.$i]) ? $instance['target-'.$i] : '_blank';
			$width = isset($instance['width-'.$i]) ? $instance['width-'.$i] : '150';
			$image = isset($instance['image-'.$i]) ? $instance['image-'.$i] : '';
			$code = isset($instance['code-'.$i]) ? $instance['code-'.$i] : '';
			?>
		<div class="ad-unit" style="border-bottom:1px solid #ccc;">
			<h4><?php printf(__('Advertisement %s','wi'),$i);?></h4>
			<p>
				<label for="<?php echo $this->get_field_id('url-'.$i); ?>"><?php _e('Ad URL','wi') ?></label>
				<input class="widefat" style="width:150px" id="<?php echo $this->get_field_id('url-'.$i); ?>" name="<?php echo $this->get_field_name('url-'.$i); ?>" type="text" value="<?php echo esc_attr($url); ?>" />
			</p>
			
			<p><label for="<?php echo $this->get_field_id('target-'.$i); ?>"><?php _e('URL Target:','wi') ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('target-'.$i); ?>" name="<?php echo $this->get_field_name('target-'.$i); ?>">
				<option value="_blank" <?php selected($target,'_blank') ?>><?php _e('New window','wi');?></option>
				<option value="_self" <?php selected($target,'_self') ?>><?php _e('Current window','wi');?></option>
			</select>
			</p>
			
			<p><label for="<?php echo $this->get_field_id('width-'.$i); ?>"><?php _e('Ad Width:','wi') ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('width-'.$i); ?>" name="<?php echo $this->get_field_name('width-'.$i); ?>">
				<option value="150" <?php selected($width,150) ?>>150px</option>
				<option value="300" <?php selected($width,300) ?>>300px</option>
			</select>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('image-'.$i); ?>"><?php _e('Image URL','wi') ?></label>
				<input class="widefat" style="width:150px" id="<?php echo $this->get_field_id('image-'.$i); ?>" name="<?php echo $this->get_field_name('image-'.$i); ?>" type="text" value="<?php echo esc_attr($image); ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('code-'.$i); ?>"><?php _e('Custom Code','wi') ?></label>
				<textarea class="widefat" id="<?php echo $this->get_field_id('code-'.$i); ?>" name="<?php echo $this->get_field_name('code-'.$i); ?>"><?php echo $code; ?></textarea>
			</p>
			
		</div><!-- .ad-unit -->
		<?php	
		endfor;		
	}
}
?>