<?php

class Curbside_Truck {

	public $ID;

	public $post;

	public function __construct( $truck ) {
		if ( is_a( $download, 'WP_Post' ) ) {
			$this->ID   = $truck->ID;
			$this->post = $truck;
		} elseif ( is_a( $truck, 'Curbside_Truck' ) ) {
			$this->ID   = $truck->ID;
			$this->post = $truck->post;
		} else {
			$this->ID   = $truck;
			$this->post = get_post( $truck );
		}
	}

	public function get_locations( $args = array() ) {
		$defaults = array(
			'connected_type' => 'location_to_truck',
			'connected_items' => $this->post
		);

		$args = wp_parse_args( $args, $defaults );

		$connected = new WP_Query( $args );

		return $connected;
	}

	public function get_current_location() {
		$location = $this->get_locations( array(
			'posts_per_page' => 1,
			'post_status' => 'publish'
		) );

		$location = new Curbside_Location( $location->post );

		return $location;
	}

	public function get_next_location() {
		$location = $this->get_locations( array(
			'posts_per_page' => 1,
			'post_status' => 'future',
			'order' => 'asc'
		) );

		$location = new Curbside_Location( $location->post );

		return $location;
	}

	public function get_menus() {
		$defaults = array(
			'connected_type' => 'menu_to_truck',
			'connected_items' => $this->post
		);

		$args = wp_parse_args( $args, $defaults );

		$connected = new WP_Query( $args );

		return $connected;
	}

}