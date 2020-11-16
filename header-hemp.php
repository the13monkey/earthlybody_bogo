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
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-137898394-4"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-137898394-4');
	  gtag('config', 'AW-578853716'); /* Dinah GAds */
	</script>
	
	<!-- Global site tag (gtag.js) - Google Ads: 577014155 -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=AW-577014155"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'AW-577014155');
	  
	</script>

	
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
	
	<meta name="google-site-verification" content="eWq0tjK7MxSO0bs64lBy7aCOpVv_xFk2H6BzpcjkY38" /> 
	
	<script type="text/javascript">
	  (function() {
		window._pa = window._pa || {};
		// _pa.orderId = "myOrderId"; // OPTIONAL: attach unique conversion identifier to conversions
		// _pa.revenue = "19.99"; // OPTIONAL: attach dynamic purchase values to conversions
		// _pa.productId = "myProductId"; // OPTIONAL: Include product ID for use with dynamic ads

		var pa = document.createElement('script'); pa.type = 'text/javascript'; pa.async = true;
		pa.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + "//tag.perfectaudience.com/serve/5f8db4dd1cb06922350000c6.js";
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(pa, s);
	  })();
	</script>
	
</head>

<body <?php body_class(); ?>>
	
	<div class="container-fluid text-center">
		
		<?php if ( !is_page('Shop for Pets') ) : ?>
		<div class="row justify-content-center py-3" style="background: #c00001; color: #fff;">
			Free Shipping for Orders Over $30 | Only valid for the continental United States.
		</div>
		<?php endif; ?>
		
		<div class="row justify-content-center mt-3">
			<?php if ( is_page('Shop for Pets') ) : ?>
				<a href="https://chosenbydogscbd.com/shop/?utm_source=Spokes&utm_medium=ppc&utm_campaign=chosen_by_dogs">
					<img src="<?php echo get_template_directory_uri() ?>/img/site/eb_logo_brown.svg" alt="Shop Earthly Body" width="auto" height="80" />
				</a>
			<?php else: ?>
				<a href="https://shop.earthlybody.com/cbd-daily-products/shop-by-product-cbd-daily-products/?orderby=price-desc">
					<img src="<?php echo get_template_directory_uri() ?>/img/site/eb_logo_brown.svg" alt="Shop Earthly Body" width="auto" height="80" />
				</a>
			<?php endif; ?>	

		</div>
		
	</div>