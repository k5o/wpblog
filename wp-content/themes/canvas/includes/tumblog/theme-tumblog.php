<?php

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- Woo Tumblog Output Functions
-- woo_tumblog_content()
-- woo_tumblog_article_content()
-- woo_tumblog_image_content()
-- woo_tumblog_audio_content()
-- woo_tumblog_video_content()
-- woo_tumblog_quote_content()
-- woo_tumblog_link_content()
-- woo_tumblog_the_title()
-- woo_tumblog_taxonomy_link()

-----------------------------------------------------------------------------------*/

/* Load the default BuddyPress javascript */
if (get_option('woo_woo_tumblog_switch') == 'true') 
	wp_enqueue_script( 'tumblog-js', get_bloginfo('template_directory') . '/includes/tumblog/swfobject.js' );

/*-----------------------------------------------------------------------------------*/
/* Woo Tumblog Output Functions  */
/*-----------------------------------------------------------------------------------*/

function woo_tumblog_content($output = 'Before', $return = false) {
	global $post;
	$post_id = $post->ID;
    
    //check if it is a tumblog post
    
    //check which tumblog
    $tumblog_list = get_the_term_list( $post_id, 'tumblog', '' , '|' , ''  );
    
    $tumblog_array = explode('|', $tumblog_list);
    	
    $tumblog_items = array(	'articles'	=> get_option('woo_articles_term_id'),
    						'images' 	=> get_option('woo_images_term_id'),
    						'audio' 	=> get_option('woo_audio_term_id'),
    						'video' 	=> get_option('woo_video_term_id'),
    						'quotes'	=> get_option('woo_quotes_term_id'),
    						'links' 	=> get_option('woo_links_term_id')
    						);
    //switch between tumblog taxonomies
    $tumblog_list = strip_tags($tumblog_list);
    $tumblog_array = explode('|', $tumblog_list);
    $tumblog_results = '';
    $sentinel = false;
    foreach ($tumblog_array as $tumblog_item) {
      	$tumblog_id = get_term_by( 'name', $tumblog_item, 'tumblog' );
      	if ( $tumblog_items['articles'] == $tumblog_id->term_id && !$sentinel ) {
      		$content = woo_tumblog_article_content($post_id);
       	} elseif ($tumblog_items['images'] == $tumblog_id->term_id && !$sentinel ) {
       		if ($output == get_option('woo_woo_tumblog_images_content')) {
       			$content = woo_tumblog_image_content($post_id);
       		}
       	} elseif ($tumblog_items['audio'] == $tumblog_id->term_id && !$sentinel) {
       		if ($output == get_option('woo_woo_tumblog_audio_content')) {
       			$content = woo_tumblog_audio_content($post_id);
       		}
       	} elseif ($tumblog_items['video'] == $tumblog_id->term_id && !$sentinel) {
       		if ($output == get_option('woo_woo_tumblog_videos_content')) {
       			$content = woo_tumblog_video_content($post_id);
       		}
       	} elseif ($tumblog_items['quotes'] == $tumblog_id->term_id && !$sentinel) {
       		if ($output == get_option('woo_woo_tumblog_quotes_content')) {
       			$content = woo_tumblog_quote_content($post_id);
       		}
       	} elseif ($tumblog_items['links'] == $tumblog_id->term_id && !$sentinel) {
       		$content = woo_tumblog_link_content($post_id);
       	} else {
       		$content = '';
      	}	    		
    } 
	
	// Return or echo the content
	if ( $return == TRUE )
		return $content;
	else 
		echo $content; // Done

}

function woo_tumblog_article_content($post_id) {
	
	$content_tumblog = '';
    
	return $content_tumblog;
}

function woo_tumblog_image_content($post_id) {
	
	if (get_option('woo_image_link_to') == 'image') {
  		$content_tumblog = '<p><a href="'.get_post_meta($post_id, "image", true).'" title="image" rel="lightbox">'.woo_image('key=image&width='.get_option('woo_tumblog_image_width').'px'.$height.'&link=img&return=true').'</a></p>';  
  	} else { 
    	$content_tumblog = '<p><a href="'.get_permalink($post_id).'" title="image">'.woo_image('key=image&width='.get_option('woo_tumblog_image_width').'px'.$height.'&link=img&return=true').'</a></p>';
	}
		   	
	return $content_tumblog;
}

