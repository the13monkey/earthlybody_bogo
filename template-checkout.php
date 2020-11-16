<?php 

/*
** Template Name: WooCommerce Checkout
** Note: change layouts of WooCommerce checkout page
*/

get_header();
get_header('home');

?>

<div class="container mt-3 mt-lg-5 mb-5 pb-5" id="checkout-page">
    
    <div class="row row justify-content-center my-3">

        <?php if ( is_checkout() && !empty( $wp->query_vars['order-received'] ) ) : ?>
            <a href="<?php echo get_site_url() ?>" id="checkout-back-to-bag">← Back to Home</a>
            <h1 class="mt-5 mt-md-0">Thank you!</h1>
        <?php else : ?>
            <a href="<?php echo wc_get_cart_url() ?>" id="checkout-back-to-bag">← Back to Shopping Bag</a>
            <h1 class="mt-5 mt-md-0">Checkout</h1>
        <?php endif; ?>

    </div>

    <?php 

        if(have_posts()) : while(have_posts()) : the_post();
            the_content();
        endwhile; else: endif;

    ?>

</div>


<?php get_footer() ; ?>