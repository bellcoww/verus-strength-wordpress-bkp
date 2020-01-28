<?php
/**
 * Template part for default header layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Crossarena
 */
?>
<div <?php echo crossarena_get_container_classes( ['header-container_wrap'], 'header' ); ?>>
	<?php if ( ! crossarena_is_top_panel_visible() ) : ?>
		<div class="site-branding">
			<?php crossarena_header_logo() ?>
			<?php crossarena_site_description(); ?>
		</div>
	<?php endif; ?>
	<div class="header-container__flex">
		<div class="header-nav-wrapper">
			<?php crossarena_main_menu(); ?>
		</div>
		<?php crossarena_top_message( '<div class="top-panel__message">%s</div>' ); ?>
		<?php crossarena_header_btn(); ?>
	</div>
</div>
