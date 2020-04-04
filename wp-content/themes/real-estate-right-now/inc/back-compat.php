<?php
/**
 * real estate back compat functionality
 *
 * Prevents real estate from running on WordPress versions prior to 4.4,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.4.
 *
 * @package real-estate-right-now
 * @subpackage Real_estate
 * @since real estate 1.0
 */

/**
 * Prevent switching to real estate on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since real estate 1.0
 */
function realestaterightnow_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'realestaterightnow_upgrade_notice' );
}
add_action( 'after_switch_theme', 'realestaterightnow_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * real estate on WordPress versions prior to 4.4.
 *
 * @since real estate 1.0
 *
 * @global string $wp_version WordPress version.
 */
function realestaterightnow_upgrade_notice() {
	$message = sprintf( __( 'real estate requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'real-estate-right-now' ), esc_attr($GLOBALS['wp_version']) );
	printf( '<div class="error"><p>%s</p></div>', esc_attr($message ));
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.4.
 *
 * @since real estate 1.0
 *
 * @global string $wp_version WordPress version.
 */
function realestaterightnow_customize() {
	wp_die( sprintf( esc_attr( __( 'real estate requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'real-estate-right-now' )), esc_attr($GLOBALS['wp_version']) ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'realestaterightnow_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.4.
 *
 * @since real estate 1.0
 *
 * @global string $wp_version WordPress version.
 */
function realestaterightnow_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( esc_attr(sprintf( esc_attr( __( 'real estate requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'real-estate-right-now' )), esc_attr($GLOBALS['wp_version'] )) ));
	}
}
add_action( 'template_redirect', 'realestaterightnow_preview' );
