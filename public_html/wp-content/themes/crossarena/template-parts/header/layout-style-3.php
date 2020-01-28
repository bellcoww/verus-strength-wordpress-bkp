<?php
/**
 * Template part for style-3 header layout.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Crossarena
 */
?>
<div <?php echo crossarena_get_container_classes( ['header-container_wrap'], 'header' ); ?>>
	<div class="header-container__flex">
		<div class="site-branding">
			<?php crossarena_header_logo() ?>
			<?php crossarena_site_description(); ?>
		</div>
		<?php crossarena_header_btn(); ?>
	</div>
	<div class="header-nav-wrapper">
		<?php crossarena_main_menu(); ?>
	</div>
</div>
