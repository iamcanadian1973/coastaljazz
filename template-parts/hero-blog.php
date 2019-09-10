<?php

/*
Hero
		
*/

section_hero_blog();
function section_hero_blog() {
    
    $args = array(
        'post_type'      => 'page',
        'p'				 => get_option('page_for_posts'),
        'posts_per_page' => 1,
        'post_status'    => 'publish'
    );

    // Use $loop, a custom variable we made up, so it doesn't overwrite anything
    $loop = new WP_Query( $args );
    
    // have_posts() is a wrapper function for $wp_query->have_posts(). Since we
    // don't want to use $wp_query, use our custom variable instead.
    if ( $loop->have_posts() ) : 
        while ( $loop->have_posts() ) : $loop->the_post(); 
        
            get_template_part( 'template-parts/hero', 'page' );
     
        endwhile;
    endif;
    
    // We only need to reset the $post variable. If we overwrote $wp_query,
    // we'd need to use wp_reset_query() which does both.
    wp_reset_postdata();   
}