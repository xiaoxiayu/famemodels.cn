<?php 
	global $smof_data;
	$quote_content = trim ( get_post_meta ( get_the_ID() , '_wi_quote-content' , true ) );
	$quote_author = get_post_meta ( get_the_ID() , '_wi_quote-author' , true );
	if ( $quote_author && $quote_author_url = get_post_meta ( get_the_ID() , '_wi_quote-author-url' , true ) ) {
		$quote_author = '<a href="' . esc_url ( $quote_author_url ) . '">' . $quote_author . '</a>';
	}
?>
<article <?php post_class('article');?> id="post-<?php the_ID();?>">
	<div class="blockquote">
		<blockquote>
			<p><?php echo $quote_content;?></p>
			<?php if ( $quote_author ):?>
			<cite class="quote-author"><?php echo $quote_author;?></cite>
			<?php endif;?>
		</blockquote>
	</div><!-- .excerpt -->
</article><!-- .post -->