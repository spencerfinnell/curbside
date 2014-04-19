<?php

class Curbside_Locations {

	private static $instance;

	public $post_type_object;

	public static function init() {
		if ( ! isset ( self::$instance ) ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function __construct() {
		$this->post_type_object = new Curbside_Post_Type( 'Location' );

		add_action( 'save_post', array( $this, 'save_post' ) );
	}

	public function save_post() {
		global $post;

		if ( ! $this->post_type_object->can_save_data( $post ) ) {
			return;
		}

		$geocode = new Curbside_Geocode;
		$geocode->generate_location_data( $post->ID, $post->post_title );
	}

}