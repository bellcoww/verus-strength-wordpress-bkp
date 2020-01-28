<?php
/**
 * Cherry team members hooks.
 *
 * @package Crossarena
 */

// Add excerpt meta box to cherry-team
add_filter( 'cherry_team_post_type_args', 'crossarena_cherry_team_post_type_args' );
// Add team members meta email
add_filter( 'cherry_team_members_meta_args', 'crossarena_cherry_team_members_meta_args' );
add_filter( 'cherry_team_data_callbacks', 'crossarena_cherry_team_data_callbacks' );
// Add new team template
add_filter( 'cherry_team_templates_list', 'crossarena_cherry_team_templates_list' );

/**
 * Add excerpt meta box to cherry-team.
 *
 * @param array $args supports.
 *
 * @return array
 */
function crossarena_cherry_team_post_type_args( $args ) {
 array_push( $args['supports'], 'excerpt' );

 return $args;
}

/**
 * Add team members meta email
 *
 * @param array $args supports.
 *
 * @return array
 */
function crossarena_cherry_team_members_meta_args( $args ) {
	$args['fields'] = array(
		'cherry-team-email' => array(
			'type'        => 'text',
			'placeholder' => esc_html__( 'Email', 'crossarena' ),
			'label'       => esc_html__( 'Email', 'crossarena' ),
		)
	) + $args['fields'];

	return $args;
}

function crossarena_cherry_team_data_callbacks( $atts ) {

	$atts['email'] = 'crossarena_cherry_team_get_email';

	return $atts;
}

function crossarena_cherry_team_get_email() {
	$post_id = get_the_id();
	$email_data = get_post_meta( $post_id, 'cherry-team-email', true );
	$email = '<div class="team-macros"><a href="mailto:' . $email_data . '"class="team-meta_item email">' . $email_data . '</a></div>';

	return $email;
}


function crossarena_cherry_team_templates_list( $tmpl_list ) {
	$tmpl_list['list'] = 'list.tmpl';

	return $tmpl_list;
}