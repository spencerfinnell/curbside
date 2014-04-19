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

<?php get_footer(); ?>