<?php
/***************************/
/* OPTIONTREE FRAMEWORK    */
/***************************/
add_filter( 'ot_show_pages', '__return_false' );

add_filter( 'ot_theme_mode', '__return_true' );

include_once( 'option-tree/ot-loader.php' );

include_once( 'includes/theme-options.php' );

include ('includes/page_metaboxes.php');
/******************/
/*Register Scripts*/
/******************/
function bliccaThemes_script() {
    wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-2.6.2-respond-1.1.0.min.js', array( 'jquery' ));
    if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
    wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '', true );   
    wp_register_script( 'imagesload', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('jquery'), '', true);
    wp_register_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array('jquery'), '', true);
    wp_register_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery'), '', true);
      
    
    wp_enqueue_script('jquery');   
    wp_enqueue_script('modernizr');
    wp_enqueue_script('bootstrap');
    wp_enqueue_script('imagesload');
    wp_enqueue_script('plugins'); 
    wp_enqueue_script('main');

    }
add_action( "wp_enqueue_scripts", "bliccaThemes_script" );

/***********************/
/*    Register  CSS    */
/***********************/
function bliccaThemes_styles($theme_options) {
    wp_register_style('bootstrap', get_template_directory_uri(). '/css/bootstrap.min.css');
    wp_register_style('flexslider', get_template_directory_uri(). '/css/flexslider.css');
    wp_register_style('fontawesome', get_template_directory_uri(). '/css/font-awesome.min.css');
    wp_register_style('pretty', get_template_directory_uri(). '/css/prettyPhoto.css');
    wp_register_style('main', get_template_directory_uri(). '/css/main.css');
    wp_register_style('animate', get_template_directory_uri(). '/css/animate.css');
    wp_enqueue_style('bootstrap');
    wp_enqueue_style('flexslider');
    wp_enqueue_style('fontawesome');
    wp_enqueue_style('pretty');  
    wp_enqueue_style('main');
    wp_enqueue_style('animate'); 

    // enqueue custom fonts from Google Font library
    wp_enqueue_style( 'pronto-google-fonts', 'http://fonts.googleapis.com/css?family=Architects+Daughter|Slabo+27px|Open+Sans' );       
}
add_action('wp_enqueue_scripts', 'bliccaThemes_styles');

/***********************/
/* Register Style CSS  */
/***********************/
function bliccaThemes_child() {
    wp_register_style('child', get_stylesheet_uri() );
    wp_enqueue_style('child');
}
add_action('wp_enqueue_scripts', 'bliccaThemes_child', 22);
/********************/
/* Content Width    */
/*******************/   
if ( ! isset( $content_width ) ) $content_width = 1040;

/*****************/
/*** Thumbnail ***/
/*****************/
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 770, 522, true );
add_image_size( 'bliccaThemes-grid', 480, 325, true );
add_image_size( 'bliccaThemes-menus1', 166, 160, true );
add_image_size( 'bliccaThemes-event', 770, 468, true );
/*****************/
/*  WP Title     */
/*****************/
if ( ! function_exists( '_wp_render_title_tag' ) ) {
    function bliccaThemes_render_title() {
?>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
    }
    add_action( 'wp_head', 'bliccaThemes_render_title' );
}
add_theme_support( "title-tag" );
/*****************/
/*    FEED      */
/*****************/
add_theme_support( 'automatic-feed-links' );

/******************************/
/* Multiple Image for Gallery */
/*****************************/

if (class_exists('MultiPostThumbnails')) {
$types = array('post');
 foreach($types as $type) {
new MultiPostThumbnails(array(
'label' => 'Secondary Image',
'id' => 'secondary-image',
'post_type' => $type
 ) );

new MultiPostThumbnails(array(
'label' => 'Third Image',
'id' => 'third-image',
'post_type' => $type
 ) );

new MultiPostThumbnails(array(
'label' => 'Fourth Image',
'id' => 'fourth-image',
'post_type' => $type
 ) );

new MultiPostThumbnails(array(
'label' => 'Fifth Image',
'id' => 'fifth-image',
'post_type' => $type
 ) );

new MultiPostThumbnails(array(
'label' => 'Sixth Image',
'id' => 'last-image',
'post_type' => $type
 ) );
 }
}

/*************************/
/* Thumbnail need these */
/************************/
include ('includes/function-vt-resize.php');

/**********************/
/*** Custom Post Type */
/**********************/
include ('includes/custom-post-type.php');

/**************************/
/*** Blog intro length ***/
/*************************/
function bliccaThemes_custom_excerpt_length( $length ) {
    return 90;
}

add_filter( 'excerpt_length', 'bliccaThemes_custom_excerpt_length', 999 );

/************************/
/* Dynamic CSS */
/************************/

  include ('css/options.php');
  
/*********************/
/* Load Text Domain */
/*********************/
add_action('after_setup_theme', 'bliccaThemes_lang_text_setup');
function bliccaThemes_lang_text_setup(){
load_theme_textdomain('bliccaThemes', get_template_directory().'/languages');
}
/**************************/
/*    Include Plugins     */
/**************************/
 
require_once get_template_directory() . "/plugins/install.php";

