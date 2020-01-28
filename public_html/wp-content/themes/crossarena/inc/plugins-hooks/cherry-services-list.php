<?php
/**
 * Cherry-services-list hooks.
 *
 * @package Crossarena
 */

// Customization cherry-services-list plugin.
add_filter( 'cherry_services_listing_templates_list', 'crossarena_cherry_services_listing_templates' );

// Cherry services data callbacks hooks.
add_filter( 'cherry_services_data_callbacks', 'crossarena_cherry_services_data_callbacks' );

/**
 * Dequeue cherry-services grid style.
 *
 * @param array $styles Cherry services list styles.
 *
 * @return array
 */
function crossarena_cherry_services_listing_templates (  $tmpl_list ) {
	$tmpl_list['boxed'] = 'boxed.tmpl';
	$tmpl_list['boxed-2'] = 'boxed-2.tmpl';

	return $tmpl_list;
}

/**
 * Cherry services list meta testi args.
 *
 * @param array $args.
 *
 * @return array
 */
function crossarena_cherry_services_list_meta_testi_args ( $args ) {
	$args = '';

	return $args;
}

/**
 * Add new macros %%POST-URL%% to cherry services.
 */
function crossarena_cherry_services_data_callbacks( $data ) {
	$data['post-url'] = 'crossarena_get_service_url';

	return $data;
}

/**
 * Callback function to macros %%POST-URL%%.
 */
function crossarena_get_service_url ( ) {
	global $post;
	$post_url = get_permalink();

	return esc_url( $post_url );
}
