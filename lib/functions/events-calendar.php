<?php

function my_events_list_the_date_headers( $html ) {
    
    return sprintf( '<h4>%s</h4>', strip_tags( $html ) );
    
}
//apply_filters( 'tribe_events_list_the_date_headers', 'my_events_list_the_date_headers', 99, 1 );


function remove_featured_classes( $classes ) {
    
    return array_diff( $classes, array( 'tribe-event-featured' ) );
    
}

add_filter( 'tribe_events_event_classes', 'remove_featured_classes', 99, 1 );



add_filter( 'tribe-events-bar-filters',  'remove_search_from_bar', 1000, 1 );
 
function remove_search_from_bar( $filters ) {
  if ( isset( $filters['tribe-bar-search'] ) ) {
        unset( $filters['tribe-bar-search'] );
    }
 
    return $filters;
}

function _get_events_custom_seconondary_menu( $page_menu_item ) {
 
    $open = '<section class="section after-hero"><div class="row small-collapse xlarge-uncollapse"><div class="small-12 columns"><nav id="site-navigation-secondary" class="nav-secondary" role="navigation">';
    $close = '</nav></div></div></section>';
                
    if( !empty( $page_menu_item ) ) {
        
        $menu = wp_nav_menu( array(
          'menu'       => $page_menu_item,
          'echo'       => false,
        ) );
        
        return sprintf( '%s%s%s', $open, $menu, $close );
        
    }        
    
    return;
    
}



// Used on front-page.php
function get_upcoming_events() {

    $posts = [];
    
    $events = tribe_get_events( array(
       'eventDisplay' => 'list',
       'posts_per_page' => 10,
       //'tribe_events_cat' => 'pain-management' 
       ) 
    );
        
    // The result set may be empty
    if ( empty( $events ) ) {
       //return false;
    }
    
    foreach( $events as $event ) {
        $posts[] = get_single_event( $event );                            
    } 
    
    wp_reset_postdata();
    
    return $posts;
    
}


// Used on front-page.php
function get_featured_events( $slick = false ) {

    $posts = [];
    
    /*
    $total_featured = tribe_get_events( array(
       'eventDisplay' => 'list',
       'posts_per_page' => -1,
       // 'start_date'     => date( 'Y-m-d H:i:s', strtotime( '+1 day' ) ), // don't show today
       'start_date'     => date( 'Y-m-d H:i:s', strtotime( 'yesterday midnight' ) ),
       'post_parent'    => 0,
       'meta_query'     => array(
                array(
                'key' => 'event_featured',
                'value' => true,
                'type' => 'BOOLEAN'
                )
            )
        ) 
    );
    
    $show_random_order = count( $total_featured > 3) ? true : false;
    */
    
    $args  = array(
       'eventDisplay' => 'list',
       'posts_per_page' => 12,
       // 'start_date'     => date( 'Y-m-d H:i:s', strtotime( '+1 day' ) ), // don't show today
       'start_date'     => date( 'Y-m-d H:i:s', strtotime( '-2 days' ) ),
        // 'post_parent'    => 0,
       'meta_query'     => array(
                array(
                'key' => 'event_featured',
                'value' => true,
                'type' => 'BOOLEAN'
                )
            )
        );
    
    /*   
    if( $show_random_order ) {
        // $args['orderby'] = 'rand';
    }
    */
    
    $events = tribe_get_events( $args );
            
    // The result set may be empty
    if ( empty( $events ) ) {
       //return false;
    }
    
    foreach( $events as $event ) {
        // $key =  tribe_get_start_date( $event, false, 'U' );
        // $posts[$key] = get_single_event( $event );  
        $posts[] = get_single_event( $event );                          
    } 
    
    wp_reset_postdata();
    
    //ksort( $posts );
    
    return array_slice( $posts, 0, 3);
    
    return $posts;
    
}


