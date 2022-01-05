<?php
/**
 * View: Day Event
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/day/event.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @since 5.0.0
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

$event_classes = tribe_get_post_class( [ 'cj-tribe-events-calendar-list__event', 'cj-tribe-common-g-row', 'cj-tribe-common-g-row--gutters' ], $event->ID );


$permalink = esc_url( $event->permalink );

$title = sprintf( '<h5><a class="url" href="%s" rel="bookmark">%s</a></h5>', $permalink, $event->title );

// custom Venue   
$venue = sprintf( '<span class="event-venue">%s</span>', tribe_get_venue_link( $event->ID ) );

// time
$time = sprintf( '<span class="event-time">%s</span>', tribe_get_start_time( null, 'M j, g:iA' ) );

// Price - custom field
$price = get_field( 'event_price' );
$price = sprintf( '<span class="event-price">%s</span>', $price );

$icons = get_event_icons( $event, true );
?>
<article <?php tribe_classes( $event_classes ) ?>>

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
	printf( '<a href="%s" class="url button primary">%s</a>', 
			esc_url( $event->permalink ), esc_html__( 'More info', 'the-events-calendar' ) );
	
	$button = '';

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

	echo $button;
	?>
</div>

</div>
</article>
