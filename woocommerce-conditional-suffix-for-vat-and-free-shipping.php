/**
 *
 * ██████╗ ██████╗ ███████╗██╗   ██╗███████╗
 *██╔═══██╗██╔══██╗██╔════╝██║   ██║╚══███╔╝
 *██║   ██║██████╔╝█████╗  ██║   ██║  ███╔╝ 
 *██║▄▄ ██║██╔══██╗██╔══╝  ██║   ██║ ███╔╝  
 *╚██████╔╝██║  ██║███████╗╚██████╔╝███████╗
 * ╚══▀▀═╝ ╚═╝  ╚═╝╚══════╝ ╚═════╝ ╚══════╝
 *                                          
 * QREUZ SNIPPET FOR WOOCOMMERCE
 * This file is part of a collection of snippets to be used on your WooCommerce store.
 * !! Do not put this file in your Wordpress installation !!
 *
 * Copy/paste the code below and add it to the functions.php of your child theme.
 * Don't know what a child theme is? Read this post: https://qreuz.com/how-to-use-a-child-theme-on-wordpress-and-woocommerce/
 *
 * COPY AND PASTE EVERYTHING BELOW THIS LINE TO YOUR FUNCTIONS.PHP **/
 
/**
 * QREUZ SNIPPET FOR WOOCOMMERCE
 * @TITLE: WooCommerce Conditional Suffix for VAT and Free Shipping Scenarios
 * @DESCRIPTION: shows a price suffix if VAT is applied and if free shipping is available
 * @DOCUMENTATION AND DISCUSSION: https://qreuz.com/snippets/woocommerce-conditional-suffix-for-vat-and-free-shipping-scenarios/
 * @AUTHOR: Qreuz GmbH
 * @VERSION: 1.0
 */	

add_filter( 'woocommerce_get_price_suffix', 'qreuz_price_suffix', 10, 4 );
	
	function qreuz_price_suffix( $price_display_suffix, $product ) {
	
		if (isset( WC()->customer ))	{
			$shipping_country = WC()->customer->get_shipping_country();
			
			// define list of countries in the European Union to apply VAT
			// replace this list of country codes with your countries to apply VAT for (if applicable)
			$eu_countries = array("BE","BG","CZ","DK","DE","EE","IE","EL","ES","FR","HR","IT","CY","LV","LT","LU","HU","MT","NL","AT","PL","PT","RO","SI","SK","FI","SE","UK");
			
			if (in_array($shipping_country,$eu_countries) && $product->is_taxable()){
				$vat = 'inc. 19% VAT. '; // the suffix to show if VAT is applied, replace with your VAT rate
				$price = wc_get_price_including_tax($product);
			}
			else	{
				$vat = '';
				$price = wc_get_price_excluding_tax($product);
			}
			
			$free_shipping_treshold = 25; // enter the amount an order needs to be eligible for free shipping
			
			if ($price < $free_shipping_treshold && $product->needs_shipping()){
				$shipping = 'plus shipping'; // suffix for 'excl. shipping' scenario
			}
			elseif ($price >= $free_shipping_treshold && $product->needs_shipping()){
				$shipping = 'free shipping'; // suffix for 'free shipping' scenario
			}
			else {
				$shipping = '';
			}
			
			$suffix = $vat.$shipping;
			
			$suffix_output = '<small class="woocommerce-price-suffix">'. $suffix .'</small>';
			
			return $suffix_output;
		}
		else	{
			return $price_display_suffix;
		}
	}