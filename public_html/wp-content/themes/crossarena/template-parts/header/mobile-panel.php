<?php
/**
 * Template part for mobile panel in header.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Crossarena
 */
?>

<?php
	if ( class_exists( 'Jet_Menu' ) ) {
		return;
	}
?>

<div class="mobile-panel invert">
	<?php crossarena_menu_toggle( 'main-menu' ); ?>
</div>
