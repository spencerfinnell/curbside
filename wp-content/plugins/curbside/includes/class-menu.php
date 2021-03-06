<?php

class Curbside_Menu {

	public $ID;

	public $post;

	public function __construct( $menu, $from = 'post' ) {
		if ( is_a( $download, 'WP_Post' ) ) {
			$this->ID   = $menu->ID;
			$this->post = $menu;
		} elseif ( is_a( $menu, 'Curbside_Menu' ) ) {
			$this->ID   = $menu->ID;
			$this->post = $menu->post;
		} elseif ( 'menu-item' == $from ) {
			$this->ID   = $this->get_menu_from_item( $menu );
			$this->post = get_post( $this->ID );
		} else {
			$this->ID   = $menu;
			$this->post = get_post( $menu );
		}
	}

	public function get_items( $category = null ) {
		$defaults = array(
			'connected_type' => 'menu_item_to_menu',
			'connected_items' => $this->post
		);

		$args = wp_parse_args( $args, $defaults );

		if ( $category ) {
			$args[ 'tax_query' ] = array(
				array(
					'taxonomy' => 'menu_item-item_category',
					'field' => 'id',
					'terms' => array( $category )
				)
			);
		}

		$connected = new WP_Query( $args );

		return $connected;
	}

	public function get_menu_from_item( $menu_item ) {
		$connected = p2p_type( 'menu_item_to_menu' )->get_connected( $menu_item->ID );

		return $connected->post;
	}

}