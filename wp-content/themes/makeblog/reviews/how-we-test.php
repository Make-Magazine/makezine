<?php get_header('universal'); ?>

<?php // Reviews Section Header
get_template_part( 'reviews/content/header/ads-leaderboard' ); ?>

<div class="container">
	<?php get_template_part( 'reviews/content/header/reviews' ); ?>
</div>

<?php $hero = get_field( 'hero_image' ); ?>

<?php if ( ! empty( $hero ) ): ?>
	<div id="hero-products" class="how-we-test" style="background-image: url(<?php echo esc_attr( $hero['url'] );?>);">
		<img class="hero-single-products" src="<?php echo $hero['url']; ?>" alt=""/>
	</div><!-- #hero-products -->
<?php endif; ?>


<div id="content-wrap" class="container <?php if ( empty( $hero ) ) { echo 'no-hero'; } ?>">
	<div class="row cw-content">
		<div id="product-content" class="col-sm-8">
			
			<a data-sumome-share-id="002914e1-bbce-4a58-b59e-8846991ae71c"></a>

			<h2 class="product-title"><?php echo get_field('title'); ?></h2>

			<p><?php echo get_field( 'how_we_test' ); ?></p>
			<?php
			$slug  = \Reviews\Architecture\Post_Types\Reviews::get_product_category_slug( get_the_ID() );
			$title = 'The Make: Testing Team';
			?>
			<h4 class="authors-title"><?php echo $title; ?></h4>

			<div class="row testing-authors">
				<?php
				$authors = get_coauthors( get_the_ID() );
				$author_data = new Make_Authors();
				foreach ( $authors as $author ) {	?>
					<div class="author col-xs-4 col-sm-4 col-md-3 col-lg-3">
						<a href="<?php echo get_author_posts_url( $author->ID, $author->user_nicename ); ?>" class="author-target">
							<?php echo $author_data->author_avatar( $author ); ?>

							<?php
							$description = $author_data->author_bio( $author );
							if ( ! empty( $description ) ) {
								?>
								<div class="description">
									<p><?php echo strip_tags( $description ); ?></p>

									<div class="gradient"></div>
								</div><!-- .description -->
								<?php
							}
							?>
						</a><!-- .author-target -->
						<h5><?php echo esc_html( $author->display_name ); ?></h5>

						<?php
						$twitter = get_user_meta( $author->ID, 'twitter', true );
						if ( ! empty( $twitter ) ):
							?>
							<p>
								<a class="twitter-link" target="_blank" href="<?php echo esc_url( 'https://twitter.com/intent/follow?screen_name=' . $twitter ); ?>">
									<i class="fa fa-twitter"></i> <span><?php echo esc_html( $twitter ); ?></span>
								</a>
							</p>
						<?php endif; ?>

					</div>
					<!-- .author -->
					<?php
				}
				?>

			</div><!-- .testing-authors-->

			
			<?php if( have_rows('previous_testers') ): ?>

				<h4 class="authors-title">Previous Testers</h4>

				<div class="row previous-testing-authors">

				<?php while( have_rows('previous_testers') ): the_row(); 

					$author_type = get_sub_field('author_type'); 

					if($author_type == 'user') {
						$user_object = get_sub_field('makezine_users');
						$description = $user_object['user_description'] ?>

						<div class="author col-xs-4 col-sm-4 col-md-3 col-lg-3">
							<a href="/author/<?php echo $user_object['user_nicename']; ?>" class="author-target">
								<?php echo get_avatar( $user_object['ID'], 300 ); ?>
								<?php
								if (!empty($description)) {
									?>
									<div class="description">
										<p><?php echo strip_tags( $description ); ?></p>
										<div class="gradient"></div>
									</div>
								<?php } ?>
							</a>
							<h5><?php echo ($user_object["display_name"]); ?></h5>
						</div>

					<?php
					} else {
						$coauthor_object = get_sub_field('coauthors');
						$authors = get_coauthors( $coauthor_object[0]->ID );
						$author_data = new Make_Authors();
						$image = $author_data->author_avatar( $authors[0] );
						$description = $author_data->author_bio($authors[0] ); ?>
						<div class="author col-xs-4 col-sm-4 col-md-3 col-lg-3">
							<a href="/author/<?php echo $coauthor_object[0]->post_name; ?>" class="author-target">
								<?php echo $image;
								if (!empty($description)) {
									?>
									<div class="description">
										<p><?php echo strip_tags( $description ); ?></p>
										<div class="gradient"></div>
									</div>
								<?php } ?>
							</a>
							<h5><?php echo $coauthor_object[0]->post_title; ?></h5>
						</div>
						
					<?php } ?>


				<?php endwhile; ?>

				</div><!-- .previous-testing-authors -->

			<?php endif; ?>


		</div>
		<!-- .col -->

		<div id="product-sidebar" class="col-sm-4">
			
			<div class="meta-block pro-tips mobile border-top">
				<h4><?php echo get_field( 'pro_tips_title' ); ?></h4>
			
				<p><?php echo get_field( 'pro_tips' ); ?></p>
			</div><!-- .meta-block.pro-tips -->
			
			<div class="meta-block ad-1">
				<p id="ads-title">ADVERTISEMENT</p>
				<?php global $make; print $make->ads->ad_300x250_atf; ?>
			</div><!-- .meta-block.ad-1 -->

			<div class="meta-block pro-tips desktop">
				<h4><?php echo get_field( 'pro_tips_title' ); ?></h4>

				<p><?php echo get_field( 'pro_tips' ); ?></p>
			</div>
			<!-- .meta-block.pro-tips -->

			<?php
			if ( $slug === 'boards' ) {
				if ( is_active_sidebar( 'sidebar_comparison_boards' ) ) { ?>
					<div class="clearfix"></div>
					<div class="sidebar-wrapper">
						<?php dynamic_sidebar('sidebar_comparison_boards'); ?>
					</div>
					<div class="clearfix"><br /><br /></div>
				<?php } 
			} else if ( $slug === 'printers' ) {
				if ( is_active_sidebar( 'sidebar_comparison_3dprinter' ) ) { ?>
					<div class="clearfix"></div>
					<div class="sidebar-wrapper">
						<?php dynamic_sidebar('sidebar_comparison_3dprinter'); ?>
					</div>
					<div class="clearfix"><br /><br /></div>
				<?php } 
			} else if ( $slug === 'drones' ) {
				if ( is_active_sidebar( 'sidebar_comparison_drones' ) ) { ?>
					<div class="clearfix"></div>
					<div class="sidebar-wrapper">
						<?php dynamic_sidebar('sidebar_comparison_drones'); ?>
					</div>
					<div class="clearfix"><br /><br /></div>
				<?php } 
			} ?>
			
			<div class="meta-block ad-2 desktop no-border">
				<p id="ads-title">ADVERTISEMENT</p>
				<?php global $make; print $make->ads->ad_300x600; ?>
			</div><!-- .meta-block.ad-2 -->
			
		</div><!-- .col -->
		
	</div><!-- .cw-content -->
</div><!-- .container -->

<?php get_footer(); ?>
