<?php

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
 * @TITLE: Disable Email and Phone Transmission to DHL for WooCommerce (Enable Customer Privacy)
 * @FOR_PLUGIN: DHL for WooCommerce, https://wordpress.org/plugins/dhl-for-woocommerce/
 * @DESCRIPTION: prevent transmission of customer email and phone by DHL for WooCommerce to DHL (required privacy)
 * @DOCUMENTATION AND DISCUSSION: https://qreuz.com/snippets/disable-email-and-phone-transmission-to-dhl-for-woocommerce-enable-customer-privacy/
 * @AUTHOR: Qreuz GmbH
 * @VERSION: 1.0
 */	
 
// do not transmit email when creating a label from DHL
add_filter('pr_shipping_dhl_label_args', 'qreuz_remove_email_from_dhl_api', 10, 2);
	
	function qreuz_remove_email_from_dhl_api($args, $order_id) {
		if(isset($args['shipping_address']['email'])){
			unset($args['shipping_address']['email']);
		}
		return $args;
	}
	
// do not transmit customer phone number when creating a label from DHL	
add_filter('pr_shipping_dhl_label_args', 'qreuz_remove_phone_number_from_dhl_api', 10, 2);
	
	function qreuz_remove_phone_number_from_dhl_api($args, $order_id) {
		if(isset($args['shipping_address']['phone'])){
			unset($args['shipping_address']['phone']);
		}
		return $args;
	}
	