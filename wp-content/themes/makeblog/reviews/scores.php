<?php get_header('version-2'); ?>

<?php // Reviews Section Header
get_template_part( 'reviews/content/header/ads-leaderboard' ); ?>

<div class="container">
	<?php get_template_part( 'reviews/content/header/reviews' ); ?>
</div>

<?php $image = get_field('scores_image'); ?>
	
<main id="scores" class="container">

	<div class="row">

		<div class="tc-container mz-body">
			<section class="tc-content">
			
				<img class="scores-large" src="<?php echo $image['url']; ?>" alt="Product review scoring image"/>

				<ul id="score-list">
					<?php
					$container = Reviews()->container();

					$products = $container['Relationships']->get_products_in_review( get_the_ID(), [ 'orderby' => 'post_title', 'order' => 'ASC' ] );

					foreach ( $products as $product ):
						$mobile_image = get_field( 'scores_image', $product->ID );
						if( ! empty( $mobile_image ) ){
						?>
							<li>
								<img src="<?php echo $mobile_image['url']; ?>" alt="Product review scoring image mobile"/>
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
		
		<aside class="reviews-sidebar tc-sidebar scores-sidebar mz-sidebar">
			
			<div class="meta-block ad-1">
				<p id="ads-title">ADVERTISEMENT</p>
				<?php global $make; print $make->ads->ad_300x250_atf; ?>
			</div><!-- .meta-block.ad-1 -->
			<?php $how_scoring_works = get_field( 'how_scoring_works' ); ?>

			<?php if ( ! empty( $how_scoring_works ) ): ?>
				<div class="meta-block pro-tips desktop">
					<h4>How Scoring Works</h4>

					<p><?php echo $how_scoring_works; ?></p>
				</div>
			<?php endif; ?>

			<?php
			$slug = \Reviews\Architecture\Post_Types\Reviews::get_product_category_slug( $id );
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
			}?>
			
			<div class="meta-block ad-2 desktop no-border">
				<p id="ads-title">ADVERTISEMENT</p>
				<?php global $make; print $make->ads->ad_300x600; ?>
			</div><!-- .meta-block.ad-2 -->
		
		</aside><!-- .reviews-sidebar -->

	</div><!-- .div -->

</main><!-- .container -->

<?php get_footer(); ?>
