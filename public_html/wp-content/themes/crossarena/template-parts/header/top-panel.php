<?php
/**
 * Template part for top panel in header.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Crossarena
 */

// Don't show top panel if all elements are disabled.
if ( ! crossarena_is_top_panel_visible() ) {
	return;
}
?>

<div class="top-panel <?php echo crossarena_get_invert_class_customize_option( 'top_panel_bg' ); ?>">
	<?php crossarena_top_menu(); ?>
	<div <?php echo crossarena_get_container_classes( ['top-container_wrap'], 'header' ); ?>>
		<?php //do_action('cherry_popups_login_logout_link'); ?>
		<div class="top-panel__container">
			<?php crossarena_contact_block( 'header' ); ?>
			<div class="top-panel__container__items">
				<?php crossarena_top_message( '<div class="top-panel__message">%s</div>' ); ?>
				<?php crossarena_social_list( 'header' ); ?>
				<?php crossarena_header_search( ); ?>
			</div>
		</div>
	</div>
</div><!-- .top-panel -->
