<?php
/* ------------------------------------------------------- */
/* Remove automatics
/* ------------------------------------------------------- */
add_filter('the_content', 'wi_theme_pre_process_shortcode', 7);

// Allow Shortcodes in Widgets
add_filter('widget_text', 'wi_theme_pre_process_shortcode', 7);
if (!function_exists('wi_theme_pre_process_shortcode')){
function wi_theme_pre_process_shortcode($content){
	$shortcodes = 'divider';
	$shortcodes = explode(",",$shortcodes);
	$shortcodes = array_map("trim",$shortcodes);
	
	global $shortcode_tags;

    // Backup current registered shortcodes and clear them all out
    $orig_shortcode_tags = $shortcode_tags;
	$shortcode_tags = array();
	
	foreach ($shortcodes as $shortcode){
		add_shortcode($shortcode,'wi_'.$shortcode.'_shortcode');
	}	
	 // Do the shortcode (only the one above is registered)
    $content = do_shortcode($content);
 
    // Put the original shortcodes back
    $shortcode_tags = $orig_shortcode_tags;
 
    return $content;
}
}

/* ------------------------------------------------------- */
/* Divider
/* ------------------------------------------------------- */
if (!function_exists('wi_divider_shortcode')){
function wi_divider_shortcode($atts,$content = NULL){
	extract(shortcode_atts(array(
		'h'				=>	'',
		'heading'		=>  '',
	), $atts));
	
	$heading = strtolower( trim ($heading) );
	if ( !$heading ) $heading = $h;
	if(!in_array($heading,array('h1','h2','h3','h4','h5','h6'))) $heading = 'h2';
	
	$return = '</div>';	// end container
	$return .= '<div class="wi-divider"><div class="container">';
	$return .= '<' . $heading . ' class="title">' . trim($content) . '</' . $heading . '>';
	$return .= '</div></div>';	// end container, end divider
	$return .= '<div class="container">';	// start a new container

	return $return;
}
}

/* ------------------------------------------------------- */
/* Blockquote
/* ------------------------------------------------------- */
if (!function_exists('wi_blockquote_shortcode')){
function wi_blockquote_shortcode($atts,$content = NULL){
	extract(shortcode_atts(array(
		'author'				=>	'',
		'link'					=>  '',
		'target'				=>	'',
	), $atts));
	
	$return = '<blockquote class="blockquote-sc">';
	$return .= '<p>'. do_shortcode($content) . '</p>';
	if ( $author ) {
		if ( $link ) {
			if ( $target != '_blank' ) $target = '_self';
			$open = '<a href="'.esc_url($link).'" target="'.$target.'">';
			$close = '</a>';
		} else {
			$open = $close = '';
		}
		$return .= '<cite>'.$open . $author . $close.'</cite>';
	}
	$return .= '</blockquote>';
	return $return;
}
}

/* ------------------------------------------------------- */
/* Toparea Small
/* ------------------------------------------------------- */
if (!function_exists('wi_toparea_small_shortcode')){
function wi_toparea_small_shortcode($atts,$content = NULL){
	$return = '<h3 class="small-text">'.trim($content).'</h3>';
	return $return;
}
}

/* ------------------------------------------------------- */
/* Toparea Big
/* ------------------------------------------------------- */
if (!function_exists('wi_toparea_big_shortcode')){
function wi_toparea_big_shortcode($atts,$content = NULL){
	$return = '<h1 class="heading-text">'.trim($content).'</h1>';
	return $return;
}
}

