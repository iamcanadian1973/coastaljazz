<?php

/*

Table
		
*/

if( !function_exists( 'section_table' ) ) {
    function section_table() {
    
        global $post;
        
        $prefix = 'table';
        
        static $section_id;
        $section_id++;
        
        $attr = array( 
                'id' => sprintf( 'section-%s-%s', $prefix, $section_id ), 
                'class' => sprintf( 'section section-%s section-%s-%s', $prefix, $prefix, $section_id ) );
    
        $table = get_sub_field( 'table' );
        
        if( empty( $table ) ) {
            return;
        }
        
        // Add section attributes
        $attr = _s_add_page_builder_section_attributes( $attr );
        
                
        $table = _get_acf_table( $table );
        
          
        _s_section_open( $attr );
                
            print( '<div class="column row">' );
    
            echo $table;
            
            echo '<hr class="bottom" />';
                
            echo '</div>';
            
        _s_section_close();	   
            
    }
    
}

// Call function
section_table();
