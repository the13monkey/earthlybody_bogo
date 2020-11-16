<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="row px-3 mb-5">

<div class="col col-12 col-lg-7 pr-xl-5">

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
		
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				$product_price = $_product->get_price();
				/* BOGO Snippet 
				$onsale = $_product->is_on_sale();
				$arr = array(12833, 12836, 12841, 12846, 12849, 12852, 12855, 12858, 12861, 12864, 12867, 12870, 12873, 12877, 12881, 12884, 12887, 12890, 12894, 12897, 12900, 12903, 12906, 12909, 12914, 12917);
				if ( ( $onsale == 1 ) || ( in_array( $product_id , $arr) ) ) {
					$nobogo = "Product Not eligible for BOGO.";
					echo "<p style='color: red; padding-left: 1rem; margin-bottom: 0; padding-bottom: 0;'>".$nobogo."</p>";
				} else {
					$yesbogo = "Buy 2, Get the 2nd Item Free!";
					echo "<p style='color: green; padding-left: 1rem; margin-bottom: 0; padding-bottom: 0;'>".$yesbogo."</p>"; 
				} */
				
				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
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
					<div class="col col-12 p-3 mb-5 d-flex justify-content-start woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

							<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_html__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
							?>

						<div class="mr-3">
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
							
							
						</div>
						
						<div class="ml-md-3" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
						<p class="mt-0 mb-2" style="font-weight: 500; line-height: 1.2; max-width:300px; font-size: 1.15rem;">
						<?php
						if ( ! $product_permalink ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
						} else {
							if ( $_product->is_type( 'simple' ) ) {
								$product_name = $_product->get_name();
								echo $product_name; 
							} else {
								$parent_id = $_product->get_parent_id();
								$parent_name = wc_get_product( $parent_id )->get_name();
								echo $parent_name; 
							}
						}
						do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key ); ?>
						</p>
						<?php 
							if ( !$_product->is_type( 'simple' ) ) {
								$attributes = $_product->get_attributes();
									foreach ( $attributes as $attribute => $value ) {
										echo "<p style='text-transform:capitalize; margin-block-start:0; margin-block-end:0;'>". $attribute .": ". $value ."</p>"; 
										}
								}
						?>
						<?php
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {
							$product_quantity = woocommerce_quantity_input(
								array(
									'input_name'   => "cart[{$cart_item_key}][qty]",
									'input_value'  => $cart_item['quantity'],
									'max_value'    => $_product->get_max_purchase_quantity(),
									'min_value'    => '0',
									'product_name' => $_product->get_name(),
								),
								$_product,
								false
							);
						
						}

						echo '<span style="display:inline-block; vertical-align:middle; margin-top: 1.2rem; margin-right: 0.25rem;">Qty:</span>'. apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
					echo '<span style="display:inline-block; vertical-align:middle; margin-top: 1.2rem; margin-left: 0.25rem;">$'.$product_price.'/each</span>';
						?>

						<?php 
						// Meta data.
						echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

						// Backorder notification.
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
						}
						?>
						</div>

						<!--
						<?php
							echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
						?>
						-->

						<!-- BOGO Thanksgiving 2020 --> 

						<?php 
							
							$updated_qty = $cart_item['quantity'];

							if ( $updated_qty > 6 ) {

								echo '<p class="bogo-err" style="color:#721c24; background-color:#f8d7da; border-color:#f55c6cb; padding: 0.25rem 1rem; width: 100%;">Only a maximum of 3 pairs (6 products) can use the BOGO deal. Rest of your items will be charged their full listed prices at the checkout.<p>';

								echo '<div class="bogo-price">';

								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.

								echo '</div>';

							} elseif( $updated_qty % 2 !== 0 ) {

								echo '<p class="bogo-err" style="color:#721c24; background-color:#f8d7da; border-color:#f55c6cb; padding: 0.25rem 1rem; width: 100%;">Please add 1 more item to use the BOGO deal.<p>';

								echo '<div class="bogo-price">';

								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.

								echo '</div>';

							} else {

								echo '<p class="bogo-err" style="color:#155724; background-color:#d4edda; border-color:#c3e6c6; padding: 0.25rem 1rem; width: 100%;">BOGO deal successfully applied.<p>';

								echo '<div class="bogo-price bogo-success-price">';
								
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.

								$qty = $cart_item['quantity'];

								$newQty = intdiv($qty, 2); 

								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $newQty ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.

								echo '</div>';

							}
							
						?>
						
						<!-- BOGO Thanksgiving 2020 --> 
						
					</div>

					<?php
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>

			<tr>
				<td colspan="6" class="actions">

					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon">
							<label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					<?php } ?>

					<button type="submit" class="button d-none" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>


					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
				</td>
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		
	</div>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

</div><!-- end of .col-lg-7 -->
<div class="col col-12 col-lg-5 pl-lg-5 pr-lg-0" id="shopping_bag_cart_totals">

<?php do_action( 'woocommerce_after_cart' ); ?>

<div class="my-3 p-3" style="border: 1px solid #efefef; background: #fff;">
			<p style="font-weight: 500;">We give back to our communities.<br>
			<a href="https://gettogetherfoundation.com" style="color: #000; text-decoration: underline;" target="_blank">Learn more</a><p>
			<img src="<?php echo get_template_directory_uri() ?>/img/gtf.jpg" alt="Get Together Foundation" style="width: 100%; height: auto;" class="mb-1" />
		</div>

</div><!-- end of .col-lg-5 -->

</div><!-- end of .row -->
