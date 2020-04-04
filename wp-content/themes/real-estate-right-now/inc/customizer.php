<?php
/**
 * real estate Customizer functionality
 * @package real-estate-right-now
 * @subpackage Real_estate
 * @since real estate 1.0
 *
 */
/**
 * Sets up the WordPress core custom header and custom background features.
 * @since real estate 1.0
 * @see realestaterightnow_header_style()
 */
function realestaterightnow_custom_header_and_background() {
	$color_scheme             = realestaterightnow_get_color_scheme();
	$default_background_color = trim( $color_scheme[0], '#' );
	$default_text_color       = trim( $color_scheme[3], '#' );
	/**
	 * Filter the arguments used when adding 'custom-background' support in real estate.
	 *
	 * @since real estate 1.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'realestaterightnow_custom_background_args', array(
		'default-color' => $default_background_color,
	) ) );
	/**
	 * Filter the arguments used when adding 'custom-header' support in real estate.
	 *
	 * @since real estate 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-text-color Default color of the header text.
	 *     @type int      $width            Width in pixels of the custom header image. Default 1200.
	 *     @type int      $height           Height in pixels of the custom header image. Default 280.
	 *     @type bool     $flex-height      Whether to allow flexible-height header images. Default true.
	 *     @type callable $wp-head-callback Callback function used to style the header image and text
	 *                                      displayed on the blog.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'realestaterightnow_custom_header_args', array(
		'default-text-color'     => $default_text_color,
		'width'                  => 1200,
		'height'                 => 280,
		'flex-height'            => true,
		'wp-head-callback'       => 'realestaterightnow_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'realestaterightnow_custom_header_and_background' );
if ( ! function_exists( 'realestaterightnow_header_style' ) ) :
/**
 * Styles the header text displayed on the site.
 *
 * Create your own realestaterightnow_header_style() function to override in a child theme.
 *
 * @since real estate 1.0
 *
 * @see realestaterightnow_custom_header_and_background().
 */
function realestaterightnow_header_style() {
	// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
	//	return;
	}
 	if ( display_header_text() ) {
		return;
	}
	// If the header text has been hidden.
	?>
	<style type="text/css" id="realestaterightnow-header-css">
		.site-branding {
			margin: 0 auto 0 0;
		}
		.site-branding .site-title,
		.site-description {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	</style>
	<?php
}
endif; // realestaterightnow_header_style
/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since real estate 1.0
 *
 * @see realestaterightnow_header_style()
 */
function realestaterightnow_custom_site($wp_customize) {
$wp_customize->add_panel( 'settings', array(
    'title' => 'Settings',
    'description' => 'Settings Panel',
    'priority' => 20,
) ); 
$wp_customize->add_panel( 'general', array(
    'title' => 'Theme Options',
    'description' => 'General Settings Panel',
    'priority' => 10,
) );
// Margin-logo
  		$wp_customize->add_setting( 'realestaterightnow_logo_margin_top', array(
         'sanitize_callback' =>'realestaterightnow_sanitize_text',
         'default' => '00'
		) );
		$wp_customize->add_control( 'realestaterightnow_logo_margin_top', array(
			'label'      => __( 'Branding Margin From Top','real-estate-right-now' ),
			'section'    => 'title_tagline',
            'type' => 'range',
            'description' => __( 'Choose from -20px to 100px', 'real-estate-right-now' ),
         	'priority' => 9,
            'input_attrs' => array(
            'min' => -20,
            'max' => 100,
            'step' => 10
          ),
		) ); 
 $wp_customize->add_setting('header_text_bill', array(
     'sanitize_callback' =>'realestaterightnow_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control( 'header_text_bill', array(
				'label'    => __( 'Display Site Title and Tagline','real-estate-right-now' ),
				'section'  => 'title_tagline',
				'settings' => 'header_text_bill',
				'type'     => 'checkbox',
			) );       
// Lay Out
    $wp_customize->add_section( 
    	'general_settings_section', 
    	array(
    		'title'       => __( 'Layout', 'real-estate-right-now' ),
    		'priority'    => 1,
    		'capability'  => 'edit_theme_options',
    		'description' => __('Change General options here.', 'real-estate-right-now'), 
            'panel'       => 'general',    	) 
    ); 
$wp_customize->add_setting('realestaterightnow_entry_title', array(
     'sanitize_callback' =>'realestaterightnow_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control(
		'realestaterightnow_entry_title',
		array(
			'settings'		=> 'realestaterightnow_entry_title',
			'section'		=> 'general_settings_section',
			'type'			=> 'checkbox',
			'label'			=> __( 'Show entry-title', 'real-estate-right-now' ),
			'description'	=> '',
		)
	);
     $wp_customize->add_setting('realestaterightnow_show_sidebar_singlepage', array(
     'sanitize_callback' =>'realestaterightnow_sanitize_checkbox',
     'default' => '1'
     ));
   
     $wp_customize->add_setting('realestaterightnow_layout_type', array(
     'sanitize_callback' =>'realestaterightnow_sanitize_text',
     'default' => '2'
     ));
 	$wp_customize->add_control(
		'realestaterightnow_layout_type',
		array(
			'settings'		=> 'realestaterightnow_layout_type',
			'section'		=> 'general_settings_section',
			'type'			=> 'radio',
			'label'			=> __( 'Website Layout', 'real-estate-right-now' ) ,
			'description'	=> '',
			'choices'		=> array(
   				'3' => 'Boxed Width 1200px',
				'1' => 'Boxed Width 1000px',
				'2' => 'Wide'
			)
		)
	); 
    $wp_customize->add_setting( 'realestaterightnow_opacity',
        	array(
        		'default' => '10',
               'sanitize_callback' => 'realestaterightnow_sanitize_number',        	)
        );
     $wp_customize->add_control( 'realestaterightnow_opacity', array(
      'type' => 'range',
      'section' => 'general_settings_section',
      'label' => __( 'Background transparency (opacity)', 'real-estate-right-now' ),
      'description' => __( 'Choose from .6 to 1', 'real-estate-right-now' ),
      'sanitize_callback' => 'realestaterightnow_sanitize_number',
      'input_attrs' => array(
        'min' => 6,
        'max' => 10,
        'step' => 1,
      ),
    ) );
// Top Header Settings
      $wp_customize->add_section( 
    	'top_header_settings_section', 
    	array(
    		'title'       => __( 'Top Header Settings', 'real-estate-right-now' ),
    		'priority'    => 81,
    		'capability'  => 'edit_theme_options',
    		'description' => '',
            'panel'       => 'general',    	 
    	) 
    );
     $wp_customize->add_setting('realestaterightnow_show_top_header', array(
     'sanitize_callback' =>'realestaterightnow_sanitize_text',
     'default' => ''
     ));
	$wp_customize->add_control(
		'realestaterightnow_show_top_header',
		array(
			'settings'		=> 'realestaterightnow_show_top_header',
			'section'		=> 'top_header_settings_section',
			'type'			=> 'checkbox',
			'label'			=> __( 'Show', 'real-estate-right-now' ),
			'description'	=> __( 'Show Top Header Info (email, phone, hours) and Social Media Menu at top header.', 'real-estate-right-now' ),
            'sanitize_callback' => 'realestaterightnow_sanitize_checkbox',            
		)
	); 
    $wp_customize->add_setting('realestaterightnow_topinfo_phone', array(
      'sanitize_callback' =>'realestaterightnow_sanitize_phone', 
      'default'        => '',
     ));
    $wp_customize->add_control('realestaterightnow_topinfo_phone', array(
     'label'   => __( 'Top Info Phone', 'real-estate-right-now' ),
      'section' => 'top_header_settings_section',
	  'description' => 'Digite only numbers and . or - to separate them.',
     'type'    => 'text',
    )); 
       $wp_customize->add_setting('realestaterightnow_topinfo_email', array(
      'sanitize_callback' =>'realestaterightnow_sanitize_email', 
      'default'        => '',
     ));
    $wp_customize->add_control('realestaterightnow_topinfo_email', array(
     'label'   => __( 'Top Info eMail', 'real-estate-right-now' ),
      'section' => 'top_header_settings_section',
     'type'    => 'text',
    )); 
       $wp_customize->add_setting('realestaterightnow_topinfo_hours', array(
      'sanitize_callback' =>'realestaterightnow_sanitize_html', 
      'default'        => '',
     ));
    $wp_customize->add_control('realestaterightnow_topinfo_hours', array(
     'label'   => __( 'Top Info Hours', 'real-estate-right-now' ),
      'section' => 'top_header_settings_section',
     'type'    => 'text',
    )); 
    $wp_customize->add_setting( 'realestaterightnow_topinfo_color',
    	array(
    		'default' => '#ffffff',
	    	'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realestaterightnow_topinfo_color', array(
    			'label'    => __( 'Header Top Info Color', 'real-estate-right-now' ),
                'section' => 'top_header_settings_section', 
    	        'settings' => 'realestaterightnow_topinfo_color',
           		'priority' => 60,
    		)
    	)
    );
// End Top Page Settings
// Header Settings
      $wp_customize->add_section( 
    	'header_settings_section', 
    	array(
    		'title'       => __( 'Header Settings', 'real-estate-right-now' ),
    		'priority'    => 100,
    		'capability'  => 'edit_theme_options',
    		'description' => 'Configure Header Bottom 1px Border and Header Background Color.',
            'panel'       => 'general', 
    	) 
    );
// Header Settings
      $wp_customize->add_section( 
    	'header_settings_section', 
    	array(
    		'title'       => __( 'Header Settings', 'real-estate-right-now' ),
    		'priority'    => 100,
    		'capability'  => 'edit_theme_options',
    		'description' => 'Configure Header style, Border, Header Image Background, Text and Colors. <br> To use style 1 in your Front Page, you need setup the page template as "No-Sidebar". (Pages => Template).',
            'panel'       => 'general', 
    	) 
    );
    $wp_customize->add_setting( 'realestaterightnow_header_style', array(
      'default' =>'1' ,
      'sanitize_callback' =>'realestaterightnow_sanitize_text',
    ));
	$wp_customize->add_control(
		'realestaterightnow_header_style',
		array(
			'settings'		=> 'realestaterightnow_header_style',
			'section'		=> 'header_settings_section',
			'type'			=> 'radio',
			'label'			=> __( 'Choose Front Page Header Style', 'real-estate-right-now'),
			'description'	=> '<br/><img src="'.realestaterightnowimgURL.'header-help.jpg" width="300" />',
			'choices'		=> array(
				'1' => 'Front Page Header Style 1',
				'2' => 'Front Page Header Style 2'
			)
		)
	);
$wp_customize->add_setting('realestaterightnow_header_img_background', array(
    'default' => '',
    'sanitize_callback' =>'realestaterightnow_sanitize_url',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
));
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'image_control_one', array(
    'label' => __( 'Front Page Header Background Image. Choose one image with 1920px by 700px.', 'real-estate-right-now' ),
    'section' => 'header_settings_section',
    'settings' => 'realestaterightnow_header_img_background',
    ))
);      
/*    
   $wp_customize->add_setting( 'realestaterightnow_header_background_color',
    	array(
    		'default' => '#333333',
	    	'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realestaterightnow_copyright_color', array(
    			'label'    => __( 'Header Background Color', 'real-estate-right-now' ),
                'section' => 'header_settings_section', 
    	        'settings' => 'realestaterightnow_header_background_color',
           		'priority' => 10,
    		)
    	)
    );
 */   
    $wp_customize->add_setting('realestaterightnow_header_border', array(
      'sanitize_callback' =>'realestaterightnow_sanitize_checkbox', 
      'default'        => '',
     ));
	$wp_customize->add_control(
		'realestaterightnow_header_border',
		array(
			'settings'		=> 'realestaterightnow_header_border',
			'section'		=> 'header_settings_section',
			'type'			=> 'checkbox',
			'label'			=> __( 'Show border', 'real-estate-right-now' ),
			'description'	=> '',
//			)
		)
	);    
    $wp_customize->add_setting( 'realestaterightnow_header_border_color',
    	array(
    		'default' => '#f1f1f1',
	    	'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realestaterightnow_header_border_color', array(
    			'label'    => __( 'Header Bottom Border Color', 'real-estate-right-now' ),
                'section' => 'header_settings_section', 
    	        'settings' => 'realestaterightnow_header_border_color',
           		'priority' => 20,
    		)
    	)
    );
        $wp_customize->add_setting( 'realestaterightnow_header_background_color',
    	array(
    		'default' => '#333333S',
	    	'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realestaterightnow_header_background_color', array(
    			'label'    => __( 'Header Background Color', 'real-estate-right-now' ),
                'section' => 'header_settings_section', 
    	        'settings' => 'realestaterightnow_header_background_color',
           		'priority' => 20,
    		)
    	)
    );
$wp_customize->add_setting( 'realestaterightnow_header_text_color',
    	array(
    		'default' => '#ffffff',
	    	'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realestaterightnow_header_text_color', array(
    			'label'    => __( 'Header Text Color', 'real-estate-right-now' ),
                'section' => 'header_settings_section', 
    	        'settings' => 'realestaterightnow_header_text_color',
           		'priority' => 40,
    		)
    	)
); 
    $wp_customize->add_setting('realestaterightnow_header_text_bottom', array(
      'sanitize_callback' =>'realestaterightnow_sanitize_text', 
      'default'        => 'A home for everyone.',
     ));
    $wp_customize->add_control('realestaterightnow_header_text_bottom', array(
     'label'   => __( 'Front Page Header Bottom Text', 'real-estate-right-now' ),
      'section' => 'header_settings_section',
	  'description' => 'Digite max 30 characters. Only letters and numbers.',
     'type'    => 'text',
     'priority' => 100,
    )); 
// WooCommerce
$all_plugins = apply_filters('active_plugins', get_option('active_plugins'));
if (stripos(implode($all_plugins), 'woocommerce.php')) {
    $wp_customize->add_setting( 'realestaterightnow_header_cart_color',
        	array(
        		'default' => '#000000',
    	    	'sanitize_callback' => 'sanitize_hex_color',
        	)
        );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realestaterightnow_header_cart_color', array(
        			'label'    => __( 'Shopping Cart Text Color', 'real-estate-right-now' ),
                    'section' => 'header_settings_section', 
        	        'settings' => 'realestaterightnow_header_cart_color',
        			'description'	=> 'If you use WooCommerce plugin',
               		'priority' => 40,
        		)
        	)
    ); 
}
/* End Header  */
/////////// Navigation Details
    $wp_customize->add_section( 
    	'navigation_colors_section', 
    	array(
    		'title'       => __( 'Main Navigation Design', 'real-estate-right-now' ),
    		'priority'    => 101,
    		'capability'  => 'edit_theme_options',
            'panel'       => 'general',
    		'description' => __('Change Navigation detais here.', 'real-estate-right-now'), 
    	) 
    );
     $wp_customize->add_setting( 'realestaterightnow_menu_margin_top',
        	array(
        		'default' => '30',
                'sanitize_callback' => 'sanitize_text_field',                
        	)
        );
     $wp_customize->add_control( 'realestaterightnow_menu_margin_top', array(
      'type' => 'range',
      'section' => 'navigation_colors_section',
      'label' => __( 'Menu Margin Top', 'real-estate-right-now' ),
      'description' => __( 'Choose from -20 to 50 Pixels.', 'real-estate-right-now' ),
      'input_attrs' => array(
        'min' => -20,
        'max' => 50,
        'step' => 1,
      ),
    ) );
   $wp_customize->add_setting( 'realestaterightnow_menu_margin_right',
        	array(
        		'default' => '0',
                'sanitize_callback' => 'sanitize_text_field',                
        	)
        );
     $wp_customize->add_control( 'realestaterightnow_menu_margin_right', array(
      'type' => 'range',
      'section' => 'navigation_colors_section',
      'label' => __( 'Menu Margin Right', 'real-estate-right-now' ),
      'description' => __( 'Choose from -20 to 30 Pixels.', 'real-estate-right-now' ),
      'input_attrs' => array(
        'min' => -20,
        'max' => 30,
        'step' => 1,
      ),
    ) );   
    $wp_customize->add_setting( 'menu_font_size',
        	array(
        		'default' => '16',
               'sanitize_callback' => 'realestaterightnow_sanitize_number',        	)
        );
     $wp_customize->add_control( 'menu_font_size', array(
      'type' => 'range',
      'section' => 'navigation_colors_section',
      'label' => __( 'Menu Font Size', 'real-estate-right-now' ),
      'description' => __( 'Choose from 12 to 20 Pixels.', 'real-estate-right-now' ),
      'sanitize_callback' => 'realestaterightnow_sanitize_number',
      'input_attrs' => array(
        'min' => 12,
        'max' => 20,
        'step' => 1,
      ),
    ) );
    $wp_customize->add_setting( 'realestaterightnow_navigation_background',
    	array(
    		'default' => '#333333',
            'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realestaterightnow_navigation_background', array(
    			'label'    =>__( 'Background Navigation Color', 'real-estate-right-now' ),
                'section' => 'navigation_colors_section', 
    	        'settings' => 'realestaterightnow_navigation_background',
           		'priority' => 10,
    		)
    	)
    );
     $wp_customize->add_setting( 'realestaterightnow_menu_color',
    	array(
    		'default' => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realestaterightnow_menu_color', array(
    			'label'    =>__( 'Menu Text Color', 'real-estate-right-now' ),
                'section' => 'navigation_colors_section', 
    	        'settings' => 'realestaterightnow_menu_color',
           		'priority' => 10,
    		)
    	)
    ); 
   $wp_customize->add_setting( 'realestaterightnow_menu_hover_color',
    	array(
    		'default' => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realestaterightnow_menu_hover_color', array(
    			'label'    =>__( 'Menu Text Hover Color', 'real-estate-right-now' ),
                'section' => 'navigation_colors_section', 
    	        'settings' => 'realestaterightnow_menu_hover_color',
           		'priority' => 10,
    		)
    	)
    );   
     $wp_customize->add_setting( 'realestaterightnow_submenu_background',
    	array(
    		'default' => '#e65e23',
            'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realestaterightnow_submenu_background', array(
    			'label'    =>__( 'Sub Menu Background', 'real-estate-right-now' ),
                'section' => 'navigation_colors_section', 
    	        'settings' => 'realestaterightnow_submenu_background',
           		'priority' => 10,
    		)
    	)
    );     
      $wp_customize->add_setting( 'realestaterightnow_submenu_color',
    	array(
    		'default' => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realestaterightnow_submenu_color', array(
    			'label'    =>__( 'Sub Menu Text Color', 'real-estate-right-now' ),
                'section' => 'navigation_colors_section', 
    	        'settings' => 'realestaterightnow_submenu_color',
           		'priority' => 10,
    		)
    	)
    ); 
    $wp_customize->add_setting( 'realestaterightnow_submenu_hover_color',
    	array(
    		'default' => '#e65e23',
             'sanitize_callback' => 'sanitize_hex_color',           
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realestaterightnow_submenu_hover_color', array(
    			'label'    =>__( 'Sub Menu Hover color', 'real-estate-right-now' ),
                'section' => 'navigation_colors_section', 
    	        'settings' => 'realestaterightnow_submenu_hover_color',
           		'priority' => 10,
    		)
    	)
    );     
     $wp_customize->add_setting( 'realestaterightnow_submenu_hover_background',
    	array(
    		'default' => '#8D8B8B',
            'sanitize_callback' => 'sanitize_hex_color',           
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realestaterightnow_submenu_hover_background', array(
    			'label'    =>__( 'Sub Menu Hover Background', 'real-estate-right-now' ),
                'section' => 'navigation_colors_section', 
    	        'settings' => 'realestaterightnow_submenu_hover_background',
           		'priority' => 10,
    		)
    	)
    );        
