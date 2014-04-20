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
		$menu = $truck->get_menu();
	?>

	<header class="bar bar-nav">
		<a href="<?php the_permalink(); ?>" class="btn btn-link btn-nav pull-left" data-transition="slide-out">
			<span class="icon icon-left-nav"></span>
			Back
		</button>

		<a href="#" class="icon icon-bars pull-right"></a>

		<h1 class="title">Menu</h1>
	</header>

	<div class="content">

		<div class="card">
			<ul class="table-view">
				<?php foreach ( get_terms( array( 'menu_item-item_category' ) ) as $category ) : ?>
					<?php $items = $menu->get_items( $category->term_id ); ?>

					<li class="table-view-cell table-view-divider"><?php echo $category->name; ?></li>

					<?php while ( $items->have_posts() ) : $items->the_post(); ?>
						<li class="table-view-cell">
							<a href="<?php the_permalink(); ?>" class="navigate-right">
								<span class="badge">$0.00</span>
								<?php the_title(); ?>
							</a>
						</li>
					<?php endwhile; ?>
				<?php endforeach; ?>
			</ul>
		</div>

		<?php endwhile; ?>

		<?php locate_template( array( 'bar-tab.php' ), true ); ?>

	</div>

<?php get_footer(); ?>