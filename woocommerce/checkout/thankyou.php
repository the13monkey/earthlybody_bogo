<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
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
?>

<div class="woocommerce-order">

	<?php if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() ); ?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>

			<div class="row px-3 px-md-0">

				<div class="col col-12 col-md-6 pr-md-5">

					<h2 class="mt-0 thankyou-title">We've received your order and will start working on it right away! </h2>
					<div class="p-3 thankyou-notice">
						<h4 class="my-2 mb-0"><strong>Please note</strong></h4>
						<p>Order processing can take up to 7-10 business days. All orders are pending approval and merchandise availability.</p>
						<p>Please add einvoice@donotreply.net to your contacts to receive tracking information once your order is shipped.</p>
					</div>

					<div class="mt-5 p-3 thankyou-order-details">
						<h4 class="my-2 mb-0">Order#<?php echo $order->get_order_number() ?></h4>
						<p>
							<span>Order confirmation and shipping updates will be sent to</span>
							<br>
							<span id="refer-email"><?php echo $order->billing_email; ?></span>
						</p>
						<p>
							<span>Order date</span>
							<br>
							<span><?php echo wc_format_datetime( $order->get_date_created() ); ?></span>
						</p>
						<p>
							<span>Payment</span>
							<br>
							<span><?php echo $order->get_payment_method_title(); ?></span>
						</p>
						<hr>
						<table>
							<tr>
								<td>Order Item</td>
								<td>Qty.</td>
								<td>Subtotal</td>
							</tr>
							<?php 
								foreach ( $order->get_items() as $item_id => $item_data ) {
									$product = $item_data->get_product();
									$product_name = $product->get_name();
									$product_qty = $item_data->get_quantity();
									$product_total = $item_data->get_total();
									echo '<tr>
											<td>'. $product_name .'</td>
											<td>'. $product_qty .'</td>
											<td>$ '. $product_total .'</td>
										</tr>';
								}
							?>
							<tr>
								<td colspan="2">Shipping</td>
								<td><?php echo $order->get_shipping_total() ?></td>
							</tr>
							<tr>
								<td colspan="2">Tax</td>
								<td><?php echo $order->get_total_tax() ?></td>
							</tr>
							<tr>
								<td colspan="2">Order Total</td>
								<td id="GTM_order_total"><?php echo $order->get_total() ?></td>
							</tr>
						</table>	
					</div>
					
					<?php if ( !is_user_logged_in() ) : ?>
							
					<div class="mt-5 p-3 thankyou-order-register">
						<h4 class="my-0">Register an account with us to save time on your next checkout!</h4>
						<?php echo do_shortcode('[woocommerce_my_account]'); ?>
					</div>

					<?php endif; ?>
				</div>

				<div class="col col-12 col-md-6">
					
					<div class="pb-3 pt-0 px-0 mt-3 thankyou-share">
						<img src="<?php echo get_template_directory_uri() ?>/img/site/share_n_save.jpg" alt="Shop Earthly Body" />
						
						<div class="deal-box m-3">
							<div class="row justify-content-between mx-3">
								<h4 class="mb-0">Follow us on social media</h4>
								<h3 class="mb-0">-10% off</h3>
							</div>
							<div class="row mt-2 mb-3 mx-3 justify-content-start align-items-center">
								<div class="sm-icon mr-3" style="background-image:url('<?php echo get_template_directory_uri() ?>/img/social/facebook-white.svg')"></div>
								<div class="sm-icon mr-3" style="background-image:url('<?php echo get_template_directory_uri() ?>/img/social/twitter-white.svg')"></div>
								<div class="sm-icon mr-3" style="background-image:url('<?php echo get_template_directory_uri() ?>/img/social/youtube-white.svg')"></div>
								<div class="sm-icon mr-3" style="background-image:url('<?php echo get_template_directory_uri() ?>/img/social/instagram-white.svg')"></div>
								<p>@EarthlyBody</p>
							</div>
						</div>
						
						<div class="deal-box m-3">
							<div class="row mx-3 justify-content-between">
								<h4 class="mb-0">Join our mailing list</h4>
								<h3 class="mb-0">-25% off</h3>
							</div>
							<div class="row mx-3 mt-2 mb-4 justify-content-between">
								<a href="https://lp.constantcontactpages.com/su/sZ5rUig/joinEB" target="_blank" id="thankyou-join-mailing">Send me coupons!</a>
							</div>
						</div>
						
						<script type="text/javascript">
							jQuery(document).ready(function($){
								$('.gens-raf-generate-guest').find('.gens-raf-generate-link').html('Sign Up');
								$('.gens-refer-a-friend--generate').addClass('container-fluid');
								$('.gens-raf-generate-guest').addClass('row');
								$('.gens-raf-generate-guest span').addClass('col col-12');
								$('.gens-raf-guest-email').addClass('col col-12 col-md-8');
								$('.gens-raf-generate-link').addClass('col col-12 col-md-4 bg-brown');
								var order_email = $('#refer-email').html();
								$('.gens-raf-guest-email').val(order_email);
							})
						</script>
						
						<!-- Refer to a Friend Program -->
						<div class="deal-box m-3">
							<div class="row mx-3 justify-content-between">
								<h4 class="mb-0">Refer Us to Your Friends<br>Get $5 When They Shop with Us!</h4>
								<h3 class="mb-0">$5 per Friend</h3>
							</div>
							<div class="row mx-3 mt-2 mb-4 justify-content-between">
								<a href="https://shop.earthlybody.com/referrals-terms-and-conditions/" id="thankyou-join-mailing" target="_blank">Read our referral policies</a>
							</div>
							<div class="row mx-3 mt-2 mb-4 justify-content-start">
								<?php echo do_shortcode('[WOO_GENS_RAF_ADVANCE guest_text="A $5 coupon will be sent to the email you sign up with when your friend\'s order is completed." url="https://shop.earthlybody.com"]'); ?> 
							</div>
							
						</div> 
						
					</div>

				</div>

			</div>
			
	
		<?php endif; ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

	<?php endif; ?>

</div>
