<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package brewhouse
 */
?>

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

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div id="jump-to" class="grid grid-pad">
			
            <div class="entry-content col-1-1">
    			<h2 class="underline"><span><?php the_title(); ?></span></h2>
				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'brewhouse' ),
					'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
            
			<footer class="entry-footer">
				<?php edit_post_link( __( 'Edit', 'brewhouse' ), '<span class="edit-link">', '</span>' ); ?>
			</footer><!-- .entry-footer -->
    	
        </div><!-- grid -->
 	</article><!-- #post-## -->