function woo_tumblog_audio_content($post_id) {
	
	//Post Args
	$args = array(
	    'post_type' => 'attachment',
	    'numberposts' => -1,
	    'post_status' => null,
	    'post_parent' => $post_id
	);
	//Get attachements 
	$attachments = get_posts($args);
	if ($attachments) {
	    foreach ($attachments as $attachment) {
	    	$link_url= $attachment->guid;
	    }
	}
	else {
	    $link_url = get_post_meta($post_id,'audio',true);
	}
	if(!empty($link_url)) {
				
		$content_tumblog = '<div class="audio"><div id="mediaspace'.$post_id.'"></div></div>'; 
		  
		$content_tumblog .= '<script type="text/javascript">
		      				var so = new SWFObject("'.get_bloginfo('template_directory').'/includes/tumblog/player.swf","mpl","'.get_option('woo_tumblog_audio_width').'","32","9");
		      				so.addParam("allowfullscreen","true");
		      				so.addParam("allowscriptaccess","always");
		      				so.addParam("wmode","opaque");
		      				so.addParam("wmode","opaque");
		      				so.addVariable("skin", "'.get_bloginfo('template_directory').'/includes/tumblog/stylish_slim.swf");
		      				so.addVariable("file","'.$link_url.'");
		      				so.addVariable("backcolor","000000");
		      				so.addVariable("frontcolor","FFFFFF");
		      				so.write("mediaspace'.$post_id.'");
		    				</script>';
		    
	}
	
	return $content_tumblog;
}

function woo_tumblog_video_content($post_id) {
	
	$content_tumblog = '<div class="video">'.woo_embed('key=video-embed&width='.get_option('woo_tumblog_video_width')).'</div>';
	
	return $content_tumblog;
	
}

function woo_tumblog_quote_content($post_id) {
	
	$content_tumblog = '<div class="quote"><blockquote>'.get_post_meta($post_id,'quote-copy',true).' </blockquote><cite><a href="'.get_post_meta($post_id,'quote-url',true).'" title="'.get_the_title($post_id).'">'.get_post_meta($post_id,'quote-author',true).'</a></cite></div>';
	
	return $content_tumblog;
}

function woo_tumblog_link_content($post_id) {

	$content_tumblog = '';
	
	return $content_tumblog;
}

