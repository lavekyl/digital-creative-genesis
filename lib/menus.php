<?php
/**
 * Digital Creative Genesis.
 *
 * This file adds widgets to the Digital Creative Genesis Theme.
 *
 * @package Digital Creative Genesis
 * @author  Laverty Creative
 * @license GPL-2.0+
 * @link    https://lavertycreative.com/
 */

// Define our standard responsive menu settings.
function digital_creative_genesis_standard_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( 'Menu', 'digital-creative-genesis' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'digital-creative-genesis' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Define our centered logo responsive menu settings.
function digital_creative_genesis_centered_logo_responsive_menu_settings() {

  $settings = array(
		'mainMenu'          => __( 'Menu', 'digital-creative-genesis' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'digital-creative-genesis' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header-left',
				'.nav-header-right',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Reposition the primary navigation menu
if( get_theme_mod( 'digital_creative_genesis_navigation_layout_select' ) == 'centered' ) {
  remove_action( 'genesis_after_header', 'genesis_do_nav' );
  add_action( 'genesis_before_header', 'genesis_do_nav', 7 );
  add_action( 'genesis_header', 'digital_creative_genesis_header_left_menu', 6 );
  add_action( 'genesis_header', 'digital_creative_genesis_header_right_menu', 9 );
}

/**
 * Hook menu to left of logo.
 *
 * @since 1.0.0
 */
function digital_creative_genesis_header_left_menu() {

	genesis_nav_menu( array(
    'theme_location' => 'header-left',
    'depth'          => 2,
  ));

}

/**
 * Hook menu to right of logo.
 *
 * @since 1.0.0
 */
function digital_creative_genesis_header_right_menu() {

  genesis_nav_menu( array(
    'theme_location' => 'header-right',
    'depth'          => 2,
  ));

}
