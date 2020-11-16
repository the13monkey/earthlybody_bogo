<?php 

$url = $_SERVER['REQUEST_URI'];
$brand_name = explode( "/", $url );
$brand = $brand_name[1]; //Change in live site. 

$slugs = array( 
    'cbddaily' => 'cbd-daily-products',
    'marrakesh' => 'marrakesh-hair-care',
    'emera' => 'emera-cbd-hair-care',
    'hempseed' => 'hemp-seed-body-care'
);

$names = array(
    'cbddaily' => 'CBD Daily Products',
    'marrakesh' => 'Marrakesh Hair Care',
    'emera' => 'Emera CBD Hair Care',
    'hempseed' => 'Hemp Seed Body Care'
);

$cbddaily_h2 = 'your best days start with cbd';
$marrakesh_h2 = 'the best hair days smell good too';
$emera_h2 = 'scalp & hair care powered by cbd';
$hempseed_h2 = 'products inspired by nature';

$cbddaily_p = 'The #1 CBD brand choice of beauty professionals to soothe, moisturize, and ease discomforts';
$marrakesh_p = 'Professional hair care infused with argan & hemp seed oil and enticing fragrances';
$emera_p = 'The first professional CBD Hair Care line for optimal scalp and hair health';
$hempseed_p = 'Hemp-based, uniquely scented body care made from high-quality, natural ingredients';

foreach ( $slugs as $url => $slug ) {
    if ( $brand == $url ) {
        $this_slug = $slug; 
    }    
}

foreach ( $names as $url => $cat_name ) {
    if ( $brand == $url ) {
        $this_cat = $cat_name; 
    }
}

$cbddaily_categories = array(
	array(
        'category_name' => 'Original Strength',
        'category_url' => get_site_url().'/product-category/cbd-daily-products/shop-by-category/original-strength/',
    ),
	array(
		'category_name' => 'Triple Strength',
        'category_url' => get_site_url().'/product-category/cbd-daily-products/shop-by-category/triple-strength/',
	),
	array(
		'category_name' => 'Ultra Care',
        'category_url' => get_site_url().'/product-category/cbd-daily-products/shop-by-category/ultra-care/',	
	),
	array(
		'category_name' => 'Hair Care',
        'category_url' => get_site_url().'/product-category/cbd-daily-products/cbd-wellness/cbd-hair-care-cbd-wellness',		
	),
);

$marrakesh_categories = array(
    array(
        'category_name' => 'Color Care',
        'category_url' => get_site_url().'/product-category/marrakesh-hair-care/shop-by-benefit/color-care/',
    ),
    array(
        'category_name' => 'Styling',
        'category_url' => get_site_url().'/product-category/marrakesh-hair-care/shop-by-benefit/styling/',
    ),
    array(
        'category_name' => 'Smoothing',
        'category_url' => get_site_url().'/product-category/marrakesh-hair-care/shop-by-benefit/smoothing/',
    ),
	array(
		'category_name' => 'Fine Hair',
        'category_url' => get_site_url().'/product-category/marrakesh-hair-care/shop-by-benefit/fine-hair/',
	),
	array(
		'category_name' => 'Hydration',
        'category_url' => get_site_url().'/product-category/marrakesh-hair-care/shop-by-benefit/hydration/',
	),
	array(
		'category_name' => 'Men',
        'category_url' => get_site_url().'/product-category/marrakesh-hair-care/shop-by-product/marrakesh-for-men/',
	)
);

$hempseed_categories = array(
	array(
		'category_name' => 'Body Care',
        'category_url' => get_site_url().'/product-category/hemp-seed-body-care/',
	),
	array(
		'category_name' => 'Hair Care',
        'category_url' => get_site_url().'/product-category/hemp-seed-body-care/hemp-seed-shop-by-product/hemp-seed-hair-care/',
	),
	array(
		'category_name' => 'Miracle Oil',
        'category_url' => get_site_url().'/product-category/hemp-seed-body-care/hemp-seed-shop-by-product/hemp-seed-miracle-oil/',
	),
	array(
		'category_name' => 'Hemp Seed By Night',
        'category_url' => get_site_url().'/product-category/hemp-seed-body-care/hemp-seed-by-night/',
	),
);

?>

