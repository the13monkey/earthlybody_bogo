<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="row">
	<div class="col col-4">
		<h4>Order No.</h4>
		<p><?php echo $order->get_order_number() ?></p>
	</div>
	<div class="col col-4">
		<h4>Order Date</h4>
		<p><?php echo wc_format_datetime( $order->get_date_created() ) ?></p>
	</div>
	<div class="col col-4">
		<h4>Order Total</h4>
		<p><?php echo $order->get_formatted_order_total() ?></p>
	</div>
</div>
<hr>

<div class="row px-3">
	<h4 class="my-4">Order Items (<?php echo $order->get_item_count() ?>)</h4>
</div>

<?php 
	$items = $order->get_items();
	foreach ( $items as $item ) {
?>
	<ul class="mb-5">
		<li class="d-flex mb-3">
			<div class="mr-3" style="width: 100px; height: 100px;">
				<img src="<?php echo get_the_post_thumbnail_url( $item->get_product_id() ) ?>" alt="CBD Daily Products" style="width:100%; height: 100%; border: 1px solid #efefef;" />	
			</div>
			<div>
				<h4 class="mt-0 mb-1"><?php echo $item->get_name() ?> x <?php echo $item->get_quantity() ?></h4>
				<p>$<?php echo $item->get_total() ?></p>
				<p class="mt-md-3">
					<?php  
						if ( $item['variation_id'] ) {
							$id = $item['variation_id'];
							$variation = new WC_Product_Variation($id);
							$name = implode("/", $variation->get_variation_attributes());
							echo $name; 	
						}
					?>
				</p>
			</div>
		</li>
	</ul>
<?php 
	}
?>
<hr>

<div class="row my-4">
	<div class="col col-md-6">
		<h4 class="">Shipping Address</h4>
		<div class="">
			<?php echo $order->get_formatted_shipping_address(); ?>
		</div>	
	</div>
	<div class="col col-md-6">
		<h4 class="">Billing Address</h4>
		<div class="">
			<?php echo $order->get_formatted_billing_address(); ?>
		</div>
	</div>
</div>
