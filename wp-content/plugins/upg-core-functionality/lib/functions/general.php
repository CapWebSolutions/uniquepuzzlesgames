<?php
/**
 * General
 *
 * This file contains any general functions
 *
 * @package   Core_Functionality
 * @since        1.0.0
 * @author			Matt Ryan [Cap Web Solutions] <matt@mattryan.co>
 * @copyright  Copyright (c) 2016, Cap Web Solutions
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

add_filter( 'http_request_args', 'cws_core_functionality_hidden', 5, 2 );
/**
 * Don't Update Plugin
 * @since 1.0.0
 *
 * This prevents you being prompted to update if there's a public plugin
 * with the same name.
 *
 * @author Mark Jaquith
 * @link http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
 *
 * @param array $r, request arguments
 * @param string $url, request url
 * @return array request arguments
 */

function cws_core_functionality_hidden( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/plugins/update-check' ) )
		return $r; // Not a plugin update request. Bail immediately.
	$plugins = unserialize( $r['body']['plugins'] );
	unset( $plugins->plugins[ plugin_basename( __FILE__ ) ] );
	unset( $plugins->active[ array_search( plugin_basename( __FILE__ ), $plugins->active ) ] );
	$r['body']['plugins'] = serialize( $plugins );
	return $r;
}

/**
  * Permit Use of shortcodes in widgets
  */
add_filter( 'widget_text', 'do_shortcode' );

/**
  * Remove theme and plugin editor links
  */
function cws_hide_editor_and_tools() {
	remove_submenu_page('themes.php','theme-editor.php');
	remove_submenu_page('plugins.php','plugin-editor.php');
}
add_action('admin_init','cws_hide_editor_and_tools');


/**
* Search Shortcode Excerpt
* @since 1.1 Genesis 404 Page plugin
* @author Bill Erickson
*
* Add shortcode for search form in Genesis Framework
*/
function search_shortcode() {
  return '<div class="genesis-404-search">' . get_search_form( false ) . '</div>';
}
add_shortcode( 'genesis-404-search', array( $this, 'search_shortcode' ) );

/*
 * Prevent the Jetpack publicize connections from being auto-selected,
 * so you need to manually select them if you’d like to publicize something.
 * Source: http://jetpack.me/2013/10/15/ever-accidentally-publicize-a-post-that-you-didnt/
 */
add_filter( 'publicize_checkbox_default', '__return_false' );


/**
 * Remove Menu Items
 * @since 1.0.0
 *
 * Remove unused menu items by adding them to the array.
 * See the commented list of menu items for reference.
 *
 */
