<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
			<?php } // end if ?> page-header" data-depth="0.10" src="<?php echo $image; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"> 
             
            <div class="page-entry-header">
        	<div class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        	<?php echo ( 'layer' ); ?>
			<?php } // end if ?> data" data-depth="0.40"><h1 class="page-entry-title"><?php _e( 'News & Events', 'brewhouse' ); ?></h1>
            </div><!-- layer -->
            
            <div class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        	<?php echo ( 'layer' ); ?>
			<?php } // end if ?> data" data-depth="0.80"><a href="#jump-to"><i class="fa fa-angle-down"></i></a>
            </div><!-- layer -->
            </div><!-- page-entry-header -->
            
        </div><!-- scene -->
	</header><!-- .entry-header -->
   
	<?php else :  ?>
    
   	<header class="entry-header">  
		<div id="scene"> 
        
            <div class="page-entry-header">
        	<div class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        	<?php echo ( 'layer' ); ?>
			<?php } // end if ?> data" data-depth="0.40"><h1 class="page-entry-title"><?php _e( 'News & Events', 'brewhouse' ); ?></h1>
            </div><!-- layer -->
            
            <div class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        	<?php echo ( 'layer' ); ?>
			<?php } // end if ?> data" data-depth="0.80"><a href="#jump-to"><i class="fa fa-angle-down"></i></a>
            </div><!-- layer -->
            </div><!-- page-entry-header -->
            
        </div><!-- scene -->
	</header><!-- .entry-header --> 
	
	<?php endif; ?>
	
	<div id="jump-to" class="entry-content"> 
        <div class="grid grid-pad blog-archive">
        	<div class="col-1-1 text-center">
			
			<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php brewhouse_paging_nav(); ?>

			<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>
        	
            </div><!-- text-center -->
        </div><!-- blog-archive -->
    </div><!-- .entry-header --> 
 

<?php get_footer(); ?>
