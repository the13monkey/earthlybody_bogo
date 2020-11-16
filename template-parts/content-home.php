<?php get_header('home') ?>

<div class="container-fluid" id="home-banner-container">
    <div class="row">
        <div class="col col-12 col-md-6 col-lg-3 mb-3">
            <a href="<?php echo get_site_url() ?>/marrakesh/">
                <img src="<?php echo get_template_directory_uri() ?>/img/home/marrakesh1.jpg" alt="Marrakesh Hair Care | Shop Earthly Body" />
                <div class="p-3 text-center">
                    <h2 class="my-0 pt-3">Marrakesh</h2>
                    <p class="mt-1">professional hair care</p>
                </div>
            </a> 
        </div>
        <div class="col col-12 col-md-6 col-lg-3 mb-3">
            <a href="<?php echo get_site_url() ?>/hempseed/">
                <img src="<?php echo get_template_directory_uri() ?>/img/home/home-hempseed1.jpg" alt="Hemp Seed Body Care | Shop Earthly Body" />
                <div class="p-3 text-center">
                    <h2 class="my-0 pt-3">Hemp Seed</h2>
                    <p class="mt-1">natural hemp body care</p>
                </div>
            </a> 
        </div>
        <div class="col col-12 col-md-6 col-lg-3 mb-3">
            <a href="<?php echo get_site_url() ?>/cbddaily/">
                <img src="<?php echo get_template_directory_uri() ?>/img/home/home-cbddaily1.jpg" alt="CBD Daily Products | Shop Earthly Body" />
                <div class="p-3 text-center">
                    <h2 class="my-0 pt-3">CBD Daily</h2>
                    <p class="mt-1 mt-xl-3">topical cbd relief</p>
                </div>
            </a>
        </div>
        <div class="col col-12 col-md-6 col-lg-3 mb-3">
            <a href="<?php echo get_site_url() ?>/emera/">
                <img src="<?php echo get_template_directory_uri() ?>/img/home/home-emera1.jpg" alt="EMERA CBD Hair Care | Shop Earthly Body" />
                <div class="p-3 text-center">
                    <h2 class="my-0 pt-3">EMERA</h2>
                    <p class="mt-1">cbd hair care</p>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="container" id="home-new-arrivals">
    <div class="row justify-content-center">
        <h1 class="mb-3 text-brown">New Arrivals</h1>
    </div>
    
    <!-- two row carousel - desktop -->
    <div class="row products columns-4 d-lg-flex" id="firstrow">
    <?php
		$args = array(
			'post_type' => 'product',
            'posts_per_page' => 4,
            'column' => 4,
            'order' => 'DESC',
			);
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
				wc_get_template_part( 'content', 'product' );
			endwhile;
		} else {
			echo __( 'No products found' );
		}
		wp_reset_postdata();
	?>
    </div>

    <div class="row d-none d-lg-block" id="row-arrows">
        <button id="firstrowbtn" onclick="firstrow()" class="bg-brown text-white p-3 box-shadow">&larr;</button>
        <button id="nextrowbtn" onclick="nextrow()" class="bg-brown text-white p-3 box-shadow">&rarr;</button>
    </div>

    <div class="row products columns-4 d-lg-flex" id="nextrow">
    <?php
		$args = array(
			'post_type' => 'product',
            'posts_per_page' => 4,
            'column' => 4,
            'order' => 'DESC',
            'offset' => 4,
			);
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
				wc_get_template_part( 'content', 'product' );
			endwhile;
		} else {
			echo __( 'No products found' );
		}
		wp_reset_postdata();
	?>
    </div>
    <!-- two row carousel - desktop ends --> 

</div>

<!-- Show Slider Revolution -->

<div class="container box-shadow" id="home-email-wrapper">

    <div class="row">
        
		<!-- Hemp Seed and Emera product cutout photos -->

        <div class="col col-12 text-center">
            <h2 class="text-white mb-0">save 25%</h2>
            <p class="text-white">Sign up for our Mailing List</p>
            <div>
                <a href="https://visitor.r20.constantcontact.com/d.jsp?llr=kqwzkfcab&p=oi&m=kqwzkfcab&sit=4maqedwcb&f=4be824e6-1700-4621-b6b3-e1d6e8cea0a0" target="_blank" class="bg-white text-brown p-3">Save on your next order ></a>
            </div>
        </div>

        <div class="w-100">
            <img data-src="<?php echo get_template_directory_uri() ?>/img/home/mk.png" id="marrakesh" class="lazy" alt="Shop Earthly Body" style="display:none"/>
            <img data-src="<?php echo get_template_directory_uri() ?>/img/home/cbd.png" id="cbd" class="lazy" alt="Shop Earthly Body" style="display:none"/>
        </div>

    </div>

</div>

<div class="container my-5" id="home-icons-wrapper">
    
    <div class="row justify-content-center">
        <h3>We are earth-friendly</h3>
    </div>

    <div class="row justify-content-center p-3"> 
        <div class="col text-center p-3">
            <img data-src="<?php echo get_template_directory_uri() ?>/img/site/Icon-CrueltyFree.svg" alt="Shop Earthly Body" width="100" height="100" class="lazy" style="display:none"/>
            <p>Cruelty-Free & 100% Vegan</p>
        </div>
        <div class="col text-center p-3">
            <img data-src="<?php echo get_template_directory_uri() ?>/img/site/Icon-Solar.svg" alt="Shop Earthly Body" width="100" height="100" class="lazy" style="display:none" />
            <p>Made with Solar Powered Energy</p>
        </div>
        <div class="col text-center p-3">
            <img data-src="<?php echo get_template_directory_uri() ?>/img/site/Icon-Natural.svg" alt="Shop Earthly Body" width="100" height="100" class="lazy" style="display:none" />
			<p>Naturally-Derived Ingredients</p>
        </div>
        <div class="col text-center p-3">
            <img data-src="<?php echo get_template_directory_uri() ?>/img/site/Icon-Charity.svg" alt="Shop Earthly Body" width="100" height="100" class="lazy" style="display:none" />
            <p>A Portion of Every Sale is Donated to our Nonprofit</p>
        </div>
        <div class="col text-center p-3">
            <img data-src="<?php echo get_template_directory_uri() ?>/img/site/Icon-Pollution.jpg" alt="Shop Earthly Body" width="100" height="100" class="lazy" style="display:none" />
            <p>Member of Plastic Pollution Coalition</p>
        </div>
    </div>

</div> 


<script type="text/javascript">    
//animation - new arrival section 
function nextrow ()
{
    var firstrow = document.getElementById('firstrow');
    var nextrow = document.getElementById('nextrow');
    var buttonhide = document.getElementById('nextrowbtn');
    var buttonshow = document.getElementById('firstrowbtn');
    nextrow.classList.add('slideInLeft');
    buttonhide.style.display = "none";
    buttonshow.style.display = "block";
}
function firstrow ()
{
    var firstrow = document.getElementById('firstrow');
    var nextrow = document.getElementById('nextrow');
    var buttonhide = document.getElementById('firstrowbtn');
    var buttonshow = document.getElementById('nextrowbtn');
    nextrow.classList.remove('slideInLeft');
    firstrow.classList.remove('slideOutRight');
    buttonhide.style.display = "none";
    buttonshow.style.display = "block";
}
</script>
