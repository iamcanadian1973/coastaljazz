<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

get_header(); ?>

<?php
// Hero
get_template_part( 'template-parts/hero', 'blog' );
?>

<?php
// Before Primary Hook
do_action( '_s_before_primary' );
?>

<div class="column row">
      
    <div id="primary" class="content-area">
    
        <main id="main" class="site-main" role="main">
            <?php
             
            if ( have_posts() ) : ?>
    
               
               <?php
               echo '<div class="row small-up-1 medium-up-2 large-up-3">';
               
                while ( have_posts() ) :
    
                    the_post();
    
                    get_template_part( 'template-parts/content', 'post-column' );
    
                endwhile;
                
                echo '</div>';
                
                the_posts_navigation();
                
            else :
    
                get_template_part( 'template-parts/content', 'none' );
    
            endif; ?>
    
        </main>
    
    </div>
    


</div>

<?php
// After Primary Hook (add sidebars)
do_action( '_s_after_primary' );
?>

<?php
get_footer();