/////////// End Navigation Colors
/////////// Social Menu
    $wp_customize->add_section( 
    	'social_navigation_section', 
    	array(
    		'title'       => __( 'Social Navigation Design', 'real-estate-right-now' ),
    		'priority'    => 101,
    		'capability'  => 'edit_theme_options',
            'panel'       => 'general',
    		'description' => '',
    	) 
    );
    $wp_customize->add_setting( 'realestaterightnow_social_menu', array(
      'default' =>'White' ,
      'sanitize_callback' =>'realestaterightnow_sanitize_text',
    ));
	$wp_customize->add_control(
		'realestaterightnow_social_menu',
		array(
			'settings'		=> 'realestaterightnow_social_menu',
			'section'		=> 'social_navigation_section',
			'type'			=> 'radio',
			'label'			=> __( 'Social Menu Color', 'real-estate-right-now' ),
			'description'	=> '',
			'choices'		=> array(
				'white' => __( 'White', 'real-estate-right-now' ),
				'lightgray' => __( 'Gray', 'real-estate-right-now' ),
			 	'darkgray' => __( 'Dark', 'real-estate-right-now' )
			)
		)
	);
// End Social
// Footer
      $wp_customize->add_section( 
    	'footer_settings_section', 
    	array(
    		'title'       => __( 'Footer Copyright', 'real-estate-right-now' ),
    		'priority'    => 100,
    		'capability'  => 'edit_theme_options',
    		'description' => '',
            'panel'       => 'general', 
    	) 
    );
    $wp_customize->add_setting('realestaterightnow_footer_copyright', array(
      'sanitize_callback' =>'realestaterightnow_sanitize_html', 
      'default'        => '',
     ));
    $wp_customize->add_control('realestaterightnow_footer_copyright', array(
     'label'   => __( 'Copyright Footer Text Here', 'real-estate-right-now' ),
      'section' => 'footer_settings_section',
     'type'    => 'textarea',
    ));            
    $wp_customize->add_setting( 'realestaterightnow_copyright_background',
    	array(
    		'default' => '#f1f1f1',
	    	'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realestaterightnow_copyright_background', array(
    			'label'    => __( 'Copyright Background Color', 'real-estate-right-now' ),
                'section' => 'footer_settings_section', 
    	        'settings' => 'realestaterightnow_copyright_background',
           		'priority' => 50,
    		)
    	)
    );
        $wp_customize->add_setting( 'realestaterightnow_copyright_color',
    	array(
    		'default' => '#333333',
	    	'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'realestaterightnow_copyright_color', array(
    			'label'    => __( 'Copyright Text Color', 'real-estate-right-now' ),
                'section' => 'footer_settings_section', 
    	        'settings' => 'realestaterightnow_copyright_color',
           		'priority' => 60,
    		)
    	)
    );
