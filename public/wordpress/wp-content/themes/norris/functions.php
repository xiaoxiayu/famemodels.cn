<?php
	global $smof_data;	/* Theme Options */	

if ( ! isset( $content_width ) )
	$content_width = 940;

if ( !function_exists('disable_onepage') ) {
function disable_onepage(){
	global $smof_data;	
	$disable_onepage = isset($smof_data['disable-onepage']) ? $smof_data['disable-onepage'] : false;
	if ( $disable_onepage ) return true;
	return false;
}
}	
	
	/* Is onepage
	------------------------------------------------- */
if ( !function_exists('is_onepage') ) {
function is_onepage(){	
	if ( disable_onepage() ) return false;	
	if ( !is_page() ) return false;
	$page_template = get_post_meta(get_the_ID(),'_wp_page_template',true);
	$page_template = basename($page_template,'.php');
	if ( $page_template == 'template-onepage' ) return true;	
	return false;
}
}
	
	/* Body class
	------------------------------------------------- */
add_filter('body_class','wi_add_body_class');
if ( !function_exists('wi_add_body_class') ) {
function wi_add_body_class($classes){
	global $smof_data;
	// onepage
	if ( is_onepage() ) {
		$classes[] = 'wi-onepage';
	} else {
		$classes[] = 'wi-not-onepage';
	}
		
	// responsive
	if ( isset ( $smof_data['responsive'] ) && !$smof_data['responsive'] ) {
		$classes[] = 'non-responsive';
	}
	
	// dark skin
	if ( isset ( $smof_data['dark-skin'] ) && $smof_data['dark-skin'] ) {
		$classes[] = 'dark-skin';
	}
	
	// sticky header
	if ( isset ( $smof_data['header-always-stick'] ) && $smof_data['header-always-stick'] ) {
		$classes[] = 'header-always-stick';
	}
	
	// header theme
	$header_theme = isset ( $smof_data['header-theme'] ) ? $smof_data['header-theme'] : 'light';
	$classes[] = 'header-'.$header_theme;
	
	// header at very top
	$header_top = isset ( $smof_data['header-at-top'] ) ? $smof_data['header-at-top'] : false;
	if ( $header_top ) {
		$classes[] = 'header-at-top';
	}	
	
	/* uppercase and lowercase */
	$uppercase = isset($smof_data['uppercase']) ? $smof_data['uppercase'] : true;
	$classes[] = $uppercase ? 'uppercase' : 'lowercase';
	
	/* WP Version */
	$version = get_bloginfo('version');
	$classes[] = 'wp-version-'. str_replace('.','-',$version);
	if ( $version >= 3.8 ) $classes[] = 'wp-version-from-3-8';
	
	return $classes;
}
}
		
/* ------------------------------------------------------- */
/* INCLUDE
/* ------------------------------------------------------- */
	include_once('inc/google-fonts.php');
	include_once('admin/index.php');

if ( !class_exists( 'RW_Meta_Box' ) && !defined('RWMB_URL') && !defined('RWMB_DIR') ) {
	/* for compatibility with plugins */
	define( 'RWMB_URL', get_template_directory_uri() . '/inc/meta-box/' );
	define( 'RWMB_DIR', get_template_directory() . '/inc/meta-box/' );
		include_once('inc/meta-box/meta-box.php');	
	}	

	include_once('inc/metabox.php');
//	include_once('demo.php');
	include_once('inc/shortcodes.php');
	
	/* Widgets */
	include_once('widgets/media.php');
	include_once('widgets/ads.php');
	include_once('widgets/facebook.php');
	include_once('widgets/google-plus.php');
	
	/* Require Plugins */
	include_once('inc/class-tgm-plugin-activation.php');	/* Plugin Required */
	add_action( 'tgmpa_register', 'wi_register_required_plugins' );

