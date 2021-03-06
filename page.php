<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

get_header(); ?>

<?php
// Hero
get_template_part( 'template-parts/hero', 'page' );

// Before Primary Hook
do_action( '_s_before_primary' );
?>

    <div id="primary" class="content-area">
    
        <main id="main" class="site-main" role="main">
        <?php
        // Default
        section_default();
        function section_default() {
                    
            global $post;
            
            $attr = array( 'class' => 'section default' );
            
            _s_section_open( $attr );		
            
            print( '<div class="column row"><div class="entry-content">' );
            
            while ( have_posts() ) :
    
                the_post();
                
                the_content();
                    
            endwhile;
            
            print( '</div></div>' );
            _s_section_close();	
        }
        ?>
        </main>
    
    
    </div>

<?php
// After Primary Hook (add sidebars)
do_action( '_s_after_primary' );
?>

<?php
get_footer();
