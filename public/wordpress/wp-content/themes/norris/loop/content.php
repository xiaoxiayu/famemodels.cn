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
$cropmode = ( $cropmode != 'no' ) ? '-crop' : '';

	/* link to post */
$link_to_post = get_post_meta( get_the_ID() , '_wi_blog-thumb-link-to-post' , true );
if ( !$link_to_post ) {
	$link_to_post = ( isset ( $smof_data['blog-thumb-link-to-post'] ) && $smof_data['blog-thumb-link-to-post'] ) ? 'yes' : 'no';	
}
$link_to_post = ( $link_to_post != 'no' ) ? 'yes' : 'no';
if ( $link_to_post == 'yes' ) {
	$open = '<a href="' . get_permalink() . '">';
	$close = '';
} else {
	$open = $close = '';
}
?>

<article <?php post_class('article');?> id="post-<?php the_ID();?>">

	<?php if ( has_post_thumbnail() ):?>
	<div class="post-thumbnail">
		<?php echo $open; ?>
		<?php the_post_thumbnail('thumb-600'. $cropmode); ?>
		<?php echo $close; ?>
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