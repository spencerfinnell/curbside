<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<input type="search" name="s" id="s" placeholder="Search" value="<?php echo get_search_query(); ?>">
	<input type="hidden" name="post_type" value="truck" />
</form>