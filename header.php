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
            $title_output = $page_title; 
        } else {
            $title_output = $site_title; 
        }
        echo $title_output; 
    ?>
    </title>
    
    <?php wp_head(); ?>
    
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5TH9DWC');</script>
    <!-- End Google Tag Manager -->
	
	<!-- Global site tag (gtag.js) - Google Analytics | 2nd to the Last line from AJ GAds Account | The Last Line from Dinah GAds Account-->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-137898394-4"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-137898394-4');
	</script>
	
	<!-- Global site tag (gtag.js) - Google Analytics AJ Ads? -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-179074058-1">
	</script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-179074058-1');
	</script>
	
	<!-- Global site tag (gtag.js) - Google Ads: 577014155 | Last line for AJ GAds Account-->
	<script async src="https://www.googletagmanager.com/gtag/js?id=AW-577014155"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'AW-577014155');
	  gtag('config', 'AW-581990469');
	  gtag('config', 'AW-578853716'); 
	</script>

	<meta name="google-site-verification" content="eWq0tjK7MxSO0bs64lBy7aCOpVv_xFk2H6BzpcjkY38" /> 	
	
	<!-- Facebook Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '975935092922711');
	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=975935092922711&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->
	
</head>

<body <?php body_class(); ?>>
    
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5TH9DWC"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
	
    <div class="w-100 bg-brown">
        
        <!-- browse all brands, only show on small screens, .browse-brands-nav --> 
        <div class="container-fluid p-3 d-block d-md-none browse-brands-nav">
            <a href="<?php echo get_site_url() ?>" class="text-white mr-2">Home | </a>
            <a href="#" class="text-white" id="browse">Browse Earthly Body Brands</a>
            <img src="<?php echo get_template_directory_uri() ?>/img/sort-up-white.svg" width="auto" height="8" alt="Expand | Shop Eearthly Body" class="mt-1 ml-1" />
        </div>

        <!-- all brands logos + back to home --> 
        <div class="brands-list pl-lg-2">
            <a href="<?php echo get_site_url() ?>" class="d-none d-md-inline-block">
                <img src="<?php echo get_template_directory_uri() ?>/img/header/homelogo.png" alt="Home | Shop Earthly Body" />
            </a>
            <a href="<?php echo get_site_url() ?>/cbddaily/">
                <img src="<?php echo get_template_directory_uri() ?>/img/header/cbddailylogo.png" alt="CBD Daily Products | Shop Earthly Body" />
            </a>
            <a href="<?php echo get_site_url() ?>/marrakesh/">
                <img src="<?php echo get_template_directory_uri() ?>/img/header/marrakeshlogo.png" alt="Marrakesh Hair Care | Shop Earthly Body" />
            </a>
            <a href="<?php echo get_site_url() ?>/emera/">
                <img src="<?php echo get_template_directory_uri() ?>/img/header/emeralogo.png" alt="EMERA CBD Hair Care | Shop Earthly Body" />
            </a>
            <a href="<?php echo get_site_url() ?>/hempseed/">
                <img src="<?php echo get_template_directory_uri() ?>/img/header/hempseedlogo.png" alt="Hemp Seed Body Care | Shop Earthly Body" />
            </a>
            <a href="https://fleurtiva.com/" target="_blank">
                <img src="<?php echo get_template_directory_uri() ?>/img/header/fleurtivalogo.png" alt="Fleurtiva Hemp Drops | Shop Earthly Body" />
            </a>
			<a href="https://chosenbydogscbd.com/" target="_blank">
                <img src="<?php echo get_template_directory_uri() ?>/img/header/chosenbydogs_logo3.svg" alt="Chosen Byd Dogs Pet CBD | Shop Earthly Body"/>
            </a>
        </div>

        <div class="account-shopping d-none d-lg-block pb-3" <?php 
                                                                if ( is_user_logged_in() ) {
                                                                    global $current_user; 
                                                                    if ( in_array( 'administrator', (array) $current_user->roles ) ) {
                                                                        echo 'style="margin-top: 2rem;"';
                                                                    }
                                                                } 
                                                              ?>>
            <a class="text-white mr-3">Call 1-877-EB4-HEMP</a>
            <?php if ( is_user_logged_in() ) : ?>
                <?php global $current_user;
                        $username = $current_user->user_login; ?>
                <a href="#" id="my-account" class="text-white">Welcome back, <?php echo $username; ?>!</a>
                <div id="myaccount-dropdown" class="py-3">
                    <a class="text-white" href="<?php echo wc_get_page_permalink('myaccount'); ?>">My account</a>
                    <a class="text-white" href="<?php echo wc_logout_url(); ?>">Log out</a>
                </div>
            <?php else: ?>
                <a class="text-white" href="<?php echo wc_get_page_permalink('myaccount'); ?>">My Account / Join</a>
            <?php endif; ?>
            <a id="shopping-bag" href="#">
                <img src="<?php echo get_template_directory_uri() ?>/img/shopping-bag-white.svg" alt="Shop Earthly Body" width="auto" height="18" />
				<span class="cart-items-count">
					<?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>
				</span>
            </a>
        </div>

    </div>

    <?php do_shortcode('[my-store-notice]'); ?>

    <div class="mobile-account-shopping d-block d-lg-none p-3 text-center">
        <?php if ( is_user_logged_in() ) : ?>
            <?php global $current_user;
                        $username = $current_user->user_login; ?>
            <a href="#" id="my-account" class="text-brown">Welcome back, <?php echo $username; ?>!</a>
            <div id="myaccount-dropdown">
                <a class="text-brown" href="<?php echo wc_get_page_permalink('myaccount'); ?>">My account</a>
                <a class="text-brown" href="<?php echo wc_logout_url(); ?>">Log out</a>
            </div>
        <?php else: ?>
            <a class="text-brown" href="<?php echo wc_get_page_permalink('myaccount'); ?>">My Account / Join</a>
        <?php endif; ?>
    </div>

    <script type="text/javascript">

        jQuery( document ).ready( function($){
            $( '.browse-brands-nav #browse' ).click( function(e){
                e.preventDefault();
                $( '.brands-list' ).slideToggle();
                if ( $( '.browse-brands-nav .rotateback' ).length ) {
                    $( '.browse-brands-nav img' ).removeClass( 'rotateback' );
                } else {
                    $( '.browse-brands-nav img' ).addClass( 'rotateback' );
                }
            } );
            $( '.account-shopping #my-account' ).click( function(e){
                e.preventDefault();
                $('.account-shopping #myaccount-dropdown').slideToggle();
                if ( $('.account-shopping .myaccountopened').length ) {
                    $(this).removeClass('myaccountopened');
                } else {
                    $(this).addClass('myaccountopened');
                }
            } );
        } );

    </script>


    