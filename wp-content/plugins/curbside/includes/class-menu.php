<?php

class Curbside_Menu {

	public function __construct( $menu ) {
		$this->menu = $menu;
	}

	public function get_items() {
		$defaults = array(
			'connected_type' => 'menu_item_to_menu',
			'connected_items' => $this->menu
		);

		$args = wp_parse_args( $args, $defaults );

		$connected = new WP_Query( $args );

		return $connected;
	}

}