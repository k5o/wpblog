	<?php global $woo_options; ?>
	<?php woo_footer_top(); ?>

	<?php if ( ( woo_active_sidebar('footer-1') ||
			   	 woo_active_sidebar('footer-2') || 
			     woo_active_sidebar('footer-3') || 
			     woo_active_sidebar('footer-4') ) && 
			    ( ( is_page_template('template-biz.php') && $woo_options['woo_biz_disable_footer_widgets'] <> "true" ) || !is_page_template('template-biz.php') ) ):
	
		$total = $woo_options['woo_footer_sidebars']; if (!$total) $total = 4;	
	?>
                                  
	<div id="footer-widgets" class="col-full col-<?php echo $total; ?>">

		<?php $i = 0; while ( $i < $total ) : $i++; ?>			
			<?php if ( woo_active_sidebar('footer-'.$i) ) { ?>

		<div class="block footer-widget-<?php echo $i; ?>">
        	<?php woo_sidebar('footer-'.$i); ?>    
		</div>
		        
	        <?php } ?>
		<?php endwhile; ?>
        		        
		<div class="fix"></div>

	</div><!-- /#footer-widgets  -->
    <?php endif; ?>
    
	<?php woo_footer_before(); ?>    

	<div id="footer" class="col-full">
	
		<?php woo_footer_inside(); ?>    
        
		<div id="copyright" class="col-left">
			<?php if($woo_options['woo_footer_left'] == 'true'){
				echo '<p>'.$woo_options['woo_footer_left_text'].'</p>';
			} else { 
			?>
			<p>&copy; <?php echo date('Y'); ?> <?php bloginfo(); ?>. <?php _e('All Rights Reserved.', 'woothemes') ?></p>
            <?php } ?>
		</div>
		
		<div id="credit" class="col-right">
			<?php if($woo_options['woo_footer_right'] == 'true'){
				echo '<p>'.$woo_options['woo_footer_right_text'].'</p>';
			} else { 
			?>
			<p><?php _e('Powered by', 'woothemes') ?> <a href="http://www.wordpress.org">WordPress</a>. <?php _e('Designed by', 'woothemes') ?> <a href="<?php if(!empty($woo_options['woo_footer_aff_link'])) { echo $woo_options['woo_footer_aff_link']; } else { echo 'http://www.woothemes.com'; } ?>"><img src="<?php bloginfo('template_directory'); ?>/images/woothemes.png" width="74" height="19" alt="Woo Themes" /></a></p>
            <?php } ?>
		</div>
		
	</div><!-- /#footer  -->

	<?php woo_footer_after(); ?>    
	
</div><!-- /#wrapper -->
<?php wp_footer(); ?>
<?php woo_foot(); ?>
</body>
</html>