function get_related_events( $post_ids ) {
                                            
    if( empty( $post_ids ) ) {
        return;
    }
    
    $posts = [];
        
    $args  = array(
       'eventDisplay' => 'list',
       'posts_per_page' => 100 );
    
    //$args['orderby'] = 'post__in';
    $args['post__in'] = $post_ids;
    
    $events = tribe_get_events( $args );
                
    // The result set may be empty
    if ( empty( $events ) ) {
       return false;
    }
    
    foreach( $events as $event ) {
        // $key =  tribe_get_start_date( $event, false, 'U' );
        // $posts[$key] = get_single_event( $event );  
        $posts[] = get_related_event( $event );                          
    } 
    
    wp_reset_postdata();
    
    return $posts;
}


function get_related_event( $event ) {
    
    setup_postdata( $event );
    
    $link = esc_url( tribe_get_event_link( $event ) );
                              
    $subtitle = _s_get_heading( get_field( 'event_subtitle', $event ), 'h5' );
     
    $special_event_title = _s_get_heading( get_field( 'event_special_title', $event ), 'h6' );
    
    $full_date = sprintf( '<span class="event-date">%s</span>', tribe_get_start_date( $event, false, 'l, F j, Y' ) );
    
    $venue = sprintf( '<span class="event-venue">%s</span>', strip_tags( tribe_get_venue( $event ) ) );
    
    // time
    $time = sprintf( '<span class="event-time">%s</span>', tribe_get_start_time( $event, 'g:iA' ) );
    
    // Price - custom field
    $price = get_field( 'event_price', $event );
    if( !empty( $price ) ) {
        $price = sprintf( '<span class="event-price">%s</span>', $price );
    }
        
    $time_price = sprintf( '<span class="event-time-price">%s%s</span>', $time, $price );
    
    $event_meta = sprintf( '<p>%s%s%s</p>', $full_date, $venue, $time_price );
   
    return sprintf( '<div class="event"><div class="event-details"><header><a href="%s"><h5>%s</h5></a></header>%s</div></div>', 
                    $link,
                    get_the_title( $event ),
                    $event_meta                 
    
    );
}


function get_single_event( $event ) {
    
    setup_postdata( $event );
    
    $link = esc_url( tribe_get_event_link( $event ) );
   
    $thumbnail = get_the_post_thumbnail_url( $event, 'event-thumbnail' );
    if( !empty( $thumbnail ) ) {
        $thumbnail = sprintf( 'style="background-image: url(%s);"', $thumbnail );
    }
    $thumbnail = sprintf( '<div class="thumbnail" %s></div>', $thumbnail );
    
    $event_date_dark = get_field( 'event_date_dark', $event );
    $dark_class = $event_date_dark ? ' dark' : '';
    
    
    $thumbnail = sprintf( '<a href="%s" class="event-thumbnail"><span class="event-date%s">%s<i>%s</i></span>%s</a>', 
                          $link,
                          $dark_class,
                          tribe_get_start_date( $event, false, 'M' ), 
                          tribe_get_start_date( $event, false, 'j' ),
                          $thumbnail );
                              
    $subtitle = _s_get_heading( get_field( 'event_subtitle', $event ), 'h5' );
    
     
    $special_event_title = _s_get_heading( get_field( 'event_special_title', $event ), 'h6' );
    
    $full_date = sprintf( '<span class="event-date">%s</span>', tribe_get_start_date( $event, false, 'l, F j, Y' ) );
    
    $venue = sprintf( '<span class="event-venue">%s</span>', strip_tags( tribe_get_venue( $event ) ) );
    
    // time
    $time = sprintf( '<span class="event-time">%s</span>', tribe_get_start_time( $event, 'g:iA' ) );
    
    // Price - custom field
    $price = get_field( 'event_price', $event );
    if( !empty( $price ) ) {
        $price = sprintf( '<span class="event-price">%s</span>', $price );
    }
    
    $icons = get_event_icons( $event );
    
    $time_price = sprintf( '<span class="event-time-price">%s%s%s</span>', $time, $price, $icons );
    
    $event_meta = sprintf( '<p>%s%s%s</p>', $full_date, $venue, $time_price );
   
    return sprintf( '<div class="event">%s<div class="event-details"><header><a href="%s"><h4>%s</h4>%s%s</a></header>%s</div></div>', 
                    $thumbnail,
                    $link,
                    get_the_title( $event ),
                    $subtitle,
                    $special_event_title,
                    $event_meta                 
    
    );
}


