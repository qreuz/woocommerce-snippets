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
 * @TITLE       Reorder Tabs on WooCommerce Product Page
 * @VERSION     1.0
 * @DESCRIPTION Reorders the tabs on WooCommerce product pages
 * @LINK        https://qreuz.com/snippets/
 * @AUTHOR      Qreuz GmbH <hello@qreuz.com>
 * @LICENSE     GNU GPL v3 https://www.gnu.org/licenses/gpl-3.0
 */

/**
 * This function will allow you to customize the order of the tabs on WooCommerce product pages.
 * Change the priority values to change the order of the tabs.
 * Lower number means higher position in the order.
**/
function qreuz_reorder_tabs_product_page( $tabs ) {
	$tabs['description']['priority'] = 5;
    $tabs['additional_information']['priority'] = 10;
    $tabs['reviews']['priority'] = 15;
    
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'qreuz_reorder_tabs_product_page', 98 );
