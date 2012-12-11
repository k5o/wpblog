<?php 
	global $woo_options;
	if ( $woo_options['woo_layout'] == "three-col-left" ||
		 $woo_options['woo_layout'] == "three-col-middle" ||
		 $woo_options['woo_layout'] == "three-col-right" ) :
?>	
				   
<div id="sidebar-alt">

	<?php 
	if ( woo_active_sidebar('secondary') ) 
		woo_sidebar('secondary'); 
	?>		           
  
</div><!-- /#sidebar-alt -->

<?php endif; ?>