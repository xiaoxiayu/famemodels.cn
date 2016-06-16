<?php
/* ------------------------------------------------------- */
/* Remove automatics
/* ------------------------------------------------------- */
add_filter('the_content', 'wi_pre_process_shortcode', 7);

// Allow Shortcodes in Widgets
add_filter('widget_text', 'wi_pre_process_shortcode', 7);
if (!function_exists('wi_pre_process_shortcode')){
function wi_pre_process_shortcode($content){
	$shortcodes = 'column, align, heading, center_heading, bigtext, progress, progress_group, piechart, member, tab, accordion, toggle, button, counter, iconbox, small_iconbox, flexslider, brands, pricing, gmap, list, icon, dropcap, text_dropcap, highlight, br, clear, spacer, hr, separator, wi_video, wi_soundcloud, testimonials, imagebox,fullwidth, iconlist';
	$shortcodes = explode(",",$shortcodes);
	$shortcodes = array_map("trim",$shortcodes);
	
	global $shortcode_tags;

    // Backup current registered shortcodes and clear them all out
    $orig_shortcode_tags = $shortcode_tags;
	$shortcode_tags = array();
	
	foreach ($shortcodes as $shortcode){
		add_shortcode($shortcode,'wi_'.$shortcode.'_shortcode');
	}	
	 // Do the shortcode (only the one above is registered)
    $content = do_shortcode($content);
 
    // Put the original shortcodes back
    $shortcode_tags = $orig_shortcode_tags;
 
    return $content;
}
}

/* ------------------------------------------------------- */
/* Columns
/* ------------------------------------------------------- */
if (!function_exists('wi_column_shortcode')){
function wi_column_shortcode($atts,$content = NULL){
	extract(shortcode_atts(array(
		'size'		=>  '1/2',
		'last'		=>	'false',
	), $atts));
	if(!in_array($size,array('1/2','1/3','2/3','1/4','3/4','1/5','2/5','3/5','4/5','1/6','5/6'))) $size="1/2";
	$size = str_replace("/","-",$size);

	if($last!='true')
	$return = '<div class="wi-column column-'.$size.'">'.do_shortcode($content).'</div>';
	else
	$return = '<div class="wi-column column-last column-'.$size.'">'.do_shortcode($content).'</div><div class="clearfix"></div>';
	return $return;	
}
}

/* ------------------------------------------------------- */
/* Align
/* ------------------------------------------------------- */
if (!function_exists('wi_align_shortcode')){
function wi_align_shortcode($atts,$content = NULL){
	extract(shortcode_atts(array(
		'align'		=>  '',
	), $atts));
	
	$align = trim($align);
	if ( $align!='center' && $align!='right' ) $align = 'left';
	
	$return = '<div class="align-'.$align.'">' . do_shortcode($content) . '</div>';	
	return $return;	
}
}


/* ------------------------------------------------------- */
/* Heading
/* ------------------------------------------------------- */
if (!function_exists('wi_heading_shortcode')){
function wi_heading_shortcode($atts,$content = NULL){
	extract(shortcode_atts(array(
		'h'				=>	'',
		'heading'		=>  '',
	), $atts));
	
	$heading = strtolower( trim ($heading) );
	if ( !$heading ) $heading = $h;
	if(!in_array($heading,array('h1','h2','h3','h4','h5','h6'))) $heading = 'h2';
	
	$return = '<div class="wi-heading">';
	$return .= '<' . $heading . ' class="h">' . trim($content) . '</' . $heading . '>';
	$return .= '</div>';

	return $return;	
}
}

/* ------------------------------------------------------- */
/* Center Heading
/* ------------------------------------------------------- */
if (!function_exists('wi_center_heading_shortcode')){
function wi_center_heading_shortcode($atts,$content = NULL){
	extract(shortcode_atts(array(
		'h'				=>	'',
		'heading'		=>  '',
	), $atts));
	
	$heading = strtolower( trim ($heading) );
	if ( !$heading ) $heading = $h;
	if(!in_array($heading,array('h1','h2','h3','h4','h5','h6'))) $heading = 'h2';
	
	$return = '<div class="wi-center-heading">';
	$return .= '<' . $heading . ' class="h">' . trim($content) . '</' . $heading . '>';
	$return .= '</div>';

	return $return;	
}
}

/* ------------------------------------------------------- */
/* BigText
/* ------------------------------------------------------- */
if (!function_exists('wi_bigtext_shortcode')){
function wi_bigtext_shortcode($atts,$content = NULL){
	extract(shortcode_atts(array(
		'font'			=>  '',
		'bg'			=>	'',
	), $atts));
	
	if ( $font ) {
		$font = str_replace(' ','-',$font);
		$font_class = ' font-'.$font;
	} else {
		$font_class = '';
	}
	
	$bg_class = ($bg == 'true') ? ' class="bg"' : '';
	
	wp_enqueue_script('wi-bigtext');
	$return = '<div class="bigtext'.$font_class.'"><div'.$bg_class.'>' . trim($content) . '</div></div>';
	return $return;

}
}

