<?php
/**
 * Template part for posts pagination.
 *
 * @package Crossarena
 */

the_posts_pagination( apply_filters( 'crossarena_content_posts_pagination',
	array(
		'prev_text' => '',
		'next_text' => '',
	)
) );