function get_event_icons( $event, $show_empty = false ) {
    
    $icons = '';
    
    $spotify = get_field( 'event_spotify_id', $event );
    if( ! empty( $spotify ) ) {
        $icons .= '<i class="fa fa-spotify" aria-hidden="true"></i>'; 
    }
    
    
    $youtube = get_field( 'event_youtube_video', $event );
    if( ! empty( $youtube ) ) {
        $icons .= '<i class="fa fa-youtube" aria-hidden="true"></i>'; 
    }
        
    $icons = sprintf( '<span class="event-icons">%s</span>', $icons );
    
    if( empty( $icons ) && false == $show_empty ) {
        $icons = '';
    }
    
    return $icons;   
}


// *** Nothing below this line needs to be touched.



function the_events_calendar_register_custom_taxonomies() {
    
    register_taxonomy(
        'series',
        'tribe_events',
        array(
            'label' => __( 'Series Type' ),
            'public' => true,
            'rewrite' => false,
            'hierarchical' => true,
        )
    );
    
    register_taxonomy(
        'genre',
        'tribe_events',
        array(
            'label' => __( 'Genre' ),
            'public' => true,
            'rewrite' => false,
            'hierarchical' => true,
        )
    );
}

add_action( 'init', 'the_events_calendar_register_custom_taxonomies' );


// Register all new custom filters and create taxonomies as needed

