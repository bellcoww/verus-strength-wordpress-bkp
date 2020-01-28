<?php
/**
 * The template for displaying footer widget area.
 *
 * @package Crossarena
 */

$footer_type = get_theme_mod( 'footer_layout_type', crossarena_theme()->customizer->get_default( 'footer_layout_type' ) );

if ($footer_type === 'style-2') {
	return false;
}

$subscribe_visibility = get_theme_mod( 'footer_subscribe_visibility', crossarena_theme()->customizer->get_default( 'footer_subscribe_visibility' ) );
$social_visibility = get_theme_mod( 'footer_social_links', crossarena_theme()->customizer->get_default( 'footer_social_links' ) );

// Check subscribe and _social visibility.
if ( $subscribe_visibility || $social_visibility ) : ?>

	<div class="footer-social-wrap invert">
		<div <?php echo crossarena_get_container_classes( ['footer-container_wrap'], 'footer' ); ?>>
			<?php  if ( $subscribe_visibility ) {
				get_template_part( 'template-parts/footer/footer-subscribe' );
			} ?>
			<?php  if ( $social_visibility ) : ?>
				<?php crossarena_social_list( 'footer' ); ?>
			<?php endif; ?>
		</div>
	</div>

<?php endif;