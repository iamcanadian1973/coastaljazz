<?php
/**
 * Week View Grid Hourly Event Loop
 * This file sets up the structure for the week grid hourly event loop
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/pro/week/loop-grid-hourly.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

?>
<div class="tribe-grid-content-wrap">
        <?php while ( tribe_events_week_have_days() ) : tribe_events_week_the_day(); ?>
            
                <?php

                $day = tribe_events_week_get_current_day();
                
                foreach ( $day['all_day_events'] as $event ) : 
                    printf( '<h3>%s</h3>', get_the_title( $event ) );
                endforeach;
                
                foreach ( $day['hourly_events'] as $event ) : 
                    printf( '<h3>%s</h3>', get_the_title( $event ) );
                endforeach;

        endwhile; ?>
    </div><!-- .tribe-grid-content-wrap -->
