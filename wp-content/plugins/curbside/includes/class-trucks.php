<?php

class Curbside_Trucks {

	private static $instance;

	public static function init() {
		if ( ! isset ( self::$instance ) ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function __construct() {
		$post_type_object = new Curbside_Post_Type( 'Truck' );

		$this->add_rewrite_endpoints();

		add_filter( 'wp_title', array( $this, 'wp_title' ), 10, 2 );
		add_action( 'template_redirect', array( $this, 'template_redirect' ) );
	}

	private function add_rewrite_endpoints() {
		add_rewrite_endpoint( 'menu', EP_PERMALINK | EP_PAGES );
		add_rewrite_endpoint( 'upcoming', EP_PERMALINK | EP_PAGES );
	}

	public function wp_title( $title, $sep ) {
		global $wp_query;

		if ( ! is_singular( 'truck' ) ) {
			return $title;
		}

		if ( isset( $wp_query->query_vars[ 'menu' ] ) ) {
			$title = 'Menu' . $sep . $title;
		}

		if ( isset( $wp_query->query_vars[ 'upcoming' ] ) ) {
			$title = 'Upcoming Locations' . $sep . $title;
		}

		return $title;
	}

	public function template_redirect() {
		global $wp_query;

		if ( ! is_singular( 'truck' ) ) {
			return;
		}

		if ( isset( $wp_query->query_vars[ 'menu' ] ) ) {
			locate_template( array( 'single-truck-menu.php' ), true );

			exit;
		}

		if ( isset( $wp_query->query_vars[ 'upcoming' ] ) ) {
			locate_template( array( 'single-truck-upcoming.php' ), true );

			exit;
		}
	}

}