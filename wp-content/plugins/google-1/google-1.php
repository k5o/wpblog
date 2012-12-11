<?php
/*
Plugin Name:  Google +1 Button
Plugin URI:   http://pleer.co.uk/wordpress/plugins/google-1-button/
Description:  Full Google +1 button moderation and management for your WordPress site. Quick and easy to set up. Insert automatically or via a shortcode. Lots of options and compliant to March 2011 update.
Version:      0.1.1
Author:       Alex Moss
Author URI:   http://alex-moss.co.uk/
Contributors: pleer

Copyright (C) 2010-2010, Alex Moss
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
Neither the name of Alex Moss or pleer nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.
THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

*/

if ( is_admin() && ( !defined( 'DOING_AJAX' ) || !DOING_AJAX )) {
	add_action('admin_menu', 'show_google1_options');
function show_google1_options() {
    // Add a new submenu
   // add_options_page('Google +1 Options', 'Google +1', 8, 'google1', 'google1_options');
add_options_page('Google +1 Options', 'Google +1', 'manage_options', 'google1', 'google1_options');

	//Add options
	add_option('google1_size', 'standard');
	add_option('google1_lang', 'en-US');
	add_option('google1_count', 'on');
	add_option('google1_callback', '');
	add_option('google1_posts', 'on');
	add_option('google1_pages', 'off');
	add_option('google1_homepage', 'off');
	add_option('google1_js', 'on');
}

//
// Admin page HTML //
//
function google1_options() { ?>
<style type="text/css">
div.headerWrap { background-color:#e4f2fds; width:200px}
#options h3 { padding:7px; padding-top:10px; margin:0px; cursor:auto }
#options label { width: 300px; float: left; margin-left: 10px; }
#options input { float: left; margin-left:10px}
#options p { clear: both; padding-bottom:10px; }
#options .postbox { margin:0px 0px 10px 0px; padding:0px; }
</style>
<div class="wrap">
<form method="post" action="options.php" id="options">
<?php wp_nonce_field('update-options') ?>
<h2>Google +1 Options</h2>

<div class="postbox-container" style="width:100%;">
	<div class="metabox-holder">
	<div class="postbox">
		<h3 class="hndle"><span>Resources</span></h3>
		<div style="margin:20px;">
			<div style="width:180px; text-align:center; float:right; font-size:10px; font-weight:bold">
				<a href="http://pleer.co.uk/go/twitter-paypal/">
				<img src="https://www.paypal.com/en_GB/i/btn/btn_donateCC_LG.gif" border="0" style="padding-bottom:10px" /></a>
			</div>
	<a href="http://www.google.com/webmasters/+1/button/index.html" style="text-decoration:none" target="_blank">Google +1 Homepage</a><br /><br />
	<a href="http://pleer.co.uk/wordpress/plugins/google-1-button/" style="text-decoration:none" target="_blank">Plugin Homepage</a> <small>- More information on this plugin</small><br /><br />
	<a href="http://pleer.co.uk/wordpress/plugins/" style="text-decoration:none" target="_blank">WordPress Plugins</a> <small>- I have developed other plugins including a <a href="http://pleer.co.uk/wordpress/plugins/wp-twitter-feed/" style="text-decoration:none" target="_blank">Twitter Feed</a> and <a href="http://pleer.co.uk/wordpress/plugins/facebook-comments/" style="text-decoration:none" target="_blank">Facebook Comments</a>!</small><br /><br />

		</div>
	</div>
	</div>


	<div class="metabox-holder">
	<div class="postbox">
		<h3 class="hndle"><span>Settings</span></h3>
		<div style="margin:20px;">
		<p>
			<?php
				if (get_option('google1_js') == 'on') {echo '<input type="checkbox" name="google1_js" checked="yes" />';}
				else {echo '<input type="checkbox" name="google1_js" />';}
			?>
			<label>Enable JS</label><small>only disable this if you already have Google's script called elsewhere</small>
		</p>

					<p>
						<?php
							if (get_option('google1_count') == 'on') {echo '<input type="checkbox" name="google1_count" checked="yes" />';}
							else {echo '<input type="checkbox" name="google1_count" />';}
						?>
						<label>Show +1 count in the button</label>
		</p>
<br />
			<p><label>Size</label>

			    <select name="google1_size">
			                  <option value="standard" <?php if (get_option('google1_size') == 'standard') { echo "selected=\"selected\""; } ?>>
			                    Standard
			                  </option>
			                  <option value="small" <?php if (get_option('google1_size') == 'small') { echo "selected=\"selected\""; } ?>>
			                    Small
			                  </option>
			                  <option value="medium" <?php if (get_option('google1_size') == 'medium') { echo "selected=\"selected\""; } ?>>
			                    Medium
			                  </option>
			                  <option value="tall" <?php if (get_option('google1_size') == 'tall') { echo "selected=\"selected\""; } ?>>
			                    Tall
			                  </option>
		                </select>
            </p>

	<p><label>Language</label>

	    <select name="google1_lang">
	                  <option value="ar" <?php if (get_option('google1_lang') == 'ar') { echo "selected=\"selected\""; } ?>>
	                    Arabic
	                  </option>
	                  <option value="bg" <?php if (get_option('google1_lang') == 'bg') { echo "selected=\"selected\""; } ?>>
	                    Bulgarian
	                  </option>
	                  <option value="ca" <?php if (get_option('google1_lang') == 'ca') { echo "selected=\"selected\""; } ?>>
	                    Catalan
	                  </option>
	                  <option value="zh-CN" <?php if (get_option('google1_lang') == 'zn-CH') { echo "selected=\"selected\""; } ?>>
	                    Chinese (Simplified)
	                  </option>
	                  <option value="zh-TW" <?php if (get_option('google1_lang') == 'zh-TW') { echo "selected=\"selected\""; } ?>>
	                    Chinese (Traditional)
	                  </option>
	                  <option value="hr" <?php if (get_option('google1_lang') == 'hr') { echo "selected=\"selected\""; } ?>>
	                    Croatian
	                  </option>
	                  <option value="cs" <?php if (get_option('google1_lang') == 'cs') { echo "selected=\"selected\""; } ?>>
	                    Czech
	                  </option>
	                  <option value="da" <?php if (get_option('google1_lang') == 'da') { echo "selected=\"selected\""; } ?>>
	                    Danish
	                  </option>
	                  <option value="nl" <?php if (get_option('google1_lang') == 'nl') { echo "selected=\"selected\""; } ?>>
	                    Dutch
	                  </option>
	                  <option value="en-US" <?php if (get_option('google1_lang') == 'en-US') { echo "selected=\"selected\""; } ?>>
	                    English (US)
	                  </option>
	                  <option value="en-GB" <?php if (get_option('google1_lang') == 'en-GB') { echo "selected=\"selected\""; } ?>>
	                    English (UK)
	                  </option>
	                  <option value="et" <?php if (get_option('google1_lang') == 'et') { echo "selected=\"selected\""; } ?>>
	                    Estonian
	                  </option>
	                  <option value="fil" <?php if (get_option('google1_lang') == 'fil') { echo "selected=\"selected\""; } ?>>
	                    Filipino
	                  </option>
	                  <option value="fi" <?php if (get_option('google1_lang') == 'fi') { echo "selected=\"selected\""; } ?>>
	                    Finnish
	                  </option>
	                  <option value="fr" <?php if (get_option('google1_lang') == 'fr') { echo "selected=\"selected\""; } ?>>
	                    French
	                  </option>
	                  <option value="de" <?php if (get_option('google1_lang') == 'de') { echo "selected=\"selected\""; } ?>>
	                    German
	                  </option>
	                  <option value="el" <?php if (get_option('google1_lang') == 'el') { echo "selected=\"selected\""; } ?>>
	                    Greek
	                  </option>
	                  <option value="iw" <?php if (get_option('google1_lang') == 'iw') { echo "selected=\"selected\""; } ?>>
	                    Hebrew
	                  </option>
	                  <option value="hi" <?php if (get_option('google1_lang') == 'hi') { echo "selected=\"selected\""; } ?>>
	                    Hindi
	                  </option>
	                  <option value="hu" <?php if (get_option('google1_lang') == 'hu') { echo "selected=\"selected\""; } ?>>
	                    Hungarian
	                  </option>
	                  <option value="id" <?php if (get_option('google1_lang') == 'id') { echo "selected=\"selected\""; } ?>>
	                    Indonesian
	                  </option>
	                  <option value="it" <?php if (get_option('google1_lang') == 'it') { echo "selected=\"selected\""; } ?>>
	                    Italian
	                  </option>
	                  <option value="ja" <?php if (get_option('google1_lang') == 'ja') { echo "selected=\"selected\""; } ?>>
	                    Japanese
	                  </option>
	                  <option value="ko" <?php if (get_option('google1_lang') == 'ko') { echo "selected=\"selected\""; } ?>>
	                    Korean
	                  </option>
	                  <option value="lv" <?php if (get_option('google1_lang') == 'lv') { echo "selected=\"selected\""; } ?>>
	                    Latvian
	                  </option>
	                  <option value="lt" <?php if (get_option('google1_lang') == 'lt') { echo "selected=\"selected\""; } ?>>
	                    Lithuanian
	                  </option>
	                  <option value="ms" <?php if (get_option('google1_lang') == 'ms') { echo "selected=\"selected\""; } ?>>
	                    Malay
	                  </option>
	                  <option value="no" <?php if (get_option('google1_lang') == 'no') { echo "selected=\"selected\""; } ?>>
	                    Norwegian
	                  </option>
	                  <option value="fa" <?php if (get_option('google1_lang') == 'fa') { echo "selected=\"selected\""; } ?>>
	                    Persian
	                  </option>
	                  <option value="pl" <?php if (get_option('google1_lang') == 'pl') { echo "selected=\"selected\""; } ?>>
	                    Polish
	                  </option>
	                  <option value="pt-BR" <?php if (get_option('google1_lang') == 'pt-BR') { echo "selected=\"selected\""; } ?>>
	                    Portuguese (Brazil)
	                  </option>
	                  <option value="pt-PT" <?php if (get_option('google1_lang') == 'pt-PT') { echo "selected=\"selected\""; } ?>>
	                    Portuguese (Portugal)
	                  </option>
	                  <option value="ro" <?php if (get_option('google1_lang') == 'ro') { echo "selected=\"selected\""; } ?>>
	                    Romanian
	                  </option>
	                  <option value="ru" <?php if (get_option('google1_lang') == 'ru') { echo "selected=\"selected\""; } ?>>
	                    Russian
	                  </option>
	                  <option value="sr" <?php if (get_option('google1_lang') == 'sr') { echo "selected=\"selected\""; } ?>>
	                    Serbian
	                  </option>
	                  <option value="sv" <?php if (get_option('google1_lang') == 'sv') { echo "selected=\"selected\""; } ?>>
	                    Swedish
	                  </option>
	                  <option value="sk" <?php if (get_option('google1_lang') == 'sk') { echo "selected=\"selected\""; } ?>>
	                    Slovak
	                  </option>
	                  <option value="sl" <?php if (get_option('google1_lang') == 'sl') { echo "selected=\"selected\""; } ?>>
	                    Slovenian
	                  </option>
	                  <option value="es" <?php if (get_option('google1_lang') == 'es') { echo "selected=\"selected\""; } ?>>
	                    Spanish
	                  </option>
	                  <option value="es-419" <?php if (get_option('google1_lang') == 'es-419') { echo "selected=\"selected\""; } ?>>
	                    Spanish (Latin America)
	                  </option>
	                  <option value="th" <?php if (get_option('google1_lang') == 'th') { echo "selected=\"selected\""; } ?>>
	                    Thai
	                  </option>
	                  <option value="tr" <?php if (get_option('google1_lang') == 'tr') { echo "selected=\"selected\""; } ?>>
	                    Turkish
	                  </option>
	                  <option value="uk" <?php if (get_option('google1_lang') == 'uk') { echo "selected=\"selected\""; } ?>>
	                    Ukrainian
	                  </option>
	                  <option value="vi" <?php if (get_option('google1_lang') == 'vi') { echo "selected=\"selected\""; } ?>>
	                    Vietnamese
	                  </option>
                </select>
            </p>
            	<p><label>Default JS callback Funtion</label> <input type="text" name="google1_callback" value="<?php echo get_option('google1_callback'); ?>" /> - default is empty</p>
			<p>
				<?php
					if (get_option('google1_posts') == 'on') {echo '<input type="checkbox" name="google1_posts" checked="yes" />';}
					else {echo '<input type="checkbox" name="google1_posts" />';}
				?>
				<label>Show comment box in posts</label>
		</p>
			<p>
				<?php
					if (get_option('google1_pages') == 'on') {echo '<input type="checkbox" name="google1_pages" checked="yes" />';}
					else {echo '<input type="checkbox" name="google1_pages" />';}
				?>
				<label>Show comment box in pages</label>
			</p>

			<p>
				<?php
					if (get_option('google1_homepage') == 'on') {echo '<input type="checkbox" name="google1_homepage" checked="yes" />';}
					else {echo '<input type="checkbox" name="google1_homepage" />';}
				?>
				<label>Show comment box on the homepage</label>
		</p>
</div></div>
</div>

	<div class="metabox-holder">
<div class="postbox">
<h3 class="hndle">Insert Manually via Shortcode</h3>
<div style="text-decoration:none; padding:10px">
<p>The settings above are for automatic insertion of the Google +1 button.</p>
<p>You can insert the button manually in any page or post or template by simply using the shortcode <strong>[google1]</strong>. To enter the shortcode directly into templates using PHP, enter <strong>echo do_shortcode('[google1]');</strong></p>
<p>You can also use the options below to override the the settings above.</p>
<ul>
<li><strong>url</strong> - leave blank for current URL</li>
<li><strong>size</strong> -  size of the button (standard, small, medium or tall)</li>
<li><strong>count</strong> - on/off</li>
<li><strong>callback</strong></li>
</ul>
<p>An example using these options is <strong>[google1 url="http://pleer.co.uk/wordpress/plugins/google-1-button/" count="off" callback="googlebutton"]</strong>
</p>

</div></div></div>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="google1_js,google1_size,google1_lang,google1_posts,google1_pages,google1_homepage,google1_count,google1_callback" />
<div class="submit"><input type="submit" class="button-primary" name="submit" value="Save Google +1 Settings"></div>

</form>
</div>

<?php }

// Add settings link on plugin page
function g1button_link($links) {
  $settings_link = '<a href="options-general.php?page=google1">Settings</a>';
  array_unshift($links, $settings_link);
  return $links;
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'g1button_link' );



}else {


//ADD GOOGLE +1 JS
function g1js() {
	if (get_option('google1_js') == 'on') { echo "<!-- Google +1 Button for WordPress http://pleer.co.uk/wordpress/plugins/google-1-button/ -->\n<script type=\"text/javascript\" src=\"http://apis.google.com/js/plusone.js\">";
		if (get_option('google1_lang') != 'en-US') { echo "\n{lang: '".get_option('google1_lang')."'}\n"; }

	echo "</script>\n";
	}
}
add_action('wp_head', 'g1js', 101);


//GOOGLE +1 BUTTON
function google1button($content) {
	if ((is_single() && get_option('google1_posts') == 'on') || (is_page() && get_option('google1_pages') == 'on') || ((is_home() || is_front_page()) && get_option('google1_homepage') == 'on')) {
    		$content .= "<!-- Google +1 for WordPress: http://pleer.co.uk/wordpress/plugins/google-1-button/ -->\n<g:plusone";
    		if (get_option('google1_size') != 'standard') {$content.= " size=\"".get_option('google1_size')."\" ";}
    		if (get_option('google1_count') != 'on') {$content.= " count=\"false\" ";}
    		if (get_option('google1_callback') != '') {$content.= " callback=\"".get_option('google1_callback')."\" ";}
    		$content .= " href=\"".get_permalink()."\"></g:plusone>";
  	}
  return $content;
}
add_filter ('the_content', 'google1button', 1);



function google1shortcode($g1atts) {
    extract(shortcode_atts(array(
		"count" => get_option('google1_count'),
		"url" => get_permalink(),
		"size" => get_option('google1_size'),
		"callback" => get_option('google1_callback'),
    ), $g1atts));
    $g1button = "<!-- Google +1 for WordPress: http://pleer.co.uk/wordpress/plugins/google-1-button/ -->\n<g:plusone";
    if ($size != 'standard') {$g1button.= " size=\"".$size."\"";}
    if ($count != 'on') {$g1button.= " count=\"false\"";}
    if ($callback != '') {$g1button.= " callback=\"".$callback."\"";}
    $g1button .= " href=\"".$url."\"></g:plusone>";
	return $g1button;
}

add_filter('widget_text', 'do_shortcode');
add_shortcode('google1', 'google1shortcode');
}
?>