<?php
/*
The main admin page for this plugin. The logic for different user input and form submittion is written here. 
*/

function google_plus_one_admin_menu() {
add_options_page('Google +1 Share', 'Google +1 Share', 'administrator',
'google-plus-one-share-button', 'google_plus_one_admin_page');
}

function google_plus_one_admin_page() {

	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}

	$update = false;

	if(isset($_POST['rp_gpo_submit']) && $_POST['rp_gpo_submit'] === "true"){
		update_option('rp_gpo_button_size', $_POST['button_size']);
		
		if($_POST['include_count'] === 'true'){
			$include_count = 'true';
		}else{
			$include_count = 'false';
		}
		if($_POST['script_load'] === 'true'){
			$script_load = 'true';
		}else{
			$script_load = 'false';
		}
		
		update_option('rp_gpo_include_count', $include_count);
		update_option('rp_gpo_button_location', $_POST['button_location']);
		update_option('rp_gpo_script_load', $script_load);
		update_option('rp_gpo_top_space', $_POST['top_space']);
		update_option('rp_gpo_left_space', $_POST['left_space']);
		update_option('rp_gpo_position', $_POST['position']);
		
		$update = true;
	}
?>

<?php wp_enqueue_script( 'jquery' ); 
	  ?>

<style>
	.wrap{
		margin-top: 40px;
	}
	
	.wrap p {
		margin-bottom: 30px;
	}
	
	#update_results{
		border: 1px solid;
		background:#CCCCCC;
		color:#333333;
		text-align: center;
		font-size: 20px;
		margin-bottom: 30px;
		padding-top: 5px;
		height: 25px;
		width: 675px;
	
	}

	#options_form{
		float: left;
		width: 400px;
	}
	
	#paypal_style{
		float: left;
		width: 150px;
		text-align:justify;
		
	}
	
	#preview_wrapper{
		float: left;
	}
	
	#preview_label {
		text-align: center;
		height: 20px;
		font-size: 20px;
		padding-top: 5px;
		
	}
	
	#preview_area {
		width: 120px;
		height: 100px;
		padding-left:10px;
		position:relative;
	}
	
	#preview_container{
		position: absolute;
	}
	
	#manual_instructions{
	
		margin-bottom: 30px;
	
	}
	
	#button_style{
		width: 320px;
	}
	
	
	.option_label{
		float: left;
		text-align: left;
		width: 105px;
		margin: 0 10px 20px 0;
	}
	
	.style_label{
		width: 50px;
	}
	.style_space{
		width: 100px;
	}
	.option_element{
		float: left;
		margin-bottom: 20px;
	}
	
	.clear{
		clear: both;
	}

</style>

<div class="wrap">

<?php if($update){ ?>
	<div id="update_results">
		Changes Saved!
	</div>
<?php } ?>
<h2>Google +1 (Plus One) Share Plugin</h2>
	<div id="options_form">
		<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
		<input type="hidden" name="rp_gpo_submit" value="true"> 
		<div class="option_label">
			Button Size:
		</div>
		<div class="option_element">
			<select name="button_size" id="button_size">
				<option value="standard">Standard</option>
				<option value="small">Small</option>
				<option value="medium">Medium</option>
				<option value="tall">Tall</option>
			</select>
		</div>
		<div class="clear"></div>
		
		<div class="option_label">
			Include Count:
		</div>
		<div class="option_element">
			<input type="checkbox" name="include_count" id="include_count" value="true" />
		</div>
		<div class="clear"></div>

		<div class="option_label">	
			Button Location:
		</div>
		<div class="option_element">
			<select name="button_location" id="button_location">
				<option value="top">Top of Post</option>
				<option value="bottom">Bottom of Post</option>
				<option value="both">Top and Bottom</option>
				<option value="left">Floating Left Side</option>
				<option value="manual">Manual</option>
			</select>
		</div>
		<div class="clear"></div>
		<div id="manual_instructions" style="display: none;">Include <?php highlight_string('<?php rp_gpo_share(); ?>'); ?> in your template where you'd like the button to appear.</div>
		<div class="clear"></div>
		<div class="option_label">
			Load JavaScript in Footer: 
		</div>
		<div class="option_element">
			<input type="checkbox" name="script_load" id="script_load" value="true" />
		</div>
		<div class="clear"></div>
		<h2>Left Side Floating specific Settings</h2>
		<div class="option_label style_space">
			Top Spacing: 
		</div>
		<div class="option_element">
			<input type="text" name="top_space" id="top_space"/><br />
			Specify the top spacing for the button. <br />E.g. <?php highlight_string('60%'); ?>
		</div>
		<div class="clear"></div>
		<div class="option_label style_space">
			Left Spacing: 
		</div>
		<div class="option_element">
			<input type="text" name="left_space" id="left_space" /><br />
			Specify the left spacing for the button. <br />E.g. <?php highlight_string('70px'); ?>
		</div>
		<div class="clear"></div>
		<div class="option_label">	
			Button Position:
		</div>
		<div class="option_element">
			<select name="position" id="position">
				<option value="fixed">Fixed</option>
				<option value="absolute">Absolute</option>
			</select>
		</div>
		<div class="clear"></div>
		  
		<div><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></div>
		</form>		
	</div>
	
	<div id="preview_wrapper">

		<div id="preview_area">
			<div id="preview_container"></div>
		</div>

	
	<div id="paypal_style">
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="MRTE2A5M7JKUG">
	<table>
	<tr><td><input type="hidden" name="on0" value="Help The Developer">Plugin enhancement and maintenance do cost, Please help by donating to keep the project going</td></tr><tr><td align="center"><select name="os0">
	<option value="Donate">Donate $5.00</option>
	<option value="Donate">Donate $10.00</option>
	<option value="Donate">Donate $15.00</option>
	</select> </td></tr>
	</table>
	<input type="hidden" name="currency_code" value="USD">
	<input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
	<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
	</form>
	</div>
	</div>
	<div class="clear"></div>
