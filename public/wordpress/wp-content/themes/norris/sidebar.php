<?php
global $smof_data;
?>
<?php if (is_active_sidebar('main')):?>
<div id="secondary" class="widget-area span4" role="complementary">
	<?php dynamic_sidebar( 'main' ); ?>
</div><!-- #secondary -->
<?php endif;?>