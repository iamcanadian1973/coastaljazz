<?php

/****************************************
	Enqueue theme stylesheet
	*****************************************/

function _s_enqueue_stylesheet() {

	$version = defined( 'THEME_VERSION' ) && THEME_VERSION ? THEME_VERSION : '1.0';
	$handle  = defined( 'THEME_NAME' ) && THEME_NAME ? sanitize_title_with_dashes( THEME_NAME ) : 'theme';

	$stylesheet = 'style.css';

	wp_enqueue_style( $handle, trailingslashit( THEME_STYLES ) . $stylesheet, false, $version );
 }

add_action( 'wp_enqueue_scripts', '_s_enqueue_stylesheet', 15 );


/****************************************
	Image Sizes
	*****************************************/

add_image_size( 'hero', 1600, 999 );
add_image_size( 'event-thumbnail', 336, 208 );
