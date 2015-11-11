<?php
/**
 * The template used for displaying page content in page-about.php 
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
		<div class="entry-content col-9-12"> 
    		<h2 class="underline"><span><?php the_title(); ?></span></h2>

    		<?php if( get_theme_mod( 'active_history' ) == '') : ?>
        
        	<section class="col-1-3 about-section"> 
        		
                <div class="col-1-1">  
        			<?php if ( get_theme_mod( 'brewhouse_history_image' ) ) : ?>
    					<img src="<?php echo get_theme_mod( 'brewhouse_history_image' ); // populate the history image ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"> 
    				<?php else : ?>
					<?php endif; ?>
        		</div><!-- col-1-1 --> 
       
        		<div class="col-1-1">
        			<?php if ( get_theme_mod( 'brewhouse_our_history_title' ) ) : ?> 
    					<h3><?php echo get_theme_mod( 'brewhouse_our_history_title' ); // populate the history title ?></h3>
    				<?php else : ?> 
					<?php endif; ?>
        
        			<?php if ( get_theme_mod( 'brewhouse_our_history' ) ) : ?> 
    					<?php echo get_theme_mod( 'brewhouse_our_history' ); // populate the history text ?> 
    				<?php else : ?> 
					<?php endif; ?>
        		</div><!-- .col-1-1 -->
        	
            </section><!-- .about-section -->
            
            <?php else : ?>  
			<?php endif; ?>
			<?php // end if ?>
            
            <?php if( get_theme_mod( 'active_brewery' ) == '') : ?>
        
        	<section class="col-1-3 about-section">
        		
                <div class="col-1-1">
        			<?php if ( get_theme_mod( 'brewhouse_brewery_image' ) ) : ?>
    					<img src="<?php echo get_theme_mod( 'brewhouse_brewery_image' ); // populate the brewery image ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
    				<?php else : ?>
					<?php endif; ?>
        		</div><!-- .col-1-1 -->
        
        		<div class="col-1-1">
        			<?php if ( get_theme_mod( 'brewhouse_brewery_title' ) ) : ?> 
    					<h3><?php echo get_theme_mod( 'brewhouse_brewery_title' ); // populate the brewery title ?></h3>
    				<?php else : ?>
					<?php endif; ?>
        
        			<?php if ( get_theme_mod( 'brewhouse_brewery' ) ) : ?>
    					<?php echo get_theme_mod( 'brewhouse_brewery' ); // populate the brewery text ?>   
    				<?php else : ?> 
					<?php endif; ?>
        		</div><!-- col-1-1 --> 
        	
            </section><!-- .about-section -->
            
            <?php else : ?>  
			<?php endif; ?>
			<?php // end if ?>
            
            <?php if( get_theme_mod( 'active_people' ) == '') : ?>
        
        	<section class="col-1-3 about-section">
        		
                <div class="col-1-1">
        			<?php if ( get_theme_mod( 'brewhouse_people_image' ) ) : ?>
    					<img src="<?php echo get_theme_mod( 'brewhouse_people_image' ); // populate the people image ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"> 
    				<?php else : ?>
					<?php endif; ?> 
        		</div><!-- col-1-1 --> 
        
        		<div class="col-1-1">   
        			<?php if ( get_theme_mod( 'brewhouse_people_title' ) ) : ?> 
    					<h3><?php echo get_theme_mod( 'brewhouse_people_title' ); // populate the people title ?></h3>
    				<?php else : ?>
					<?php endif; ?>
         
        			<?php if ( get_theme_mod( 'brewhouse_our_people' ) ) : ?>
    					<?php echo get_theme_mod( 'brewhouse_our_people' ); // populate the people text ?>  
    				<?php else : ?> 
					<?php endif; ?>
        		</div><!-- col-1-1 -->
        	
            </section><!-- .about-section --> 
            
            <?php else : ?>  
			<?php endif; ?>
			<?php // end if ?> 
        
			<?php the_content(); ?> 
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'brewhouse' ),
					'after'  => '</div>',
				) ); 
			?>
        
		</div><!-- .entry-content -->
    
    	<div id="secondary" class="widget-area col-3-12" role="complementary">
    		<?php if ( is_active_sidebar('pages-widget') ) : ?>
    			<?php dynamic_sidebar('pages-widget'); ?>      
    		<?php endif; ?>
    	</div><!-- .col-3-12 -->
 
		<footer class="col-1-1 entry-footer">
			<?php edit_post_link( __( 'Edit', 'brewhouse' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-footer --> 
    
    	</div><!-- grid -->
	</article><!-- #post-## -->
