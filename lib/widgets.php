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

// Register top widget.
genesis_register_sidebar( array(
  'id' => 'top-widget',
  'name' => __( 'Top Widget', 'genesis' ),
  'description' => __( 'Widgets in this widget area will display above the header.', 'digital-creative-genesis' ),
) );

// Register above footer widget.
genesis_register_sidebar( array(
  'id' => 'above-footer-widget',
  'name' => __( 'Above Footer Widget', 'genesis' ),
  'description' => __( 'Widgets in this widget area will display above the footer.', 'digital-creative-genesis' ),
) );

// Front Page 1 widget area.
genesis_register_sidebar( array(
	'id'          => 'front-page-1',
	'name'        => __( 'Front Page 1', 'digital-creative-genesis' ),
	'description' => __( 'Widgets in this widget area will display in the 1st section on the homepage.', 'digital-creative-genesis' ),
));

// Front Page 2 widget area.
genesis_register_sidebar( array(
	'id'          => 'front-page-2',
	'name'        => __( 'Front Page 2', 'digital-creative-genesis' ),
	'description' => __( 'Widgets in this widget area will display in the 2nd section on the homepage.', 'digital-creative-genesis' ),
));

// Front Page 3 widget area.
genesis_register_sidebar( array(
	'id'          => 'front-page-3',
	'name'        => __( 'Front Page 3', 'digital-creative-genesis' ),
	'description' => __( 'Widgets in this widget area will display in the 3rd section on the homepage.', 'digital-creative-genesis' ),
));

// Front Page 4 widget area.
genesis_register_sidebar( array(
	'id'          => 'front-page-4',
	'name'        => __( 'Front Page 4', 'digital-creative-genesis' ),
	'description' => __( 'Widgets in this widget area will display in the 4th section on the homepage.', 'digital-creative-genesis' ),
));

// Front Page 5 widget area.
genesis_register_sidebar( array(
	'id'          => 'front-page-5',
	'name'        => __( 'Front Page 5', 'digital-creative-genesis' ),
	'description' => __( 'Widgets in this widget area will display in the 5th section on the homepage.', 'digital-creative-genesis' ),
));

// Add top widget.
add_action( 'genesis_before_header', 'digital_creative_genesis_top_widget' );
function digital_creative_genesis_top_widget() {
  genesis_widget_area( 'top-widget', array(
	  'before' => '<div class="top-widget widget-area">',
	  'after'  => '</div>',
  ) );
}

// Add above footer widget.
add_action( 'genesis_before_footer', 'digital_creative_genesis_above_footer_widget', 5 );
function digital_creative_genesis_above_footer_widget() {
  genesis_widget_area( 'above-footer-widget', array(
	  'before' => '<div class="above-footer-widget widget-area">',
	  'after'  => '</div>',
  ) );
}

/**
 * Function to output widget counts.
 *
 * @since 1.0.0
 *
 * @param  string $id The widget area id.
 * @return int        Number of active widgets in the widget area.
 */
function digital_creative_genesis_count_widgets( $id ) {

	global $sidebars_widgets;

	if ( isset( $sidebars_widgets[ $id ] ) ) {
		return count( $sidebars_widgets[ $id ] );
	}

}

/**
 * Function to get the flexible widget area class.
 *
 * @since 1.0.0
 *
 * @param  string $id    The widget area id.
 * @return string $class The appropriate class for the amount of widgets.
 */
function digital_creative_genesis_widget_area_class( $id ) {

	$count = digital_creative_genesis_count_widgets( $id );

	$class = '';

	if( $count == 1 ) {
		$class .= ' widget-full';
	} elseif( $count % 3 == 1 ) {
		$class .= ' widget-thirds';
	} elseif( $count % 4 == 1 ) {
		$class .= ' widget-fourths';
	} elseif( $count % 2 == 0 ) {
		$class .= ' widget-halves uneven';
	} else {
		$class .= ' widget-halves even';
	}

	return $class;

}
