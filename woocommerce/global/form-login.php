<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form class="woocommerce-form woocommerce-form-login login border my-md-3 p-md-3" method="post">

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<p class="mb-md-3 text-center text-dark-green">
		If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the billing section.
	</p>

	<div class="row px-md-2">
		<p class="form-row form-row-first px-md-3 col mr-md-1">
			<label for="username"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
			<input type="text" class="input-text form-control rounded-0" name="username" id="username" autocomplete="username" />
		</p>
		<p class="form-row form-row-last px-md-3 col ml-md-1">
			<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
			<input class="input-text form-control rounded-0" type="password" name="password" id="password" autocomplete="current-password" />
		</p>
	</div>
	
	<div class="clear"></div>

	<?php do_action( 'woocommerce_login_form' ); ?>

	<p class="form-row form-check ml-md-1">
		<input class="woocommerce-form__input woocommerce-form__input-checkbox form-check-input" name="rememberme" type="checkbox" id="rememberme" value="forever" />
		<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme form-check-label">
			Remember me
		</label>
	</p>
		<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
		<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
		<button type="submit" class="woocommerce-button button woocommerce-form-login__submit btn btn-success bg-dark-green border-0 ml-md-1 rounded-0" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>
	</p>
	<p class="lost_password pl-md-1">
		<a class="text-muted" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
	</p>

	<div class="clear"></div>

	<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>
