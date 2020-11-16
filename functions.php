<?php 

/**
 * Theme Setup Dinah
 */

function my_login_logo() { // Change WP login logo
    ?> 
        <style type="text/css"> 
            body.login div#login h1 a {
                background-image: url(https://shop.earthlybody.com/wp-content/themes/ebmarketplace/img/site/ebshop_icon.svg);  
                background-size: 60px 60px; 
            } 
        </style>
    <?php 
} 
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function add_theme_scripts () { // Load theme styles to <head>
    
    wp_enqueue_style( 'header', get_template_directory_uri() . '/css/global/header.css', false, '', 'all' );// header.css = brands navigation + woo store notice

    if ( is_front_page() || is_shop() || is_cart() || is_checkout() || is_account_page() || is_product_tag() || is_page() ) {
        wp_enqueue_style( 'home-header', get_template_directory_uri() . '/css/home-header.css', false, '', 'all' );
    }
    
    if ( is_page_template( 'template-brand.php' ) || is_product_category() || is_product() ) {
        wp_enqueue_style( 'brand-header', get_template_directory_uri() . '/css/brand-header.css', false, '', 'all' );
    } 
    if ( is_product_tag() || is_product_category() || is_shop() ) {
        wp_enqueue_style( 'category-header', get_template_directory_uri() . '/css/category-header.css', false, '', 'all' );
    }
    if ( is_product() ) {
        wp_enqueue_style( 'product-header', get_template_directory_uri() . '/css/product-header.css', false, '', 'all' );
    }
    if ( is_cart() ) {
        wp_enqueue_style( 'cart-header', get_template_directory_uri() . '/css/cart-header.css', false, '', 'all' );
    }
    if ( is_checkout() ) {
        wp_enqueue_style( 'checkout-header', get_template_directory_uri() . '/css/checkout-header.css', false, '', 'all' );
    }
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

function add_styles_to_footer () { // Load theme styls to <footer>
	
	wp_enqueue_style( 'fonts', get_template_directory_uri() . '/css/fonts.css', false, '', 'all' ); // fonts.css
	
	if ( is_front_page() ) {
        wp_enqueue_style( 'home-content', get_template_directory_uri() . '/css/home-content.css', false, '', 'all' );
    }
    if ( is_front_page() ) {
        wp_enqueue_style( 'home-footer', get_template_directory_uri() . '/css/home-footer.css', false, '', 'all' );
    }
    if ( is_product() ) {
        wp_enqueue_style( 'product-footer', get_template_directory_uri() . '/css/product-footer.css', false, '', 'all' );
        wp_enqueue_style( 'scent', get_template_directory_uri() . '/css/scent.css', false, '', 'all' );
    }
    if ( is_cart() ) {
        wp_enqueue_style( 'cart-footer', get_template_directory_uri() . '/css/cart-footer.css', false, '', 'all' );
    }
    if ( is_checkout() ) {
        wp_enqueue_style( 'checkout-footer', get_template_directory_uri() . '/css/checkout-footer.css', false, '', 'all' );
    }

    wp_enqueue_style( 'theme_style', get_template_directory_uri() . '/css/global/footer.css', false, '', 'all' ); //footer.css = <footer> eg. copyright
}
add_action( 'get_footer', 'add_styles_to_footer' );

function replace_dismiss_text( $notice ) { // Change store notice "dismiss" => "got it"
    return str_replace( 'Dismiss', 'Got it!', $notice );
}
add_filter( 'woocommerce_demo_store', 'replace_dismiss_text' );

function custom_woocommerce_demo_store() { // Customize store notice banner style
    // To Edit the text copy, (1) enable the notice from Theme>Customize, make desired changes, publish (2) disable the notice 
    $notice = get_option( 'woocommerce_demo_store_notice' );

    if ( empty( $notice ) ) {
        $notice = __( 'This is a demo store for testing purposes &mdash; no orders shall be fulfilled.', 'woocommerce' );
    }

    $notice_id = md5( $notice );

    echo apply_filters( 'woocommerce_demo_store', '<p class="woocommerce-store-notice demo_store my-0 p-3 bg-red text-white" data-notice-id="' . esc_attr( $notice_id ) . '" style="display:none;">' . wp_kses_post( $notice ) . ' <a href="#" class="woocommerce-store-notice__dismiss-link d-flex text-white">' . esc_html__( 'Dismiss', 'woocommerce' ) . '</a></p>', $notice ); // WPCS: XSS ok.
}
add_shortcode( 'my-store-notice', 'custom_woocommerce_demo_store' );

function register_theme_menus () { // Register theme menus, only one menu: Primary Menu 
    register_nav_menus (
        array (
            'primary-menu' => __( 'Primary Menu' ),
        )
    );
}
add_action( 'init', 'register_theme_menus' );

function woocommerce_theme_setup () { // Set WooCommerce theme support: remove WooCommerce default CSS
    add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-slider' );
    add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
}
add_action( 'after_setup_theme', 'woocommerce_theme_setup' );

/**
 * 13 Monkey Lazy Load
 */
function my_lazy_load() {
	if ( is_front_page() ) : ?>
	
	<script type="text/javascript">
		jQuery(document).ready(function($){
			
			//Create an "inView" function to test whether an element is in the viewpoint
			$.fn.inView = function(){
				var viewTop = $(this).offset().top;
				var viewBottom = viewTop + $(this).outerHeight();
				var windowTop = $(window).scrollTop();
				var windowBottom = windowTop + $(window).height();
				return viewBottom > windowTop && viewTop < windowBottom;
  			};
			
			var wooimages = $('#home-new-arrivals #nextrow .content-product-wrapper .attachment-woocommerce_thumbnail');
			wooimages.each( function(){
				var src = $(this).attr('src');
				$(this).attr('data-src', src);
				$(this).attr('src', '');
				$(this).attr('srcset', '');
				$(this).addClass('lazy');
			} );
			
			var minicartimages = $('#mini-cart-wrapper .woocommerce-mini-cart-item .attachment-woocommerce_thumbnail');
			minicartimages.each( function(){
				var src= $(this).attr('src');
				$(this).attr('data-src', src);
				$(this).attr('src', '');
				$(this).attr('srcset', '');
				$(this).addClass('lazy');
			} );
			
			/*var popupimages = $('#cross-sell-pop .content-product-wrapper .attachment-woocommerce_thumbnail');
			popupimages.each( function(){
				var src= $(this).attr('src');
				$(this).attr('data-src', src);
				$(this).attr('src', '');
				$(this).attr('srcset', '');
				$(this).addClass('lazy');
			} );*/
			
			//Call the "inView" function on scroll
			$(window).on('scroll', function(){
				$('.lazy').each(function(){
					if( $(this).inView() ) {
						var src = $(this).data('src');
						$(this).attr('src', src);
						$(this).show();
					} 
				});
			});
			
		});
	</script>

<?php endif; }
add_action( 'wp_footer', 'my_lazy_load' );

/**
 * Add Facebook Pixel Tracking from Spokes Digital
 */
function my_custom_tracking () {
?>
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
	fbq('track', 'Purchase');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=975935092922711&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->
	<!-- Event snippet for CD - Purchase - New conversion page -->
	<script>
	  gtag('event', 'conversion', {
		  'send_to': 'AW-577014155/JTRaCI213-ABEIuTkpMC',
		  'transaction_id': ''
	  });
	</script>
	<!-- Event snippet for Purchase conversion page | AJ GAds-->
	<script>
	  gtag('event', 'conversion', {
		  'send_to': 'AW-581990469/bljYCPnWguABEMXwwZUC',
		  'transaction_id': ''
	  });
	</script>

	<!-- Event snippet for Website sale conversion page | Dinah GAds -->
	<script>
	  gtag('event', 'conversion', {
		  'send_to': 'AW-578853716/DAZRCMGKi-EBENS2gpQC',
		  'transaction_id': ''
	  });
	</script>
<?php 
}
add_action( 'woocommerce_thankyou', 'my_custom_tracking' );


/**
 * Back to top button
 */ 
function back_to_top_button() {
?>
	<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#back-top').click(function(event){
			event.preventDefault();
			$('html, body').animate({scrollTop: 0}, 700);
		});
	});
	</script>
<?php 
}
add_action( 'wp_footer', 'back_to_top_button' );

/**
 * Breadcrumb
 */

