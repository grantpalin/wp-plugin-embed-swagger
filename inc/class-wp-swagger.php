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

		wp_enqueue_style( 'wp-swagger', plugins_url( '', __DIR__ ) . '/public/wp-swagger.css', array(), '1.0.0' );

		ob_start();
		?>
		<iframe src="<?php echo plugins_url( '', __DIR__ ) . '/swagger-iframe.php'; ?>?url=<?php echo urlencode($args['url']) ?>" class="wp-swagger-container" width="100%"></iframe>
		<?php
		return ob_get_clean();
	}
}
