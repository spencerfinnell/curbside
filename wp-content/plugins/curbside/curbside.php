<?php
/**
 * Plugin Name: Curbside Cuisine
 * Plugin URI: http://spencerfinnell.com
 * Description: Food truck manager.
 * Version: 1.0.0
 * Author: Spencer Finnell
 * Author URI: http://spencerfinnell.com
 * Text Domain: curbside
 * Domain Path: /languages
 */

class Curbside_Cuisine {

	private static $instance;

	public static function init() {
		if ( ! isset ( self::$instance ) ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function __construct() {
		include( 'includes/abstracts/abstract-post-type.php' );
		include( 'includes/abstracts/abstract-taxonomy.php' );
		include( 'includes/class-geocode.php' );
		include( 'includes/class-trucks.php' );
		include( 'includes/class-truck.php' );
		include( 'includes/class-locations.php' );
		include( 'includes/class-location.php' );
		include( 'includes/class-menus.php' );
		include( 'includes/class-menu.php' );
		include( 'includes/class-menu-items.php' );
		include( 'includes/class-menu-item.php' );

		add_action( 'init', array( $this, 'textdomain' ) );

		add_action( 'init', array( 'Curbside_Trucks', 'init' ) );
		add_action( 'init', array( 'Curbside_Locations', 'init' ) );
		add_action( 'init', array( 'Curbside_Menus', 'init' ) );
		add_action( 'init', array( 'Curbside_Menu_Items', 'init' ) );

		add_action( 'p2p_init', array( $this, 'p2p' ) );
	}

	public function textdomain() {

	}

	public function p2p() {
		p2p_register_connection_type( array(
			'name'            => 'location_to_truck',
			'from'            => 'location',
			'to'              => 'truck',
			'from_query_vars' => array('post_status' => 'any')
		) );

		p2p_register_connection_type( array(
			'name'       => 'menu_item_to_menu',
			'from'       => 'menu_item',
			'to'         => 'menu'
		) );

		p2p_register_connection_type( array(
			'name'       => 'menu_to_truck',
			'from'       => 'menu',
			'to'         => 'truck'
		) );
	}

}
add_action( 'plugins_loaded', array( 'Curbside_Cuisine', 'init' ) );