function remove_quotes_from_tag_name() { // *JQUERY*: Remove quotation marks around tag name in the breadcrumb, jQuery to footer, all site
?>
<script>
	jQuery(document).ready(function($){
		var string = $('#filter-content .woocommerce-breadcrumb span').text();
		var newstring = string.replace('“', '');
		var newstring2 = newstring.replace('”', ''); //No quotations string
		var newstring3 = newstring2.replace(' ', ''); //No spacing string
		var uplevel = $('#menu-primary-menu .sub-menu li').find('a:contains('+newstring3+')').parent().parent().prev().text();
		var uplevelurl = $('#menu-primary-menu .sub-menu li').find('a:contains('+newstring3+')').parent().parent().prev().attr('href');
		//$('.woocommerce-breadcrumb span').prepend('<a href="'+ uplevelurl +'">'+ uplevel +'</a>/');
		if (uplevel !== '' && uplevel !== 'Hair Care') { //Nested, but not under Hair Care
			$('.woocommerce-breadcrumb span').text('/ '+newstring2);
			$('.woocommerce-breadcrumb span').prepend('<a href="'+uplevelurl+'">'+uplevel+'</a>');
		} else if ( uplevel == 'Hair Care' && newstring3 !== 'Hair Care' ) {
			$('.woocommerce-breadcrumb span').text('/ '+newstring2);
			$('.woocommerce-breadcrumb span').prepend('<a href="'+uplevelurl+'">'+uplevel+'</a>');
		} else {
			$('.woocommerce-breadcrumb span').text(newstring2);
		}
		//when it is page 2 or page 3 ... span becomes a 
		var last_string_arr = string.split(' ');
		if ( last_string_arr.includes('Page') ) {
			var string_p = $('#filter-content .woocommerce-breadcrumb span').prev().text();
			var newstring_p = string_p.replace('“', '');
			var newstring2_p = newstring_p.replace('”', '');
			var newstring3_p = newstring2_p.replace(' ', '');
			var newstring3_p_arr = newstring3_p.split(' ');
			var length = newstring3_p_arr.length;
			var newwords = [];
			var i;
			for (i=1; i<length; i++) {
				if (i == (length - 1)) {
					var newword = newstring3_p_arr[i];
				} else {
					var newword = newstring3_p_arr[i]+" ";
				}
			newwords.push(newword);
			}
			var newstring4 = newwords.join('');
			$('.woocommerce-breadcrumb span').prev().text(newstring4);
		}
		
	});
</script>
<?php 
}
add_action('wp_footer', 'remove_quotes_from_tag_name');



/**
 * Product loop
 */

function woocommerce_template_loop_product_title () { // Customize product title display
    echo '<h3 class="content-product-title mb-3 ' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h3>'; 
}

function woocommerce_template_loop_rating () { //Customize star rating
    global $product; 
    $average = $product->get_average_rating();
    $process = explode( '.', $average );
    $num1 = $process[0];
    $num2 = $process[1];
	$root_url = get_template_directory_uri();	
	
    if ( $num1 == 0 ) {
        $output = "Be the first to rate this product!";
        $html = '<div class="row justify-content-center my-0 py-0"><span style="font-size: 0.85rem; margin-top:0; margin-bottom: 0;">'. $output .'</span></div>';
        echo $html; 
    } else if ( $num1 == 5 ) {
        $html = '<div class="row justify-content-center my-3 py-0">';
        for ( $i = 0; $i < $num1; $i++ ) {
            $star = '<img src="'. $root_url .'/img/site/star-solid.svg" style="width: 16px; height: 16px;" alt="star-'.$i.' | Shop Earthly Body" />';
            $html .= $star; 
        }
        echo $html.'</div>'; 
    } else {
        $html = '<div class="row justify-content-center my-3 py-0">';
        $rest = 5 - $num1; 
        for ( $i = 0; $i < $num1; $i++ ) {
            $star = '<img src="'. $root_url .'/img/site/star-solid.svg" style="width: 16px; height: 16px;" alt="star-'.$i.' | Shop Earthly Body" />';
            $html .= $star; 
        }
		if ( $num2 > 50 ) {
			for ( $j = 0; $j < $rest; $j ++ ) {
            	$hollow = '<img src="'. $root_url .'/img/site/star-solid.svg" style="width: 16px; height: 16px;" alt="star-'.$i.' | Shop Earthly Body" />';
            	$html .= $hollow;
        	}
		} else if ( $num2 > 0 && $num2 <= 50 ) {
			for ( $j = 0; $j < $rest; $j ++ ) {
            	$hollow = '<img src="'. $root_url .'/img/site/star-half.svg" style="width: 16px; height: 16px;" alt="star-'.$i.' | Shop Earthly Body" />';
            	$html .= $hollow;
        	}
		} else {
			for ( $j = 0; $j < $rest; $j ++ ) {
            	$hollow = '<img src="'. $root_url .'/img/site/star-outline.svg" style="width: 16px; height: 16px;" alt="star-'.$i.' | Shop Earthly Body" />';
            	$html .= $hollow;
        	}
		}
        echo $html.'</div>';
    }
}

// Hook product link close tag after thumbnail & unhook it from woocommerce_after_shop_loop_item
function unhook_product_link_close () {
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
}
add_action( 'woocommerce_after_shop_loop_item', 'unhook_product_link_close', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 1 ); 

// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );  
function woocommerce_custom_product_add_to_cart_text() {
    return __( 'Add to Bag', 'woocommerce' );
}


function content_product_buy_now () { // add to bag and buy now buttons at content-product loop
?>
<script type="text/javascript"> //Non cart page product loop
    jQuery( document ).ready( function($) {
		
        $( '.simple-add-to-cart' ).click( function(e){
			console.log('clicked');
            var product_id = $( this ).parent().prev().data( 'product_id' );
            var product_qty = $( this ).parent().prev().parent().find( '.quantity' ).find( 'input[type="number"]' ).val();
            var product_sku = $( this ).parent().prev().data( 'product_sku' );
            var aria_label = $(this).parent().prev().attr('aria-label');
            $(this).attr({
                "data-quantity" : product_qty,
                "data-product_id" : product_id,
                "data-product_sku" : product_sku, 
                "aria-label" : aria_label,
            });
			
           setTimeout(function(){
                $('#mini-cart-wrapper').animate({right: '0px'}, 500)
            },800); 
				
        } );
		
        $( '.variable-buy-now' ).click( function(e){
            e.preventDefault();
            $( this ).parent().parent().find('.variable-buy-now-wrapper').show();
        } );
		
        $( '.variable-add-to-cart' ).click( function(e){
            e.preventDefault();
            $( this ).addClass( 'addVariable' );
            $( this ).parent().parent().find('.variable-buy-now-wrapper').show();
        } );
        $( '.close-wrapper' ).click( function(){
            $( this ).parent().parent().hide();
            $('.clicked').removeClass('clicked');
			$('button').css('opacity', '1').prop('disabled', false);
            $('.addVariable').removeClass('addVariable');
        } );
        $( 'button.option' ).click( function(){
            //$( this ).addClass( 'clicked' );
			var attrList = $(this).attr('class').split(/\s+/);
			var attrListLength = attrList.length; 
			var index = attrListLength - 1;
			var classTest = attrList[index];
			var elements = $(this).parent().find('.'+ classTest);
			elements.removeClass('clicked');
			$(this).addClass('clicked');
			
			//CBD Intensive Cream - product_id = 39
			//NO 0.5oz Lavender, 8oz Lavender - product_id = 39
			var parent_product_id = $(this).parent().parent().find('.add_to_cart_button').data('product_id');
			var click_value = $(this).data('value');
			console.log(parent_product_id);
			console.log(click_value);
			if ( (parent_product_id == 39) && (click_value == '0.5 oz') ) {
				$(this).parent().find('button[data-value="Lavender"]').css({'opacity': '0.15', 'pointer-events': 'none'});
				$(this).parent().find('button[data-value="8 oz"]').removeClass('clicked');
				$(this).parent().find('button[data-value="1.7 oz"]').removeClass('clicked');
			}
			if ( (parent_product_id == 39) && (click_value == '8 oz') ) {
				$(this).parent().find('button[data-value="Lavender"]').css({'opacity': '0.15', 'pointer-events': 'none'});
				$(this).parent().find('button[data-value="0.5 oz"]').removeClass('clicked');
				$(this).parent().find('button[data-value="1.7 oz"]').removeClass('clicked');
			}
			if ( (parent_product_id == 39) && (click_value == '1.7 oz') ) {
				$(this).parent().find('button[data-value="0.5 oz"]').removeClass('clicked');
				$(this).parent().find('button[data-value="8 oz"]').removeClass('clicked');
				$(this).parent().find('button[data-value="Lavender"]').css({'opacity': '1', 'pointer-events': 'auto'});
			}
			if ( (parent_product_id == 37) && (click_value == '0.34 fl oz') ) {
				$(this).parent().find('button[data-value="Lavender"]').css({'opacity': '0.15', 'pointer-events': 'none'});
				$(this).parent().find('button[data-value="0.67 fl oz"]').removeClass('clicked');
			}
			if ( (parent_product_id == 37) && (click_value == '0.67 fl oz') ) {
				$(this).parent().find('button[data-value="Lavender"]').css({'opacity': '1', 'pointer-events': 'auto'});
			}
			//Hemp Seed Hand & Body Lotion - product_id = 60
			//No 7oz Lavender
			if ( (parent_product_id == 60) && (click_value == '7 oz') ) {
				$(this).parent().find('button[data-value="Lavender"]').css({'opacity': '0.15', 'pointer-events': 'none'});
				$(this).parent().find('button[data-value="16 oz"]').removeClass('clicked');
			}
			if ( (parent_product_id == 60) && (click_value == '16 oz') ) {
				$(this).parent().find('button[data-value="Lavender"]').css({'opacity': '1', 'pointer-events': 'auto'});
			}
			
            var length = $( '.clicked' ).length;
            var options_num = $( this ).parent().find( '.option-label' ).length;
            var options = $( '.clicked' );
            if ( length == options_num ) {
			
                var keys = [];
                for (i=0; i<length; i++) {
                    var key = options[i]['innerText'];
                    keys.push(key);
                }
                var output = keys.join('');
                var final = output.split(' ').join('');
                var final2 = final.replace('.', '_');
                //var variation_element = $( "input#"+ final2 );
                var variation_element = $(this).parent().parent().find("input#"+ final2);
                var variation_id = variation_element.data('variation_id');
                var variation_sku = variation_element.data('variation_sku');
                var base_url = "https://shop.earthlybody.com/";
                var product_qty = $( this ).parent().prev().parent().find( '.quantity' ).find( 'input[type="number"]' ).val();
                var fakeButton = $( this ).parent().parent().find( '.fake-button' );
                var closeButton = $( this ).parent().find( '.close-wrapper' );
                if ( $( '.addVariable' ).length ) { //Add variable product to cart
                    var target_url = base_url + "/?add-to-cart=" + variation_id + "&quantity=" + product_qty; 
                    fakeButton.removeClass('product_type_variable').addClass('product_type_simple add_to_cart_button ajax_add_to_cart');
                    fakeButton.attr({
                        'data-quantity' : product_qty,
                        'data-product_id' : variation_id, 
                        'data-product_sku' : variation_sku,
                        'href' : target_url,
                    });
                    fakeButton.click();
                    closeButton.click();
                    $( this ).parent().prev().parent().find( '.quantity' ).find( 'input[type="number"]' ).val('1');
                    setTimeout( function(){
                        //$('.add-to-cart-pop').removeClass('hidden');
                        $('#mini-cart-wrapper').animate({right: '0px'}, 500);
                    }, 1000 );  
                } else { //Buy variable product now
                    var target_url = base_url + "checkout/?add-to-cart=" + variation_id + "&quantity=" + product_qty; 
                    window.location.replace( target_url ); 
                }
            } 
        } ); //Variable add to cart button ends
		$( '.add-to-cart-pop .variable-add-to-cart' ).click(function(e){
			e.preventDefault();
			setInterval( function(){
				if ( $('.add-to-cart-pop .added').length ) {
					$('.add-to-cart-pop').addClass('hidden');
					clearInterval();
				}
			}, 800 );
		});
    } );
    </script>
<?php 
}
add_action( 'wp_footer', 'content_product_buy_now' );

