<?php
/**
 * Cherry-projects hooks.
 *
 * @package Crossarena
 */

// Customization cherry-project plugin.
add_filter( 'cherry-projects-featured-image-settings' , 'crossarena_modify_cherry_projects_featured_image_settings' );
add_filter( 'cherry-projects-title-settings', 'crossarena_cherry_projects_title_settings' );
add_filter( 'cherry-projects-content-settings', 'crossarena_cherry_projects_content_settings' );
add_filter( 'cherry_projects_show_all_text', 'crossarena_projects_show_all_text' );
add_filter( 'cherry-projects-prev-button-text', 'crossarena_cherry_projects_prev_button_text' );
add_filter( 'cherry-projects-next-button-text', 'crossarena_cherry_projects_next_button_text' );
add_filter( 'cherry_projects_cascading_list_map', 'crossarena_cherry_projects_cascading_list_map' );
add_filter( 'cherry_projects_cascading_list_map_device', 'crossarena_cherry_projects_cascading_list_map_device' );
add_filter( 'cherry-projects-button-settings', 'crossarena_cherry_projects_button_settings' );
add_action( 'cherry_projects_after_main_content', 'crossarena_add_single_project_navigation' );

/**
 * Modify featured image settings.
 *
 * @param array $settings Default settings.
 *
 * @return array
 */
function crossarena_modify_cherry_projects_featured_image_settings( $settings = array() ) {

	if ( is_single() && 'single-post-sizes' === $settings['size'] ) {

		$sidebar_position = get_theme_mod( 'sidebar_position', crossarena_theme()->customizer->get_default( 'sidebar_position' ) );
		$settings['size'] = ( 'fullwidth' !== $sidebar_position ) ? 'crossarena-thumb-l' : 'crossarena-thumb-xl';

	}

	return $settings;
}

/**
 * Customization title settings to cherry-project.
 *
 * @param array $settings Title settings.
 *
 * @return array
 */
function crossarena_cherry_projects_title_settings( $settings = array() ) {

	$title_html = ( is_single() ) ? '<h2 %1$s>%4$s</h2>' : '<h4 %1$s><a href="%2$s" %3$s rel="bookmark">%4$s</a></h4>';

	$settings['html']  = $title_html;
	$settings['class'] = 'project-entry-title';

	if ( is_single() ) {
		$settings['length'] = - 1;
	}

	return $settings;
}

/**
 * Customization content settings to cherry-project.
 *
 * @param array $settings Content settings.
 *
 * @return array
 */
function crossarena_cherry_projects_content_settings( $settings = array() ) {

	$settings['class'] = 'project-entry-content';

	return $settings;
}

/**
 * Customization show all text to cherry-project.
 *
 * @return string
 */
function crossarena_projects_show_all_text( $show_all_text ) {
	return esc_html__( 'All', 'crossarena' );
}

/**
 * Customization cherry-projects prev button text.
 *
 * @return string
 */
function crossarena_cherry_projects_prev_button_text( $prev_text ) {
	return '<i class="fa fa-chevron-left"></i>';
}

/**
 * Customization cherry-projects next button text.
 *
 * @return string
 */
function crossarena_cherry_projects_next_button_text( $next_text ) {
	return '<i class="fa fa-chevron-right"></i>';
}

/**
 * Customization cherry-projects cascading list map.
 *
 * @param array $cascading_list_map Default cascading list map.
 *
 * @return array
 */
function crossarena_cherry_projects_cascading_list_map( $cascading_list_map = array() ) {
	return array( 2, 2, 3, 3, 3, 4, 4, 4, 4 );
}

/**
 * Customization cherry-projects cascading device list map.
 *
 * @param array $device_map Default device list map.
 *
 * @return array
 */
function crossarena_cherry_projects_cascading_list_map_device( $device_map = array() ) {

	$device_map['laptop']       = array( 2, 2, 3, 3, 3, 4, 4, 4, 4 );
	$device_map['album_tablet'] = array( 2, 2, 3, 3, 3 );

	return $device_map;
}

/**
 * Customization button settings to cherry-project.
 *
 * @param array $settings Button settings.
 *
 * @return array
 */
function crossarena_cherry_projects_button_settings( $settings = array() ) {

	$settings['class'] = 'project-more-button btn-link';
	$settings['icon']  = '<i class="fa fa-chevron-right"></i>';

	return $settings;
}

/**
 * Add single project navigation.
 */
function crossarena_add_single_project_navigation() {

	if ( is_singular( 'projects' ) ) {
		get_template_part( 'template-parts/content', 'post-navigation' );
	}

}
