<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( $cross_sells ) : ?>

	<div class="cross-sells col col-md-12 px-0">

		<h1 class="text-center mt-5 mt-md-0 mb-md-n3 mt-xl-5"><?php esc_html_e( 'You may also like&hellip;', 'woocommerce' ); ?></h1>

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $cross_sells as $cross_sell ) : ?>

				<?php
					$post_object = get_post( $cross_sell->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' );
				?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>
	<div class="col col-md-1"></div>
	<?php else: ?>
		<div class="cross-sells col col-12">
			<h1 class="text-center mt-5 mt-md-0 mb-md-n3 mt-xl-5"><?php esc_html_e( 'You may also like&hellip;', 'woocommerce' ); ?></h1>
			<ul class="products columns-2 mt-md-3 mb-md-5 pb-md-5 row my-md-5 pr-md-3">
			<?php 
				$defaults = [12833, 12836, 12841, 12846, 12849, 12852, 12855, 12858, 12861, 12864, 12867, 12870, 12873, 12877, 12881, 12884, 12887, 12890, 12894, 12897, 12900, 12903, 12906, 12909, 12914, 12917];
				$_rand_keys = array_rand( $defaults, 4 );
				$_cross_ids = [];
				foreach ( $_rand_keys as $key ) {
					$_cross_id = $defaults[$key];
					array_push( $_cross_ids, $_cross_id );
				}
				foreach ( $_cross_ids as $product_id ) {
					$post_object = get_post( $product_id );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' );
				}
			?>
			</ul>
		</div>
<?php				
endif;

wp_reset_postdata();