function variable_content_actions () { // options overlay for variable products in the content-product loop
    global $product; 
    if ( $product->is_type( 'variable' ) ) {
        $attributes = $product->get_attributes();
        $variations = $product->get_children();
        $pairs_arr = [];
        foreach ( $variations as $variation ) {
            $single_variation = new WC_Product_Variation( $variation );
            $pairs = $single_variation->get_variation_attributes();
            array_push( $pairs_arr, $pairs );
        }
        $variable_array = array_combine( $variations, $pairs_arr );
        foreach ( $variable_array as $variation_id => $combination ) {
        ?>
            <input 
                class='d-none' 
                data-variation_id='<?php echo $variation_id ?>' 
                id='<?php 
                    $values_arr = [];
                    foreach ( $combination as $key => $value ) {
                        array_push( $values_arr, $value );
                    }
                    $value_str = join("", $values_arr);
                    $value_str_1 = str_replace(' ', '', $value_str); 
                    $value_str_2 = str_replace(".", "_", $value_str_1);
                    echo $value_str_2; ?>' 
                data-variation_sku='<?php 
                    $variable_product = wc_get_product( $variation_id );
                    $variation_sku = $variable_product->get_sku();
                    echo $variation_sku; 
                    ?>'>
        <?php 
        }
 
        $html2 = "<div class='variable-buy-now-wrapper'>";
        $html2 .= "<p>Please choose an option<button class='close-wrapper'>x</button></p>";
        foreach ( $attributes as $key => $value ) {
           $html2 .= "<p class='option-label'>". $key ."</p>";
           $options = $value['options'];
           foreach ( $options as $option ) {
                $html2 .= "<button class='m-1 option ". $key ."' data-value='". $option ."'>". $option ."</button>";
           }
        }
        $html2 .= "</div>";
        echo $html2; 
    }
    
}
add_action( 'woocommerce_after_shop_loop_item', 'variable_content_actions' );



/**
 * Shop/Archive Loop
 */

function remove_breadcrumb_from_before_shop () { // Unhook breadcrumb from before shop content 
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
}
add_action( 'woocommerce_before_main_content', 'remove_breadcrumb_from_before_shop', 5 );

function custom_default_catalog_orderby() { // Change default sorting to newest
     return 'date'; // Can also use title and price
}
add_filter('woocommerce_default_catalog_orderby', 'custom_default_catalog_orderby');

function small_screen_filter_func () { // *JQUERY* Side menu nested UI - #filter-content, .category-sidebar
    if ( is_product_tag() || is_product_category() || is_shop() ) {
?>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $( '#filter-content .has-dropdown' ).click( function(e){
                e.preventDefault();
                $(this).find('.dropdown').slideToggle();
                if ( $( '#filter-content .sub-opened' ).length ) {
                    $(this).removeClass('sub-opened');
                } else {
                    $( this ).addClass('sub-opened');
                }
                $( '#filter-content .nav-item a' ).click( function(){
                    var url = $(this).attr('href');
                    window.location.replace(url);
                } );
            } );
            $( '.category-sidebar .has-dropdown' ).click( function(e){
                e.preventDefault();
                $(this).find('.dropdown').slideToggle();
                if ( $( '.category-sidebar .sub-opened' ).length ) {
                    $(this).removeClass('sub-opened');
                } else {
                    $(this).addClass('sub-opened');
                }
                $( '.category-sidebar .dropdown .nav-link' ).click( function(){
                    var url = $(this).attr('href');
                    window.location.replace(url);
                } );
            } );
			$( '.category-sidebar .menu-item-has-children' ).click( function(e){
                e.preventDefault();
                $(this).find('.sub-menu').slideToggle();
                if ( $( '.category-sidebar .sub-opened' ).length ) {
                    $(this).removeClass('sub-opened');
                } else {
                    $(this).addClass('sub-opened');
                }
                $( '.category-sidebar .sub-menu .menu-item a' ).click( function(){
                    var url = $(this).attr('href');
                    window.location.replace(url);
                } );
            } );
        });
    </script>
<?php 
    }
}
add_action( 'wp_footer', 'small_screen_filter_func' );

function bbloomer_show_sale_percentage_loop() { // Change onsale text to show discount percentage
    global $product;
    if ( ! $product->is_on_sale() ) return;
    if ( $product->is_type( 'simple' ) ) {
       $max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
    } elseif ( $product->is_type( 'variable' ) ) {
       $max_percentage = 0;
       foreach ( $product->get_children() as $child_id ) {
          $variation = wc_get_product( $child_id );
          $price = $variation->get_regular_price();
          $sale = $variation->get_sale_price();
          if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;
          if ( $percentage > $max_percentage ) {
             $max_percentage = $percentage;
          }
       }
    }
    if ( $max_percentage > 0 ) echo "<div class='sale-perc'>-" . round($max_percentage) . "%</div>"; 
}
add_action( 'woocommerce_before_shop_loop_item_title', 'bbloomer_show_sale_percentage_loop', 25 );

function unhook_woo_sidebar () { // Unhook woocommerce sidebar from archive template
    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
}
add_action( 'woocommerce_sidebar', 'unhook_woo_sidebar', 5 );

function no_dropdown_for_fragrance () {
?>
	<script>
		jQuery(document).ready(function($){
			$('.brand-nav-hempseed').find('.nav-item:nth-child(2)').removeClass('has-dropdown');
			$('.brand-nav-cbddaily').find('.nav-item:nth-child(2)').removeClass('has-dropdown');
			$('.brand-nav-emera').find('.nav-item:nth-child(2)').removeClass('has-dropdown');
			$('.brand-nav-marrakesh').find('.nav-item:nth-child(2)').removeClass('has-dropdown');
		});
	</script>
<?php 
}
//add_action( 'wp_footer', 'no_dropdown_for_fragrance' );

/**
 * Single product page 
 */

// Hook woocommerce breadcrumb to woocommerce_before_single_product_summary - 5
//add_action( 'woocommerce_before_single_product_summary', 'woocommerce_breadcrumb', 5 );
add_action( 'woocommerce_before_single_product_summary', 'my_yoast_breadcrumb', 5 );
function my_yoast_breadcrumb () {
	if ( is_product() ) {
		if ( function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb( '<p id="breadcrumb">','</p>' );
		}
	}
}

