<?php

function _get_board_staff() {
    
    
    $rows = get_field( 'categories' );
     
    if( empty( $rows ) ) {
        return false;
    }
    
    $out = '';
    
    foreach( $rows as $row ) {
        
        $heading = $row['heading'];
        $columns = $row['columns'];
         
        $heading = _s_get_heading( $heading, 'h3' );
        
        if( !empty( $heading ) ) {
            $out .= sprintf( '<header class="column row">%s</header>', $heading );
        }
    
        // Output Columns
        
        $out .= '<div class="entry-content">';
                        
        if( count( $columns ) > 1  ) {
            
            $out .= sprintf( '<div class="row">' ); 
             
            foreach( $columns as $column ) {
                $out .= sprintf( '<div class="small-12 large-6 columns column-block">%s</div>', implode( '', $column ) );
            }
            
            $out .= '</div>';
            
        }
        
        else {
            $out .= sprintf( '<div class="column row column-block">%s</div>', implode( '', $columns ) );   
        }
          
        $out .= '</div>';
        
        $out .= '<hr class="bottom" />';
        
    }
    
    return $out;
     
}