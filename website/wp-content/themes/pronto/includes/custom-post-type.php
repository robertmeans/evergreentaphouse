<?php
/*********************/
/* Post Type         */
/*********************/

add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'quote' , 'link' ) );


/* Create Metabox for Video Post Type */
$bliccaThemes_post_metabox = array(
    'youtube_link_url' => array(
        'title' => __('Video Link', 'bliccaThemes'),
        'applicableto' => 'post',
        'location' => 'normal',
        'display_condition' => 'post-format-video',
        'priority' => 'low',
        'fields' => array(
            'l_url' => array(
                'title' => __('YouTube Url:', 'bliccaThemes'),
                'type' => 'text',
                'description' => 'Paste your url, not embed code',
                'size' => 80
            ),

            'v_url' => array(
                'title' => __('Vimeo Url:', 'bliccaThemes'),
                'type' => 'text',
                'description' => 'Paste your url, not embed code',
                'size' => 80
            ),
            
            'cv_url' => array(
                'title' => __('Custom Video Url:', 'bliccaThemes'),
                'type' => 'text',
                'description' => 'Paste your video url',
                'size' => 80
            )
        )
    ),

    'audio_link_url' => array(
        'title' => __('Audio Link', 'bliccaThemes'),
        'applicableto' => 'post',
        'location' => 'normal',
        'display_condition' => 'post-format-audio',
        'priority' => 'low',
        'fields' => array(
          
            'c_url' => array(
                'title' => __('Custom Url:', 'bliccaThemes'),
                'type' => 'text',
                'description' => 'Paste your custom audio url',
                'size' => 80
            ),
            'a_url' => array(
                'title' => __('Soundcloud Widget Code:', 'bliccaThemes'),
                'type' => 'textarea',
                'description' => 'Paste your soundcloud widget code, not url',
                'size' => 100
            )
        )

    ),

    'gallery_format_type' => array(
        'title' => __('Gallery Style', 'bliccaThemes'),
        'applicableto' => 'post',
        'location' => 'normal',
        'display_condition' => 'post-format-gallery',
        'priority' => 'low',
        'fields' => array(
          
            'gallery_format_style' => array(
                'title' => __('Choose Style:', 'bliccaThemes'),
                'type' => 'select',
                'description' => 'Choose your gallery style',
                'options' => array (
                            'grid' => array (
                                'label' => 'Grid',
                                'value' => 'grid'
                            ),
                            'slider' => array (
                                'label' => 'Slider',
                                'value' => 'slider'
                            )
                            )
            )
        )

    ),    
);

add_action( 'admin_init', 'bliccaThemes_add_post_format_metabox' );
 
function bliccaThemes_add_post_format_metabox() {
    global $bliccaThemes_post_metabox;
 
    if ( !empty( $bliccaThemes_post_metabox ) ) {
        foreach ( $bliccaThemes_post_metabox as $id => $metabox ) {
            add_meta_box( $id, $metabox['title'], 'bliccaThemes_show_metaboxes', $metabox['applicableto'], $metabox['location'], $metabox['priority'], $id );
        }
    }
}

/* Show Metabox */

function bliccaThemes_show_metaboxes( $post, $args ) {
    global $bliccaThemes_post_metabox;
    
    $custom = get_post_custom( $post->ID );
    $fields = $tabs = $bliccaThemes_post_metabox[$args['id']]['fields'];

    /** Nonce **/
    echo '<input type="hidden" name="post_format_meta_box_nonce" value="' . wp_create_nonce( basename( __FILE__ ) ) . '" />';
 
    if ( sizeof( $fields ) ) {
        foreach ( $fields as $id => $field ) {
            $meta = get_post_meta($post->ID, $id, true);
            switch ( $field['type'] ) {
                default:
                case "text":
                    if (empty($custom[$id][0])) { $custom[$id][0] = "";}
                    echo '<label for="' . esc_attr($id) . '">' . esc_attr($field['title']) . '</label><br><input id="' . esc_attr($id) . '" type="text" name="' . $id . '" value="' . esc_url($custom[$id][0]) . '" size="' . esc_attr($field['size']) . '" /><br>'. esc_attr($field['description']) . '<br><br>';
                    
                    break; 
                case "select":

                    echo '<select name="' . $id . '" id="' . $id . '">';
                        foreach ($field['options'] as $option) {
                            echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
                        }
                        echo '</select><br /><span class="description">'.esc_attr($field['description']).'</span>';
                    break;
                case "textarea":
                    if (empty($custom[$id][0])) { $custom[$id][0] = "";}
                    echo '<label for="' . esc_attr($id) . '">' . esc_attr($field['title']) . '</label><br><textarea id="' . esc_attr($id) . '" name="' . esc_attr($id) . '" style="width:100%;height:150px;">' . $custom[$id][0] . '</textarea><br>'. esc_attr($field['description']) . '<br><br>';  
                    break;                  
            }
        }
    }
 

}

