<?php

/*
Hero
		
*/

page_hero();
function page_hero() {
    global $post;
    
    $prefix = 'hero';
    $prefix = set_field_prefix( $prefix );
    
    $style = '';
    
    $attr = array( 'id' => 'hero', 'class' => 'section page-hero' );
    
    $default_parent_heading = '';
    
    // Set default parent heading
    $page_ancestor_ID           = get_top_parent_id( get_the_ID() );
            
    if( !empty( $page_ancestor_ID ) && $page_ancestor_ID != get_the_ID() ) {
        $default_parent_heading         = get_field( sprintf( '%sparent_heading', $prefix ), $page_ancestor_ID );
        $default_parent_heading         = !empty( $default_parent_heading ) ? $default_parent_heading : get_the_title( $page_ancestor_ID );
    }
    
    $parent_heading 		= get_field( sprintf( '%sparent_heading', $prefix ) );
    $heading 		        = get_field( sprintf( '%sheading', $prefix ) );

    
    // Check defaults
    $parent_heading 		= !empty( $parent_heading ) ? $parent_heading : $default_parent_heading ;
    $heading                = !empty( $heading ) ? $heading : get_the_title();
    
    
    
    $content = '';
    
    // Current page
    $style = _get_page_hero_background( get_the_ID() );
      
    // No background and page has a parent
    if( empty( $style ) && $post->post_parent ) {
        
        $style = _get_page_hero_background( $post->post_parent );
                        
        if( empty( $style ) && $post->post_parent != $page_ancestor_ID ) {
            $style = _get_page_hero_background( $page_ancestor_ID );
        }
    }
    
    $attr['style'] = $style;    

    if( !empty( $parent_heading ) ) {
        
        $depth = get_current_page_depth();
        
        if( $depth == 2 ) {
            $parent_heading = sprintf( '%s > %s', $parent_heading, get_the_title( $post->post_parent ) );
        }
        
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


function _get_page_hero_background( $post_id ) {
    
    $style= false;
    
    $prefix = 'hero';
    $prefix = set_field_prefix( $prefix );
    
    $background_image       = get_field( sprintf( '%sbackground_image', $prefix ), $post_id );
    $background_position_x  = get_field( sprintf( '%sbackground_position_x', $prefix ), $post_id );
    $background_position_y  = get_field( sprintf( '%sbackground_position_y', $prefix ), $post_id );
    
    if( !empty( $background_image ) ) {
        $attachment_id = $background_image;
        $size = 'hero';
        $background = wp_get_attachment_image_src( $attachment_id, $size );
        $style = sprintf( 'background-image: url(%s);', $background[0] );
        
        if( !empty( $style ) ) {
            $style .= sprintf( ' background-position: %s %s;', $background_position_x, $background_position_y );
        }
    }
    
    return $style;
}