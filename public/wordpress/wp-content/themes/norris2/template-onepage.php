<?php
/*
Template Name: Onepage
*/
?>
<?php global $smof_data; ?>
<?php get_header();?>
<?php
if ( ( $locations = get_nav_menu_locations() ) && $locations['primary'] && !disable_onepage() ) {
	$menu = wp_get_nav_menu_object( $locations['primary'] );
	$menu_items = wp_get_nav_menu_items($menu->term_id);
	
	$pages_included = array();
	foreach ( $menu_items as $item ):
		if ($item->object != 'page') continue;
		$pages_included[] = $item->object_id;		
	endforeach;
	
} else {
	$pages_included[] = array();
}	
		
$count = 0;	

/* IF THERE IS AT LEAST ONE PAGE MENU ITEM */
if (!empty($pages_included)) :

			$args = array(
				'post_type'			=> 'page',
				'post__in'			=> $pages_included,
				'posts_per_page'	=> count($pages_included), 
				'orderby' 			=> 'post__in',
			);
		query_posts($args);

endif;
		
		if ( have_posts() ): while( have_posts() ): the_post(); $count++;?>
		<?php // Some PHP stuffs
		$page_template = get_post_meta(get_the_ID(),'_wp_page_template',true);
		$page_template = basename($page_template,'.php');
		
		/* -----------------------------		GET OPTIONS			----------------------------------- */
		/* Title Options
		----------------------------------------------- */
		$subtitle = get_post_meta(get_the_ID(),'_wi_subtitle',true);
		$subtitle = trim($subtitle);
		$title_image = false;
		$title_image_ids = get_post_meta(get_the_ID(),'_wi_title-image',false);
		$title_image_id = '';
		foreach ( $title_image_ids as $tii ) {
			if ( !wp_get_attachment_image_src( $tii ) ) continue;
			$title_image_id = $tii;
		}
		
		if ( $title_image_id ) {
			$title_image = wp_get_attachment_image_src($title_image_id,'full');
			$title_image = $title_image[0];
			}
		$hide_title = get_post_meta(get_the_ID(),'_wi_hide-title-area',true);
		
		/* Page Background Options
		----------------------------------------------- */
		$page_background_type = get_post_meta(get_the_ID(),'_wi_page-background-type',true);
		$page_background_color = get_post_meta(get_the_ID(),'_wi_page-background-color',true);
		$page_background_image = get_post_meta(get_the_ID(),'_wi_page-background-image',true);
		$page_background_image_size = get_post_meta(get_the_ID(),'_wi_page-background-image-size',true);
		$page_background_image_position = get_post_meta(get_the_ID(),'_wi_page-background-image-position',true);
		$page_background_pattern = get_post_meta(get_the_ID(),'_wi_page-background-pattern',true);
		$page_background_pattern_retina = get_post_meta(get_the_ID(),'_wi_page-background-pattern-retina',true);
		
		/* Separator Background Options
		----------------------------------------------- */
		$disable_separator = get_post_meta(get_the_ID(),'_wi_disable-page-separator',true);
		$separator_content = get_post_meta(get_the_ID(),'_wi_separator-content',true);
		$background_or_pattern = get_post_meta(get_the_ID(),'_wi_background-image-or-pattern',true);
		if ( $background_or_pattern!='pattern' ) $background_or_pattern = 'background';
		$background_images = get_post_meta(get_the_ID(),'_wi_background-image',false);
		$background_image = '';
		foreach ( $background_images as $bgim ) {
			if ( !wp_get_attachment_image_src( $bgim) ) continue;
			$background_image = $bgim;
		}		
		
		$overlay_opacity = get_post_meta(get_the_ID(),'_wi_overlay-opacity',true);
		$overlay_opacity = absint($overlay_opacity);
		$clipmask_opacity = get_post_meta(get_the_ID(),'_wi_clipmask-opacity',true);
		$clipmask_opacity = absint($clipmask_opacity);
		$enable_parallax = get_post_meta(get_the_ID(),'_wi_enable-parallax-effect',true);
		$parallax_class = ( $enable_parallax ) ? ' parallax' : '';
		
		$padding = get_post_meta(get_the_ID(),'_wi_padding-top-bottom',true);		
		
		$predefined_pattern = get_post_meta(get_the_ID(),'_wi_predefined-pattern',true);
		$retina_custom_patterns = get_post_meta(get_the_ID(),'_wi_retina-custom-pattern',false);
		$retina_custom_pattern = '';
		foreach ($retina_custom_patterns as $bgim ) {
			if ( !wp_get_attachment_image_src( $bgim) ) continue;
			$retina_custom_pattern = $bgim;
		}		
		
		$custom_patterns = get_post_meta(get_the_ID(),'_wi_custom-pattern',false);
		$custom_pattern = '';
		foreach ( $custom_patterns as $bgim ) {
			if ( !wp_get_attachment_image_src( $bgim) ) continue;
			$custom_pattern = $bgim;
		}
		
		if ( $background_or_pattern != 'pattern' ) {
					$background_type = 'image';
					if ( $background_image ) {
						$background_image = wp_get_attachment_image_src($background_image,'full');
						$background_image = $background_image[0];
						$background_size = 'cover';						
					} else {
						$background_image = '';
						$background_size = '';
					}
					$retina_background_image = $background_image;
			
		}	else {	//	$background_or_pattern == 'pattern'
					$background_type = 'pattern';
					if ( $custom_pattern ) {
						$pattern = $custom_pattern;
						if ( $retina_custom_pattern ) {
							$retina_pattern = $retina_custom_pattern;
						} else {
							$retina_pattern = $custom_pattern; 
						}
						$pattern = wp_get_attachment_image_src($pattern,'full');
						$pattern = $pattern[0];
						$retina_pattern = wp_get_attachment_image_src($retina_pattern,'full');
						$retina_pattern = $retina_pattern[0];			
					} else {
						$pattern = $predefined_pattern;
						$retina_pattern = str_replace( '.png' , '_@2X.png' , $pattern );
					}
					
					if ( !$pattern ) $pattern = get_template_directory_uri().'/images/sidrbg/argyle.png';
					
					if ( $pattern ) {
						$background_image = $pattern;
						$background_size = (array) @getimagesize($pattern);
						$background_size = $background_size[0] . 'px ' . $background_size[1] . 'px';
					} else {
						$background_image = '';
						$background_size = '';
					}
					
					if ( $retina_pattern ) {
						$retina_background_image = $retina_pattern;
					} else {
						$retina_background_image = $pattern;
					}
					
		}	// image or pattern			
	?>
	<?php if ( !$disable_separator ) :?>
	<style type="text/css">
		#page-separator-<?php echo $post->post_name;?> {
			background-image:url(<?php echo $background_image;?>);
			-webkit-background-size:<?php echo $background_size;?>;
			-moz-background-size:<?php echo $background_size;?>;
			background-size:<?php echo $background_size;?>;
			padding-top:<?php echo $padding;?>px;
			padding-bottom:<?php echo $padding;?>px;
		}
		#page-separator-<?php echo $post->post_name;?> .overlay {
			opacity:<?php echo ($overlay_opacity/100);?>;
			-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=<?php echo ($overlay_opacity);?>)";
			filter: alpha(opacity=<?php echo ($overlay_opacity);?>);
			}
		#page-separator-<?php echo $post->post_name;?> .clipmask {
			opacity:<?php echo ($clipmask_opacity/100);?>;
			-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=<?php echo ($clipmask_opacity);?>)";
			filter: alpha(opacity=<?php echo ($clipmask_opacity);?>);
			}
		@media (-webkit-min-device-pixel-ratio: 1.25), (min-resolution: 120dpi){
			#page-separator-<?php echo $post->post_name;?> {
				background-image:url(<?php echo $retina_background_image;?>);
				}
		}					
	</style>
	<div class="page-separator background-type-<?php echo $background_type;?><?php echo $parallax_class;?>" id="page-separator-<?php echo $post->post_name;?>">
		<div class="overlay"></div>
		<div class="clipmask"></div>
		<div class="container">
			<div class="content">
				<?php echo do_shortcode($separator_content); ?>
			</div><!-- .content -->
		</div><!-- .container -->	
	</div><!-- .page-separator #page-separator-<?php echo $post->post_name;?> -->
	
	<?php endif; // enable/disable page separator ?>
	
	<style type="text/css">
		
		<?php if($page_background_color){?>
			.wi-page#<?php echo $post->post_name;?> {
				background-color:<?php echo $page_background_color;?>;
				}
		<?php } ?>

/* --------- BACKGROUND PATTERN OPTIONS ------------ */
<?php if ($page_background_type == 'pattern'): ?>
		
		<?php if($page_background_pattern){
				$pattern = wp_get_attachment_image_src($page_background_pattern,'full');
				$pattern = $pattern[0];
				$background_size = (array) @getimagesize($pattern);
				$background_size = $background_size[0] . 'px ' . $background_size[1] . 'px';
		?>
			.wi-page#<?php echo $post->post_name;?> {
				background-image:url(<?php echo $pattern;?>);
				-webkit-background-size:<?php echo $background_size;?>;
				-moz-background-size:<?php echo $background_size;?>;
				background-size:<?php echo $background_size;?>;
				}
		<?php } ?>
		
		<?php if($page_background_pattern_retina){
				$pattern = wp_get_attachment_image_src($page_background_pattern_retina,'full');
				$pattern = $pattern[0];
		?>
		@media (-webkit-min-device-pixel-ratio: 1.25), (min-resolution: 120dpi){
			.wi-page#<?php echo $post->post_name;?> {
				background-image:url(<?php echo $pattern;?>);
				}
			}	
		<?php } ?>
		
/* --------- BACKGROUND IMAGE OPTIONS ------------ */
<?php elseif ($page_background_type == 'image'): ?>

		<?php if($page_background_image){
			$page_background_image = wp_get_attachment_image_src($page_background_image,'full');
			$page_background_image = $page_background_image[0];
		?>
			.wi-page#<?php echo $post->post_name;?> {
				background-image:url(<?php echo $page_background_image;?>);
				-webkit-background-size:<?php echo $page_background_image_size;?>;
				-moz-background-size:<?php echo $page_background_image_size;?>;
				background-size:<?php echo $page_background_image_size;?>;
				background-position:<?php echo $page_background_image_position;?>;
				}
		<?php } ?>
		
