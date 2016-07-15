<?php
global $woocommerce;

function bliccaThemes_woocommerce() {
	if ( class_exists( 'woocommerce' ) ) { return true; }
	return false;
}

if ( !bliccaThemes_woocommerce() ) { return false; }
/***************************************************/
if ( function_exists( 'get_option_tree') ) {
    $theme_options = get_option('option_tree');  
} 


function bliccaThemes_shop_loop_count() {
  $shop_paged = ot_get_option('shop_paged');
  if ( $shop_paged == "") {
  $shop_paged = "10";
  }
 
  add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . $shop_paged . ';' ), 20 );
}
add_action( 'after_setup_theme', 'bliccaThemes_shop_loop_count');

// Change number of products per row to 3
add_filter('loop_shop_columns', 'blicca_Themes_loop_columns');
if (!function_exists('blicca_Themes_loop_columns')) {
	function blicca_Themes_loop_columns() {
    	$shop_item = ot_get_option('shop_item');
        if($shop_item == "") { $shop_item = "3"; }
		return $shop_item; 
	}
}

/* WooCommerce Related */ 
add_filter( 'woocommerce_output_related_products_args', 'bliccaThemes_woo_related' );
function bliccaThemes_woo_related( $args ) {
$args['posts_per_page']     = 3; // 3 related products
$args['columns']            = 3; // arranged in columns

return $args;
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
add_action( 'woocommerce_before_main_content', 'bliccaThemes_before_main_content', 10);
add_action( 'woocommerce_after_main_content', 'bliccaThemes_after_main_content', 10);
add_filter('woocommerce_show_page_title', 'bliccaThemes_remove_wootitle');
function bliccaThemes_remove_wootitle( $variable ) {
$variable=false;
return $variable;
}

function bliccaThemes_before_main_content() {
global $post;
 
if ( function_exists( 'get_option_tree') ) {
    $theme_options = get_option('option_tree');  
}  
$woocommerce_style =  get_option_tree('woocommerce_style', $theme_options);
if ( !isset($woocommerce_style) || $woocommerce_style == "" ) { $woocommerce_style == "col-md-8"; }
if ( is_single() ) {
$woocommerce_style = "col-md-12";
}

if(isset($theme_options['shop_header'])) { /* dont */ }
    else { $theme_options['shop_header'] = "Set from Theme Options"; }
if(isset($theme_options['shop_caption'])) { /*dont */ }
    else { $theme_options['shop_caption'] = " "; }
if ( isset($theme_options['shop_item'] )) {
		    $shop_item = $theme_options['shop_item']; 
		}
		else {
		    $shop_item = 3; 
		}  
?>
<section class="bliccaThemes-waypoint" data-animate-down="on-sticky" data-animate-up="off-sticky">   
    <div class="caption-container">
        <div class="caption"><div class="container"><div class="row"><div class="col-md-12">
            <h1 <?php bliccaThemes_h2($post); ?>><?php echo $theme_options['shop_header']; ?></h1>
              <div class="bt_caption_sep">
              <?php if (!empty($theme_options['subpage_leaf'])){?>
                    <img src="<?php echo esc_url($theme_options['subpage_leaf']);?>"> 
              <?php }
              else { ?>              
                  <img src="<?php echo get_template_directory_uri(); ?>/img/iconpronto.png">
              <?php } ?>
              </div>
            <p><?php echo esc_html($theme_options['shop_caption']); ?></p>
        </div></div></div></div>
	</div>
	<div class="bliccaThemes-shop bliccaThemes-shop-grid<?php echo esc_attr($shop_item); ?>"><div class="container"><div class="<?php echo esc_attr($woocommerce_style); ?>">
<?php			 
}

function bliccaThemes_after_main_content() {
if ( function_exists( 'get_option_tree') ) {
    $theme_options = get_option('option_tree');  
}  
$woocommerce_style =  get_option_tree('woocommerce_style', $theme_options);
if ( !isset($woocommerce_style) || $woocommerce_style == "" ) { $woocommerce_style == "col-md-8"; }
if ( is_single() ) {
$woocommerce_style = "col-md-12";
}  
	?>
	</div>
	<?php
	if ( !is_single() && $woocommerce_style != "col-md-12" ) { get_sidebar('shop'); }
	?>
	</div></div>
</section>
	<?php
}