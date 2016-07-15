<?php
    if ( function_exists( 'get_option_tree') ) {
       	$theme_options = get_option('option_tree');  
    } 
if( !isset($theme_options['blog_style'])) { $blog_style = "standard-right-sidebar"; }
  else { $blog_style = $theme_options['blog_style']; }
?>

					<aside class="col-sm-4 col-md-4 sidebar <?php if ($blog_style == "masonry") { echo "masonry_sidebar"; } ?>">
            <div class="sidebar-inner">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Shop Sidebar") ) : ?>
            <?php endif; ?> 
            </div>
					</aside>
