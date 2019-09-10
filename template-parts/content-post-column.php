<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'column column-block' ); ?>>
	
	<?php
	echo _get_blog_post();
    ?>
</article><!-- #post-## -->