/* Save Metabox */
add_action( 'save_post', 'bliccaThemes_save_metaboxes' );
 
function bliccaThemes_save_metaboxes( $post_id ) {
    global $bliccaThemes_post_metabox;
 
    // verify nonce
    if ( isset($_POST['post_format_meta_box_nonce']) && !wp_verify_nonce( $_POST['post_format_meta_box_nonce'], basename( __FILE__ ) ) )
        return $post_id;
 
    // check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;
 
    // check permissions
    if ( 'page' == isset($_POST['post_type'] )) {
        if ( !current_user_can( 'edit_page', $post_id ) )
            return $post_id;
    } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }
 
    $post_type = get_post_type();
 
    // loop through fields and save the data
    foreach ( $bliccaThemes_post_metabox as $id => $metabox ) {
        // check if metabox is applicable for current post type
        if ( $metabox['applicableto'] == $post_type ) {
            $fields = $bliccaThemes_post_metabox[$id]['fields'];
 
            foreach ( $fields as $id => $field ) {
                $old = get_post_meta( $post_id, $id, true );
                //
                // Sanitization All User's Field
                //
                if ($field['type'] == "select" ) {
                $new = esc_attr($_POST[$id]);  
                }
								elseif ($field['type'] == "textarea") {
                $new = $_POST[$id];  
                }
                else {
                $new = esc_url_raw($_POST[$id]);
 								}
                if ( $new && $new != $old ) {
                    update_post_meta( $post_id, $id, $new );
                }
                elseif ( '' == $new && $old || !isset( $_POST[$id] ) ) {
                    delete_post_meta( $post_id, $id, $old );
                }
            }
        }
    }
}

/* Show Metabox to Format */

add_action( 'admin_print_scripts', 'bliccaThemes_display_metaboxes', 1000 );
function bliccaThemes_display_metaboxes() {
    global $bliccaThemes_post_metabox;
    if ( get_post_type() == "post" ) :
        ?>
        <script type="text/javascript">// <![CDATA[
            $ = jQuery;
 
            <?php
            $formats = $ids = array();
            foreach ( $bliccaThemes_post_metabox as $id => $metabox ) {
                array_push( $formats, "'" . $metabox['display_condition'] . "': '" . $id . "'" );
                array_push( $ids, "#" . $id );
            }
            ?>
 
            var formats = { <?php echo implode( ',', $formats );?> };
            var ids = "<?php echo implode( ',', $ids ); ?>";
            function displayMetaboxes() {
                // Hide all post format metaboxes
                $(ids).hide();
                // Get current post format
                var selectedElt = $("input[name='post_format']:checked").attr("id");
 
                // If exists, fade in current post format metabox
                if ( formats[selectedElt] )
                    $("#" + formats[selectedElt]).fadeIn();
            }
 
            $(function() {
                // Show/hide metaboxes on page load
                displayMetaboxes();
 
                // Show/hide metaboxes on change event
                $("input[name='post_format']").change(function() {
                    displayMetaboxes();
                });
            });
 
        // ]]></script>
        <?php
    endif;
}
/************************************/
/* bliccaThemes Video Post Function */
/************************************/

