<?php

class Curbside_Menus {

	private static $instance;

	public static function init() {
		if ( ! isset ( self::$instance ) ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function __construct() {
		$post_type_object = new Curbside_Post_Type( 'Menu' );
	}

}