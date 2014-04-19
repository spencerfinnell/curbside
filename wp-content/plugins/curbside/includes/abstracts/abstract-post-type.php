<?php
/**
 *
 */

class Curbside_Post_Type {
	public $post_type_name;
	public $post_type_slug;

	public function __construct( $name ) {
		$this->post_type_name = $name;
		$this->post_type_slug = str_replace( '-', '_', sanitize_title( $this->post_type_name ) );

		return $this->register_post_type();
	}

	/**
	 * Register the Post Type
	 *
	 * @since St. Augustine Civil Rights Library 1.0
	 */
	private function register_post_type() {
		$singular = $this->post_type_name;
		$plural = $singular . 's';

		$labels = array(
			'name'               => $plural,
			'singular_name'      => $singular,
			'add_new'            => 'Add New',
			'add_new_item'       => sprintf( __( 'Add New %s', 'curbside' ), $singular ),
			'edit_item'          => sprintf( __( 'Edit %s', 'curbside' ), $singular ),
			'new_item'           => sprintf( __( 'New %s', 'curbside' ), $singular ),
			'all_items'          => sprintf( __( 'All %s', 'curbside' ), $plural ),
			'view_item'          => sprintf( __( 'View %s', 'curbside' ), $singular ),
			'search_items'       => sprintf( __( 'Search %s', 'curbside' ), $plural ),
			'not_found'          => sprintf( __( 'No %s found', 'curbside' ), $plural ),
			'not_found_in_trash' => sprintf( __( 'No %s found in the trash', 'curbside' ), $plural ),
			'parent_item_colon'  => '',
			'menu_name'          => $plural
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => $this->post_type_slug ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 6,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields' )
		);

		register_post_type( $this->post_type_slug, $args );

		return get_post_type_object( $this->post_type_slug );
	}

	public function can_save_data( $post ) {
		if ( empty( $post->ID ) || empty( $post ) || empty( $_POST ) ) {
			return false;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return false;
		}

		if ( is_int( wp_is_post_revision( $post ) ) ) {
			return false;
		}

		if ( is_int( wp_is_post_autosave( $post ) ) ) {
			return false;
		}

		if ( ! current_user_can( 'edit_post', $post->ID ) ) {
			return false;
		}

		if ( $post->post_type != $this->post_type_slug ) {
			return false;
		}

		return true;
	}
}