<?php
/*
Plugin Name: Pronto Theme Plugins
Plugin URI: http://www.themeforest.net/user/bliccaThemes
Description: This Plugin will install themes shortcodes and CPT
Author: Blicca Themes
Version: 1.6.2
Author URI: http://www.themeforest.net/user/bliccaThemes
*/
/*******************************/
/* Add Event Menu to Wordpress  */
/*******************************/
function bliccaThemes_add_events_metaboxes() {
  add_meta_box('bliccaThemes_events_project', 'Events', 'bliccaThemes_events_project', 'events', 'normal', 'default');
}
// The Skill Metabox

function bliccaThemes_events_project() {
  global $post;
  
  // Noncename needed to verify where the data originated
  echo '<input type="hidden" name="eventsmeta_noncename" id="eventsmeta_noncename" value="' . 
  wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
  
  // Get the skill data if its already been entered
  $date = get_post_meta($post->ID, '_date', true);

  // Echo out the field
  
  echo '<p>Date:</p>';
  echo '<input type="text" name="_date" value="' . esc_attr($date)  . '" class="widefat" />';
  echo '<p>Write your date format like this: October 13, 2017 10:13:00</p>';

}

// Save the Metabox Data

function bliccaThemes_save_events_meta($post_id, $post) {
  
  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
  if ( isset($_POST['eventsmeta_noncename']) && !wp_verify_nonce( $_POST['eventsmeta_noncename'], plugin_basename(__FILE__) )) {
  return $post->ID;
  }

  // Is the user allowed to edit the post or page?
  if ( !current_user_can( 'edit_post', $post->ID ))
    return $post->ID;

  // OK, we're authenticated: we need to find and save the data
  // We'll put it into an array to make it easier to loop though.
  $events_meta = array();
  
  if ( isset($_POST['_date'])) {
  $events_meta['_date'] = sanitize_text_field($_POST['_date']);}
  
  // Add values of $events_meta as custom fields
  
  foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
    if( $post->post_type == 'revision' ) return; // Don't store custom data twice
    $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
    if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
      update_post_meta($post->ID, $key, $value);
    } else { // If the custom field doesn't have a value
      add_post_meta($post->ID, $key, $value);
    }
    if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
  }

}

add_action('save_post', 'bliccaThemes_save_events_meta', 1, 2); // save the custom fields

    add_action('init', 'bliccaThemes_create_events');
    function bliccaThemes_create_events() {
        $args = array(
            'label' => 'Events Slider',
            'singular_label' => 'Event',
            'menu_icon' => 'dashicons-calendar-alt',
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => array('slug' => 'events', 'url' => 'event'),
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'register_meta_box_cb' => 'bliccaThemes_add_events_metaboxes'  
        );
        register_post_type('events',$args);
    }

//
// Restaurant Taxonomy
//
// Add the Skill Meta Boxes

function bliccaThemes_add_foodmenu_metaboxes() {
  add_meta_box('bliccaThemes_foodmenu_project', 'Foodmenu', 'bliccaThemes_foodmenu_project', 'foodmenu', 'normal', 'default');
}
// The Skill Metabox

function bliccaThemes_foodmenu_project() {
  global $post;
  
  // Noncename needed to verify where the data originated
  echo '<input type="hidden" name="foodmenumeta_noncename" id="foodmenumeta_noncename" value="' . 
  wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
  
  // Get the skill data if its already been entered
  $price = get_post_meta($post->ID, '_price', true);
  $ingredients = get_post_meta($post->ID, '_ingredients', true);
  $menuorder = get_post_meta($post->ID, '_menuorder', true);
  if ($menuorder == "") {
    $menuorder = 1;
  }
  // Echo out the field
  
  echo '<p>Price:</p>';
  echo '<input type="text" name="_price" value="' . esc_attr($price)  . '" class="widefat" />';
  echo '<p>Description:</p>';
  echo '<input type="text" name="_ingredients" value="' . esc_attr($ingredients)  . '" class="widefat" />';
  echo '<p>Order (this will effect your item order in category restaurant menu, please write a number):</p>';
  echo '<input type="number" name="_menuorder" min="1" max="1500" value="'.esc_attr( $menuorder ).'">';
}

// Save the Metabox Data

function bliccaThemes_save_foodmenu_meta($post_id, $post) {
  
  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
  if ( isset($_POST['foodmenumeta_noncename']) && !wp_verify_nonce( $_POST['foodmenumeta_noncename'], plugin_basename(__FILE__) )) {
  return $post->ID;
  }

  // Is the user allowed to edit the post or page?
  if ( !current_user_can( 'edit_post', $post->ID ))
    return $post->ID;

  // OK, we're authenticated: we need to find and save the data
  // We'll put it into an array to make it easier to loop though.
  $foodmenu_meta = array();
  
  if ( isset($_POST['_price'])) {
  $foodmenu_meta['_price'] = sanitize_text_field($_POST['_price']);}
  if ( isset($_POST['_ingredients'])) {
  $foodmenu_meta['_ingredients'] = sanitize_text_field($_POST['_ingredients']);}
  $save_menuorder = 1;
  if ( isset($_POST['_menuorder'])) {
    $save_menuorder = intval( $_POST['_menuorder'] );
    if ( ! $save_menuorder ) { 
    $save_menuorder = 1;
    }
  }
  $foodmenu_meta['_menuorder'] = $save_menuorder;

  // Add values of $foodmenu_meta as custom fields
  
  foreach ($foodmenu_meta as $key => $value) { // Cycle through the $events_meta array!
    if( $post->post_type == 'revision' ) return; // Don't store custom data twice
    $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
    if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
      update_post_meta($post->ID, $key, $value);
    } else { // If the custom field doesn't have a value
      add_post_meta($post->ID, $key, $value);
    }
    if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
  }

}

add_action('save_post', 'bliccaThemes_save_foodmenu_meta', 1, 2); // save the custom fields
/*
Plugin Name: Demo Tax meta class
Plugin URI: http://en.bainternet.info
Description: Tax meta class usage demo
Version: 2.0.2
Author: Bainternet, Ohad Raz
Author URI: http://en.bainternet.info
*/

//include the main class file
require_once("tax-meta-class/tax-meta-class.php");
if (is_admin()){
  /* 
   * prefix of meta keys, optional
   */
  $prefix = 'bt_';
  /* 
   * configure your meta box
   */
  $config = array(
    'id' => 'backgroundimage',          // meta box id, unique per meta box
    'title' => 'Category Background',          // meta box title
    'pages' => array('foodtype'),        // taxonomy name, accept categories, post_tag and custom taxonomies
    'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'fields' => array(),            // list of meta fields (can be added by field arrays)
    'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your meta box
   */
  $my_meta =  new Tax_Meta_Class($config);
  
  /*
   * Add fields to your meta box
   */
  
 
  //Image field
  $my_meta->addImage($prefix.'image_field_id',array('name'=> __('Category Background','bliccaThemes')));

  $my_meta->addImage($prefix.'image_field_id_iki',array('name'=> __('Subtitle Image','bliccaThemes')));
  $my_meta->Finish();
}
/// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_food_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_food_taxonomies() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => __( 'FoodTypes', 'bliccaThemes' ),
    'singular_name'     => __( 'FoodType', 'bliccaThemes' ),
    'search_items'      => __( 'Search FoodTypes', 'bliccaThemes' ),
    'all_items'         => __( 'All FoodTypes', 'bliccaThemes' ),
    'parent_item'       => __( 'Parent FoodType', 'bliccaThemes' ),
    'parent_item_colon' => __( 'Parent FoodType:', 'bliccaThemes' ),
    'edit_item'         => __( 'Edit FoodType', 'bliccaThemes' ),
    'update_item'       => __( 'Update FoodType', 'bliccaThemes' ),
    'add_new_item'      => __( 'Add New FoodType', 'bliccaThemes' ),
    'new_item_name'     => __( 'New FoodType Name', 'bliccaThemes' ),
    'menu_name'         => __( 'FoodType', 'bliccaThemes' ),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'foodtype' ),
  );

  register_taxonomy( 'foodtype', array( 'foodmenu' ), $args );
}
/*******************************/
/* Add Food Menu to Wordpress  */
/*******************************/
    add_action('init', 'bliccaThemes_create_foodmenu');
    function bliccaThemes_create_foodmenu() {
        $args = array(
            'label' => 'Food Menu',
            'singular_label' => 'Foodmenu',
            'menu_icon' => 'dashicons-products',
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => array('slug' => 'foodmenus', 'url' => 'foodmenu'),
            'supports' => array('title', 'thumbnail'),
            'register_meta_box_cb' => 'bliccaThemes_add_foodmenu_metaboxes'  
        );
        register_post_type('foodmenu',$args);
    }
/*********************************/
/* Add Testimonial to Wordpress  */
/*********************************/
    add_action('init', 'bliccaThemes_create_testimonial');
    function bliccaThemes_create_testimonial() {
        $args = array(
            'label' => 'Testimonial',
            'singular_label' => 'testimonial',
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'publicly_queryable'  => false,
                        'exclude_from_search' => true,          
            'rewrite' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'register_meta_box_cb' => 'bliccaThemes_add_testimonial_metaboxes' 
        );
        register_post_type('testimonial',$args);
    }


    function bliccaThemes_add_testimonial_metaboxes() {
    add_meta_box('bliccaThemes_testimonial_project', 'Project', 'bliccaThemes_testimonial_project', 'testimonial', 'side', 'default');
    }

    function bliccaThemes_testimonial_project() {
    global $post;
    
    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="testimonialmeta_noncename" id="testimonialmeta_noncename" value="' . 
    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    
    // Get the link data if its already been entered
    $clientname = get_post_meta($post->ID, '_clientname', true);
    $job = get_post_meta($post->ID, '_job', true);
    // Echo out the field
    echo '<p>Name:</p>';
    echo '<input type="text" name="_clientname" value="' . esc_attr($clientname)  . '" class="widefat" />';
    echo '<p>Job:</p>';
    echo '<input type="text" name="_job" value="' . esc_attr($job)  . '" class="widefat" />';
    }

    // Save the Metabox Data

    function bliccaThemes_save_testimonial_data($post_id, $post) {
    
    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( isset($_POST['testimonialmeta_noncename']) && !wp_verify_nonce( $_POST['testimonialmeta_noncename'], plugin_basename(__FILE__) )) {
    return $post->ID;
    }

    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;

    // OK, we're authenticated: we need to find and save the data
    // We'll put it into an array to make it easier to loop though.
    $testimonial_meta = array();
    if ( isset($_POST['_clientname'])) {
    $testimonial_meta['_clientname'] = sanitize_text_field($_POST['_clientname']); }
    if ( isset($_POST['_job'])) {
    $testimonial_meta['_job'] = sanitize_text_field($_POST['_job']); }
    // Add values of $testimonial_meta as custom fields
    
    foreach ($testimonial_meta as $key => $value) { // Cycle through the $events_meta array!
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    }
    }

add_action('save_post', 'bliccaThemes_save_testimonial_data', 1, 2); // save the custom fields

