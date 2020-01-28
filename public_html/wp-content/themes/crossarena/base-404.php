<?php get_header( crossarena_template_base() ); ?>

	<div <?php crossarena_content_wrap_class(); ?>>

		<div class="row invert">

			<div id="primary" <?php crossarena_primary_content_class(); ?>>

				<main id="main" class="site-main" role="main">

					<?php include crossarena_template_path(); ?>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- .container -->

<?php get_footer( crossarena_template_base() ); ?>
