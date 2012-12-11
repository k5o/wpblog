<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>

<?php global $woo_options; ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( $woo_options['woo_feed_url'] ) { echo $woo_options['woo_feed_url']; } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' );  ?>
<?php wp_head(); ?>
<?php woo_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php woo_top(); ?>

<div id="wrapper">
        
	<?php woo_header_before(); ?>
    
	<div id="header" class="col-full">
 		
		<?php woo_header_inside(); ?>
       
		<div id="logo">
	       
		<?php if ( $woo_options['woo_logo'] ) { ?>
            <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>"><img src="<?php echo $woo_options['woo_logo']; ?>" /></a>
        <?php }  if( is_singular() && !is_front_page() ) : ?>
            <span class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></span>
        <?php else: ?>
            <h1 class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
        <?php endif; ?>
            <span class="site-description"><?php bloginfo('description'); ?></span>
	      	
		</div><!-- /#logo -->
	       
		<?php if ($woo_options['woo_ad_top'] == 'true') { ?>
        <div id="topad">
        
		<?php if ( $woo_options['woo_ad_top_adsense'] <> "") { 
            echo stripslashes(get_option('woo_ad_top_adsense'));             
        } else { ?>
            <a href="<?php echo get_option('woo_ad_top_url'); ?>"><img src="<?php echo $woo_options['woo_ad_top_image']; ?>" alt="" /></a>
        <?php } ?>		   	
            
        </div><!-- /#topad -->
        <?php } ?>
       
	</div><!-- /#header -->
    
	<?php woo_header_after(); ?>
