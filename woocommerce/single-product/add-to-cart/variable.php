<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart mb-5" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
	<?php else : ?>	

		<?php foreach ( $attributes as $attribute_name => $options ) : ?>
			<div class="row px-2">
				<div class="col col-12 px-2 my-0">
					<h4 class="my-2">Choose <?php echo $attribute_name; ?></h4>
				</div>
				<div class="col col-12 px-2 my-3 scent-box-row">
					<?php if ( $attribute_name == 'Scent' || $attribute_name == 'Flavor' ) :?>

						<?php 
							foreach ( $options as $option ) {
								echo '<div data-attribute_name="'. $attribute_name .'" data-value="'. $option .'">
										<img src="'. get_template_directory_uri() .'/img/scents/'. $option .'.jpg" class="mx-3 scent-box available">
										<span class="mr-4">'. $option .'</span>
									</div>';
							}
						?>
						
						<?php if ( $attribute_name == 'Scent' ) {
							echo '<a href="#" class="explore-scents text-brown my-2">Explore our scents</a>';
							} ?>
						

					<?php else: ?>
						
						<?php 
							foreach ( $options as $option ) {
								echo '<button class="size-option mr-3 mb-1" data-value="'. $option .'" data-attribute_name="'. $attribute_name .'">'. $option .'</button>';
							}
						?>

					<?php endif; ?>
				</div>
				
			</div>
		<?php endforeach; ?>


		<table class="variations mb-3">
			<tbody>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<tr>
						<td class="align-middle d-none"><label class="mb-0" for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></label></td>
						<td class="align-middle pl-3">
							<?php
								wc_dropdown_variation_attribute_options( array(
									'options'   => $options,
									'attribute' => $attribute_name,
									'product'   => $product,
								) );
								echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Reset Options', 'woocommerce' ) . '</a>' ) ) : '';
							?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<div class="single_variation_wrap">
			<?php
				/**
				 * Hook: woocommerce_before_single_variation.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
				 *
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * Hook: woocommerce_after_single_variation.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>

	</div> <!-- don't know what it is for, but without it, footer doesn't stretch --> 
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
