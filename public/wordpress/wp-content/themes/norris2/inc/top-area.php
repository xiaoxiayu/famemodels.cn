<?php
	global $smof_data; 

	if ( !is_page() ) return;

		$page_template = get_post_meta(get_the_ID(),'_wp_page_template',true);
		$page_template = basename($page_template,'.php');
		$display_in_multipages = isset( $smof_data['toparea-multipages-layout'] ) ?  $smof_data['toparea-multipages-layout'] : true;
		$display_in_multipages = $display_in_multipages && is_front_page();
		if ( $page_template != 'template-onepage' && !$display_in_multipages ) return;
		
?>
<?php /*	------------------------		PHP Stuffs/Options			-------------------------- */ ?>
<?php
	
	$type = isset ($smof_data['top-area-type']) ? $smof_data['top-area-type'] : 'bg-fullscreen';
	
	if ( $type == 'none' ) return;
	
	$parallax = isset ($smof_data['top-area-parallax']) ? $smof_data['top-area-parallax'] : false;
	$parallax_class = $parallax ? ' parallax' : '';
	$top_content = isset ($smof_data['top-area-content']) ? $smof_data['top-area-content'] : '';
	$top_content = do_shortcode($top_content);
	
	/* Background
	---------------------------------------------------- */
	if ( $type == 'bg-fullscreen' || $type == 'bg-not-fullscreen' ):
		$fullscreen_bg_image = isset ($smof_data['toparea-bg-background-image']) ? $smof_data['toparea-bg-background-image'] : get_template_directory_uri() . '/images/wooden.jpg';
		?>
		<style type="text/css">
			#wi-top-area {
				background-image:url(<?php echo esc_url($fullscreen_bg_image);?>);
				}
			<?php if ( $type == 'bg-not-fullscreen' ) { 
				$padding = isset ($smof_data['toparea-bg-padding-top-bottom']) ? $smof_data['toparea-bg-padding-top-bottom'] : 100;
				$padding = absint($padding);
			?>
			#wi-top-area {
				padding-top:<?php echo $padding;?>px;
				padding-bottom:<?php echo $padding;?>px;
			}			
			<?php } // padding top/bottom ?>
		</style>
	<?php
	/* Fullscreen background slider
	---------------------------------------------------- */
	elseif ( $type == 'slider-fullscreen' || $type == 'slider-not-fullscreen' ) :
	
		$slider = isset ($smof_data['toparea-slider-slider']) ? $smof_data['toparea-slider-slider'] : array();
		$auto = isset ($smof_data['toparea-slider-auto']) ? $smof_data['toparea-slider-auto'] : true;
		$time = isset ($smof_data['toparea-slider-time-interval']) ? $smof_data['toparea-slider-time-interval'] : 5000;
		$navi = isset ($smof_data['toparea-slider-navi']) ? $smof_data['toparea-slider-navi'] : true;
		$pager = isset ($smof_data['toparea-slider-pager']) ? $smof_data['toparea-slider-pager'] : true;		
		
		$auto = $auto ? 'true' : 'false';
		$navi = $navi ? 'true' : 'false';
		$pager = $pager ? 'true' : 'false';
		$time = absint($time);
		
		if ( $type == 'slider-fullscreen' ) :
		
				$data_image = '';
				$slides_arr = array();
				$count = 0;
				foreach ( $slider as $slide ) {
					$count ++;
					if ( !isset($slide['url']) ) continue;
					$slides_arr[] = $slide['url'];
					$data_image .= ' data-image-'. $count .'="'.esc_url($slide['url']).'"';
				}
				
				$effect = isset ($smof_data['toparea-slider-fullscreen-effect']) ? $smof_data['toparea-slider-fullscreen-effect'] : 'slideRight';
				$progress = (isset ($smof_data['toparea-slider-fullscreen-progress']) && $smof_data['toparea-slider-fullscreen-progress']) ? 'true' : 'false';
		
		else :	// type == slider-not-fullscreen	
				$effect = isset ($smof_data['toparea-slider-not-fullscreen-effect']) ? $smof_data['toparea-slider-not-fullscreen-effect'] : 'slide';	
		endif;	// fullscreen or not
		
	/* Fullwidth Content
	---------------------------------------------------- */
	elseif ( $type == 'video' ) :
			$video_url = isset ($smof_data['toparea-video-url']) ? $smof_data['toparea-video-url'] : '';
			if ($video_url) {
				global $wp_embed;
				$media_result = $wp_embed->run_shortcode('[embed]' . $video_url . '[/embed]');
			} else {
				$media_result = '';
			}	
	endif;	// top area type
		
?>	
<div id="wi-top-area" class="wi-top-area type-<?php echo esc_attr($type);?><?php echo $parallax_class;?>">

	<?php 
	/* Fullscreen slideshow
	---------------------------------------------------- */
	if ( $type == 'slider-fullscreen' ) : ?>
	
	<div class="super" data-number="<?php echo count($slides_arr); ?>"<?php echo $data_image;?> data-effect="<?php echo esc_attr($effect);?>" data-time="<?php echo $time*1000;?>" data-auto="<?php echo $auto;?>">
		<div class="overlay"></div>
		
		<?php if ( $navi == 'true' ) {?>
		<!--Arrow Navigation-->
		<a id="prevslide" class="load-item"></a>
		<a id="nextslide" class="load-item"></a>
		<?php } ?>
		
		<?php if ( $progress == 'true' ) { ?>
		<!--Time Bar-->
		<div id="progress-back" class="load-item">
			<div id="progress-bar"></div>
		</div>
		<?php } ?>
		
		<?php if ( $pager == 'true' ) { ?>
		<div id="controls-wrapper" class="load-item">
			<div id="controls">				
				<ul id="slide-list"></ul>				
			</div><!-- #controls -->
		</div><!-- #controls-wrapper -->
		<?php } ?>
		
	</div><!-- .super -->

	<?php
	/* Not fullscreen slideshow
	---------------------------------------------------- */
	elseif ( $type == 'slider-not-fullscreen' ) : 
	wp_enqueue_script('wi-flexslider');
	wp_enqueue_style('wi-flexslider');
	?>
	
	<div class="header-slider" data-auto="<?php echo $auto;?>" data-effect="<?php echo $effect;?>" data-navi="<?php echo $navi;?>" data-pager="<?php echo $pager;?>" data-time="<?php echo $time*1000;?>">
		<div class="flexslider">
			<ul class="slides">
				<?php foreach ( $slider as $slide ): 
				if ( !isset($slide['url']) ) continue;
				?>
				<li><img src="<?php echo esc_url( $slide['url'] );?>" alt="<?php echo isset($slide['title']) ? $slide['title'] : basename($slide['url']);?>" /></li>
				<?php endforeach; ?>
			</ul><!-- .slides -->
			<div class="overlay"></div>
		</div><!-- .flexslider -->
	</div><!-- .header-slider -->

	<?php 
	/* Background
	---------------------------------------------------- */
	elseif ( $type == 'bg-fullscreen' || $type == 'bg-not-fullscreen' ): ; ?>
	
	<div class="overlay"></div>

	<?php endif; ?>

	<?php if ( $type != 'slider-not-fullscreen' ): ?>

	<div class="top-content">
		<?php echo $top_content; ?>
	</div><!-- .top-content -->
	
	<?php endif; ?>
	
</div><!-- #wi-top-area -->