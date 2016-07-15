<?php
  if ( function_exists( 'get_option_tree') ) {
    $theme_options = get_option('option_tree');  
  } 
  $readmore = get_option_tree('read_more', $theme_options);
  $sidebar_position = get_option_tree('sidebar_position', $theme_options);
  if ($sidebar_position == "" ) { 
    $sidebar_position = "sidebar_on_right"; 
  }
  if ( $readmore == "" ) {
    $readmore = "[Continue reading...]";
  }
?>

<?php if ( $sidebar_position == "sidebar_on_left" ) {
      get_sidebar();    
}
?>
      <div class="col-sm-8 col-md-8<?php if($sidebar_position == "no_sidebar") { echo " col-md-offset-2" ; } ?> blog-wrapper">
          <div class="blog-standard-right-sidebar">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <!-- Loop Start -->
            <article <?php post_class('post-item') ?>>
                <?php
                  $format = get_post_format();

                  if ( $format !== false && $format != "image") {
                  get_template_part( 'includes/blog/format', $format );
                  } 
                  else { 
                  get_template_part( 'includes/blog/format', 'standard' );
                  }
                ?>
                <?php if( !in_array($format, array('quote', 'link'))) { ?>                
                <div class="blog-content">
                    <p class="blog-meta">
                        <?php echo esc_html_e("Posted in", "bliccaThemes"); ?> <?php the_category(', '); ?>,
                        <?php echo esc_html_e("on", "bliccaThemes"); ?> <?php the_time('j F Y'); ?>,     
                        <?php echo esc_html_e("by", "bliccaThemes"); ?> <?php the_author_posts_link(); ?>,
                        <i class="fa fa-comment-o"></i><a href="<?php comments_link(); ?>"><?php comments_number( __('0', 'bliccaThemes'), __('1', 'bliccaThemes'), __('%', 'bliccaThemes') ); ?> <?php echo __('Comments', 'bliccaThemes');?></a>
                    </p>

                    <div class="blog-excerpt">
                      <?php the_content('');
                      if ( 'foodmenu' == get_post_type() ) {
                      $ingredients = get_post_meta(get_the_ID(), "_ingredients", true);
                      if ( !empty($ingredients) ) { ?><p class="bt-menu-itemDesc"><?php echo esc_html($ingredients); ?></p><?php } ?>
                      <?php } ?>
                      <a href="<?php the_permalink(); ?>"><?php echo esc_html($readmore); ?></a>
                    </div>
                    
                  <div class="clearfix"></div>
                 </div>
              
              
                <?php } ?>                
            </article>
            
            <?php endwhile; else: ?>
            <p><?php echo esc_html_e('Sorry, no posts matched your criteria.', 'bliccaThemes');?></p>
            <?php endif; ?>
          </div>
           <div class="pagination-container">
            
                  <div class="index-pagination">
                  <?php   
                  $activate_pagination =  get_option_tree('activate_pagination', $theme_options);
                  if ( $activate_pagination == "Yes" ) {
                  bliccaThemes_pagination(); 
                  }
                  else {
                    
                  ?><div class="newer-page"><?php previous_posts_link( 'Newer Posts' ); ?></div>
                    <div class="older-page"><?php next_posts_link( 'Older Posts', 0 );  ?></div><?php                 
                  }
                  ?>
                  </div>
          </div>
        </div>
        <?php 
         if ( $sidebar_position == "sidebar_on_right" ) {
          get_sidebar();
        }
        ?>