</div>

<script>

	jQuery(document).ready(function() {
		set_form();
		render_plus_one();
	
		// on location change
		jQuery('#button_location').change(function() {
	  		var location = jQuery("#button_location option:selected").val();
	  		
	  		if(location == "manual"){
	  			jQuery("#manual_instructions").show();
	  		}else{
	  		  	jQuery("#manual_instructions").hide();
	  		}
		});
		
		jQuery('#button_size').change(function() {
			render_plus_one();
		});
		
		jQuery('#include_count').change(function() {
			render_plus_one();
		});
		<?php if($update) { ?>
			setTimeout(fadeSuccess, 5000);
		<?php } ?>
	});
	
	function render_plus_one() {
	
		var button_size 	= jQuery("#button_size option:selected").val();
		
		if(jQuery("#include_count ").is(':checked')){
	  		var include_count = 'true';
	  	}else{
	  		var include_count = 'false';	  	
	  	}
		
        gapi.plusone.render("preview_container", {"size": button_size, "count": include_count});
        var height = jQuery("#preview_container").height();
        var width = jQuery("#preview_container").width();
        
        if(height == 0){
        	height 	= 24;
        	width	= 38;
        }
        
        var left 	= (270 - width) / 2;
		var top 	= (150 - height) /2;
		
		jQuery("#preview_container").css("left", left+'px');
		jQuery("#preview_container").css("top", top+'px');
		
		//console.log('Left: '+left);
		//console.log('Top: '+top);
        
       	//console.log(height+' '+width);
	}
	
	function set_form(){
		var button_size 	= '<?php echo get_option('rp_gpo_button_size'); ?>';
		var include_count 	= '<?php echo get_option('rp_gpo_include_count'); ?>';
		var button_location = '<?php echo get_option('rp_gpo_button_location'); ?>';
		var script_load 	= '<?php echo get_option('rp_gpo_script_load'); ?>';
		var top_space	 	= '<?php echo get_option('rp_gpo_top_space'); ?>';
		var left_space	 	= '<?php echo get_option('rp_gpo_left_space'); ?>';
		var position		= '<?php echo get_option('rp_gpo_position'); ?>';
		
		jQuery("#button_size").val(button_size);
		if(include_count == 'true'){
			jQuery("#include_count ").attr('checked', true);
		}
		if(script_load == 'true'){
			jQuery("#script_load ").attr('checked', true);
		}
		if(top_space == ''){
			jQuery("#top_space").val('60%');
		} else {
			jQuery("#top_space").val(top_space);
		}
		if(left_space == ''){
			jQuery("#left_space").val('70px');
		} else {
			jQuery("#left_space").val(left_space);		
		}
		jQuery("#button_location").val(button_location);
		jQuery("#position").val(position);


		
		
	}
	
	function fadeSuccess(){
		jQuery('#update_results').fadeOut('slow');
	}
	
</script>
<?php } ?>
