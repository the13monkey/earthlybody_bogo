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

</body>

<div class="container-fluid p-3 mt-5" style="background: #613d20">
	<div class="row py-3 justify-content-center">
		<?php if (is_page('Shop for Pets')) : ?>
		
		<a href="https://chosenbydogscbd.com/privacy-policy/?utm_source=Spokes&utm_medium=ppc&utm_campaign=chosen_by_dogs" class="mx-3 text-white">Privacy Policy</a><span class="text-white">|</span><a href="https://chosenbydogscbd.com/terms-of-service/?utm_source=Spokes&utm_medium=ppc&utm_campaign=chosen_by_dogs" class="mx-3 text-white">Terms and Conditions</a><span class="text-white">|</span><a href="https://chosenbydogscbd.com/shipping-returns/?utm_source=Spokes&utm_medium=ppc&utm_campaign=chosen_by_dogs" class="mx-3 text-white">Shipping and Returns</a>
		
		<?php else: ?>
		
		<a href="https://shop.earthlybody.com/privacy-policy/" class="mx-3 text-white">Privacy Policy</a><span class="text-white">|</span><a href="https://shop.earthlybody.com/terms-of-service/" class="mx-3 text-white">Terms and Conditions</a><span class="text-white">|</span><a href="https://shop.earthlybody.com/shipping-returns/" class="mx-3 text-white">Shipping and Returns</a><span class="text-white">|</span><a href="https://shop.earthlybody.com/customer-service/" class="mx-3 text-white">FAQs</a>
		
		<?php endif; ?>
		
	</div>
</div>

<?php wp_footer(); ?>
</html>