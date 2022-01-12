<?php

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

/* Frontpage */

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

/* Header */

.accent .site-header .social-icons a:hover .fa,
.site-header .search:hover .fa {
    color: $primary_accent;
}

.entry-content h2:after {
    background-color: $primary_accent;
}

/* Primary */

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

/* Secondary Nav */

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


/* Widgets */

.accent .widget-area .widget_subpages ul a {
    color: $primary_accent;
    border: 1px solid $primary_accent;
}

.accent .widget-area .widget_subpages ul li.widget_subpages_current_page a {
    color: $primary_accent_hover!important;
    border-color: $primary_accent_hover!important;
}

/* Events */



.accent .post-type-archive-tribe_events .tribe-events-sub-nav a {
    background: #fff;
    border: 1px solid $primary_accent;
    color: $primary_accent;
}

.accent.post-type-archive-tribe_events .tribe-grid>h4 {
    border-bottom: 1px solid $primary_accent!important;
}




/* Blog */

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


/* Past Programming */

.accent .section-past-programming .column h5:after, .section-past-programming .columns h5:after {
    background: $primary_accent;
}

/* Press */

.accent .section-press-releases .footable-wrapper .footable {
    width: 100%;
    border-top: 1px solid $primary_accent;
}




/* Buttons */

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

/* 
Removed 2022
.accent .tribe-events-button, 
.accent #tribe-events .tribe-events-button {
    background: $primary_accent!important;
}
.accent .tribe-events-button:hover, 
.accent #tribe-events .tribe-events-button:hover {
    background: $primary_accent_hover!important;
} */


/* Footer Buttons */

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


/* Footer Links */

.accent .site-footer a {
    color: $footer_links;
}

.accent .site-footer a:hover {
    color: $footer_links_hover;
}
