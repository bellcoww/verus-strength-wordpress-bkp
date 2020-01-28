<?php
/**
 * Skins configuration.
 *
 * @package Crossarena
 */

function crossarena_skins_import_config() {
	return apply_filters( 'crossarena_skins_import_config', array(
		'default' => array(
			'label'    => esc_html__( 'Handyman', 'crossarena' ),
			'full'     => get_template_directory() . '/assets/demo-content/default/default.xml',
			'lite'     => false,
			'thumb'    => get_template_directory_uri() . '/assets/demo-content/default/default-thumb.png',
			'demo_url' => 'https://ld-wp.template-help.com/wordpress_62555/handyman',
		),
		'bekids' => array(
			'label'    => esc_html__( 'BeKIDS', 'crossarena' ),
			'full'     => get_template_directory() . '/assets/demo-content/crossarena_ped/crossarena_ped.xml',
			'lite'     => false,
			'thumb'    => get_template_directory_uri() . '/assets/demo-content/crossarena_ped/crossarena_ped.jpg',
			'demo_url' => 'https://ld-wp.template-help.com/wordpress_62555/crossarena_ped/',
		),
		'becosmetic' => array(
			'label'    => esc_html__( 'BeCosmetic', 'crossarena' ),
			'full'     => get_template_directory() . '/assets/demo-content/becosmetic/becosmetic.xml',
			'lite'     => false,
			'thumb'    => get_template_directory_uri() . '/assets/demo-content/becosmetic/becosmetic.jpg',
			'demo_url' => 'https://ld-wp.template-help.com/wordpress_62555/becosmetic/',
		)
	) );
}
