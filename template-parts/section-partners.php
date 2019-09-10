<?php

/*

Partners
		
*/

if( !function_exists( 'section_partners' ) ) {
    function section_partners() {
        
        global $post;
        
        $prefix = 'partners';
         
        static $section_id;
        $section_id++;
        
        $attr = array( 
                'id' => sprintf( 'section-%s-%s', $prefix, $section_id ), 
                'class' => sprintf( 'section section-%s', $prefix ) 
                );
    
        
        $heading = _s_get_heading( get_sub_field( 'heading' ), 'h1' );
        
        $partners = _s_get_partners();
        
        if( empty( $partners ) ) {
            return;
        }
          
        _s_section_open( $attr );
                
            print( '<div class="column row">' );
            
            if( !empty( $heading ) ) {
                printf( '<header class="text-center">%s</header>', $heading );
            }
            
            echo '</div>';
    
            // Output Partners
            printf( '<div class="entry-content">%s</div>', _s_get_partners() );
              
        _s_section_close();	   
            
    }
    
}

// Call function
section_partners();