<?php
/*-----------------------------------------------------------------------------------

- Loads all the .php files found in /includes/widgets/ directory

----------------------------------------------------------------------------------- */

include( TEMPLATEPATH . '/includes/widgets/widgets-woo-adspace.php' );
include( TEMPLATEPATH . '/includes/widgets/widgets-woo-blogauthor.php' );
include( TEMPLATEPATH . '/includes/widgets/widget-woo-embed.php' );
include( TEMPLATEPATH . '/includes/widgets/widgets-woo-flickr.php' );
include( TEMPLATEPATH . '/includes/widgets/widgets-woo-search.php' );
include( TEMPLATEPATH . '/includes/widgets/widget-woo-tabs.php' );
include( TEMPLATEPATH . '/includes/widgets/widgets-woo-twitter.php' );
	
	
/*---------------------------------------------------------------------------------*/
/* Deregister Default Widgets */
/*---------------------------------------------------------------------------------*/
function woo_deregister_widgets(){
    unregister_widget('WP_Widget_Search');         
}
add_action('widgets_init', 'woo_deregister_widgets');  


?>