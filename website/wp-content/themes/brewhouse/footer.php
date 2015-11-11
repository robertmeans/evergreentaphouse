<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package brewhouse
 */
?>

    
    <div class="home-info">
    
    <?php if( get_theme_mod( 'active_first_footer' ) == '') : ?>
    
    	<div class="color-light">
    		<div class="color-text">
    			<i class="fa <?php echo get_theme_mod( 'footer_icon_1' ); ?>"></i>
    		
				<?php if ( get_theme_mod( 'brewhouse_footer_first_widget_heading' ) ) : ?>
    				<h2><?php echo get_theme_mod( 'brewhouse_footer_first_widget_heading' ); // first widget heading ?></h2> 
    			<?php else : ?> 
				<?php endif; ?>
            
    			<?php if ( is_active_sidebar('footer-first-widget') ) : ?>
    				<?php dynamic_sidebar('footer-first-widget'); // first widget sidebar ?>    
    			<?php endif; ?>
            
    			<?php if ( get_theme_mod( 'first_footer_button_text' ) ) : ?>  
    				<a href="<?php echo get_page_link(get_theme_mod('brewhouse_first_footer_button_url')) // the url ?>"><button><?php echo get_theme_mod( 'first_footer_button_text' ); // the text ?></button></a>
    			<?php else : ?> 
				<?php endif; ?> 
    	
        	</div><!-- .color-text -->
    	</div><!-- .color-light -->
    
    <?php else : ?>  
	<?php endif; ?>
	<?php // end if ?>
    
    <?php if( get_theme_mod( 'active_second_footer' ) == '') : ?>
    
    	<div class="color-dark">
    		<div class="color-text">   
    			<i class="fa <?php echo get_theme_mod( 'footer_icon_2' ); ?>"></i>  
    		
				<?php if ( get_theme_mod( 'brewhouse_second_footer_widget_heading' ) ) : ?> 
    				<h2><?php echo get_theme_mod( 'brewhouse_second_footer_widget_heading' ); // second widget heading ?></h2> 
				<?php endif; ?> 
            
    			<?php if ( is_active_sidebar('footer-second-widget') ) : ?>
    				<?php dynamic_sidebar('footer-second-widget'); // second widget heading ?>    
    			<?php endif; ?>
            
    			<?php if ( get_theme_mod( 'footer_second_button_text' ) ) : ?>  
    				<a href="<?php echo get_page_link(get_theme_mod('brewhouse_second_footer_button_url')) // url ?>"><button><?php echo get_theme_mod( 'footer_second_button_text' ); // the text ?></button></a>
				<?php endif; ?> 
    	
        	</div><!-- .color-text --> 
    	</div><!-- .color-dark --> 
    
    <?php else : ?>  
	<?php endif; ?> 
	<?php // end if ?>
    
    </div><!-- .home-info -->

	</section><!-- #content --> 

	<footer id="colophon" class="site-footer" role="contentinfo">
    	<div class="grid grid-pad"> 
        	<div class="footer-block col-1-3"><div class="footer-block-text"><i class="fa <?php echo get_theme_mod( 'bottom_footer_icon_1' ); // icon 1 ?>"></i><h5><?php echo get_theme_mod( 'brewhouse_footer_phone' ); // phone number ?></h5></div></div>
        	<div class="footer-block col-1-3"><div class="footer-block-text"><i class="fa <?php echo get_theme_mod( 'bottom_footer_icon_2' ); // icon 2 ?>"></i><h5><?php echo get_theme_mod( 'brewhouse_footer_address' ); // address ?></h5></div></div> 
        	<div class="footer-block col-1-3"><div class="footer-block-text"><i class="fa <?php echo get_theme_mod( 'bottom_footer_icon_3' ); // icon 3 ?>"></i>
        <?php echo brewhouse_media_icons(); // social icons ?></div></div> 
        </div><!-- grid --> 
        
    	<div class="grid grid-pad">
			<div class="site-info col-1-1">
				<?php if ( get_theme_mod( 'brewhouse_footerid' ) ) : ?> 
        			<?php echo get_theme_mod( 'brewhouse_footerid' ); // footer id ?>  
				<?php else : ?>  
    				<?php	printf( __( 'Theme: %1$s by %2$s', 'brewhouse' ), 'brewhouse', '<a href="http://modernthemes.net" rel="designer">modernthemes.net</a>' ); ?> 
				<?php endif; ?> 
			</div><!-- .site-info --> 
        </div><!-- grid -->
	
    </footer><!-- #colophon -->  
    
    <div class="border--top"></div>  
    <div class="border--right"></div>
    <div class="border--bottom"></div>
    <div class="border--left"></div> 

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
