<?php
global $post;
$postID = $post->ID;
$why_buy_content    = get_field( 'why_to_buy' );
$why_buy_title      = get_field( 'why_to_buy_title' );
$why_buy_title      = ! empty( $why_buy_title ) ? $why_buy_title : 'Why To Buy';
$link               = get_field( 'buy_link' );
$pro_tips_title     = get_field( 'pro_tips_title' );
$pro_tips_content   = get_field( 'pro_tips' );
$scored_image       = get_field( 'scores_image' );
$scored_image_title = get_field( 'scores_image_title' );
$scored_image_title = ! empty( $scored_image_title ) ? $scored_image_title : 'How this scored';
$awards 						= get_field('winners');
$container 			= Reviews()->container();
$parent    			= $container['Relationships']->get_review_for_product( $postID);
$parent_title 	= $parent[0]->post_name;
$parent_id = $parent[0]->ID;
$modal_image    = get_field( 'magazine_thumbnail', $parent_id );
$modal_text     = get_field( 'magazine_label', $parent_id );

if ( ! empty( $scored_image ) && \Reviews\Architecture\Post_Types\Reviews::is_scoring_enabled( $parent->ID ) ): ?>
	<div class="meta-block how-scored">
		<h4><?php echo $scored_image_title; ?></h4>
		<img class="product-scores" src="<?php echo esc_attr( $scored_image['url'] ); ?>" alt="Product Review Scores"/>
		<p><a href="<?php echo esc_url( $parent_link ); ?>">See Scoring Criteria</a></p>
	</div><!-- .meta-block.how-scored -->
<?php endif;

if( $awards && ( ! in_array('', $awards) ) ): ?>
	<div class="sidebar-awards meta-block">
		<div class="sidebar-awards-left <?php echo 'sd-' . $parent_title . '-badge'; ?>">
		</div>
		<div class="sidebar-awards-right">
			<h6>AWARDS</h6>
			<?php foreach( $awards as $award ): ?>
				<span itemprop="award"><?php echo $award; ?></span>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>

<?php if ( class_exists( 'CoAuthorsIterator' ) ): ?>
	<div class="meta-block authored-by desktop">
		<ul>
			<?php

			$authors = get_coauthors( $postID );
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
								By <span itemprop="author"><?php echo esc_html( $author->display_name ); ?></span>
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
	<?php echo the_date('F j, Y', '<p itemprop="datePublished">Published: ', '</p>', FALSE); ?>
</div><!-- .meta-block.post-date -->
<?php if(!isset($_COOKIE['cookielawinfo-checkbox-non-necessary']) || $_COOKIE['cookielawinfo-checkbox-non-necessary'] == "yes" ) { ?>
	<div class="meta-block ad-1">
		<?php global $make; print '<p id="ads-title">ADVERTISEMENT</p>' . $make->ads->ad_300x250_atf; ?>
	</div><!-- .meta-block.ad-1 -->
<?php } ?>

<?php
if ( $why_buy_content || $link ): ?>
	<div class="meta-block why-buy">
		<?php if ($why_buy_content) { ?>
			<h4><?php echo $why_buy_title;?></h4>
			<?php echo $why_buy_content;
		}
		if ( $link ): ?>
			<a itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="btn-buy btn" target="_blank" href="<?php echo esc_url( $link ); ?>">Buy Now</a>
		<?php endif; ?>
	</div><!-- .meta-block.why-buy -->
<?php
endif;
?>

<?php if ( ! empty( $pro_tips_content ) ): ?>
	<div class="meta-block pro-tips">
		<?php
		if ( ! empty( $pro_tips_title ) ) {
			echo '<h4>'.$pro_tips_title.'</h4>';
		}
		echo $pro_tips_content; ?>
	</div><!-- .meta-block.pro-tips -->
<?php endif; ?>

<?php if ( $modal_image ): ?>
	<div class="review-nav-mag">
		<button id="modal-capture-btn" class="modal-capture-btn class-<?php echo $parent_title; ?>">
			<img alt="Review guide featured image" src="<?php echo esc_attr( $modal_image['sizes'][ 'p1' ] ); ?>" />
			<?php echo $modal_text; ?>
		</button>
	</div>
<?php endif; ?>

<?php
   if ( $parent_title === '3dprinters' ) {
		$parent_title = '3dprinter'; // once again, this needs a stupid exceptions
	}
	if ( is_active_sidebar( 'sidebar_comparison_' . $parent_title) ) { ?>
		<div class="clearfix"></div>
		<div class="sidebar-wrapper">
			<?php dynamic_sidebar('sidebar_comparison_' . $parent_title); ?>
		</div>
	<?php }
?>

<?php if(!isset($_COOKIE['cookielawinfo-checkbox-non-necessary']) || $_COOKIE['cookielawinfo-checkbox-non-necessary'] == "yes" ) { ?>
	<div class="meta-block ad-2 desktop">
		<?php global $make; print '<p id="ads-title">ADVERTISEMENT</p>' . $make->ads->ad_300x600; ?>
	</div><!-- .meta-block.ad-2 -->
<?php } ?>

<?php
$parent_link = '';
if ( function_exists( 'Reviews' ) ) {
	$container = Reviews()->container();
	$parent    = $container['Relationships']->get_review_for_product( $postID );
	if ( ! empty( $parent ) ) {
		$parent      = array_shift( $parent );
		$parent_link = \Reviews\Architecture\Post_Types\Reviews::get_scores_link( $parent->ID );
	}
}
