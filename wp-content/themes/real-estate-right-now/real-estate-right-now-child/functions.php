<?php /**
 * real estate Child Theme functions and definitions
 *
 * @package real-estate-right-now
 * @subpackage Real_estate
 * @since real estate 1.0
 */
if ( !defined( 'ABSPATH' ) ) exit;
if ( !function_exists( 'realestaterightnow_cfg_parent_css' ) ):
    function realestaterightnow_cfg_parent_css() {
        wp_enqueue_style( 'realestaterightnow_cfg_parent_css', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'genericons' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'realestaterightnow_cfg_parent_css', 10 );