//First Footer Widget
//1-footer
function realestaterightnow_is_sidebar_active($index) {
	global $wp_registered_sidebars;
	$widgetcolums = wp_get_sidebars_widgets();
	if ($widgetcolums[$index])
		return true;
	return false;
}
if ( function_exists('realestaterightnow_is_sidebar_active')) {
    if( realestaterightnow_is_sidebar_active('1-footer')  or  realestaterightnow_is_sidebar_active('2-footer') or  realestaterightnow_is_sidebar_active('3-footer')  ) { 
    $wp_customize->add_section( 
    	'footer_background_section', 
    	array(
    		'title'       => __( 'Footer Background', 'real-estate-right-now' ),
    		'priority'    => 100,
    		'capability'  => 'edit_theme_options',
    		'description' => '',
            'panel'       => 'general', 
    	) 
    );
    $wp_customize->add_setting( 'realestaterightnow_footer_background', array(
      'default' =>'White' ,
      'sanitize_callback' =>'realestaterightnow_sanitize_text',
    ));
	$wp_customize->add_control(
		'realestaterightnow_footer_background',
		array(
			'settings'		=> 'realestaterightnow_footer_background',
			'section'		=> 'footer_background_section',
			'type'			=> 'radio',
			'label'			=> __( 'Footer Background Color', 'real-estate-right-now' ),
			'description'	=> 'To see the footer, you need add some widget there.',
			'choices'		=> array(
				'white' => __( 'White', 'real-estate-right-now' ),
				'lightgray' => __( 'Gray', 'real-estate-right-now' ),
			 	'darkgray' => __( 'Dark', 'real-estate-right-now' )
			)
		)
	);   
  }    
}    
/* End Footer  */

// Blog Settings
      $wp_customize->add_section( 
    	'blog_settings_section', 
    	array(
    		'title'       => __( 'Blog Settings', 'real-estate-right-now' ),
    		'priority'    => 100,
    		'capability'  => 'edit_theme_options',
    		'description' => 'Configure Blog style.',
            'panel'       => 'general', 
    	) 
    );
    $wp_customize->add_setting( 'realestaterightnow_blog_style', array(
      'default' =>'3' ,
      'sanitize_callback' =>'realestaterightnow_sanitize_text',
    ));
	$wp_customize->add_control(
		'realestaterightnow_blog_style',
		array(
			'settings'		=> 'realestaterightnow_blog_style',
			'section'		=> 'blog_settings_section',
			'type'			=> 'select',
			'label'			=> __( 'Choose Blog Page Style', 'real-estate-right-now' ),
			'description'	=> 'Look the right panel (and go to blog page) to see the preview...',
			'choices'		=> array(
				'1' => 'Blog Standard',
				'2' => 'Blog List View',
                '3' => 'Blog Masonry', 
			)
		)
	);
$wp_customize->add_setting('realestaterightnow_blog_post_meta', array(
     'sanitize_callback' =>'realestaterightnow_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control( 'realestaterightnow_blog_post_meta', array(
				'label'    => __( 'Turn on to display post meta on blog single posts page','real-estate-right-now' ),
				'section'  => 'blog_settings_section',
				'settings' => 'realestaterightnow_blog_post_meta',
				'type'     => 'checkbox',
			) );
$wp_customize->add_setting('realestaterightnow_blog_post_author', array(
     'sanitize_callback' =>'realestaterightnow_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control( 'realestaterightnow_blog_post_author', array(
				'label'    => __( 'Turn on to display post author on blog single posts page','real-estate-right-now' ),
				'section'  => 'blog_settings_section',
				'settings' => 'realestaterightnow_blog_post_author',
				'type'     => 'checkbox',
			) );
$wp_customize->add_setting('realestaterightnow_blog_post_categories', array(
     'sanitize_callback' =>'realestaterightnow_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control( 'realestaterightnow_blog_post_categories', array(
				'label'    => __( 'Turn on to display categories on blog posts','real-estate-right-now' ),
				'section'  => 'blog_settings_section',
				'settings' => 'realestaterightnow_blog_post_categories',
				'type'     => 'checkbox',
			) );
$wp_customize->add_setting('realestaterightnow_blog_post_date', array(
     'sanitize_callback' =>'realestaterightnow_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control( 'realestaterightnow_blog_post_date', array(
				'label'    => __( 'Turn on to display date on blog posts','real-estate-right-now' ),
				'section'  => 'blog_settings_section',
				'settings' => 'realestaterightnow_blog_post_date',
				'type'     => 'checkbox',
			) );
            
// Sidebar
$wp_customize->add_setting('realestaterightnow_blog_sidebar', array(
     'sanitize_callback' =>'realestaterightnow_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control( 'realestaterightnow_blog_sidebar', array(
				'label'    => __( 'Turn on to display sidebar on posts page.','real-estate-right-now' ),
				'section'  => 'blog_settings_section',
				'settings' => 'realestaterightnow_blog_sidebar',
				'type'     => 'checkbox',
			) );         
$wp_customize->add_setting('realestaterightnow_show_sidebar_singlepage', array(
     'sanitize_callback' =>'realestaterightnow_sanitize_checkbox',
     'default' => '1'
     ));
$wp_customize->add_control(
		'realestaterightnow_show_sidebar_singlepage',
		array(
			'settings'		=> 'realestaterightnow_show_sidebar_singlepage',
            'section' => 'blog_settings_section',
			'type'			=> 'checkbox',
			'label'			=> __( 'Turn on to display sidebar at all blog single post pages.', 'real-estate-right-now' ),
			'description'	=> '',
            'sanitize_callback' => 'realestaterightnow_sanitize_checkbox',            
		)
	);   
