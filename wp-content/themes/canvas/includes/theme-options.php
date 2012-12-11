<?php

$seo_post_types = array('post','page');
define("SEOPOSTTYPES", serialize($seo_post_types));

//Global options setup
add_action('init','woo_global_options');
function woo_global_options(){
	// Populate WooThemes option in array for use in theme
	global $woo_options;
	$woo_options = get_option('woo_options');
}

add_action('admin_head','woo_options');  
if (!function_exists('woo_options')) {
function woo_options(){
	
// VARIABLES
$themename = "Canvas";
$manualurl = 'http://www.woothemes.com/support/theme-documentation/canvas/';
$shortname = "woo";

// Populate WooThemes option in array for use in theme
global $woo_options;
$woo_options = get_option('woo_options');

$GLOBALS['template_path'] = get_bloginfo('template_directory');

//Access the WordPress Categories via an Array
$woo_categories = array();  
$woo_categories_obj = get_categories('hide_empty=0');
foreach ($woo_categories_obj as $woo_cat) {
    $woo_categories[$woo_cat->cat_ID] = $woo_cat->cat_name;}
$categories_tmp = array_unshift($woo_categories, "Select a category:");    
       
//Access the WordPress Pages via an Array
$woo_pages = array();
$woo_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($woo_pages_obj as $woo_page) {
    $woo_pages[$woo_page->ID] = $woo_page->post_name; }
$woo_pages_tmp = array_unshift($woo_pages, "Select a page:");       

// Image Alignment radio box
$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 

// Select box border-radius
$options_pixels = array("0px","1px","2px","3px","4px","5px","6px","7px","8px","9px","10px","11px","12px","13px","14px","15px","16px","17px","18px","19px","20px"); 

//Testing 
//$options_select = array("one","two","three","four","five"); 
//$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five"); 

//Stylesheets Reader
$alt_stylesheet_path = TEMPLATEPATH . '/styles/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//More Options
$all_uploads_path = get_bloginfo('home') . '/wp-content/uploads/';
$all_uploads = get_option('woo_uploads');
$other_entries = array("Select a number:","0","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$tumblog_options = array("Disabled","Before","After");
$options_image_link_to = array("image" => "The Image","post" => "The Post"); 

// THIS IS THE DIFFERENT FIELDS
$options = array();   

$options[] = array( "name" => "General Settings",
					"icon" => "general",
                    "type" => "heading");
                        
$options[] = array( "name" => "Theme Stylesheet",
					"desc" => "Select your themes alternative color scheme. <em><strong style='color:red'>NOTE:</strong> All custom styles will be disabled when using alternative stylesheet.</em>",
					"id" => $shortname."_alt_stylesheet",
					"std" => "default.css",
					"type" => "select",
					"options" => $alt_stylesheets);

$options[] = array( "name" => "Custom Logo",
					"desc" => "Upload a logo for your theme, or specify an image URL directly.",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");    
                                                                                     
$options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload"); 
                                               
$options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");        

$options[] = array( "name" => "RSS URL",
					"desc" => "Enter your preferred RSS URL. (Feedburner or other)",
					"id" => $shortname."_feed_url",
					"std" => "",
					"type" => "text");
                    
$options[] = array( "name" => "E-Mail URL",
					"desc" => "Enter your preferred E-mail subscription URL. (Feedburner or other)",
					"id" => $shortname."_subscribe_email",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Contact Form E-Mail",
					"desc" => "Enter your E-mail address to use on the Contact Form Page Template. Add the contact form by adding a new page and selecting 'Contact Form' as page template.",
					"id" => $shortname."_contactform_email",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");

$options[] = array( "name" => "Post/Page Comments",
					"desc" => "Select if you want to comments on posts and/or pages. ",
					"id" => $shortname."_comments",
					"type" => "select2",
					"options" => array("post" => "Posts Only", "page" => "Pages Only", "both" => "Pages / Posts", "none" => "None") );                                                          
    
$options[] = array( "name" => "Post Content",
					"desc" => "Select if you want to show the full content or the excerpt on posts. ",
					"id" => $shortname."_post_content",
					"type" => "select2",
					"options" => array("excerpt" => "The Excerpt", "content" => "Full Content" ) );                                                          

$options[] = array( "name" => "Layout",
					"icon" => "layout",
					"type" => "heading");    

$options[] = array( "name" => "Site Width",
					"desc" => "Set the total site width in pixels.",
					"id" => $shortname."_layout_width",
					"std" => "940px",
					"type" => "select",
					"options" => array('1200px' => '1200px' ,'980px' => '980px','960px' => '960px','940px' => '940px','880px' => '880px','760px' => '760px'));                                                          

$url =  get_bloginfo('template_url') . '/functions/images/';
$options[] = array( "name" => "Main Layout",
					"desc" => "Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.",
					"id" => $shortname."_layout",
					"std" => "two-col-left",
					"type" => "images",
					"options" => array(
						'one-col' => $url . '1c.png',
						'two-col-left' => $url . '2cl.png',
						'two-col-right' => $url . '2cr.png',
						'three-col-left' => $url . '3cl.png',
						'three-col-middle' => $url . '3cm.png',
						'three-col-right' => $url . '3cr.png')
					); 	

$options[] = array( "name" => "Disable ALL custom styles",
					"desc" => "Check this if you want to disable output of all custom CSS in the theme.",
					"id" => $shortname."_style_disable",
					"std" => "false",
					"type" => "checkbox");

$options[] = array( "name" => "Footer Widget Areas",
					"desc" => "Set the total number of widget areas in the footer.",
					"id" => $shortname."_footer_sidebars",
					"std" => "4",
					"type" => "select",
					"options" => array('1' => '1' ,'2' => '2','3' => '3','4' => '4'));                                                          

$options[] = array( "name" => "General Styling",
					"icon" => "styling",
					"type" => "heading");   

$options[] = array( "name" =>  "Background Color",
					"desc" => "Pick a custom color for site background or add a hex color code e.g. #e6e6e6",
					"id" => $shortname."_style_bg",
					"std" => "",
					"type" => "color");   

$options[] = array( "name" => "Background Image",
					"desc" => "Upload a background image, or specify the image address of your image. (http://yoursite.com/image.png)",
					"id" => $shortname."_style_bg_image",
					"std" => "",
					"type" => "upload");    

$options[] = array( "name" => "Background Image Repeat",
					"desc" => "Select how you want your background image to display.",
					"id" => $shortname."_style_bg_image_repeat",
					"type" => "select",
					"options" => array("No Repeat" => "no-repeat", "Repeat" => "repeat","Repeat Horizontally" => "repeat-x", "Repeat Vertically" => "repeat-y",) );                                                          

$options[] = array( "name" => "Top Border",
					"desc" => "Specify border properties for the top border.",
					"id" => $shortname."_border_top",
					"std" => array('width' => '4','style' => 'solid','color' => '#000000'),
					"type" => "border");    

$options[] = array( "name" =>  "Link Color",
					"desc" => "Pick a custom color for links or add a hex color code e.g. #697e09",
					"id" => $shortname."_link_color",
					"std" => "",
					"type" => "color");   

$options[] = array( "name" =>  "Link Hover Color",
					"desc" => "Pick a custom color for links hover or add a hex color code e.g. #697e09",
					"id" => $shortname."_link_hover_color",
					"std" => "",
					"type" => "color");                    

$options[] = array( "name" =>  "Button Color",
					"desc" => "Pick a custom color for buttons or add a hex color code e.g. #697e09",
					"id" => $shortname."_button_color",
					"std" => "",
					"type" => "color");  

$options[] = array( "name" =>  "General Border Color",
					"desc" => "Pick a custom color for general border colors or add a hex color code e.g. #e6e6e6",
					"id" => $shortname."_style_border",
					"std" => "",
					"type" => "color");  

$options[] = array( "name" => "General Typography",
					"icon" => "typography",
					"type" => "heading");    

$options[] = array( "name" => "General Text Font Style",
					"desc" => "Select the typography you want for your general text. <br />* non web-safe font.",
					"id" => $shortname."_font_text",
					"std" => array('size' => '14','unit' => 'px', 'face' => 'Arial, sans-serif','style' => 'normal','color' => '#555555'),
					"type" => "typography");  

$options[] = array( "name" => "H1 Font Style",
					"desc" => "Select the typography you want for header H1. <br />* non web-safe font.",
					"id" => $shortname."_font_h1",
					"std" => array('size' => '28','unit' => 'px', 'face' => 'Georgia, serif','style' => 'normal','color' => '#222222'),
					"type" => "typography");  

$options[] = array( "name" => "H2 Font Style",
					"desc" => "Select the typography you want for header H2. <br />* non web-safe font.",
					"id" => $shortname."_font_h2",
					"std" => array('size' => '24','unit' => 'px', 'face' => 'Georgia, serif','style' => 'normal','color' => '#222222'),
					"type" => "typography");  

$options[] = array( "name" => "H3 Font Style",
					"desc" => "Select the typography you want for header H3. <br />* non web-safe font.",
					"id" => $shortname."_font_h3",
					"std" => array('size' => '20','unit' => 'px', 'face' => 'Georgia, serif','style' => 'normal','color' => '#222222'),
					"type" => "typography");  

$options[] = array( "name" => "H4 Font Style",
					"desc" => "Select the typography you want for header H4. <br />* non web-safe font.",
					"id" => $shortname."_font_h4",
					"std" => array('size' => '16','unit' => 'px', 'face' => 'Georgia, serif','style' => 'normal','color' => '#222222'),
					"type" => "typography");  

$options[] = array( "name" => "H5 Font Style",
					"desc" => "Select the typography you want for header H5. <br />* non web-safe font.",
					"id" => $shortname."_font_h5",
					"std" => array('size' => '14','unit' => 'px', 'face' => 'Georgia, serif','style' => 'normal','color' => '#222222'),
					"type" => "typography");  

$options[] = array( "name" => "H6 Font Style",
					"desc" => "Select the typography you want for header H6. <br />* non web-safe font.",
					"id" => $shortname."_font_h6",
					"std" => array('size' => '12','unit' => 'px', 'face' => 'Georgia, serif','style' => 'normal','color' => '#222222'),
					"type" => "typography");  

$options[] = array( "name" => "Boxed Layout",
					"icon" => "box",
					"type" => "heading");    

$options[] = array( "name" => "Boxed Layout Style",
					"desc" => "Enable the boxed layout style. ",
					"id" => $shortname."_layout_boxed",
					"std" => "false",
					"type" => "checkbox");

$options[] = array( "name" =>  "Box Background Color",
					"desc" => "Pick a custom color for the boxed background or add a hex color code e.g. #ffffff",
					"id" => $shortname."_style_box_bg",
					"std" => "",
					"type" => "color");     

$options[] = array( "name" => "Box Margin",
					"desc" => "Enter an integer value i.e. 20 for the desired top and bottom margin.",
					"id" => $shortname."_box_margin",
					"std" => "",
					"type" => array( 
									array(  'id' => $shortname. '_box_margin_top',
											'type' => 'text',
											'std' => '',
											'meta' => 'Top'),
									array(  'id' => $shortname. '_box_margin_bottom',
											'type' => 'text',
											'std' => '',
											'meta' => 'Bottom')
								  ));

$options[] = array( "name" => "Box Border Top/Bottom",
					"desc" => "Specify border properties for the boxed layout.",
					"id" => $shortname."_box_border_tb",
					"std" => array('width' => '4','style' => 'solid','color' => '#dbdbdb'),
					"type" => "border");      

$options[] = array( "name" => "Box Border Left/Right",
					"desc" => "Specify border properties for the boxed layout.",
					"id" => $shortname."_box_border_lr",
					"std" => array('width' => '4','style' => 'solid','color' => '#dbdbdb'),
					"type" => "border");      

$options[] = array( "name" => "Box Rounded Corners",
					"desc" => "Set amount of pixels for border radius (rounded corners). Will only show in CSS3 compatible browser.",
					"id" => $shortname."_box_border_radius",
					"type" => "select",
					"options" => $options_pixels);                                                          

$options[] = array( "name" => "Box Shadow",
					"desc" => "Enable box shadow. Will only show in CSS3 compatible browser.",
					"id" => $shortname."_box_shadow",
					"std" => "true",
					"type" => "checkbox");       

$options[] = array( "name" => "Header Styling",
					"icon" => "header",
					"type" => "heading");    

$options[] = array( "name" =>  "Header Background Color",
					"desc" => "Pick a custom color for header background or add a hex color code e.g. #e6e6e6",
					"id" => $shortname."_header_bg",
					"std" => "",
					"type" => "color");   

$options[] = array( "name" => "Header Background Image",
					"desc" => "Upload a background image, or specify the image address of your image (http://yoursite.com/image.png). <br/>Image should be same width as your site width.",
					"id" => $shortname."_header_bg_image",
					"std" => "",
					"type" => "upload");  

$options[] = array( "name" => "Header Background Image Repeat",
					"desc" => "Select how you want your background image to display.",
					"id" => $shortname."_header_bg_image_repeat",
					"type" => "select",
					"options" => array("No Repeat" => "no-repeat", "Repeat" => "repeat","Repeat Horizontally" => "repeat-x", "Repeat Vertically" => "repeat-y",) );                                                          

$options[] = array( "name" => "Header Border",
					"desc" => "Specify border properties for the header.",
					"id" => $shortname."_header_border",
					"std" => array('width' => '0','style' => 'solid','color' => ''),
					"type" => "border");      

$options[] = array( "name" => "Header Margin Top/Bottom",
					"desc" => "Enter an integer value i.e. 20 for the desired header margin.",
					"id" => $shortname."_header_margin_tb",
					"std" => "",
					"type" => array( 
									array(  'id' => $shortname. '_header_margin_top',
											'type' => 'text',
											'std' => '0',
											'meta' => 'Top'),
									array(  'id' => $shortname. '_header_margin_bottom',
											'type' => 'text',
											'std' => '0',
											'meta' => 'Bottom')
								  ));
$options[] = array( "name" => "Header Padding Top/Bottom",
					"desc" => "Enter an integer value i.e. 20 for the desired header padding.",
					"id" => $shortname."_header_padding_tb",
					"std" => "",
					"type" => array( 
									array(  'id' => $shortname. '_header_padding_top',
											'type' => 'text',
											'std' => '40',
											'meta' => 'Top'),
									array(  'id' => $shortname. '_header_padding_bottom',
											'type' => 'text',
											'std' => '30',
											'meta' => 'Bottom')
								  ));

$options[] = array( "name" => "Header Padding Left/Right",
					"desc" => "Enter an integer value i.e. 20 for the desired header padding.",
					"id" => $shortname."_header_padding_lr",
					"std" => "",
					"type" => array( 
									array(  'id' => $shortname. '_header_padding_left',
											'type' => 'text',
											'std' => '',
											'meta' => 'Left'),
									array(  'id' => $shortname. '_header_padding_right',
											'type' => 'text',
											'std' => '',
											'meta' => 'Right')
								  ));

$options[] = array( "name" => "Site Title Font Style",
					"desc" => "Select the typography you want for your site title. <br />* non web-safe font.",
					"id" => $shortname."_font_logo",
					"std" => array('size' => '40','unit' => 'px', 'face' => 'Georgia, serif','style' => 'normal','color' => '#222222'),
					"type" => "typography");  

$options[] = array( "name" => "Site Description Font Style",
					"desc" => "Select the typography you want for your site description. <br />* non web-safe font.",
					"id" => $shortname."_font_desc",
					"std" => array('size' => '14','unit' => 'px', 'face' => 'Georgia, serif','style' => 'italic','color' => '#999999'),
					"type" => "typography");  

$options[] = array( "name" => "Post Styling",
					"icon" => "main",
					"type" => "heading");  

$options[] = array( "name" => "Post Title Font Style",
					"desc" => "Select the typography you want for your post title. <br />* non web-safe font.",
					"id" => $shortname."_font_post_title",
					"std" => array('size' => '24','unit' => 'px', 'face' => 'Arial, sans-serif','style' => 'bold','color' => '#222222'),
					"type" => "typography");  

$options[] = array( "name" => "Post Meta Font Style",
					"desc" => "Select the typography you want for your post meta. <br />* non web-safe font.",
					"id" => $shortname."_font_post_meta",
					"std" => array('size' => '11','unit' => 'px', 'face' => '&quot;Trebuchet MS&quot;, sans-serif','style' => 'normal','color' => '#868686'),
					"type" => "typography");  

$options[] = array( "name" =>  "Disable Author Meta",
					"desc" => "Disable author meta below post title",
					"id" => $shortname."_disable_post_meta_author",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" =>  "Disable Date Meta",
					"desc" => "Disable date meta below post title",
					"id" => $shortname."_disable_post_meta_date",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" =>  "Disable Category Meta",
					"desc" => "Disable category meta below post title",
					"id" => $shortname."_disable_post_meta_cat",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Post Text Font Style",
					"desc" => "Select the typography you want for your post text. <br />* non web-safe font.",
					"id" => $shortname."_font_post_text",
					"std" => array('size' => '16','unit' => 'px', 'face' => 'Georgia, serif','style' => 'normal','color' => '#555555'),
					"type" => "typography");  

$options[] = array( "name" => "Post More (bottom) Font Style",
					"desc" => "Select the typography you want for your post bottom text. <br />* non web-safe font.",
					"id" => $shortname."_font_post_more",
					"std" => array('size' => '12','unit' => 'px', 'face' => 'Arial, sans-serif','style' => 'normal','color' => '#868686'),
					"type" => "typography");  

$options[] = array( "name" => "Post More (bottom) Border Top",
					"desc" => "Specify border properties for post more section.",
					"id" => $shortname."_post_more_border_top",
					"std" => array('width' => '4','style' => 'solid','color' => '#e6e6e6'),
					"type" => "border");      

$options[] = array( "name" => "Post More (bottom) Border Bottom",
					"desc" => "Specify border properties for post more section.",
					"id" => $shortname."_post_more_border_bottom",
					"std" => array('width' => '1','style' => 'solid','color' => '#e6e6e6'),
					"type" => "border");   

$options[] = array( "name" =>  "Disable Post More",
					"desc" => "Disable the more section below the post",
					"id" => $shortname."_disable_post_more",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" =>  "Post Author Background Color",
					"desc" => "Pick a custom background color for the post author section or add a hex color code e.g. #fafafa",
					"id" => $shortname."_post_author_bg",
					"std" => "#fafafa",
					"type" => "color");    

$options[] = array( "name" => "Post Author Border Top",
					"desc" => "Specify border properties for post author section.",
					"id" => $shortname."_post_author_border_top",
					"std" => array('width' => '1','style' => 'solid','color' => '#e6e6e6'),
					"type" => "border");      

$options[] = array( "name" => "Post Author Border Bottom",
					"desc" => "Specify border properties for post author section.",
					"id" => $shortname."_post_author_border_bottom",
					"std" => array('width' => '4','style' => 'solid','color' => '#e6e6e6'),
					"type" => "border");   

$options[] = array( "name" =>  "Disable Post Author",
					"desc" => "Disable post author below post?",
					"id" => $shortname."_disable_post_author",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" =>  "Comments Background Color (even threads)",
					"desc" => "Pick a custom background color for the post comments even threads or add a hex color code e.g. #fafafa",
					"id" => $shortname."_post_comments_bg",
					"std" => "",
					"type" => "color");    

$options[] = array( "name" => "Page Navigation Font Style",
					"desc" => "Select the typography you want for your Page Navigation text. <br />* non web-safe font.",
					"id" => $shortname."_pagenav_font",
					"std" => array('size' => '12','unit' => 'px', 'face' => 'Georgia, serif','style' => 'italic','color' => '#777777'),
					"type" => "typography");  

$options[] = array( "name" =>  "Page Navigation Background Color",
					"desc" => "Pick a custom color for the Page Navigation background or add a hex color code e.g. #fafafa",
					"id" => $shortname."_pagenav_bg",
					"std" => "",
					"type" => "color");    

$options[] = array( "name" => "Page Navigation Border Top",
					"desc" => "Specify border properties for Page Navigation section.",
					"id" => $shortname."_pagenav_border_top",
					"std" => array('width' => '1','style' => 'solid','color' => '#e6e6e6'),
					"type" => "border");      

$options[] = array( "name" => "Page Navigation Border Bottom",
					"desc" => "Specify border properties for Page Navigation section.",
					"id" => $shortname."_pagenav_border_bottom",
					"std" => array('width' => '4','style' => 'solid','color' => '#e6e6e6'),
					"type" => "border");      

$options[] = array( "name" => "Archive Header Font Style",
					"desc" => "Select the typography you want for your Archive header. <br />* non web-safe font.",
					"id" => $shortname."_archive_header_font",
					"std" => array('size' => '18','unit' => 'px', 'face' => 'Arial, sans-serif','style' => '','color' => '#555555'),
					"type" => "typography");  

$options[] = array( "name" => "Archive Header Border Bottom",
					"desc" => "Specify border properties for Archive header",
					"id" => $shortname."_archive_header_border_bottom",
					"std" => array('width' => '5','style' => 'solid','color' => '#e6e6e6'),
					"type" => "border");      

$options[] = array( "name" =>  "Disable Archive Header RSS link",
					"desc" => "Disable RSS link in Archive header",
					"id" => $shortname."_archive_header_disable_rss",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Widget Styling",
					"icon" => "sidebar",
					"type" => "heading");  

$options[] = array( "name" =>  "Widget Background Color",
					"desc" => "Pick a custom color for the widget background or add a hex color code e.g. #cccccc",
					"id" => $shortname."_widget_bg",
					"std" => "",
					"type" => "color");    

$options[] = array( "name" => "Widget Border",
					"desc" => "Specify border properties for widgets.",
					"id" => $shortname."_widget_border",
					"std" => array('width' => '0','style' => 'solid','color' => '#dbdbdb'),
					"type" => "border");      

$options[] = array( "name" => "Widget Padding",
					"desc" => "Enter an integer value i.e. 20 for the desired widget padding.",
					"id" => $shortname."_widget_padding",
					"std" => "",
					"type" => array( 
									array(  'id' => $shortname. '_widget_padding_tb',
											'type' => 'text',
											'std' => '',
											'meta' => 'Top/Bottom'),
									array(  'id' => $shortname. '_widget_padding_lr',
											'type' => 'text',
											'std' => '',
											'meta' => 'Left/Right')
								  ));

$options[] = array( "name" => "Widget Title",
					"desc" => "Select the typography you want for the widget title. <br />* non web-safe font.",
					"id" => $shortname."_widget_font_title",
					"std" => array('size' => '14','unit' => 'px', 'face' => 'Arial, sans-serif','style' => 'bold','color' => '#555555'),
					"type" => "typography");  

$options[] = array( "name" => "Widget Title Bottom Border",
					"desc" => "Specify border property for the widget title.",
					"id" => $shortname."_widget_title_border",
					"std" => array('width' => '3','style' => 'solid','color' => '#e6e6e6'),
					"type" => "border");      

$options[] = array( "name" => "Widget Text",
					"desc" => "Select the typography you want for the widget text. <br />* non web-safe font.",
					"id" => $shortname."_widget_font_text",
					"std" => array('size' => '12','unit' => 'px', 'face' => 'Arial, sans-serif','style' => 'normal','color' => '#555555'),
					"type" => "typography");  

$options[] = array( "name" => "Widget Rounded Corners",
					"desc" => "Set amount of pixels for border radius (rounded corners). Will only show in CSS3 compatible browser.",
					"id" => $shortname."_widget_border_radius",
					"type" => "select",
					"options" => $options_pixels);  

$options[] = array( "name" =>  "Tabs Widget Background color",
					"desc" => "Pick a custom color for the tabs widget or add a hex color code e.g. #cccccc",
					"id" => $shortname."_widget_tabs_bg",
					"std" => "",
					"type" => "color");     

$options[] = array( "name" =>  "Tabs Widget Inside Background Color",
					"desc" => "Pick a custom color for the tabs widget or add a hex color code e.g. #cccccc",
					"id" => $shortname."_widget_tabs_bg_inside",
					"std" => "",
					"type" => "color");     

$options[] = array( "name" => "Tabs Widget Title",
					"desc" => "Select the typography you want for the widget text. <br />* non web-safe font.",
					"id" => $shortname."_widget_tabs_font",
					"std" => array('size' => '12','unit' => 'px', 'face' => 'Georgia, serif','style' => 'bold','color' => '#555555'),
					"type" => "typography");  

$options[] = array( "name" => "Tabs Widget Meta / Tabber Font",
					"desc" => "Select the typography you want for the widget text. <br />* non web-safe font.",
					"id" => $shortname."_widget_tabs_font_meta",
					"std" => array('size' => '11','unit' => 'px', 'face' => '&quot;Trebuchet MS&quot;, sans-serif','style' => 'normal','color' => '#777777'),
					"type" => "typography");  

$options[] = array( "name" => "Footer Styling",
					"icon" => "footer",
					"type" => "heading");    

$options[] = array( "name" => "Footer Font Style",
					"desc" => "Select the typography you want for your footer. <br />* non web-safe font.",
					"id" => $shortname."_footer_font",
					"std" => array('size' => '14','unit' => 'px', 'face' => 'Georgia, serif','style' => 'italic','color' => '#777777'),
					"type" => "typography");  

$options[] = array( "name" => "Footer Background",
					"desc" => "Select the background color you want for your footer. ",
					"id" => $shortname."_footer_bg",
					"std" => "",
					"type" => "color");  

$options[] = array( "name" => "Footer Border Top",
					"desc" => "Specify top border properties for the footer.",
					"id" => $shortname."_footer_border_top",
					"std" => array('width' => '4','style' => 'solid','color' => '#dbdbdb'),
					"type" => "border");      

$options[] = array( "name" => "Footer Border Bottom",
					"desc" => "Specify bottom border properties for the footer.",
					"id" => $shortname."_footer_border_bottom",
					"std" => array('width' => '0','style' => 'solid','color' => ''),
					"type" => "border");      

$options[] = array( "name" => "Footer Border Left/Right",
					"desc" => "Specify left/right border properties for the footer.",
					"id" => $shortname."_footer_border_lr",
					"std" => array('width' => '0','style' => 'solid','color' => ''),
					"type" => "border");      

$options[] = array( "name" => "Footer Rounded Corners",
					"desc" => "Set amount of pixels for border radius (rounded corners). Will only show in CSS3 compatible browser.",
					"id" => $shortname."_footer_border_radius",
					"type" => "select",
					"options" => $options_pixels);                                                          

$options[] = array( "name" => "Custom Affiliate Link",
					"desc" => "Add an affiliate link to the WooThemes logo in the footer of the theme.",
					"id" => $shortname."_footer_aff_link",
					"std" => "",
					"type" => "text");	
									
$options[] = array( "name" => "Enable Custom Footer (Left)",
					"desc" => "Activate to add the custom text below to the theme footer.",
					"id" => $shortname."_footer_left",
					"class" => "collapsed",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Custom Text (Left)",
					"desc" => "Custom HTML and Text that will appear in the footer of your theme.",
					"id" => $shortname."_footer_left_text",
					"class" => "hidden last",
					"std" => "<p></p>",
					"type" => "textarea");
						
$options[] = array( "name" => "Enable Custom Footer (Right)",
					"desc" => "Activate to add the custom text below to the theme footer.",
					"id" => $shortname."_footer_right",
					"class" => "collapsed",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Custom Text (Right)",
					"desc" => "Custom HTML and Text that will appear in the footer of your theme.",
					"id" => $shortname."_footer_right_text",
					"class" => "hidden last",
					"std" => "<p></p>",
					"type" => "textarea");
                   
$options[] = array( "name" => "Navigation Styling",
					"icon" => "nav",
					"type" => "heading");    

$options[] = array( "name" =>  "Show Subscribe Link",
					"desc" => "Show the Subscribe to RSS link in right navigation.",
					"id" => $shortname."_nav_rss",
					"std" => "true",
					"type" => "checkbox");     

$options[] = array( "name" =>  "Background Color",
					"desc" => "Pick a custom color for the navigation background or add a hex color code e.g. #cccccc",
					"id" => $shortname."_nav_bg",
					"std" => "",
					"type" => "color");     

$options[] = array( "name" => "Navigation Font Style",
					"desc" => "Select the typography you want for your navigation. <br />* non web-safe font.",
					"id" => $shortname."_nav_font",
					"std" => array('size' => '14','unit' => 'px', 'face' => '','style' => '','color' => '#555555'),
					"type" => "typography");  

$options[] = array( "name" =>  "Hover Color",
					"desc" => "Pick a custom color for the navigation hover effect or add a hex color code e.g. #eeeeee",
					"id" => $shortname."_nav_hover",
					"std" => "",
					"type" => "color");     

$options[] = array( "name" => "Border Top",
					"desc" => "Specify border properties for the navigation.",
					"id" => $shortname."_nav_border_top",
					"std" => array('width' => '1','style' => 'solid','color' => '#dbdbdb'),
					"type" => "border");      

$options[] = array( "name" => "Border Bottom",
					"desc" => "Specify border properties for the navigation.",
					"id" => $shortname."_nav_border_bot",
					"std" => array('width' => '4','style' => 'solid','color' => '#dbdbdb'),
					"type" => "border");      

$options[] = array( "name" => "Border Left/Right",
					"desc" => "Specify border properties for the navigation.",
					"id" => $shortname."_nav_border_lr",
					"std" => array('width' => '0','style' => 'solid','color' => '#dbdbdb'),
					"type" => "border");      

$options[] = array( "name" => "Navigation Rounded Corners",
					"desc" => "Set amount of pixels for border radius (rounded corners). Will only show in CSS3 compatible browser.",
					"id" => $shortname."_nav_border_radius",
					"type" => "select",
					"options" => $options_pixels); 

$options[] = array( "name" => "Dynamic Images",
					"icon" => "image",
				    "type" => "heading");    

$options[] = array( "name" => "Enable WordPress Post Thumbnail Support",
					"desc" => "Use WordPress post thumbnail support to assign a post thumbnail.",
					"id" => $shortname."_post_image_support",
					"std" => "false",
					"class" => "collapsed",
					"type" => "checkbox"); 

$options[] = array( "name" => "Dynamically Resize Post Thumbnail",
					"desc" => "The post thumbnail will be dynamically resized using native WP resize functionality. <em>(Requires PHP 5.2+)</em>",
					"id" => $shortname."_pis_resize",
					"std" => "true",
					"class" => "hidden",
					"type" => "checkbox"); 									   
					
$options[] = array( "name" => "Hard Crop Post Thumbnail",
					"desc" => "The image will be cropped to match the target aspect ratio.",
					"id" => $shortname."_pis_hard_crop",
					"std" => "true",
					"class" => "hidden last",
					"type" => "checkbox"); 									   

$options[] = array( "name" => "Enable Dynamic Image Resizer",
					"desc" => "This will enable the thumb.php script which dynamically resizes images on your site.",
					"id" => $shortname."_resize",
					"std" => "true",
					"type" => "checkbox");    
                    
$options[] = array( "name" => "Automatic Image Thumbs",
					"desc" => "If no image is specified in the 'image' custom field then the first uploaded post image is used.",
					"id" => $shortname."_auto_img",
					"std" => "true",
					"type" => "checkbox");    

$options[] = array( "name" => "Thumbnail Image Dimensions",
					"desc" => "Enter an integer value i.e. 250 for the desired size which will be used when dynamically creating the images.",
					"id" => $shortname."_image_dimensions",
					"std" => "",
					"type" => array( 
									array(  'id' => $shortname. '_thumb_w',
											'type' => 'text',
											'std' => 100,
											'meta' => 'Width'),
									array(  'id' => $shortname. '_thumb_h',
											'type' => 'text',
											'std' => 100,
											'meta' => 'Height')
								  ));
                                                                                                
$options[] = array( "name" => "Thumbnail Image alignment",
					"desc" => "Select how to align your thumbnails with posts.",
					"id" => $shortname."_thumb_align",
					"std" => "alignleft",
					"type" => "radio",
					"options" => $options_thumb_align); 

$options[] = array( "name" => "Show thumbnail in Single Posts",
					"desc" => "Show the attached image in the single post page.",
					"id" => $shortname."_thumb_single",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Single Image Dimensions",
					"desc" => "Enter an integer value i.e. 250 for the image size.",
					"id" => $shortname."_image_dimensions",
					"std" => "",
					"type" => array( 
									array(  'id' => $shortname. '_single_w',
											'type' => 'text',
											'std' => 200,
											'meta' => 'Width'),
									array(  'id' => $shortname. '_single_h',
											'type' => 'text',
											'std' => 200,
											'meta' => 'Height')
								  ));

$options[] = array( "name" => "Thumbnail Image alignment Single Post",
					"desc" => "Select how to align your thumbnails with single posts.",
					"id" => $shortname."_thumb_align_single",
					"std" => "alignright",
					"type" => "radio",
					"options" => $options_thumb_align); 


$options[] = array( "name" => "Add thumbnail to RSS feed",
					"desc" => "Add the the image uploaded via your Custom Settings to your RSS feed",
					"id" => $shortname."_rss_thumb",
					"std" => "false",
					"type" => "checkbox");    

//Advertising
$options[] = array( "name" => "Ad - Top (468x60)",
					"icon" => "ads",
                    "type" => "heading");

$options[] = array( "name" => "Enable Ad",
					"desc" => "Enable the ad space",
					"id" => $shortname."_ad_top",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Adsense code",
					"desc" => "Enter your adsense code (or other ad network code) here.",
					"id" => $shortname."_ad_top_adsense",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "Image Location",
					"desc" => "Enter the URL to the banner ad image location.",
					"id" => $shortname."_ad_top_image",
					"std" => "http://www.woothemes.com/ads/468x60b.jpg",
					"type" => "upload");
					
$options[] = array( "name" => "Destination URL",
					"desc" => "Enter the URL where this banner ad points to.",
					"id" => $shortname."_ad_top_url",
					"std" => "http://www.woothemes.com",
					"type" => "text");        

// Template: Magazine

	$options[] = array( "name" => "Magazine Template",
						"icon" => "layout",
						"type" => "heading");
	
	$options[] = array( "name" => "Featured Posts",
						"desc" => "Select how many featured (full width) posts you would like to show before your two-column posts. Set total number of posts in Settings > Reading.",
						"id" => $shortname."_magazine_feat_posts",
						"type" => "select",
						"options" => $other_entries);
	
	$options[] = array( "name" => "Featured Image Dimensions",
						"desc" => "Enter an integer value i.e. 250 for the image size. ",
						"id" => $shortname."_image_dimensions",
						"std" => "",
						"type" => array( 
										array(  'id' => $shortname. '_magazine_f_w',
												'type' => 'text',
												'std' => 100,
												'meta' => 'Width'),
										array(  'id' => $shortname. '_magazine_f_h',
												'type' => 'text',
												'std' => 100,
												'meta' => 'Height')
									  ));
	
	$options[] = array( "name" => "Featured Post Image Alignment",
						"desc" => "Select how to align your featured post images.",
						"id" => $shortname."_magazine_f_align",
						"std" => "alignleft",
						"type" => "radio",
						"options" => $options_thumb_align); 
	
	$options[] = array( "name" => "Normal Post Image Dimensions",
						"desc" => "Enter an integer value i.e. 250 for the image size. ",
						"id" => $shortname."_image_dimensions",
						"std" => "",
						"type" => array( 
										array(  'id' => $shortname. '_magazine_b_w',
												'type' => 'text',
												'std' => 100,
												'meta' => 'Width'),
										array(  'id' => $shortname. '_magazine_b_h',
												'type' => 'text',
												'std' => 100,
												'meta' => 'Height')
									  ));
	
	$options[] = array( "name" => "Normal Post Image Alignment",
						"desc" => "Select how to align your normal post images.",
						"id" => $shortname."_magazine_b_align",
						"std" => "alignleft",
						"type" => "radio",
						"options" => $options_thumb_align); 
	
	$options[] = array( "name" => "Exclude Categories From Loop",
						"desc" => "Enter a comma-separated list of category <a href='http://support.wordpress.com/pages/8/'>ID's</a> that you'd like to exclude from the post loop. (e.g. 12,23,27,44)",
						"id" => $shortname."_magazine_exclude",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "Featured Slider",
						"desc" => "Enable the featured slider. Setup template specific options underneath. Setup general slider settings in 'Slider Settings' tab.",
						"id" => $shortname."_slider_magazine",
						"std" => "false",
						"type" => "checkbox");        
	
	$options[] = array( "name" => "Featured Slider Tag(s)",
						"desc" => "Add comma separated list for the tags that you would like to have displayed in the featured slider on your homepage. For example, if you add 'tag1, tag3' here, then all posts tagged with either 'tag1' or 'tag3' will be shown in the featured area. These posts will be excluded from normal posts below slider.",
						"id" => $shortname."_slider_magazine_tags",
						"std" => "",
						"type" => "text");
	
	$options[] = array(    "name" => "Featured Slider Entries",
						"desc" => "Select the number of entries that should appear in the Featured slider.",
						"id" => $shortname."_slider_magazine_entries",
						"std" => "3",
						"type" => "select",
						"options" => $other_entries);
	
	$options[] = array( "name" => "Featured Slider Exclude Posts",
						"desc" => "Exclude the slider posts from posts below slider.",
						"id" => $shortname."_slider_magazine_exclude",
						"std" => "true",
						"type" => "checkbox");        

	$options[] = array( "name" => "Featured Slider Title",
						"desc" => "Show the post title in slider.",
						"id" => $shortname."_slider_magazine_title",
						"std" => "true",
						"type" => "checkbox");  
	
	$options[] = array( "name" => "Featured Slider Title Font Style",
						"desc" => "Select the typography you want for your title. <br />* non web-safe font.",
						"id" => $shortname."_slider_magazine_font_title",
						"std" => array('size' => '24','unit' => 'px', 'face' => 'Arial, sans-serif','style' => 'bold','color' => '#ffffff'),
						"type" => "typography");  
	
	$options[] = array( "name" => "Featured Slider Excerpt",
						"desc" => "Show the post excerpt in slider.",
						"id" => $shortname."_slider_magazine_excerpt",
						"std" => "true",
						"type" => "checkbox"); 
	
	$options[] = array( "name" => "Featured Slider Excerpt Font Style",
						"desc" => "Select the typography you want for your excerpt text. <br />* non web-safe font.",
						"id" => $shortname."_slider_magazine_font_excerpt",
						"std" => array('size' => '12','unit' => 'px', 'face' => 'Arial, sans-serif','style' => 'normal','color' => '#cccccc'),
						"type" => "typography");  
	
	$options[] = array( "name" => "Featured Slider Excerpt Length",
						"desc" => "Total number of words to show in the slider excerpt",
						"id" => $shortname."_slider_magazine_excerpt_length",
						"std" => "15",
						"type" => "text");        
	
	$options[] = array( "name" => "Featured Slider Height",
						"desc" => "Set a manual height for the slider e.g. 250. Default height is 300px.",
						"id" => $shortname."_slider_magazine_height",
						"std" => "",
						"type" => "text"); 

// Template: Business

	$options[] = array( "name" => "Business Template",
						"icon" => "layout",
	
						"type" => "heading");
	
	$options[] = array( "name" => "Featured Slider",
						"desc" => "Enable the featured slider. Add posts with the <strong><em>Slides</em></strong> custom post type. Setup template specific options underneath. Setup general slider settings in 'Slider Settings' tab.",
						"id" => $shortname."_slider_biz",
						"std" => "false",
						"type" => "checkbox");        
	
	$options[] = array( "name" => "Featured Slider Posts",
						"desc" => "Select how many slide posts you would like to show in the slider.",
						"id" => $shortname."_slider_biz_number",
						"std" => "10",
						"type" => "select",
						"options" => $other_entries);

$options[] = array( "name" => "Features Slider Posts Order",
					"desc" => "Select the order in which you want to show your slider posts. ",
					"id" => $shortname."_slider_biz_order",
					"type" => "select2",
					"std" => "DESC",
					"options" => array("DESC" => "Newest posts first", "ASC" => "Oldest posts first" ) );                                                          

	$options[] = array( "name" => "Featured Slider Title",
						"desc" => "Show the page title in slider <strong>(ONLY when using image as background uploaded through Custom Settings panel)</strong>.",
						"id" => $shortname."_slider_biz_title",
						"std" => "true",
						"type" => "checkbox");  
	
	$options[] = array( "name" => "Featured Slider Title Font Style",
						"desc" => "Select the typography you want for your title (when using image background). <br />* non web-safe font.",
						"id" => $shortname."_slider_biz_font_title",
						"std" => array('size' => '24','unit' => 'px', 'face' => 'Arial, sans-serif','style' => 'bold','color' => '#ffffff'),
						"type" => "typography");  
		
	$options[] = array( "name" => "Featured Slider Content Font Style",
						"desc" => "Select the typography you want for your content text (when using image background). <br />* non web-safe font.",
						"id" => $shortname."_slider_biz_font_excerpt",
						"std" => array('size' => '12','unit' => 'px', 'face' => 'Arial, sans-serif','style' => 'normal','color' => '#cccccc'),
						"type" => "typography");  
	
	$options[] = array( "name" => "Featured Slider Height",
						"desc" => "Set a manual height for the slider e.g. 250. Default height is 350px.",
						"id" => $shortname."_slider_biz_height",
						"std" => "",
						"type" => "text");       

	$options[] = array( "name" => "Disable Footer Widgets",
							"desc" => "Disable the footer widgets on this template.",
							"id" => $shortname."_biz_disable_footer_widgets",
							"std" => "true",
							"type" => "checkbox"); 

// Slider Settings

	$options[] = array( "name" => "Slider Settings",
						"icon" => "slider",
						"type" => "heading");
	
	$options[] = array(    "name" => "Auto Start",
						"desc" => "Set the slider to start sliding automatically. Adjust the speed of sliding underneath.",
						"id" => $shortname."_slider_auto",
						"std" => "true",
						"type" => "checkbox");   
	
	$options[] = array(    "name" => "Auto Height",
						"desc" => "Set the slider to adjust automatically depending on the height of the current slide contents.",
						"id" => $shortname."_slider_autoheight",
						"std" => "false",
						"type" => "checkbox");   

	$options[] = array(    "name" => "ContainerClick",
						"desc" => "Set the slider to slide on mouseclick in the slider container",
						"id" => $shortname."_slider_containerclick",
						"std" => "false",
						"type" => "checkbox");   

	$options[] = array(    "name" => "Animation Speed",
							"desc" => "The time in <b>seconds</b> the animation between frames will take e.g. 0.6",
							"id" => $shortname."_slider_speed",
							"std" => 0.6,
							"type" => "text");
						
	$options[] = array(    "name" => "Auto Slide Interval",
						"desc" => "The time in <b>seconds</b> each slide pauses for, before sliding to the next. Only when using Auto Start option above.",
						"id" => $shortname."_slider_interval",
						"std" => "4.0",
						"type" => "text"); 
						
//Tumblog Settings

	$options[] = array( "name" => "Tumblog Settings",
						"icon" => "tumblog",
						"type" => "heading");

	$options[] = array( "name" => "Enable Tumblog Functionality",
						"desc" => "This will allow you to publish content using the WooTumblog functionality, including the Express for WordPress iPhone App. If you would like to use the iPhone app, you will need to enable XML-RPC publishing under Settings->Writing. Find out more at <a href='http://express-app.com/' target='_blank'>Express-App.com</a>",
						"id" => $shortname."_woo_tumblog_switch",
						"std" => "false",
						"type" => "checkbox"); 
	
	$options[] = array( "name" => "Use Custom Tumblog RSS Feed",
						"desc" => "Replaces the default WordPress RSS feed output with Tumblog RSS output.",
						"id" => $shortname."_custom_rss",
						"std" => "true",
						"type" => "checkbox");
	
	$options[] = array( "name" => "Images Link to",
						"desc" => "Select where your Tumblog Images will link to when clicked.",
						"id" => $shortname."_image_link_to",
						"std" => "post",
						"type" => "radio",
						"options" => $options_image_link_to); 
	
	$options[] = array( "name" => "Tumblog Images Width",
						"desc" => "The output width for Tumblog image post images.",
						"id" => $shortname."_tumblog_image_width",
						"std" => "610",
						"type" => "text"); 
																								
	$options[] = array( "name" => "Tumblog Content Position: Images",
						"desc" => "Select where you would like the Tumblog Specific content to be output around the standard content.",
						"id" => $shortname."_woo_tumblog_images_content",
						"std" => "Before",
						"type" => "select",
						"options" => $tumblog_options);	
	
	$options[] = array( "name" => "Tumblog Audio Width",
						"desc" => "The output width for Tumblog Audio player.",
						"id" => $shortname."_tumblog_audio_width",
						"std" => "440",
						"type" => "text"); 
						
	$options[] = array( "name" => "Tumblog Content Position: Audio",
						"desc" => "Select where you would like the Tumblog Specific content to be output around the standard content.",
						"id" => $shortname."_woo_tumblog_audio_content",
						"std" => "Before",
						"type" => "select",
						"options" => $tumblog_options);	
	
	$options[] = array( "name" => "Tumblog Video Width",
						"desc" => "The output width for Tumblog Videos.",
						"id" => $shortname."_tumblog_video_width",
						"std" => "610",
						"type" => "text"); 
						
	$options[] = array( "name" => "Tumblog Content Position: Video",
						"desc" => "Select where you would like the Tumblog Specific content to be output around the standard content.",
						"id" => $shortname."_woo_tumblog_videos_content",
						"std" => "Before",
						"type" => "select",
						"options" => $tumblog_options);	
	
	$options[] = array( "name" => "Tumblog Content Position: Quotes",
						"desc" => "Select where you would like the Tumblog Specific content to be output around the standard content.",
						"id" => $shortname."_woo_tumblog_quotes_content",
						"std" => "Before",
						"type" => "select",
						"options" => $tumblog_options);	
																
						

// Add extra options through function
if ( function_exists("woo_options_add") )
	$options = woo_options_add($options);

if ( get_option('woo_template') != $options) update_option('woo_template',$options);      
if ( get_option('woo_themename') != $themename) update_option('woo_themename',$themename);   
if ( get_option('woo_shortname') != $shortname) update_option('woo_shortname',$shortname);
if ( get_option('woo_manual') != $manualurl) update_option('woo_manual',$manualurl);
                                                                  
// Woo Metabox Options
$woo_metaboxes = array();

if( get_post_type() == 'post' || !get_post_type()){

	$woo_metaboxes[] = array (	"name" => "image",
								"label" => "Image",
								"type" => "upload",
								"desc" => "Upload file here...");
	
	if ( get_option('woo_resize') == "true" ) {						
		$woo_metaboxes[] = array (	"name" => "_image_alignment",
									"std" => "Center",
									"label" => "Image Crop Alignment",
									"type" => "select2",
									"desc" => "Select crop alignment for resized image",
									"options" => array(	"c" => "Center",
														"t" => "Top",
														"b" => "Bottom",
														"l" => "Left",
														"r" => "Right"));
	}

	$url =  get_bloginfo('template_url') . '/functions/images/';
	$woo_metaboxes[] = array (	"name" => "layout",
								"label" => "Layout",
								"type" => "images",
								"desc" => "Select a specific layout for this post/page. Overrides default site layout.",
								"options" => array(	'' => $url . 'layout-off.png',
													'one-col' => $url . '1c.png',
													'two-col-left' => $url . '2cl.png',
													'two-col-right' => $url . '2cr.png',
													'three-col-left' => $url . '3cl.png',
													'three-col-middle' => $url . '3cm.png',
													'three-col-right' => $url . '3cr.png'));
	
	$woo_metaboxes[] = array (	"name" => "embed",
								"label" => "Embed",
								"type" => "textarea",
								"desc" => "Enter embed code for use on single posts and with the Video widget.");
	
	if (get_option('woo_woo_tumblog_switch') == 'true') {
	
		$woo_metaboxes[] = array (	"name" => "video-embed",
									"label" => "Tumblog : Embed Code (Videos)",
									"type" => "textarea",
									"desc" => "Add embed code for video services like Youtube or Vimeo - Tumblog only.");
		
    	$woo_metaboxes[] = array (	"name" => "quote-author",
									"std" => "Unknown",
									"label" => "Tumblog : Quote Author",
									"type" => "text",
									"desc" => "Enter the name of the Quote Author.");
								    
    	$woo_metaboxes[] = array (	"name" => "quote-url",
									"std" => "http://",
									"label" => "Tumblog : Link to Quote",
									"type" => "text",
									"desc" => "Enter the url/web address of the Quote if available.");
								    
    	$woo_metaboxes[] = array (	"name" => "quote-copy",
    								"std"  => "Unknown",
									"label" => "Tumblog : Quote",
									"type" => "textarea",
									"desc" => "Enter the Quote.");
		
		$woo_metaboxes[] = array (	"name" => "audio",
									"std" => "http://",
									"label" => "Tumblog : Audio URL",
									"type" => "text",
									"desc" => "Enter the url/web address of the Audio file.");							    
    	 
    	$woo_metaboxes[] = array (	"name" => "link-url",
									"std" => "http://",
									"label" => "Tumblog : Link URL",
									"type" => "text",
									"desc" => "Enter the url/web address of the Link.");  
	
	}
							
} // End post

if( get_post_type() == 'slide' || !get_post_type()){

	$woo_metaboxes[] = array (	"name" => "image",
								"label" => "Image",
								"type" => "upload",
								"desc" => "Upload an image to be used as background of this slide. (optional) ");
	
	$woo_metaboxes[] = array (	"name" => "url",
								"label" => "URL",
								"type" => "text",
								"desc" => "Enter URL if you want to add a link to the uploaded image. (optional) ");
								
} // End slide

// Show layout option on all pages
if ( get_post_type() <> 'post' && get_post_type() <> 'slide') {

	$url =  get_bloginfo('template_url') . '/functions/images/';
	$woo_metaboxes[] = array (	"name" => "layout",
								"label" => "Layout",
								"type" => "images",
								"desc" => "Select a specific layout for this post/page. Overrides default site layout.",
								"options" => array(	'' => $url . 'layout-off.png',
													'one-col' => $url . '1c.png',
													'two-col-left' => $url . '2cl.png',
													'two-col-right' => $url . '2cr.png',
													'three-col-left' => $url . '3cl.png',
													'three-col-middle' => $url . '3cm.png',
													'three-col-right' => $url . '3cr.png'));

} 
							

// Add extra metaboxes through function
if ( function_exists("woo_metaboxes_add") )
	$woo_metaboxes = woo_metaboxes_add($woo_metaboxes);
	
if ( get_option('woo_custom_template') != $woo_metaboxes) update_option('woo_custom_template',$woo_metaboxes);    

}
}


?>