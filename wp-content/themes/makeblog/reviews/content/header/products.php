<?php // Reviews Section Header
get_template_part( 'reviews/content/header/ads-leaderboard' ); ?>

<div class="container">
	<?php get_template_part( 'reviews/content/header/reviews' ); ?>
</div>

<?php 

$image = get_field('hero_image');

if ( ! empty( $image ) ) {
?>
<div id="hero-products" style="background-image: url(<?php echo esc_attr( $image['url'] );?>);">
	<img class="hero-single-products" src="<?php echo esc_attr( $image['url'] );?>" alt=""/>
<?php
} else {
?>
<div id="hero-products">
<?php
}
?>

	<div id="tour-overlay">
		<div class="inner">
			<div class="cell">
				<div class="container">
					<div class="row">
						<div class="meta-wrapper col-sm-4">
							<div class="product-meta">
								<h2 class="product-title"><?php the_title();?></h2>
									
									<div class="authors-mobile">
									
									<?php if ( class_exists( 'CoAuthorsIterator' ) ): ?>
										<?php
										$my_date_mobile = the_date('M j, Y', '', '', FALSE);
										$i = new CoAuthorsIterator();
										$count = $i->count;
										
										if( $count === 1 ){
										?>
											
											<p>By 
												<?php
												$i->iterate();
												do {
													?>
														<!-- .image -->
															<a href="<?php echo get_author_posts_url( $i->current_author->ID ); ?>"><?php echo esc_html( $i->current_author->display_name ); ?></a>
															<?php
															$twitter = get_user_meta( $i->current_author->ID, 'twitter', true );
															if ( ! empty( $twitter ) ):
																?>
																/ <a target="_blank" href="<?php echo esc_url( 'https://twitter.com/intent/follow?screen_name=' . $twitter ); ?>"><i class="fa fa-twitter"></i> @<?php echo esc_html( $twitter ); ?></a>
															<?php endif; ?>
													<?php
												} while ( $i->iterate() );
												?>
											/ <?php echo $my_date_mobile; ?>
											</p>
										<?php
										}else{
										?>
											<p>By 
												<?php
												$i->iterate();
												do {
													?>
														<!-- .image -->
															<a href="<?php echo get_author_posts_url( $i->current_author->ID ); ?>"><?php echo esc_html( $i->current_author->display_name ); ?></a>
															<?php
															$twitter = get_user_meta( $i->current_author->ID, 'twitter', true );
															if ( ! empty( $twitter ) ):
																?>
																/ <a target="_blank" href="<?php echo esc_url( 'https://twitter.com/' . $twitter ); ?>"><i class="fa fa-twitter"></i> @<?php echo esc_html( $twitter ); ?></a>
															<?php endif; ?>
															<br/>
													<?php
												} while ( $i->iterate() );
												?>
											<?php echo $my_date_mobile; ?>
											</p>
										<?php
										}
										?>
									<?php endif; ?>
								
								</div><!-- .authors-mobile" -->
								<?php $link = get_field( 'buy_link' ); ?>
								<a class="btn-buy" target="_blank" href="<?php echo esc_url( $link ); ?>">Buy It Now</a>
							</div><!-- .product-meta -->

							<?php
							/**
							 * Setup the 3D View
							 */
							$asset_path = get_field( '3d_view_config' );

							if ( $asset_path && shortcode_exists( 'wr360embed' ) ):
								global $post;
								$wr_shortcode = sprintf(
									'[%1$s name="%2$s" width="300" height="400" config="%3$s"]',
									'wr360embed',
									$post->post_name,
									esc_url( $asset_path )
								);
							?>
								<div class="virtual-tour">
									<?php
									$bodytag = str_replace(".xml", "", $asset_path);
									$bodytag = substr($bodytag, 0, strrpos( $bodytag, '/'));
									$bodytag = $bodytag.'/images/';
									$bodytag = ltrim($bodytag, '/');
									
									$directory = $bodytag;
									$files = scandir ($directory);
									$firstFile = $directory . $files[2];
									$firstFile = '/'.$firstFile;
									?>

									<?php echo do_shortcode( $wr_shortcode ); ?>
									
									<div id="virtual-placeholder">
										<div class="inner">
											<img src="<?php echo $firstFile;?>" alt="<?php the_title();?>"/>
											<i class="fa fa-search-plus"></i>
											<div class="rotate-instructions">
												<i class="fa fa-refresh"></i> see it in 360
											</div><!-- .rotate-instructions -->
										</div><!-- .inner -->
									</div><!-- #virtual-placeholder -->
								</div><!-- .virtual-tour -->
							<?php endif; ?>

						</div><!-- .meta-wrapper -->
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .cell -->
		</div><!-- .inner -->
	</div><!-- #tour-overlay -->

</div><!-- #hero-products -->