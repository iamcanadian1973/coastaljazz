<?php


function _s_load_google_fonts() {

	// change array as needed
	$font_families = array(
			'Roboto:300,400,700'
		);

	// do not touch below here:
  
	$query_args = array(
			'family' => implode( '|', $font_families ),
			'subset' => 'latin,latin-ext,cyrillic,cyrillic-ext',
		);

	$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

	if( !empty( $font_families ) ) {
		wp_enqueue_style( 'google-fonts', $fonts_url, array(), THEME_VERSION );
	}


}

//add_action( 'wp_enqueue_scripts', '_s_load_google_fonts' );


// Load custom fonts such as FontAwesome. Make sure to update version
function _s_load_custom_fonts() {

	$fonts = array(
			'font-awesome' => '//use.fontawesome.com/releases/v5.6.1/css/all.css', 
            'font-awesome-shim' => '//use.fontawesome.com/releases/v5.6.1/css/v4-shims.css'
			);

	foreach( $fonts as $name => $src ) {
		wp_enqueue_style( $name, $src, array(), THEME_VERSION );
	}

}

add_action( 'wp_enqueue_scripts', '_s_load_custom_fonts' );
