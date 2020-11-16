<?php 

/*
** Template Name: WooCommerce Cart
** Note: change the general style of woocommerce cart page
*/

get_header();
get_header('home'); 

?>

<div class="container">

    <div class="row justify-content-center my-3">
        <h1>Shopping Bag</h1>
    </div>

    <?php 
        
        if(have_posts()) : while(have_posts()) : the_post();
            the_content();
        endwhile; else: endif;

    ?>

</div>


<?php get_footer(); ?>