if ( in_array( 'js_composer/js_composer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
 
/************************/
/* List Restaurant Menu */
/************************/
function bliccaThemes_restaurant_menu_classics($atts){
   extract(shortcode_atts ( array(
      'r' => '',
      'taxonomies' => '',
      'order' => 'DESC',
      'add_desc' => ''    
    ), 
   $atts));
        $ordery = $order;
        ob_start();
        global $wp_query;
        $terms = get_terms("foodtype", array('hide_empty' => false, 'include' => $taxonomies, 'orderby' => 'slug'));
        $count = count($terms);

    ?>
    <div class="bt-menu-classic-category">
    <?php 
    if ( $count > 0 ){
      foreach ( $terms as $term) {
        $term_id = $term->term_id;
        $term_desc = $term->description;
        $subtitle_icon = get_tax_meta($term_id,'bt_image_field_id_iki',true);        
        ?>
        <div class="bt-menu-classic-items">
          <div class="bt-menu-classic-itemContents"><div class="container"><div class="row"><div class="col-md-12">
          <div class="bt-menu-classic-catname">
            <?php if (!empty($subtitle_icon['url'])) { ?><img src="<?php echo esc_url($subtitle_icon['url']); ?>" alt="<?php echo esc_attr($term->name); ?>"><?php } ?>
            <h4><?php echo esc_attr($term->name); ?></h4>
            <?php
            if (!empty($term_desc) && $add_desc == "yes") {
              ?><p><?php echo esc_html($term_desc); ?></p>
              <?php
            }
            ?>
            <div class="clearfix"></div>
          </div>
          <div class="bt-menu-classic-item-container">  
          <?php 
          $r = new WP_Query( array( 'posts_per_page' => -1, 'post_type' => 'foodmenu', 'foodtype' => $term->slug, 'meta_key' => '_menuorder', 'orderby'=> 'meta_value_num', 'order' => $ordery) );
          if ($r->have_posts()) :
          while ( $r->have_posts() ) : $r->the_post();  
          ?>  
            <div class="bt-menu-classic-item">
            <?php
            $image_id = get_post_thumbnail_id();    
            $image_url = wp_get_attachment_image_src($image_id,'full');
            $price = get_post_meta(get_the_ID(), "_price", true);
            $ingredients = get_post_meta(get_the_ID(), "_ingredients", true);    
            ?> 
              <div class="bt-menu-classic-itemContent">
                <div class="bt-menu-classic-title"><?php the_title(); ?></div>
                <div class="bt-menu-classic-dot"></div>
                <div class="bt-menu-classic-price"><?php if ( !empty($price) ) { ?><?php echo esc_html($price); ?><?php } ?></div>             
              </div>
              <div class="bt-menu-classic-desc"><?php if ( !empty($ingredients) ) { ?><p class="bt-menu-itemDesc"><?php echo esc_html($ingredients); ?></p><?php } ?></div>
            </div>
            <?php endwhile; 
            endif;
            wp_reset_query(); 
            ?>
          </div>  
          </div></div></div></div>
        </div> 
        <?php 
      }
    }

    ?>
    </div>
    <?php
    $content = ob_get_contents();
    ob_end_clean();  
    return $content;
}
add_shortcode('bliccaThemes_restaurant_menu_classic', 'bliccaThemes_restaurant_menu_classics');

add_action( 'init', 'bliccaThemes_restaurant_menu_classic_integrateWithVC' );
function bliccaThemes_restaurant_menu_classic_integrateWithVC() {
$vc_taxonomies_types = get_taxonomies( array( 'public' => true ), 'objects' );
$vc_taxonomies = get_terms( array_keys( $vc_taxonomies_types ), array( 'hide_empty' => false ) );
$taxonomies_list = array();
if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
  foreach ( $vc_taxonomies as $t ) {
    if ( is_object( $t ) ) {
      $taxonomies_list[] = array(
        'label' => $t->name,
        'value' => $t->term_id,
        'group_id' => $t->taxonomy,
        'group' =>
          isset( $vc_taxonomies_types[ $t->taxonomy ], $vc_taxonomies_types[ $t->taxonomy ]->labels, $vc_taxonomies_types[ $t->taxonomy ]->labels->name )
            ? $vc_taxonomies_types[ $t->taxonomy ]->labels->name
            : __( 'Taxonomies', 'js_composer' )
      );
    }
  }
}
$taxonomies_for_filter = array();
if ( is_array( $vc_taxonomies_types ) && ! empty( $vc_taxonomies_types ) ) {
  foreach ( $vc_taxonomies_types as $t => $data ) {
    if ( $t !== 'post_format' && is_object( $data ) ) {
      $taxonomies_for_filter[ $data->labels->name ] = $t;
    }
  }
}   
wpb_map( array(
   "name" => __("Classic Restaurant Menu", 'bliccaThemes'),
   "base" => "bliccaThemes_restaurant_menu_classic",
   "class" => "",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/visualcomposer.css'),   
   "icon" => "bliccaThemes-vc-icon",    
   "params" => array(
    array(
        "type" => 'checkbox',
        "heading" => __("Add category description", "bliccaThemes"),
        "param_name" => "add_desc",
        "description" => __("If you click this, there will be a description after category name. You can set your description in wordpress dashboard > food menu > foodtype", "bliccaThemes"),
        "value" => Array(__("Yes, please", "bliccaThemes") => 'yes')
    ), 
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Menu Order", 'bliccaThemes'),
        "param_name" => "order",
        "value" => array(__('Descending ', "bliccaThemes") => "DESC ", __('Ascending ', "bliccaThemes") => "ASC" ),
        "description" => __("Choose your order.", 'bliccaThemes')
    ),
    array(
    'type' => 'autocomplete',
    'heading' => __( 'Narrow data source', 'js_composer' ),
    'param_name' => 'taxonomies',
    'settings' => array(
      'multiple' => true,
      // is multiple values allowed? default false
      // 'sortable' => true, // is values are sortable? default false
      'min_length' => 1,
      // min length to start search -> default 2
      // 'no_hide' => true, // In UI after select doesn't hide an select list, default false
      'groups' => true,
      // In UI show results grouped by groups, default false
      'unique_values' => true,
      // In UI show results except selected. NB! You should manually check values in backend, default false
      'display_inline' => true,
      // In UI show results inline view, default false (each value in own line)
      'delay' => 500,
      // delay for search. default 500
      'auto_focus' => true,
      // auto focus input, default true
      'values' => $taxonomies_list,
    ),
    'param_holder_class' => 'vc_not-for-custom',
    'description' => __( 'Enter menu categories', 'js_composer' ),
    'dependency' => array(
      'element' => 'post_type',
      'value_not_equal_to' => array( 'ids', 'custom' ),
    ),
  )     
   )
) );
}
/*********************************/
/*     BliccaThemes Buttons      */
/*********************************/

function bliccaThemes_buttons($atts, $content = null) {
   extract(shortcode_atts ( array(
    'color' => 'b_asset', 
    'url' => '#',
    'transition' => 'buton-1',
    'b_size' => 'buton-mini'
    ), 
   $atts));
   return '<span class="buton '.$color.' '.$transition.' '.$b_size.'"><a href="'.$url.'">'.do_shortcode($content).'</a></span>';
}
add_shortcode('mbuttons', 'bliccaThemes_buttons');

add_action( 'init', 'bliccaThemes_buttons_integrateWithVC' );
function bliccaThemes_buttons_integrateWithVC() {
wpb_map( array(
   "name" => __("bliccaThemes Buttons", 'bliccaThemes'),
   "base" => "mbuttons",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend_admin.css'),
   "params" => array(    

    array( 
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Button Color", 'bliccaThemes'),
        "param_name" => "color",
        "value" => array( __('Asset', "js_composer") => "b_asset", __('White', "js_composer") => "b_white", __('Green', "js_composer") => "b_green-1", __('Orange', "js_composer") => "b_orange-1-dark", __('Light Orange', "js_composer") => "b_orange-1", __('Purple', "js_composer") => 'b_purple', __('Grey', "js_composer") => "b_grey", __('Dark Grey', "js_composer") => "b_darkgrey-1"),
        "description" => __("Choose your button color.", 'bliccaThemes')
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Buton Size", 'bliccaThemes' ),
        "param_name" => "b_size",
        "value" => array( __('XS', "js_composer") => "buton-mini", __('Small', "js_composer") => "buton-small", __('Medium', "js_composer") => "buton-medium", __('Large', "js_composer") => "buton-large"),
    ),  
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Button Transition", 'bliccaThemes'),
        "param_name" => "transition",
        "value" => array(__('Left to Right', "js_composer") => "buton-1", __('Top to Bottom', "js_composer") => "buton-2", __('Fade Effect', "js_composer") => "buton-3", __('Middle to Side', "js_composer") => "buton-4", __('Middle to Corners', "js_composer") => "buton-5", __('Middle to Top', "js_composer") => "buton-6", ),
        "description" => __("Choose your button effect.", 'bliccaThemes')
    ),
     array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Content", 'bliccaThemes'),
        "param_name" => "content",
        "value" => __("Awesome Button", 'bliccaThemes'),
        "description" => __("Text on buttons", 'bliccaThemes')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Button link", 'bliccaThemes'),
        "param_name" => "url",
        "value" => "http://themeforest.net",
        "description" => __("Link of your button.", 'bliccaThemes')
    )
    )
    ) );
}
/********************************/
/*    Testimonial Slider        */
/********************************/
function bliccaThemes_max_testimonial($atts, $content = null) {
   extract(shortcode_atts ( array(
      'style' => 'bVersion',
      'animation' => 'no_animation',
      'r' => ''
    ), 
   $atts));

        global $wp_query;
        $r = new WP_Query( array( 'posts_per_page' => -1, 'post_type' => 'testimonial') );
        if ($r->have_posts()) :
            ?>
        <?php ob_start(); ?>

        <div class="<?php echo esc_attr($animation) ?> happyclients <?php echo esc_attr($style); ?> animated">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="happyclientslider">
                  <ul class="slides">
                    <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                    <li>
                      <div class="clients-say">
                        <?php if (has_post_thumbnail() && $style == "sVersion" ) {echo the_post_thumbnail('full');} ?><p><?php echo get_the_content(); ?><?php if ( $style == "sVersion" ) { ?> <br><span class="clientname"><?php echo get_post_meta( get_the_ID(), "_clientname", true); ?>,</span><span class="job"><?php echo get_post_meta( get_the_ID(), "_job", true); ?></span><?php } ?></p>
                        
                        <?php if ( $style != "sVersion" ) { ?>
                        <div class="clientphoto"> 
                        <?php if (has_post_thumbnail()) {echo the_post_thumbnail('full');} ?>
                        </div>
                        
                        <div class="byclient">
                        <p class="byclient">
                          <?php echo get_post_meta( get_the_ID(), "_clientname", true); ?>,<br><span><?php echo get_post_meta( get_the_ID(), "_job", true); ?></span>
                        </p>
                        </div> 
                        <?php } ?>
                        <div class="clearfix"></div>
                      </div>
                    </li>
                  <?php endwhile; ?>
                </ul>              
              </div>
            </div>
          </div>
      </div>
  </div>
    <?php endif;
       wp_reset_query(); 
       $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('bliccaThemes_max_testi', 'bliccaThemes_max_testimonial');
add_action( 'init', 'bliccaThemes_max_testi_integrateWithVC' );
function bliccaThemes_max_testi_integrateWithVC() {
wpb_map( array(
   "name" => __("Testimonial Slider", 'bliccaThemes'),
   "base" => "bliccaThemes_max_testi",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(
     
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Slider Type", 'bliccaThemes'),
        "param_name" => "style",
        "value" => array(__('Big Slider', "bliccaThemes") => "bVersion", __('Mini Slider', "bliccaThemes") => "sVersion"),
        "description" => __("Choose your animation.", 'bliccaThemes')                   
    ),

    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'bliccaThemes'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "bliccaThemes") => "no_animation", __('Tada', "bliccaThemes") => "tadab-1 blind", __('Flip In X', "bliccaThemes") => "flipInX-1 blind", __('Flip In Y', "bliccaThemes") => "flipInY-1 blind", __('Fade In', "bliccaThemes") => "fadeIn-1 blind", __('Fade In Up', "bliccaThemes") => "fadeInUp-1 blind", __('Fade In Down', "bliccaThemes") => "fadeInDown-1 blind", __('Fade In Left', "bliccaThemes") => "fadeInLeft-1 blind", __('Fade In Right', "bliccaThemes") => "fadeInRight-1 blind", __('Fade In Up Big', "bliccaThemes") => "fadeInUpBig-1 blind", __('Fade In Down Big', "bliccaThemes") => "fadeInDownBig-1 blind", __('Fade In Left Big', "bliccaThemes") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "bliccaThemes") => "fadeInRightBig-1 blind", __('Bounce In', "bliccaThemes") => "bounceIn-1 blind", __('Bounce In Down', "bliccaThemes") => "bounceInDown-1 blind",  __('Bounce In Left', "bliccaThemes") => "bounceInLeft-1 blind", __('Bounce In Right', "bliccaThemes") => "bounceInRight-1 blind", __('Rotate In', "bliccaThemes") => "rotateIn-1 blind", __('Rotate In Down Left', "bliccaThemes") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "bliccaThemes") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "bliccaThemes") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "bliccaThemes") => "rotateInUpRight-1 blind", __('Light Speed In', "bliccaThemes") => "lightSpeedIn-1 blind", __('Roll In', "bliccaThemes") => "rollIn-1 blind", __('Special Effect 1', "bliccaThemes") => "blogeffect4-1 blind", __('Special Effect 2', "bliccaThemes") => "blogeffect5-1 blind", __('Special Effect 3', "bliccaThemes") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'bliccaThemes')
    )
   )
) );
}
/*********************/
/*   Mail Chimp Form */
/*********************/
function bliccaThemes_mailchimps($atts) {
   extract(shortcode_atts ( array(
    'mailchimp' => '',
    ), 
   $atts));
  
  $mailchimp = '['.$mailchimp.']';
  return '<div class="bt-mailchimp">'.do_shortcode( $mailchimp ) .'</div>';
}
add_shortcode('bliccaThemes_mailchimp', 'bliccaThemes_mailchimps');
add_action( 'init', 'bliccaThemes_mailchimp_integrateWithVC' );
function bliccaThemes_mailchimp_integrateWithVC() {
wpb_map( array(
   "name" => __("Mail Chimp", 'bliccaThemes'),
   "base" => "bliccaThemes_mailchimp",
   "class" => "",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/visualcomposer.css'),   
   "icon" => "bliccaThemes-vc-icon",    
   "params" => array(    

    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Mail Chimp Shortcode", 'bliccaThemes'),
        "param_name" => "mailchimp",
        "description" => __("Paste your mail chimp shortcode without [ ], just paste content of between [ and ]. you should install mailchimp plugin for wordpress and create your form before using these.", 'bliccaThemes')
    )
)
));
}     
/*************************************/
/**** Blicca Themes Count Widget  ****/
/*************************************/
function bliccaThemes_count($atts) {
   extract(shortcode_atts ( array(
    'header' => '',
    'number' => '',
    'speed' => '',
    'refresh'=> '',
    'count_title_color'=> '',
    'style' => 'minimal', 
    'count_image' => '',
    'count_icon' => '',
    'count_size' => ''
    ), 
   $atts));

   $c_title_color = "";
   if ( $count_title_color != "" ) {
      $c_title_color = ' style = "color:'.$count_title_color.';"'; 
   }
   
  
   if ( $style == "image" ) {
      $img_id = preg_replace('/[^\d]/', '', $count_image);
      $image_url = wp_get_attachment_image_src( $img_id, 'full');
      $image_url = $image_url[0]; 
      $add_icon = '<div class="bt-count-icon"><img src="'.$image_url.'" alt="seperator"></div>'; 
   }
   
   if ( $style == "font-icon") {
     if ( $count_size != "" ) {
       $count_size = ' style = "font-size:'.$count_size.'px;"'; 
     }
       $add_icon = '<div class="bt-count-icon"><i '.$count_size.' class="fa fa-'.$count_icon.'"></i></div>'; 
  }

   return '<div class="bliccaThemes-count"'.$c_title_color.'><div class="bt-count-title">'.$header.'</div><span class="timer" data-from="0" data-to="'.$number.'" data-speed="'.$speed.'" data-refresh-interval="'.$refresh.'">0</span>'.$add_icon.'</div>';

}
add_shortcode('bliccaThemes_count_widget', 'bliccaThemes_count');