if ( !function_exists('wi_register_required_plugins') ) {
function wi_register_required_plugins(){
	$plugins = array(
		
		array(
			'name'     				=> 'Contact Form 7', // The plugin name
			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/plugins/contact-form-7.3.8.1.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Wi:Shortcodes', // The plugin name
			'slug'     				=> 'wi-shortcodes', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/plugins/wi-shortcodes.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
				
		array(
			'name'     				=> 'Wi:Portfolio', // The plugin name
			'slug'     				=> 'wi-portfolio', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/plugins/wi-portfolio.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
	);
	
	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'wi';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );
}
}

/* ------------------------------------------------------- */
/* SETUP
/* ------------------------------------------------------- */
add_action( 'after_setup_theme', 'wi_setup' );
if ( !function_exists('wi_setup') ) {
function wi_setup() {
	load_theme_textdomain( 'wi', get_template_directory() . '/languages' );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	
	// Add Theme Support WooCommerce
	add_theme_support('woocommerce');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'wi' ) );
	
	add_theme_support( 'post-formats', array( 'video', 'audio', 'gallery', 'link', 'quote' ) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	add_image_size('thumb-600',600,9999,false);
	add_image_size('thumb-600-crop',600,400,true);
	
	/* for blog thumbnail */
	add_image_size('thumb-480',480,9999,false);	// small portfolio thumbnail
	add_image_size('thumb-480-crop',480,320,true);	// small portfolio thumbnail crop
	
	// editor style
	add_editor_style('css/editor.css');
}
}
/* ------------------------------------------------------- */
/* ENQUEUE
/* ------------------------------------------------------- */
add_action( 'wp_enqueue_scripts', 'wi_enqueue' );
if ( !function_exists('wi_enqueue') ) {
function wi_enqueue(){
	global $wp_styles, $smof_data;
	
	/* Default stylesheet
	---------------------- */
	wp_enqueue_style( 'wi-stylesheet', get_stylesheet_uri() );

	/* Comments
	---------------------- */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Easing
	---------------------- */
	wp_enqueue_script( 'wi-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), '1.3', true );
	
	/* Touchswipe
	---------------------- */
	wp_enqueue_script( 'wi-touchswipe', get_template_directory_uri() . '/js/jquery.touchSwipe.min.js', array('jquery'), '1.3.3', true );
	
	/* Superfish
	---------------------- */
	wp_enqueue_script( 'wi-superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery'), '1.0', true );
	
	/* Autosize
	---------------------- */
	wp_enqueue_script( 'wi-autosize', get_template_directory_uri() . '/js/jquery.autosize-min.js', array('jquery'), '1.17.1', true );
	
	/* Modernizr (top)
	---------------------- */
	wp_enqueue_script( 'wi-modernizr', get_template_directory_uri() . '/js/modernizr.custom.15140.js', array('jquery'), '2.6.2', false );
	
	/* Fitvids
	---------------------- */
	wp_enqueue_script( 'wi-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), '1.0', true );
	
	/* Parallax, enqueued in Onepage Template
	---------------------- */
	wp_enqueue_script( 'wi-parallax', get_template_directory_uri() . '/js/jquery.parallax-1.1.3.js', array('jquery'), '1.1.3', true );
	
	/* Tweets
	---------------------- */
	wp_register_script( 'wi-tweets', get_template_directory_uri() . '/js/jquery.tweet.min.js', array('jquery'), '1.0', true );	
	
	/* Colorbox
	---------------------- */
	if ( isset ( $smof_data['colorbox'] ) && $smof_data['colorbox'] ) {
		wp_enqueue_script( 'wi-colorbox', get_template_directory_uri() . '/js/jquery.colorbox-min.js', array('jquery'), '1.4.26', true );
		wp_enqueue_style( 'wi-colorbox', get_template_directory_uri() . '/css/colorbox.css' );
	}
	
	/* Sticky
	---------------------- */
	wp_enqueue_script( 'wi-sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array('jquery'), '1.0', true );
	
	/* Facebook
	---------------------- */
	wp_register_script( 'wi-facebook', 'http://connect.facebook.net/en_US/all.js#xfbml=1', false, '1.0', true );
	
	/* Flexslider
	---------------------- */
	wp_register_script( 'wi-flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), '2.1', true );
	wp_register_style( 'wi-flexslider', get_template_directory_uri() . '/css/flexslider.css' );
		
	/* Supersized 
	---------------------- */
	$page_template = get_post_meta(get_the_ID(),'_wp_page_template',true);
	$page_template = basename($page_template,'.php');
	$display_in_multipages = isset( $smof_data['toparea-multipages-layout'] ) ?  $smof_data['toparea-multipages-layout'] : true;
	$display_in_multipages = $display_in_multipages && is_front_page();
	if ( $page_template == 'template-onepage' || $display_in_multipages ) {
		$type = isset ($smof_data['top-area-type']) ? $smof_data['top-area-type'] : 'bg-fullscreen';
		if ( $type == 'slider-fullscreen' ) {
			
			wp_enqueue_script( 'wi-supersized', get_template_directory_uri() . '/js/supersized.3.2.7.min.js', array('jquery'), '3.2.7', true );
			wp_enqueue_script( 'wi-supersized-shutter', get_template_directory_uri() . '/js/supersized.shutter.min.js', array('jquery'), '1.1', true );
			wp_enqueue_style( 'wi-supersized', get_template_directory_uri() . '/css/supersized.css' );
		}	// is onepage and type slider fullscreen
	
	}
	
	/* Main JS
	---------------------- */
	wp_enqueue_script( 'wi-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0', true );

	/* IE
	---------------------- */
	wp_enqueue_style( 'wi-ie', get_template_directory_uri() . '/css/ie.css' );
	$wp_styles->add_data( 'wi-ie', 'conditional', 'lt IE 9' );
	
	/* Responsive
	---------------------- */
	if ( isset ( $smof_data['responsive'] ) && $smof_data['responsive'] ) {
		wp_enqueue_style( 'wi-responsive', get_template_directory_uri() . '/css/responsive.css' );	
	} else {
		wp_dequeue_style( 'wi-shortcodes-responsive' );
		wp_dequeue_style( 'wi-portfolio-responsive' );
	}

}
}
/* ------------------------------------------------------------------------------ */
/* Register Sidebars
/* ------------------------------------------------------------------------------ */
add_action( 'widgets_init', 'wi_widgets_init' );
if ( !function_exists('wi_widgets_init') ) {
function wi_widgets_init() {
	register_sidebar( array(
		'name'			=> __( 'Main Sidebar', 'wi' ),
		'id'			=> 'main',
		'description'	=> '',
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h3 class="widget-title"><span>',
		'after_title'	=> '</span></h3>',
	) );
	
	register_sidebar( array(
		'name'			=> __( 'Shop Sidebar', 'wi' ),
		'id'			=> 'shop',
		'description'	=> __( 'This sidebar is used for WooCommerce Plugin, on shop pages.', 'wi' ),
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h3 class="widget-title"><span>',
		'after_title'	=> '</span></h3>',
	) );	
}
}

/* ------------------------------------------------------------------------------ */
/* Fix <title> meta tag and make it compatible with WP SEO by Yoast
/* ------------------------------------------------------------------------------ */
function wi_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'wi' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'wi_wp_title', 10, 2 );

/* ------------------------------------------------------------------------------ */
/* Onepage Menu
/* ------------------------------------------------------------------------------ */
if ( !class_exists('wi_nav_walker') ) {
class wi_nav_walker extends Walker_Nav_Menu {

	function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
		global $wp_query;
		
		$class_names = '';		
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		
		if($item->object == 'page')	{
			$varpost = get_post($item->object_id);
			$attributes .= ' href="' . get_site_url() . '#' . $varpost->post_name . '"';
			$classes[] = 'scrolltopage';
		} else {
			if ( in_array ( 'menu-item-home' , $classes ) ) {
				$attributes .= ! empty( $item->url ) ? ' href="' . get_site_url() .'#top"' : '';
				$classes[] = 'active';
			} else {
				$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';
			}			
		}

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';	// code indent
		
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';		
		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $class_names .'>';		
		
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
		$item_output .= $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
}	// wi nav walker class
}	// class exists

/* --------------------------------------------------- */
/* Add a thumbnail column in edit.php
/* Source: http://wordpress.org/support/topic/adding-custum-post-type-thumbnail-to-the-edit-screen
/* --------------------------------------------------- */
add_action( 'manage_posts_custom_column', 'wi_add_thumbnail_value_editscreen', 10, 2 );
add_filter( 'manage_edit-post_columns', 'wi_columns_filter', 10, 1 );

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
/* ------------------------------------------------------------------------------ */
/* Comments
/* ------------------------------------------------------------------------------ */
if ( !function_exists('wi_comment') ) {
function wi_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'wi' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'wi' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-avatar">
				<?php echo get_avatar( $comment, 100 ); ?>
			</div>
			<div class="text">
				<header class="comment-meta comment-author vcard">
					<?php
						printf( '<cite class="fn">%1$s %2$s</cite>',
							'<span>' . get_comment_author_link() . '</span>',
							// If current post author is also comment author, make it known visually.
							( $comment->user_id === $post->post_author ) ? '<span class="post-author">' . __( 'Post author', 'wi' ) . '</span>' : ''
						);
						printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							/* translators: 1: date, 2: time */
							sprintf( __( '%1$s at %2$s', 'wi' ), get_comment_date(), get_comment_time() )
						);
						edit_comment_link( __( 'Edit', 'wi' ), '<span class="sep">/</span>', '' );
						
						echo '<span class="sep">/</span>';
						
						comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'wi' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );						
					?>
				</header><!-- .comment-meta -->
			
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'wi' ); ?></p>
			<?php endif; ?>

				<section class="comment-content comment">
					<?php comment_text(); ?>					
				</section><!-- .comment-content -->
			</div><!-- .text -->
			
		</article><!-- #comment-<?php comment_ID(); ?> -->
	<?php
		break;
	endswitch; // end comment_type check
}
}
/* ------------------------------------------------------------------------------ */
/* Blog Slider
/* ------------------------------------------------------------------------------ */
if ( !function_exists('wi_blog_slider') ) {
function wi_blog_slider(){
	global $post, $smof_data;
	
		/* gallery args
		------------------------------------------------------ */
	$navi = get_post_meta ( get_the_ID(), '_wi_gallery-navi', true ) ? 'true' : 'false';
	$auto = get_post_meta ( get_the_ID(), '_wi_gallery-auto', true ) ? 'true' : 'false';
	$smooth_height = get_post_meta ( get_the_ID(), '_wi_smooth-height', true ) ? 'true' : 'false';
	$effect = get_post_meta ( get_the_ID(), '_wi_gallery-effect', true );	
	if ( $effect!='fade' ) $effect = 'slide';
	
		/* image link to
		------------------------------------------------------ */
	if ( !is_single() ) {	// not single post, check link to
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
	} else { // is single post, check link to lightbox or not
			$link_to_full = get_post_meta( get_the_ID() , '_wi_featured-image-link-to-full' , true );
			if ( !$link_to_full ) {
				$link_to_full = ( isset ( $smof_data['single-featured-image-link-to-full'] ) && $smof_data['single-featured-image-link-to-full'] ) ? 'yes' : 'no';				
			}
			if ($link_to_full!= 'no') $link_to_full == 'yes';					
	}	// if single
	
		/* crop mode?
		------------------------------------------------------ */
	if ( !is_single() )	{
		$cropmode = get_post_meta( get_the_ID() , '_wi_blog-thumb-crop' , true );
		if ( !$cropmode ) {
			$cropmode = ( isset ( $smof_data['blog-thumb-crop'] ) && $smof_data['blog-thumb-crop'] ) ? 'yes' : 'no';	
		}
	} else {
		$cropmode = get_post_meta( get_the_ID() , '_wi_single-thumb-crop' , true );
		if ( !$cropmode ) {
			$cropmode = ( isset ( $smof_data['single-thumb-crop'] ) && $smof_data['single-thumb-crop'] ) ? 'yes' : 'no';
		}
	}
	$cropmode = ( $cropmode != 'no' ) ? '-crop' : '';

	$attachments = get_post_meta( get_the_ID() , '_wi_gallery-images' );

	if (  count($attachments) == 0 ):	// nothing at all
		return;

	else:	// has images

		wp_enqueue_script('wi-flexslider');
		wp_enqueue_style('wi-flexslider');
		
		?>
		<div class="post-thumbnail slider-thumbnail" data-effect="<?php echo $effect;?>" data-auto="<?php echo $auto;?>" data-navi="<?php echo $navi;?>" data-smooth="<?php echo $smooth_height;?>">
			<div class="flexslider">
				<ul class="slides">
		<?php
		foreach ( $attachments as $attachment):

			$attachment_src = wp_get_attachment_image_src( $attachment, 'thumb-600'. $cropmode );
			
			// if !is_single(), open and close are checked above
			if ( is_single() ) {
				if ( $link_to_full == 'yes' ) {
					$full_src = wp_get_attachment_image_src( $attachment, 'full' );
					$open = '<a href="' . esc_url ( $full_src[0] ) . '">';
					$close = '</a>';
				} else {
					$open = $close = '';
				}
			}
			?>
			<li class="slide"><?php echo $open;?><img src="<?php echo esc_url ( $attachment_src[0] );?>" alt="<?php echo basename( $attachment_src[0] );?>" /><?php echo $close;?></li>
		
		<?php
		endforeach;
		?>
				</ul><!-- .slides -->
			</div><!-- .flexslider -->
		</div><!-- .slider-thumbnail -->
<?php
	endif;	// count attachments	
}
}

