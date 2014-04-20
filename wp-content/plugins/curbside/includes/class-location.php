<?php

class Curbside_Location {

	public function __construct( $location ) {
		$this->location = $location;
	}

	public function get_date() {
		return $this->location->post_date;
	}

	public function get_street() {
		return $this->location->geolocation_street;
	}

	public function get_formatted_address() {
		return $this->location->geolocation_formatted_address;
	}

	public function get_coordinates() {
		return array(
			'long' => $this->location->geolocation_long,
			'lat' => $this->location->geolocation_lat
		);
	}

}