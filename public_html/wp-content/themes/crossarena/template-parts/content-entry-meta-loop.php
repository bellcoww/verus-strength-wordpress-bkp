<?php
/**
 * Template part for displaying entry-meta.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Crossarena
 */
?>
<?php $utility = crossarena_utility()->utility; ?>

<?php if ( 'post' === get_post_type() ) : ?>

	<div class="entry-meta"><?php
	
		$author_visible = crossarena_is_meta_visible( 'blog_post_author', 'loop' );
		$utility->meta_data->get_author( array(
			'visible' => $author_visible,
			'class'   => 'posted-by__author',
			'prefix'  => esc_html__( 'by ', 'crossarena' ),
			'html'    => '<span class="posted-by">%1$s<a href="%2$s" %3$s %4$s rel="author">%5$s%6$s</a></span>',
			'echo'    => true,
		) );
	
		$cats_visible = crossarena_is_meta_visible( 'blog_post_categories', 'loop' );
		$utility->meta_data->get_terms( array(
			'visible'   => $cats_visible,
			'type'      => 'category',
			'delimiter' => ', ',
			'prefix'  => esc_html__( 'in ', 'crossarena' ),
			'before'    => '<span class="post__cats">',
			'after'     => '</span>',
			'echo'      => true,
		) );
		
		$tags_visible = crossarena_is_meta_visible( 'blog_post_tags', 'loop' );
		$utility->meta_data->get_terms( array(
			'visible'   => $tags_visible,
			'type'      => 'post_tag',
			'delimiter' => ', ',
			'prefix'    => esc_html__( 'tags ', 'crossarena' ),
			'before'    => '<span class="post__tags">',
			'after'     => '</span>',
			'echo'      => true,
		) );

		$comment_visible = crossarena_is_meta_visible( 'blog_post_comments', 'loop' );
		$utility->meta_data->get_comment_count( array(
			'visible' => $comment_visible,
			'icon'    => '<i class="fa fa-comment" aria-hidden="true"></i>',
			'html'    => '<span class="post__comments">%1$s<a href="%2$s" %3$s %4$s>%5$s%6$s</a></span>',
			'class'   => 'post__comments-link',
			'echo'    => true,
		) );

	?></div><!-- .entry-meta -->

<?php endif; ?>