function bliccaThemes_video( $height ) {
    //
    // Escaped
    //    
    $video_url = esc_url(get_post_meta( get_the_ID(), 'l_url', true ));
    $vimeo_url = esc_url(get_post_meta( get_the_ID(), 'v_url', true ));
    $custom_video = esc_url(get_post_meta ( get_the_ID(), 'cv_url', true));
    //
    // Escaped
    //
    if ( !empty($video_url)) {
        $embed_url = explode("?v=", $video_url);
        $new_url = $embed_url[1];
        if (empty($embed_url[1])) { $embed_url[1]=""; }
        if ($embed_url != "") {?>
        <iframe width="100%" height="<?php echo esc_attr($height);?>" src="http://www.youtube.com/embed/<?php echo esc_attr($new_url); ?>?wmode=opaque" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
<?php   }}
    else if ( !empty($vimeo_url) ) {
        $video_url = get_post_meta( get_the_ID(), 'v_url', true );
        $embed_url = explode("com/", $video_url);
        if (empty($embed_url[1])) { $embed_url[1]=""; }
        $new_url = $embed_url[1];
        if ($new_url != "") {?> 
        <iframe width="100%" height="<?php echo esc_attr($height);?>" src="http://player.vimeo.com/video/<?php echo esc_attr($new_url); ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
<?php   }}
    else if ( !empty($custom_video) ) {     
        if (has_post_thumbnail() ) {
        $thumb = get_post_thumbnail_id(); 
        $image = vt_resize( $thumb, '', 940, 450, true );
        }
      
        else { $image['url'] = ""; }
      ?><div class="bliccaThemes_custom_video"><?php
        echo do_shortcode('[video width="750px" src="'.$custom_video.'" poster="'.$image['url'].'"]');
      ?></div><?php
      }
}

/************************************/
/* bliccaThemes Audio Post Function */
/************************************/

function bliccaThemes_audio () {
    $audio_url = $custom_url = "";
    //
    // Escaped
    //
    $audio_url = get_post_meta ( get_the_ID(), 'a_url', true );
    $custom_url = esc_url(get_post_meta ( get_the_ID(), 'c_url', true));
    if(!empty($audio_url)) {
    echo $audio_url;
    }
    else if (!empty($custom_url)) {
    ?><div class="bliccaThemes_custom_audio"><?php
    echo do_shortcode('[audio src="'.$custom_url.'"]');
    ?></div> <?php }    
}

