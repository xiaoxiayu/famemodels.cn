<?php global $smof_data; ?>
<?php get_header();?>
<div class="container">
<div class="row-fluid">
	<div id="primary" class="span8">
<?php	
	if (have_posts()) :?>
	<?php while(have_posts()): the_post(); ?>	
		<article <?php post_class('article wi-single');?> id="post-<?php the_ID();?>">
			<?php
			/*------------------------		PHP Stuffs		------------------------------- */
			
			/* Post format
			------------------------------------- */
			$post_format = get_post_format();
			
			/* Display featured or not
			------------------------------------- */
			$show_featured_image = get_post_meta( get_the_ID() , '_wi_show-featured-image' , true );
			if ( !$show_featured_image ) {
				$show_featured_image = ( isset ( $smof_data['single-featured-image'] ) && $smof_data['single-featured-image'] ) ? 'yes' : 'no';
				}
			$show_featured_image = ( $show_featured_image != 'no' ) ? true : false;
			
			/* Crop or not
			------------------------------------- */
			$cropmode = get_post_meta( get_the_ID() , '_wi_single-thumb-crop' , true );
			if ( !$cropmode ) {
				$cropmode = ( isset ( $smof_data['single-thumb-crop'] ) && $smof_data['single-thumb-crop'] ) ? 'yes' : 'no';
			}
			$cropmode = ( $cropmode != 'no' ) ? '-crop' : '';
			
			/* Link to full or not
			------------------------------------- */
			$link_to_full = get_post_meta( get_the_ID() , '_wi_featured-image-link-to-full' , true );
			if ( !$link_to_full ) {
				$link_to_full = ( isset ( $smof_data['single-featured-image-link-to-full'] ) && $smof_data['single-featured-image-link-to-full'] ) ? 'yes' : 'no';				
			}
			$link_to_full = ( $link_to_full != 'no' ) ? true : false;
			?>
			
			<?php /*------------------------		THUMBNAIL		------------------------------- */ ?>
			<?php
if ( $show_featured_image )	:
			/* Gallery
			------------------------------------- */
			if ( $post_format == 'gallery' ):?>
			
			<?php wi_blog_slider(); ?>
			
			<?php 
			/* Video and Audio
			------------------------------------- */
			elseif ( $post_format == 'video' || $post_format == 'audio' ):?>
			
			<?php
			/* media code */
			$media_code = trim( get_post_meta( get_the_ID() , '_wi_media' , true ) );
			$self_hosted_media_code = trim( get_post_meta( get_the_ID() , '_wi_self-hosted-media' , true ) );
			if ( $media_code ) {
				global $wp_embed;
				$media_result = $wp_embed->run_shortcode('[embed]' . $media_code . '[/embed]');
			} elseif ( $self_hosted_media_code ) {
				if ( has_post_thumbnail() ) {
					$poster = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ) , 'full' );
					$poster = ' poster="' . esc_url( $poster[0] ) . '"';
				} else $poster = '';
				
				if ( $post_format == 'video' ) $tag_element = 'video';
				else $tag_element = 'audio';
				$media_result = do_shortcode('['.$tag_element.' src="' . esc_url($self_hosted_media_code) . '"'.$poster.' /]');	
			} else {
				$media_result = '';
			}
			?>
			
			<div class="post-thumbnail">
				<div class="media-container">
					<?php echo $media_result; ?>
				</div><!-- .media-container -->
			</div><!-- .post-thumbnail -->
			
			<?php
			
			/* Standard Post (exclude link & quote)
			------------------------------------- */
			elseif ( $post_format != 'link' && $post_format != 'quote' && has_post_thumbnail() ):
			if ( $link_to_full == 'yes' ) {
				$full_src = wp_get_attachment_image_src( get_post_thumbnail_id() , 'full' );
				$open = '<a href="' . esc_url ( $full_src[0] ) . '">';
				$close = '</a>';
			} else {
				$open = $close = '';
			}
			?>
			
			<div class="post-thumbnail">
				<?php echo $open; ?>
				<?php the_post_thumbnail('thumb-600'. $cropmode); ?>
				<?php echo $close; ?>
			</div><!-- .post-thumbnail -->
				
			<?php endif; // which type ?>
			
