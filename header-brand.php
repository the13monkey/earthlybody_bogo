<?php 

if ( is_search() ) {
	$url_raw = $_SERVER['REQUEST_URI'];
	$url_raw_array = explode('?', $url_raw);
	$url_raw_str = $url_raw_array[0];
	$brand_name_arr = explode('/', $url_raw_str);
} else {
	$url = $_SERVER['REQUEST_URI'];
	$brand_name_arr = explode( "/", $url );
}


$brand_slugs = array(
    'cbd-daily-products',
    'marrakesh-hair-care',
    'emera-cbd-hair-care',
    'hemp-seed-body-care'
);

$brand_urls = array(
    'cbddaily',
    'marrakesh',
    'emera',
    'hempseed'
);

$brands = array(
    'cbd-daily-products' => 'cbddaily',
    'marrakesh-hair-care' => 'marrakesh',
    'emera-cbd-hair-care' => 'emera',
    'hemp-seed-body-care' => 'hempseed'
);

$cats = array(
    'cbddaily' => 'CBD Daily Products',
    'marrakesh' => 'Marrakesh Hair Care',
    'emera' => 'Emera CBD Hair Care',
    'hempseed' => 'Hemp Seed Body Care'
);

$slugs = array(
    'cbddaily' => 'cbd-daily-products',
    'marrakesh' => 'marrakesh-hair-care',
    'emera' => 'emera-cbd-hair-care',
    'hempseed' => 'hemp-seed-body-care'
);

$sites = array(
	'cbddaily' => 'cbddailyproducts',
    'marrakesh' => 'marrakeshhaircare',
    'emera' => 'emerahaircare',
    'hempseed' => 'hempseedbodycare'
);

foreach ( $brand_name_arr as $brand_info ) {

    if ( in_array( $brand_info, $brand_slugs ) ) {
        $brand = $brands[$brand_info];
        $this_slug = $brand_info;
        $this_cat = $cats[$brand];
		$this_site = $sites[$brand];
    } 

    if ( in_array( $brand_info, $brand_urls ) ) {
        $brand = $brand_info; 
        $this_slug = $slugs[$brand_info];
        $this_cat = $cats[$brand];
		$this_site = $sites[$brand];
    }

};

?>

<div class="w-100 p-3 px-lg-0 brand-header brand-header-<?php echo $brand ?>">

    <div class="d-block d-lg-none" id="mobile-menu">
        <img src="<?php echo get_template_directory_uri() ?>/img/bars.svg" alt="Shop Earthly Body" />
    </div>
	
	<?php if ( isset($brand) ) : ?>
    <div class="brand-logo brand-logo-<?php echo $brand ?>">
        <a href="<?php echo get_site_url() ?>/<?php echo $brand ?>">
            <img src="<?php echo get_template_directory_uri() ?>/img/brand/<?php echo $brand ?>.png" alt="<?php echo $brand ?> | Shop Earthly Body" />
        </a>
    </div>
	<?php else: ?>
	<div class="brand-logo brand-logo-<?php echo $brand ?>">
        <a href="<?php echo get_site_url() ?>/">
            <img src="<?php echo get_template_directory_uri() ?>/img/site/eb_logo_brown.svg" alt="Shop Earthly Body" />
			<h5 class="text-brown my-0">marketplace</h5>
        </a>
    </div>
	<?php endif; ?>

    <div class="brand-nav brand-nav-<?php echo $brand ?> d-none d-lg-flex justify-content-center align-itmes-center my-md-4">
        
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
		
		<li class="nav-item my-3"><a href="https://<?php echo $this_site; ?>.com" class="nav-link" target="_blank">About Our Brand</a></li>
    </div>

    <div class="d-block d-lg-none" id="mobile-shopping-bag">
        <a href="<?php echo wc_get_cart_url() ?>">
            <img src="<?php echo get_template_directory_uri() ?>/img/shopping-bag-brown.svg" alt="Shop Earthly Body" />
			<span class="cart-items-count">
					<?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>
				</span>
        </a>
    </div>
    
    <button id="brand-search-trigger" class="d-none d-lg-inline-block">
        <img src="<?php echo get_template_directory_uri() ?>/img/search_eb.svg" alt="Shop Earthly Body" />
    </button>
	 
    <div class="brand-search px-3 py-5 w-100 bg-white brand-search-<?php echo $brand ?> ">
		<button id="close-brand-search">Close</button>
        <form role="search" method="get" class="brand-search-form" id="search-<?php echo $brand ?>" action="<?php echo get_site_url(); ?>/product-category/<?php echo $this_slug; ?>">
            <button type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'woocommerce' ); ?>">
		        <img src="<?php echo get_template_directory_uri() ?>/img/search_eb.svg" alt="Search Natural CBD Topicals | Shop Earthly Body" />
	        </button>
	        <input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="w-100" placeholder="Search <?php echo $this_cat; ?>" value="<?php echo get_search_query(); ?>" name="s" style="color: #000 !important;" aria-label="Search Product"/>
			<input type="hidden" name="post_cat" value="<?php echo $this_cat ?>" />
	        <input type="hidden" name="post_type" value="product" />
			<input type="hidden" name="my_search" id="my_search" value="c_search" />
        </form> 
        
    </div> 
