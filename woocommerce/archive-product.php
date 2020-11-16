<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
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
		
		<div class="col col-12 col-lg-10 px-0" id="category-products">
		<?php
		/**
		 * Hook: woocommerce_archive_description.
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		do_action( 'woocommerce_archive_description' );
		?>
		
		<?php
			if ( woocommerce_product_loop() ) {

				/**
				 * Hook: woocommerce_before_shop_loop.
				 *
				 * @hooked woocommerce_output_all_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );

				woocommerce_product_loop_start();

				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();

						/**
						 * Hook: woocommerce_shop_loop.
						 */
						do_action( 'woocommerce_shop_loop' );

						wc_get_template_part( 'content', 'product' );
					}
				}

				woocommerce_product_loop_end();

				/**
				 * Hook: woocommerce_after_shop_loop.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );
			}

			/**
			 * Hook: woocommerce_after_main_content.
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action( 'woocommerce_after_main_content' );

			/**
			 * Hook: woocommerce_sidebar.
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 * @hooked dc script - sortby trigger - 10
			 */
			do_action( 'woocommerce_sidebar' );
		?>	

		</div>

	</div>

</div>