function woo_tumblog_the_title($outer_element = 'h1', $class = 'title', $icon = true, $before = '', $after = '', $return = false) {
	
	global $post;
	$post_id = $post->ID;
    
    //check if it is a tumblog post and which tumblog
    $tumblog_list = get_the_term_list( $post_id, 'tumblog', '' , '|' , ''  );
    
    $tumblog_array = explode('|', $tumblog_list);
    	
    $tumblog_items = array(	'articles'	=> get_option('woo_articles_term_id'),
    						'images' 	=> get_option('woo_images_term_id'),
    						'audio' 	=> get_option('woo_audio_term_id'),
    						'video' 	=> get_option('woo_video_term_id'),
    						'quotes'	=> get_option('woo_quotes_term_id'),
    						'links' 	=> get_option('woo_links_term_id')
    						);
    //switch between tumblog taxonomies
    $tumblog_list = strip_tags($tumblog_list);
    $tumblog_array = explode('|', $tumblog_list);
    $tumblog_results = '';
    $sentinel = false;
    foreach ($tumblog_array as $tumblog_item) {
      	$tumblog_id = get_term_by( 'name', $tumblog_item, 'tumblog' );
      	if ( $tumblog_items['articles'] == $tumblog_id->term_id && !$sentinel ) {
      		if ($icon) {
      			$category_id = $tumblog_items['articles'];
      			if ($category_id > 0) {
    				$term = &get_term($category_id, 'tumblog');
    				// Get the URL of Articles Tumblog Taxonomy
    				$category_link = get_term_link( $term, 'tumblog' );
    			} else {
    				$category_link = '#';
    			}
    			$icon_content = '<span class="post-icon article"><a href="'.$category_link.'" title="'.$tumblog_id->name.'">'.$tumblog_id->name.'</a></span>';
      		} else {
      			$icon_content = '';
      		}
      		$content = $icon_content.$before.'<'.$outer_element.' class="'.$class.'"><a href="'.get_permalink($post_id).'" title="'.sprintf( esc_attr__( "Permalink to %s", "woothemes" ), get_the_title($post_id)).'" rel="bookmark">'.get_the_title($post_id).'</a></'.$outer_element.'>'.$after;
       	} elseif ($tumblog_items['images'] == $tumblog_id->term_id && !$sentinel ) {
       		if ($icon) {
       			$category_id = $tumblog_items['images'];
      			if ($category_id > 0) {
    				$term = &get_term($category_id, 'tumblog');
    				// Get the URL of Images Tumblog Taxonomy
    				$category_link = get_term_link( $term, 'tumblog' );
    			} else {
    				$category_link = '#';
    			}
    			$icon_content = '<span class="post-icon image"><a href="'.$category_link.'" title="'.$tumblog_id->name.'">'.$tumblog_id->name.'</a></span>';
      		} else {
      			$icon_content = '';
      		}
       		$content = $icon_content.$before.'<'.$outer_element.' class="'.$class.'"><a href="'.get_permalink($post_id).'" title="'.sprintf( esc_attr__( "Permalink to %s", "woothemes" ), get_the_title($post_id)).'" rel="bookmark">'.get_the_title($post_id).'</a></'.$outer_element.'>'.$after;
       	} elseif ($tumblog_items['audio'] == $tumblog_id->term_id && !$sentinel) {
       		if ($icon) {
       			$category_id = $tumblog_items['audio'];
      			if ($category_id > 0) {
    				$term = &get_term($category_id, 'tumblog');
    				// Get the URL of Audio Tumblog Taxonomy
    				$category_link = get_term_link( $term, 'tumblog' );
    			} else {
    				$category_link = '#';
    			}
    			$icon_content = '<span class="post-icon audio"><a href="'.$category_link.'" title="'.$tumblog_id->name.'">'.$tumblog_id->name.'</a></span>';
      		} else {
      			$icon_content = '';
      		}
       		$content = $icon_content.$before.'<'.$outer_element.' class="'.$class.'"><a href="'.get_permalink($post_id).'" title="'.sprintf( esc_attr__( "Permalink to %s", "woothemes" ), get_the_title($post_id)).'" rel="bookmark">'.get_the_title($post_id).'</a></'.$outer_element.'>'.$after;
       	} elseif ($tumblog_items['video'] == $tumblog_id->term_id && !$sentinel) {
       		if ($icon) {
       			$category_id = $tumblog_items['video'];
      			if ($category_id > 0) {
    				$term = &get_term($category_id, 'tumblog');
    				// Get the URL of Video Tumblog Taxonomy
    				$category_link = get_term_link( $term, 'tumblog' );
    			} else {
    				$category_link = '#';
    			}
    			$icon_content = '<span class="post-icon video"><a href="'.$category_link.'" title="'.$tumblog_id->name.'">'.$tumblog_id->name.'</a></span>';
      		} else {
      			$icon_content = '';
      		}
       		$content = $icon_content.$before.'<'.$outer_element.' class="'.$class.'"><a href="'.get_permalink($post_id).'" title="'.sprintf( esc_attr__( "Permalink to %s", "woothemes" ), get_the_title($post_id)).'" rel="bookmark">'.get_the_title($post_id).'</a></'.$outer_element.'>'.$after;
       	} elseif ($tumblog_items['quotes'] == $tumblog_id->term_id && !$sentinel) {
       		if ($icon) {
      			$category_id = $tumblog_items['quotes'];
      			if ($category_id > 0) {
    				$term = &get_term($category_id, 'tumblog');
    				// Get the URL of Quotes Tumblog Taxonomy
    				$category_link = get_term_link( $term, 'tumblog' );
    			} else {
    				$category_link = '#';
    			}
    			$icon_content = '<span class="post-icon quote"><a href="'.$category_link.'" title="'.$tumblog_id->name.'">'.$tumblog_id->name.'</a></span>';
      		} else {
      			$icon_content = '';
      		}
       		$content = $icon_content.$before.'<'.$outer_element.' class="'.$class.'"><a href="'.get_permalink($post_id).'" title="'.sprintf( esc_attr__( "Permalink to %s", "woothemes" ), get_the_title($post_id)).'" rel="bookmark">'.get_the_title($post_id).'</a></'.$outer_element.'>'.$after;
       	} elseif ($tumblog_items['links'] == $tumblog_id->term_id && !$sentinel) {
       		if ($icon) {
       			$category_id = $tumblog_items['links'];
      			if ($category_id > 0) {
    				$term = &get_term($category_id, 'tumblog');
    				// Get the URL of Links Tumblog Taxonomy
    				$category_link = get_term_link( $term, 'tumblog' );
    			} else {
    				$category_link = '#';
    			}
    			$icon_content = '<span class="post-icon link"><a href="'.$category_link.'" title="'.$tumblog_id->name.'">'.$tumblog_id->name.'</a></span>';
      		} else {
      			$icon_content = '';
      		}
       		$content = $icon_content.$before.'<'.$outer_element.' class="'.$class.'"><a href="'.get_post_meta($post_id,'link-url',true).'" title="'.sprintf( esc_attr__( "Permalink to %s", "woothemes" ), get_the_title($post_id)).'" rel="bookmark" target="_blank">'.get_the_title($post_id).'</a></'.$outer_element.'>'.$after;
       	} else {
       		$content = $before.'<'.$outer_element.' class="'.$class.'"><a href="'.get_permalink($post_id).'" title="'.sprintf( esc_attr__( "Permalink to %s", "woothemes" ), get_the_title($post_id)).'" rel="bookmark">'.get_the_title($post_id).'</a></'.$outer_element.'>'.$after;
      	}	    		
    } 
	
	// Return or echo the content
	if ( $return == TRUE )
		return $content;
	else 
		echo $content; // Done
	
}

