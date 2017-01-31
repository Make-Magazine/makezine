<?php
/**
 * Reviews Sidebar Content
 */

$how_scoring_works       = get_field( 'how_scoring_works' );
$how_scoring_works_title = get_field( 'how_scoring_works_title' );
$how_scoring_works_title = ! empty( $how_scoring_works_title ) ? $how_scoring_works_title : 'How Scoring Works';
?>

<aside class="reviews-sidebar tc-sidebar mz-sidebar">

	<div class="meta-block ad-1">
		<?php global $make; print '<p id="ads-title">ADVERTISEMENT</p>' . $make->ads->ad_300x250_atf; ?>
	</div><!-- .meta-block.ad-1 -->

	<?php
	if( have_rows('youtube_videos') ): 
		$yt_title = get_field('yt_sidebar_title');
		$link_text = get_field('link_text');
		$link = get_field('link'); ?>

	    <div class="yt-video-sidebar">
	    	<div class="yt-sidebar-title">
	    		<i class="fa fa-play-circle-o" aria-hidden="true"></i><?php echo $yt_title; ?>
	    	</div>
	    	<div class="yt-sidebar-body">

	  <?php
	  while ( have_rows('youtube_videos') ) : the_row();

	    $yt_id = get_sub_field('video_id');
	    $description = get_sub_field('description2');
	    ?>

				<a class="fancytube fancybox.iframe" href="http://www.youtube.com/embed/<?php echo $yt_id; ?>?autoplay=1">
					<div class="yt-sb-video">
						<img class="img-responsive" src="http://img.youtube.com/vi/<?php echo $yt_id; ?>/mqdefault.jpg" alt="Product Review Videos" />
						<img class="yt-play-btn" src="<?php echo get_stylesheet_directory_uri(); ?>/img/play-btn.png" alt="Youtube overlay play button" />
					</div>
					<p><?php echo $description; ?></p>
				</a>

	  <?php endwhile; ?>

	    	</div>
	    	<div class="yt-sidebar-footer">
	    		<a href="<?php echo $link; ?>"><?php echo $link_text; ?></a>
	    	</div>
	    </div>

	<?php endif;

	$slug = \Reviews\Architecture\Post_Types\Reviews::get_product_category_slug( $id );
	if ( $slug === 'boards' ) {
		if ( is_active_sidebar( 'sidebar_comparison_boards' ) ) { ?>
			<div class="clearfix"></div>
			<div class="sidebar-wrapper">
				<?php dynamic_sidebar('sidebar_comparison_boards'); ?>
			</div>
		<?php } 
	} else if ( $slug === 'printers' ) {
		if ( is_active_sidebar( 'sidebar_comparison_3dprinter' ) ) { ?>
			<div class="clearfix"></div>
			<div class="sidebar-wrapper">
				<?php dynamic_sidebar('sidebar_comparison_3dprinter'); ?>
			</div>
		<?php } 
	} else if ( $slug === 'drones' ) {
		if ( is_active_sidebar( 'sidebar_comparison_drones' ) ) { ?>
			<div class="clearfix"></div>
			<div class="sidebar-wrapper">
				<?php dynamic_sidebar('sidebar_comparison_drones'); ?>
			</div>
		<?php } 
	}?>

	<?php if ( ! empty( $how_scoring_works ) ): ?>
	<div class="meta-block how-scoring-works">
		<h4><?php echo $how_scoring_works_title; ?></h4>
		<div class="hsw-content">
			<?php echo $how_scoring_works; ?>
		</div>
	</div>
	<?php endif; ?>

	<div class="meta-block ad-2 desktop">
		<?php global $make; print '<p id="ads-title">ADVERTISEMENT</p>' . $make->ads->ad_300x600; ?>
	</div><!-- .meta-block.ad-2 -->

</aside><!-- .reviews-sidebar -->