/**********************/
/*---Register Menus---*/
/*********************/
function bliccaThemes_register_my_menus() {
register_nav_menus(
array(
'main_menu' => 'Main Menu'
)
);
}
add_action( 'init', 'bliccaThemes_register_my_menus' );
?>
<?php 
/*********************************/
/* Register Walker for Main Menu */
/*********************************/
class bliccaThemes_sweet_custom_menu {

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {

		
		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'bliccaThemes_scm_add_custom_nav_fields' ) );

		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'bliccaThemes_scm_update_custom_nav_fields'), 10, 3 );
		
		// edit menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'bliccaThemes_scm_edit_walker'), 10, 2 );

	} // end constructor
	
	
	
	/**
	 * Add custom fields to $item nav object
	 * in order to be used in custom Walker
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function bliccaThemes_scm_add_custom_nav_fields( $menu_item ) {
	
	    $menu_item->extra_class = get_post_meta( $menu_item->ID, '_menu_item_extra_class', true );
	    return $menu_item;
	    
	}
	
	/**
	 * Save menu custom fields
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function bliccaThemes_scm_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
	
	    // Check if element is properly sent
	    if ( isset( $_REQUEST['menu-item-extra_class'] ) && is_array( $_REQUEST['menu-item-extra_class']) ) {
	        $extra_class_value = $_REQUEST['menu-item-extra_class'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_extra_class', $extra_class_value );
	    }
	    
	}
	
	/**
	 * Define new Walker edit
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function bliccaThemes_scm_edit_walker($walker,$menu_id) {
	
	    return 'Walker_Nav_Menu_Edit_Custom';
	    
	}

}
// instantiate plugin's class
$GLOBALS['sweet_custom_menu'] = new bliccaThemes_sweet_custom_menu();
/**
 *  /!\ This is a copy of Walker_Nav_Menu_Edit class in core
 * 
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu  {
	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {	
	}
	
	/**
	 * @see Walker_Nav_Menu::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
	}
	
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
	    global $_wp_nav_menu_max_depth;
	   
	    $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;
	
	    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
	    ob_start();
	    $item_id = esc_attr( $item->ID );
	    $removed_args = array(
	        'action',
	        'customlink-tab',
	        'edit-menu-item',
	        'menu-item',
	        'page-tab',
	        '_wpnonce',
	    );
	
	    $original_title = '';
	    if ( 'taxonomy' == $item->type ) {
	        $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
	        if ( is_wp_error( $original_title ) )
	            $original_title = false;
	    } elseif ( 'post_type' == $item->type ) {
	        $original_object = get_post( $item->object_id );
	        $original_title = $original_object->post_title;
	    }
	
	    $classes = array(
	        'menu-item menu-item-depth-' . $depth,
	        'menu-item-' . esc_attr( $item->object ),
	        'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
	    );
	
	    $title = $item->title;
	
	    if ( ! empty( $item->_invalid ) ) {
	        $classes[] = 'menu-item-invalid';
	        /* translators: %s: title of menu item which is invalid */
	        $title = sprintf( __( '%s (Invalid)' ), $item->title );
	    } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
	        $classes[] = 'pending';
	        /* translators: %s: title of menu item in draft status */
	        $title = sprintf( __('%s (Pending)'), $item->title );
	    }
	
	    $title = empty( $item->label ) ? $title : $item->label;
	
	    ?>
	    <li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo implode(' ', $classes ); ?>">
	        <dl class="menu-item-bar">
	            <dt class="menu-item-handle">
	                <span class="item-title"><?php echo esc_html( $title ); ?></span>
	                <span class="item-controls">
	                    <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
	                    <span class="item-order hide-if-js">
	                        <a href="<?php
	                            echo wp_nonce_url(
	                                add_query_arg(
	                                    array(
	                                        'action' => 'move-up-menu-item',
	                                        'menu-item' => $item_id,
	                                    ),
	                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
	                                ),
	                                'move-menu_item'
	                            );
	                        ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up'); ?>">&#8593;</abbr></a>
	                        |
	                        <a href="<?php
	                            echo wp_nonce_url(
	                                add_query_arg(
	                                    array(
	                                        'action' => 'move-down-menu-item',
	                                        'menu-item' => $item_id,
	                                    ),
	                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
	                                ),
	                                'move-menu_item'
	                            );
	                        ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down'); ?>">&#8595;</abbr></a>
	                    </span>
	                    <a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="<?php esc_attr_e('Edit Menu Item', 'bliccaThemes'); ?>" href="<?php
	                        echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
	                    ?>"><?php _e( 'Edit Menu Item', 'bliccaThemes' ); ?></a>
	                </span>
	            </dt>
	        </dl>
	
	        <div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
	            <?php if( 'custom' == $item->type ) : ?>
	                <p class="field-url description description-wide">
	                    <label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
	                        <?php _e( 'URL', 'bliccaThemes' ); ?><br />
	                        <input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
	                    </label>
	                </p>
	            <?php endif; ?>
	            <p class="description description-thin">
	                <label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
	                    <?php _e( 'Navigation Label', 'bliccaThemes'  ); ?><br />
	                    <input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
	                </label>
	            </p>
	            <p class="description description-thin">
	                <label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
	                    <?php _e( 'Title Attribute', 'bliccaThemes'  ); ?><br />
	                    <input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
	                </label>
	            </p>
	            <p class="field-link-target description">
	                <label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
	                    <input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
	                    <?php _e( 'Open link in a new window/tab', 'bliccaThemes'  ); ?>
	                </label>
	            </p>
	            <p class="field-css-classes description description-thin">
	                <label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
	                    <?php _e( 'CSS Classes (optional)', 'bliccaThemes' ); ?><br />
	                    <input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
	                </label>
	            </p>
	            <p class="field-xfn description description-thin">
	                <label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
	                    <?php _e( 'Link Relationship (XFN)', 'bliccaThemes' ); ?><br />
	                    <input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
	                </label>
	            </p>
	            <p class="field-description description description-wide">
	                <label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
	                    <?php _e( 'Description', 'bliccaThemes' ); ?><br />
	                    <textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
	                    <span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.', 'bliccaThemes'); ?></span>
	                </label>
	            </p>        
	            <?php
	            /* New fields insertion starts here */
	            ?>      
	            <p class="field-custom description description-wide">
	                <label for="edit-menu-item-extra_class-<?php echo esc_attr($item_id); ?>">
	                    <?php _e( 'Extra Class', 'bliccaThemes' ); ?><br />
	                    <input type="text" id="edit-menu-item-extra_class-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-custom" name="menu-item-extra_class[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->extra_class ); ?>" />
	                </label>
	            </p>
	            <?php
	            /* New fields insertion ends here */
	            ?>
	            <div class="menu-item-actions description-wide submitbox">
	                <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
	                    <p class="link-to-original">
	                        <?php printf( __('Original: %s'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
	                    </p>
	                <?php endif; ?>
	                <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
	                echo wp_nonce_url(
	                    add_query_arg(
	                        array(
	                            'action' => 'delete-menu-item',
	                            'menu-item' => $item_id,
	                        ),
	                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
	                    ),
	                    'delete-menu_item_' . $item_id
	                ); ?>"><?php _e('Remove', 'bliccaThemes'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
	                    ?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php _e('Cancel', 'bliccaThemes'); ?></a>
	            </div>
	
	            <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
	            <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
	            <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
	            <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
	            <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
	            <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
	        </div><!-- .menu-item-settings-->
	        <ul class="menu-item-transport"></ul>
	    <?php
	    
	    $output .= ob_get_clean();

	    }
}
class bliccaThemes_walker_main_menu extends Walker_Nav_Menu {
  
// add classes to ul sub-menus
function start_lvl( &$output, $depth=0, $args=array() ) {
    // depth dependent classes
    $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
    $display_depth = ( $depth + 1); // because it counts the first submenu as 0
    $classes = array(
        
        ( $display_depth % 2  ? 'dropdown-menu' : '' ),
        ( $display_depth >=2 ? 'dropdown-menu' : '' )
        );
    $class_names = implode( ' ', $classes );
  
    // build html
    $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
}
  
// add main/sub classes to li's and links
 function start_el( &$output, $item, $depth = 0, $args = array(),$current_object_id = 0) {
    $mainSite = home_url();
    global $wp_query;
    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
  
    // depth dependent classes
    $depth_classes = array(
        ( $depth == 0 ? 'firstitem' : '' ),
        ( $depth >=2 ? '' : '' ),
        ( $depth % 2 ? '' : '' ),
        
    );
    $depth_class_names = esc_attr( implode( '', $depth_classes ) );
  
    // passed classes
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
  
    // build html
    $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . ' '. $item->extra_class . '">';
  
    // link attributes
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    if($item->object == 'sections') {
        $attributes .= ! empty( $item->url )        ? ' href="#go'.$item->object_id.'"' : '';
    }
    else {
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    }
    $attributes .= ! empty( $item->object_id )    ? ' data-id="go' . esc_attr( $item->object_id )  .'"' : '';
    $attributes .= ' class="menu-link"';

    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
        $args->before,
        $attributes,
        $args->link_before,
        apply_filters( 'the_title', $item->title, $item->ID ),
        $args->link_after,
        $args->after
    );
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

}
}