// End Sidebar
// miscellany
      $wp_customize->add_section( 
    	'theme_miscellany_section', 
    	array(
    		'title'       => __( 'Miscellany', 'real-estate-right-now' ),
    		'priority'    => 900,
    		'capability'  => 'edit_theme_options',
    		'description' => 'Configure Theme Preloader, Search Icon and Back to top. ',
            'panel'       => 'general', 
    	) 
    );
$wp_customize->add_setting('realestaterightnow_preloader', array(
     'sanitize_callback' =>'realestaterightnow_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control( 'realestaterightnow_preloader', array(
				'label'    => __( 'Turn on the Preloader','real-estate-right-now' ),
				'section'  => 'theme_miscellany_section',
				'settings' => 'realestaterightnow_preloader',
				'type'     => 'checkbox',
			) );
$wp_customize->add_setting('realestaterightnow_search_icon', array(
     'sanitize_callback' =>'realestaterightnow_sanitize_checkbox', 
     'default' => '1',
    /*  'transport'   => 'refresh', */
     'transport' => 'postMessage',
     ));
$wp_customize->add_control( 'realestaterightnow_search_icon', array(
				'label'    => __( 'Turn on the Search Icon','real-estate-right-now' ),
				'section'  => 'theme_miscellany_section',
				'settings' => 'realestaterightnow_search_icon',
				'type'     => 'checkbox',
			) );
$wp_customize->add_setting('realestaterightnow_back_to_top', array(
     'sanitize_callback' =>'realestaterightnow_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control( 'realestaterightnow_back_to_top', array(
				'label'    => __( 'Turn on the Back to Top Button','real-estate-right-now' ),
				'section'  => 'theme_miscellany_section',
				'settings' => 'realestaterightnow_back_to_top',
				'type'     => 'checkbox',
			) );
// end miscellany

/* Sanitize with absint */
function realestaterightnow_sanitize_phone ( $str ) {
        $str = sanitize_text_field( $str );   
        if(empty ($str))
           return "";
        $size = strlen($str);
        $r = '';
        for($i=0; $i < $size; $i++)
        {
           $w = substr($str, $i, 1);
           if($w != '.' and $w != '-')
             $w = absint($w);
           $r .= $w;
        }
        Return $r;
    }
    function realestaterightnow_sanitize_html( $str ) {
    $allowed_html = array(
		'a' => array(
			'href' => true,
			'title' => true,
		),
		'abbr' => array(
			'title' => true,
		),
		'acronym' => array(
			'title' => true,
		),
		'b' => array(),
		'blockquote' => array(
			'cite' => true,
		),
		'cite' => array(),
		'code' => array(),
		'del' => array(
			'datetime' => true,
		),
		'em' => array(),
		'i' => array(),
		'q' => array(
			'cite' => true,
		),
		'strike' => array(),
		'strong' => array(),
	);
        wp_kses($str, $allowed_html); 
        return $str ;
    }    
    function realestaterightnow_sanitize_url( $str ) {
        return esc_url( $str );
    } 
    function realestaterightnow_sanitize_text( $str ) {
        return sanitize_text_field( $str );
    }
    function realestaterightnow_sanitize_number( $str ) {
        return sanitize_text_field( $str );
    }  
    function realestaterightnow_sanitize_textarea( $text ) {
        return esc_textarea( $text );
    } 
    function realestaterightnow_sanitize_email( $text ) {
        return sanitize_email( $text );
    } 
    function realestaterightnow_sanitize_checkbox( $input ) {
       return absint($input);
    }
}
//add_action( 'after_setup_theme', 'realestaterightnow_custom_site' );
add_action( 'customize_register', 'realestaterightnow_custom_site', 11 );
if ( ! function_exists( 'realestaterightnow_header_style' ) ) :
/**
 * Styles the header text displayed on the site.
 *
 * Create your own realestaterightnow_header_style() function to override in a child theme.
 *
 * @since real estate 1.0
 *
 * @see realestaterightnow_custom_header_and_background().
 */
function realestaterightnow_header_style() {
	// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
		 return;
	}
	// If the header text has been hidden.
	?>
	<style type="text/css" id="realestaterightnow-header-css">
		.site-branding {
			margin: 0 auto 0 0;
		}
		.site-branding .site-title,
		.site-description {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	</style>
	<?php
}
endif; // realestaterightnow_header_style
/**
 * Adds postMessage support for site title and description for the Customizer.
 *
 * @since real estate 1.0
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function realestaterightnow_customize_register( $wp_customize ) {
	$color_scheme = realestaterightnow_get_color_scheme();
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'realestaterightnow_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'realestaterightnow_customize_partial_blogdescription',
		) );
	}
	// Add color scheme setting and control.
	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'default',
		'sanitize_callback' => 'realestaterightnow_sanitize_color_scheme',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'color_scheme', array(
		'label'    => __( 'Base Color Scheme', 'real-estate-right-now' ),
		'section'  => 'colors',
		'type'     => 'select',
		'choices'  => realestaterightnow_get_color_scheme_choices(),
		'priority' => 1,
	) );
	// Add page background color setting and control.
	$wp_customize->add_setting( 'page_background_color', array(
		'default'           => $color_scheme[1],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_background_color', array(
		'label'       => __( 'Page Background Color', 'real-estate-right-now' ),
		'section'     => 'colors',
	) ) );
	// Remove the core header textcolor control, as it shares the main text color.
	$wp_customize->remove_control( 'header_textcolor' );
	// Add link color setting and control.
	$wp_customize->add_setting( 'link_color', array(
		'default'           => $color_scheme[2],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'       => __( 'Link Color', 'real-estate-right-now' ),
		'section'     => 'colors',
	) ) );
	// Add main text color setting and control.
	$wp_customize->add_setting( 'main_text_color', array(
		'default'           => $color_scheme[3],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_text_color', array(
		'label'       => __( 'Main Text Color', 'real-estate-right-now' ),
		'section'     => 'colors',
	) ) );
	// Add secondary text color setting and control.
	$wp_customize->add_setting( 'secondary_text_color', array(
		'default'           => $color_scheme[4],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_text_color', array(
		'label'       => __( 'Secondary Text Color', 'real-estate-right-now' ),
		'section'     => 'colors',
	) ) );
}
add_action( 'customize_register', 'realestaterightnow_customize_register', 11 );
/**
 * Render the site title for the selective refresh partial.
 *
 * @since real estate 1.2
 * @see realestaterightnow_customize_register()
 *
 * @return void
 */
function realestaterightnow_customize_partial_blogname() {
	bloginfo( 'name' );
}
/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since real estate 1.2
 * @see realestaterightnow_customize_register()
 *
 * @return void
 */
function realestaterightnow_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
/**
 * Registers color schemes for real estate.
 *
 * Can be filtered with {@see 'realestaterightnow_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Page Background Color.
 * 3. Link Color.
 * 4. Main Text Color.
 * 5. Secondary Text Color.
 * 6. Footer Color
 *
 * @since real estate 1.0
 *
 * @return array An associative array of color scheme options.
 */
function realestaterightnow_get_color_schemes() {
	/**
	 * Filter the color schemes registered for use with real estate.
	 *
	 * The default schemes include 'default', 'dark', 'gray', 'red', and 'yellow'.
	 *
	 * @since real estate 1.0
	 *
	 * @param array $schemes {
	 *     Associative array of color schemes data.
	 *
	 *     @type array $slug {
	 *         Associative array of information for setting up the color scheme.
	 *
	 *         @type string $label  Color scheme label.
	 *         @type array  $colors HEX codes for default colors prepended with a hash symbol ('#').
	 *                              Colors are defined in the following order: Main background, page
	 *                              background, link, main text, secondary text.
	 *     }
	 * }
	 */
	return apply_filters( 'realestaterightnow_color_schemes', array(
		'default' => array(
			'label'  => __( 'Default', 'real-estate-right-now' ),
			'colors' => array(
				'#1a1a1a',
				'#ffffff',
				'#007acc',
				'#1a1a1a',
				'#686868',
                '#F1F0F0',
			),
		),
		'dark' => array(
			'label'  => __( 'Dark', 'real-estate-right-now' ),
			'colors' => array(
				'#262626',
				'#1a1a1a',
				'#9adffd',
				'#e5e5e5',
				'#c1c1c1',
                '#616a73',
			),
		),
		'gray' => array(
			'label'  => __( 'Gray', 'real-estate-right-now' ),
			'colors' => array(
				'#616a73',
				'#4d545c',
				'#c7c7c7',
				'#f2f2f2',
				'#f2f2f2',
                '#F1F0F0',
			),
		),
		'red' => array(
			'label'  => __( 'Orange', 'real-estate-right-now' ),
			'colors' => array(
				'#E65E23',
				'#ffffff',
				'#640c1f',
				'#402b30',
				'#402b30',
                '#F1F0F0',
			),
		),
		'yellow' => array(
			'label'  => __( 'Blue', 'real-estate-right-now' ),
			'colors' => array(
				'#005681',
				'#ffffff',
				'#774e24',
				'#3b3721',
				'#5b4d3e',
                '#F1F0F0',
			),
		),
	) );
}
if ( ! function_exists( 'realestaterightnow_get_color_scheme' ) ) :
/**
 * Retrieves the current real estate color scheme.
 *
 * Create your own realestaterightnow_get_color_scheme() function to override in a child theme.
 *
 * @since real estate 1.0
 *
 * @return array An associative array of either the current or default color scheme HEX values.
 */
