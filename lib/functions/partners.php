<?php

function _s_get_partners() {
    
    $args = array(
        'post_type'         => 'partners',
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
        
            $logos = _get_partner_logos();
            
            $text_links = _get_parner_text_list();
            
            if( !empty( $logos ) ) {
                $posts .= sprintf( '<div class="column row"><h3 class="text-center">%s</h3></div>%s', get_the_title(), $logos );
            }
            
            if( !empty( $text_links ) ) {
                $posts .= sprintf( '<div class="column row"><h3 class="text-center">%s</h3></div>%s', get_the_title(), $text_links );
            }
 
        endwhile;
    endif;

    wp_reset_postdata();
    
    return $posts;
    
}



function _get_partner_logos() {
    
    global $post;
    
    $rows = get_field( 'logos' );
     
    if( empty( $rows ) ) {
        return false;
    }
    
    $columns = '';
    
    foreach( $rows as $row ) {
        
        $logo = $row['logo'];
        $url = $row['url'];
        $anchor_open = $anchor_close = '';
        
        if( !empty( $url ) ) {
            $anchor_open = sprintf( '<a href="%s">', $url );
            $anchor_close = '</a>';
        }
        
        if( !empty( $logo ) ) {
            $logo = _s_get_acf_image( $logo, 'medium' );
            $columns .= sprintf( '<div class="column column-block"><span>%s%s%s</span></div>', $anchor_open, $logo, $anchor_close );
         }
    }
    
    if( !empty( $columns ) ) {
        return sprintf( '<div class="row small-up-1 medium-up-2 large-up-3 grid logos">%s</div><hr />', $columns );
    }
    
    return false;
}


function _get_parner_text_list() {
    
    global $post;
    
    $rows = get_field( 'text_list' );
     
    if( empty( $rows ) ) {
        return false;
    }
    
    $columns = '';
    
    $column_count = 0;
    
    //$column_classes = array( 'small-1-up', 'small-1-up medium-2-up', 'small-1-up medium-2-up large-3-up' );
    
    foreach( $rows as $row ) {
        
        $list = $row['list'];
        
        if( !empty( $list ) ) {
            $list = sprintf( '<ul class="no-style">%s</li>', nl2li( $list ) );
            $columns .= sprintf( '<div class="column column-block">%s</div>', $list );
            $column_count++;
        }
    }
    
    if( !empty( $columns ) ) {
        return sprintf( '<div class="row small-up-1 medium-up-2 large-up-3 grid">%s</div><hr />', $columns );
    }
    
    return false;
    
}
