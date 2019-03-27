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
 * @TITLE: Customize Woocommerce Cross-Sells Output
 * @DESCRIPTION: modify output of cross-sell products on WooCommerce cart page
 * @DOCUMENTATION AND DISCUSSION: https://qreuz.com/snippets/customize-woocommerce-cross-sells-output/
 * @AUTHOR: Qreuz GmbH
 * @VERSION: 1.0
 */	
 
add_filter( 'woocommerce_cross_sells_total', 'qreuz_modify_cross_sells_count', 20 );
	
	function qreuz_modify_cross_sells_count( $columns ) {
	 $cross_sells = 4;
	 return $cross_sells; // define how many cross sell products shall max. be shown on the cart page
	}