/* ------------------------------------------------------- */
/* Progress bar
/* ------------------------------------------------------- */
if (!function_exists('wi_progress_shortcode')){
function wi_progress_shortcode($atts,$content = NULL){
	extract(shortcode_atts(array(
		'percent'		=>  '',
		'name'			=>	'',
		'color'			=>	'',
	), $atts));
	
		/* name */
	$name = trim ($name);
	
		/* percent */
	$percent = absint( $percent );
	if ( $percent > 100 || $percent < 0) $percent = 0;
	
		/* color */
	$color = apply_filters('wi_progress_color', $color );
	$color = trim($color);
	if ( !$color || $color == 'primary' ) $color = '#b40606';
	
	$return = '<div class="progress">';	
	$return .= '<div class="fore">';
	$return .= '<div class="bar" style="width:'.$percent.'%; background-color:'.$color.'"></div>';
	$return .= '<div class="name">' . $name . '</div>';
	$return .= '</div></div>';

	return $return;	
}
}

/* ------------------------------------------------------- */
/* Progress group
/* ------------------------------------------------------- */
if (!function_exists('wi_progress_group_shortcode')){
function wi_progress_group_shortcode($atts,$content = NULL){

	$return = '<div class="progress-group">' . do_shortcode($content) . '</div>';
	return $return;	
}
}

/* ------------------------------------------------------- */
/* PieChart
/* ------------------------------------------------------- */
if (!function_exists('wi_piechart_shortcode')){
function wi_piechart_shortcode($atts,$content = NULL){
	extract(shortcode_atts(array(
		'percent'		=>  '',
		'thickness'		=>	'5',
		'size'			=>	'120',		
		'name'			=>	'',
		'color'			=>	'',
		'forecolor'		=>	'#ccc',
	), $atts));
	
	wp_enqueue_script('wi-piechart');
	
		/* name */
	$name = trim ($name);

		/* percent */
	$percent = absint( $percent );
	if ( $percent > 100 || $percent < 0) $percent = 0;
		/* thickness */
	$thickness = absint($thickness);
	if ( $thickness < 0 || $thickness > 40 ) $thickness = 4;
		/* size */
	$size = absint($size);	
	if ( $size < 40 || $size > 400 ) $size = 120;
	
		/* color */
	$color = apply_filters('wi_piechart_color', $color );
	$color = trim($color);
	if ( !$color || $color == 'primary' ) $color = '#b40606';
	
	$return = '<div class="wi-piechart-container">';
	$return .= '<div class="wi-piechart" data-percent="'.$percent.'" data-thickness="'.$thickness.'" data-size="'.$size.'" data-color="'.esc_attr($color).'" data-forecolor="'.esc_attr($forecolor).'" style="width:'.$size.'px; height:'.$size.'px; line-height:'.$size.'px;">';
	$return .= '<span class="number">'.$percent.'</span>';
	$return .= '<sup class="percent">%</sup>';
	$return .= '</div>'; // wi-piechart
	$return .= '<div class="name">' . $name . '</div>';
	if ( $content = trim($content) ) {
		$return .= '<div class="desc"><p>' . do_shortcode($content) . '</p></div>';
	}	
	$return .= '</div>'; // wi-piechart-container
	
	return $return;	
}
}

/* ------------------------------------------------------- */
/* Member
/* ------------------------------------------------------- */
if (!function_exists('wi_member_shortcode')){
function wi_member_shortcode($atts,$content = NULL){
	extract(shortcode_atts(array(
		'name'			=>  '',
		'image'			=>	'',
		'role'			=>	'',
	), $atts));
	
		/* image */
	$image = trim($image);
	if ( !$image ) {
		$image = plugin_dir_url( __FILE__ ) . 'images/member.png';
		}
		
		/* name */
	$name = trim($name);
	$role = trim($role);
	
		/* content */
	$content = do_shortcode( trim($content) );
	
		/* social */
	if ( function_exists('wi_social_array') ) {	
		$social_array = wi_social_array();
		$social_array['email'] = __('Email','wi');
		$social_array['googleplus'] = __('Google+','wi');
		$social_array['google_plus'] = __('Google+','wi');
	} else {
		$social_array = array();
	}
	$display_social = array();
	
	foreach ( $atts as $key => $val ) {
		if ( $key == 'email') $icon = 'envelope-alt'; 
		elseif ( $key == 'googleplus' || $key == 'google_plus' ) $icon = 'google-plus';
		else $icon = $key;
		
		if ( isset ($social_array[$icon]) && trim($atts[$key]) ) {
			$display_social[] = '<li><a href="'.esc_url($atts[$key]).'" title="'.esc_attr($social_array[$icon]).'" target="_blank"><i class="icon-'.$icon.'"></i></a></li>';		
		}	
	}
	
	$return =  '<div class="wi-member">';
	$return .= '<div class="image">';
	$return .= '<img src="' . esc_url($image) . '" alt="'.esc_attr($name).'" />';
	$return .= '</div>'; // image
	$return .= '<div class="text">';
	$return .= '<div class="name">'. $name .'</div>';
	if ( $role ) $return .= '<div class="role">' . $role . '</div>';
	if ( trim($content) ) {
	$return .= '<div class="desc"><p>' .$content . '</p></div>';
	}
	$return .= '</div>'; // text
	if ( !empty($display_social) ) {
		$return .= '<div class="social"><ul>';
		$return .= join ('', $display_social );
		$return .= '<ul></div>'; // social
	}
	
	$return .= '</div>'; // wi member 
	
	return $return;	
}
}

/* ------------------------------------------------------- */
/* Tab
/* ------------------------------------------------------- */
if (!function_exists('wi_tab_shortcode')){
function wi_tab_shortcode($atts,$content = NULL){

	if (!preg_match_all("/(.?)\[(tab_element)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab_element\])?(.?)/s", $content, $matches)) :
		return do_shortcode($content);		
	else :
		$rand = rand(0,9999);
		$nav = '<nav class="tabnav"><ul>'; $return = '';
		
		for($i = 0; $i < count($matches[0]); $i++):
			
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
			$icon = isset( $matches[3][$i]['icon'] ) ? trim($matches[3][$i]['icon']) : '';
			$name = isset( $matches[3][$i]['name'] ) ? trim($matches[3][$i]['name']) : '';
			if ($icon) {
				$icon = '<i class="icon-'.$icon.'"></i>'; 
			} else {
				$icon = '';
			}
			if ( $i == 0 ) $active = 'active'; else $active = '';
			$nav .= '<li class="'.$active.'"><a data-href="#tab'.$rand.$i.'">' . $icon . $name . '</a></li>';
			$return .= '<div id="tab'.$rand.$i.'" class="tab-content '.$active.'"><p>' . do_shortcode($matches[5][$i]) . '</p></div>';
									
		endfor;
		
		$nav .= '</ul></nav>';

		$return = '<div class="wi-tab">'. $nav . $return. '<div class="clearfix"></div></div>';
		return $return;
		
	endif;
}
}

/* ------------------------------------------------------- */
/* Accordion
/* ------------------------------------------------------- */
if (!function_exists('wi_accordion_shortcode')){
function wi_accordion_shortcode($atts,$content = NULL){

	if (!preg_match_all("/(.?)\[(toggle)\b(.*?)(?:(\/))?\](?:(.+?)\[\/toggle\])?(.?)/s", $content, $matches)) :
		return do_shortcode($content);		
	else :
		$return = '<div class="wi-accordion">';
		
		for($i = 0; $i < count($matches[0]); $i++):
			
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
			$name = isset( $matches[3][$i]['name'] ) ? trim($matches[3][$i]['name']) : '';
			if ( !$name ) $name = isset( $matches[3][$i]['title'] ) ? trim($matches[3][$i]['title']) : '';
			if ( $i != 0 ) {
				$active = '';
			} else {
				$active = ' active';
			}
			$return .= '<div class="wi-toggle">';
			$return .= '<div class="toggle-title'.$active.'">'.$name.'</div>';
			$return .= '<div class="toggle-content'.$active.'"><p>'.do_shortcode($matches[5][$i]) . '</p></div>';
			$return .= '</div>'; // wi-toggle

		endfor;
		
		$return .= '</div>'; // wi-accordion
		
		return $return;
		
	endif;
}
}

/* ------------------------------------------------------- */
/* Toggle
/* ------------------------------------------------------- */
if (!function_exists('wi_toggle_shortcode')){
function wi_toggle_shortcode($atts,$content = NULL){
	extract(shortcode_atts(array(
		'name'			=>  '',
		'title'			=>	'',	// alias of name
		'open'			=>	'false',
	), $atts));
	
	$name = trim($name);
	if ( !$name ) $name = trim( $title );	
	if ($open != 'true' ) $open = 'false';
	
	if ( $open == 'true' ) {
		$active = ' active';
	} else {
		$active = '';
	}
	
	$return = '<div class="wi-toggle toggle-mode">';
	$return .= '<div class="toggle-title'.$active.'">'.$name.'</div>';
	$return .= '<div class="toggle-content'.$active.'"><p>'. do_shortcode( $content ) . '</p></div>';
	$return .= '</div>'; // wi-toggle
	
	return $return;
}
}

/* ------------------------------------------------------- */
/* Button
/* ------------------------------------------------------- */
if (!function_exists('wi_button_shortcode')){
function wi_button_shortcode($atts,$content = NULL){
	extract(shortcode_atts(array(
		'link'			=>  '',
		'url'			=>	'',
		'target'		=>	'_self',
		'icon'			=>	'',
		'icon_position'	=>	'right',
		'color'			=>	'',
		'align'			=>	'',
		'scroll'		=>	'false',
	), $atts));
		
	$button_class = '';

		/* icon */
	$icon_position = trim($icon_position);
	if ( $icon_position!='left' ) $icon_position = 'right';		
	$icon = trim($icon);
	if ( $icon ) {
		$ic = '<i class="icon-'.$icon.' '.$icon_position.'-icon"></i>';
		$button_class .= ' has_icon';
	} else $ic = '';
	
		/* color */
	$style = '';
	if ($color!='white' && $color!='none') $color = apply_filters('wi_button_color',trim($color));
	if ( $color == 'primary' ) $color = '#b40606';
	if ( $color && $color != 'white' ) {
		$style .= 'background-color:'.$color.';';
	}		
	if ( $color == 'white' ) $button_class .= ' btn-white';
	
	if ( $style ) $style = ' style="'.$style.'"';
	
		/* link */
	$link = trim($link);
	if (!$link) $link = trim($url);
	if ( $link ) {
		if ( trim($target) == '_blank' ) $target = '_blank'; else $target = '_self';
		$target = ' target="'.$target.'"';
		$href = ' href="'.esc_url($link).'"';
	} else {
		$target = '';
		$href = '';
	}
	
		/* align */
	$align = trim($align);
	if ( $align!= 'right' && $align != 'center' ) $align = 'left';
	
		/* scroll */
	if ( trim($scroll) == 'true' ) $button_class .= ' btn-scroll';
	
		/* content */
	if ( !trim($content) ) $button_class .= ' no-content';
	
	$return = '<div class="wi-button align-'.$align.'">';
	$return .= '<a class="btn'.$button_class.'"' . $href . $target . $style . '>';
	
	if ( $icon_position == 'left') $return .= $ic . '<span>' . trim($content) . '</span>';
	else $return .= '<span>' . trim($content) . '</span>' . $ic ;
	
	$return .= '</a></div>';
	
	return $return;
}
}

/* ------------------------------------------------------- */
/* Counter
/* ------------------------------------------------------- */
if (!function_exists('wi_counter_shortcode')){
function wi_counter_shortcode($atts,$content = NULL){
	extract(shortcode_atts(array(
		'name'			=>	'',
		'number'		=>	'',
		'delay'			=>	'0',
	), $atts));
	
		/* delay */
	$delay = absint($delay);
	
		/* name */
	$name = trim($name);
	$number = absint($number);
	
	$return = '<div class="wi-count" data-number="'.$number.'" data-delay="'.$delay.'">';
	if ( $number ) {
		$return .= '<div class="number">' . $number . '</div>';		
	}
	if ( $name ) {
		$return .= '<div class="name">' . $name . '</div>';
	}
	if ( $content = trim($content) ) {
		$return .= '<div class="desc"><p>' . do_shortcode($content) . '</p></div>';
	}
	$return .= '</div>'; // wi count
	return $return;
}
}

/* ------------------------------------------------------- */
/* Iconbox
/* ------------------------------------------------------- */
if (!function_exists('wi_iconbox_shortcode')){
function wi_iconbox_shortcode($atts,$content = NULL){
	extract(shortcode_atts(array(
		'icon'			=>  'search',
		'name'			=>	'',
		'title'			=>	'',	// alias of name
	), $atts));
	
		/* name */
	$name = trim($name);
	if (!$name) $name = trim($title);
		
		/* icon */
	$icon = trim($icon);
	if ( strpos($icon,'//') !== false ) {
		$ic = '<img src="' . esc_url($icon) . '" />';
		$ic_class = 'ic-image';
	}	else {
		$ic = '<i class="icon-'.$icon.'"></i>';
		$ic_class = 'ic-icon';
	}
	
	$return = '<div class="wi-iconbox">';
	
	$return .= '<div class="icon '.$ic_class.'">' . $ic . '</div>';
	$return .= '<h4 class="name">' . $name . '</h4>';
	$return .= '<div class="desc"><p>' . do_shortcode( trim($content) ) . '</p></div>';
	
	$return .= '</div>'; // wi iconbox
	return $return;
}
}

/* ------------------------------------------------------- */
/* Small Iconbox
/* ------------------------------------------------------- */
if (!function_exists('wi_small_iconbox_shortcode')){
function wi_small_iconbox_shortcode($atts,$content = NULL){
	extract(shortcode_atts(array(
		'icon'			=>  'search',
		'name'			=>	'',
		'title'			=>	'',	// alias of name
	), $atts));
	
		/* name */
	$name = trim($name);
	if (!$name) $name = trim($title);
		
		/* icon */
	$icon = trim($icon);
	
	$return = '<div class="wi-small-iconbox">';
	$return .= '<h4 class="iconbox-title">';
	$return .= '<i class="icon-'.$icon.'"></i>';
	$return .= '<span class="title">' . $name . '</span>';
	$return .= '</h4>';
	$return .= '<div class="iconbox-content"><p>' . do_shortcode( trim($content) ) . '</p></div>';	
	$return .= '</div>'; // wi small iconbox
	return $return;
}
}

/* ------------------------------------------------------- */
/* Brands
/* ------------------------------------------------------- */
if (!function_exists('wi_brands_shortcode')){
function wi_brands_shortcode($atts,$content = NULL){
	if (!preg_match_all("/(.?)\[(brand)\b(.*?)(?:(\/))?\](?:(.+?)\[\/brand\])?(.?)/s", $content, $matches)) :
		return do_shortcode($content);		
	else :
		
		$number = count($matches[0]);
		
		$return = '<div class="brands brands-'.$number.'">';
		
		for($i = 0; $i < count($matches[0]); $i++):
			
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
			$src = trim($matches[5][$i]);
			$title = isset( $matches[3][$i]['title'] ) ? trim($matches[3][$i]['title']) : '';
			$link = isset( $matches[3][$i]['link'] ) ? trim($matches[3][$i]['link']) : '';
			$target = isset( $matches[3][$i]['target'] ) ? trim($matches[3][$i]['target']) : '';
			if ( $target!='_blank' ) $target = '_self';
			if ( $link ) {
				$open = '<a href="'.esc_url($link).'" target="'.$target.'">';
				$close = '</a>';
			} else {
				$open = $close = '';
			}
			if ( $src ) {
				$img = '<img src="'.esc_url($src).'" alt="'.$title.'" />';
			} else {
				$img = '';
			}
			if ($title) $title_attr = ' title="'.esc_attr($title).'"'; else $title_attr = '';
			$return .= '<div class="brand"'.$title_attr.'>' . $open . $img . $close . '</div>';

		endfor;
		
		$return .= '<div class="clearfix"></div></div>'; // brands
		
		return $return;
		
	endif;
}
}

/* ------------------------------------------------------- */
/* FlexSlider
/* ------------------------------------------------------- */
if (!function_exists('wi_flexslider_shortcode')){
function wi_flexslider_shortcode($atts,$content = NULL){
	extract(shortcode_atts(array(
		'navi'			=>  'true',
		'auto'			=>	'false',
		'effect'		=>	'',
	), $atts));

	if (!preg_match_all("/(.?)\[(slide)\b(.*?)(?:(\/))?\](?:(.+?)\[\/slide\])?(.?)/s", $content, $matches)) :
		return do_shortcode($content);		
	else :

		wp_enqueue_script('wi-flexslider');
		wp_enqueue_style('wi-flexslider');
		
			/* auto */
		if ( trim($auto) != 'true' ) $auto = 'false'; else $auto = 'true';
		
			/* navi */
		if ( trim($navi)!= 'false' ) {
			$navi = 'true';
			$has_navi = ' has_navi';
		} else {
			$navi = 'false';
			$has_navi = '';
		}
		
			/* effect */
		$effect = trim($effect);
		if ( $effect!= 'fade' ) $effect = 'slide';
		
		$return = '<div class="wi-flexslider'. $has_navi . '" data-auto="'.$auto.'" data-navi="'.$navi.'" data-effect="'.$effect.'">';
		$return .= '<div class="flexslider"><ul class="slides">';
		
		for($i = 0; $i < count($matches[0]); $i++):
			
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
			$image = trim($matches[5][$i]);
			
			if ( $image ) {
				$img = '<img src="' . esc_url($image) . '" alt="'.basename($image).'" />';
			} else {
				$img = '';
			}
			
			$link = isset( $matches[3][$i]['link'] ) ? trim($matches[3][$i]['link']) : '';
			$target = isset( $matches[3][$i]['target'] ) ? trim($matches[3][$i]['target']) : '';
			if ( $target != '_blank') $target = '_self';
			if ( !$link ) $link = isset( $matches[3][$i]['url'] ) ? trim($matches[3][$i]['url']) : '';
			
			if ( $link ) {
				$open = '<a href="'.esc_url($link).'" target="'.$target.'">';
				$close = '</a>';
			} else {
				$open = '';
				$close = '';
			}
			
			$return .= '<li class="slide">' . $open . $img . $close. '</li>';

		endfor;
		
		$return .= '</ul></div></div>'; // wi-flexslider		
		return $return;
		
	endif;
}
}

/* ------------------------------------------------------- */
/* Pricing Table
/* ------------------------------------------------------- */
if (!function_exists('wi_pricing_shortcode')){
function wi_pricing_shortcode($atts,$content = NULL){
	
	if (!preg_match_all("/(.?)\[(pricing_column)\b(.*?)(?:(\/))?\](?:(.+?)\[\/pricing_column\])?(.?)/s", $content, $matches)) :
		return do_shortcode($content);		
	else :
	
		$number = count($matches[0]);
		$has_featured = ''; $return = '';
		
		for($i = 0; $i < count($matches[0]); $i++):
			
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
				/* get data */
			$title = isset ( $matches[3][$i]['title'] ) ? trim( $matches[3][$i]['title'] ) : '';
			if ( !$title ) $title = isset ( $matches[3][$i]['name'] ) ? trim( $matches[3][$i]['name'] ) : ''; // alias of title			
			$price = isset ( $matches[3][$i]['price'] ) ? trim( $matches[3][$i]['price'] ) : '';
			$unit = isset ( $matches[3][$i]['unit'] ) ? trim( $matches[3][$i]['unit'] ) : __('$','wi');
			$unit_position = isset ( $matches[3][$i]['unit_position'] ) ? trim( $matches[3][$i]['unit_position'] ) : '';
			$per = isset ( $matches[3][$i]['per'] ) ? trim( $matches[3][$i]['per'] ) : '';
			$color = isset ( $matches[3][$i]['color'] ) ? trim( $matches[3][$i]['color'] ) : '';
			$featured = isset ( $matches[3][$i]['featured'] ) ? trim( $matches[3][$i]['featured'] ) : '';			
			$button = isset( $matches[3][$i]['button'] ) ? trim($matches[3][$i]['button']) : '';
			$link = isset( $matches[3][$i]['link'] ) ? trim($matches[3][$i]['link']) : '';
			if ( !$link ) $link = isset( $matches[3][$i]['url'] ) ? trim($matches[3][$i]['url']) : '';
			$target = isset( $matches[3][$i]['target'] ) ? trim($matches[3][$i]['target']) : '';
			$icon = isset( $matches[3][$i]['icon'] ) ? trim($matches[3][$i]['icon']) : '';
			$icon_position = isset( $matches[3][$i]['icon_position'] ) ? trim($matches[3][$i]['icon_position']) : '';
			$scroll = isset( $matches[3][$i]['scroll'] ) ? trim($matches[3][$i]['scroll']) : '';
			
			$features = trim($matches[5][$i]);
			
				/* sanitize */
			if ( $featured == 'true') {
				$has_featured = ' has_featured';
				$featured_class = ' featured';
				if ( !$color ) $color = 'primary';
			} else {
				$featured_class = '';
			}
	
			$link = isset( $matches[3][$i]['link'] ) ? trim($matches[3][$i]['link']) : '';
			$target = isset( $matches[3][$i]['target'] ) ? trim($matches[3][$i]['target']) : '';
			if ( $target != '_blank') $target = '_self';
			
			$color = apply_filters ('wi_pricing_color', $color );
			if ( $color == 'primary' ) $color = '#b40606';
			if ( $button ) {			
				$button_shortcode = '[button link="'.$link.'" target="'.$target.'" icon="'.$icon.'" icon_position="'.$icon_position.'" color="none" srcoll="'.$scroll.'"]' . $button . '[/button]';
			} else $button_shortcode = '';
			
			if ( $color ) {
				$css = ' style="background-color:'.esc_attr($color).';"';
			} else {
				$css = '';
				}
				
			if ( $unit_position !='right' ) $unit_position = 'left';
			if ( $unit_position == 'left' ) {
				$unit_left = '<u class="unit unit-left">'.$unit.'</u>';
				$unit_right = '';
			} else {
				$unit_right = '<u class="unit unit-right">'.$unit.'</u>';
				$unit_left = '';
			}
			
			$return .= '<div class="pricing-column'.$featured_class.'"'.$css.'>';
			
			$return .= '<div class="title-row"><span>' . $title . '</span></div>';
			
			$return .= '<div class="price-row">';
			if ( $price ) $return .= '<div class="price">'.$unit_left.'<span>' . $price . '</span>'.$unit_right.'</div>';
			if ( $per ) $return .= '<div class="per">' . $per . '</div>';
			$return .= '</div>'; // price row
			
			$return .= '<div class="features">' . $features . '</div>'; // features
			
			if ( $button_shortcode ) {
			
			$return .= '<div class="footer-row">';
			
			$return .= do_shortcode ( $button_shortcode );
			
			$return .= '</div>'; // footer row
			
			}
			
			$return .= '</div>'; // pricing column

		endfor;
		
		$return = '<div class="wi-pricing pricing-'.$number . $has_featured.'">' . $return;
		
		$return .= '<div class="clearfix"></div>';
		$return .= '</div>'; // wi-pricing
		
		return $return;
		
	endif;
}
}

/* ------------------------------------------------------- */
/* Gmap
/* ------------------------------------------------------- */
if (!function_exists('wi_gmap_shortcode')){
function wi_gmap_shortcode($atts,$content=NULL){

	extract(shortcode_atts(array(
		'src'		=>	'',
		'height'	=>	'',
	), $atts));

	if ( !$src) return;
	$height = absint($height); if ( $height < 20 || $height > 2000 ) $height = 400;

	return '<div class="gmap"><iframe width="100%" height="'.$height.'" src="'.esc_url($src).'&output=embed"></iframe></div>';
}
}

/* ------------------------------------------------------- */
/* List
/* ------------------------------------------------------- */
if (!function_exists('wi_list_shortcode')){
function wi_list_shortcode($atts, $content = null ){
	extract(shortcode_atts(array(
		'type'	=>	'',
	), $atts));
	
		/* type */
	$type = trim($type);
	return '<div class="wi-list type-'. esc_attr($type) .'">' . do_shortcode( trim($content) ) . '</div>';
}
}

/* ------------------------------------------------------- */
/* Icon
/* ------------------------------------------------------- */
if (!function_exists('wi_icon_shortcode')){
function wi_icon_shortcode($atts, $content = null ){
	extract(shortcode_atts(array(
		'icon'		=>	'trophy',
		'link'		=>	'',
		'url'		=>	'',
		'target'	=>	'',
		'title'		=>	'',
		'size'		=>	'36',
	), $atts));
	
		/* size */
	$size = absint( $size ); if ( $size < 20 || $size > 60 ) $size = 36;
	$css = ' style="width:'.$size.'px;height:'.$size.'px;"';
	$css2 = ' style="line-height:'.$size.'px"';
	
		/* link */
	$link = trim($link);
	if (!$link) $link = trim($url);
	if ( trim($target)=='_blank' ) $target = '_blank'; else $target = '_self';
	if ( $link ) {
		$open = '<a href="'.esc_url($link).'" target="'.$target.'">';
		$close = '</a>';
		$has_url = ' hasurl';
	} else {
		$open = '';
		$close = '';
		$has_url = '';
	}
	
	if ( $title = trim($title) ) {
		$title_attr = ' title="' . esc_attr($title) .'"';
	} else {
		$title_attr = '';
	}
	
	$return = '<div class="wi-icon'. $has_url .'"'.$title_attr.$css.'>';
	$return .= $open;
	$return .= '<i class="icon-'.$icon.'"'.$css2.'></i>';
	$return .= $close;	
	$return .= '</div>'; // wi icon
	
	return $return;
}
}

/* ------------------------------------------------------- */
/* Dropcap
/* ------------------------------------------------------- */
if (!function_exists('wi_dropcap_shortcode')){
function wi_dropcap_shortcode($atts,$content=NULL){
	$letter = strtolower(trim($content));
	if ( !empty($letter) ) {
		$letter = substr($letter,0,1);
		}
	if ( !in_array ( $letter, range('a','z') ) ) return;
	
	$return = '<span class="wi-dropcap"><img src="' . plugin_dir_url( __FILE__ ). '/images/aoc/aoc-' . $letter . '.gif" alt="' . $letter . '" /><u>'.$letter.'</u></span>';
	return $return;
}
}

/* ------------------------------------------------------- */
/* Text Dropcap
/* ------------------------------------------------------- */
if (!function_exists('wi_text_dropcap_shortcode')){
function wi_text_dropcap_shortcode($atts, $content = null ){	
	$return = '<span class="text-dropcap">' . trim($content). '</span>';
	return $return;
}
}

/* ------------------------------------------------------- */
/* Highlight
/* ------------------------------------------------------- */
if (!function_exists('wi_highlight_shortcode')){
function wi_highlight_shortcode($atts,$content = NULL){
	extract(shortcode_atts(array(
		'style'		=>	1,
	), $atts));
	$return = '<span class="highlight style-'.esc_attr($style).'">'.do_shortcode($content).'</span>';
	return $return;	
}
}

/* ------------------------------------------------------- */
/* Br
/* ------------------------------------------------------- */
if (!function_exists('wi_br_shortcode')){
function wi_br_shortcode($atts, $content = null ){
	return '<br />';
}
}

/* ------------------------------------------------------- */
/* Clear
/* ------------------------------------------------------- */
if (!function_exists('wi_clear_shortcode')){
function wi_clear_shortcode($atts, $content = null ){
	return '<div class="clearfix"></div>';
}
}

/* ------------------------------------------------------- */
/* Spacer
/* ------------------------------------------------------- */
if (!function_exists('wi_spacer_shortcode')){
function wi_spacer_shortcode($atts, $content = null ){
	extract(shortcode_atts(array(
		'height'		=>	'30',
	), $atts));
	
	$height = absint($height);	
	return '<div class="clearfix"></div><div class="spacer" style="height:'.$height.'px"></div><div class="clearfix"></div>';
}
}

/* ------------------------------------------------------- */
/* Hr
/* ------------------------------------------------------- */
if (!function_exists('wi_hr_shortcode')){
function wi_hr_shortcode($atts, $content = null ){
	return '<div class="clearfix"></div><div class="hr"><div class="inner"></div></div><div class="clearfix"></div>';
}
}

/* ------------------------------------------------------- */
/* Separator
/* ------------------------------------------------------- */
if (!function_exists('wi_separator_shortcode')){
function wi_separator_shortcode($atts, $content = null ){
	return '<div class="clearfix"></div><div class="wi-separator"></div><div class="clearfix"></div>';
}
}

/* ------------------------------------------------------- */
/* Video
/* ------------------------------------------------------- */
if (!function_exists('wi_wi_video_shortcode')){
function wi_wi_video_shortcode($atts,$content = NULL) {
	extract(shortcode_atts(array(
		'width'		=>	'',
		'height'	=>	'',
	), $atts));
	if (is_numeric($width)) $width .= 'px';
	if (is_numeric($height)) $height .= 'px';
	
	global $wp_embed;
	$return = $wp_embed->run_shortcode('[embed]' . $content . '[/embed]');
	if ($return) $return = '<div class="video-container media-container" style="width:'.$width.';height:'.$height.';">'. $return .'</div>';
	return $return;
}
}

/* ------------------------------------------------------- */
/* Soundcloud
/* ------------------------------------------------------- */
if (!function_exists('wi_wi_soundcloud_shortcode')){
function wi_wi_soundcloud_shortcode($atts,$content = NULL) {
	global $wp_embed;
	$return = $wp_embed->run_shortcode('[embed]' . $content . '[/embed]');
	if ($return) $return = '<div class="media-container soundcloud-container">'. $return .'</div>';
	return $return;	
}
}

/* ------------------------------------------------------- */
/* Testimonials
/* ------------------------------------------------------- */
if (!function_exists('wi_testimonials_shortcode')){
function wi_testimonials_shortcode($atts,$content = NULL){

	extract(shortcode_atts(array(
		'auto'		=>	'false',
		'effect'	=>	'fade',
		'pager'		=>	'true',
	), $atts));

	if (!preg_match_all("/(.?)\[(testimonial)\b(.*?)(?:(\/))?\](?:(.+?)\[\/testimonial\])?(.?)/s", $content, $matches)) :
		return do_shortcode($content);		
	else :
	
		wp_enqueue_script('wi-flexslider');
		wp_enqueue_style('wi-flexslider');
	
		if ($auto!='true') $auto = 'false';
		if ($effect!='slide') $effect='fade';
		if ($pager!='false') $pager = 'true';
		$return = '<div class="testimonial-slider" data-auto="'.$auto.'" data-effect="'.$effect.'" data-pager="'.$pager.'">';
		$return .= '<div class="flexslider"><ul class="slides">';
		
		for($i = 0; $i < count($matches[0]); $i++):
			
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
			$name = isset( $matches[3][$i]['name'] ) ? trim($matches[3][$i]['name']) : '';
			$from = isset( $matches[3][$i]['from'] ) ? trim($matches[3][$i]['from']) : '';
			$content = trim($matches[5][$i]);
			
			$return .= '<li>';
			$return .= '<div class="wi-testimonial">';
			$return .= '<div class="content">';
			$return .= '<div class="text">';
			$return .= '<p>'. do_shortcode($content) . '</p>';
			$return .= '</div>'; // text
			$return .= '</div>'; // content
			if ( $name ) {
				$return .= '<div class="author"><span class="name">'.$name.'</span>';
				if ( $from ) $return .= '&middot; '.$from ;
				$return .= '</div>'; // author
				} // if name
			$return .= '</div>'; // wi testimonial
			$return .= '</li>';

		endfor;
		
		$return .= '</ul></div>'; // flexslider
		$return .= '</div>'; // testimonial-slider
		
		return $return;
		
	endif;
}
}

