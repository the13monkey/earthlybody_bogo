<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
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

if ( wc_get_page_id( 'shop' ) > 0 ) : ?>

<div class="row px-3 mb-5">
	
	<div class="col col-12 col-lg-7 pr-xl-5">
		<div class="row">
			<?php do_action( 'woocommerce_cart_is_empty' ); ?>
		</div>
		<div class="row" id="empty-actions">
			<a class="mx-0 mb-3 mb-lg-0 mr-lg-2" href="<?php echo wc_get_page_permalink('shop') ?>">Browse all products</a>
			<a class="mx-0 mb-3 mb-lg-0 mr-lg-2" href="<?php echo get_home_url() ?>">Shop Earthly Body® Home</a>
		</div>
		<div class="row px-5 mt-3 justify-content-center">
			<h1 style="font-size: 2rem" class="mb-0 text-center">most customers like ...</h1>
		</div>
		<div class="row">
			<?php echo do_shortcode( '[products limit=4 columns=2 orderby="popularity" visibility="featured"]' ); ?>
		</div>
	</div>
	
	<div class="col col-12 col-lg-5 pl-lg-5 pr-lg-0" >
		<!-- @hooked woocommerce_cart_totals -->							
		<?php do_action( 'woocommerce_after_cart' ); ?>

		<div class="my-3 p-3" style="border: 1px solid #efefef;">
			<p style="font-size: 1rem; font-weight: 500;">We give back to our communities.<br>
			<a href="https://gettogetherfoundation.com" style="color: #000; text-decoration: underline;" target="_blank">Learn more</a><p>
			<img src="<?php echo get_template_directory_uri() ?>/img/gtf.jpg" alt="Get Together Foundation" style="width: 100%; height: auto;" class="mb-1" />
		</div>
	</div>
</div>

<?php endif; ?>


