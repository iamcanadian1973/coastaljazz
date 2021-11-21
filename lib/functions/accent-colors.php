<?php


function _s_accent_body_class( $classes ) {
	
	$enable_accents = get_field( 'enable_accent_colours', 'option' );
    
    if( $enable_accents ) {
       $classes[] = 'accent';
    }
	
	return $classes;
}

add_filter( 'body_class', '_s_accent_body_class' );


function _s_enqueue_accents() {

	$version = defined( 'THEME_VERSION' ) && THEME_VERSION ? THEME_VERSION : '1.0';
	$handle  = defined( 'THEME_NAME' ) && THEME_NAME ? sanitize_title_with_dashes( THEME_NAME ) : 'theme';
    
   
    
    wp_add_inline_style( $handle, accent_colors() );
 }

add_action( 'wp_enqueue_scripts', '_s_enqueue_accents', 15 );


function accent_colors() {
    
    $out = '';
    
    $enable_accents = get_field( 'enable_accent_colours', 'option' );
    
    if( ! $enable_accents ) {
        return;
    }
    
    $colors = get_field( 'colors', 'option' );
    
    $primary_accent = $colors['primary_accent'];
    $primary_accent_hover = $colors['primary_accent_hover'];
    $text_links = $colors['text_links'];
    $text_links_hover = $colors['text_links_hover'];
    $primary_button = $colors['primary_button'];
    $primary_button_hover = $colors['primary_button_hover'];
    $footer_button = $colors['footer_button'];
    $footer_button_hover = $colors['footer_button_hover'];
    $footer_links = $colors['footer_links'];
    $footer_links_hover = $colors['footer_links_hover'];
    
    if( !empty( $primary_accent ) && !empty( $primary_accent_hover ) ) {
            
        $out = "
            
            .accent hr {
                border-color: $primary_accent!important;
            }
            
            .accent blockquote p {
                color: $primary_accent!important;
            }
            
            .accent .footer-widgets .widget .social-icons a:hover i {
                color: $primary_accent_hover!important;
            }
            
            .accent .blog-posts h4:after {
                background: $primary_accent!important;
            }
            
            .blog article.type-post h4:after {
                background: $primary_accent!important;
            }
            
            
            .accent .site-header .social-icons a:hover .fa,
            .site-header .search:hover .fa {
                color: $primary_accent!important;
            }
            
            .entry-content h2:after {
                background-color: $primary_accent!important;
            }
            
            
            .accent.single-tribe_events .entry-content #single-tribe-events-header h6 {
                color: $primary_accent!important;
            }
            
            .accent.home .featured-events .event-details h6, .home .upcoming-shows .event-details h6 {
                color: $primary_accent!important;
            } 
            
            
            .accent .nav-primary .menu .menu-item-has-children:active>a, 
            .accent .nav-primary .menu .menu-item-has-children:focus>a, 
            .accent .nav-primary .menu .menu-item-has-children:hover>a {
                color: $primary_accent!important;
            }
            
            .accent .nav-primary .menu .menu-item-has-children:active .sub-menu-toggle:after, 
            .accent .nav-primary .menu .menu-item-has-children:focus .sub-menu-toggle:after, 
            .accent .nav-primary .menu .menu-item-has-children:hover .sub-menu-toggle:after {
                border-color: $primary_accent!important;
            }
            
            .accent .nav-primary .menu .menu-item a:hover {
                color: $primary_accent!important;
            }
            
            @media screen and (min-width: 64em) {
                .accent .nav-primary .menu>.menu-item.current-category-ancestor>a, 
                .accent .nav-primary .menu>.menu-item.current-menu-ancestor>a, 
                .accent .nav-primary .menu>.menu-item.current-menu-item>a, 
                .accent .nav-primary .menu>.menu-item.current-page-ancestor>a, 
                .accent .nav-primary .menu>.menu-item.current_page_parent>a, 
                .accent .nav-primary .menu>.menu-item:active>a, .nav-primary .menu>.menu-item:focus>a, 
                .accent .nav-primary .menu>.menu-item:hover>a {
                    color: $primary_accent!important;
                }
            }
            
            
            @media screen and (min-width: 64em) {
                
                .accent .nav-secondary .menu .menu-item.current-category-ancestor>a, 
                .accent .nav-secondary .menu .menu-item.current-menu-ancestor>a, 
                .accent .nav-secondary .menu .menu-item.current-menu-item>a, 
                .accent .nav-secondary .menu .menu-item.current-menu-parent>a, 
                .accent .nav-secondary .menu .menu-item.current-page-ancestor>a, 
                .accent .nav-secondary .menu .menu-item.current_page_parent>a, 
                .accent .nav-secondary .menu .menu-item:hover>a {
                    color: $primary_accent!important;
                }
            
                .accent .nav-secondary .menu .menu-item.current-category-ancestor, 
                .accent .nav-secondary .menu .menu-item.current-menu-ancestor, 
                .accent .nav-secondary .menu .menu-item.current-menu-item, 
                .accent .nav-secondary .menu .menu-item.current-menu-parent, 
                .accent .nav-secondary .menu .menu-item.current-page-ancestor, 
                .accent .nav-secondary .menu .menu-item.current_page_parent, 
                .accent .nav-secondary .menu .menu-item:hover {
                    border-bottom: 1px solid $primary_accent!important;
                }
            
            }
            
            
            
            .accent .widget-area .widget_subpages ul a {
                color: $primary_accent!important;
                border: 1px solid $primary_accent!important;
            }
            
            .accent .widget-area .widget_subpages ul li.widget_subpages_current_page a {
                color: $primary_accent_hover!important;
                border-color: $primary_accent_hover!important;
            }
            
            
            
            
            .accent .post-type-archive-tribe_events .tribe-events-sub-nav a {
                background: #fff!important;
                border: 1px solid $primary_accent!important;
                color: $primary_accent!important;
            }
            
            .accent.post-type-archive-tribe_events .tribe-grid>h4 {
                border-bottom: 1px solid $primary_accent!important;
            }
            
            
            @media screen and (min-width: 64em) {
               .accent.single-post .nav-secondary .menu .menu-item:hover {
                    border-bottom: 1px solid $primary_accent!important;
                }
                
                .accent.single-post .nav-secondary .menu .menu-item:hover a {
                    color: $primary_accent!important;
                }
            }
            
            .accent.single-post .entry-header h2:after {
                background-color: $primary_accent;
            }
            
            
            
            .accent .section-past-programming .column h5:after, .section-past-programming .columns h5:after {
                background: $primary_accent;
            }
            
            
            .accent .section-press-releases .footable-wrapper .footable {
                width: 100%;
                border-top: 1px solid $primary_accent;
            }
            
            
            .accent.home .featured-events .event-details header:after, 
            .accent.home .upcoming-shows .event-details header:after {
                background: $primary_accent;
            }
            
            
            .accent .tribe-events-list-separator-month {
                border-bottom: 1px solid $primary_accent;
            }
            
        
        ";
    }
    
    
    if( !empty( $text_links ) && !empty( $text_links_hover ) ) {
     
        $out .= "
        
            .accent a {
                color: $text_links;
            }
            .accent a:focus {
                color: $text_links_hover;
            }
            .accent a:visited {
                color: $text_links_hover;
            }
            .accent a:hover { 
                color: $text_links_hover;
            }
            
            .accent .instagram .fa-instagram {
                color: $text_links;
            }
            
            .accent .section .view-all:hover .fa {
                color: $text_links_hover;
            }

            .tribe-events-button:focus, 
            .tribe-events-button:hover, 
            body #tribe-events .tribe-events-button:focus, 
            body #tribe-events .tribe-events-button:hover {
                background: $text_links_hover!important;
            }

            .site-header .social-icons a:focus .fa, .site-header .social-icons a:hover .fa {
                color: $text_links_hover;
            }

            .footer-widgets .widget .social-icons a:focus i, .footer-widgets .widget .social-icons a:hover i {
                color: $text_links_hover;
            }
        
        ";
        
    }

    
    
    if( !empty( $primary_button ) && !empty( $primary_button_hover ) ) {
       
       $out .= "
       
       .accent .button {
            border-color: $primary_button!important;
            color: $primary_button!important;
        }
        .accent .button:hover {
            border-color: $primary_button_hover!important;
            color: $primary_button_hover!important;
        }
        
        .accent .button.secondary {
            background: $primary_button!important;
            border: 1px solid $primary_button!important;
            color: #fff!important;
        }
        
        .accent .button.secondary:hover {
            background: $primary_button_hover!important;
            border: 1px solid $primary_button_hover!important;
            color: #fff!important;
        }
        
        .accent .tribe-events-button, 
        .accent #tribe-events .tribe-events-button {
            background: $primary_button!important;
        }
        .accent .tribe-events-button:hover, 
        .accent #tribe-events .tribe-events-button:hover {
            background: $primary_button_hover!important;
        }
        
        .accent.post-type-archive-tribe_events .tribe-events-sub-nav a {
            color: $primary_button!important;
            border: 1px solid $primary_button!important;
        }
        
        .accent.post-type-archive-tribe_events .tribe-events-sub-nav a:hover {
            color: $primary_button_hover!important;
            border: 1px solid $primary_button_hover!important;
        }
        
        
        .accent.single-post .nav-links a {
            color: $primary_button!important;
            border: 1px solid $primary_button!important;
        }
        
        .accent.single-post .nav-links a:hover {
            color: $primary_button!important;
            border: 1px solid $primary_button!important;
        }
        
        
        .accent .nav-primary .menu .donate a {
            background: $primary_button!important;
            color: #fff!important;
        }
        
        .accent .nav-primary .menu .donate:hover a {
            background: $primary_button_hover!important;
            color: #fff!important;
        }
        
       
       ";
        
    }
    
    
    if( !empty( $footer_button ) && !empty( $footer_button_hover ) ) {
       
       $out .= "
               
        
        .accent .gform_wrapper .gform_footer input, 
        .accent .gform_wrapper .gform_page_footer input {
            background: $footer_button!important;
            border: 1px solid $footer_button!important;
        }
        
        .accent .gform_wrapper .gform_footer input:hover, 
        .accent .gform_wrapper .gform_page_footer input:hover {
            background: $footer_button_hover!important;
            border: 1px solid $footer_button_hover!important;
        }
       
       ";
        
    }
    
    
    
    if( !empty( $footer_links ) && !empty( $footer_links_hover ) ) {
       
       $out .= "

        .accent .site-footer a {
            color: $footer_links!important;
        }
        
        .accent .site-footer a:hover {
            color: $footer_links_hover!important;
        }

       
       ";
        
    }
    
    return $out;
    
}

