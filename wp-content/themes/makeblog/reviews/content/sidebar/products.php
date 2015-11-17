<?php
$why_buy_content  = get_field( 'why_to_buy' );
$link             = get_field( 'buy_link' );
$pro_tips_title = get_field( 'pro_tips_title' );
$pro_tips_content = get_field( 'pro_tips' );
$scored_image     = get_field( 'scores_image' );
?>

<?php if ( class_exists( 'CoAuthorsIterator' ) ): ?>
	<div class="meta-block authored-by desktop">
		<ul>
			<?php
			$i = new CoAuthorsIterator();
			$i->iterate();
			do {
				?>
				<?php
				$user_description = get_user_meta($i->current_author->ID);
				$user_description = esc_html( $user_description['description'][0] );
				//echo $user_description;
				?>
				<li>
					<a href="<?php echo get_author_posts_url( $i->current_author->ID ); ?>" class="image">
						<?php echo get_avatar( $i->current_author->ID ); ?>
					</a>
					<!-- .image -->
					<div class="author-info">
						<p><a href="<?php echo get_author_posts_url( $i->current_author->ID ); ?>">By <?php echo esc_html( $i->current_author->display_name ); ?></a></p>
						<?php
						$twitter = get_user_meta( $i->current_author->ID, 'twitter', true );
						if ( ! empty( $twitter ) ):
							?>
							<p class="author-twitter"><a target="_blank" href="<?php echo esc_url( 'https://twitter.com/intent/follow?screen_name=' . $twitter ); ?>"><i class="fa fa-twitter"></i>
									@<?php echo esc_html( $twitter ); ?></a></p>
						<?php endif; ?>
					</div>
					<!-- .author-info -->
				</li>
				<?php
			} while ( $i->iterate() );
			?>
		</ul>
	</div><!-- .meta-block.authored-by -->
<?php endif; ?>

<div class="meta-block post-date desktop">
	<?php global $previousday; $previousday=null; ?>
	<?php echo the_date('F j, Y', '<p>Published: ', '</p>', FALSE); ?>
</div><!-- .meta-block.post-date -->

<?php

$parent_link = '';

if ( function_exists( 'Reviews' ) ) {

	$container = Reviews()->container();
	$parent    = $container['Relationships']->get_review_for_product( get_the_ID() );

	if ( ! empty( $parent ) ) {
		$parent      = array_shift( $parent );
		$parent_link = get_permalink( $parent->ID );
	}
}

if ( ! empty( $scored_image ) ): ?>
	<div class="meta-block how-scored mobile">
		<h4>How this scored</h4>
		<img class="product-scores" src="<?php echo esc_attr( $scored_image['url'] ); ?>" alt="Scores"/>
	</div><!-- .meta-block.how-scored -->
<?php endif; ?>

<?php
if ( ! empty( $why_buy_content ) ): ?>
	<div class="meta-block why-buy mobile">
		<h4>Why To Buy</h4>
	
		<?php echo $why_buy_content; ?>
	</div><!-- .meta-block.why-buy -->
<?php
endif;
?>

<?php if ( ! empty( $pro_tips_content ) ): ?>
	<div class="meta-block pro-tips mobile">
		<?php
		if ( ! empty( $pro_tips_title ) ) {
			echo '<h4>'.$pro_tips_title.'</h4>';
		}
		?>
	
		<?php echo $pro_tips_content; ?>
	</div><!-- .meta-block.pro-tips -->
<?php endif; ?>


<div class="meta-block ad-1">
	<?php global $make; print $make->ads->ad_300x250_atf; ?>
</div><!-- .meta-block.ad-1 -->


<?php
if ( ! empty( $why_buy_content ) ): ?>
	<div class="meta-block why-buy desktop">
		<h4>Why To Buy</h4>
	
		<?php echo $why_buy_content;
	
		if ( ! empty( $link ) ): ?>
	
			<a class="btn-buy" target="_blank" href="<?php echo esc_url( $link ); ?>">Buy It Now</a>
	
		<?php endif; ?>
	</div><!-- .meta-block.why-buy -->
<?php
endif;
?>




<?php if ( ! empty( $pro_tips_content ) ): ?>
	<div class="meta-block pro-tips desktop">
		<?php
		if ( ! empty( $pro_tips_title ) ) {
			echo '<h4>'.$pro_tips_title.'</h4>';
		}
		?>
	
		<?php echo $pro_tips_content; ?>
	</div><!-- .meta-block.pro-tips -->
<?php endif; ?>

<div class="meta-block ad-2 desktop">
	<?php global $make; print $make->ads->ad_300x600; ?>
</div><!-- .meta-block.ad-2 -->

<?php

$parent_link = '';

if ( function_exists( 'Reviews' ) ) {

	$container = Reviews()->container();
	$parent    = $container['Relationships']->get_review_for_product( get_the_ID() );

	if ( ! empty( $parent ) ) {
		$parent      = array_shift( $parent );
		$parent_link = \Reviews\Architecture\Post_Types\Reviews::get_scores_link( $parent->ID );
	}
}

if ( ! empty( $scored_image ) ): ?>
	<div class="meta-block how-scored desktop">
		<h4>How this scored</h4>
		<img class="product-scores" src="<?php echo esc_attr( $scored_image['url'] ); ?>" alt="Scores"/>
		<p><a href="<?php echo esc_url( $parent_link ); ?>">See all the Scores</a></p>
	</div><!-- .meta-block.how-scored -->
<?php endif;