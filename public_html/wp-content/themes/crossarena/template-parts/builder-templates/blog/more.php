<?php
/**
 * Template for displaying read more button
 */
?>
<a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-primary" ><?php
	echo esc_html__( 'Read more', 'crossarena' );
?></a>