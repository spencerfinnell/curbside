<?php
/**
 * Curbside Cuisine functions and definitions
 *
 * @package Curbside Cuisine
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'curbside_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function curbside_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'curbside' ),
	) );
}
endif; // curbside_setup
add_action( 'after_setup_theme', 'curbside_setup' );

/**
 * Enqueue scripts and styles.
 */
function curbside_scripts() {
	wp_enqueue_style( 'ratchet', get_stylesheet_directory_uri() . '/css/ratchet.min.css' );
	wp_enqueue_style( 'ratchet-ios', get_stylesheet_directory_uri() . '/css/ratchet-theme-ios.min.css' );
	wp_enqueue_style( 'curbside-style', get_stylesheet_uri() );

	wp_enqueue_script( 'ratchet', get_stylesheet_directory_uri() . '/js/ratchet.js' );
}
add_action( 'wp_enqueue_scripts', 'curbside_scripts' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function twentyfourteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentyfourteen' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'twentyfourteen_wp_title', 10, 2 );