/* ------------------------------------------------------------------------------ */
/* Meta
/* ------------------------------------------------------------------------------ */
if ( !function_exists('wi_meta') ) {
function wi_meta(){
	global $smof_data, $post;
?>
	<div class="meta">
		<?php if ( isset ( $smof_data['blog-date'] ) && $smof_data['blog-date'] ):?>
		<div class="ele time"><time data-time="<?php echo get_the_date('c');?>"><?php echo get_the_date( get_option('date_format') );?></time></div>
		<?php endif;?>
		<?php if ( isset ( $smof_data['blog-categories'] ) && $smof_data['blog-categories'] ):?>
		<div class="ele categories"><?php echo get_the_category_list('<span class="sep">|</span>') ;?></div>
		<?php endif;?>
		<?php if ( isset ( $smof_data['blog-comments-link'] ) && $smof_data['blog-comments-link'] ):?>
		<div class="ele comments">
			<?php comments_popup_link( __('0 comments','wi'), __('1 comment','wi'), __('% comments','wi'),'', __('Off','wi') ); ?>
		</div><!-- .comments -->
		<?php endif; ?>
		<?php if ( isset ( $smof_data['blog-author'] ) && $smof_data['blog-author'] ):?>
		<div class="ele author">
			<?php printf(__('by %s','wi'), '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) .'" rel="author">' . get_the_author() . '</a>' );?>
		</div><!-- .comments -->
		<?php endif; ?>
		<?php if ( current_user_can('edit_post', get_the_ID() ) ) :?>
		<div class="ele edit">
			<?php edit_post_link( __('<i class="icon-pencil"></i>','wi'), '', '' ); ?>
		</div><!-- .edit -->
		<?php endif;?>
	</div><!-- .meta -->
<?php
}
}

/* ------------------------------------------------------------------------------ */
/* Social
/* ------------------------------------------------------------------------------ */
if ( !function_exists('wi_social_array') ) {
function wi_social_array(){
	return array(
		'facebook'		=>	__('Facebook','wi'),
		'twitter'		=>	__('Twitter','wi'),
		'google-plus'	=>	__('Google+','wi'),
		'linkedin'	 	=>	__('LinkedIn','wi'),
		'tumblr'	 	=>	__('Tumblr','wi'),
		'pinterest'	 	=>	__('Pinterest','wi'),
		'youtube'	 	=>	__('YouTube','wi'),
		'skype'	 		=>	__('Skype','wi'),
		'instagram'	 	=>	__('Instagram','wi'),
		'delicious'	 	=>	__('Delicious','wi'),
		'reddit'		=>	__('Reddit','wi'),
		'stumbleupon'	=>	__('StumbleUpon','wi'),
		'wordpress'	 	=>	__('Wordpress','wi'),
		'joomla'		=>	__('Joomla','wi'),
		'blogger'	 	=>	__('Blogger','wi'),
		'vimeo'	 		=>	__('Vimeo','wi'),
		'yahoo'	 		=>	__('Yahoo!','wi'),
		'flickr'	 	=>	__('Flickr','wi'),
		'picasa'	 	=>	__('Picasa','wi'),
		'deviantart'	=>	__('DeviantArt','wi'),
		'github'	 	=>	__('GitHub','wi'),
		'stackoverflow'	=>	__('StackOverFlow','wi'),
		'xing'	 		=>	__('Xing','wi'),
		'flattr'	 	=>	__('Flattr','wi'),
		'foursquare'	=>	__('Foursquare','wi'),
		'paypal'	 	=>	__('Paypal','wi'),
		'yelp'	 		=>	__('Yelp','wi'),
		'soundcloud'	=>	__('SoundCloud','wi'),
		'lastfm'	 	=>	__('Last.fm','wi'),
		'lanyrd'	 	=>	__('Lanyrd','wi'),
		'dribbble'	 	=>	__('Dribbble','wi'),
		'forrst'	 	=>	__('Forrst','wi'),
		'steam'	 		=>	__('Steam','wi'),
		'behance'		=>	__('Behance','wi'),
		'mixi'			=>	__('Mixi','wi'),
		'weibo'			=>	__('Weibo','wi'),
		'renren'		=>	__('Renren','wi'),
		'evernote'		=>	__('Evernote','wi'),
		'dropbox'		=>	__('Dropbox','wi'),
		'bitbucket'		=>	__('Bitbucket','wi'),
		'trello'		=>	__('Trello','wi'),
		'vk'			=>	__('VKontakte','wi'),
		'home'			=>	__('Homepage','wi'),
		'envelope-alt'	=>	__('Email','wi'),
		'rss'			=>	__('RSS','wi'),
	);
}
}
/* ------------------------------------------------------------------------------ */
/* Useful functions
/* ------------------------------------------------------------------------------ */
if ( !function_exists('wi_pagination') ) {
function wi_pagination( $custom_query = false ){
	global $wp_query;
	
	if ( !$custom_query ) $custom_query = $wp_query;

	$big = 999999999; // need an unlikely integer
	echo '<div class="wi-pagination">';
		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $custom_query->max_num_pages,
			'type'			=> 'list',
			'prev_text'    => sprintf( __('%s Previous','wi'), '<i class="icon-angle-left"></i>' ),
			'next_text'    => sprintf( __('Next %s','wi'), '<i class="icon-angle-right"></i>' ),
		) );
	echo '<div class="clearfix"></div></div>';
}
}

/* ------------------------------------------------------------------------------ */
/* Hooks
/* ------------------------------------------------------------------------------ */
	/* image quality */
add_filter('jpeg_quality', 'wi_image_full_quality');
add_filter('wp_editor_set_quality', 'wi_image_full_quality');
if (!function_exists('wi_image_full_quality')) {
function wi_image_full_quality($quality) {
    return 100;
}
}

	/* Untitled posts */
add_filter ('the_title', 'wi_default_title' );
if (!function_exists('wi_default_title')) {
function wi_default_title( $title, $id = false ){
	if (!$title) {
		return __('Untitled','wi');
	}	else {
		return $title;
	}
}
}

	/* Remove the ugly bracket [...] in the excerpt */
add_filter('excerpt_more','wi_remove_bracket_in_excerpt');
if ( !function_exists('wi_remove_bracket_in_excerpt') ) {
function wi_remove_bracket_in_excerpt($excerpt){
	return '&nbsp;&hellip;';
}
}
	/* More length */
if ( !function_exists('wi_custom_excerpt_length') ) {
function wi_custom_excerpt_length( $length ) {
	global $smof_data;
	if ( isset ( $smof_data['excerpt-length'] ) && $smof_data['excerpt-length'] )
	return $smof_data['excerpt-length'] ; else return 55;	
}
}
add_filter( 'excerpt_length', 'wi_custom_excerpt_length', 999 );

/* ------------------------------------------------------------------------------ */
/* Options
/* ------------------------------------------------------------------------------ */
	/* Scroll to top */
add_action('wp_footer','wi_add_scrolltop');
if ( !function_exists('wi_add_scrolltop') ) {
function wi_add_scrolltop(){
	global $smof_data;
	if ( isset ( $smof_data['scrollup'] ) && $smof_data['scrollup'] ) {
		echo '<div class="scrollup" id="scrollup"></div>';
	}
}
}
	/* Header Code */
add_action('wp_head','wi_add_head_code');
if ( !function_exists('wi_add_head_code') ) {
function wi_add_head_code(){
	global $smof_data;
	if ( isset ( $smof_data['header-code'] ) && $smof_data['header-code'] ) {
		echo $smof_data['header-code'];
	}
}
}

	/* Footer Code */
add_action('wp_footer','wi_add_footer_code');
if ( !function_exists('wi_add_footer_code') ) {
function wi_add_footer_code(){
	global $smof_data;
	if ( isset ( $smof_data['footer-code'] ) && $smof_data['footer-code'] ) {
		echo $smof_data['footer-code'];
	}
}
}
	/* CSS */
