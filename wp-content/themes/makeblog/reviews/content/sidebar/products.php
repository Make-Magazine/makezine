<?php
$why_buy_content    = get_field( 'why_to_buy' );
$why_buy_title      = get_field( 'why_to_buy_title' );
$why_buy_title      = ! empty( $why_buy_title ) ? $why_buy_title : 'Why To Buy';
$link               = get_field( 'buy_link' );
$pro_tips_title     = get_field( 'pro_tips_title' );
$pro_tips_content   = get_field( 'pro_tips' );
$scored_image       = get_field( 'scores_image' );
$scored_image_title = get_field( 'scores_image_title' );
$scored_image_title = ! empty( $scored_image_title ) ? $scored_image_title : 'How this scored';

?>

<?php if ( class_exists( 'CoAuthorsIterator' ) ): ?>
	<div class="meta-block authored-by desktop">
		<ul>
			<?php

			$authors = get_coauthors( get_the_ID() );
			$author_data = new Make_Authors();
			foreach ( $authors as $author ) {
					?>
				<li>
					<a href="<?php echo get_author_posts_url( $author->ID, $author->user_nicename ); ?>" class="image">
						<?php echo $author_data->author_avatar( $author ); ?>
					</a>

					<div class="author-info">
						<p>
							<a href="<?php echo get_author_posts_url( $author->ID, $author->user_nicename ); ?>">
								By <?php echo esc_html( $author->display_name ); ?>
							</a>

						</p>
						<?php
						$twitter = get_user_meta( $author->ID, 'twitter', true );
						if ( ! empty( $twitter ) ):
							?>
							<p class="author-twitter"><a target="_blank" href="<?php echo esc_url( 'https://twitter.com/intent/follow?screen_name=' . $twitter ); ?>"><i class="fa fa-twitter"></i>
									@<?php echo esc_html( $twitter ); ?></a></p>
						<?php endif; ?>
					</div>
					<!-- .author-info -->
				</li>
				<?php
			}
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


$container = Reviews()->container();
$parent    = $container['Relationships']->get_review_for_product( get_the_ID() );

if ( ! empty( $parent ) ) {
	$parent      = array_shift( $parent );
	$parent_link = get_permalink( $parent->ID );
}

if ( ! empty( $scored_image ) && \Reviews\Architecture\Post_Types\Reviews::is_scoring_enabled( $parent->ID ) ): ?>
	<div class="meta-block how-scored mobile">
		<h4><?php echo $scored_image_title; ?></h4>
		<img class="product-scores" src="<?php echo esc_attr( $scored_image['url'] ); ?>" alt="Scores"/>
	</div><!-- .meta-block.how-scored -->
<?php endif; ?>

<?php
if ( ! empty( $why_buy_content ) ): ?>
	<div class="meta-block why-buy mobile">
		<h4><?php echo $why_buy_title;?></h4>
	
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
	<?php global $make; print '<p id="ads-title">ADVERTISEMENT</p>' . $make->ads->ad_300x250_atf; ?>
</div><!-- .meta-block.ad-1 -->


<?php
if ( ! empty( $why_buy_content ) ): ?>
	<div class="meta-block why-buy desktop">
		<h4><?php echo $why_buy_title;?></h4>
	
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

<?php
	$container = Reviews()->container();
	$parent    = $container['Relationships']->get_review_for_product( get_the_ID() );
	$parent_title = $parent[0]->post_name;
	echo $parent_title;
if ( $parent_title === 'boards' ) {
	if ( is_active_sidebar( 'sidebar_comparison_boards' ) ) { ?>
		<div class="clearfix"></div>
		<div class="sidebar-wrapper">
			<?php dynamic_sidebar('sidebar_comparison_boards'); ?>
		</div>
		<div class="clearfix"><br /><br /></div>
	<?php } 
} else if ( $parent_title === '3dprinters' ) {
	if ( is_active_sidebar( 'sidebar_comparison_3dprinter' ) ) { ?>
		<div class="clearfix"></div>
		<div class="sidebar-wrapper">
			<?php dynamic_sidebar('sidebar_comparison_3dprinter'); ?>
		</div>
		<div class="clearfix"><br /><br /></div>
	<?php } 
} ?>

<div class="meta-block ad-2 desktop">
	<?php global $make; print '<p id="ads-title">ADVERTISEMENT</p>' . $make->ads->ad_300x600; ?>
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

if ( ! empty( $scored_image ) && \Reviews\Architecture\Post_Types\Reviews::is_scoring_enabled( $parent->ID ) ): ?>
	<div class="meta-block how-scored desktop">
		<h4><?php echo $scored_image_title; ?></h4>
		<img class="product-scores" src="<?php echo esc_attr( $scored_image['url'] ); ?>" alt="Scores"/>
		<p><a href="<?php echo esc_url( $parent_link ); ?>">See all the Scores</a></p>
	</div><!-- .meta-block.how-scored -->
<?php endif;