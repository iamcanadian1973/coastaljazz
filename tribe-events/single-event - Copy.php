<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version  4.3
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = get_the_ID();

$thumbnail = get_the_post_thumbnail_url( $event_id, 'large' );
if( !empty( $thumbnail ) ) {
    $thumbnail = sprintf( 'style="background-image: url(%s);"', $thumbnail );
    $thumbnail = sprintf( '<div class="thumbnail" %s></div>', $thumbnail );
}
            
$thumbnail = sprintf( '<div class="event-thumbnail"><span class="event-date">%s<i>%s</i></span>%s</div>', 
                      tribe_get_start_date( $event_id, false, 'M' ), 
                      tribe_get_start_date( $event_id, false, 'j' ),
                      $thumbnail );

?>
<div id="tribe-events-content" class="tribe-events-single  entry-content">

    <div class="row">
    
        <div class="small-12 large-6 large-push-6 columns">
            
            <!-- Notices -->
            <?php tribe_the_notices() ?>
            
            <?php
            printf( '<div class="hide-for-large">%s</div>', $thumbnail );
            ?>
        
            <?php the_title( '<h2>', '</h2>' ); ?>
        
            <?php                                  
            $subtitle = _s_get_heading( get_field( 'event_subtitle', $event_id ), 'h4' );
              
            $special_event_title = _s_get_heading( get_field( 'event_special_title', $event_id ), 'h6' );
            
            $full_date = sprintf( '<span class="event-date">%s</span>', tribe_get_start_date( $event_id, false, 'l, F d, Y' ) );
            
            $venue = sprintf( '<span class="event-venue">%s</span>', strip_tags( tribe_get_venue( $event_id ) ) );
            
            // time
            $time = sprintf( '<span class="event-time">%s</span>', tribe_get_start_time( $event_id, 'g:iA' ) );
            
            // Price - custom field
            $price = get_field( 'event_price', $event_id );
            if( !empty( $price ) ) {
                $price = sprintf( '<span class="event-price">%s</span>', $price );
            }
            
            $time_price = sprintf( '<span class="event-time-price">%s%s</span>', $time, $price );
            $event_meta = sprintf( '<div class="event-meta"><p>%s%s%s</p></div>', $full_date, $venue, $time_price );
            
            // CTA Button
            $button = '';
            $event_cta_button_text = get_field( 'event_cta_button_text' );
            $event_cta_button_link = get_field( 'event_cta_button_link' );
            if( !empty( $event_cta_button_text ) && !empty( $event_cta_button_link ) ) {
                $button = sprintf( '<p><a href="%s" class="button">%s</a></p>', $event_cta_button_link, $event_cta_button_text );
            }
            ?>
        
            <!-- Event header -->
            <div id="single-tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
                <?php
                echo $subtitle;
                echo $special_event_title;
                echo '<hr style="margin: 22px 0;" />';
                echo $event_meta;
                echo $button;
                //echo '<hr />';
                ?>
            </div>
            <!-- #tribe-events-header -->
        
            <?php while ( have_posts() ) :  the_post(); ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
         
                    <!-- Event content -->
                    <div class="tribe-events-single-event-description tribe-events-content">
                        <?php 
                        the_content(); 
                        echo '<hr />';
                        ?>
                    </div>
                    <!-- .tribe-events-single-event-description -->			
                </div> <!-- #post-x -->
            <?php endwhile; ?>
        
            <!-- Event footer -->
            <div class="tribe-events-footer">
                
                <h3>Share</h3>
                <?php
                // Social sharing
                echo _s_get_addtoany_share_icons( '' );
                ?>
                
                <?php do_action( 'tribe_events_single_event_after_the_content' ) ?>
            </div>
            <!-- #tribe-events-footer -->
            
        </div>
        
        <div class="small-12 large-6 large-pull-6 columns">
            <?php
            printf( '<div class="show-for-large">%s</div>', $thumbnail );
             
            $youtube = get_field( 'event_youtube_video' );                     
            if( !empty( $youtube ) ) {
                printf( '<div class="youtube-video">%s</div>', apply_filters( 'the_content', $youtube ) );
            }
            
            $spotify = get_field( 'event_spotify_id' );
            if( !empty( $spotify ) ) {
                printf( '<div class="spotify-embed">%s</div>', apply_filters( 'the_content', $spotify ) );
            }
            
            // Back button
            $referrer =  parse_url ( wp_get_referer(), PHP_URL_HOST );
            $host    = parse_url( site_url(), PHP_URL_HOST );
            
            if( $referrer === $host ) {
                printf( '<p style="margin-bottom: 44px;"><a class="go-back" href="%s"><i class="fa fa-chevron-left fa-small" aria-hidden="true"></i> Back to Event Calendar</a></p>', 
                wp_get_referer() );   
            }
            
            ?>
        </div>

    </div>
  
</div><!-- #tribe-events-content -->