// Remove cross-sells/related products output
function remove_related_products_output () {
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}
add_action( 'woocommerce_after_single_product_summary', 'remove_related_products_output', 10 );

function remove_sale_image_from_before_product () { // Move single product sale & image to summary not before_single_product_summray
    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
}
add_action( 'woocommerce_before_single_product_summary', 'remove_sale_image_from_before_product', 1 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash', 1 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_images', 1 );

function single_product_page_add_to_cart () { // single product add-to-cart area scripts
?>
    <script type="text/javascript">
        jQuery( document ).ready( function($) {
			$( '.explore-scents' ).click( function(event){
				event.preventDefault();
				$( '.woocommerce-tabs li[role="tab"]' ).removeClass('active');
				$( 'li.explore-our-scents_tab' ).addClass('active'); 
				$( '.woocommerce-Tabs-panel' ).hide();
				$( '.woocommerce-Tabs-panel#tab-explore-our-scents' ).show();
				$("html, body").animate({ // catch the `html, body`
        			scrollTop: $('.woocommerce-tabs').offset().top - 200 
    				}, 1000); 
				} );
			
            $( '.single_simple_buy_now_button' ).click( function(event){
                event.preventDefault();
                var base_url = "https://shop.earthlybody.com/";
                var product_id = $( this ).attr('value');
                var product_qty = $( this ).parent().find( '.quantity' ).find( 'input[type="number"]' ).val();
                var target_url = base_url + "checkout/?add-to-cart=" + product_id + "&quantity=" + product_qty; 
                window.location.replace( target_url );
            } );

            $('.size-option').click( function(event){
                event.preventDefault();
				$('.size-option').removeClass('outlined').css({'opacity': '0.15', 'pointer-events': 'none'});
                $(this).addClass('outlined');
				$('.outlined').css({'opacity': '1', 'pointer-events': 'auto'});
                var sizevalue = $(this).data('value');
                var selectid = $(this).data('attribute_name');
                var id = selectid.toLowerCase();
                var selectel = '#'+id;
                $(selectel).val(sizevalue).change();
            } );

            $('.scent-box').click( function(event){
                event.preventDefault();
				$('.scent-box').removeClass('outlined').css({'opacity': '0.15', 'pointer-events': 'none'});
                $(this).addClass('outlined');
				$('.outlined').css({'opacity': '1', 'pointer-events': 'auto'});
                var attribute = $(this).parent().data('value');
                var selectid = $(this).parent().data('attribute_name');
                var id = selectid.toLowerCase();
                var selectel = '#'+id;
                $(selectel).val(attribute).change();
            } );
			
			$( '.reset_variations' ).click(function(){
                $('.outlined').removeClass('outlined');
				$('.size-option').css({'opacity': '1', 'pointer-events': 'auto'});
				$('.scent-box').css({'opacity': '1', 'pointer-events': 'auto'});
            }); 

            $( '.single_variable_buy_now_button' ).click(function(event){
                event.preventDefault();
                var base_url = 'https://shop.earthlybody.com/';
                var variation_id = $(this).parent().find('input.variation_id').val();
				if ( variation_id == 0 ) {
					alert('Please select some product options before making this purchase.');
				} else {
					var product_qty = $(this).parent().find('.quantity').find( 'input[type="number"]' ).val();
                	var target_url = base_url + "checkout/?add-to-cart=" + variation_id + "&quantity=" + product_qty; 
					window.location.replace( target_url );
				}
            });
			
        });
    </script>
<?php 
}
add_action( 'wp_footer', 'single_product_page_add_to_cart' );

function variation_not_sold () { // product variations not for sale, 39: CBD Intensive Cream | 37: CBD Soothing Serum | 60: 7oz Lavender Hemp Seed Hand & Body Lotion
	if ( is_product() && is_single(39) ) {
?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('.size-option[data-value="0.5 oz"]').click( function(event){
				event.preventDefault();
				$('.scent-box-row').find('div[data-value="Lavender"]').css({'opacity': '0.15', 'pointer-events': 'none'});
			} );
			$('.size-option[data-value="8 oz"]').click( function(event){
				event.preventDefault();
				$('.scent-box-row').find('div[data-value="Lavender"]').css({'opacity': '0.15', 'pointer-events': 'none'});
				
			} );
			$('.size-option[data-value="1.7 oz"]').click( function(event){
				event.preventDefault();
				$('.scent-box-row').find('div[data-value="Lavender"]').css({'opacity': '1', 'pointer-events': 'auto'});
			} );
			$('.reset_variations').click(function(e){
				e.preventDefault();
				$('.scent-box-row').find('div').css({'opacity': '1', 'pointer-events': 'auto'});
			});
		});
	</script>
<?php 
	}
	
	if ( is_product() && is_single(37) ) {
?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('.size-option[data-value="0.34 fl oz"]').click( function(event){
				event.preventDefault();
				$('.scent-box-row').find('div[data-value="Lavender"]').css({'opacity': '0.15', 'pointer-events': 'none'});
			} );
			$('.size-option[data-value="0.67 fl oz"]').click( function(event){
				event.preventDefault();
				$('.scent-box-row').find('div[data-value="Lavender"]').css({'opacity': '1', 'pointer-events': 'auto'});
			} );
			$('.reset_variations').click(function(e){
				e.preventDefault();
				$('.scent-box-row').find('div').css({'opacity': '1', 'pointer-events': 'auto'});
			});
		});
	</script>
<?php 
	}
	
	if ( is_product() && is_single(614) ) {
?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('.size-option[data-value="Lip Balm Pot"]').click( function(event){
				event.preventDefault();
				$('.scent-box-row').find('div[data-value="Isle of You"]').css({'opacity': '0.15', 'pointer-events': 'none'});
			} );
			$('.size-option[data-value="Lip Balm Stick"]').click( function(event){
				event.preventDefault();
				$('.scent-box-row').find('div[data-value="Isle of You"]').css({'opacity': '1', 'pointer-events': 'auto'});
			} );
			$('.reset_variations').click(function(e){
				e.preventDefault();
				$('.scent-box-row').find('div').css({'opacity': '1', 'pointer-events': 'auto'});
			});
		});
	</script>
<?php 
	}
	
	if ( is_product() && is_single(60) ) {
?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('.size-option[data-value="7 oz"]').click( function(event){
				event.preventDefault();
				$('.scent-box-row').find('div[data-value="Lavender"]').css({'opacity': '0.15', 'pointer-events': 'none'});
			} );
			$('.size-option[data-value="16 oz"]').click( function(event){
				event.preventDefault();
				$('.scent-box-row').find('div[data-value="Lavender"]').css({'opacity': '1', 'pointer-events': 'auto'});
			} );
			$('.reset_variations').click(function(e){
				e.preventDefault();
				$('.scent-box-row').find('div').css({'opacity': '1', 'pointer-events': 'auto'});
			});
		});
	</script>
<?php 
	}
}
add_action('wp_footer', 'variation_not_sold');

// Show mini cart after WooCommerce message is over. 
function show_mini_cart_after_woo_msg () {
	if ( is_product() ) {
?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			
				setTimeout(function(){
					if ( $('.woocommerce-notices-wrapper').length ) {
						if ( $('.woocommerce-notices-wrapper').is(':visible') ) {
							$('.woocommerce-notices-wrapper').fadeOut();
							//$('#mini-cart-wrapper').css('right', '0px');
						}
					}
				},3000);
			
		});
	</script>
<?php 
	} else {
?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			setTimeout(function(){
			if ( $('.woocommerce-notices-wrapper').length ) {
				$('.woocommerce-notices-wrapper').fadeOut();
			}
			$('.woocommerce-success').fadeOut();
			},3000);
		});
	</script>
<?php 
	}
}
add_action('wp_footer', 'show_mini_cart_after_woo_msg');


// Fix custom tabs for woocommerce content not showing issue
add_filter( 'yikes_woo_use_the_content_filter', '__return_false' );
add_filter( 'yikes_woo_filter_main_tab_content', 'yikes_woo_custom_tab_content_filter', 10, 1 );

function yikes_woo_custom_tab_content_filter( $content ) {

	$content = function_exists( 'capital_P_dangit' ) ? capital_P_dangit( $content ) : $content;
	$content = function_exists( 'wptexturize' ) ? wptexturize( $content ) : $content;
	$content = function_exists( 'convert_smilies' ) ? convert_smilies( $content ) : $content;
	$content = function_exists( 'wpautop' ) ? wpautop( $content ) : $content;
	$content = function_exists( 'shortcode_unautop' ) ? shortcode_unautop( $content ) : $content;
	$content = function_exists( 'prepend_attachment' ) ? prepend_attachment( $content ) : $content;
	$content = function_exists( 'wp_make_content_images_responsive' ) ? wp_make_content_images_responsive( $content ) : $content;
	$content = function_exists( 'do_shortcode' ) ? do_shortcode( $content ) : $content;

	if ( class_exists( 'WP_Embed' ) ) {

		// Deal with URLs
		$embed = new WP_Embed;
		$content = method_exists( $embed, 'autoembed' ) ? $embed->autoembed( $content ) : $content;
	}	

	return $content;
}



