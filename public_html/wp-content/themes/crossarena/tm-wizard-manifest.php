<?php
/**
 * Plugins configuration example.
 *
 * @var array
 */
$plugins = array(
	'elementor' => array(
		'name'   => esc_html__( 'Elementor', 'crossarena' ),
		'access' => 'base',
	),
	'jet-elements' => array(
		'name'   => esc_html__( 'Jet Elements', 'crossarena' ),
		'source' => 'local',
		'path'   => CROSSARENA_THEME_DIR . '/assets/includes/plugins/jet-elements.zip',
		'access' => 'base',
	),
	'jet-menu' => array(
		'name'   => esc_html__( 'Jet Menu', 'crossarena' ),
		'source' => 'local',
		'path'   => CROSSARENA_THEME_DIR . '/assets/includes/plugins/jet-menu.zip',
		'access' => 'base',
	),
	'jet-tricks' => array(
		'name'   => esc_html__( 'Jet Tricks', 'crossarena' ),
		'source' => 'local',
		'path'   => CROSSARENA_THEME_DIR . '/assets/includes/plugins/jet-tricks.zip',
		'access' => 'base',
	),
	'wordpress-social-login' => array(
		'name'   => esc_html__( 'WordPress Social Login', 'crossarena' ),
		'access' => 'skins',
	),
	'cherry-team-members' =>array(
		'name'   => esc_html__( 'Cherry Team Members', 'crossarena' ),
		'access' => 'skins',
	),
	'cherry-services-list' => array(
		'name'   => esc_html__( 'Cherry Services List', 'crossarena' ),
		'access' => 'skins',
	),
	'cherry-testi' => array(
		'name'   => esc_html__( 'Cherry Testimonials', 'crossarena' ),
		'access' => 'skins',
	),
	'cherry-sidebars' => array(
		'name'   => esc_html__( 'Cherry Sidebars', 'crossarena' ),
		'access' => 'skins',
	),
	'cherry-popups' => array(
		'name'   => esc_html__( 'Cherry Popups', 'crossarena' ),
		'access' => 'skins',
	),
	'cherry-search' => array(
		'name'   => esc_html__( 'Cherry Search', 'crossarena' ),
		'access' => 'skins',
	),
	'cherry-projects' => array(
		'name'   => esc_html__( 'Cherry Projects', 'crossarena' ),
		'access' => 'skins',
	),
	'contact-form-7' => array(
		'name'   => esc_html__( 'Contact Form 7', 'crossarena' ),
		'access' => 'skins',
	),
	'booked' => array(
		'name'   => esc_html__( 'Book an Appointment', 'crossarena' ),
		'source' => 'local',
		'path'   => CROSSARENA_THEME_DIR . '/assets/includes/plugins/booked.zip',
		'access' => 'skins',
	),
	'tm-photo-gallery' => array(
		'name'   => esc_html__( 'TM Photo Gallery', 'crossarena' ),
		'access' => 'skins',
	),
	'jet-data-importer' => array(
		'name'   => esc_html__( 'Jet  Data Importer', 'crossarena' ),
		'source' => 'remote', // 'local', 'remote', 'wordpress' (default).
		'path'   => 'https://github.com/ZemezLab/jet-data-importer/archive/master.zip',
		'access' => 'base',
	),
);

/**
 * Skins configuration example
 *
 * @var array
 */
$skins = array(
	'base' => array(
		'elementor',
		'jet-elements',
		'jet-menu',
		'jet-tricks',
		'jet-data-importer',
	),
	'advanced' => array(
		'default' => array(
			'full'  => array(
				'cherry-projects',
				'cherry-search',
				'cherry-team-members',
				'cherry-services-list',
				'cherry-testi',
				'cherry-sidebars',
				'cherry-popups',
				'wordpress-social-login',
				'contact-form-7',
				'booked',
				'tm-photo-gallery',
			),
			'lite'  => false,
			'demo'  => 'http://ld-wp.template-help.com/wordpress_crossarena/crossarena/',
			'thumb' => get_template_directory_uri() . '/assets/demo-content/default-thumb.png',
			'name'  => esc_html__( 'Crossarena', 'crossarena' ),
		),
	),
);

$texts = array(
	'theme-name' => 'Crossarena'
);

