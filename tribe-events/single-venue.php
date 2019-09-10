<?php
/**
 * Single Venue Template
 * The template for a venue. By default it displays venue information and lists
 * events that occur at the specified venue.
 *
 * This view contains the filters required to create an effective single venue view.
 *
 * You can recreate an ENTIRELY new single venue view by doing a template override, and placing
 * a single-venue.php file in a tribe-events/pro/ directory within your theme directory, which
 * will override the /views/pro/single-venue.php.
 *
 * You can use any or all filters included in this file or create your own filters in
 * your functions.php. In order to modify or extend a single filter, please see our
 * readme on templates hooks and filters (TO-DO)
 *
 * @package TribeEventsCalendarPro
 *
 * @version 4.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$venue_id     = get_the_ID();
$full_address = tribe_get_full_address();
$telephone    = tribe_get_phone();
//$website_link = tribe_get_venue_website_link();
$website_link = tribe_get_event_meta( $venue_id, '_VenueURL', true );
global $wp_query;
?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="tribe-events-venue">

    <div class="row venue-details">
    
        <div class="small-12 large-6 large-push-6 columns">
        
        <div class="entry-content">
            
            <h2 class="tribe-venue-name"><?php echo tribe_get_venue( $venue_id ); ?></h2>
              
            <div class="venue-address">
 
                <?php if ( $full_address ) : ?>
                <address class="tribe-events-address">
                    <span class="location">
                        <?php echo $full_address; ?>
                    </span>
                </address>
                <?php endif; ?>
            
                <?php if ( $telephone ): ?>
                    <span class="tel">
                        <?php echo $telephone; ?>
                    </span>
                <?php endif; ?>
                
                <?php if ( $website_link ):
                    printf( '<p class="url" style="margin-top: 10px;"><a href="%s">Visit website</a></p>', $website_link ); 
                 endif; ?>
            
                
                 
                 <?php if ( tribe_show_google_map_link() && tribe_address_exists() ) : ?>
				<!-- Google Map Link -->
				<?php printf( '<p style="margin-top: 30px;"><a href="%s" class="button">Get Directions</a></p>', tribe_get_map_link() ); ?>
                
			<?php endif; ?>
            
            </div><!-- .venue-address -->
            
            <!-- Venue Description -->
            <?php if ( get_the_content() ) : ?>
            <div class="tribe-venue-description tribe-events-content">
                <hr />
                <?php the_content(); ?>
            </div>
            <?php endif; ?>
            
            <?php
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
                    
       
       <div class="small-12 large-6 large-pull-6 columns">
            <?php if ( tribe_embed_google_map() && tribe_address_exists() ) : ?>
                <!-- Venue Map -->
                <div class="tribe-events-map">
                    <?php echo tribe_get_embedded_map( $venue_id, '100%', '400px' ); ?>
                </div><!-- .tribe-events-map-wrap -->
            <?php endif; ?>
        </div>
       
        
    </div>
    
    <div class="column row">
	<?php
	// Use the `tribe_events_single_venue_posts_per_page` to filter the number of events to get here.
	echo tribe_venue_upcoming_events( $venue_id, $wp_query->query_vars ); 
    ?>
    </div>

</div><!-- .tribe-events-venue -->
<?php
endwhile;
