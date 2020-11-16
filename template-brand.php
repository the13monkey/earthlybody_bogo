<?php 
/*
** Template Name: EBM Single Brand Page
*/
    get_header();

    $url = $_SERVER['REQUEST_URI'];
    $brand_name = explode( "/", $url );
    $brand = $brand_name[1]; //Change in live site. 
    
    if ( !empty ( $brand ) ) {
        get_template_part( 'template-parts/content', 'brand' );
    } else {
        get_template_part( 'template-parts/content', 'home' );
    } 

    get_footer();
?>

