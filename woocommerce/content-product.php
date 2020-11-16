<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

/*BOGO Snippet
$onsale = $product->is_on_sale();
$arr = array(12833, 12836, 12841, 12846, 12849, 12852, 12855, 12858, 12861, 12864, 12867, 12870, 12873, 12877, 12881, 12884, 12887, 12890, 12894, 12897, 12900, 12903, 12906, 12909, 12914, 12917);
$product_id = $product->get_id();
if ( ( $onsale == 1 ) || ( in_array( $product_id , $arr) ) ) {
					$nobogo = "Product Not eligible for BOGO.";
					//echo "<p style='color: red; padding-left: 1rem; margin-bottom: 0; padding-bottom: 0;'>".$nobogo."</p>";
				} else {
					$yesbogo = "Buy 2, Get the 2nd Item Free";
					//echo "<p style='color: green; padding-left: 1rem; margin-bottom: 0; padding-bottom: 0;'>".$yesbogo."</p>"; 
				} */

?>
<li <?php wc_product_class( 'col col-12 col-md-6 col-lg-3 text-center mb-3', $product ); ?>>
	<div class="content-product-wrapper p-3 box-shadow text-center bg-white">
		
	<?php

	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	do_action( 'woocommerce_shop_loop_item_title' );
		
	/* BOGO snippet
	if ( isset( $nobogo ) ) {
		echo '<p style="color:#c00001; padding: 0.5rem; font-size: 0.8rem; text-transform: capitalize; font-weight: 500;">'.$nobogo.'</p>'; 
	} else {
		echo '<p style="background:#5d7041; color:#fff; padding: 0.5rem; font-size: 0.8rem; text-transform: capitalize;">'.$yesbogo.'</p>';
	}*/

	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5 - Unhook it
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
		<?php 
			$product_id = $product->get_id(); 
			if ($product_id == 16869) {
				echo '<p style="color:#c00001;">Maximum 3 items per order.</p>';
			}
		?>
	</div>
</li>
