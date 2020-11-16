<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="row my-Account-titles" style="background: #fcf7f2;">
	<div class="col col-12">
		<h2 class="mb-0 mb-md-3 mx-5">My Account</h2>
		<h3 class="mt-0 mt-md-3">
			<span>Hello, <?php echo $current_user->display_name; ?> | <a style="color: #613d20; text-decoration: underline;" href="<?php echo esc_url( wc_logout_url() ) ?>">Log Out</a></span>
		</h3>
	</div>
</div>

<div class="row">
	<div class="col col-12 col-md-3 mb-0 pl-0">
		<?php do_action( 'woocommerce_account_navigation' ); ?>
	</div>
	<div class="col col-12 col-md-9">
		<div class="border p-md-3 my-md-4">
			<?php do_action( 'woocommerce_account_content' ) ?>
		</div>	
	</div>
</div>
