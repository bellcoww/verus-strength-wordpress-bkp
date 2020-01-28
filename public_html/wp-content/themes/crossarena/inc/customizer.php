<?php
/**
 * Theme Customizer.
 *
 * @package Crossarena
 */

/**
 * Retrieve a holder for Customizer options.
 *
 * @since  1.0.0
 * @return array
 */
function crossarena_get_customizer_options() {
	/**
	 * Filter a holder for Customizer options (for theme/plugin developer customization).
	 *
	 * @since 1.0.0Body Background Color
	 */
	return apply_filters( 'crossarena_get_customizer_options' , array(
		'prefix'     => 'crossarena',
		'capability' => 'edit_theme_options',
		'type'       => 'theme_mod',
		'options'    => array(

			/** `Site Indentity` section */
			'show_tagline' => array(
				'title'    => esc_html__( 'Show tagline after logo', 'crossarena' ),
				'section'  => 'title_tagline',
				'priority' => 60,
				'default'  => true,
				'field'    => 'checkbox',
				'type'     => 'control',
			),
			'totop_visibility' => array(
				'title'    => esc_html__( 'Show ToTop button', 'crossarena' ),
				'section'  => 'title_tagline',
				'priority' => 61,
				'default'  => true,
				'field'    => 'checkbox',
				'type'     => 'control',
			),
			'general_settings' => array(
				'title'    => esc_html__( 'General Site settings', 'crossarena' ),
				'priority' => 40,
				'type'     => 'panel',
			),

			/** `Logo & Favicon` section */
			'logo_favicon' => array(
				'title'    => esc_html__( 'Logo &amp; Favicon', 'crossarena' ),
				'priority' => 25,
				'panel'    => 'general_settings',
				'type'     => 'section',
			),
			'header_logo_type' => array(
				'title'   => esc_html__( 'Logo Type', 'crossarena' ),
				'section' => 'logo_favicon',
				'default' => 'image',
				'field'   => 'radio',
				'choices' => array(
					'image' => esc_html__( 'Image', 'crossarena' ),
					'text'  => esc_html__( 'Text', 'crossarena' ),
				),
				'type' => 'control',
			),
			'header_logo_url' => array(
				'title'           => esc_html__( 'Logo Upload', 'crossarena' ),
				'description'     => esc_html__( 'Upload logo image', 'crossarena' ),
				'section'         => 'logo_favicon',
				'default'         => '%s/assets/images/logo.png',
				'field'           => 'image',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_header_logo_image',
			),
			'retina_header_logo_url' => array(
				'title'           => esc_html__( 'Retina Logo Upload', 'crossarena' ),
				'description'     => esc_html__( 'Upload logo for retina-ready devices', 'crossarena' ),
				'section'         => 'logo_favicon',
				'field'           => 'image',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_header_logo_image',
			),
			'header_logo_font_family' => array(
				'title'           => esc_html__( 'Font Family', 'crossarena' ),
				'section'         => 'logo_favicon',
				'default'         => 'Montserrat, sans-serif',
				'field'           => 'fonts',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_header_logo_text',
			),
			'header_logo_font_style' => array(
				'title'           => esc_html__( 'Font Style', 'crossarena' ),
				'section'         => 'logo_favicon',
				'default'         => 'normal',
				'field'           => 'select',
				'choices'         => crossarena_get_font_styles(),
				'type'            => 'control',
				'active_callback' => 'crossarena_is_header_logo_text',
			),
			'header_logo_font_weight' => array(
				'title'           => esc_html__( 'Font Weight', 'crossarena' ),
				'section'         => 'logo_favicon',
				'default'         => '600',
				'field'           => 'select',
				'choices'         => crossarena_get_font_weight(),
				'type'            => 'control',
				'active_callback' => 'crossarena_is_header_logo_text',
			),
			'header_logo_font_size' => array(
				'title'           => esc_html__( 'Font Size, px', 'crossarena' ),
				'section'         => 'logo_favicon',
				'default'         => '23',
				'field'           => 'number',
				'input_attrs'     => array(
					'min'  => 6,
					'max'  => 50,
					'step' => 1,
				),
				'type'            => 'control',
				'active_callback' => 'crossarena_is_header_logo_text',
			),
			'header_logo_character_set' => array(
				'title'           => esc_html__( 'Character Set', 'crossarena' ),
				'section'         => 'logo_favicon',
				'default'         => 'latin',
				'field'           => 'select',
				'choices'         => crossarena_get_character_sets(),
				'type'            => 'control',
				'active_callback' => 'crossarena_is_header_logo_text',
			),

			/** `Breadcrumbs` section */
			'breadcrumbs' => array(
				'title'    => esc_html__( 'Breadcrumbs', 'crossarena' ),
				'priority' => 30,
				'type'     => 'section',
				'panel'    => 'general_settings',
			),
			'breadcrumbs_visibillity' => array(
				'title'   => esc_html__( 'Enable Breadcrumbs', 'crossarena' ),
				'section' => 'breadcrumbs',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'breadcrumbs_front_visibillity' => array(
				'title'   => esc_html__( 'Enable Breadcrumbs on front page', 'crossarena' ),
				'section' => 'breadcrumbs',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'breadcrumbs_page_title' => array(
				'title'   => esc_html__( 'Enable page title in breadcrumbs area', 'crossarena' ),
				'section' => 'breadcrumbs',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'breadcrumbs_path_type' => array(
				'title'   => esc_html__( 'Show full/minified path', 'crossarena' ),
				'section' => 'breadcrumbs',
				'default' => 'full',
				'field'   => 'select',
				'choices' => array(
					'full'     => esc_html__( 'Full', 'crossarena' ),
					'minified' => esc_html__( 'Minified', 'crossarena' ),
				),
				'type'    => 'control',
			),

			/** `Social links` section */
			'social_links' => array(
				'title'    => esc_html__( 'Social links', 'crossarena' ),
				'priority' => 50,
				'type'     => 'section',
				'panel'    => 'general_settings',
			),
			'header_social_links' => array(
				'title'   => esc_html__( 'Show social links in header', 'crossarena' ),
				'section' => 'social_links',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'footer_social_links' => array(
				'title'   => esc_html__( 'Show social links in footer', 'crossarena' ),
				'section' => 'social_links',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Page Layout` section */
			'page_layout' => array(
				'title'    => esc_html__( 'Page Layout', 'crossarena' ),
				'priority' => 55,
				'type'     => 'section',
				'panel'    => 'general_settings',
			),
			'header_container_type' => array(
				'title'   => esc_html__( 'Header type', 'crossarena' ),
				'section' => 'page_layout',
				'default' => 'boxed',
				'field'   => 'select',
				'choices' => array(
					'boxed'     => esc_html__( 'Boxed', 'crossarena' ),
					'fullwidth' => esc_html__( 'Fullwidth', 'crossarena' ),
				),
				'type' => 'control',
			),
			'content_container_type' => array(
				'title'   => esc_html__( 'Content type', 'crossarena' ),
				'section' => 'page_layout',
				'default' => 'boxed',
				'field'   => 'select',
				'choices' => array(
					'boxed'     => esc_html__( 'Boxed', 'crossarena' ),
					'fullwidth' => esc_html__( 'Fullwidth', 'crossarena' ),
				),
				'type' => 'control',
			),
			'footer_container_type' => array(
				'title'   => esc_html__( 'Footer type', 'crossarena' ),
				'section' => 'page_layout',
				'default' => 'boxed',
				'field'   => 'select',
				'choices' => array(
					'boxed'     => esc_html__( 'Boxed', 'crossarena' ),
					'fullwidth' => esc_html__( 'Fullwidth', 'crossarena' ),
				),
				'type' => 'control',
			),
			'container_width' => array(
				'title'       => esc_html__( 'Container width (px)', 'crossarena' ),
				'section'     => 'page_layout',
				'default'     => 1200,
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 960,
					'max'  => 1920,
					'step' => 1,
				),
				'type' => 'control',
			),
			'sidebar_width' => array(
				'title'   => esc_html__( 'Sidebar width', 'crossarena' ),
				'section' => 'page_layout',
				'default' => '1/3',
				'field'   => 'select',
				'choices' => array(
					'1/3' => '1/3',
					'1/4' => '1/4',
				),
				'sanitize_callback' => 'sanitize_text_field',
				'type'              => 'control',
			),

			/** `Page Preloader` section */
			'page_preloader_section' => array(
				'title'    => esc_html__( 'Page Preloader', 'crossarena' ),
				'priority' => 60,
				'type'     => 'section',
				'panel'    => 'general_settings',
			),

			'page_preloader' => array(
				'title'    => esc_html__( 'Show page preloader', 'crossarena' ),
				'section'  => 'page_preloader_section',
				'priority' => 10,
				'default'  => true,
				'field'    => 'checkbox',
				'type'     => 'control',
			),

			'page_preloader_bg' => array(
				'title'           => esc_html__( 'Preloader Cover Background Color', 'crossarena' ),
				'section'         => 'page_preloader_section',
				'default'         => '#fff',
				'field'           => 'hex_color',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_page_preloader_enable',
			),

			'page_preloader_url' => array(
				'title'           => esc_html__( 'Preloader Image Upload', 'crossarena' ),
				'section'         => 'page_preloader_section',
				'field'           => 'image',
				'default'         => '%s/assets/images/preloader-image.png',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_page_preloader_enable',
			),

			/** `Color Scheme` panel */
			'color_scheme' => array(
				'title'       => esc_html__( 'Color Scheme', 'crossarena' ),
				'description' => esc_html__( 'Configure Color Scheme', 'crossarena' ),
				'priority'    => 40,
				'type'        => 'panel',
			),

			/** `Regular scheme` section */
			'regular_scheme' => array(
				'title'       => esc_html__( 'Regular scheme', 'crossarena' ),
				'priority'    => 1,
				'panel'       => 'color_scheme',
				'type'        => 'section',
			),
			'regular_accent_color_1' => array(
				'title'   => esc_html__( 'Accent color (1)', 'crossarena' ),
				'section' => 'regular_scheme',
				'default' => '#73c6cd',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_accent_color_2' => array(
				'title'   => esc_html__( 'Accent color (2)', 'crossarena' ),
				'section' => 'regular_scheme',
				'default' => '#b5b9bb',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_text_color' => array(
				'title'   => esc_html__( 'Text color', 'crossarena' ),
				'section' => 'regular_scheme',
				'default' => '#42474c',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_link_color' => array(
				'title'   => esc_html__( 'Link color', 'crossarena' ),
				'section' => 'regular_scheme',
				'default' => '#73c6cd',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_link_hover_color' => array(
				'title'   => esc_html__( 'Link hover color', 'crossarena' ),
				'section' => 'regular_scheme',
				'default' => '#1e2428',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h1_color' => array(
				'title'   => esc_html__( 'H1 color', 'crossarena' ),
				'section' => 'regular_scheme',
				'default' => '#1e2428',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h2_color' => array(
				'title'   => esc_html__( 'H2 color', 'crossarena' ),
				'section' => 'regular_scheme',
				'default' => '#1e2428',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h3_color' => array(
				'title'   => esc_html__( 'H3 color', 'crossarena' ),
				'section' => 'regular_scheme',
				'default' => '#1e2428',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h4_color' => array(
				'title'   => esc_html__( 'H4 color', 'crossarena' ),
				'section' => 'regular_scheme',
				'default' => '#1e2428',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h5_color' => array(
				'title'   => esc_html__( 'H5 color', 'crossarena' ),
				'section' => 'regular_scheme',
				'default' => '#1e2428',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h6_color' => array(
				'title'   => esc_html__( 'H6 color', 'crossarena' ),
				'section' => 'regular_scheme',
				'default' => '#1e2428',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			/** `Invert scheme` section */
			'invert_scheme' => array(
				'title'       => esc_html__( 'Invert scheme', 'crossarena' ),
				'priority'    => 1,
				'panel'       => 'color_scheme',
				'type'        => 'section',
			),
			'invert_accent_color_1' => array(
				'title'   => esc_html__( 'Accent color (1)', 'crossarena' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_accent_color_2' => array(
				'title'   => esc_html__( 'Accent color (2)', 'crossarena' ),
				'section' => 'invert_scheme',
				'default' => '#73c6cd',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_text_color' => array(
				'title'   => esc_html__( 'Text color', 'crossarena' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_link_color' => array(
				'title'   => esc_html__( 'Link color', 'crossarena' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_link_hover_color' => array(
				'title'   => esc_html__( 'Link hover color', 'crossarena' ),
				'section' => 'invert_scheme',
				'default' => '#73c6cd',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h1_color' => array(
				'title'   => esc_html__( 'H1 color', 'crossarena' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h2_color' => array(
				'title'   => esc_html__( 'H2 color', 'crossarena' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h3_color' => array(
				'title'   => esc_html__( 'H3 color', 'crossarena' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h4_color' => array(
				'title'   => esc_html__( 'H4 color', 'crossarena' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h5_color' => array(
				'title'   => esc_html__( 'H5 color', 'crossarena' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h6_color' => array(
				'title'   => esc_html__( 'H6 color', 'crossarena' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			/** `Typography Settings` panel */
			'typography' => array(
				'title'       => esc_html__( 'Typography', 'crossarena' ),
				'description' => esc_html__( 'Configure typography settings', 'crossarena' ),
				'priority'    => 45,
				'type'        => 'panel',
			),

			/** `Body text` section */
			'body_typography' => array(
				'title'       => esc_html__( 'Body text', 'crossarena' ),
				'priority'    => 5,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'body_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'crossarena' ),
				'section' => 'body_typography',
				'default' => 'Montserrat, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'body_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'crossarena' ),
				'section' => 'body_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => crossarena_get_font_styles(),
				'type'    => 'control',
			),
			'body_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'crossarena' ),
				'section' => 'body_typography',
				'default' => '300',
				'field'   => 'select',
				'choices' => crossarena_get_font_weight(),
				'type'    => 'control',
			),
			'body_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'crossarena' ),
				'section'     => 'body_typography',
				'default'     => '16',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 6,
					'max'  => 50,
					'step' => 1,
				),
				'type' => 'control',
			),
			'body_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'crossarena' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'crossarena' ),
				'section'     => 'body_typography',
				'default'     => '1.6',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'body_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'crossarena' ),
				'section'     => 'body_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'body_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'crossarena' ),
				'section' => 'body_typography',
				'default' => 'italic',
				'field'   => 'select',
				'choices' => crossarena_get_character_sets(),
				'type'    => 'control',
			),
			'body_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'crossarena' ),
				'section' => 'body_typography',
				'default' => 'left',
				'field'   => 'select',
				'choices' => crossarena_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H1 Heading` section */
			'h1_typography' => array(
				'title'       => esc_html__( 'H1 Heading', 'crossarena' ),
				'priority'    => 10,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h1_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'crossarena' ),
				'section' => 'h1_typography',
				'default' => 'Montserrat, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h1_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'crossarena' ),
				'section' => 'h1_typography',
				'default' => 'italic',
				'field'   => 'select',
				'choices' => crossarena_get_font_styles(),
				'type'    => 'control',
			),
			'h1_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'crossarena' ),
				'section' => 'h1_typography',
				'default' => '900',
				'field'   => 'select',
				'choices' => crossarena_get_font_weight(),
				'type'    => 'control',
			),
			'h1_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'crossarena' ),
				'section'     => 'h1_typography',
				'default'     => '90',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h1_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'crossarena' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'crossarena' ),
				'section'     => 'h1_typography',
				'default'     => '1.1',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h1_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'crossarena' ),
				'section'     => 'h1_typography',
				'default'     => '3',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h1_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'crossarena' ),
				'section' => 'h1_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => crossarena_get_character_sets(),
				'type'    => 'control',
			),
			'h1_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'crossarena' ),
				'section' => 'h1_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => crossarena_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H2 Heading` section */
			'h2_typography' => array(
				'title'       => esc_html__( 'H2 Heading', 'crossarena' ),
				'priority'    => 15,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h2_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'crossarena' ),
				'section' => 'h2_typography',
				'default' => 'Montserrat, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h2_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'crossarena' ),
				'section' => 'h2_typography',
				'default' => 'italic',
				'field'   => 'select',
				'choices' => crossarena_get_font_styles(),
				'type'    => 'control',
			),
			'h2_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'crossarena' ),
				'section' => 'h2_typography',
				'default' => '900',
				'field'   => 'select',
				'choices' => crossarena_get_font_weight(),
				'type'    => 'control',
			),
			'h2_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'crossarena' ),
				'section'     => 'h2_typography',
				'default'     => '36',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h2_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'crossarena' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'crossarena' ),
				'section'     => 'h2_typography',
				'default'     => '1',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h2_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'crossarena' ),
				'section'     => 'h2_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h2_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'crossarena' ),
				'section' => 'h2_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => crossarena_get_character_sets(),
				'type'    => 'control',
			),
			'h2_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'crossarena' ),
				'section' => 'h2_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => crossarena_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H3 Heading` section */
			'h3_typography' => array(
				'title'       => esc_html__( 'H3 Heading', 'crossarena' ),
				'priority'    => 20,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h3_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'crossarena' ),
				'section' => 'h3_typography',
				'default' => 'Montserrat, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h3_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'crossarena' ),
				'section' => 'h3_typography',
				'default' => 'italic',
				'field'   => 'select',
				'choices' => crossarena_get_font_styles(),
				'type'    => 'control',
			),
			'h3_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'crossarena' ),
				'section' => 'h3_typography',
				'default' => '900',
				'field'   => 'select',
				'choices' => crossarena_get_font_weight(),
				'type'    => 'control',
			),
			'h3_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'crossarena' ),
				'section'     => 'h3_typography',
				'default'     => '24',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h3_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'crossarena' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'crossarena' ),
				'section'     => 'h3_typography',
				'default'     => '1.3',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h3_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'crossarena' ),
				'section'     => 'h3_typography',
				'default'     => '1',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h3_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'crossarena' ),
				'section' => 'h3_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => crossarena_get_character_sets(),
				'type'    => 'control',
			),
			'h3_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'crossarena' ),
				'section' => 'h3_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => crossarena_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H4 Heading` section */
			'h4_typography' => array(
				'title'       => esc_html__( 'H4 Heading', 'crossarena' ),
				'priority'    => 25,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h4_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'crossarena' ),
				'section' => 'h4_typography',
				'default' => 'Montserrat, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h4_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'crossarena' ),
				'section' => 'h4_typography',
				'default' => 'italic',
				'field'   => 'select',
				'choices' => crossarena_get_font_styles(),
				'type'    => 'control',
			),
			'h4_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'crossarena' ),
				'section' => 'h4_typography',
				'default' => '900',
				'field'   => 'select',
				'choices' => crossarena_get_font_weight(),
				'type'    => 'control',
			),
			'h4_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'crossarena' ),
				'section'     => 'h4_typography',
				'default'     => '18',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h4_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'crossarena' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'crossarena' ),
				'section'     => 'h4_typography',
				'default'     => '1.5',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h4_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'crossarena' ),
				'section'     => 'h4_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h4_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'crossarena' ),
				'section' => 'h4_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => crossarena_get_character_sets(),
				'type'    => 'control',
			),
			'h4_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'crossarena' ),
				'section' => 'h4_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => crossarena_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H5 Heading` section */
			'h5_typography' => array(
				'title'       => esc_html__( 'H5 Heading', 'crossarena' ),
				'priority'    => 30,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h5_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'crossarena' ),
				'section' => 'h5_typography',
				'default' => 'Montserrat, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h5_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'crossarena' ),
				'section' => 'h5_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => crossarena_get_font_styles(),
				'type'    => 'control',
			),
			'h5_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'crossarena' ),
				'section' => 'h5_typography',
				'default' => '700',
				'field'   => 'select',
				'choices' => crossarena_get_font_weight(),
				'type'    => 'control',
			),
			'h5_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'crossarena' ),
				'section'     => 'h5_typography',
				'default'     => '16',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h5_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'crossarena' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'crossarena' ),
				'section'     => 'h5_typography',
				'default'     => '1.5',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h5_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'crossarena' ),
				'section'     => 'h5_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h5_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'crossarena' ),
				'section' => 'h5_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => crossarena_get_character_sets(),
				'type'    => 'control',
			),
			'h5_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'crossarena' ),
				'section' => 'h5_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => crossarena_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H6 Heading` section */
			'h6_typography' => array(
				'title'       => esc_html__( 'H6 Heading', 'crossarena' ),
				'priority'    => 35,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h6_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'crossarena' ),
				'section' => 'h6_typography',
				'default' => 'Montserrat, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h6_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'crossarena' ),
				'section' => 'h6_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => crossarena_get_font_styles(),
				'type'    => 'control',
			),
			'h6_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'crossarena' ),
				'section' => 'h6_typography',
				'default' => '600',
				'field'   => 'select',
				'choices' => crossarena_get_font_weight(),
				'type'    => 'control',
			),
			'h6_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'crossarena' ),
				'section'     => 'h6_typography',
				'default'     => '13',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h6_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'crossarena' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'crossarena' ),
				'section'     => 'h6_typography',
				'default'     => '1.5',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h6_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'crossarena' ),
				'section'     => 'h6_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h6_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'crossarena' ),
				'section' => 'h6_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => crossarena_get_character_sets(),
				'type'    => 'control',
			),
			'h6_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'crossarena' ),
				'section' => 'h6_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => crossarena_get_text_aligns(),
				'type'    => 'control',
			),

			/** `Body text` section */
			'breadcrumbs_typography' => array(
				'title'       => esc_html__( 'Breadcrumbs text', 'crossarena' ),
				'priority'    => 45,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'breadcrumbs_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'crossarena' ),
				'section' => 'breadcrumbs_typography',
				'default' => 'Montserrat, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'breadcrumbs_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'crossarena' ),
				'section' => 'breadcrumbs_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => crossarena_get_font_styles(),
				'type'    => 'control',
			),
			'breadcrumbs_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'crossarena' ),
				'section' => 'breadcrumbs_typography',
				'default' => '500',
				'field'   => 'select',
				'choices' => crossarena_get_font_weight(),
				'type'    => 'control',
			),
			'breadcrumbs_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'crossarena' ),
				'section'     => 'breadcrumbs_typography',
				'default'     => '18',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 6,
					'max'  => 50,
					'step' => 1,
				),
				'type' => 'control',
			),
			'breadcrumbs_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'crossarena' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'crossarena' ),
				'section'     => 'breadcrumbs_typography',
				'default'     => '1.6',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'breadcrumbs_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'crossarena' ),
				'section'     => 'breadcrumbs_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'breadcrumbs_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'crossarena' ),
				'section' => 'breadcrumbs_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => crossarena_get_character_sets(),
				'type'    => 'control',
			),
			/** `Header` panel */
			'header_options' => array(
				'title'    => esc_html__( 'Header', 'crossarena' ),
				'priority' => 60,
				'type'     => 'panel',
			),

			/** `Header styles` section */
			'header_styles' => array(
				'title'    => esc_html__( 'Styles', 'crossarena' ),
				'priority' => 5,
				'panel'    => 'header_options',
				'type'     => 'section',
			),
			'header_layout_type' => array(
				'title'   => esc_html__( 'Layout', 'crossarena' ),
				'section' => 'header_styles',
				'default' => 'default',
				'field'   => 'select',
				'choices' => crossarena_get_header_layout_options(),
				'type'    => 'control',
			),
			'header_bg_color' => array(
				'title'   => esc_html__( 'Background Color', 'crossarena' ),
				'section' => 'header_styles',
				'field'   => 'hex_color',
				'default' => '#191a1f',
				'type'    => 'control',
			),
			'header_bg_image' => array(
				'title'   => esc_html__( 'Background Image', 'crossarena' ),
				'section' => 'header_styles',
				'field'   => 'image',
				'default' => '%s/assets/images/header_bg.jpg',
				'type'    => 'control',
			),
			'header_bg_repeat' => array(
				'title'   => esc_html__( 'Background Repeat', 'crossarena' ),
				'section' => 'header_styles',
				'default' => 'no-repeat',
				'field'   => 'select',
				'choices' => array(
					'no-repeat' => esc_html__( 'No Repeat', 'crossarena' ),
					'repeat'    => esc_html__( 'Tile', 'crossarena' ),
					'repeat-x'  => esc_html__( 'Tile Horizontally', 'crossarena' ),
					'repeat-y'  => esc_html__( 'Tile Vertically', 'crossarena' ),
				),
				'type'    => 'control',
			),
			'header_bg_position_x' => array(
				'title'   => esc_html__( 'Background Position', 'crossarena' ),
				'section' => 'header_styles',
				'default' => 'center',
				'field'   => 'select',
				'choices' => array(
					'left'   => esc_html__( 'Left', 'crossarena' ),
					'center' => esc_html__( 'Center', 'crossarena' ),
					'right'  => esc_html__( 'Right', 'crossarena' ),
				),
				'type'    => 'control',
			),
			'header_bg_attachment' => array(
				'title'   => esc_html__( 'Background Attachment', 'crossarena' ),
				'section' => 'header_styles',
				'default' => 'scroll',
				'field'   => 'select',
				'choices' => array(
					'scroll' => esc_html__( 'Scroll', 'crossarena' ),
					'fixed'  => esc_html__( 'Fixed', 'crossarena' ),
				),
				'type'    => 'control',
			),

			/** `Top Panel` section */
			'header_top_panel' => array(
				'title'    => esc_html__( 'Top Panel', 'crossarena' ),
				'priority' => 10,
				'panel'    => 'header_options',
				'type'     => 'section',
			),
			'top_panel_visibility' => array(
				'title'   => esc_html__( 'Enable top panel', 'crossarena' ),
				'section' => 'header_top_panel',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'top_panel_bg'        => array(
				'title'           => esc_html__( 'Background color', 'crossarena' ),
				'section'         => 'header_top_panel',
				'default'         => '#191a1f',
				'field'           => 'hex_color',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_top_panel_enable',
			),

			/** `Header elements` section */
			'header_elements' => array(
				'title'       => esc_html__( 'Header Elements', 'crossarena' ),
				'priority'    => 15,
				'panel'       => 'header_options',
				'type'        => 'section',
			),
			'header_search' => array(
				'title'   => esc_html__( 'Show search', 'crossarena' ),
				'section' => 'header_elements',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'header_btn_visibility' => array(
				'title'   => esc_html__( 'Show header call to action button', 'crossarena' ),
				'section' => 'header_elements',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'header_panel_text' => array(
				'title'           => esc_html__( 'Disclaimer Text', 'crossarena' ),
				'description'     => esc_html__( 'HTML formatting support', 'crossarena' ),
				'section'         => 'header_elements',
				'default'         => false,
				'field'           => 'textarea',
				'type'            => 'control',
			),
			'header_btn_text' => array(
				'title'           => esc_html__( 'Header call to action button', 'crossarena' ),
				'description'     => esc_html__( 'Button text', 'crossarena' ),
				'section'         => 'header_elements',
				'default'         => esc_html__( 'Make an Appointment', 'crossarena' ),
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_header_btn_visible',
			),
			'header_btn_url' => array(
				'title'           => '',
				'description'     => esc_html__( 'Button url', 'crossarena' ),
				'section'         => 'header_elements',
				'default'         => '#',
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_header_btn_visible',
			),

			/** `Header contact block` section */
			'header_contact_block' => array(
				'title'    => esc_html__( 'Header Contact Block', 'crossarena' ),
				'priority' => 20,
				'panel'    => 'header_options',
				'type'     => 'section',
			),
			'header_contact_block_visibility' => array(
				'title'   => esc_html__( 'Show Header Contact Block', 'crossarena' ),
				'section' => 'header_contact_block',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'header_contact_icon_1' => array(
				'title'           => esc_html__( 'Contact item 1', 'crossarena' ),
				'description'     => esc_html__( 'Choose icon', 'crossarena' ),
				'section'         => 'header_contact_block',
				'field'           => 'iconpicker',
				'default'         => 'fa-credit-card',
				'icon_data'       => array(
					'icon_set'    => 'moreButtonFontAwesome',
					'icon_css'    => CROSSARENA_THEME_URI . '/assets/css/font-awesome.min.css',
					'icon_base'   => 'fa',
					'icon_prefix' => 'fa-',
					'icons'       => crossarena_get_icons_set(),
				),
				'type'            => 'control',
				'active_callback' => 'crossarena_is_header_contact_block_visible',
			),
			'header_contact_label_1' => array(
				'title'           => '',
				'description'     => esc_html__( 'Label', 'crossarena' ),
				'section'         => 'header_contact_block',
				'default'         => false,
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_header_contact_block_visible',
			),
			'header_contact_text_1' => array(
				'title'           => '',
				'description'     => esc_html__( 'Description', 'crossarena' ),
				'section'         => 'header_contact_block',
				'default'         => crossarena_get_default_contact_information( 'location' ),
				'field'           => 'textarea',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_header_contact_block_visible',
			),
			'header_contact_icon_2' => array(
				'title'           => esc_html__( 'Contact item 2', 'crossarena' ),
				'description'     => esc_html__( 'Choose icon', 'crossarena' ),
				'section'         => 'header_contact_block',
				'field'           => 'iconpicker',
				'default'         => 'fa-clock-o',
				'icon_data'       => array(
					'icon_set'    => 'moreButtonFontAwesome',
					'icon_css'    => CROSSARENA_THEME_URI . '/assets/css/font-awesome.min.css',
					'icon_base'   => 'fa',
					'icon_prefix' => 'fa-',
					'icons'       => crossarena_get_icons_set(),
				),
				'type'            => 'control',
				'active_callback' => 'crossarena_is_header_contact_block_visible',
			),
			'header_contact_label_2' => array(
				'title'           => '',
				'description'     => esc_html__( 'Label', 'crossarena' ),
				'section'         => 'header_contact_block',
				'default'         => false,
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_header_contact_block_visible',
			),
			'header_contact_text_2' => array(
				'title'           => '',
				'description'     => esc_html__( 'Description', 'crossarena' ),
				'section'         => 'header_contact_block',
				'default'         => crossarena_get_default_contact_information( 'time' ),
				'field'           => 'textarea',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_header_contact_block_visible',
			),
			'header_contact_icon_3' => array(
				'title'           => esc_html__( 'Contact item 3', 'crossarena' ),
				'description'     => esc_html__( 'Choose icon', 'crossarena' ),
				'section'         => 'header_contact_block',
				'field'           => 'iconpicker',
				'default'         => 'fa-phone',
				'icon_data'       => array(
					'icon_set'    => 'moreButtonFontAwesome',
					'icon_css'    => CROSSARENA_THEME_URI . '/assets/css/font-awesome.min.css',
					'icon_base'   => 'fa',
					'icon_prefix' => 'fa-',
					'icons'       => crossarena_get_icons_set(),
				),
				'type'            => 'control',
				'active_callback' => 'crossarena_is_header_contact_block_visible',
			),
			'header_contact_label_3' => array(
				'title'           => '',
				'description'     => esc_html__( 'Label', 'crossarena' ),
				'section'         => 'header_contact_block',
				'default'         => false,
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_header_contact_block_visible',
			),
			'header_contact_text_3' => array(
				'title'           => '',
				'description'     => esc_html__( 'Description', 'crossarena' ),
				'section'         => 'header_contact_block',
				'default'         => crossarena_get_default_contact_information( 'phone' ),
				'field'           => 'textarea',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_header_contact_block_visible',
			),

			/** `Main Menu` section */
			'header_main_menu' => array(
				'title'    => esc_html__( 'Main Menu', 'crossarena' ),
				'priority' => 20,
				'panel'    => 'header_options',
				'type'     => 'section',
			),
			'header_menu_sticky' => array(
				'title'   => esc_html__( 'Enable sticky menu', 'crossarena' ),
				'section' => 'header_main_menu',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'header_menu_attributes' => array(
				'title'   => esc_html__( 'Enable description', 'crossarena' ),
				'section' => 'header_main_menu',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'more_button_type' => array(
				'title'   => esc_html__( 'More Menu Button Type', 'crossarena' ),
				'section' => 'header_main_menu',
				'default' => 'text',
				'field'   => 'radio',
				'choices' => array(
					'image' => esc_html__( 'Image', 'crossarena' ),
					'icon'  => esc_html__( 'Icon', 'crossarena' ),
					'text'  => esc_html__( 'Text', 'crossarena' ),
				),
				'type'    => 'control',
			),
			'more_button_text' => array(
				'title'           => esc_html__( 'More Menu Button Text', 'crossarena' ),
				'section'         => 'header_main_menu',
				'default'         => esc_html__( 'More', 'crossarena' ),
				'field'           => 'input',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_more_button_type_text',
			),
			'more_button_icon' => array(
				'title'           => esc_html__( 'More Menu Button Icon', 'crossarena' ),
				'section'         => 'header_main_menu',
				'field'           => 'iconpicker',
				'type'            => 'control',
				'default'         => 'fa-arrow-down',
				'active_callback' => 'crossarena_is_more_button_type_icon',
				'icon_data'       => array(
					'icon_set'    => 'moreButtonFontAwesome',
					'icon_css'    => CROSSARENA_THEME_URI . '/assets/css/font-awesome.min.css',
					'icon_base'   => 'fa',
					'icon_prefix' => 'fa-',
					'icons'       => crossarena_get_icons_set(),
				),
			),
			'more_button_image_url' => array(
				'title'           => esc_html__( 'More Button Image Upload', 'crossarena' ),
				'description'     => esc_html__( 'Upload More Button image', 'crossarena' ),
				'section'         => 'header_main_menu',
				'default'         => '',
				'field'           => 'image',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_more_button_type_image',
			),
			'retina_more_button_image_url' => array(
				'title'           => esc_html__( 'Retina More Button Image Upload', 'crossarena' ),
				'description'     => esc_html__( 'Upload More Button image for retina-ready devices', 'crossarena' ),
				'section'         => 'header_main_menu',
				'field'           => 'image',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_more_button_type_image',
			),

			/** `Sidebar` section */
			'sidebar_settings' => array(
				'title'    => esc_html__( 'Sidebar', 'crossarena' ),
				'priority' => 105,
				'type'     => 'section',
			),
			'sidebar_position' => array(
				'title'   => esc_html__( 'Sidebar Position', 'crossarena' ),
				'section' => 'sidebar_settings',
				'default' => 'fullwidth',
				'field'   => 'select',
				'choices' => array(
					'one-left-sidebar'  => esc_html__( 'Sidebar on left side', 'crossarena' ),
					'one-right-sidebar' => esc_html__( 'Sidebar on right side', 'crossarena' ),
					'fullwidth'         => esc_html__( 'No sidebars', 'crossarena' ),
				),
				'type' => 'control',
			),

			/** `mailchimp` section */
			'mailchimp' => array(
				'title'       => esc_html__( 'MailChimp', 'crossarena' ),
				'description' => esc_html__( 'Setup MailChimp settings for subscribe widget', 'crossarena' ),
				'priority'    => 109,
				'type'        => 'section',
			),
			'mailchimp_api_key' => array(
				'title'   => esc_html__( 'MailChimp API key', 'crossarena' ),
				'section' => 'mailchimp',
				'field'   => 'text',
				'type'    => 'control',
			),
			'mailchimp_list_id' => array(
				'title'   => esc_html__( 'MailChimp list ID', 'crossarena' ),
				'section' => 'mailchimp',
				'field'   => 'text',
				'type'    => 'control',
			),

			/** `Ads Management` panel */
			'ads_management' => array(
				'title'    => esc_html__( 'Ads Management', 'crossarena' ),
				'priority' => 110,
				'type'     => 'section',
			),
			'ads_header' => array(
				'title'             => esc_html__( 'Header', 'crossarena' ),
				'section'           => 'ads_management',
				'field'             => 'textarea',
				'default'           => '',
				'sanitize_callback' => 'esc_html',
				'type'              => 'control',
			),
			'ads_home_before_loop' => array(
				'title'             => esc_html__( 'Front Page Before Loop', 'crossarena' ),
				'section'           => 'ads_management',
				'field'             => 'textarea',
				'default'           => '',
				'sanitize_callback' => 'esc_html',
				'type'              => 'control',
			),
			'ads_post_before_content' => array(
				'title'             => esc_html__( 'Post Before Content', 'crossarena' ),
				'section'           => 'ads_management',
				'field'             => 'textarea',
				'default'           => '',
				'sanitize_callback' => 'esc_html',
				'type'              => 'control',
			),
			'ads_post_before_comments' => array(
				'title'             => esc_html__( 'Post Before Comments', 'crossarena' ),
				'section'           => 'ads_management',
				'field'             => 'textarea',
				'default'           => '',
				'sanitize_callback' => 'esc_html',
				'type'              => 'control',
			),

			/** `Footer` panel */
			'footer_options' => array(
				'title'    => esc_html__( 'Footer', 'crossarena' ),
				'priority' => 110,
				'type'     => 'panel',
			),

			/** `Footer styles` section */
			'footer_styles' => array(
				'title'    => esc_html__( 'Footer Styles', 'crossarena' ),
				'priority' => 5,
				'panel'    => 'footer_options',
				'type'     => 'section',
			),
			'footer_logo_visibility' => array(
				'title'   => esc_html__( 'Show Footer Logo', 'crossarena' ),
				'section' => 'footer_styles',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'footer_logo_url' => array(
				'title'           => esc_html__( 'Logo upload', 'crossarena' ),
				'section'         => 'footer_styles',
				'field'           => 'image',
				'default'         => '%s/assets/images/footer-logo.png',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_footer_logo_visible',
			),
			'footer_copyright' => array(
				'title'   => esc_html__( 'Copyright text', 'crossarena' ),
				'section' => 'footer_styles',
				'default' => crossarena_get_default_footer_copyright(),
				'field'   => 'textarea',
				'type'    => 'control',
			),
			'footer_layout_type' => array(
				'title'   => esc_html__( 'Layout', 'crossarena' ),
				'section' => 'footer_styles',
				'default' => 'default',
				'field'   => 'select',
				'choices' => crossarena_get_footer_layout_options(),
				'type' => 'control',
			),
			'footer_bg' => array(
				'title'   => esc_html__( 'Footer Background color', 'crossarena' ),
				'section' => 'footer_styles',
				'default' => '#111217',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'footer_subscribe_visibility' => array(
				'title'   => esc_html__( 'Show Subscribe', 'crossarena' ),
				'section' => 'footer_styles',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'footer_widget_area_visibility' => array(
				'title'   => esc_html__( 'Show Footer Widgets Area', 'crossarena' ),
				'section' => 'footer_styles',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'footer_widget_columns' => array(
				'title'           => esc_html__( 'Widget Area Columns', 'crossarena' ),
				'section'         => 'footer_styles',
				'default'         => '3',
				'field'           => 'select',
				'choices'         => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'type'            => 'control',
				'active_callback' => 'crossarena_is_footer_area_visible',
			),
			'footer_widgets_bg' => array(
				'title'           => esc_html__( 'Footer Widgets Area Background color', 'crossarena' ),
				'section'         => 'footer_styles',
				'default'         => '#111217',
				'field'           => 'hex_color',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_footer_area_visible',
			),
			'footer_menu_visibility' => array(
				'title'   => esc_html__( 'Show Footer Menu', 'crossarena' ),
				'section' => 'footer_styles',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Footer contact block` section */
			'footer_contact_block' => array(
				'title'    => esc_html__( 'Footer Contact Block', 'crossarena' ),
				'priority' => 10,
				'panel'    => 'footer_options',
				'type'     => 'section',
			),
			'footer_contact_block_visibility' => array(
				'title'   => esc_html__( 'Show Footer Contact Block', 'crossarena' ),
				'section' => 'footer_contact_block',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'footer_contact_icon_1' => array(
				'title'           => esc_html__( 'Contact item 1', 'crossarena' ),
				'description'     => esc_html__( 'Choose icon', 'crossarena' ),
				'section'         => 'footer_contact_block',
				'field'           => 'iconpicker',
				'default'         => 'fa-map-marker',
				'icon_data'       => array(
					'icon_set'    => 'moreButtonFontAwesome',
					'icon_css'    => CROSSARENA_THEME_URI . '/assets/css/font-awesome.min.css',
					'icon_base'   => 'fa',
					'icon_prefix' => 'fa-',
					'icons'       => crossarena_get_icons_set(),
				),
				'type'            => 'control',
				'active_callback' => 'crossarena_is_footer_contact_block_visible',
			),
			'footer_contact_label_1' => array(
				'title'           => '',
				'description'     => esc_html__( 'Label', 'crossarena' ),
				'section'         => 'footer_contact_block',
				'default'         => esc_html__( 'Address:', 'crossarena' ),
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_footer_contact_block_visible',
			),
			'footer_contact_text_1' => array(
				'title'           => '',
				'description'     => esc_html__( 'Value (HTML formatting support)', 'crossarena' ),
				'section'         => 'footer_contact_block',
				'default'         => crossarena_get_default_contact_information( 'location' ),
				'field'           => 'textarea',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_footer_contact_block_visible',
			),
			'footer_contact_icon_2' => array(
				'title'           => esc_html__( 'Contact item 2', 'crossarena' ),
				'description'     => esc_html__( 'Choose icon', 'crossarena' ),
				'section'         => 'footer_contact_block',
				'field'           => 'iconpicker',
				'default'         => 'fa-phone',
				'icon_data'       => array(
					'icon_set'    => 'moreButtonFontAwesome',
					'icon_css'    => CROSSARENA_THEME_URI . '/assets/css/font-awesome.min.css',
					'icon_base'   => 'fa',
					'icon_prefix' => 'fa-',
					'icons'       => crossarena_get_icons_set(),
				),
				'type'            => 'control',
				'active_callback' => 'crossarena_is_footer_contact_block_visible',
			),
			'footer_contact_label_2' => array(
				'title'           => '',
				'description'     => esc_html__( 'Label', 'crossarena' ),
				'section'         => 'footer_contact_block',
				'default'         => esc_html__( 'Phones:', 'crossarena' ),
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_footer_contact_block_visible',
			),
			'footer_contact_text_2' => array(
				'title'           => '',
				'description'     => esc_html__( 'Value (HTML formatting support)', 'crossarena' ),
				'section'         => 'footer_contact_block',
				'default'         => crossarena_get_default_contact_information( 'mail' ),
				'field'           => 'textarea',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_footer_contact_block_visible',
			),
			'footer_contact_icon_3' => array(
				'title'           => esc_html__( 'Contact item 3', 'crossarena' ),
				'description'     => esc_html__( 'Choose icon', 'crossarena' ),
				'section'         => 'footer_contact_block',
				'field'           => 'iconpicker',
				'default'         => false,
				'icon_data'       => array(
					'icon_set'    => 'moreButtonFontAwesome',
					'icon_css'    => CROSSARENA_THEME_URI . '/assets/css/font-awesome.min.css',
					'icon_base'   => 'fa',
					'icon_prefix' => 'fa-',
					'icons'       => crossarena_get_icons_set(),
				),
				'type'            => 'control',
				'active_callback' => 'crossarena_is_footer_contact_block_visible',
			),
			'footer_contact_label_3' => array(
				'title'           => '',
				'description'     => esc_html__( 'Label', 'crossarena' ),
				'section'         => 'footer_contact_block',
				'default'         => false,
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_footer_contact_block_visible',
			),
			'footer_contact_text_3' => array(
				'title'           => '',
				'description'     => esc_html__( 'Value (HTML formatting support)', 'crossarena' ),
				'section'         => 'footer_contact_block',
				'default'         => false,
				'field'           => 'textarea',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_footer_contact_block_visible',
			),

			/** `Blog Settings` panel */
			'blog_settings' => array(
				'title'    => esc_html__( 'Blog Settings', 'crossarena' ),
				'priority' => 115,
				'type'     => 'panel',
			),

			/** `Blog` section */
			'blog' => array(
				'title'           => esc_html__( 'Blog', 'crossarena' ),
				'panel'           => 'blog_settings',
				'priority'        => 10,
				'type'            => 'section',
				'active_callback' => 'is_home',
			),
			'blog_layout_type' => array(
				'title'   => esc_html__( 'Layout', 'crossarena' ),
				'section' => 'grid-3-cols',
				'default' => 'default',
				'field'   => 'select',
				'choices' => array(
					'default'          => esc_html__( 'Listing', 'crossarena' ),
					'grid-2-cols'      => esc_html__( 'Grid (2 Columns)', 'crossarena' ),
					'grid-3-cols'      => esc_html__( 'Grid (3 Columns)', 'crossarena' ),
					'masonry-2-cols'   => esc_html__( 'Masonry (2 Columns)', 'crossarena' ),
					'masonry-3-cols'   => esc_html__( 'Masonry (3 Columns)', 'crossarena' ),
					'vertical-justify' => esc_html__( 'Vertical Justify', 'crossarena' ),
				),
				'type' => 'control',
			),
			'blog_sticky_type' => array(
				'title'   => esc_html__( 'Sticky label type', 'crossarena' ),
				'section' => 'blog',
				'default' => 'icon',
				'field'   => 'select',
				'choices' => array(
					'label' => esc_html__( 'Text Label', 'crossarena' ),
					'icon'  => esc_html__( 'Font Icon', 'crossarena' ),
					'both'  => esc_html__( 'Text with Icon', 'crossarena' ),
				),
				'type' => 'control',
			),
			'blog_sticky_icon' => array(
				'title'           => esc_html__( 'Icon for sticky post', 'crossarena' ),
				'section'         => 'blog',
				'field'           => 'iconpicker',
				'default'         => 'fa-star',
				'icon_data'       => array(
					'icon_set'    => 'moreButtonFontAwesome',
					'icon_css'    => CROSSARENA_THEME_URI . '/assets/css/font-awesome.min.css',
					'icon_base'   => 'fa',
					'icon_prefix' => 'fa-',
					'icons'       => crossarena_get_icons_set(),
				),
				'type'            => 'control',
				'active_callback' => 'crossarena_is_header_contact_block_visible',
			),
			'blog_sticky_label' => array(
				'title'           => esc_html__( 'Featured Post Label', 'crossarena' ),
				'description'     => esc_html__( 'Label for sticky post', 'crossarena' ),
				'section'         => 'blog',
				'default'         => esc_html__( 'Featured', 'crossarena' ),
				'field'           => 'text',
				'active_callback' => 'crossarena_is_sticky_text',
				'type'            => 'control',
			),
			'blog_posts_content' => array(
				'title'   => esc_html__( 'Post content', 'crossarena' ),
				'section' => 'blog',
				'default' => 'excerpt',
				'field'   => 'select',
				'choices' => array(
					'excerpt' => esc_html__( 'Only excerpt', 'crossarena' ),
					'full'    => esc_html__( 'Full content', 'crossarena' ),
					'none'    => esc_html__( 'Hide', 'crossarena' ),
				),
				'type' => 'control',
			),
			'blog_featured_image' => array(
				'title'           => esc_html__( 'Featured image', 'crossarena' ),
				'section'         => 'blog',
				'default'         => 'fullwidth',
				'field'           => 'select',
				'choices'         => array(
					'small'     => esc_html__( 'Small', 'crossarena' ),
					'fullwidth' => esc_html__( 'Fullwidth', 'crossarena' ),
				),
				'type'            => 'control',
				'active_callback' => 'crossarena_is_blog_featured_image',
			),
			'blog_read_more_text' => array(
				'title'       => esc_html__( 'Read More button text', 'crossarena' ),
				'description' => esc_html__( 'Leave empty to hide button', 'crossarena' ),
				'section'     => 'blog',
				'default'     => esc_html__( 'Read More', 'crossarena' ),
				'field'       => 'text',
				'type'        => 'control',
			),
			'blog_post_author' => array(
				'title'   => esc_html__( 'Show post author', 'crossarena' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_publish_date' => array(
				'title'   => esc_html__( 'Show publish date', 'crossarena' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_categories' => array(
				'title'   => esc_html__( 'Show categories', 'crossarena' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_tags' => array(
				'title'   => esc_html__( 'Show tags', 'crossarena' ),
				'section' => 'blog',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_comments' => array(
				'title'   => esc_html__( 'Show comments', 'crossarena' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Post` section */
			'blog_post' => array(
				'title'           => esc_html__( 'Post', 'crossarena' ),
				'panel'           => 'blog_settings',
				'priority'        => 20,
				'type'            => 'section',
				'active_callback' => 'callback_single',
			),
			'single_post_type' => array(
				'title'   => esc_html__( 'Post style', 'crossarena' ),
				'section' => 'blog_post',
				'default' => 'default',
				'field'   => 'select',
				'choices' => array(
					'default' => esc_html__( 'Default', 'crossarena' ),
					'modern'  => esc_html__( 'Modern', 'crossarena' ),
				),
				'type' => 'control',
			),
			'single_post_author' => array(
				'title'   => esc_html__( 'Show post author', 'crossarena' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_publish_date' => array(
				'title'   => esc_html__( 'Show publish date', 'crossarena' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_categories' => array(
				'title'   => esc_html__( 'Show categories', 'crossarena' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_tags' => array(
				'title'   => esc_html__( 'Show tags', 'crossarena' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_comments' => array(
				'title'   => esc_html__( 'Show comments', 'crossarena' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_author_block' => array(
				'title'   => esc_html__( 'Enable the author block after each post', 'crossarena' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_navigation' => array(
				'title'   => esc_html__( 'Enable post navigation', 'crossarena' ),
				'section' => 'blog_post',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Related Posts` section */
			'related_posts' => array(
				'title'           => esc_html__( 'Related posts block', 'crossarena' ),
				'panel'           => 'blog_settings',
				'priority'        => 30,
				'type'            => 'section',
				'active_callback' => 'callback_single',
			),
			'related_posts_visible' => array(
				'title'   => esc_html__( 'Show related posts block', 'crossarena' ),
				'section' => 'related_posts',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'related_posts_block_title' => array(
				'title'           => esc_html__( 'Related posts block title', 'crossarena' ),
				'section'         => 'related_posts',
				'default'         => esc_html__( 'Related Posts', 'crossarena' ),
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_related_posts_visible',
			),
			'related_posts_count' => array(
				'title'           => esc_html__( 'Number of post', 'crossarena' ),
				'section'         => 'related_posts',
				'default'         => '2',
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_related_posts_visible',
			),
			'related_posts_grid' => array(
				'title'           => esc_html__( 'Layout', 'crossarena' ),
				'section'         => 'related_posts',
				'default'         => '2',
				'field'           => 'select',
				'choices'         => array(
					'2' => esc_html__( '2 columns', 'crossarena' ),
					'3' => esc_html__( '3 columns', 'crossarena' ),
					'4' => esc_html__( '4 columns', 'crossarena' ),
				),
				'type'            => 'control',
				'active_callback' => 'crossarena_is_related_posts_visible',
			),
			'related_posts_title' => array(
				'title'           => esc_html__( 'Show post title', 'crossarena' ),
				'section'         => 'related_posts',
				'default'         => true,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_related_posts_visible',
			),
			'related_posts_title_length' => array(
				'title'           => esc_html__( 'Number of words in the title', 'crossarena' ),
				'section'         => 'related_posts',
				'default'         => '10',
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_related_posts_visible',
			),
			'related_posts_image' => array(
				'title'           => esc_html__( 'Show post image', 'crossarena' ),
				'section'         => 'related_posts',
				'default'         => true,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_related_posts_visible',
			),
			'related_posts_content' => array(
				'title'           => esc_html__( 'Display content', 'crossarena' ),
				'section'         => 'related_posts',
				'default'         => 'hide',
				'field'           => 'select',
				'choices'         => array(
					'hide'         => esc_html__( 'Hide', 'crossarena' ),
					'post_excerpt' => esc_html__( 'Excerpt', 'crossarena' ),
					'post_content' => esc_html__( 'Content', 'crossarena' ),
				),
				'type'            => 'control',
				'active_callback' => 'crossarena_is_related_posts_visible',
			),
			'related_posts_content_length' => array(
				'title'           => esc_html__( 'Number of words in the content', 'crossarena' ),
				'section'         => 'related_posts',
				'default'         => '25',
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_related_posts_visible',
			),
			'related_posts_categories' => array(
				'title'           => esc_html__( 'Show post categories', 'crossarena' ),
				'section'         => 'related_posts',
				'default'         => false,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_related_posts_visible',
			),
			'related_posts_tags' => array(
				'title'           => esc_html__( 'Show post tags', 'crossarena' ),
				'section'         => 'related_posts',
				'default'         => false,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_related_posts_visible',
			),
			'related_posts_author' => array(
				'title'           => esc_html__( 'Show post author', 'crossarena' ),
				'section'         => 'related_posts',
				'default'         => true,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_related_posts_visible',
			),
			'related_posts_publish_date' => array(
				'title'           => esc_html__( 'Show post publish date', 'crossarena' ),
				'section'         => 'related_posts',
				'default'         => true,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_related_posts_visible',
			),
			'related_posts_comment_count' => array(
				'title'           => esc_html__( 'Show post comment count', 'crossarena' ),
				'section'         => 'related_posts',
				'default'         => false,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'crossarena_is_related_posts_visible',
			),
		),
	) );
}

/**
 * Return true if setting is value. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @param  string $setting Setting name to check.
 * @param  string $value   Setting value to compare.
 * @return bool
 */
function crossarena_is_setting( $control, $setting, $value ) {

	if ( $value == $control->manager->get_setting( $setting )->value() ) {
		return true;
	}

	return false;
}

/**
 * Return true if value of passed setting is not equal with passed value.
 *
 * @param  object $control Parent control.
 * @param  string $setting Setting name to check.
 * @param  string $value   Setting value to compare.
 * @return bool
 */
function crossarena_is_not_setting( $control, $setting, $value ) {

	if ( $value !== $control->manager->get_setting( $setting )->value() ) {
		return true;
	}

	return false;
}

/**
 * Return true if logo in header has image type. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function crossarena_is_header_logo_image( $control ) {
	return crossarena_is_setting( $control, 'header_logo_type', 'image' );
}

/**
 * Return true if logo in header has text type. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function crossarena_is_header_logo_text( $control ) {
	return crossarena_is_setting( $control, 'header_logo_type', 'text' );
}

/**
 * Return blog-featured-image true if blog layout type is default. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function crossarena_is_blog_featured_image( $control ) {
	return crossarena_is_setting( $control, 'blog_layout_type', 'default' );
}

/**
 * Return true if sticky label type set to text or text with icon.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function crossarena_is_sticky_text( $control ) {
	return crossarena_is_not_setting( $control, 'blog_sticky_type', 'icon' );
}

/**
 * Return true if sticky label type set to icon or text with icon.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function crossarena_is_sticky_icon( $control ) {
	return crossarena_is_not_setting( $control, 'blog_sticky_type', 'label' );
}

/**
 * Return true if More button (in the main menu) has image type. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function crossarena_is_more_button_type_image( $control ) {

	if ( ( $control->manager->get_setting( 'more_button_type' )->value() == 'image' ) ) {
		return true;
	}

	return false;
}

/**
 * Return true if More button (in the main menu) has text type. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function crossarena_is_more_button_type_text( $control ) {

	if ( ( $control->manager->get_setting( 'more_button_type' )->value() == 'text' ) ) {
		return true;
	}

	return false;
}

/**
 * Return true if More button (in the main menu) has icon type. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function crossarena_is_more_button_type_icon( $control ) {

	if ( ( $control->manager->get_setting( 'more_button_type' )->value() == 'icon' ) ) {
		return true;
	}

	return false;
}

/**
 * Return true if option Show header call to action button is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function crossarena_is_header_btn_visible( $control ) {
	return crossarena_is_setting( $control, 'header_btn_visibility', true );
}

/**
 * Return true if option Show Header Contact Block is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function crossarena_is_header_contact_block_visible( $control ) {
	return crossarena_is_setting( $control, 'header_contact_block_visibility', true );
}

/**
 * Return true if option Show Footer Contact Block is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function crossarena_is_footer_contact_block_visible( $control ) {
	return crossarena_is_setting( $control, 'footer_contact_block_visibility', true );
}

/**
 * Return true if option Show Related Posts Block is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function crossarena_is_related_posts_visible( $control ) {
	return crossarena_is_setting( $control, 'related_posts_visible', true );
}

/**
 * Return true if option Enable Top Panel is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function crossarena_is_top_panel_enable( $control ) {
	return crossarena_is_setting( $control, 'top_panel_visibility', true );
}

/**
 * Return true if option Show Footer Logo is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function crossarena_is_footer_logo_visible( $control ) {
	return crossarena_is_setting( $control, 'footer_logo_visibility', true );
}

/**
 * Return true if option Show Footer Widgets Area is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function crossarena_is_footer_area_visible( $control ) {
	return crossarena_is_setting( $control, 'footer_widget_area_visibility', true );
}

/**
 * Get default header layouts.
 *
 * @since  1.0.0
 * @return array
 */
function crossarena_get_header_layout_options() {
	return apply_filters( 'crossarena_header_layout_options', array(
		'default' => esc_html__( 'Style 1', 'crossarena' ),
		'style-2' => esc_html__( 'Style 2', 'crossarena' ),
		'style-3' => esc_html__( 'Style 3', 'crossarena' )
	) );
}

/**
 * Get default footer layouts.
 *
 * @since  1.0.0
 * @return array
 */
function crossarena_get_footer_layout_options() {
	return apply_filters( 'crossarena_footer_layout_options', array(
		'default' => esc_html__( 'Style 1', 'crossarena' ),
		'style-2' => esc_html__( 'Style 2', 'crossarena' )
	) );
}

/**
 * Get default header layouts options for Post Meta boxes
 *
 * @return array
 */
function crossarena_get_header_layout_pm_options() {
	$inherit_option = array(
		'inherit' => esc_html__( 'Inherit', 'crossarena' ),
	);

	$options = crossarena_get_header_layout_options();

	return array_merge( $inherit_option, $options );
}

/**
 * Get default footer layouts options for Post Meta boxes
 *
 * @return array
 */
function crossarena_get_footer_layout_pm_options() {
	$inherit_option = array(
		'inherit' => esc_html__( 'Inherit', 'crossarena' ),
	);

	$options = crossarena_get_footer_layout_options();

	return array_merge( $inherit_option, $options );
}

// Move native `site_icon` control (based on WordPress core) in custom section.
add_action( 'customize_register', 'crossarena_customizer_change_core_controls', 20 );
/**
 * Move native `site_icon` control (based on WordPress core) into custom section.
 *
 * @since 1.0.0
 * @param  object $wp_customize Object wp_customize.
 * @return void
 */
function crossarena_customizer_change_core_controls( $wp_customize ) {
	$wp_customize->get_control( 'site_icon' )->section         = 'crossarena_logo_favicon';
	$wp_customize->get_control( 'background_color' )->label    = esc_html__( 'Body Background Color', 'crossarena' );

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}

// Typography utility function
/**
 * Get font styles
 *
 * @since 1.0.0
 * @return array
 */
function crossarena_get_font_styles() {
	return apply_filters( 'crossarena_get_font_styles', array(
		'normal'  => esc_html__( 'Normal', 'crossarena' ),
		'italic'  => esc_html__( 'Italic', 'crossarena' ),
		'oblique' => esc_html__( 'Oblique', 'crossarena' ),
		'inherit' => esc_html__( 'Inherit', 'crossarena' ),
	) );
}

/**
 * Get character sets
 *
 * @since 1.0.0
 * @return array
 */
function crossarena_get_character_sets() {
	return apply_filters( 'crossarena_get_character_sets', array(
		'latin'        => esc_html__( 'Latin', 'crossarena' ),
		'greek'        => esc_html__( 'Greek', 'crossarena' ),
		'greek-ext'    => esc_html__( 'Greek Extended', 'crossarena' ),
		'vietnamese'   => esc_html__( 'Vietnamese', 'crossarena' ),
		'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'crossarena' ),
		'latin-ext'    => esc_html__( 'Latin Extended', 'crossarena' ),
		'cyrillic'     => esc_html__( 'Cyrillic', 'crossarena' ),
	) );
}

/**
 * Get text aligns
 *
 * @since 1.0.0
 * @return array
 */
function crossarena_get_text_aligns() {
	return apply_filters( 'crossarena_get_text_aligns', array(
		'inherit' => esc_html__( 'Inherit', 'crossarena' ),
		'center'  => esc_html__( 'Center', 'crossarena' ),
		'justify' => esc_html__( 'Justify', 'crossarena' ),
		'left'    => esc_html__( 'Left', 'crossarena' ),
		'right'   => esc_html__( 'Right', 'crossarena' ),
	) );
}

/**
 * Get font weights
 *
 * @since 1.0.0
 * @return array
 */
function crossarena_get_font_weight() {
	return apply_filters( 'crossarena_get_font_weight', array(
		'100' => '100',
		'200' => '200',
		'300' => '300',
		'400' => '400',
		'500' => '500',
		'600' => '600',
		'700' => '700',
		'800' => '800',
		'900' => '900',
	) );
}

/**
 * Return array of arguments for dynamic CSS module
 *
 * @return array
 */
function crossarena_get_dynamic_css_options() {
	return apply_filters( 'crossarena_get_dynamic_css_options', array(
		'prefix'        => 'crossarena',
		'type'          => 'theme_mod',
		'parent_handle' => 'crossarena-theme-style',
		'single'        => true,
		'css_files'     => array(
			get_parent_theme_file_path( 'assets/css/dynamic.css' ),

			get_parent_theme_file_path( 'assets/css/dynamic/site/elements.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/site/header.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/site/forms.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/site/menus.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/site/post.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/site/navigation.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/site/footer.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/site/misc.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/site/buttons.css' ),

			get_parent_theme_file_path( 'assets/css/dynamic/widgets/widget-default.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/widgets/taxonomy-tiles.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/widgets/image-grid.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/widgets/carousel.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/widgets/custom-posts.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/widgets/playlist-slider.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/widgets/featured-posts-block.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/widgets/news-smart-box.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/widgets/contact-information.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/widgets/subscribe.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/widgets/about.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/plugins/booked.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/plugins/cherry-team-members.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/plugins/cherry-services-list.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/plugins/cherry-testimonials.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/plugins/polylang.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/plugins/tm-photo-gallery.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/plugins/cherry-popups.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/plugins/cherry-project.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/elementor/default-elements.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/elementor/jet-elements.css' ),
			get_parent_theme_file_path( 'assets/css/dynamic/elementor/jet-menu.css' ),
		),
		'options' => array(
			'header_logo_font_style',
			'header_logo_font_weight',
			'header_logo_font_size',
			'header_logo_font_family',

			'body_font_style',
			'body_font_weight',
			'body_font_size',
			'body_line_height',
			'body_font_family',
			'body_letter_spacing',
			'body_text_align',

			'h1_font_style',
			'h1_font_weight',
			'h1_font_size',
			'h1_line_height',
			'h1_font_family',
			'h1_letter_spacing',
			'h1_text_align',

			'h2_font_style',
			'h2_font_weight',
			'h2_font_size',
			'h2_line_height',
			'h2_font_family',
			'h2_letter_spacing',
			'h2_text_align',

			'h3_font_style',
			'h3_font_weight',
			'h3_font_size',
			'h3_line_height',
			'h3_font_family',
			'h3_letter_spacing',
			'h3_text_align',

			'h4_font_style',
			'h4_font_weight',
			'h4_font_size',
			'h4_line_height',
			'h4_font_family',
			'h4_letter_spacing',
			'h4_text_align',

			'h5_font_style',
			'h5_font_weight',
			'h5_font_size',
			'h5_line_height',
			'h5_font_family',
			'h5_letter_spacing',
			'h5_text_align',

			'h6_font_style',
			'h6_font_weight',
			'h6_font_size',
			'h6_line_height',
			'h6_font_family',
			'h6_letter_spacing',
			'h6_text_align',

			'breadcrumbs_font_style',
			'breadcrumbs_font_weight',
			'breadcrumbs_font_size',
			'breadcrumbs_line_height',
			'breadcrumbs_font_family',
			'breadcrumbs_letter_spacing',
			'breadcrumbs_text_align',

			'regular_accent_color_1',
			'regular_accent_color_2',
			'regular_accent_color_3',
			'regular_text_color',
			'regular_link_color',
			'regular_link_hover_color',
			'regular_h1_color',
			'regular_h2_color',
			'regular_h3_color',
			'regular_h4_color',
			'regular_h5_color',
			'regular_h6_color',

			'invert_accent_color_1',
			'invert_accent_color_2',
			'invert_accent_color_3',
			'invert_text_color',
			'invert_link_color',
			'invert_link_hover_color',
			'invert_h1_color',
			'invert_h2_color',
			'invert_h3_color',
			'invert_h4_color',
			'invert_h5_color',
			'invert_h6_color',

			'header_bg_color',
			'header_bg_image',
			'header_bg_repeat',
			'header_bg_position_x',
			'header_bg_attachment',

			'top_panel_bg',
			'page_preloader_bg',

			'container_width',

			'footer_widgets_bg',
			'footer_bg',

			'onsale_badge_bg',
			'featured_badge_bg',
			'new_badge_bg',
		),
	) );
}

/**
 * Return array of arguments for Google Font loader module.
 *
 * @since  1.0.0
 * @return array
 */
function crossarena_get_fonts_options() {
	return apply_filters( 'crossarena_get_fonts_options', array(
		'prefix'  => 'crossarena',
		'type'    => 'theme_mod',
		'single'  => true,
		'options' => array(
			'body' => array(
				'family'  => 'body_font_family',
				'style'   => 'body_font_style',
				'weight'  => 'body_font_weight',
				'charset' => 'body_character_set',
			),
			'h1' => array(
				'family'  => 'h1_font_family',
				'style'   => 'h1_font_style',
				'weight'  => 'h1_font_weight',
				'charset' => 'h1_character_set',
			),
			'h2' => array(
				'family'  => 'h2_font_family',
				'style'   => 'h2_font_style',
				'weight'  => 'h2_font_weight',
				'charset' => 'h2_character_set',
			),
			'h3' => array(
				'family'  => 'h3_font_family',
				'style'   => 'h3_font_style',
				'weight'  => 'h3_font_weight',
				'charset' => 'h3_character_set',
			),
			'h4' => array(
				'family'  => 'h4_font_family',
				'style'   => 'h4_font_style',
				'weight'  => 'h4_font_weight',
				'charset' => 'h4_character_set',
			),
			'h5' => array(
				'family'  => 'h5_font_family',
				'style'   => 'h5_font_style',
				'weight'  => 'h5_font_weight',
				'charset' => 'h5_character_set',
			),
			'h6' => array(
				'family'  => 'h6_font_family',
				'style'   => 'h6_font_style',
				'weight'  => 'h6_font_weight',
				'charset' => 'h6_character_set',
			),
			'header_logo' => array(
				'family'  => 'header_logo_font_family',
				'style'   => 'header_logo_font_style',
				'weight'  => 'header_logo_font_weight',
				'charset' => 'header_logo_character_set',
			),
			'breadcrumbs' => array(
				'family'  => 'breadcrumbs_font_family',
				'style'   => 'breadcrumbs_font_style',
				'weight'  => 'breadcrumbs_font_weight',
				'charset' => 'breadcrumbs_character_set',
			),
		),
	) );
}

/**
 * Get default footer copyright.
 *
 * @since  1.0.0
 * @return string
 */
function crossarena_get_default_footer_copyright() {
	return esc_html__( '&copy; %%year%% Crossarena Inc and Web Templates Ltd. All rights reserved.', 'crossarena' );
}

/**
 * Get default contact information.
 *
 * @since  1.0.0
 * @return string
 */
function crossarena_get_default_contact_information( $value ) {
	$contact_information = array(
		'location' => esc_html__( '4578 Marmora Road', 'crossarena' ),
		'time' => esc_html__( 'Mon - Fri: 9:00AM - 5:00PM &nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Sat - Sun: Closed', 'crossarena' ),
		'mail'  => sprintf( '<a href="mailto:%1$s">%1$s</a>', esc_html__( 'info@crossarena.com', 'crossarena' ) ),
		'phone'  => sprintf( '<a href="tel:%1$s">%1$s</a>', esc_html__( '+91 123 456 7890', 'crossarena' ) ),
	);

	return $contact_information[ $value ];
}

/**
 * Get default top panel text
 *
 * @since  1.0.0
 * @return string
 */
function crossarena_get_default_top_panel_text() {
	return sprintf( '%1$s <a href="tel:%2$s"><b>%2$s</b></a>', esc_html__( 'For emergency cases:', 'crossarena' ), esc_html__( '8001234567', 'crossarena' ) );
}

/**
 * Get FontAwesome icons set
 *
 * @return array
 */
function crossarena_get_icons_set() {

	static $font_icons;

	if ( ! $font_icons ) {

		ob_start();

		include get_parent_theme_file_path( 'assets/js/icons.json' );
		$json = ob_get_clean();

		$font_icons = array();
		$icons      = json_decode( $json, true );

		foreach ( $icons['icons'] as $icon ) {
			$font_icons[] = $icon['id'];
		}
	}

	return $font_icons;
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function crossarena_customize_preview_js() {
	wp_enqueue_script( 'crossarena-customize-preview', CROSSARENA_THEME_JS . '/customize-preview.js', array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'crossarena_customize_preview_js' );

/**
 * Return true if option Show Page Preloader is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function crossarena_is_page_preloader_enable( $control ) {
	return crossarena_is_setting( $control, 'page_preloader', true );
}
