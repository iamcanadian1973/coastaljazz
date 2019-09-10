<?php

/*
Hero - single event, we use the event category hero
		
*/

page_hero();
function page_hero() {
    global $post;
    
    $prefix = 'event_category_hero';
    $prefix = set_field_prefix( $prefix );
    
    $attr = array( 'id' => 'hero', 'class' => 'section page-hero' );
    
    $post_terms = wp_get_post_terms( $post->ID, 'tribe_events_cat',array('fields' => 'ids') );
        
    if( is_wp_error( $post_terms ) || empty( $post_terms )  ) {
         return false;
    }
 
    $current_term_id = $post_terms[0];
    $event_category = sprintf( 'term_%s', $current_term_id );
               
    $parent_heading 		= get_field( sprintf( '%sparent_heading', $prefix ), $event_category );
    
    // Get Hero heading, default to page title
    $heading 		        = get_field( sprintf( '%sheading', $prefix ), $event_category );
     
    $background_image	    = get_field( sprintf( '%sbackground_image', $prefix ), $event_category );
    $background_position_x	= get_field( sprintf( '%sbackground_position_x', $prefix ), $event_category );
    $background_position_y	= get_field( sprintf( '%sbackground_position_y', $prefix ), $event_category );
    
    $content = '';
        
    if( !empty( $background_image ) ) {
        $attachment_id = $background_image;
        $size = 'hero';
        $background = wp_get_attachment_image_src( $attachment_id, $size );
        $attr['style'] = sprintf( 'background-image: url(%s);', $background[0] );
        $attr['style'] .= sprintf( ' background-position: %s %s;', $background_position_x, $background_position_y );
    }
    
    if( !empty( $parent_heading ) ) {
        $content .= sprintf( '<h5>%s</h5>', $parent_heading );
    }
    
    if( !empty( $heading ) ) {
        $content .= sprintf( '<h1>%s</h1>', $heading );
    }
      
    _s_section_open( $attr );
            
        if( !empty( $content ) ) {
            
            print( '<div class="row"><div class="small-12 columns">' );

            printf( '<header class="entry-header">%s</header>', $content );
            
            echo '</div></div>';
        }
        
 
    _s_section_close();	   
        
}