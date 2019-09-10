<?php
/*
Template Name: Page Builder
*/


/**
 * Custom Body Class
 *
 * @param array $classes
 * @return array
 */
function kr_body_class( $classes ) {
  $classes[] = 'page-builder';
  return $classes;
}
add_filter( 'body_class', 'kr_body_class' );

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
 	get_template_part( 'template-parts/page-builder' );
	?>
	</main>


</div>

<?php
// After Primary Hook (add sidebars)
do_action( '_s_after_primary' );
?>

<?php
get_footer();
