<?php

while ( have_posts() ) : the_post();

	$truck = new Curbside_Truck( $post );

	print_r( $truck->get_locations() );

endwhile;