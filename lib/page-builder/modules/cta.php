<?php


/**
 * CTA Button
 * Create a formatted anchor for an ACF button
 * If using clone field check for prefix
 * @param array  $btn_args
 * @param array  $attr
 * @param string $prefix
 * @return string anchor
 */
function pb_get_cta_button( $btn_args = array(), $attr = '', $prefix = '' ) {
	    
    $prefix = set_field_prefix( $prefix );
	
	$button_text = $btn_args[ $prefix . 'text' ];
	$button_link = $btn_args[ $prefix . 'link' ];
	$choose_page = $btn_args[ $prefix . 'page' ];
    $file        = $btn_args[ $prefix . 'file' ];
	$url         = $btn_args[ $prefix . 'url' ];
	$link_target = $btn_args[ $prefix . 'target' ];
	$target = '';
	
	// Link type
    if( 'none' == $button_link || '' == $button_text ) {
        return false;
    }
     
	else if ( $button_link == 'Page' ) {
		if ( ! empty( $choose_page ) ) {
			$link = $choose_page;
		}
 	} else if( $button_link == 'File' ) {
        $link = $file;
 	} else {
		if ( ! empty( $url ) ) {
			$link = $url;
		}
		// Link target
		if ( $link_target == 'New Tab' ) {
			$target = ' target="_blank"';
		}
	} 
	
    	
	if ( ! empty( $attr ) ) {
		$attr = _s_attr( '', $attr );
	}
    	
	$button =  sprintf( '<a href="%s" %s %s><span>%s</span></a>', $link, $attr, $target, $button_text );
            
    return $button;
}


/**
 * CTA Link
 * Create a formatted anchor for an ACF button
 * If using clone field check for prefix
 * @param array  $btn_args
 * @param array  $attr
 * @param string $prefix
 * @return string anchor
 */
function pb_get_cta_link( $btn_args = array(), $attr = '', $prefix = '' ) {
	    
    $link = '';
    
    $prefix = set_field_prefix( $prefix );
	
	$button_link = $btn_args[ $prefix . 'link' ];
	$choose_page = $btn_args[ $prefix . 'page' ];
    $file        = $btn_args[ $prefix . 'file' ];
	$url         = $btn_args[ $prefix . 'url' ];
	$link_target = $btn_args[ $prefix . 'target' ];
	$target = '';
	
	// Link type
    if( 'none' == $button_link ) {
        return false;
    }
     
	else if ( $button_link == 'Page' ) {
		if ( ! empty( $choose_page ) ) {
			$link = $choose_page;
        }
    } else if( $button_link == 'File' ) {
            $link = $file;
 	} else {
		if ( ! empty( $url ) ) {
			$link = $url;
		}
		// Link target
		if ( $link_target == 'New Tab' ) {
			$target = ' target="_blank"';
		}
	} 
	
    	
	if ( ! empty( $attr ) ) {
		$attr = _s_attr( '', $attr );
	}
    	
	return $link;
            
 }