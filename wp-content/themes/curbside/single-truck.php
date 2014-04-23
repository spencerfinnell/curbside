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

	<?php $truck = new Curbside_Truck( $post ); ?>

	<header class="bar bar-nav">
		<a href="<?php echo home_url(); ?>" class="btn btn-link btn-nav pull-left">
			<span class="icon icon-left-nav"></span>
		</a>

		<a href="#" class="icon icon-bars pull-right"></a>

		<h1 class="title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h1>
	</header>

	<?php locate_template( array( 'bar-tab.php' ), true ); ?>

	<div class="bar bar-standard bar-header-secondary">
		<span class="btn current-location-label">Current Location:</span> <a href="<?php echo get_permalink( $truck->get_current_location()->location->ID  ); ?>" class="btn street-address"><?php echo $truck->get_current_location()->get_street(); ?></a>
	</div>

	<div class="content">

		<div class="card">
			<div id="map"><span class="icon icon-more"></span></div>

			<?php $coords = $truck->get_current_location()->get_coordinates();?>

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

					//map.fitBounds();
				});
			</script>
		</div>

		<div class="card">
			<ul class="table-view">
				<li class="table-view-cell">
					<a href="<?php echo $truck->get_menu_url(); ?>" class="navigate-right">
						<span class="badge"><?php echo $truck->get_menu()->get_items()->found_posts; ?></span>
						Menu Items
					</a>
				</li>
				<li class="table-view-cell">
					<a href="<?php the_permalink(); ?>upcoming/" class="navigate-right">
						<span class="badge"><?php echo $truck->get_upcoming_locations()->found_posts; ?></span>
						Upcoming Locations
					</a>
				</li>
				<li class="table-view-cell">
					<a class="navigate-right">
						<span class="badge">0</span>
						Rate and Review
					</a>
				</li>
				<li class="table-view-cell">
					<a href="<?php echo get_permalink( $truck->get_current_location()->location->ID ); ?>" class="navigate-right">
						<span class="badge distance-to">0 km</span>
						Directions
					</a>
				</li>
			</ul>
		</div>

		<div class="content-padded truck-tags">
			<?php
				$taxes = array( 'truck-cuisine', 'truck-price', 'truck-meal', 'truck-tag' );

				foreach ( $taxes as $tax ) :
					$terms = wp_get_object_terms( $truck->ID, $tax );

					foreach ( $terms as $term ) :
				?>
				<a href="<?php echo get_term_link( $term ); ?>" class="btn"><?php echo $term->name; ?></a>
				<?php endforeach; ?>

			<?php endforeach; ?>
		</div>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>