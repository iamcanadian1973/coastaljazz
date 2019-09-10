<?php

/*
Hero
		
*/

section_hero();
function section_hero() {
    global $post;
    
    $prefix = 'hero';
    $prefix = set_field_prefix( $prefix );
    
    $attr = array( 'id' => 'hero', 'class' => 'section page-hero' );
    
    $queried_object = get_queried_object(); 
    $taxonomy = $queried_object->taxonomy;
    $term_id = $queried_object->term_id; 
    $post_id =  $queried_object;

    $heading = single_cat_title( '', '' );
    remove_filter('term_description','wpautop');
    $description = category_description();
    add_filter('term_description','wpautop');
    $background_image	= get_field( sprintf( '%sbackground_image', $prefix ), $post_id );
    
    if( empty( $background_image ) ) {
        $post_id = get_option('page_for_posts');
        $background_image	= get_field( sprintf( '%sbackground_image', $prefix ), $post_id );
    }
        
    $background_position_x	= get_field( sprintf( '%sbackground_position_x', $prefix ), $post_id );
    $background_position_y	= get_field( sprintf( '%sbackground_position_y', $prefix ), $post_id );
    
    
    $content = '';
    
    if( !empty( $background_image ) ) {
        $attachment_id = $background_image;
        $size = 'hero';
        $background = wp_get_attachment_image_src( $attachment_id, $size );
        $attr['style'] = sprintf( 'background-image: url(%s);', $background[0] );
        $attr['style'] .= sprintf( ' background-position: %s %s;', $background_position_x, $background_position_y );
    }
    
    $content .= sprintf( '<h5>%s</h5>', 'Blog' );
    
    if( !empty( $heading ) ) {
        $content .= sprintf( '<h1>%s</h1>', $heading );
    }
      
    _s_section_open( $attr );
            
        if( !empty( $content ) ) {
            
            print( '<div class="column row">' );

            printf( '<header class="entry-header">%s</header>', $content );
            
            echo '</div>';
        }
        
 
    _s_section_close();	   
        
}