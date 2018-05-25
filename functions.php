<?php
/**
 * Digital Creative Genesis.
 *
 * This file adds functions to the Digital Creative Genesis Theme.
 *
 * @package Digital Creative Genesis
 * @author  Laverty Creative
 * @license GPL-2.0+
 * @link    https://lavertycreative.com/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'digital_creative_genesis_localization_setup' );
function digital_creative_genesis_localization_setup(){
	load_child_theme_textdomain( 'digital-creative-genesis', get_stylesheet_directory() . '/languages' );
}

// Generic login error message
function digital_creative_genesis_login_errors(){
  return 'Oops! Something is wrong!';
}
add_filter( 'login_errors', 'digital_creative_genesis_login_errors' );

// Add the helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add widgets.
require_once( get_stylesheet_directory() . '/lib/widgets.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce styles and Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Add the Genesis Connect WooCommerce notice.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

// Add the hero slider component.
// include_once( get_stylesheet_directory() . '/lib/components/hero.php' );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Digital Creative Genesis' );
define( 'CHILD_THEME_URL', 'https://lavertycreative.com/' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

// Add the assets and enqueue styles and scripts.
include_once( get_stylesheet_directory() . '/lib/assets.php' );

// Add our responsive menu settings.
include_once( get_stylesheet_directory() . '/lib/menus.php' );

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

if( get_theme_mod( 'digital_creative_genesis_display_footer' ) == true ) {
	// Add support for 3-column footer widgets.
	add_theme_support( 'genesis-footer-widgets', 3 );
}

// Add Image Sizes.
add_image_size( 'featured-image', 720, 400, TRUE );

if( get_theme_mod( 'digital_creative_genesis_navigation_layout_select' ) == 'centered' ) {
	// Add support for right and left menu & rename top menu.
	add_theme_support( 'genesis-menus' , array (
		'primary'      => __( 'Above Header Menu', 'digital-creative-genesis' ),
		'header-left'  => __( 'Header Left', 'digital-creative-genesis' ),
		'header-right' => __( 'Header Right', 'digital-creative-genesis' ),
		'secondary' => __( 'Footer Menu', 'digital-creative-genesis' )
	) );
} else {
	// Rename primary and secondary navigation menus.
	add_theme_support( 'genesis-menus', array (
		'primary' => __( 'Header Menu', 'digital-creative-genesis' ),
		'secondary' => __( 'Footer Menu', 'digital-creative-genesis' )
	) );
}

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

// Reduce the secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'digital_creative_genesis_secondary_menu_args' );
function digital_creative_genesis_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'digital_creative_genesis_author_box_gravatar' );
function digital_creative_genesis_author_box_gravatar( $size ) {
	return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'digital_creative_genesis_comments_gravatar' );
function digital_creative_genesis_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

// Remove Query String from Static Resources
add_filter( 'style_loader_src', 'remove_css_js_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_css_js_ver', 10, 2 );
function remove_css_js_ver( $src ) {
	if( strpos( $src, '?ver=' ) )
	$src = remove_query_arg( 'ver', $src );
	return $src;
}

// Add Shortcode for Social Icons
function digital_creative_genesis_social_shortcode() {

	// (if statement is true) ? (do this) : (else, do this);
	$dcg_facebook_link = ( get_theme_mod('dcg_facebook') ) ? '<a href="'. get_theme_mod('dcg_facebook') .'" target="_blank"><span class="icon-facebook2"></span></a>' : '';
	$dcg_twitter_link = ( get_theme_mod('dcg_twitter') ) ? '<a href="'. get_theme_mod('dcg_twitter') .'" target="_blank"><span class="icon-twitter"></span></a>' : '';
	$dcg_instagram_link = ( get_theme_mod('dcg_instagram') ) ? '<a href="'. get_theme_mod('dcg_instagram') .'" target="_blank"><span class="icon-instagram"></span></a>' : '';
	$dcg_pinterest_link = ( get_theme_mod('dcg_pinterest') ) ? '<a href="'. get_theme_mod('dcg_pinterest') .'" target="_blank"><span class="icon-pinterest"></span></a>' : '';
	$dcg_linkedin_link = ( get_theme_mod('dcg_linkedin') ) ? '<a href="'. get_theme_mod('dcg_linkedin') .'" target="_blank"><span class="icon-linkedin"></span></a>' : '';
	$dcg_youtube_link = ( get_theme_mod('dcg_youtube') ) ? '<a href="'. get_theme_mod('dcg_youtube') .'" target="_blank"><span class="icon-youtube"></span></a>' : '';
	$dcg_vimeo_link = ( get_theme_mod('dcg_vimeo') ) ? '<a href="'. get_theme_mod('dcg_vimeo') .'" target="_blank"><span class="icon-vimeo2"></span></a>' : '';
	$dcg_github_link = ( get_theme_mod('dcg_github') ) ? '<a href="'. get_theme_mod('dcg_github') .'" target="_blank"><span class="icon-github"></span></a>' : '';
	$dcg_reddit_link = ( get_theme_mod('dcg_reddit') ) ? '<a href="'. get_theme_mod('dcg_reddit') .'" target="_blank"><span class="icon-reddit"></span></a>' : '';
	$dcg_tumblr_link = ( get_theme_mod('dcg_tumblr') ) ? '<a href="'. get_theme_mod('dcg_tumblr') .'" target="_blank"><span class="icon-tumblr2"></span></a>' : '';
	$dcg_gplus_link = ( get_theme_mod('dcg_google-plus') ) ? '<a href="'. get_theme_mod('dcg_google-plus') .'" target="_blank"><span class="icon-google-plus2"></span></a>' : '';
	$dcg_email_link = ( get_theme_mod('dcg_email-form') ) ? '<a href="'. get_theme_mod('dcg_email-form') .'" target="_blank"><span class="icon-mail"></span></a>' : '';

	return '<div class="social-media">
						'. $dcg_facebook_link .'
						'. $dcg_twitter_link .'
						'. $dcg_instagram_link .'
						'. $dcg_pinterest_link .'
						'. $dcg_linkedin_link .'
						'. $dcg_youtube_link .'
						'. $dcg_vimeo_link .'
						'. $dcg_github_link .'
						'. $dcg_reddit_link .'
						'. $dcg_tumblr_link .'
						'. $dcg_gplus_link .'
						'. $dcg_email_link .'
					</div>';

}
add_shortcode( 'social-media', 'digital_creative_genesis_social_shortcode' );

/**
 * Genesis adjustments
 *
 */

