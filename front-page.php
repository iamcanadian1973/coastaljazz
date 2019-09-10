<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package coastaljazz
 */

get_header(); ?>

<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">
    
         <?php
        section_hero();
        function section_hero() {
                    
            global $post;
            
            $rows = get_field( 'slides' );
                        
            $slides = '';
            
            if( empty( $rows ) ) {
                return;   
            }
            
            foreach( $rows as $row ) {
                 $photo = _s_get_acf_image( $row['photo'], 'hero', true );
                 $anchor  = pb_get_cta_link( $row['anchor'] );
                                   
                 if( !empty( $anchor ) ) {
                     $url   = sprintf( '<a href="%s" class="rsLink"></a>', $anchor );
                  }
                 
                 if( !empty( $photo ) ) {
                     $photo = sprintf( '<img src="%s" class="rsImg" />', $photo );
                     $slides .= sprintf( '<div class="rsContent">%s%s</div>', $photo, $url );
                 }
                 
            }
            
            if( empty( $slides ) ) {
                return;
            }
                        
            $attr = array( 'class' => 'section slider' );
            
            _s_section_open( $attr );		
             
            printf( '<div id="slider" class="royalSlider rsCustom">%s</div>', $slides );
            
            _s_section_close();	
        }
        
        content_blocks();
        function content_blocks() {
            
            if ( have_rows('content_blocks') ) {
    
                while ( have_rows('content_blocks') ) { 
                
                    the_row();
                
                    $row_layout = get_row_layout();
                    
                    switch( $row_layout ) {
                        case 'cta':
                        section_cta();
                        break;
                        case 'upcoming':
                        section_upcoming_shows();
                        break;
                        case 'featured':
                        section_featured_events();
                        break;
                        case 'instagram':
                        section_instagram();
                        break;
                        case 'blog':
                        section_blog();
                        break;
                        
                    }
                        
                } // endwhile have_rows('sections')
                
            
            } 
            else {
                
                // default order
                
                section_cta();
        
                section_upcoming_shows();
                
                section_featured_events();
                
                section_instagram();
                
                section_blog();
            }
        }
       
        
        
        function section_cta() {
                    
            global $post;
            
            $rows = get_field( 'calls_to_action' );
                        
            $output = $url = '';
            
            if( empty( $rows ) ) {
                return;   
            }
            
            foreach( $rows as $row ) {
                 $photo         = _s_get_acf_image( $row['photo'], 'medium', true );
                 $description   = _s_get_heading( $row['description'], 'h3' );
                 $anchor        = pb_get_cta_link( $row['anchor'] );
                  
                 if( !empty( $anchor ) ) {
                     $url   = sprintf( '<a href="%s"></a>', $anchor );
                  }
                 
                 if( !empty( $photo ) ) {
                     $background = sprintf( 'style="background-image: url(%s);"', $photo );
                     $output .= sprintf( '<div class="column column-block"><div %s>%s%s</div></div>', $background, $description, $url );
                 }
                 
            }
            
            if( empty( $output ) ) {
                return;
            }
                        
            $attr = array( 'class' => 'section calls-to-action' );
            
            _s_section_open( $attr );		
             
            printf( '<div class="row small-up-1 medium-up-2 xlarge-up-4 text-center">%s</div>', $output );
            
            echo '<div class="column row">
                    <hr class="bottom" />
                </div>';
            
            _s_section_close();	
        }
        
        
        
        function section_upcoming_shows() {
            
            $events = get_upcoming_events();
                                                
            if( empty( $events ) ) {
                return;
            }
                        
            $attr = array( 'class' => 'section upcoming-shows' );
            
            _s_section_open( $attr );
            
            print( '<header class="column row"><h3>Upcoming Shows</h3></header>' );	
            
            // Only use Slider if more than 4 events
            if( count( $events ) > 3 ) {
                print( '<div class="column row">' );
                printf( '<div class="slick-shows">%s</div>', implode( '', $events ) );
                print( '</div>' );
            }
            else {
                print( '<div class="row small-up-1 large-up-3">' );
                
                foreach( $events as $event ) {
                    printf( '<div class="column column-block">%s</div>', $event );
                }
                
                print( '</div>' );
            }
            
            
            echo '<div class="column row">
                    <hr class="bottom" />
                </div>';
            
            _s_section_close();	
        }
        
        
        
        function section_featured_events() {
            
            // Optional slick slider add later to homepage settings
            $slick = false;
            
            $events = get_featured_events( $slick );
                                                
            if( empty( $events ) ) {
                return;
            }
                        
            $attr = array( 'class' => 'section featured-events' );
            
            _s_section_open( $attr );		
             
            print( '<header class="column row"><h3>Featured Events</h3></header>' );		
            
            print( '<div class="column row">' );
                        
            if( count( $events ) > 3 && true == $slick ) {
                
                print( '<div class="column row">' );
                printf( '<div class="slick-shows">%s</div>', implode( '', $events ) );
                print( '</div>' );
             }
            else {
                print( '<div class="row small-up-1 medium-up-2 large-up-3">' );
                
                foreach( $events as $event ) {
                    printf( '<div class="column column-block">%s</div>', $event );
                }
                
                print( '</div>' );
            }
            
            
            
            print( '</div>' );
            
            echo '<div class="column row">
                    <hr class="bottom" />
                </div>';
            
            _s_section_close();	
        }
        
        
        
        function section_instagram() {
         
            $out = do_shortcode( '[instagram-feed]' );
            
            $attr = array( 'class' => 'section instagram' );
            
            _s_section_open( $attr );	
            
            printf( '<header class="column row">
                        <h3>#coastaljazz</h3>
                        <a href="%s" class="view-all">View On <i class="fa fa-instagram"></i> Instagram <i class="fa fa-chevron-right fa-small" aria-hidden="true"></i></a>
                    </header>', 'https://www.instagram.com/coastaljazz' );		
            
            printf( '<div class="row">%s</div>', $out );
            
            echo '<div class="column row">
                    <hr class="bottom" />
                </div>';
            
		    _s_section_close();	
        
            
        }
        
        
        
        function section_blog() {            
            
            $posts = _get_blog_posts();
            
            if( empty( $posts ) ) {
                return;
            }
            
            
            $attr = array( 'class' => 'section blog-posts' );
            
            _s_section_open( $attr );	
            
            printf( '<header class="column row"><h3>From Our Blog</h3>
                    <a class="view-all" href="%s">View All Posts <i class="fa fa-chevron-right fa-small" aria-hidden="true"></i></a></header>', get_permalink( get_option( 'page_for_posts' ) ) );		
            
            printf( '<div class="row small-up-1 large-up-3">%s</div>', $posts );
            
		    _s_section_close();	
        
            
        }
        
        ?>

	</main>
    
</div>
<?php
get_footer();
