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

			<div class="filter_mini">

				<p class="filter-button current">Filter</p>

				<p class="sort-button">Sort</p>
			</div>
			<div class="filter-applied">
				<span class="applied">Filter have been applied</span>
				<span class="clear clicks">Clear All</span>
			</div>
			<div class="filter_max">
				<div class="filter">
					<div class="mobile_cat row">
						<div class="spinner">
							<img src="<?php echo get_stylesheet_directory_uri() . '/images/spinner_60.gif'; ?>"
							     alt="spinner">
						</div>
						<form action="#">
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
						<ul class="diff-item">
							<li class="col-xs-12 first-item current" data-value="diff0">
								<span>All Diffilculties</span>
							</li>
							<li class="col-xs-12 clicks" data-value="diff1">
								<div class="clock-wrapper">
									<span class="fa fa-wrench"></span>
								</div>
								<span>Easy for Everyone</span>
							</li>
							<li class="col-xs-12 clicks" data-value="diff2">
								<div class="clock-wrapper">
									<span class="fa fa-wrench"></span>
									<span class="fa fa-wrench"></span>
								</div>
								<span>Intermediate</span>
							</li>
							<li class="col-xs-12 clicks" data-value="diff3">
								<div class="clock-wrapper">
									<span class="fa fa-wrench"></span>
									<span class="fa fa-wrench"></span>
									<span class="fa fa-wrench"></span>
								</div>
								<span>Advanced</span></li>
						</ul>
					</div>




					<div class="mobile-dur row">
						<ul class="duration-item">
							<li class="col-xs-12 first-item current" data-value="dur0">
								<span>All Times</span>
							</li>
							<li class="col-xs-12 clicks" data-value="dur1">
								<div class="clock-wrapper">
									<span class="fa fa-clock-o"></span>
								</div>
								<span>1-3 hours</span>
							</li>
							<li class="col-xs-12 clicks" data-value="dur2">
								<div class="clock-wrapper">
									<span class="fa fa-clock-o"></span>
									<span class="fa fa-clock-o"></span>
								</div>
								<span>3-8 hours</span>
							</li>
							<li class="col-xs-12 clicks" data-value="dur3">
								<div class="clock-wrapper">
									<span class="fa fa-clock-o"></span>
									<span class="fa fa-clock-o"></span>
									<span class="fa fa-clock-o"></span>
								</div>
								<span>8-16 hours (A Weekend)</span></li>
							<li class="col-xs-12 clicks" data-value="dur4">
								<div class="clock-wrapper">
									<span class="fa fa-clock-o"></span>
									<span class="fa fa-clock-o"></span>
									<span class="fa fa-clock-o"></span>
									<span class="fa fa-clock-o"></span>
								</div>
								<span>>16 hours</span>
							</li>
						</ul>
					</div>
					<div class="resets row">
						<div class="reset-button">
							<p class="clear clicks">Reset</p>

							<p class="close-button">Close</p>
						</div>
					</div>
				</div>
				<div class="sortby row">
					<p>Sort By</p>

					<div class="post-filter">
						<p class="recent clicks" data-value="recent">Recent</p>

						<p class="popular clicks" data-value="popular">Popular</p>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php } else { ?>
	<div class="project-navigation">
		<div class="cat-list-wrapp row">
			<h1 class="project-category-title" data-value="">Project</h1>

			<div class="filter_mini">
				<p class="filter-button current">Filter</p>

				<p class="sort-button">Sort</p>
			</div>
			<div class="filter-applied">
				<span class="applied">Filter have been applied</span>
				<span class="clear clicks">Clear All</span>
			</div>
			<div class="filter_max">
				<div class="filter">
					<div class="mobile_cat row">
						<div class="spinner">
							<img src="<?php echo get_stylesheet_directory_uri() . '/images/spinner_60.gif'; ?>"
							     alt="spinner">
						</div>

						<form action="#">
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
						<ul class="diff-item">
							<li class="col-xs-12 first-item current" data-value="diff0">
								<span>All Diffilculties</span>
							</li>
							<li class="col-xs-12 clicks" data-value="diff1">
								<div class="clock-wrapper">
									<span class="fa fa-wrench"></span>
								</div>
								<span>Easy for Everyone</span>
							</li>
							<li class="col-xs-12 clicks" data-value="diff2">
								<div class="clock-wrapper">
									<span class="fa fa-wrench"></span>
									<span class="fa fa-wrench"></span>
								</div>
								<span>Intermediate</span>
							</li>
							<li class="col-xs-12 clicks" data-value="diff3">
								<div class="clock-wrapper">
									<span class="fa fa-wrench"></span>
									<span class="fa fa-wrench"></span>
									<span class="fa fa-wrench"></span>
								</div>
                            <span>Advanced</span></li>
						</ul>
					</div>




					<div class="mobile-dur row">
						<ul class="duration-item">
							<li class="col-xs-12 first-item current" data-value="dur0">
								<span>All Times</span>
							</li>
							<li class="col-xs-12 clicks" data-value="dur1">
								<div class="clock-wrapper">
									<span class="fa fa-clock-o"></span>
								</div>
								<span>1-3 hours</span>
							</li>
							<li class="col-xs-12 clicks" data-value="dur2">
								<div class="clock-wrapper">
									<span class="fa fa-clock-o"></span>
									<span class="fa fa-clock-o"></span>
								</div>
								<span>3-8 hours</span>
							</li>
							<li class="col-xs-12 clicks" data-value="dur3">
								<div class="clock-wrapper">
									<span class="fa fa-clock-o"></span>
									<span class="fa fa-clock-o"></span>
									<span class="fa fa-clock-o"></span>
								</div>
                            <span>8-16 hours (A Weekend)</span></li>
							<li class="col-xs-12 clicks" data-value="dur4">
								<div class="clock-wrapper">
									<span class="fa fa-clock-o"></span>
									<span class="fa fa-clock-o"></span>
									<span class="fa fa-clock-o"></span>
									<span class="fa fa-clock-o"></span>
								</div>
								<span>>16 hours</span>
							</li>
						</ul>
					</div>
					<div class="resets row">
						<div class="reset-button">
							<p class="clear clicks">Reset</p>

							<p class="close-button">Close</p>
						</div>
					</div>
				</div>
				<div class="sortby row">
					<p>Sort By</p>

					<div class="post-filter">
						<p class="recent clicks" data-value="recent">Recent</p>

						<p class="popular clicks" data-value="popular">Popular</p>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }