<?php 

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- Woo Conditionals
- Add specific IE styling/hacks to HEAD
- Add custom styling
- Add layout to body_class output
- WooSlider Setup
- WooSlider Magazine template
- Navigation
- Post More
- Video Embed
- Single Post Author
- Yoast Breadcrumbs
- BuddyPress

-----------------------------------------------------------------------------------*/

add_action('wp_head','woo_IE_head');							// Add specific IE styling/hacks to HEAD
add_action('wp_head','woo_custom_styling');						// Add custom styling
add_filter('body_class','woo_layout_body_class');				// Add layout to body_class output
add_action('woo_head','woo_slider');							// WooSlider Setup
add_action('woo_header_after','woo_nav');						// Navigation
add_action('woo_head', 'woo_conditionals');						// Woo Conditionals
add_action('wp_head', 'woo_author');							// Author Box
add_action("woo_post_after", "woo_postnav");					// Single post navigation
add_action('wp_head', 'woo_google_webfonts');					// Add Google Fonts output to HEAD			
add_action('woo_loop_before', 'woo_breadcrumbs');				// Breadcrumbs


/*-----------------------------------------------------------------------------------*/
/* Woo Conditinals */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_conditionals')) {
	function woo_conditionals() { 
	
		// Video Embed
		if( is_single() ) { 
			add_action('woo_post_inside_before','canvas_get_embed');
		} 
	
		// Post More
		if ( !is_singular() && !is_404() || is_page_template('template-blog.php') || is_page_template('template-magazine.php')) {
			add_action('woo_post_inside_after','woo_post_more');					  
		}
		
		// Tumblog Content
		if (get_option('woo_woo_tumblog_switch') == 'true') {
			add_action('woo_tumblog_content_before','woo_tumblog_content');
			add_action('woo_tumblog_content_after','woo_tumblog_content');
		}
					
	}
}

/*-----------------------------------------------------------------------------------*/
/* Add specific IE styling/hacks to HEAD */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_IE_head')) {
	function woo_IE_head() {
	?>
	
<!--[if IE 6]>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/pngfix.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/menu.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/ie6.css" />
<![endif]-->	

<!--[if IE 7]>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/ie7.css" />
<![endif]-->

<!--[if IE 8]>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/ie8.css" />
<![endif]-->
	
	<?php
	}
}

/*-----------------------------------------------------------------------------------*/
/* // Add custom styling */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_custom_styling')) {
function woo_custom_styling() {

	global $woo_options;
	$output = '';
			
	// Logo
	if ( !$woo_options['woo_logo'] )
		$output .= '#logo .site-title, #logo .site-description { display:block; }' . "\n";

	// Styling options output in header
	if ( $woo_options['woo_style_disable'] <> "true" && $woo_options['woo_alt_stylesheet'] == "default.css" ) :

		// Layout styling
		$bg = $woo_options['woo_style_bg'];
		$bg_image = $woo_options['woo_style_bg_image'];
		$bg_image_repeat = $woo_options['woo_style_bg_image_repeat'];		
		$border_top = $woo_options['woo_border_top'];
		$border_general = $woo_options['woo_style_border'];
	
		$body = '';
		if ($bg)
			$body .= 'background-color:'.$bg.';';
		if ($bg_image)
			$body .= 'background-image:url('.$bg_image.');';
		if ($bg_image_repeat)
			$body .= 'background-repeat:'.$bg_image_repeat.';background-position:top center;';
		if ($border_top && $border_top['width'] >= 0)
			$body .= 'border-top:'.$border_top["width"].'px '.$border_top["style"].' '.$border_top["color"].';';
	
		if ( $body != '' )
			$output .= 'body {'. $body . '}'. "\n";
	
		if ( $border_general )
			$output .= 'hr, .entry img, img.thumbnail, .entry .wp-caption, #footer-widgets, #comments, #comments .comment.thread-even, #comments ul.children li, .entry h1{border-color:'. $border_general . '}'. "\n";
			
	
		// General styling
		$link = $woo_options['woo_link_color'];
		$hover = $woo_options['woo_link_hover_color'];
		$button = $woo_options['woo_button_color'];
	
		if ($link)
			$output .= 'a:link, a:visited {color:'.$link.'}' . "\n";
		if ($hover)
			$output .= 'a:hover, .post-more a:hover, .post-meta a:hover, .post p.tags a:hover {color:'.$hover.'}' . "\n";
		if ($button)
			$output .= '.button, .reply a {background-color:'.$button.'}' . "\n";
			
		// Header styling		
		$header_bg = $woo_options['woo_header_bg'];	
		$header_bg_image = $woo_options['woo_header_bg_image'];			
		$header_bg_image_repeat = $woo_options['woo_header_bg_image_repeat'];		
		$header_border = $woo_options['woo_header_border'];
		$header_margin_top = $woo_options['woo_header_margin_top'];			
		$header_margin_bottom = $woo_options['woo_header_margin_bottom'];			
		$header_padding_top = $woo_options['woo_header_padding_top'];			
		$header_padding_bottom = $woo_options['woo_header_padding_bottom'];			
		$header_padding_left = $woo_options['woo_header_padding_left'];			
		$header_padding_right = $woo_options['woo_header_padding_right'];					
		$font_logo = $woo_options['woo_font_logo'];	
		$font_desc = $woo_options['woo_font_desc'];	

		$header_css = '';
		if ( $header_bg )
			$header_css .= 'background-color:'.$header_bg.';';	
		if ( $header_bg_image )
			$header_css .= 'background-image:url('.$header_bg_image.');';	
		if ( $header_bg_image_repeat )
			$header_css .= 'background-repeat:'.$header_bg_image_repeat.';background-position:top center;';
		if ( $header_margin_top <> '' || $header_margin_bottom <> '' )
			$header_css .= 'margin-top:'.$header_margin_top.'px;margin-bottom:'.$header_margin_bottom.'px;';	
		if ( $header_padding_top <> '' || $header_padding_bottom <> '' )
			$header_css .= 'padding-top:'.$header_padding_top.'px;padding-bottom:'.$header_padding_bottom.'px;';	
		if ( $header_border && $header_border['width'] >= 0)
			$header_css .= 'border:'.$header_border["width"].'px '.$header_border["style"].' '.$header_border["color"].';';
		if ( $header_border && $header_border['width'] > 0) {
			$width = $woo_options['woo_layout_width'] - $header_border['width']*2;
			if ( $width > 0 ) 
				$header_css .= 'width:'.$width.'px;';
		}
		if ( $header_css != '' )
			$output .= '#header {'. $header_css . '}'. "\n";
			
		if ( $header_padding_left <> '' )
			$output .= '#logo {padding-left:'.$header_padding_left.'px;}';
		if ( $header_padding_right <> '' )
			$output .= '#topad {padding-right:'.$header_padding_right.'px;}'. "\n";
		if ( $font_logo )
			$output .= '#logo .site-title a {font:'.$font_logo["style"].' '.$font_logo["size"].$font_logo["unit"].'/1em '.stripslashes($font_logo["face"]).';color:'.$font_logo["color"].'}' . "\n";	
		if ( $font_desc )
			$output .= '#logo .site-description {font:'.$font_desc["style"].' '.$font_desc["size"].$font_desc["unit"].'/1em '.stripslashes($font_desc["face"]).';color:'.$font_desc["color"].'}' . "\n";	
		
		
		// Boxed styling
		$boxed = $woo_options['woo_layout_boxed'];
		$box_bg = $woo_options['woo_style_box_bg'];
		$box_margin_top = $woo_options['woo_box_margin_top'];
		$box_margin_bottom = $woo_options['woo_box_margin_bottom']; 
		$box_border_tb = $woo_options['woo_box_border_tb'];
		$box_border_lr = $woo_options['woo_box_border_lr'];
		$box_border_radius = $woo_options['woo_box_border_radius'];
		$box_shadow = $woo_options['woo_box_shadow'];
	
		$wrapper = '';
		if ($boxed == "true") {
			//$wrapper .= 'margin:0 auto;padding:0 0 20px 0;width:'.$woo_options['woo_layout_width'].';';
			if ( $woo_options['woo_layout_width'] == '940px' )
				$wrapper .= 'padding-left:20px; padding-right:20px;';
			else
				$wrapper .= 'padding-left:30px; padding-right:30px;';			
		}
		if ($boxed == "true" && $box_bg)
			$wrapper .= 'background-color:'.$box_bg.';';
		if ($boxed == "true" && ($box_margin_top || $box_margin_bottom) )
			$wrapper .= 'margin-top:'.$box_margin_top.'px;margin-bottom:'.$box_margin_bottom.'px;';
		if ($boxed == "true" && $box_border_tb["width"] > 0 )
			$wrapper .= 'border-top:'.$box_border_tb["width"].'px '.$box_border_tb["style"].' '.$box_border_tb["color"].';border-bottom:'.$box_border_tb["width"].'px '.$box_border_tb["style"].' '.$box_border_tb["color"].';';
		if ($boxed == "true" && $box_border_lr["width"] > 0 )
			$wrapper .= 'border-left:'.$box_border_lr["width"].'px '.$box_border_lr["style"].' '.$box_border_lr["color"].';border-right:'.$box_border_lr["width"].'px '.$box_border_lr["style"].' '.$box_border_lr["color"].';';
		if ( $boxed == "true" && $box_border_radius )
			$wrapper .= 'border-radius:'.$box_border_radius.';-moz-border-radius:'.$box_border_radius.';-webkit-border-radius:'.$box_border_radius.';';
		if ( $boxed == "true" && $box_shadow == "true" )
			$wrapper .= 'box-shadow: 0px 1px 5px rgba(0,0,0,.3);-moz-box-shadow: 0px 1px 5px rgba(0,0,0,.3);-webkit-box-shadow: 0px 1px 5px rgba(0,0,0,.3);';
	
		if ( $wrapper != '' )
			$output .= '#wrapper {'. $wrapper . '}'. "\n";
	
		// General Typography		
		$font_logo = $woo_options['woo_font_logo'];	
		$font_desc = $woo_options['woo_font_desc'];	
		$font_text = $woo_options['woo_font_text'];	
		$font_h1 = $woo_options['woo_font_h1'];	
		$font_h2 = $woo_options['woo_font_h2'];	
		$font_h3 = $woo_options['woo_font_h3'];	
		$font_h4 = $woo_options['woo_font_h4'];	
		$font_h5 = $woo_options['woo_font_h5'];	
		$font_h6 = $woo_options['woo_font_h6'];	
	
		if ( $font_logo )
			$output .= '#logo .site-title a {font:'.$font_logo["style"].' '.$font_logo["size"].$font_logo["unit"].'/1em '.stripslashes($font_logo["face"]).';color:'.$font_logo["color"].'}' . "\n";	
		if ( $font_desc )
			$output .= '#logo .site-description {font:'.$font_desc["style"].' '.$font_desc["size"].$font_desc["unit"].'/1em '.stripslashes($font_desc["face"]).';color:'.$font_desc["color"].'}' . "\n";	
		if ( $font_text )
			$output .= 'body, p {font:'.$font_text["style"].' '.$font_text["size"].$font_text["unit"].'/1.5em '.stripslashes($font_text["face"]).';color:'.$font_text["color"].'}' . "\n";	
		if ( $font_h1 )
			$output .= 'h1 {font:'.$font_h1["style"].' '.$font_h1["size"].$font_h1["unit"].'/1.5em '.stripslashes($font_h1["face"]).';color:'.$font_h1["color"].'}';	
		if ( $font_h2 )
			$output .= 'h2 {font:'.$font_h2["style"].' '.$font_h2["size"].$font_h2["unit"].'/1.5em '.stripslashes($font_h2["face"]).';color:'.$font_h2["color"].'}';	
		if ( $font_h3 )
			$output .= 'h3 {font:'.$font_h3["style"].' '.$font_h3["size"].$font_h3["unit"].'/1.5em '.stripslashes($font_h3["face"]).';color:'.$font_h3["color"].'}';	
		if ( $font_h4 )
			$output .= 'h4 {font:'.$font_h4["style"].' '.$font_h4["size"].$font_h4["unit"].'/1.5em '.stripslashes($font_h4["face"]).';color:'.$font_h4["color"].'}';	
		if ( $font_h5 )
			$output .= 'h5 {font:'.$font_h5["style"].' '.$font_h5["size"].$font_h5["unit"].'/1.5em '.stripslashes($font_h5["face"]).';color:'.$font_h5["color"].'}';	
		if ( $font_h6 )
			$output .= 'h6 {font:'.$font_h6["style"].' '.$font_h6["size"].$font_h6["unit"].'/1.5em '.stripslashes($font_h6["face"]).';color:'.$font_h6["color"].'}' . "\n";	
	
		// Post Styling
		$font_post_title = $woo_options['woo_font_post_title'];	
		$font_post_meta = $woo_options['woo_font_post_meta'];	
		$font_post_text = $woo_options['woo_font_post_text'];	
		$font_post_more = $woo_options['woo_font_post_more'];	
		$post_more_border_top = $woo_options['woo_post_more_border_top'];	
		$post_more_border_bottom = $woo_options['woo_post_more_border_bottom'];	
		$post_comments_bg = $woo_options['woo_post_comments_bg'];	
		$post_author_border_top = $woo_options['woo_post_author_border_top'];	
		$post_author_border_bottom = $woo_options['woo_post_author_border_bottom'];	
		$post_author_bg = $woo_options['woo_post_author_bg'];	
		
		if ( $font_post_title )
			$output .= '.post .title, .page .title, .post .title a:link, .post .title a:visited, .page .title a:link, .page .title a:visited {font:'.$font_post_title["style"].' '.$font_post_title["size"].$font_post_title["unit"].'/1.2em '.stripslashes($font_post_title["face"]).';color:'.$font_post_title["color"].'}' . "\n";	
		if ( $font_post_meta )
			$output .= '.post-meta {font:'.$font_post_meta["style"].' '.$font_post_meta["size"].$font_post_meta["unit"].'/1.2em '.stripslashes($font_post_meta["face"]).';color:'.$font_post_meta["color"].'}' . "\n";	
		if ( $font_post_text )
			$output .= '.entry, .entry p{font:'.$font_post_text["style"].' '.$font_post_text["size"].$font_post_text["unit"].'/1.5em '.stripslashes($font_post_text["face"]).';color:'.$font_post_text["color"].'}' . "\n";	
		$post_more_border = '';
		if ( $font_post_more )
			$post_more_border .= 'font:'.$font_post_more["style"].' '.$font_post_more["size"].$font_post_more["unit"].'/1.5em '.stripslashes($font_post_more["face"]).';color:'.$font_post_more["color"].';';	
		if ( $post_more_border_top )
			$post_more_border .= 'border-top:'.$post_more_border_top["width"].'px '.$post_more_border_top["style"].' '.$post_more_border_top["color"].';';	
		if ( $post_more_border_bottom )
			$post_more_border .= 'border-bottom:'.$post_more_border_bottom["width"].'px '.$post_more_border_bottom["style"].' '.$post_more_border_bottom["color"].';';	
		$output .= '.post-more {'.$post_more_border .'}' . "\n";	
	
		if ( $post_comments_bg )
			$output .= '#comments .comment.thread-even {background-color:'.$post_comments_bg.';}' . "\n";

		$post_author = '';
		if ( $post_author_border_top )
			$post_author .= 'border-top:'.$post_author_border_top["width"].'px '.$post_author_border_top["style"].' '.$post_author_border_top["color"].';';	
		if ( $post_author_border_bottom )
			$post_author .= 'border-bottom:'.$post_author_border_bottom["width"].'px '.$post_author_border_bottom["style"].' '.$post_author_border_bottom["color"].';';		
		if ( $post_author_bg )
			$post_author .= 'background-color:'.$post_author_bg;
	
		$output .= '#post-author {'.$post_author .'}' . "\n";	
	
		if ( $post_comments_bg )
			$output .= '#comments .comment.thread-even {background-color:'.$post_comments_bg.';}' . "\n";
		
		// Page Nav Styling	
		$pagenav_font = $woo_options['woo_pagenav_font'];	
		$pagenav_bg = $woo_options['woo_pagenav_bg'];	
		$pagenav_border_top = $woo_options['woo_pagenav_border_top'];	
		$pagenav_border_bottom = $woo_options['woo_pagenav_border_bottom'];	
	
		$pagenav_css = '';
		if ( $pagenav_bg )
			$pagenav_css .= 'background-color:'.$pagenav_bg.';';	
		if ( $pagenav_border_top )
			$pagenav_css .= 'border-top:'.$pagenav_border_top["width"].'px '.$pagenav_border_top["style"].' '.$pagenav_border_top["color"].';';	
		if ( $pagenav_border_bottom )
			$pagenav_css .= 'border-bottom:'.$pagenav_border_bottom["width"].'px '.$pagenav_border_bottom["style"].' '.$pagenav_border_bottom["color"].';';	
		if ( $pagenav_css != '' )
			$output .= '.nav-entries, .wp-pagenavi {'. $pagenav_css . '}'. "\n";
		if ( $pagenav_font ) {
			$output .= '.nav-entries a, .wp-pagenavi a:link, .wp-pagenavi a:visited, .wp-pagenavi .current, .wp-pagenavi .on, .wp-pagenavi a:hover, .wp-pagenavi span.extend, .wp-pagenavi span.pages {font:'.$pagenav_font["style"].' '.$pagenav_font["size"].$pagenav_font["unit"].'/1.5em '.stripslashes($pagenav_font["face"]).';color:'.$pagenav_font["color"].'!important}' . "\n";	
			$output .= '.wp-pagenavi a:link, .wp-pagenavi a:visited, .wp-pagenavi span.extend, .wp-pagenavi span.pages, .wp-pagenavi span.current {color:'.$pagenav_font["color"].'!important}' . "\n";	
		}
		// Widget Styling
		$widget_font_title = $woo_options['woo_widget_font_title'];	
		$widget_font_text = $woo_options['woo_widget_font_text'];	
		$widget_padding_tb = $woo_options['woo_widget_padding_tb'];
		$widget_padding_lr = $woo_options['woo_widget_padding_lr'];
		$widget_bg = $woo_options['woo_widget_bg'];
		$widget_border = $woo_options['woo_widget_border'];
		$widget_title_border = $woo_options['woo_widget_title_border'];
		$widget_border_radius = $woo_options['woo_widget_border_radius'];
	
		$h3_css = '';
		if ( $widget_font_title )
			$h3_css .= 'font:'.$widget_font_title["style"].' '.$widget_font_title["size"].$widget_font_title["unit"].'/1.5em '.stripslashes($widget_font_title["face"]).';color:'.$widget_font_title["color"].';';	
		if ( $widget_title_border )
			$h3_css .= 'border-bottom:'.$widget_title_border["width"].'px '.$widget_title_border["style"].' '.$widget_title_border["color"].';';	
		if ( $widget_title_border["width"] == 0 )
			$h3_css .= 'margin-bottom:0;';
		
		if ( $h3_css != '' )
			$output .= '.widget h3 {'. $h3_css . '}'. "\n";
		
		if ( $widget_title_border )
			$output .= '.widget_recent_comments li, #twitter li { border-color: '.$widget_title_border["color"].';}'. "\n";
		
		if ( $widget_font_text )
			$output .= '.widget p, .widget .textwidget {font:'.$widget_font_text["style"].' '.$widget_font_text["size"].$widget_font_text["unit"].'/1.5em '.stripslashes($widget_font_text["face"]).';color:'.$widget_font_text["color"].';}' . "\n";	
	
		$widget_css = '';
		if ( $widget_font_text )
			$widget_css .= 'font:'.$widget_font_text["style"].' '.$widget_font_text["size"].$widget_font_text["unit"].'/1.5em '.stripslashes($widget_font_text["face"]).';color:'.$widget_font_text["color"].';';	
		if ( $widget_padding_tb || $widget_padding_lr )
			$widget_css .= 'padding:'.$widget_padding_tb.'px '.$widget_padding_lr.'px;';	
		if ( $widget_bg )
			$widget_css .= 'background-color:'.$widget_bg.';';	
		if ( $widget_border["width"] > 0 )
			$widget_css .= 'border:'.$widget_border["width"].'px '.$widget_border["style"].' '.$widget_border["color"].';';	
		if ( $widget_border_radius )
			$widget_css .= 'border-radius:'.$widget_border_radius.';-moz-border-radius:'.$widget_border_radius.';-webkit-border-radius:'.$widget_border_radius.';';	
	
		if ( $widget_css != '' )
			$output .= '.widget {'. $widget_css . '}'. "\n";

		if ( $widget_border["width"] > 0 )
			$output .= '#tabs {border:'.$widget_border["width"].'px '.$widget_border["style"].' '.$widget_border["color"].';}'. "\n";

		// Tabs Widget
		$widget_tabs_bg = $woo_options['woo_widget_tabs_bg'];	
		$widget_tabs_bg_inside = $woo_options['woo_widget_tabs_bg_inside'];	
		$widget_tabs_font = $woo_options['woo_widget_tabs_font'];	
		$widget_tabs_font_meta = $woo_options['woo_widget_tabs_font_meta'];	
		
		if ( $widget_tabs_bg )
			$output .= '#tabs {background-color:'.$widget_tabs_bg.';}'. "\n";
		if ( $widget_tabs_bg_inside )
			$output .= '#tabs .inside, #tabs ul.wooTabs li a.selected, #tabs ul.wooTabs li a:hover {background-color:'.$widget_tabs_bg_inside.';}'. "\n";	
		if ( $widget_tabs_font )
			$output .= '#tabs .inside li a {font:'.$widget_tabs_font["style"].' '.$widget_tabs_font["size"].$widget_tabs_font["unit"].'/1.5em '.stripslashes($widget_tabs_font["face"]).';color:'.$widget_tabs_font["color"].';}'. "\n";	
		if ( $widget_tabs_font_meta )
			$output .= '#tabs .inside li span.meta, #tabs ul.wooTabs li a {font:'.$widget_tabs_font_meta["style"].' '.$widget_tabs_font_meta["size"].$widget_tabs_font_meta["unit"].'/1.5em '.stripslashes($widget_tabs_font_meta["face"]).';color:'.$widget_tabs_font_meta["color"].';}'. "\n";	
	
		//Navigation
		$nav_bg = $woo_options['woo_nav_bg'];	
		$nav_font = $woo_options['woo_nav_font'];	
		$nav_hover = $woo_options['woo_nav_hover'];	
		$nav_border_top = $woo_options['woo_nav_border_top'];
		$nav_border_bot = $woo_options['woo_nav_border_bot'];
		$nav_border_lr = $woo_options['woo_nav_border_lr'];
		$nav_border_radius = $woo_options['woo_nav_border_radius'];
		
		if ( $nav_font )
			$output .= '.nav a, #navigation ul.rss a {font:'.$nav_font["style"].' '.$nav_font["size"].$nav_font["unit"].' '.stripslashes($nav_font["face"]).';color:'.$nav_font["color"].'}' . "\n";	
		if ( $nav_hover )
			$output .= '.nav a:hover, .nav li.current_page_item, .nav li.current_page_parent, .nav li.sfHover{background-color:'.$nav_hover.'}' . "\n";
	
		$navigation_css = '';
		if ( $nav_bg )
			$navigation_css .= 'background-color:'.$nav_bg.';';
		if ( $nav_border_top && $nav_border_top["width"] >= 0 )
			$navigation_css .= 'border-top:'.$nav_border_top["width"].'px '.$nav_border_top["style"].' '.$nav_border_top["color"].';border-bottom:'.$nav_border_bot["width"].'px '.$nav_border_bot["style"].' '.$nav_border_bot["color"].';border-left:'.$nav_border_lr["width"].'px '.$nav_border_lr["style"].' '.$nav_border_lr["color"].';border-right:'.$nav_border_lr["width"].'px '.$nav_border_lr["style"].' '.$nav_border_lr["color"].';';
		if ( $nav_border_radius )
			$navigation_css .= 'border-radius:'.$nav_border_radius.'; -moz-border-radius:'.$nav_border_radius.'; -webkit-border-radius:'.$nav_border_radius.';';	
	
		if ( $navigation_css != '' )
			$output .= '#navigation {'. $navigation_css . '}'. "\n";
	
		// Footer 
		$footer_font = $woo_options['woo_footer_font'];	
		$footer_bg = $woo_options['woo_footer_bg'];	
		$footer_border_top = $woo_options['woo_footer_border_top'];	
		$footer_border_bottom = $woo_options['woo_footer_border_bottom'];	
		$footer_border_lr = $woo_options['woo_footer_border_lr'];	
		$footer_border_radius = $woo_options['woo_footer_border_radius'];	
		
		if ( $footer_font )
			$output .= '#footer, #footer p {font:'.$footer_font["style"].' '.$footer_font["size"].$footer_font["unit"].' '.stripslashes($footer_font["face"]).';color:'.$footer_font["color"].'}' . "\n";	
		$footer_css = '';
		if ( $footer_bg )
			$footer_css .= 'background-color:'.$footer_bg.';';	
		if ( $footer_border_top )
			$footer_css .= 'border-top:'.$footer_border_top["width"].'px '.$footer_border_top["style"].' '.$footer_border_top["color"].';';	
		if ( $footer_border_bottom )
			$footer_css .= 'border-bottom:'.$footer_border_bottom["width"].'px '.$footer_border_bottom["style"].' '.$footer_border_bottom["color"].';';	
		if ( $footer_border_lr )
			$footer_css .= 'border-left:'.$footer_border_lr["width"].'px '.$footer_border_lr["style"].' '.$footer_border_lr["color"].';border-right:'.$footer_border_lr["width"].'px '.$footer_border_lr["style"].' '.$footer_border_lr["color"].';';	
		if ( $footer_border_radius )
			$footer_css .= 'border-radius:'.$footer_border_radius.'; -moz-border-radius:'.$footer_border_radius.'; -webkit-border-radius:'.$footer_border_radius.';';	

		if ( $footer_css != '' )
			$output .= '#footer {'. $footer_css . '}' . "\n";
			
		// Magazine Template
		$slider_magazine_font_title = $woo_options['woo_slider_magazine_font_title'];	
		$slider_magazine_font_excerpt = $woo_options['woo_slider_magazine_font_excerpt'];	
		
		if ( $slider_magazine_font_title )
			$output .= '.magazine #loopedSlider .content h2.title a {font:'.$slider_magazine_font_title["style"].' '.$slider_magazine_font_title["size"].$slider_magazine_font_title["unit"].'/1em '.stripslashes($slider_magazine_font_title["face"]).';color:'.$slider_magazine_font_title["color"].';}'. "\n";	
		if ( $slider_magazine_font_excerpt )
			$output .= '.magazine #loopedSlider .content .excerpt p {font:'.$slider_magazine_font_excerpt["style"].' '.$slider_magazine_font_excerpt["size"].$slider_magazine_font_excerpt["unit"].'/1.5em '.stripslashes($slider_magazine_font_excerpt["face"]).';color:'.$slider_magazine_font_excerpt["color"].';}'. "\n";	

		// Business Template
		$slider_biz_font_title = $woo_options['woo_slider_biz_font_title'];	
		$slider_biz_font_excerpt = $woo_options['woo_slider_biz_font_excerpt'];	

		if ( $slider_biz_font_title )
			$output .= '.business #loopedSlider .content h2.title a {font:'.$slider_biz_font_title["style"].' '.$slider_biz_font_title["size"].$slider_magazine_font_excerpt["unit"].'/1em '.stripslashes($slider_biz_font_title["face"]).';color:'.$slider_biz_font_title["color"].';}'. "\n";	
		if ( $slider_biz_font_excerpt )
			$output .= '.business #loopedSlider .content p {font:'.$slider_biz_font_excerpt["style"].' '.$slider_biz_font_excerpt["size"].$slider_biz_font_excerpt["unit"].'/1.5em '.stripslashes($slider_magazine_font_excerpt["face"]).';color:'.$slider_biz_font_excerpt["color"].';}'. "\n";	
		
		// Archive Header
		$output .= '.archive_header {font:'.$woo_options['woo_archive_header_font']["style"].' '.$woo_options['woo_archive_header_font']["size"].$woo_options['woo_archive_header_font']["unit"].'/1em '.stripslashes($woo_options['woo_archive_header_font']["face"]).';color:'.$woo_options['woo_archive_header_font']["color"].';border-bottom:'.$woo_options['woo_archive_header_border_bottom']["width"].'px '.$woo_options['woo_archive_header_border_bottom']["style"].' '.$woo_options['woo_archive_header_border_bottom']["color"].';}'. "\n";	
		if ( $woo_options['woo_archive_header_disable_rss'] == "true" )
			$output .= '.archive_header .catrss { display:none; }' . "\n";
			
	endif;
	
	// Output styles
	if (isset($output)) {
		$output = "\n<!-- Woo Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n<!-- /Woo Custom Styling -->\n\n";
		echo $output;
	}
		
} 
}

/*-----------------------------------------------------------------------------------*/
/* Add layout to body_class output */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_layout_body_class')) {
	function woo_layout_body_class($classes) {
	
		$layout = '';
		// Set main layout
		if ( is_singular() ) {
			global $post;
			$layout = get_post_meta($post->ID, 'layout', true);
			if ( $layout ) {
				global $woo_options;
				$woo_options['woo_layout'] = $layout;
			}
		}
		if ( !$layout ) {
			$layout = get_option('woo_layout');
				if ( $layout == '' ) 
					$layout = "two-col-left";
		}
	
		// Specify site width
		$width = get_option('woo_layout_width');
		if ( $width == '760px' ) 
			$width = "-760";
		elseif ( $width == '960px' ) 
			$width = "-960";
		elseif ( $width == '880px' ) 
			$width = "-880";
		elseif ( $width == '980px' ) 
			$width = "-980";
		elseif ( $width == '1200px' ) 
			$width = "-1200";
		else 
			$width = "-940";
		
		// Add classes to body_class() output 
		$classes[] = $layout;
		$classes[] = 'width' . $width;
		$classes[] = $layout . $width;
		return $classes;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Woo Slider Setup */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_slider')) {
	function woo_slider() {
		global $woo_options;
		if ( ( is_page_template('template-biz.php') && $woo_options['woo_slider_biz'] == "true" ) || 
			 ( is_page_template('template-magazine.php') && $woo_options['woo_slider_magazine'] == "true" ) ) {
	?>	
	<!-- Woo Slider Setup -->
	<script type="text/javascript">
	jQuery(window).load(function(){
	    jQuery("#loopedSlider").loopedSlider({
	<?php
		$autoStart = 0;
		$autoHeight = "false";
		if ( $woo_options['woo_slider_autoheight'] == "true" )
			$autoHeight = "true";
		$containerClick = "false";
		if ( $woo_options['woo_slider_containerclick'] == "true" )
			$containerClick = "true";
		$slidespeed = 600;
		$slidespeed = $woo_options['woo_slider_speed'] * 1000;
		if ( $woo_options['woo_slider_auto'] == "true" ) 
		   $autoStart = $woo_options['woo_slider_interval'] * 1000;
		else 
		   $autoStart = 0;
	 ?>
	        autoStart: <?php echo $autoStart; ?>, 
	        slidespeed: <?php echo $slidespeed; ?>, 
	        autoHeight: <?php echo $autoHeight; ?>,
	        containerClick: <?php echo $containerClick; ?>
	    });
	});
	</script>
	<?php if ( $containerClick == "true" ) { ?>
	<style type="text/css">#loopedSlider .container { cursor:pointer; }</style>
	<?php } ?>
	<!-- /Woo Slider Setup -->
	<?php
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Woo Slider Magazine */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_slider_magazine')) {
	function woo_slider_magazine() {
		
		global $woo_options;
		
		// Setup height of slider
		$height = $woo_options['woo_slider_magazine_height'];
		if ( $height == "" ) 
			$height = "300";
	
		// Setup width of slider and images
		$width = "610";
		$layout = $woo_options['woo_layout'];
		$layout_width = $woo_options['woo_layout_width'];
	
		if ( $layout == "one-col" ) {
	
			if ( $layout_width == '980px' ) { 
				$width = "980";
			} elseif ( $layout_width == '960px' ) {
				$width = "960";
			} elseif ( $layout_width == '880px' ) {
				$width = "880";
			} elseif ( $layout_width == '760px' ) {
				$width = "760";
			} elseif ( $layout_width == '1200px' ) {
				$width = "1200";
			} else {
				$width = "940";
			}
	
		} elseif ( $layout == "two-col-left" || $layout == "two-col-right" || $layout == "two-col-middle" ) {
	
			if ( $layout_width == '980px' ) { 
				$width = "650";
			} elseif ( $layout_width == '960px' ) {
				$width = "630";
			} elseif ( $layout_width == '880px' ) {
				$width = "550";
			} elseif ( $layout_width == '760px' ) {
				$width = "480";
			} elseif ( $layout_width == '1200px' ) {
				$width = "800";
			} else {
				$width = "610";
			}
	
		} elseif ( $layout == "three-col-left" || $layout == "three-col-right" || $layout == "three-col-middle" ) {
	
			if ( $layout_width == '980px' ) { 
				$width = "480";
			} elseif ( $layout_width == '960px' ) {
				$width = "460";
			} elseif ( $layout_width == '880px' ) {
				$width = "420";
			} elseif ( $layout_width == '760px' ) {
				$width = "350";
			} elseif ( $layout_width == '1200px' ) {
				$width = "680";
			} else {
				$width = "440";
			}
	
		} 
	
		// Setup slider tags array
		$slider_tags = explode(',',$woo_options['woo_slider_magazine_tags']); // Tags to be shown
		foreach ($slider_tags as $tags){ 
			$tag = get_term_by( 'name', trim($tags), 'post_tag', 'ARRAY_A' );
			if ( $tag['term_id'] > 0 )
				$tag_array[] = $tag['term_id'];
		}
		if ( empty($tag_array) ) {
			echo '<p class="note">Please setup Featured Slider Tag(s) in your options panel. You must setup tags that are used on active posts.</p>';
			return;
		}
		
		// Setup excerpt length
		$excerpt_length = $woo_options['woo_slider_magazine_excerpt_length'];
		if ( $excerpt_length == "" ) 
			$excerpt_length = "15";
	
	?>
	
	<div id="loopedSlider">
	   
	<?php $saved = $wp_query; query_posts(array('tag__in' => $tag_array, 'showposts' => $woo_options['woo_slider_magazine_entries'])); ?>
	<?php if (have_posts()) : $count = 0; ?>
	
	     <div class="container" style="height:<?php echo $height; ?>px">  
	         <div class="slides">  
	       
	        <?php while (have_posts()) : the_post(); global $post; $shownposts[$count] = $post->ID; $count++; ?>
	          
	            <div id="slide-<?php echo $count; ?>" class="slide" <?php if($count >= 2) { echo 'style="display:none"'; }?>>                
	
	                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php woo_image('width='.$width.'&height='.$height.'&link=img'); ?></a>
	                <div class="content">                 
	                    <?php if ( $woo_options['woo_slider_magazine_title'] == "true" ) { ?><h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2><?php } ?>
	                    <?php if ( $woo_options['woo_slider_magazine_excerpt'] == "true" ) { ?><div class="excerpt"><p><?php echo woo_text_trim( get_the_excerpt(), $excerpt_length); ?></p></div><?php } ?>
	                </div>
	
	            </div>     
	
	        <?php endwhile; $wp_query = $saved; ?>
	
	        </div><!-- /.slides -->
	    </div><!-- /.container -->   
	    
	    <a href="#" class="previous"><img src="<?php bloginfo('template_directory'); ?>/images/btn-prev-slider.png" alt="&lt;" /></a>
	    <a href="#" class="next"><img src="<?php bloginfo('template_directory'); ?>/images/btn-next-slider.png" alt="&gt;" /></a>        
	    
	<?php endif; $wp_query = $saved; ?>
	
	</div><!-- /#loopedSlider -->
	
	<?php 
    	if (get_option('woo_exclude') <> $shownposts) update_option("woo_exclude", $shownposts); 
	
	} 
}

/*-----------------------------------------------------------------------------------*/
/* Woo Slider Business */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_slider_biz')) {
	function woo_slider_biz() {
		
		global $woo_options;
		
		// Setup height of slider
		$height = $woo_options['woo_slider_biz_height'];
		if ( $height == "" ) 
			$height = "350";
	
		// Setup width of slider and images
		$width = "940";
		$layout = $woo_options['woo_layout'];
		$layout_width = $woo_options['woo_layout_width'];
	
		if ( $layout_width == '980px' ) { 
			$width = "980";
		} elseif ( $layout_width == '960px' ) {
			$width = "960";
		} elseif ( $layout_width == '880px' ) {
			$width = "880";
		} elseif ( $layout_width == '760px' ) {
			$width = "760";
		} elseif ( $layout_width == '1200px' ) {
			$width = "1200";
		}
	
		// Setup slider page id's
		query_posts('post_type=slide&order='.$woo_options['woo_slider_biz_order'].'&orderby=date&showposts='.$woo_options['woo_slider_biz_number']);
		if (!have_posts()) {
			echo '<p class="note">Please setup Featured Slider Tag(s) in your options panel. You must setup page ID\'s to be shown in the slider.</p>';
			return;
		}
		
		// Setup excerpt length
		$excerpt_length = $woo_options['woo_slider_biz_excerpt_length'];
		if ( $excerpt_length == "" ) 
			$excerpt_length = "15";	
	
	?>
	
	<div id="loopedSlider">
	
	     <div class="container" style="height:<?php echo $height; ?>px">  
	         <div class="slides">  
	                
	        <?php if (have_posts()) : while (have_posts()) : the_post(); global $post; $count++; ?>
	
	            <div id="slide-<?php echo $count; ?>" class="slide" style="width:<?php echo $width; ?>px;<?php if ($count >= 2) { echo 'display:none;'; } ?>">                
	
					<?php $type = get_post_meta($post->ID, "image", true); if ( $type ) {	?>
	
						<?php $url = get_post_meta($post->ID, "url", true); if ( $url ) {	?>
	                        <a href="<?php echo $url; ?>" title="<?php the_title(); ?>"><?php woo_image('width='.$width.'&height='.$height.'&link=img'); ?></a>
	                    <?php } else { ?>
	                        <?php woo_image('width='.$width.'&height='.$height.'&link=img'); ?>
	                    <?php } ?>
	                                
	                    <div class="content">                 
	                        <?php if ( $woo_options['woo_slider_biz_title'] == "true" ) { ?><div class="title"><h2 class="title"><a href="<?php if ( $url ) echo $url; else the_permalink(); ?>"><?php the_title(); ?></a></h2></div><?php } ?>
	                        <div class="excerpt"><?php the_content(); ?></div>
	                    </div>
	                    
	                <?php } else { ?>
	                
	                	<div class="entry">
		                    <?php the_content(); ?>
	                    </div>                        
	               
	                <?php } ?>
	
	            </div>     
	
	        <?php endwhile; endif; ?>
	        
	        </div><!-- /.slides -->
	    </div><!-- /.container -->   
	    
	    <a href="#" class="previous"><img src="<?php bloginfo('template_directory'); ?>/images/btn-prev-slider.png" alt="&lt;" /></a>
	    <a href="#" class="next"><img src="<?php bloginfo('template_directory'); ?>/images/btn-next-slider.png" alt="&gt;" /></a>        
	    
	
	</div><!-- /#loopedSlider -->
	
	<?php 
	} 
}

/*-----------------------------------------------------------------------------------*/
/* Navigation */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_nav')) {
	function woo_nav() { 
	global $woo_options;
	?>
	
	<?php woo_nav_before(); ?>
	
	<div id="navigation" class="col-full">
		
		<?php woo_nav_inside(); ?>
		<?php
		if ( function_exists('has_nav_menu') && has_nav_menu('primary-menu') ) {
			wp_nav_menu( array( 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'main-nav', 'menu_class' => 'nav fl', 'theme_location' => 'primary-menu' ) );
		} else {
		?>
		<ul id="main-nav" class="nav fl">
			<?php 
			if ( get_option('woo_custom_nav_menu') == 'true' ) {
				if ( function_exists('woo_custom_navigation_output') )
					woo_custom_navigation_output("name=Woo Menu 1");
	
			} else { ?>
				
				<?php if ( is_page() ) $highlight = "page_item"; else $highlight = "page_item current_page_item"; ?>
				<li class="<?php echo $highlight; ?>"><a href="<?php bloginfo('url'); ?>"><?php _e('Home', 'woothemes') ?></a></li>
				<?php wp_list_pages('sort_column=menu_order&depth=6&title_li=&exclude='); ?>
	
			<?php } ?>
		</ul><!-- /#nav -->
		<?php } ?>
		<?php if ( $woo_options['woo_nav_rss'] == "true" ) { ?>
		<ul class="rss fr">
			<?php if ( $woo_options['woo_subscribe_email'] ) { ?>
			<li class="sub-email"><a href="<?php echo $woo_options['woo_subscribe_email'] ?>" target="_blank"><?php _e('Subscribe by Email', 'woothemes') ?></a></li>
			<?php } ?>
			<li class="sub-rss"><a href="<?php if ( $woo_options['woo_feed_url'] ) { echo $woo_options['woo_feed_url']; } else { echo get_bloginfo_rss('rss2_url'); } ?>"><?php _e('Subscribe to RSS', 'woothemes') ?></a></li>
		</ul>
		<?php } ?>
		
	</div><!-- /#navigation -->
	
	<?php woo_nav_after(); ?>
	
	<?php 
	}
}

/*-----------------------------------------------------------------------------------*/
/* Post More  */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_post_more')) {
	function woo_post_more() {
		if ( get_option('woo_disable_post_more') <> "true" ) {
	?>
		<div class="post-more">   
			<?php if ( get_option('woo_post_content') == "excerpt" ) { ?><span class="read-more"><a href="<?php the_permalink() ?>" title="<?php _e('Read full story','woothemes'); ?>"><?php _e('Read full story','woothemes'); ?></a></span> <span class="sep">&bull;</span><?php } ?>
			<span class="comments"><?php comments_popup_link(__('Comments { 0 }', 'woothemes'), __('Comments { 1 }', 'woothemes'), __('Comments { % }', 'woothemes')); ?></span>
		</div>                        	
	<?php
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Video Embed  */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('canvas_get_embed')) {
	function canvas_get_embed() { 
		global $woo_options;
		
		// Setup height & width of embed
		$width = "610";
		$height = "343";
		$layout = $woo_options['woo_layout'];
		$layout_width = $woo_options['woo_layout_width'];
	
		if ( $layout == "one-col" ) {
	
			if ( $layout_width == '980px' ) { 
				$width = "980";
			} elseif ( $layout_width == '960px' ) {
				$width = "960";
			} elseif ( $layout_width == '880px' ) {
				$width = "880";
			} elseif ( $layout_width == '760px' ) {
				$width = "760";
			} elseif ( $layout_width == '1200px' ) {
				$width = "1200";
			} else {
				$width = "940";
			}
	
		} elseif ( $layout == "two-col-left" || $layout == "two-col-right" || $layout == "two-col-middle" ) {
	
			if ( $layout_width == '980px' ) { 
				$width = "650";
				$height = "365";
			} elseif ( $layout_width == '960px' ) {
				$width = "630";
				$height = "354";
			} elseif ( $layout_width == '880px' ) {
				$width = "550";
				$height = "309";
			} elseif ( $layout_width == '760px' ) {
				$width = "480";
				$height = "270";
			} elseif ( $layout_width == '1200px' ) {
				$width = "800";
				$height = "450";
			} else {
				$width = "610";
			}
	
		} elseif ( $layout == "three-col-left" || $layout == "three-col-right" || $layout == "three-col-middle" ) {
	
			if ( $layout_width == '980px' ) { 
				$width = "480";
				$height = "270";
			} elseif ( $layout_width == '960px' ) {
				$width = "460";
				$height = "259";
			} elseif ( $layout_width == '880px' ) {
				$width = "420";
				$height = "236";
			} elseif ( $layout_width == '760px' ) {
				$width = "350";
				$height = "197";
			} elseif ( $layout_width == '1200px' ) {
				$width = "680";
				$height = "380";
			} else {
				$width = "440";
				$height = "247";
			}
	
		} 
	
		if ( woo_embed('') ) {
	?>
	
	<div class="post-embed">
		<?php echo woo_embed('width='.$width.'&height='.$height); ?>
	</div><!-- /.post-embed -->
	
	<?php 
		}
	} 
}


/*-----------------------------------------------------------------------------------*/
/* Author Box */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_author')) {
	function woo_author() { 
		
		// Author box single post page 
		if ( is_single() && get_option('woo_disable_post_author') <> "true" )
			add_action('woo_post_inside_after', 'woo_author_box');				

		// Author box author page
		elseif (is_author())
			add_action('woo_loop_before', 'woo_author_box');				
	
	}
}


/*-----------------------------------------------------------------------------------*/
/* Single Post Author */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_author_box')) {
	function woo_author_box() { 
		global $post;
		$author_id=$post->post_author;
?>
<div id="post-author">
	<div class="profile-image"><?php echo get_avatar( $author_id, '80' ); ?></div>
	<div class="profile-content">
		<h4><?php printf( esc_attr__( 'About %s', 'woothemes' ), get_the_author_meta( 'display_name', $author_id ) ); ?></h4>
		<?php echo get_the_author_meta( 'description', $author_id ) ?>
		<?php if (is_singular()) : ?>
		<div class="profile-link">
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ); ?>">
				<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'woothemes' ), get_the_author_meta( 'display_name', $author_id ) ); ?>
			</a>
		</div><!-- #profile-link	-->
		<?php endif; ?>
	</div>
	<div class="fix"></div>
</div>
<?php 
	}
}


/*-----------------------------------------------------------------------------------*/
/* Yoast Breadcrumbs */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_breadcrumbs') ) { 
	function woo_breadcrumbs() {
		if ( function_exists('yoast_breadcrumb') ) { 
			yoast_breadcrumb('<div id="breadcrumb"><p>','</p></div>');
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* END */
/*-----------------------------------------------------------------------------------*/
?>