function woo_tumblog_taxonomy_link($post_id, $return = true) {
	
	$tumblog_list = get_the_term_list( $post_id, 'tumblog', '' , '|' , ''  );
	$tumblog_array = explode('|', $tumblog_list);
	
	$tumblog_items = array(	'articles'	=> get_option('woo_articles_term_id'),
							'images' 	=> get_option('woo_images_term_id'),
							'audio' 	=> get_option('woo_audio_term_id'),
							'video' 	=> get_option('woo_video_term_id'),
							'quotes'	=> get_option('woo_quotes_term_id'),
							'links' 	=> get_option('woo_links_term_id')
						);
	//switch between tumblog taxonomies
	$tumblog_list = strip_tags($tumblog_list);
	$tumblog_array = explode('|', $tumblog_list);
	$tumblog_results = '';
	$sentinel = false;
	foreach ($tumblog_array as $tumblog_item) {
	  	$tumblog_id = get_term_by( 'name', $tumblog_item, 'tumblog' );
	  	if ( $tumblog_items['articles'] == $tumblog_id->term_id && !$sentinel ) {
	  		$tumblog_results = 'article';
	  		$category_id = $tumblog_items['articles'];
	  		$sentinel = true;
	   	} elseif ($tumblog_items['images'] == $tumblog_id->term_id && !$sentinel ) {
	   		$tumblog_results = 'image';
	   		$category_id = $tumblog_items['images'];
	   		$sentinel = true;
	   	} elseif ($tumblog_items['audio'] == $tumblog_id->term_id && !$sentinel) {
	   		$tumblog_results = 'audio';
	   		$category_id = $tumblog_items['audio'];
	   		$sentinel = true;
	   	} elseif ($tumblog_items['video'] == $tumblog_id->term_id && !$sentinel) {
	   		$tumblog_results = 'video';
	   		$category_id = $tumblog_items['video'];
	   		$sentinel = true;
	   	} elseif ($tumblog_items['quotes'] == $tumblog_id->term_id && !$sentinel) {
	   		$tumblog_results = 'quote';
	   		$category_id = $tumblog_items['quotes'];
	   		$sentinel = true;
	   	} elseif ($tumblog_items['links'] == $tumblog_id->term_id && !$sentinel) {
	   		$tumblog_results = 'link';
	   		$category_id = $tumblog_items['links'];
	   		$sentinel = true;
	   	} else {
	   		$tumblog_results = 'default';
	   		$category_id = 0;
	   		$sentinel = false;
	  	}	    		
	}  
	
    if ($category_id > 0) {
    	$term = &get_term($category_id, 'tumblog');
    	// Get the URL of Articles Tumblog Taxonomy
    	$category_link = get_term_link( $term, 'tumblog' );
    } else {
    	$category_link = '#';
    }
    
    if ( $return )
		echo '<a href="'.$category_link.'" title="'.$term->name.'">'.$term->name.'</a>';
	else
		return $category_link;
    
}

