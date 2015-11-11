<?php

/*
Template Name: Contact Page
*/

?>


<?php get_header(); ?>
<div id="primary" class="content-area contact-area">
		<main id="main" class="site-main" role="main"> 

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'contact' ); ?>  
                
			<?php endwhile; // end of the loop. ?>
           
     
 </main><!-- #main --> 
</div><!-- #primary -->   
      
<?php get_footer(); ?>

	