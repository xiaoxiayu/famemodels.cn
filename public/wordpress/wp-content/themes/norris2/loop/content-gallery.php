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

	/* thumbnail crop? */
$cropmode = get_post_meta( get_the_ID() , '_wi_blog-thumb-crop' , true );
if ( !$cropmode ) {
	$cropmode = ( isset ( $smof_data['blog-thumb-crop'] ) && $smof_data['blog-thumb-crop'] ) ? 'yes' : 'no';	
}
$cropmode = ( $cropmode != 'no' ) ? '' : '-nocrop';

	/* gallery options */
$effect = get_post_meta( get_the_ID() , '_wi_gallery-effect' , true );
if ( $effect != 'fade' ) $effect = 'slide';
$navi = get_post_meta ( get_the_ID(), '_wi_gallery-navi', true ) ? 'true' : 'false';
$auto = get_post_meta ( get_the_ID(), '_wi_gallery-auto', true ) ? 'true' : 'false';
$smooth_height = get_post_meta ( get_the_ID(), '_wi_smooth-height', true ) ? 'true' : 'false';
?>

<article <?php post_class('article');?> id="post-<?php the_ID();?>">

	<?php wi_blog_slider(); ?>
	
	
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