class bliccaThemes_walker_main_menu2 extends Walker_Nav_Menu {
  
// add classes to ul sub-menus
function start_lvl( &$output, $depth=0, $args=array() ) {
    // depth dependent classes
    $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
    $display_depth = ( $depth + 1); // because it counts the first submenu as 0
    $classes = array(
        
        ( $display_depth % 2  ? 'dropdown-menu' : '' ),
        ( $display_depth >=2 ? 'dropdown-menu' : '' )
        );
    $class_names = implode( ' ', $classes );
  
    // build html
    $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
}
  
// add main/sub classes to li's and links
 function start_el( &$output, $item, $depth = 0, $args = array(),$current_object_id = 0) {
    $mainSite = home_url();
    global $wp_query;
    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
  
    // depth dependent classes
    $depth_classes = array(
        ( $depth == 0 ? 'firstitem' : '' ),
        ( $depth >=2 ? '' : '' ),
        ( $depth % 2 ? '' : '' ),
        
    );
    $depth_class_names = esc_attr( implode( '', $depth_classes ) );
  
    // passed classes
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
  
    // build html
    $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . ' '. $item->extra_class . '">';
  
    // link attributes
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    if($item->object == 'sections') {
        $attributes .= ! empty( $item->url )        ? ' href="'.$mainSite.'#go'.$item->object_id.'"' : '';
    }
    else {
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_url( $item->url        ) .'"' : '';
    }
    $attributes .= ! empty( $item->object_id )    ? ' data-id="' . esc_attr( $item->object_id )  .'"' : '';
    $attributes .= ' class="menu-link"';

    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
        $args->before,
        $attributes,
        $args->link_before,
        apply_filters( 'the_title', $item->title, $item->ID ),
        $args->link_after,
        $args->after
    );
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

}
}

