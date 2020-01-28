<?php
/**
 * Template for displaying standard post format item content
 *
 * @package Crossarena
 */
?>
<?php tm_pb_gallery_images( 'slider' ); ?>
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
