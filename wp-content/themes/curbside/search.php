<?php
/**
 * Search
 *
 * @package Curbside Cuisine
 */

get_header(); ?>

	<header class="bar bar-nav">
		<a href="#" class="icon icon-bars pull-right"></a>

		<h1 class="title">
			<a href="<?php the_permalink(); ?>"><?php echo get_search_query(); ?></a>
		</h1>
	</header>

	<div class="bar bar-standard bar-header-secondary">
		<input type="search" placeholder="Search">
	</div>

	<div class="content">

		<div class="card">
			<ul class="table-view">

			<?php while ( have_posts() ) : the_post(); ?>

				<li class="table-view-cell">
					<a href="<?php the_permalink(); ?>" data-transition="slide-in" class="navigate-right">
						<span class="badge">5</span>
						<?php the_title(); ?>
					</a>
				</li>

			<?php endwhile; ?>

			</ul>
		</div>

		<?php locate_template( array( 'bar-tab.php' ), true ); ?>

	</div>

<?php get_footer(); ?>