function realestaterightnow_get_color_scheme() {
	$color_scheme_option = esc_html(get_theme_mod( 'color_scheme', 'default' ));
	$color_schemes       = realestaterightnow_get_color_schemes();
	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}
	return $color_schemes['default']['colors'];
}
endif; // realestaterightnow_get_color_scheme
if ( ! function_exists( 'realestaterightnow_get_color_scheme_choices' ) ) :
/**
 * Retrieves an array of color scheme choices registered for real estate.
 *
 * Create your own realestaterightnow_get_color_scheme_choices() function to override
 * in a child theme.
 *
 * @since real estate 1.0
 *
 * @return array Array of color schemes.
 */
function realestaterightnow_get_color_scheme_choices() {
	$color_schemes                = realestaterightnow_get_color_schemes();
	$color_scheme_control_options = array();
	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}
	return $color_scheme_control_options;
}
endif; // realestaterightnow_get_color_scheme_choices
if ( ! function_exists( 'realestaterightnow_sanitize_color_scheme' ) ) :
/**
 * Handles sanitization for real estate color schemes.
 *
 * Create your own realestaterightnow_sanitize_color_scheme() function to override
 * in a child theme.
 *
 * @since real estate 1.0
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function realestaterightnow_sanitize_color_scheme( $value ) {
	$color_schemes = realestaterightnow_get_color_scheme_choices();
	if ( ! array_key_exists( $value, $color_schemes ) ) {
		return 'default';
	}
	return $value;
}
endif; // realestaterightnow_sanitize_color_scheme
/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since real estate 1.0
 *
 * @see wp_add_inline_style()
 */