if( class_exists( 'Tribe__Events__Filterbar__Filter' ) ) {
    class Tribe__Events__Filterbar__Filters__Series extends Tribe__Events__Filterbar__Filter {
    
        public $type = 'select';
    
        public function get_admin_form() {
            $title = $this->get_title_field();
            $type  = $this->get_multichoice_type_field();
    
            return $title . $type;
        }
    
        protected function get_values() {
            $terms = array();
    
            // Load all available event categories
            $source = get_terms( 'series', array( 'orderby' => 'name', 'order' => 'ASC' ) );
            if ( empty( $source ) || is_wp_error( $source ) ) {
                return array();
            }
    
            // Preprocess the terms
            foreach ( $source as $term ) {
                $terms[ (int) $term->term_id ] = $term;
                $term->parent                  = (int) $term->parent;
                $term->depth                   = 0;
                $term->children                = array();
            }
    
            // Initally copy the source list of terms to our ordered list
            $ordered_terms = $terms;
    
            // Re-order!
            foreach ( $terms as $id => $term ) {
                // Skip root elements
                if ( 0 === $term->parent ) {
                    continue;
                }
    
                // Reposition child terms within the ordered terms list
                unset( $ordered_terms[ $id ] );
                $term->depth                             = $this->get_depth( $term );
                $terms[ $term->parent ]->children[ $id ] = $term;
            }
    
            // Finally flatten out and return
            return $this->flattened_term_list( $ordered_terms );
        }
    
        /**
         * Get Term Depth
         *
         * @since 4.5
         *
         * @param     $term
         * @param int $level
         *
         * @return int
         */
        protected function get_depth( $term, $level = 0 ) {
            if ( 0 == $term->parent ) {
                return $level;
            } else {
                $level++;
                $term = get_category( $term->parent );
    
                return $this->get_depth( $term, $level );
            }
    
        }
    
        /**
         * Flatten out the hierarchical list of event categories into a single list of values,
         * applying formatting (non-breaking spaces) to help indicate the depth of each nested
         * item.
         *
         * @param array $term_items
         * @param array $existing_list
         *
         * @return array
         */
        protected function flattened_term_list( array $term_items, array $existing_list = null ) {
            // Pull in the existing list when called recursively
            $flat_list = is_array( $existing_list ) ? $existing_list : array();
    
            // Add each item - including nested items - to the flattened list
            foreach ( $term_items as $term ) {
    
                $has_child = ! empty( $term->children ) ? ' has-child closed' : '';
                $parent_child_cat = '';
                if ( ! $term->parent && $has_child ) {
                    $parent_child_cat = ' parent-' . absint( $term->term_id );
                } elseif ( $term->parent && $has_child ) {
                    $parent_child_cat = ' parent-' . absint( $term->term_id ) . ' child-' . absint( $term->parent );
                } elseif ( $term->parent && ! $has_child ) {
                    $parent_child_cat = ' child-' . absint( $term->parent );
                }
    
                $flat_list[] = array(
                    'name'  => $term->name,
                    'depth' => $term->depth,
                    'value' => $term->term_id,
                    'data'  => array( 'slug' => $term->slug ),
                    'class' =>
                        esc_html( $this->set_category_class( $term->depth ) ) .
                        'tribe-events-category-' . $term->slug .
                        $parent_child_cat .
                        $has_child,
                );
    
                if ( ! empty( $term->children ) ) {
                    $child_items = $this->flattened_term_list( $term->children, $existing_list );
                    $flat_list   = array_merge( $flat_list, $child_items );
                }
            }
    
            return $flat_list;
        }
    
        /**
         * Return class based on dept of the event category
         *
         * @param $depth
         *
         * @return bool|string
         */
        protected function set_category_class( $depth ) {
    
            $class = 'tribe-parent-cat ';
    
            if ( 1 == $depth ) {
                $class = 'tribe-child-cat ';
            } elseif ( 1 <= $depth ) {
                $class = 'tribe-grandchild-cat tribe-depth-' . $depth . ' ';
            }
    
            /**
             * Filter the event category class based on the term depth for the Filter Bar
             *
             * @param string $class class as a string
             * @param int    $depth numeric value of the depth, parent is 0
             */
            $class = apply_filters( 'tribe_events_filter_event_category_display_class', $class, $depth );
    
            return $class;
        }
    
        /**
         * This method will only be called when the user has applied the filter (during the
         * tribe_events_pre_get_posts action) and sets up the taxonomy query, respecting any
         * other taxonomy queries that might already have been setup (whether by The Events
         * Calendar, another plugin or some custom code, etc).
         *
         * @see Tribe__Events__Filterbar__Filter::pre_get_posts()
         *
         * @param WP_Query $query
         */
        protected function pre_get_posts( WP_Query $query ) {
            $new_rules      = array();
            $existing_rules = (array) $query->get( 'tax_query' );
            $values         = (array) $this->currentValue;
    
            // if select display and event category has children get all those ids for query
            if ( 'select' === $this->type ) {
    
                $categories = get_categories( array(
                    'taxonomy' => 'series',
                    'child_of' => current( $values ),
                ) );
    
                if ( ! empty( $categories ) ) {
                    foreach ( $categories as $category ) {
                        $values[] = $category->term_id;
                    }
                }
            } elseif ( 'multiselect' === $this->type ) {
                $values = ! empty( $values[0] ) ? explode( ',', $values[0] ) : $values;
            }
    
            $new_rules[] = array(
                'taxonomy' => 'series',
                'operator' => 'IN',
                'terms'    => $values,
            );
    
            /**
             * Controls the relationship between different taxonomy queries.
             *
             * If set to an empty value, then no attempt will be made by the additional field filter
             * to set the meta_query "relation" parameter.
             *
             * @var string $relation "AND"|"OR"
             */
            $relationship = apply_filters( 'tribe_events_filter_taxonomy_relationship', 'AND' );
    
            /**
             * If taxonomy filter meta queries should be nested and grouped together.
             *
             * The default is true in WordPress 4.1 and greater, which allows for greater flexibility
             * when combined with taxonomy queries added by other filters/other plugins.
             *
             * @var bool $group
             */
            $nest = apply_filters( 'tribe_events_filter_nest_taxonomy_queries', version_compare( $GLOBALS['wp_version'], '4.1', '>=' ) );
    
            if ( $nest ) {
                $new_rules = array(
                    __CLASS__ => $new_rules,
                );
            }
    
            $tax_query = array_merge_recursive( $existing_rules, $new_rules );
    
            // Apply the relationship (we leave this late, or the recursive array merge would potentially cause duplicates)
            if ( ! empty( $relationship ) && $nest ) {
                $tax_query[ __CLASS__ ]['relation'] = $relationship;
            } elseif ( ! empty( $relationship ) ) {
                $tax_query['relation'] = $relationship;
            }
    
            // Apply our new meta query rules
            $query->set( 'tax_query', $tax_query );
        }
    }
    
    new Tribe__Events__Filterbar__Filters__Series( 'Series', 'series_filter' );


    class Tribe__Events__Filterbar__Filters__Genre extends Tribe__Events__Filterbar__Filter {
    
        public $type = 'select';
    
        public function get_admin_form() {
            $title = $this->get_title_field();
            $type  = $this->get_multichoice_type_field();
    
            return $title . $type;
        }
    
        protected function get_values() {
            $terms = array();
    
            // Load all available event categories
            $source = get_terms( 'genre', array( 'orderby' => 'name', 'order' => 'ASC' ) );
            if ( empty( $source ) || is_wp_error( $source ) ) {
                return array();
            }
    
            // Preprocess the terms
            foreach ( $source as $term ) {
                $terms[ (int) $term->term_id ] = $term;
                $term->parent                  = (int) $term->parent;
                $term->depth                   = 0;
                $term->children                = array();
            }
    
            // Initally copy the source list of terms to our ordered list
            $ordered_terms = $terms;
    
            // Re-order!
            foreach ( $terms as $id => $term ) {
                // Skip root elements
                if ( 0 === $term->parent ) {
                    continue;
                }
    
                // Reposition child terms within the ordered terms list
                unset( $ordered_terms[ $id ] );
                $term->depth                             = $this->get_depth( $term );
                $terms[ $term->parent ]->children[ $id ] = $term;
            }
    
            // Finally flatten out and return
            return $this->flattened_term_list( $ordered_terms );
        }
    
        /**
         * Get Term Depth
         *
         * @since 4.5
         *
         * @param     $term
         * @param int $level
         *
         * @return int
         */
        protected function get_depth( $term, $level = 0 ) {
            if ( 0 == $term->parent ) {
                return $level;
            } else {
                $level++;
                $term = get_category( $term->parent );
    
                return $this->get_depth( $term, $level );
            }
    
        }
    
        /**
         * Flatten out the hierarchical list of event categories into a single list of values,
         * applying formatting (non-breaking spaces) to help indicate the depth of each nested
         * item.
         *
         * @param array $term_items
         * @param array $existing_list
         *
         * @return array
         */
        protected function flattened_term_list( array $term_items, array $existing_list = null ) {
            // Pull in the existing list when called recursively
            $flat_list = is_array( $existing_list ) ? $existing_list : array();
    
            // Add each item - including nested items - to the flattened list
            foreach ( $term_items as $term ) {
    
                $has_child = ! empty( $term->children ) ? ' has-child closed' : '';
                $parent_child_cat = '';
                if ( ! $term->parent && $has_child ) {
                    $parent_child_cat = ' parent-' . absint( $term->term_id );
                } elseif ( $term->parent && $has_child ) {
                    $parent_child_cat = ' parent-' . absint( $term->term_id ) . ' child-' . absint( $term->parent );
                } elseif ( $term->parent && ! $has_child ) {
                    $parent_child_cat = ' child-' . absint( $term->parent );
                }
    
                $flat_list[] = array(
                    'name'  => $term->name,
                    'depth' => $term->depth,
                    'value' => $term->term_id,
                    'data'  => array( 'slug' => $term->slug ),
                    'class' =>
                        esc_html( $this->set_category_class( $term->depth ) ) .
                        'tribe-events-category-' . $term->slug .
                        $parent_child_cat .
                        $has_child,
                );
    
                if ( ! empty( $term->children ) ) {
                    $child_items = $this->flattened_term_list( $term->children, $existing_list );
                    $flat_list   = array_merge( $flat_list, $child_items );
                }
            }
    
            return $flat_list;
        }
    
        /**
         * Return class based on dept of the event category
         *
         * @param $depth
         *
         * @return bool|string
         */
        protected function set_category_class( $depth ) {
    
            $class = 'tribe-parent-cat ';
    
            if ( 1 == $depth ) {
                $class = 'tribe-child-cat ';
            } elseif ( 1 <= $depth ) {
                $class = 'tribe-grandchild-cat tribe-depth-' . $depth . ' ';
            }
    
            /**
             * Filter the event category class based on the term depth for the Filter Bar
             *
             * @param string $class class as a string
             * @param int    $depth numeric value of the depth, parent is 0
             */
            $class = apply_filters( 'tribe_events_filter_event_category_display_class', $class, $depth );
    
            return $class;
        }
    
        /**
         * This method will only be called when the user has applied the filter (during the
         * tribe_events_pre_get_posts action) and sets up the taxonomy query, respecting any
         * other taxonomy queries that might already have been setup (whether by The Events
         * Calendar, another plugin or some custom code, etc).
         *
         * @see Tribe__Events__Filterbar__Filter::pre_get_posts()
         *
         * @param WP_Query $query
         */
        protected function pre_get_posts( WP_Query $query ) {
            $new_rules      = array();
            $existing_rules = (array) $query->get( 'tax_query' );
            $values         = (array) $this->currentValue;
    
            // if select display and event category has children get all those ids for query
            if ( 'select' === $this->type ) {
    
                $categories = get_categories( array(
                    'taxonomy' => 'genre',
                    'child_of' => current( $values ),
                ) );
    
                if ( ! empty( $categories ) ) {
                    foreach ( $categories as $category ) {
                        $values[] = $category->term_id;
                    }
                }
            } elseif ( 'multiselect' === $this->type ) {
                $values = ! empty( $values[0] ) ? explode( ',', $values[0] ) : $values;
            }
    
            $new_rules[] = array(
                'taxonomy' => 'genre',
                'operator' => 'IN',
                'terms'    => $values,
            );
    
            /**
             * Controls the relationship between different taxonomy queries.
             *
             * If set to an empty value, then no attempt will be made by the additional field filter
             * to set the meta_query "relation" parameter.
             *
             * @var string $relation "AND"|"OR"
             */
            $relationship = apply_filters( 'tribe_events_filter_taxonomy_relationship', 'AND' );
    
            /**
             * If taxonomy filter meta queries should be nested and grouped together.
             *
             * The default is true in WordPress 4.1 and greater, which allows for greater flexibility
             * when combined with taxonomy queries added by other filters/other plugins.
             *
             * @var bool $group
             */
            $nest = apply_filters( 'tribe_events_filter_nest_taxonomy_queries', version_compare( $GLOBALS['wp_version'], '4.1', '>=' ) );
    
            if ( $nest ) {
                $new_rules = array(
                    __CLASS__ => $new_rules,
                );
            }
    
            $tax_query = array_merge_recursive( $existing_rules, $new_rules );
    
            // Apply the relationship (we leave this late, or the recursive array merge would potentially cause duplicates)
            if ( ! empty( $relationship ) && $nest ) {
                $tax_query[ __CLASS__ ]['relation'] = $relationship;
            } elseif ( ! empty( $relationship ) ) {
                $tax_query['relation'] = $relationship;
            }
    
            // Apply our new meta query rules
            $query->set( 'tax_query', $tax_query );
        }
    }
    
    new Tribe__Events__Filterbar__Filters__Genre( 'Genre', 'genre_filter' );

}  

