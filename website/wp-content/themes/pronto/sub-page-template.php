<?php
/* Template Name: SubPage Template */  
	get_header();

    if ( function_exists( 'get_option_tree') ) {
       	$theme_options = get_option('option_tree');  
    } 

?>

<?php while ( have_posts() ) : the_post(); ?>    
<section class="bliccaThemes-waypoint" data-animate-down="on-sticky" data-animate-up="off-sticky">  
      <div class="caption-container">
        <div class="caption" <?php bliccaThemes_caption_image($post); ?>><div class="container"><div class="row"><div class="col-md-12">
              <h1 <?php bliccaThemes_h2($post); ?>><?php the_title(); ?></h1>
              <div class="bt_caption_sep">
              <?php if (!empty($theme_options['subpage_leaf'])){?>
                    <img src="<?php echo esc_url($theme_options['subpage_leaf']);?>"> 
              <?php }
              else { ?>              
                  <img src="<?php echo get_template_directory_uri(); ?>/img/iconpronto.png">
              <?php } ?>
              </div>
              <p><?php echo get_post_meta($post->ID, '_bliccaThemes_page_subtitle', true); ?></p>
        </div></div></div></div>
			</div>
  <!-- Page Content Start -->      
    <?php the_content(); ?>
      
    
    <?php if (comments_open()){ ?>    
    <div class="bg-color white"><div class="container"><div class="row"><div class="col-md-12">    
        <div id="comment" class="comments-wrapper">
              <?php comments_template(); ?>
        </div>
    </div></div></div></div>
    <?php } ?>

</section>
<?php endwhile; // end of the loop. ?>
<?php get_footer();?>