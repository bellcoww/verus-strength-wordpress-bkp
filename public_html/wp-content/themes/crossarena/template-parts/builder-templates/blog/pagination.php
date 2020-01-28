<?php
/**
 * Template part for displaying posts pagination.
 *
 * @package Crossarena
 */

the_posts_pagination( array(
		'prev_text' => esc_html__( 'Next', 'crossarena' ),
		'next_text' => esc_html__( 'Previous', 'crossarena' ),
	)
);
