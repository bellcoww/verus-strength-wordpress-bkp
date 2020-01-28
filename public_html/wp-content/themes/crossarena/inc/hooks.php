<?php
/**
 * Theme hooks.
 *
 * @package Crossarena
 */

// Menu description.
add_filter( 'walker_nav_menu_start_el', 'crossarena_nav_menu_description', 10, 4 );

// Sidebars classes.
add_filter( 'crossarena_widget_area_classes', 'crossarena_set_sidebar_classes', 10, 2 );

// Set footer columns.
add_filter( 'dynamic_sidebar_params', 'crossarena_get_footer_widget_layout' );

// Adapt default image post format classes to current theme.
add_filter( 'cherry_post_formats_image_css_model', 'crossarena_add_image_format_classes', 10, 2 );

// Enqueue misc js script.
add_filter( 'crossarena_theme_script_depends', 'crossarena_enqueue_misc' );

// Add to toTop and stickUp properties if required.
add_filter( 'crossarena_theme_script_variables', 'crossarena_js_vars' );

// Add has/no thumbnail classes for posts.
add_filter( 'post_class', 'crossarena_post_thumb_classes' );

// Modify a comment form.
add_filter( 'comment_form_defaults', 'crossarena_modify_comment_form' );

// Additional body classes.
add_filter( 'body_class', 'crossarena_extra_body_classes' );

// Adds the meta viewport to the header.
add_action( 'wp_head', 'crossarena_meta_viewport', 0 );

// Customization for `Tag Cloud` widget.
add_filter( 'widget_tag_cloud_args', 'crossarena_customize_tag_cloud' );

// Changed excerpt more string.
add_filter( 'excerpt_more', 'crossarena_excerpt_more' );

// Creating wrappers for audio shortcode.
add_filter( 'wp_audio_shortcode', 'crossarena_audio_shortcode', 10, 5 );

// Change text for buddypress activity read more
add_filter( 'bp_activity_excerpt_append_text', 'crossarena_bp_activity_read_more_text' );

// Landing main menu location.
add_filter( 'crossarena_main_menu_args', 'crossarena_landing_main_menu_location' );

// Custom gallery grid sizes
add_action( 'init', 'crossarena_add_imeges_size_filter' );

add_filter( 'the_content', 'crossarena_fix_elementor_content', -999 );

add_filter('cherry_breadcrumb_args', 'crossarena_breadcrumb_args');

function crossarena_fix_elementor_content( $content ) {
	remove_filter( 'the_content', 'wptexturize', 10 );
	return $content;
}

/**
 * * Modify a breadcrumbs args  *
 * * @param $args *
 * * @return mixed */

 function crossarena_breadcrumb_args($args)
 {
	 $args['separator'] = '/';
	 return $args;
 }


/**
 * Append description into nav items
 *
 * @param  string $item_output The menu item output.
 * @param  WP_Post $item Menu item object.
 * @param  int $depth Depth of the menu.
 * @param  array $args wp_nav_menu() arguments.
 *
 * @return string
 */
function crossarena_nav_menu_description( $item_output, $item, $depth, $args ) {

	if ( 'main' !== $args->theme_location || ! $item->description ) {
		return $item_output;
	}

	$descr_enabled = get_theme_mod(
		'header_menu_attributes',
		crossarena_theme()->customizer->get_default( 'header_menu_attributes' )
	);

	if ( ! $descr_enabled ) {
		return $item_output;
	}

	$current     = $args->link_after . '</a>';
	$description = '<div class="menu-item__desc">' . $item->description . '</div>';
	$item_output = str_replace( $current, $description . $current, $item_output );

	return $item_output;
}

/**
 * Set layout classes for sidebars.
 *
 * @since  1.0.0
 * @uses   crossarena_get_layout_classes.
 *
 * @param  array $classes Additional classes.
 * @param  string $area_id Sidebar ID.
 *
 * @return array
 */
function crossarena_set_sidebar_classes( $classes, $area_id ) {

	if ( 'sidebar' == $area_id || 'shop-sidebar' == $area_id ) {
		return crossarena_get_layout_classes( 'sidebar', $classes );
	}

	if ( 'footer-area' == $area_id ) {
		$columns = esc_html( get_theme_mod( 'footer_widget_columns', crossarena_theme()->customizer->get_default( 'footer_widget_columns' ) ) );

		if ( '1' !== $columns ) {
			$classes[] = sprintf( 'footer-area--%s-cols', $columns );
		} else {
			$classes[] = 'footer-area--fullwidth';
		}

		$classes[] = 'row';
	}

	return $classes;
}

/**
 * Get footer widgets layout class
 *
 * @since  1.0.0
 *
 * @param  string $params Existing widget classes.
 *
 * @return string
 */
