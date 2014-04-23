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
		$truck = new Curbside_Truck( $post );
		$upcoming = $truck->get_upcoming_locations();
	?>

	<header class="bar bar-nav">
		<a href="<?php the_permalink(); ?>" class="btn btn-link btn-nav pull-left">
			<span class="icon icon-left-nav"></span>
		</a>

		<a href="#" class="icon icon-bars pull-right"></a>

		<h1 class="title">
			Upcoming Locations
		</h1>
	</header>

	<?php locate_template( array( 'bar-tab.php' ), true ); ?>

	<div class="content">

		<div class="card">
			<ul class="table-view">
				<?php if ( $upcoming->have_posts() ) : ?>
					<?php while ( $upcoming->have_posts() ) : $upcoming->the_post(); ?>
					<?php $location = new Curbside_Location( $post ); ?>

					<li class="table-view-cell">
						<a href="<?php the_permalink(); ?>" class="navigate-right">
							<span class="badge"><?php echo human_time_diff( current_time( 'timestamp' ), strtotime( $location->get_date() ) ); ?></span>
							<?php echo $location->get_street(); ?>
						</a>
					</li>
					<?php endwhile; ?>
				<?php else : ?>
					<li class="table-view-cell">Sorry, no upcoming locations.</li>
				<?php endif; ?>
			</ul>
		</div>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>