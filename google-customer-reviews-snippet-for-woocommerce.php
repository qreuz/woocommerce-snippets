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
 * !! Do not put this file in your Wordpress installation !!
 *
 * Copy/paste the code below and add it to the functions.php of your child theme.
 * Don't know what a child theme is? Read this post: https://qreuz.com/
 *
 * COPY AND PASTE EVERYTHING BELOW THIS LINE TO YOUR FUNCTIONS.PHP 
 * 
 * QREUZ SNIPPET FOR WOOCOMMERCE / WORDPRESS
 * 
 * @TITLE Google Customer Reviews Snippet for WooCommerce
 * 
 * @AUTHOR      Qreuz GmbH <hello@qreuz.com>
 * @LICENSE     GPL v3 https://www.gnu.org/licenses/gpl-3.0
 * @VERSION     1.4
 * @DESCRIPTION Implements the necessary snippets to WooCommerce for collecting Google Customer Reviews from customers after purchase
 * @FOR         Google Customer Reviews, https://support.google.com/merchants/answer/7124319
 * @LINK        https://qreuz.com/snippets/google-customer-reviews-snippet-for-woocommerce/
 */

/**
 * This function will set the language for your GCR opt-in (and your GCR badge if you integrate it).
 * replace the lang code with your store´s language; available languages can be found at https://support.google.com/merchants/answer/7106244
 * 
 * @return void;
 */
function qreuzGoogleCustomerReviewsLanguage()
{
    $qreuz_customer_reviews_language_script = 'window.___gcfg = {lang: \'en_US\'};';

        wp_register_script('qreuz_customer_reviews_language_script', '', '', '', 'true');
        wp_enqueue_script('qreuz_customer_reviews_language_script');
        wp_add_inline_script('qreuz_customer_reviews_language_script', $qreuz_customer_reviews_language_script);
    return;
} 
add_action('wp_enqueue_scripts', 'QreuzGoogleCustomerReviewsLanguage', 20);

/**
 * Adds the Google Customer Reviews opt-in form to the checkout confirmation page
 * Add your merchant ID where the placeholder is.
 * 
 * @param int|string $order_id WooCommerce order id
 * 
 * @return void;
 */
function qreuzGoogleCustomerReviewsOptIn($order_id)
{

    $order = new WC_Order($order_id);

    $qreuz_google_customer_reviews_opt_in_script_js = '<script src="https://apis.google.com/js/platform.js?onload=renderOptIn" async defer></script>';

    echo $qreuz_google_customer_reviews_opt_in_script_js;

    $qreuz_google_customer_reviews_opt_in_script = '			
			  window.renderOptIn = function() {
				window.gapi.load(\'surveyoptin\', function() {
				  window.gapi.surveyoptin.render(
					{
					  // REQUIRED FIELDS
					  "merchant_id": YOUR_MERCHANT_ID_HERE, // place your merchant ID here, get it from your Merchant Center at https://merchants.google.com/mc/merchantdashboard
					  "order_id": "'. $order->get_order_number() .'",
					  "email": "'. $order->get_billing_email() .'",
					  "delivery_country": "'. $order->get_billing_country() .'",
					  "estimated_delivery_date": "'. date("Y-m-d", strtotime("+5 day", strtotime($order->get_date_created()))) .'",  // replace "5 day" with the estimated delivery time of your orders
					  "opt_in_style": "CENTER_DIALOG"
					});
				});
			  }';

    wp_register_script('qreuz_google_customer_reviews_opt_in_script', '', '', '', 'true');
    wp_enqueue_script('qreuz_google_customer_reviews_opt_in_script');
    wp_add_inline_script('qreuz_google_customer_reviews_opt_in_script', $qreuz_google_customer_reviews_opt_in_script);

    return;
}
add_action('woocommerce_thankyou', 'qreuzGoogleCustomerReviewsOptIn');


/**
 * Adds the GCR rating badge to your storefront.
 * Add your merchant ID and set the positioning of the rating badge as you like.
 * 
 * @return void;
 */
function qreuzGoogleCustomerReviewsBadge()
{
    $qreuz_google_customer_reviews_script = '<script src="https://apis.google.com/js/platform.js?onload=renderBadge" async defer></script>';
    echo $qreuz_google_customer_reviews_script;

    $qreuz_google_customer_reviews_badge_script = '
			  window.renderBadge = function() {
				var ratingBadgeContainer = document.createElement("div");
				document.body.appendChild(ratingBadgeContainer);
				window.gapi.load(\'ratingbadge\', function() {
				  window.gapi.ratingbadge.render(ratingBadgeContainer, {
					// REQUIRED
					 "merchant_id": YOUR_MERCHANT_ID_HERE, // place your merchant ID here, get it from your Merchant Center at https://merchants.google.com/mc/merchantdashboard
					// OPTIONAL
					"position": "BOTTOM_RIGHT" // find out more about positioning at https://support.google.com/merchants/answer/7105655
					});
				});
			  }';

    wp_register_script('qreuz_google_customer_reviews_badge_script', '', '', '', 'true');
    wp_enqueue_script('qreuz_google_customer_reviews_badge_script');
    wp_add_inline_script('qreuz_google_customer_reviews_badge_script', $qreuz_google_customer_reviews_badge_script);


    return;
}
add_action('wp_enqueue_scripts', 'qreuzGoogleCustomerReviewsBadge', 20);