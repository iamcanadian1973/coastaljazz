<?php

/**
*  Creates ACF Options Page(s)
*/


if( function_exists('acf_add_options_sub_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Theme Settings',
        'menu_title' 	=> 'Theme Settings',
        'menu_slug' 	=> 'theme-settings',
        'capability' 	=> 'edit_posts',
        'redirect' 	=> false
    ));
    
    acf_add_options_sub_page(array(
		'page_title' 	=> 'Social Profiles',
		'menu_title' 	=> 'Social Profiles',
        'menu_slug' 	=> 'theme-settings-social',
        'parent' 		=> 'theme-settings',
		'capability' => 'edit_posts',
 		'redirect' 	=> false
	));
    
    acf_add_options_page(array(
        'page_title' 	=> 'Events',
        'menu_title' 	=> 'Events',
        'menu_slug' 	=> 'theme-settings-events',
        'parent' 		=> 'theme-settings',
        'capability' => 'edit_posts',
        'redirect' 	=> false
    ));
    
    acf_add_options_page(array(
        'page_title' 	=> 'Footer',
        'menu_title' 	=> 'Footer',
        'menu_slug' 	=> 'theme-settings-footer',
        'parent' 		=> 'theme-settings',
        'capability' => 'edit_posts',
        'redirect' 	=> false
    ));
    
    acf_add_options_page(array(
        'page_title' 	=> 'Error 404 Page',
        'menu_title' 	=> 'Error 404 Page',
        'menu_slug' 	=> 'theme-settings-404',
        'parent' 		=> 'theme-settings',
        'capability' => 'edit_posts',
        'redirect' 	=> false
    ));
    
    
    acf_add_options_page(array(
        'page_title' 	=> 'Search Page',
        'menu_title' 	=> 'Search Page',
        'menu_slug' 	=> 'theme-settings-search',
        'parent' 		=> 'theme-settings',
        'capability' => 'edit_posts',
        'redirect' 	=> false
    ));
    
    acf_add_options_page(array(
        'page_title' 	=> 'Accent Colors',
        'menu_title' 	=> 'Accent Colors',
        'menu_slug' 	=> 'theme-settings-accent',
        'parent' 		=> 'theme-settings',
        'capability' => 'edit_posts',
        'redirect' 	=> false
    ));
    

}


function _s_get_acf_image( $attachment_id, $size = 'large', $background = FALSE ) {

	if( ! absint( $attachment_id ) )
		return FALSE;

	if( wp_is_mobile() ) {
 		$size = 'large';
	}

	if( $background ) {
		$background = wp_get_attachment_image_src( $attachment_id, $size );
		return $background[0];
	}

	return wp_get_attachment_image( $attachment_id, $size );

}


function _s_get_acf_oembed( $iframe ) {


	// use preg_match to find iframe src
	preg_match('/src="(.+?)"/', $iframe, $matches);
	$src = $matches[1];


	// add extra params to iframe src
	$params = array(
		'controls'    => 1,
		'hd'        => 1,
		'autohide'    => 1,
		'rel' => 0
	);

	$new_src = add_query_arg($params, $src);

	$iframe = str_replace($src, $new_src, $iframe);


	// add extra attributes to iframe html
	$attributes = 'frameborder="0"';

	$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

	$iframe = sprintf( '<div class="embed-container">%s</div>', $iframe );


	// echo $iframe
	return $iframe;
}


function  _get_acf_table( $table ) {
	
	if( empty( $table ) ) {
		return false;
	}
	
	$obj = new CI_Table();
 	
	$template = array(
			'table_open' => '<table class="footable">'
	);
	
	$obj->set_template( $template );
					
	if ( $table['header'] ) {
 		$th = wp_list_pluck( $table['header'], 'c' );
 		$obj->set_heading( $th );
	}

	if( $table['body'] && !empty( $table['body'] ) ) {
		foreach( $table['body'] as $tr ) {
			$tr = wp_list_pluck( $tr, 'c' );
			$obj->add_row( $tr );
		}
	}
	
	return sprintf( '<div class="footable-wrapper">%s</div>', $obj->generate() );
 	
}


function _get_acf_accordion( $rows ) {
     
    $is_active = ' is-active';  
    $accordion_content = '';  
    
    foreach( $rows as $row ) {
        
        $title = $row['title'];
        $content = $row['content'];
        
        if( !empty( $title ) && !empty( $content ) ) {
            $accordion_title = sprintf( '<a href="#" class="accordion-title"><h4>%s</h4></a>', $title );
            $is_active = empty( $accordion_content ) ? $is_active : '';
            $accordion_content .= sprintf( '<li class="accordion-item%s" data-accordion-item>%s
            <div class="accordion-content" data-tab-content>%s</div></li>', $is_active, $accordion_title, $content );
        }
    }
    
    return sprintf( '<ul class="accordion" data-accordion data-allow-all-closed="true">%s</ul>', 	
				$accordion_content );
      
}


function _get_acf_columns( $columns ) {
    
    global $post;
    
    $out = [];
    
     foreach( $columns as $columns ) {
         
        $content = $columns['content'];
        $button  = $columns['button'];
                
        if( !empty( $content ) ) {
            
            $button = pb_get_cta_button( $button, array( 'class' => 'button' ) );
            
            if( !empty( $button ) ) {
                
                $button = sprintf( '<p class="buttons">%s</p>', $button );
            }
            
            $out[] = sprintf( '%s%s', $content, $button );
        }
        
     }
     
     return $out;
}


add_filter('acf/fields/relationship/query/name=related_events', 'my_relationship_query', 10, 3);
function my_relationship_query( $args, $field, $post_id ) {
	
    // exclude current post from being selected
    $args['exclude'] = $post_id;
	
	
	// return
    return $args;
    
}


function my_relationship_result( $title, $post, $field, $post_id ) {
	
    if( function_exists( 'tribe_get_start_date' ) ) {
        $title .= sprintf( ' [%s]', tribe_get_start_date( $post, false, 'l, F j, Y' ) );
    }
    	
	// return
	return $title;
	
}

add_filter('acf/fields/relationship/result/name=related_events', 'my_relationship_result', 10, 4);