/*
Kyle Rusak Functions
*/

function bsc_festival_to_day_view( $query ) {

	if ( is_admin() || ! $query->is_main_query() || ! is_archive() ) return;
    
    $event_id = false;
    
	/*
	Check if the festival category is in the query, send the day view of the next event if so
	*/
	if( get_query_var( 'tribe_events_cat' ) == 'festival' ){

		$term = get_term_by( 'slug', 'festival', 'tribe_events_cat' );
		
		$events = tribe_get_events(
				array(
					'eventDisplay'=>'list',
					'posts_per_page'=>1,
                    'start_date' => date( 'Y-m-d H:i:s', strtotime( 'today' ) ),
					'tax_query'=> array(
						array(
							'taxonomy' => 'tribe_events_cat',
							'field' => 'slug',
							'terms' => 'festival'
						)
					)
				)
			);
            
        if( !empty( $events ) ) {
            foreach ( $events as $event ) {
                 $event_id = $event->ID;
            }
        }
        
        /*
        By Day
        $day = null;
        		
		if( $event_id ) {
            $day = tribe_get_start_date( $event_id, false, 'Y-m-d' );
        }
  
        $link = tribe_get_day_link( $day );
         
        //$link_2 = add_query_arg( 'action', 'tribe_event_day', $link );
        //$redirect = add_query_arg( 'tribe_eventcategory', '2', $link );   
        */
        
        if( $event_id ) {
            $day = tribe_get_start_date( $event_id, false, 'Y-m-d' );
            $week = tribe_get_first_week_day( $day );
        }

        $link = Tribe__Events__Main::instance()->getLink( 'list', $week, $term ); 
        
        $query_args = array( 
                        'tribe_eventcategory' => '2'
        );
        
        $redirect 	= add_query_arg( $query_args, $link );
		
		header( 'Location: ' . $redirect  );
        exit();			
	
	}
	
	/*
	Check if the year round category is in the query, send the week view of the next event if so
	*/
	if( get_query_var( 'tribe_events_cat' ) == 'year-round' ){

		$term = get_term_by( 'slug', 'year-round', 'tribe_events_cat' );
		
		$events = tribe_get_events(
				array(
					'posts_per_page'=>1,
                    'start_date' => date( 'Y-m-d H:i:s', strtotime( 'today' ) ),
					'tax_query'=> array(
						array(
							'taxonomy' => 'tribe_events_cat',
							'field' => 'slug',
							'terms' => 'year-round'
						)
					)
				)
			);
            
        if( !empty( $events ) ) {
            foreach ( $events as $event ) {
                 $event_id = $event->ID;
            }
        }
        
        $week = false;
		
		if( $event_id ) {
            $day = tribe_get_start_date( $event_id, false, 'Y-m-d' );
            $week = tribe_get_first_week_day( $day );
        }

        $link 		= Tribe__Events__Main::instance()->getLink( 'list', $week, $term );
        
        $query_args = array( 
                        'tribe-bar-date' => $week,
                        'tribe_eventcategory' => '3'
        );
        
        $redirect 	= add_query_arg( $query_args, $link );
        
        wp_redirect( $redirect );
        exit();	
 	
	}

	/*
	No empty calendar, when going to Month it goes to the next event's month
	*/
	if( get_query_var( 'eventDisplay' ) == 'month' ){
	
		$events = tribe_get_events(
				array(
					'eventDisplay'=>'list',
					'posts_per_page'=>1,
                    'start_date' => date( 'Y-m-d H:i:s', strtotime( 'today' ) )
				)
			);
		
		if( !empty( $events ) ) {
            foreach ( $events as $event ) {
                 $event_id = $event->ID;
            }
        }
        
        $term  = null;
        $month = false;
		
		if( $event_id ) {
            $month     	= tribe_get_start_date( $event_id, false, 'Y-m-d' );
        }
	    
        $link 		= Tribe__Events__Main::instance()->getLink( 'month', $month, $term );
        $link_2 	= add_query_arg( 'tribe_eventcategory', '3', $link );
        
        header( 'Location: ' . $link  );
        exit();		
	}
	
	/*
	Redirect any attempt to go to the list view to the month view
	
	if( get_query_var( 'eventDisplay' ) == 'list' ){
	
		$link = tribe_get_events_link();
	
		header( 'Location: ' . $link  );
		exit();		
	
	}
    */
    

}
add_action( 'tribe_events_pre_get_posts', 'bsc_festival_to_day_view', 1 );