function crossarena_get_footer_widget_layout( $params ) {

	if ( is_admin() ) {
		return $params;
	}

	if ( empty( $params[0]['id'] ) || 'footer-area' !== $params[0]['id'] ) {
		return $params;
	}

	if ( empty( $params[0]['before_widget'] ) ) {
		return $params;
	}

	$columns = get_theme_mod(
		'footer_widget_columns',
		crossarena_theme()->customizer->get_default( 'footer_widget_columns' )
	);

	$columns = intval( $columns );
	$classes = 'class="col-xs-12 col-sm-%3$s col-md-%2$s col-lg-%1$s %4$s ';

	switch ( $columns ) {
		case 4:
			$lg_col = 3;
			$md_col = 6;
			$sm_col = 12;
			$extra  = '';
			break;

		case 3:
			$lg_col = 4;
			$md_col = 4;
			$sm_col = 12;
			$extra  = '';
			break;

		case 2:
			$lg_col = 6;
			$md_col = 6;
			$sm_col = 12;
			$extra  = '';
			break;

		default:
			$lg_col = 12;
			$md_col = 12;
			$sm_col = 12;
			$extra  = '';
			break;
	}

	$params[0]['before_widget'] = str_replace(
		'class="',
		sprintf( $classes, $lg_col, $md_col, $sm_col, $extra ),
		$params[0]['before_widget']
	);

	return $params;
}

/**
 * Filter image CSS model
 *
 * @param  array $css_model Default CSS model.
 * @param  array $args Post formats module arguments.
 *
 * @return array
 */
function crossarena_add_image_format_classes( $css_model, $args ) {
	$blog_featured_image = esc_html( get_theme_mod( 'blog_featured_image', crossarena_theme()->customizer->get_default( 'blog_featured_image' ) ) );
	$blog_layout         = esc_html( get_theme_mod( 'blog_layout_type', crossarena_theme()->customizer->get_default( 'blog_layout_type' ) ) );
	$suffix              = ( 'default' !== $blog_layout ) ? 'fullwidth' : $blog_featured_image;

	$css_model['link'] .= ' post-thumbnail--' . $suffix;

	return $css_model;
}

/**
 * Enqueue misc js script.
 *
 * @param  array $depends Default dependencies.
 * @return array
 */
function crossarena_enqueue_misc( $depends ) {
	global $is_IE;

	if ( $is_IE ) {
		$depends[] = 'object-fit-images';
	}

	return $depends;
}

/**
 * Add to toTop and stickUp properties if required.
 *
 * @param  array $vars Default variables.
 *
 * @return array
 */
function crossarena_js_vars( $vars ) {
	$header_menu_sticky = get_theme_mod( 'header_menu_sticky', crossarena_theme()->customizer->get_default( 'header_menu_sticky' ) );

	if ( $header_menu_sticky && ! wp_is_mobile() ) {
		$vars['stickUp'] = true;
	}

	$totop_visibility = get_theme_mod( 'totop_visibility', crossarena_theme()->customizer->get_default( 'totop_visibility' ) );

	if ( $totop_visibility ) {
		$vars['toTop'] = true;
	}

	return $vars;
}

/**
 * Add has/no thumbnail classes for posts
 *
 * @param  array $classes Existing classes.
 *
 * @return array
 */
function crossarena_post_thumb_classes( $classes ) {
	$thumb = 'no-thumb';

	if ( has_post_thumbnail() ) {
		$thumb = 'has-thumb';
	}

	$classes[] = $thumb;

	return $classes;
}

/**
 * Add placeholder attributes for comment form fields.
 *
 * @param  array $args Arguments for comment form.
 *
 * @return array
 */
