<?php

add_action('pre_get_posts', '_s_filter_search_results');
function _s_filter_search_results($query) {
    // No other checks should be necessary
    if( !is_admin() && $query->is_search ){
       
        $query->set('posts_per_page', -1 );
        
    }
    
}


// Blog/Category archives
add_action('pre_get_posts', '_s_filter_post_archives_for_sticky_posts');
function _s_filter_post_archives_for_sticky_posts($query) {
    // No other checks should be necessary
    if( !is_admin() && $query->is_main_query() && ( $query->is_home() || $query->is_category ) ){
        
        // set the number of posts per page
        $posts_per_page = 3;
        
        $query->set('posts_per_page', $posts_per_page );
        $query->set( 'ignore_sticky_posts', 1 );
        
        /*
        
        // get sticky posts array
        $sticky = get_option( 'sticky_posts' );
 
        // if we have any sticky posts and we are at the first page
        if ( is_array( $sticky ) && !$query->is_paged() ) {

            // Sort the stickies with the newest ones at the top
	        rsort( $sticky );
            
            $sticky_count = count( $sticky );
            
            $total = $sticky_count + $posts_per_page;
            
            // try rounding to the nearest interval of $posts_per_page
            $first_posts_per_page = ceil( $total/$posts_per_page ) * $posts_per_page;
            
            $query->set('posts_per_page', $first_posts_per_page );
            
        // fallback in case we have no sticky posts
        // and we are not on the first page
        }
        else {
             $query->set('posts_per_page', $posts_per_page );
             $query->set( 'ignore_sticky_posts', 1 );
        }
        */
    }
}

// homepage Blog posts
add_action('pre_get_posts', 'ad_custom_query');
function ad_custom_query($query) {
    // No other checks should be necessary
    if ( $query->get( 'custom_query' ) == 1 ) {
        
        // set the number of posts per page
        $posts_per_page = 3;
        
        // get sticky posts array
        $sticky = get_option( 'sticky_posts' );
 
        // if we have any sticky posts and we are at the first page
        if ( is_array( $sticky ) && !$query->is_paged() ) {

            /* Sort the stickies with the newest ones at the top */
	        rsort( $sticky );
            
            $sticky_count = count( $sticky );
            
             // If more sticky posts, just show sticky posts
            if ( $sticky_count >= $posts_per_page ) {
                // Get the 3 newest stickies (change $posts_per_page above for a different number)
                $sticky_posts = array_slice( $sticky, 0, $posts_per_page ); 
                $query->set('post__in', $sticky_posts );
                $query->set('ignore_sticky_posts', 1 );
                
                var_dump( $sticky_count );
            }
            // If less sticky posts than posts per page, adjust posts_per_page
            // $sticky_count < $posts_per_page
            else {
                //$query->set('posts_per_page', $posts_per_page - $sticky_count );
                
                //var_dump( $posts_per_page - $sticky_count );
            }
            
        // fallback in case we have no sticky posts
        // and we are not on the first page
        }
        else {
             $query->set('posts_per_page', $posts_per_page );
        }
    }
}


function _s_add_blog_class( $classes ) {
  
  if ( is_category() || is_author() ) {
      $classes[] = 'blog';
  }
   return $classes;
}
add_filter( 'body_class', '_s_add_blog_class' );



function _get_blog_posts() {
          
    $count_stickies = count( get_option( 'sticky_posts' ) );
    
    $args = array(
        'custom_query'      => 1, 
        'post_type'         => 'post',
        'posts_per_page'    => 3,
        'post_status'       => 'publish',
    );

    $posts = '';
      
    // Use $loop, a custom variable we made up, so it doesn't overwrite anything
    $loop = new WP_Query( $args );
    
    if ( $loop->have_posts() ) : 
        while ( $loop->have_posts() ) : $loop->the_post(); 
            
            $posts .= sprintf( '<div class="column column-block">%s</div>', _get_blog_post() );
 
        endwhile;
    endif;

    wp_reset_postdata();
    
    return $posts;
}

function _get_blog_post() {

    global $post;
    
    $thumbnail = get_the_post_thumbnail_url( $post, 'large' );
    
    if( !empty( $thumbnail ) ) {
        $thumbnail = sprintf( ' style="background-image: url(%s);"', $thumbnail );
    }
    
    $image = sprintf( '<a href="%s" class="thumbnail"%s></a>', get_permalink(), $thumbnail );
    
    $title = sprintf( '<h4><a href="%s">%s</a></h4>', 
                      get_permalink(), get_the_title() );
                      
    $terms = _s_get_post_terms( get_the_ID() );
                      
    $post_meta = sprintf( '<p class="post-meta">%s%s</p>', _s_get_posted_on(), $terms );
    
    $more = sprintf( '<p><a href="%s" class="more">read more <i class="fa fa-chevron-right fa-small" aria-hidden="true"></i></a></p>', 
                     get_permalink() );
     
    return sprintf( '%s%s%s%s', $image, $title, $post_meta, $more );   
}


 
function _s_get_post_author( $size = 90, $user_id = false ) {
    global $post;
    
    if( false == $user_id ) {
        $author_id = get_the_author_meta('ID');
    }
    else {
        $author_id = $user_id;
    }

    $display_name = get_the_author_meta('display_name', $author_id );
    $author_image = '';
    if( $avatar = get_avatar( $author_id, $size ) ) {
         $author_url = get_author_posts_url( $author_id ); 
         return sprintf( '<div class="post-author"><a href="%s">%s<p>%s</p></a></div>',$author_url, $avatar, $display_name );
    }
    
    return '';
        
}


