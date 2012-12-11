<?php
/*
Template Name: Business
*/
?>
<?php get_header(); ?>
<?php global $woo_options; ?>

    <!-- #content Starts -->
	<?php woo_content_before(); ?>
    <div id="content" class="col-full business">
    
    	<div id="main-sidebar-container">

			<?php if ( $woo_options['woo_slider_biz'] == "true" ) { $saved = $wp_query; woo_slider_biz(); $wp_query = $saved; } ?>
            
            <!-- #main Starts -->
            <?php woo_main_before(); ?>
            <div id="main">      
                        
				<?php woo_loop_before(); ?>
                
                <?php if (have_posts()) : $count = 0; ?>
                <?php while (have_posts()) : the_post(); $count++; ?>
                                                                            
                 <!-- Post Starts -->
                <?php woo_post_before(); ?>
                <div <?php post_class(); ?>>
                
                    <?php woo_post_inside_before(); ?>
                   
                    <div class="entry">
                        <?php the_content(); ?>
                    </div><!-- /.entry -->
                
                    <?php edit_post_link( __('{ Edit }', 'woothemes'), '<span class="small">', '</span>' ); ?>
                    
                    <?php woo_post_inside_after(); ?>
    
                </div><!-- /.post -->
                <?php woo_post_after(); ?>
                                                                    
            <?php endwhile; else: ?>
                <div class="post">
                    <p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
                </div><!-- /.post -->
            <?php endif; ?>  
            
				<?php woo_loop_after(); ?>
                    
            </div><!-- /#main -->
            <?php woo_main_after(); ?>
    
			<?php woo_sidebar_before(); ?>
            <div id="sidebar">
            
                <?php woo_sidebar_inside_before(); ?>
				<?php get_sidebar(); ?>
                <?php woo_sidebar_inside_after(); ?>
            
            </div><!-- /#sidebar -->
            <?php woo_sidebar_after(); ?>
            
		</div><!-- /#main-sidebar-container -->         

    </div><!-- /#content -->
	<?php woo_content_after(); ?>
    
<?php get_footer(); ?>