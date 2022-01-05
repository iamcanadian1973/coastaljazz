<?php

/* usage
 *
 * wp_nav_menu( array(
 *   'theme_location' => 'primary', 
 *   'sub_menu'       => true,
 *   'root_id'        => id_of_menu_item
 * ) );
 */

// add hook
add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );

// filter_hook function to react on sub_menu flag
function my_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {
  if ( isset( $args->sub_menu ) ) {
    if ( isset( $args->root_id ) ) {
      // force a specific sub-menu to display
      $root_id = $args->root_id;
    }
    else {
      $root_id = 0;
      
      // find the current menu item
      foreach ( $sorted_menu_items as $menu_item ) {
        if ( $menu_item->current ) {
          // set the root id based on whether the current menu item has a parent or not
          $root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
          break;
        }
      }
      
      // find the top level parent
      if ( ! isset( $args->direct_parent ) ) {
        $prev_root_id = $root_id;
        while ( $prev_root_id != 0 ) {
          foreach ( $sorted_menu_items as $menu_item ) {
            if ( $menu_item->ID == $prev_root_id ) {
              $prev_root_id = $menu_item->menu_item_parent;
              // don't set the root_id to 0 if we've reached the top of the menu
              if ( $prev_root_id != 0 ) $root_id = $menu_item->menu_item_parent;
              break;
            } 
          }
        }
      }
    }

    $menu_item_parents = array();
    foreach ( $sorted_menu_items as $key => $item ) {
      // init menu_item_parents
      if ( $item->ID == $root_id ) $menu_item_parents[] = $item->ID;

      if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
        // part of sub-tree: keep!
        $menu_item_parents[] = $item->ID;
      } else if ( ! ( isset( $args->show_parent ) && in_array( $item->ID, $menu_item_parents ) ) ) {
        // not part of sub-tree: away with it!
        unset( $sorted_menu_items[$key] );
      }
    }
    
    return $sorted_menu_items;
  } else {
    return $sorted_menu_items;
  }
}


// remove parent class from homepage - used for single page scroll menus
function clear_nav_menu_item_class($classes, $item, $args) {
    	
	if( is_front_page() && ( $args->theme_location == 'primary' ) ) {
		$classes = array_filter($classes, "remove_parent_classes");
	}
	
	return $classes;
}

//add_filter('nav_menu_css_class', 'clear_nav_menu_item_class', 10, 3);


// Filter menu items as needed and set a custom class etc....
function set_current_menu_class($classes) {
	global $post;
    
    $coastal_event_category = false;

    if( isset( $_GET['tribe_eventcategory'] ) ) {
        $coastal_event_category = absint( $_GET['tribe_eventcategory'] );
    }

    
    // 234 = festival
    // 217 = year round
	
	if( is_singular( 'tribe_events' ) ) {
        
        $post_terms = wp_get_post_terms( $post->ID, 'tribe_events_cat',array('fields' => 'ids') );
        
        if( !is_wp_error( $post_terms ) && !empty( $post_terms )  ) {
            
            $current_term_id = $post_terms[0];
              
            $menu_to_set = ( 2 == $current_term_id ) ? 'menu-item-234' : 'menu-item-217';
            
            $classes = array_filter($classes, "remove_parent_classes");
            
            if ( in_array( $menu_to_set, $classes ) ) {
                $classes[] = 'current-menu-item';
            }
        }
	}
    
    if( ( $coastal_event_category || is_tax( 'tribe_events_cat' ) ) && !is_singular( 'tribe_events' ) ) {
        
        if( $coastal_event_category ) {
            $event_category = absint( $coastal_event_category );
        }
        else {
            $event_category = get_queried_object(); 
        }        
            
        $menu_to_set = ( 2 == $event_category->term_id ) ? 'menu-item-234' : 'menu-item-217';
        
        $classes = array_filter($classes, "remove_parent_classes");
        
        if ( in_array( $menu_to_set, $classes ) ) {
            $classes[] = 'current-menu-item';
        }
	}
			
	return $classes;
}

add_filter('nav_menu_css_class', 'set_current_menu_class',1,2); 


// check for current page classes, return false if they exist.
function remove_parent_classes($class){
  return in_array( $class, array( 'current_page_item', 'current_page_parent', 'current_page_ancestor', 'current-menu-item' ) )  ? FALSE : TRUE;
}



function _s_is_page_template_name( $template_name ) {
	
	if( is_page() ) {
		$template_found = str_replace( '.php', '', basename( get_page_template_slug( get_queried_object_id() ) ) );
		return $template_name === $template_found ? true : false;
	}
	
}
