<?php

/**
 * Custom Body Class
 *
 * @param array $classes
 * @return array
 */
function sidebars_body_class( $classes ) {
  
    $sidebar_location = _s_get_sidebar_location();
    $sidebar_id = _s_get_custom_sidebar_id();
    
     // Add sidebar
    
    if( $sidebar_location && $sidebar_id ) {
        
        // only left or right
        if( 'left' == $sidebar_location ) {
            $classes[] = 'sidebar-left';
        }
        else {
            $classes[] = 'sidebar-right';   
        }
    }
    else {
        $classes[] = 'full-width';   
    }
  
  return $classes;
}
add_filter( 'body_class', 'sidebars_body_class' );



function _s_after_page_hero_sidebar() {
    
    global $post;
    
    if( !is_page() ) {
        return false;
    }
    
    // Need to add mobile menu
      
    $open = '<section class="section after-hero"><div class="row small-collapse xlarge-uncollapse"><div class="small-12 columns"><nav id="site-navigation-secondary" class="nav-secondary" role="navigation">';
    $close = '</nav></div></div></section>';
    
    if ( ! is_active_sidebar( 'page-after-hero' ) ) {
        
        // Set the parent menu based on Parent Menu ID
        $page_menu_item = get_field( 'page_menu_item' );
        
        if( function_exists( 'get_top_parent_id' ) ) {
            
            if( empty( $page_menu_item ) ) {
                $parent_id = get_top_parent_id( $post );
                $page_menu_item = get_field( 'page_menu_item', $parent_id );
            }
        }
        
                
        if( !empty( $page_menu_item ) ) {
            
            $menu = wp_nav_menu( array(
              'menu'       => $page_menu_item,
              'echo'       => false,
            ) );
            
            printf( '%s%s%s', $open, $menu, $close );
            
        }        
        
        return;
    }
    
    //echo $open;
    //dynamic_sidebar( 'page-after-hero' );
    //echo $close;
}

add_action( '_s_before_primary', '_s_after_page_hero_sidebar' );



function blog_after_hero_sidebar() {
            
    if( !is_home() && !is_category() && !is_singular( 'post' ) ) {
        return;   
    }
        
    $open = '<section class="section after-hero"><div class="row small-collapse xlarge-uncollapse"><div class="small-12 columns"><nav id="site-navigation-secondary" class="nav-secondary" role="navigation">';
    $close = '</nav></div></div></section>';
    
    if ( ! is_active_sidebar( 'blog-after-hero' ) ) {
        
        // Get list of categories
        $menu = _s_get_terms_list();
                
        if( !empty( $menu ) ) {
             printf( '%s%s%s', $open, $menu, $close );
         }        
        
        return;
    }
    
    echo $open;
    dynamic_sidebar( 'blog-after-hero' );
    echo $close;
}

add_action( '_s_before_primary', 'blog_after_hero_sidebar' );


function _s_before_primary() {
    
    $sidebar_location = _s_get_sidebar_location();
    $sidebar_id = _s_get_custom_sidebar_id();
    
    $classes = 'small-12 columns';
    $additional_classes = '';
    
    if( $sidebar_location && $sidebar_id ) {
          
        $classes = 'large-8 columns';
        $additional_classes = '';
        
        // only left or right
        if( 'left' == $sidebar_location ) {
            $additional_classes = ' large-push-4';
         }
        
        print( '<div class="row">' );
        
        printf( '<div class="%s%s">', $classes, $additional_classes );
       
    }   
}

add_action( '_s_before_primary', '_s_before_primary' );


function _s_after_primary() {
    
    $sidebar_location = _s_get_sidebar_location();
    $sidebar_id = _s_get_custom_sidebar_id();
    
     // Add sidebar
    
    if( $sidebar_location && $sidebar_id ) {

        $classes = 'large-4 columns';
        $additional_classes = '';
        
        // only left or right
        if( 'left' == $sidebar_location ) {
            $additional_classes = ' large-pull-8';
        }
        
        // Close primary
        echo '</div>';
        
        printf( '<div class="%s%s">', $classes, $additional_classes );
        
        get_sidebar();
        
        echo '</div>';
        
        // close /.row
        print( '</div>' );
    }
    
}

add_action( '_s_after_primary', '_s_after_primary' );



function has_children() {
  global $post;
  
  $pages = get_pages('child_of=' . $post->ID);
  
  return count($pages);
}


function _s_get_sidebar_location() {
    
    $sidebar_location = get_field( 'sidebar_location' );
    $sidebar_location = strtolower( $sidebar_location );
    
    if( empty( $sidebar_location ) || 'none' == $sidebar_location ) {
        return false;
    }
    
    return $sidebar_location;

}

function _s_get_custom_sidebar_id( $replace = 'primary' ) {
    
    $sidebar = '';
     
    $sidebars = get_post_meta( get_the_ID(), '_cs_replacements', true );
    
    if( empty( $sidebars ) ) {
        $sidebar =  $replace;
    }
    
    if( isset( $sidebars[ $replace ] ) ) {
        $sidebar =  $sidebars[ $replace ];
    }
    
    if( !empty( $sidebar ) && is_active_sidebar( $sidebar ) ) {
        return $sidebar;
    }
    
    return false;
}