<?php endif; // page background type ?>
				
	</style>
	
	<div <?php post_class('wi-page '.$page_template);?> id="<?php echo $post->post_name;?>">
	<?php if ( !$hide_title ): // if hide title not set to true ?>	
		<!--			TITLE				-->
		<div class="title-area">
			<div class="container">
				<div class="pad">
					<?php if ( $title_image ) : ?>
					<div class="image">
						<img src="<?php echo esc_url($title_image);?>" alt="<?php the_title();?>" />
					</div><!-- .image -->
					<?php endif; // header_image ?>
					<h2 class="title"><?php the_title();?></h2>
					<?php if ($subtitle):?>
					<h3 class="subtitle"><?php echo $subtitle; ?></h3>
					<?php endif;?>
				</div><!-- .pad -->	
			</div><!-- .container -->	
		</div><!-- .title-area -->
	<?php endif; ?>
	
		<div class="content-area">
			<div class="container">
				<?php the_content();?>
			</div><!-- .container -->
		</div><!-- .content-area -->	
		
		<div class="clearfix"></div>
	</div><!-- .wi-page -->
	
	<?php
	endwhile;	// have posts	
endif; // have posts

if (!empty($pages_included)) :	
	
	wp_reset_query();
	
endif;	
?>
<?php get_footer();?>