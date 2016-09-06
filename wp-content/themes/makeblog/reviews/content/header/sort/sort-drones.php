<?php
/**
 * The Reviews Listing/Sort Header
 */
?>
<header class="rl-header">
	<form id="rl-sort-form" action="" class="fl-sort-list clearfix" aria-labelledby="show-sort-btn">

		<div class="rl-sort">
			<h3 class="rl-sort-header visible-xs-block">Sort By:</h3>
			<div class="rl-sort-options">
				<span class="image spacer"></span>
				<label for="az" class="details">
					<input id="az" type="radio" name="sort" value="title">
					<span>A-Z <i class="fa fa-angle-down" aria-hidden="true"></i></span>
				</label>
				<label for="score" class="score">
					<input id="score" type="radio" name="sort" value="score" checked>
					<span>Score <i class="fa fa-angle-down" aria-hidden="true"></i></span>
				</label>
				<label for="price" class="price">
					<input id="price" type="radio" name="sort" value="price">
					<span>Price <i class="fa fa-angle-down" aria-hidden="true"></i></span>
				</label>
				<span class="winner spacer"></span>
			</div>
		</div><!-- .fl-sort -->

		<div class="rl-actions visible-xs-block">
			<div class="rl-actions-wrap">
				<button id="sort-cancel-btn" type="button" class="sort-cancel-btn btn btn-default">Cancel</button>
				<button id="sort-apply-btn" type="submit" class="sort-apply-btn btn btn-primary">Apply</button>
			</div>
		</div><!-- .fl-actions -->

	</form>
</header>
