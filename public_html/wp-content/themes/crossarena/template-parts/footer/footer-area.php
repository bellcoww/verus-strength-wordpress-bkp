<?php
/**
 * The template for displaying footer widget area.
 *
 * @package Crossarena
 */
// Check footer-area visibility.
if ( ! get_theme_mod( 'footer_widget_area_visibility', crossarena_theme()->customizer->get_default( 'footer_widget_area_visibility' ) ) || ! is_active_sidebar( 'footer-area' ) ) {
	return;
} ?>

<div class="footer-area-wrap invert">
	<div <?php echo crossarena_get_container_classes( ['footer-container_wrap'], 'footer' ); ?>>
		<?php do_action( 'crossarena_render_widget_area', 'footer-area' ); ?>
	</div>
</div>
