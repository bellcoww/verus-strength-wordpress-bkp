<?php
/**
 * The template for displaying footer widget area.
 *
 * @package Crossarena
 */

?>

<div class="subscribe-block">
	<form method="POST" action="#" class="subscribe-block__form">
		<?php
			wp_nonce_field('crossarena_subscribe', 'crossarena_subscribe');
		?>
		<div class="subscribe-block__input-group">
			<div class="subscribe-block__input_wr">
				<input class="subscribe-block__input" type="email" name="subscribe-mail" value="" placeholder="<?php echo esc_html__( 'Enter Your Email', 'crossarena' ) ?>">
			</div>
			<div class="subscribe-block__btn_wr">
				<a href="#" class="subscribe-block__submit">
					<div class="page-preloader"></div>
					<i class="fa fa-envelope-o" aria-hidden="true"></i>
				</a>
			</div>
		</div>
	</form>
</div>