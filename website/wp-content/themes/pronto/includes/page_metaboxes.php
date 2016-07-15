<?php
function bliccaThemes_featured_add_a_metabox() {
	add_meta_box(
		'featured_metabox', // metabox ID, it also will be it id HTML attribute
		'Featured Post?', // title
		'bliccaThemes_featured_metashow', // this is a callback functions, which will be print HTML of our metabox
		'post', // post type
		'normal', // position of the screen where metabox shoul be displayed (normal, side, advanced)
		'default' // priority over another metaboxes on this page (default, low, high, core)
	);
}
 
add_action( 'admin_menu', 'bliccaThemes_featured_add_a_metabox' );

function bliccaThemes_featured_metashow($post) {
	/*
	 * needs for security checks
	 */
	wp_nonce_field( basename( __FILE__ ), 'featured_metabox_nonce' );

	/*
	 * add a checkbox
	 */
	$html  = '<p><label><input type="checkbox" name="featured"';
	$html .= (get_post_meta($post->ID, 'bliccaThemes_featured',true) == 'on') ? ' checked="checked"' : '';
	$html .= ' /> Check this show featured posts on Alternative Style Blog</label></p>';
	/*
	 * print all of this
	 */
	echo $html;
}

function bliccaThemes_featured_save_post_meta( $post_id, $post ) {
	/* 
	 * Security checks
	 */
	if ( !isset( $_POST['featured_metabox_nonce'] ) || !wp_verify_nonce( $_POST['featured_metabox_nonce'], basename( __FILE__ ) ) )
		return $post_id;
	/* 
	 * Check current user permissions
	 */
	$post_type = get_post_type_object( $post->post_type );
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;
	/*
	 * Check if the autosave
	 */
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;
 
	if ($post->post_type == 'post') { // define your own post type here
		update_post_meta($post_id, 'bliccaThemes_featured', $_POST['featured']);
	}
	return $post_id;
}
 
add_action( 'save_post', 'bliccaThemes_featured_save_post_meta', 10, 2 );

/*********************************/
/* Adds a box to the main column on the Post and Page edit screens. */
/**************************************/
function bliccaThemes_add_meta_box() {

	$screens = array( 'page' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'bliccaThemes_sectionid',
			__( 'Page Options', 'bliccaThemes' ),
			'bliccaThemes_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'bliccaThemes_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function bliccaThemes_meta_box_callback() {
  global $post;
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="bliccaThemespage_noncename" id="bliccaThemespage_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	wp_enqueue_script('wp-color-picker');
    wp_enqueue_style( 'wp-color-picker' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	
	$bliccaThemes_page_subtitle = get_post_meta( $post->ID, '_bliccaThemes_page_subtitle', true );
	$bliccaThemes_page_color = get_post_meta( $post->ID, '_bliccaThemes_page_color', true );
  	$bliccaThemes_page_back = get_post_meta( $post->ID, '_bliccaThemes_page_back', true );
  	$bliccaThemes_page_caption = get_post_meta( $post->ID, '_bliccaThemes_page_caption', true);
  
	echo '<label for="bliccaThemes_page_subtitle">';
	_e( 'Your Page Subtitle', 'bliccaThemes' );
	echo '</label><br>';
	echo '<input type="text" id="bliccaThemes_page_subtitle" name="_bliccaThemes_page_subtitle" value="' . esc_attr( $bliccaThemes_page_subtitle ) . '" size="60" /><br>';

	echo '<label for="bliccaThemes_page_color">';
	_e( 'Your Titles Color', 'bliccaThemes' );
	echo '</label><br>';
	echo '<input type="text" id="bliccaThemes_page_color" name="_bliccaThemes_page_color" value="' . esc_attr( $bliccaThemes_page_color ) . '" data-default-color="#ffffff" /><br>';
  
  echo '<label for="bliccaThemes_page_back">';
	_e( 'If you dont set featured image, you can use background color', 'bliccaThemes' );
	echo '</label><br>';
	echo '<input type="text" id="bliccaThemes_page_back" name="_bliccaThemes_page_back" value="' . esc_attr( $bliccaThemes_page_back ) . '" data-default-color="#ffffff" /><br>';
  
  echo '<label for="bliccaThemes_page_caption">';
	_e( 'Your Caption Height', 'bliccaThemes' );
	echo '</label><br>';
	echo '<input type="text" id="bliccaThemes_page_caption" name="_bliccaThemes_page_caption" value="' . esc_attr( $bliccaThemes_page_caption ) . '" size="60" placeholder="422" /><br>';
	?>
	<script type="text/javascript">
    jQuery(document).ready(function($) {   
        $('#bliccaThemes_page_color').wpColorPicker();
        $('#bliccaThemes_page_back').wpColorPicker();
    });             
    </script>
    <?php		
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function bliccaThemes_save_meta_box_data($post_id, $post) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	if ( isset($_POST['bliccaThemespage_noncename']) && !wp_verify_nonce( $_POST['bliccaThemespage_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	/* OK, it's safe for us to save the data now. */
	
	$page_set_array = array();
	// Make sure that it is set.
	
	if ( isset($_POST['_bliccaThemes_page_subtitle'])) {
	$page_set_array['_bliccaThemes_page_subtitle'] = $_POST['_bliccaThemes_page_subtitle'];}
  if ( isset($_POST['_bliccaThemes_page_color'])) {
	$page_set_array['_bliccaThemes_page_color'] = $_POST['_bliccaThemes_page_color'];}
	if ( isset($_POST['_bliccaThemes_page_back'])) {
	$page_set_array['_bliccaThemes_page_back'] = $_POST['_bliccaThemes_page_back'];}
  if ( isset($_POST['_bliccaThemes_page_caption'])) {
	$page_set_array['_bliccaThemes_page_caption'] = $_POST['_bliccaThemes_page_caption'];}
  
	foreach ($page_set_array as $key => $value) { // Cycle through the $events_meta array!
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
add_action('save_post', 'bliccaThemes_save_meta_box_data', 1, 2); // save the custom fields