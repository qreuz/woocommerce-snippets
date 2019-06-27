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
 * @TITLE       Rename Tabs on WooCommerce Product Page
 * @VERSION     1.0
 * @DESCRIPTION Renames the tabs on WooCommerce product pages
 * @LINK        https://qreuz.com/snippets/
 * @AUTHOR      Qreuz GmbH <hello@qreuz.com>
 * @LICENSE     GNU GPL v3 https://www.gnu.org/licenses/gpl-3.0
 */

/**
 * This function will allow you to customize the names of the tabs on WooCommerce product pages.
**/
function qreuz_rename_tabs_product_page( $tabs ) {
    $tabs['description']['title'] = __( 'Description title' );		// Set your title for the description tab here
	$tabs['reviews']['title'] = __( 'Ratings title' );				// Set your title for the reviews tab here
	$tabs['additional_information']['title'] = __( 'Additional information title' );	// Set your title for the additional information tab here

    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'qreuz_rename_tabs_product_page', 98 );
