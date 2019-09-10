<?php

/*

Accordion
		
*/

if( !function_exists( 'section_accordion' ) ) {
    function section_accordion() {
        
        global $post;
        
        $prefix = 'accordion';
         
        static $section_id;
        $section_id++;
        
        $attr = array( 
                'id' => sprintf( 'section-%s-%s', $prefix, $section_id ), 
                'class' => sprintf( 'section section-%s section-%s-%s', $prefix, $prefix, $section_id ) );
    
        $rows = get_sub_field( 'accordion' );
        
        if( empty( $rows ) ) {
            return;
        }
        
                
        $accordion = _get_acf_accordion( $rows );
        
        
        // Add section attributes
        $attr = _s_add_page_builder_section_attributes( $attr );
        
          
        _s_section_open( $attr );
                
            print( '<div class="column row">' );
    
            echo $accordion;
            
            echo '<hr class="bottom" />';
                
            echo '</div>';
            
        _s_section_close();	   
            
    }
    
}

// Call function
section_accordion();
