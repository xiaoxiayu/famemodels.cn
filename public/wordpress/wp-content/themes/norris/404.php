<?php global $smof_data; ?>
<?php get_header();?>
<div class="container">
<div class="row-fluid">
	<div id="primary" class="span8 offset2 notfound">
		<h1 class="h1-404">404</h1>
		<h2><?php _e('Oops, This Page Could Not Be Found!','wi');?></h2>
		<div class="notfound-text">
			<?php $notfound = isset($smof_data['404-text']) ? $smof_data['404-text'] : __('404 - Not found','wi'); ?>
			<p><?php echo $notfound; ?></p>
		</div><!-- .notfound-text -->
		<div class="wi-heading">
			<h3 class="h"><?php _e('Search our website','wi');?></h3>
		</div><!-- .wi-heading -->	
		<?php get_search_form(); ?>
	</div><!-- #primary -->
</div><!-- .row-fluid -->
</div><!-- .container -->	
<?php get_footer();?>