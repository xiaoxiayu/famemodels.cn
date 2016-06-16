<?php if ( is_onepage() ) return;

global $wp_query, $post, $smof_data;
$title = ''; $subtitle = '';
?>
<div class="headline">
	<div class="container"><div class="pad">
		<?php if ( is_home() ) {
			$title = isset( $smof_data['blog-title'] ) ? $smof_data['blog-title'] : __('Blog','wi');
			$subtitle = isset( $smof_data['blog-subtitle'] ) ? $smof_data['blog-subtitle'] : __('Just tell your stories.','wi');
		} elseif ( is_category() ) {
			$this_cat = get_category(get_query_var('cat'), false);
			$title = single_cat_title('', false);
			$subtitle = do_shortcode( trim($this_cat->description) );
		} elseif ( is_search() ) {
			$title  = get_search_query();
			$subtitle = sprintf(__('%s result(s) found.','wi'), $wp_query->found_posts);
		} elseif ( is_day() ) {
			$title = get_the_time('F d, Y');
		} elseif ( is_month() ) {
			$title = get_the_time('F Y');
		} elseif ( is_year() ) {
			$title = get_the_time('Y');
		} elseif ( is_page() ) {
			$title = get_the_title();
			$subtitle = get_post_meta(get_the_ID(),'_wi_subtitle',true);
		} elseif ( is_single() ) {
			$title = get_the_title();
		}  elseif ( is_singular('product') ) {
			$title = get_the_title();
		} elseif ( is_post_type_archive('product') || is_tax('product_cat') || is_tax('product_tag') ) {
			$title = woocommerce_page_title(false);
			$shop_page_id = wc_get_page_id( 'shop' );
			$subtitle = is_shop() ? get_post_meta($shop_page_id,'_wi_subtitle',true) : '';
		} elseif ( is_tag() ) {
			$tag_id = intval(get_query_var('tag_id'));
			$this_tag = get_term($tag_id , 'post_tag');
			$title = single_tag_title('', false);		
			$subtitle = do_shortcode ( trim ($this_tag->description));
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			$title = $userdata->display_name;
			$count = count_user_posts($userdata->ID);
			$subtitle = sprintf( __('<span>%1$s</span> has %2$s articles published.','wi'), $title, $count );
		} elseif ( is_404() ) {
			$title = __('Not found','wi');
		}
		
		if ( get_query_var('paged') ) {			
			$page_text = sprintf(__(' - Page %d','wi') , get_query_var('paged') );
		}	else $page_text = '';
		
		$title = $title . $page_text;
				
		$title = apply_filters('wi_headline_title',$title);		
		?>
		<?php if ( !is_singular('post') ):?>
		<h1 class="page-title"><?php echo $title;?></h1>
		<?php if ( $subtitle ) {?>
		<h2 class="page-subtitle"><?php echo $subtitle;?></h2>
		<?php } ?>
		<?php else : ?>
		<h1 class="post-title"><?php echo $title;?></h1>
		<div class="meta">
			<?php if ( isset ( $smof_data['blog-date'] ) && $smof_data['blog-date'] ):?>
			<div class="ele time"><time data-time="<?php echo get_the_date('c');?>"><?php echo get_the_date( get_option('date_format') );?></time></div>
			<?php endif;?>
			<?php if ( isset ( $smof_data['blog-categories'] ) && $smof_data['blog-categories'] ):?>
			<div class="ele categories"><?php echo get_the_category_list('<span class="sep">|</span>') ;?></div>
			<?php endif;?>
			<?php if ( isset ( $smof_data['blog-comments-link'] ) && $smof_data['blog-comments-link'] ):?>
			<div class="ele comments">
				<?php comments_popup_link( __('0 comments','wi'), __('1 comment','wi'), __('% comments','wi'),'', __('Off','wi') ); ?>
			</div><!-- .comments -->
			<?php endif; ?>
		</div><!-- .meta -->
		<?php endif; // is_single() ?>
	</div></div><!-- .container -->
</div><!-- .headline -->