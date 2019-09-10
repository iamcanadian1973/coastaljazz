<?php

/*
Hero
		
*/

page_hero();
function page_hero() {
    global $post;
    
    $prefix = 'hero_search';
    $prefix = set_field_prefix( $prefix );
    
    $style = '';
    
    $attr = array( 'id' => 'hero', 'class' => 'section page-hero' );
    
    $heading = get_field( sprintf( '%sheading', $prefix ), 'option' );
    
    $content = '';
    
    $background_image	    = get_field( sprintf( '%sbackground_image', $prefix ), 'option' );
    $background_position_x	= get_field( sprintf( '%sbackground_position_x', $prefix ), 'option' );
    $background_position_y	= get_field( sprintf( '%sbackground_position_y', $prefix ), 'option' );
    
    $content = '';
    
    if( !empty( $background_image ) ) {
        $attachment_id = $background_image;
        $size = 'hero';
        $background = wp_get_attachment_image_src( $attachment_id, $size );
        $attr['style'] = sprintf( 'background-image: url(%s);', $background[0] );
        $attr['style'] .= sprintf( ' background-position: %s %s;', $background_position_x, $background_position_y );
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