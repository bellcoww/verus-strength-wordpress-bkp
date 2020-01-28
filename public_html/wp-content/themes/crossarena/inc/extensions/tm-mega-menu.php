<?php
/**
 * Extends basic functionality for better TM Mega Menu compatibility
 *
 * @package Crossarena
 */

/**
 * Check if Mega Menu plugin is activated.
 *
 * @return bool
 */
function crossarena_is_mega_menu_active() {
	return class_exists( 'tm_mega_menu' );
}

add_filter( 'crossarena_theme_script_variables', 'crossarena_pass_mega_menu_vars' );

/**
 * Pass Mega Menu variables.
 *
 * @param  array  $vars Variables array.
 * @return array
 */
function crossarena_pass_mega_menu_vars( $vars = array() ) {

	if ( ! crossarena_is_mega_menu_active() ) {
		return $vars;
	}

	$vars['megaMenu'] = array(
		'isActive' => true,
		'location' => get_option( 'tm-mega-menu-location' ),
	);

	return $vars;
}
