<?
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
 * Don't know what a child theme is? Read this post: https://qreuz.com/
 *
 * COPY AND PASTE EVERYTHING BELOW THIS LINE TO YOUR FUNCTIONS.PHP **/

/**
 * QREUZ SNIPPET FOR WOOCOMMERCE / WORDPRESS
 * @TITLE: GDPR Opt-out for SendinBlue Wordpress Plugin
 * @FOR_PLUGIN: SendinBlue Subscribe Form And WP SMTP, https://wordpress.org/plugins/mailin/
 * @DESCRIPTION: implement an opt-out functionality for Sendinblue marmketing automation used by the SendinBlue Subscribe Form And WP SMTP plugin
 * @DOCUMENTATION AND DISCUSSION: https://qreuz.com/snippets/gdpr-opt-out-for-sendinblue-wordpress-plugin/
 * @AUTHOR: Qreuz GmbH
 * @VERSION: 1.0
 */	
 
// part 1: conditional deactivation of Sendinblue tracking code based on cookie value

add_action('init', 'qreuz_gdpr_sendinblue_tracking', 20);
	
	// this function published the Sendinblue script if the opt-out cookie is not set to true
	function qreuz_gdpr_sendinblue_tracking(){
		
		if(!isset($_COOKIE['SendinblueOptOut']))	{
			$cookie_domain_parts = parse_url(home_url());
			$cookie_domain = '.'.$cookie_domain_parts['host'];
			$expire_time = time()+(86400*36500); // set expiration time to 100 years
			setcookie("SendinblueOptOut", "false", $expire_time, '/', $cookie_domain);
			return;
		}
		elseif ($_COOKIE['SendinblueOptOut'] === 'true'){
			
			add_action ('wp_loaded','qreuz_sendinblue_gdpr_opt_out'); // disables Sendinblue marketing automation tracking
				
				function qreuz_sendinblue_gdpr_opt_out(){
					remove_action( 'wp_head', array(SIB_Manager::$instance, 'install_ma_script' ));
					return;
				}
				
			return;
		}
		else	{
			
			return;
			
		}
	}
	
// part 2: add JavaScript to head to set cookie value on click on opt-out element with ID "sib-opt-out"
// !important: this needs a clickable element with ID "sib-opt-out" on your page to work. This may be a link in your privacy policy. Read the installation instructions to learn more.
add_action('wp_enqueue_scripts','qreuz_gdpr_sendinblue_opt_out_script',20);
	
	function qreuz_gdpr_sendinblue_opt_out_script() {
		$qreuz_opt_out_script = "var siboptOutLink = document.getElementById(\"sib-opt-out\");
									if(siboptOutLink) {
										siboptOutLink.onclick = function() {
										  var cookieName = \"SendinblueOptOut\";
										  var cookieValue = \"true\";
										  document.cookie = cookieName+\"=\"+cookieValue+\"; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/; domain=.\" + location.hostname.replace(/^www\./i, \"\");
										  alert(\"Sendinblue tracking has been disabled.\");
										}}";
		wp_register_script('qreuz_gdpr_sendinblue_opt_out_script','','','','true');
		wp_enqueue_script('qreuz_gdpr_sendinblue_opt_out_script');
		wp_add_inline_script('qreuz_gdpr_sendinblue_opt_out_script', $qreuz_opt_out_script);
		return;
	} 
