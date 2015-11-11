<?php
/**
 * brewhouse Theme Customizer
 *
 * @package brewhouse
 */
 
function brewhouse_theme_customizer( $wp_customize ) {
	
	//allows donations
    class brewhouse_Info extends WP_Customize_Control { 
     
        public $label = '';
        public function render_content() { 
        ?>

        <?php
        }
    }	
	
	// Donations
    $wp_customize->add_section(
        'brewhouse_theme_info',
        array(
            'title' => __('Like Brew House? Help Us Out.', 'brewhouse'),
            'priority' => 5,
            'description' => __('We do all we can do to make all our themes free for you. While we enjoy it, and it makes us happy to help out, a little appreciation can help us to keep theming.</strong><br/><br/> Please help support our mission and continued development with a donation of $5, $10, $20, or if you are feeling really kind $100..<br/><br/> <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7LMGYAZW9C5GE" target="_blank" rel="nofollow"><img class="" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" alt="Make a donation to ModernThemes" /></a>'), 
        )
    );  
	 
    //Donations section
    $wp_customize->add_setting('brewhouse_help', array(   
			'sanitize_callback' => 'brewhouse_no_sanitize', 
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control( new brewhouse_Info( $wp_customize, 'brewhouse_help', array(
        'section' => 'brewhouse_theme_info', 
        'settings' => 'brewhouse_help', 
        'priority' => 10
        ) )
    ); 
	
	// Fonts  
    $wp_customize->add_section(
        'brewhouse_typography',
        array(
            'title' => __('Google Fonts', 'brewhouse' ),  
            'priority' => 39,
        )
    );
    $font_choices = 
        array(
			'Francois One:400' => 'Francois One',
			'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
			'Playfair Display:400,700,400italic' => 'Playfair Display',
			'Montserrat:400,700' => 'Montserrat',
			'Raleway:400,700' => 'Raleway',
			'Open Sans:400italic,700italic,400,700' => 'Open Sans',     
            'Droid Sans:400,700' => 'Droid Sans',
            'Lato:400,700,400italic,700italic' => 'Lato',
            'Arvo:400,700,400italic,700italic' => 'Arvo',
            'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'PT Serif:400,700' => 'PT Serif', 
            'PT Sans:400,700,400italic,700italic' => 'PT Sans',
            'PT Sans Narrow:400,700' => 'PT Sans Narrow',
			'Cabin:400,700,400italic' => 'Cabin',
			'Fjalla One:400' => 'Fjalla One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',  
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
            'Arimo:400,700,400italic,700italic' => 'Arimo',
            'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
            'Bitter:400,700,400italic' => 'Bitter',
            'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
            'Roboto:400,400italic,700,700italic' => 'Roboto',
            'Oswald:400,700' => 'Oswald',
            'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
            'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
            'Roboto Slab:400,700' => 'Roboto Slab',
            'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
            'Rokkitt:400' => 'Rokkitt',
    ); 
    
    $wp_customize->add_setting(
        'headings_fonts',
        array(
            'sanitize_callback' => 'brewhouse_sanitize_fonts',
        )
    );
    
    $wp_customize->add_control(
        'headings_fonts',
        array(
            'type' => 'select',
            'description' => __('Select your desired font for the headings. Francois One is the default Heading font.', 'brewhouse'),
            'section' => 'brewhouse_typography', 
            'choices' => $font_choices
        )
    );
    
    $wp_customize->add_setting(
        'body_fonts',
        array(
            'sanitize_callback' => 'brewhouse_sanitize_fonts',
        )
    );
    
    $wp_customize->add_control(
        'body_fonts',
        array(
            'type' => 'select',
            'description' => __( 'Select your desired font for the body. Source Sans Pro is the default Body font.', 'brewhouse' ), 
            'section' => 'brewhouse_typography',  
            'choices' => $font_choices 
        ) 
    );
	
	// Disable Tipsy 

	$wp_customize->add_section( 'tipsy_section', array(
		'title'          => 'Tipsy Background',
		'priority'       => 22   
	) );

	$wp_customize->add_setting('disable_tipsy',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_checkbox',
	    ) 
	); 
	
	$wp_customize->add_control(
    'disable_tipsy',
    array(
        'type' => 'checkbox',
        'label' => 'Disable Tipsy Feature', 
        'section' => 'tipsy_section',
    )  
);
	
	// Colors

	$wp_customize->add_setting( 'brewhouse_dark_widget_color', array(   
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brewhouse_dark_widget_color', array(
        'label'	   => 'Dark Widget Color', 
        'section'  => 'colors',
        'settings' => 'brewhouse_dark_widget_color', 
		'priority' => 1
    ) ) );
	
	$wp_customize->add_setting( 'brewhouse_light_widget_color', array(   
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brewhouse_light_widget_color', array(
        'label'	   => 'Light Widget Color',   
        'section'  => 'colors',
        'settings' => 'brewhouse_light_widget_color', 
		'priority' => 2
    ) ) );
	
	$wp_customize->add_setting( 'brewhouse_link_color', array( 
        'default'     => '',   
        'sanitize_callback' => 'sanitize_hex_color', 
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brewhouse_link_color', array(
        'label'	   => 'Link Color', 
        'section'  => 'colors',
        'settings' => 'brewhouse_link_color',
		'priority' => 3 
    ) ) );
	
	$wp_customize->add_setting( 'brewhouse_hover_color', array(
        'default'     => '',   
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brewhouse_hover_color', array(
        'label'	   => 'Hover Color', 
        'section'  => 'colors',
        'settings' => 'brewhouse_hover_color',
		'priority' => 4  
    ) ) );
	
	$wp_customize->add_setting( 'brewhouse_custom_color', array( 
        'default'     => '', 
		'sanitize_callback' => 'sanitize_hex_color',
    ) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brewhouse_custom_color', array(
        'label'	   => 'Theme Color',
        'section'  => 'colors',
        'settings' => 'brewhouse_custom_color', 
		'priority' => 5
    ) ) );
	
	$wp_customize->add_setting( 'brewhouse_custom_color_hover', array( 
        'default'     => '', 
		'sanitize_callback' => 'sanitize_hex_color', 
    ) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brewhouse_custom_color_hover', array(
        'label'	   => 'Theme Hover Color',
        'section'  => 'colors',
        'settings' => 'brewhouse_custom_color_hover', 
		'priority' => 6
    ) ) ); 

    // Logo upload
    $wp_customize->add_section( 'brewhouse_logo_section' , array(  
	    'title'       => __( 'Logo and Icons', 'brewhouse' ),
	    'priority'    => 25,
	    'description' => 'Upload a logo to replace the default site name and description in the header. Also, upload your site favicon and Apple Icons.',
	) );

	$wp_customize->add_setting( 'brewhouse_logo', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'brewhouse_logo', array(
		'label'    => __( 'Logo', 'brewhouse' ),
		'section'  => 'brewhouse_logo_section', 
		'settings' => 'brewhouse_logo',
		'priority' => 1,
	) ) );
	
	// Logo Width
	$wp_customize->add_setting( 'logo_size', 
	array(
		 'sanitize_callback' => 'brewhouse_sanitize_text', 
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'logo_size', array( 
		'label'    => __( 'Change the width of the Logo in PX.', 'brewhouse' ),
		'description'    => __( 'Only enter numeric value', 'brewhouse' ),
		'section'  => 'brewhouse_logo_section',
		'settings' => 'logo_size',  
		'priority'   => 2 
	) ) );
	
	//Favicon Upload
	$wp_customize->add_setting(
		'site_favicon',
		array(
			'default' => (get_stylesheet_directory_uri() . '/images/favicon.png'), 
			'sanitize_callback' => 'esc_url_raw',
		)
	);
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_favicon',
            array(
			   'default' => '/images/favicon.png',
               'label'          => __( 'Upload your favicon (16x16 pixels)', 'brewhouse' ),
			   'type' 			=> 'image',
               'section'        => 'brewhouse_logo_section',
               'settings'       => 'site_favicon',
               'priority' => 2,
            )
        )
    );
    //Apple touch icon 144
    $wp_customize->add_setting(
        'apple_touch_144',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_144',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (144x144 pixels)', 'brewhouse' ),
               'type'           => 'image',
               'section'        => 'brewhouse_logo_section',
               'settings'       => 'apple_touch_144',
               'priority'       => 11,
            )
        )
    );
    //Apple touch icon 114
    $wp_customize->add_setting(
        'apple_touch_114',
        array( 
            'default-image' => '', 
			'sanitize_callback' => 'esc_url_raw', 
        ) 
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_114',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (114x114 pixels)', 'brewhouse' ),
               'type'           => 'image',
               'section'        => 'brewhouse_logo_section',
               'settings'       => 'apple_touch_114',
               'priority'       => 12,
            )
        )
    );
    //Apple touch icon 72
    $wp_customize->add_setting(
        'apple_touch_72',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_72',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (72x72 pixels)', 'brewhouse' ),
               'type'           => 'image',
               'section'        => 'brewhouse_logo_section',
               'settings'       => 'apple_touch_72',
               'priority'       => 13,
            )
        )
    );
    //Apple touch icon 57
    $wp_customize->add_setting(
        'apple_touch_57',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_57',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (57x57 pixels)', 'brewhouse' ),
               'type'           => 'image',
               'section'        => 'brewhouse_logo_section',
               'settings'       => 'apple_touch_57', 
               'priority'       => 14,
            )
        )
    );
	
	// Home Page Top
	$wp_customize->add_section( 'brewhouse_home_section_top' , array(  
	    'title'       => __( 'Home Page Top', 'brewhouse' ),
	    'priority'    => 28, 
	    'description' => __( 'Customize the top of your home page here', 'brewhouse' )  
	) );
	
	// Main Image
	$wp_customize->add_setting( 'brewhouse_main_image', array(
		'default' => (get_stylesheet_directory_uri() . '/images/badge.png'),   
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'brewhouse_main_image', array( 
		'label'    => __( 'Main Image', 'brewhouse' ),
		'section'  => 'brewhouse_home_section_top',  
		'settings' => 'brewhouse_main_image', 
		'priority'   => 1  
	) ) );
	
	// Main Background
	$wp_customize->add_setting( 'brewhouse_main_bg', array(
		'default' => (get_stylesheet_directory_uri() . '/images/parallax-bg.jpg'),   
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'brewhouse_main_bg', array( 
		'label'    => __( 'Main Background Image', 'brewhouse' ),
		'section'  => 'brewhouse_home_section_top',  
		'settings' => 'brewhouse_main_bg', 
		'priority'   => 2 
	) ) ); 

	// First Heading
	$wp_customize->add_setting( 'brewhouse_first_heading' ,
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_text',
	    ) 
	);
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_first_heading', array( 
    'label' => __( 'First Heading', 'brewhouse' ),   
    'section' => 'brewhouse_home_section_top',
    'settings' => 'brewhouse_first_heading',
	'priority'   => 3
	) ) );
	
	// Second Heading 
	$wp_customize->add_setting( 'brewhouse_second_heading',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_text',
	    ) 
	);
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_second_heading', array( 
    'label' => __( 'Second Heading', 'personal' ),   
    'section' => 'brewhouse_home_section_top',
    'settings' => 'brewhouse_second_heading', 
	'priority'   => 4 
	) ) );
	
	// Home Page First Widget Area
	
	$wp_customize->add_section( 'brewhouse_home_section_w1' , array(  
	    'title'       => __( 'First Widget Area', 'brewhouse' ),
	    'priority'    => 29, 
	    'description' => __( 'Customize the first home widget area. Choose from any of <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">these icons</a>. Example: "fa-arrow-right". The main body of the widget area can be edited under the Widgets section below.', 'brewhouse' )   
	) );
	
	$wp_customize->add_setting('active_first_widget',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_checkbox',
	    ) 
	);   
	
	$wp_customize->add_control(
    'active_first_widget', 
    array(
        'type' => 'checkbox',
        'label' => 'Hide First Widget Section',  
        'section' => 'brewhouse_home_section_w1',
		'priority'   => 1
    ));
	
	// Icon 1 
	$wp_customize->add_setting( 'home_icon_1' , 
	array( 
		'default' => 'fa-home',
		'sanitize_callback' => 'brewhouse_sanitize_text',
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'home_icon_1', array( 
    'label' => __( 'First Icon', 'brewhouse' ),  
    'section' => 'brewhouse_home_section_w1',
    'settings' => 'home_icon_1',
	'priority'   => 1
	) ) );
	
	// First Widget Heading
	$wp_customize->add_setting( 'brewhouse_first_widget_heading',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_text',
	    ) 
	);
	  
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_first_widget_heading', array( 
    'label' => __( 'First Widget Heading', 'brewhouse' ),   
    'section' => 'brewhouse_home_section_w1', 
    'settings' => 'brewhouse_first_widget_heading', 
	'priority'   => 2
	) ) );
	
	// CTA Button Text
	$wp_customize->add_setting( 'first_button_text',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_text',
	    ) 
	); 

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'first_button_text', array( 
		'label'    => __( 'First button text', 'brewhouse' ),
		'section'  => 'brewhouse_home_section_w1', 
		'settings' => 'first_button_text',
		'priority'   => 3
	) ) ); 
	
	// Page Drop Downs 
	 $wp_customize->add_setting('brewhouse_first_button_url', 
	 array( 
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'brewhouse_sanitize_int', 
	)); 
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_first_button_url', array( 
    'label' => __( 'First Button URL', 'brewhouse' ), 
    'section' => 'brewhouse_home_section_w1',
	'type' => 'dropdown-pages',
    'settings' => 'brewhouse_first_button_url',
	'priority'   => 4
	) ) );
	
	// Home Page Second Widget Area
	$wp_customize->add_section( 'brewhouse_home_section_w2' , array(     
	    'title'       => __( 'Second Widget Area', 'brewhouse' ),
	    'priority'    => 30,    
	    'description' => __( 'Customize the second home widget area. Choose from any of <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">these icons</a>. Example: "fa-arrow-right". The main body of the widget area can be edited under the Widgets section below.', 'brewhouse' ) 
	) );
	
	$wp_customize->add_setting('active_second_widget',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_checkbox',
	    ) 
	);  
	
	$wp_customize->add_control( 
    'active_second_widget', 
    array(
        'type' => 'checkbox',
        'label' => 'Hide Second Widget Area',  
        'section' => 'brewhouse_home_section_w2', 
		'priority'   => 1
    ));
	
	// Icon 2
	$wp_customize->add_setting( 'home_second_icon' , 
	array( 
		'default' => 'fa-home',
	    'sanitize_callback' => 'brewhouse_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'home_second_icon', array( 
    'label' => __( 'Second Icon', 'brewhouse' ),  
    'section' => 'brewhouse_home_section_w2',
    'settings' => 'home_second_icon',
	'priority'   => 1 
	) ) );
	
	// Second Widget Heading
	$wp_customize->add_setting( 'brewhouse_second_widget_heading',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_text',
	    ) 
	); 
	  
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_second_widget_heading', array( 
    'label' => __( 'Second Widget Heading', 'brewhouse' ),   
    'section' => 'brewhouse_home_section_w2', 
    'settings' => 'brewhouse_second_widget_heading', 
	'priority'   => 2
	) ) );
	
	// CTA Button Text
	$wp_customize->add_setting( 'second_button_text',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_text',
	    ) 
	); 

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'second_button_text', array( 
		'label'    => __( 'Second button text', 'brewhouse' ),
		'section'  => 'brewhouse_home_section_w2', 
		'settings' => 'second_button_text',
		'priority'   => 3
	) ) );
	
	// Page Drop Downs 
	 $wp_customize->add_setting('brewhouse_second_button_url', 
	 array( 
		'capability' => 'edit_theme_options', 
		'sanitize_callback' => 'brewhouse_sanitize_int', 
	)); 
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_second_button_url', array( 
    'label' => __( 'Second Button URL', 'brewhouse' ), 
    'section' => 'brewhouse_home_section_w2',
	'type' => 'dropdown-pages',
    'settings' => 'brewhouse_second_button_url',
	'priority'   => 4
	) ) ); 
	
	// Home Page Middle
	$wp_customize->add_section( 'brewhouse_home_section_middle' , array(  
	    'title'       => __( 'Home Page Middle', 'brewhouse' ),
	    'priority'    => 31,
	    'description' => __( 'Customize the middle of your home page here', 'brewhouse' )  
	) );
	
	$wp_customize->add_setting('active_middle',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_checkbox',
	    ) 
	); 
	
	$wp_customize->add_control( 
    'active_middle', 
    array(
        'type' => 'checkbox', 
        'label' => 'Hide Middle Section',  
        'section' => 'brewhouse_home_section_middle', 
		'priority'   => 1
    ));
	
	// Middle Image
	$wp_customize->add_setting( 'brewhouse_middle_image', array(
		'default' => (get_stylesheet_directory_uri() . '/images/cta-bg.jpg'),    
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'brewhouse_middle_image', array( 
		'label'    => __( 'Main Image', 'brewhouse' ),
		'section'  => 'brewhouse_home_section_middle', 
		'settings' => 'brewhouse_middle_image', 
		'priority'   => 1  
	) ) ); 

	// First Heading
	$wp_customize->add_setting( 'brewhouse_middle_heading',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_text',
	    ) 
	); 
	  
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_middle_heading', array( 
    'label' => __( 'Middle Heading', 'brewhouse' ),   
    'section' => 'brewhouse_home_section_middle',
    'settings' => 'brewhouse_middle_heading',
	'priority'   => 1
	) ) );
	
	// CTA Button Text
	$wp_customize->add_setting( 'third_button_text',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_text',
	    ) 
	); 

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'third_button_text', array( 
		'label'    => __( 'Third Button Text', 'brewhouse' ),
		'section'  => 'brewhouse_home_section_middle', 
		'settings' => 'third_button_text',
		'priority'   => 2
	) ) );
	
	// Page Drop Downs 
	 $wp_customize->add_setting('brewhouse_third_button_url', 
	 array( 
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'brewhouse_sanitize_int', 
	)); 
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_third_button_url', array( 
    'label' => __( 'Second Button URL', 'brewhouse' ), 
    'section' => 'brewhouse_home_section_middle',
	'type' => 'dropdown-pages',
    'settings' => 'brewhouse_third_button_url', 
	'priority'   => 3 
	) ) );
	
	// Beer Listing
	$wp_customize->add_section( 'brewhouse_home_featured_drinks' , array(  
	    'title'       => __( 'Home Page Featured Drinks', 'brewhouse' ),
	    'priority'    => 32,
	    'description' => __( 'Customize the home page featured drinks list', 'brewhouse' )  
	) ); 
	
	$wp_customize->add_setting('active_featured_drinks',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_checkbox',
	    ) 
	);  
	
	$wp_customize->add_control( 
    'active_featured_drinks', 
    array(
        'type' => 'checkbox', 
        'label' => 'Hide Featured Drinks',  
        'section' => 'brewhouse_home_featured_drinks', 
		'priority'   => 1 
    ));
	 
	// Footer First Widget Area
	$wp_customize->add_section( 'brewhouse_footer_section_w1' , array(  
	    'title'       => __( 'First Footer Widget Area', 'brewhouse' ),
	    'priority'    => 33, 
	    'description' => __( 'Customize the first footer widget area. Choose from any of <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">these icons</a>. Example: "fa-arrow-right". The main body of the widget area can be edited under the Widgets section below.', 'brewhouse' )   
	) );
	
	$wp_customize->add_setting('active_first_footer',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_checkbox',
	    ) 
	);   
	
	$wp_customize->add_control(
    'active_first_footer',
    array(
        'type' => 'checkbox',
        'label' => 'Hide First Footer Widget Section',  
        'section' => 'brewhouse_footer_section_w1',
		'priority'   => 1
    ));
	
	// Icon 1 
	$wp_customize->add_setting( 'footer_icon_1' , 
	array( 
		'default' => 'fa-edit', 
	    'sanitize_callback' => 'brewhouse_sanitize_text'
	));
	  
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_icon_1', array( 
    'label' => __( 'First Footer Icon', 'brewhouse' ),  
    'section' => 'brewhouse_footer_section_w1',
    'settings' => 'footer_icon_1',
	'priority'   => 1
	) ) );
	
	// First Widget Heading
	$wp_customize->add_setting( 'brewhouse_footer_first_widget_heading',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_text',
	    ) 
	); 
	  
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_footer_first_widget_heading', array( 
    'label' => __( 'First Footer Widget Heading', 'brewhouse' ),   
    'section' => 'brewhouse_footer_section_w1', 
    'settings' => 'brewhouse_footer_first_widget_heading', 
	'priority'   => 2
	) ) );
	
	// CTA Button Text
	$wp_customize->add_setting( 'first_footer_button_text',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_text',
	    ) 
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'first_footer_button_text', array( 
		'label'    => __( 'First Footer Button Text', 'brewhouse' ),
		'section'  => 'brewhouse_footer_section_w1', 
		'settings' => 'first_footer_button_text',
		'priority'   => 3
	) ) );
	
	// Page Drop Downs 
	 $wp_customize->add_setting('brewhouse_first_footer_button_url', 
	 array( 
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'brewhouse_sanitize_int',  
	)); 
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_first_footer_button_url', array( 
    'label' => __( 'First Footer Button URL', 'brewhouse' ), 
    'section' => 'brewhouse_footer_section_w1',
	'type' => 'dropdown-pages',
    'settings' => 'brewhouse_first_footer_button_url',
	'priority'   => 4
	) ) );
	
	// Footer Second Widget Area
	$wp_customize->add_section( 'brewhouse_footer_section_w2' , array(  
	    'title'       => __( 'Second Footer Widget Area', 'brewhouse' ),
	    'priority'    => 34,      
	    'description' => __( 'Customize the second footer widget area. Choose from any of <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">these icons</a>. Example: "fa-arrow-right". The main body of the widget area can be edited under the Widgets section below.', 'brewhouse' )
	) );
	
	$wp_customize->add_setting('active_second_footer',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_checkbox',
	    ) 
	);  
	
	$wp_customize->add_control(
    'active_second_footer',
    array(
        'type' => 'checkbox',
        'label' => 'Hide Second Footer Widget Section',  
        'section' => 'brewhouse_footer_section_w2',
		'priority'   => 1
    ));
	
	// Footer Icon 2
	$wp_customize->add_setting( 'footer_icon_2' , 
	array( 
		'default' => 'fa-envelope-o',
	    'sanitize_callback' => 'brewhouse_sanitize_text',
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_icon_2', array(  
    'label' => __( 'Second Footer Icon', 'brewhouse' ),  
    'section' => 'brewhouse_footer_section_w2',
    'settings' => 'footer_icon_2',
	'priority'   => 1  
	) ) );
	
	// Footer Second Widget Heading
	$wp_customize->add_setting( 'brewhouse_second_footer_widget_heading',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_text',
	    ) 
	);  
	  
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_second_footer_widget_heading', array( 
    'label' => __( 'Second Footer Widget Heading', 'brewhouse' ),   
    'section' => 'brewhouse_footer_section_w2', 
    'settings' => 'brewhouse_second_footer_widget_heading', 
	'priority'   => 2
	) ) );
	 
	// Footer CTA Button Text
	$wp_customize->add_setting( 'footer_second_button_text',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_text',
	    ) 
	); 

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_second_button_text', array(  
		'label'    => __( 'Footer Second Button Text', 'brewhouse' ),
		'section'  => 'brewhouse_footer_section_w2', 
		'settings' => 'footer_second_button_text',
		'priority'   => 3
	) ) );
	
	// Page Drop Downs 
	 $wp_customize->add_setting('brewhouse_second_footer_button_url', 
	 array( 
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'brewhouse_sanitize_int',  
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_second_footer_button_url', array( 
    'label' => __( 'Footer Second Button URL', 'brewhouse' ), 
    'section' => 'brewhouse_footer_section_w2', 
	'type' => 'dropdown-pages',
    'settings' => 'brewhouse_second_footer_button_url',
	'priority'   => 4
	) ) );
	
	// Add Footer Section
	$wp_customize->add_section( 'footer-custom' , array( 
    	'title' => __( 'Footer', 'brewhouse' ),
    	'priority' => 35,  
    	'description' => __( 'Customize your footer area', 'brewhouse' ) 
	) );
	
	// Bottom Footer Icon 1
	$wp_customize->add_setting( 'bottom_footer_icon_1' , 
	array( 
		'default' => 'fa-mobile',
		'sanitize_callback' => 'brewhouse_sanitize_text',  
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bottom_footer_icon_1', array(  
    'label' => __( 'First Icon', 'brewhouse' ),  
    'section' => 'footer-custom', 
    'settings' => 'bottom_footer_icon_1', 
	'priority'   => 1  
	) ) );
	
	// Footer Contact
	$wp_customize->add_setting( 'brewhouse_footer_phone' , 
	array( 
		'default' => '777-565-BREW',
		'sanitize_callback' => 'brewhouse_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_footer_phone', array( 
    'label' => __( 'Footer Phone Number', 'brewhouse' ),
    'section' => 'footer-custom',
    'settings' => 'brewhouse_footer_phone', 
	'type'     => 'textarea', 
	'priority'   => 2
	) ) );
	
	// Bottom Footer Icon 2
	$wp_customize->add_setting( 'bottom_footer_icon_2', 
	array( 
		'default' => 'fa-map-marker',
		'sanitize_callback' => 'brewhouse_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bottom_footer_icon_2', array(  
    'label' => __( 'Second Icon', 'brewhouse' ),  
    'section' => 'footer-custom',
    'settings' => 'bottom_footer_icon_2',
	'priority'   => 3
	) ) );
	
	// Footer Location
	$wp_customize->add_setting( 'brewhouse_footer_address' , 
	array( 
		'default' => '21 Brew St. New York, NY',
		'sanitize_callback' => 'brewhouse_sanitize_text',
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_footer_address', array(
    'label' => __( 'Footer Address', 'brewhouse' ),
    'section' => 'footer-custom',
    'settings' => 'brewhouse_footer_address',
	'type'     => 'textarea',   
	'priority'   => 4
	) ) );
	
	// Bottom Footer Icon 3
	$wp_customize->add_setting( 'bottom_footer_icon_3' , 
	array( 
		'default' => 'fa-comments-o',
		'sanitize_callback' => 'brewhouse_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bottom_footer_icon_3', array(  
    'label' => __( 'Third Icon', 'brewhouse' ), 
    'section' => 'footer-custom',
    'settings' => 'bottom_footer_icon_3',
	'priority'   => 5
	) ) ); 
	
	// Footer Byline Text 
	$wp_customize->add_setting( 'brewhouse_footerid',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_text',
	    ) 
	);
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_footerid', array( 
    'label' => __( 'Footer Byline Text', 'brewhouse' ),
    'section' => 'footer-custom',
    'settings' => 'brewhouse_footerid',
	'priority'   => 7 
	) ) );
	
	// Add Beer Page Section
	$wp_customize->add_section( 'beer_section' , array( 
    	'title' => __( 'Beer List Page', 'brewhouse' ),
    	'priority' => 36,
    	'description' => __( 'Customize your Beer List page', 'brewhouse' ) 
	) );
	
	// Beer List Title
	$wp_customize->add_setting( 'beer_list_title',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_text',
	    ) 
	);
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'beer_list_title', array( 
    'label' => __( 'Beer List Title', 'brewhouse' ),
    'section' => 'beer_section',
    'settings' => 'beer_list_title', 
	'priority'   => 1
	) ) );
	

    // Add About Us Page Section
	$wp_customize->add_section( 'about_us_section' , array( 
    	'title' => __( 'About Us Page', 'brewhouse' ),
    	'priority' => 37,
    	'description' => __( 'Customize your About Us page', 'brewhouse' ) 
	) );
	
	$wp_customize->add_setting('active_history',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_checkbox', 
	    ) 
	);   
	
	$wp_customize->add_control(
    'active_history', 
    array(
        'type' => 'checkbox',
        'label' => 'Hide History Section',  
        'section' => 'about_us_section',
		'priority'   => 1
    ));
	
	$wp_customize->add_setting('active_brewery',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_checkbox',
	    ) 
	);    
	
	$wp_customize->add_control(
    'active_brewery', 
    array(
        'type' => 'checkbox',
        'label' => 'Hide Brewery Section',  
        'section' => 'about_us_section',
		'priority'   => 2
    ));
	
	$wp_customize->add_setting('active_people',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_checkbox',
	    ) 
	);     
	
	$wp_customize->add_control(
    'active_people', 
    array(
        'type' => 'checkbox',
        'label' => 'Hide People Section',  
        'section' => 'about_us_section',
		'priority'   => 3
    ));
	
	// Our History Picture
	$wp_customize->add_setting( 'brewhouse_history_image', array(
		'default' => (get_stylesheet_directory_uri() . ''),    
		'sanitize_callback' => 'esc_url_raw', 
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'brewhouse_history_image', array( 
		'label'    => __( 'Our History Picture', 'brewhouse' ),
		'section'  => 'about_us_section', 
		'settings' => 'brewhouse_history_image', 
		'priority'   => 4
	) ) );
	
	// Our History Title
	$wp_customize->add_setting( 'brewhouse_our_history_title',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_text',
	    ) 
	); 
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_our_history_title', array( 
    'label' => __( 'Our History Title', 'brewhouse' ),
    'section' => 'about_us_section', 
    'settings' => 'brewhouse_our_history_title',
	'type'     => 'text', 
	'priority'   => 5
	) ) );
	
	// Our History Text
	$wp_customize->add_setting( 'brewhouse_our_history',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_text',
	    ) 
	); 
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_our_history', array( 
    'label' => __( 'Our History Text', 'brewhouse' ),
    'section' => 'about_us_section', 
    'settings' => 'brewhouse_our_history',
	'type'     => 'textarea', 
	'priority'   => 6 
	) ) );

	// Brewery Picture
	$wp_customize->add_setting( 'brewhouse_brewery_image', array(
		'default' => (get_stylesheet_directory_uri() . ''),    
		'sanitize_callback' => 'esc_url_raw', 
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'brewhouse_brewery_image', array( 
		'label'    => __( 'Brewery Picture', 'brewhouse' ),
		'section'  => 'about_us_section', 
		'settings' => 'brewhouse_brewery_image', 
		'priority'   => 7
	) ) );
	
	// Brewery Title
	$wp_customize->add_setting( 'brewhouse_brewery_title',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_text',
	    ) 
	); 
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_brewery_title', array( 
    'label' => __( 'Brewery Title', 'brewhouse' ),
    'section' => 'about_us_section', 
    'settings' => 'brewhouse_brewery_title',
	'type'     => 'text', 
	'priority'   => 8
	) ) );
	
	// Brewery Text 
	$wp_customize->add_setting( 'brewhouse_brewery',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_text',
	    ) 
	); 
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_brewery', array( 
    'label' => __( 'Brewery Text', 'brewhouse' ),
    'section' => 'about_us_section', 
    'settings' => 'brewhouse_brewery',
	'type'     => 'textarea',  
	'priority'   => 9
	) ) );
	
	// Our People Picture
	$wp_customize->add_setting( 'brewhouse_people_image', array(
		'default' => (get_stylesheet_directory_uri() . ''), 
		'sanitize_callback' => 'esc_url_raw', 
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'brewhouse_people_image', array( 
		'label'    => __( 'Our People Picture', 'brewhouse' ),
		'section'  => 'about_us_section', 
		'settings' => 'brewhouse_people_image', 
		'priority'   => 10
	) ) );
	
	// Our People Title
	$wp_customize->add_setting( 'brewhouse_people_title',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_text',
	    ) 
	); 
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_people_title', array( 
    'label' => __( 'Our People Title', 'brewhouse' ),
    'section' => 'about_us_section', 
    'settings' => 'brewhouse_people_title',
	'type'     => 'text', 
	'priority'   => 11
	) ) );
	
	// Our People Text 
	$wp_customize->add_setting( 'brewhouse_our_people',
	    array(
	        'sanitize_callback' => 'brewhouse_sanitize_text',
	    ) 
	); 
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_our_people', array( 
    'label' => __( 'Our People Text', 'brewhouse' ),
    'section' => 'about_us_section', 
    'settings' => 'brewhouse_our_people', 
	'type'     => 'textarea', 
	'priority'   => 12  
	) ) ); 

    // Choose excerpt or full content on blog
    $wp_customize->add_section( 'brewhouse_layout_section' , array( 
	    'title'       => __( 'Layout', 'brewhouse' ),
	    'priority'    => 45, 
	    'description' => 'Change how brewhouse displays posts', 
	) );

	$wp_customize->add_setting( 'brewhouse_post_content', array( 
		'default'	        => 'option1',
		'sanitize_callback' => 'brewhouse_sanitize_index_content',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'brewhouse_post_content', array(
		'label'    => __( 'Post content', 'brewhouse' ),
		'section'  => 'brewhouse_layout_section',
		'settings' => 'brewhouse_post_content',
		'type'     => 'radio',
		'choices'  => array(
			'option1' => 'Excerpts',
			'option2' => 'Full content',
			),
	) ) );
	
	//Excerpt
    $wp_customize->add_setting(
        'exc_length',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '30',
        )       
    );
    $wp_customize->add_control( 'exc_length', array( 
        'type'        => 'number',
        'priority'    => 2, 
        'section'     => 'brewhouse_layout_section',
        'label'       => __('Excerpt length', 'brewhouse'),
        'description' => __('Choose your excerpt length here. Default: 30 words', 'brewhouse'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5, 
            'style' => 'padding: 15px;',  
        ), 
    ) );  
	   
	// Set site name and description to be previewed in real-time
	$wp_customize->get_setting('blogname')->transport='postMessage';
	$wp_customize->get_setting('blogdescription')->transport='postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	// Move sections up 
	$wp_customize->get_section('static_front_page')->priority = 10; 

	// Enqueue scripts for real-time preview
	wp_enqueue_script( 'brewhouse_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true ); 
 

}
add_action('customize_register', 'brewhouse_theme_customizer');


