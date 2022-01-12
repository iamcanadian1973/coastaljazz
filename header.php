<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="dns-prefetch" href="//fonts.googleapis.com">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo THEME_FAVICONS;?>/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo THEME_FAVICONS;?>/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo THEME_FAVICONS;?>/favicon-16x16.png">
<link rel="manifest" href="<?php echo THEME_FAVICONS;?>/manifest.json">
<link rel="mask-icon" href="<?php echo THEME_FAVICONS;?>/safari-pinned-tab.svg" color="#b9914b">
<meta name="theme-color" content="#ffffff">
<script src="https://use.typekit.net/blz1omv.js"></script>
<script>try{Typekit.load({ async: false });}catch(e){}</script>
<script src="https://www.eventbrite.com/static/widgets/eb_widgets.js"></script>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '_s' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="wrap row expanded small-collapse xlarge-uncollapse"><div class="small-12 columns">
            
                <div class="site-branding">
                    <div class="site-title">
                    <?php
                    $site_url = site_url();
                    printf('<a href="%s" title="%s"><img src="%s" alt="%s"/></a>',  
                            $site_url, get_bloginfo( 'name' ), THEME_IMG .'/logo.svg', get_bloginfo( 'name' ) );
                    ?>
                    </div>
                </div>
                
                
                <button class="search" data-toggle="search-form"><i class="fa fa-search" aria-hidden="true"></i></button>
                    <div class="dropdown-pane bottom" id="search-form" data-dropdown data-position="left" data-alignment="top">
                      <?php
                      get_search_form();
                      ?>
                    </div>
                    
                    <?php
                    // social icons
                    echo _s_get_social_icons();
                    ?>
                    
                    <?php
                    $donate_link = get_field( 'donate_link', 'option' );
                    if( !empty( $donate_link ) ) {
                       printf( '<a href="%s" class="button secondary show-for-xxlarge">Donate Now</a>', $donate_link ); 
                    }
                 ?>
                
                
                <nav id="site-navigation" class="nav-primary" role="navigation">
                    <?php
                        // Desktop Menu
                        $args = array(
                            'theme_location' => 'primary',
                            'menu' => 'Primary Menu',
                            'container' => 'false',
                            'container_class' => '',
                            'container_id' => '',
                            'menu_id'        => 'primary-menu',
                            'menu_class'     => 'menu',
                            'before' => '',
                            'after' => '',
                            'link_before' => '',
                            'link_after' => '',
                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'depth' => 0
                        );
                        wp_nav_menu($args);
                    ?>
                </nav>   
                 
          </div>
	    </div>	
    </header><!-- #masthead -->

	

<div id="page" class="site-container">

	<div id="content" class="site-content">