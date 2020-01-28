<?php
/**
 * Template part for displaying post meta in Blog module
 *
 * @package Crossarena
 */
if ( ! $module->is_meta_visible() ) {
	return;
}
?>
<div class="tm_pb_post_meta entry-meta"><?php

	if ( 'on' === $module->_var( 'show_date' ) ) {
		echo tm_get_safe_localization(
			sprintf(
				esc_html__( '%s', 'crossarena' ),
				'<span class="published">' . esc_html( get_the_date( $module->_var( 'meta_date' ) ) ) . '</span>'
			)
		);
	}

	if ( 'on' === $module->_var( 'show_author' ) ) {
		echo tm_get_safe_localization(
			sprintf(
				'<span class="author vcard posted-by">%s' . tm_pb_get_the_author_posts_link() . '</span>',
				esc_html__( 'by ', 'crossarena' )
			)
		);
	}

	if ( 'on' === $module->_var( 'show_comments' ) ) {
		?><span class="comments"><?php
		printf(
			esc_html(
				_nx( '1', '%s', get_comments_number(), 'number of comments', 'crossarena' )
			),
			number_format_i18n( get_comments_number() )
		);
		?></span><?php
	}

?></div>