/**
 * Sanitizes a hex color. Identical to core's sanitize_hex_color(), which is not available on the wp_head hook.
 *
 * Returns either '', a 3 or 6 digit hex color (with #), or null.
 * For sanitizing values without a #, see sanitize_hex_color_no_hash().
 *
 * @since 1.7
 */
function brewhouse_sanitize_hex_color( $color ) {
	if ( '#FF0000' === $color ) 
		return '';

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;

	return null;
}

/**
 * Sanitizes our post content value (either excerpts or full post content).
 *
 * @since 1.7
 */
 
//Integers
function brewhouse_sanitize_int( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}
//Text
function brewhouse_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

//content
function brewhouse_sanitize_index_content( $content ) {
	if ( 'option2' == $content ) {
		return 'option2';
	} else {
		return 'option1';
	}
}

//checkboxes
function brewhouse_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {  
		return 1;
	} else {
		return '';
	}
} 

//Sanitizes Fonts 
function brewhouse_sanitize_fonts( $input ) {  
    $valid = array(
            'Francois One:400' => 'Francois One',
			'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro', 
			'Playfair Display:400,700,400italic' => 'Playfair Display',
			'Montserrat:400,700' => 'Montserrat',
			'Raleway:400,700' => 'Raleway',
			'Open Sans:400italic,700italic,400,700' => 'Open Sans',     
            'Droid Sans:400,700' => 'Droid Sans',
            'Lato:400,700,400italic,700italic' => 'Lato',
            'Arvo:400,700,400italic,700italic' => 'Arvo',
            'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'PT Serif:400,700' => 'PT Serif', 
            'PT Sans:400,700,400italic,700italic' => 'PT Sans',
            'PT Sans Narrow:400,700' => 'PT Sans Narrow',
			'Cabin:400,700,400italic' => 'Cabin',
			'Fjalla One:400' => 'Fjalla One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',  
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
            'Arimo:400,700,400italic,700italic' => 'Arimo',
            'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
            'Bitter:400,700,400italic' => 'Bitter',
            'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
            'Roboto:400,400italic,700,700italic' => 'Roboto',
            'Oswald:400,700' => 'Oswald',
            'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
            'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
            'Roboto Slab:400,700' => 'Roboto Slab',
            'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
            'Rokkitt:400' => 'Rokkitt',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

//No sanitize - empty function for options that do not require sanitization -> to bypass the Theme Check plugin
function brewhouse_no_sanitize( $input ) {
} 

/**
 * Add CSS in <head> for styles handled by the theme customizer
 *
 * @since 1.5
 */
function brewhouse_add_customizer_css() {
	$color = brewhouse_sanitize_hex_color( get_theme_mod( 'brewhouse_link_color' ) );
	?>
	<!-- brewhouse customizer CSS -->
	<style>
		body {
			border-color: <?php echo $color; ?>;
		}
		a {
			color: <?php echo $color; ?>;
		}
		
		a:hover {
			color: <?php echo get_theme_mod( 'brewhouse_hover_color' ) ?>;  
		}
		
		.color-dark, .cbp-spmenu h3 { background: <?php echo get_theme_mod( 'brewhouse_dark_widget_color' ) ?>; } 
		.color-light, .cbp-spmenu { background: <?php echo get_theme_mod( 'brewhouse_light_widget_color' ) ?>; }
		
		a:focus, a:active { color: <?php echo get_theme_mod( 'brewhouse_custom_color' ) ?> !important; } 
		.entry-header { background: <?php echo get_theme_mod( 'brewhouse_custom_color' ) ?>; }
		blockquote { border-color: <?php echo get_theme_mod( 'brewhouse_custom_color' ) ?>; }
		button, input[type="button"], input[type="reset"], input[type="submit"] { background: <?php echo get_theme_mod( 'brewhouse_custom_color' ) ?>; border-color: <?php echo get_theme_mod( 'brewhouse_custom_color' ) ?>; }  
		
		button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover { border-color: <?php echo get_theme_mod( 'brewhouse_custom_color_hover') ?>; background: <?php echo get_theme_mod( 'brewhouse_custom_color_hover') ?>; }
		
		.site-header button, .site-header button:hover { background: none; }   
		 
	</style>
<?php }
add_action( 'wp_head', 'brewhouse_add_customizer_css' );  
