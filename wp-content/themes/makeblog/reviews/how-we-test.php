<?php
get_header('version-2');
get_template_part( 'reviews/content/header/reviews' );

$hero = get_field( 'hero_image' );
?>

<?php if ( ! empty( $hero ) ): ?>
	<div id="hero-products">
		<img class="hero-single-products" src="<?php echo $hero['url']; ?>" alt=""/>
	</div><!-- #hero-products -->
<?php endif; ?>

<div id="content-wrap" class="container <?php if ( empty( $hero ) ) {
	echo 'no-hero';
} ?>">
	<div class="row cw-content">
		<div id="product-content" class="col-sm-8">

			<h2 class="product-title"><?php echo get_field('title'); ?></h2>

			<p><?php echo get_field( 'how_we_test' ); ?></p>

			<h4 class="authors-title">The Make: Digital Fabrication Team</h4>

			<div class="row testing-authors">

				<?php if ( class_exists( 'CoAuthorsIterator' ) ):
					$i = new CoAuthorsIterator();
					$i->iterate();

					do {
						$user_description = get_user_meta( $i->current_author->ID );
						$user_description = esc_html( $user_description['description'][0] );
						?>

						<div class="author col-sm-3">
							<a href="<?php echo get_author_posts_url( $i->current_author->ID ); ?>" class="author-target">
								<?php echo get_avatar( $i->current_author->ID ); ?>
								
								<?php
								if( ! empty( $user_description ) ){
								?>
									<div class="description">
										<p><?php echo $user_description; ?></p>
	
										<div class="gradient"></div>
									</div><!-- .description -->
								<?php
								}
								?>
							</a><!-- .author-target -->
							<h5><?php echo esc_html( $i->current_author->display_name ); ?></h5>

							<?php
							$twitter = get_user_meta( $i->current_author->ID, 'twitter', true );
							if ( ! empty( $twitter ) ):
								?>
								<p><a class="twitter-link" target="_blank"
								      href="<?php echo esc_url( 'https://twitter.com/intent/follow?screen_name=' . $twitter ); ?>"><i
											class="fa fa-twitter"></i> <span><?php echo esc_html( $twitter ); ?></span></a></p>
							<?php endif; ?>

						</div>
						<!-- .author -->
						<?php
					} while ( $i->iterate() );

				endif; ?>


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
				<?php global $make; print $make->ads->ad_300x250_atf; ?>
			</div><!-- .meta-block.ad-1 -->

			<div class="meta-block pro-tips desktop">
				<h4><?php echo get_field( 'pro_tips_title' ); ?></h4>

				<p><?php echo get_field( 'pro_tips' ); ?></p>
			</div>
			<!-- .meta-block.pro-tips -->
			
			
			<div class="meta-block ad-2 desktop no-border">
				<?php global $make; print $make->ads->ad_300x600; ?>
			</div><!-- .meta-block.ad-2 -->
			
		</div><!-- .col -->
		
		
		
		
		
		
		
		
	</div><!-- .cw-content -->
</div><!-- .container -->
	
	


<?php get_footer(); ?>






















