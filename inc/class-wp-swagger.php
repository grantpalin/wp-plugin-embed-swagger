<?php
class WP_Swagger {
	protected static $instance;

	protected function __construct() {
		add_shortcode( 'swagger', array( $this, 'shortcode' ) );
	}

	public static function get_instance() {
		if(self::$instance === null) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function shortcode($attributes = array()) {
		// first param is all possible attributes for the shortcode, and their default values.
		// second param is the attributes that were written in the shortcode usage.
		// - shortcode attributes not on the whitelist will be omitted.
		// - whitelisted attributes not written in the shortcode will be added with default values.
		// third param is the shortcode name - providing it enables an attributes filter.
		$args = shortcode_atts(
			array(
				'url' => ''
			),
			$attributes,
			'wpswagger'
		);

		// exit early if URL is blank
		if ($args['url'] === '') {
			return '[wpswagger no url]';
		}

		$baseUrl = plugins_url( '', __DIR__ );

		wp_enqueue_script( 'iframeResizer', $baseUrl . '/public/iframeResizer.min.js', array(), '2.8.6', true );
		wp_enqueue_script( 'wp-swagger', $baseUrl . '/public/wp-swagger.js', array( 'iframeResizer', 'jquery' ), '1.0.0' );
		wp_enqueue_style( 'wp-swagger', $baseUrl . '/public/wp-swagger.css', array(), '1.0.0' );

		$args['url'] = filter_var($args['url'], FILTER_VALIDATE_URL);

		ob_start();
		?>
		<iframe src="<?php echo $baseUrl . '/swagger-iframe.php'; ?>?url=<?php echo urlencode($args['url']) ?>" class="wp-swagger-container" width="100%"></iframe>
		<?php
		return ob_get_clean();
	}
}
