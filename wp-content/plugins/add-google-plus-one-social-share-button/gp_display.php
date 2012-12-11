<?php 
/*
Core logic to display social share icons at the required positions. 
*/


function google_plus_one_share_init() {
	// DISABLED IN THE ADMIN PAGES
	if (is_admin()) {
		return;
	}
	$script_load = get_option('rp_gpo_script_load');
	wp_enqueue_script('twitter_facebook_share_google', 'http://apis.google.com/js/plusone.js','','',$script_load);
	
}    


function google_plus_one_contents($content)
{
  global $single;
  $output = rp_social_share();
  if (is_single()) {
  		$position = get_option('rp_gpo_button_location');
		if ($position == 'top')
        	return  $output . $content;
		if ($position == 'bottom')
			return  $content . $output;
		if ($position == 'left')
			return  $output . $content;
		if ($position == 'both')
			return  $output . $content . $output;
    } else {
        return $content;
    }
}

// Function to manually display related posts.
function rp_gpo_share()
{
 $output = rp_social_share();
 echo $output;
}



function rp_social_share()
{
	//GET ARRAY OF STORED VALUES
		$button_size 	=  get_option('rp_gpo_button_size');
		$include_count 	=  get_option('rp_gpo_include_count');
		$button_location = get_option('rp_gpo_button_location');
		$button_style 	=  get_option('rp_gpo_button_style');
		$script_load 	=  get_option('rp_gpo_script_load');
		$top_space		=  get_option('rp_gpo_top_space');
		$left_space		=  get_option('rp_gpo_left_space');
		$position		=  get_option('rp_gpo_position');
		
	if ($left_space == '')
		$left_space = '70px';
	if ($top_space == '')
		$top_space = '60%';
	if ($button_size == 'tall')
		$height = '60px';
	else
		$height = '30px';
?>
<style type="text/css">
#leftcontainerBox {
float:left;
position: <?php echo $position; ?>;
top: <?php echo $top_space; ?>;
left: <?php echo $left_space; ?>;
}

#leftcontainerBox .buttons {
float:left;
clear:both;
margin:4px 4px 4px 4px;

padding-bottom:2px;
}


#bottomcontainerBox {
height: <?php echo $height; ?>;
width:50%;
padding-top:1px;
}

#bottomcontainerBox .buttons {
float:left;
height: <?php echo $height; ?>;
margin:4px 4px 4px 4px;
}

</style>
<?php
 	
	if ($button_location == 'left'){
		$output = '<div id="leftcontainerBox">';
				
		$output .= '
			<div class="buttons">
			<g:plusone size="tall" count="'.$include_count.'"></g:plusone>
			</div>';
						
		$output .= '</div><div style="clear:both"></div>';
		return $output;
	}

		
	if (($button_location == 'top') || ($button_location == 'bottom') || ($button_location == 'both'))
	{
		$output = '<div id="bottomcontainerBox">';
		
		$output .= '
			<div class="buttons">
			<script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script>
			<g:plusone size="'.$button_size.'" count="'.$include_count.'"></g:plusone>
			</div>';
		
		$output .= '</div><div style="clear:both"></div><div style="padding-bottom:2px;"></div>';
			
		return $output;
	}
}
?>