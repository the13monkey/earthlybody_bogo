<?php 

/*
** Template Name: WooCommerce My Account
** Note: change layouts of woocommerce my account login/register/dashboard ect. 
*/

get_header();
get_header('home');

?>

<div class="container mt-0 mt-md-5 pt-2 pb-5" id="account-page">

    <?php 

        if(have_posts()) : while(have_posts()) : the_post();
            the_content();
        endwhile; else: endif;

    ?>

</div>

<?php get_footer(); ?>