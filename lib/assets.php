<?php
/**
 * Digital Creative Genesis.
 *
 * This file adds the dist (styles and scripts) to the Digital Creative Genesis Theme.
 *
 * @package Digital Creative Genesis
 * @author  Laverty Creative
 * @license GPL-2.0+
 * @link    https://lavertycreative.com/
 */

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'digital_creative_genesis_enqueue_scripts_styles' );
function digital_creative_genesis_enqueue_scripts_styles() {

	wp_enqueue_style( 'digital-creative-genesis-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	// Load responsive menu and arguments.
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_style( 'digital-creative-genesis-custom-style', get_stylesheet_directory_uri() . "/dist/css/style.css", array(), CHILD_THEME_VERSION );
	wp_enqueue_script( 'digital-creative-genesis-custom-js', get_stylesheet_directory_uri() . "/dist/js/site{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );

	wp_enqueue_script( 'digital-creative-genesis-responsive-menu', get_stylesheet_directory_uri() . "/dist/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );

	if( get_theme_mod( 'digital_creative_genesis_navigation_layout_select' ) == 'centered' ) {
		wp_localize_script(
			'digital-creative-genesis-responsive-menu',
			'genesis_responsive_menu',
			digital_creative_genesis_centered_logo_responsive_menu_settings()
		);
	} else {
		wp_localize_script(
			'digital-creative-genesis-responsive-menu',
			'genesis_responsive_menu',
			digital_creative_genesis_standard_responsive_menu_settings()
		);
	}

}
