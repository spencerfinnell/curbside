<nav class="bar bar-tab">
	<a class="tab-item <?php echo is_home() ? 'active' : ''; ?>" href="<?php echo home_url(); ?>">
		<span class="icon icon-home"></span>
		<span class="tab-label">Home</span>
	</a>
	<a class="tab-item" href="#">
		<span class="icon icon-person"></span>
		<span class="tab-label">Profile</span>
	</a>
	<a class="tab-item" href="#">
		<span class="icon icon-star-filled"></span>
		<span class="tab-label">Favorites</span>
	</a>
</nav>