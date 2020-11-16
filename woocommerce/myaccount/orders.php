<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_orders', $has_orders ); 

if ( $has_orders ) : ?>

	<ul class="list-group">
		<?php 
			foreach ( $customer_orders->orders as $customer_order ) {
				$order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
				$item_count = $order->get_item_count() - $order->get_item_count_refunded();
			?>
			<li class="list-group-item rounded-0 border-0 mb-4" style="border-bottom: 1px solid #efefef;">
				<div class="row px-3">
					<div class="col col-sm-4">
						<h4 class="mb-1">Order No.</h4>
						<p class="mt-0"><?php echo $order->get_order_number() ?></p>
					</div>
					<div class="col col-sm-4">
						<h4 class="mb-1">Order Date</h4>
						<p class="mt-0"><?php echo wc_format_datetime( $order->get_date_created() ) ?></p>
					</div>
					<div class="col col-sm-4">
						<h4 class="mb-1">Order Total</h4>
						<p class="mt-0"><?php echo $order->get_formatted_order_total() ?></p>
					</div>
				</div>
				<div class="row px-3">
					<?php 
						$items = $order->get_items();
						foreach ( $items as $item ) {
					?>
						<div class="pl-3 p-md-3 p-lg-1" style="width: 100px; height: 100px;">
							<img src="<?php echo get_the_post_thumbnail_url( $item->get_product_id() ) ?>" alt="CBD Daily Products" style="width:100%; height:auto; border: 1px solid #efefef;" />	
						</div>
					<?php
						}
					?>	
				</div>
				<div class="row px-3 px-md-0" style="justify-content: flex-end;">
					<?php
						$actions = wc_get_account_orders_actions( $order );

						if ( ! empty( $actions ) ) {
							foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
								echo '<a href="' . esc_url( $action['url'] ) . '" class="p-3 my-3 woocommerce-button' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
							}
						}
					?>
				</div>
			</li>
			<?php
			} 
		?>
	</ul>

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php esc_html_e( 'Previous', 'woocommerce' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php esc_html_e( 'Next', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?><!-- Below for new user without past orders -->
	<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info" style="margin-top: 1.35rem;">
		
		<?php esc_html_e( 'No order has been made yet.', 'woocommerce' ); ?>
		<a class="woocommerce-Button button ml-3" style="text-decoration: underline;" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php esc_html_e( 'Browse products', 'woocommerce' ); ?>
		</a>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