add_action('wp_head','wi_options_css');
if ( !function_exists('wi_options_css') ) {
function wi_options_css(){
	global $smof_data;?>
	<style type="text/css">
		/* Top area overlay
		------------------------------------------------- */
		<?php $overlay_opacity = isset ($smof_data['toparea-bg-overlay-opacity']) ? $smof_data['toparea-bg-overlay-opacity'] : 60;?>
		#wi-top-area .overlay {
			opacity:<?php echo ($overlay_opacity/100);?>;
			-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=<?php echo ($overlay_opacity);?>)";
			filter: alpha(opacity=<?php echo ($overlay_opacity);?>);
			}
		
		/* Header top black line
		------------------------------------------------- */
		<?php if ( isset ( $smof_data['header-top-black-line'] ) && !$smof_data['header-top-black-line'] ) { ?>		
		#wi-header {
			border-top:none;
		}
		<?php } ?>		
		/* Logo
		------------------------------------------------- */
		<?php if ( isset ( $smof_data['logo-margin-top'] ) ) { ?>		
		#wi-logo img {
			margin-top:<?php echo $smof_data['logo-margin-top'];?>px;			
		}
		@media (max-width: 767px) {
			#wi-logo img {
				margin-bottom:<?php echo $smof_data['logo-margin-top'];?>px;			
			}
		}
		<?php } ?>
		<?php if ( isset ( $smof_data['logo-margin-left'] ) ) { ?>
		#wi-logo img {
			margin-left:<?php echo $smof_data['logo-margin-left'];?>px;
		}
		<?php } ?>		
		/* Footer pattern
		------------------------------------------------- */
		<?php if ( isset ( $smof_data['footerbg'] ) && !empty( $smof_data['footerbg'] ) ) {
			$sidrbg_size = (array) @getimagesize($smof_data['footerbg']);
		?>
		#wi-footer {
			background-image:url(<?php echo $smof_data['footerbg'];?>);
			background-size:<?php echo $sidrbg_size[0] .'px ' . $sidrbg_size[1] .'px' ;?>;
		}
		@media (-webkit-min-device-pixel-ratio: 1.25), (min-resolution: 120dpi){ 
			#wi-footer {
				background-image:url(<?php echo str_replace( '.png' , '_@2X.png' , $smof_data['footerbg'] );?>);
				}
		}
		<?php } ?>
		
		/* Footer custom pattern
		------------------------------------------------- */
		<?php if ( isset ( $smof_data['footer-custom-bg'] ) && trim ( $smof_data['footer-custom-bg'] )!= '' ) { 
		$custom_bg_size = (array) @getimagesize($smof_data['footer-custom-bg']);
		?>
			#wi-footer {
				background-image:url(<?php echo $smof_data['footer-custom-bg']; ?>);
				-webkit-background-size:<?php echo $custom_bg_size[0] . 'px '. $custom_bg_size[1] .'px';?>;
				-moz-background-size:<?php echo $custom_bg_size[0] . 'px '. $custom_bg_size[1] .'px';?>;
				background-size:<?php echo $custom_bg_size[0] . 'px '. $custom_bg_size[1] .'px';?>;
				}
		<?php } // endif ?>
		<?php if ( isset ( $smof_data['footer-custom-bg-retina'] ) && trim ( $smof_data['footer-custom-bg-retina'] )!= '' ) {?>
			@media (-webkit-min-device-pixel-ratio: 1.25), (min-resolution: 120dpi){
				#wi-footer {
					background-image:url(<?php echo $smof_data['footer-custom-bg-retina']; ?>);
				}
			}
		<?php } ?>
		/* Footer use color instead of pattern
		------------------------------------------------- */
		<?php if ( isset($smof_data['use-footer-background-color']) && $smof_data['use-footer-background-color'] ) {?>
		#wi-footer {
			background-image:none !important;
			background-color:<?php echo $smof_data['footer-background-color'];?>;
			border-top:none;
			}
		<?php } ?>
		
		/* Body background color
		------------------------------------------------- */
		<?php if ( isset ( $smof_data['body-background-color'] ) && $smof_data['body-background-color']!='' ) { ?>
		body,
		#wi-content,
		#wi-header {
			background-color:<?php echo $smof_data['body-background-color'];?>;
			}
		<?php }?>
		
		/* Primary Color
		------------------------------------------------- */
		<?php if ( isset ( $smof_data['primary-color'] ) && $smof_data['primary-color']!='' ) { ?>
		a, 
		a:hover,
		blockquote em,
		blockquote cite,
		blockquote em a,
		blockquote em a:hover,
		blockquote cite a,
		blockquote cite a:hover,
		.page-links > a:hover,
		.authorbox .text h4 a,
		
		.widget_recent_entries ul li a:hover,
		.widget_archive ul li a:hover,
		.widget_categories ul li a:hover,
		.widget_meta ul li a:hover,
		.widget_pages ul li a:hover,
		.widget_nav_menu ul li a:hover,
		.widget_recent_comments ul li a:hover,
		.widget_rss ul li a:hover,
		
		.wi-member .role,
		.wi-testimonial .author .name,
		
		.wi-portfolio-filter ul li.active a,
		
		/* WooCommerce */
		.woocommerce .star-rating span:before, 
		.woocommerce-page .star-rating span:before
		{
			color:<?php echo $smof_data['primary-color'];?>;
		}
		ul#slide-list li.current-slide a,
		ul#slide-list li.current-slide a:hover,
		.gallery-icon:hover,
		.header-slider .flex-control-paging li a.flex-active,
		.text-slider .flex-control-paging li a.flex-active,
		#respond #submit:hover,
		.wpcf7 .wpcf7-submit:hover,
		
		.progress .fore .bar,
		.testimonial-slider .flex-control-paging li a.flex-active,
		.wi-button .btn-primary,
		.wi-pricing .pricing-column.featured,
		.wi-flexslider .flex-control-paging li a.flex-active,
		
		.portfolio-thumb-slider .flex-control-paging li a.flex-active,
		
		.dark-skin .wi-tab .tabnav ul li.active a,
		
		/* WooCommerce */
		.woocommerce span.onsale, 
		.woocommerce-page span.onsale,
		.woocommerce a.button.alt:hover,
		.woocommerce button.button.alt:hover,
		.woocommerce input.button.alt:hover,
		.woocommerce #respond input#submit.alt:hover,
		.woocommerce-page a.button.alt:hover, 
		.woocommerce-page button.button.alt:hover, 
		.woocommerce-page input.button.alt:hover,
		.woocommerce-page #respond input#submit.alt:hover,
		.woocommerce #review_form #respond .form-submit input:hover, 
		.woocommerce-page #review_form #respond .form-submit input:hover,
		.woocommerce #review_form #respond .form-submit input:focus,
		.woocommerce-page #review_form #respond .form-submit input:focus,
		.woocommerce #review_form #respond .form-submit input:active,
		.woocommerce-page #review_form #respond .form-submit input:active	
		{
			background-color:<?php echo $smof_data['primary-color'];?>;
		}		
		.wi-portfolio-filter ul li.active a,
		
		/* WooCommerce */
		.woocommerce #review_form #respond .form-submit input:hover, 
		.woocommerce-page #review_form #respond .form-submit input:hover,
		.woocommerce #review_form #respond .form-submit input:focus,
		.woocommerce-page #review_form #respond .form-submit input:focus,
		.woocommerce #review_form #respond .form-submit input:active,
		.woocommerce-page #review_form #respond .form-submit input:active
		{
			border-color:<?php echo $smof_data['primary-color'];?>;
		}
		
		.woocommerce ul.products li.product.featured, 
		.woocommerce-page ul.products li.product.featured {
			box-shadow:0 3px 0 <?php echo $smof_data['primary-color'];?>;
		}
		<?php }	// primary color ?>
		
		/* Link Color
		------------------------------------------------- */
		<?php if ( isset ( $smof_data['link-color'] ) && $smof_data['link-color']!= '' ) { ?>
		a,
		a:hover,
		.authorbox .text h4 a,
		blockquote em a,
		blockquote em a:hover,
		blockquote cite a,
		blockquote cite a:hover,
		.page-links > a:hover,
		.authorbox .text h4 a,
		
		.widget_recent_entries ul li a:hover,
		.widget_archive ul li a:hover,
		.widget_categories ul li a:hover,
		.widget_meta ul li a:hover,
		.widget_pages ul li a:hover,
		.widget_nav_menu ul li a:hover,
		.widget_recent_comments ul li a:hover,
		.widget_rss ul li a:hover,
		
		.close-portfolio a:hover,
		.portfolio-navi ul li a:hover
		{
			color:<?php echo $smof_data['link-color'];?>;
		}
		<?php } ?>
		
		/* Selection Color
		------------------------------------------------- */
		<?php if ( isset ( $smof_data['selection-color'] ) && $smof_data['selection-color']!= '' ) { ?>
		::selection
		{
			background:<?php echo $smof_data['selection-color'];?>;
			color:#fff;
		}
		::-moz-selection
		{
			background:<?php echo $smof_data['selection-color'];?>;
			color:#fff;
		}		
		<?php } ?>
		
		/* Header background color dark skin
		------------------------------------------------- */
		<?php if ( isset ( $smof_data['header-bg-color'] ) && $smof_data['header-bg-color'] ) { ?>
			.dark-skin #wi-header,
			.dark-skin #wi-header-sticky-wrapper.is-sticky #wi-header  {
				background-color:<?php echo $smof_data['header-bg-color'];?>;
				}
		<?php } ?>
		
		/* Typography
		------------------------------------------------- */
			/* Body */
		<?php if ( isset ( $smof_data['body-size'] ) ) { ?>
		body {
			font-size:<?php echo $smof_data['body-size'];?>px;			
		}
		<?php } ?>
		<?php for ( $i = 1; $i <= 6; $i++ ):
			if ( isset ( $smof_data['h'.$i.'-size'] ) ) {?>
			h<?php echo $i;?> {
				font-size:<?php echo $smof_data['h'.$i.'-size'];?>px;
			}
		<?php } ?>
		<?php endfor; ?>
			/* Blog Title */
		<?php if ( isset ( $smof_data['blog-title-size'] ) ) { ?>
		.article .title {
			font-size:<?php echo $smof_data['blog-title-size'];?>px;
		}
		<?php if ( isset( $smof_data['responsive'] ) && $smof_data['responsive'] ) { ?>
		@media (min-width: 768px) and (max-width: 979px) {
			.article .title {
				font-size:<?php echo floor($smof_data['blog-title-size'] * 0.7);?>px;
			}
		}
		@media (max-width: 768px) {
			.article .title {
			}
		}
		@media (max-width: 480px) {
			.article .title {
				font-size:<?php echo floor($smof_data['blog-title-size'] * 0.7);?>px;
			}
		}
		<?php } // if responsive ?>
		<?php }?>
			/* Single Title */
		<?php if ( isset ( $smof_data['single-post-size'] ) ) { ?>
		.single .post-title {
			font-size:<?php echo $smof_data['single-post-size'];?>px;
		}
		<?php if ( isset( $smof_data['responsive'] ) && $smof_data['responsive'] ) { ?>
		@media (min-width: 768px) and (max-width: 979px) {
			.single .post-title {
				font-size:<?php echo floor($smof_data['single-post-size'] * 0.8);?>px;
			}
		}
		@media (max-width: 768px) {
			.single .post-title {
				font-size:<?php echo floor($smof_data['single-post-size'] * 0.7);?>px;
			}
		}
		@media (max-width: 480px) {
			.single .post-title {
				font-size:<?php echo floor($smof_data['single-post-size'] * 0.6);?>px;
			}
		}
		<?php } // if responsive ?>
		<?php }?>
			/* Page title */
		<?php if ( isset ( $smof_data['page-title-size'] ) ) { ?>
		.page-title,
		.wi-page .title-area .title {
			font-size:<?php echo $smof_data['page-title-size'];?>px;
		}
		<?php if ( isset( $smof_data['responsive'] ) && $smof_data['responsive'] ) { ?>
		@media (min-width: 768px) and (max-width: 979px) {
			.page-title,
			.wi-page .title-area .title {
				font-size:<?php echo floor($smof_data['page-title-size'] * 0.8);?>px;
			}
		}
		@media (max-width: 768px) {
			.page-title,
			.wi-page .title-area .title {
				font-size:<?php echo floor($smof_data['page-title-size'] * 0.8);?>px;
			}
		}
		@media (max-width: 480px) {
			.page-title,
			.wi-page .title-area .title {
				font-size:<?php echo floor($smof_data['page-title-size'] * 0.65);?>px;
			}
		}
		<?php } // if responsive ?>
		<?php }?>
			/* Toparea Big Heading */
		<?php if ( isset ( $smof_data['toparea-big-heading-size'] ) ) { ?>
		#wi-top-area .heading-text {
			font-size:<?php echo $smof_data['toparea-big-heading-size'];?>px;
		}
		<?php if ( isset( $smof_data['responsive'] ) && $smof_data['responsive'] ) { ?>
		@media (min-width: 768px) and (max-width: 979px) {
			#wi-top-area .heading-text {
				font-size:<?php echo floor($smof_data['toparea-big-heading-size'] * 0.8);?>px;
			}
		}
		@media (max-width: 768px) {
			#wi-top-area .heading-text {
				font-size:<?php echo floor($smof_data['toparea-big-heading-size'] * 0.65);?>px;
			}
		}
		@media (max-width: 480px) {
			#wi-top-area .heading-text {
				font-size:<?php echo floor($smof_data['toparea-big-heading-size'] * 0.5);?>px;
			}
		}
		<?php } // if responsive ?>
		<?php }?>
		
		<?php if ( isset ( $smof_data['body-font'] ) && $smof_data['body-font']!= '' ) { ?>
		body,
		.page-subtitle,
		#wi-top-area .small-text,
		.wi-page .title-area .subtitle,
		.headline .meta,
		#respond input[type="text"], 
		#respond input[type="text"]:focus, 
		#respond textarea, 
		#respond textarea:focus,
		.searchform .s, .searchform .s:focus,
		.wpcf7 input[type=text],
		.wpcf7 input[type=text]:focus,
		.wpcf7 input[type=email],
		.wpcf7 input[type=email]:focus,
		.wpcf7 textarea,
		.wpcf7 textarea:focus,
		
		.wi-testimonial .content
		{
			font-family:<?php 
				if ( in_array($smof_data['body-font'],wi_google_fonts()) ) {
					echo '"' . $smof_data['body-font'] . '", sans-serif;';
				} else {
					echo $smof_data['body-font'];
				}
			?>;
		}
		<?php } // body font ?>
		<?php if ( isset ( $smof_data['heading-font'] ) && $smof_data['heading-font']!= '' ) { ?>
		h1, h2, h3, h4, h5, h6, dl dt,
		#wi-top-area .wi-button .btn,
		.text-slider,
		#wi-logo a,
		.page-separator .wi-button .btn,
		.link-area .link-button,
		.post-nav .ele a,
		.tags,
		.commentlist .fn,
		#respond .comment-ele label,
		#respond #submit,
		.tagcloud a,
		
		.widget_recent_entries ul li,
		.widget_archive ul li,
		.widget_categories ul li,
		.widget_meta ul li,
		.widget_pages ul li,
		.widget_nav_menu ul li,
		.widget_recent_comments ul li,
		.widget_rss ul li,
		
		#wp-calendar caption,
		#wp-calendar th,
		#wp-calendar td,
		.wpcf7 p,
		.wpcf7 .wpcf7-submit,
		div.wpcf7-response-output,
		
		.recent-item .meta,
		.recent-item .readmore-link,
		.progress .fore .name,
		.wi-count .name,
		.wi-member .name,
		.bigtext,
		.wi-pricing .pricing-column .title-row,
		.wi-toggle .toggle-title,
		.wi-tab .tabnav ul li a,
		.wi-piechart .number,
		.wi-piechart-container .name,
		
		.wi-portfolio-filter ul li a,
		.portfolio-item .thumb .name,
		.portfolio-navi ul li a,
		
		/* woocommerce */
		.woocommerce .woocommerce-breadcrumb, 
		.woocommerce-page .woocommerce-breadcrumb,
		.woocommerce-result-count,
		.woocommerce-ordering select,
		.woocommerce span.onsale, 
		.woocommerce-page span.onsale,
		.woocommerce a.button, 
		.woocommerce button.button, 
		.woocommerce input.button, 
		.woocommerce #respond input#submit, 
		.woocommerce-page a.button, 
		.woocommerce-page button.button, 
		.woocommerce-page input.button, 
		.woocommerce-page #respond input#submit,
		.woocommerce a.wc-forward,
		.woocommerce-page a.wc-forward,
		.woocommerce a.button.wc-forward,
		.woocommerce-page a.button.wc-forward,
		.woocommerce div.product .woocommerce-tabs ul.tabs li,
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li, 
		.woocommerce-page div.product .woocommerce-tabs ul.tabs li, 
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li,
		.woocommerce table.shop_attributes th, 
		.woocommerce-page table.shop_attributes th,
		#commentform label,
		.woocommerce #review_form #respond .form-submit input, 
		.woocommerce-page #review_form #respond .form-submit input,
		.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta,
		.woocommerce-page #reviews #comments ol.commentlist li .comment-text p.meta,
		div.ppt,
		div.pp_woocommerce .pp_description, 
		div.pp_woocommerce .pp_nav p,
		.woocommerce table.shop_table th, 
		.woocommerce-page table.shop_table th,
		.shipping-calculator-form select,
		.woocommerce .cart-collaterals .cart_totals table th,
		.woocommerce-page .cart-collaterals .cart_totals table th,
		.woocommerce form .form-row label,
		.woocommerce #payment ul.payment_methods li label, 
		.woocommerce-page #payment ul.payment_methods li label,
		.woocommerce ul.cart_list li.empty, 
		.woocommerce ul.product_list_widget li.empty, 
		.woocommerce-page ul.cart_list li.empty, 
		.woocommerce-page ul.product_list_widget li.empty,
		.woocommerce ul.cart_list li a,
		.woocommerce ul.product_list_widget li a, 
		.woocommerce-page ul.cart_list li a, 
		.woocommerce-page ul.product_list_widget li a
		
		{
			font-family:<?php if ( in_array($smof_data['heading-font'],wi_google_fonts()) ) {
					echo '"' . $smof_data['heading-font'] . '", sans-serif;';
				} else {
					echo $smof_data['heading-font'];
				}
				?>
		}		
		<?php } // heading font ?>
		<?php if ( isset ( $smof_data['mainnav-font'] ) && $smof_data['mainnav-font']!= '' ) { ?>
		#wi-mainnav .menu > ul > li > a
		{
			font-family:<?php 
				if ( in_array($smof_data['mainnav-font'],wi_google_fonts()) ) {
					echo '"' . $smof_data['mainnav-font'] . '", sans-serif;';
				} else {
					echo $smof_data['mainnav-font'];
				}
			?>;
		}
		<?php } // mainnav font ?>
		
		/* Portfolio
		------------------------------------------------- */
		<?php if ( isset ( $smof_data['portfolio-ajax-loader-image'] ) && trim ( $smof_data['portfolio-ajax-loader-image'] )!= '' ) { 
		$loader_size = (array) @getimagesize($smof_data['portfolio-ajax-loader-image']);
		?>
			#portfolio-ajax-wrapper {
				min-height:<?php echo $loader_size[1].'px';?>;
				}
			#portfolio-ajax-wrapper .ajax-loader {
				height: <?php echo $loader_size[1].'px';?>;				
				margin-top:-<?php echo $loader_size[1]/2;?>px;
				background-image:url(<?php echo $smof_data['portfolio-ajax-loader-image']; ?>);
				-webkit-background-size:<?php echo $loader_size[0] . 'px '. $loader_size[1] .'px';?>;
				-moz-background-size:<?php echo $loader_size[0] . 'px '. $loader_size[1] .'px';?>;
				background-size:<?php echo $loader_size[0] . 'px '. $loader_size[1] .'px';?>;
				}
		<?php } // endif ?>
		<?php if ( isset ( $smof_data['portfolio-retina-ajax-loader-image'] ) && trim ( $smof_data['portfolio-retina-ajax-loader-image'] )!= '' ) {?>
			@media (-webkit-min-device-pixel-ratio: 1.25), (min-resolution: 120dpi){
				#portfolio-ajax-wrapper .ajax-loader {
					background-image:url(<?php echo $smof_data['portfolio-retina-ajax-loader-image']; ?>);
				}
			}
		<?php } ?>
		<?php if ( isset ( $smof_data['custom-css'] ) && trim ( $smof_data['custom-css'] )!= '' ) { ?>
			<?php echo trim ($smof_data['custom-css']);?>
		<?php } // custom css ?>
	</style>	
	<?php
}
}

