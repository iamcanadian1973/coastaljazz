<?php

/*

Board Staff
		
*/

if( !function_exists( 'section_board_staff' ) ) {
    function section_board_staff() {
    
        global $post;
        
        $prefix = 'board-staff';
        
        static $section_id;
        $section_id++;
        
        $attr = array( 
                'id' => sprintf( 'section-%s-%s', $prefix, $section_id ), 
                'class' => sprintf( 'section section-%s section-%s-%s', $prefix, $prefix, $section_id ) );
    
        $content = _get_board_staff();
        
        if( empty( $content ) ) {
            return;
        }
        
          
        _s_section_open( $attr );
     
            echo '<div class="column row">';
            
            echo $content;
            
            echo '</div>';
              
        _s_section_close();	   
            
    }
    
}

// Call function
section_board_staff();
