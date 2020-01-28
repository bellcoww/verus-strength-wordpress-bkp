<?php
/**
 * Template part for displaying modern single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Crossarena
 */
?>

<div class="single-modern-header <?php echo $invert_class = has_post_thumbnail() ? 'invert' : ''; ?>">

	<?php $utility = crossarena_utility()->utility; ?>

	<div class="post-thumbnail">
		<?php $utility->media->get_image( array(
			'size'        => 'crossarena-thumb-xl',
			'mobile_size' => 'crossarena-thumb-xl',
			'html'        => '<img class="wp-post-image" src="%3$s" alt="%4$s">',
			'placeholder' => false,
			'echo'        => true,
		) );
		?>
	</div><!-- .post-thumbnail -->

	<div class="container">

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

			<?php $utility->attributes->get_title( array(
					'class' => 'entry-title',
					'html'  => '<h2 %1$s>%4$s</h2>',
					'echo'  => true,
				) );
			?>

			<?php get_template_part( 'template-parts/content-entry-meta-single' ); ?>

		</header><!-- .entry-header -->

	</div>

</div>
