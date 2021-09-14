```php
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
 * @TITLE: Increase WooCommerce AJAX Variation Treshold (Enable Conditional Variations)
 * @DESCRIPTION: increases the treshhold of variations to enable conditional display of variations if your product has many variations
 * @DOCUMENTATION AND DISCUSSION: https://qreuz.com/snippets/increase-woocommerce-ajax-variation-treshold-enable-conditional-variations/
 * @AUTHOR: Qreuz GmbH
 * @VERSION: 1.0
 */
 
add_filter( 'woocommerce_ajax_variation_threshold', 'qreuz_ajax_variation_treshold_modification', 10, 2 );
	
	function qreuz_ajax_variation_treshold_modification( $threshold, $product ){
	  $threshold = '999';
	  return  $threshold;
	}
```