<?php
$output = $el_class = $bg_image = $row_id = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $new_background = $background_attachmen = $fix_video = $video_url_webm = $video_url = $image_ratio = $parallax_settings = $maps_url = $maps_size = $maps_background = $widthy = $marker_url = $full_width = $new_textalign = $add_maps_back = $marker_image = '';
extract(shortcode_atts(array(
    'el_class'        => '',
    'el_id'           => '',
    'bg_image'        => '',
    'bg_color'        => '',
    'bg_image_repeat' => '',
    'new_background' => '',
    'video_url'    => '',
    'video_url_webm' => '',
    'video_url_ogv' => '',
    'image_ratio'  => '',
    'font_color'      => '',
    'add_maps_back' => '',
    'maps_url' 				=> '',
    'marker_url'			=> '',
    'marker_image' => '',
    'padding'         => '',
    'margin_bottom'   => '',
    'full_width' => '',
    'new_textalign' => '',
    'animation' => ''
), $atts));

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');
$css= "";
$el_class = $this->getExtraClass($el_class);

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row '.get_row_css_class().$el_class, $this->settings['base']);$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
if( $new_textalign != "default" ) {
  $css_class .= ' '.$new_textalign; 
}
if ( $new_background == "parallax") {
  $css_class .= " m_parallax";
  $image_ratio = ' data-stellar-background-ratio="'.$image_ratio.'"';  
}

else if ( $new_background == "video" ) {
  $css_class .= " bliccaThemes_video";
  $image_ratio = "";
  $fix_video = ' style="position: relative;"';  
}

if ( $new_background != "parallax") {
  $image_ratio = "";
}

if ( $full_width == "yes" ) {
	$css_class .= " full";
}

if ( $el_id != "") {
  $row_id = 'id="'.$el_id.'" ';
}

$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom, $new_background);
echo '<div '.$row_id.'class="'.$animation.' '.$css_class.' animated"'.$style.''.$image_ratio.'>';
if ( $new_background == 'video') {
    $image_url = wp_get_attachment_url( $bg_image, 'large' );
		echo '<div class = "video_back"><video poster="'.$image_url.'" preload autoplay="autoplay" loop="loop">';
		echo '<source src="'.$video_url.'" type="video/mp4">';		
		echo '<source src="'.$video_url_webm.'" type="video/webm; codecs=vp8,vorbis">';
		echo '<source src="'.$video_url_ogv.'" type="video/ogg; codecs=theora,vorbis"></video></div>';
		}
echo $maps_background;
echo '<div class="container"'.$fix_video.'><div class="row">';
echo wpb_js_remove_wpautop($content);
echo '</div></div></div>'.$this->endBlockComment('row');