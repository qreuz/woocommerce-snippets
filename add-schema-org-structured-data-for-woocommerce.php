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
 * @TITLE: Add schema.org Structured Data for WooCommerce
 * @DESCRIPTION: adds structured data according to schema.org to pages, posts, archives, and product pages
 * @DOCUMENTATION AND DISCUSSION: https://qreuz.com/snippets/add-schema-org-structured-data-for-woocommerce/
 * @AUTHOR: Qreuz GmbH
 * @VERSION: 1.0
 */

// OPTIONAL: disable Yoast structured data (useful if you use the Yoast SEO plugin)	
// add_filter( 'disable_wpseo_json_ld_search', '__return_true' );


if( ! is_admin() ) {
	new qreuz_structured_data();
}

class qreuz_structured_data {

	public function __construct() {
		add_action ( 'wp_footer', array( $this, 'qreuz_add_json_markup' ), 10);
	}

	public function qreuz_add_json_markup() {
		
		global $post;
		
		if ( ! $post ) {
			return;
		}
		
		$schema_publisher_name  = $this->qreuz_strip_text( get_bloginfo( 'name' ));
		
		$schema_publisher_type  = 'Organization';
		
		// set your social media links here (if available)
		$schema_social_media_urls = array(
							"https://www.facebook.com/YOUR_FACEBOOK_URL",
							"https://twitter.com/YOUR_TWITTER_URL",
							"https://www.instagram.com/YOUR_INSTAGRAM_URL",
							"https://www.linkedin.com/YOUR_LINKEDIN_URL"
						);
		
		// determine post type and set data accordingly
		switch ($post->post_type) {
			case 'post':
				$schema_type = 'Article';
				$author_type = 'Person';
				$author_name = get_the_author_meta( 'display_name', $post->post_author );
				break;
			case 'page':
				$schema_type = 'WebPage';
				$author_type = 'Organization';
				$author_name = $schema_publisher_name;
				break;
			case 'product':
				$schema_type = 'Product';
				$author_type = 'Brand';
				$author_name = $schema_publisher_name;
				break;
			default:
				$schema_type = 'WebPage';
				$author_type = 'Organization';
				$author_name = $schema_publisher_name;
		}
		
			$author_name = $this->qreuz_strip_text( $author_name );
			
			$schema_logo  = wp_get_attachment_url( get_theme_mod( 'custom_logo' ), 'full' ); // sets the theme's custom logo as organization logo
				if ('' === $schema_logo){
					$schema_logo  = wp_get_attachment_url( get_post_thumbnail_id(get_option('page_on_front')), 'full' ); // sets the featured image of the home page as organization logo if there is no custom logo
				}
			
			$schema_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
			
			if ( empty( $schema_image ) ) {
				$schema_image = $schema_logo;
			}
			
			if (is_front_page()){
				$headline = $this->qreuz_strip_text( get_bloginfo( 'name' ));
			}
			else {
				$headline = $this->qreuz_strip_text( $post->post_title );
			}
			
			$content  = $this->qreuz_strip_text( get_post_meta( $post->ID, '_yoast_wpseo_metadesc', true )); // uses content from Yoast SEO's description field if available

			if ( '' === $content ) $content = $this->qreuz_strip_text( get_post_meta( $post->ID, '_aioseop_description', true )); // uses content from All in One SEO's description field if available
			
			  if ( '' === $content ) {
				$content  = $this->qreuz_strip_text( $post->post_excerpt );
				if ( '' === $content ) {
				  $content = $this->qreuz_strip_text( $post->post_content );
				  $content = mb_substr( $content, 0, 110 );
				}
			  }

			$schema_post_id = site_url() . str_replace( site_url(), '', get_permalink( $post->ID ));
			
			$date_published = get_the_time( DATE_ISO8601, $post->ID );
			
			$date_modified  = get_post_modified_time(DATE_ISO8601, __return_false(), $post->ID);
			
			// defines structured data output for individual product pages
			if(is_product()){

				$product = wc_get_product($post->ID);
				
				$sku = $product->get_sku();
				
				$qreuz_schema_output = array(
					"@context" => "http://schema.org",
					"@type"    => $schema_type,
					"mainEntityOfPage" => array(
						"@type" => "WebPage",
						"@id"   => $schema_post_id
					),
					"name" => $headline,
					"sku" => $sku,
					"mpn" => $sku,
					"image"    => array(
						"@type"  => "ImageObject",
						"url"    => $schema_image,
						"width"  => "auto",
						"height" => "auto"
					),
					"brand" => array(
						"@type" => $author_type,
						"name"  => $author_name,
						"logo"  => array(
							"@type"  => "ImageObject",
							"url"    => $schema_logo,
							"width"  => "auto",
							"height" => "auto"
						),
						"sameAs" => $schema_social_media_urls
					),
					"url" => $schema_post_id,
					"description" => $content
				);
			}
			// defines structured data output for archive pages
			elseif (is_archive()){
				
				$archive_title = get_the_archive_title();
				
				$archive_description  = $this->qreuz_strip_text( get_term_meta( get_queried_object_id(), '_yoast_wpseo_metadesc', true ));
				
					if ( '' === $archive_description ) {
						
						$archive_description  = $this->qreuz_strip_text( get_the_archive_description() );
						
						if ( '' === $archive_description ) {
							
						$archive_description  = $this->qreuz_strip_text( $archive_title );
						
						}
					}
					
				if (is_category()){
					$archive_permalink = get_category_link( get_queried_object_id() );
				}
				elseif ( is_tax() ) { 
					$archive_permalink = get_term_link( get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				}
				elseif( is_post_type_archive() ) {
					$archive_permalink = get_post_type_archive_link( get_query_var('post_type') );
				}
				else {
					$archive_permalink = get_permalink();
				}	
				
				$qreuz_schema_output = array(
					"@context" => "http://schema.org",
					"@type"    => 'WebPage',
					"mainEntityOfPage" => array(
						"@type" => "WebPage",
						"@id"   => $archive_permalink
					),
					"headline" => $archive_title,
					"image"    => array(
						"@type"  => "ImageObject",
						"url"    => $schema_logo,
						"width"  => "auto",
						"height" => "auto"
					),
					"publisher" => array(
						"@type" => $schema_publisher_type,
						"name"  => $schema_publisher_name,
						"logo"  => array(
							"@type"  => "ImageObject",
							"url"    => $schema_logo,
							"width"  => "auto",
							"height" => "auto"
						),
						"sameAs" => $schema_social_media_urls
					),
					"description" => $archive_description
				);
			}
			// defines structured data output for pages
			elseif (is_page()){
				$qreuz_schema_output = array(
					"@context" => "http://schema.org",
					"@type"    => $schema_type,
					"mainEntityOfPage" => array(
						"@type" => "WebPage",
						"@id"   => $schema_post_id
					),
					"headline" => $headline,
					"image"    => array(
						"@type"  => "ImageObject",
						"url"    => $schema_image,
						"width"  => "auto",
						"height" => "auto"
					),
					"publisher" => array(
						"@type" => $schema_publisher_type,
						"name"  => $schema_publisher_name,
						"logo"  => array(
							"@type"  => "ImageObject",
							"url"    => $schema_logo,
							"width"  => "auto",
							"height" => "auto"
						),
						"sameAs" => $schema_social_media_urls
					),
					"description" => $content
				);
			}
			// defines structured data output for everything else (e.g. posts or other post types)
			else {
		
				$qreuz_schema_output = array(
					"@context" => "http://schema.org",
					"@type"    => $schema_type,
					"mainEntityOfPage" => array(
						"@type" => "WebPage",
						"@id"   => $schema_post_id
					),
					"headline" => $headline,
					"image"    => array(
						"@type"  => "ImageObject",
						"url"    => $schema_image,
						"width"  => "auto",
						"height" => "auto"
					),
					"datePublished" => $date_published,
					"dateModified"  => $date_modified,
					"author" => array(
						"@type" => $author_type,
						"name"  => $author_name
					),
					"publisher" => array(
						"@type" => $schema_publisher_type,
						"name"  => $schema_publisher_name,
						"logo"  => array(
							"@type"  => "ImageObject",
							"url"    => $schema_logo,
							"width"  => "auto",
							"height" => "auto"
						),
						"sameAs" => $schema_social_media_urls
					),
					"description" => $content
				);
			}
			
			// output of all schema.org structured data
			$this->qreuz_schema_json_echo( $qreuz_schema_output );
	}

	// function to escape / strip text
	private function qreuz_strip_text( $text ) {
		$text = str_replace( array( '\r', '\n' ), '', strip_tags( $text ) );
		return $text;
	}

	// echo structured data in JSON format
	private function qreuz_schema_json_echo( $qreuz_schema_output ) {
		echo '<script type="application/ld+json">', PHP_EOL;
		echo json_encode($qreuz_schema_output, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), PHP_EOL;
		echo '</script>', PHP_EOL;
	}
}