/* ------------------------------------------------------- */
/* RETINA
/* ------------------------------------------------------- */
add_action('wp_head','wi_replace_retina_logo');
if ( !function_exists('wi_replace_retina_logo') ) {
function wi_replace_retina_logo() {
	global $smof_data;
?>
<script type="text/javascript">
jQuery(document).ready(function(){
	var retina = window.devicePixelRatio > 1 ? true : false;

	<?php if( isset($smof_data['retina-logo']) && $smof_data['retina-logo'] && isset($smof_data['logo-width']) && isset($smof_data['logo-height']) && $smof_data['logo-width'] > 0 && $smof_data['logo-height'] > 0 ): ?>
	if(retina) {
		jQuery('#wi-logo img').attr('src', '<?php echo $smof_data["retina-logo"]; ?>');
		jQuery('#wi-logo img').attr('width', '<?php echo $smof_data["logo-width"]; ?>');
		jQuery('#wi-logo img').attr('height', '<?php echo $smof_data["logo-height"]; ?>');
	}
	<?php endif; ?>
	<?php if( isset($smof_data['retina-footer-logo']) && $smof_data['retina-footer-logo'] && isset($smof_data['footer-logo-width']) && isset($smof_data['footer-logo-height']) && $smof_data['footer-logo-width'] > 0 && $smof_data['footer-logo-height'] > 0 ): ?>
	if(retina) {
		jQuery('#wi-footer .footer-logo img').attr('src', '<?php echo $smof_data["retina-footer-logo"]; ?>');
		jQuery('#wi-footer .footer-logo img').attr('width', '<?php echo $smof_data["footer-logo-width"]; ?>');
		jQuery('#wi-footer .footer-logo img').attr('height', '<?php echo $smof_data["footer-logo-height"]; ?>');
	}
	<?php endif; ?>
});	
</script>
<?php
}
}