/* ------------------------------------------------------- */
/* Text Slider
/* ------------------------------------------------------- */
if (!function_exists('wi_text_slider_shortcode')){
function wi_text_slider_shortcode($atts,$content = NULL){

	extract(shortcode_atts(array(
		'auto'				=>	'false',
		'pager'				=>	'true',
		'effect'			=>	'slide',
		'direction'			=>	'horizontal',
	), $atts));
	
	if ( $auto != 'true' ) $auto = 'false';
	if ( $pager!= 'true' ) $pager = 'false';
	if ( $effect !='fade' ) $effect = 'slide';
	if ( $direction != 'vertical' ) $direction = 'horizontal';

	if (!preg_match_all("/(.?)\[(slide)\b(.*?)(?:(\/))?\](?:(.+?)\[\/slide\])?(.?)/s", $content, $matches)) :
		return do_shortcode($content);		
	else :
		wp_enqueue_script('wi-flexslider');
		wp_enqueue_style('wi-flexslider');
		$return = '<div class="text-slider" data-auto="'.$auto.'" data-pager="'.$pager.'" data-effect="'.$effect.'" data-direction="'.$direction.'">';
		$return .= '<div class="flexslider"><ul class="slides">';

		for($i = 0; $i < count($matches[0]); $i++):
			
			$return .= '<li>'.trim($matches[5][$i]).'</li>';
									
		endfor;
		
		$return .= '</ul></div></div>';

		return $return;
		
	endif;

}
}


/* ------------------------------------------------------- */
/* Latest Tweets
/* ------------------------------------------------------- */
if (!function_exists('wi_latest_tweets_shortcode')){
function wi_latest_tweets_shortcode($atts,$content = NULL) {
	extract(shortcode_atts(array(
		'username'		=>	'',
		'number'		=>	'',
		'navi'			=>	'true',
		'auto'			=>	'false',
	), $atts));

	wp_enqueue_script('wi-tweets');
	wp_enqueue_script('wi-flexslider');
	wp_enqueue_style('wi-flexslider');
	$username = trim($username); if ( !$username ) return;
	$number = absint($number);
	if ( $navi!='false' ) $navi = 'true';
	if ( $auto!='true' ) $auto = 'false';
	
	$return = '<div class="wi-tweets">';
	$return .='<div class="latest-tweets flexslider" data-number="'.$number.'" data-auto="'.$auto.'" data-navi="'.$navi.'" data-username="'.$username.'" data-modpath="'.get_template_directory_uri().'/inc/twitter/index.php'.'"></div>';
	$return .= '</div>';	

	return $return;
}
}

/* ------------------------------------------------------- */
/* Init
/* ------------------------------------------------------- */

$shortcodes = 'blockquote, toparea_small, toparea_big, text_slider, latest_tweets';
$shortcodes = explode(",", $shortcodes);
$shortcodes = array_map("trim",$shortcodes);

foreach ($shortcodes as $shortcode){
	add_shortcode($shortcode,'wi_'.$shortcode.'_shortcode');
}


