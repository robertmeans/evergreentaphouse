<?php get_header(); 
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
?>
<div class="bliccaThemes-waypoint" data-animate-down="header-1 <?php echo esc_js($header_style);?> on-sticky" data-animate-up="header-1 <?php echo esc_js($header_style);?> off-sticky">

  <!-- Content Start -->  
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
      <div class="container">
        <div class="row">
          <?php if ( function_exists( 'get_option_tree') ) {
              $theme_options = get_option('option_tree');  
              } ?>
          <?php $blog_template = get_option_tree('single_blog_style',$theme_options);
          if ( $blog_template == "single_sidebar" || $blog_template == "" ): 
            get_template_part( 'includes/single/single', 'right' ); 
          
          else:
            get_template_part( 'includes/single/single', 'full');
          endif;
          ?>
        </div>
      </div>
    </div>

</div>
<?php get_footer(); ?>