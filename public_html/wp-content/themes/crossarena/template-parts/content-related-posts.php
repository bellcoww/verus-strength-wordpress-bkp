<?php
/**
 * The template for displaying related posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Crossarena
 * @subpackage single-post
 */
?>
<div class="related-post page-content<?php echo esc_attr( $grid_class ); ?>">
	<figure class="post-thumbnail">
		<?php echo $image; ?>
	</figure>
	<header class="entry-header">
		<?php echo $date; ?>
		<?php echo $title; ?>
	</header>
	<div class="entry-meta">
		<?php echo $author; ?>
		<?php echo $category; ?>
		<?php echo $tag; ?>
		<?php echo $comment_count; ?>
	</div>
	<div class="entry-content">
		<?php echo $excerpt; ?>
	</div>
</div>
