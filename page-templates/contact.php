<?php
/*
Template Name: Contact
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
        
        echo '<div class="entry-content">';	
		
		print( '<div class="row">' );
        
            $thumbnail = $classes = '';
			
            if( has_post_thumbnail() ) {
                $thumbnail = sprintf( '<div class="small-12 large-6 columns column-block">%s</div>', get_the_post_thumbnail( get_the_ID(), 'large' ) );
                $classes = ' large-6';
            }
             
            printf( '<div class="small-12%s columns">', $classes) ;
            
			while ( have_posts() ) :
	
				the_post();
 				
				the_content();
 					
			endwhile;
            
			echo '</div>';
            
            echo $thumbnail;
            
         echo '</div>';    
		
		print( '</div>' );
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