<?php endif; // show featured image ?>
			
			
			<?php /*------------------------		POST CONTENT		------------------------------- */ ?>
			<div class="post-content">
			
			<?php 
			/* Format link
			------------------------------------- */
			if ( $post_format == 'link' ): ?>
				<div class="link-area">
					<a href="<?php echo esc_url( get_post_meta ( get_the_ID() , '_wi_url' , true) );?>" target="<?php echo esc_attr(get_post_meta( get_the_ID(),'_wi_target', true));?>" class="link-button"><?php _e('Open link','wi');?></a>
					<p class="url"><?php echo esc_attr( urldecode( get_post_meta ( get_the_ID() , '_wi_url' , true) ) );?></p>
				</div>
			<?php 
			/* Format Quote
			------------------------------------- */
			elseif ( $post_format == 'quote' ): ?>
			<?php 
				$quote_author = get_post_meta ( get_the_ID() , '_wi_quote-author' , true );
				if ( $quote_author && $quote_author_url = get_post_meta ( get_the_ID() , '_wi_quote-author-url' , true ) ) {
					$quote_author = '<a href="' . esc_url ( $quote_author_url ) . '">' . $quote_author . '</a>';
				}					
				?>					
				<blockquote>
					<p><?php echo get_post_meta ( get_the_ID() , '_wi_quote-content' , true );?></p>
					<?php if ( $quote_author ):?>
					<cite class="quote-author"><?php echo $quote_author;?></cite>
					<?php endif;?>
				</blockquote>
				
			<?php endif; ?>

			<!--	//////////////////	CONTENT		///////////////////		-->
			<?php the_content();?>			
			<?php wp_link_pages( array( 'before' => '<div class="page-links-container"><div class="page-links"><div class="page-links-label">' . __( 'Pages:', 'wi' ) . '</div>', 'after' => '</div></div>', 'pagelink' => '<span>%</span>' ) ); ?>
			
			</div><!-- .post-content -->
			
			<?php /*------------------------		NAVIGATION		------------------------------- */ ?>
			<?php if ( isset($smof_data['single-nav']) && $smof_data['single-nav'] ):?>
			<nav class="post-nav">
				<?php previous_post_link( '<div class="prev ele">%link</div>', __('<i class="icon-chevron-left"></i> Previous Post', 'wi' )  ); ?>
				<?php if( get_next_post() && get_previous_post() ):?>
				<div class="nav-sep"></div>
				<?php endif;?>
				<?php next_post_link( '<div class="next ele">%link</div>', __('Next Post <i class="icon-chevron-right"></i>', 'wi' )  ); ?>
			</nav><!-- .post-nav -->
			<?php endif; // nav ?>
			
			<?php /*------------------------		TAGS		------------------------------- */ ?>
			<?php if ( isset($smof_data['single-tags']) && $smof_data['single-tags'] && $tag_list = get_the_tag_list('', '<span class="sep">/</span>')):
			?>
			<div class="tags">
				<span class="tag-label"><i class="icon-tags"></i></span>
				<?php echo $tag_list;?>				
			</div><!-- .tags -->
			<?php endif; ?>
			
			<?php /*------------------------		AUTHORBOX		------------------------------- */ ?>
			<?php if ( isset($smof_data['single-authorbox']) && $smof_data['single-authorbox'] ):?>
			
			<div class="authorbox">
				<div class="inner">
					<div class="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wi_author_bio_avatar_size', 120 ) ); ?>
					</div><!-- .author-avatar -->
					<div class="text">
						<h4><?php printf( __( 'About %s', 'wi' ), '<a href=" ' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="author"> ' . get_the_author() . '</a>' ); ?></h4>
						<div class="desc">
							<p><?php the_author_meta( 'description' ); ?></p>							
						</div><!-- .desc -->
					</div><!-- .text -->
				</div><!-- .inner -->	
			</div><!-- .authorbox -->
			
			<?php endif;	// single author box ?>
			
			<?php /*------------------------		COMMENTS		------------------------------- */ ?>
			<?php comments_template( '', true ); ?>
							
		</article><!-- .wi-single -->
	<?php endwhile;?>	
<?php endif; ?>	
	</div><!-- #primary .span8 -->
	<?php get_sidebar();?>
</div><!-- .row-fluid -->
</div><!-- .container -->	
<?php get_footer();?>