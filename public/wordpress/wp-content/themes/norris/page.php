<?php global $smof_data; ?>
<?php get_header();?>
<?php	
if (have_posts()) :?>
	<div class="container">
	<?php while(have_posts()): the_post(); ?>	
		<article <?php post_class('article wi-single');?> id="post-<?php the_ID();?>">
					
			<?php the_content();?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links-container"><div class="page-links"><div class="page-links-label">' . __( 'Pages:', 'wi' ) . '</div>', 'after' => '</div></div>', 'pagelink' => '<span>%</span>' ) ); ?>
		
		</article><!-- .article -->	
	<?php endwhile;?>
	</div><!-- .container -->	
<?php endif; ?>
<?php get_footer();?>