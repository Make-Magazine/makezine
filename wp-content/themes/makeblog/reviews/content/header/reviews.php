<?php
/**
 * The Reviews Section Header
 */
?>
<div class="row">
	<header class="reviews-header">

		<h1 class="review-title">Make: 3D Printer Buyer's Guide</h1>

		<nav class="review-nav navbar">
			<ol class="nav navbar-nav">
				<li <?php if ( \Reviews\Architecture\Post_Types\Reviews::is_how_we_test() ) { ?> class="active"  <?php } ?> >
					<a href="<?php echo \Reviews\Architecture\Post_Types\Reviews::get_how_we_test_link(); ?>">How We Test</a>
				</li>
				<li <?php if ( \Reviews\Architecture\Post_Types\Reviews::is_review() ) { ?> class="active"  <?php } ?> >
					<a href="<?php echo get_permalink(); ?>">Compare</a>
				</li>
				<li <?php if ( \Reviews\Architecture\Post_Types\Reviews::is_scores() ) { ?> class="active"  <?php } ?> >
					<a href="<?php echo \Reviews\Architecture\Post_Types\Reviews::get_scores_link(); ?>">Scores</a>
				</li>
				<?php
				$container = Reviews()->container();
				$products  = $container['Relationships']->get_products_in_review( get_the_ID() );
				?>
				<li class="has-submenu dropdown">
					<button id="reviews-nav-btn" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reviews</button>
					<section class="submenu" aria-labelledby="reviews-nav-btn">
						<ol>
						<?php foreach ( $products as $product ): ?>
							<li><a href="<?php echo get_permalink( $product->ID ); ?>"><?php echo $product->post_title; ?></a></li>
						<?php endforeach; ?>
						</ol>
					</section>
				</li>
				<li class="mag navbar-right"><a href="#">Magazine Link</a></li>
			</ol>
		</nav>

		<div class="review-nav-btns visible-xs-block">
			<button id="show-filters-btn" type="button" class="show-filters-btn btn btn-default" aria-haspopup="true" aria-expanded="false">Filter</button>
			<button id="show-sort-btn" type="button" class="show-sort-btn btn btn-default" aria-haspopup="true" aria-expanded="false">Sort</button>
		</div><!-- .review-nav-btns -->

	</header>
</div>