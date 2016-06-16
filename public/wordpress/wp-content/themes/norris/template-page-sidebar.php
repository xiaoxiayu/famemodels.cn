<?php
/*
Template Name: Page with sidebar
*/
?>
<?php global $smof_data; ?>
<?php get_header();?>
<div class="container">
<div class="row-fluid">
	<div id="primary" class="span8">
<?php	
if (have_posts()) :?>
	<?php while(have_posts()): the_post(); ?>	
		<article <?php post_class('article wi-single');?> id="post-<?php the_ID();?>">
					
			<?php the_content();?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links-container"><div class="page-links"><div class="page-links-label">' . __( 'Pages:', 'wi' ) . '</div>', 'after' => '</div></div>', 'pagelink' => '<span>%</span>' ) ); ?>
		
		</article><!-- .article -->	
	<?php endwhile;?>
<?php endif; ?>
	</div><!-- #primary .span8 -->
	<?php get_sidebar();?>
</div><!-- .row-fluid -->
</div><!-- .container -->
<?php get_footer();?>