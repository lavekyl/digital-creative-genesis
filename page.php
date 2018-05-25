<?php
/**
 * Digital Creative Genesis.
 *
 * This file adds the standard page template to the Digital Creative Genesis Theme.
 *
 * @package Digital Creative Genesis
 * @author  Laverty Creative
 * @license GPL-2.0+
 * @link    https://lavertycreative.com/
 */

// Add blog page body class to the head.
add_filter( 'body_class', 'digital_creative_genesis_add_body_class' );
function digital_creative_genesis_add_body_class( $classes ) {

	$classes[] = 'standard-page';

	return $classes;

}

// Run the Genesis loop.
genesis();
