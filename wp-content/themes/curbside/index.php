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
		<a href="<?php the_permalink(); ?>" class="btn btn-link btn-nav pull-left">
			<span class="icon icon-left-nav"></span>
			Back
		</button>

		<a href="#" class="icon icon-bars pull-right"></a>

		<h1 class="title">Menu</h1>
	</header>

	<div class="content">

		<div class="card">
			Map...
		</div>

		<div class="card">
			<ul class="table-view">
				<li class="table-view-cell">
					<a class="navigate-right">
						<span class="badge">5</span>
						Menu Items
					</a>
				</li>
				<li class="table-view-cell">
					<a class="navigate-right">
						<span class="badge">5</span>
						Upcoming Locations
					</a>
				</li>
				<li class="table-view-cell">
					<a class="navigate-right">
						<span class="badge">5</span>
						Rate and Review
					</a>
				</li>
			</ul>
		</div>

		<?php locate_template( array( 'bar-tab.php' ), true ); ?>

	</div>

<?php get_footer(); ?>