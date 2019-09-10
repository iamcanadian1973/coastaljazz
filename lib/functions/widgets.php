<?php
// Example: change sidebar params

/* function _s_widget_display_callback($instance, $widget, $args) {

  if ( strpos( $args['id'], 'cs-' ) === FALSE ) {
	  return $instance;
  }

  $args['before_widget'] = sprintf( '<aside class="widget %s">', $widget->widget_options['classname'] );
  $args['after_widget'] = '</aside>';
  $args['before_title'] = '<h3 class="widget-title">';
  $args['after_title'] = '</h3>';

  $widget->widget($args, $instance);

  return false;
} */

//add_filter( 'widget_display_callback', '_s_widget_display_callback', 10, 3 );


function my_dynamic_sidebar_params( $params ) {
    
    if( is_admin() ) {
        return $params;
    }
	
	// get widget vars
	$widget_name = $params[0]['widget_name'];
	$widget_id = $params[0]['widget_id'];
	$widget_id = 'widget_' . $widget_id;
	
	// bail early if this widget is not a Text widget
	if( $widget_name != 'Text' ) {
		
		return $params;
		
	}
    		
	$button     = get_field( 'widget_button', $widget_id );
    $link       = get_field( 'widget_link', $widget_id );
    $background = strtolower( get_field( 'widget_background', $widget_id ) );
    $background = sanitize_title_with_dashes( $background );
    
    $params[0]['before_widget'] = str_replace( 'widget_text', sprintf( 'widget_cta %s', $background ), $params[0]['before_widget'] );
	
	if( empty( $button ) ) {
       $button = 'Click Here'; 
    }
    
    if( !empty( $link ) ) {
        $link = sprintf( '<p style="margin-bottom: 0;"><a href="%s" class="button light"><span>%s</span></a></p>', $link, $button );
        $params[0]['after_widget'] = sprintf( '<p>%s</p>', $link );
    }
    
	// return
	return $params;

}

add_filter('dynamic_sidebar_params', 'my_dynamic_sidebar_params', 99 );



/**
 * Add Parent to the Subpages Widget.
 *
 * @param array $args Array of arguments.
 * @param array Modified array of arguments for get_pages().
 */
function _s_subpages_widget_args( $args ) {
     
    global $post;
    
    // show children pages if exist, else show siblings
    $post_id = has_children() ? $post->ID : $post->post_parent;
    
    // Build a menu listing top level parent's children
    $args['child_of'] = $post_id;
    $args['parent'] = $post_id;
    $args['sort_column'] = 'menu_order';

    return $args;
}

add_filter( 'be_subpages_widget_args', '_s_subpages_widget_args' );


/**
 * Add span to the Subpages Widget title.
 *
 * @param string $title
 */
function _s_subpages_widget_title( $title ) {

    return sprintf( '<span>%s</span>', $title );
}

add_filter( 'be_subpages_page_title', '_s_subpages_widget_title' );
