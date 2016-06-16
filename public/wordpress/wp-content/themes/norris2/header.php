<?php global $smof_data; ?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7 no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8 no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title><?php wp_title( '-', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php if( isset ( $smof_data['favicon'] ) &&  $smof_data['favicon']!= '' ) { ?>
	<link rel="shortcut icon" href="<?php echo $smof_data['favicon']; ?>">
<?php } ?>
<?php if( isset ( $smof_data['apple-iphone-icon'] ) &&  $smof_data['apple-iphone-icon'] != '' ) { ?>
	<link rel="apple-touch-icon" href="<?php echo $smof_data['apple-iphone-icon']; ?>">
<?php } ?>

<?php if( isset ($smof_data['apple-iphone-retina-icon']) && $smof_data['apple-iphone-retina-icon']!= '' ) { ?>
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $smof_data['apple-iphone-retina-icon']; ?>">
<?php } ?>

<?php if( isset ($smof_data['apple-ipad-icon'] ) &&  $smof_data['apple-ipad-icon']!= '') { ?>
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $smof_data['apple-ipad-icon']; ?>">
<?php } ?>

<?php if( isset ($smof_data['apple-ipad-retina-icon']) && $smof_data['apple-ipad-retina-icon']!= '' ) { ?>
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $smof_data['apple-ipad-retina-icon']; ?>">
<?php } ?>

<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="top"></div>

<?php get_template_part('inc/top-area');?>

<?php $header_proportion = isset ( $smof_data['header-proportion'] ) ? $smof_data['header-proportion'] : 'span3';
$header_proportion = substr($header_proportion,4,1);
$header_proportion = absint($header_proportion);
?>

<!--										HEADER											-->
<header id="wi-header" class="wi-header">
	<div class="container">
		<div class="row-fluid">
			<div class="span<?php echo $header_proportion;?>">
				<div id="wi-logo" class="wi-logo">
					<a href="<?php echo home_url();?>" rel="home">
					<?php $logo = isset ( $smof_data['logo'] ) ? trim($smof_data['logo']) : ''; if ($logo == '' || ( isset( $smof_data['text-logo']) && $smof_data['text-logo'] ) ) :?>
						<?php bloginfo('name');?>
					<?php else:	// image logo ?>
						<img src="<?php echo esc_url( $logo );?>" alt="<?php bloginfo('name');?>" />
					<?php endif;	// text logo or image logo ?>	
					</a>
				</div><!-- .wi-logo -->
			</div><!-- .span3 -->
			<div class="span<?php echo (12 - $header_proportion);?>">
				<nav id="wi-mainnav" class="wi-mainnav">
					<?php
					
					$args = array(
							'theme_location'	=>	'primary',
							'depth'				=>	2,
							'container_class'	=>	'menu',
						);
					if ( has_nav_menu('primary') && !disable_onepage() ) {
						$args['walker'] = new wi_nav_walker();
					}	
					
					wp_nav_menu($args);
					?>
				</nav><!-- .wi-mainnav -->
				<select id="wi-mainnav-mobile"></select>
			</div><!-- .span9 -->
		</div><!-- .row-fluid -->		
	</div><!-- .container -->
</header><!-- .wi-header -->

<div id="wi-content">

<?php get_template_part('inc/headline');?>