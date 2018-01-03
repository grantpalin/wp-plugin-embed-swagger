<?php
/**
 * Contains the Swagger_Embed class, the centre of the plugin.
 *
 * @package Swagger_Embed
 */

/**
 * The Swagger_Embed class contains the plugin's core functionality.
 */
class Swagger_Embed {
	/**
	 * The class' sole instance.
	 *
	 * @var Swagger_Embed
	 */
	protected static $instance;

	/**
	 * Swagger_Embed constructor.
	 */
	protected function __construct() {
		add_shortcode( 'swagger', array( $this, 'shortcode' ) );
	}

	/**
	 * Provides access to the class' sole instance.
	 *
	 * @return Swagger_Embed
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
		wp_enqueue_script( 'swagger-embed', $base_url . '/public/swagger-embed.js', array( 'iframeResizer', 'jquery' ), '1.0.0' );
		wp_enqueue_style( 'swagger-embed', $base_url . '/public/swagger-embed.css', array(), '1.0.0' );

		$args['url'] = filter_var( $args['url'], FILTER_VALIDATE_URL );

		ob_start();
		?>
		<iframe src="<?php echo esc_url( $base_url . '/swagger-iframe.php' ); ?>?url=<?php echo rawurlencode( $args['url'] ); ?>" class="swagger-embed-container" width="100%"></iframe>
		<?php
		return ob_get_clean();
	}
}
