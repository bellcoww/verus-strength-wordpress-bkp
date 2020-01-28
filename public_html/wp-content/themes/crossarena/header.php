<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Crossarena
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php crossarena_get_page_preloader(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'crossarena' ); ?></a>
	<header id="masthead" <?php crossarena_header_class(); ?> role="banner">
		<?php crossarena_ads_header() ?>
		<?php get_template_part( 'template-parts/header/mobile-panel' ); ?>
		<?php get_template_part( 'template-parts/header/top-panel', get_theme_mod( 'header_layout_type' ) ); ?>

		<div <?php crossarena_header_container_class(); ?>>
			<?php get_template_part( 'template-parts/header/layout', get_theme_mod( 'header_layout_type' ) ); ?>
		</div><!-- .header-container -->

		<?php crossarena_site_breadcrumbs(); ?>
	</header><!-- #masthead -->

	<?php crossarena_single_modern_header(); ?>

	<div id="content" <?php crossarena_content_class(); ?>>