// Remove the header right widget area
if( get_theme_mod( 'digital_creative_genesis_navigation_layout_select' ) != 'below'  ) {
	unregister_sidebar( 'header-right' );
} else {
	// do nothing
}

// Reposition the primary navigation menu
if( get_theme_mod( 'digital_creative_genesis_navigation_layout_select' ) == 'top'  ) {
	remove_action( 'genesis_after_header', 'genesis_do_nav' );
	add_action( 'genesis_before_header', 'genesis_do_nav' );
} elseif( get_theme_mod( 'digital_creative_genesis_navigation_layout_select' ) == 'right'  ) {
	remove_action( 'genesis_after_header', 'genesis_do_nav' );
	add_action( 'genesis_header', 'genesis_do_nav' );
}

// Customize the footer copyright
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'digital_creative_genesis_custom_footer' );
function digital_creative_genesis_custom_footer() {
	if ( get_theme_mod( 'digital_creative_genesis_footer_copyright_text' ) ) : ?>
		<p>&copy; <?php echo date("Y"); ?> <?php bloginfo( 'name' ); ?> | <?php echo esc_html__( get_theme_mod( 'digital_creative_genesis_footer_copyright_text' ) ); ?></p>
	<?php else : ?>
		<p>&copy; <?php echo date("Y"); ?> <?php bloginfo( 'name' ); ?> | All Rights Reserved | Powered by <a href="http://wordpress.org/">WordPress</a></p>
	<?php endif;
}
