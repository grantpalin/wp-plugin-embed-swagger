=== Swagger Embed ===
Contributors: grantpalin
Tags: shortcode, embed, swagger
Requires at least: 4.6
Tested up to: 4.9.4
Requires PHP: 5.2.4
Stable tag: trunk
Requires PHP: 5.2.4
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Provides a shortcode for embedding Swagger specs into pages or posts.

== Description ==

The shortcode provided by this plugin allows embedding Swagger `.json` files into WordPress pages and posts. An iframe is used to host the external content, with some styling to mesh it with the host page or post. The external spec is rendered using Swagger UI.

Note that the Swagger UI styling seems to go up to 1500px in width. If the page or post container is less than 1500px wide, the Swagger UI output will appear slightly cut off on the right side, but will otherwise be intact and functional.

Example shortcode usage:

    [swagger url="Swagger .json URL goes here"]

An absolute URL must be provided within the quotes. The URL must point to a valid Swagger spec file, typically ending with `.json`.

Custom styles can be applied to the iframe by adding rules to `swagger-embed-container`, e.g.:

    .swagger-embed-container {
        /* custom styles here */
    }

An included script forces the iframe to be as high as needed to show all the contained content, and a stylesheet forces the iframe to take the full width of the parent element.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/swagger-embed` directory, or install the plugin through the WordPress plugins screen directly (search for "Swagger Embed").
2. Activate the plugin through the 'Plugins' screen in WordPress

== Screenshots ==

1. Example usage of the shortcode within the page editor
2. An example output of the Petstore spec on a site using the Twenty Thirteen theme (with a wider content area)

== Changelog ==

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 1.0.0 =
Initial release.
