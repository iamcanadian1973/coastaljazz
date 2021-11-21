<?php
/**
 * Week View Single Event
 * This file contains one event in the day view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/day/single-event.php
 *
 * @version 4.5.11
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


$title = sprintf( '<h5><a class="url" href="%s" rel="bookmark">%s</a></h5>', esc_url( tribe_get_event_link( $event ) ), get_the_title( $event ));

// custom Venue   
$venue = sprintf( '<span class="event-venue">%s</span>', tribe_get_venue_link( $event ) );

// time
$time = sprintf( '<span class="event-time">%s</span>', tribe_get_start_time( $event, 'g:iA' ) );

// Price - custom field
$price = get_field( 'event_price', $event );
$price = sprintf( '<span class="event-price">%s</span>', $price );

$icons = get_event_icons( $event );
  
$buttons = sprintf( '<a href="%s" class="button primary desktop" rel="bookmark">%s</a>', esc_url( tribe_get_event_link( $event ) ), esc_html__( 'More info', 'the-events-calendar' ) );

$button = '';

// Button 1
$cta_button_text = get_field( 'event_cta_button_text' );
$cta_button_link = get_field( 'event_cta_button_link' );  
$event_id = get_field( 'event_brite_id', $event );

if( !empty( $cta_button_text ) ) {
    if( !empty( $cta_button_link ) ) {
        $button = sprintf( '<a href="%s" class="button secondary" rel="bookmark">%s</a>', $cta_button_link, $cta_button_text );
    }
    
    if( ! empty( $event_id ) ) {
        $button = show_pass_button( $cta_button_text, $event_id );
    }
}

/* $cta_button_text_2 = get_field( 'event_cta_button_text_2' );
$cta_button_link_2 = get_field( 'event_cta_button_link_2' );
$event_id_2 = get_field( 'event_brite_id_2' );


if( !empty( $cta_button_text_2 ) &&  ( !empty( $cta_button_text_2 ) || !empty( $event_id_2 ) ) ) {
    $button = '';
} */

$buttons .= $button;


?>

<!-- Event Details -->
<div class="event-details">

    <div class="event-meta">
        <div>
        <?php
        echo $title;
        echo $venue;
        echo $time;
        echo $price;
        echo $icons;
        ?>
        </div>
    </div>
    
    <div class="event-buttons">
        <?php
        echo $buttons;
        ?>
    </div>

</div>
