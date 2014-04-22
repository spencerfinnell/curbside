<?php

class Curbside_Truck {

	public $ID;

	public $post;

	public function __construct( $truck, $from = 'post' ) {
		if ( is_a( $truck, 'WP_Post' ) && 'post' == $from ) {
			$this->ID   = $truck->ID;
			$this->post = $truck;
		} elseif ( is_a( $truck, 'Curbside_Truck' ) && 'truck' == $from ) {
			$this->ID   = $truck->ID;
			$this->post = $truck->post;
		} elseif ( 'menu' == $from ) {
			$this->ID   = $this->_get_from_menu( $truck );
			$this->post = get_post( $this->ID );
		} elseif ( 'menu-item' == $from ) {
			$this->ID   = $this->_get_from_menu_item( $truck );
			$this->post = get_post( $this->ID );
		} elseif( 'location' == $from ) {
			$this->ID   = $this->_get_from_location( $truck );
			$this->post = get_post( $this->ID );
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

	public function get_upcoming_locations() {
		$locations = $this->get_locations( array(
			'post_status' => 'future',
			'order' => 'asc',
			'nopaging' => true
		) );

		return $locations;
	}

	public function get_menu() {
		$defaults = array(
			'connected_type' => 'menu_to_truck',
			'connected_items' => $this->post
		);

		$args = wp_parse_args( $args, $defaults );

		$connected = new WP_Query( $args );

		$menu = new Curbside_Menu( $connected->post );

		return $menu;
	}

	public function get_menu_url() {
		$url = get_permalink( $this->ID );
		$url = trailingslashit( $url . 'menu' );

		return $url;
	}

	private function _get_from_menu( $menu ) {
		$connected = p2p_type( 'menu_to_truck' )->set_direction( 'from' )->get_connected( $menu->ID );

		return $connected->post->ID;
	}

	private function _get_from_menu_item( $menu_item ) {
		$menu = new Curbside_Menu( $menu_item, 'menu-item' );
		$truck = $this->_get_from_menu( $menu );

		return $truck;
	}

	private function _get_from_location( $location ) {
		$defaults = array(
			'connected_type' => 'location_to_truck',
			'connected_items' => $location->ID,
			'post_status' => 'any'
		);

		$args = wp_parse_args( $args, $defaults );

		$connected = new WP_Query( $args );

		return $connected->post->ID;
	}

}