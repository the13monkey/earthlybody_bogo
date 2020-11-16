<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

$terms = get_the_terms( get_the_ID(), 'product_cat' );

$cat_names = [];
foreach ( $terms as $term ) {
	$cat_name = $term->name; 
	array_push( $cat_names, $cat_name );
}

$brands_arr = array( 
	'CBD Daily Products' => 'cbddaily',
	'Marrakesh Hair Care' => 'marrakesh',
	'Emera CBD Hair Care' => 'emera',
	'Hemp Seed Body Care' => 'hempseed',
);

$counts = [];
foreach ( $brands_arr as $slug => $header ) {
	if ( in_array( $slug, $cat_names ) ) {
		$count = 1;
		get_header( 'brand' );
	} else {
		$count = 0;
	}
	array_push( $counts, $count );
}
if ( !in_array( 1, $counts ) ) {
	get_header( 'home' );
}

?>
<div class="row mb-5">
	<div class="container">
	<div class="row">
	<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'container individual-product px-0 col col-12', $product ); ?> >

		<div class="container-fluid my-3">
			<div class="row px-3">
			<?php
			/**
			 * Hook: woocommerce_before_single_product_summary.
			 *
			 * @Unhooked woocommerce_show_product_sale_flash - 10 - Dinah
			 * @Unhooked woocommerce_show_product_images - 20 - Dinah
			 * @hooked woocommerce_breadcrumb - 5 - Dinah
			 * @hooked add_product_sticky_bar - 1 - Dinah
			 */
			do_action( 'woocommerce_before_single_product_summary' );
			?>
			</div>
		</div>
			
		<div class="summary entry-summary container-fluid pb-3">
			<div class="row">
			<?php
			/**
			 * Hook: woocommerce_single_product_summary.
			 *
			 * @hooked woocommerce_show_product_sale_flash - Dinah
			 * @hooked woocommerce_show_product_iamges - Dinah : single-product/product-image.php
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			 */
			do_action( 'woocommerce_single_product_summary' );
			?>
			</div>
		</div>

		<div class="container-fluid">
			<?php
			/**
			 * Hook: woocommerce_after_single_product_summary.
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
			?>
		</div>

		<?php do_action( 'woocommerce_after_single_product' ); ?>

	</div>
	
	<!-- scent explore carousel script -->
	<script type="text/javascript">
		var slideIndex = 1; 
		showSlide( slideIndex );

		function current( n ) {
			showSlide( slideIndex = n );
		}

		function plusSlides( n ) {
			showSlide( slideIndex += n );
		}

		function showSlide( n ) {
			var i;
			var slides = document.getElementsByClassName( "slide" );
			if ( n > slides.length ) { slideIndex = 1 }
			if ( n < 1 ) { slideIndex = slides.length }
			for ( i = 0; i < slides.length; i++ ) {
				slides[i].classList.remove("active");
			}
			slides[slideIndex - 1].classList.add("active");
		}
	</script>
		
	<!-- click "view cart" slide out the mini cart --> 
	<script>
		jQuery( document ).ready( function($){
			
			$('.woocommerce-success .button.wc-forward').click(function(e){
				e.preventDefault();
				$('#mini-cart-wrapper').css('right', '0px');
			});
			
		} );
	</script>
		
	</div>
	</div>
</div><!-- end of .row -->
