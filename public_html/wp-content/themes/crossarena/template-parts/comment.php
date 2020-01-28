<?php
/**
 * The template for displaying comments.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy
 *
 * @package Crossarena
 */
?>
<div class="vcard">
	<?php echo crossarena_comment_author_avatar(); ?>
</div>
<div class="comment-content-wrap">
	<footer class="comment-meta">
		<div class="comment-author">
			<?php printf( __( '%s <span class="posted-by"> says:</span>', 'crossarena' ), crossarena_get_comment_author_link() ); ?>
		</div>
		<?php echo crossarena_get_comment_date( array( 'format' => 'M d, Y' ) ); ?>
	</footer>
	<div class="comment-content">
		<?php echo crossarena_get_comment_text(); ?>
	</div>
	<div class="reply">
		<?php echo crossarena_get_comment_reply_link( array( 'reply_text' => '<i class="fa fa-comment" aria-hidden="true"></i> ' . esc_html__( 'Reply ', 'crossarena' ) ) ); ?>
	</div>
</div>
