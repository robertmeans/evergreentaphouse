<?php
//OptionTree Stuff
function option_tree_theme_setup2() {
  $theme_options = get_option('option_tree');
    
  $all_css = $overridecss = $loadgooglefonts = "";
  /* asset color */
  if ( !empty($theme_options['custom_asset_color']) ) {
    $overridecss = $overridecss . ' ' . "
    a, .logo-text:after, .logo-text:before, .header-classic .navbar-default .navbar-nav>.firstitem.current-menu-item>a, .header-classic .navbar-default .navbar-nav>.firstitem.current-menu-item>a:hover, .header-classic .navbar-default .navbar-nav>.firstitem.current-menu-item>a:focus, .header-classic .navbar-default .navbar-nav>.firstitem.current-menu-parent>a, .header-classic .navbar-default .navbar-nav>.firstitem.current-menu-parent>a:hover, .header-classic .navbar-default .navbar-nav>.firstitem.current-menu-parent>a:focus, .navbar-default .navbar-nav>li>a:hover, .navbar-default .navbar-nav>li>a:focus, .topsection-about a:hover, .bliccaThemes-header-search:hover i, .header-social a div:hover i, .blog-standard-right-sidebar .blog-meta a:hover, .blog-standard-right-sidebar .blog-title a:hover, .masonry-blog .blog-meta a:hover, .masonry-blog .blog-title a:hover, .featured-meta a:hover, .featured-meta p a, .page-numbers .current:hover, .page-numbers .current, .page-numbers > li:hover a, .sidebar-widget h5, .sidebar-widget ul li a:hover, .footer-widget ul li a:hover, .bliccaThemes_twitter .twitter-widget .tweet a:hover, #wp-calendar tbody td a, #wp-calendar tfoot #next, #wp-calendar tfoot #prev, #wp-calendar tfoot #next a, #wp-calendar tfoot #prev a, .sidebar-widget .bliccaThemes-recent-post h6 a:hover, .contact-info .contact-widget i, .contact-info .social-widget a:hover .socialbox i, .blicca-list-style li:before, .sticky:after, .services-right:hover .services-right-content h4, .services-left:hover .services-left-content h4, .services-top:hover .services-top-content h4, .services-button, .bt-accordion-itemTitle.closeit h3:after, .bt-accordion-itemTitle.closeit h3:before, .bt-menu-filter ul li.active a, .bt-menu-filter ul li:hover a, .bt-event-content h3:before, .bt-event-content h3:after, .woocommerce #bliccaThemes-layout ul.products li.product .price, .woocommerce #bliccaThemes-layout div.product p.price, .woocommerce #bliccaThemes-layout div.product span.price, .woocommerce #bliccaThemes-layout .widget_price_filter .ui-slider .ui-slider-range, .woocommerce #bliccaThemes-layout .widget_price_filter .ui-slider .ui-slider-handle, .footer_bliccaThemes .footer-widget a:hover, .footer_bliccaThemes .twitter-widget a, .footer-widget ul li a:hover i, .footer-widget ul li a:hover, .footer_bliccaThemes .twitter-widget .tweet_meta a, .footer_bliccaThemes .twitter-widget a:hover, .footer_bliccaThemes .twitter-widget .tweet_meta a:hover
    { color: {$theme_options['custom_asset_color']}; }   

    .ball_1, .ball_2, .ball_3, .ball_4, .header-classic .navbar-nav>li>a:before, .header-classic .navbar-default .navbar-nav>.firstitem.current-menu-item>a:before, .header-fixed.on-sticky .navbar-nav>li>a:before, .header-fixed.on-sticky .navbar-default .navbar-nav>.firstitem.current-menu-item>a:before, .b_asset, a.bliccaThemes-loading-button, .single-tags a:hover, .comment-respond input#submit, a.comment-reply-link, a.comment-reply-link:hover, .blog-left:hover a, .blog-right:hover a, .sidebar-widget .bliccaThemes-tag-cloud ul li a:hover, input[type=\"submit\"].wpcf7-form-control , input[type=\"button\"].wpcf7-form-control, span.highlight2, .services-right:hover .holder, .services-left:hover .holder, .services-top:hover .holder, .bt-event-readmore, #bliccaThemes-layout .vc_btn-sandy_brown, #bliccaThemes-layout a.vc_btn-sandy_brown, #bliccaThemes-layout .asset.vc_btn, #directions input#getDirections, .woocommerce #bliccaThemes-layout #respond input#submit.alt, .woocommerce #bliccaThemes-layout a.button.alt, .woocommerce #bliccaThemes-layout button.button.alt, .woocommerce #bliccaThemes-layout input.button.alt, .woocommerce #bliccaThemes-layout #respond input#submit, .woocommerce #bliccaThemes-layout a.button, .woocommerce #bliccaThemes-layout button.button, .woocommerce #bliccaThemes-layout input.button, #bliccaThemes-layout .woocommerce-tabs ul.tabs li.active, .woocommerce #bliccaThemes-layout span.onsale
    { background: {$theme_options['custom_asset_color']}; }

    .dropdown-menu>li>a::after, .multi .dropdown-menu li>ul>li>a::after 
    { background: {$theme_options['custom_asset_color']} !important; }

    .sticky, .services-right:hover .holder, .services-left:hover .holder, .services-top:hover .holder 
    { border-color: {$theme_options['custom_asset_color']}; }
    "; }         
  //
  // Body Back Image  
  //

  $temp_back_css = "";
  $boxed_back_array = ot_get_option('boxed_back');
  
  if ( !empty($boxed_back_array['background-color'])) {
    $temp_back_css = $temp_back_css . 'background-color:' . $boxed_back_array['background-color'] . ';';
  }
  if ( !empty($boxed_back_array['background-image'])) {
    $temp_back_css = $temp_back_css . 'background-image: url(' . $boxed_back_array['background-image'] . ');';
  }
  
  if ( !empty($boxed_back_array['background-repeat'])) {
    $temp_back_css = $temp_back_css . 'background-repeat: ' . $boxed_back_array['background-repeat'] . ';';
  }
  
  if ( !empty($boxed_back_array['background-attachment'])) {
    $temp_back_css = $temp_back_css . 'background-attachment: ' . $boxed_back_array['background-attachment'] . ';';
  }
  
  if ( !empty($boxed_back_array['background-position'])) {
    $temp_back_css = $temp_back_css . 'background-position: ' . $boxed_back_array['background-position'] . ';';
  }
  
  if ( !empty($boxed_back_array['background-size'])) {
    $temp_back_css = $temp_back_css . 'background-size: ' . $boxed_back_array['background-size'] . ';';
  }
  
  if ( !empty($temp_back_css)) {
    $overridecss = $overridecss . ' body{ ' . $temp_back_css . ' } ';
  }     
  
  //
  // Header Codes
  // 
  if( !isset($theme_options['blog_style'])) { $blog_style = "standard-right-sidebar"; }
    else { $blog_style = $theme_options['blog_style']; }

  if ( !empty($theme_options['top_section_bg']) ) {
  $overridecss = $overridecss . ' ' . ".topsection { background: {$theme_options['top_section_bg']}; }";  
  }
  
  if ( !empty($theme_options['top_section_fc']) ) {
  $overridecss = $overridecss . ' ' . ".topsection-about a, .topsection-about, .header-social a div i, .bliccaThemes-header-search i, .topsection-about .fa-envelope, .topsection-about .fa-phone { color: {$theme_options['top_section_fc']}; }";  
  }

  if ( !empty($theme_options['top_section_border']) ) {
  $overridecss = $overridecss . ' ' . ".topsection, .header-social, .bliccaThemes-header-search { border-color: {$theme_options['top_section_border']}; }";  
  }
  
  if ( !empty($theme_options['header_background_color']) ) {
  $overridecss = $overridecss . ' ' . ".bliccaThemes-header.header-1 { background: {$theme_options['header_background_color']}; }";  
  }

  if ( !empty($theme_options['header_text_color']) ) {
  $overridecss = $overridecss . ' ' . "a.logo-text { color: {$theme_options['header_text_color']}; }";  
  }
  
  if ( !empty($theme_options['menu_link_color']) ) {
  $overridecss = $overridecss . ' ' . ".navbar-default .navbar-nav>li>a { color: {$theme_options['menu_link_color']}; }";  
  }
  
  if ( !empty($theme_options['menu_link_active_hover_color']) ) {
  $overridecss = $overridecss . ' ' . ".header-1 .navbar-default .navbar-nav>.firstitem.current-menu-item>a, .header-1 .navbar-default .navbar-nav>.firstitem.current-menu-item>a:hover, .header-1 .navbar-default .navbar-nav>.firstitem.current-menu-item>a:focus, .header-1 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a, .header-1 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a:hover, .header-1 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a:focus, .navbar-default .navbar-nav>li>a:hover, .navbar-default .navbar-nav>li>a:focus { color: {$theme_options['menu_link_active_hover_color']}; }";  
  }  

  if ( !empty($theme_options['dropdown_menu_color']) ) {
  $overridecss = $overridecss . ' ' . ".dropdown-menu { background: {$theme_options['dropdown_menu_color']}; }";      
  }
  if ( !empty($theme_options['dropdown_menu_title']) ) {
  $overridecss = $overridecss . ' ' . ".dropdown-menu>li>a { color: {$theme_options['dropdown_menu_title']}; }";      
  }
  if ( !empty($theme_options['dropdown_menu_title_hover']) ) {
  $overridecss = $overridecss . ' ' . ".dropdown-menu>li>a:hover { color: {$theme_options['dropdown_menu_title_hover']}; }";      
  }
  if ( !empty($theme_options['dropdown_menu_border_color']) ) {
  $overridecss = $overridecss . ' ' . ".header-1 .dropdown-menu, .dropdown-menu>li:not(:last-child)>a { border-color: {$theme_options['dropdown_menu_border_color']}; }";      
  }
  
  //
  // Footer Options
  //
  if ( !empty($theme_options['footer_bg_color']) ) {
  $overridecss = $overridecss . ' ' . "footer { background: {$theme_options['footer_bg_color']}!important; }"; 
  }
  if ( !empty($theme_options['footer_title_color']) ) {
  $overridecss = $overridecss . ' ' . "footer h4 { color: {$theme_options['footer_title_color']}!important; }"; 
  }
  if ( !empty($theme_options['footer_p_color']) ) {
  $overridecss = $overridecss . ' ' . ".footer-widget p, .twitter-widget .tweet i { color: {$theme_options['footer_p_color']}!important; }"; 
  }
  if ( !empty($theme_options['footer_a_color']) ) {
  $overridecss = $overridecss . ' ' . ".footer-widget a, .footer-widget ul li a, .footer_dark .comment-author-link { color: {$theme_options['footer_a_color']}!important; }"; 
  }
  if ( !empty($theme_options['copy_bg_color']) ) {
  $overridecss = $overridecss . ' ' . ".copyright-background { background: {$theme_options['copy_bg_color']}!important; }"; 
  }
  if ( !empty($theme_options['copy_p_color']) ) {
  $overridecss = $overridecss . ' ' . ".copyright-section a, .copyright-section p, .copyright-section i { color: {$theme_options['copy_p_color']}!important; }"; 
  }

  //
  // Fonts  
  //
  $body_fonts =  ot_get_option('body_font');
  $h1_fonts =  ot_get_option( 'h1_font' );
  $h2_fonts =  ot_get_option( 'h2_font' );
  $h3_fonts =  ot_get_option( 'h3_font' );
  $h4_fonts =  ot_get_option( 'h4_font' );
  $h5_fonts =  ot_get_option( 'h5_font' );
  $h6_fonts =  ot_get_option( 'h6_font' );
  $header_logo_fonts =  ot_get_option( 'header_logo_font' );
  $header_link_fonts =  ot_get_option( 'header_link_font' );
  $footer_title_fonts =  ot_get_option( 'footer_title_font' );
  $footer_p_fonts =  ot_get_option( 'footer_p_font' );
  $footer_copyright_fonts =  ot_get_option( 'footer_copyright_font' );
  $sidebar_title_fonts = ot_get_option( 'sidebar_title_font' );
  $section_title_fonts = ot_get_option( 'section_title_font' );
  $restaurant_menu_category = ot_get_option( 'restaurant_menu_category' );
  $restaurant_menu_item = ot_get_option( 'restaurant_menu_item' );
  $caption_defaults = ot_get_option( 'caption_defaults' );    
  //class
  $arrayleng = 0;
  $diziclass = array ( "body", "h1", "h2", "h3", "h4", "h5", "h6", ".header-1 .logo-text", ".multi .dropdown-menu li>ul>li>a, .dropdown-menu>li>a, .bliccaThemes-header, .header-1 .navbar-nav>li>a", "footer h4", ".footer-widget p", ".copyright-section", ".sidebar-widget h5", ".bliccaThemes_section_title h2", ".bt-menu-classic-catname h4, .bt-accordion-itemTitle.closeit h3, .bt-accordion-itemTitle h3, h4.bt-accordion-subtitle", ".bt-menu-item-s1 .bt-menu-itemContent h4, .bt-menu-classic-title, .bt-menu-classic-price, .bt-menu-item-s1 p.bt-menu-itemPrice, .bt-menu-item-s1 p", ".caption h1" );

  //options
  $bliccaThemes_font_set = array( $body_fonts, $h1_fonts, $h2_fonts, $h3_fonts, $h4_fonts, $h5_fonts, $h6_fonts, $header_logo_fonts, $header_link_fonts, $footer_title_fonts, $footer_p_fonts, $footer_copyright_fonts, $sidebar_title_fonts, $section_title_fonts, $restaurant_menu_category, $restaurant_menu_item, $caption_defaults );
  
  //css
  $bliccaThemes_user_fonts = array();
  $temp_google_fonts = 'Great+Vibes';
 
  foreach( $bliccaThemes_font_set as $temp_font_set )
    {
      
      $temp_css_all = "";
      
      if ( !empty($temp_font_set['font-family']) ) {
            if (in_array($temp_font_set["font-family"], $bliccaThemes_user_fonts)) {
                $temp_css_all = $temp_css_all . 'font-family: "' . $temp_font_set['font-family'] . '";'; 
            }
          
            else {
                $bliccaThemes_user_fonts[] = $temp_font_set['font-family'];
                $user_font = str_replace(' ', '+', $temp_font_set['font-family']);
                
                $temp_google_fonts = $temp_google_fonts . ',' . $user_font;
                
                $temp_css_all = $temp_css_all . 'font-family: "' . $temp_font_set['font-family'] . '";'; 
            }
          
        }
      
      if ( !empty($temp_font_set['font-size'] ) ){
          $temp_css_all = $temp_css_all . 'font-size: ' . $temp_font_set['font-size'] . ';';
      }

      if ( !empty($temp_font_set['font-color'] ) ){
          $temp_css_all = $temp_css_all . 'color: ' . $temp_font_set['font-color'] . ';';
      }

      if ( !empty($temp_font_set['font-style'] ) ){
          $temp_css_all = $temp_css_all . 'font-style: ' . $temp_font_set['font-style'] . ';';
      }

      if ( !empty($temp_font_set['font-variant'] ) ){
          $temp_css_all = $temp_css_all . 'font-variant: ' . $temp_font_set['font-variant'] . ';';
      }

      if ( !empty($temp_font_set['font-weight'] ) ){
          $temp_css_all = $temp_css_all . 'font-weight: ' . $temp_font_set['font-weight'] . ';';
      }

      if ( !empty($temp_font_set['letter-spacing'] ) ){
          $temp_css_all = $temp_css_all . 'letter-spacing: ' . $temp_font_set['letter-spacing'] . ';';
      } 

      if ( !empty($temp_font_set['line-height'] ) ){
          $temp_css_all = $temp_css_all . 'line-height: ' . $temp_font_set['line-height'] . ';';
      }
      
      if ( !empty($temp_font_set['text-decoration'] ) ){
          $temp_css_all = $temp_css_all . 'text-decoration: ' . $temp_font_set['text-decoration'] . ';';
      }      
          
      if ( !empty($temp_font_set['text-transform'] ) ){
          $temp_css_all = $temp_css_all . 'text-transform: ' . $temp_font_set['text-transform'] . ';';
      }
      
      if ( !empty($temp_css_all) ) {
                  
          $overridecss = $overridecss . ' ' . $diziclass[$arrayleng] . ' { ' . $temp_css_all . ' } ';
      }
      $arrayleng++;
    }
 
  //
  // Miscellaneous
  //
  if( !isset($theme_options['sidebar_position'])) { $blog_style = "sidebar_on_right"; }
  else { $blog_style = $theme_options['sidebar_position']; }
  
  if ( $blog_style == "sidebar_on_left" ) {
  $overridecss = $overridecss . ' ' . ".blog-wrapper { padding-left: 30px; padding-right: 0; } .sidebar .sidebar-widget { padding-left:0; padding-right: 30px; }";  
  }

  if ( !empty($theme_options['blog_caption_image']) ) {
  $overridecss = $overridecss . ' ' . ".caption { background: url({$theme_options['blog_caption_image']}) no-repeat center; }"; 
  }
  
  if ( !empty($theme_options['caption_text_color']) ) {
  $overridecss = $overridecss . ' ' . ".caption { color: {$theme_options['caption_text_color']}; }"; 
  }
  if ( !empty($theme_options['shop_caption_image']) ) {
  $overridecss = $overridecss . ' ' . ".woocommerce .caption, .woocommerce-page .caption { background: url({$theme_options['shop_caption_image']}) no-repeat center; }"; 
  }
  
  if ( !empty($theme_options['shop_text_color']) ) {
  $overridecss = $overridecss . ' ' . ".woocommerce .caption, .woocommerce-page .caption { color: {$theme_options['shop_text_color']}; }"; 
  }   
  //
  // Don't write anything below, just write above
  //
  if ( !empty($theme_options['custom_css']) ) {
  $overridecss =  $overridecss . ' ' . "{$theme_options['custom_css']}";
  }
  
  $all_css = $overridecss;
  $all_fonts = $temp_google_fonts;
  define('googlefonts', $all_fonts);
  define('bliccaThemes_custom', $all_css);
  function bliccaThemes_user_style() {
    wp_add_inline_style( 'custom_style', bliccaThemes_custom);
  }
  add_action('wp_enqueue_scripts', 'bliccaThemes_user_style', 21);

  $charfamilyset = "latin";
  $charfamilyget = ot_get_option('character_sets');
  if ( is_array ($charfamilyget) ) {
    $i = 0;
    foreach( $charfamilyget as $temp_char ) {
        $charfamilyset .= ','.$temp_char;
        $i++;
    }
    $i = 0; 
  }

  define('charfamily', $charfamilyset);
  /***********************/
  /* Register Custom CSS */
  /***********************/
  function bliccaThemes_style() {
      wp_enqueue_style( 
              'custom_style',
              get_template_directory_uri() . '/css/options.css' 
      );
      
      $site_parameters = array(
    'theme_directory' => get_template_directory_uri(), 'theme_fonts' => googlefonts, 'font_char' => charfamily
    );
    wp_localize_script( 'main', 'SiteParameters', $site_parameters, 'font_char' );      
  }
  
  add_action( 'wp_enqueue_scripts', 'bliccaThemes_style', 20 );  
}
add_action( 'after_setup_theme', 'option_tree_theme_setup2' );