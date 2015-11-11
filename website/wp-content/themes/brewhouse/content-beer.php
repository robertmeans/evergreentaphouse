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
    
	<div id="jump-to" class="entry-content">
		<div class="beer-list">
    		
            <?php if ( get_theme_mod( 'beer_list_title' ) ) : ?> 
    		<div class="grid grid-pad">
                <div class="col-1-1">
                	<h2 class="underline">
                		<span><?php echo get_theme_mod( 'beer_list_title' ); ?></span>
                    </h2>  
               	</div><!-- col-1-1 --> 
    		</div><!-- grid --> 
            <?php endif; ?>
    
    		<div class="grid grid-pad">
    		<!-- Beginning of Drink List -->
				
				<?php
				global $post;
				$args = array( 'post_type' => 'drink', 'posts_per_page' => -1 );
				$myposts = get_posts( $args );
				foreach( $myposts as $post ) :	setup_postdata($post); ?>
				
                <div class="col-1-4">
   					<div class="featured-drink"> 
                		<?php the_post_thumbnail( 'beer-image', array( 'class' => 'beer' ) ); ?>
   						<span><?php the_title(); ?></span><em><?php global $post; $text = get_post_meta( $post->ID, '_drink_ibu_alc', true ); echo $text; ?></em>
                		<p><?php global $post; $text = get_post_meta( $post->ID, '_drink_description', true ); echo $text; ?></p>
    				</div><!-- featured-drink --> 
    			</div><!-- col-1-4 -->  
				<?php endforeach; ?>
            <!-- End of Drink List --> 
    		
            </div><!-- grid -->
        </div><!-- beer-list -->
	</div><!-- .entry-content -->
    
	<footer class="col-1-1 entry-footer">
		<?php edit_post_link( __( 'Edit', 'brewhouse' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->

