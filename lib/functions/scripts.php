<?php

// Register scripts to load later as needed
add_action( 'wp_enqueue_scripts', '_s_register_scripts' );
function _s_register_scripts() {

	// Frontpage
    wp_register_script( 'royalslider', THEME_SCRIPTS . '/jquery.royalslider.custom.min.js', array('jquery'), '', true );
	wp_register_script( 'front-page', THEME_SCRIPTS . '/front-page.js', array('jquery', 'royalslider' ), '', true );

	// blog
	wp_register_script( 'infinite-scroll', THEME_SCRIPTS . '/infinite-scroll.pkgd.min.js', array('jquery'), '', true );
	wp_register_script( 'infinite-scroll-config', THEME_SCRIPTS . '/infinite-scroll.js', array('jquery', 'infinite-scroll' ), '', true );

	//wp_register_script( 'modernizr', THEME_SCRIPTS . '/modernizr-custom.js', false, '', false );

    wp_register_script( 'manifest', _s_asset_path( 'scripts/manifest.js' ), ['jquery'], '', false );
    
	wp_register_script( 'vendor', _s_asset_path( 'scripts/vendor.js' ), false, '', true );
    
    // Project
 	wp_register_script( 'project' , _s_asset_path( 'scripts//project.js' ),
			array(
					'jquery',
                    'manifest',
 					'vendor',
 					),
				NULL, TRUE );
    
    // Localize responsive menus script.
    wp_localize_script( 'project', 'genesis_responsive_menu', array(
        'mainMenu'         => __( 'Menu', '_s' ),
        'subMenu'          => __( 'Menu', '_s' ),
        'menuIconClass'    => null,
        'subMenuIconClass' => null,
        'menuClasses'      => array(
            'combine' => array(
                '.nav-primary',
            ),
            'others'  => array( '.nav-secondary' ),
        ),
    ) );
    
    wp_localize_script( 'project', 'coastal', array(
        'tribe_get_events_link'         => tribe_get_events_link()
        
    ) );         
                       
                       
}


// Load Scripts
add_action( 'wp_enqueue_scripts', '_s_load_scripts' );
function _s_load_scripts() {

		wp_enqueue_script( 'project' );

		if( is_front_page() ) {
 			wp_enqueue_script( 'front-page');
		}

		if( is_home() || is_category() ) {
			wp_enqueue_script( 'infinite-scroll-config');
		}

}


/**
 * Get paths for assets
 */
class JsonManifest {
	private $manifest;

	public function __construct( $manifest_path ) {
		if ( file_exists( $manifest_path ) ) {
			$this->manifest = json_decode( file_get_contents( $manifest_path ), true );
		} else {
			$this->manifest = [];
		}
	}

	public function get() {
		return $this->manifest;
	}

	public function getPath( $key = '', $default = null ) {
		$collection = $this->manifest;
		if ( is_null( $key ) ) {
			return $collection;
		}
		if ( isset( $collection[ $key ] ) ) {
			return $collection[ $key ];
		}
		foreach ( explode( '.', $key ) as $segment ) {
			if ( ! isset( $collection[ $segment ] ) ) {
				return $default;
			} else {
				$collection = $collection[ $segment ];
			}
		}

		return $collection;
	}
}


function _s_asset_path( $filename ) {
    $filename = ltrim( $filename, '/' );
	$dist_path = trailingslashit( THEME_DIST );
	static $manifest;

	if ( empty( $manifest ) ) {
		$manifest_path = $dist_path . 'mix-manifest.json';
		$manifest      = new JsonManifest( $manifest_path );
	}

	if ( array_key_exists( $filename, $manifest->get() ) ) {
		return $dist_path . $manifest->get()[ $filename ];
	} else {
		return $dist_path . $filename;
	}
}