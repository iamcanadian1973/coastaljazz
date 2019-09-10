<?php
// Creating the widget 
class ACF_WIDGET_CTA extends WP_Widget {

	const WIDGET_DOMAIN = 'acf-widget-cta';
	const WIDGET_ID = 'acf_widget_cta';
	const WIDGET_NAME = 'Call to Action';
	const WIDGET_DESCRIPTION = 'Quiet Transformations Custom Widget';
	const WIDGET_TITLE = '';
	
	function __construct() {
		
		parent::__construct(
			// Base ID of your widget
			self::WIDGET_ID, 
		
			// Widget name will appear in UI
			__( self::WIDGET_NAME, self::WIDGET_DOMAIN), 
		
			// Widget description
			array( 'description' => __( self::WIDGET_DESCRIPTION, self::WIDGET_DOMAIN ), ) 
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		/*
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
        */
		
 		// outputs the content of the widget
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }
        
        // widget ID with prefix for use in ACF API functions
        $widget_id = 'widget_' . $args['widget_id'];
		
        $text       = get_field( 'widget_text', $widget_id );
		$button     = get_field( 'widget_button', $widget_id );
        $link       = get_field( 'widget_link', $widget_id );
        $background = strtolower( get_field( 'widget_background', $widget_id ) );
                
        if( empty( $text ) ) {
            return;
        }
        
        // before and after widget arguments are defined by themes
		echo $args['before_widget'];
        
        if( empty( $button ) ) {
           $button = 'Click Here'; 
        }
        
        if( !empty( $link ) ) {
            $link = sprintf( '<p style="margin-bottom: 0;"><a href="%s" class="primary-button"><span>%s</span></a></p>', $link, $button );
        }
        
        printf( '<div class="cta-box %s"><div class="border"></div><div class="text">%s%s</div></div>', $background, $text, $link );
        
		
		// After Widget
		echo $args['after_widget'];
	}
			
	// Widget Backend 
	public function form( $instance ) {
		
		if ( isset( $instance[ 'title' ] ) ) {
				$title = $instance[ 'title' ];
		}
		else {
			$title = __( self::WIDGET_TITLE, self::WIDGET_DOMAIN );
		}
  	
	}
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
	
} // Class wpb_widget ends here

// Register and load the widget

add_action( 'widgets_init', function{
	register_widget( 'ACF_WIDGET_CTA' );
});