/***************************************/
/* bliccaThemes Gallery Post Function  */
/***************************************/
function bliccaThemes_gallery ($id) {
    $gallery_style = get_post_meta ( get_the_ID(), 'gallery_format_style', true );
    $gallery_class = $thumbsizer = "";
    if ( $gallery_style == "grid" ) { 
       $gallery_class = "post-grid-thumbnails";
       $thumbsizer = "bliccaThemes-grid";       
    }
    else {
       $gallery_class = "post-slider";
       $thumbsizer = "post-thumbnails";
    }
    if(class_exists('MultiPostThumbnails')) { ?>
    <div class="<?php echo esc_attr($gallery_class); ?>">
    <ul class="slides">
        <?php 
        if ( has_post_thumbnail() ) {

            $post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
            $thumb_post = get_post($post_thumbnail_id);
            // ESC
            // 
            $src_url = esc_url($thumb_post->guid);
            $caption = trim(strip_tags( $thumb_post->post_excerpt ));
            if ( !empty( $caption )) {
                $caption = '<div class="bliccaThemes-caption">'.esc_attr($caption).'</div>';
            }
            else {
                $caption = "";
            }
            echo '<li><a href="'.$src_url.'" class="prettyPhoto" data-rel="prettyPhoto">' . get_the_post_thumbnail($id, $thumbsizer) . '</a>'.$caption.'</li>'; 
            }
        ?>
                <?php 
                   if (class_exists('MultiPostThumbnails')) : $image = MultiPostThumbnails::get_the_post_thumbnail( get_post_type(), 'secondary-image', NULL, $thumbsizer); endif; if(!empty($image)) { 
                        $post_thumbnail_id = MultiPostThumbnails::get_post_thumbnail_id( get_post_type(), 'secondary-image', get_the_ID() );
                        $thumb_post = get_post($post_thumbnail_id);
                        $src_url = esc_url($thumb_post->guid);
                        $caption = trim(strip_tags( $thumb_post->post_excerpt ));
                        if ( !empty( $caption )) {
                            $caption = '<div class="bliccaThemes-caption">'.esc_attr($caption).'</div>';
                        }
                        else {
                            $caption = "";
                        }                        
                        echo '<li><a href="'.$src_url.'" class="prettyPhoto" data-rel="prettyPhoto">'.$image.'</a>'.$caption.'</li>';
                    }
                   if (class_exists('MultiPostThumbnails')) : $image = MultiPostThumbnails::get_the_post_thumbnail( get_post_type(), 'third-image', NULL, $thumbsizer); endif; if(!empty($image)) { 
                        $post_thumbnail_id = MultiPostThumbnails::get_post_thumbnail_id( get_post_type(), 'third-image', get_the_ID() );
                        $thumb_post = get_post($post_thumbnail_id);
                        $src_url = esc_url($thumb_post->guid);
                        $caption = trim(strip_tags( $thumb_post->post_excerpt ));
                        if ( !empty( $caption )) {
                            $caption = '<div class="bliccaThemes-caption">'.esc_attr($caption).'</div>';
                        }
                        else {
                            $caption = "";
                        }                        
                        echo '<li><a href="'.$src_url.'" class="prettyPhoto" data-rel="prettyPhoto">'.$image.'</a>'.$caption.'</li>';
                    }
                   if (class_exists('MultiPostThumbnails')) : $image = MultiPostThumbnails::get_the_post_thumbnail( get_post_type(), 'fourth-image', NULL, $thumbsizer); endif; if(!empty($image)) { 
                        $post_thumbnail_id = MultiPostThumbnails::get_post_thumbnail_id( get_post_type(), 'fourth-image', get_the_ID() );
                        $thumb_post = get_post($post_thumbnail_id);
                        $src_url = esc_url($thumb_post->guid);
                        $caption = trim(strip_tags( $thumb_post->post_excerpt ));
                        if ( !empty( $caption )) {
                            $caption = '<div class="bliccaThemes-caption">'.esc_attr($caption).'</div>';
                        }
                        else {
                            $caption = "";
                        }                        
                        echo '<li><a href="'.$src_url.'" class="prettyPhoto" data-rel="prettyPhoto">'.$image.'</a>'.$caption.'</li>';
                    }
                   if (class_exists('MultiPostThumbnails')) : $image = MultiPostThumbnails::get_the_post_thumbnail( get_post_type(), 'fifth-image', NULL, $thumbsizer); endif; if(!empty($image)) { 
                        $post_thumbnail_id = MultiPostThumbnails::get_post_thumbnail_id( get_post_type(), 'fifth-image', get_the_ID() );
                        $thumb_post = get_post($post_thumbnail_id);
                        $src_url = esc_url($thumb_post->guid);
                        $caption = trim(strip_tags( $thumb_post->post_excerpt ));
                        if ( !empty( $caption )) {
                            $caption = '<div class="bliccaThemes-caption">'.esc_attr($caption).'</div>';
                        }
                        else {
                            $caption = "";
                        }                        
                        echo '<li><a href="'.$src_url.'" class="prettyPhoto" data-rel="prettyPhoto">'.$image.'</a>'.$caption.'</li>';
                    }
                   if (class_exists('MultiPostThumbnails')) : $image = MultiPostThumbnails::get_the_post_thumbnail( get_post_type(), 'last-image', NULL, $thumbsizer); endif; if(!empty($image)) { 
                        $post_thumbnail_id = MultiPostThumbnails::get_post_thumbnail_id( get_post_type(), 'last-image', get_the_ID() );
                        $thumb_post = get_post($post_thumbnail_id);
                        $src_url = esc_url($thumb_post->guid);
                        $caption = trim(strip_tags( $thumb_post->post_excerpt ));
                        if ( !empty( $caption )) {
                            $caption = '<div class="bliccaThemes-caption">'.esc_attr($caption).'</div>';
                        }
                        else {
                            $caption = "";
                        }                        
                        echo '<li><a href="'.$src_url.'" class="prettyPhoto" data-rel="prettyPhoto">'.$image.'</a>'.$caption.'</li>';
                    } 
                ?>
    </ul>
    </div><?php
    }
}