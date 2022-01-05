<?php
/**
 * View: Default Template for Events
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/default-template.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.0.0
 */

use Tribe\Events\Views\V2\Template_Bootstrap;

get_header();

$coastal_event_category = false;

if( isset( $_GET['tribe_eventcategory'] ) ) {
    $coastal_event_category = absint( $_GET['tribe_eventcategory'] );
}


// Get the Hero
if( is_singular( 'tribe_events' ) ) {
    get_template_part( 'template-parts/hero', 'event-single' );
    
    $post_terms = wp_get_post_terms( $post->ID, 'tribe_events_cat',array('fields' => 'ids') );
    if( !is_wp_error( $post_terms ) && !empty( $post_terms )  ) {
        $current_term_id = $post_terms[0];
        
        $event_category = sprintf( 'term_%s', absint( $current_term_id ) );
    
        $page_menu_item = get_field( 'page_menu_item', $event_category );
            
        if( $page_menu_item ) {
            echo _get_events_custom_seconondary_menu( $page_menu_item );
        }
    }    
}
elseif ( is_tax() || ( true == $coastal_event_category ) ) {
    
    get_template_part( 'template-parts/hero', 'event-category' );
   
    if( $coastal_event_category ) {
        $event_category = sprintf( 'term_%s', absint( $_GET['tribe_eventcategory'] ) );
    }
    else {
        $event_category = get_queried_object(); 
    }
    
    $page_menu_item = get_field( 'page_menu_item', $event_category );
        
    if( $page_menu_item ) {
        echo _get_events_custom_seconondary_menu( $page_menu_item );
    }
}
else {
    get_template_part( 'template-parts/hero', 'event-archive' );
}

echo '<div class="column row">';

echo tribe( Template_Bootstrap::class )->get_view_html();

echo '</div>';

get_footer();
