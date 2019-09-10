<?php
section_page_builder();
function section_page_builder() {
	
    global $post;
    
    if ( have_rows('sections') ) {
    
        while ( have_rows('sections') ) { 
        
            the_row();
        
            $row_layout = get_row_layout();
            
            get_template_part( 'template-parts/section', $row_layout );
                
        } // endwhile have_rows('sections')
        
    
    } // endif have_rows('sections')
}

// Add Page Builder Section Attributes
function _s_add_page_builder_section_attributes( $attr ) {
    
    global $post;
    
    // Check Settings
    $settings = get_sub_field( 'settings' );
    
    if( !empty( $settings ) ) {
        
        // Hide Horizontal Rule?
        if( isset( $settings['hide_horizontal_rule'] ) ) {
            $hide_horizontal_rule = $settings['hide_horizontal_rule'];
            if( true === $hide_horizontal_rule ) {
                $attr['class'] .= ' no-horizontal-rule';
            }
        }
        
        // Hide Margin Bottom
        if( isset( $settings['hide_margin_bottom'] ) ) {
            $hide_margin_bottom = $settings['hide_margin_bottom'];
            if( true === $hide_margin_bottom ) {
                $attr['class'] .= ' no-margin-bottom';
            }
        }
        
    }
    
    return $attr;
}