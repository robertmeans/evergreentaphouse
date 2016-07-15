<?php
/* Template Name: Home Page Template */  
	get_header();

  if ( function_exists( 'get_option_tree') ) {
       	$theme_options = get_option('option_tree');  
  } 
    
  $header_style = get_option_tree('header_style', $theme_options);
  if ( $header_style == "" ) {
    $header_style == "bt-header-classic";
  }
?>

<?php while ( have_posts() ) : the_post(); ?>    
<section class="bliccaThemes-waypoint" data-animate-down="on-sticky" data-animate-up="off-sticky"> 
  <!-- Page Content Start -->
    <?php the_content(); ?>
</section>
<?php endwhile; // end of the loop. ?>
<?php get_footer();?>