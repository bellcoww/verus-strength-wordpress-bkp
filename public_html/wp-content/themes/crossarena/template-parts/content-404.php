<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Crossarena
 */
?>
<section class="error-404 not-found">
	<header class="page-header">
		<h1 class="screen-reader-text"><?php esc_html_e( '404', 'crossarena' ); ?></h1>
		<h1><?php esc_html_e( '404', 'crossarena' ); ?></h1>
		<h3><?php esc_html_e( 'The page not found.', 'crossarena' ); ?></h3>
		<a class="btn btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Visit Home Page', 'crossarena' ); ?></a>
	</header><!-- .page-header -->

	<div class="page-content">
		<p><?php esc_html_e( 'Unfortunately the page you were looking for could not be found. Maybe search can help.', 'crossarena' ); ?></p>
		<?php get_search_form(); ?>
	</div><!-- .page-content -->
</section><!-- .error-404 -->
