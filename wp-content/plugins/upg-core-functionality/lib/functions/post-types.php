<?php
/**
 * Post Types
 *
 * This file registers any custom post types
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @link         https://github.com/billerickson/Core-Functionality
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Create Invoice post type
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */


/**
 *	Register Invoice Type
 *
 *	@author     Ren Ventura/Matt Ryan
 *	@link       http://www.engagewp.com/create-invoices-gravty-forms-wordpress
 */

// add_action( 'init', 'cws_invoice_cpt' );
function cws_invoice_cpt() {

	$labels = array(
		'name'               => _x( 'Invoice', 'post type general name', 'cws' ),
		'singular_name'      => _x( 'Invoice', 'post type singular name', 'cws' ),
		'menu_name'          => _x( 'Invoices', 'admin menu', 'cws' ),
		'name_admin_bar'     => _x( 'Invoice', 'add new on admin bar', 'cws' ),
		'add_new'            => _x( 'Add New', 'Invoice', 'cws' ),
		'add_new_item'       => __( 'Add New Invoice', 'cws' ),
		'new_item'           => __( 'New Invoice', 'cws' ),
		'edit_item'          => __( 'Edit Invoice', 'cws' ),
		'view_item'          => __( 'View Invoice', 'cws' ),
		'all_items'          => __( 'All Invoices', 'cws' ),
		'search_items'       => __( 'Search Invoices', 'cws' ),
		'parent_item_colon'  => __( 'Parent Invoice:', 'cws' ),
		'not_found'          => __( 'No Invoices found.', 'cws' ),
		'not_found_in_trash' => __( 'No Invoices found in Trash.', 'cws' )
	);

	$args = array(
		'description'			=> __( 'Invoice', 'cws' ),
		'labels'				=> $labels,
		'supports'				=> array( 'title' ),
		'hierarchical'			=> false,
		'public'				=> true,
		'publicly_queryable'	=> true,
		'query_var'				=> true,
		'rewrite'				=> array( 'slug' => 'invoice' ),
		'show_ui'				=> true,
		'menu_icon'				=> 'dashicons-cart',
		'show_in_menu'			=> true,
		'show_in_nav_menus'		=> false,
		'show_in_admin_bar'		=> true,
		'menu_position'			=> 5,
		'can_export'			=> true,
		'has_archive'			=> false,
		'exclude_from_search'	=> true,
		'capability_type'		=> 'post',
	);

	register_post_type( 'invoice', $args );

}


/**
 *	Register Proposal Type
 *
 *	@author     Matt Ryan
 *	@link       http://capwebsolutions.com/create-proposal-system-gravty-forms-wordpress
 */

// add_action( 'init', 'cws_proposal_cpt' );
function cws_proposal_cpt() {

	$labels = array(
		'name'               => _x( 'Proposal', 'post type general name', 'cws' ),
		'singular_name'      => _x( 'Proposal', 'post type singular name', 'cws' ),
		'menu_name'          => _x( 'Proposals', 'admin menu', 'cws' ),
		'name_admin_bar'     => _x( 'Proposal', 'add new on admin bar', 'cws' ),
		'add_new'            => _x( 'Add New', 'Proposal', 'cws' ),
		'add_new_item'       => __( 'Add New Proposal', 'cws' ),
		'new_item'           => __( 'New Proposal', 'cws' ),
		'edit_item'          => __( 'Edit Proposal', 'cws' ),
		'view_item'          => __( 'View Proposal', 'cws' ),
		'all_items'          => __( 'All Proposals', 'cws' ),
		'search_items'       => __( 'Search Proposals', 'cws' ),
		'parent_item_colon'  => __( 'Parent Proposal:', 'cws' ),
		'not_found'          => __( 'No Proposals found.', 'cws' ),
		'not_found_in_trash' => __( 'No Proposals found in Trash.', 'cws' )
	);

	$args = array(
		'description'			=> __( 'Proposal', 'cws' ),
		'labels'				=> $labels,
		'supports'				=> array( 'title' ),
		'hierarchical'			=> false,
		'public'				=> true,
		'publicly_queryable'	=> true,
		'query_var'				=> true,
		'rewrite'				=> array( 'slug' => 'proposal' ),
		'show_ui'				=> true,
		'menu_icon'				=> 'dashicons-format-quote',
		'show_in_menu'			=> true,
		'show_in_nav_menus'		=> false,
		'show_in_admin_bar'		=> true,
		'menu_position'			=> 5,
		'can_export'			=> true,
		'has_archive'			=> false,
		'exclude_from_search'	=> true,
		'capability_type'		=> 'post',
	);

	register_post_type( 'proposal', $args );

}