function realestaterightnow_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	// Don't do anything if the default color scheme is selected.
	if ( 'default' === $color_scheme_option ) {
		return;
	}
	$color_scheme = realestaterightnow_get_color_scheme();
	// Convert main text hex color to rgba.
	$color_textcolor_rgb = realestaterightnow_hex2rgb( $color_scheme[3] );
	// If the rgba values are empty return early.
	if ( empty( $color_textcolor_rgb ) ) {
		return;
	}
	// If we get this far, we have a custom color scheme.
	$colors = array(
		'background_color'      => $color_scheme[0],
		'page_background_color' => $color_scheme[1],
		'link_color'            => $color_scheme[2],
		'main_text_color'       => $color_scheme[3],
		'secondary_text_color'  => $color_scheme[4],
		'footer_color'          => $color_scheme[5],
    	'border_color'          => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.2)', $color_textcolor_rgb ),
	);
	$color_scheme_css = realestaterightnow_get_color_scheme_css( $colors );
	wp_add_inline_style( 'realestaterightnow-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'realestaterightnow_color_scheme_css' );
/**
 * Binds the JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since real estate 1.0
 */
function realestaterightnow_customize_color_control_js() {
	wp_enqueue_script( 'realestaterightnow-color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20160816', true );
	wp_localize_script( 'realestaterightnow-color-scheme-control', 'colorScheme', realestaterightnow_get_color_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'realestaterightnow_customize_color_control_js' );
/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since real estate 1.0
 */
function realestaterightnow_customize_preview_js() {
	wp_enqueue_script( 'realestaterightnow-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20160816', true );
}
add_action( 'customize_preview_init', 'realestaterightnow_customize_preview_js' );
/**
 * Returns CSS for the color schemes.
 *
 * @since real estate 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function realestaterightnow_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'background_color'      => '',
		'page_background_color' => '',
		'link_color'            => '',
		'main_text_color'       => '',
		'secondary_text_color'  => '',
  		'footer_color'          => '',
  		'border_color'          => '',
	) );
	return <<<CSS
	/* Color Scheme */
	/* Background Color */
	body {
		background-color: {$colors['background_color']};
	}
	/* Page Background Color */
	.site {
		background-color: {$colors['page_background_color']};
	}
	mark,
	ins,
	button,
	button[disabled]:hover,
	button[disabled]:focus,
	input[type="button"],
	input[type="button"][disabled]:hover,
	input[type="button"][disabled]:focus,
	input[type="reset"],
	input[type="reset"][disabled]:hover,
	input[type="reset"][disabled]:focus,
	input[type="submit"],
	input[type="submit"][disabled]:hover,
	input[type="submit"][disabled]:focus,
	.menu-toggle.toggled-on,
	.menu-toggle.toggled-on:hover,
	.menu-toggle.toggled-on:focus,
	.pagination .prev,
	.pagination .next,
	.pagination .prev:hover,
	.pagination .prev:focus,
	.pagination .next:hover,
	.pagination .next:focus,
	.pagination .nav-links:before,
	.pagination .nav-links:after,
	.widget_calendar tbody a,
	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus,
	.page-links a,
	.page-links a:hover,
	.page-links a:focus {
		color: {$colors['page_background_color']};
	}
	/* Link Color */
	.menu-toggle:hover,
	.menu-toggle:focus,
	a,
	.main-navigation a:hover,
	.main-navigation a:focus,
	.dropdown-toggle:hover,
	.dropdown-toggle:focus,
	.social-navigation a:hover:before,
	.social-navigation a:focus:before,
	.post-navigation a:hover .post-title,
	.post-navigation a:focus .post-title,
	.tagcloud a:hover,
	.tagcloud a:focus,
	.site-branding .site-title a:hover,
	.site-branding .site-title a:focus,
	.entry-title a:hover,
	.entry-title a:focus,
	.entry-footer a:hover,
	.entry-footer a:focus,
	.comment-metadata a:hover,
	.comment-metadata a:focus,
	.pingback .comment-edit-link:hover,
	.pingback .comment-edit-link:focus,
	.comment-reply-link,
	.comment-reply-link:hover,
	.comment-reply-link:focus,
	.required,
	.site-info a:hover,
	.site-info a:focus {
		color: {$colors['link_color']};
	}
	mark,
	ins,
	button:hover,
	button:focus,
	input[type="button"]:hover,
	input[type="button"]:focus,
	input[type="reset"]:hover,
	input[type="reset"]:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus,
	.pagination .prev:hover,
	.pagination .prev:focus,
	.pagination .next:hover,
	.pagination .next:focus,
	.widget_calendar tbody a,
	.page-links a:hover,
	.page-links a:focus {
		background-color: {$colors['link_color']};
	}
	input[type="date"]:focus,
	input[type="time"]:focus,
	input[type="datetime-local"]:focus,
	input[type="week"]:focus,
	input[type="month"]:focus,
	input[type="text"]:focus,
	input[type="email"]:focus,
	input[type="url"]:focus,
	input[type="password"]:focus,
	input[type="search"]:focus,
	input[type="tel"]:focus,
	input[type="number"]:focus,
	textarea:focus,
	.tagcloud a:hover,
	.tagcloud a:focus,
	.menu-toggle:hover,
	.menu-toggle:focus {
		border-color: {$colors['link_color']};
	}
	/* Main Text Color */
	body,
	blockquote cite,
	blockquote small,
	.main-navigation a,
	.menu-toggle,
	.dropdown-toggle,
	.social-navigation a,
	.post-navigation a,
	.pagination a:hover,
	.pagination a:focus,
	.widget-title a,
	.site-branding .site-title a,
	.entry-title a,
	.page-links > .page-links-title,
	.comment-author,
	.comment-reply-title small a:hover,
	.comment-reply-title small a:focus {
		color: {$colors['main_text_color']};
	}
	blockquote,
	.menu-toggle.toggled-on,
	.menu-toggle.toggled-on:hover,
	.menu-toggle.toggled-on:focus,
	.post-navigation,
	.post-navigation div + div,
	.pagination,
	.widget,
	.page-header,
	.page-links a,
	.comments-title,
	.comment-reply-title {
		border-color: {$colors['main_text_color']};
	}
	button,
	button[disabled]:hover,
	button[disabled]:focus,
	input[type="button"],
	input[type="button"][disabled]:hover,
	input[type="button"][disabled]:focus,
	input[type="reset"],
	input[type="reset"][disabled]:hover,
	input[type="reset"][disabled]:focus,
	input[type="submit"],
	input[type="submit"][disabled]:hover,
	input[type="submit"][disabled]:focus,
	.menu-toggle.toggled-on,
	.menu-toggle.toggled-on:hover,
	.menu-toggle.toggled-on:focus,
	.pagination:before,
	.pagination:after,
	.pagination .prev,
	.pagination .next,
	.page-links a {
		background-color: {$colors['main_text_color']};
	}
	/* Secondary Text Color */
	/**
	 * IE8 and earlier will drop any block with CSS3 selectors.
	 * Do not combine these styles with the next block.
	 */
	body:not(.search-results) .entry-summary {
		color: {$colors['secondary_text_color']};
	}
	blockquote,
	.post-password-form label,
	a:hover,
	a:focus,
	a:active,
	.post-navigation .meta-nav,
	.image-navigation,
	.comment-navigation,
	.widget_recent_entries .post-date,
	.widget_rss .rss-date,
	.widget_rss cite,
	.site-description,
	.author-bio,
	.entry-footer,
	.entry-footer a,
	.sticky-post,
	.taxonomy-description,
	.entry-caption,
	.comment-metadata,
	.pingback .edit-link,
	.comment-metadata a,
	.pingback .comment-edit-link,
	.comment-form label,
	.comment-notes,
	.comment-awaiting-moderation,
	.logged-in-as,
	.form-allowed-tags,
	.site-info,
	.site-info a,
	.wp-caption .wp-caption-text,
	.gallery-caption,
	.widecolumn label,
	.widecolumn .mu_register label {
		color: {$colors['secondary_text_color']};
	}
	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus {
		background-color: {$colors['secondary_text_color']};
	}
	/* Border Color */
	fieldset,
	pre,
	abbr,
	acronym,
	table,
	th,
	td,
	input[type="date"],
	input[type="time"],
	input[type="datetime-local"],
	input[type="week"],
	input[type="month"],
	input[type="text"],
	input[type="email"],
	input[type="url"],
	input[type="password"],
	input[type="search"],
	input[type="tel"],
	input[type="number"],
	textarea,
	.main-navigation li,
	.main-navigation .primary-menu,
	.menu-toggle,
	.dropdown-toggle:after,
	.social-navigation a,
	.image-navigation,
	.comment-navigation,
	.tagcloud a,
	.entry-content,
	.entry-summary,
	.page-links a,
	.page-links > span,
	.comment-list article,
	.comment-list .pingback,
	.comment-list .trackback,
	.comment-reply-link,
	.no-comments,
	.widecolumn .mu_register .mu_alert {
		border-color: {$colors['main_text_color']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['border_color']};
	}
	hr,
	code {
		background-color: {$colors['main_text_color']}; /* Fallback for IE7 and IE8 */
		background-color: {$colors['border_color']};
	}
    /*  Footer ///// */  
       .site-footer {
        background: {$colors['border_color']};
	}
	@media screen and (min-width: 56.875em) {
		.main-navigation li:hover > a,
		.main-navigation li.focus > a {
			color: {$colors['link_color']};
		}
		.main-navigation ul ul,
		.main-navigation ul ul li {
			border-color: {$colors['border_color']};
		}
		.main-navigation ul ul:before {
			border-top-color: {$colors['border_color']};
			border-bottom-color: {$colors['border_color']};
		}
		.main-navigation ul ul li {
			background-color: {$colors['page_background_color']};
		}
		.main-navigation ul ul:after {
			border-top-color: {$colors['page_background_color']};
			border-bottom-color: {$colors['page_background_color']};
		}
	}
CSS;
}
/**
 * Outputs an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the
 * Customizer preview.
 *
 * @since real estate 1.0
 */
function realestaterightnow_color_scheme_css_template() {
	$colors = array(
		'background_color'      => '{{ data.background_color }}',
		'page_background_color' => '{{ data.page_background_color }}',
		'link_color'            => '{{ data.link_color }}',
		'main_text_color'       => '{{ data.main_text_color }}',
		'secondary_text_color'  => '{{ data.secondary_text_color }}',
		'border_color'          => '{{ data.border_color }}',
	);
	?>
	<script type="text/html" id="tmpl-realestaterightnow-color-scheme">
		<?php echo realestaterightnow_get_color_scheme_css( $colors ); ?>
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'realestaterightnow_color_scheme_css_template' );
/**
 * Enqueues front-end CSS for the page background color.
 *
 * @since real estate 1.0
 *
 * @see wp_add_inline_style()
 */
function realestaterightnow_page_background_color_css() {
	$color_scheme          = realestaterightnow_get_color_scheme();
	$default_color         = $color_scheme[1];
	$page_background_color = get_theme_mod( 'page_background_color', $default_color );
	// Don't do anything if the current color is the default.
	if ( $page_background_color === $default_color ) {
		return;
	}
	$css = '
		/* Custom Page Background Color */
		.site {
			background-color: %1$s;
		}
		mark,
		ins,
		button,
		button[disabled]:hover,
		button[disabled]:focus,
		input[type="button"],
		input[type="button"][disabled]:hover,
		input[type="button"][disabled]:focus,
		input[type="reset"],
		input[type="reset"][disabled]:hover,
		input[type="reset"][disabled]:focus,
		input[type="submit"],
		input[type="submit"][disabled]:hover,
		input[type="submit"][disabled]:focus,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,
		.pagination .prev,
		.pagination .next,
		.pagination .prev:hover,
		.pagination .prev:focus,
		.pagination .next:hover,
		.pagination .next:focus,
		.pagination .nav-links:before,
		.pagination .nav-links:after,
		.widget_calendar tbody a,
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus,
		.page-links a,
		.page-links a:hover,
		.page-links a:focus {
			color: %1$s;
		}
		@media screen and (min-width: 56.875em) {
			.main-navigation ul ul li {
				background-color: %1$s;
			}
			.main-navigation ul ul:after {
				border-top-color: %1$s;
				border-bottom-color: %1$s;
			}
		}
	';
	wp_add_inline_style( 'realestaterightnow-style', sprintf( $css, $page_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'realestaterightnow_page_background_color_css', 11 );
/**
 * Enqueues front-end CSS for the link color.
 *
 * @since real estate 1.0
 *
 * @see wp_add_inline_style()
 */
function realestaterightnow_link_color_css() {
	$color_scheme    = realestaterightnow_get_color_scheme();
	$default_color   = $color_scheme[2];
	$link_color = get_theme_mod( 'link_color', $default_color );
	// Don't do anything if the current color is the default.
	if ( $link_color === $default_color ) {
		return;
	}
	$css = '
		/* Custom Link Color */
		.menu-toggle:hover,
		.menu-toggle:focus,
		a,
		.main-navigation a:hover,
		.main-navigation a:focus,
		.dropdown-toggle:hover,
		.dropdown-toggle:focus,
		.social-navigation a:hover:before,
		.social-navigation a:focus:before,
		.post-navigation a:hover .post-title,
		.post-navigation a:focus .post-title,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.site-branding .site-title a:hover,
		.site-branding .site-title a:focus,
		.entry-title a:hover,
		.entry-title a:focus,
		.entry-footer a:hover,
		.entry-footer a:focus,
		.comment-metadata a:hover,
		.comment-metadata a:focus,
		.pingback .comment-edit-link:hover,
		.pingback .comment-edit-link:focus,
		.comment-reply-link,
		.comment-reply-link:hover,
		.comment-reply-link:focus,
		.required,
		.site-info a:hover,
		.site-info a:focus {
			color: %1$s;
		}
		mark,
		ins,
		button:hover,
		button:focus,
		input[type="button"]:hover,
		input[type="button"]:focus,
		input[type="reset"]:hover,
		input[type="reset"]:focus,
		input[type="submit"]:hover,
		input[type="submit"]:focus,
		.pagination .prev:hover,
		.pagination .prev:focus,
		.pagination .next:hover,
		.pagination .next:focus,
		.widget_calendar tbody a,
		.page-links a:hover,
		.page-links a:focus {
			background-color: %1$s;
		}
		input[type="date"]:focus,
		input[type="time"]:focus,
		input[type="datetime-local"]:focus,
		input[type="week"]:focus,
		input[type="month"]:focus,
		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		input[type="tel"]:focus,
		input[type="number"]:focus,
		textarea:focus,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.menu-toggle:hover,
		.menu-toggle:focus {
			border-color: %1$s;
		}
		@media screen and (min-width: 56.875em) {
			.main-navigation li:hover > a,
			.main-navigation li.focus > a {
				color: %1$s;
			}
		}
	';
	wp_add_inline_style( 'realestaterightnow-style', sprintf( $css, $link_color ) );
}
add_action( 'wp_enqueue_scripts', 'realestaterightnow_link_color_css', 11 );
/**
 * Enqueues front-end CSS for the main text color.
 *
 * @since real estate 1.0
 *
 * @see wp_add_inline_style()
 */
function realestaterightnow_main_text_color_css() {
	$color_scheme    = realestaterightnow_get_color_scheme();
	$default_color   = $color_scheme[3];
	$main_text_color = get_theme_mod( 'main_text_color', $default_color );
	// Don't do anything if the current color is the default.
	if ( $main_text_color === $default_color ) {
		return;
	}
	// Convert main text hex color to rgba.
	$main_text_color_rgb = realestaterightnow_hex2rgb( $main_text_color );
	// If the rgba values are empty return early.
	if ( empty( $main_text_color_rgb ) ) {
		return;
	}
	// If we get this far, we have a custom color scheme.
	$border_color = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.2)', $main_text_color_rgb );
	$css = '
		/* Custom Main Text Color */
		body,
		blockquote cite,
		blockquote small,
		.main-navigation a,
		.menu-toggle,
		.dropdown-toggle,
		.social-navigation a,
		.post-navigation a,
		.pagination a:hover,
		.pagination a:focus,
		.widget-title a,
		.site-branding .site-title a,
		.entry-title a,
		.page-links > .page-links-title,
		.comment-author,
		.comment-reply-title small a:hover,
		.comment-reply-title small a:focus {
			color: %1$s
		}
		blockquote,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,
		.post-navigation,
		.post-navigation div + div,
		.pagination,
		.widget,
		.page-header,
		.page-links a,
		.comments-title,
		.comment-reply-title {
			border-color: %1$s;
		}
		button,
		button[disabled]:hover,
		button[disabled]:focus,
		input[type="button"],
		input[type="button"][disabled]:hover,
		input[type="button"][disabled]:focus,
		input[type="reset"],
		input[type="reset"][disabled]:hover,
		input[type="reset"][disabled]:focus,
		input[type="submit"],
		input[type="submit"][disabled]:hover,
		input[type="submit"][disabled]:focus,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,
		.pagination:before,
		.pagination:after,
		.pagination .prev,
		.pagination .next,
		.page-links a {
			background-color: %1$s;
		}
		/* Border Color */
		fieldset,
		pre,
		abbr,
		acronym,
		table,
		th,
		td,
		input[type="date"],
		input[type="time"],
		input[type="datetime-local"],
		input[type="week"],
		input[type="month"],
		input[type="text"],
		input[type="email"],
		input[type="url"],
		input[type="password"],
		input[type="search"],
		input[type="tel"],
		input[type="number"],
		textarea,
		.main-navigation li,
		.main-navigation .primary-menu,
		.menu-toggle,
		.dropdown-toggle:after,
		.social-navigation a,
		.image-navigation,
		.comment-navigation,
		.tagcloud a,
		.entry-content,
		.entry-summary,
		.page-links a,
		.page-links > span,
		.comment-list article,
		.comment-list .pingback,
		.comment-list .trackback,
		.comment-reply-link,
		.no-comments,
		.widecolumn .mu_register .mu_alert {
			border-color: %1$s; /* Fallback for IE7 and IE8 */
			border-color: %2$s;
		}
		hr,
		code {
			background-color: %1$s; /* Fallback for IE7 and IE8 */
			background-color: %2$s;
		}
		@media screen and (min-width: 56.875em) {
			.main-navigation ul ul,
			.main-navigation ul ul li {
				border-color: %2$s;
			}
			.main-navigation ul ul:before {
				border-top-color: %2$s;
				border-bottom-color: %2$s;
			}
		}
	';
	wp_add_inline_style( 'realestaterightnow-style', sprintf( $css, $main_text_color, $border_color ) );
}
add_action( 'wp_enqueue_scripts', 'realestaterightnow_main_text_color_css', 11 );
/**
 * Enqueues front-end CSS for the secondary text color.
 *
 * @since real estate 1.0
 *
 * @see wp_add_inline_style()
 */
function realestaterightnow_secondary_text_color_css() {
	$color_scheme    = realestaterightnow_get_color_scheme();
	$default_color   = $color_scheme[4];
	$secondary_text_color = get_theme_mod( 'secondary_text_color', $default_color );
	// Don't do anything if the current color is the default.
	if ( $secondary_text_color === $default_color ) {
		return;
	}
	$css = '
		/* Custom Secondary Text Color */
		/**
		 * IE8 and earlier will drop any block with CSS3 selectors.
		 * Do not combine these styles with the next block.
		 */
		body:not(.search-results) .entry-summary {
			color: %1$s;
		}
		blockquote,
		.post-password-form label,
		a:hover,
		a:focus,
		a:active,
		.post-navigation .meta-nav,
		.image-navigation,
		.comment-navigation,
		.widget_recent_entries .post-date,
		.widget_rss .rss-date,
		.widget_rss cite,
		.site-description,
		.author-bio,
		.entry-footer,
		.entry-footer a,
		.sticky-post,
		.taxonomy-description,
		.entry-caption,
		.comment-metadata,
		.pingback .edit-link,
		.comment-metadata a,
		.pingback .comment-edit-link,
		.comment-form label,
		.comment-notes,
		.comment-awaiting-moderation,
		.logged-in-as,
		.form-allowed-tags,
		.site-info,
		.site-info a,
		.wp-caption .wp-caption-text,
		.gallery-caption,
		.widecolumn label,
		.widecolumn .mu_register label {
			color: %1$s;
		}
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus {
			background-color: %1$s;
		}
	';
	wp_add_inline_style( 'realestaterightnow-style', sprintf( $css, $secondary_text_color ) );
}
add_action( 'wp_enqueue_scripts', 'realestaterightnow_secondary_text_color_css', 11 );
add_action( 'wp_head' , 'realestaterightnow_dynamic_css' );
function realestaterightnow_dynamic_css() { ?>
 <style type='text/css'>
    .entry-title
     { 
     <?php
     $realestaterightnow_entry_title = esc_html(get_theme_mod('realestaterightnow_entry_title',1)); 
     if($realestaterightnow_entry_title == 1)
      {
        echo 'display:block;';
      } 
      else
      {
        echo 'display:none;';     
      }
      ?>    
    }
<?php 
 $realestaterightnow_icon_color = trim(esc_html(get_theme_mod('realestaterightnow_topinfo_color','gray')));
 $realestaterightnow_topinfo_color = $realestaterightnow_icon_color;
 $realestaterightnow_topinfo_email = trim(esc_html(get_theme_mod('realestaterightnow_topinfo_email','')));
 $realestaterightnow_topinfo_phone = trim(esc_html(get_theme_mod('realestaterightnow_topinfo_phone','')));
 $realestaterightnow_topinfo_hours = trim(esc_html(get_theme_mod('realestaterightnow_topinfo_hours','')));
 $mycopyrightbackground = esc_html(get_theme_mod('realestaterightnow_copyright_background','#ffffff'));
 $mycopyrightcolor = esc_html(get_theme_mod('realestaterightnow_copyright_color','#7a7a7a'));
 $footerbkcolor = esc_html(get_theme_mod('realestaterightnow_footer_background','#ffffff'));
 $realestaterightnow_show_top_header = esc_html(get_theme_mod('realestaterightnow_show_top_header','Yes'));
 $realestaterightnow_layout_type = esc_html(get_theme_mod('realestaterightnow_layout_type',2)); 
 $realestaterightnow_logo_margin_top = esc_html(get_theme_mod('realestaterightnow_logo_margin_top',0)); 
 $realestaterightnow_opacity = esc_html(get_theme_mod('realestaterightnow_opacity', 10)/10);
    if($realestaterightnow_layout_type == 1) { ?>
        #wrapper
        	{ 
            	 max-width:1000px !important;
                 opacity: <?php echo $realestaterightnow_opacity;?> !important; 
             }  
    <?php }
    elseif ($realestaterightnow_layout_type == 2)  { ?>
         #wrapper
        	{ 
            	 max-width:100% !important;
                 opacity: <?php echo $realestaterightnow_opacity;?> !important;
             }  
    <?php } 
    else { ?>
         #wrapper
        	{ 
       	         max-width:1200px !important;
                 opacity: <?php echo $realestaterightnow_opacity;?> !important;
             }  
    <?php } 
if( $realestaterightnow_show_top_header != '1')
  { ?>
    #top_header 
       {
         display: none !important;  
       }
  <?php  
  }     
if( empty($realestaterightnow_topinfo_email) and empty($realestaterightnow_topinfo_phone) and empty($realestaterightnow_topinfo_hours))
  { ?>
    #header_top_left 
       {
        /* //// display: none; */ 
       }
    #header_top_right 
       {
        margin-top: -0px; 
       }
  <?php  
  }
  if ( empty($realestaterightnow_topinfo_email))
  { ?>
         #realestaterightnow_iconemail
         {
           display: none !important; 
         }
  <?php }
  if ( empty($realestaterightnow_topinfo_phone))
  { ?>
         #realestaterightnow_iconphone
         {
           display: none !important; 
         }
  <?php }
  if ( empty($realestaterightnow_topinfo_hours))
  { ?>
         #realestaterightnow_iconhours
         {
           display: none !important; 
         }
  <?php }
?>
 .site-branding{
    margin-top: <?php echo $realestaterightnow_logo_margin_top;?>px !important;
 }
.social-navigation a {
	color: <?php esc_html($realestaterightnow_icon_color); ?>;
}
   #header_top_left, #realestaterightnow_topinfo_text a 
   {
    color: <?php echo $realestaterightnow_topinfo_color; ?> !important;   
   }
    .site-info,
    .site-info a {
        color: <?php echo esc_html($mycopyrightcolor);?> !important;
        background: <?php echo esc_html($mycopyrightbackground);?> !important;
    }
    .site-info a {
        color: <?php echo esc_html($mycopyrightcolor);?> !important;
        background: <?php echo esc_html($mycopyrightbackground);?> !important;
    }  
    .site-footer {
      background: <?php echo esc_html($footerbkcolor);?> !important;
    } 
    <?php 
    if($footerbkcolor == 'darkgray') // or $footerbkcolor == 'gray')
            {  
               echo '.site-footer {';
              /*  echo 'color: #E9E9E9;'; */
               echo '}';
               echo '.site-footer a {';
               echo 'color: white; '; // lightgray;'
               echo '}';
               echo '.site-footer a:hover {';
               echo 'color: white;';
               echo 'text-decoration: underline;'; 
               echo '}';           
            }
    ?>
    } 
	.main-navigation {
           <?php $mymenufontsize = esc_html(get_theme_mod('menu_font_size', '14')); ?> 
            font-size: <?php echo $mymenufontsize;?>px !important;
         <?php $realestaterightnow_menu_margin_top = esc_html(get_theme_mod('realestaterightnow_menu_margin_top', '30')); ?> 
        margin-top: <?php echo $realestaterightnow_menu_margin_top;?>px !important;
        <?php $mymenubackground = esc_html(get_theme_mod('realestaterightnow_navigation_background', '#333333'));?> 
	}
    .site-header-menu
    {
        <?php $realestaterightnow_menu_margin_right = esc_html(get_theme_mod('realestaterightnow_menu_margin_right', '0')); ?> 
        margin-right: <?php echo esc_html($realestaterightnow_menu_margin_right);?>px !important;
	}       
    }
    .menu-toggle{
        margin-top: <?php echo $realestaterightnow_menu_margin_top;?>px !important;
        display
    }
    .site-header-menu
    {
          background: <?php echo $mymenubackground;?> !important; 
		    font-size: <?php echo $mymenufontsize;?>px !important;
        <?php $realestaterightnow_menu_margin_top = esc_html(get_theme_mod('realestaterightnow_menu_margin_top', '30')); ?> 
        margin-top: <?php echo $realestaterightnow_menu_margin_top;?>px !important;
    }
     <?php $mymenucolor = esc_html(get_theme_mod('realestaterightnow_menu_color', 'white'));?> 
	.main-navigation a {
    <?php
           if(! empty ($mymenucolor))
           {
       	       echo 'color:'. $mymenucolor.'!important;';
               echo 'border-bottom-color:'.$mymenucolor.'!important;';
           }
    ?>
    }   
    
 /* 2018 */   
 .current-menu-item
{
   border-bottom: 1px solid <?php echo $mymenucolor; ?> !important;
}   
    
    
    
      
 	.menu-toggle, .dropdown-toggle {
    <?php
           if(! empty ($mymenucolor))
           {
       	       echo 'color:'. $mymenucolor.'!important;';
               echo 'border-color:'.$mymenucolor.'!important;';
           }
    ?>   
   } 
    <?php 
    $mymenuhovercolor = esc_html(get_theme_mod('realestaterightnow_menu_hover_color','yellow'));
    $mysubmenucolor = esc_html(get_theme_mod('realestaterightnow_submenu_color', 'white'));
    ?> 
	.main-navigation a:hover, .menu-toggle a:hover {
    <?php
           if(! empty ($mymenucolor))
           {
       	       echo 'color:'. $mymenuhovercolor.'!important;';
           }
    ?>
   }  
    .main-navigation li:hover > a,
	.main-navigation li.focus > a {
        border-bottom:  0px solid <?php echo $mymenuhovercolor;?> !important; 
	}
    <?php 
    $mysubmenubackground = esc_html(get_theme_mod('realestaterightnow_submenu_background', '#e65e23')); 
    ?> 
    .main-navigation ul ul a 
     {
          <?php
	           if(! empty ($mysubmenubackground))
       	         echo 'background:'. $mysubmenubackground.'!important;';
               if(! empty ($mymenucolor))
               {
           	       echo 'color:'. $mysubmenucolor.'!important;';
                   echo 'border-bottom-color:'.$mysubmenucolor.'!important;';
               }
            ?> 
}
     <?php 
     $mysubmenuhovercolor = esc_html(get_theme_mod('realestaterightnow_submenu_hover_color','#e65e23'));     
     $mysubmenuhoverbackground = esc_html(get_theme_mod('realestaterightnow_submenu_hover_background', '#8D8B8B'));
     ?>
	.main-navigation ul ul a:hover,
	.main-navigation ul ul li.focus > a {
          <?php
	           if(! empty ($mysubmenuhoverbackground))
       	         echo 'background:'. $mysubmenuhoverbackground.'!important;';
          	   if(! empty ($mysubmenuhovercolor))
       	         echo 'color:'. $mysubmenuhovercolor.'!important;';       
            ?> 
} 
	.main-navigation ul ul li.focus > a:hover {
          <?php
	           if(! empty ($mysubmenuhoverbackground))
       	         echo 'background:'. $mysubmenuhoverbackground.'!important;';
          	   if(! empty ($mysubmenuhovercolor))
       	         echo 'color:'. $mysubmenuhovercolor.'!important;';       
            ?> 
}   
<?php
    $realestaterightnow_social_menu = esc_html(get_theme_mod('realestaterightnow_social_menu','white'));     
    if($realestaterightnow_social_menu == 'darkgray') 
            {  
               echo '.social-navigation li a';
               echo '{';
               echo 'background-color: #3D3D3D;'; // lightgray;'
               echo 'color: white;';
               echo '}';
            }
     if($realestaterightnow_social_menu == 'lightgray') 
            {  
               echo '.social-navigation li a';
               echo '{';
               echo 'background-color: gray; '; // lightgray;
               echo 'color: white;';
               echo '}';
            }
    if($realestaterightnow_social_menu == 'white') 
            {  
               echo '.social-navigation li a';
               echo '{';
               echo 'background-color: white; '; // lightgray;'
               echo 'color: darkgray;';
               echo '}';
            }           
   $realestaterightnow_header_background_color = esc_html(get_theme_mod('realestaterightnow_header_background_color','#333333'));     
   $realestaterightnow_header_border_color = esc_html(get_theme_mod('realestaterightnow_header_border_color','#d1d1d1'));     
   $realestaterightnow_header_border = esc_html(get_theme_mod('realestaterightnow_header_border','no'));     
   $realestaterightnow_header_text_color = esc_html(get_theme_mod('realestaterightnow_header_text_color','#ffffff'));     
   $realestaterightnow_header_cart_color = esc_html(get_theme_mod('realestaterightnow_header_cart_color','#000000'));     
   $realestaterightnow_header_style = trim(get_theme_mod('realestaterightnow_header_style','1'));
   $realestaterightnow_header_style = esc_attr($realestaterightnow_header_style);
     if( !is_front_page())
      $realestaterightnow_header_style = '2';   
   // Bill 2018
    echo '.site-header-main, .site-description, .site-title-text a {';
    echo 'background: '.$realestaterightnow_header_background_color. '!important;';
    echo 'color: '.$realestaterightnow_header_text_color. '!important;';
    echo '}';
    global $template;
    $realestaterightnowtemplete = wp_basename($template);
    if($realestaterightnowtemplete <> 'full-width.php')
      $realestaterightnow_header_style = '2';
     if ($realestaterightnow_header_style == '2')
     {
        echo '#masthead {'; 
        // Bill aqui
        echo 'background: '.$realestaterightnow_header_background_color. '!important;';
        if($realestaterightnow_header_border == '1' )
        {
          echo 'border-bottom: 1px solid '.$realestaterightnow_header_border_color. '!important;';
        }    
     }
     else
     {
           echo '.site-header-main {';
           echo 'border-bottom: 1px solid '.$realestaterightnow_header_border_color. '!important;';
           echo '}';
  ?>         
        #billwrapbackground
        {
           <?php
           $imgdefault = realestaterightnowimgURL.'realestate_bkg.png';
           $realestaterightnow_header_img = trim(get_theme_mod('realestaterightnow_header_img_background', ''));
           $realestaterightnow_header_img = trim(esc_attr($realestaterightnow_header_img));
           if( empty($realestaterightnow_header_img))
             $realestaterightnow_header_img = $imgdefault;
           ?>
           background-image: linear-gradient(to bottom, rgba(0,0,0,0.4) 100%,rgba(0,0,0,0.1) 0%), url("<?php echo $realestaterightnow_header_img;?>"); 
           background-repeat: no-repeat;
           background-size: cover;
           height: 700px;
           min-height: 700px;
           width: 100%;
           margin-top: -190px; 
           z-index: 1;
        } 
        <?php        
     }
    echo '} // Style 1'; 
    
    
    
    
    
    
$realestaterightnow_blog_post_meta = trim(get_theme_mod('realestaterightnow_blog_post_meta','1'));
$realestaterightnow_blog_post_meta = esc_attr($realestaterightnow_blog_post_meta);
$realestaterightnow_blog_post_categories = trim(get_theme_mod('realestaterightnow_blog_post_categories','1'));
$realestaterightnow_blog_post_categories = esc_attr($realestaterightnow_blog_post_categories);
$realestaterightnow_blog_post_date = trim(get_theme_mod('realestaterightnow_blog_post_date','1'));
$realestaterightnow_blog_post_date = esc_attr($realestaterightnow_blog_post_date);
//$realestaterightnow_blog_sidebar_single = trim(get_theme_mod('realestaterightnow_show_sidebar_singlepage','1'));
//$realestaterightnow_blog_sidebar_single = esc_attr($realestaterightnow_blog_sidebar_single);
//die('bbbbb '.$realestaterightnow_blog_sidebar);
$realestaterightnow_blog_post_author = trim(get_theme_mod('realestaterightnow_blog_post_author','1'));
$realestaterightnow_blog_post_author = esc_attr($realestaterightnow_blog_post_author);
if($realestaterightnow_blog_post_meta != '1')
{
       echo '.entry-content {
             width: 100% !important;
             }';
       echo '.entry-footer {
             display:none !important;
             }';
}
// author
if($realestaterightnow_blog_post_categories != '1')
{
       echo '.cat-links {
             display:none !important;
             }';
}
if($realestaterightnow_blog_post_date != '1')
{
       echo '.posted-on {
             display:none !important;
             }';
}
/*
if($realestaterightnow_blog_sidebar_single <> '1')
{
        echo '.content-area {
              width:100% !important; 
             }';   
}
*/
if($realestaterightnow_blog_post_author <> '1')
{
        echo '.author {
             display: none;
             }';   
}
/*
// realestaterightnow_blog_post_categories
// realestaterightnow_blog_post_date
// realestaterightnow_blog_post_author
// posted-on
// comments-link
// cats-link
// author vcard ????      
*/       
    
    
    
    
    
?>    
</style>
<?php /* end style */
} 