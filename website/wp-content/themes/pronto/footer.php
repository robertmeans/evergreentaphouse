<?php if ( function_exists( 'get_option_tree') ) {
              $theme_options = get_option('option_tree');  
              } 
$logo_texty = get_option_tree('text_logo', $theme_options);
?>
<footer class="footer_bliccaThemes">  

    <?php $show_widget = get_option_tree('show_widget', $theme_options); 
    if ( $show_widget != 'Yes') {?>
    <div class="container">
        <div class="row">
          <div class="widgetscontainer">
          <!-- Widget Area 1 -->
          <div class="col-md-3">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer First") ) : ?>
            <?php endif; ?>
          </div>
          <!-- Widget Area 2 -->
          <div class="col-md-3">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Second") ) : ?>
            <?php endif; ?>
          </div>
          <!-- Widget Area 3 -->
          <div class="col-md-3">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Third") ) : ?>
            <?php endif; ?>
          </div>
          <!-- Widget Area 4 -->
          <div class="col-md-3">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Fourth") ) : ?>
            <?php endif; ?>
          </div>          
        </div>

        </div>
    </div>
    <?php } ?>

    
    <div class="copyright-background">
        <div class="container">
          <div class="row">

            <div class="col-md-12">
            <?php $showsocial = get_option_tree('show_social_on_footer', $theme_options);
            if ( $showsocial == 'Yes') {?>
              <div class="footer-social"><?php bliccaThemes_footer_social(); ?><div class="clearfix"></div></div> 
            <?php } ?>   
            <?php $show_copyright = get_option_tree('show_copyright', $theme_options); 
            if ( $show_copyright == 'Yes') {?>
              <div class="copyright-section"><a href="<?php echo esc_url(home_url('/')); ?>" class="logo-text">
                  <?php if (!empty($logo_texty)) {
      											echo esc_html($logo_texty);
      											}
								
                  elseif (!empty($theme_options['logo_upload_footer'])){?>
                    <img src="<?php echo esc_url($theme_options['logo_upload_footer']);?>" alt="<?php esc_html(bloginfo('name')); ?>" class="logo" /> 
             			<?php } ?></a><p><?php $copyright_text = get_option_tree('copyright_text', $theme_options); echo esc_html($copyright_text); ?></div>
            <?php } ?>  
            </div>  
          </div>
        </div>
    </div>

    
</footer>
    <?php 
    $boxed =  get_option_tree('boxed', $theme_options);
    if ( $boxed == "Yes" ) {
    ?></div><?php
    }
		?>  
</div>


    <?php wp_footer() ?>
  </body>
</html>