/*******************************/
/* Wordpress Widgets&Sidebar   */
/*******************************/
/******************************/
/* Sidebar */
/******************************/
function bliccaThemes_sidebar() {
  
register_sidebar(array(
'name'          => __( 'Main Sidebar', 'bliccaThemes' ),
'id'            => 'sidebar-1',
'before_widget' => '<div class="sidebar-widget %2$s">',
'after_widget'  => '<div class="bt_section_sep">NM</div></div>',
'before_title'  => '<h5>',
'after_title'   => '</h5>',
));
register_sidebar(array(
'name'          => __( 'Shop Sidebar', 'bliccaThemes' ),
'id'            => 'sidebar-2',
'before_widget' => '<div class="sidebar-widget %2$s">',
'after_widget'  => '<div class="bt_section_sep">NM</div></div>',
'before_title'  => '<h5>',
'after_title'   => '</h5>',
));    
}
add_action( 'widgets_init', 'bliccaThemes_sidebar' );

/******************************/
/* Footer Area Widget */
/******************************/
function bliccaThemes_widget() {

register_sidebar( array(
        'name' => __( 'Footer First', 'bliccaThemes' ),
        'id' => 'footer-first',
        'description' => __( 'Widget area for your footer', 'bliccaThemes' ),
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ) );

register_sidebar( array(
        'name' => __( 'Footer Second', 'bliccaThemes' ),
        'id' => 'footer-second',
        'description' => __( 'Widget area for your footer', 'bliccaThemes' ),
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ) );

register_sidebar( array(
        'name' => __( 'Footer Third', 'bliccaThemes' ),
        'id' => 'footer-third',
        'description' => __( 'Widget area for your footer', 'bliccaThemes' ),
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ) );
  register_sidebar( array(
        'name' => __( 'Footer Fourth', 'bliccaThemes' ),
        'id' => 'footer-fourth',
        'description' => __( 'Widget area for your footer', 'bliccaThemes' ),
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ) );

}
add_action( 'widgets_init', 'bliccaThemes_widget' );

/*********************************/
/*           Comment             */
/*********************************/
if ( ! function_exists( 'bliccaThemes_comment' ) ) :
function bliccaThemes_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p><?php _e( 'Pingback:', 'bliccaThemes' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'bliccaThemes' ), ' ' ); ?></p>
    <?php
            break;
        default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="media">
                    <div class="pull-left">            
                        <?php echo get_avatar( $comment, 80 ); ?>
                    </div>
                    <div class="media-body">
                    <?php printf( __( '%s', 'bliccaThemes' ), sprintf( '<h3 class="media-heading"><span>%s</span></h3>', get_comment_author_link() ) ); ?>
                    <p class="comment-date">
                        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
                        <?php
                            /* translators: 1: date, 2: time */
                            printf( __( '%1$s at %2$s', 'bliccaThemes' ), get_comment_date(), get_comment_time() ); ?>
                        </time></a>
                    </p>
                    <p class="comment-text"><?php comment_text(); ?></p>
                    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>  
                    <p class="reply"> <?php edit_comment_link( __( '(Edit)', 'bliccaThemes' ), ' ' );
                    ?>
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em><?php _e( 'Your comment is awaiting moderation.', 'bliccaThemes' ); ?></em>
                    <?php endif; ?>
                    </div>
            
        </article><!-- #comment-## -->
 
    <?php
            break;
    endswitch;
}
endif; // ends check for bliccaThemes_comment()

/*** Comment Form ***/
function bliccaThemes_alter_comment_form_fields(){
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $placename = __("Name *", "bliccaThemes");
    $placeemail = __("Email *", "bliccaThemes");
    $placeweb = __("Website", "bliccaThemes");
    $fields =  array(
        'author' => '<div class="col-md-5 form-group">'  .
                    '<input id="author" class="required form-control" name="author" type="text" placeholder="'.$placename.'" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' />'.'</div><div class="clearfix"></div>',
        'email'  => '<div class="col-md-5 form-group">' .
                    '<input id="email" class="required form-control" name="email" type="text" placeholder="'.$placeemail.'" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></div><div class="clearfix"></div>',
        'url'    => '<div class="col-md-5 form-group">' .
                    '<input id="url" class="form-control" name="url" type="text" placeholder="'.$placeweb.'" value="' . esc_attr( $commenter['comment_author_url'] ) . '"/>'.'</div><div class="clearfix"></div>',
        
    );
    return $fields;
}

add_filter('comment_form_default_fields','bliccaThemes_alter_comment_form_fields');

