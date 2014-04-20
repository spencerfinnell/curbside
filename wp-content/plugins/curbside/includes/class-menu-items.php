<?php

class Curbside_Menu_Items {

	private static $instance;

	public static function init() {
		if ( ! isset ( self::$instance ) ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function __construct() {
		$post_type_object = new Curbside_Post_Type( 'Menu Item' );
		$post_type_taxonomy = new Curbside_Taxonomy( 'Item Category', $post_type_object->post_type_slug );
	}

}