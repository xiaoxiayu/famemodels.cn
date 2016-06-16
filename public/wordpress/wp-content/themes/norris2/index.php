<?php global $smof_data; ?>
<?php get_header();?>
<div class="container">
<div class="row-fluid">
	<div id="primary" class="span8">
<?php	
	if (have_posts()) :?>
	<div class="wi-blog">
	<?php
		while(have_posts()): the_post();
			get_template_part('loop/content', get_post_format());
		endwhile;	
	endif;
	wi_pagination();	
	?>
	</div><!-- .wi-blog -->
	</div><!-- #primary .span8 -->
	<?php get_sidebar();?>
</div><!-- .row-fluid -->
</div><!-- .container -->
<?php get_footer();?>