function bliccaThemes_defaults_comment_form($defaults) {

$theme_options = get_option('option_tree');

$comment_title = '<span>'. get_option_tree('comment_title',$theme_options) . '</span>'; 
if ( isset($comment_title) ) {} else { $comment_title = "<span>Leave your comment</span>"; }
$defaults['comment_field'] = '<div class="clearfix"></div><div class="col-md-12 form-group"><p class="single-comment">Your Message</p><textarea class="required form-control" type="text" rows="7" id="bliccaThemes_comment" name="comment" aria-required="true"></textarea></div>';
$defaults['comment_notes_after'] = "";
$defaults['comment_notes_before'] = "";
$defaults['label_submit'] = __('Submit', 'bliccaThemes');
$defaults['title_reply']  = $comment_title;

    return $defaults;
}
add_filter('comment_form_defaults','bliccaThemes_defaults_comment_form');
/********************************/
/*         Pagination           */
/********************************/
function bliccaThemes_pagination($pages = '', $range = 4)
{  
    global $wp_query;

                        $big = 999999999; // need an unlikely integer

                        echo paginate_links( array(
                            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format' => '?paged=%#%',
                            'current' => max( 1, get_query_var('paged') ),
                            'total' => $wp_query->max_num_pages,
                            'type'         => 'list'
                        ) );
}

function bliccaThemes_custom_nextpage_links($defaults) {
$args = array(
'before' => '<div class="pagination-container"><div class="post-pagination">',
'after' => '</div></div>',
'link_before'      => '<span>',
'link_after'       => '</span>'
);
$r = wp_parse_args($args, $defaults);
return $r;
}
add_filter('wp_link_pages_args','bliccaThemes_custom_nextpage_links');


/*****************************/
/* ADD CAPTION IMAGE TO PAGE */
/*****************************/
if ( ! function_exists( 'bliccaThemes_caption_image' ) ) {
function bliccaThemes_caption_image ($post) {
    $thumb_id = get_post_thumbnail_id($post->ID);
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
    $thumb_url = $thumb_url_array[0];
    $text_color = $back_size = "";
    $text_color = get_post_meta($post->ID, '_bliccaThemes_page_color', true);
    $back_color = get_post_meta($post->ID, '_bliccaThemes_page_back', true);
  
    $back_size = get_post_meta($post->ID, '_bliccaThemes_page_caption', true);
    if ( $back_size != "" ) {
    $back_size = 'height:'.$back_size.'px; padding:0;';
    }
    else {
    $back_size = 'height: 422px; padding:0;';
    }
    if ( $back_color == "") {
    $back_color = "#e2e2e2";  
    }
    if ( $text_color != "") { $text_color = 'color:'.$text_color.';'; }
    else {
    $text_color = 'color: #fff;';
    }
    if (has_post_thumbnail()) { 
    echo 'style="'.esc_attr($back_size).'background: url('.esc_url($thumb_url).') no-repeat center; background-size: cover;'.esc_attr($text_color).'"';

    }
    else {
    echo 'style="'.esc_attr($back_size).'background:'.esc_url($back_color).';'.esc_attr($text_color).'"';
    
    }
}
}

if ( ! function_exists( 'bliccaThemes_h2' ) ) {
function bliccaThemes_h2 ($post) {
    $text_color = "";
    if ( isset($post->ID)) {
    $text_color = get_post_meta($post->ID, '_bliccaThemes_page_color', true);
    }
    if ( $text_color != "") { echo 'style="color:'.esc_attr($text_color).';"'; }
    else {
    echo 'style="color: #fff;"';  
    }
}
}
/*******************************/
/* Gallery Links               */
/*******************************/
    function bliccaThemes_gallery_thumbnail_url($pid){  
    $image_id = get_post_thumbnail_id($pid);    
    $image_url = wp_get_attachment_image_src($image_id,'screen-shot');    
    return  $image_url[0];    
    }    
/**********************/
/*   Twitter Widget   */
/**********************/
function bliccaThemes_twitapi_links($text) {
      $text = eregi_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)','<a href="\\1">\\1</a>', $text);
            $text = eregi_replace('([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)','\\1<a href="http://\\2">\\2</a>', $text);
            return $text;
  }