function _s_get_the_author_meta( $field, $user_id = false ) {
    
    if ( in_array( $field, array( 'login', 'pass', 'nicename', 'email', 'url', 'registered', 'activation_key', 'status' ) ) )
		return get_the_author_meta( $field, $user_id );
    
    $author_id = ! $user_id ? get_the_author_meta('ID') : $user_id;
    $value = get_field( $field, 'user_'. $author_id );
    
    return !empty( $value ) ? $value : '';
}


function _s_modify_user_contact_methods( $user_contact ) {

	// Add user contact methods
	$user_contact['facebook']   = __( 'Facebook URL' );
	$user_contact['twitter'] = __( 'Twitter URL' );
    $user_contact['instagram'] = __( 'Instagram URL' );
    $user_contact['youtube'] = __( 'YouTube URL' );
    
	return $user_contact;
}
add_filter( 'user_contactmethods', '_s_modify_user_contact_methods' );



// Callback function to remove default bio field from user profile page & re-title the section
// ------------------------------------------------------------------

if( !function_exists( 'remove_plain_bio' ) ){
	function remove_bio_box($buffer){
		$buffer = str_replace('<h2>About Yourself</h2>','',$buffer);
		$buffer = preg_replace('/<tr class=\"user-description-wrap\"[\s\S]*?<\/tr>/','',$buffer,1);
		return $buffer;
	}
	function user_profile_subject_start(){ ob_start('remove_bio_box'); }
	function user_profile_subject_end(){ ob_end_flush(); }
}
add_action('admin_head-profile.php','user_profile_subject_start');
add_action('admin_footer-profile.php','user_profile_subject_end');



function _s_get_terms_list( $taxonomy = 'category', $post_type = 'post' ) {

 	$orderby      = 'name'; 
	$show_count   = 0;      // 1 for yes, 0 for no
	$pad_counts   = 0;      // 1 for yes, 0 for no
	$hierarchical = 1;      // 1 for yes, 0 for no
	$title        = '';

	$args = array(
	  'echo'		 => FALSE,
	  'hide_empty'   => FALSE, 
	  'taxonomy'     => $taxonomy,
	  'orderby'      => $orderby,
	  'show_count'   => $show_count,
	  'pad_counts'   => $pad_counts,
	  'hierarchical' => $hierarchical,
	  'title_li'     => $title
	);
	
	$current = is_tax() ? '' : 'class="current-cat"';
    
    $permalink = 'post' == $post_type ? get_permalink( get_option( 'page_for_posts' ) ) : get_post_type_archive_link( $post_type ) ;
	
	$all = sprintf( '<li %s><a href="%s">%s</a></li>', $current, $permalink, 'All' );
	
	return sprintf('<div class="terms-list"><ul class="menu">%s%s</ul></div>', $all, wp_list_categories( $args ) );
	
}


function _s_get_post_terms( $post_id ) {
    $taxonomy = 'category';
    $terms = wp_get_post_terms( $post_id, $taxonomy );
    if( !is_wp_error( $terms ) && !empty( $terms ) ) {
        $out = '';
        foreach( $terms as $term ) {
            $out .= sprintf( '<a href="%s" class="term-link"><span>%s</span></a>', 
                             get_term_link( $term->slug, $taxonomy ), $term->name );
        }
        
        return sprintf( '<span class="post-categories">%s</span>', $out );
        
    }
    
}


function _s_get_post_term( $post_id ) {
    $taxonomy = 'category';
    $terms = wp_get_post_terms( $post_id, $taxonomy );
    if( !is_wp_error( $terms ) ) {
        $term = array_pop($terms);
        $term_class = sanitize_title( $term->name );
        return sprintf( '<a href="%s" class="term-link %s">%s<span>%s</span></a>', get_term_link( $term->slug, $taxonomy ), $term_class, get_svg( $term_class ), $term->name );
    }
    
}


function comment_form_submit_button($button) {
    $button = sprintf( "<button class='submit button'><span>%s</span></button>", 'Post Comment' ) . //Add your html codes here
    get_comment_id_fields();
    return $button;
}
add_filter('comment_form_submit_button', 'comment_form_submit_button');