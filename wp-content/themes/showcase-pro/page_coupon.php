<?php
/**
 * This file adds the Coupon page template to the Showcase Pro Theme.
 *
 * @author Matt Ryan / Cap Web Solutions
 * @package Showcase Pro Theme
 * @subpackage Customizations
 */

/*
Template Name: Coupon
*/
$coupon_code = 'signupwelcome10'; // Code
$amount = '10'; // Amount
$discount_type = 'store_credit_gift_certificate'; // Type: fixed_cart, percent, fixed_product, percent_product

$coupon = array(
	'post_title' => $coupon_code,
	'post_content' => '',
	'post_status' => 'publish',
	'post_author' => 1,
	'post_type'		=> 'shop_coupon'
);

$new_coupon_id = wp_insert_post( $coupon );

// Add meta
update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
update_post_meta( $new_coupon_id, 'coupon_amount', $amount );
update_post_meta( $new_coupon_id, 'customer_email', 'xx' );
update_post_meta( $new_coupon_id, 'product_ids', '' );
update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
update_post_meta( $new_coupon_id, 'usage_limit', '' );
update_post_meta( $new_coupon_id, 'expiry_date', '' );
update_post_meta( $new_coupon_id, 'apply_before_tax', 'yes' );
update_post_meta( $new_coupon_id, 'free_shipping', 'no' );

var_dump($new_coupon_id);
