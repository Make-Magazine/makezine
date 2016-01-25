<?php get_header('version-2'); ?>

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




<div id="content-wrap" class="container <?php if ( empty( $hero ) ) {
	echo 'no-hero';
} ?>">
	<div class="row cw-content">
		<div id="product-content" class="col-sm-8">
			
			<a data-sumome-share-id="002914e1-bbce-4a58-b59e-8846991ae71c"></a>

			<h2 class="product-title"><?php echo get_field('title'); ?></h2>

			<p><?php echo get_field( 'how_we_test' ); ?></p>
			<?php
			$slug  = \Reviews\Architecture\Post_Types\Reviews::get_product_category_slug( get_the_ID() );
			$title = ( $slug === 'boards' ) ? 'The Make: Boards Team' : 'The Make: Digital Fabrication Team';
			?>
			<h4 class="authors-title"><?php echo $title; ?></h4>

			<div class="row testing-authors">
				<?php
				$authors = get_coauthors( get_the_ID() );
				$author_data = new Make_Authors();
				$postcount = -1;
				foreach ( $authors as $author ) {
					$postcount++;
					if($postcount % 4 == 0){
					    $clear_count = 'clear-4';
					}else if($postcount % 3 == 0){
					    $clear_count = 'clear-3';
					}else{
						$clear_count = '';
					}
					$evenOdd = ( ($postcount % 2) == 0 ) ? " clear-2" : "";
					?>

					<div class="author col-sm-3 <?php echo $clear_count; echo $evenOdd; ?>">
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
							<p><a class="twitter-link" target="_blank"
							      href="<?php echo esc_url( 'https://twitter.com/intent/follow?screen_name=' . $twitter ); ?>"><i
										class="fa fa-twitter"></i> <span><?php echo esc_html( $twitter ); ?></span></a></p>
						<?php endif; ?>

					</div>
					<!-- .author -->
					<?php
				}

				?>


			</div>
			<!-- .row -->

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
			
			
			<div class="meta-block ad-2 desktop no-border">
				<p id="ads-title">ADVERTISEMENT</p>
				<?php global $make; print $make->ads->ad_300x600; ?>
			</div><!-- .meta-block.ad-2 -->
			
		</div><!-- .col -->
		
		
		
		
		
		
		
		
	</div><!-- .cw-content -->
</div><!-- .container -->
	
	


<?php get_footer(); ?>






















