<?php
/**
 * Digital Creative Genesis.
 *
 * This file adds the front page template to the Digital Creative Genesis Theme.
 *
 * @package Digital Creative Genesis
 * @author  Laverty Creative
 * @license GPL-2.0+
 * @link    https://lavertycreative.com/
 */

add_action( 'genesis_meta', 'digital_creative_genesis_home_setup' );
/**
 * Set up the homepage layout
 *
 * @since 1.0.0
 */
function digital_creative_genesis_home_setup() {

	// Add front page body class to the head.
	add_filter( 'body_class', 'digital_creative_genesis_add_body_class' );

	if ( is_active_sidebar( 'front-page-1' ) || is_active_sidebar( 'front-page-2' ) || is_active_sidebar( 'front-page-3' ) || is_active_sidebar( 'front-page-4' ) || is_active_sidebar( 'front-page-5' ) ) {
		// Force full width content layout.
		add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

		// Add widgets on front page.
		add_action( 'genesis_before_content_sidebar_wrap', 'digital_creative_genesis_front_page_widgets' );
	}

	// Remove Genesis loop
	remove_action( 'genesis_loop', 'genesis_do_loop' );
}


function digital_creative_genesis_add_body_class( $classes ) {

	$classes[] = 'front-page';

	return $classes;

}

// Add widgets to front page.
function digital_creative_genesis_front_page_widgets() {
	if ( get_query_var( 'paged' ) >= 2 ) {
		return;
	}

	genesis_widget_area( 'front-page-1', array(
		'before' => '<div id="front-page-1" class="front-page-1"><div class="wrap"><div class="flexible-widgets widget-area' . digital_creative_genesis_widget_area_class( 'front-page-1' ) . '">',
		'after'  => '</div></div></div>',
	));

	genesis_widget_area( 'front-page-2', array(
		'before' => '<div id="front-page-2" class="front-page-2"><div class="wrap"><div class="flexible-widgets widget-area' . digital_creative_genesis_widget_area_class( 'front-page-2' ) . '">',
		'after'  => '</div></div></div>',
	));

	genesis_widget_area( 'front-page-3', array(
		'before' => '<div id="front-page-3" class="front-page-3"><div class="wrap"><div class="flexible-widgets widget-area' . digital_creative_genesis_widget_area_class( 'front-page-3' ) . '">',
		'after'  => '</div></div></div>',
	));

	genesis_widget_area( 'front-page-4', array(
		'before' => '<div id="front-page-4" class="front-page-4"><div class="wrap"><div class="flexible-widgets widget-area' . digital_creative_genesis_widget_area_class( 'front-page-4' ) . '">',
		'after'  => '</div></div></div>',
	));

	genesis_widget_area( 'front-page-5', array(
		'before' => '<div id="front-page-5" class="front-page-5"><div class="wrap"><div class="flexible-widgets widget-area' . digital_creative_genesis_widget_area_class( 'front-page-5' ) . '">',
		'after'  => '</div></div></div>',
	));
}

// Run the Genesis loop.
genesis();
