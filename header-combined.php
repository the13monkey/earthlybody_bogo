<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
    <?php 
        $page_title = wp_title( '', false ); 
        $site_title = get_bloginfo( 'title' );
        if ( !empty ( $page_title ) ) {
            $title_output = $page_title. ' | ' .$site_title; 
        } else {
            $title_output = $site_title; 
        }
        echo $title_output; 
    ?>
    </title>

    <?php wp_head(); ?>

    <!-- All the analytics --><!-- End of all the anlytics -->
</head>

<body <?php body_class(); ?>>
    <div class="d-flex justify-content-center justify-content-lg-between align-items-center bg-brown">
        <ul class="nav d-flex justify-content-center my-0 pl-0" id="brands-nav">
            <li class="nav-item">
                <a class="nav-link d-block p-1" href="<?php echo get_site_url() ?>/cbddaily">
                    <img src="<?php echo get_template_directory_uri() ?>/img/site/cbddailylogo_new.png" alt="Shop Earthly Body"/>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-block p-1" href="<?php echo get_site_url() ?>/marrakesh">
                    <img src="<?php echo get_template_directory_uri() ?>/img/site/marrakeshlogo_new.png" alt="Shop Earthly Body"/>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-block p-1" href="<?php echo get_site_url() ?>/emera">
                    <img src="<?php echo get_template_directory_uri() ?>/img/site/emeralogo_new.png" alt="Shop Earthly Body"/>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-block p-1" href="<?php echo get_site_url() ?>/hempseed">
                    <img src="<?php echo get_template_directory_uri() ?>/img/site/hempseedlogo_new.png" alt="Shop Earthly Body"/>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-block p-1" href="<?php echo get_site_url() ?>/shop/fleurtiva-hemp-cbd-drops/fleurtiva-hemp-cbd-drops/">
                    <img src="<?php echo get_template_directory_uri() ?>/img/site/fleurtivalogo_new.png" alt="Shop Earthly Body"/>
                </a>
            </li>
        </ul>
        <ul class="nav d-none d-md-flex align-items-center my-0 px-3">
            <li class="nav-item">
                <a class="nav-link d-block p-1">
                    <span class="text-white">Call 1-877-EB4-HEMP</span> 
                </a>
            </li>
            <li class="nav-item px-4" id="my-account">
                <?php if ( is_user_logged_in() ) { 
                        global $current_user;
                        $username = $current_user->user_login; 
                    ?>
                    <a class="nav-link d-block px-1" href="#">
                        <span class="text-white">Welcome back, <?php echo $username; ?>!</span>
                    </a>
                    <div id="myaccount-dropdown" class="box-shadow mt-0 text-center bg-transparent">
                        <a class="d-block text-white py-2 px-4" href="<?php echo wc_get_page_permalink('myaccount'); ?>">My account</a>
                        <a class="d-block text-white py-2 px-4" href="<?php echo wc_logout_url(); ?>">Log out</a>
                    </div>
                <?php } else { ?>
                    <a class="nav-link d-block p-1" href="<?php echo wc_get_page_permalink('myaccount'); ?>">
                        <span class="text-white">My Account / Join</span>
                    </a>
                <?php } ?>
            </li>
            <li class="nav-item">
                <a class="nav-link d-block p-1" href="<?php echo wc_get_cart_url() ?>" id="shopping-bag">
                    <img src="<?php echo get_template_directory_uri() ?>/img/shopping-bag-white.svg" alt="Shop Earthly Body" width="auto" height="20"/>
                </a>
            </li>
        </ul>
    </div>

    <?php do_shortcode('[my-store-notice]'); ?>

    <style type="text/css">
#main-logo-wrapper img {
    height: 3rem; 
}
#main-logo-wrapper span,
.menu-primary-menu-container .menu-item a {
    text-transform: uppercase;
}
#main-logo-wrapper span, 
.menu-primary-menu-container .menu-item a {
    font-size: 0.9rem;
}
#main-logo-wrapper span {
    font-family:'Oswald', sans-serif; 
    font-weight: 700;
}
#main-logo-wrapper * {
    display: block; 
    text-align: center; 
}
.menu-primary-menu-container {
    margin: 1rem .25rem; 
}
.menu-primary-menu-container .menu-item { 
    padding: 0.5rem 0rem; 
    border-bottom: 1px solid #333;
}
.menu-primary-menu-container .menu-item a {
    color: #666666; 
    font-weight: 500; 
    letter-spacing: 2px; 
}
.menu-primary-menu-container .menu-item a:hover,
.menu-primary-menu-container .menu-item a:focus {
    color: #333; 
}        
@media screen and (min-width: 768px) {
    #main-logo-wrapper img {
        height: 4rem; 
    }
    #main-logo-wrapper * {
        display: inline-block; 
        vertical-align: middle; 
    }
    .menu-primary-menu-container {
        margin: 1rem .25rem; 
    }
    .menu-primary-menu-container .menu-item {
        border-bottom: none; 
        padding: 0.5rem;
    }
    .menu-primary-menu-container .menu-item a {
        letter-spacing: 0;
    }
    #top-product-search {
        margin-bottom: 1rem; 
    }
    #top-product-search input {
        width: 600px; 
    }    
}
@media screen and (min-width: 1200px) {
    #top-product-search {
        margin-bottom: 0; 
    }
    #top-product-search input {
        width: 10rem; 
    }
}
@media screen and (min-width: 1440px) {
    #top-product-search input {
        width: 20rem; 
    }
    .menu-primary-menu-container .menu-item a {
        letter-spacing: 1px; 
        padding: 0.25rem 0.5rem; 
    }
}
</style>

<div class="d-flex justify-content-between justify-content-md-center justify-content-xl-between align-items-center p-3" style="border-bottom: 1px solid #efefef;">
    <div class="d-flex align-items-center d-md-none" id="mobile-menu">
        <img src="<?php echo get_template_directory_uri() ?>/img/bars.svg" alt="Shop Earthly Body" />
    </div> 

    <div id="main-logo-wrapper">
        <a href="<?php echo get_site_url() ?>" >
            <img src="<?php echo get_template_directory_uri() ?>/img/site/eb_logo_brown.svg" alt="Shop Earthly Body"/>
            <span class="text-brown spaced-out">Marketplace</span>
        </a>
    </div>
    
    <div class="d-none d-md-block">
        <?php 
            wp_nav_menu (
                array (
                    'theme_location' => 'primary-menu',
                    'menu_class' => 'nav d-none d-md-flex mb-0'
                )
            )
        ?>
    </div>

    <div id="top-product-search" class="d-none d-md-flex align-items-center">
        <?php get_product_search_form(); ?>
    </div>

    <div class="d-flex align-items-center d-md-none" id="mobile-shopping-bag">
        <a href="<?php echo wc_get_cart_url() ?>">
            <img src="<?php echo get_template_directory_uri() ?>/img/shopping-bag-brown.svg" alt="Shop Earthly Body" />
        </a>
    </div>
</div>

<div class="d-block py-3 pl-3 pr-5" id="mobile-menu-wrapper">
    <div id="top-product-search" class="d-md-flex align-items-center">
        <?php get_product_search_form(); ?>
    </div>
    <h4 class="mb-0 pb-0 ml-1">Shop by Category</h4>
        <?php 
            wp_nav_menu (
                array (
                    'theme_location' => 'primary-menu',
                    'menu_class' => 'nav flex-column'
                )
            )
        ?>
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
</script>

    

    