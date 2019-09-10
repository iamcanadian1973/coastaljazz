<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */
?>

</div><!-- #content -->


<?php
 // Footer functions located inside: theme.php
?>
<div class="footer-widgets">
    <div class="wrap">
    
        <div class="row">
            
            <div class="small-12 large-4 xlarge-5 columns">
                
                <div class="widget">
                    <h4>Our Mission</h4>
                <?php
					printf( '%s', apply_filters( 'the_content', get_field( 'our_mission', 'options' ) ) );
                    
                    $site_url = home_url();
                    printf('<div class="logo"><a href="%s" title="%s"><img src="%s" alt="%s"/></a></div>',  
                            $site_url, get_bloginfo( 'name' ), THEME_IMG .'/footer-logo.svg', get_bloginfo( 'name' ) );
                ?>
                </div>
            </div>
            
            <div class="small-12 large-4 xlarge-3 columns">
                
                <div class="widget widget-get-in-touch">
                    <h4>Get In touch</h4>
                    <?php
                        the_field( 'contact', 'options' );
                        
                        // social icons
                        echo _s_get_social_icons();
                    ?>
                </div>
            </div>
            
            <div class="small-12 large-4 columns">
                
                <div class="widget widget-gravity-form">
                    <h4>Subscribe</h4>
                <?php
					the_field( 'subscribe', 'options' );
                ?>
                </div>
            </div>
        
        </div>
	
	</div>
</div>
<footer id="colophon" class="site-footer" role="contentinfo">
	
    <div class="wrap">
    
    <div class="column row">
    
        <?php
        footer_copyright();
        function footer_copyright() {
            $menu = '';
          
            if ( has_nav_menu( 'copyright' ) ) {
                $args = array(
                    'theme_location' => 'copyright',
                    'container' => false,
                    'container_class' => '',
                    'container_id' => '',
                    'menu_id'        => 'copyright-menu',
                    'menu_class'     => 'menu',
                    'before' => '',
                    'after' => '',
                    'link_before' => '',
                    'link_after' => '',
                    'depth' => 0,
                    'echo' => false
                );
                $menu = sprintf( '| <span class="links">%s</span>', strip_tags( wp_nav_menu($args), '<a>' ) );	
            }
            
            
            $photos = sprintf( '<span class="split"><i>|</i> Selected photography by <a href="%s">Rebecca Blissett</a> and <a href="%s">Jon Benjamin</a>.</span>',
                                'https://phoblographer.wordpress.com', 'https://jonbenjamin.ca' );
            $design_by = sprintf( '<span class="split"><i>|</i> Website design by  <a href="%s">Massif Creative</a> and website development by <a href="%s">Butter Creative</a>.</span>',
                                'http://massif.ca', 'http://www.buttercreative.com' ); 
                                
            printf( '<p>&copy; %s Coastal Jazz & Blues Society %s %s %s</p>', date( 'Y' ), $menu, $photos, $design_by );
         
        }
        ?>
         
       </div>
    
    </div>
  

 </footer><!-- #colophon -->

<?php wp_footer(); ?>
</body>
</html>
