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
 * @TITLE: Disable Facebook Pixel on Facebook for WooCommerce Plugin
 * @FOR_PLUGIN: Facebook for WooCommerce, https://woocommerce.com/products/facebook/
 * @DESCRIPTION: completely disables the Facebook Pixel on the Facebook for WooCommerce plugin
 * @DOCUMENTATION AND DISCUSSION: https://qreuz.com/snippets/disable-facebook-pixel-on-facebook-for-woocommerce-plugin/
 * @AUTHOR: Qreuz GmbH
 * @VERSION: 1.0
 */		

add_filter('facebook_for_woocommerce_integration_pixel_enabled', '__return_false', 20);
```