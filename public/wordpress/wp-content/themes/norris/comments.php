<?php
global $smof_data;
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _n( '1 Comment', '%s Comments', get_comments_number(), 'wi' ),
					number_format_i18n( get_comments_number() ) );
			?>
		</h2>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'wi_comment', 'style' => 'ol' ) ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comments-navigation" role="navigation">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'wi' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'wi' ) ); ?></div>
			<div class="clearfix"></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'wi' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>
	
	<?php 
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$args = array(
		'fields' => apply_filters( 'comment_form_default_fields', array(		
			'author' =>
			'<div class="comment-ele">' .
			'<label for="author">' . __( 'Name', 'wi' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
			'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			'" size="30"' . $aria_req . ' /></div>',
			
			'email' =>
			'<div class="comment-ele"><label for="email">' . __( 'Email', 'wi' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . 
			'<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .
			'" size="30"' . $aria_req . ' /></div>',
			
			'url' =>
			'<div class="comment-ele"><label for="url">' .
			__( 'Website', 'wi' ) . '</label>' .
			'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
			'" size="30" /></div>'
			)
		),
		
		'comment_field' =>  '<div class="comment-ele"><label for="comment">' . __( 'Comment', 'wi' ) .
		'</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>',
		
		'comment_notes_after'	=>	'',
		
		'label_submit'		=>	__('Post Comment','wi'),
		
	);
	?>
	<?php comment_form($args); ?>

</div><!-- #comments .comments-area -->