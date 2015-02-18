<?php
/**
 * @package MakeZine
 * Template Name: MF Featured Posts
 */
?>

<?php
	$args = array(
		'post_type' => array( 'post', 'craft', 'magazine', 'video', 'projects' ),
		'post_status' => 'publish',
		'posts_per_page' => 7,
		'ignore_sticky_posts' => 1,
		'tag' => 'mf-featured'
	);
	
	$query = new WP_Query( $args );

	if ( $query->have_posts() ) : ?>
		<div id="mf-featured-slider" class="carousel slide">
			<div class="carousel-inner">
				<?php $i = 1; while ( $query->have_posts() ) : $query->the_post(); 
					$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); ?>
					<div class="item<?php echo ( $i % 7 == 1 ) ? ' active' : ''; ?>">
						<a href="<?php echo get_permalink($post->ID); ?>"><img src="<?php echo wpcom_vip_get_resized_remote_image_url( $image[0], 366, 342 ); ?>"></a>
						<div class="carousel-caption">
							<h3 class="cap-title">Maker Faire News</h3>
							<h4 class="cap-body"><a href="<?php echo get_permalink($post->ID); ?>"><?php the_title(); ?></a></h4>
						</div>
					</div>
				<?php $i++; endwhile; ?>
			</div>
			<?php if ( $query->found_posts >= 2 ) : ?>
				<a class="left carousel-control" href="#mf-featured-slider" data-slide="prev"><span class="icon-prev"><</span></a>
				<a class="right carousel-control" href="#mf-featured-slider" data-slide="next"><span class="icon-next">></span></a>
			<?php endif; ?>
		</div>
	<?php endif;
?>