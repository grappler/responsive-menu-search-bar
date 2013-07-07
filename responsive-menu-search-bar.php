<?php
/**
 * Responsive Menu Search Bar
 *
 * A plugin to add a search bar to the header menu in Responsive.
 *
 * @package   responsive-menu-search-bar
 * @author    Ulrich Pogson <grapplerurlrich@gmail.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2013 Ulrich Pogson
 *
 * @wordpress-plugin
 * Plugin Name: Responsive Menu Search Bar
 * Plugin URI:  https://github.com/grappler/responsive-sticky-menu
 * Description: A plugin to add a search bar to the header menu in Responsive.
 * Version:     0.1.0
 * Author:      Ulrich Pogson
 * Author URI:  http://www.ulrich.pogson.ch/
 * Text Domain: responsive-menu-serch-bar
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /lang
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Enqueue search bar styles
function responsive_sticky_menu_enqueue_script() {
	wp_enqueue_style( 'responsive-search-bar-style', plugins_url( 'css/search-bar.css', __FILE__ ), '0.1.0' );
}
add_action( 'wp_enqueue_scripts', 'responsive_sticky_menu_enqueue_script' );

// Add search bar to the header menu
function responsive_add_search_box($items, $args) {
	if($args->theme_location == 'header-menu') {
		ob_start();
		get_search_form();
		$searchform = ob_get_contents();
		ob_end_clean();
 
		return $items .= '<li id="searchform-item">' . $searchform . '</li>';
	}
	return $items;
}
add_filter('wp_nav_menu_items','responsive_add_search_box', 10, 2);