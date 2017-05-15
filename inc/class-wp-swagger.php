<?php
class WP_Swagger {
	protected static $instance;

	protected function __construct() {
	}

	public static function get_instance() {
		if(self::$instance === null) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}
