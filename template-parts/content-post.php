<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'column row' ); ?>>
	
	<?php
	$post_image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
    if( !empty( $post_image ) ) {
        $post_image = sprintf( 'background-image: url(%s);', $post_image );
    }
    $post_categories =  get_the_category_list( '' );
    $terms = _s_get_post_terms( get_the_ID() );
    
    $post_title = the_title( '<h2>', '</h2>', false );
    $post_author = sprintf( 'Posted by: %s', get_the_author_meta('display_name' ) );
    $post_meta = sprintf( '<p class="post-meta">%s%s<br />%s</p>', _s_get_posted_on(), $terms, $post_author );
        
    printf( '<header class="entry-header">%s%s</header>', 
                $post_title, $post_meta );
        
	?>
	
	<div class="entry-content">
	
		<?php 
		the_content(); 
		?>
		
	</div><!-- .entry-content -->

	<footer class="entry-footer">
       
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
