<?php
/**
Template Name: Gallery
 *
 * @package brewhouse
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<!-- Beginning of Gallery -->
            <div id="gallery-container">
				
				<?php
				global $post;
				$args = array( 'post_type' => 'gallery', 'posts_per_page' => -1 );
				$myposts = get_posts( $args );
				foreach( $myposts as $post ) :	setup_postdata($post); ?>
				
                
                <div class="gallery-image">
                <?php the_post_thumbnail('gallery-image'); ?>
                </div><!-- gallery-image -->
				<?php endforeach; ?> 
            
            </div><!-- gallery-container -->
            <!-- End ofGallery -->  
            
		</main><!-- #main -->
	</div><!-- #primary -->
    
<?php get_footer(); ?>