/**
 * My Account 
 */
function custom_my_account_menu_items( $items ) { // Remove downloads from my account navigation
    unset($items['downloads']);
    return $items;
}
add_filter( 'woocommerce_account_menu_items', 'custom_my_account_menu_items' );

function old_account_message() {
	if ( !is_account_page() ) : return; endif ; 
?>
	<div class="row px-3 px-lg-5 justify-content-center">
		<p style="font-size: 0.9rem;" class="p-3 box-shadow bg-brown text-white">
			Returning Customer from our brand websites? Unfortunately, we were unable to transfer your existing account at this moment. Please create a new account on our Marketplace and then you'll be set to continue your shopping experience seamlessly. Thank you for your understanding. 
		</p>
	</div>
<?php 
}
add_action('woocommerce_before_customer_login_form', 'old_account_message');

/**
 * Cart and Checkout pages
 */

// Remove 'order notes' section
add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );

// Remove "have a coupon?" from default place from checkout page 
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

// Remove "returning customers log in" from default place on checkout page
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
//add_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_login_form', 10 );

// Free Shipping class + no Shipping choice 
function my_hide_shipping_when_free_is_available( $rates ) { // Hide shipping rates when free shipping is available. 
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );

function bbloomer_add_0_to_shipping_label( $label, $method ) { // Display $0.00 when at free shipping class
    if ( ! ( $method->cost > 0 ) ) {
        $label .= ': ' . wc_price(0);
    } 
    return $label;
}
add_filter( 'woocommerce_cart_shipping_method_full_label', 'bbloomer_add_0_to_shipping_label', 10, 2 );

// Remove default state
add_filter( 'default_checkout_billing_state', 'change_default_checkout_state' );
add_filter( 'default_checkout_shipping_state', 'change_default_checkout_state' );
function change_default_checkout_state() {
    return ''; //set state code if you want to set it otherwise leave it blank.
}

function add_custom_notes () {
	$html = "If you have special delivery instructions, please Email us at Info@EarthlyBody.com<br>Remeber to put your order number on the subject line.";
	echo $html; 
}
add_action('woocommerce_after_order_notes', 'add_custom_notes');


// Disable coupon on product level 
// Create and display the custom field in product general setting tab
add_action( 'woocommerce_product_options_general_product_data', 'add_custom_field_general_product_fields' );
function add_custom_field_general_product_fields(){
    global $post;

    echo '<div class="product_custom_field">';

    // Custom Product Checkbox Field
    woocommerce_wp_checkbox( array(
        'id'        => '_disabled_for_coupons',
        'label'     => __('Disabled for coupons', 'woocommerce'),
        'description' => __('Disable this products from coupon discounts', 'woocommerce'),
        'desc_tip'  => 'true',
    ) );

    echo '</div>';;
}

// Save the custom field and update all excluded product Ids in option WP settings
add_action( 'woocommerce_process_product_meta', 'save_custom_field_general_product_fields', 10, 1 );
function save_custom_field_general_product_fields( $post_id ){

    $current_disabled = isset( $_POST['_disabled_for_coupons'] ) ? 'yes' : 'no';

    $disabled_products = get_option( '_products_disabled_for_coupons' );
    if( empty($disabled_products) ) {
        if( $current_disabled == 'yes' )
            $disabled_products = array( $post_id );
    } else {
        if( $current_disabled == 'yes' ) {
            $disabled_products[] = $post_id;
            $disabled_products = array_unique( $disabled_products );
        } else {
            if ( ( $key = array_search( $post_id, $disabled_products ) ) !== false )
                unset( $disabled_products[$key] );
        }
    }

    update_post_meta( $post_id, '_disabled_for_coupons', $current_disabled );
    update_option( '_products_disabled_for_coupons', $disabled_products );
}

// Make coupons invalid at product level
add_filter('woocommerce_coupon_is_valid_for_product', 'set_coupon_validity_for_excluded_products', 12, 4);
function set_coupon_validity_for_excluded_products($valid, $product, $coupon, $values ){
    if( ! count(get_option( '_products_disabled_for_coupons' )) > 0 ) return $valid;

    $disabled_products = get_option( '_products_disabled_for_coupons' );
    if( in_array( $product->get_id(), $disabled_products ) )
        $valid = false;

    return $valid;
}

// Set the product discount amount to zero
add_filter( 'woocommerce_coupon_get_discount_amount', 'zero_discount_for_excluded_products', 12, 5 );
function zero_discount_for_excluded_products($discount, $discounting_amount, $cart_item, $single, $coupon ){
    if( ! count(get_option( '_products_disabled_for_coupons' )) > 0 ) return $discount;

    $disabled_products = get_option( '_products_disabled_for_coupons' );
    if( in_array( $cart_item['product_id'], $disabled_products ) )
        $discount = 0;

    return $discount;
}

// Unhook cart totals from cart colletrals of cart page
// Hook cart totals to woocommerce_after_cart
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 ); 
add_action( 'woocommerce_after_cart', 'woocommerce_cart_totals', 10 ); 

// Change Empty cart output
remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message', 10 );
function custom_empty_cart_message() {
    
    $html  = '<h5 class="mt-0">';
    $html .= wp_kses_post( apply_filters( 'wc_empty_cart_message', __( 'Your shopping bag is empty.', 'woocommerce' ) ) );
    $html .= '</h5>';
    echo $html;
}
add_action( 'woocommerce_cart_is_empty', 'custom_empty_cart_message', 10 );

function add_plus_to_qty_input () { // Add plus to global/quantity-input.php AKA woocommerce_quantity_input() function
	$html = '<input type="button" value="-" class="minus" aria-label="number input add button">';
    echo $html;
}
add_action( 'woocommerce_before_quantity_input_field', 'add_plus_to_qty_input' );

function add_minus_to_qty_input () { // Add minus to global/quantity-input.php AKA woocommerce_quantity_input() function
	$html = '<input type="button" value="+" class="plus" aria-label="number input minus button">';
    echo $html; 
}
add_action( 'woocommerce_after_quantity_input_field', 'add_minus_to_qty_input' );

//Old quantity input 
function my_add_cart_quantity_plus_minus() {
?>
	<script type="text/javascript">
      jQuery(document).ready(function($){   
           
         $('.quantity').on( 'click', '.plus, .minus', function() {
  
            // Get current quantity values
            var qty = $( this ).parent().find( '.qty' );
            var val   = parseFloat(qty.val());
            var max = parseFloat(qty.attr( 'max' ));
            var min = parseFloat(qty.attr( 'min' ));
            var step = parseFloat(qty.attr( 'step' ));
            var add_to_cart_button = $(this).parent().parent().parent().find('.add_to_cart_button');
            add_to_cart_button.attr('data-quantity', '');
  
            // Change the value if plus or minus
            if ( $( this ).is( '.plus' ) ) {

               if ( max && ( max <= val ) ) {

                  qty.val( max );
                  var qtyValue = parseInt( qty.val() );
                 

               } else {

                  qty.val( val + step );
                  var qtyValue = parseInt( qty.val() );
                  

               }

            } else {

               if ( min && ( min >= val ) ) {

                  qty.val( min );
                  var qtyValue = parseInt( qty.val() );
                  

               } else if ( val > 1 ) {

                  qty.val( val - step );
                  var qtyValue = parseInt( qty.val() );
                  

               }
            }


            add_to_cart_button.attr('data-quantity', qtyValue);
			

         });
      });
	</script>
<?php
}
add_action( 'wp_footer', 'my_add_cart_quantity_plus_minus' ); 

