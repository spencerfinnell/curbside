<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Curbside Cuisine
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Sets initial viewport load and disables zooming  -->
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

	<!-- Makes your prototype chrome-less once bookmarked to your phone's home screen -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">

	<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-152x152.png">

	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

	<title><?php wp_title( ' - ', true, 'right' ); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class( is_home() ? 'home' : '' ); ?>>

<div class="off-navigation">
	<ul class="table-view">
		<li class="table-view-divider">
			Quick Links
		</li>
		<li class="table-view-cell">
			<a href="<?php echo home_url(); ?>">Home</a>
		</li>
		<li class="table-view-cell">
			<a href="<?php echo get_permalink( get_page_by_path( 'search' ) ); ?>">Search</a>
		</li>
		<li class="table-view-divider">
			Cuisines
		</li>
		<?php
			$terms = get_terms( 'truck-cuisine', array( 'hide_empty' => 0 ) );

			foreach ( $terms as $term ) :
		?>
		<li class="table-view-cell">
			<a href="<?php echo get_term_link( $term ); ?>" class="navigate-right"><?php echo $term->name; ?></a>
		</li>
		<?php endforeach; ?>
		<?php if ( is_user_logged_in() ) : ?>
		<li class="table-view-cell">
			<a href="<?php echo get_permalink( get_page_by_path( 'search' ) ); ?>">Following</a>
		</li>
		<?php endif; ?>
		<li class="table-view-divider">
			Quick Picks
		</li>
		<?php $picks = Curbside_Trucks::get_random_trucks(); ?>
		<?php while ( $picks->have_posts() ) : $picks->the_post(); ?>
			<li class="table-view-cell">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</li>
		<?php endwhile; ?>
	</ul>
</div>

<div id="page" class="hfeed site">