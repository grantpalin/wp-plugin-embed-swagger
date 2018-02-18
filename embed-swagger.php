<?php
/**
 * Contains the plugin's entry point.
 *
 * @package Embed_Swagger
 */

/*
 * Plugin Name: Embed Swagger
 * Description: Provides a shortcode for embedding Swagger specs into pages or posts.
 * Version:     1.0.0
 * Author:      Grant Palin
 * Author URI:  https://grantpalin.com
 * License:     GPL-3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain: embed-swagger
 * Domain Path: /languages
 *
 * Embed Swagger is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 *
 * Embed Swagger is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Embed Swagger. If not, see
 * http://www.gnu.org/licenses/gpl-3.0.txt.
 */

require_once __DIR__ . '/inc/class-embed-swagger.php';

/**
 * Initializes the plugin.
 */
function embed_swagger_init() {
	Embed_Swagger::get_instance();
}
add_action( 'init', 'embed_swagger_init' );
