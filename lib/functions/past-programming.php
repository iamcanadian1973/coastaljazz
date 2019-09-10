<?php

function _get_past_programming() {
    $args = array(
        'post_type'         => 'past_programs',
        'posts_per_page'    => -1,
        'post_status'       => 'publish',
        'orderby'           => 'menu_order',
        'order'             => 'ASC'
    );

    $posts = '';
      
    // Use $loop, a custom variable we made up, so it doesn't overwrite anything
    $loop = new WP_Query( $args );
    
    if ( $loop->have_posts() ) : 
        while ( $loop->have_posts() ) : $loop->the_post(); 
        
            $posts .= _s_get_program();
 
        endwhile;
    endif;

    wp_reset_postdata();
    
    if( !empty( $posts ) ) {
        $posts =sprintf( '<div class="row small-up-1 medium-up-2 large-up-4">%s</div>',  $posts );
    }
    
    return $posts;
    
}


function _s_get_program() {
    
    global $post;
    
    $thumbnail = get_the_post_thumbnail( get_the_ID(), 'large' );
      
    if( empty( $thumbnail ) ) {
        return false;
    }
    
    $pdf = get_field( 'pdf' );
    
    $thumbnail = sprintf( '<a href="%s">%s</a>', $pdf, $thumbnail );
    
    $date = get_field( 'date' );
    
    $title = sprintf( '<h5><a href="%s">%s</a></h5><p>%s</p>', $pdf, get_the_title(), $date );
    
    return sprintf( '<div class="column column-block">%s%s</div>', $thumbnail, $title );
       
}