<?php 
	global $woo_options;
	if ( $woo_options['woo_layout'] <> "one-col" ) :
?>	

<?php woo_sidebar_before(); ?>
<div id="sidebar">

	<?php woo_sidebar_inside_before(); ?>
	
	<?php 
	if ( woo_active_sidebar('primary') ) 
		woo_sidebar('primary');
	?>
	
	<?php woo_sidebar_inside_after(); ?>

</div><!-- /#sidebar -->
<?php woo_sidebar_after(); ?>

<?php endif; ?>
