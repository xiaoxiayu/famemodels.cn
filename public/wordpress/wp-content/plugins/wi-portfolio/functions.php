<?php
/* ------------------------------------------------------------------------------ */
/* Pagination
/* ------------------------------------------------------------------------------ */
if ( !function_exists('wi_pagination') ) {
function wi_pagination( $custom_query = false , $anchor = ''){
	global $wp_query;
	
	if ( !$custom_query ) $custom_query = $wp_query;

	$big = 999999999; // need an unlikely integer
	$page_num = isset($_GET['paged']) ? $_GET['paged'] : 1; // get_query_var('paged')
	echo '<div class="wi-pagination">';
		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%' . $anchor,
			'current' => max( 1, $page_num ),
			'total' => $custom_query->max_num_pages,
			'type'			=> 'list',
			'prev_text'    => sprintf( __('%s Previous','wi'), '<i class="icon-angle-left"></i>' ),
			'next_text'    => sprintf( __('Next %s','wi'), '<i class="icon-angle-right"></i>' ),
		) );
	echo '<div class="clearfix"></div></div>';
}
}
?>
<?php
// wi subword function
if ( !function_exists('wi_subword') ) {
function wi_subword($str = '',$int = 0, $length = NULL){
	if (!$str) return;
	$words = explode(" ",$str); if (!is_array($words)) return;
	$return = array_slice($words,$int,$length); if (!is_array($return)) return;
	return implode(" ",$return);
}
}
?>
<?php
/* add portfolio shortcode */

