<?php
/**
 * Menus configuration.
 *
 * @package Crossarena
 */

add_action( 'after_setup_theme', 'crossarena_register_menus', 5 );
/**
 * Register menus.
 */
function crossarena_register_menus() {

	register_nav_menus( array(
		'top'          => esc_html__( 'Top', 'crossarena' ),
		'main'         => esc_html__( 'Main', 'crossarena' ),
		'main_landing' => esc_html__( 'Landing Main', 'crossarena' ),
		'footer'       => esc_html__( 'Footer', 'crossarena' ),
		'social'       => esc_html__( 'Social', 'crossarena' ),
	) );
}
