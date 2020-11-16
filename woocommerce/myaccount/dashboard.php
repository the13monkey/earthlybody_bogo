<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="container-fluid">
	<div class="row mt-4 mb-5">
		<div class="col col-12 col-md-4 px-3">
			<a href="<?php echo wc_get_endpoint_url( 'orders' ) ?>">
				<img src="<?php echo get_template_directory_uri() ?>/img/recent_orders.jpg" width="100%" height="auto" />
				<p style="text-align:center; color: #000;">My Orders</p>
			</a>
		</div>
		<div class="col col-12 col-md-4 px-3">
			<a href="<?php echo wc_get_endpoint_url( 'edit-address' ) ?>">
				<img src="<?php echo get_template_directory_uri() ?>/img/my_addresses.jpg" width="100%" height="auto" />
				<p style="text-align:center; color: #000;">Shipping & Billing Addresses</p>
			</a>
		</div>
		<div class="col col-12 col-md-4 px-3">
			<a href="<?php echo wc_get_endpoint_url( 'edit-account' ) ?>">
				<img src="<?php echo get_template_directory_uri() ?>/img/change_password.jpg" width="100%" height="auto" />
				<p style="text-align:center; color: #000;">Change Password</p>
			</a>
		</div>
	</div>
</div>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */