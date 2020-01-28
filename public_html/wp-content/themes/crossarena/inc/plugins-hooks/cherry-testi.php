<?php
/**
 * Cherry-testi hooks.
 *
 * @package Crossarena
 */

// Customization cherry-testimonials pagination args.
add_filter( 'tm_testimonials_pagination_args', 'crossarena_tm_testimonials_pagination_args', 10, 2 );

// Add template to tm-testimonials templates list.
add_filter( 'tm_testimonials_templates_list', 'crossarena_tm_testimonials_templates_list' );


/**
 * Customization cherry-testimonials pagination args.
 *
 * @return array
 */
function crossarena_tm_testimonials_pagination_args( $pagination_args, $args ) {

	$pagination_args = array(
		'prev_text' => esc_html__( 'Previous', 'crossarena' ),
		'next_text' => esc_html__( 'Next', 'crossarena' ),
	);

	return $pagination_args;
}

/**
 * Add template to tm-testimonials templates list.
 *
 * @param array $tmpl_list Templates list.
 *
 * @return array
 */
function crossarena_tm_testimonials_templates_list( $tmpl_list ) {
	$tmpl_list['default-center.tmpl'] = 'default-center.tmpl';

	return $tmpl_list;
}
