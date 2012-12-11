<?php
/*
Template Name: Full Width
*/
?>

<?php get_header(); ?>
       
    <!-- #content Starts -->
	<?php woo_content_before(); ?>
    <div id="content" class="page col-full">

        <!-- #main Starts -->
		<?php woo_main_before(); ?>
		<div id="main" class="fullwidth">
            
			<?php woo_loop_before(); ?>
		
		<?php if (have_posts()) : $count = 0; ?>
        <?php while (have_posts()) : the_post(); $count++; ?>
                                                                    
            <!-- Post Starts -->
            <?php woo_post_before(); ?>
            <div class="post">

                <?php woo_post_inside_before(); ?>

                <h1 class="title"><?php the_title(); ?></h1>
                
                <div class="entry">
                    <?php the_content(); ?>
                </div><!-- /.entry -->

				<?php woo_post_inside_after(); ?>

            </div><!-- /.post -->
			<?php woo_post_after(); ?>
                                                
        <?php endwhile; else: ?>
            <div class="post">
                <p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
            </div><!-- /.post -->
        <?php endif; ?>  
        
		</div><!-- /#main -->
		<?php woo_main_after(); ?>
		
    </div><!-- /#content -->
	<?php woo_content_after(); ?>
		
<?php get_footer(); ?>