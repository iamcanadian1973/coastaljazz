<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package _s
 */

get_header(); 

get_template_part( 'template-parts/hero', 'search' );
?>

<div class="row column">

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h2><?php printf( esc_html__( 'You searched for: %s', '_s' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
			</header>

			<?php
			while ( have_posts() ) :

				the_post();

				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation(
                    array(
                        'prev_text' => __( 'Next &raquo;' ),
                        'next_text' => __( '&laquo; Previous' ),
                    )
                );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main>

	</div>

</div>

<?php
get_footer();
