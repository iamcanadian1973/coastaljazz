<?php

/**
 * Custom Body Class
 *
 * Add additional body classes to pages for targeting.
 *
 * @param array $classes
 * @return array
 */
function _s_add_custom_body_class( $classes ) {
		
 	if( wp_is_mobile() ) {
		$body_class = 'mobile';
	}
	
	
	
	// If exists add body class
	if( !empty( $body_class ) ) {
		$classes[] = $body_class;
	}
	
	return $classes;
}
add_filter( 'body_class', '_s_add_custom_body_class' );


// =======================================================================//
// Foundation 6 Gallery
// =======================================================================//

add_filter( 'post_gallery', 'f5_gallery', 10, 2 );

function f5_gallery( $output, $attr ) {
	global $post;
	
	/*
	if ( isset( $attr['type'] ) && $attr['type'] == 'sponsors' ) {
		f5_sponsors_gallery( $output, $attr );
	}
	*/

	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( ! $attr['orderby'] ) {
			unset( $attr['orderby'] );
		}
	}

	extract( shortcode_atts( array(
		'order'   => 'ASC',
		'orderby' => 'menu_order ID',
		'id'      => $post->ID,
		'columns' => 3,
		'size'    => 'thumbnail',
		'include' => '',
		'exclude' => '',
	), $attr ) );


	$id = intval( $id );
	if ( 'RAND' === $order ) {
		$orderby = 'none';
	}

	if ( ! empty( $include ) ) {
		$include         = preg_replace( '/[^0-9,]+/', '', $include );
		$attachments_arr = get_posts( array(
			'include'        => $include,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => $order,
			'orderby'        => $orderby
		) );

		$attachments = array();
		foreach ( $attachments_arr as $key => $val ) {
			$attachments[ $val->ID ] = $attachments_arr[ $key ];
		}
	}

	if ( empty( $attachments ) ) {
		return '';
	}
	
	$classes = 'gallery';
	
	if( $size == 'logo' ) {
		$classes = 'sponsors';
	}
	
	$output = sprintf( '<div class="row small-up-2 medium-up-%s %s">', $columns, $classes );

	foreach ( $attachments as $id => $attachment ) {
		$img     = wp_get_attachment_image_src( $id, $size );
		$img_big = wp_get_attachment_image_src( $id, 'full' );
		$link    = get_field( 'custom_link', $id );
		
		$caption = ( ! $attachment->post_excerpt ) ? '' :  esc_attr( $attachment->post_excerpt ) ;
		
		if( $size == 'logo' && $link != '' ) {
			$output .= sprintf( '<div class="column"><a href="%s" title="%s" target="_blank"><img src="%s" alt="%s" /></a></div>', $link, $caption, $img[0], esc_attr( $post->title ) );
		}
		else {
			$output .= sprintf( '<div class="column"><a href="%s" title="%s"><img src="%s" title="" alt="%s" style="width: 100%%;" /></a></div>', $img_big[0], $caption, $img[0], esc_attr( $post->title ) );
		}

	}

	$output .= '</div>';

	return $output;
}