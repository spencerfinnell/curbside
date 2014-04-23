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
		$cuisine = new Curbside_Taxonomy( 'Cuisine', $post_type_object->post_type_slug );
		$meal = new Curbside_Taxonomy( 'Meal', $post_type_object->post_type_slug );
		$price = new Curbside_Taxonomy( 'Price', $post_type_object->post_type_slug );
		$price = new Curbside_Taxonomy( 'Tag', $post_type_object->post_type_slug );

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

	public static function get_current_trucks() {
		$trucks = new WP_Query( array(
			'post_type' => 'truck',
			'nopaging' => true
		) );

		$locations = array();]

		if ( ! $trucks->have_posts() ) {
			return $locations;
		}

		while ( $trucks->have_posts() ) {
			$trucks->the_post();

			$truck = new Curbside_Truck( get_post() );
			$coords = $truck->get_current_location()->get_coordinates();

			$locations[$truck->ID] = array(
				'lat' => $coords[ 'lat' ],
				'lng' => $coords[ 'lng' ],
				'details' => array(
					'permalink' => get_permalink( $truck->ID )
				)
			);
		}

		return $locations;
	}

	public static function get_random_trucks() {
		$trucks = new WP_Query( array(
			'post_type' => 'truck',
			'nopaging' => true,
			'posts_per_page' => 5,
			'orderby' => 'rand'
		) );

		return $trucks;
	}

}