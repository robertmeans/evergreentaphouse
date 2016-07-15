        <?php
        if ( function_exists( 'get_option_tree') ) {
        $theme_options = get_option('option_tree');  
        }
        $sidebar_position = get_option_tree('sidebar_position', $theme_options);
        if ($sidebar_position == "" ) { 
        $sidebar_position = "sidebar_on_right"; 
        }
                $after = "";  
        ?>

        <?php if ( $sidebar_position == "sidebar_on_left" ) {
              get_sidebar();    
        }
        ?>  
        <div class="col-sm-8 col-md-8 blog-wrapper">
          <div class="blog-standard-right-sidebar">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <!-- Loop Start -->
                <article <?php post_class('post-item') ?>>
                <?php
                  $format = get_post_format();
                  if ( $format !== false) {
                  get_template_part( 'includes/blog/format', $format );
                  } else { 
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
                      <?php the_content();
                      if ( is_singular( 'foodmenu' ) ) {
                      $ingredients = get_post_meta(get_the_ID(), "_ingredients", true);
                      if ( !empty($ingredients) ) { ?><p class="bt-menu-itemDesc"><?php echo esc_html($ingredients); ?></p><?php } ?>
                      <?php } ?>                    
                    <span class="single-tags"><?php the_tags('', ' ', '<br />'); ?></span>
                  </div>
                  
                  <div class="clearfix"></div>
                </div>
              
              
                <?php } ?>
            <?php wp_link_pages(); ?>
            </article>
              
              <?php endwhile; else: ?>
              <p><?php echo esc_attr_e('Sorry, no posts matched your criteria.', 'bliccaThemes');?></p>
              <?php endif; ?>
                </div>
          <div id="comment" class="comments-wrapper"><?php comments_template(); ?></div>
            </div>

        <?php 
         if ( $sidebar_position != "sidebar_on_left" ) {
          get_sidebar();
        }
        ?>
          <div class="clearfix"></div>

