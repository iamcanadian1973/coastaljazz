<?php

/*

WYSIWYG
		
*/

if( !function_exists( 'section_hero' ) ) {
    function section_hero() {
        
        global $post;
        
        $prefix = 'hero';
         
        static $section_id;
        $section_id++;
        
        $attr = array( 
                'id' => sprintf( 'section-%s-%s', $prefix, $section_id ), 
                'class' => sprintf( 'section section-%s flex no-horizontal-rule', $prefix ) 
                );
               
        
        $background_image	    = get_sub_field( 'background_image' );
        $background_position_x	= get_sub_field( 'background_position_x' );
        $background_position_y	= get_sub_field( 'background_position_y' );
        $overlay              	= strtolower( get_sub_field( 'overlay' ) );
        $button_class           = 'button';
        
        if( !empty( $background_image ) ) {
            $attachment_id = $background_image;
            $size = 'hero';
            $background = wp_get_attachment_image_src( $attachment_id, $size );
            $attr['style'] = sprintf( 'background-image: url(%s);', $background[0] );
            $attr['style'] .= sprintf( ' background-position: %s %s;', $background_position_x, $background_position_y );
        }
        
        if( !empty( $overlay ) && 'none' != $overlay ) {
             $attr['class'] .= sprintf( ' overlay-%s', $overlay );
            
            if( 'black' == $overlay ) {
                $button_class = 'button secondary';
            }
        }
        
        
        $heading = get_sub_field( 'heading' );
        
        $content = get_sub_field( 'content' );
        
        $button = get_sub_field( 'button' );
        if( !empty( $button ) ) {
             $button = sprintf( '<p class="buttons">%s</p>', pb_get_cta_button( $button, array( 'class' => $button_class ) ) );
        }
        
        // Add section attributes
        $attr = _s_add_page_builder_section_attributes( $attr );
          
        _s_section_open( $attr );
                
            print( '<div class="row"><div class="small-12 large-8 large-centered columns">' );
            
            if( !empty( $heading ) ) {
                printf( '<header><h2>%s</h2></header>', $heading );
            }
    
            echo $content;
            
            echo $button;
                
            echo '</div></div>';
            
        _s_section_close();	   
            
    }
    
}

// Call function
section_hero();