add_action( 'init', 'bliccaThemes_count_integrateWithVC' );
function bliccaThemes_count_integrateWithVC() {
wpb_map( array(
   "name" => __("Count Widget", 'bliccaThemes'),
   "base" => "bliccaThemes_count_widget",
   "class" => "",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/visualcomposer.css'),   
   "icon" => "bliccaThemes-vc-icon",    
   "params" => array(    
    array(
      "type" => "colorpicker",
      "heading" => __("Content Color", "bliccaThemes"),
      "param_name" => "count_title_color",
      "description" => __("Leave it blank if you want to use default color", "bliccaThemes")
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'bliccaThemes'),
        "param_name" => "header",
        "value" => __("Title", 'bliccaThemes'),
        "description" => __("Title for section", 'bliccaThemes')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Number", 'bliccaThemes'),
        "param_name" => "number",
        "description" => __("Number", 'bliccaThemes')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Speed", 'bliccaThemes'),
        "param_name" => "speed",
        "description" => __("Speed of count, for example 1000", 'bliccaThemes')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Refresh Interval", 'bliccaThemes'),
        "param_name" => "refresh",
        "description" => __("Refresh Interval, for example 20", 'bliccaThemes')
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Count Style", 'bliccaThemes'),
        "param_name" => "style",
        "value" => array(__('Minimal', "bliccathemes") => "minimal", __('Image', "bliccaThemes") => "image", __('Font Icon', "bliccaThemes") => "font-icon"),
        "description" => __("You can add image or icon to your count widget, if you dont want to add, choose minimal.", 'bliccaThemes')
    ),
    array(
      "type" => "attach_image",
      "heading" => __('Image for Count', 'bliccaThemes'),
      "param_name" => "count_image",
      "dependency" => Array('element' => "style", 'value' => array('image')),         
      "description" => __("Select image for your count widget", "bliccaThemes")
    ),        
    array(
        "type" => "icon",
        "class" => "",
        "heading" => __("Count Icon:", "bliccaThemes"),
        "param_name" => "count_icon",
        "admin_label" => true,        
        "value" => "circle",
        "dependency" => Array('element' => "style", 'value' => array('font-icon')),        
        "description" => __("Select the count icon from the list if you want to add.", "bliccaThemes")
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Count Icon Font Size", 'bliccaThemes'),
        "param_name" => "count_size",
        "dependency" => Array('element' => "style", 'value' => array('font-icon')),        
        "description" => __("Count icon size. Leave it blank for the default size.", 'bliccaThemes')
    )   
)
));
}
/***********************/
/*    Event Slider     */
/***********************/
function bliccaThemes_events_slider($atts) {
   extract(shortcode_atts ( array(
    'slides' => '',
    'readmore' => '',
    'r' => '',
    'animation' => 'no_animation',
    'delay' => ''
    ), 
    $atts));
    $countto = "";
    if ($slides == "") {
      $slides == "3";
    }
    
    if ( $delay == '') {
    $delay = "1000";
    }
    global $wp_query;

    ob_start(); ?>

    <div class="<?php echo esc_attr($animation); ?> bt-events-slider" <?php echo ' style="animation-delay: '.$delay.'ms; -moz-animation-delay: '.$delay.'ms; -webkit-animation-delay: '.$delay.'ms;"'; ?>>
      <div class="bt-events-container">
      <?php 
          $r = new WP_Query( array( 'posts_per_page' => $slides, 'post_type' => 'events') );
          if ($r->have_posts()) :
          while ( $r->have_posts() ) : $r->the_post();
          $countto = get_post_meta(get_the_ID(), "_date", true);  
          if (new DateTime() < new DateTime($countto)) {   
          ?>        
        <div class="bt-event">
          <div class="bt-event-thumb">
          <?php echo get_the_post_thumbnail(get_the_ID(), 'bliccaThemes-event'); ?>
          </div>
          <div class="bt-event-content">
            <h3><?php the_title(); ?></h3>
            <p class="bt-event-meta">
                <?php 
                
                echo esc_html($countto);
                ?>
            </p>
            <p class="bt-event-excerpt"><?php echo get_the_excerpt(); ?></p>
            <div class="count-down" data-countdown="<?php echo esc_js($countto); ?>"></div>
            <div class="bt-event-button"><a class="bt-event-readmore" href="<?php the_permalink(); ?>"><?php echo esc_html($readmore); ?></a></div>
          </div>
          <div class="clearfix"></div>
        </div>
            <?php 
               }
               endwhile; 
            endif;
            wp_reset_query(); 
            ?>        
      </div>
    </div>   
  <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode('bliccaThemes_event_slider', 'bliccaThemes_events_slider');

add_action( 'vc_before_init', 'bliccaThemes_event_slider_integrateWithVC' );
function bliccaThemes_event_slider_integrateWithVC() {
wpb_map( array(
   "name" => __("Event Slider", 'bliccaThemes'),
   "base" => "bliccaThemes_event_slider",
   "class" => "",
   "category" => 'Content',    
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/visualcomposer.css'),   
   "icon" => "bliccaThemes-vc-icon", 
   "params" => array(    
 
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Slides", 'bliccaThemes'),
        "param_name" => "slides",
        "description"=> __("How many events do you want to show", 'bliccaThemes')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("View Event", 'bliccaThemes'),
        "param_name" => "readmore",
        "description"=> __("This is a text for you button, example: View Event, Read More...", 'bliccaThemes')
    ),    
      
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'bliccaThemes'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "bliccaThemes") => "no_animation", __('Tada', "bliccaThemes") => "tadab-1 blind", __('Flip In X', "bliccaThemes") => "flipInX-1 blind", __('Flip In Y', "bliccaThemes") => "flipInY-1 blind", __('Fade In', "bliccaThemes") => "fadeIn-1 blind", __('Fade In Up', "bliccaThemes") => "fadeInUp-1 blind", __('Fade In Down', "bliccaThemes") => "fadeInDown-1 blind", __('Fade In Left', "bliccaThemes") => "fadeInLeft-1 blind", __('Fade In Right', "bliccaThemes") => "fadeInRight-1 blind", __('Fade In Up Big', "bliccaThemes") => "fadeInUpBig-1 blind", __('Fade In Down Big', "bliccaThemes") => "fadeInDownBig-1 blind", __('Fade In Left Big', "bliccaThemes") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "bliccaThemes") => "fadeInRightBig-1 blind", __('Bounce In', "bliccaThemes") => "bounceIn-1 blind", __('Bounce In Down', "bliccaThemes") => "bounceInDown-1 blind",  __('Bounce In Left', "bliccaThemes") => "bounceInLeft-1 blind", __('Bounce In Right', "bliccaThemes") => "bounceInRight-1 blind", __('Rotate In', "bliccaThemes") => "rotateIn-1 blind", __('Rotate In Down Left', "bliccaThemes") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "bliccaThemes") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "bliccaThemes") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "bliccaThemes") => "rotateInUpRight-1 blind", __('Light Speed In', "bliccaThemes") => "lightSpeedIn-1 blind", __('Roll In', "bliccaThemes") => "rollIn-1 blind", __('Special Effect 1', "bliccaThemes") => "blogeffect4-1 blind", __('Special Effect 2', "bliccaThemes") => "blogeffect5-1 blind", __('Special Effect 3', "bliccaThemes") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'bliccaThemes')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation Delay", 'bliccaThemes'),
        "param_name" => "delay",
        "description"=> __("If you write 1000, it means your animation will work after 1 second", 'bliccaThemes')
    )
   )
) );
}
/************************************/
/**** BliccaThemes Section Title ****/
/************************************/
function bliccaThemes_section_titles($atts, $content = null) {
   extract(shortcode_atts ( array(
    'header' => '',
    'subtitle' => '',   
    'subtitle_color' => '',
    'title_color' => '',
    'line_color' => '',
    'style' => 'image', 
    'sep_image' => '',
    'sep_icon' => '',
    'sep_color' => '',    
    'sep_size' =>'',
    'activate_animation' =>''
    ), 
   $atts));
   $custom_sep_size = $sep = $anim1 = $anim3 = "";

   $anim2 = "bt_section_sep";
   if ( $activate_animation == "yes" ) {
     $anim1 = "fadeInDown-1 blind animated";
     $anim2 = "fadeIn-1 blind bt_section_sep animated";
     $anim3 = "fadeInUp-1 blind animated";
   }
   if ( $style == "image" ) {
      $img_id = preg_replace('/[^\d]/', '', $sep_image);
      $image_url = wp_get_attachment_image_src( $img_id, 'full');
      $image_url = $image_url[0]; 
      $sep = '<img src="'.$image_url.'" alt="seperator">'; 
   }

   $custom_sep_color = "";
     if ( $sep_color != "" ) {
     $custom_sep_color = ' style = "color:'.$sep_color.';"'; 
   }
   
   if ( $style == "font-icon") {
     if ( $sep_size != "" ) {
       $custom_sep_size = ' style = "font-size:'.$sep_size.'px;"'; 
     }
       $sep = '<span class="font-sep" '.$custom_sep_color.'><i '.$custom_sep_size.' class="fa fa-'.$sep_icon.'"></i></span>'; 
  }

   $custom_line_color = "";
     if ( $line_color != "" ) {
     $line_color = ' style = "border-color:'.$line_color.';"'; 
   }

   $custom_title_color = "";
     if ( $title_color != "" ) {
     $custom_title_color = ' style = "color:'.$title_color.';"'; 
   }
   $custom_content_color = "";
     if ( $subtitle_color != "" ) {
     $custom_content_color = ' style = "color:'.$subtitle_color.';"'; 
   }
   if ( $subtitle != "" ) {
     $subtitle = '<p class="'.$anim3.'"'.$custom_content_color.'>'.$subtitle.'</p>';
   }

   return '<div class="bliccaThemes_section_title wpb_content_element" '.$custom_line_color.'>
          <h2 class="'.$anim1.'" '.$custom_title_color.'>'.$header.'</h2>
          <div class="'.$anim2.'"'.$line_color.'>'.$sep.'</div>'
          .$subtitle.'
          </div>';

}
add_shortcode('bliccaThemes_section_title', 'bliccaThemes_section_titles');

add_action( 'init', 'bliccaThemes_section_titles_integrateWithVC' );
function bliccaThemes_section_titles_integrateWithVC() {
wpb_map( array(
   "name" => __("BliccaThemes Section Title", 'bliccaThemes'),
   "base" => "bliccaThemes_section_title",
   "class" => "",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/visualcomposer.css'),   
   "icon" => "bliccaThemes-vc-icon",    
   "params" => array(    

    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'bliccaThemes'),
        "param_name" => "header",
        "value" => __("Title", 'bliccaThemes'),
        "description" => __("Title for section", 'bliccaThemes')
    ),
    array(
      "type" => "colorpicker",
      "heading" => __("Title Color", "bliccaThemes"),
      "param_name" => "title_color",
      "description" => __("Leave it blank if you want to use default color", "bliccaThemes")
    ),

    array(
      "type" => "colorpicker",
      "heading" => __("Line Color", "bliccaThemes"),
      "param_name" => "line_color",
      "description" => __("Leave it blank if you want to use default color", "bliccaThemes")
    ),

    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Subtitle", 'bliccaThemes'),
        "param_name" => "subtitle",
        "description" => __("Subtitle for section", 'bliccaThemes')
    ),
    array(
      "type" => "colorpicker",
      "heading" => __("Subtitle Color", "bliccaThemes"),
      "param_name" => "subtitle_color",
      "description" => __("Leave it blank if you want to use default color", "bliccaThemes")
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Seperator Style", 'bliccaThemes'),
        "param_name" => "style",
        "value" => array(__('Image', "bliccaThemes") => "image", __('Font Icon', "bliccaThemes") => "font-icon"),
        "description" => __("Choose your seperator style.", 'bliccaThemes')
    ),
    array(
      "type" => "attach_image",
      "heading" => __('Image for Separator', 'bliccaThemes'),
      "param_name" => "sep_image",
        "dependency" => Array('element' => "style", 'value' => array('image')),         
      "description" => __("Select image for your seperator", "bliccaThemes")
    ),        
    array(
        "type" => "icon",
        "class" => "",
        "heading" => __("Seperator Icon:", "bliccaThemes"),
        "param_name" => "sep_icon",
        "admin_label" => true,        
        "value" => "circle",
        "dependency" => Array('element' => "style", 'value' => array('font-icon')),        
        "description" => __("Select the seperator icon from the list if you want to add.", "bliccaThemes")
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Seperator Icon Font Size", 'bliccaThemes'),
        "param_name" => "sep_size",
        "dependency" => Array('element' => "style", 'value' => array('font-icon')),        
        "description" => __("Seperator size. Leave it blank for the default size.", 'bliccaThemes')
    ),
    array(
      "type" => "colorpicker",
      "heading" => __("Seperator Icon Color", "bliccaThemes"),
      "param_name" => "sep_color",
      "dependency" => Array('element' => "style", 'value' => array('font-icon')),          
      "description" => __("Leave it blank if you want to use default color", "bliccaThemes")
    ),
    array(
        "type" => 'checkbox',
        "heading" => __("Add Animation", "bliccaThemes"),
        "param_name" => "activate_animation",
        "description" => __("Add animation to your widget. If you check this, your titles will have auto animation", "bliccaThemes"),
        "value" => Array(__("Yes, please", "bliccaThemes") => 'yes')
    )    
)
));
}
/************************/
/* Grid Restaurant Menu */
/************************/
function bliccaThemes_restaurant_menu_grids($atts){
   extract(shortcode_atts ( array(
      'type' => 'style1',
      'r' => '',
      'taxonomies' => '',
      'menufilter' => '',
      'order' => 'DESC'    
    ), 
   $atts));
        $ordery = $order;
        ob_start();
        global $post;
        global $wp_query;
        if ( !empty($taxonomies)) {
        
        $taxo = explode(",", $taxonomies);
        $r = new WP_Query( array( 
          'posts_per_page' => -1, 
          'post_type' => 'foodmenu', 
          'meta_key' => '_menuorder', 
          'orderby'=> 'meta_value_num',
          'order' => $ordery, 
          'tax_query' => array(
                            'relation' => 'AND',
                            array(
                              'taxonomy' => 'foodtype',
                              'field'    => 'id',
                              'terms'    => $taxo,
                              
                            ),  
                        ),
          ) );
        
        }
        else {
        $r = new WP_Query( array( 'posts_per_page' => -1, 'post_type' => 'foodmenu', 'order' => $ordery) );  
        }
        if ($r->have_posts()) :
            ?>

        <div class="bliccaThemes-menu-grid">    
          <?php if ( $menufilter == "yes" ) {?> 
          <div class="bt-menu-filter">
              <ul>
                  <li class="slug-bt-menu-item active"><a href="#bt-menu-item"><?php echo __('All', 'bliccaThemes');?></a></li>
                  <?php
                  $terms = get_terms("foodtype", array('hide_empty' => false, 'include' => $taxonomies));
                  $count = count($terms);
                  if ( $count > 0 ){
                    foreach ( $terms as $term) {
                    echo '<li class="slug-'.$term->slug.'"><a href="#'.$term->slug.'" data-filter=".'.$term->slug.'">'.$term->name.'</a></li>';
                    }
                  }
              ?>
              </ul>  
          </div>
          <?php } ?>
          <div id="<?php echo esc_attr($type); ?>" class="bt-menu-items">
          <?php while ( $r->have_posts() ) : $r->the_post();?>                    
          <?php wp_enqueue_script( 'isotope' ); ?>            
            <div class="bt-menu-item bt-menu-item-s1 <?php $categories = wp_get_object_terms($post->ID, 'foodtype');
              foreach($categories as $category){
                echo esc_attr($category->slug).' '; }?>">
            <?php
            $image_id = get_post_thumbnail_id();    
            $image_url = wp_get_attachment_image_src($image_id,'full');
            $price = get_post_meta(get_the_ID(), "_price", true);
            $ingredients = get_post_meta(get_the_ID(), "_ingredients", true);    
            ?>   
              <div class="bt-menu-itemThumb">
              <a href="<?php echo esc_url($image_url[0]); ?>" class="prettyPhoto" data-rel="prettyPhoto">
              <?php 
                    if ($type == "style1") { echo get_the_post_thumbnail(get_the_ID(), 'bliccaThemes-menus1'); }
                    else { echo get_the_post_thumbnail(get_the_ID(), 'bliccaThemes-grid'); }
              ?>
              <div class="bt-menu-itemHover"><i class="fa fa-search"></i></div>
              </a>
              </div>
              <div class="bt-menu-itemContent">
                <h4><?php the_title(); ?></h4>
                <?php if ( !empty($ingredients) ) { ?><p class="bt-menu-itemDesc"><?php echo esc_html($ingredients); ?></p><?php } ?>
                <?php if ( !empty($price) ) { ?><p class="bt-menu-itemPrice"><?php echo __("Price", "bliccaThemes"); ?>: <?php echo esc_html($price); ?></p><?php } ?>
              </div>
            </div>
          <?php endwhile; ?>
          </div>
        </div>            
    
<?php 
endif;
       wp_reset_query(); 
       $content = ob_get_contents();
       ob_end_clean();
       return $content;
}
add_shortcode('bliccaThemes_restaurant_menu_grid', 'bliccaThemes_restaurant_menu_grids');

add_action( 'init', 'bliccaThemes_restaurant_menu_grid_integrateWithVC' );
function bliccaThemes_restaurant_menu_grid_integrateWithVC() {
$vc_taxonomies_types = get_taxonomies( array( 'public' => true ), 'objects' );
$vc_taxonomies = get_terms( array_keys( $vc_taxonomies_types ), array( 'hide_empty' => false ) );
$taxonomies_list = array();
if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
  foreach ( $vc_taxonomies as $t ) {
    if ( is_object( $t ) ) {
      $taxonomies_list[] = array(
        'label' => $t->name,
        'value' => $t->term_id,
        'group_id' => $t->taxonomy,
        'group' =>
          isset( $vc_taxonomies_types[ $t->taxonomy ], $vc_taxonomies_types[ $t->taxonomy ]->labels, $vc_taxonomies_types[ $t->taxonomy ]->labels->name )
            ? $vc_taxonomies_types[ $t->taxonomy ]->labels->name
            : __( 'Taxonomies', 'js_composer' )
      );
    }
  }
}
$taxonomies_for_filter = array();
if ( is_array( $vc_taxonomies_types ) && ! empty( $vc_taxonomies_types ) ) {
  foreach ( $vc_taxonomies_types as $t => $data ) {
    if ( $t !== 'post_format' && is_object( $data ) ) {
      $taxonomies_for_filter[ $data->labels->name ] = $t;
    }
  }
}  
wpb_map( array(
   "name" => __("Grid Restaurant Menu", 'bliccaThemes'),
   "base" => "bliccaThemes_restaurant_menu_grid",
   "class" => "",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/visualcomposer.css'),   
   "icon" => "bliccaThemes-vc-icon",    
   "params" => array(

    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Grid Style", 'bliccaThemes'),
        "param_name" => "type",
        "value" => array(__('Thumbnail Left', "bliccaThemes") => "style1", __('Thumbnail Top', "bliccaThemes") => "style2" ),
        "description" => __("Choose your style.", 'bliccaThemes')
    ),
    array(
        'type' => 'autocomplete',
        'heading' => __( 'Narrow data source', 'js_composer' ),
        'param_name' => 'taxonomies',
        'settings' => array(
          'multiple' => true,
          // is multiple values allowed? default false
          // 'sortable' => true, // is values are sortable? default false
          'min_length' => 1,
          // min length to start search -> default 2
          // 'no_hide' => true, // In UI after select doesn't hide an select list, default false
          'groups' => true,
          // In UI show results grouped by groups, default false
          'unique_values' => true,
          // In UI show results except selected. NB! You should manually check values in backend, default false
          'display_inline' => true,
          // In UI show results inline view, default false (each value in own line)
          'delay' => 500,
          // delay for search. default 500
          'auto_focus' => true,
          // auto focus input, default true
          'values' => $taxonomies_list,
        ),
        'param_holder_class' => 'vc_not-for-custom',
        'description' => __( 'Enter menu categories', 'js_composer' ),
        'dependency' => array(
          'element' => 'post_type',
          'value_not_equal_to' => array( 'ids', 'custom' ),
        ),
      ),         
    array(
        "type" => 'checkbox',
        "heading" => __("Add Filter", "bliccaThemes"),
        "param_name" => "menufilter",
        "description" => __("Add filter menu to your widget.", "bliccaThemes"),
        "value" => Array(__("Yes, please", "bliccaThemes") => 'yes')
    ), 
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Menu Order", 'bliccaThemes'),
        "param_name" => "order",
        "value" => array(__('Descending ', "bliccaThemes") => "DESC ", __('Ascending ', "bliccaThemes") => "ASC" ),
        "description" => __("Choose your order.", 'bliccaThemes')
    ) 
   )
) );
}
/************************/
/* List Restaurant Menu */
/************************/
function bliccaThemes_restaurant_menu_lists($atts){
   extract(shortcode_atts ( array(
      'r' => '',
      'taxonomies' => '',      
      'order' => 'DESC'    
    ), 
   $atts));
        $ordery = $order;
        ob_start();
        global $wp_query;
        $terms = get_terms("foodtype", array('hide_empty' => false, 'include' => $taxonomies, 'orderby' => 'slug'));
        $count = count($terms);

    ?>
    <div class="bliccaThemes-menu-category">
    <?php 
    if ( $count > 0 ){
      foreach ( $terms as $term) {
        $term_id = $term->term_id;
        $subtitle_icon = get_tax_meta($term_id,'bt_image_field_id_iki',true);        
        ?>
        <div class="bt-accordionMenu-item">
          <div class="bt-accordion-itemContent"><div class="container"><div class="row"><div class="col-md-12">
          <h4 class="bt-accordion-subtitle"><?php echo esc_html($term->name); ?></h4>
          <div class="bt-subtitle-image"><?php if (!empty($subtitle_icon['url'])) { ?><img src="<?php echo esc_url($subtitle_icon['url']); ?>" alt="<?php echo esc_html($term->name); ?>"><?php } ?></div>  
          <div class="bt-accordion-item-container">  
          <?php 
          $r = new WP_Query( array( 'posts_per_page' => -1, 'post_type' => 'foodmenu', 'foodtype' => $term->slug, 'meta_key' => '_menuorder', 'orderby'=> 'meta_value_num', 'order' => $ordery) );
          if ($r->have_posts()) :
          while ( $r->have_posts() ) : $r->the_post();  
          ?>  
            <div class="bt-menu-item-s1">
            <?php
            $image_id = get_post_thumbnail_id();    
            $image_url = wp_get_attachment_image_src($image_id,'full');
            $price = get_post_meta(get_the_ID(), "_price", true);
            $ingredients = get_post_meta(get_the_ID(), "_ingredients", true);    
            ?>   
              <div class="bt-menu-itemThumb">
              <a href="<?php echo esc_url($image_url[0]); ?>" class="prettyPhoto" data-rel="prettyPhoto">
              <?php echo get_the_post_thumbnail(get_the_ID(), 'bliccaThemes-menus1'); ?>
              <div class="bt-menu-itemHover"><i class="fa fa-search"></i></div>
              </a>
              </div>
              <div class="bt-menu-itemContent">
                <h4><?php the_title(); ?></h4>
                <?php if ( !empty($ingredients) ) { ?><p class="bt-menu-itemDesc"><?php echo esc_html($ingredients); ?></p><?php } ?>
                <?php if ( !empty($price) ) { ?><p class="bt-menu-itemPrice"><?php echo __("Price", "bliccaThemes"); ?>: <?php echo esc_html($price); ?></p><?php } ?>
              </div>
            </div>
            <?php endwhile; 
            endif;
            wp_reset_query(); 
            ?>
          </div>  
          </div></div></div></div>
        </div> 
        <?php 
      }
    }

    ?>
    </div>
    <?php
    $content = ob_get_contents();
    ob_end_clean();  
    return $content;
}
add_shortcode('bliccaThemes_restaurant_menu_list', 'bliccaThemes_restaurant_menu_lists');

