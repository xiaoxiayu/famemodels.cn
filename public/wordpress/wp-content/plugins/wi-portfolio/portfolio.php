<?php
/* --------------------------------------------------- */
/* Register Portfolio
/* --------------------------------------------------- */
add_action( 'init', 'wi_register_portfolio_custom_post_type' );
if ( !function_exists('wi_register_portfolio_custom_post_type') ) {
function wi_register_portfolio_custom_post_type() {
	$labels = array(
		'name' 				=> _x('Portfolio','post type general name','wi'),
		'singular_name' 	=> _x('Portfolio','post type singular name','wi'),
		'add_new' 			=> __('Add New','wi'),
		'add_new_item' 		=> __('Add New Project','wi'),
		'edit_item' 		=> __('Edit Project','wi'),
		'new_item' 			=> __('New Project','wi'),
		'all_items' 		=> __('All Projects','wi'),
		'view_item'			=> __('View Portfolio','wi'),
		'search_items' 		=> __('Search Portfolio','wi'),
		'not_found'			=> __('No projects found','wi'),
		'not_found_in_trash'=> __('No projects found in Trash','wi'),
		'parent_item_colon' => '',
		'menu_name' 		=> _x('Portfolio','post type general name','wi'),
	);
	
	$args = array(
		'labels' 			=> $labels,
		'public' 			=> true,
		'publicly_queryable'=> true,
		'show_ui'			=> true, 
		'show_in_menu' 		=> true, 
		'query_var' 		=> true,
		'rewrite' 			=> array( 'slug' => 'portfolio_item','wi'),
		'capability_type' 	=> 'post',
		'has_archive' 		=> true,
		'hierarchical' 		=> false,
		'menu_position' 	=> null,
		'supports' 			=> array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	); 
	
	register_post_type( 'portfolio', $args );
}
}
/* --------------------------------------------------- */
/* Register Portfolio Category
/* --------------------------------------------------- */
add_action( 'init', 'wi_register_portfolio_category', 0 );

if ( !function_exists('wi_register_portfolio_category') ) {
function wi_register_portfolio_category(){
	$labels = array(
		'name'                => _x( 'Portfolio Categories', 'taxonomy general name','wi'),
		'singular_name'       => _x( 'Portfolio Category', 'taxonomy singular name','wi'),
		'search_items'        => __( 'Search Portfolio Categories','wi'),
		'all_items'           => __( 'All Portfolio Categories','wi'),
		'parent_item'         => __( 'Parent Portfolio Category','wi'),
		'parent_item_colon'   => __( 'Parent Portfolio Category:','wi'),
		'edit_item'           => __( 'Edit Portfolio Category','wi'), 
		'update_item'         => __( 'Update Portfolio Category','wi'),
		'add_new_item'        => __( 'Add New Portfolio Category','wi'),
		'new_item_name'       => __( 'New Portfolio Category Name','wi'),
		'menu_name'           => __( 'Portfolio Category','wi')
	); 	
	
	$args = array(
		'hierarchical'        => true,
		'labels'              => $labels,
		'show_ui'             => true,
		'show_admin_column'   => true,
		'query_var'           => true,
		'rewrite'             => array( 'slug' => 'portfolio_category' )
	);
	
	register_taxonomy( 'portfolio_category', array( 'portfolio'), $args );
}

}

/* --------------------------------------------------- */
/* Filter Portfolios by Categories in Edit Screen (edit.php)
/* Source: http://wordpress.org/support/topic/add-taxonomy-filter-to-admin-list-for-my-custom-post-type
/* --------------------------------------------------- */

add_action('restrict_manage_posts', 'wi_restrict_portfolios_by_category');
if ( !function_exists('wi_restrict_portfolios_by_category') ){
function wi_restrict_portfolios_by_category() {
		global $typenow;
		$post_type = 'portfolio'; // change HERE
		$taxonomy = 'portfolio_category'; // change HERE
		if ($typenow == $post_type) {
			$selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
			$info_taxonomy = get_taxonomy($taxonomy);
			wp_dropdown_categories(array(
				'show_option_all' => sprintf(__('All %s','wi') , $info_taxonomy->label ),
				'taxonomy' => $taxonomy,
				'name' => $taxonomy,
				'orderby' => 'name',
				'selected' => $selected,
				'show_count' => true,
				'hide_empty' => true,
			));
		}
}
}	
add_filter('parse_query', 'wi_convert_id_to_term_in_query');
if ( !function_exists('wi_convert_id_to_term_in_query') ) {
function wi_convert_id_to_term_in_query($query) {
		global $pagenow;
		$post_type = 'portfolio'; // change HERE
		$taxonomy = 'portfolio_category'; // change HERE
		$q_vars = &$query->query_vars;
		if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
			$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
			$q_vars[$taxonomy] = $term->slug;
		}
}
}

/* --------------------------------------------------- */
/* Add a thumbnail column in edit.php
/* Source: http://wordpress.org/support/topic/adding-custum-post-type-thumbnail-to-the-edit-screen
/* --------------------------------------------------- */
add_action( 'manage_posts_custom_column', 'wi_add_thumbnail_value_editscreen', 10, 2 );
add_filter( 'manage_edit-portfolio_columns', 'wi_columns_filter', 10, 1 );

if ( !function_exists('wi_columns_filter') ) {
function wi_columns_filter( $columns ) {
 	$column_thumbnail = array( 'thumbnail' => __('Thumbnail','wi') );
	$columns = array_slice( $columns, 0, 1, true ) + $column_thumbnail + array_slice( $columns, 1, NULL, true );
	return $columns;
}
}
if ( !function_exists('wi_add_thumbnail_value_editscreen') ) {
function wi_add_thumbnail_value_editscreen($column_name, $post_id) {

	$width = (int) 50;
	$height = (int) 50;

	if ( 'thumbnail' == $column_name ) {
		// thumbnail of WP 2.9
		$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
		// image from gallery
		$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
		if ($thumbnail_id)
			$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
		elseif ($attachments) {
			foreach ( $attachments as $attachment_id => $attachment ) {
				$thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
			}
		}
		if ( isset($thumb) && $thumb ) {
			echo $thumb;
		} else {
			echo '<em>' . __('None','wi') . '</em>';
		}
	}
}
}