<nav class="bar bar-tab bar-footer">
	<a class="tab-item <?php echo is_home() ? 'active' : ''; ?>" href="<?php echo home_url(); ?>">
		<span class="icon icon-home"></span>
		<span class="tab-label">Home</span>
	</a>

	<a class="tab-item" href="<?php echo get_permalink( get_page_by_path( 'search' ) ); ?>">
		<span class="icon icon-search"></span>
		<span class="tab-label">Search</span>
	</a>

	<?php if ( is_singular( 'truck' ) ) : ?>
		<a class="tab-item" href="#">
			<span class="icon icon-sound"></span>
			<span class="tab-label">Call</span>
		</a>

		<?php if ( is_user_logged_in() ) : ?>
		<a class="tab-item" href="#">
			<span class="icon icon-star-filled"></span>
			<span class="tab-label">Following</span>
		</a>
		<?php endif; ?>
	<?php else : ?>
		<?php if ( is_user_logged_in() ) : ?>
		<a class="tab-item" href="#">
			<span class="icon icon-person"></span>
			<span class="tab-label">Profile</span>
		</a>
		<?php else : ?>
		<a class="tab-item" href="#">
			<span class="icon icon-person"></span>
			<span class="tab-label">Login</span>
		</a>
		<?php endif; ?>
	<?php endif; ?>
</nav>