/* ------------------------------------------------------- */
/* ENQUEUE GOOGLE FONTS
/* ------------------------------------------------------- */
add_action( 'wp_enqueue_scripts', 'wi_enqueue_google_fonts' );
if (!function_exists('wi_enqueue_google_fonts')) {
function wi_enqueue_google_fonts(){
	global $smof_data;
	$protocol = is_ssl() ? 'https' : 'http';
	
	if( isset ( $smof_data['body-font'] ) && in_array ( $smof_data['body-font'], wi_google_fonts() ) ) {
		$body_font = $smof_data['body-font'];
	    wp_enqueue_style( 'wi-google-font-' . str_replace(' ','-',$body_font), "$protocol://fonts.googleapis.com/css?family=" . str_replace(' ','+', $body_font ) . ":100,200,300,400,500,600,700,800,900&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese" );
	}
	
	if( isset ( $smof_data['heading-font'] ) && in_array ( $smof_data['heading-font'], wi_google_fonts() ) ) {
		$heading_font = $smof_data['heading-font'];		
	    wp_enqueue_style( 'wi-google-font-' . str_replace(' ','-',$heading_font), "$protocol://fonts.googleapis.com/css?family=" . str_replace(' ','+', $heading_font ) . ":100,200,300,400,500,600,700,800,900&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese" );
	}
	
	if( isset ( $smof_data['mainnav-font'] ) && in_array ( $smof_data['mainnav-font'], wi_google_fonts() ) ) {
		$mainnav_font = $smof_data['mainnav-font'];		
	    wp_enqueue_style( 'wi-google-font-' . str_replace(' ','-',$mainnav_font), "$protocol://fonts.googleapis.com/css?family=" . str_replace(' ','+', $mainnav_font ) . ":100,200,300,400,500,600,700,800,900&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese" );
	}
}
}

/* ------------------------------------------------------- */
/* COLOR
/* ------------------------------------------------------- */
if ( !function_exists('wi_color_array') ){
function wi_color_array(){
	return array (
		'white' 		=> '#ffffff',
		'black'			=> '#333333',
		'gray' 			=> '#999999',
		'blue' 			=> '#1d89ef',
		'teal' 			=> '#00aba9',
		'green' 		=> '#00a300',
		'greenLight'	=> '#98d305',
		'red'	 		=> '#b91d47',
		'yellow' 		=> '#ffd913',
		'orange' 		=> '#ff981d',
		'pink' 			=> '#ff0097',
		'purple' 		=> '#a200ff',
		'brown' 		=> '#a05000',
	);
}
}
if ( !function_exists('wi_color') ){
function wi_color($color=''){
	global $smof_data;
	$color_code = wi_color_array();
	
	if ( gettype($color) != 'string' ) return '';
	$color = trim($color);
	
	$primary = isset($smof_data['primary-color']) ? $smof_data['primary-color'] : '';
	if (!$primary) $primary = '#b40606';
	
	if ( $color == 'primary' ) return $primary;	
	if(isset($color_code[$color]) && $color_code[$color]) return $color_code[$color];
	else return $color;
}
}


