<?php
/**
 * Elementor hooks.
 *
 * @package Crossarena
 */

// Change elementor widget args.
add_filter( 'elementor/widgets/wordpress/widget_args', 'crossarena_elementor_widget_args' );

function crossarena_elementor_widget_args( $args ) {
	$args['before_title'] = '<h3>';
	$args['after_title'] = '</h3>';

	return $args;
}