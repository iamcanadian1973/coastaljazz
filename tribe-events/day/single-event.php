<?php
/**
 * Day View Single Event
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

$event_id = get_the_ID();

$permalink = esc_url( tribe_get_event_link() );

$title = sprintf( '<h5><a class="url" href="%s" rel="bookmark">%s</a></h5>', $permalink, get_the_title());

// custom Venue   
$venue = sprintf( '<span class="event-venue">%s</span>', tribe_get_venue_link( $event_id ) );

// time
$time = sprintf( '<span class="event-time">%s</span>', tribe_get_start_time( null, 'g:iA' ) );

// Price - custom field
$price = get_field( 'event_price' );
$price = sprintf( '<span class="event-price">%s</span>', $price );
  
// But ticket link
$cta_button_text = get_field( 'event_cta_button_text' );
$cta_button_link = get_field( 'event_cta_button_link' );  

$buttons = sprintf( '<a href="%s" class="url button primary">%s</a>', 
           $permalink, esc_html__( 'More info', 'the-events-calendar' ) );

if( !empty( $cta_button_text ) && !empty( $cta_button_link ) ) {
    $buttons .= sprintf( '<a href="%s" class="button secondary">%s</a>', $cta_button_link, $cta_button_text );
}

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
        ?>
        </div>
    </div>
    
    <div class="event-buttons">
        <?php
        echo $buttons;
        ?>
    </div>

</div>