<?php
/**
 * The Reviews Listing/Sort Header
 */
?>
<header class="rl-header">
	<form id="rl-sort-form" action="" class="fl-sort-list clearfix">

		<div class="rl-sort">
			<div class="rl-sort-options">

				<h3 class="rl-sort-header rl-sort-cell">SORT BY</h3>

				<label for="az" class="details rl-sort-cell">
					<input id="az" type="radio" name="sort" value="title">
					<span>A-Z <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i></span>
				</label>

				<?php if ( \Reviews\Architecture\Post_Types\Reviews::is_scoring_enabled( get_the_ID() ) ) : ?>
				<label for="score" class="score rl-sort-cell">
					<input id="score" type="radio" name="sort" value="score" checked>
					<span>Score <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i></span>
				</label>
				<?php endif; ?>

				<label for="price" class="price rl-sort-cell">
					<input id="price" type="radio" name="sort" value="price">
					<span>Price <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i></span>
				</label>

			</div>
		</div><!-- .fl-sort -->

	</form>
</header>