function cws_remove_menus () {
	global $menu;
	$restricted = array( );
	// Example: $restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}
add_action( 'admin_menu', 'cws_remove_menus' );

/**
 * Customize Admin Bar Items
 * @since 1.0.0
 * @link http://wp-snippets.com/addremove-wp-admin-bar-links/
 */
 function cws_admin_bar_items() {
	global $wp_admin_bar;
	$wp_admin_bar -> remove_menu( 'new-link', 'new-content' );
}
add_action( 'wp_before_admin_bar_render', 'cws_admin_bar_items' );


add_filter( 'menu_order', 'cws_custom_menu_order' );
add_filter( 'custom_menu_order', 'cws_custom_menu_order' );
/**
 * Customize Menu Order
 * @since 1.0.0
 *
 * @param array $menu_ord. Current order.
 * @return array $menu_ord. New order.
 *
 */
function cws_custom_menu_order( $menu_ord ) {
	if ( !$menu_ord ) return true;
	return array(
		'index.php', // this represents the dashboard link
		'edit.php?post_type=page', //the page tab
		'edit.php', //the posts tab
		'edit-comments.php', // the comments tab
		'upload.php', // the media manager
    'themes.php', // Appearance
    'plugins.php', // Plugins
    'separator1', // --Space--
    'tools.php', // Tools
    'options-general.php', // Settings
    'users.php', // Users
    'separator2', // --Space--
    'edit-comments.php', // Comments
    );
}


/**
 * Automatically link Twitter names to Twitter URL
 * @since 1.0.0
 * @ref https://www.nutsandboltsmedia.com/how-to-create-a-custom-functionality-plugin-and-why-you-need-one/
 */
add_filter('the_content', 'twtreplace');
add_filter('comment_text', 'twtreplace');
function twtreplace($content) {
	$twtreplace = preg_replace('/([^a-zA-Z0-9-_&])@([0-9a-zA-Z_]+)/',"$1<a href=\"http://twitter.com/$2\" target=\"_blank\" rel=\"nofollow\">@$2</a>",$content);
	return $twtreplace;
}

/**
 * Force Stupid IE
 * @since 1.0.0
 *
 * @param array $headers. Current page header.
 * @return array $headers. Headers updated.
 *
 * Ref: https://www.nutsandboltsmedia.com/how-to-create-a-custom-functionality-plugin-and-why-you-need-one/
 */
add_filter( 'wp_headers', 'wsm_keep_ie_modern' );
function wsm_keep_ie_modern( $headers ) {
  if ( isset( $_SERVER['HTTP_USER_AGENT'] ) && ( strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE' ) !== false ) ) {
      $headers['X-UA-Compatible'] = 'IE=edge,chrome=1';
  }
  return $headers;
}

/**
 * Fix Gravity Form Tabindex Conflicts.
 * @since 1.0.0
 *
 * http://gravitywiz.com/fix-gravity-form-tabindex-conflicts/
 */
function gform_tabindexer( $tab_index, $form = false ) {

    $starting_index = 1000; // if you need a higher tabindex, update this number
    if( $form )
        add_filter( 'gform_tabindex_' . $form['id'], 'gform_tabindexer' );
    return GFCommon::$tab_index >= $starting_index ? GFCommon::$tab_index : $starting_index;
}
add_filter( 'gform_tabindex', 'gform_tabindexer', 10, 2 );

/**
 * Enable Gravity Forms Visibility Setting.
 * @since 1.0.0
 *
 * Ref: https://www.gravityhelp.com/gravity-forms-v1-9-placeholders/.
 */
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

/**
 * Change the footer text in Showcase Pro theme.
 * @since 1.0.0
 */
function cws_sp_footer_creds_filter( $creds ) {
	$creds = '[footer_copyright] &middot; <a href="http://UniquePuzzlesGames.com">UniquePuzzlesGames.com</a> &middot; All rights Reserved.  &middot; Built by <a href="//capwebsolutions.com" title="Cap Web Solutions">Cap Web Solutions LLC</a>';
	return $creds;
}
add_filter('genesis_footer_creds_text', 'cws_sp_footer_creds_filter');



// Ref: https://www.livexp.net/wordpress/using-wordpress-shortcodes-to-show-members-only-content.html
// Let's add support for logged in only display of content
// shortcode = [upgcustomer]  [/upgcustomer]
add_shortcode( 'upgcustomer', 'cws_member_check_shortcode' );
function cws_member_check_shortcode( $atts, $content = null ) {
if ( is_user_logged_in() && !is_null( $content ) && !is_feed() )
return $content;
return '';
}

// Let's add support for non-logged in only display of content
// shortcode = [upgvisitor]  [/upgvisitor]
add_shortcode( 'upgvisitor', 'cws_visitor_check_shortcode' );
function cws_visitor_check_shortcode( $atts, $content = null ) {
if ( ( !is_user_logged_in() && !is_null( $content ) ) || is_feed() )
return $content;
return '';
}


/**********************************
 *
 * Replace Header Site Title with Inline Logo
 *
 * Fixes Genesis bug - when using static front page and blog page (admin reading settings) Home page is <p> tag and Blog page is <h1> tag
 *
 * Replaces "is_home" with "is_front_page" to correctly display Home page wit <h1> tag and Blog page with <p> tag
 *
 * @author AlphaBlossom / Tony Eppright
 * @link http://www.alphablossom.com/a-better-wordpress-genesis-responsive-logo-header/
 *
 * @edited by Sridhar Katakam
 * @link http://www.sridharkatakam.com/use-inline-logo-instead-background-image-genesis/
 *
************************************/
add_filter( 'genesis_seo_title', 'custom_header_inline_logo', 10, 3 );
function custom_header_inline_logo( $title, $inside, $wrap ) {
 
	// $logo = '<img src="' . get_stylesheet_directory_uri() . '/images/logo.gif" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" width="200" height="62" />';
	$logo = '<img src="' . get_stylesheet_directory_uri() . '/images/puzzlelogoimage.png" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" width="135" height="100" />';	
 
	$inside = sprintf( '<a href="%s" title="%s">%s</a>', trailingslashit( home_url() ), esc_attr( get_bloginfo( 'name' ) ), $logo );
 
	//* Determine which wrapping tags to use - changed is_home to is_front_page to fix Genesis bug
	$wrap = is_front_page() && 'title' === genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : 'p';
 
	//* A little fallback, in case an SEO plugin is active - changed is_home to is_front_page to fix Genesis bug
	$wrap = is_front_page() && ! genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : $wrap;
 
	//* And finally, $wrap in h1 if HTML5 & semantic headings enabled
	$wrap = genesis_html5() && genesis_get_seo_option( 'semantic_headings' ) ? 'h1' : $wrap;
 
	return sprintf( '<div class="site-logo"><%1$s %2$s>%3$s</%1$s></div><div class="site-title-description"><%1$s %2$s><a href="%4$s">%5$s</a></%1$s>', $wrap, genesis_attr( 'site-title' ), $inside, trailingslashit( home_url() ), get_bloginfo( 'name' ) );
 
}

// Remove the site description
add_action( 'genesis_site_description', 'sk_seo_site_description' );
function sk_seo_site_description() {
	echo '</div>';
}

/**
 * Close Popup After Mailchimp for WordPress Submission
 */
add_action( 'wp_footer', 'cws_custom_popup_scripts', 500 );
function cws_custom_popup_scripts() { ?>
<script type="text/javascript">
	(function ($, document, undefined) {
		jQuery(document).on('subscribe.mc4wp','.popmake-content .mc4wp-form', function() {
			var $popup = PUM.getPopup(this);
			
			$popup.trigger('pumSetCookie');
			
			setTimeout(function () {
			    $popup.popmake('close');
			}, 5000); // 5 seconds
		});
	}(jQuery, document))
</script><?php
}