<?php

add_action( 'wp_enqueue_scripts', 'load_addtoany_scripts', 15 );
function load_addtoany_scripts() {
		wp_register_script( 'addtoany', '//static.addtoany.com/menu/page.js', FALSE, NULL, TRUE );
 		
		if( is_singular( 'tribe_events' ) ) {
 			wp_enqueue_script( 'addtoany' );
 		}
}

function addtoany_share( $label = 'Share' ) {
	return sprintf( '<span class="social-share">
					<a class="a2a_dd" href="https://www.addtoany.com/share">%s &nbsp;&nbsp;<i class="ion-icons ion-android-share-alt"></i></a></span>',
                     $label );
	
}

// Social icons used in header/footer
function _s_get_addtoany_share_icons( $url = '', $title = '' ) {
	
	global $post;
	
	$socials = array(
        'facebook'    => 'facebook',
        'twitter'     => 'twitter',
        //'google_plus' => 'googleplus',
 	);
	
	
	$anchor_class = 'a2a_button_'; // a2a_button_
	
	$list = '';
		
	foreach( $socials as $network => $icon ) {
  		
		$list .= sprintf('<li class="%1$s"><a class="%2$s%1$s">%3$s<span class="screen-reader-text">%1$s</span></a></li>', 
                         $network, $anchor_class, get_share_icon( $icon ) );	
		
	}
    
    $list .= sprintf( '<li class="share"><a class="a2a_dd" href="https://www.addtoany.com/share">%s</a></li>', get_share_icon( 'share' ) );
			
	return sprintf( '<ul class="share-icons a2a_kit clearfix" data-a2a-url="%s" data-a2a-title="%s">%s</ul>', $url, $title, $list );
}


function get_share_icon( $type ) {
     
     $icons = array( 
     
        'facebook' => '<i class="fa fa-facebook-square" aria-hidden="true"></i>',
        
        'twitter' => '<i class="fa fa-twitter-square" aria-hidden="true"></i>',
        
        'share' => '<i class="fa fa-share-alt-square" aria-hidden="true"></i>'
     
     );
     
     if( isset( $icons[ $type ] ) )
        return $icons[ $type ];
 }