/* BOGO qty input 
function my_add_cart_quantity_plus_minus() {
    if ( is_product() ) {
        global $product; 
        $onsale = $product->is_on_sale();
        if ( $onsale == 1 ) {
?>
        <script type="text/javascript">
        jQuery(document).ready(function($){   
           
         $('.quantity').on( 'click', '.plus, .minus', function() {
  
            // Get current quantity values
            var qty = $( this ).parent().find( '.qty' );
            var val   = parseFloat(qty.val());
            var max = 4; // parseFloat(qty.attr( 'max' ));
            var min = 1;
            var step = 1;
  
            // Change the value if plus or minus
            if ( $( this ).is( '.plus' ) ) {
               if ( max && ( max <= val ) ) {
				  alert('BOGO weekend! You can add a max. of 4 sale products to your shopping bag.');
                  qty.val( max );
               } else {
                  qty.val( val + step );
               }
            } else {
               if ( min && ( min >= val ) ) {
				   alert('BOGO weekend! You need to have at least 1 product to add to the shopping bag.');
                  qty.val( min );
               } else if ( val > 1 ) {
                  qty.val( val - step );
               }
            }
              
         });
        });
	    </script>
<?php   
        } else {
    ?>
        <script type="text/javascript">
      jQuery(document).ready(function($){   
           
         $('.quantity').on( 'click', '.plus, .minus', function() {
  
            // Get current quantity values
            var qty = $( this ).parent().find( '.qty' );
            var val   = parseFloat(qty.val());
            var max = 8; // parseFloat(qty.attr( 'max' ));
            var min = 1;
            var step = 1;
  
            // Change the value if plus or minus
            if ( $( this ).is( '.plus' ) ) {
               if ( max && ( max <= val ) ) {
				  alert('BOGO weekend! You can add a max. of 8 eligible products to your shopping bag.');
                  qty.val( max );
               } else {
                  qty.val( val + step );
               }
            } else {
               if ( min && ( min >= val ) ) {
				   alert('BOGO weekend! You need to have at least 1 product to add to the shopping bag.');
                  qty.val( min );
               } else if ( val > 1 ) {
                  qty.val( val - step );
               }
            }
              
         });
      });
	</script>
    <?php         
        }

    } else {
?>
    <script type="text/javascript">
      jQuery(document).ready(function($){   
           
         $('.quantity').on( 'click', '.plus, .minus', function() {
            
            // Get current quantity values
            var qty = $( this ).parent().find( '.qty' );
            var val   = parseFloat(qty.val());
            var sale = $( this ).parent().parent().parent().find('.onsale');
            if ( sale.length ) {
                var max = 4; // parseFloat(qty.attr( 'max' ));
                var min = 1;
                var step = 1;
            } else {
                var max = 8; // parseFloat(qty.attr( 'max' ));
                var min = 1;
                var step = 1;
            }
            
            // Change the value if plus or minus
            if ( $( this ).is( '.plus' ) ) {
               if ( max && ( max <= val ) ) {
				  alert('BOGO weekend! You have reached your max. purchase quantity.');
                  qty.val( max );
               } else {
                  qty.val( val + step );
               }
            } else {
               if ( min && ( min >= val ) ) {
				   alert('BOGO weekend! You need to have at least 1 product to add to the shopping bag.');
                  qty.val( min );
               } else if ( val > 1 ) {
                  qty.val( val - step );
               }
            }
              
         });
      });
	</script>
<?php 
    }
?>
	
<?php
}
add_action( 'wp_footer', 'my_add_cart_quantity_plus_minus' );  */

/**
 * BOGO Qty Input Notifications - Thanksgiving 2020 
 */



 
function my_cart_refresh_update_qty() { 
   if (is_cart()) { 
      ?> 
      <script type="text/javascript">

        jQuery(document).ready(function($){

            $('input.qty').click(function(){

                $("[name='update_cart']").trigger("click");

            });

        });

      </script> 
      <?php 
   } 
}
add_action( 'wp_footer', 'my_cart_refresh_update_qty' ); 

function checkout_forms_ui () { // control front end interface of checkout page
?>
    <script type="text/javascript">
        jQuery( document ).ready( function($) {
            $( '#user-login-form' ).click(function(e){
                e.preventDefault();
                $('.woocommerce-form-login').slideToggle();
            });
        });
    </script>
<?php 
}
add_action( 'wp_footer', 'checkout_forms_ui' ); 



/**
 * The popup with products recommendations after Ajax add to cart call
 */

// Hook into Woocommerce when adding a product to the cart
add_filter( 'woocommerce_add_to_cart_fragments', 'wd_woocommerce_footer_bar_fragment', 999 , 1 );

if( !function_exists( 'wd_woocommerce_footer_bar_fragment' ) ) {
	function wd_woocommerce_footer_bar_fragment($fragments)
	{
		ob_start();
        $cart_total = WC()->cart->cart_contents_total;
        $cart_number = WC()->cart->cart_contents_count;
?>
        <div id="mini-cart-wrapper" class="bg-white">
            <?php woocommerce_mini_cart() ?>
        </div>

        <script type="text/javascript">
        //Toggle mini cart from click shopping bag icon 
        var bag = document.getElementById("shopping-bag");
        var mobilebag = document.getElementById("mobile-shopping-bag");
        var minicart = document.getElementById("mini-cart-wrapper");
        var closeminicart = document.getElementById("closeminicart");
		var viewcartbtns = document.getElementsByClassName("added_to_cart");
      
		bag.addEventListener("click", function(event){
            event.preventDefault();
            minicart.style.right = '0px';
        });
        closeminicart.addEventListener("click", function(){
            minicart.style.right = '-350px';
        });
        mobilebag.addEventListener("click", function(event){
            event.preventDefault();
            minicart.style.right = '0px';
        });   
		
		var i;
		for (i=0; i<viewcartbtns.length; i++) {
			viewcartbtns[i].addEventListener("click", function(event){
				event.preventDefault();
				minicart.style.right = '0px';
			});
		}
		
        </script>
<?php
		$fragments['#mini-cart-wrapper'] = ob_get_clean();
		return $fragments;
	}
}

// display cart items count on Ajax call 
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
    ?>
    
    <span class="cart-items-count"><?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span>

	<?php
	$fragments['span.cart-items-count'] = ob_get_clean();
	return $fragments;
}


/**
 * Hide variation select dropdown but still show clear option link
 */
function wc_dropdown_variation_attribute_options( $args = array() ) {
    $args = wp_parse_args(
        apply_filters( 'woocommerce_dropdown_variation_attribute_options_args', $args ),
        array(
            'options'          => false,
            'attribute'        => false,
            'product'          => false,
            'selected'         => false,
            'name'             => '',
            'id'               => '',
            'class'            => '',
            'show_option_none' => __( 'Choose an option', 'woocommerce' ),
        )
    );

    // Get selected value.
    if ( false === $args['selected'] && $args['attribute'] && $args['product'] instanceof WC_Product ) {
        $selected_key     = 'attribute_' . sanitize_title( $args['attribute'] );
        $args['selected'] = isset( $_REQUEST[ $selected_key ] ) ? wc_clean( wp_unslash( $_REQUEST[ $selected_key ] ) ) : $args['product']->get_variation_default_attribute( $args['attribute'] ); // WPCS: input var ok, CSRF ok, sanitization ok.
    }

    $options               = $args['options'];
    $product               = $args['product'];
    $attribute             = $args['attribute'];
    $name                  = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute );
    $id                    = $args['id'] ? $args['id'] : sanitize_title( $attribute );
    $class                 = $args['class'];
    $show_option_none      = (bool) $args['show_option_none'];
    $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __( 'Choose an option', 'woocommerce' ); // We'll do our best to hide the placeholder, but we'll need to show something when resetting options.

    if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
        $attributes = $product->get_variation_attributes();
        $options    = $attributes[ $attribute ];
    }

    $html  = '<select id="' . esc_attr( $id ) . '" class="d-none ' . esc_attr( $class ) . '" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '" data-show_option_none="' . ( $show_option_none ? 'yes' : 'no' ) . '">';
    $html .= '<option value="">' . esc_html( $show_option_none_text ) . '</option>';

    if ( ! empty( $options ) ) {
        if ( $product && taxonomy_exists( $attribute ) ) {
            // Get terms if this is a taxonomy - ordered. We need the names too.
            $terms = wc_get_product_terms(
                $product->get_id(),
                $attribute,
                array(
                    'fields' => 'all',
                )
            );

            foreach ( $terms as $term ) {
                if ( in_array( $term->slug, $options, true ) ) {
                    $html .= '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $args['selected'] ), $term->slug, false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name, $term, $attribute, $product ) ) . '</option>';
                }
            }
        } else {
            foreach ( $options as $option ) {
                // This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
                $selected = sanitize_title( $args['selected'] ) === $args['selected'] ? selected( $args['selected'], sanitize_title( $option ), false ) : selected( $args['selected'], $option, false );
                $html    .= '<option value="' . esc_attr( $option ) . '" ' . $selected . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option, null, $attribute, $product ) ) . '</option>';
            }
        }
    }

    $html .= '</select>';

    echo apply_filters( 'woocommerce_dropdown_variation_attribute_options_html', $html, $args ); // WPCS: XSS ok.
}

function load_more_category () {
    $html = "<a href='#' id='category-load-more' class='d-block d-md-none p-2 m-4 text-center text-brown box-shadow'>Load more</a>";
    echo $html; 
}
//add_action( 'woocommerce_after_shop_loop', 'load_more_category', 20 );

/**
 * Change placement of woo message on single product page 
 */
remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 );
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_output_all_notices', 10 );

/**
 * Change text of "view cart"
 */
function my_text_strings( $translated_text, $text, $domain ) {
	switch ( $translated_text ) {
		case 'View cart' :
		$translated_text = __( 'View', 'woocommerce' );
		break;
	}
return $translated_text;
}
add_filter( 'gettext', 'my_text_strings', 20, 3 );


/**
 * Store locator show category name 
 * - Collect category information 
 * - Show names in the template 
 * - Show category in the marker information window
 */
add_filter( 'wpsl_store_meta', 'custom_store_meta', 10, 2 );

