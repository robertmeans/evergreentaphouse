<?php
/**
 * brewhouse functions and definitions
 *
 * @package brewhouse
 */
 
/**
 * Theme Updater
 */  
require_once('inc/wp-updates-theme.php'); 
new WPUpdatesThemeUpdater_971( 'http://wp-updates.com/api/2/theme', basename( get_template_directory() ) ); 

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'brewhouse_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function brewhouse_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on brewhouse, use a find and replace
	 * to change 'brewhouse' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'brewhouse', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'gallery-image', 500 ); 
	add_image_size( 'beer-image', 300 ); 

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'brewhouse' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'brewhouse_custom_background_args', array( 
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // brewhouse_setup
add_action( 'after_setup_theme', 'brewhouse_setup' ); 


/**
 * Load Google Fonts.
 */
function load_fonts() {
            wp_register_style('googleFonts', '//fonts.googleapis.com/css?family=Francois+One|Source+Sans+Pro:400,300,600italic,600,900');
            wp_enqueue_style( 'googleFonts');
        }
    
    add_action('wp_print_styles', 'load_fonts');
	
/**
* Register and load font awesome CSS files using a CDN.
*
* @link http://www.bootstrapcdn.com/#fontawesome
* @author FAT Media 
*/
	
add_action( 'wp_enqueue_scripts', 'brewhouse_enqueue_awesome' );

function brewhouse_enqueue_awesome() {
wp_enqueue_style( 'brewhouse-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', array(), '4.4.0' );  
}  

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function brewhouse_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'brewhouse' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Home First Widget', 'brewhouse' ),
		'id'            => 'home-first-widget', 
		'description'   => 'Enter anything you want here.  Make sure you edit the Title in the Wordpress Customizer section of the Admin Panel',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
		'after_widget'  => '</aside>',  
		'before_title'  => '<h2>',
		'after_title'   => '</h2>', 
	) );
	
	register_sidebar( array(
		'name'          => __( 'Home Second Widget', 'brewhouse' ), 
		'id'            => 'home-second-widget', 
		'description'   => 'Enter anything you want here.  Make sure you edit the Title in the Wordpress Customizer section of the Admin Panel',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
		'after_widget'  => '</aside>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>', 
	) );
	
	register_sidebar( array(
		'name'          => __( 'Home Middle Section', 'brewhouse' ),
		'id'            => 'home-middle-section', 
		'description'   => 'Enter anything you want here.  Make sure you edit the Title in the Wordpress Customizer section of the Admin Panel',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
		'after_widget'  => '</aside>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>', 
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer First Widget', 'brewhouse' ),
		'id'            => 'footer-first-widget', 
		'description'   => 'Enter anything you want here.  Make sure you edit the Title in the Wordpress Customizer section of the Admin Panel',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
		'after_widget'  => '</aside>', 
		'before_title'  => '<h2>',
		'after_title'   => '</h2>', 
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Second Widget', 'brewhouse' ),
		'id'            => 'footer-second-widget',  
		'description'   => 'Enter anything you want here.  Make sure you edit the Title in the Wordpress Customizer section of the Admin Panel',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
		'after_widget'  => '</aside>', 
		'before_title'  => '<h2>',
		'after_title'   => '</h2>', 
	) );
	
	register_sidebar( array(
		'name'          => __( 'Pages Widget', 'brewhouse' ),
		'id'            => 'pages-widget',  
		'description'   => 'Widgets for your pages', 
		'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
		'after_widget'  => '</aside>', 
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	
	//Register the sidebar widgets   
	register_widget( 'brewhouse_Video_Widget' );
	register_widget( 'brewhouse_Contact_Info' );
	
}
add_action( 'widgets_init', 'brewhouse_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function brewhouse_scripts() {
	wp_enqueue_style( 'brewhouse-style', get_stylesheet_uri() );
	
	$headings_font = esc_html(get_theme_mod('headings_fonts'));
	$body_font = esc_html(get_theme_mod('body_fonts')); 
	
	if( $headings_font ) {
		wp_enqueue_style( 'brewhouse-headings-fonts', '//fonts.googleapis.com/css?family='. $headings_font );	
	} else {
		wp_enqueue_style( 'brewhouse-francois', '//fonts.googleapis.com/css?family=Francois+One');  
	}	
	if( $body_font ) {
		wp_enqueue_style( 'brewhouse-body-fonts', '//fonts.googleapis.com/css?family='. $body_font );	
	} else {
		wp_enqueue_style( 'brewhouse-source-sans', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600italic,600,900');
	} 
	
	wp_enqueue_style( 'brewhouse-superslide', get_template_directory_uri() . '/css/superslides.css' );
	
	if ( file_exists( get_stylesheet_directory_uri() . '/inc/my_style.css' ) ) {
	wp_enqueue_style( 'brewhouse-mystyle', get_stylesheet_directory_uri() . '/inc/my_style.css', array(), false, false );
	} 
	
	if ( is_admin() ) {
    wp_enqueue_style( 'brewhouse-codemirror', get_stylesheet_directory_uri() . '/css/codemirror.css', array(), '1.0' ); 
	} 
	
	wp_enqueue_style( 'brewhouse-pushmenu', get_template_directory_uri() . '/css/pushmenu.css' );
	
	wp_enqueue_script( 'brewhouse-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'brewhouse-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'brewhouse-imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), false, false );
	wp_enqueue_script( 'brewhouse-parallax', get_template_directory_uri() . '/js/jquery.parallax.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'brewhouse-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), false, true );
	wp_enqueue_script( 'brewhouse-animate', get_template_directory_uri() . '/js/jquery.animate-enhanced.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'brewhouse-superslides', get_template_directory_uri() . '/js/jquery.superslides.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'brewhouse-pushmenu', get_template_directory_uri() . '/js/jPushMenu.js', array('jquery'), false, true );
	wp_enqueue_script( 'brewhouse-skrollr', get_template_directory_uri() . '/js/skrollr.min.js', array(), false, true );
	wp_enqueue_script( 'brewhouse-codemirrorJS', get_template_directory_uri() . '/js/codemirror.js', array(), false, true);
	wp_enqueue_script( 'brewhouse-cssJS', get_template_directory_uri() . '/js/css.js', array(), false, true);
	wp_enqueue_script( 'brewhouse-placeholder', get_template_directory_uri() . '/js/jquery.placeholder.js', array('jquery'), false, true);
 	wp_enqueue_script( 'brewhouse-placeholdertext', get_template_directory_uri() . '/js/placeholdertext.js', array('jquery'), false, true);
	
	if ( is_page_template( 'page-gallery.php' ) ) { 
	wp_enqueue_script( 'brewhouse-masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array(), false, true );
	wp_enqueue_script( 'brewhouse-bh-gallery', get_template_directory_uri() . '/js/bh-gallery.js', array(), false, true );
	}
	
	if ( is_page_template( 'page-contact.php' ) ) { 
	wp_enqueue_script( 'brewhouse-validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'), false, true);
	wp_enqueue_script( 'brewhouse-verify', get_template_directory_uri() . '/js/verify.js', array('jquery'), false, true);  
	}
	
	wp_enqueue_script( 'brewhouse-scripts', get_template_directory_uri() . '/js/brewhouse.scripts.js', array(), false, true );
  
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { 
		wp_enqueue_script( 'comment-reply' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'brewhouse_scripts' ); 

/**
 * Load html5shiv
 */
function brewhouse_html5shiv() {
    echo '<!--[if lt IE 9]>' . "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/js/html5shiv.js' ) . '"></script>' . "\n";
    echo '<![endif]-->' . "\n";
}
add_action( 'wp_head', 'brewhouse_html5shiv' );

/**
 * Change the excerpt length
 */
function brewhouse_excerpt_length( $length ) {
	
	$excerpt = get_theme_mod('exc_length', '30'); 
	return $excerpt; 

}

add_filter( 'excerpt_length', 'brewhouse_excerpt_length', 999 );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Include additional custom admin panel features. 
 */
require get_template_directory() . '/panel/functions-admin.php';
require get_template_directory() . '/panel/theme-admin_page.php'; 

/**
 * Google Fonts  
 */
require get_template_directory() . '/inc/gfonts.php';

/**
 * Include additional custom features.
 */
require get_template_directory() . '/inc/my-custom-css.php';
require get_template_directory() . '/inc/socialicons.php'; 

/**
 * register your custom widgets
 */ 
require get_template_directory() . "/widgets/contact-info.php";
require get_template_directory() . "/widgets/video-widget.php";
require get_template_directory() . '/widgets/hours-widget.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Drink Menu Post Type.
 */
function drink_post_type() {

	$labels = array(
		'name'                => _x( 'Drink Menu', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Drink', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Drink Menu', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'All Drinks', 'text_domain' ),
		'view_item'           => __( 'View Drinks', 'text_domain' ),
		'add_new_item'        => __( 'Add New Drink', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Drink', 'text_domain' ),
		'update_item'         => __( 'Update Drink', 'text_domain' ),
		'search_items'        => __( 'Search Drinks', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'drink', 'text_domain' ),
		'description'         => __( 'Add an drink to your list.', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', ),
		'taxonomies'          => array( 'thumbnail' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'drink', $args );

}

// Hook into the 'init' action
add_action( 'init', 'drink_post_type', 0 );	

function drink_metaboxes( $meta_boxes ) {
    $prefix = '_drink_'; // Prefix for all fields
    $meta_boxes['drink_metabox'] = array(
        'id' => 'drink_metabox',
        'title' => 'Drink Text',
        'pages' => array('drink'), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => 'IBU and/or Alc. %',
                'desc' => 'Enter the IBU and/or Alc. % - this value shows up under the title.',
                'id' => $prefix . 'ibu_alc',
                'type' => 'text'
            ),
			array(
   				'name' => 'Short Description',
    			'desc' => 'Enter a short description of the drink. We recommend 20 words or less.',
    			'id' => $prefix . 'description',
    			'type' => 'textarea_small'
			),
        ),
    );

    return $meta_boxes;
}
 
add_filter( 'cmb_meta_boxes', 'drink_metaboxes' );   

/**
 * Gallery Post Type.
 */
function gallery_post_type() {

	$labels = array(
		'name'                => _x( 'Gallery Images', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Gallery Image', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Gallery Images', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'All Gallery Images', 'text_domain' ),
		'view_item'           => __( 'View Gallery Images', 'text_domain' ),
		'add_new_item'        => __( 'Add New Gallery Image', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Gallery Image', 'text_domain' ),
		'update_item'         => __( 'Update Gallery Image', 'text_domain' ),
		'search_items'        => __( 'Search Gallery Images', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'gallery', 'text_domain' ),
		'description'         => __( 'Add an image to the gallery page.', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', ),
		'taxonomies'          => array( 'thumbnail' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'gallery', $args );

}

// Hook into the 'init' action
add_action( 'init', 'gallery_post_type', 0 );


add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );
function be_initialize_cmb_meta_boxes() {
    if ( !class_exists( 'cmb_Meta_Box' ) ) {
        require_once( 'meta/init.php' );
    }
}