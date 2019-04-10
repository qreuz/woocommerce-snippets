<?
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
 * Don't know what a child theme is? Read this post: https://qreuz.com/
 *
 * COPY AND PASTE EVERYTHING BELOW THIS LINE TO YOUR FUNCTIONS.PHP **/

/**
 * QREUZ SNIPPET FOR WOOCOMMERCE / WORDPRESS
 * @TITLE: WooCommerce Disable Free Shipping for Shipping Class
 * @DESCRIPTION: disables free shipping and forces a paid shipping method if a product of a certain class is added to the cart
 * @DOCUMENTATION AND DISCUSSION: https://qreuz.com/
 * @AUTHOR: Qreuz GmbH
 * @VERSION: 1.0
 */	

add_filter( 'woocommerce_package_rates', 'qreuz_force_shipping_when_class_in_cart', 10, 2);

function qreuz_force_shipping_when_class_in_cart( $rates, $package ) {
	
	$shipping_class_slug = 'maxibrief'; // set the shipping class slug to force a paid certain shipping method here
	
	$shipping_method_id = 'free_shipping'; // sets free shipping as the deactivated method
	
	$shipping_class_in_cart = false;
	
	foreach( WC()->cart->get_cart() as $cart_item ) {
        if( $cart_item['data']->get_shipping_class() == $shipping_class_slug ) {
		  $shipping_class_in_cart = true;
		  break;
		 } 
	}

	if ($shipping_class_in_cart) {
		
		$shipping_methods_disable = array();

		foreach ( $rates as $rate_id => $rate ) {
			if ( $shipping_method_id !== $rate->method_id ) {
				$shipping_methods_disable[ $rate_id ] = $rate;
			}
		}
	}
	
	return ! empty( $shipping_methods_disable ) ? $shipping_methods_disable : $rates;
}