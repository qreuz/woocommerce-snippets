```php
<?php
/**
 *
 *  ██████╗ ██████╗ ███████╗██╗   ██╗███████╗
 * ██╔═══██╗██╔══██╗██╔════╝██║   ██║╚══███╔╝
 * ██║   ██║██████╔╝█████╗  ██║   ██║  ███╔╝
 * ██║▄▄ ██║██╔══██╗██╔══╝  ██║   ██║ ███╔╝
 * ╚██████╔╝██║  ██║███████╗╚██████╔╝███████╗
 *  ╚══▀▀═╝ ╚═╝  ╚═╝╚══════╝ ╚═════╝ ╚══════╝
 *
 * QREUZ SNIPPET FOR WOOCOMMERCE
 * This file is part of a collection of snippets to be used on your WooCommerce store.
 * !! Do not put this file in your WordPress installation !!
 *
 * Copy/paste the code below and add it to the functions.php of your child theme.
 * Don't know what a child theme is? Read this post: https://qreuz.com/
 *
 * COPY AND PASTE EVERYTHING BELOW THIS LINE TO YOUR FUNCTIONS.PHP */

/**
 * QREUZ SNIPPET FOR WOOCOMMERCE / WORDPRESS
 *
 * @TITLE       Remove Tabs from WooCommerce Product Page
 * @VERSION     1.0
 * @DESCRIPTION Removes tabs from WooCommerce product pages
 * @LINK        https://qreuz.com/snippets/remove-tabs-from-woocommerce-product-page/
 * @AUTHOR      Qreuz GmbH <hello@qreuz.com>
 * @LICENSE     GNU GPL v3 https://www.gnu.org/licenses/gpl-3.0
 */

/**
 * This function will remove all tabs from WooCommerce product pages.
 * You can customize this snippet to select which tab to remove.
**/
function qreuz_remove_tabs_product_page( $tabs ) {
    unset( $tabs['additional_information'] ); // Removes the tab 'additional information'
    unset( $tabs['description'] );      	// Remove the tab 'description'
    unset( $tabs['reviews'] ); 			// Remove the tab 'reviews'
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'qreuz_remove_tabs_product_page', 98 );
```