if ( !function_exists('wi_portfolio_shortcode') ) {
function wi_portfolio_shortcode($atts,$content = NULL){
	extract(shortcode_atts(array(
		'number'		=>	'-1',	//	number of projects to show, default display all
		'column'		=>	'3',	// 2, 3, 4
		'crop'			=>	'true',	// auto height or custom height
		'belowtitle'	=>	'category',	//	category/subtitle/date/location/nothing
		'filter'		=>	'true',	// display filter or not
		'categories'	=>	'',	// category IDs, separated by commas
		'exclude_categories'	=>	'',	// category IDs, separated by commas
		'include'		=>	'',	// include specified portfolio
		'exclude'		=>	'',	// exclude specified portfolio
		'style'			=>	'1',	// 1 or 2
		'excerpt'		=>	'true',
		'excerpt_length'=>	'14',	// number of words
		'open'			=>	'content', // content or lightbox
		'all'			=>	__('All','wi'),
		'default'		=>	'',
		'pagination'	=>	'false',
	), $atts));
	
	$port_rel = rand(1000,9999);
	
	$data_default = '';	
	if ( $filter!='false' ) $filter = 'true';
	if ( $crop!='false' ) $crop = 'true';
	$number = (int) trim($number);
	$column = intval(trim($column)); if ( $column!=2 && $column!=4 ) $column = 3;
	$thumb = 'thumb-480';
	$thumb .= ( $crop == 'true' ) ? '-crop' : '';
	if (trim($open) != 'lightbox' ) $open = 'content';
	
	if ( $style != '2' ) $style = '1';
	
	wp_enqueue_script('wi-isotope');
	wp_enqueue_style('wi-portfolio');
	
	/* SOME PHP STUFFS
	-------------------------------------------- */	
	$args = array('orderby'=>'slug');
	$args['include'] = $categories;
	$args['exclude'] = $exclude_categories;
	$portfolio_categories = get_terms('portfolio_category',$args);
	$cat_arg = array();
	if ( !empty($portfolio_categories) ) {
		foreach ( (array) $portfolio_categories as $cate ) {
			$cat_arg[] = $cate->term_id;
			if ( $default == $cate->term_id ) {
				$data_default = $cate->slug;
			}
			}
	}
	
	global $wp_query, $post;
	$page_num = isset($_GET['paged']) ? $_GET['paged'] : 1; // get_query_var('paged')
	$paged = $page_num; // (get_query_var('paged')) ? $page_num : 1;
	$portfolio_query = new WP_Query();
	
	if ($include)	$include = explode(',',$include);
	if ($exclude)	$exclude = explode(',',$exclude);
	
	$query_arg = array( 
		'post_type' 			=> 	'portfolio', 
		'posts_per_page' 		=> 	$number, 
		'paged' 				=> 	$paged,
		'tax_query'				=>	array( array(
										'taxonomy'	=>	'portfolio_category',
										'field'		=>	'id',
										'terms'		=>	$cat_arg,
										)
									),		
		);
	
	if (!empty($include)) {
		$query_arg['post__in'] = $include;
		$query_arg['orderby'] = 'post__in';
		}
	if (!empty($exclude)) $query_arg['post__not_in'] = $exclude;
	
	$portfolio_query->query($query_arg);

	if ( !$portfolio_query->have_posts() ) {return;}
	
	ob_start();
	?>
<div class="wi-portfolio-wrapper style-<?php echo $style;?> open-<?php echo $open;?>">
	<?php 
	/* AJAX LOADING CONTAINER 
	-------------------------------------------- */
		wp_enqueue_script( 'wi-wait-for-images' );
		wp_enqueue_script( 'wi-portfolio-ajax' );
		wp_enqueue_script('wi-flexslider');
		wp_enqueue_style('wi-flexslider');
	?>
	
	<div id="portfolio-ajax-wrapper">
		<div class="portfolio-navi">
			<ul>
				<li class="prev"><a href="#"><i class="icon-chevron-left"></i><span><?php _e('Previous','wi');?></span></a></li>
				<li class="next"><a href="#"><span><?php _e('Next','wi');?></span><i class="icon-chevron-right"></i></a></li>
		   </ul>
		</div><!-- portfolio-navi -->
		
		<div class="close-portfolio">
			<a href="#" title="<?php _e('Close','wi');?>">&times;</a>
	   </div>
	   
	   <div class="ajax-loader"></div>
	   
	   <div id="portfolio-ajax-content-container">
			<div id="portfolio-ajax-content"></div>
	   </div><!-- #portfolio-ajax-content-container -->
	
	</div><!-- #portfolio-ajax-wrapper -->
	
	<?php 
	/* FILTER
	-------------------------------------------- */
	if ( $filter == 'true'):
	?>
	<div class="wi-portfolio-filter">	
		<?php
		
		if( !empty($portfolio_categories) ):?>
		<ul>
			<li class="all active">
				<a data-filter="*" href="#">
					<span class="catname"><?php echo $all;?></span>
				</a>
			</li>
			<?php foreach ($portfolio_categories as $cate):?>
			<li>			
				<a data-filter=".wi-<?php echo $cate->slug;?>" href="#">
					<span class="catname"><?php echo $cate->name;?></span>
				</a>
			</li>
			<?php endforeach;?>
		</ul>
		<div class="clearfix"></div>
		<?php endif;?>
	</div><!-- .portfolio-filter -->
	<div class="clearfix"></div>
	<?php endif;	// filter or not ?>	
	<?php
	/* DISPLAY PORTFOLIO ITEMS
	-------------------------------------------- */
	$portfolio_class_attr = 'wi-portfolio portfolio-ajax';
	$portfolio_class_attr .= ' portfolio-'.$column;
	$portfolio_class_attr .= ' style-'.$style;
	?>
	<div class="<?php echo esc_attr($portfolio_class_attr);?>" data-default="<?php echo esc_attr(trim($data_default));?>">
		<?php while ( $portfolio_query->have_posts() ): $portfolio_query->the_post(); ?>
				<?php
					$categories = array();
					$item_classes = array('portfolio-item');
					$item_cats = get_the_terms(get_the_ID(), 'portfolio_category');
					if($item_cats) {
						foreach($item_cats as $item_cat) {
							$item_classes[] = 'wi-' . $item_cat->slug ;
							$categories[] = $item_cat->name;
						}
					}
					$item_classes = implode(' ',$item_classes);
					if ( !empty($categories) ) {
						$categories = implode(' <span class="dot">&middot;</span> ',$categories);
					} else {
						$categories = '';
					}
					$client = trim( get_post_meta( get_the_ID() , '_wi_client' , true ) );
					$location = trim( get_post_meta( get_the_ID() , '_wi_location' , true ) );
					$date = trim( get_post_meta( get_the_ID() , '_wi_date' , true ) );
					$subtitle = trim( get_post_meta( get_the_ID() , '_wi_subtitle' , true ) );
					
				?>				
				<?php if ( $style == '1' ): ?>
										
				<article <?php post_class($item_classes);?> id="portfolio-<?php the_ID();?>">
					<div class="inner">
						<div class="thumb <?php if ($open != 'lightbox') echo 'thumb-content';?>">
							<?php if ( has_post_thumbnail() ):?>
							<?php if ($open == 'lightbox') {
								
								$video_url = get_post_meta( get_the_ID(), '_wi_media' , true );
								if ( !$video_url ) {
									$fullimg = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' );
									$op = '<a href="' . $fullimg[0] . '" class="wi-colorbox" rel="portfolio-' . $port_rel . '" title="' .  get_the_title() . '">';
								} else {
								
									// only for youtube, vimeo and soundcloud

									$video_url = str_replace('watch?v=','embed/',$video_url); // replace youtube video url to embed form
									$video_url = str_replace('vimeo.com/','player.vimeo.com/video/',$video_url); // replace vimeo video url to embed form
									
									if ( strpos($video_url,'soundcloud.com') !== false ) {
										$video_url = 'http://w.soundcloud.com/player/?url=' . urlencode( str_replace('soundcloud.com', 'api.soundcloud.com' , $video_url ) );
										$data_height = ' data-height="166"';
									} else $data_height = '';
									
									$op = '<a href="' . $video_url . '" class="colorbox-video" rel="portfolio-' . $port_rel . '" title="' .  get_the_title() . '"'.$data_height.'>';
								}	
								$cl = '</a>';
							} else {
								$op = ''; $cl = '';
							}	
							?>
							<?php echo $op;?><?php the_post_thumbnail( $thumb );?>
							<?php else: $cl = ''; // do not have post thumbnail ?>
							<img src="<?php echo plugin_dir_url( __FILE__ );?>images/<?php echo str_replace('-crop','',$thumb);?>.jpg" alt="<?php _e('No Image','wi');?>" />
							<?php endif; ?>
							<span class="overlay"></span>
							<span class="name"><span><?php the_title();?></span></span>
							<?php if ( $belowtitle == 'category' ):?>
							<span class="categories belowtitle"><?php echo $categories;?></span>
							<?php elseif ( $belowtitle == 'subtitle' ):?>								
							<span class="belowtitle"><?php echo $subtitle;?></span>
							<?php elseif ( $belowtitle == 'client' ):?>
							<span class="belowtitle"><?php echo $client;?></span>
							<?php elseif ( $belowtitle == 'location' ):?>
							<span class="belowtitle"><?php echo $location;?></span>
							<?php elseif ( $belowtitle == 'date' ):?>
							<span class="belowtitle"><?php echo $date;?></span>
							<?php endif; // belowtitle ?>
							
							<?php echo $cl;?>
															
						</div><!-- .thumb -->		
					</div><!-- .inner -->
				</article><!-- .portfolio-item -->
				
				<?php else: // style == 2 ?>				
				
				<article <?php post_class($item_classes);?> id="portfolio-<?php the_ID();?>">
					<div class="inner">
						<div class="thumb <?php if ($open != 'lightbox') echo 'thumb-content';?>">
							<?php if ( has_post_thumbnail() ):?>
							<?php if ($open == 'lightbox') {
								
								$video_url = get_post_meta( get_the_ID(), '_wi_media' , true );
								if ( !$video_url ) {
									$fullimg = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' );
									$op = '<a href="' . $fullimg[0] . '" class="wi-colorbox" rel="portfolio-' . $port_rel . '" title="' .  get_the_title() . '">';
								} else {
								
									// only for youtube, vimeo and soundcloud

									$video_url = str_replace('watch?v=','embed/',$video_url); // replace youtube video url to embed form
									$video_url = str_replace('vimeo.com/','player.vimeo.com/video/',$video_url); // replace vimeo video url to embed form
									
									if ( strpos($video_url,'soundcloud.com') !== false ) {
										$video_url = 'http://w.soundcloud.com/player/?url=' . urlencode( str_replace('soundcloud.com', 'api.soundcloud.com' , $video_url ) );
										$data_height = ' data-height="166"';
									} else $data_height = '';
									
									$op = '<a href="' . $video_url . '" class="colorbox-video" rel="portfolio-' . $port_rel . '" title="' .  get_the_title() . '"'.$data_height.'>';
								}	
								$cl = '</a>';
							} else {
								$op = ''; $cl = '';
							}
							?>
							<?php echo $op;?><?php the_post_thumbnail( $thumb );?>						
							<?php else: // do not have post thumbnail ?>
							<img src="<?php echo plugin_dir_url( __FILE__ );?>images/<?php echo str_replace('-crop','',$thumb);?>.jpg" alt="<?php _e('No Image','wi');?>" />
							<?php endif; ?>
							
							<?php echo $cl;?>
													
						</div><!-- .thumb -->
						
						<h3 class="name"><span><?php the_title();?></span></h3>
						
						<div class="meta">
						
						<?php if ( $belowtitle == 'category' ):?>
						<span class="categories belowtitle"><?php echo $categories;?></span>
						<?php elseif ( $belowtitle == 'subtitle' ):?>								
						<span class="belowtitle"><?php echo $subtitle;?></span>
						<?php elseif ( $belowtitle == 'client' ):?>
						<span class="belowtitle"><?php echo $client;?></span>
						<?php elseif ( $belowtitle == 'location' ):?>
						<span class="belowtitle"><?php echo $location;?></span>
						<?php elseif ( $belowtitle == 'date' ):?>
						<span class="belowtitle"><?php echo $date;?></span>
						<?php endif; ?>
						
						</div><!-- .meta -->
						
						<?php if ( $excerpt == 'true' ) : 
						$excerpt_length = absint($excerpt_length);
						?>
						<div class="excerpt">
							<p><?php echo wi_subword( get_the_excerpt(), 0, $excerpt_length ) ; ?></p>
						</div><!-- .excerpt -->
						<?php endif; ?>
						
					</div><!-- .inner -->
				</article><!-- .portfolio-item -->
				
				<?php endif; // which style 1 or 2 ?>
				
		<?php endwhile; ?>
		
	</div><!-- .wi-portfolio -->
	
	<div class="clearfix"></div>
	
	<?php if ( $pagination!='false' ) {?>
		
	<?php wi_pagination( $portfolio_query, '#portfolio-2' ); ?>
	
	<div class="clearfix"></div>
	
	<?php } ?>
	
</div><!-- .wi-portfolio-wrapper -->
	<?php
	$return = ob_get_clean();	
	return $return;
}
}
add_shortcode('portfolio','wi_portfolio_shortcode');

