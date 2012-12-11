<?php
/*
Template Name: Blog
*/
?>
<?php get_header(); ?>
<?php global $woo_options; ?>

    <!-- #content Starts -->
	<?php woo_content_before(); ?>
    <div id="content" class="col-full">
    
		
    	<div id="main-sidebar-container">

            <!-- #main Starts -->
            <?php woo_main_before(); ?>
            <div id="main">      
                        
				<?php woo_loop_before(); ?>
            <?php 
				// WP 3.0 PAGED BUG FIX
				if ( get_query_var('paged') )
					$paged = get_query_var('paged');
				elseif ( get_query_var('page') ) 
					$paged = get_query_var('page');
				else 
					$paged = 1;
				//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
           		 
	             query_posts("paged=$paged"); 
	        ?>
            <?php if (have_posts()) : $count = 0; ?>
            <?php while (have_posts()) : the_post(); $count++; ?>
                                                                        
                <!-- Post Starts -->
                <?php woo_post_before(); ?>
                <div <?php post_class(); ?>>
    
                    <?php woo_post_inside_before(); ?>
    
                    <?php woo_image('width='.$woo_options['woo_thumb_w'].'&height='.$woo_options['woo_thumb_h'].'&class=thumbnail '.$woo_options['woo_thumb_align']); ?> 
                    
                    <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                    
                    <?php woo_post_meta(); ?>
                    
                    <div class="entry">
						<?php global $more; $more = 0; ?>	                                        
	                    <?php if ( $woo_options['woo_post_content'] == "content" ) the_content(__('Continue Reading &rarr;', 'woothemes')); else the_excerpt(); ?>
                    </div>
        
                    <?php woo_post_inside_after(); ?>
    
                </div><!-- /.post -->
                <?php woo_post_after(); ?>
                                                    
            <?php endwhile; else: ?>
                <div class="post">
                    <p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
                </div><!-- /.post -->
            <?php endif; ?>  
        
                <?php woo_pagenav(); ?>
                    
            </div><!-- /#main -->
            <?php woo_main_after(); ?>
    
            <?php get_sidebar(); ?>
            
		</div><!-- /#main-sidebar-container -->         

		<?php get_sidebar('alt'); ?>

    </div><!-- /#content -->
	<?php woo_content_after(); ?>
    
		
<?php get_footer(); ?>