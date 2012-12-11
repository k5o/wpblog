<?php
/*
Template Name: Magazine
*/
?>
<?php get_header(); ?>
<?php if (is_paged()) $is_paged = true; else $is_paged = false; ?>
<?php global $woo_options; ?>

    <!-- #content Starts -->
	<?php woo_content_before(); ?>
    <div id="content" class="col-full magazine">
    
    	<div id="main-sidebar-container">

            <!-- #main Starts -->
            <?php woo_main_before(); ?>
            <div id="main">      
                        
				<?php woo_loop_before(); ?>
             	<?php if ( $woo_options['woo_slider_magazine'] == "true" && !$is_paged) { if (get_option('woo_exclude')) update_option("woo_exclude", ""); woo_slider_magazine(); } ?>
                
			<?php  
				// Exclude stored duplicates 
				if ($woo_options['woo_slider_magazine_exclude'] == "true") $exclude = get_option('woo_exclude'); 
				// Exclude categories
				//$cat_exclude = array();
				$cats = explode(',',$woo_options['woo_magazine_exclude']); 
				foreach ($cats as $cat)
				   $cat_exclude[] = $cat;
				   			
				// WP 3.0 PAGED BUG FIX
				if ( get_query_var('paged') )
					$paged = get_query_var('paged');
				elseif ( get_query_var('page') ) 
					$paged = get_query_var('page');
				else 
					$paged = 1;
				//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
				$args = array( 'post__not_in' => $exclude, 
							   'category__not_in' => $cat_exclude,
							   'paged'=> $paged ); 
				query_posts($args);		
			?>
            <?php if (have_posts()) : $postcount = 0; $counter = 0; $counter2 = 0; ?>
            <?php while (have_posts()) : the_post(); $postcount++; ?>
            
                <!-- Featured Starts -->
                <?php if ( $postcount <= $woo_options['woo_magazine_feat_posts'] && !$is_paged ) { ?>           
                                                                        
                <!-- Post Starts -->
                <?php woo_post_before(); ?>
                <div <?php post_class(); ?>>
    
                    <?php woo_post_inside_before(); ?>
    
                    <?php woo_image('width='.$woo_options['woo_magazine_f_w'].'&height='.$woo_options['woo_magazine_f_h'].'&class=thumbnail '.$woo_options['woo_magazine_f_align']); ?> 
                    
                    <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                    
                    <?php woo_post_meta(); ?>
                    
                    <div class="entry">
                        <?php the_excerpt(); ?>
                    </div>
        
                    <?php woo_post_inside_after(); ?>
    
                </div><!-- /.post -->
                <?php woo_post_after(); ?>
                
				<?php continue; } ?>
                <!-- Featured Ends -->          
    
                <?php $counter++; $counter2++; ?>
    
                <div class="block<?php if ($counter > 1) { echo ' last'; $counter = 0; } ?>">

                    <!-- Post Starts -->
                    <?php woo_post_before(); ?>
                    <div <?php post_class(); ?>>
        
                        <?php woo_post_inside_before(); ?>
        
                        <?php woo_image('width='.$woo_options['woo_magazine_b_w'].'&height='.$woo_options['woo_magazine_b_h'].'&class=thumbnail '.$woo_options['woo_magazine_b_align']); ?> 
                        
                        <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                        
	                    <?php woo_post_meta(); ?>
                        
                        <div class="entry">
                            <?php the_excerpt(); ?>
                        </div>
            
                        <?php woo_post_inside_after(); ?>
        
                    </div><!-- /.post -->
                    <?php woo_post_after(); ?>

				</div><!-- /.block -->
                <?php if ( $counter == 0 ) { ?><div class="fix"></div><?php } ?>                   
                                                    
            <?php endwhile; else: ?>
                <div class="post">
                    <p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
                </div><!-- /.post -->
            <?php endif; ?>  
            
				<?php woo_loop_after(); ?>
            
                <div class="fix"></div>
                <?php woo_pagenav(); ?>
                    
            </div><!-- /#main -->
            <?php woo_main_after(); ?>
    
            <?php get_sidebar(); ?>
            
		</div><!-- /#main-sidebar-container -->         

		<?php get_sidebar('alt'); ?>

    </div><!-- /#content -->
	<?php woo_content_after(); ?>
    
		
<?php get_footer(); ?>