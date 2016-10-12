<?php
/**
 * BB Niche Theme Customizer.
 *
 * @package BB_Niche
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bb_niche_customize_register( $wp_customize )
{
	$wp_customize->get_setting('blogname')->transport = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
	$wp_customize->add_section('bb-niche_logo_section', array(
		'title' => __('Logo', 'bb-niche'),
		'priority' => 30,
		'description' => 'Upload a Logo here logo size should be 350px / 50px',
	));

	$wp_customize->add_setting('bb-niche_logo', wp_parse_args($setting, $default_setting_args), array('sanitize_callback' => '__return_false',));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'bb-niche_logo', array(
		'label' => __('Logo', 'bb-niche'),
		'section' => 'bb-niche_logo_section',
		'settings' => 'bb-niche_logo',
	)));



	// Sanitize text
	function sanitize_hometext($text)
	{
		return sanitize_hometext_field($text);
	}







// footer copyright text


	$wp_customize->add_panel('text_blocks', array(
		'priority' => 500,
		'theme_supports' => '',
		'title' => __('Footer Copyright Text', 'bb-niche'),
		'description' => __('Set editable text for certain content.', 'bb-niche'),
	));
	// Add Footer Text
	// Add section.
	$wp_customize->add_section('custom_footer_text', array(
		'title' => __('Change Footer Text', 'bb-niche'),
		'panel' => 'text_blocks',
		'priority' => 10
	));
	// Add setting
	$wp_customize->add_setting('footer_text_block', array(
		'default' => __('BB niche theme', 'bb-niche'),
		'sanitize_callback' => 'sanitize_text'
	));
	// Add control
	$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			'custom_footer_text',
			array(
				'label' => __('Footer Text', 'bb-niche'),
				'section' => 'custom_footer_text',
				'settings' => 'footer_text_block',
				'type' => 'textarea'
			)
		)
	);

	// Sanitize text
	function sanitize_text($text)
	{
		return sanitize_text_field($text);
	}




}
add_action( 'customize_register', 'bb_niche_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bb_niche_customize_preview_js() {
	wp_enqueue_script( 'bb_niche_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'bb_niche_customize_preview_js' );
