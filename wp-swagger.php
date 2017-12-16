<?php
/**
 * Contains the plugin's entry point.
 *
 * @package WP_Swagger
 */

/*
 * Plugin Name: WP Swagger
 * Plugin URI:  https://grantpalin.com
 * Description: Provides a shortcode for embedding Swagger specs into pages or posts.
 * Version:     1.0.0
 * Author:      Grant Palin
 * Author URI:  https://grantpalin.com
 * License:     GPL-3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 */

require_once __DIR__ . '/inc/class-wp-swagger.php';

/**
 * Initializes the plugin.
 */
function wp_swagger_init() {
	WP_Swagger::get_instance();
}
add_action( 'init', 'wp_swagger_init' );
