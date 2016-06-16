<?php
/**
* Media Widget: Video, Soundcloud...
*/
add_action('widgets_init', 'wi_media_load_widgets');

function wi_media_load_widgets()
{
	register_widget('WI_Widget_Video');
}

class WI_Widget_Video extends WP_Widget {
	
	function __construct() {
		$widget_ops = array('classname' => 'widget_media', 'description' => __('Video / Soundcloud Widget','wi'));
		$control_ops = array('width' => 250, 'height' => 350);
		parent::__construct('media', __('Wi:Video / SoundCloud','wi'), $widget_ops, $control_ops);
	}
	
	function widget( $args, $instance) {
		extract($args);
		$title = isset ( $instance['title'] ) ? $instance['title'] : '';
		$code = isset ( $instance['code'] ) ? $instance['code'] : ''; if(!$code) $src = '';
		
		echo $before_widget;
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		if ( !empty( $title ) ) {	
			echo $before_title;
			echo $title ;
			echo $after_title;
		}
		global $wp_embed;
		$return = $wp_embed->run_shortcode('[embed]' . $code . '[/embed]');
		if ($return):?>
			<div class="media-container">
				<?php echo $return;?>
			</div><!-- .media-container -->
		<?php endif;?>

		<?php echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;		
		$instance['title'] = $new_instance['title'];
		$instance['code'] = $new_instance['code'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array(
			'title'		=>	'',
			'code'		=>	'',
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		extract($instance);
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>" style="display:inline-block;width:50px"><?php _e('Title:','wi'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>	
				
		<p>
			<label for="<?php echo $this->get_field_id('code'); ?>"><?php _e('Video / SoundCloud Code','wi') ?></label>
			<textarea class="widefat" rows="8" id="<?php echo $this->get_field_id('code'); ?>" name="<?php echo $this->get_field_name('code'); ?>"><?php echo $code; ?></textarea><br />
			<small><?php _e('Insert Youtube URL, Vimeo URL or SoundCloud URL (NOT iframe or ID, but <strong>URL</strong>)','wi');?></small>
		</p>
		
	<?php
	}
}
?>