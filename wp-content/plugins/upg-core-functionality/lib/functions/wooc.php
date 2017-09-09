<?php
/**
 * WooC
 *
 * This file contains functions realted to WooCommerce customizations
 *
 * @package   Core_Functionality
 * @since        1.0.0
 * @Plugin URI: https://github.com/mattry/upg-core-cunctionality
 * @author			Matt Ryan [Cap Web Solutions] <matt@mattryan.co>
 * @copyright  Copyright (c) 2016, Cap Web Solutions
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */


/**
 * Make sure our Genesis theme is aware of WooCommerce.
 */
add_theme_support( 'genesis-connect-woocommerce' );


/**
 * remove default sorting dropdown
 */
// remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

/**
 * Remove sidebar from single product pages by
 * Force full width layout on all product pages
 */

add_filter( 'genesis_pre_get_option_site_layout', 'full_width_layout_single_pages' );
/**
* @author Brad Dalton
* @link http://wpsites.net/web-design/change-layout-genesis/
*/
function full_width_layout_single_pages( $opt ) {
if ( is_product() ) {
    $opt = 'full-width-content';
    return $opt;
    }
}

/**
 * Change number or products per row
 */
if (!function_exists('_cws_loop_columns')) {
   	function cws_loop_columns() {
      if ( is_shop() ) return 5;   // 5 across on shop archive page displaying categories only
   		return 4; // 4 products per row
   	}
}
add_filter('loop_shop_columns', 'cws_loop_columns');

/**
 * Change number or products per page
 */
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

 /**
  * Plugin Name: WooCommerce - List Products by Tags
  * Plugin URI: http://www.remicorson.com/list-woocommerce-products-by-tags/
  * Description: List WooCommerce products by tags using a shortcode,
  *   ex: [woo_products_by_tags tags="shoes,socks"]
  * Version: 1.0
  * Author: Remi Corson
  * Author URI: http://remicorson.com
  * Requires at least: 3.5
  * Tested up to: 3.5
  *
  */
 function woo_products_by_tags_shortcode( $atts, $content = null ) {
  	// Get attributess
 	extract(shortcode_atts(array(
 		"tags" => ''
 	), $atts));

 	ob_start();

 	// Define Query Arguments
 	$args = array(
 				'post_type' 	 => 'product',
 				'posts_per_page' => 5,
 				'product_tag' 	 => $tags
 				);

 	// Create the new query
 	$loop = new WP_Query( $args );

 	// Get products number
 	$product_count = $loop->post_count;

 	// If results
 	if( $product_count > 0 ) :
 		echo '<ul class="products">';

 			// Start the loop
 			while ( $loop->have_posts() ) : $loop->the_post(); global $product;
 				global $post;
 				echo "<p>" . $thePostID = $post->post_title. " </p>";
 				if (has_post_thumbnail( $loop->post->ID ))
 					echo  get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
 				else
 					echo '<img src="'.$woocommerce->plugin_url().'/assets/images/placeholder.png" alt="" width="'.$woocommerce->get_image_size('shop_catalog_image_width').'px" height="'.$woocommerce->get_image_size('shop_catalog_image_height').'px" />';
 			endwhile;
 		echo '</ul><!--/.products-->';
 	else :
 		_e('No product matching your criteria.');
 	endif; // endif $product_count > 0
 	return ob_get_clean();
 }
 add_shortcode("woo_products_by_tags", "woo_products_by_tags_shortcode");

/**
 * Change PayPal logo
 */
function replacePayPalIcon($iconUrl) {
 	return get_bloginfo('stylesheet_directory') . '/images/secured-by-paypal-logo.png';
}
add_filter('woocommerce_paypal_icon', 'replacePayPalIcon');

/**
 * Removes Catagory Counters
 */
function woo_remove_category_products_count() {
 return;
}
add_filter( 'woocommerce_subcategory_count_html', 'woo_remove_category_products_count' );

/**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 * @link: https://docs.woocommerce.com/document/hide-other-shipping-methods-when-free-shipping-is-available/
 */
function cws_hide_shipping_when_free_is_available( $rates ) {
	$free = array();

	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}

	return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'cws_hide_shipping_when_free_is_available', 100 );



/**
 * Let's turn off that Ship to a different address box!
 */
add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false');


// Set limit to number of characters permitted on gift card. 
function wc_add_checkout_add_ons_attributes( $checkout_fields ) {
    $add_on_id = 4; // 4 is the card message
    if ( isset( $checkout_fields['add_ons'][ 'wc_checkout_add_ons_' . $add_on_id ] ) ) {
        $checkout_fields['add_ons'][ 'wc_checkout_add_ons_' . $add_on_id ]['maxlength']   = "100";
        $checkout_fields['add_ons'][ 'wc_checkout_add_ons_' . $add_on_id ]['description']   = "Please add no more than 100 characters.";

        //Adds a maximum character length + description to this add on
    }

    return $checkout_fields;
}
add_filter( 'woocommerce_checkout_fields', 'wc_add_checkout_add_ons_attributes', 20 );


function cws_add_gift_wrap_image( ) {
  echo '<div class="gift-wrap-image"><img class="size-thumbnail wp-image-971 alignright" src="https://uniquepuzzlesgames.com/wp-content/uploads/2016/09/gift-wrapping-for-UPG-150x150.jpg" alt="gift wrapping from Unique Puzzles and Games" width="150" height="150" /></div>';
}
add_action( 'woocommerce_checkout_after_customer_details', 'cws_add_gift_wrap_image' );


/**
 * Hide Add to Cart on front page
 */
 
add_action('init', 'cws_hide_add_cart_on_front');
 
function cws_hide_add_cart_on_front() { 
  if (is_home() || is_front_page() || is_archive()) {       
   remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
   // remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
   // remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );  
  }
}