<?php
/**
 * The template for displaying the style-2 footer layout.
 *
 * @package Crossarena
 */

$subscribe_visibility = get_theme_mod( 'footer_subscribe_visibility', crossarena_theme()->customizer->get_default( 'footer_subscribe_visibility' ) );

?>
<div class="footer-container invert">
	<div class="site-info container">
		<?php
			crossarena_footer_logo();
			crossarena_contact_block( 'footer' );
			crossarena_social_list( 'footer' );
			if ( $subscribe_visibility ) {
				get_template_part( 'template-parts/footer/footer-subscribe' );
			}
			crossarena_footer_menu();
			crossarena_footer_copyright();
		?>
	</div><!-- .site-info -->
</div><!-- .container -->
