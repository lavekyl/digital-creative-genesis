<?php
/**
 * Digital Creative Genesis.
 *
 * This file adds the Customizer additions to the Digital Creative Genesis Theme.
 *
 * @package Digital Creative Genesis
 * @author  Laverty Creative
 * @license GPL-2.0+
 * @link    https://lavertycreative.com/
 */

add_action( 'customize_register', 'digital_creative_genesis_customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 2.2.3
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function digital_creative_genesis_customizer_register( $wp_customize ) {

	$wp_customize->add_setting(
		'digital_creative_genesis_link_color',
		array(
			'default'           => digital_creative_genesis_customizer_get_default_link_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'digital_creative_genesis_link_color',
			array(
				'description' => __( 'Change the color of post info links, hover color of linked titles, hover color of menu items, and more.', 'digital-creative-genesis' ),
				'label'       => __( 'Link Color', 'digital-creative-genesis' ),
				'section'     => 'colors',
				'settings'    => 'digital_creative_genesis_link_color',
			)
		)
	);

	$wp_customize->add_setting(
		'digital_creative_genesis_accent_color',
		array(
			'default'           => digital_creative_genesis_customizer_get_default_accent_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'digital_creative_genesis_accent_color',
			array(
				'description' => __( 'Change the default hovers color for button.', 'digital-creative-genesis' ),
				'label'       => __( 'Accent Color', 'digital-creative-genesis' ),
				'section'     => 'colors',
				'settings'    => 'digital_creative_genesis_accent_color',
			)
		)
	);

	// HEADER ORIENTATION START
	$wp_customize->add_setting(
		'digital_creative_genesis_header_parallax',
		array(
			'default'    	    =>  'true',
			'sanitize_callback' => 'digital_creative_genesis_sanitize_input',
			'transport'  	    =>  'refresh'
		)
	);
	$wp_customize->add_control(
		'digital_creative_genesis_header_parallax',
		array(
			'section'   => 'header_image',
			'label'     => 'Parallax header?',
			'type'      => 'checkbox'
		)
	);
	// HEADER ORIENTATION END

	// DISPLAY OPTIONS SECTION START
	$wp_customize->add_section(
		'digital_creative_genesis_display_options',
		array(
			'title'     => 'Display Options',
			'priority'  => 100
		)
	);
	// DISPLAY OPTIONS SECTION END

	// SOCIAL MEDIA START
	$wp_customize->add_section(
		'digital_creative_genesis_social_media',
		array(
			'title'     => 'Social Media',
			'priority'  => 150
		)
	);

	$social_sites = array(
		'dcg_facebook'      => 'digital_creative_genesis_facebook_profile',
		'dcg_twitter'       => 'digital_creative_genesis_twitter_profile',
		'dcg_instagram'     => 'digital_creative_genesis_instagram_profile',
		'dcg_pinterest'     => 'digital_creative_genesis_pinterest_profile',
		'dcg_linkedin'      => 'digital_creative_genesis_linkedin_profile',
		'dcg_youtube'       => 'digital_creative_genesis_youtube_profile',
		'dcg_vimeo'         => 'digital_creative_genesis_vimeo_profile',
		'dcg_github'        => 'digital_creative_genesis_github_profile',
		'dcg_reddit'        => 'digital_creative_genesis_reddit_profile',
		'dcg_tumblr'        => 'digital_creative_genesis_tumblr_profile',
		'dcg_google-plus'   => 'digital_creative_genesis_googleplus_profile',
		'dcg_email-form'    => 'digital_creative_genesis_email_form_profile'
	);

	foreach ( $social_sites as $social_site => $value ) {

		$label = '';

		if ( $social_site == 'dcg_facebook' ) {
			$label = 'Facebook';
		} elseif ( $social_site == 'dcg_twitter' ) {
			$label = 'Twitter';
		} elseif ( $social_site == 'dcg_instagram' ) {
			$label = 'Instagram';
		} elseif ( $social_site == 'dcg_pinterest' ) {
			$label = 'Pinterest';
		} elseif ( $social_site == 'dcg_linkedin' ) {
			$label = 'LinkedIn';
		} elseif ( $social_site == 'dcg_youtube' ) {
			$label = 'YouTube';
		} elseif ( $social_site == 'dcg_vimeo' ) {
			$label = 'Vimeo';
		} elseif ( $social_site == 'dcg_github' ) {
			$label = 'Github';
		} elseif ( $social_site == 'dcg_reddit' ) {
			$label = 'Reddit';
		} elseif ( $social_site == 'dcg_tumblr' ) {
			$label = 'Tumblr';
		} elseif ( $social_site == 'dcg_google-plus' ) {
			$label = 'Google+';
		} elseif ( $social_site == 'dcg_email-form' ) {
			$label = 'Email';
		}

		$wp_customize->add_setting(
			$social_site,
			array(
				'sanitize_callback'  => 'digital_creative_genesis_sanitize_input',
				'transport'          => 'postMessage'
			)
		);
		$wp_customize->add_control(
			$social_site,
			array(
				'section'  => 'digital_creative_genesis_social_media',
				'label'    => $label,
				'type'     => 'text'
			)
		);
	}
	// SOCIAL MEDIA END

	// NAVIGATION LAYOUT START
	$wp_customize->add_setting(
		'digital_creative_genesis_navigation_transparency',
		array(
			'default'    	    =>  'true',
			'sanitize_callback' => 'digital_creative_genesis_sanitize_input',
			'transport'  	    =>  'refresh'
		)
	);
	$wp_customize->add_control(
		'digital_creative_genesis_navigation_transparency',
		array(
			'section'   => 'digital_creative_genesis_display_options',
			'label'     => 'Transparent Navigation?',
			'type'      => 'checkbox'
		)
	);

	$wp_customize->add_setting(
		'digital_creative_genesis_navigation_layout_select',
		array(
			'default'   	    => 'below',
			'sanitize_callback' => 'digital_creative_genesis_sanitize_input',
			'transport' 	    => 'refresh'
		)
	);
	$wp_customize->add_control(
		'digital_creative_genesis_navigation_layout_select',
		array(
			'section'  => 'digital_creative_genesis_display_options',
			'label'    => 'Navigation Location',
			'type'     => 'select',
			'choices'  => array(
				'top'      => 'Above the header',
				'right'    => 'Right of the logo',
				'below'    => 'Below the header',
				'centered' => 'Centered logo in nav'
			)
		)
	);
	// NAVIGATION LAYOUT END

	// STANDARD HEADER IMAGE START
	$wp_customize->add_setting(
		'digital_creative_genesis_header_image',
		array(
		  'default'      	    => '',
			'sanitize_callback' => 'digital_creative_genesis_sanitize_input',
		  'transport'    	    => 'refresh'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'digital_creative_genesis_header_image',
			array(
			    'label'    => 'Standard Header Image',
			    'settings' => 'digital_creative_genesis_header_image',
			    'section'  => 'digital_creative_genesis_display_options'
			)
		)
	);
	// STANDARD HEADER IMAGE END

	// FOOTER LAYOUT START
	$wp_customize->add_setting(
		'digital_creative_genesis_display_footer',
		array(
			'default'    	    =>  'true',
			'sanitize_callback' => 'digital_creative_genesis_sanitize_input',
			'transport'  	    =>  'refresh'
		)
	);
	$wp_customize->add_control(
		'digital_creative_genesis_display_footer',
		array(
			'section'   => 'digital_creative_genesis_display_options',
			'label'     => 'Display Footer Widgets?',
			'type'      => 'checkbox'
		)
	);
	// FOOTER LAYOUT END

	// COPYRIGHT MESSAGE START
	$wp_customize->add_setting(
		'digital_creative_genesis_footer_copyright_text',
		array(
			'default'            => 'All Rights Reserved',
			'sanitize_callback'  => 'digital_creative_genesis_sanitize_input',
			'transport'          => 'refresh'
		)
	);
	$wp_customize->add_control(
		'digital_creative_genesis_footer_copyright_text',
		array(
			'section'  => 'digital_creative_genesis_display_options',
			'label'    => 'Copyright Message',
			'type'     => 'text'
		)
	);
	// COPYRIGHT MESSAGE END

}

/**
 * Sanitizes the incoming input and returns it prior to serialization.
 *
 * @param      string    $input    The string to sanitize
 * @return     string              The sanitized string
 * @package    digital-creative-agency
 * @since      0.5.0
 * @version    1.0.2
 */
function digital_creative_genesis_sanitize_input( $input ) {
	return strip_tags( stripslashes( $input ) );
} // end digital_creative_genesis_sanitize_input

/**
 * Writes styles out the `<head>` element of the page based on the configuration options
 * saved in the Theme Customizer.
 *
 * @since      0.2.0
 * @version    1.0.1
 */
function digital_creative_genesis_customizer_css() { ?>
	<style type="text/css">
		<?php if( get_theme_mod( 'digital_creative_genesis_navigation_layout_select' ) == 'centered' ) { ?>
			.nav-primary {
				border-top: none;
				text-align: center;
			}
			.nav-header-left {
		    float: left;
		    text-align: center;
		    width: 40%;
			}
			.nav-header-right {
		    float: right;
		    text-align: center;
		    width: 40%;
			}
			.header-full-width .title-area {
		    float: none;
		    margin: 0 auto;
		    text-align: center;
		    width: 20%;
			}
			@media (max-width: 1023px) {
				.header-full-width .title-area {
					margin-top: 25px;
					max-width: 200px;
					width: 100%;
				}
			}
		<?php } ?>

		<?php if( get_theme_mod( 'digital_creative_genesis_navigation_layout_select' ) == 'right' ) { ?>
			.nav-primary {
				border-top: none;
				float: right;
				text-align: right;
				width: 75%;
			}
			.header-full-width .title-area {
		    float: left;
		    width: 25%;
			}
		<?php } ?>

		<?php if( get_theme_mod( 'digital_creative_genesis_navigation_layout_select' ) == 'top' ) { ?>
			.header-image .title-area {
				max-width: 400px;
			}
			.header-image .site-title>a {
				display: block;
				float: none;
				min-height: 165px;
			}
			.nav-primary {
				border-top: none;
				text-align: center;
			}
		<?php } ?>

		<?php if( get_theme_mod( 'digital_creative_genesis_header_image') ) { ?>
			<?php if( !is_front_page() ) { ?>
				.site-header {
					background: url('<?php echo get_theme_mod( 'digital_creative_genesis_header_image' ); ?>') no-repeat center;
					background-size: cover;
				}
				.site-header::after {
			    background: rgba(255,255,255,0.6);
			    content: '';
			    display: block;
			    height: 100%;
			    left: 0;
			    position: absolute;
			    top: 0;
			    width: 100%;
			    z-index: 0;
				}
			<?php } ?>
		<?php } ?>
	</style>
<?php } // end digital_creative_genesis_customizer_css
add_action( 'wp_head', 'digital_creative_genesis_customizer_css' );