add_action( 'init', 'bliccaThemes_restaurant_menu_list_integrateWithVC' );
function bliccaThemes_restaurant_menu_list_integrateWithVC() {
$vc_taxonomies_types = get_taxonomies( array( 'public' => true ), 'objects' );
$vc_taxonomies = get_terms( array_keys( $vc_taxonomies_types ), array( 'hide_empty' => false ) );
$taxonomies_list = array();
if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
  foreach ( $vc_taxonomies as $t ) {
    if ( is_object( $t ) ) {
      $taxonomies_list[] = array(
        'label' => $t->name,
        'value' => $t->term_id,
        'group_id' => $t->taxonomy,
        'group' =>
          isset( $vc_taxonomies_types[ $t->taxonomy ], $vc_taxonomies_types[ $t->taxonomy ]->labels, $vc_taxonomies_types[ $t->taxonomy ]->labels->name )
            ? $vc_taxonomies_types[ $t->taxonomy ]->labels->name
            : __( 'Taxonomies', 'js_composer' )
      );
    }
  }
}
$taxonomies_for_filter = array();
if ( is_array( $vc_taxonomies_types ) && ! empty( $vc_taxonomies_types ) ) {
  foreach ( $vc_taxonomies_types as $t => $data ) {
    if ( $t !== 'post_format' && is_object( $data ) ) {
      $taxonomies_for_filter[ $data->labels->name ] = $t;
    }
  }
}  
wpb_map( array(
   "name" => __("List Restaurant Menu", 'bliccaThemes'),
   "base" => "bliccaThemes_restaurant_menu_list",
   "class" => "",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/visualcomposer.css'),   
   "icon" => "bliccaThemes-vc-icon",    
   "params" => array(
    array(
        'type' => 'autocomplete',
        'heading' => __( 'Narrow data source', 'js_composer' ),
        'param_name' => 'taxonomies',
        'settings' => array(
          'multiple' => true,
          // is multiple values allowed? default false
          // 'sortable' => true, // is values are sortable? default false
          'min_length' => 1,
          // min length to start search -> default 2
          // 'no_hide' => true, // In UI after select doesn't hide an select list, default false
          'groups' => true,
          // In UI show results grouped by groups, default false
          'unique_values' => true,
          // In UI show results except selected. NB! You should manually check values in backend, default false
          'display_inline' => true,
          // In UI show results inline view, default false (each value in own line)
          'delay' => 500,
          // delay for search. default 500
          'auto_focus' => true,
          // auto focus input, default true
          'values' => $taxonomies_list,
        ),
        'param_holder_class' => 'vc_not-for-custom',
        'description' => __( 'Enter menu categories,.', 'js_composer' ),
        'dependency' => array(
          'element' => 'post_type',
          'value_not_equal_to' => array( 'ids', 'custom' ),
        ),
      ), 
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Menu Order", 'bliccaThemes'),
        "param_name" => "order",
        "value" => array(__('Descending ', "bliccaThemes") => "DESC ", __('Ascending ', "bliccaThemes") => "ASC" ),
        "description" => __("Choose your order.", 'bliccaThemes')
    ) 
   )
) );
}
/***********************************/
/**** Restaurant Menu Accordion ****/
/***********************************/ 
function bliccaThemes_restaurant_menu_accordions($atts) {
   extract(shortcode_atts ( array(
    'r' => '',
    'animation' => 'no_animation',
    'taxonomies' => '',
    'delay' => ''
    ), 
    $atts));
    if ( $delay == '') {
    $delay = "1000";
    }

    global $wp_query;

    $terms = get_terms("foodtype", array('hide_empty' => false, 'include' => $taxonomies, 'orderby' => 'slug'));
    $count = count($terms);

    ob_start(); ?>
    <div class="<?php echo esc_attr($animation); ?> bliccaThemes-accordionMenu animated"<?php echo ' style="animation-delay: '.$delay.'ms; -moz-animation-delay: '.$delay.'ms; -webkit-animation-delay: '.$delay.'ms;"'; ?>><?php
    if ( $count > 0 ){
      foreach ( $terms as $term) {
        ?>
        <div class="bt-accordionMenu-item">
          <div class="bt-accordion-itemTitle closeit">
          <h3><?php echo esc_html($term->name); ?></h3>
          <?php 
          $term_id = $term->term_id;
          $title_back = get_tax_meta($term_id,'bt_image_field_id',true);
          $subtitle_icon = get_tax_meta($term_id,'bt_image_field_id_iki',true);
          if ( !isset($title_back['url']) ) { $title_back['url'] = get_template_directory_uri() . '/img/nothumb.png'; }
          ?>  
          <div class="bt-accordion-itemBg" style="background:url('<?php echo esc_url($title_back['url']); ?>')"></div>
          </div>
          <div class="bt-accordion-itemContent"><div class="container"><div class="row"><div class="col-md-12">
          <h4 class="bt-accordion-subtitle"><?php echo esc_html($term->description); ?></h4>
          <div class="bt-subtitle-image"><?php if (!empty($subtitle_icon['url'])) { ?><img src="<?php echo esc_html($subtitle_icon['url']); ?>" alt="<?php echo esc_attr($term->name); ?>"><?php } ?></div>  
          <div class="bt-accordion-item-container">  
          <?php 
          $r = new WP_Query( array( 'posts_per_page' => -1, 'post_type' => 'foodmenu', 'meta_key' => '_menuorder', 'orderby'=> 'meta_value_num', 'foodtype' => $term->slug) );
          if ($r->have_posts()) :
          while ( $r->have_posts() ) : $r->the_post();  
          ?>  
            <div class="bt-menu-item-s1">
            <?php
            $image_id = get_post_thumbnail_id();    
            $image_url = wp_get_attachment_image_src($image_id,'full');
            $price = get_post_meta(get_the_ID(), "_price", true);
            $ingredients = get_post_meta(get_the_ID(), "_ingredients", true);    
            ?>   
              <div class="bt-menu-itemThumb">
              <a href="<?php echo esc_url($image_url[0]); ?>" class="prettyPhoto" data-rel="prettyPhoto">
              <?php echo get_the_post_thumbnail(get_the_ID(), 'bliccaThemes-menus1'); ?>
              <div class="bt-menu-itemHover"><i class="fa fa-search"></i></div>
              </a>
              </div>
              <div class="bt-menu-itemContent">
                <h4><?php the_title(); ?></h4>
                <?php if ( !empty($ingredients) ) { ?><p class="bt-menu-itemDesc"><?php echo esc_html($ingredients); ?></p><?php } ?>
                <?php if ( !empty($price) ) { ?><p class="bt-menu-itemPrice"><?php echo __("Price", "bliccaThemes"); ?>: <?php echo esc_html($price); ?></p><?php } ?>
              </div>
            </div>
            <?php endwhile; 
            endif;
            wp_reset_query(); 
            ?>
          </div>  
          </div></div></div></div>
        </div> 
        <?php 
      }
    }

    ?>
    </div>
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode('bliccaThemes_restaurant_menu_accordion', 'bliccaThemes_restaurant_menu_accordions');

add_action( 'vc_before_init', 'bliccaThemes_restaurant_menu_accordion_integrateWithVC' );
function bliccaThemes_restaurant_menu_accordion_integrateWithVC() {
$vc_taxonomies_types = get_taxonomies( array( 'public' => true ), 'objects' );
$vc_taxonomies = get_terms( array_keys( $vc_taxonomies_types ), array( 'hide_empty' => false ) );
$taxonomies_list = array();
if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
  foreach ( $vc_taxonomies as $t ) {
    if ( is_object( $t ) ) {
      $taxonomies_list[] = array(
        'label' => $t->name,
        'value' => $t->term_id,
        'group_id' => $t->taxonomy,
        'group' =>
          isset( $vc_taxonomies_types[ $t->taxonomy ], $vc_taxonomies_types[ $t->taxonomy ]->labels, $vc_taxonomies_types[ $t->taxonomy ]->labels->name )
            ? $vc_taxonomies_types[ $t->taxonomy ]->labels->name
            : __( 'Taxonomies', 'js_composer' )
      );
    }
  }
}
$taxonomies_for_filter = array();
if ( is_array( $vc_taxonomies_types ) && ! empty( $vc_taxonomies_types ) ) {
  foreach ( $vc_taxonomies_types as $t => $data ) {
    if ( $t !== 'post_format' && is_object( $data ) ) {
      $taxonomies_for_filter[ $data->labels->name ] = $t;
    }
  }
}  
wpb_map( array(
   "name" => __("Restaurant Menu Accordion", 'bliccaThemes'),
   "base" => "bliccaThemes_restaurant_menu_accordion",
   "class" => "",
   "category" => 'Content',    
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/visualcomposer.css'),   
   "icon" => "bliccaThemes-vc-icon", 
   "params" => array(    
     
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'bliccaThemes'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "bliccaThemes") => "no_animation", __('Tada', "bliccaThemes") => "tadab-1 blind", __('Flip In X', "bliccaThemes") => "flipInX-1 blind", __('Flip In Y', "bliccaThemes") => "flipInY-1 blind", __('Fade In', "bliccaThemes") => "fadeIn-1 blind", __('Fade In Up', "bliccaThemes") => "fadeInUp-1 blind", __('Fade In Down', "bliccaThemes") => "fadeInDown-1 blind", __('Fade In Left', "bliccaThemes") => "fadeInLeft-1 blind", __('Fade In Right', "bliccaThemes") => "fadeInRight-1 blind", __('Fade In Up Big', "bliccaThemes") => "fadeInUpBig-1 blind", __('Fade In Down Big', "bliccaThemes") => "fadeInDownBig-1 blind", __('Fade In Left Big', "bliccaThemes") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "bliccaThemes") => "fadeInRightBig-1 blind", __('Bounce In', "bliccaThemes") => "bounceIn-1 blind", __('Bounce In Down', "bliccaThemes") => "bounceInDown-1 blind",  __('Bounce In Left', "bliccaThemes") => "bounceInLeft-1 blind", __('Bounce In Right', "bliccaThemes") => "bounceInRight-1 blind", __('Rotate In', "bliccaThemes") => "rotateIn-1 blind", __('Rotate In Down Left', "bliccaThemes") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "bliccaThemes") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "bliccaThemes") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "bliccaThemes") => "rotateInUpRight-1 blind", __('Light Speed In', "bliccaThemes") => "lightSpeedIn-1 blind", __('Roll In', "bliccaThemes") => "rollIn-1 blind", __('Special Effect 1', "bliccaThemes") => "blogeffect4-1 blind", __('Special Effect 2', "bliccaThemes") => "blogeffect5-1 blind", __('Special Effect 3', "bliccaThemes") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'bliccaThemes')
    ),
 array(
        'type' => 'autocomplete',
        'heading' => __( 'Narrow data source', 'js_composer' ),
        'param_name' => 'taxonomies',
        'settings' => array(
          'multiple' => true,
          // is multiple values allowed? default false
          // 'sortable' => true, // is values are sortable? default false
          'min_length' => 1,
          // min length to start search -> default 2
          // 'no_hide' => true, // In UI after select doesn't hide an select list, default false
          'groups' => true,
          // In UI show results grouped by groups, default false
          'unique_values' => true,
          // In UI show results except selected. NB! You should manually check values in backend, default false
          'display_inline' => true,
          // In UI show results inline view, default false (each value in own line)
          'delay' => 500,
          // delay for search. default 500
          'auto_focus' => true,
          // auto focus input, default true
          'values' => $taxonomies_list,
        ),
        'param_holder_class' => 'vc_not-for-custom',
        'description' => __( 'Enter menu categories,.', 'js_composer' ),
        
      ), 
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation Delay", 'bliccaThemes'),
        "param_name" => "delay",
        "description"=> __("If you write 1000, it means your animation will work after 1 second", 'bliccaThemes')
    )
   )
) );
}

/***********************************/
/**** Restaurant Menu Accordion ****/
/***********************************/ 
function bliccaThemes_restaurant_menu_accordions2($atts) {
   extract(shortcode_atts ( array(
    'r' => '',
    'taxonomies' => '',
    'animation' => 'no_animation',
    'delay' => ''
    ), 
    $atts));
    if ( $delay == '') {
    $delay = "1000";
    }

    global $wp_query;

    $terms = get_terms("foodtype", array('hide_empty' => false, 'include' => $taxonomies, 'orderby' => 'slug'));
    $count = count($terms);

    ob_start(); ?>
    <div class="<?php echo esc_attr($animation); ?> bliccaThemes-accordionMenu animated"<?php echo ' style="animation-delay: '.$delay.'ms; -moz-animation-delay: '.$delay.'ms; -webkit-animation-delay: '.$delay.'ms;"'; ?>><?php
    if ( $count > 0 ){
      foreach ( $terms as $term) {
        ?>
        <div class="bt-accordionMenu-item">
          <div class="bt-accordion-itemTitle closeit">
          <h3><?php echo esc_html($term->name); ?></h3>
          <?php 
          $term_id = $term->term_id;
          $title_back = get_tax_meta($term_id,'bt_image_field_id',true);
          $subtitle_icon = get_tax_meta($term_id,'bt_image_field_id_iki',true);
          if ( !isset($title_back['url']) ) { $title_back['url'] = get_template_directory_uri() . '/img/nothumb.png'; }
          ?>  
          <div class="bt-accordion-itemBg" style="background:url('<?php echo esc_url($title_back['url']); ?>')"></div>
          </div>
          <div class="bt-accordion-itemContent"><div class="container"><div class="row"><div class="col-md-12">
          <h4 class="bt-accordion-subtitle"><?php echo esc_html($term->description); ?></h4>
          <div class="bt-subtitle-image"><?php if (!empty($subtitle_icon['url'])) { ?><img src="<?php echo esc_html($subtitle_icon['url']); ?>" alt="<?php echo esc_attr($term->name); ?>"><?php } ?></div>  
          <div class="bt-menu-classic-item-container">  
          <?php 
          $r = new WP_Query( array( 'posts_per_page' => -1, 'post_type' => 'foodmenu', 'meta_key' => '_menuorder', 'orderby'=> 'meta_value_num', 'foodtype' => $term->slug) );
          if ($r->have_posts()) :
          while ( $r->have_posts() ) : $r->the_post();  
          ?>  
            <div class="bt-menu-classic-item">
            <?php
            $image_id = get_post_thumbnail_id();    
            $image_url = wp_get_attachment_image_src($image_id,'full');
            $price = get_post_meta(get_the_ID(), "_price", true);
            $ingredients = get_post_meta(get_the_ID(), "_ingredients", true);    
            ?> 
              <div class="bt-menu-classic-itemContent">
                <div class="bt-menu-classic-title"><?php the_title(); ?></div>
                <div class="bt-menu-classic-dot"></div>
                <div class="bt-menu-classic-price"><?php if ( !empty($price) ) { ?><?php echo esc_html($price); ?><?php } ?></div>             
              </div>
              <div class="bt-menu-classic-desc"><?php if ( !empty($ingredients) ) { ?><p class="bt-menu-itemDesc"><?php echo esc_html($ingredients); ?></p><?php } ?></div>
            </div>
            <?php endwhile; 
            endif;
            wp_reset_query(); 
            ?>
          </div>  
          </div></div></div></div>
        </div> 
        <?php 
      }
    }

    ?>
    </div>
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode('bliccaThemes_restaurant_menu_accordion2', 'bliccaThemes_restaurant_menu_accordions2');

add_action( 'vc_before_init', 'bliccaThemes_restaurant_menu_accordion2_integrateWithVC' );
function bliccaThemes_restaurant_menu_accordion2_integrateWithVC() {
$vc_taxonomies_types = get_taxonomies( array( 'public' => true ), 'objects' );
$vc_taxonomies = get_terms( array_keys( $vc_taxonomies_types ), array( 'hide_empty' => false ) );
$taxonomies_list = array();
if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
  foreach ( $vc_taxonomies as $t ) {
    if ( is_object( $t ) ) {
      $taxonomies_list[] = array(
        'label' => $t->name,
        'value' => $t->term_id,
        'group_id' => $t->taxonomy,
        'group' =>
          isset( $vc_taxonomies_types[ $t->taxonomy ], $vc_taxonomies_types[ $t->taxonomy ]->labels, $vc_taxonomies_types[ $t->taxonomy ]->labels->name )
            ? $vc_taxonomies_types[ $t->taxonomy ]->labels->name
            : __( 'Taxonomies', 'js_composer' )
      );
    }
  }
}
$taxonomies_for_filter = array();
if ( is_array( $vc_taxonomies_types ) && ! empty( $vc_taxonomies_types ) ) {
  foreach ( $vc_taxonomies_types as $t => $data ) {
    if ( $t !== 'post_format' && is_object( $data ) ) {
      $taxonomies_for_filter[ $data->labels->name ] = $t;
    }
  }
}    
wpb_map( array(
   "name" => __("Restaurant Menu Accordion 2", 'bliccaThemes'),
   "base" => "bliccaThemes_restaurant_menu_accordion2",
   "class" => "",
   "category" => 'Content',    
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/visualcomposer.css'),   
   "icon" => "bliccaThemes-vc-icon", 
   "params" => array(    
   array(
        'type' => 'autocomplete',
        'heading' => __( 'Narrow data source', 'js_composer' ),
        'param_name' => 'taxonomies',
        'settings' => array(
          'multiple' => true,
          // is multiple values allowed? default false
          // 'sortable' => true, // is values are sortable? default false
          'min_length' => 1,
          // min length to start search -> default 2
          // 'no_hide' => true, // In UI after select doesn't hide an select list, default false
          'groups' => true,
          // In UI show results grouped by groups, default false
          'unique_values' => true,
          // In UI show results except selected. NB! You should manually check values in backend, default false
          'display_inline' => true,
          // In UI show results inline view, default false (each value in own line)
          'delay' => 500,
          // delay for search. default 500
          'auto_focus' => true,
          // auto focus input, default true
          'values' => $taxonomies_list,
        ),
        'param_holder_class' => 'vc_not-for-custom',
        'description' => __( 'Enter menu categories,.', 'js_composer' ),
        
      ),     
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'bliccaThemes'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "bliccaThemes") => "no_animation", __('Tada', "bliccaThemes") => "tadab-1 blind", __('Flip In X', "bliccaThemes") => "flipInX-1 blind", __('Flip In Y', "bliccaThemes") => "flipInY-1 blind", __('Fade In', "bliccaThemes") => "fadeIn-1 blind", __('Fade In Up', "bliccaThemes") => "fadeInUp-1 blind", __('Fade In Down', "bliccaThemes") => "fadeInDown-1 blind", __('Fade In Left', "bliccaThemes") => "fadeInLeft-1 blind", __('Fade In Right', "bliccaThemes") => "fadeInRight-1 blind", __('Fade In Up Big', "bliccaThemes") => "fadeInUpBig-1 blind", __('Fade In Down Big', "bliccaThemes") => "fadeInDownBig-1 blind", __('Fade In Left Big', "bliccaThemes") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "bliccaThemes") => "fadeInRightBig-1 blind", __('Bounce In', "bliccaThemes") => "bounceIn-1 blind", __('Bounce In Down', "bliccaThemes") => "bounceInDown-1 blind",  __('Bounce In Left', "bliccaThemes") => "bounceInLeft-1 blind", __('Bounce In Right', "bliccaThemes") => "bounceInRight-1 blind", __('Rotate In', "bliccaThemes") => "rotateIn-1 blind", __('Rotate In Down Left', "bliccaThemes") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "bliccaThemes") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "bliccaThemes") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "bliccaThemes") => "rotateInUpRight-1 blind", __('Light Speed In', "bliccaThemes") => "lightSpeedIn-1 blind", __('Roll In', "bliccaThemes") => "rollIn-1 blind", __('Special Effect 1', "bliccaThemes") => "blogeffect4-1 blind", __('Special Effect 2', "bliccaThemes") => "blogeffect5-1 blind", __('Special Effect 3', "bliccaThemes") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'bliccaThemes')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation Delay", 'bliccaThemes'),
        "param_name" => "delay",
        "description"=> __("If you write 1000, it means your animation will work after 1 second", 'bliccaThemes')
    )
   )
) );
}
/*******************/
/**** Promotion ****/
/*******************/
function bliccaThemes_promotion_elements($atts) {
   extract(shortcode_atts ( array(
    'element_title' => '',
    'element_subtitle' => '',
    'element_description' => '',
    'element_price' => '',
    'element_discount_price' => '',   
    'animation' => '',
    'delay' => ''
    ), 
   $atts));
   $mydelay = "";
   if ( $delay != '') {
      $mydelay = ' style="animation-delay: '.$delay.'ms; -moz-animation-delay: '.$delay.'ms; -webkit-animation-delay: '.$delay.'ms;"';
   }
   $element_subtitle_check = "";
   if ($element_subtitle != "") { $element_subtitle_check = '<span class="bt_promotion_sub">'.$element_subtitle.'</span>'; }
   if ($element_description != "") { $element_description = '<div class="bt_promotion_desc">'.$element_description.'</div>'; }

   return '<div class="'.$animation.' bt_promotion wpb_content_element animated"'.$mydelay.'>
   <div class="bt_promotion_title">'.$element_title.' '.$element_subtitle_check.'</div>
   <div class="bt_promotion_details">
   '.$element_description.'<div class="bt_promotion_dot"></div>
   <div class="bt_promotion_prices"><span class="bt_promotion_price">'.$element_price.'</span><span class="bt_promotion_discount">'.$element_discount_price.'</span></div>
   </div>
   </div>';
}
add_shortcode('bliccaThemes_promotion_element', 'bliccaThemes_promotion_elements');

