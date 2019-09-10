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
<div class="tribe-grid">
        <?php while ( tribe_events_week_have_days() ) : tribe_events_week_the_day(); ?>
            
                <?php

                $day = tribe_events_week_get_current_day();
                
                if( !empty( $day ) ) {
                    
                    if( empty( $day['all_day_events'] ) && empty( $day['hourly_events'] ) ) {
                        continue;
                    }
                    
                                         
                    printf( '<h4>%s</h4>', date( 'l, F j', strtotime( $day['date'] ) ) );
                    
                    foreach ( $day['all_day_events'] as $event ) : 
                        
                        ?><div class="<?php tribe_events_event_classes( $event ) ?>"><?php
                        tribe_get_template_part( 'week/single', 'event', array( 'event' => $event ) );
                        echo '</div>';
                    endforeach;
                 
                     foreach ( $day['hourly_events'] as $event ) : 
                        ?><div class="<?php tribe_events_event_classes( $event ) ?>"><?php
                        tribe_get_template_part( 'week/single', 'event', array( 'event' => $event ) );
                        echo '</div>';
                    endforeach;
                     
                }

        endwhile; ?>
    </div><!-- .tribe-grid-content-wrap -->
