<?php
/**
 * This file adds the Fuller Width page template to the Showcase Pro Theme.
 *
 * @author Matt Ryan
 * @package Showcase Pro Theme
 * @subpackage Customizations
 */

/*
Template Name: Fuller Width
*/

//* Force fuller-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_fuller_width_content' );

//* Add fuller-width body class to the head
add_filter( 'body_class', 'cws_showcase_add_body_class' );
function cws_showcase_add_body_class( $classes ) {

	$classes[] = 'fuller-width';
	return $classes;

}

//* Run the Genesis loop
genesis();
