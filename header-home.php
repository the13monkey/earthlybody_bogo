<div class="w-100 bg-white p-3 home-top-navbar">

    <!-- mobile menu open trigger and menu wrapper, hide from md and above -->
    <a href="#" id="mobile-menu" class="d-block d-lg-none">
        <img src="<?php echo get_template_directory_uri() ?>/img/bars.svg" alt="Shop Earthly Body" />
    </a>
    
    <!-- shopping bag on mobile phones --> 
    <a id="mobile-shopping-bag" href="#" class="d-block d-lg-none">
        <img src="<?php echo get_template_directory_uri() ?>/img/shopping-bag-brown.svg" alt="Shop Earthly Body" width="auto" height="18" />
		<span class="cart-items-count">
					<?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>
				</span>
    </a>

    <!-- EB marketplace logo -->
    <div class="d-block" id="main-logo-wrapper">
        <a href="<?php echo get_site_url() ?>" >
            <img src="<?php echo get_template_directory_uri() ?>/img/site/eb_logo_brown.svg" alt="Shop Earthly Body"/>
            <h5 class="text-brown my-0">marketplace</h5>
        </a>
    </div>

    <!-- top menu, hide from mobile --> 
    <div class="site-top-nav d-none">
    <?php 
        wp_nav_menu (
            array (
                'theme_location' => 'primary-menu',
                'menu_class' => 'nav'
            )
        )
    ?>
    </div>

    <div class="d-none" id="lg-desktop">
       <button class="bg-white ml-3">
           <img src="<?php echo get_template_directory_uri() ?>/img/search_eb.svg" alt="Shop Earthly Body" />
       </button>         
    </div>

    <div class="d-none d-xl-inline-block bg-white" id="xl-search">
        <?php get_product_search_form(); ?>
    </div>

</div>

<div id="mobile-menu-wrapper" class="d-block w-100 p-3">
    <div id="top-product-search">
        <?php get_product_search_form(); ?>
    </div>
    <h4>Shop by Category</h4>
    <?php 
        wp_nav_menu (
            array (
                'theme_location' => 'primary-menu',
                'menu_class' => 'nav'
            )
        )
    ?>
    <span id="close-mobile-menu">
        <img src="<?php echo get_template_directory_uri() ?>/img/close.svg" alt="Shop Earthly Body">
    </span>
</div>

<div id="lg-desktop-search" class="w-100 bg-white box-shadow">
    <button class="bg-white box-shadow p-1" id="close-btn">Close</button>
    <?php get_product_search_form(); ?>
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

//Toggle slide up and down for submenus in the mobile menu 
jQuery( document ).ready( function($) {
    $( '#mobile-menu-wrapper .menu-item-has-children' ).click( function(e){
        $( this ).find( '.sub-menu' ).slideToggle();
        $( this ).toggleClass( 'arrowup' );
    } );
    $( '#lg-desktop button' ).click( function(){
        $( '#lg-desktop-search' ).slideDown();
    } );
    $( '#lg-desktop-search #close-btn' ).click( function(){
        $( '#lg-desktop-search' ).slideUp();
    } );
} );
</script>
