<?php
/**
 *
 *
 * @package Curbside Cuisine
 */

$trucks = Curbside_Trucks::get_current_trucks();
$query = get_queried_object();

get_header(); ?>

	<header class="bar bar-nav">
		<a href="#" class="icon icon-bars pull-right"></a>

		<a href="<?php echo get_permalink( get_page_by_path( 'search' ) ); ?>" class="btn btn-link btn-nav pull-left">
			<span class="icon icon-left-nav"></span>
		</a>

		<h1 class="title">
			<?php if ( $query->term_id ) : ?>
				<?php single_term_title(); ?>
			<?php endif; ?>
		</h1>
	</header>

	<?php locate_template( array( 'bar-tab.php' ), true ); ?>

	<div class="content">

		<?php if ( ! empty( $trucks ) ) : ?>

		<div class="card">
			<div id="map"><span class="icon icon-more"></span></div>

			<script type="text/javascript">
				jQuery(document).ready(function($) {
					var map = curbsideMap();

					map.init({
						el: '#map',
						lat: '',
						lng: '',
						markers: <?php echo json_encode( $trucks ); ?>
					});
				});
			</script>
		</div>

		<div class="card">
			<ul class="table-view">
			<?php foreach ( $trucks as $truck ) : ?>
				<li class="table-view-cell">
					<a href="<?php echo get_permalink( $truck[ 'details' ][ 'permalink' ] ); ?>" class="navigate-right"><?php echo $truck[ 'details' ][ 'title' ]; ?></a>
				</li>
			<?php endforeach; ?>
			</ul>
		</div>

		<?php else : ?>

			<div class="card">
				<ul class="table-view">
					<li class="table-view-cell">No trucks found</li>
				</ul>
			</div>

		<?php endif; ?>

	</div>

<?php get_footer(); ?>