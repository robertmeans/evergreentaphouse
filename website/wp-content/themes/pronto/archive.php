<?php
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
?>

<section class="bliccaThemes-waypoint" data-animate-down="on-sticky" data-animate-up="off-sticky"> 

  <!-- Blog Content Start --> 
    <div class="blog-style">
      <div class="container">
        <div class="row">   
          <div class="query-title">
          <h4>
          <?php 
          if ( is_search() ) :  ?>
          <?php echo esc_html_e( 'Search Results for: ', 'bliccaThemes' ); printf( '%s', '<span>' . get_search_query() . '</span>' ); ?>
          <?php endif; 
          if(is_category()) :
                $page_tit =  single_cat_title(); ?>
          <?php echo esc_attr($page_tit); ?>
          <?php
            elseif(is_tag()) :
                $query_name =  single_tag_title();?>
          <?php echo esc_attr($page_tit); ?>
          <?php endif; ?>
          </h4>
          </div>
        </div>
      </div>             
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