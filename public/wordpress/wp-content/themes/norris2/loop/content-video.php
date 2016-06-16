<?php 
global $smof_data;

	/* content or excerpt */
$display = get_post_meta( get_the_ID() , '_wi_display' , true );
if ( !$display ) {
	$display = isset ( $smof_data['blog-display'] ) ? $smof_data['blog-display'] : '';
	}
if ( $display!= 'content' ) {
	$display = 'excerpt';
	}

	/* media */
$media_code = trim( get_post_meta( get_the_ID() , '_wi_media' , true ) );
$self_hosted_media_code = trim( get_post_meta( get_the_ID() , '_wi_self-hosted-media' , true ) );
if ( $media_code ) {
	global $wp_embed;
	$media_result = $wp_embed->run_shortcode('[embed]' . $media_code . '[/embed]');
} elseif ( $self_hosted_media_code ) {
	$media_result = do_shortcode('[video src="' . esc_url($self_hosted_media_code) . '" /]');
} else {
	$media_result = '';
}
?>

<article <?php post_class('article');?> id="post-<?php the_ID();?>">

	<?php if ( $media_result ):?>
	<div class="post-thumbnail">
		<div class="media-container">
			<?php echo $media_result; ?>
		</div><!-- .media-container -->
	</div><!-- .post-thumbnail -->
	<?php endif;	// has post thumbnail ?>
	
	<h2 class="title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
	
	<?php wi_meta(); ?>
	
	<?php if ( $display == 'excerpt' ) :?>
	
		<div class="excerpt">
			<?php the_excerpt(); ?>
		</div><!-- .excerpt -->
		<?php if ( isset ( $smof_data['blog-readmore'] ) && $smof_data['blog-readmore'] ):?>
			<a href="<?php the_permalink();?>" class="more-link"><?php _e('Read more','wi');?></a>
		<?php endif;?>
	
	<?php else: // display content ?>
	
		<div class="post-content">
			<?php the_content(__('Continue Reading','wi'));?>		
		</div><!-- .post-content -->
	
	<?php endif; ?>
	
</article><!-- .post -->