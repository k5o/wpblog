<?php get_header(); ?>
<?php global $woo_options_options; ?>
       
    <!-- #content Starts -->
	<?php woo_content_before(); ?>
    <div id="content" class="col-full">
    
    	<div id="main-sidebar-container">
    
            <!-- #main Starts -->
            <?php woo_main_before(); ?>
            <div id="main" class="col-left">
                
				<?php woo_loop_before(); ?>
                <?php if (have_posts()) : $count = 0; ?>
                
                <span class="archive_header"><?php _e('Search results for', 'woothemes') ?> &quot;<?php printf(the_search_query()); ?>&quot;</span>
                
                <div class="fix"></div>
                    
                <?php while (have_posts()) : the_post(); $count++; ?>
                
                <?php if (get_option('woo_woo_tumblog_switch') == 'true') { $is_tumblog = woo_tumblog_test(); } else { $is_tumblog = false; } ?>
                                                                             
                <!-- Post Starts -->
                <?php woo_post_before(); ?>
                <div <?php post_class(); ?>>
                
                    <?php woo_post_inside_before(); ?>
    
                    <?php if (!$is_tumblog) { woo_image('width='.$woo_options['woo_thumb_w'].'&height='.$woo_options['woo_thumb_h'].'&class=thumbnail '.$woo_options['woo_thumb_align']); } ?> 

                    <?php if ($is_tumblog) { woo_tumblog_the_title('h2','title'); } else { ?><h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2><?php } ?>
                    
                    <?php woo_post_meta($is_tumblog); ?>
                    
                    <div class="entry">
                    	 <?php if ($is_tumblog) { woo_tumblog_content_before(); } ?>
                        <?php the_excerpt(); ?>
                        <?php if ($is_tumblog) { woo_tumblog_content_after(); } ?>
                    </div><!-- /.entry -->
                                
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
