<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;
?>
<table class="shop_table woocommerce-checkout-review-order-table">
	<thead>
		<tr>
			<th class="product-name" colspan="2" style="text-align:left; width: 50%; font-weight:500; padding-bottom: 1rem; padding-top: 1rem;"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-total" style="text-align:left; font-weight:500; padding-bottom: 1rem; padding-top: 1rem;"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		do_action( 'woocommerce_review_order_before_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

				if ( $_product->is_type( 'simple' ) ) {
					$cat_ids = $_product->category_ids;	
					$cat_names = [];
					foreach ( $cat_ids as $cat_id ) {
						$term = get_term_by( 'id', $cat_id, 'product_cat' );
						$cat_name = $term->name; 
						array_push( $cat_names, $cat_name );
					}
				} else {
					$parent_id = $_product->get_parent_id();
					$cat_ids = wc_get_product( $parent_id )->category_ids;
					$cat_names = [];
					foreach ( $cat_ids as $cat_id ) {
						$term = get_term_by( 'id', $cat_id, 'product_cat' );
						$cat_name = $term->name; 
						array_push( $cat_names, $cat_name );
					}
				}
				if ( in_array( 'CBD Daily Products', $cat_names ) ) {
					$show_cat_name = 'CBD Daily Products';
					$brand_color = '#5d7041';
				}	
				
				if ( in_array( 'Hemp Seed Body Care', $cat_names ) ) {
					$show_cat_name = 'Hemp Seed Body Care';
					$brand_color = '#3d8e26';
				}

				if ( in_array( 'Marrakesh Hair Care', $cat_names ) ) {
					$show_cat_name = 'Marrakesh Hair Care';
					$brand_color = '#a51e35';
				}
				
				if ( in_array( 'Emera CBD Hair Care', $cat_names  ) ) {
					$show_cat_name = 'Emera CBD Hair Care';
					$brand_color = '#004c45';
				}
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
					<td class="product-thumb">
						<p class="my-0" style="width: 200px; text-align: center; background: <?php echo $brand_color ?>; ">
								<span style="color: #fff; padding: 1rem; font-size: 0.85rem;">
									<?php echo $show_cat_name; ?>
								</span>
							</p>
							<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $product_permalink ) {
								echo $thumbnail; // PHPCS: XSS ok.
							} else {
								printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
							}
							?>
					</td>
					<td class="product-name px-3">
							
						<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times;&nbsp;%s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</td>
					<td class="product-total">
						<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</td>
				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
	</tbody>
	<tfoot>

		<tr class="cart-subtotal">
			<th colspan="2" style="text-align:left; padding-top: 1rem; padding-bottom: 1rem;"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
			<td style="text-align:left; padding-top: 1rem; padding-bottom: 1rem;"><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>
		
		<!--
		<tr class="cart-coupon">
			<td colspan="3">
				<div class="woocommerce-form-coupon-toggle">
					<?php wc_print_notice( apply_filters( 'woocommerce_checkout_coupon_message', esc_html__( 'Have a coupon?', 'woocommerce' ) . ' <a href="#" class="showcoupon">' . esc_html__( 'Click here to enter your code', 'woocommerce' ) . '</a>' ), 'notice' ); ?>
				</div>
				<form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">
					<input type="text" name="coupon_code" class="input-text form-control rounded-0 p-md-2" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
					<button type="submit" class="button btn btn-success bg-dark-green border-0 rounded-0" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
					<div class="clear"></div>
				</form>
			</td>
		</tr>
-->

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<th colspan="2" style="text-align: left;"><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
				<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th><?php echo esc_html( $fee->name ); ?></th>
				<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited ?>
					<tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<th style="text-align: left;" colspan="2"><?php echo esc_html( $tax->label ); ?></th>
						<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<th style="text-align: left;" colspan="2"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
					<td><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<tr class="order-total">
			<th colspan="2" class="py-3" style="text-align:left;"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
			<td style="text-align:left; display: table-cell;"><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

	</tfoot>
</table>
