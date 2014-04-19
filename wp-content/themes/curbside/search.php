<?php
/**
 * Search
 *
 * @package Curbside Cuisine
 */

get_header(); ?>

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

<?php get_footer(); ?>