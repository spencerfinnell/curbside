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
				<li class="table-view-divider">
					Keyword
				</li>
				<li class="table-view-cell has-form">
					<?php get_search_form(); ?>
				</li>

				<?php
					$taxes = array( 'truck-cuisine', 'truck-price', 'truck-meal' );

					foreach ( $taxes as $tax ) :
						$taxonomy = get_taxonomy( $tax, 'truck' );
				?>

				<li class="table-view-divider">
					<?php echo $taxonomy->label; ?>
				</li>

					<?php
						$terms = get_terms( $tax, array( 'hide_empty' => 0 ) );

						foreach ( $terms as $term ) :
					?>
					<li class="table-view-cell">
						<a href="<?php echo get_term_link( $term ); ?>" class="navigate-right"><?php echo $term->name; ?></a>
					</li>
					<?php endforeach; ?>

				<?php endforeach; ?>
			</ul>
		</div>

	</div>

<?php get_footer(); ?>