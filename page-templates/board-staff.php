<?php
/*
Template Name: Board & Staff
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
        get_template_part( 'template-parts/section', 'board-staff' );
        ?>
        </main>
    
    
    </div>

<?php
// After Primary Hook (add sidebars)
do_action( '_s_after_primary' );
?>

<?php
get_footer();