add_action( 'vc_before_init', 'bliccaThemes_promotion_element_integrateWithVC' );
function bliccaThemes_promotion_element_integrateWithVC() {
wpb_map( array(
   "name" => __("Promotion Element", 'bliccaThemes'),
   "base" => "bliccaThemes_promotion_element",
   "class" => "",
   "category" => 'Content',    
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/visualcomposer.css'),   
   "icon" => "bliccaThemes-vc-icon", 
   "params" => array(    
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'bliccaThemes'),
        "param_name" => "element_title",
        "value" => __("Title", 'bliccaThemes'),
        "description" => __("Title for the promotion", 'bliccaThemes')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Subtitle", 'bliccaThemes'),
        "param_name" => "element_subtitle",
        "value" => __("Subtitle", 'bliccaThemes'),
        "description" => __("You can write a subtitle or leave it blank", 'bliccaThemes')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Description", 'bliccaThemes'),
        "param_name" => "element_description",
        "description" => __("Description for your promotion", 'bliccaThemes')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Price of your item", 'bliccaThemes'),
        "param_name" => "element_price",
        "value" => __("$15", 'bliccaThemes'),
        "description" => __("This is real price of your item", 'bliccaThemes')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Discounted Price", 'bliccaThemes'),
        "param_name" => "element_discount_price",
        "value" => __("$9", 'bliccaThemes'),
        "description" => __("This is discounted price of your item", 'bliccaThemes')
    ),     
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'bliccaThemes'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "bliccaThemes") => "no_animation", __('Tada', "bliccaThemes") => "tadab-1 blind", __('Flip In X', "bliccaThemes") => "flipInX-1 blind", __('Flip In Y', "bliccaThemes") => "flipInY-1 blind", __('Fade In', "bliccaThemes") => "fadeIn-1 blind", __('Fade In Up', "bliccaThemes") => "fadeInUp-1 blind", __('Fade In Down', "bliccaThemes") => "fadeInDown-1 blind", __('Fade In Left', "bliccaThemes") => "fadeInLeft-1 blind", __('Fade In Right', "bliccaThemes") => "fadeInRight-1 blind", __('Fade In Up Big', "bliccaThemes") => "fadeInUpBig-1 blind", __('Fade In Down Big', "bliccaThemes") => "fadeInDownBig-1 blind", __('Fade In Left Big', "bliccaThemes") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "bliccaThemes") => "fadeInRightBig-1 blind", __('Bounce In', "bliccaThemes") => "bounceIn-1 blind", __('Bounce In Down', "bliccaThemes") => "bounceInDown-1 blind",  __('Bounce In Left', "bliccaThemes") => "bounceInLeft-1 blind", __('Bounce In Right', "bliccaThemes") => "bounceInRight-1 blind", __('Rotate In', "bliccaThemes") => "rotateIn-1 blind", __('Rotate In Down Left', "bliccaThemes") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "bliccaThemes") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "bliccaThemes") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "bliccaThemes") => "rotateInUpRight-1 blind", __('Light Speed In', "bliccaThemes") => "lightSpeedIn-1 blind", __('Roll In', "bliccaThemes") => "rollIn-1 blind", __('Special Effect 1', "bliccaThemes") => "blogeffect4-1 blind", __('Special Effect 2', "bliccaThemes") => "blogeffect5-1 blind", __('Special Effect 3', "bliccaThemes") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'bliccaThemes')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation Delay", 'bliccaThemes'),
        "param_name" => "delay",
        "description"=> __("If you write 1000, it means your animation will work after 1 second", 'bliccaThemes')
    )
   )
) );
}
/**********************************/
/* Contact Widget for Custom Page */
/**********************************/
function bliccaThemes_template_contacts($atts) {
   extract(shortcode_atts ( array(
    'telephone' => '',
    'email' => '',
    'web' => '',
    'time' => '',
    'address' => '',
    'social' => ''
    ), 
   $atts));

   if ( function_exists( 'get_option_tree') ) {
    $theme_options = get_option('option_tree');  
}
$tel = $mail = $site = $zone = $adress = "";
$contact_social = '';
if ( get_option_tree('social_facebook', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_facebook', $theme_options).'"><div class="socialbox"><i class="fa fa-facebook"></i></div></a>';
}

if ( get_option_tree('social_twitter', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_twitter', $theme_options).'"><div class="socialbox"><i class="fa fa-twitter"></i></div></a>';
}

if ( get_option_tree('social_google', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_google', $theme_options).'"><div class="socialbox"><i class="fa fa-google-plus"></i></div></a>';
}

if ( get_option_tree('social_dribbble', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_dribbble', $theme_options).'"><div class="socialbox"><i class="fa fa-dribbble"></i></div></a>';
}

if ( get_option_tree('social_youtube', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_youtube', $theme_options).'"><div class="socialbox"><i class="fa fa-youtube"></i></div></a>';
}

if ( get_option_tree('social_vimeo', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_vimeo', $theme_options).'"><div class="socialbox"><i class="fa fa-vine"></i></div></a>';
}

if ( get_option_tree('social_linkedin', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_linkedin', $theme_options).'"><div class="socialbox"><i class="fa fa-linkedin"></i></div></a>';
}

if ( get_option_tree('social_digg', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_digg', $theme_options).'"><div class="socialbox"><i class="fa fa-digg"></i></div></a>';
}

if ( get_option_tree('social_skype', $theme_options) != '') {
  $contact_social .= '<a href="skype:'.get_option_tree('social_skype', $theme_options).'"><div class="socialbox"><i class="fa fa-skype"></i></div></a>';
}

if ( get_option_tree('social_stumbleupon', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_stumbleupon', $theme_options).'"><div class="socialbox"><i class="fa fa-stumbleupon"></i></div></a>';
}

if ( get_option_tree('social_pinterest', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_pinterest', $theme_options).'"><div class="socialbox"><i class="fa fa-pinterest"></i></div></a>';
}

if ( get_option_tree('social_flickr', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_flickr', $theme_options).'"><div class="socialbox"><i class="fa fa-flickr"></i></div></a>';
}

if ( get_option_tree('social_rss', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_rss', $theme_options).'"><div class="socialbox"><i class="fa fa-rss"></i></div></a>';
}

if ( get_option_tree('social_yahoo', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_yahoo', $theme_options).'"><div class="socialbox"><i class="fa fa-yahoo"></i></div></a>';
}
if ( get_option_tree('social_foursquare', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_foursquare', $theme_options).'"><div class="socialbox"><i class="fa fa-foursquare"></i></div></a>';
}

if ( get_option_tree('social_yelp', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_yelp', $theme_options).'"><div class="socialbox"><i class="fa fa-yelp"></i></div></a>';
}
   if( $social == 'yes') {
    $social = $contact_social;
   }

   else {
    $social = '';
   }

   if(!empty($telephone)){
   $tel ='<i class="fa fa-phone pull-left widget-icon"></i><p>'.$telephone.'</p>';
   }

   if(!empty($email)){
   $mail ='<i class="fa fa-envelope-o pull-left widget-icon"></i><p>'.$email.'</p>';
   }

   if(!empty($web)){
   $site ='<i class="fa fa-globe pull-left widget-icon"></i><p><a href="http://'.$web.'">'.$web.'</a></p>';
   }

   if(!empty($time)){
   $zone ='<i class="fa fa-clock-o pull-left widget-icon"></i><p>'.$time.'</p>';
   }

   if(!empty($telephone)){
   $adress ='<i class="fa fa-location-arrow pull-left widget-icon"></i><p>'.$address.'</p>';
   } 

   return '<div class="contact-info"><div class="contact-widget">'.$tel.$mail.$site.$zone.$adress.'</div><div class="social-widget">'.$social.'</div></div>';
}
add_shortcode('bliccaThemes_template_contact', 'bliccaThemes_template_contacts');
add_action( 'init', 'bliccaThemes_template_contact_integrateWithVC' );
function bliccaThemes_template_contact_integrateWithVC() {
wpb_map( array(
   "name" => __("Contact Info", 'bliccaThemes'),
   "base" => "bliccaThemes_template_contact",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(    

        array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Phone", 'bliccaThemes'),
        "param_name" => "telephone",
        "value" => __("", 'bliccaThemes')
        ),
        array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("E-Mail", 'bliccaThemes'),
        "param_name" => "email",
        "value" => __("", 'bliccaThemes')
        ),    
        array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Your Url", 'bliccaThemes'),
        "param_name" => "web",
        "value" => __("", 'bliccaThemes'),
        "description" => __("Dont write http://, write your url starting with www.", 'bliccaThemes')
        ),
        array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Business Hours", 'bliccaThemes'),
        "param_name" => "time",
        "value" => __("", 'bliccaThemes')
        ),
        array(
        "type" => "textarea",
        "holder" => "div",
        "class" => "",
        "heading" => __("Your Address", 'bliccaThemes'),
        "param_name" => "address",
        "value" => __("", 'bliccaThemes')
        ),
        array(
        "type" => 'checkbox',
        "heading" => __("Add your social", "bliccaThemes"),
        "param_name" => "social",
        "description" => __("Add your social to contact.", "bliccaThemes"),
        "value" => Array(__("Yes, please", "bliccaThemes") => 'yes')
    )    
    )
));
}

/***************************/
/*** Map Shortcode Address */
/***************************/
function map_config_option_text()
{}

function map_config_address(){
    printf(('<input type="text" id="map_config_address" name="map_config_address" value="%s" size="50"/>'), get_option('map_config_address'));
}

function map_config_infobox()
{
    printf(('<textarea name="map_config_infobox" id="map_config_infobox" cols="30" rows="3">%s</textarea>'), get_option('map_config_infobox'));
}

function map_config_zoom()
{
    printf(('<input name="map_config_zoom" id="map_config_zoom" value="%s" />'), get_option('map_config_zoom'));
}

function map_config_menu(){

    add_settings_section('map_config', 'Map Configuration', 'map_config_option_text', 'general');
    add_settings_field('map_config_address', 'Address - Longitude and Lattitude', 'map_config_address', 'general', 'map_config');
    add_settings_field('map_config_infobox', 'Map InfoWindow', 'map_config_infobox', 'general', 'map_config');
    add_settings_field('map_config_zoom', 'Map Zoom Level', 'map_config_zoom', 'general', 'map_config');
}
add_action('admin_menu', 'map_config_menu');



function map_init()
{
    register_setting('general', 'map_config_address');
    register_setting('general', 'map_config_infobox');
    register_setting('general', 'map_config_zoom');
}

add_action('admin_init', 'map_init');

function bliccaThemes_map(){

    wp_register_script('google-maps', 'http://maps.google.com/maps/api/js?sensor=false');
    wp_enqueue_script('google-maps');

    wp_register_script('map-css', get_template_directory_uri() . '/includes/map.js', '', '', true);
    wp_enqueue_script('map-css');

    $output = sprintf(('<div class="overlay" onClick="style.pointerEvents=\'none\'"><!-- prevent wheel zoom over map --></div><div id="map-container" data-map-infowindow="%s" data-map-zoom="%s"></div>'),

        get_option('map_config_infobox'),
        get_option('map_config_zoom')

        );
    return $output;

}
add_shortcode('bliccaThemes_map', 'bliccaThemes_map');

function bliccaThemes_directions(){

    $output = '<div id="dir-container" ></div>';
    return $output;

}
add_shortcode('bliccaThemes_directions_container', 'bliccaThemes_directions');

function bliccaThemes_directions_input(){

    $address_to = get_option('map_config_address');
    $mapadress = __( 'Enter Your Address', 'bliccaThemes');
    $output = '<section id="directions" class="widget">
                <div class="bt-marker-box"><input id="from-input" type="text" value="" size="10" placeholder="'.$mapadress.'"/>
                <select class="hidden" onchange="" id="unit-input">
                    <option value="imperial" selected="selected">Imperial</option>
                    <option value="metric">Metric</option>
                </select></div>
                <div class="bt-marker"><input id="getDirections" type="button" value="" onclick="bliccaThemes.getDirections();"/></div>
                <input id="map-config-address" type="hidden" value="' . $address_to . '"/>
               </section>';
    return $output;
}
add_shortcode('bliccaThemes_directions_input', 'bliccaThemes_directions_input');
/******************/
/**** Services ****/
/******************/
function bliccaThemes_services($atts, $content = null) {
   extract(shortcode_atts ( array(
    'style' => 'services-right', 
    'icon' => '',
    'header' => '',
    'icon_style' => 'image',
    'services_image' => '',
    'service_title_color' => '',
    'services_url' => '',
    'services_url_text' => '',
    'services_url_target' => '_blank',     
    'animation' => 'no_animation',
    'delay' => ''
    ), 
   $atts));

   $s_title_color = $s_icon_color = $s_button_color = $s_button = $add_icon = "";
   
   if ( !empty($services_url) ) {
   $s_button = '<a href="'.$services_url.'" target="'.$services_url_target.'" class="services-button">'.$services_url_text.'</a>';
   }
   $mydelay = '';
   if ( $delay != '') {
    $mydelay = ' style="animation-delay: '.$delay.'ms; -moz-animation-delay: '.$delay.'ms; -webkit-animation-delay: '.$delay.'ms;"';
   }

   if ( $icon_style == "image" ) {
      $img_id = preg_replace('/[^\d]/', '', $services_image);
      $image_url = wp_get_attachment_image_src( $img_id, 'full');
      $image_url = $image_url[0]; 
      $add_icon = '<div class="holder-image"><img src="'.$image_url.'" alt="services"></div>'; 
   }
   
   if ( $icon_style == "font-icon") {
       $add_icon = '<div class="holder"><i class="fa fa-'.$icon.'"></i></div>'; 
   }
  
   if ( $style == "services-right") {
  return '<div class="'.$animation.' services-right wpb_content_element animated"'.$mydelay.'>
            <div class="services-right-content">'.$add_icon.'<h4>'.$header.'</h4><p>'.do_shortcode($content).'</p>'.$s_button.'</div>
         </div>'; 
   }
  
   if ( $style == "services-left") {
  return '<div class="'.$animation.' services-left wpb_content_element animated"'.$mydelay.'>   
            <div class="services-left-content">'.$add_icon.'<h4>'.$header.'</h4><p>'.do_shortcode($content).'</p>'.$s_button.'</div>
         </div>'; 
   }

   if ( $style == "services-top") {
  return '<div class="'.$animation.' services-top wpb_content_element animated"'.$mydelay.'>   
            <div class="services-top-content">'.$add_icon.'<h4>'.$header.'</h4><p>'.do_shortcode($content).'</p>'.$s_button.'</div>
         </div>';
   }

}
add_shortcode('bliccaThemes_service', 'bliccaThemes_services');

add_action( 'vc_before_init', 'bliccaThemes_services_integrateWithVC' );
function bliccaThemes_services_integrateWithVC() {
wpb_map( array(
   "name" => __("Services", 'bliccaThemes'),
   "base" => "bliccaThemes_service",
   "class" => "",
   "category" => 'Content',    
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/visualcomposer.css'),   
   "icon" => "bliccaThemes-vc-icon", 
   "params" => array(    

    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Services Style", 'bliccaThemes'),
        "param_name" => "style",
        "value" => array(__('Icon on Right', "bliccaThemes") => "services-right", __('Icon on Left', "bliccaThemes") => "services-left", __('Icon on Top', "bliccaThemes") => "services-top"),
        "description" => __("Choose your service icon placement", 'bliccaThemes')
    ),
   array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Icon or Image", 'bliccaThemes'),
        "param_name" => "icon_style",
        "value" => array( __('Image', "bliccaThemes") => "image", __('Font Icon', "bliccaThemes") => "font-icon"),
        "description" => __("You can add image or icon to your services", 'bliccaThemes')
    ),
    array(
      "type" => "attach_image",
      "heading" => __('Image', 'bliccaThemes'),
      "param_name" => "services_image",
      "dependency" => Array('element' => "icon_style", 'value' => array('image')),         
      "description" => __("Select image for your services widget", "bliccaThemes")
    ),        

    array(
        "type" => "icon",
        "class" => "",
        "heading" => __("Select Icon:", "bliccaThemes"),
        "param_name" => "icon",
        "dependency" => Array('element' => "icon_style", 'value' => array('font-icon')),         
        "admin_label" => true,        
        "value" => "adjust",
        "description" => __("Select the icon from the list.", "bliccaThemes")
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'bliccaThemes'),
        "param_name" => "header",
        "value" => __("Title", 'bliccaThemes'),
        "description" => __("Title for the service", 'bliccaThemes')
    ),

    array(
        "type" => "textarea_html",
        "holder" => "div",
        "class" => "",
        "heading" => __("Box Content", 'bliccaThemes'),
        "param_name" => "content",
        "value" => __("This is your Content", 'bliccaThemes'),
        "description" => __("Content of the service", 'bliccaThemes')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Button Link URL", 'bliccaThemes'),
        "param_name" => "services_url",
        "value" => "",
        "description" => __("If you dont want to add button, leave this area blank", 'bliccaThemes')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Link Text", 'bliccaThemes'),
        "param_name" => "services_url_text",
        "value" => __("Read More", 'bliccaThemes'),
        "description" => __("Lin text", 'bliccaThemes')
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Link Target", 'bliccaThemes'),
        "param_name" => "services_url_target",
        "value" => array(__('New Page', "bliccaThemes") => "_blank", __('Self Page', "bliccaThemes") => "_self"),
        "description" => __("Choose your link target.", 'bliccaThemes')
    ),     
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'bliccaThemes'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "bliccaThemes") => "no_animation", __('Tada', "bliccaThemes") => "tadab-1 blind", __('Flip In X', "bliccaThemes") => "flipInX-1 blind", __('Flip In Y', "bliccaThemes") => "flipInY-1 blind", __('Fade In', "bliccaThemes") => "fadeIn-1 blind", __('Fade In Up', "bliccaThemes") => "fadeInUp-1 blind", __('Fade In Down', "bliccaThemes") => "fadeInDown-1 blind", __('Fade In Left', "bliccaThemes") => "fadeInLeft-1 blind", __('Fade In Right', "bliccaThemes") => "fadeInRight-1 blind", __('Fade In Up Big', "bliccaThemes") => "fadeInUpBig-1 blind", __('Fade In Down Big', "bliccaThemes") => "fadeInDownBig-1 blind", __('Fade In Left Big', "bliccaThemes") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "bliccaThemes") => "fadeInRightBig-1 blind", __('Bounce In', "bliccaThemes") => "bounceIn-1 blind", __('Bounce In Down', "bliccaThemes") => "bounceInDown-1 blind",  __('Bounce In Left', "bliccaThemes") => "bounceInLeft-1 blind", __('Bounce In Right', "bliccaThemes") => "bounceInRight-1 blind", __('Rotate In', "bliccaThemes") => "rotateIn-1 blind", __('Rotate In Down Left', "bliccaThemes") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "bliccaThemes") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "bliccaThemes") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "bliccaThemes") => "rotateInUpRight-1 blind", __('Light Speed In', "bliccaThemes") => "lightSpeedIn-1 blind", __('Roll In', "bliccaThemes") => "rollIn-1 blind", __('Special Effect 1', "bliccaThemes") => "blogeffect4-1 blind", __('Special Effect 2', "bliccaThemes") => "blogeffect5-1 blind", __('Special Effect 3', "bliccaThemes") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'bliccaThemes')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation Delay", 'bliccaThemes'),
        "param_name" => "delay",
        "description"=> __("If you write 1000, it means your animation will work after 1 second", 'bliccaThemes')
    )
   )
) );
}

/***************************/
/* Visual Composer Updates */
/***************************/
add_action( 'wp_loaded', 'bliccaThemes_overwrite_shortcode' );
function bliccaThemes_overwrite_shortcode() 
{   
/* Row Setting Parallax and Video */
$setting_row = array (
    "params" => array(
     array(
      "type" => "colorpicker",
      "heading" => __("Custom Background Color", "bliccaThemes"),
      "param_name" => "bg_color",
      "edit_field_class" => "vc_col-sm-12 vc_column vc_shortcode-param",
      "description" => __("Select backgound color for your row", "bliccaThemes"),
    ),
    array(
      "type" => "colorpicker",
      "heading" => __('Font Color', 'bliccaThemes'),
      "param_name" => "font_color",
      "edit_field_class" => "vc_col-sm-12 vc_column vc_shortcode-param",      
      "description" => __("Select font color", "bliccaThemes"),
    ),
    array(
      "type" => "textfield",
      "heading" => __('Padding', 'bliccaThemes'),
      "param_name" => "padding",
      "edit_field_class" => "vc_col-sm-12 vc_column vc_shortcode-param",      
      "description" => __("You can use px, em, %, etc. or enter just number and it will use pixels. ", "bliccaThemes"),
    ),
    array(
      "type" => "textfield",
      "heading" => __('Bottom margin', 'bliccaThemes'),
      "param_name" => "margin_bottom",
      "edit_field_class" => "vc_col-sm-12 vc_column vc_shortcode-param",      
      "description" => __("You can use px, em, %, etc. or enter just number and it will use pixels. ", "bliccaThemes"),
    ),
    array(
      "type" => "attach_image",
      "heading" => __('Background Image', 'bliccaThemes'),
      "param_name" => "bg_image",
      "description" => __("Select background image for your row", "bliccaThemes")
    ),
    array(
      "type" => "dropdown",
      "heading" => __('Background Repeat', 'bliccaThemes'),
      "param_name" => "bg_image_repeat",
      "value" => array(
                        __("Default", 'bliccaThemes') => '',
                        __("Cover", 'bliccaThemes') => 'cover',
                        __('Contain', 'bliccaThemes') => 'contain',
                        __('No Repeat', 'bliccaThemes') => 'no-repeat'
                      ),
      "description" => __("Select how a background image will be repeated", "bliccaThemes"),
      "dependency" => Array('element' => "bg_image", 'not_empty' => true)
    ),
    array(
      "type" => "dropdown",
      "heading" => __('Parallax Background or Video Background?', 'bliccaThemes'),
      "param_name" => "new_background",
      "value" => array(
                        __("Default", 'bliccaThemes') => 'default',
                        __("Parallax", 'bliccaThemes') => 'parallax',
                        __('Video', 'bliccaThemes') => 'video'
                      ),
      "description" => __("You can use parallax background or video background instead of standart image or color", "bliccaThemes")
    ),

    array(
      "type" => "textfield",
      "heading" => __("Video MP4 URL", "bliccaThemes"),
      "param_name" => "video_url",
      "description" => __("Add your video url, mp4 file type.", "bliccaThemes"),
      "dependency" => Array('element' => "new_background", 'value' => array('video'))
    ),      
    array(
        "type" => "textfield",
        "heading" => __("Video .webm URL", "bliccaThemes"),
        "param_name" => "video_url_webm",
        "description" => __("Add your video url, webm file type.", "bliccaThemes"),
        "dependency" => Array('element' => "new_background", 'value' => array('video'))
    ),
    array(
        "type" => "textfield",
        "heading" => __("Video .ogv URL", "bliccaThemes"),
        "param_name" => "video_url_ogv",
        "description" => __("Add your video url, webm file type.", "bliccaThemes"),
        "dependency" => Array('element' => "new_background", 'value' => array('video'))
    ),
    array(
      "type" => "textfield",
      "heading" => __("Parallax Image Ratio", "bliccaThemes"),
      "param_name" => "image_ratio",
      "description" => __("You need set your parallax effects ratio, please write a number between -0.9 to 0.9, example: 0.8 or 0.1", "bliccaThemes"),
      "dependency" => Array('element' => "new_background", 'value' => array('parallax'))
    ),
    array(
      "type" => "checkbox",
      "heading" => __("Full Width", "bliccaThemes"),
      "param_name" => "full_width",
      "description" => __("If you wish to use full width row, click it", "bliccaThemes"),
      'value' => array( __( 'Yes, please', 'bliccaThemes' ) => 'yes' )
    ),
    array(
      "type" => "dropdown",
      "heading" => __('Textalign for Row', 'bliccaThemes'),
      "param_name" => "new_textalign",
      "value" => array(
                        __("Default", 'bliccaThemes') => 'default',
                        __("Left", 'bliccaThemes') => 'bt_textleft',
                        __('Center', 'bliccaThemes') => 'bt_textcenter',
                        __('Right', 'bliccaThemes') => 'bt_textright'
                      ),
      "description" => __("This will not effect all items that you have added on row. Some items may use their default value. You can create textbox in your row and set textalign in editor", "bliccaThemes")
    ),
    array(
      'type' => 'el_id',
      'heading' => __( 'Row ID', 'js_composer' ),
      'param_name' => 'el_id',
      'description' => sprintf( __( 'Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
    ),          
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "bliccaThemes"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "bliccaThemes")
    )
  )
);
vc_map_update('vc_row', $setting_row);

$attributes = array(
      "type" => "colorpicker",
      "heading" => __('Font Color', 'bliccaThemes'),
      "param_name" => "font_color",
      "edit_field_class" => "vc_col-sm-12 vc_column vc_shortcode-param",      
      "description" => __("Select font color", "bliccaThemes")
);
vc_add_param( 'vc_text_separator', $attributes ); 
$attributes2 = array(
    'type' => 'dropdown',
    'heading' =>  __('Font Size', 'bliccaThemes'),
    'param_name' => 'font_size',
    'value' => array( "40px", "36px", "32px", "28px", "24px", "20px", "16px" ),
    'description' => __( "Select font-size", "bliccaThemes" )
);
vc_add_param( 'vc_text_separator', $attributes2 );
/*********************/
/*   Icons Param     */
/*********************/
function icon_settings_field($settings, $value)
    {
      $dependency = vc_generate_dependencies_attributes($settings);
      $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
      $type = isset($settings['type']) ? $settings['type'] : '';
      $class = isset($settings['class']) ? $settings['class'] : '';
      $icons = array('adjust','adn','align-center','align-justify','align-left','align-right','ambulance','anchor','android','angle-double-down','angle-double-left','angle-double-right','angle-double-up','angle-down','angle-left','angle-right','angle-up','apple','archive','arrow-circle-down','arrow-circle-left','arrow-circle-o-down','arrow-circle-o-left','arrow-circle-o-right','arrow-circle-o-up','arrow-circle-right','arrow-circle-up','arrow-down','arrow-left','arrow-right','arrow-up','arrows','arrows-alt','arrows-h','arrows-v','asterisk','automobile','backward','ban','bank','bar-chart-o','barcode','bars','beer','behance','behance-square','bell','bell-o','bitbucket','bitbucket-square','bitcoin','bold','bolt','bomb','book','bookmark','bookmark-o','briefcase','btc','bug','building','building-o','bullhorn','bullseye','cab','calendar','calendar-o','camera','camera-retro','car','caret-down','caret-left','caret-right','caret-square-o-down','caret-square-o-left','caret-square-o-right','caret-square-o-up','caret-up','certificate','chain','chain-broken','check','check-circle','check-circle-o','check-square','check-square-o','chevron-circle-down','chevron-circle-left','chevron-circle-right','chevron-circle-up','chevron-down','chevron-left','chevron-right','chevron-up','child','circle','circle-o','circle-o-notch','circle-thin','clipboard','clock-o','cloud','cloud-download','cloud-upload','cny','code','code-fork','codepen','coffee','cog','cogs','columns','comment','comment-o','comments','comments-o','compass','compress','copy','credit-card','crop','crosshairs','css3','cube','cubes','cut','cutlery','dashboard','database','dedent','delicious','desktop','deviantart','digg','dollar','dot-circle-o','download','dribbble','dropbox','drupal','edit','eject','ellipsis-h','ellipsis-v','empire','envelope','envelope-o','envelope-square','eraser','eur','euro','exchange','exclamation','exclamation-circle','exclamation-triangle','expand','external-link','external-link-square','eye','eye-slash','facebook','facebook-square','fast-backward','fast-forward','fax','female','fighter-jet','file','file-archive-o','file-audio-o','file-code-o','file-excel-o','file-image-o','file-movie-o','file-o','file-pdf-o','file-photo-o','file-picture-o','file-powerpoint-o','file-sound-o','file-text','file-text-o','file-video-o','file-word-o','file-zip-o','files-o','film','filter','fire','fire-extinguisher','flag','flag-checkered','flag-o','flash','flask','flickr','floppy-o','folder','folder-o','folder-open','folder-open-o','font','forward','foursquare','frown-o','gamepad','gavel','gbp','ge','gear','gears','gift','git','git-square','github','github-alt','github-square','gittip','glass','globe','google','google-plus','google-plus-square','graduation-cap','group','h-square','hacker-news','hand-o-down','hand-o-left','hand-o-right','hand-o-up','hdd-o','header','headphones','heart','heart-o','history','home','hospital-o','html5','image','inbox','indent','info','info-circle','inr','instagram','institution','italic','joomla','jpy','jsfiddle','key','keyboard-o','krw','language','laptop','leaf','legal','lemon-o','level-down','level-up','life-bouy','life-ring','life-saver','lightbulb-o','link','linkedin','linkedin-square','linux','list','list-alt','list-ol','list-ul','location-arrow','lock','long-arrow-down','long-arrow-left','long-arrow-right','long-arrow-up','magic','magnet','mail-forward','mail-reply','mail-reply-all','male','map-marker','maxcdn','medkit','meh-o','microphone','microphone-slash','minus','minus-circle','minus-square','minus-square-o','mobile','mobile-phone','money','moon-o','mortar-board','music','navicon','openid','outdent','pagelines','paper-plane','paper-plane-o','paperclip','paragraph','paste','pause','paw','pencil','pencil-square','pencil-square-o','phone','phone-square','photo','picture-o','pied-piper','pied-piper-alt','pied-piper-square','pinterest','pinterest-square','plane','play','play-circle','play-circle-o','plus','plus-circle','plus-square','plus-square-o','power-off','print','puzzle-piece','qq','qrcode','question','question-circle','quote-left','quote-right','ra','random','rebel','recycle','reddit','reddit-square','refresh','renren','reorder','repeat','reply','reply-all','retweet','rmb','road','rocket','rotate-left','rotate-right','rouble','rss','rss-square','rub','ruble','rupee','save','scissors','search','search-minus','search-plus','send','send-o','share','share-alt','share-alt-square','share-square','share-square-o','shield','shopping-cart','sign-in','sign-out','signal','sitemap','skype','slack','sliders','smile-o','sort','sort-alpha-asc','sort-alpha-desc','sort-amount-asc','sort-amount-desc','sort-asc','sort-desc','sort-down','sort-numeric-asc','sort-numeric-desc','sort-up','soundcloud','space-shuttle','spinner','spoon','spotify','square','square-o','stack-exchange','stack-overflow','star','star-half','star-half-empty','star-half-full','star-half-o','star-o','steam','steam-square','step-backward','step-forward','stethoscope','stop','strikethrough','stumbleupon','stumbleupon-circle','subscript','suitcase','sun-o','superscript','support','table','tablet','tachometer','tag','tags','tasks','taxi','tencent-weibo','terminal','text-height','text-width','th','th-large','th-list','thumb-tack','thumbs-down','thumbs-o-down','thumbs-o-up','thumbs-up','ticket','times','times-circle','times-circle-o','tint','toggle-down','toggle-left','toggle-right','toggle-up','trash-o','tree','trello','trophy','truck','try','tumblr','tumblr-square','turkish-lira','twitter','twitter-square','umbrella','underline','undo','university','unlink','unlock','unlock-alt','unsorted','upload','usd','user','user-md','users','video-camera','vimeo-square','vine','vk','volume-down','volume-off','volume-up','warning','wechat','weibo','weixin','wheelchair','windows','won','wordpress','wrench','xing','xing-square','yahoo','yen','youtube','youtube-play','youtube-square');
    
      $output = '<input type="hidden" name="'.$param_name.'" class="wpb_vc_param_value grab'.$param_name.' '.$type.' '.$class.'" value="'.$value.'" id="grab"/>
          <div class="icon-preview"><i class=" fa fa-'.$value.'"></i></div>';
      $output .='<input class="search" type="text" placeholder="Search" />';
      $output .='<div class="icon-dropdown" >';
      $output .= '<ul class="icon-list">';
      $a = 1;
      foreach($icons as $icon)
      {
        $selected = ($icon == $value) ? 'class="selected"' : '';
        $id = 'icon-'.$a;
        $output .= '<li '.$selected.' data-icon="'.$icon.'"><i class="icon fa fa-'.$icon.'"></i><label class="icon">'.$icon.'</label></li>';
        $a++;
      }
      $output .='</ul>';
      $output .='</div>';
      
      return $output;
    }
add_shortcode_param('icon', 'icon_settings_field', get_template_directory_uri().'/js/visualcomposer.js');
                                       
}
}