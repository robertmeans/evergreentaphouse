<?php
  if ( function_exists( 'get_option_tree') ) {
        $theme_options = get_option('option_tree');  
  }
  $header_style = get_option_tree('header_style', $theme_options);

  if ( $header_style == "" ) {
    $header_style == "bt-header-classic";
  }
  $logo_texty = get_option_tree('text_logo', $theme_options);
  $phone_number = get_option_tree('phone_number', $theme_options); 
  $email_post = get_option_tree('email_post', $theme_options);  
?>
<div class="topsection">    
    <div class="container"><div class="row"><div class="col-md-12">
                <div class="topsection-about">
                <?php if (!empty($phone_number)) { ?><i class="fa fa-phone"></i><?php echo esc_html($phone_number); } ?>
                <?php if (!empty($email_post)) { ?><i class="fa fa-envelope"></i><a href="mailto:<?php echo esc_html($email_post); ?>"><?php echo esc_html($email_post); ?></a><?php } ?>
                </div>
                <div class="bliccaThemes-header-search">
                <i class="fa fa-search"></i>
                <div class="search">
                  <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
                  <input type="text" name="s" class="search-query" placeholder="<?php echo esc_attr_e('Search here...', 'mukam');?>" value="<?php esc_attr(the_search_query()); ?>">
                  </form>
                </div>  
                </div>
                <div class="header-social"><?php bliccaThemes_footer_social(); ?><div class="clearfix"></div></div><div class="clearfix"></div>
    </div></div></div>
</div>
<div class="container">
        <div class="row">
          <div class="col-md-12">
          <!-- Main Menu -->
          <nav class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-text">
                  <?php if (!empty($logo_texty)) {
                            echo esc_html($logo_texty);
                            }
                
                  elseif (!empty($theme_options['logo_upload'])){?>
                    <img src="<?php echo esc_url($theme_options['logo_upload']);?>" alt="<?php bloginfo('name'); ?>" class="logo" />
                    <img src="<?php echo esc_url($theme_options['logo_upload_sticky']);?>" alt="<?php bloginfo('name'); ?>" class="stickylogo" /> 
                  <?php } ?></a>    
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse navbar-ex1-collapse">
                
                <?php if(has_nav_menu('main_menu')) { 
                      wp_nav_menu(
                        array(
                            'theme_location'        => 'main_menu',
                            'container'             => '',
                            'container_class'       => false,
                            'menu_class'            => 'nav navbar-nav navbar-right',
                            'fallback_cb'           => 'primary_menu_fallback',
                            'walker'                => new bliccaThemes_walker_main_menu2()
                        ));
                } else { ?>
                   <ul class="nav navbar-nav navbar-right animsition-overlay">
                   <li><a href="<?php echo esc_url(get_admin_url()).'nav-menus.php'; ?>">Please assign a menu from Appearance -> Menus</a></li>
                   </ul>
                <?php } ?>
          </div><!-- /.navbar-collapse -->
        </nav>
          </div>
        </div>
</div>