add_action('wp_ajax_nopriv_wi_load_portfolio','wi_load_portfolio_content');
add_action('wp_ajax_wi_load_portfolio','wi_load_portfolio_content');
if ( !function_exists('wi_load_portfolio_content') ) {
function wi_load_portfolio_content() {
	
	global $smof_data;

	$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
	if ( !$id ) {die();return;}
	global $post;
	$post = get_post($id);
	setup_postdata($post);
	
	/*	Project info
	------------------------------ */
	$client = trim( get_post_meta( get_the_ID() , '_wi_client' , true ) );
	$location = trim( get_post_meta( get_the_ID() , '_wi_location' , true ) );
	$date = trim( get_post_meta( get_the_ID() , '_wi_date' , true ) );
	$url = trim( get_post_meta( get_the_ID() , '_wi_url' , true ) );
	$target = get_post_meta( get_the_ID() , '_wi_url-target' , true );
	$hide_cats = get_post_meta( get_the_ID() , '_wi_hide-portfolio-categories' , true );
	$categories = wp_get_post_terms(get_the_ID(),'portfolio_category');
	$cats_array = array();
	foreach ( $categories as $cate ) {
		$cats_array[] = $cate->name;
	}
	$categories = implode(' <span class="dot">&middot;</span> ',$cats_array);
	if ( $target!= '_blank' ) $target = '_self';
	$has_info = $client || $location || $date || $categories;
	
	$client_label = isset( $smof_data['portfolio-client-label'] ) ? $smof_data['portfolio-client-label'] : __('Client:','wi');
	$location_label = isset( $smof_data['portfolio-location-label'] ) ? $smof_data['portfolio-location-label'] : __('Location:','wi');
	$date_label = isset( $smof_data['portfolio-date-label'] ) ? $smof_data['portfolio-date-label'] : __('Date:','wi');
	$url_label = isset( $smof_data['portfolio-url-label'] ) ? $smof_data['portfolio-url-label'] : __('Launch Project','wi');
	$cat_label = isset( $smof_data['portfolio-cat-label'] ) ? $smof_data['portfolio-cat-label'] : __('Categories:','wi');
	
	/*	Display
	------------------------------ */
	$layout = get_post_meta( get_the_ID() , '_wi_layout' , true );
	if ( $layout != 'full' ) $layout = 'half';
	$link_to_full = get_post_meta( get_the_ID() , '_wi_thumbnail-link-to-full' , true );
	$crop = get_post_meta( get_the_ID() , '_wi_crop-thumbnail' , true );
	$crop = $crop ? '-crop' : '';
	
	$thumb = $layout == 'full' ? 'thumb-940' : 'thumb-600';
	$thumb .= $crop;
	
	/*	Slideshow
	------------------------------ */
	$slideshow = get_post_meta( get_the_ID() , '_wi_slideshow-images' );
	$auto = get_post_meta( get_the_ID() , '_wi_slideshow-auto' , true );
	$auto = $auto ? 'true' : 'false';
	$navi = get_post_meta( get_the_ID() , '_wi_slideshow-navi' , true );
	$navi = $navi ? 'true' : 'false';
	
	/*	Media Code
	------------------------------ */
	$media_code = trim( get_post_meta( get_the_ID() , '_wi_media' , true ) );
	$self_hosted_video = trim( get_post_meta( get_the_ID() , '_wi_self-hosted-video' , true ) );
	$self_hosted_audio = trim( get_post_meta( get_the_ID() , '_wi_self-hosted-audio' , true ) );
	if ( $media_code ) {
		global $wp_embed;
		$media_result = $wp_embed->run_shortcode('[embed]' . $media_code . '[/embed]');
	} elseif ( $self_hosted_video ) {
		$media_result = do_shortcode('[video src="' . esc_url($self_hosted_video) . '" width="940" /]');
	} elseif ( $self_hosted_audio ) {
		$media_result = do_shortcode('[audio src="' . esc_url($self_hosted_audio) . '" /]');
	} else {
		$media_result = '';
	}

	?>
	
	<div class="portfolio-content layout-<?php echo esc_attr($layout);?>" id="portfolio-content">
		<div class="inner">
			<div class="thumb">
				<?php 
				/* VIDEO/AUDIO THUMBNAIL
				-------------------------------------------- */
				if ( $media_result ): ?>
				<div class="media-container">
					<?php echo $media_result; ?>
				</div><!-- .media-container -->
				<?php 
				/* SLIDESHOW
				-------------------------------------------- */
				elseif ( !empty($slideshow) ): ?>
				<div class="portfolio-thumb-slider" data-navi="<?php echo $navi;?>" data-auto="<?php echo $auto;?>">
					<div class="flexslider">
						<ul class="slides">
							<?php
							foreach ( $slideshow as $attachment ):
							
								$attachment_src = wp_get_attachment_image_src( $attachment, $thumb );
								
								if ( !$attachment_src ) continue;
								
								if ( $link_to_full ) {
									$full_src = wp_get_attachment_image_src( $attachment , 'full' );
									$open = '<a href="' . esc_url ( $full_src[0] ) . '" class="wi-colorbox">';
									$close = '</a>';
								} else {
									$open = $close = '';
								}

								?>
								<li class="slide"><?php echo $open;?><img src="<?php echo esc_url ( $attachment_src[0] );?>" alt="<?php echo basename( $attachment_src[0] );?>" /><?php echo $close;?></li>							
							<?php
							
							endforeach;
							?>
						</ul><!-- .slides -->
					</div><!-- .flexslider -->
				</div><!-- .portfolio-thumb-slider -->
				<?php 
				/* IMAGE
				-------------------------------------------- */
				elseif ( has_post_thumbnail() ):
						if ( $link_to_full ) {
							$full_src = wp_get_attachment_image_src( get_post_thumbnail_id() , 'full' );
							$open = '<a href="' . esc_url ( $full_src[0] ) . '" class="wi-colorbox">';
							$close = '</a>';
						} else {
							$open = $close = '';
						}
				echo $open . get_the_post_thumbnail(get_the_ID(),$thumb) . $close ; ?>				
				<?php
				/* PLACEHOLDER IMAGE
				-------------------------------------------- */
				else:	// no post thumbnail
				?>
				<img src="<?php echo plugin_dir_url( __FILE__ );?>images/<?php echo str_replace('-crop','',$thumb);?>.jpg" alt="<?php _e('No Image');?>" />
				<?php endif;	// endif which thumbnail type ?>
			</div><!-- .thumb -->
			<div class="details">
				<h3><?php the_title();?></h3>
				<?php $content = trim(get_the_content()); if ( !empty( $content ) ): ?>
				<div class="desc">
					<?php the_content();?>		
				</div><!-- .desc -->
				<?php endif; // content?>
				<?php if ( $has_info ): ?>
				<div class="info">
					<ul>
						<?php if ( $client ):?>
						<li><i class="icon-user"></i><span class="label"><?php echo $client_label;?></span> <span class="prop"><?php echo $client;?></span></li>
						<?php endif;?>
						<?php if ( $location ):?>
						<li><i class="icon-map-marker"></i><span class="label"><?php echo $location_label;?></span> <span class="prop"><?php echo $location;?></span></li>
						<?php endif; ?>
						<?php if ( $date ): ?>
						<li><i class="icon-time"></i><span class="label"><?php echo $date_label;?></span> <span class="prop"><?php echo $date;?></span></li>
						<?php endif; ?>
						<?php if ( $categories && !$hide_cats ): ?>
						<li><i class="icon-tags"></i><span class="label"><?php echo $cat_label;?></span> <span class="prop"><?php echo $categories;?></span></li>
						<?php endif; ?>					
					</ul>
				</div><!-- .info -->
				<?php endif; // show info && has_info ?>
				<?php if ( $url ): ?>
				<div class="launch">
					<a class="btn-launch" href="<?php echo esc_url($url);?>" target="<?php echo $target;?>"><?php echo $url_label;?></a>
				</div><!-- .wi-button -->
				<?php endif; ?>
			</div><!-- .details -->
		</div><!-- .inner -->	
	</div><!-- #portfolio-content -->
	
	<?php
	wp_reset_postdata($post);	
	die();
}
}