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
 * @TITLE       Add Custom Order Status to WooCommerce
 * @VERSION     1.1
 * @DESCRIPTION Adds a custom order status to WooCommerce
 * @LINK        https://qreuz.com/snippets/add-custom-order-status-to-woocommerce/
 * @AUTHOR      Qreuz GmbH <hello@qreuz.com>
 * @LICENSE     GNU GPL v3 https://www.gnu.org/licenses/gpl-3.0
 */

$qreuz_custom_order_status = 'order status name'; // set your custom order status name here

/**
 * This function will register a new custom order status for you.
 * Set the name above in the variable.
**/
function qreuz_register_custom_order_status() {

	global $qreuz_custom_order_status;
	register_post_status(
		'wc-custom-status',
		array(
			'label'                     => $qreuz_custom_order_status,
			'public'                    => true,
			'exclude_from_search'       => false,
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'label_count'               => _n_noop( $qreuz_custom_order_status . ' <span class="count">(%s)</span>', $qreuz_custom_order_status . ' <span class="count">(%s)</span>' ),
		)
	);
}
add_action( 'init', 'qreuz_register_custom_order_status' );

/**
 * Add the custom order status to the list of order statuses.
 * You can customize the position of your new order status by modifying the line with 'wc-failed'.
 * Possible values are, e.g. wc-pending, wc-processing, wc-on-hold, wc-completed.
 */
function qreuz_add_custom_order_status_to_order_statuses( $order_statuses ) {

	global $qreuz_custom_order_status;
	$new_order_statuses = array();

	foreach ( $order_statuses as $key => $status ) {

		$new_order_statuses[ $key ] = $status;

		if ( 'wc-failed' === $key ) {
			$new_order_statuses['wc-custom-status'] = $qreuz_custom_order_status;
		}
	}

	return $new_order_statuses;
}
add_filter( 'wc_order_statuses', 'qreuz_add_custom_order_status_to_order_statuses' );
