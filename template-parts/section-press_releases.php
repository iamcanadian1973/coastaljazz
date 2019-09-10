<?php

/*

Press
		
*/

if( !function_exists( 'section_press' ) ) {
    function section_press() {
        
        global $post;
        
        $prefix = 'press-releases';
         
        static $section_id;
        $section_id++;
        
        $attr = array( 
                'id' => sprintf( 'section-%s-%s', $prefix, $section_id ), 
                'class' => sprintf( 'section section-%s section-%s-%s', $prefix, $prefix, $section_id ) );
          
       $heading = _s_get_heading( get_sub_field( 'heading' ), 'h3' );
       
       
        _s_section_open( $attr );
                
            print( '<div class="column row">' );
            
            if( !empty( $heading ) ) {
                printf( '<header>%s</header>', $heading );
            }
                
            _s_press();
            
            echo '<hr class="bottom" />';
                 
            echo '</div>';
            
        _s_section_close();	   
            
    }
    
}

// Call function
section_press();