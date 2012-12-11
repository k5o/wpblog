<?PHP
/*
Plugin Name: Open in New Window Plugin
Plugin URI: http://www.BlogsEye.com/
Description: Opens external links in a new window, keeping your blog page in the browser so you don't lose surfers to another site.
Version: 1.9
Author: Keith P. Graham
Author URI: http://www.BlogsEye.com/

This software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/


/************************************************************
* 	kpg_open_in_new_window_fixup()
*	Shows the javascript in the footer so that the links can be adjusted
*
*************************************************************/
function kpg_open_in_new_window_fixup() {
	// this is the open in new window functionality.
	
	// we've added more than one place to put this because some templates seem to totally ignore the call to wp_footer.
	// just check the cache to see if we have done anything with it.
	$sema=wp_cache_get('kpg_plf');
	if (!empty($sema)) return;
	wp_cache_set('kpg_plf','Been there, done that');
	
?>
<script language="javascript" type="text/javascript">
	// <!--
	/* <![CDATA[ */
	// open-in-new-window-plugin
	function kpg_oinw_action(event) {
		try {
			var b=document.getElementsByTagName("a");
			var ksrv='<?php echo $_SERVER['HTTP_HOST']; ?>';
			ksrv=ksrv.toLowerCase();
			for (var i = 0; i < b.length; i++) {
				// IE 6 bug - the anchor might not be a link and might not support hostname
				if (b[i] && b[i].href) {
					if (!(b[i].title)) {
						var ih=b[i].innerHTML;
						if (ih.indexOf('<img')==-1) { // check for img tag
							b[i].title=kpgremoveHTMLTags(b[i].innerHTML);
						}
					}
					var khref=b[i].href;
					khref=khref.toLowerCase();
					if ( b[i].target==null || b[i].target=='')  {
						if ( 
							khref.indexOf('http://')!=-1 ||
							khref.indexOf('https://')!=-1 ||
							khref.indexOf('ftp://')!=-1
						) {
							// check to see if target is on this domain.
							if (b[i].hostname && location.hostname) {
								if (b[i].hostname.toLowerCase() != location.hostname.toLowerCase()) {
									b[i].target="_blank";
								}
							} else {
								if (khref.indexOf(ksrv)==-1) { 					
									b[i].target="_blank";
								}
							}
						}
					}
				}
				// http:, https:, and ftp: open in new windwo
			}
		} catch (ee) {}
	}
	// set the onload event
	if (document.addEventListener) {
		document.addEventListener("DOMContentLoaded", function(event) { kpg_oinw_action(event); }, false);
	} else if (window.attachEvent) {
		window.attachEvent("onload", function(event) { kpg_oinw_action(event); });
	} else {
		var oldFunc = window.onload;
		window.onload = function() {
			if (oldFunc) {
				oldFunc();
			}
				kpg_oinw_action('load');
			};
	}
	function kpgremoveHTMLTags(ihtml){
		try {
			ihtml = ihtml.replace(/&(lt|gt);/g, function (strMatch, p1){
				return (p1 == "lt")? "<" : ">";
			});
			return ihtml.replace(/<\/?[^>]+(>|$)/g, "");
		} catch (eee) {
			return '';
		}
 	}	
	/* ]]> */
	// -->
</script>

<?php
}
function kpg_open_in_new_window_control()  {
// this is the display of information about the page.
	$bname=urlencode(get_bloginfo('name'));
	$burl=urlencode(home_url());
	$bdesc=urlencode(get_bloginfo('description'));

?>

<div class="wrap">
<h2>Open in new window Plugin</h2>
<h4>The Open in new window Plugin is installed and working correctly.</h4>
<p>This plugin installs some javascript in the footer of every page. When your page finishes loading, the javascript steps through the links on the page looking for links that lead to other domains. It alters these links so that they will open in a new window.</p>
<p>The javascript does not look in any embedded iframes, so it will not work with some ads and affiliate links. It will also not work where other javascript is executed through an onclick event or the link begins with javascript:</p>
<p>There are no configurations options. The plugin is on when it is installed and enabled. To turn it off just disable the plugin from the plugin menu.. </p>
<p>Since the javascript does not run until the web page is completely loaded, links on a page that is slow to load will not open in a new window until the page is fully loaded.</p>

 <hr/>
  <p>This plugin is free and I expect nothing in return. If you would like to support my programmin, you can buy my book of short stories.<br/>
<a targe="_blank" href="http://www.amazon.com/gp/product/1456336584?ie=UTF8&tag=thenewjt30page&linkCode=as2&camp=1789&creative=390957&creativeASIN=1456336584">Error Message Eyes: A Programmer's Guide to the Digital Soul</a></p>
<p>A link on your blog to one of my personal sites would be appreciated.</p>
  <p><a target="_blank" href="http://www.WestNyackHoney.com">West Nyack Honey</a> (I keep bees and sell the honey)<br />
   <a target="_blank" href="http://www.cthreepo.com/blog">Wandering Blog </a> (My personal Blog) <br />
    <a target="_blank"  href="http://www.cthreepo.com">Resources for Science Fiction</a> (Writing Science Fiction) <br />
    <a target="_blank"  href="http://www.jt30.com">The JT30 Page</a> (Amplified Blues Harmonica) <br />
    <a target="_blank"  href="http://www.harpamps.com">Harp Amps</a> (Vacuum Tube Amplifiers for Blues) <br />
    <a target="_blank"  href="http://www.blogseye.com">Blog&apos;s Eye</a> (PHP coding) <br />
    <a target="_blank"  href="http://www.cthreepo.com/bees">Bee Progress Beekeeping Blog</a> (My adventures as a new beekeeper) </p>
</div>


<form method="post" action="options.php">
<?php settings_fields( 'myoption-group' ); ?>

</form>
<?php
}
// no unistall because I have not created any meta data to delete.
function kpg_open_in_new_window_init() {
   add_options_page('Open in new window', 'Open in new window', 'manage_options',__FILE__,'kpg_open_in_new_window_control');
}
  // Plugin added to Wordpress plugin architecture
	add_action('admin_menu', 'kpg_open_in_new_window_init');	
	add_action( 'wp_footer', 'kpg_open_in_new_window_fixup' );
	add_action( 'admin_footer', 'kpg_open_in_new_window_fixup' );
	add_action( 'get_footer', 'kpg_open_in_new_window_fixup' );

 	
?>