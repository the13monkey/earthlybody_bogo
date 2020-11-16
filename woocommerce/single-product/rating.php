<?php
/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();
$process = explode( '.', $average );
$num1 = $process[0];
$num2 = $process[1];
$root_url = get_template_directory_uri();

if ( $rating_count > 0 ) : ?>

	<div class="woocommerce-product-rating mb-4 pl-md-3">

		<?php 
			if ( $num1 == 0 ) {
				$output = "Be the first to rate this product!";
				$html = '<div class="row justify-content-center">'. $output .'</div>';
				echo $html; 
			} else if ( $num1 == 5 ) {
				$html = '<div class="row justify-content-center"><div>';
				for ( $i = 0; $i < $num1; $i++ ) {
					$star = '<img src="'. $root_url .'/img/site/star-solid.svg" style="width: 16px; height: 16px;" alt="Shop Earthly Body" />'; 
					$html .= $star; 
				}
				$result_text = wc_get_rating_html( $average, $rating_count );
				echo $html.'</div>'.$result_text.'</div>'; 
			} else {
				$html = '<div class="row justify-content-center"><div>';
				$rest = 5 - $num1; 
				for ( $i = 0; $i < $num1; $i++ ) {
					$star = '<img src="'. $root_url .'/img/site/star-solid.svg" style="width: 16px; height: 16px;" alt="Shop Earthly Body" />';
					$html .= $star; 
				}
				if ( $num2 > 50 ) {
					for ( $j = 0; $j < $rest; $j ++ ) {
						$hollow = '<img src="'. $root_url .'/img/site/star-solid.svg" style="width: 16px; height: 16px;" alt="Shop Earthly Body" />';
						$html .= $hollow;
					}
				} elseif ( $num2 > 0 ) {
					for ( $j = 0; $j < $rest; $j ++ ) {
						$hollow = '<img src="'. $root_url .'/img/site/star-half.svg" style="width: 16px; height: 16px;" alt="Shop Earthly Body" />';
						$html .= $hollow;
					}
				} else {
					for ( $j = 0; $j < $rest; $j ++ ) {
						$hollow = '<img src="'. $root_url .'/img/site/star-outline.svg" style="width: 16px; height: 16px;" alt="Shop Earthly Body" />';
						$html .= $hollow;
					}
				}
				
				$result_text = wc_get_rating_html( $average, $rating_count );
				echo $html.'</div>'.$result_text.'</div>';
			}
		?>

	
	</div>
	
<?php endif; ?>

