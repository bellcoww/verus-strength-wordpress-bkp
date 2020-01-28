<?php
/**
 * Thumbnails configuration.
 *
 * @package Crossarena
 */

add_action( 'after_setup_theme', 'crossarena_register_image_sizes', 5 );
/**
 * Register image sizes.
 */
function crossarena_register_image_sizes() {
	set_post_thumbnail_size( 418, 315, true );

	// Registers a new image sizes.
	add_image_size( 'crossarena-thumb-s', 150, 150, true );
	add_image_size( 'crossarena-slider-thumb', 158, 88, true );
	add_image_size( 'crossarena-thumb-sm', 270, 270, true );
	add_image_size( 'crossarena-thumb-m', 400, 400, true );
	add_image_size( 'crossarena-thumb-masonry', 418, 9999 );
	add_image_size( 'crossarena-thumb-l', 770, 460, true );
	add_image_size( 'crossarena-thumb-team', 190, 203, true );
	add_image_size( 'crossarena-thumb-l-2', 770, 278, true );
	add_image_size( 'crossarena-thumb-xl', 1920, 1080, true );
	add_image_size( 'crossarena-author-avatar', 512, 512, true );

	add_image_size( 'crossarena-thumb-1355-1020', 1200, 900, true );
	add_image_size( 'crossarena-thumb-370-260', 370, 260, true );
}