function crossarena_modify_comment_form( $args ) {
	$args = wp_parse_args( $args );

	if ( ! isset( $args['format'] ) ) {
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
	}

	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	$html_req  = ( $req ? " required='required'" : '' );
	$html5     = 'html5' === $args['format'];
	$commenter = wp_get_current_commenter();

	$args['label_submit'] = esc_html__( 'Submit Comment', 'crossarena' );

	$args['fields']['author'] = '<p class="comment-form-author"><input id="author" class="comment-form__field" name="author" type="text" placeholder="' . esc_html__( 'Your name', 'crossarena' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></p>';

	$args['fields']['email'] = '<p class="comment-form-email"><input id="email" class="comment-form__field" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' placeholder="' . esc_html__( 'Your e-mail', 'crossarena' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req . ' /></p>';

	$args['fields']['url'] = '';

	$args['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" class="comment-form__field" name="comment" placeholder="' . esc_html__( 'Your comment *', 'crossarena' ) . '" cols="45" rows="8" aria-required="true" required="required"></textarea></p>';

	$args['title_reply_before'] = '<h3 id="reply-title" class="comment-reply-title">';

	$args['title_reply_after'] = '</h3>';

	$args['title_reply'] = esc_html__( 'Leave a reply', 'crossarena' );

	return $args;
}

/**
 * Reorder comment fields
 *
 * @param  array $fields Comment fields.
 *
 * @return array
 */
function crossarena_reorder_comment_fields( $fields ) {

	if ( is_singular( 'product' ) ) {
		return $fields;
	}

	$new_fields_order = array();
	$new_order        = array( 'author', 'email', 'url', 'comment' );

	foreach ( $new_order as $key ) {
		$new_fields_order[ $key ] = $fields[ $key ];
		unset( $fields[ $key ] );
	}

	return $new_fields_order;
}

/**
 * Add extra body classes
 *
 * @param  array $classes Existing classes.
 *
 * @return array
 */
function crossarena_extra_body_classes( $classes ) {
	global $is_IE;

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of ie to browsers IE.
	if ( $is_IE ) {
		$classes[] = 'ie';
	}

	// Adds a options-based classes.
	$header_layout  = esc_attr( get_theme_mod( 'header_container_type', crossarena_theme()->customizer->get_default( 'header_container_type' ) ) );
	$content_layout = esc_attr( get_theme_mod( 'content_container_type', crossarena_theme()->customizer->get_default( 'content_container_type' ) ) );
	$footer_layout  = esc_attr( get_theme_mod( 'footer_container_type', crossarena_theme()->customizer->get_default( 'footer_container_type' ) ) );
	$blog_layout    = esc_attr( get_theme_mod( 'blog_layout_type', crossarena_theme()->customizer->get_default( 'blog_layout_type' ) ) );
	$sb_position    = esc_attr( get_theme_mod( 'sidebar_position', crossarena_theme()->customizer->get_default( 'sidebar_position' ) ) );
	$sidebar        = esc_attr( get_theme_mod( 'sidebar_width', crossarena_theme()->customizer->get_default( 'sidebar_width' ) ) );
	$single_type    = esc_attr( get_theme_mod( 'single_post_type', crossarena_theme()->customizer->get_default( 'single_post_type' ) ) );
	$header_type    = esc_attr( get_theme_mod( 'header_layout_type', crossarena_theme()->customizer->get_default( 'header_layout_type' ) ) );
	$footer_type    = esc_attr( get_theme_mod( 'footer_layout_type', crossarena_theme()->customizer->get_default( 'footer_layout_type' ) ) );

	if ( is_singular( 'post' ) ) {
		$classes[] = 'single-post-' . sanitize_html_class( $single_type );;
	}

	return array_merge( $classes, array(
		'header-layout-' . $header_layout,
		'content-layout-' . $content_layout,
		'footer-layout-' . $footer_layout,
		'blog-' . $blog_layout,
		'position-' . $sb_position,
		'sidebar-' . str_replace( '/', '-', $sidebar ),
		'header-' . $header_type,
		'footer-' . $footer_type,
	) );
}

/**
 * Adds the meta viewport to the header.
 *
 * @since  1.0.1
 */
function crossarena_meta_viewport() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />' . "\n";
}

/**
 * Customization for `Tag Cloud` widget.
 *
 * @since  1.0.1
 *
 * @param  array $args Widget arguments.
 *
 * @return array
 */
function crossarena_customize_tag_cloud( $args ) {
	$args['smallest'] = 12;
	$args['largest']  = 12;
	$args['unit']     = 'px';

	return $args;
}

/**
 * Replaces `[...]` (appended to automatically generated excerpts) with `...`.
 *
 * @since  1.0.1
 *
 * @param  string $more The string shown within the more link.
 *
 * @return string
 */
function crossarena_excerpt_more( $more ) {

	if ( is_admin() ) {
		return $more;
	}

	return ' &hellip;';
}

/**
 * Creating wrappers for audio shortcode.
 */
function crossarena_audio_shortcode( $html, $atts, $audio, $post_id, $library ) {

	$html = '<div class="mejs-container-wrapper">' . $html . '</div>';

	return $html;
}


/**
 * Change text for buddypress activity read more
 *
 * @return string
 */
function crossarena_bp_activity_read_more_text( $read_more_text ) {
	return esc_html__( 'Read more', 'crossarena' );
}

/**
 * Disable sidebar 404 page.
 */
function crossarena_specific_sidebar_position( $value ) {

	if (  is_404() || is_singular('tm_pg_set') || is_singular('tm_pg_album') ) {
		return 'fullwidth';
	}

	return $value;
}


/**
 * Landing main menu location.
 */
function crossarena_landing_main_menu_location( $args ) {

	if ( 'page-templates/landing.php' === get_page_template_slug() ) {
		$args['theme_location'] = 'main_landing';
	}
	return $args;
}

/**
 * Add images size filter
 */
function crossarena_add_imeges_size_filter() {
	add_filter( 'tm_pg_get_sizes', 'crossarena_images_sizes' );
}

/**
 * Images sizes.
 *
 * @param array $args The arguments.
 *
 * @return array
 */

function crossarena_images_sizes( $args ) {
	$args['grid-default'] = array(
		'width'   => '558',
		'height'  => '374',
		'type'    => 'grid',
	);
	$args['masonry-default'] = array(
		'width'   => '558',
		'height'  => '0',
		'type'    => 'masonry',
	);
	return $args;
}
