<nav class="bar bar-tab">
	<a class="tab-item <?php echo is_home() ? 'active' : ''; ?>" href="<?php echo home_url(); ?>">
		<span class="icon icon-home"></span>
		<span class="tab-label">Home</span>
	</a>

	<?php if ( is_singular( 'truck' ) ) : ?>
		<a class="tab-item" href="#">
			<span class="icon icon-sound"></span>
			<span class="tab-label">Call</span>
		</a>

		<a class="tab-item" href="#">
			<span class="icon icon-star-filled"></span>
			<span class="tab-label">Following</span>
		</a>
	<?php else : ?>
		<a class="tab-item" href="#">
			<span class="icon icon-person"></span>
			<span class="tab-label">Profile</span>
		</a>

		<a class="tab-item" href="<?php echo esc_url( add_query_arg( 's', 'Dinner', home_url() ) ); ?>">
			<span class="icon icon-search"></span>
			<span class="tab-label">Search</span>
		</a>
	<?php endif; ?>
</nav>