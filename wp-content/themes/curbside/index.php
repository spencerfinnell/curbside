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

$trucks = Curbside_Trucks::get_current_trucks();

get_header(); ?>

	<header class="bar bar-nav">
		<a href="#" class="icon icon-bars pull-right"></a>

		<h1 class="title"><?php echo get_bloginfo( 'name' ); ?></h1>
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
						markers: <?php echo json_encode( $trucks ); ?>
					});
				});
			</script>
		</div>

		<div class="card">
			<ul class="table-view">
			<li class="table-view-divider">Trucks Near You</li>
			<?php foreach ( $trucks as $truck ) : ?>
				<li class="table-view-cell">
					<?php $truck = new Curbside_Truck( $truck[ 'id' ] ); ?>
					<a href="<?php echo get_permalink( $truck->ID ); ?>" class="navigate-right">
						<span class="badge"><?php echo $truck->get_cuisine(); ?></span>
						<?php echo get_the_title( $truck->ID ); ?>
					</a>
				</li>
			<?php endforeach; ?>
			</ul>
		</div>

	</div>

<?php get_footer(); ?>