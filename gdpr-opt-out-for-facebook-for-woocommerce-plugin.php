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
 * @TITLE: GDPR Opt-out for Facebook for WooCommerce Plugin
 * @FOR_PLUGIN: Facebook for WooCommerce, https://woocommerce.com/products/facebook/
 * @DESCRIPTION: implement an opt-out functionality for Facebook Pixel used by the Facebook for WooCommerce plugin
 * @DOCUMENTATION AND DISCUSSION: https://qreuz.com/snippets/gdpr-opt-out-for-facebook-for-woocommerce-plugin/
 * @AUTHOR: Qreuz GmbH
 * @VERSION: 1.0
 */	
 
// part 1: conditional deactivation of Facebook Pixel based on cookie value
add_filter('facebook_for_woocommerce_integration_pixel_enabled', 'qreuz_gdpr_facebook_opt_out_check', 20);
	
	function qreuz_gdpr_facebook_opt_out_check(){
		if(!isset($_COOKIE['FacebookOptOut']))	{
			$cookie_domain_parts = parse_url(home_url());
			$cookie_domain = '.'.$cookie_domain_parts['host'];
			$expire_time = time()+(86400*36500); // set expiration time to 100 years
			setcookie('FacebookOptOut','false',$expire_time,'/',$cookie_domain);
			return true;
		}
		elseif ($_COOKIE['FacebookOptOut'] === 'true'){
			return false;
		}
		else{
			return true;
		}
	}
	
// part 2: add JavaScript to head to set cookie value on click on opt-out element with ID "fb-opt-out"
// !important: this needs a clickable element with ID "fb-opt-out" on your page to work. This may be a link in your privacy policy. Read the installation instructions to learn more.
add_action('wp_enqueue_scripts','qreuz_gdpr_facebook_opt_out_script',20);
	
	function qreuz_gdpr_facebook_opt_out_script() {
		$qreuz_opt_out_script = "<script type='text/javascript'>
									var fboptOutLink = document.getElementById(\"fb-opt-out\");
									if(fboptOutLink) {
										fboptOutLink.onclick = function() {
										  var cookieName = \"FacebookOptOut\";
										  var cookieValue = \"true\";
										  document.cookie = cookieName+\"=\"+cookieValue+\"; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/; domain=.\" + location.hostname.replace(/^www\./i, \"\");
										  alert(\"Facebook tracking has been disabled.\");
										}}
								</script>";
		wp_register_script('qreuz_gdpr_facebook_opt_out_script','');
		wp_enqueue_script('qreuz_gdpr_facebook_opt_out_script');
		wp_add_inline_script('qreuz_gdpr_facebook_opt_out_script', $qreuz_opt_out_script);
		return;
	}