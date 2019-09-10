<?php

function _s_press() {
    
    $args = array(
        'post_type'         => 'press_release',
        'posts_per_page'    => -1,
        'post_status'       => 'publish',
        'orderby'           => 'menu_order',
        'order'             => 'ASC'
    );

    $table = new CI_Table();
      
    // Use $loop, a custom variable we made up, so it doesn't overwrite anything
    $loop = new WP_Query( $args );
    
    if ( $loop->have_posts() ) : 
       
        /*
        $th = array();
        $table->set_heading( $th );    
        */
           
        while ( $loop->have_posts() ) : $loop->the_post(); 
        
            $cell = array();
            $cell[] = array( 'data' => get_the_title() );
            $cell[] = array( 'data' => get_field( 'date' ) );
            
            $url = get_field( 'pdf' );
            if( !empty( $url ) ) {
                $url = sprintf( '<a href="%s">Download</a>', $url );
            }
            $cell[] = array( 'data' => $url );
            
            $table->add_row( $cell );
                                
        endwhile;
        
        
        $template = array(
                    'table_open' => '<table class="footable">'
            );
							
		$table->set_template($template);
        
        $content = $table->generate();
							
		printf( '<div id="footable-wrapper" class="footable-wrapper">%s</div>', $content );
							
         
    endif;

    wp_reset_postdata();
    
    
}