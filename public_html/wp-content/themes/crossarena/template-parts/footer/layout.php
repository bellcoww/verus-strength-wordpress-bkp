<?php
/**
 * The template for displaying the default footer layout.
 *
 * @package Crossarena
 */

$footer_contact_block_visibility = get_theme_mod( 'footer_contact_block_visibility', crossarena_theme()->customizer->get_default( 'footer_contact_block_visibility' ) );
?>

<div class="footer-container invert">
	<div <?php echo crossarena_get_container_classes( ['footer-container_wrap'], 'footer' ); ?>>
		<div class="footer-container__top">
			<?php crossarena_footer_menu(); ?>
			<?php crossarena_footer_copyright(); ?>
		</div>
		<div class="footer-container__bottom">
			<?php crossarena_footer_logo(); ?>
			<?php if ( $footer_contact_block_visibility ) : ?>
				<?php crossarena_contact_block( 'footer' ); ?>
			<?php endif; ?>
		</div>
	</div>
</div><!-- .container -->
