<?php

class Curbside_Taxonomy {

	public function __construct( $name, $post_type ) {
		$this->name = $name;
		$this->post_type_slug = $post_type;

		$this->register_taxonomy();
	}

	public function register_taxonomy() {
		$name   = $this->name;
		$slug   = str_replace( '-', '_', sanitize_title( $this->name ) );
		$plural = $this->name . 's';

		$labels = wp_parse_args(
			$labels,
			array(
				'name'                  => _x( $plural, 'taxonomy general name' ),
				'singular_name'         => _x( $name, 'taxonomy singular name' ),
				'search_items'          => __( 'Search ' . $plural ),
				'all_items'             => __( 'All ' . $plural ),
				'parent_item'           => __( 'Parent ' . $name ),
				'parent_item_colon'     => __( 'Parent ' . $name . ':' ),
				'edit_item'             => __( 'Edit ' . $name ),
				'update_item'           => __( 'Update ' . $name ),
				'add_new_item'          => __( 'Add New ' . $name ),
				'new_item_name'         => __( 'New ' . $name . ' Name' ),
				'menu_name'             => __( $plural ),
			)
		);

		$args = wp_parse_args(
			$args,
			array(
				'label'                 => $plural,
				'labels'                => $labels,
				'public'                => true,
				'show_ui'               => true,
				'show_in_nav_menus'     => true,
				'_builtin'              => false,
				'hierarchical'          => true
			)
		);

		register_taxonomy( $this->post_type_slug . '-' . $slug, $this->post_type_slug, $args );
	}

}