<div class="row mb-3">

    <div class="container-fluid px-0 hero hero-<?php echo $brand ?>">
        
       <div class="hero-captions d-flex align-items-center">
        <?php 
            if ( $brand == 'cbddaily' ) {
                echo '<h2 class="my-0">'. $cbddaily_h2 .'</h2>
                        <p>'. $cbddaily_p .'</p>';
            }
            if ( $brand == 'marrakesh' ) {
                echo '<h2 class="my-0">'. $marrakesh_h2 .'</h2>
                        <p>'. $marrakesh_p .'</p>';
            }
            if ( $brand == 'emera' ) {
                echo '<h2 class="my-0">'. $emera_h2 .'</h2>
                        <p>'. $emera_p .'</p>';
            }
            if ( $brand == 'hempseed' ) {
                echo '<h2 class="my-0">'. $hempseed_h2 .'</h2>
                        <p>'. $hempseed_p .'</p>';
            }
        ?>
       </div>

       <img src="<?php echo get_template_directory_uri() ?>/img/brand/<?php echo $brand ?>-bg-sm.jpg" alt="Shop Earthly Body" class="d-block d-md-none">

       <img src="<?php echo get_template_directory_uri() ?>/img/brand/<?php echo $brand ?>-bg-md.jpg" alt="Shop Earthly Body" class="d-none d-md-block d-lg-none">

       <img src="<?php echo get_template_directory_uri() ?>/img/brand/<?php echo $brand ?>-bg-lg.jpg" alt="Shop Earthly Body" class="d-none d-lg-block d-xl-none">

       <img src="<?php echo get_template_directory_uri() ?>/img/brand/<?php echo $brand ?>-bg-xl.jpg" alt="Shop Earthly Body" class="d-none d-xl-block">

    </div>

</div>

<?php if ( $brand !== 'emera' ) : ?>

<div class="container mb-5 brand-featured brand-featured-<?php echo $brand ?>">
    <div class="row justify-content-center mb-0">
        <h2 class="text-center">Shop by category</h2>
    </div>

    <?php 
    if ( $brand == 'cbddaily' ) {
        $categories = $cbddaily_categories; 
        $col = 3;
    }
    if ( $brand == 'marrakesh' ) {
        $categories = $marrakesh_categories; 
        $col = 4;
    }
    if ( $brand == 'hempseed' ) {
        $categories = $hempseed_categories; 
        $col = 3;
    }
    ?>
    
    <div class="row px-3 mb-3 mb-md-5 justify-content-center shop-category shop-category-<?php echo $brand; ?>">
        <?php foreach ( $categories as $category ) : ?>
            <div class="col col-12 col-md-6 col-lg-<?php echo $col ?>">
                <a href="<?php echo $category['category_url']; ?>">
                    <img src="<?php echo get_template_directory_uri() ?>/img/brand/<?php echo $brand ?>-<?php echo $category['category_name'] ?>.jpg" alt="<?php echo $category['category_name'] ?> | Shop Earthly Body" />
                    <p class="mt-0 text-center"><?php echo $category['category_name'] ?></p>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php endif; ?>

<div class="row justify-content-center brand-featured brand-featured-<?php echo $brand ?>">
    <h2 class="text-center mb-0 mb-lg-5">featured products</h2>
</div>

<div class="container mb-3 featured-products">
    <?php 
        $shortcode = "[products category='". $this_cat ."' columns='4' limit='4' visibility='featured']";
        echo do_shortcode( $shortcode ); 
    ?>
</div>

<div class="container my-5">
    <div class="row justify-content-center px-3 icons-row">
        <div class="col p-3 text-center">
            <img src="<?php echo get_template_directory_uri() ?>/img/site/Icon-CrueltyFree.svg" alt="Cruelty Free & Vegan| Shop Earthly Body" width="100" height="100"/>
            <p>Cruelty-Free & 100% Vegan</p>
        </div>
        <div class="col text-center p-3">
            <img src="<?php echo get_template_directory_uri() ?>/img/site/Icon-Solar.svg" alt="Solar Powered Energy | Shop Earthly Body" width="100" height="100" />
            <p>Made with Solar Powered Energy</p>
        </div>
        <div class="col text-center p-3">
            <img src="<?php echo get_template_directory_uri() ?>/img/site/Icon-Natural.svg" alt="Naturally-Derived Ingredients | Shop Earthly Body" width="100" height="100" />
            <p>Natually-Derived Ingredients</p>
        </div>
        <div class="col text-center p-3">
            <img src="<?php echo get_template_directory_uri() ?>/img/site/Icon-Charity.svg" alt="Contribute to Nonprofit | Shop Earthly Body" width="100" height="100" />
            <p>A Portion of Every Sale is Donated to our Nonprofit</p>
        </div>
        <div class="col text-center p-3">
            <img src="<?php echo get_template_directory_uri() ?>/img/site/Icon-Pollution.jpg" alt="Plastic Poluttion Coalition | Shop Earthly Body" width="100" height="100" />
            <p>Member of Plastic Pollution Coalition</p>
        </div>
    </div>
</div>
