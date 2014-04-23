<?php
/**
 * Template Name: Search
 *
 * @package Curbside Cuisine
 */

get_header(); ?>

	<header class="bar bar-nav">
		<a href="<?php echo home_url(); ?>" class="btn btn-link btn-nav pull-left" data-transition="slide-out">
			<span class="icon icon-left-nav"></span>
			Home
		</a>

		<a href="#" class="icon icon-bars pull-right"></a>

		<h1 class="title">
			Search
		</h1>
	</header>

	<?php locate_template( array( 'bar-tab.php' ), true ); ?>

	<div class="content">

		<div class="card">
			<ul class="table-view">
				<li class="table-view-cell">
					<a href="#" class="navigate-right">by <strong>Keyword</strong></a>
				</li>
				<li class="table-view-cell">
					<a href="#" class="navigate-right">by <strong>Cuisine</strong></a>
				</li>
				<li class="table-view-cell">
					<a href="#" class="navigate-right">by <strong>Meal</strong></a>
				</li>
				<li class="table-view-cell">
					<a href="#" class="navigate-right">by <strong>Price</strong></a>
				</li>
				<li class="table-view-cell">
					<a href="#" class="navigate-right">by <strong>Tag</strong></a>
				</li>
			</ul>
		</div>

	</div>

<?php get_footer(); ?>