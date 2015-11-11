<?php
/**
Template Name: Home Page
 *
 * @package brewhouse
 */

get_header(); ?>


  <div id="slides">
    <div class="slides-container">    
    	<div id="scene" class="slide-content">
    		<div class="box-align"> 
    			<div class="vertical-align">
       		
            		<div class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?> 
        				<?php echo ( 'layer' ); ?>
						<?php } // end if ?> data" data-depth="0.20">
                
                		<?php if ( get_theme_mod( 'brewhouse_main_image' ) ) : ?> 
            				<img src="<?php echo get_theme_mod( 'brewhouse_main_image' ); ?>" class="badge preserve hide-on-mobile" alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
                		<?php endif; ?>
            		</div><!-- .data -->  
             
        			<div class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        				<?php echo ( 'layer' ); ?>
						<?php } // end if ?> data" data-depth="0.40"><h2><?php echo get_theme_mod( 'brewhouse_first_heading' ); ?><br /><?php echo get_theme_mod( 'brewhouse_second_heading' ); ?></h2>
            		</div><!-- .data -->  
            
            		<div class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?> 
        				<?php echo ( 'layer' ); ?>
						<?php } // end if ?> data" data-depth="0.65"><a href="#jump-to"><i class="fa fa-angle-down"></i></a>
            		</div><!-- .data -->  
        		
                </div><!-- .vertical-align -->     
        	</div><!-- .box-align -->
         		
                <?php if ( get_theme_mod( 'brewhouse_main_bg' ) ) : ?> 
                	<img class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?> 
					<?php echo ( 'layer' ); ?>
					<?php } // end if ?> home-background" data-depth="0.10" src="<?php echo get_theme_mod( 'brewhouse_main_bg' ); ?>" alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
            	<?php endif; ?>
              
        	</div><!-- .slide-content -->   
    	</div><!-- .slides-container -->  
  	</div><!-- #slides --> 
  
  	<div id="jump-to" class="home-info">
    
    <?php if( get_theme_mod( 'active_first_widget' ) == '') : ?> 
    
    	<div class="color-dark">
    		<div class="color-text">
    			<i class="fa <?php echo get_theme_mod( 'home_icon_1' ); ?>"></i>   
    
				<?php if ( get_theme_mod( 'brewhouse_first_widget_heading' ) ) : ?>
    				<h2><?php echo get_theme_mod( 'brewhouse_first_widget_heading' ); ?></h2>
				<?php endif; ?> 
    
				<?php if ( is_active_sidebar('home-first-widget') ) : ?>
    				<?php dynamic_sidebar('home-first-widget'); ?>    
    			<?php endif; ?>
    
				<?php if ( get_theme_mod( 'first_button_text' ) ) : ?> 
    				<a href="<?php echo get_page_link(get_theme_mod('brewhouse_first_button_url'))?>"><button><?php echo get_theme_mod( 'first_button_text' ); ?></button></a>   
				<?php endif; ?>
    		</div><!-- .color-text -->
    	</div><!-- .color-dark -->
        
    <?php else : ?>  
	<?php endif; ?>
	<?php // end if ?> 
 
    <?php if( get_theme_mod( 'active_second_widget' ) == '') : ?>
    
    	<div class="color-light">
    		<div class="color-text">
    			<i class="fa <?php echo get_theme_mod( 'home_second_icon' ); ?>"></i>
    
    			<?php if ( get_theme_mod( 'brewhouse_second_widget_heading' ) ) : ?>
    				<h2><?php echo get_theme_mod( 'brewhouse_second_widget_heading' ); ?></h2> 
				<?php endif; ?> 
    
				<?php if ( is_active_sidebar('home-second-widget') ) : ?>
    				<?php dynamic_sidebar('home-second-widget'); ?>    
    			<?php endif; ?>
    
				<?php if ( get_theme_mod( 'second_button_text' ) ) : ?>  
    				<a href="<?php echo get_page_link(get_theme_mod('brewhouse_second_button_url'))?>"><button><?php echo get_theme_mod( 'second_button_text' ); ?></button></a>
     			<?php endif; ?>  
    		</div><!-- .color-text -->
    	</div><!-- .color-light -->
    
	<?php else : ?>  
	<?php endif; ?>
	<?php // end if ?>  
        
  	</div><!-- .home-info --> 
    
    <?php if( get_theme_mod( 'active_middle' ) == '') : ?>
    
    <div id="cta-parallax" class="home-cta">
    	<div id="scene2" class="cta-content">
        	<div class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        	<?php echo ( 'layer' ); ?>
			<?php } // end if ?>" data-depth="0.20">
           	
            <?php if ( get_theme_mod( 'brewhouse_middle_heading' ) ) : ?> 
            	<h2><?php echo get_theme_mod( 'brewhouse_middle_heading' ); ?></h2>
            	<hr class="hr" />
     		<?php endif; ?>
            
            </div><!-- .layer -->   
            
            <div class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        		<?php echo ( 'layer' ); ?>
					<?php } // end if ?>" data-depth="0.40">
             	
				<?php if ( is_active_sidebar('home-middle-section') ) : ?>
    				<?php dynamic_sidebar('home-middle-section'); ?>    
    		 	<?php endif; ?>  
        	</div> <!-- .layer -->
            
        	<div class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        	<?php echo ( 'layer' ); ?>
			<?php } // end if ?>" data-depth="0.65">
            
			<?php if ( get_theme_mod( 'third_button_text' ) ) : ?>  
    			<a href="<?php echo get_page_link(get_theme_mod('brewhouse_third_button_url'))?>"><button class="white-btn"><?php echo get_theme_mod( 'third_button_text' ); ?></button></a>
    		<?php else : ?>    
     		<?php endif; ?>
        	</div><!-- .layer -->
       	</div><!-- #scene2 -->
        
        <div id="scene-bg">
        	<img class="<?php if( get_theme_mod( 'disable_tipsy' ) == '') { ?>
        	<?php echo ( 'layer' ); ?>
			<?php } // end if ?> cta-parallax-bg" src="<?php echo get_theme_mod( 'brewhouse_middle_image' ); ?>" data-depth="0.10" alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
        </div><!-- #scene-bg -->
   	</div><!-- #cta-parallax -->
    
    <?php else : ?>  
	<?php endif; ?>
	<?php // end if ?>  
 
    <?php if( get_theme_mod( 'active_featured_drinks' ) == '') : ?>
    
    <div class="featured-drinks">
    	<div class="grid grid-pad">
    	<!-- Beginning of Drink List -->
				<?php
				global $post;
				$args = array( 'post_type' => 'drink', 'posts_per_page' => 4 );
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
    	</div><!-- .grid --> 
    </div><!-- .featured-drinks -->
	
    <?php else : ?> 
	<?php endif; ?>
	<?php // end if ?>

<?php get_footer(); ?>