add_filter('wi_progress_color','wi_empty_color_filter');
add_filter('wi_piechart_color','wi_empty_color_filter');
add_filter('wi_button_color','wi_empty_color_filter');
if ( !function_exists('wi_empty_color_filter') ) {
function wi_empty_color_filter($color){
	global $smof_data;
	if ( !trim($color) ) return wi_color('primary');
	else return wi_color($color);
}
}

add_filter('wi_pricing_color','wi_primary_color_filter');
if ( !function_exists('wi_primary_color_filter') ) {
function wi_primary_color_filter($color){
	$color = trim($color);
	return wi_color($color);
}
}

add_filter('wi_color','wi_color_filter');
if ( !function_exists('wi_color_filter') ) {
function wi_color_filter($color){
	$color = trim($color);
	return wi_color($color);
}
}

/* ------------------------------------------------------------------------------ */
/* Visual background pattern select
/* ------------------------------------------------------------------------------ */
add_action( 'admin_init', 'wi_visual_background_pattern_select' );
if ( !function_exists('wi_visual_background_pattern_select') ){
function wi_visual_background_pattern_select(){
	global $pagenow;
	if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {
		wp_enqueue_script('wi_admin_javascript' , get_template_directory_uri() . '/js/wi_visual_background_pattern_select.js', array('jquery'), '1.0', true );
	}	
}
}

add_action( 'admin_enqueue_scripts', 'wi_register_admin_scripts' );
if ( !function_exists('wi_register_admin_scripts') ){
function wi_register_admin_scripts(){
	/* Admin Javascript
	---------------------- */
	wp_register_script('wi_admin_javascript' , get_template_directory_uri() . '/js/wi_visual_background_pattern_select.js', array('jquery'), '1.0', true );

}
}






/* ----------------------------------------------------------------------------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------------------------------------------------------------------------- */

																	/* WOOCOMMERCE */

/* ----------------------------------------------------------------------------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------------------------------------------------------------------------- */


/* ------------------------------------------------------------------------------ */
/* WOOCOMMERCE OPTIONS
/* ------------------------------------------------------------------------------ */

/* Check plugin installed
-------------------------------------- */
if (!function_exists('wiwoo')) {
function wiwoo() {

	return in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
	
}
}

/* Menu Option
-------------------------------------- */
/**
 * Source: http://wordpress.org/plugins/woocommerce-menu-bar-cart/
 */
add_filter('wp_nav_menu_items','wiwoo_menucart', 10, 2);
if (!function_exists('wiwoo_menucart')) {
function wiwoo_menucart($menu, $args) {
	global $smof_data;
	$display_cart = ( isset($smof_data['shop-cart-icon']) && $smof_data['shop-cart-icon'] ) ? true : false;
	if ( !$display_cart ) return $menu;
	
	// Check if WooCommerce is active and add a new item to a menu assigned to Primary Navigation Menu location
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || 'primary' !== $args->theme_location )
		return $menu;
 
	ob_start();
		global $woocommerce;
		$empty_cart = isset($smof_data['shop-cart-menu-empty']) ? $smof_data['shop-cart-menu-empty'] : 'cart';
		if ( $empty_cart == 'cart' ) {
			$empty_cart_link = $woocommerce->cart->get_cart_url();
		} elseif ( $empty_cart == 'shop' ) {
			$empty_cart_link = get_permalink( woocommerce_get_page_id( 'shop' ) );
		} elseif ( $empty_cart == 'custom' ) {
			$empty_cart_link = isset($smof_data['shop-cart-menu-empty-link']) ? $smof_data['shop-cart-menu-empty-link'] : '';
			if (!trim($empty_cart_link)) $empty_cart_link = $woocommerce->cart->get_cart_url();
		}
		
		$cart_url = $woocommerce->cart->get_cart_url();
		$cart_contents_count = $woocommerce->cart->cart_contents_count;
		$cart_contents = sprintf(_n('%d item', '%d items', $cart_contents_count, 'wi'), $cart_contents_count);
		$cart_total = strip_tags(	$woocommerce->cart->get_cart_total()	);
		
		$title_attr =  $cart_contents.' - '. $cart_total;

		if ( $cart_contents_count > 0 || $empty_cart != 'hide' ) {
			if ($cart_contents_count == 0) {
				$menu_item = '<li class="menu-item menu-item-type-custom menu-cart menu-cart-empty"><a href="'. $empty_cart_link .'">';
			} else {
				$menu_item = '<li class="menu-item menu-item-type-custom menu-cart menu-cart-has"><a href="'. $cart_url .'" title="'. $title_attr .'">';
			}
 
			$menu_item .= '<i class="icon-shopping-cart"></i>';
			$menu_item .= '</a></li>';
			
			echo $menu_item;
		} // if not empty cart
		
	$return = ob_get_clean();
	return $menu . $return;
} 
}

/* Shop Archive
-------------------------------------- */
	/* Option for Display Breadcrumb*/
add_action( 'init', 'wi_display_wc_breadcrumbs' );
if(!function_exists('wi_display_wc_breadcrumbs')){
function wi_display_wc_breadcrumbs() {
	global $smof_data;
	$display_breadcrumb = ( isset($smof_data['shop-breadcrumb']) && $smof_data['shop-breadcrumb'] ) ? true : false;
	if (!$display_breadcrumb) remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
}

	/* Sorting & Result */
$show_sorting = (isset($smof_data['shop-display-sorting']) && $smof_data['shop-display-sorting']) ? true : false;
if ( !$show_sorting ) {
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
}
$show_result_count =( isset($smof_data['shop-display-result-count']) && $smof_data['shop-display-result-count']) ? true : false;
if ( !$show_result_count ) {
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
}

	/* Column Archive and Cross Sells */
add_filter('loop_shop_columns', 'wiwoo_loop_columns');
add_filter('woocommerce_cross_sells_columns', 'wiwoo_loop_columns');
if (!function_exists('wiwoo_loop_columns')) {
	function wiwoo_loop_columns() {
		global $smof_data;
		$column = isset($smof_data['shop-products-column']) ? $smof_data['shop-products-column'] : 4;
		return $column; // $column products per row
	}
}
				/* Add column class before and after main loop */
add_action('woocommerce_before_shop_loop', 'wiwoo_woocommerce_before_shop_loop', 50); // after everything to wrap the loop
if (!function_exists('wiwoo_woocommerce_before_shop_loop')){
function wiwoo_woocommerce_before_shop_loop() {
	global $smof_data;
	$column = isset($smof_data['shop-products-column']) ? $smof_data['shop-products-column'] : 4;
	echo '<div class="wi-products column-'.$column .'">';
}
}
add_action('woocommerce_after_shop_loop', 'wiwoo_woocommerce_after_shop_loop', 1); // before everything to wrap the loop
if (!function_exists('wiwoo_woocommerce_after_shop_loop')){
function wiwoo_woocommerce_after_shop_loop() {echo '</div>';}
}
				/* Add class for cross sells */
add_filter('body_class','wi_cross_sells_products_column');
if ( !function_exists('wi_cross_sells_products_column') ) {
function wi_cross_sells_products_column($classes){
	global $smof_data;
	if ( !wiwoo() ) return $classes;
	$column = isset($smof_data['shop-products-column']) ? $smof_data['shop-products-column'] : 4;
	if ( is_cart() ) {
		$classes[] = 'products-column-'.$column;
	}
	return $classes;
}
}				

	/* Change number of products to show */
$products_per_page = isset($smof_data['shop-products-per-page']) ? $smof_data['shop-products-per-page'] : '';
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$products_per_page.';' ), 20 );


	/* Number of related products */
if(!function_exists('wiwoo_related_products_limit')){
function wiwoo_related_products_limit() {
	global $smof_data, $post, $product;
	$number_related_products = absint(get_post_meta(get_the_ID(),'_wi_product-related-number',true));
	if(!$number_related_products) $number_related_products = isset($smof_data['shop-related-products-number']) ? $smof_data['shop-related-products-number'] : 4;
	$column = absint(get_post_meta(get_the_ID(),'_wi_product-related-per-row',true));
	if(!$column) $column = isset($smof_data['shop-related-products-column']) ? $smof_data['shop-related-products-column'] : 4;
	$args = array(
			'posts_per_page' 	=>	$number_related_products,
			'columns' 			=>	$column,
			'orderby'			=>	'rand'
		);
	return $args;
}
}
add_filter( 'woocommerce_output_related_products_args', 'wiwoo_related_products_limit' );

	/* Upsell */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'wiwoo_output_upsells', 15 ); 
