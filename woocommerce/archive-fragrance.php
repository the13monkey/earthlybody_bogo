<?php
/**
 * The Template for displaying fragrance category of each brand
 *
 * This template is modified after WooCommerce archive-product.php file
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 * @DC - unhook woocommerce_bradcrumb - 10 (to move it around)
 */
do_action( 'woocommerce_before_main_content' );

?>
	<?php 
		/**
		 * Get brand header content based on URL
		 * CBD Daily = cbd-daily-products
		 * Marrakesh = marrakesh-hair-care
		 * Emera = emera-cbd-hair-care
		 * Hempseed = hemp-seed-body-care
		 */
		
		if ( is_search() ) {
			$url_raw = $_SERVER['REQUEST_URI'];
			$url_raw_array = explode('?', $url_raw);
			$url_raw_str = $url_raw_array[0];
			$url_arr = explode('/', $url_raw_str);
		} else {
			$url = $_SERVER['REQUEST_URI'];
			$url_arr = explode( '/', $url );
		}

		$brands_arr = array( 
			'cbd-daily-products' => 'cbddaily',
			'marrakesh-hair-care' => 'marrakesh',
			'emera-cbd-hair-care' => 'emera',
			'hemp-seed-body-care' => 'hempseed',
		);

		$cats = array(
			'cbddaily' => 'CBD Daily Products',
			'marrakesh' => 'Marrakesh Hair Care',
			'emera' => 'Emera CBD Hair Care',
			'hempseed' => 'Hemp Seed Body Care'
		);

		$counts = [];
		foreach ( $brands_arr as $slug => $header ) {
			if ( in_array( $slug, $url_arr ) ) {
				$count = 1; 
				get_header( 'brand' );
				$this_cat = $cats[$header];
			} else {
				$count = 0;
			}
			array_push( $counts, $count );
		}
		if ( !in_array( 1, $counts ) ) {
			get_header( 'home' );
		} 
		$isbrand = array_sum( $counts );

		
	?>


<div class="row justify-content-center mt-3 my-md-3 px-5">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="text-center woocommerce-products-header__title page-title-<?php echo $header ?>">
			<?php if ( is_product_tag() ) : ?>
				Shop <?php woocommerce_page_title(); ?>
			<?php else : ?>
				<?php woocommerce_page_title(); ?>
			<?php endif; ?>
		</h1>
	<?php endif; ?>
</div>

