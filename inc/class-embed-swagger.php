<?php
/**
 * Contains the Embed_Swagger class, the centre of the plugin.
 *
 * @package Embed_Swagger
 */

if ( ! class_exists( 'Embed_Swagger' ) ) {
	/**
	 * The Embed_Swagger class contains the plugin's core functionality.
	 */
	class Embed_Swagger {
		/**
		 * The class' sole instance.
		 *
		 * @var Embed_Swagger
		 */
		protected static $instance;

		/**
		 * Embed_Swagger constructor.
		 */
		protected function __construct() {
			add_shortcode( 'swagger', array( $this, 'shortcode' ) );
		}

		/**
		 * Provides access to the class' sole instance.
		 *
		 * @return Embed_Swagger
		 */
		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Handles processing of the shortcode and generation of the output.
		 *
		 * @param array $attributes Array of attributes written in the shortcode.
		 *
		 * @return string
		 */
		public function shortcode( $attributes = array() ) {
			// first param is all possible attributes for the shortcode, and their default values.
			// second param is the attributes that were written in the shortcode usage.
			// - shortcode attributes not on the whitelist will be omitted.
			// - whitelisted attributes not written in the shortcode will be added with default values.
			// third param is the shortcode name - providing it enables an attributes filter.
			$args = shortcode_atts(
				array(
					'url' => '',
				),
				$attributes,
				'swagger'
			);

			// exit early if URL is blank.
			if ( '' === $args['url'] ) {
				return '[swagger no url]';
			}

			$base_url = plugins_url( '', __DIR__ );

			wp_enqueue_script( 'iframeResizer', $base_url . '/public/iframeResizer.min.js', array(), '3.5.12', true );
			wp_enqueue_script( 'embed-swagger', $base_url . '/public/embed-swagger.js', array( 'iframeResizer', 'jquery' ), '1.0.0' );
			wp_enqueue_style( 'embed-swagger', $base_url . '/public/embed-swagger.css', array(), '1.0.0' );

			$args['url'] = filter_var( $args['url'], FILTER_VALIDATE_URL );

			ob_start();
			?>
			<iframe
				src="<?php echo esc_url( $base_url . '/swagger-iframe.php' ); ?>?url=<?php echo rawurlencode( $args['url'] ); ?>"
				class="swagger-embed-container" width="100%"></iframe>
			<?php
			return ob_get_clean();
		}
	}
}
