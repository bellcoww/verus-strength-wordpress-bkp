<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Crossarena
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php $utility = crossarena_utility()->utility; ?>

	<div class="post-format-link-wrap">
		<?php $size = crossarena_post_thumbnail_size(); ?>

		<?php $utility->media->get_image( array(
			'size'        => $size['size'],
			'html'        => '<img class="post-thumbnail__img wp-post-image" src="%3$s" alt="%4$s">',
			'placeholder' => false,
			'echo'        => true,
			) );
		?>
		<?php do_action( 'cherry_post_format_link', array( 'render' => true ) ); ?>
	</div>

	<header class="entry-header">
	
			<?php $date_visible = crossarena_is_meta_visible( 'blog_post_publish_date', 'single' );
	
			$utility->meta_data->get_date( array(
				'visible' => $date_visible,
				'icon'    => '<i class="fa fa-calendar-o" aria-hidden="true"></i>',
				'html'    => '<div class="post__date">%1$s<a href="%2$s" %3$s %4$s ><time datetime="%5$s">%6$s%7$s</time></a></div>',
				'class'   => 'post__date-link',
				'echo'    => true,
			) );
			?>
	
			<?php $title_html = ( is_single() ) ? '<h3 %1$s>%4$s</h3>' : '<h4 %1$s><a href="%2$s" rel="bookmark">%4$s</a></h4>';
	
			$utility->attributes->get_title( array(
				'class' => 'entry-title',
				'html'  => $title_html,
				'echo'  => true,
			) );
			?>
	
		</header><!-- .entry-header -->
	
		<?php crossarena_ads_post_before_content() ?>
	
		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links__title">' . esc_html__( 'Pages:', 'crossarena' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span class="page-links__item">',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'crossarena' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );
			?>
		</div><!-- .entry-content -->
	
		<footer class="entry-footer">
		
			<?php get_template_part( 'template-parts/content-entry-meta-single' ); ?>
	
		</footer><!-- .entry-footer -->

</article><!-- #post-## -->
