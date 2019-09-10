<?php

/*

Past Programming
		
*/

if( !function_exists( 'section_past_programming' ) ) {
    function section_past_programming() {
    
        global $post;
        
        $prefix = 'past-programming';
        
        static $section_id;
        $section_id++;
        
        $attr = array( 
                'id' => sprintf( 'section-%s-%s', $prefix, $section_id ), 
                'class' => sprintf( 'section section-%s section-%s-%s', $prefix, $prefix, $section_id ) );
    
        $content = _get_past_programming();
        
        if( empty( $content ) ) {
            return;
        }
        
          
        _s_section_open( $attr );
     
            echo $content;
              
        _s_section_close();	   
            
    }
    
}

// Call function
section_past_programming();
