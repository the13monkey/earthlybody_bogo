<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/result-count.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="container-fluid p-3">

	<div class="row justify-content-between align-items-center px-lg-3">

		<p class="woocommerce-result-count my-0">
			<?php
				if ( 1 === $total ) {
					_e( 'Showing the single result', 'woocommerce' );
				} elseif ( $total <= $per_page || -1 === $per_page ) {
					/* translators: %d: total results */
					printf( _n( '%d item', '%d items', $total, 'woocommerce' ), $total );
				} else {
					$first = ( $per_page * $current ) - $per_page + 1;
					$last  = min( $total, $per_page * $current );
					/* translators: 1: first result 2: last result 3: total results */
					printf( _nx( '%1$d&ndash;%2$d of %3$d item', '%1$d&ndash;%2$d of %3$d items', $total, 'with first and last item', 'woocommerce' ), $first, $last, $total );
				}
			?>
		</p>

		<div class="d-block d-lg-none">
			<a href="#" id="filter">
				<img src="<?php echo get_template_directory_uri() ?>/img/filter.jpg" alt="Shop Earthly Body" />
			</a>
		</div>

	