/* ------------------------------------------------------- */
/* Latest Posts
/* ------------------------------------------------------- */
if (!function_exists('wi_latest_posts_shortcode')){
function wi_latest_posts_shortcode($atts,$content = NULL){
	extract(shortcode_atts(array(
		'style'				=>	'1', // style 1: vertical, style 2: horizontal
		'column'			=>	'4',
		'number'			=>	'3', // number of posts to show
		'thumbnail'			=>	'true',
		'readmore'			=>	'false',
		'excerpt'			=>	'true',
		'excerpt_length'	=>	'14',
		'date'				=>	'true',
		'comments'			=>	'true',
		'author'			=>	'false',
		'category'			=>	'',	//	show posts in a specified category
		'tag'				=>	'', //	show posts in a specified tag
	), $atts));
	
	$number = intval(trim($number));
	
/*	PHP Stuffs 
	------------------------------------------------------------ */
	
	global $smof_data, $wp_query, $post;
	
	$classes = array('wi-recent-posts');
	
	if ($style!='2') $style = 1;
	$classes[] = 'style-'.$style;
	
	$thumb = ($style == 1) ? 'thumbnail' : 'thumb-480-crop';
	$placeholder_img = get_template_directory_uri() . '/images/'.$thumb.'.png';;
	
	$column = absint($column);
	if ($column < 1 || $column > 8) $column = 4;
	$classes[] = 'column-'.$column;
	
	/* post per page */
	$number = intval($number);

	$args = array(
		'posts_per_page'	=>		$number,
		'paged'				=>		1,
	);
	
	if ( $category ) $args['category_name'] = $category;
	if ( $tag ) $args['tag'] = $tag;
	
	$latest_query = get_posts($args);
	
	$classes = join(' ', $classes);
	$classes = esc_attr($classes);
	
	ob_start();
	?>
	
	<div class="<?php echo $classes; ?>">
	<?php
		if ( $latest_query ) : $count = 0;
			foreach ( $latest_query as $post ) : setup_postdata( $post );
			
				$count++;
			
				$post_classes = array('recent-item');	
				$post_classes = join(' ',$post_classes);
				$post_classes = esc_attr($post_classes);
				
				$post_format = get_post_format();
				if ( $post_format == 'standard' )
					$format_icon = 'pencil';
				elseif ( $post_format == 'video' )
					$format_icon = 'play';
				elseif ( $post_format == 'audio' )
					$format_icon = 'music';
				elseif ( $post_format == 'image' )
					$format_icon = 'picture';
				elseif ( $post_format == 'gallery' )
					$format_icon = 'pictures';			
				elseif ( $post_format == 'link' )
					$format_icon = 'link';
				elseif ( $post_format == 'quote' )
					$format_icon = 'quote';
				elseif ( $post_format == 'status' )
					$format_icon = 'comments';
				else $format_icon = 'pencil';	
				?>
				
				<article <?php post_class($post_classes);?> id="recent-item-<?php the_ID();?>">
				
				<?php if ($thumbnail == 'true') { ?>
					
						<div class="post-thumbnail">
						
							<a href="<?php the_permalink();?>">
								<?php if ( has_post_thumbnail() ) {
									the_post_thumbnail($thumb);
								} else {
									echo '<span class="format-icon"><img src="'.$placeholder_img.'" alt="No Image" /><span class="ic"><i class="icon-'.$format_icon.'"></i></span></span>';
								}?>
							</a>
						
						</div><!-- .post-thumbnail -->
						
				<?php } // thumbnail ?>
				
					<div class="text">
						<h4 class="sc-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
						<?php if ( $date=='true' || $comments=='true' || $author=='true') { ?>
						<div class="sc-meta">
							<?php if ($date == 'true' ) { ?>
							<div class="ele time"><time data-time="<?php echo get_the_date('c');?>"><?php echo get_the_date( get_option('date_format') );?></time></div>
							<?php } ?>
							<?php if ($comments == 'true') {?>
							<div class="ele comments">
								<?php comments_popup_link( __('0 comments','wi'), __('1 comment','wi'), __('% comments','wi'),'', __('Off','wi') ); ?>
							</div><!-- .comments -->
							<?php }?>
							<?php if ($author == 'true') {?>
							<div class="ele author">
								<?php printf(__('by %s','wi'), '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) .'" rel="author">' . get_the_author() . '</a>' );?>
							</div><!-- .comments -->
							<?php } ?>
							<div class="clearfix"></div>
						</div><!-- .meta -->
						<?php } // if 1 in 3 elements of meta ?>
						<?php if ( $excerpt == 'true' ) { ?>
						<div class="excerpt">
							<p>
							<?php echo wi_subword(get_the_excerpt(),0,$excerpt_length);?>
							<?php if ($readmore == 'true'):?>
							<a href="<?php the_permalink();?>" class="readmore-link"><?php _e('Read more','wi');?> <i class="icon-angle-right"></i></a>
							<?php endif; ?>
							</p>
						</div><!-- .excerpt -->
						<?php } ?>						
					</div><!-- .text -->
				
					<div class="clearfix"></div>
				
				</article><!-- .recent-item -->
			
			<?php
			
			if ( $count % $column == 0 ) echo '<div class="clearfix"></div>';
			
			endforeach; // while have posts
			
		endif; // if have posts
	
//		wp_reset_query();
	
	?>
		<div class="clearfix"></div>
	</div><!-- .wi-recent-posts -->
	<?php
	
	$return = ob_get_clean();
	return $return;
}
}

add_shortcode ( 'latest_posts', 'wi_latest_posts_shortcode' );
add_shortcode ( 'recent_posts', 'wi_latest_posts_shortcode' );