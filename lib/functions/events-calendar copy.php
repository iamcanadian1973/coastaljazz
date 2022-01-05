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
    
   $args = array(
           // 'eventDisplay' => 'custom',
           'start_date'     => 'now',
           'posts_per_page' => 10,           
           'meta_query'     => array(
                array(
                'key' => 'exclude_from_home',
                'type' => 'BOOLEAN',
                'value' => 0
                )
            )
       );
    
    $events = tribe_get_events( $args );
    
    // exclude_from_home
        
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
       //'eventDisplay' => 'list',
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
        
    $event_id = is_null( $event ) ? get_the_ID() : $event->ID ;
    
    $icons = '';
    
    $spotify = get_field( 'event_spotify_id', $event );
    if( ! empty( $spotify ) ) {
        $icons .= '<i class="fa fa-spotify" aria-hidden="true"></i>'; 
    }
    
    
    $youtube = get_field( 'event_youtube_video', $event );
    if( ! empty( $youtube ) ) {
        $icons .= '<i class="fa fa-youtube" aria-hidden="true"></i>'; 
    }
            
    // Share icons
    
    $calendar_links = '<a href="' . Tribe__Events__Main::instance()->esc_gcal_url( tribe_get_gcal_link() ) . '" title="' . esc_attr__( 'Add to Google Calendar', 'the-events-calendar' ) . '">+ ' . esc_html__( 'Google Calendar', 'the-events-calendar' ) . '</a>';
    $calendar_links .= '<a href="' . esc_url( tribe_get_single_ical_link() ) . '" title="' . esc_attr__( 'Download .ics file', 'the-events-calendar' ) . '" >+ ' . esc_html__( 'iCal Export', 'the-events-calendar' ) . '</a>';
    
    $icons .= sprintf( '<button type="button" data-toggle="event-%s"><i class="fa fa-calendar-plus" aria-hidden="true"></i></button>
<div class="dropdown-pane top add-to-calendar" id="event-%s" data-dropdown data-hover="true" data-hover-pane="true">%s</div>', 
                   $event_id,
                   $event_id,
                   $calendar_links
              );
    
    $icons = sprintf( '<span class="event-icons">%s</span>', $icons );
    
    if( empty( $icons ) && false == $show_empty ) {
        $icons = '';
    }
    
    return $icons;   
}


function event_brite_button( $text, $event_id = false ) {
    
    if( empty( $event_id ) || empty( $text ) ) {
        return false;
    }
    
    ob_start();
    ?>
    <!-- Noscript content for added SEO -->
    <noscript><a href="https://www.eventbrite.ca/e/<?php echo $event_id;?>" class="button secondary" rel="noopener noreferrer" target="_blank"></noscript>
    <!-- You can customize this button any way you like -->
    <button class="button secondary" id="eventbrite-widget-modal-trigger-<?php echo $event_id;?>" type="button"><?php echo $text;?></button>
    <noscript></a></noscript>
    
    <script type="text/javascript">
        window.EBWidgets.createWidget({
            widgetType: 'checkout',
            eventId: '<?php echo $event_id;?>',
            modal: true,
            modalTriggerElementId: 'eventbrite-widget-modal-trigger-<?php echo $event_id;?>'
        });
    </script>    
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;

}

function show_pass_button( $text, $event_id = false ) {
    
    if( empty( $event_id ) || empty( $text ) ) {
        return false;
    }

    if( ! shortcode_exists( 'showpass_widget' ) ) {
        return false;
    }

    $button = sprintf( '[showpass_widget label="%s" slug="%s" class="button secondary" keep_shopping="true"]', $text, $event_id );
    
    return do_shortcode( $button );

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


/*
Kyle Rusak Functions

https://theeventscalendar.com/knowledgebase/k/set-calendar-to-show-specific-month/
*/

function bsc_festival_to_day_view( $query ) {

	if ( is_admin() ) return;
    
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


function tribe_force_event_date( $query ) {
        
    // Don't touch single posts or queries other than the main query
    if ( is_single() ) {
        return;
    }

    // var_dump( $query->get( 'eventDisplay' ) );
 
    // If a date has already been set by some other means, bail out
    if ( strlen( $query->get( 'eventDate' ) ) || ! empty( $_REQUEST['tribe-bar-date'] ) ) {
        return;
    }
 
    // Change this to whatever date you prefer
    $default_date = '2022-10-01';
 
    // Use the preferred default date
    $query->set( 'eventDate', $default_date );
    $query->set( 'event_date', $default_date );
    $_REQUEST['tribe-bar-date'] = $default_date;
}
 
//add_action( 'tribe_events_pre_get_posts', 'tribe_force_event_date' ); 