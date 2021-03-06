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
		</button>

		<a href="#" class="icon icon-bars pull-right"></a>

		<h1 class="title"><a href="<?php the_permalink(); ?>">Menu</a></h1>
	</header>

	<?php locate_template( array( 'bar-tab.php' ), true ); ?>

	<div class="content">

		<div class="card">
			<ul class="table-view">
				<?php foreach ( get_terms( array( 'menu_item-item_category' ) ) as $category ) : ?>
					<?php $items = $menu->get_items( $category->term_id ); ?>

					<li class="table-view-cell table-view-divider"><?php echo $category->name; ?></li>

					<?php
						while ( $items->have_posts() ) :
							$items->the_post();
							$item = new Curbside_Menu_Item( $post );
					?>
						<li class="table-view-cell">
							<a href="<?php the_permalink(); ?>" class="navigate-right">
								<span class="badge"><?php echo $item->get_price(); ?></span>
								<?php the_title(); ?>
							</a>
						</li>
					<?php endwhile; ?>
				<?php endforeach; ?>
			</ul>
		</div>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>