function custom_store_meta( $store_meta, $store_id ) {
    
    $terms = wp_get_post_terms( $store_id, 'wpsl_store_category' );
    
    $store_meta['terms'] = '';
    
    if ( $terms ) {
        if ( !is_wp_error( $terms ) ) {
            if ( count( $terms ) > 1 ) {
                $location_terms = array();

                foreach ( $terms as $term ) {
                    $location_terms[] = $term->name;
                }

                $store_meta['terms'] = implode( ', ', $location_terms );
            } else {
                $store_meta['terms'] = $terms[0]->name;    
            }
        }
    }
    
    return $store_meta;
}

add_filter( 'wpsl_listing_template', 'custom_listing_template' );

function custom_listing_template() {

    global $wpsl, $wpsl_settings;
    
    $listing_template = '<li data-store-id="<%= id %>">' . "\r\n";
    $listing_template .= "\t\t" . '<div class="wpsl-store-location">' . "\r\n";
    $listing_template .= "\t\t\t" . '<p><%= thumb %>' . "\r\n";
    $listing_template .= "\t\t\t\t" . wpsl_store_header_template( 'listing' ) . "\r\n"; // Check which header format we use
    $listing_template .= "\t\t\t\t" . '<span class="wpsl-street"><%= address %></span>' . "\r\n";
    $listing_template .= "\t\t\t\t" . '<% if ( address2 ) { %>' . "\r\n";
    $listing_template .= "\t\t\t\t" . '<span class="wpsl-street"><%= address2 %></span>' . "\r\n";
    $listing_template .= "\t\t\t\t" . '<% } %>' . "\r\n";
    $listing_template .= "\t\t\t\t" . '<span>' . wpsl_address_format_placeholders() . '</span>' . "\r\n"; // Use the correct address format

    if ( !$wpsl_settings['hide_country'] ) {
        $listing_template .= "\t\t\t\t" . '<span class="wpsl-country"><%= country %></span>' . "\r\n";
    }

    $listing_template .= "\t\t\t" . '</p>' . "\r\n";
    
     // Include the category names.
    $listing_template .= "\t\t\t" . '<% if ( terms ) { %>' . "\r\n";
    $listing_template .= "\t\t\t" . '<h3 class="text-brown mb-0" style="font-weight:500">' . __( 'Carries:', 'wpsl' ) . ' </h3><p><%= terms %></p>' . "\r\n";
    $listing_template .= "\t\t\t" . '<% } %>' . "\r\n";

    // Show the phone, fax or email data if they exist.
    if ( $wpsl_settings['show_contact_details'] ) {
        $listing_template .= "\t\t\t" . '<p class="wpsl-contact-details">' . "\r\n";
        $listing_template .= "\t\t\t" . '<% if ( phone ) { %>' . "\r\n";
        $listing_template .= "\t\t\t" . '<span><strong>' . esc_html( $wpsl->i18n->get_translation( 'phone_label', __( 'Phone', 'wpsl' ) ) ) . '</strong>: <%= formatPhoneNumber( phone ) %></span>' . "\r\n";
        $listing_template .= "\t\t\t" . '<% } %>' . "\r\n";
        $listing_template .= "\t\t\t" . '<% if ( fax ) { %>' . "\r\n";
        $listing_template .= "\t\t\t" . '<span><strong>' . esc_html( $wpsl->i18n->get_translation( 'fax_label', __( 'Fax', 'wpsl' ) ) ) . '</strong>: <%= fax %></span>' . "\r\n";
        $listing_template .= "\t\t\t" . '<% } %>' . "\r\n";
        $listing_template .= "\t\t\t" . '<% if ( email ) { %>' . "\r\n";
        $listing_template .= "\t\t\t" . '<span><strong>' . esc_html( $wpsl->i18n->get_translation( 'email_label', __( 'Email', 'wpsl' ) ) ) . '</strong>: <%= email %></span>' . "\r\n";
        $listing_template .= "\t\t\t" . '<% } %>' . "\r\n";
        $listing_template .= "\t\t\t" . '</p>' . "\r\n";
    }

    $listing_template .= "\t\t\t" . wpsl_more_info_template() . "\r\n"; // Check if we need to show the 'More Info' link and info
    $listing_template .= "\t\t" . '</div>' . "\r\n";
    $listing_template .= "\t\t" . '<div class="wpsl-direction-wrap">' . "\r\n";

    if ( !$wpsl_settings['hide_distance'] ) {
        $listing_template .= "\t\t\t" . '<%= distance %> ' . esc_html( $wpsl_settings['distance_unit'] ) . '' . "\r\n";
    }

    $listing_template .= "\t\t\t" . '<%= createDirectionUrl() %>' . "\r\n"; 
    $listing_template .= "\t\t" . '</div>' . "\r\n";
    $listing_template .= "\t" . '</li>';

    return $listing_template;
}

add_filter( 'wpsl_info_window_template', 'custom_info_window_template' );

function custom_info_window_template() {
   
    $info_window_template = '<div data-store-id="<%= id %>" class="wpsl-info-window">' . "\r\n";
    $info_window_template .= "\t\t" . '<p>' . "\r\n";
    $info_window_template .= "\t\t\t" .  wpsl_store_header_template() . "\r\n";  
    $info_window_template .= "\t\t\t" . '<span><%= address %></span>' . "\r\n";
    $info_window_template .= "\t\t\t" . '<% if ( address2 ) { %>' . "\r\n";
    $info_window_template .= "\t\t\t" . '<span><%= address2 %></span>' . "\r\n";
    $info_window_template .= "\t\t\t" . '<% } %>' . "\r\n";
    $info_window_template .= "\t\t\t" . '<span>' . wpsl_address_format_placeholders() . '</span>' . "\r\n";
    $info_window_template .= "\t\t" . '</p>' . "\r\n";
    
    // Include the category names.
    $info_window_template .= "\t\t" . '<% if ( terms ) { %>' . "\r\n";
    $info_window_template .= "\t\t" . '<p>' . __( 'Categories:', 'wpsl' ) . ' <%= terms %></p>' . "\r\n";
    $info_window_template .= "\t\t" . '<% } %>' . "\r\n";
    
    $info_window_template .= "\t\t" . '<%= createInfoWindowActions( id ) %>' . "\r\n";
    $info_window_template .= "\t" . '</div>' . "\r\n";
    
    return $info_window_template;
}

/**
 * Add a single sticky top action bar on small devices for single product pages 
 */
function add_product_sticky_bar () {
    if ( is_product() ) {
        global $product; 
        $name = $product->get_name();
        $image = $product->get_image();

        $html = "<div id='single-product-sticky-bar' class='w-100 box-shadow text-brown p-3 text-center'>";
        $html .= $image ."<p class='my-0'>". $name ."</p>";
        $html .= "</div>";

        echo $html;
    }
}
add_action( 'woocommerce_before_single_product_summary', 'add_product_sticky_bar', 1 );

/** Single sticky top bar show on scroll */
function single_sticky_top_bar_script () {
?>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $(window).scroll(function(){
                if ($(document).scrollTop() > 1000 ) {
                    $('#single-product-sticky-bar').fadeIn();
                } else {
                    $('#single-product-sticky-bar').fadeOut();
                }
            });
        });
    </script>
<?php 
}
add_action( 'wp_footer', 'single_sticky_top_bar_script' );



/**
 * Advanced product search - search within category  
 */
function search_filter($query) {

	if ( $query->is_search &&  $_post['my_search'] == "c_search") {
        $args = array(
                'relation' => 'AND',
            array(
                'taxonomy' => 'category',
                'field' => 'id',
                'terms' => $_post['post_cat'],
                'operator' => 'IN'
            )
        );
        $query->set( 'tax_query', $args);
    }
    return $query;
   
}
add_filter( 'the_search_query','search_filter');

