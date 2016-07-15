<?php
/**
 * Register the Widget
 */
add_action( 'widgets_init', create_function( '', 'register_widget("bliccaThemes_advert_widget");' ) );

class bliccaThemes_advert_widget extends WP_Widget
{
    /**
     * Constructor
     **/
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'bliccaThemes_advert_widget',
            'description' => 'Add advertisement to your sidebar'
        );

        parent::__construct( 'bliccaThemes_advert_widget', 'Advertisement Widget', $widget_ops );
				 global $pagenow;
        if ($pagenow == 'widgets.php') {
        add_action('admin_enqueue_scripts', array($this, 'upload_scripts'));
          }		  
    }

    /**
     * Upload the Javascripts for the media uploader
     */
    public function upload_scripts()
    {
       
				wp_enqueue_media();
      		
        wp_enqueue_script('ads_script', get_template_directory_uri() . '/js/upload_image.js', false, '1.0', true);
    }



    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme
     * @param array  An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    public function widget( $args, $instance )
    {
        extract($args);

        echo $before_widget;
        echo $before_title . $instance['title'] . $after_title;
        echo '<a href="'. esc_url($instance['add_url']) .'" target="_blank"><img src="'. esc_url($instance['image']) .'" alt="'. esc_url($instance['title']) .'"></a>';
        echo $after_widget;       
    }

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array  An array of new settings as submitted by the admin
     * @param array  An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['image'] = strip_tags($new_instance['image']);
        $instance['add_url'] = strip_tags($new_instance['add_url']);
        return $instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void
     **/
    public function form( $instance )
    {
        $title = '';
        if(isset($instance['title']))
        {
            $title = strip_tags($instance['title']);
        }

        $image = '';
        if(isset($instance['image']))
        {
            $image = strip_tags($instance['image']);
        }

        $add_url = '';

        if(isset($instance['add_url'])) 
        {
            $add_url = strip_tags($instance['add_url']);
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php esc_attr_e( 'Title:', 'bliccaThemes' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_name( 'add_url' ); ?>"><?php esc_attr_e( 'URI:', 'bliccaThemes' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'add_url' ); ?>" name="<?php echo $this->get_field_name( 'add_url' ); ?>" type="text" value="<?php echo esc_attr( $add_url ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('image'); ?>">Image</label><br />
        
                <?php
                    if ( isset($instance['image']) && $instance['image'] != '' ) :
                        echo '<img class="custom_media_image" src="' . strip_tags($instance['image']) . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />';
                    endif;
                ?>
        
            <input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('image'); ?>" id="<?php echo $this->get_field_id('image'); ?>" value="<?php echo esc_url($image); ?>" style="margin-top:5px;">
        
            <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name('image'); ?>" value="Upload Image" style="margin-top:5px;" />
        </p>
    <?php
    }
}


/**
 * Register the Widget
 */
add_action( 'widgets_init', create_function( '', 'register_widget("bliccaThemes_aboutme_widget");' ) );

class bliccaThemes_aboutme_widget extends WP_Widget
{
    /**
     * Constructor
     **/
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'bliccaThemes_aboutme_widget',
            'description' => 'Add about me element to your sidebar'
        );

        parent::__construct( 'bliccaThemes_aboutme_widget', 'About me Widget', $widget_ops );
				 global $pagenow;
        if ($pagenow == 'widgets.php') {
        add_action('admin_enqueue_scripts', array($this, 'upload_scripts'));
          }
    }

    /**
     * Upload the Javascripts for the media uploader
     */
    public function upload_scripts()
    {
				wp_enqueue_media();
        wp_enqueue_script('ads_script', get_template_directory_uri() . '/js/upload_image.js', false, '1.0', true);
    }



    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme
     * @param array  An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    public function widget( $args, $instance )
    {
        extract($args);

        echo $before_widget;
        if ( !empty($instance['title'])) {
        echo $before_title . $instance['title'] . $after_title;
        }
        echo '<img src="'. esc_url($instance['image']) .'" alt="'. esc_url($instance['title']) .'"><p>'.$instance['add_text'].'</p><div class="clearfix"></div>';
        echo $after_widget;       
    }

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array  An array of new settings as submitted by the admin
     * @param array  An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['image'] = strip_tags($new_instance['image']);
        $instance['add_text'] = strip_tags($new_instance['add_text']);
        return $instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void
     **/
    public function form( $instance )
    {
        $title = '';
        if(isset($instance['title']))
        {
            $title = strip_tags($instance['title']);
        }

        $image = '';
        if(isset($instance['image']))
        {
            $image = strip_tags($instance['image']);
        }

        $add_text = '';

        if(isset($instance['add_text'])) 
        {
            $add_text = strip_tags($instance['add_text']);
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:', 'bliccaThemes' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_name( 'add_text' ); ?>"><?php _e( 'Text:', 'bliccaThemes' ); ?></label>
            <textarea rows="16" cols="20" class="widefat" id="<?php echo $this->get_field_id( 'add_text' ); ?>" name="<?php echo $this->get_field_name( 'add_text' ); ?>" type="textfield"><?php echo esc_attr( $add_text ); ?></textarea>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('image'); ?>">Image</label><br />
        
                <?php
                    if ( isset($instance['image']) && $instance['image'] != '' ) :
                        echo '<img class="custom_media_image" src="' . strip_tags($instance['image']) . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />';
                    endif;
                ?>
        
            <input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('image'); ?>" id="<?php echo $this->get_field_id('image'); ?>" value="<?php echo esc_url($image); ?>" style="margin-top:5px;">
        
            <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name('image'); ?>" value="Upload Image" style="margin-top:5px;" />
        </p>
    <?php
    }
}