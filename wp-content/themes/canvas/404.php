<?php get_header(); ?>

    <!-- #content Starts -->
	<?php woo_content_before(); ?>
    <div id="content" class="col-full">
		
    	<div id="main-sidebar-container">

            <!-- #main Starts -->
            <?php woo_main_before(); ?>
            <div id="main" class="col-left">
                                                                                   
				<?php woo_loop_before(); ?>

                <!-- Post Starts -->
                <?php woo_post_before(); ?>
                <div class="post">
    
                    <?php woo_post_inside_before(); ?>
                    
                    <h2 class="title"><?php _e('Error 404 - Page not found!', 'woothemes') ?></h2>
                    
                    <div class="entry">
                        <p><?php _e('The page you are trying to reach does not exist, or has been moved. Please use the menus or the search box to find what you are looking for.', 'woothemes') ?></p>
                    </div><!-- /.entry -->
    
                    <?php woo_post_inside_after(); ?>
    
                </div><!-- /.post -->
                <?php woo_post_after(); ?>
    
            </div><!-- /#main -->
            <?php woo_main_after(); ?>
    
            <?php get_sidebar(); ?>

		</div><!-- /#main-sidebar-container -->         

		<?php get_sidebar('alt'); ?>
        
    </div><!-- /#content -->
	<?php woo_content_after(); ?>
		
<?php get_footer(); ?>