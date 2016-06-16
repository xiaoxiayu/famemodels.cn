<?php global $smof_data;

	/* display */
$display = get_post_meta( get_the_ID() , '_wi_display' , true );
if ( !$display ) {
	$display = isset ( $smof_data['blog-display'] ) ? $smof_data['blog-display'] : '';
	}
if ( $display!= 'content' ) {
	$display = 'excerpt';
	}

	/* link */
$link = trim(get_post_meta( get_the_ID(),'_wi_url', true));
if ( !$link ) $link = site_url();

$target = esc_attr(get_post_meta( get_the_ID(),'_wi_target', true));

?>
<article <?php post_class('article');?> id="post-<?php the_ID();?>">

	<h2 class="title"><i class="format-icon icon-link"></i><a href="<?php echo esc_url($link);?>" target="<?php echo $target;?>"><?php the_title();?></a></h2>
	
	<?php wi_meta();?>
	
	<div class="post-content">
		<?php the_content(__('Continue Reading','wi'));?>		
	</div><!-- .post-content -->
	
</article><!-- .post -->