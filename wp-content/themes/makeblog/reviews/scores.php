<?php get_header('version-2'); ?>

<div class="header-ad">
	<li class="post col-lg-4 col-md-4 col-sm-6 col-xs-12 own_ads">
		<div class="own">
			<div class="home-ads">
				<?php global $make; print $make->ads->leaderboard; ?>
			</div>
		</div>
	</li>
</div><!-- .header-ad -->

<div class="container">
	<?php get_template_part( 'reviews/content/header/reviews' ); ?>
</div>

<?php $image = get_field('scores_image'); ?>
	
<main id="scores" class="container">



	<div class="row">

		<div class="tc-container">
			<section class="tc-content">
			
				<img class="scores-large" src="<?php echo $image['url']; ?>" alt=""/>

				<ul id="score-list">
					<?php
					$container = Reviews()->container();

					$products = $container['Relationships']->get_products_in_review( get_the_ID(), [ 'orderby' => 'post_title', 'order' => 'ASC' ] );

					foreach ( $products as $product ):
						$mobile_image = get_field( 'scores_image', $product->ID );
						if( ! empty( $mobile_image ) ){
						?>
							<li>
								<img src="<?php echo $mobile_image['url']; ?>" alt=""/>
							</li>
						<?php	
						}
						?>
					<?php endforeach; ?>
				</ul>


				<?php
				$methodology = get_field( 'scoring_methodology' );
				$methodology = \Reviews\Theme::partition_array( $methodology, count( $methodology ) < 3 ? count( $methodology ) : 3 );
				$count       = 0;
				?>

				<div id="scoring">
					<?php foreach ( $methodology as $group ) { $count++; ?>
						<div class="column <?php if ( $count === count( $methodology ) ){ echo 'last'; }?>">
							<?php foreach ( $group as $item ) { ?>
								<article>
									<h5><?php echo $item['title']; ?></h5>

									<p><?php echo $item['description']; ?></p>
								</article>
							<?php } ?>
						</div><!-- .column -->
					<?php } ?>
				</div><!-- #scoring -->
			
			</section><!-- .tc-content -->
		</div><!-- .tc-container -->

		
		
		
		<aside class="reviews-sidebar tc-sidebar scores-sidebar">
			
			<div class="meta-block ad-1">
				<?php global $make; print $make->ads->ad_300x250_atf; ?>
			</div><!-- .meta-block.ad-1 -->
			<?php $how_scoring_works = get_field( 'how_scoring_works' ); ?>

			<?php if ( ! empty( $how_scoring_works ) ): ?>
				<div class="meta-block pro-tips desktop">
					<h4>How Scoring Works</h4>

					<p><?php echo $how_scoring_works; ?></p>
				</div>
			<?php endif; ?>
			
			<div class="meta-block ad-2 desktop no-border">
				<?php global $make; print $make->ads->ad_300x600; ?>
			</div><!-- .meta-block.ad-2 -->
		
		</aside><!-- .reviews-sidebar -->
		
		
		

	</div><!-- .div -->

</main><!-- .container -->

<?php get_footer(); ?>