function woo_tumblog_test() {
	
	global $post;
	$post_id = $post->ID;
	
	$tumblog_items = array(	'articles'	=> get_option('woo_articles_term_id'),
							'images' 	=> get_option('woo_images_term_id'),
							'audio' 	=> get_option('woo_audio_term_id'),
							'video' 	=> get_option('woo_video_term_id'),
							'quotes'	=> get_option('woo_quotes_term_id'),
							'links' 	=> get_option('woo_links_term_id')
						);
						
  	//switch between tumblog taxonomies
	$tumblog_list = get_the_term_list( $post_id, 'tumblog', '' , '|' , ''  );
	$tumblog_list = strip_tags($tumblog_list);
	$tumblog_array = explode('|', $tumblog_list);
	$sentinel = false;
	foreach ($tumblog_array as $location_item) {
	  	$tumblog_id = get_term_by( 'name', $location_item, 'tumblog' );
	  	if ( $tumblog_items['articles'] == $tumblog_id->term_id && !$sentinel ) {
	    	$sentinel = true;
	    } elseif ($tumblog_items['images'] == $tumblog_id->term_id && !$sentinel ) {
	    	$sentinel = true;
	    } elseif ($tumblog_items['audio'] == $tumblog_id->term_id && !$sentinel) {
	    	$sentinel = true;
	    } elseif ($tumblog_items['video'] == $tumblog_id->term_id && !$sentinel) {
	    	$sentinel = true;
	    } elseif ($tumblog_items['quotes'] == $tumblog_id->term_id && !$sentinel) {
	    	$sentinel = true;
	    } elseif ($tumblog_items['links'] == $tumblog_id->term_id && !$sentinel) {
	    	$sentinel = true;
	    } else {
	    	$sentinel = false;
	    }	    		
	}           	
    
    return $sentinel;       	
}


	

	/*-----------------------------------------------------------------------------------*/
	/* WooTumblog Custom RSS Feed Output */
	/*-----------------------------------------------------------------------------------*/
	
	function woo_custom_tumblog_rss_output($content) {
		global $post;
		$post_id = $post->ID;
		$default_feed_option = get_option('woo_custom_rss');
		if ($default_feed_option == 'yes') {
			//default content output to nothing
			$temp_content = $content;
			$content = '';
			//check if it is a tumblog post
			
			//check which tumblog
			$tumblog_list = get_the_term_list( $post_id, 'tumblog', '' , '|' , ''  );
			
			$tumblog_array = explode('|', $tumblog_list);
			
			$tumblog_items = array(	'articles'	=> get_option('woo_articles_term_id'),
									'images' 	=> get_option('woo_images_term_id'),
									'audio' 	=> get_option('woo_audio_term_id'),
									'video' 	=> get_option('woo_video_term_id'),
									'quotes'	=> get_option('woo_quotes_term_id'),
									'links' 	=> get_option('woo_links_term_id')
								);
			//switch between tumblog taxonomies
			$tumblog_list = strip_tags($tumblog_list);
			$tumblog_array = explode('|', $tumblog_list);
			$tumblog_results = '';
			$sentinel = false;
			foreach ($tumblog_array as $tumblog_item) {
			  	$tumblog_id = get_term_by( 'name', $tumblog_item, 'tumblog' );
			  	if ( $tumblog_items['articles'] == $tumblog_id->term_id && !$sentinel ) {
			  		$tumblog_results = 'article';
			  		$tumblog_name = $tumblog_id->name;
			  		$sentinel = true;
			   	} elseif ($tumblog_items['images'] == $tumblog_id->term_id && !$sentinel ) {
			   		$tumblog_results = 'image';
			   		$tumblog_name = $tumblog_id->name;
			   		$sentinel = true;
			   	} elseif ($tumblog_items['audio'] == $tumblog_id->term_id && !$sentinel) {
			   		$tumblog_results = 'audio';
			   		$tumblog_name = $tumblog_id->name;
			   		$sentinel = true;
			   	} elseif ($tumblog_items['video'] == $tumblog_id->term_id && !$sentinel) {
			   		$tumblog_results = 'video';
			   		$tumblog_name = $tumblog_id->name;
			   		$sentinel = true;
			   	} elseif ($tumblog_items['quotes'] == $tumblog_id->term_id && !$sentinel) {
			   		$tumblog_results = 'quote';
			   		$tumblog_name = $tumblog_id->name;
			   		$sentinel = true;
			   	} elseif ($tumblog_items['links'] == $tumblog_id->term_id && !$sentinel) {
			   		$tumblog_results = 'link';
			   		$tumblog_name = $tumblog_id->name;
			   		$sentinel = true;
			   	} else {
			   		$tumblog_results = 'default';
			   		$tumblog_name = 'Tumblog';
			   		$sentinel = false;
			  	}	    		
			} 
			
			$taxonomy_link = woo_tumblog_taxonomy_link($post_id, false);
			if ($tumblog_name != 'Tumblog') {
			    $content .= '<p>Posted in <a href="'.$taxonomy_link.'">'.$tumblog_name.'</a></p>';
			} else {
			    $content .= '<p>Posted in ';
			    foreach((get_the_category($post_id)) as $category) { 
    		    	$category_link = get_category_link( $category->cat_ID );
 			    	$content .= '<a href="'.$category_link.'" title="'.$category->cat_name.'">'.$category->cat_name.'</a>';
			    } 
			    $content .= '</p>';
			}
			
			switch ($tumblog_results) {
			
				case 'article':
					break;
				case 'image':
					if (get_option('woo_image_link_to') == 'image') {
  						$content .= '<p><a href="'.get_post_meta($post_id, "image", true).'" title="image" rel="lightbox"><img src="'.get_post_meta($post_id, "image", true).'" alt="image" width="'.get_option('woo_tumblog_width').'" /></a></p>';  
  					} else { 
    		    		$content .= '<p><a href="'.get_permalink($post_id).'" title="image"><img src="'.get_post_meta($post_id, "image", true).'" alt="image" width="'.get_option('woo_tumblog_width').'" /></a></p>';
					}
					break;
				case 'audio':
					//Post Args
					$args = array(
						'post_type' => 'attachment',
						'numberposts' => -1,
						'post_status' => null,
						'post_parent' => $post_id
					);
					//Get attachements 
					$attachments = get_posts($args);
					if ($attachments) {
						foreach ($attachments as $attachment) {
							$link_url= $attachment->guid;
						}
					}
					else {
						$link_url = get_post_meta($post_id,'audio',true);
					}
					if(!empty($link_url)) {
						$content .= '<p><a href="'.$link_url.'" rel="bookmark" title="'.get_the_title($post_id).'" target="_blank">'.__('Play Audio', 'woothemes').'</a></p>';
					}
					break;
				case 'video':
					$content .= '<p>'.get_post_meta($post_id,'video-embed',true).'</p>';
					break;
				case 'quote':
					$content .= '<p><cite>'.get_post_meta($post_id,'quote-copy',true).__(' ~ ', 'woothemes').'<a href="'.get_post_meta($post_id,'quote-url',true).'" title="'.get_the_title($post_id).'">'.get_post_meta($post_id,'quote-author',true).'</a></cite></p>';
					break;
				case 'link':
					$content .= '<p><a href="'.get_post_meta($post_id,'link-url',true).'" rel="bookmark" title="'.get_the_title($post_id).'" target="_blank">'.get_post_meta($post_id,'link-url',true).'</a></p>';
					break;
				default:
					break;
			}
				
			
			//add original content back
    		$content .= $temp_content;
		}
	    return $content;
	}

?>