if ( ! function_exists( 'wiwoo_output_upsells' ) ) {
function wiwoo_output_upsells() {
	global $smof_data, $post, $product;
	$upsells = $product->get_upsells();
	if ( sizeof( $upsells ) == 0 ) return;
	
	$column = absint(get_post_meta(get_the_ID(),'_wi_product-related-per-row',true));
	if(!$column) $column = isset($smof_data['shop-related-products-column']) ? $smof_data['shop-related-products-column'] : 4;
	woocommerce_upsell_display( sizeof($upsells) , $column ); // Display 3 products in rows of 3
}
}	

	/* Products Column in single view */
add_filter('body_class','wi_related_products_column');
if ( !function_exists('wi_related_products_column') ) {
function wi_related_products_column($classes){
	global $smof_data;
	$column = absint(get_post_meta(get_the_ID(),'_wi_product-related-per-row',true));
	if(!$column) $column = isset($smof_data['shop-related-products-column']) ? $smof_data['shop-related-products-column'] : 4;
	if ( is_singular('product') ) {
		$classes[] = 'products-column-'.$column;
	}
	return $classes;
}
}

	/* Product Secondary Image */
add_action( 'woocommerce_before_shop_loop_item_title', 'wiwoo_template_loop_product_second_thumbnail', 9 );
if ( !function_exists('wiwoo_template_loop_product_second_thumbnail') ) {
function wiwoo_template_loop_product_second_thumbnail(){
	global $post, $smof_data;
	$secondary_thumb = get_post_meta(get_the_ID(),'_wi_product-secondary-image',true);
	if ( $secondary_thumb ) {
		echo '<span class="thumb-wrap crossfade">';
		echo wp_get_attachment_image($secondary_thumb,'shop_catalog',false,array('class' => 'secondary-image'));
	} else {
		echo '<span class="thumb-wrap">';
	}
}
}
add_action( 'woocommerce_before_shop_loop_item_title', create_function('', 'echo "</span>";'), 11 );
	

	/* Do not display related items */
$display_related_products = ( isset($smof_data['shop-single-display-related-products']) && $smof_data['shop-single-display-related-products'] ) ? 'yes' : 'no';
if ( $display_related_products=='no') {
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}	

	/* Add an inner div */
add_action( 'woocommerce_before_shop_loop_item', create_function('','echo \'<div class="inner">\';' ));
add_action( 'woocommerce_after_shop_loop_item', create_function('','echo \'</div>\';' ));

	/* Wrap Rating and Price */
add_action( 'woocommerce_before_shop_loop_item_title', create_function('','echo \'<div class="meta">\';' ), 20);
add_action( 'woocommerce_after_shop_loop_item_title', create_function('','echo \'</div>\';' ), 20);

	/* Bottom */
add_action( 'woocommerce_after_shop_loop_item', create_function('','echo \'<div class="bottom">\';' ), 5);
add_action( 'woocommerce_after_shop_loop_item', create_function('','echo \'</div>\';' ), 15);

	/* Remove Shop title */
add_filter( 'woocommerce_show_page_title', '__return_false');

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
add_action('woocommerce_before_main_content','wiwoo_before_main_content');
if ( !function_exists('wiwoo_before_main_content') ) {
function wiwoo_before_main_content(){
	global $smof_data, $wi_has_sidebar;

	$titlebar_classes = array('titlebar');
	$page_classes = is_singular() ? array('wi-single-product') : array('wi-shop-archive');
	$page_id = is_singular() ? 'page-product-' . get_the_ID() : 'shop-archive-page';
	
	/* TEMPLATE & SIDEBAR POSITION */
	if ( is_singular('product') ) {
			$page_template = get_post_meta ( get_the_ID(), '_wi_product-layout', true );
			if ( !$page_template ) {
				$page_template = isset($smof_data['shop-single-template']) ? $smof_data['shop-single-template'] : 'sidebar';
			}
			$sidebar_position = get_post_meta ( get_the_ID(), '_wi_product-sidebar-position', true );
			if ( !$sidebar_position ) {
				$sidebar_position = isset($smof_data['shop-single-sidebar-position']) ? $smof_data['shop-single-sidebar-position'] : 'right';
			}
	} else { // shop archive, cats...
				$page_template = isset($smof_data['shop-template']) ? $smof_data['shop-template'] : 'sidebar';
				$sidebar_position = isset($smof_data['shop-sidebar-position']) ? $smof_data['shop-sidebar-position'] : 'right';
	}
	if ( $page_template == 'sidebar' ) $wi_has_sidebar = true;
	if ($wi_has_sidebar) $page_classes[] = 'has-sidebar';
	$page_classes[] = 'sidebar-'.$sidebar_position;
	
	$titlebar_classes = join(' ', $titlebar_classes);
	$titlebar_classes = esc_attr($titlebar_classes);
	
	$page_classes = join(' ',$page_classes);
	$page_classes = esc_attr($page_classes);

?>	
<div class="container">

	<article class="<?php echo $page_classes;?>" id="<?php echo $page_id;?>">
	
<?php	
/* Template has sidebar
----------------------------- */
	if ( $page_template == 'sidebar' ): ?>
	
			<div class="row-fluid">
				
				<div class="span8" id="primary">
	
	<?php else : // fullwidth ?>
	
	<?php endif; // sidebar or not
	
}
}

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_after_main_content','wiwoo_after_main_content');
if ( !function_exists('wiwoo_after_main_content') ) {
function wiwoo_after_main_content(){
	global $smof_data;
	
	/* TEMPLATE */
	if ( is_singular('product') ) {
			$page_template = get_post_meta ( get_the_ID(), '_wi_product-layout', true );
			if ( !$page_template ) {
				$page_template = isset($smof_data['shop-single-template']) ? $smof_data['shop-single-template'] : 'sidebar';
			}
	} else { // shop archive, cats...
				$page_template = isset($smof_data['shop-template']) ? $smof_data['shop-template'] : 'sidebar';
	}
	
	if ( $page_template == 'sidebar' ): ?>
	
		</div><!-- #primary -->
	
	<?php else : // fullwidth ?>
	
	<?php endif; // sidebar or not
}
}

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
add_action('woocommerce_sidebar','wiwoo_sidebar');
if ( !function_exists('wiwoo_sidebar') ) {
function wiwoo_sidebar(){
	global $smof_data;
	/* TEMPLATE */
	if ( is_singular('product') ) {
			$page_template = get_post_meta ( get_the_ID(), '_wi_product-layout', true );
			if ( !$page_template ) {
				$page_template = isset($smof_data['shop-single-template']) ? $smof_data['shop-single-template'] : 'sidebar';
			}
	} else { // shop archive, cats...
				$page_template = isset($smof_data['shop-template']) ? $smof_data['shop-template'] : 'sidebar';
	}
	if ( $page_template == 'sidebar' ) :?>
		
		<div id="secondary" class="widget-area span4" role="complementary">
			<?php dynamic_sidebar( 'shop' ); ?>
		</div><!-- #secondary -->
	
	</div><!-- .row-fluid -->
		
	<?php else: // fullwidth template ?>
	
	<?php endif; // sidebar or fullwidth?>
	
</article><!-- article -->
</div><!-- .container -->	
<?php	
	
}
} 

	/* 
	 * Single Product Title 
	 * Basically want to replace h1 by h2
	 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title' , 5); // remove single title
add_action( 'woocommerce_single_product_summary', 'wiwoo_template_single_title', 5 ); // add single title
if (!function_exists('wiwoo_template_single_title')) {
function wiwoo_template_single_title(){
	echo '<h2 itemprop="name" class="product_title entry-title">' . get_the_title() . '</h2>';
}
}	

	/* 
	 * Single Product Border
	 * It appears below the price
	 */
add_action( 'woocommerce_single_product_summary', 'woo_template_single_border', 11 );
if (!function_exists('woo_template_single_border')) {
function woo_template_single_border(){
	echo '<div class="clearfix"></div><div class="product-border"></div><div class="clearfix"></div>';
}
}

	/* 
	 * A Spacer before tab =.=
	 */
	
add_action( 'woocommerce_after_single_product_summary', 'woo_spacer_before_tabs', 9 );	
if (!function_exists('woo_spacer_before_tabs')) {
function woo_spacer_before_tabs(){
	echo '<div class="clearfix"></div><div class="product-spacer"></div><div class="clearfix"></div>';
}
}