<div class="container-fluid">

	<div class="row mb-5">

		<div class="col col-12 col-lg-2 d-none d-lg-block category-sidebar">
			<?php woocommerce_breadcrumb(); ?>
			<?php if ( $isbrand == 0 ): ?>
				<!-- home category page -->
				<?php 
					wp_nav_menu (
						array (
							'theme_location' => 'primary-menu',
							'menu_class' => 'nav'
						)
					)
				?>
			<?php else: ?>
				
				<!-- brand category page --> 
				<?php 
				$category = $this_cat;
				$IdByName = get_term_by( 'name', $category, 'product_cat' );
				$product_cat_ID = $IdByName->term_id; 
				$args = array (
					'hierarchical' => 1,
					'show_option_none' => '',
					'hide_empty' => 0,
					'parent' => $product_cat_ID,
					'taxonomy' => 'product_cat'
				);
				$subcats = get_categories( $args );

				foreach ( $subcats as $subcat ) {
					$sub_link = get_term_link( $subcat->slug, $subcat->taxonomy );
					$subcat_name = $subcat->name; 

					$subIDbyName = get_term_by( 'name', $subcat_name, 'product_cat' );
					$product_subcat_ID = $subIDbyName->term_id; 
					$sub_args = array (
						'hierarchical' => 1,
						'show_option_none' => '',
						'hide_empty' => 0,
						'parent' => $product_subcat_ID,
						'taxonomy' => 'product_cat'
					);
					$sub_subcats = get_categories( $sub_args );

					if ( count( $sub_subcats ) > 0 ) {
						$html = '<li class="nav-item my-3 has-dropdown"><a class="nav-link" href="'. $sub_link .'">'. $subcat_name .'</a><div class="dropdown">';
						for ( $i=0; $i<count( $sub_subcats ); $i++ ) {
							$sub_sublink = get_term_link( $sub_subcats[$i]->slug, $sub_subcats[$i]->taxonomy );
							$sub_subname = $sub_subcats[$i]->name;
							$html .= '<a href="'. $sub_sublink .'" class="nav-link">'. $sub_subname .'</a>';
						}
						$html .= '</div></li>';
					} else {
						$html = '<li class="nav-item my-3"><a class="nav-link" href="'. $sub_link .'">'. $subcat_name .'</a></li>';
					}
					
					echo $html; 
				}
				?>
				
				<!-- end of brand category page --> 
			<?php endif; ?>	
		</div>

		<div class="d-none d-xl-none p-3" id="filter-content">
			<?php woocommerce_breadcrumb(); ?>
			<?php if ( $isbrand == 0 ): ?> 
				<!-- home category page -->
				<?php 
					wp_nav_menu (
						array (
							'theme_location' => 'primary-menu',
							'menu_class' => 'nav'
						)
					)
    			?>
			<?php else: ?>
				<!-- brand category page -->
				<?php 
				$category = $this_cat;
				$IdByName = get_term_by( 'name', $category, 'product_cat' );
				$product_cat_ID = $IdByName->term_id; 
				$args = array (
					'hierarchical' => 1,
					'show_option_none' => '',
					'hide_empty' => 0,
					'parent' => $product_cat_ID,
					'taxonomy' => 'product_cat'
				);
				$subcats = get_categories( $args );

				foreach ( $subcats as $subcat ) {
					$sub_link = get_term_link( $subcat->slug, $subcat->taxonomy );
					$subcat_name = $subcat->name; 

					$subIDbyName = get_term_by( 'name', $subcat_name, 'product_cat' );
					$product_subcat_ID = $subIDbyName->term_id; 
					$sub_args = array (
						'hierarchical' => 1,
						'show_option_none' => '',
						'hide_empty' => 0,
						'parent' => $product_subcat_ID,
						'taxonomy' => 'product_cat'
					);
					$sub_subcats = get_categories( $sub_args );

					if ( count( $sub_subcats ) > 0 ) {
						$html = '<li class="nav-item my-3 has-dropdown"><a class="nav-link" href="'. $sub_link .'">'. $subcat_name .'</a><div class="dropdown">';
						for ( $i=0; $i<count( $sub_subcats ); $i++ ) {
							$sub_sublink = get_term_link( $sub_subcats[$i]->slug, $sub_subcats[$i]->taxonomy );
							$sub_subname = $sub_subcats[$i]->name;
							$html .= '<a href="'. $sub_sublink .'" class="nav-link">'. $sub_subname .'</a>';
						}
						$html .= '</div></li>';
					} else {
						$html = '<li class="nav-item my-3"><a class="nav-link" href="'. $sub_link .'">'. $subcat_name .'</a></li>';
					}
					
					echo $html; 
				}
				?>
				<!-- end of brand category page -->
			<?php endif; ?>
			<a href="#" id="close-filter" class="p-1 bg-brown text-white">Close</a>	
		</div>
		
		<div class="col col-12 col-lg-10 px-0 fragrance-category mt-3" id="category-products">
		
		<?php 
			 
				$category = single_cat_title('', false);
				$IdByName = get_term_by( 'name', $category, 'product_cat' );
				$product_cat_ID = $IdByName->term_id; 
				$args = array (
					'hierarchical' => 1,
					'show_option_none' => '',
					'hide_empty' => 0,
					'parent' => $product_cat_ID,
					'taxonomy' => 'product_cat'
				);
				$subcats = get_categories( $args );

				foreach ( $subcats as $subcat ) {
					$sub_link = get_term_link( $subcat->slug, $subcat->taxonomy );
					$subcat_name = $subcat->name; 
					$thumbnail_id = get_term_meta( $subcat->term_id, 'thumbnail_id', true );
					$image = wp_get_attachment_url( $thumbnail_id );
					
					if ( $image ) {
						$html = '<div class="p-3">
								<a href="'. $sub_link .'">
									<img src="'. $image .'" alt="Shop Earthly Body | '. $subcat_name .'" />
									<p>'. $subcat_name .'</p>
								</a>
							  </div>';
						echo $html;
					}
					 
				}
				
		?>

		</div>

	</div>

</div>
