<?php
/**
 * The template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
 		<div class="entry-meta">
            <?php
            global $post;
            
            //printf( '<span>%s</span> ', strtoupper( get_post_type() ) );             
            if ( 'tribe_events' === get_post_type() ) :
			    echo _s_get_heading( get_field( 'event_subtitle' ), 'h5' );
                echo _s_get_heading( get_field( 'event_special_title' ), 'h6' );
                $full_date = sprintf( '<span class="event-date">%s</span>', tribe_get_start_date( $post, false, 'l, F j, Y' ) );
                $venue = sprintf( '<span class="event-venue">%s</span>', strip_tags( tribe_get_venue( $post ) ) );
                // time
                $time = sprintf( '<span class="event-time">%s</span>', tribe_get_start_time( $post, 'g:iA' ) );
                // Price - custom field
                $price = get_field( 'event_price', $post );
                if( !empty( $price ) ) {
                    $price = sprintf( '<span class="event-price">%s</span>', $price );
                }
                
                $time_price = sprintf( '<span class="event-time-price">%s%s</span>', $time, $price );
                
                printf( '<p>%s%s%s</p>', $full_date, $venue, $time_price );
            endif; 
            
            if( 'post' == get_post_type() ) {
                $post_categories =  get_the_category_list( '' );
                $terms = _s_get_post_terms( get_the_ID() );
                
                $post_title = the_title( '<h2>', '</h2>', false );
                $post_author = sprintf( 'Posted by: %s', get_the_author_meta('display_name', $author_id ) );
                printf( '<p class="post-meta">%s%s<br />%s</p>', _s_get_posted_on(), $terms, $post_author );
            }
            ?>
		</div><!-- .entry-meta -->
		
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php
            printf( '<p><a href="%s" class="more">read more <i class="fa fa-chevron-right fa-small" aria-hidden="true"></i></a></p>', 
                     get_permalink() );
        ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