function promotion_bottom() {
	
	if ( is_page( array('Hemp Products', 'Intensive Cream Triple Strength 8oz', 'Intensive Cream Triple Strength 1.7oz', 'Hemp Nature Fix Kit', 'Ultra Care Products', 'EMERA Landing Page', 'Shop for Pets' ) ) ) {
		return; 
	}
	
    wp_enqueue_style( 'promotionbox', get_template_directory_uri() . '/css/promotionbox.css', false, '', 'all' );
	
    $html = "
            <div id='promotionbox_wrapper' style='display:none'></div>
            <div id='promotionbox'>
                <div id='promotionbox_title'>
                    <h5 class='my-0'>Promos & New Items<a href='#' id='hidepromotionbox'>&uarr;</a></h5>
                    <p class='my-0'>expand to learn more</p>
                </div>
                <div id='promotionexpand' style='height: 0'>
                    <div class='expanded-container py-3'>
                        <div class='px-3 thebox'>
                            <div class='p-3'>
                                <img src='https://shop.earthlybody.com/wp-content/uploads/2020/06/HandWash.jpg' alt='Natural Hand Soap | Hemp Seed Body Care | Shop Earthly Body'/>
                                <a href='https://shop.earthlybody.com/shop/hemp-seed-body-care/hemp-seed-fragrances/hemp-seed-eucalyptus-tea/hemp-seed-hand-wash/' class='action box-shadow'>Shop Now</a>
                            </div>
                        </div>
                        <div class='px-3 thebox'>
                            <div class='p-3'>
                                <img src='https://shop.earthlybody.com/wp-content/uploads/2020/06/BeachDaze-4.jpg' alt='Beach Daze Scent | Hemp Seed Body Care | Shop Earthly Body' />
                                <a href='https://shop.earthlybody.com/product-tag/fragrance-beach-daze/' class='action box-shadow'>Learn More</a>
                            </div>
                        </div>
      
                        
                    </div>
                </div>
            </div>";
    echo $html; 
?>
    <script type="text/javascript">
        var promobox = document.getElementById('hidepromotionbox');
        var promobg = document.getElementById('promotionbox_wrapper');
        var promoexpand = document.getElementById('promotionexpand');
        var ifopen = sessionStorage.getItem('ifopen'); 
        
       /* document.getElementsByTagName('body')[0].onscroll = function(event) {
			event.preventDefault();
            if ( ifopen == null ) {
                expandpromotion();
            } 
        } */

        promobox.addEventListener('click', function(event){
			event.preventDefault();
            var visible = promobg.style.display; 
            if (visible == '' ) { //expanded, click to close
                closepromotion();
                document.getElementsByTagName('body')[0].onscroll = function(event) {
					event.preventDefault();
                    closepromotion();
                };
            } else { //closed, click to expand
                expandpromotion();
            }
            sessionStorage.setItem('ifopen', 1);
        });

        function expandpromotion() {
            promobg.style.display = '';
            promoexpand.style.height = '';
            promobox.innerHTML = 'Close';
        }

        function closepromotion() {
            promobg.style.display = 'none';
            promoexpand.style.height = '0px';
            promobox.innerHTML = '&uarr;';
        }
    </script>
<?php
}
add_action( 'wp_footer', 'promotion_bottom' );

//Add BOGO notice to single product page 
/*
function bogonobogo () {
	global $product; 
	$onsale = $product->is_on_sale();
	$product_id = $product->get_id();
	$arr = array(12833, 12836, 12841, 12846, 12849, 12852, 12855, 12858, 12861, 12864, 12867, 12870, 12873, 12877, 12881, 12884, 12887, 12890, 12894, 12897, 12900, 12903, 12906, 12909, 12914, 12917);
	if ( ( $onsale == 1 ) || ( in_array( $product_id , $arr) ) ) {
		$nobogo = "This product is not eligible for BOGO";
		echo '<p style="color:#c00001; padding: 0.5rem; font-size: 1rem; font-weight: 500;">'.$nobogo.'</p>'; 
	} else {
		$yesbogo = "Buy 2, get the 2nd item Free";
		echo '<p style="background:#5d7041; color:#fff; padding: 0.5rem; font-size: 1rem;">'.$yesbogo.'</p>';
	}
}
add_action('woocommerce_single_product_summary', 'bogonobogo', 25); */

/* Apply Buddy50 BOGO directly when click on the button 
add_action( 'woocommerce_before_cart', 'bbloomer_apply_coupon' );
  
function bbloomer_apply_coupon() {
    $coupon_code = 'buddy50'; 
	$url = $_GET['coupon'];
	if ( ($url !== $coupon_code) || WC()->cart->has_discount( $coupon_code ) ) {
		return; 
	} elseif ( ($url == $coupon_code) ) {
		WC()->cart->apply_coupon( $coupon_code );
    	wc_print_notices();
	}
}
*/
/**
 * Change product URL to use primary category only 
 */

add_filter( 'wc_product_post_type_link_product_cat', function( $term, $terms, $post ) {

    // Get the primary term as saved by Yoast
    $primary_cat_id = get_post_meta( $post->ID, '_yoast_wpseo_primary_product_cat', true );

    // If there is a primary and it's not currently chosen as primary
    if ( $primary_cat_id && $term->term_id != $primary_cat_id ) {

        // Find the primary term in the term list
        foreach ( $terms as $term_key => $term_object ) {

            if ( $term_object->term_id == $primary_cat_id ) {
                // Return this as the primary term
                $term = $terms[ $term_key ];
                break;
            }

        }

    }

    return $term;

}, 10, 3 );

// Add Refer A Friend Box HTML to The Footer 
function refer_a_friend_box_footer() {
	
	if ( !is_page( array('Hemp Products', 'Shop for Pets')  ) ) {
		
		echo "<div id='refer-a-friend-box-footer' style='display: none;'>";
	
		echo "<img src='https://shop.earthlybody.com/wp-content/themes/ebmarketplace/img/gift-3-32.png' style='margin-left: 8px; margin-right: 4px;' alt='Refer A Friend | Shop Earthly Body'/>";
	
		echo "<div id='open-detail-box' style='text-transform: uppercase; border-right: 1px solid #fff; color: #fff; font-size: 1.25rem; line-height: 1.25; padding-left: 8px; padding-right: 8px;'>Refer A Friend<br>Give 25% Off. Get $5.</div>";
	
		echo "<button id='no-refer-a-friend' style='color: #fff; font-weight: 500; background: transparent; border: none; box-shadow: none; margin-left: 4px; margin-right: 4px; font-size: 0.85rem;'>X</button>";
	
	echo "</div>";
	
	echo "<div id='refer-a-friend-overlay' style='display: none;'>";
	
		echo "<div id='offer-container'>";
	
			echo "<button id='close-refer-friend-overlay'>X</button>";
	
			echo "<img src='https://bogo.earthlybody.com/wp-content/uploads/2020/09/ReferAFriendGraphic-2.jpg' id='image-left' alt='Refer A Friend | Shop Earthly Body | Banner Image'/>";
	
			echo "<div id='refer-detail-right'>";
	
				echo "<img src='https://bogo.earthlybody.com/wp-content/uploads/2020/08/EarthlyBodyLogoJPG1.jpg' style='width:100%; height: auto; padding-left:25px; padding-right:25px;' alt='Refer A Friend | Give 25% Off. Get $5 | Shop Earthly Body' />";
	
				echo "<h4>Refer a Friend</h4>";
	
				echo "<h1 style='padding: 15px; margin-left: 30px; margin-right: 30px; border-top: 2px solid #000; border-bottom: 2px solid #000; text-transform: uppercase;'>Give 25% Off. Get $5!</h1>";
	
				echo do_shortcode('[WOO_GENS_RAF_ADVANCE guest_text="A $5 coupon will be sent to the email you sign up with when your friend\'s order is completed." url="https://shop.earthlybody.com"]');
	
			echo "</div>";
	
	
		echo "</div>";
	
	echo "</div>";
		
	}
	
}

add_action( 'wp_footer', 'refer_a_friend_box_footer' );

//Add Refer A Friend Box Script to The Footer 
function refer_a_friend_box_script() {
	
?>	

	<script>
		
		var ReferPopup = document.getElementById("refer-a-friend-box-footer");
		
		var noReferPopup = document.getElementById("no-refer-a-friend");
		
		var keepclosed = sessionStorage.getItem('one'); 
		
		noReferPopup.addEventListener("click", function(){
			
			ReferPopup.style.display = "none";
			
			sessionStorage.setItem('one','two'); 
			
			var keepclosed = sessionStorage.getItem('one');
			
			console.log(keepclosed);
			
		});
		
		window.addEventListener('load', function() {
			
            if ( keepclosed == null ) {
				
				ReferPopup.style.display = "flex";
				
			} else {
				
				ReferPopup.style.display = "none";
				
			}
			
		});
		
		document.getElementById("open-detail-box").addEventListener("click", function(){
			
			document.getElementById("refer-a-friend-overlay").style.display = "flex";
			
		});
		
		document.getElementById("js--gens-email-clone").addEventListener("click", function(){
			
			document.getElementById("image-left").style.verticalAlign = "top";
			
			document.getElementById("refer-detail-right").style.verticalAlign = "top";
			
		});
		
		document.getElementById("close-refer-friend-overlay").addEventListener("click", function(){
			
			document.getElementById("refer-a-friend-overlay").style.display = "none";
			
		});
		
	</script>

<?php 

}

add_action( 'wp_footer', 'refer_a_friend_box_script' );

/**
 * @snippet       How to Apply a Coupon Programmatically - WooCommerce Cart
 */
  
add_action( 'woocommerce_before_cart', 'bbloomer_apply_coupon' );
  
function bbloomer_apply_coupon() {
    $coupon_code = 'bogothanksgiving2020'; 
    if ( WC()->cart->has_discount( $coupon_code ) ) return;
    WC()->cart->apply_coupon( $coupon_code );
    wc_print_notices();
}

/**
 * @snippet         Add not a bogo item to category = nobogo & on sale items 
 * @locations       product loop & single product page 
 */

 



