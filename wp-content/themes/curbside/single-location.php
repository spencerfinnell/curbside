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

	<?php while ( have_posts() ) : the_post(); ?>

	<?php
		$truck = new Curbside_Truck( $post, 'location' );
		$location = new Curbside_Location( $post );
	?>

	<header class="bar bar-nav">
		<a href="<?php echo get_permalink( $truck->ID ); ?>upcoming/" class="btn btn-link btn-nav pull-left">
			<span class="icon icon-left-nav"></span>
		</a>

		<a href="#" class="icon icon-bars pull-right"></a>

		<h1 class="title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h1>
	</header>

	<?php locate_template( array( 'bar-tab.php' ), true ); ?>

	<div class="content">

		<div class="card">
			<div id="map"><span class="icon icon-more"></span></div>

			<?php $coords = $location->get_coordinates(); ?>

			<script type="text/javascript">
				jQuery(document).ready(function($) {
					var map = curbsideMap();

					map.init({
						el: '#map',
						geolocate: true,
						lat: <?php echo $coords[ 'lat' ]; ?>,
						lng: <?php echo $coords[ 'lng' ]; ?>,
						markers: {
							0: {
								lat: <?php echo $coords[ 'lat' ]; ?>,
								lng: <?php echo $coords[ 'lng' ]; ?>,
							}
						},
						toPlace: [ <?php echo $coords[ 'lat' ]; ?>, <?php echo $coords[ 'lng' ]; ?> ]
					});
				});
			</script>
		</div>

		<div class="card">
			<ul class="table-view step-list">

			</ul>
		</div>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>