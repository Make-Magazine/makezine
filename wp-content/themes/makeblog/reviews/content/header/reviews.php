<?php
/**
 * The Reviews Section Header
 */

// Get the correct comparison post ID
$id        = get_the_ID();
$container = Reviews()->container();
// $count = get_the_terms($id, 'product-categories')[0]->count;

if ( is_singular( \Reviews\Architecture\Post_Types\Products::NAME ) ) {
	$review = $container['Relationships']->get_review_for_product( get_the_ID() );
	if ( count( $review ) > 0 ) {
		$id = $review[0]->ID;
	}
}

$modal_image    = get_field( 'magazine_thumbnail', $id );
$modal_text     = get_field( 'magazine_label', $id );
$slug  = \Reviews\Architecture\Post_Types\Reviews::get_product_category_slug( $id );

?>

<div class="row">
	<header class="reviews-header col-xs-12">

		<h1>Digital Fabrication Tool Guide</h1>

		<nav class="review-nav">

			<?php if ( $modal_image ) { ?>
				<div class="review-nav-mag">
					<button id="modal-capture-btn" class="modal-capture-btn class-<?php echo $slug; ?>">
						<img alt="Review guide featured image" src="<?php echo esc_attr( $modal_image['sizes'][ 'p1' ] ); ?>" />
						<?php echo $modal_text; ?>
					</button>
				</div>
			<?php } ?>

			<div class="review-nav-choosing">
			<?php $oldCodeWas = '<div class="review-nav-choosing" <?php if ( \Reviews\Architecture\Post_Types\Reviews::is_how_we_test() ) { ?> class="active"  <?php } ?> >' ?>
            <div class="btn-wrapper hidden-lg hidden-md hidden-sm">
					<a href="/digital-fabrication-tool-guide"><?php echo(get_field('compare_button')); ?></a>
				</div>
				<span class="hidden-xs">
				<a id="compare" <?php if ( \Reviews\Architecture\Post_Types\Reviews::is_review() ) { ?> class="active" <?php } ?> href="<?php echo get_permalink( $id ); ?>">
					<div class="btn-wrapper"><?php echo(get_field('compare_button') . " <span id='count'></span><span id='category-picker' class='lnr lnr-chevron-down hidden-xs'></span>"); ?> </div>
					<?php if( get_field('digital_fabrication') === true ) { ?>
					<div id="category-dropdown">
						<?php 
							$categories = get_posts([
  								'post_type' => 'reviews',
  								'post_status' => 'publish'
							]);
						   $categoryDropdownOutput = '';
						   foreach($categories as $category){
								if( get_field('digital_fabrication', $category->ID) === true ) { 
									$categoryDropdownOutput .= '<a href="' . get_permalink($category->ID) . '">Compare ' . ucwords(str_replace("-"," ",$category->post_name)) . '</a>';
								}
							}
							echo($categoryDropdownOutput);
						?>
					</div>
					<?php } ?>
				</a>
				</span>

				<a <?php if ( \Reviews\Architecture\Post_Types\Reviews::is_how_we_test() ) { ?> class="active"  <?php } ?> href="<?php echo \Reviews\Architecture\Post_Types\Reviews::get_how_we_test_link( $id ); ?>">
					<?php 
					   if(get_field('how_button') && get_field('how_button') != "") {
					   	echo(get_field('how_button')); 
						} else { echo("How we test"); }
					?>
				</a>

				<?php if ( \Reviews\Architecture\Post_Types\Reviews::is_scoring_enabled( $id ) ) { ?>
					<a <?php if ( \Reviews\Architecture\Post_Types\Reviews::is_scores() ) { ?> class="active"  <?php } ?> href="<?php echo \Reviews\Architecture\Post_Types\Reviews::get_scores_link( $id ); ?>">
					  <?php
						   if(get_field('scoring_button') && get_field('scoring_button') != "") {
								echo(get_field('scoring_button')); 
							} else { echo("Scoring"); }
					  ?>
				   </a>
				<?php } ?>

				<?php if ( \Reviews\Architecture\Post_Types\Reviews::is_review() ) { ?>
					<button id="show-filters-btn" type="button" class="show-filters-btn visible-xs-inline-block" aria-haspopup="true" aria-expanded="false">Filter</button>
				<?php } ?>
			</div>

		</nav>
	</header>
</div>