<?php

/*

WYSIWYG
		
*/

if( !function_exists( 'section_wysiwyg' ) ) {
    function section_wysiwyg() {
        
        global $post;
        
        $prefix = 'wysiwyg';
         
        static $section_id;
        $section_id++;
        
        $attr = array( 
                'id' => sprintf( 'section-%s-%s', $prefix, $section_id ), 
                'class' => sprintf( 'section section-%s section-%s-%s', $prefix, $prefix, $section_id ) 
                );
    
        
        $heading = _s_get_heading( get_sub_field( 'heading' ), 'h3' );
        
        $columns = get_sub_field( 'columns' );
        
        if( empty( $columns ) ) {
            return;
        }
        
                
        $columns = _get_acf_columns( $columns );
        
        
        // Add section attributes
        $attr = _s_add_page_builder_section_attributes( $attr );
        
          
        _s_section_open( $attr );
                
            print( '<div class="column row"><div class="entry-content">' );
            
            if( !empty( $heading ) ) {
                printf( '<header>%s</header>', $heading );
            }
    
            // Output Columns
            
            if( count( $columns ) > 1  ) {
                
                print( '<div class="row">' ); 
                
                foreach( $columns as $column ) {
                    printf( '<div class="small-12 large-6 columns column-block">%s</div>', $column );
                }
                
                print( '</div>' );  
                
            }
            
            else {
                printf( '<div class="column row">%s</div>', implode( '', $columns ) );   
            }
            
            echo '<hr class="bottom" />';
                
            echo '</div></div>';
            
        _s_section_close();	   
            
    }
    
}

// Call function
section_wysiwyg();