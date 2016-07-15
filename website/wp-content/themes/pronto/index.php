<?php
/* Template Name: Blog Template */  
	get_header();

    if ( function_exists( 'get_option_tree') ) {
       	$theme_options = get_option('option_tree');  
    } 
    
  $header_style = get_option_tree('header_style', $theme_options);
  if ( $header_style == "" ) {
    $header_style == "bt-header-classic";
  }
	if(isset($theme_options['blog_header'])) { /* dont */ }
    else { $theme_options['blog_header'] = "Set from Theme Options"; }
  if(isset($theme_options['blog_caption'])) { /*dont */ }
    else { $theme_options['blog_caption'] = " "; }

	if( !isset($theme_options['blog_style'])) { $blog_style = "standard-right-sidebar"; }
  else { $blog_style = $theme_options['blog_style']; }

  $readmore = get_option_tree('read_more', $theme_options);
  if ( $readmore == "" ) {
    $readmore = "Continue reading...";
  }

  $slider = get_option_tree('featured_slider', $theme_options);
?>

<section class="bliccaThemes-waypoint" data-animate-down="on-sticky" data-animate-up="off-sticky"> 

	<!-- Blog Content Start -->	
		<div class="blog-style">
      <div class="caption-container">
        <div class="caption"><div class="container"><div class="row"><div class="col-md-12">
              <h1 <?php bliccaThemes_h2($post); ?>><?php if ( is_search() ) : // Only display for Search?>
                <?php printf( __( 'Search Results for: %s', 'bliccaThemes' ), '<span>' . get_search_query() . '</span>' ); ?> 
              <?php else: echo esc_html($theme_options['blog_header']); ?><?php endif; ?></h1>
              <div class="bt_caption_sep">
              <?php if (!empty($theme_options['subpage_leaf'])){?>
                    <img src="<?php echo esc_url($theme_options['subpage_leaf']);?>"> 
              <?php }
              else { ?>              
                  <img src="<?php echo get_template_directory_uri(); ?>/img/iconpronto.png">
              <?php } ?>
              </div>
              <p><?php echo esc_html($theme_options['blog_caption']); ?></p>
        </div></div></div></div>
			</div>      
				<?php

            if ($slider == "Yes") {						
						if( ! is_search() && ! is_archive()  ) {
            $sticky = get_option( 'sticky_posts' );   
            $args = array (
              'post__not_in' => get_option( 'sticky_posts' ),
              'meta_query'             => array(
                array(
                  'key'       => 'bliccaThemes_featured',
                  'value'     => 'on',
                  'compare'   => '=',
                  'type'      => 'CHAR'
                ),
              ),
            );
            // The Query
            $featured_query = new WP_Query( $args );

            // The Loop
            if ( $featured_query->have_posts() ) { ?>
            <div class="featured-slider">          
            <div class="featured-posts">
                <?php
                while ( $featured_query->have_posts() ) {
                    $featured_query->the_post(); ?>           
                <div class="featured-item">
                <?php the_post_thumbnail('full'); ?>
                  <div class="featured-meta"><div class="container"><div class="row"><div class="col-md-12">
                    <?php
                    $posttitle = get_the_title();
                    if ( strlen($posttitle) > 50 ) {
                    $posttitle = mb_substr($posttitle, 0, 45);
                    $posttitle = $posttitle . "...";
                    }
										?>
                    <h3><a href="<?php the_permalink(); ?>"><?php echo esc_attr($posttitle); ?></a></h3>
                    <p class="hidden-xs"><?php $short_content = get_the_content(''); $short_content = substr($short_content, 0, 180); echo esc_html($short_content); ?>... <a href="<?php the_permalink(); ?>"><?php echo esc_attr($readmore);?></a></p>
                    <span class="hidden-xs">
                      <?php echo esc_html_e("Posted in", "bliccaThemes"); ?> <?php the_category(', '); ?>,
                        <?php echo esc_html_e("on", "bliccaThemes"); ?> <?php the_time('j F Y'); ?>,     
                        <?php echo esc_html_e("by", "bliccaThemes"); ?> <?php the_author_posts_link(); ?>,
                        <i class="fa fa-comment-o"></i><a href="<?php comments_link(); ?>"><?php comments_number( __('0', 'bliccaThemes'), __('1', 'bliccaThemes'), __('%', 'bliccaThemes') ); ?> <?php echo __('Comments', 'bliccaThemes');?></a>
                    </span>
                  </div></div></div></div>
                </div>
                <?php } ?>
            </div></div><div class="clearfix"></div><?php } 
						wp_reset_postdata(); 
					}	
 					}
					?>                
			<div class="container">
				<div class="row">
					<?php 
						get_template_part( 'includes/blog/blog', $blog_style ); 
					?>	
				</div>
			</div>
		</div>

</section>

<?php get_footer();?>                            