/*

$primary_accent = '#0081c7'; 
$primary_accent_hover = '';

$primary_colors = 
.accent a {
    color: $primary_accent;
}
.accent a:focus {
    color: $primary_accent_hover;
}
.accent a:hover { 
    color: $primary_accent_hover;
}

.accent hr {
    border-color: $primary_accent;
}

.accent blockquote p {
    color: $primary_accent;
}

.accent .footer-widgets .widget .social-icons a:hover i {
    color: $primary_accent_hover;
}


.accent .instagram .fa-instagram {
    color: $primary_accent;
}

.accent .section .view-all:hover .fa {
    color: $primary_accent_hover;
}

.accent .blog-posts h4:after {
    background: $primary_accent;
}

.blog article.type-post h4:after {
    background: $primary_accent;
}


.accent .site-header .social-icons a:hover .fa,
.site-header .search:hover .fa {
    color: $primary_accent;
}

.entry-content h2:after {
    background-color: $primary_accent;
}


.accent .nav-primary .menu .menu-item-has-children:active>a, 
.accent .nav-primary .menu .menu-item-has-children:focus>a, 
.accent .nav-primary .menu .menu-item-has-children:hover>a {
    color: $primary_accent;
}

.accent .nav-primary .menu .menu-item-has-children:active .sub-menu-toggle:after, 
.accent .nav-primary .menu .menu-item-has-children:focus .sub-menu-toggle:after, 
.accent .nav-primary .menu .menu-item-has-children:hover .sub-menu-toggle:after {
    border-color: $primary_accent;
}

.accent .nav-primary .menu .menu-item a:hover {
    color: $primary_accent;
}

@media screen and (min-width: 64em) {
    .accent .nav-primary .menu>.menu-item.current-category-ancestor>a, 
    .accent .nav-primary .menu>.menu-item.current-menu-ancestor>a, 
    .accent .nav-primary .menu>.menu-item.current-menu-item>a, 
    .accent .nav-primary .menu>.menu-item.current-page-ancestor>a, 
    .accent .nav-primary .menu>.menu-item.current_page_parent>a, 
    .accent .nav-primary .menu>.menu-item:active>a, .nav-primary .menu>.menu-item:focus>a, 
    .accent .nav-primary .menu>.menu-item:hover>a {
        color: $primary_accent;
    }
}


@media screen and (min-width: 64em) {
    
    .accent .nav-secondary .menu .menu-item.current-category-ancestor>a, 
    .accent .nav-secondary .menu .menu-item.current-menu-ancestor>a, 
    .accent .nav-secondary .menu .menu-item.current-menu-item>a, 
    .accent .nav-secondary .menu .menu-item.current-menu-parent>a, 
    .accent .nav-secondary .menu .menu-item.current-page-ancestor>a, 
    .accent .nav-secondary .menu .menu-item.current_page_parent>a, 
    .accent .nav-secondary .menu .menu-item:hover>a {
        color: $primary_accent;
    }

    .accent .nav-secondary .menu .menu-item.current-category-ancestor, 
    .accent .nav-secondary .menu .menu-item.current-menu-ancestor, 
    .accent .nav-secondary .menu .menu-item.current-menu-item, 
    .accent .nav-secondary .menu .menu-item.current-menu-parent, 
    .accent .nav-secondary .menu .menu-item.current-page-ancestor, 
    .accent .nav-secondary .menu .menu-item.current_page_parent, 
    .accent .nav-secondary .menu .menu-item:hover {
        border-bottom: 1px solid $primary_accent;
    }

}



.accent .widget-area .widget_subpages ul a {
    color: $primary_accent;
    border: 1px solid $primary_accent;
}

.accent .widget-area .widget_subpages ul li.widget_subpages_current_page a {
    color: $primary_accent_hover!important;
    border-color: $primary_accent_hover!important;
}




.accent .post-type-archive-tribe_events .tribe-events-sub-nav a {
    background: #fff;
    border: 1px solid $primary_accent;
    color: $primary_accent;
}

.accent.post-type-archive-tribe_events .tribe-grid>h4 {
    border-bottom: 1px solid $primary_accent!important;
}





@media screen and (min-width: 64em) {
   .accent.single-post .nav-secondary .menu .menu-item:hover {
        border-bottom: 1px solid $primary_accent!important;
    }
    
    .accent.single-post .nav-secondary .menu .menu-item:hover a {
        color: $primary_accent!important;
    }
}

.accent.single-post .entry-header h2:after {
    background-color: $primary_accent;
}



.accent .section-past-programming .column h5:after, .section-past-programming .columns h5:after {
    background: $primary_accent;
}


.accent .section-press-releases .footable-wrapper .footable {
    width: 100%;
    border-top: 1px solid $primary_accent;
}





.accent .button {
    border-color: $primary_button;
    color: $primary_button;
}
.accent .button:hover {
    border-color: $primary_button_hover;
    color: $primary_button_hover;
}

.accent .button.secondary {
    background: $primary_button;
    border: 1px solid $primary_button;
    color: #fff;
}

.accent .button.secondary:hover {
    background: $primary_button_hover;
    border: 1px solid $primary_button_hover;
    color: #fff;
}

.accent .tribe-events-button, 
.accent #tribe-events .tribe-events-button {
    background: $primary_accent!important;
}
.accent .tribe-events-button:hover, 
.accent #tribe-events .tribe-events-button:hover {
    background: $primary_accent_hover!important;
}



.accent .gform_wrapper .gform_footer input, 
.accent .gform_wrapper .gform_page_footer input {
    background: $footer_button!important;
    border: 1px solid $footer_button!important;
}

.accent .gform_wrapper .gform_footer input:hover, 
.accent .gform_wrapper .gform_page_footer input:hover {
    background: $footer_button_hover!important;
    border: 1px solid $footer_button_hover!important;
}



.accent .site-footer a {
    color: $footer_links;
}

.accent .site-footer a:hover {
    color: $footer_links_hover;
}

*/