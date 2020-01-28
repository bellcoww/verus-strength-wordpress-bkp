<?php
/**
 * Template part for single post navigation.
 *
 * @package Crossarena
 */

if ( ! get_theme_mod( 'single_post_navigation', crossarena_theme()->customizer->get_default( 'single_post_navigation' ) ) ) {
	return;
}

the_post_navigation();
