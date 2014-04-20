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

	<?php $truck = new Curbside_Truck( $post, $from = 'menu-item' );?>

	<header class="bar bar-nav">
		<a href="<?php echo $truck->get_menu_url(); ?>" class="btn btn-link btn-nav pull-left" data-transition="slide-out">
			<span class="icon icon-left-nav"></span>
			Back
		</button>

		<a href="#" class="icon icon-bars pull-right"></a>

		<h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	</header>

	<div class="content">

		<div class="content-padded">
			<?php the_post_thumbnail(); ?>
		</div>

		<div class="card">
			<ul class="table-view">
				<li class="table-view-cell">
					<?php the_content(); ?>
				</li>
				<li class="table-view-cell">
					$0.00
				</li>
			</ul>
		</div>

		<?php endwhile; ?>

		<?php locate_template( array( 'bar-tab.php' ), true ); ?>

	</div>

<?php get_footer(); ?>