if ( ! function_exists( 'bliccaThemes_timeSince' ) ) {  
function bliccaThemes_timeSince($time) {

        $since = time() - strtotime($time);

        $string     = '';

        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'minute'),
            array(1 , 'second')
        );

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        $string = ($count == 1) ? '1 ' . $name . ' ago' : $count . ' ' . $name . 's ago';

        return $string;

    }  
}
if ( ! function_exists( 'bliccaThemes_twitter_plug' ) ) {  
function bliccaThemes_twitter_plug() {
$theme_options = get_option('option_tree');
$access_token = get_option_tree('access_token',$theme_options);
$access_token_secret = get_option_tree('access_token_secret',$theme_options);
$consumer_key = get_option_tree('consumer_key',$theme_options);
$consumer_secret = get_option_tree('consumer_secret',$theme_options);
$twitter_user_name = get_option_tree('twitter_user_name',$theme_options);

if ( $access_token == "" || $access_token_secret == "" || $consumer_key == "" || $consumer_secret == "" || $twitter_user_name == "" ) { 
      echo '<div class="twitter-widget"><p>Please set your all keys and user name in theme options</p></div>';
  }
  
  else {
// Setting our Authentication Variables that we got after creating an application
$settings = array(
    'oauth_access_token' => $access_token,
    'oauth_access_token_secret' => $access_token_secret,
    'consumer_key' => $consumer_key,
    'consumer_secret' => $consumer_secret
);

// We are using GET Method to Fetch the latest tweets.
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

// Set your screen_name to your twitter screen name. Also set the count to the number of tweets you want to be fetched. Here we are fetching 5 latest tweets.
$getfield = '?screen_name='.$twitter_user_name.'&count=2';
$requestMethod = 'GET';

// Making an object to access our library class
$twitter = new TwitterAPIExchange($settings);
$store = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();
// Since the returned result is in json format, we need to decode it             
  $result = json_decode($store);

// After decoding, we have an standard object array, so we can print each tweet into a list item.
  $multi_array = objectToArray($result);
   
  
  if( !empty($multi_array)) {
 foreach($multi_array as $key => $value ){
   
// The Regular Expression filter

    $text = $value["text"];
        
    
   
    $tweet = bliccaThemes_twitapi_links($value["text"]); //converts text links to clickable links
    $tweet = preg_replace('#@([\\d\\w]+)#', '<a target= "_blank" href="http://twitter.com/$1"> $0 </a>', $tweet);//converts hashtags to clickable links
    $tweet = preg_replace('/#([\\d\\w]+)/', '<a target= "_blank" href="http://twitter.com/search?q=%23$1"> $0 </a>', $tweet);//converts @username to links
    
        // if no urls in the text just return the text
    echo '<div class="twitter-widget"><div class="tweet"><p>'. $tweet . '</p><p class="tweet_meta"><span class="twitter-reply-to"><a target="_blank" href="https://twitter.com/intent/tweet?in_reply_to='.$value["id"].'">Reply</a></span><i class="fa fa-circle"></i><span class="twitter-retweet"><a target="_blank" href="https://twitter.com/intent/retweet?tweet_id='.$value["id"].'">Retweet</a></span><i class="fa fa-circle"></i><span class="twitter-fav"><a target="_blank" href="https://twitter.com/intent/favorite?tweet_id='.$value["id"].'">Favorite</a></span></p></div></div>';

    
 }
}
    
}

}
}
class bliccaThemes_twitter_widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'bliccaThemes_twitter', 'description' => __( "Twitter Widget", 'bliccaThemes') );
        parent::__construct('twitter_widget', __('Twitter Widget', 'bliccaThemes'), $widget_ops);
        $this->alt_option_name = 'mukam_twittery';

        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_text_footer', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo esc_html($cache[ $args['widget_id'] ]);
            return;
        }

        ob_start();
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? 'Text Box' : $instance['title'], $instance, $this->id_base);
        ?>
        <?php echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>
        
            <?php echo bliccaThemes_twitter_plug(); ?>
        
        <?php echo $after_widget; ?>
<?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_text_footer', $cache, 'widget');
    }   

function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        
        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_text_footer', 'widget');
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        $title = strip_tags($instance['title']);
        
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bliccaThemes'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

<?php
    }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "bliccaThemes_twitter_widget" );' ) ); 
/******************************/
/*     POPULAR TAG WIDGET     */
/******************************/
class bliccaThemes_popular_tag extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'bliccaThemes_pop_tags', 'description' => __( "Add most used tags to Widget Area", 'bliccaThemes') );
        parent::__construct('bliccaThemes_tag_cloud', __('bliccaThemes Tag Cloud', 'bliccaThemes'), $widget_ops);  
    }

    function widget($args, $instance) {

        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        ?>
        <?php echo $before_widget; ?>
        <?php if ( $title !="" ) echo $before_title . $title . $after_title; ?>
            <div class="bliccaThemes-tag-cloud">
               <?php wp_tag_cloud('unit=px&smallest=13&largest=13&number=10&format=list'); ?>
            </div>
        <?php echo $after_widget; ?>
<?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();
    }   

        function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
        $title = strip_tags($instance['title']);
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bliccaThemes'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

<?php
    }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "bliccaThemes_popular_tag" );' ) );


/***********************/
/* Sidebar Widgets     */
/***********************/
include ('includes/instagram.php');
include ('includes/flickr.php');
include ('includes/dribbble.php');
include ('includes/adds.php');
/*****************************/
/* bliccaThemes RECENT POST    */
/*****************************/
class bliccaThemes_Recent_Posts extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_recent_entries', 'description' => __( "The most recent posts on your site", 'bliccaThemes') );
        parent::__construct('bliccaThemes-recent-posts', __('bliccaThemes Recent Posts', 'bliccaThemes'), $widget_ops);
        $this->alt_option_name = 'widget_recent_entries';

        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_recent_posts', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo esc_html($cache[ $args['widget_id'] ]);
            return;
        }

        ob_start();
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'bliccaThemes') : $instance['title'], $instance, $this->id_base);
        if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
            $number = 3;
        

        $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
        if ($r->have_posts()) :
?>

        <?php echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>
        <div class="bliccaThemes-recent-post-widget">
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
            <article class="bliccaThemes-recent-post">
                <a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php if (has_post_thumbnail()) { $thumb = get_post_thumbnail_id(); 
                                        $image = vt_resize( $thumb, '', 74, 70, true );?>
                                        <img src="<?php echo esc_url($image['url']); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>" alt="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>" /><?php } else if ( has_post_format( 'video' )) { echo '<div class="recentpostinside"><i class="fa fa-video-camera"></i></div>';} else if ( has_post_format( 'audio' )) { echo '<div class="recentpostinside"><i class="fa fa-music"></i></div>';} else if ( has_post_format( 'quote' )) { echo '<div class="recentpostinside"><i class="fa fa-quote-left"></i></div>';} else  { echo '<div class="recentpostinside"><i class="fa fa-picture-o"></i></div>';}?></a>
                <h6><a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></h6>
                <p class="popular-date"><?php echo get_the_date(); ?></p>
             <div class="clearfix"></div>   
            </article>
        <?php endwhile; ?>
        </div>
        <?php echo $after_widget; ?>
