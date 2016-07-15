<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <html class="no-js"> <![endif]-->
  <head>
     <?php if ( function_exists( 'get_option_tree') ) {
        $theme_options = get_option('option_tree');  
      } ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="author" content="bliccaThemes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php if (!empty($theme_options['favicon_upload'])){?>
        <link rel="shortcut icon" href="<?php echo esc_url($theme_options['favicon_upload']); ?>" />
    <?php } ?>
    <?php wp_head(); ?>
  </head>
  <?php
  $smoothscroll =  get_option_tree('disable_smooth_scroll', $theme_options);
  if ( $smoothscroll == "Yes" ) {
  $extra_body = "enable_smoothscroll";  
 	}

  else { 
  $extra_body = "disable_smoothscroll";   
  }
  $fixed_header = get_option_tree('enable_fixed_header', $theme_options);
  if ( $fixed_header == "Yes") {
  $extra_body .= " enable_fixhead";
  }

  $header_style = get_option_tree('header_style', $theme_options);

  if ( $header_style == "" ) {
    $header_style = "header-classic";
  }
 
  ?>
  <body <?php body_class($extra_body); ?>>
    <div id="bliccaThemes-loader">
      <div class="fond">
        <div class="contener_general">
            <div class="contener_mixte"><div class="ballcolor ball_1">&nbsp;</div></div>
            <div class="contener_mixte"><div class="ballcolor ball_2">&nbsp;</div></div>
            <div class="contener_mixte"><div class="ballcolor ball_3">&nbsp;</div></div>
            <div class="contener_mixte"><div class="ballcolor ball_4">&nbsp;</div></div>
        </div>
      </div>
    </div>     

    <div id="bliccaThemes-layout">
    <?php 
    $boxed =  get_option_tree('boxed', $theme_options);
    if ( $boxed == "Yes" ) {
    ?><div class="bliccaThemesBox"><?php
    }
		?>     
    <!-- Top Section -->
    <!-- Header -->

    <header id="bliccaThemes_header" class="bliccaThemes-header header-1 <?php echo esc_attr($header_style);?> off-sticky">
			<?php 
						get_template_part( 'includes/header/bt', $header_style ); 
			?>	
      
    </header>