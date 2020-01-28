<?php
/**
 * Default manifest file
 *
 * @var array
 */
$settings = array(
	'xml' => false,
	'advanced_import' => array(
		'default' => array(
			'label'    => esc_html__( 'Crossarena', 'crossarena' ),
			'full'     => get_template_directory() . '/assets/demo-content/default-full.xml',
			'lite'     => false,
			'thumb'    => get_template_directory_uri() . '/assets/demo-content/default-thumb.png',
			'demo_url' => 'https://ld-wp.template-help.com/rockthemes/18751/',
		),
	),
	'import' => array(
		'chunk_size' => 3,
	),
	'export' => array(
		'options' => array(
			'cherry_projects_options',
			'cherry_projects_options_default',
			'cherry-team',
			'cherry-team_default',
			'cherry-services',
			'cherry-services_default',
			'cherry-search',
			'cherry-search-default',
			'elementor_cpt_support',
			'elementor_disable_color_schemes',
			'elementor_disable_typography_schemes',
			'elementor_container_width',
			'elementor_css_print_method',
			'elementor_global_image_lightbox',
			'site_icon',
			'wsl_settings_social_icon_set',
			'toastie_smsb_li',
			'toastie_smsb_gp',
			'toastie_smsb_fb',
			'toastie_smsb_tw',
			'toastie_smsb_custom_fb',
			'toastie_smsb_custom_tw',
			'toastie_smsb_custom_gp',
			'toastie_smsb_custom_li',
			'toastie_smsb_format',
			'toastie_smsb_tu',
			'toastie_smsb_pi',
			'toastie_smsb_st',
			'toastie_smsb_vk',
			'toastie_smsb_em',
			'toastie_smsb_title',
			'toastie_smsb_email',
			'toastie_smsb_opengraph',
			'toastie_smsb_custom_pi',
			'toastie_smsb_custom_tu',
			'toastie_smsb_custom_st',
			'toastie_smsb_custom_vk',
			'toastie_smsb_custom_em',
			'jet-elements-settings',
			'jet_menu_options',
		),
		'tables' => array(
			'nextend2_image_storage',
			'nextend2_section_storage',
		),
	),
);
