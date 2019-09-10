<?php

/*
Section - Footer CTA
*/

// site-content needs padding bottom 100px if cta active

 _s_footer_cta();
function _s_footer_cta() {
	
	global $post;
	
	if( is_post_type_archive( 'case_study' ) || is_singular( 'case_study' ) || is_tax( 'case_study_cat' ) ) {
		$post_id = CASE_STUDY_PAGE_ID;	
	}
	else if( is_front_page() || is_page() ) {
		$post_id = get_the_ID();
	}
	else {
		$post_id = false;	
	}
	
	if( ! $post_id ) {
		return false;
	}
	
  	$prefix = 'footer_cta';
	$prefix = set_field_prefix( $prefix );
	
	$show_in_footer = get_field( 'show_in_footer' );
	
	if( ! $show_in_footer ) {
		return false;
	}
	
	$title = get_field( sprintf( '%stitle', $prefix ), $post_id );
    
    $button = get_field( sprintf( '%sbutton', $prefix ), $post_id );
    $button = pb_get_cta_button( $button, array( 'class' => 'btn-clear' ) );
	
	$title = sprintf( '<h2>%s</h2>', $title );
   	
	$content = sprintf( '<div class="column row"><div class="entry-content">%s%s</div></div>', $title, $button );
				
	$attr = array( 'id' => 'footer-cta', 'class' => 'section footer-cta' );
	
 	_s_section_open( $attr );
		echo $content;
	_s_section_close();		
 }