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
 * @TITLE: Customize WooCommerce Upsells Output
 * @DESCRIPTION: modify output of upsell products on WooCommerce product pages
 * @DOCUMENTATION AND DISCUSSION: https://qreuz.com/snippets/customize-woocommerce-upsells-output/
 * @AUTHOR: Qreuz GmbH
 * @VERSION: 1.0
 */
 
add_filter( 'woocommerce_upsell_display_args', 'qreuz_modify_upsells_output', 20 );
	
	function qreuz_modify_upsells_output( $args ) {
	 $args['posts_per_page'] = 4; // define how many upsell products shall be shown on the product pages
	 $args['columns'] = 4; // define across how many columns the products shall be split
	 return $args;
	}
```