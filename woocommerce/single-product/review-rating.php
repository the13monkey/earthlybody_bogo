<?php
/**
 * The template to display the reviewers star rating in reviews
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/review-rating.php.
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

global $comment;
$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

$process = explode( '.', $rating );
$num1 = $process[0];
$num2 = $process[1];
$root_url = get_template_directory_uri();

if ( $rating && wc_review_ratings_enabled() ) {
	
	if ( $num1 == 5 ) {
		$html = '<div class="row px-3"><div>';
			for ( $i = 0; $i < $num1; $i++ ) {
				$star = '<img src="'. $root_url .'/img/site/star-solid.svg" style="width: auto; height: 16px;" alt="Shop Earthly Body" />'; 
				$html .= $star; 
			}
			$result_text = wc_get_rating_html( $average, $rating_count );
			echo $html.'</div>'.$result_text.'</div>'; 
		
	} else {
		$html = '<div class="row px-3"><div>';
		$rest = 5 - $num1; 
		for ( $i = 0; $i < $num1; $i++ ) {
			$star = '<img src="'. $root_url .'/img/site/star-solid.svg" style="width: auto; height: 16px;" alt="Shop Earthly Body" />';
			$html .= $star; 
		}
		if ( $num2 >= 50 ) {
			for ( $j = 0; $j < $rest; $j ++ ) {
				$hollow = '<img src="'. $root_url .'/img/site/star-solid.svg" style="width: auto; height: 16px;" alt="Shop Earthly Body" />';
				$html .= $hollow;
			}
		} else {
			for ( $j = 0; $j < $rest; $j ++ ) {
				$hollow = '<img src="'. $root_url .'/img/site/star-outline.svg" style="width: auto; height: 16px;" alt="Shop Earthly Body" />';
				$html .= $hollow;
			}
		}
				
		$result_text = wc_get_rating_html( $average, $rating_count );
		echo $html.'</div>'.$result_text.'</div>';
	}
	
}
