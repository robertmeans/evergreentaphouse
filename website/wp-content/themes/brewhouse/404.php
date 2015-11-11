<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package brewhouse
 */

get_header(); ?>

	<?php if (has_post_thumbnail( $post->ID ) ): 
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
	$image = $image[0];  ?> 
    
     <header class="entry-header"> 
		<div id="scene">
            
            <img class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        	<?php echo ( 'layer' ); ?>
			<?php } // end tipsy background if ?> page-header" data-depth="0.10" src="<?php echo $image; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
            
            <div class="page-entry-header">
        		<div class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        		<?php echo ( 'layer' ); ?>
				<?php } // end tipsy background if ?> data" data-depth="0.40"><h2><?php the_title( '<h1 class="page-entry-title">', '</h1>' ); ?></h2>
            	</div><!-- layer --> 
             
            	<div class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        		<?php echo ( 'layer' ); ?>
				<?php } // end tipsy background if ?> data" data-depth="0.80"><a href="#jump-to"><i class="fa fa-angle-down"></i></a>
            	</div><!-- layer --> 
            </div><!-- page-entry-header -->  
        
        </div><!-- #scene --> 
	</header><!-- .entry-header --> 
   
	<?php else :  ?>
    
   	<header class="entry-header">  
		<div id="scene">
            <div class="page-entry-header">
        		<div class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        		<?php echo ( 'layer' ); ?>
				<?php } // end tipsy background if ?> data" data-depth="0.40"><h2><?php the_title( '<h1 class="page-entry-title">', '</h1>' ); ?></h2>
            	</div><!-- layer --> 
             
            	<div class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        		<?php echo ( 'layer' ); ?>
				<?php } // end tipsy background if ?> data" data-depth="0.80"><a href="#jump-to"><i class="fa fa-angle-down"></i></a>
            	</div><!-- layer --> 
            </div><!-- page-entry-header --> 
        </div><!-- #scene --> 
	</header><!-- .entry-header --> 
	
	<?php endif; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<div class="page-content max-width">
                	<div class="grid grid-pad">
                    	<div class="col-1-1 text-center">
					<p><?php _e( 'It looks like nothing was found at this location.', 'brewhouse' ); ?></p>

					<button style="margin-bottom: 65px;">Return to Home</button>
                    	</div><!-- .col-1-1 --> 
                    </div><!-- .grid -->
				</div><!-- .page-content --> 
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