</div>

<div class="d-block d-lg-none p-3 w-100" id="mobile-menu-wrapper">
	
    <div class="brand-search brand-search-<?php echo $brand ?> d-block">
		
        <form role="search" method="get" class="brand-search-form mx-1 mx-md-3 mb-4" id="search-<?php echo $brand ?>" action="<?php echo get_site_url(); ?>/product-category/<?php echo $this_slug; ?>">
            <button type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'woocommerce' ); ?>">
                <img src="<?php echo get_template_directory_uri() ?>/img/search_eb.svg" alt="Shop Earthly Body" />
            </button>
            <input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" placeholder="Search <?php echo $this_cat; ?>" value="<?php echo get_search_query(); ?>" name="s" style="color: #000 !important;" aria-label="search product"/>
			<input type="hidden" name="post_cat" value="<?php echo $this_cat ?>" />
            <input type="hidden" name="post_type" value="product" />
			<input type="hidden" name="my_search" id="my_search" value="c_search" />
        </form> 

    </div>
    
    <div class="brand-nav brand-nav-<?php echo $brand ?> d-block">
        <a href="<?php echo get_site_url() ?>/product-category/<?php echo $this_slug ?>/" class="nav-link">Shop all</a>
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
		<li class="nav-item my-3" style="text-decoration: underline;"><a href="https://<?php echo $this_site; ?>.com" class="nav-link" target="_blank">About Our Brand</a></li>
    </div>

    <span id="close-mobile-menu">
        <img src="<?php echo get_template_directory_uri() ?>/img/close.svg" alt="Shop Earthly Body">
    </span>
</div>

<script type="text/javascript">
//Slide In and Out Mobile Menu
var openMobileMenu = document.getElementById("mobile-menu");
var mobileMenu = document.getElementById("mobile-menu-wrapper");
var closeMobileMenu = document.getElementById("close-mobile-menu");
    openMobileMenu.addEventListener("click", function(){
    mobileMenu.classList.add("slideInLeft");
});
closeMobileMenu.addEventListener("click", function(){
    mobileMenu.classList.remove("slideInLeft");
});
jQuery(document).ready(function($){
    $('#mobile-menu-wrapper .brand-nav .has-dropdown').click(function(e){
        e.preventDefault();
        $(this).find('.dropdown').slideToggle();
        if ( $('.brand-nav .dropdownopen').length ) {
            $(this).removeClass('dropdownopen');
        } else {
            $(this).addClass('dropdownopen');
        }
        $('.brand-nav .dropdown a').click(function(e){
            var url = $(this).attr('href');
            window.location.replace(url);
        });
    });
    $('#brand-search-trigger').click(function(e){
        e.preventDefault();
        $('.brand-search').slideDown();
    });
    $('#close-brand-search').click(function(e){
        e.preventDefault();
        $('.brand-search').slideUp();
    });
	
	//Change menu item texts 
	$('.brand-nav-marrakesh').find('.nav-link:contains("Our Products")').text('Shop Products');
	$('.brand-nav-marrakesh').find('.nav-link:contains("Our Fragrances")').text('Shop By Scent');
	$('.brand-nav-marrakesh').find('.nav-link:contains("Our Categories")').text('Shop By Category');
	$('.brand-nav-marrakesh .dropdown').find('.nav-link:contains("Shop All Marrakesh Products")').text('Shop All');
	
	$('.brand-nav-emera').find('.nav-link:contains("Shop EMERA Products")').text('Shop Products');
	$('.brand-nav-emera').find('.nav-link:contains("Shop Fragrances")').text('Shop By Scent');
	$('.brand-nav-emera .dropdown').find('.nav-link:contains("Shop All EMERA Products")').text('Shop All');
	
	$('.brand-nav-hempseed').find('.nav-link:contains("Shop By Hemp Seed Products")').text('Shop Products');
	$('.brand-nav-hempseed').find('.nav-link:contains("Shop by Fragrance")').text('Shop By Scent');
	$('.brand-nav-hempseed').find('.nav-link:contains("Shop Hemp Seed Category")').text('Shop By Category');
	$('.brand-nav-hempseed').find('.nav-link:contains("Hemp Seed Hair Care Category")').text('Hair Care');
	$('.brand-nav-hempseed').find('.nav-link:contains("Hemp Seed Miracle Oil Category")').text('Miracle Oil');
	$('.brand-nav-hempseed').find('.nav-link:contains("Hemp Seed By Night Category")').text('Hemp Seed By Night');
	$('.brand-nav-hempseed .dropdown').find('.nav-link:contains("Hemp Seed By Night Category")').text('Hemp Seed By Night');
	$('.brand-nav-hempseed .dropdown').find('.nav-link:contains("Shop All Hemp Seed Products")').text('Shop All');
});
</script>