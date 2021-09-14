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
 * @TITLE: Hide WooCommerce Backend Login for Non-Admins
 * @DESCRIPTION: hide the default Wordpress login page and prevent WooCommerce backend access for non-admins
 * @DOCUMENTATION AND DISCUSSION: https://qreuz.com/snippets/hide-woocommerce-backend-login-for-non-admins/
 * @AUTHOR: Qreuz GmbH
 * @VERSION: 1.0
 */	



add_action( 'init', 'qreuz_hide_admin_pages' );

	function qreuz_hide_admin_pages() {
		if ( is_admin() && ! current_user_can( 'administrator' ) &&
		! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		wp_redirect( home_url() );
		exit;
		}
	}
```