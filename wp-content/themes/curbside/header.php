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

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

   <!-- Make sure all your bars are the first things in your <body> -->
	<header class="bar bar-nav">
		<a href="<?php echo esc_url( add_query_arg( 's', 'Dinner', home_url() ) ); ?>" class="icon icon-search pull-right" data-ignore="push"></a>
		<a href="#" class="icon icon-bars pull-left"></a>

		<h1 class="title"><a href="<?php echo home_url(); ?>" data-transition="slide-in">Street Treats</a></h1>
	</header>

	<?php if ( is_search() ) : ?>
		<div class="bar bar-standard bar-header-secondary">
			<form action="" method="post">
				<input type="search" placeholder="Search" value="<?php echo get_search_query(); ?>" name="s">
			</form>
		</div>
	<?php endif; ?>

	<div class="content">