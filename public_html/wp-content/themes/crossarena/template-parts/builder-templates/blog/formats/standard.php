<?php
/**
 * Template for displaying standard post format item content
 *
 * @package Crossarena
 */
?>
<?php if ( $module->_var( 'thumb' ) ) : ?>
<div class="tm_pb_image_container">
	<a href="<?php esc_url( the_permalink() ); ?>" class="entry-featured-image-url">
		<?php echo $module->_var( 'thumb' ); ?>
		<?php if ( 'on' === $module->_var( 'use_overlay' ) ) {
			echo $module->_var( 'item_overlay' );
		} ?>
	</a>
</div> <!-- .tm_pb_image_container -->
<?php endif; ?>
<div class="tm_pb_content_container">
	<?php
	if ( 'on' === $module->_var( 'show_categories' ) ) {
		?><div class="categories"><?php
			echo get_the_category_list( ', ' );
		?></div><?php
	}

	$title_html = '<h5 %1$s><a href="%2$s" %3$s rel="bookmark">%4$s</a></h5>';

	tm_builder_core()->utility()->attributes->get_title( array(
		'html'  => $title_html,
		'class' => 'entry-title',
		'echo'  => true,
	) );
	?>

	<?php crossarena_get_builder_module_template( 'blog/meta.php', $module ); ?>

	<?php echo $module->get_post_content(); ?>

	<?php if ( 'on' === $module->_var( 'show_more' ) ) {
		crossarena_get_builder_module_template( 'blog/more.php', $module );
	} ?>
</div>
