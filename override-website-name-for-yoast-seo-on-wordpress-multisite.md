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
 * @TITLE: Override Website Name for Yoast SEO on Wordpress Multisite
 * @DESCRIPTION: manually set the site name to be used by Yoast SEO
 * @DOCUMENTATION AND DISCUSSION: https://qreuz.com/snippets/override-website-name-for-yoast-seo-on-wordpress-multisite/
 * @AUTHOR: Qreuz GmbH
 * @VERSION: 1.0
 */	
 
add_filter('wpseo_opengraph_site_name', 'qreuz_seo_site_name' );

	function qreuz_seo_site_name(){
		return 'YOUR_SITE_NAME'; // replace with your site's name
	}
```