<?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();

        endif;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_recent_posts', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_recent_entries']) )
            delete_option('widget_recent_entries');

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_recent_posts', 'widget');
    }

    function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        
?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'bliccaThemes' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'bliccaThemes' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>

<?php
    }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "bliccaThemes_Recent_Posts" );' ) );


/**********************/
/*   Social Widget    */
/**********************/
class bliccaThemes_mini_socwid extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'bliccaThemes_mini_socwid', 'description' => __( "Mini Social Widget", 'bliccaThemes') );
        parent::__construct('bliccaThemes_mini_socwid', __('Social Widget', 'bliccaThemes'), $widget_ops);
        $this->alt_option_name = 'mini_soc';

        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('bliccaThemes_mini_socwid', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();
        extract($args);
        $theme_options = get_option('option_tree');
        $mailchimp = get_option_tree('mailchimp',$theme_options);

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'bliccaThemes') : $instance['title'], $instance, $this->id_base);
        ?>
        <div class="footer-widget">
              <div class="social-widget">
                <?php if ( get_option_tree('social_facebook', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_facebook', $theme_options));?>" target="_blank"><div class="social-facebook"><i class="fa fa-facebook"></i></div></a>

                <?php } if ( get_option_tree('social_twitter', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_twitter', $theme_options));?>" target="_blank"><div class="social-twitter"><i class="fa fa-twitter"></i></div></a>
                
                <?php } if ( get_option_tree('social_pinterest', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_pinterest', $theme_options));?>" target="_blank"><div class="social-pinterest"><i class="fa fa-pinterest"></i></div></a>
                
                <?php } if ( get_option_tree('social_instagram', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_instagram', $theme_options));?>" target="_blank"><div class="social-instagram"><i class="fa fa-instagram"></i></div></a>

                <?php } if ( get_option_tree('social_flickr', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_flickr', $theme_options));?>" target="_blank"><div class="social-flickr"><i class="fa fa-flickr"></i></div></a>
                
                                <?php } if ( get_option_tree('social_google', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_google', $theme_options));?>" target="_blank"><div class="social-google-plus"><i class="fa fa-google-plus"></i></div></a>
                
                
                                <?php } if ( get_option_tree('social_dribbble', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_dribbble', $theme_options));?>" target="_blank"><div class="social-dribbble"><i class="fa fa-dribbble"></i></div></a>
               

                                <?php } if ( get_option_tree('social_linkedin', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_linkedin', $theme_options));?>" target="_blank"><div class="social-linkedin"><i class="fa fa-linkedin"></i></div></a>
               

                                <?php } if ( get_option_tree('social_digg', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_digg', $theme_options));?>" target="_blank"><div class="social-digg"><i class="fa fa-digg"></i></div></a>
                
                                <?php } if ( get_option_tree('social_yelp', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_yelp', $theme_options));?>" target="_blank"><div class="social-yelp"><i class="fa fa-yelp"></i></div></a>
                
                                <?php } if ( get_option_tree('social_skype', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_skype', $theme_options));?>" target="_blank"><div class="social-skype"><i class="fa fa-skype"></i></div></a>
                
                
                                <?php } if ( get_option_tree('social_vimeo', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_vimeo', $theme_options));?>" target="_blank"><div class="social-vimeo"><i class="fa fa-vimeo-square"></i></div></a>
                
                
                                <?php } if ( get_option_tree('social_youtube', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_youtube', $theme_options));?>" target="_blank"><div class="social-youtube"><i class="fa fa-youtube"></i></div></a>
                
                
                                <?php } if ( get_option_tree('social_stumbleupon', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_stumbleupon', $theme_options));?>" target="_blank"><div class="social-stumbleupon"><i class="fa fa-stumbleupon"></i></div></a>
                
                
                <?php } if ( get_option_tree('social_yahoo', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_yahoo', $theme_options));?>" target="_blank"><div class="social-yahoo"><i class="fa fa-yahoo"></i></div></a>
                
                
                <?php } if ( get_option_tree('social_foursquare', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_foursquare', $theme_options));?>" target="_blank"><div class="social-foursquare"><i class="fa fa-foursquare"></i></div></a>
                
                <?php } if ( get_option_tree('social_vk', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_vk', $theme_options));?>" target="_blank"><div class="social-foursquare"><i class="fa fa-vk"></i></div></a>              
                
                <?php } if ( get_option_tree('social_rss', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_rss', $theme_options));?>" target="_blank"><div class="social-rss"><i class="fa fa-rss"></i></div></a>
                <?php } ?>
              </div>
        </div>
        <?php 
        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('bliccaThemes_mini_socwid', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);

        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['mini_soc']) )
            delete_option('mini_soc');

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('bliccaThemes_mini_socwid', 'widget');
    }

    function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

        
?>
        
<?php
    }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "bliccaThemes_mini_socwid" );' ) );
/*********************/
/*    Social Links   */
/*********************/
if ( ! function_exists( 'bliccaThemes_footer_social' ) ) {
function bliccaThemes_footer_social(){

if ( function_exists( 'get_option_tree') ) {
      $theme_options = get_option('option_tree');  
}  
                if ( get_option_tree('social_facebook', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_facebook', $theme_options));?>" target="_blank"><div class="social-facebook"><i class="fa fa-facebook"></i></div></a>

                <?php } if ( get_option_tree('social_twitter', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_twitter', $theme_options));?>" target="_blank"><div class="social-twitter"><i class="fa fa-twitter"></i></div></a>
 
                <?php } if ( get_option_tree('social_yelp', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_yelp', $theme_options));?>" target="_blank"><div class="social-yelp"><i class="fa fa-yelp"></i></div></a>

                <?php } if ( get_option_tree('social_pinterest', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_pinterest', $theme_options));?>" target="_blank"><div class="social-pinterest"><i class="fa fa-pinterest"></i></div></a>
                
                <?php } if ( get_option_tree('social_instagram', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_instagram', $theme_options));?>" target="_blank"><div class="social-instagram"><i class="fa fa-instagram"></i></div></a>

                <?php } if ( get_option_tree('social_flickr', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_flickr', $theme_options));?>" target="_blank"><div class="social-flickr"><i class="fa fa-flickr"></i></div></a>
                
        		<?php } if ( get_option_tree('social_google', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_google', $theme_options));?>" target="_blank"><div class="social-google-plus"><i class="fa fa-google-plus"></i></div></a>
                 
            	<?php } if ( get_option_tree('social_dribbble', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_dribbble', $theme_options));?>" target="_blank"><div class="social-dribbble"><i class="fa fa-dribbble"></i></div></a>
               
        		<?php } if ( get_option_tree('social_linkedin', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_linkedin', $theme_options));?>" target="_blank"><div class="social-linkedin"><i class="fa fa-linkedin"></i></div></a>
               
        		<?php } if ( get_option_tree('social_digg', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_digg', $theme_options));?>" target="_blank"><div class="social-digg"><i class="fa fa-digg"></i></div></a>             
             
        		<?php } if ( get_option_tree('social_skype', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_skype', $theme_options));?>" target="_blank"><div class="social-skype"><i class="fa fa-skype"></i></div></a>     
                
        		<?php } if ( get_option_tree('social_vimeo', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_vimeo', $theme_options));?>" target="_blank"><div class="social-vimeo"><i class="fa fa-vimeo-square"></i></div></a>
                
                <?php } if ( get_option_tree('social_youtube', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_youtube', $theme_options));?>" target="_blank"><div class="social-youtube"><i class="fa fa-youtube"></i></div></a>
                
                <?php } if ( get_option_tree('social_stumbleupon', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_stumbleupon', $theme_options));?>" target="_blank"><div class="social-stumbleupon"><i class="fa fa-stumbleupon"></i></div></a>
                
                <?php } if ( get_option_tree('social_yahoo', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_yahoo', $theme_options));?>" target="_blank"><div class="social-yahoo"><i class="fa fa-yahoo"></i></div></a> 
                
                <?php } if ( get_option_tree('social_foursquare', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_foursquare', $theme_options));?>" target="_blank"><div class="social-foursquare"><i class="fa fa-foursquare"></i></div></a>
         
                <?php } if ( get_option_tree('social_vk', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_vk', $theme_options));?>" target="_blank"><div class="social-foursquare"><i class="fa fa-vk"></i></div></a>              
                
                <?php } if ( get_option_tree('social_ta', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_ta', $theme_options));?>" target="_blank"><div class="social-rss"><i class="fa fa-tripadvisor"></i></div></a>              
                      
                <?php } if ( get_option_tree('social_rss', $theme_options) != '') { ?>
                <a href="<?php echo esc_url(get_option_tree('social_rss', $theme_options));?>" target="_blank"><div class="social-rss"><i class="fa fa-rss"></i></div></a>
                <?php }  
}
}
/*********************************/
/* CUSTOM PAGE BUILDER ELEMENT * /
/********************************/
if ( in_array( 'js_composer/js_composer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
include ('includes/shortcodes.php');
}

add_action( 'after_setup_theme', 'bliccaThemes_vc_editor' );
function bliccaThemes_vc_editor() {
    update_option('wpb_js_content_types', array( 'page' ) );
}


add_action( 'init', 'bliccaThemes_vcSetAsTheme' );
function bliccaThemes_vcSetAsTheme() {
    if (function_exists('vc_set_as_theme')) vc_set_as_theme(true);
}
/*********************/
/*   WOO COMMERCE    */
/*********************/
add_theme_support( 'woocommerce' );
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    include ('includes/pronto-shop.php');
}
/**********************/
/* Theme Options Link */
/**********************/
function bliccaThemes_add_themeoptions_nav() {
    global $wp_admin_bar;
    
      //Add a link called 'My Link'...
    $wp_admin_bar->add_node(array(
      'id'    => 'theme-options',
      'title' => 'Theme Options',
      'href'  => admin_url('themes.php?page=ot-theme-options')
    ));
}
// and we hook our function via
add_action( 'wp_before_admin_bar_render', 'bliccaThemes_add_themeoptions_nav' );