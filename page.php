<?php 
	
	if ( is_page( array( 
		
						'Hemp Products', 
						'Intensive Cream Triple Strength 8oz', 
						'Intensive Cream Triple Strength 1.7oz', 
						'Hemp Nature Fix Kit', 
						'Ultra Care Products',
						'Ultra Care Cuticle Oil',
						'Ultra Care Hand Body Lotion',
						'Ultra Care Hand Wash',
						'Ultra Care Foot Cream',
						'Shop for Pets',
		
						) ) ) {
		
		get_header('hemp');
		
		if(have_posts()) : while(have_posts()) : the_post();
			the_content();
		endwhile; else: endif; 
		
		get_footer('hemp');
		
	} elseif( is_page( 'EMERA Landing Page' ) ) {
		
		get_header('emeralandingpage');
		
		if(have_posts()) : while(have_posts()) : the_post();
			the_content();
		endwhile; else: endif; 
		
		get_footer('emeralandingpage');
		
	} else {
		
		get_header(); 
		get_header('home');
    
		if(have_posts()) : while(have_posts()) : the_post();
			the_content();
		endwhile; else: endif; 
    
    	get_footer(); 
		
	}

    