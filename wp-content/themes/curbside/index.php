<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Curbside Cuisine
 */

get_header(); ?>

	<header class="bar bar-nav">
		<a href="#" class="icon icon-bars pull-right"></a>

		<h1 class="title"><?php get_bloginfo( 'name' ); ?></h1>
	</header>

	<?php locate_template( array( 'bar-tab.php' ), true ); ?>

	<div class="content">

		<div class="card">
			<div id="map"><span class="icon icon-more"></span></div>

			<script type="text/javascript">
				jQuery(document).ready(function($) {
					var map = curbsideMap();

					map.init({
						el: '#map',
						geolocate: true,
						lat: '',
						lng: '',
						markers: <?php echo json_encode( Curbside_Trucks::get_current_trucks() ); ?>
					});
				});
			</script>
		</div>

	</div>

<?php get_footer(); ?>