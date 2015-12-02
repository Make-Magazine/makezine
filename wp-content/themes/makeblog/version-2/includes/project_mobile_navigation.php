<?php
$current_category = get_query_var( 'category_name' );

$type = ( isset( $current_category ) ) ? sanitize_title( $current_category ) : '';
if ( $type != '' ) { ?>
	<div class="project-navigation">
		<?php
		$current_cat_id   = get_query_var( 'cat' );
		$current_cat_name = get_cat_name( $current_cat_id );
		$parent_cat       = get_queried_object();
		$parent_cat       = $parent_cat->parent;
		$parent_name      = get_cat_name( $parent_cat );
		$args             = array(
			'post_type' => 'projects',
			'parent'    => $current_cat_id,
			'exclude'   => array( 25624, 12, 8, 24794, 13, 1 ),
		);
		$categories       = get_categories( $args );
		?>
		<div class="cat-list-wrapp row">
			<h1 class="project-category-title" data-value="<?php echo $current_cat_id ?>"><?php single_cat_title(); ?></h1>
			<div class="filter_max">
				<div class="filter">
					<div class="mobile_cat row">
						<div class="spinner">
							<img src="<?php echo get_stylesheet_directory_uri() . '/images/spinner_60.gif'; ?>"
								 alt="spinner">
						</div>
						<form action="#">
							<div class="select-border"></div>
							<select name="category" id="mobile_cat" class="category_select">
								<option value="all" data-value="<?php echo $current_cat_id ?>">
									<?php single_cat_title(); ?>
								</option>
								<?php
								foreach ( $categories as $category ) {
									$cat_name = $category->cat_name;
									$cat_link = get_category_link( $category->cat_ID );

									?>
									<option value="<?php echo $category->term_id ?>">
										<?php echo $cat_name ?>
									</option>
								<?php } ?>
							</select>
						</form>
						<div class="cat_hidden">
							<?php
							foreach ( $categories as $category ) {
								$cat_name = $category->cat_name;
								$cat_link = get_category_link( $category->cat_ID );
								?>
								<a href="<?php echo $cat_link ?>" class="<?php echo $category->term_id ?>"></a>
							<?php } ?>
							?>
						</div>
					</div>

					<div class="mobile_diff row">
						<form action="#">
							<div class="select-border"></div>
							<select name="category" id="mobile_diff" class="category_select">
								<option value="" data-value="diff0">
									All Difficulties
								</option>
								<option value="" data-value="diff1">
									Easy for Everyone
								</option>
								<option value="" data-value="diff2">
									Intermediate
								</option>
								<option value="" data-value="diff3">
									Advanced
								</option>
							</select>
						</form>
					</div>

					<div class="mobile_dur row">
						<form action="#">
							<div class="select-border"></div>
							<select name="category" id="mobile_dur" class="category_select">
								<option value="" data-value="dur0">
									All Times
								</option>
								<option value="" data-value="dur1">
									1-3 hours
								</option>
								<option value="" data-value="dur2">
									3-8 hours
								</option>
								<option value="" data-value="dur3">
									8-16 hours (A Weekend)
								</option>
								<option value="" data-value="dur4">
									16 hours
								</option>
							</select>
						</form>
					</div>
					<div class="resets row">
						<div class="reset-button">
							<p class="close-button">Cancel</p>
							<p class="apply-button clicks">Apply Filters</p>
						</div>
					</div>
				</div>
				<div class="sortby row">
					<p>Sort By</p>

					<div class="post-filter">
						<p class="recent current clicks" data-value="recent">Recent</p>

						<p class="popular clicks" data-value="popular">Popular</p>
					</div>
				</div>
			</div>
			<div class="filter_mini">

				<p class="filter-button current">Filter</p>

				<p class="sort-button">Sort</p>
			</div>

			<div class="filter-applied">
				<span class="applied">Filter have been applied</span>
				<span class="clear clicks">Clear All</span>
			</div>
		</div>
	</div>

<?php } else { ?>
	<div class="project-navigation">
		<div class="cat-list-wrapp row">
			<h1 class="project-category-title" data-value="">Projects</h1>
			<div class="filter_max">
				<div class="spinner">
					<img src="<?php echo get_stylesheet_directory_uri() . '/images/spinner_60.gif'; ?>"
						 alt="spinner">
				</div>
				<div class="filter">
					<div class="mobile_cat row">


						<form action="#">
							<div class="select-border"></div>
							<select name="category" id="mobile_cat" class="category_select">
								<option value="all">
									All Categories
								</option>
								<?php
								$args       = array(
									'post_type' => 'projects',
									'parent'    => '0',
									'exclude'   => array( 25624, 12, 8, 24794, 13, 1 ),
								);
								$categories = get_categories( $args );
								foreach ( $categories as $category ) {
									$cat_name = $category->cat_name;
									$cat_link = get_category_link( $category->cat_ID );
									?>
									<option value="<?php echo $category->term_id ?>"">
										<?php echo $cat_name ?>
									</option>
									<?php $child_args       = array(
									'child_of' => $category->cat_ID,
									);
									$child_categories = get_categories( $child_args );
									foreach ( $child_categories as $category ) {
										$cat_name = $category->cat_name;
										$cat_link = get_category_link( $category->cat_ID );
										?>
										<option value="<?php echo $category->term_id ?>"">
											&nbsp;&nbsp;<?php echo $cat_name ?>
										</option>
									<?php } ?>
								<?php } ?>
							</select>
						</form>
						<div class="cat_hidden">
							<?php
							foreach ( $categories as $category ) {
								$cat_name = $category->cat_name;
								$cat_link = get_category_link( $category->cat_ID );
								?>
								<a href="<?php echo $cat_link ?>" class="<?php echo $category->term_id ?>"></a>
								<?php $child_args       = array(
									'child_of' => $category->cat_ID,
								);
								$child_categories = get_categories( $child_args );
								foreach ( $child_categories as $category ) {
									$cat_name = $category->cat_name;
									$cat_link = get_category_link( $category->cat_ID );
									?>
									<a href="<?php echo $cat_link ?>" class="<?php echo $category->term_id ?>"></a>
								<?php } ?>
							<?php } ?>
							?>
						</div>
					</div>

					<div class="mobile_diff row">
						<form action="#">
							<div class="select-border"></div>
							<select name="category" id="mobile_diff" class="category_select">
								<option value="" data-value="diff0">
									All Difficulties
								</option>
								<option value="" data-value="diff1">
									Easy for Everyone
								</option>
								<option value="" data-value="diff2">
									Intermediate
								</option>
								<option value="" data-value="diff3">
									Advanced
								</option>
							</select>
						</form>
					</div>

					<div class="mobile_dur row">
						<form action="#">
							<div class="select-border"></div>
							<select name="category" id="mobile_dur" class="category_select">
								<option value="" data-value="dur0">
									All Times
								</option>
								<option value="" data-value="dur1">
									1-3 hours
								</option>
								<option value="" data-value="dur2">
									3-8 hours
								</option>
								<option value="" data-value="dur3">
									8-16 hours (A Weekend)
								</option>
								<option value="" data-value="dur4">
									16 hours
								</option>
							</select>
						</form>
					</div>
					<div class="resets row">
						<div class="reset-button">
							<p class="close-button">Cancel</p>
							<p class="apply-button clicks">Apply Filters</p>
						</div>
					</div>
				</div>
				<div class="sortby row">
					<p>Sort By</p>

					<div class="post-filter">
						<p class="recent current clicks" data-value="recent">Recent</p>

						<p class="popular clicks" data-value="popular">Popular</p>
					</div>
				</div>
			</div>
			<div class="filter_mini">
				<p class="filter-button current">Filter</p>

				<p class="sort-button">Sort</p>
			</div>
			<div class="filter-applied">
				<span class="applied">Filter have been applied</span>
				<span class="clear clicks">Clear All</span>
			</div>
		</div>
	</div>
<?php }