/* ------------------------------------------------------- */
/* Imagebox
/* ------------------------------------------------------- */
if (!function_exists('wi_imagebox_shortcode')){
function wi_imagebox_shortcode($atts,$content = NULL){
	extract(shortcode_atts(array(
		'image'		=>  '',
		'name'		=>	'',
		'lightbox'	=>	'false',
		'link'		=>	'',
	), $atts));
	
	if ( $link ) {
		$colorbox = ($lightbox == 'true') ? 'wi-colorbox' : '';
		$open = '<a href="'.esc_url($link).'" class="'.$colorbox.'">';
		$close = '</a>';
	} else {
		$open = ''; $close = '';
		}	
	
	$return = '<div class="wi-imagebox">';
	if ( $image ) {
		$return .= '<div class="image">'.$open.'<img src="' . esc_url($image) . '" alt="'. esc_attr($name) .'" />'.$close.'</div>';
	}
	$return .= '<div class="text">';
	$return .= '<h4 class="name">' . $name . '</h4>';
	$return .= '<div class="desc">' . do_shortcode($content) . '</div>';
	$return .= '</div>'; // text
	$return .= '</div>'; // wi-imagebox
	
	return $return;	
}
}



/* ------------------------------------------------------- */
/* Fullwidth
/* ------------------------------------------------------- */
if (!function_exists('wi_fullwidth_shortcode')){
function wi_fullwidth_shortcode($atts,$content = NULL){
	extract(shortcode_atts(array(
		'padding'		=>  '30',	// padding top & bottom
		'padding_top'	=>	'',
		'padding_bottom'=>	'',
		'background'	=>	'true',
		'border'		=>	'true',
		'container'		=>	'true',	// include a container element or not
		'background_image'=>'',
		'parallax'		=>	'false',
		'overlay'		=>	'0',
	), $atts));
	
	$cl = array('wi-fullwidth');
	
	$padding = absint($padding);
	if ($padding_top == '') $padding_top = $padding;
	if ($padding_bottom == '') $padding_bottom = $padding;
	$style = 'padding-top:'.$padding_top.'px;padding-bottom:'.$padding_bottom.'px;';
	$overlay = absint($overlay);
	
	if ($background_image) $style .= 'background-image:url('.esc_url($background_image).');';
	if ($parallax == 'true') {
		wp_enqueue_script('wi-parallax');
		$cl[] = 'enable-parallax';
		}
	
	$style = ' style="'.$style.'"';
	if ($border!='false') $cl[] = 'has_border';
	if ($background!='false') $cl[] = 'has_bg';
	$cl = join(' ',$cl);
	
	if ($container != 'false') {
		$open = '<div class="container">';
		$close = '</div>';
	} else {
		$open = '';
		$close = '';
	}
	
	$return = '</div>'; // end container 
	$return .= '<div class="'.$cl.'"'.$style.'><div class="wi-fullwidth-content">' . $open . do_shortcode($content) . '<div class="clearfix"></div>' . $close . '</div><div class="wi-fullwidth-overlay" style="opacity:'.($overlay/100).';"></div></div>'; // fullwidth section
	$return .= '<div class="container">'; // open a new container
	
	return $return;	
}
}

/* ------------------------------------------------------- */
/* Icon List
/* ------------------------------------------------------- */
if (!function_exists('wi_iconlist_shortcode')){
function wi_iconlist_shortcode($atts, $content = null ){
	extract(shortcode_atts(array(
		'icon'		=>	'',
		'color'		=>	'',
	), $atts));
	
		/* icon */
	$icon = trim($icon);
	if ( $color ) $css = ' style="color:'.apply_filters('wi_color',$color).';"'; else $css = '';
	
	if (!preg_match_all("/(.?)\[(li)\b(.*?)(?:(\/))?\](?:(.+?)\[\/li\])?(.?)/s", $content, $matches)) :
		$return = '<div class="wi-iconlist">';
		$return .= str_replace('<li>','<li><i class="icon-'.$icon.'"'.$css.'></i>',do_shortcode($content));
		$return .= '</div>';
		return $return;
	else :
	
		$return = '<div class="wi-iconlist"><ul>';
	
		for($i = 0; $i < count($matches[0]); $i++):
			
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
				/* get data */
			$ic = isset ( $matches[3][$i]['icon'] ) ? trim( $matches[3][$i]['icon'] ) : '';
			if (!$ic) $ic = $icon;
			$return .= '<li><i class="icon-'.$ic.'"'.$css.'></i>'.trim($matches[5][$i]).'</li>';
			
		endfor;
		
		$return .= '</ul></div>';
		return $return;
		
	endif;		
}
}


$shortcodes = 'column, align, heading, center_heading, bigtext, progress, progress_group, piechart, member, tab, accordion, toggle, button, counter, iconbox, small_iconbox, flexslider, brands, pricing, gmap, list, icon, dropcap, text_dropcap, highlight, br, clear, spacer, hr, separator, wi_video, wi_soundcloud, testimonials, imagebox,fullwidth, iconlist';

$shortcodes = explode(",",$shortcodes);
$shortcodes = array_map("trim",$shortcodes);

foreach ($shortcodes as $shortcode){
	add_shortcode($shortcode,'wi_'.$shortcode.'_shortcode');
}