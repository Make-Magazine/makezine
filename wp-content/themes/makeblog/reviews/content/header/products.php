<?php // Reviews Section Header
get_template_part( 'reviews/content/header/ads-leaderboard' );

$image = get_field('hero_image');
$awards = get_field('winners');
$container = Reviews()->container();
$parent = $container['Relationships']->get_review_for_product( get_the_ID() );
$parent_name = $parent[0]->post_name;
$parent_title = $parent[0]->post_title;
$parent_url = get_permalink( $parent[0]->ID );
?>

<div class="breadcrumbs">
	<a href="<?php echo($parent_url); ?>">
		<?php echo ($parent_title); ?>
	</a>
	> 
	<?php echo( get_the_title() ); ?>
</div>

<?php
if ( ! empty( $image ) ) {
?>
<div id="hero-products" style="background-image: url(<?php echo esc_attr( $image['url'] );?>);">
	<img class="hero-single-products" src="<?php echo esc_attr( $image['url'] );?>" alt="Product review hero image"/>
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
															if ( ! empty( $twitter ) ): ?>
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
							</div><!-- .product-meta -->

							<?php if( $awards && ( ! in_array('', $awards) ) ): ?>
								<div class="sidebar-awards meta-block visible-xs-block">
									<div class="sidebar-awards-left <?php
										if ( $parent_name === 'boards' ) {
											echo 'sd-boards-badge';
										} else if ( $parent_name === '3dprinters' ) {
											echo 'sd-3dprinters-badge';
										} else if ( $parent_name === 'drones' ) {
											echo 'sd-drones-badge';
										}  ?>">
									</div>
									<div class="sidebar-awards-right">
										<h6>AWARDS</h6>
										<?php foreach( $awards as $award ): ?>
											<span><?php echo $award; ?></span>
										<?php endforeach; ?>
									</div>
									<div class="clearfix"></div>
								</div>
							<?php endif; ?>

							<?php
							/**
							 * Setup the 3D View
							 */
							if ( $parent_name === '3dprinters' ) {
								//Added get_site_url() to account for any environment.
								$view_config_path = get_field( '3d_view_config' );
								$asset_path = get_site_url() . $view_config_path;
								if ( (! empty($view_config_path)) && shortcode_exists( 'wr360embed' ) ):
									global $post;
									//Determine the path to the product:
									$rootpath = str_replace(".xml", "", $asset_path);
									$rootpath = substr($rootpath, 0, strrpos( $rootpath, '/'));
									$rootpath = ltrim($rootpath, '/');

									$wr_shortcode = sprintf(
										'[%1$s name="%2$s" width="300" height="400" config="%3$s"]',
										'wr360embed',
										$post->post_name,
										esc_url($asset_path),
										$rootpath
									); ?>

									<div class="virtual-tour">
										<?php
										if (! empty($view_config_path) ) {
											$config_xml = simplexml_load_file($asset_path);
											//Load first image from XML
                      if(!is_null($config_xml->images->image[0]->attributes())){
                        $image1 = $config_xml->images->image[0]->attributes();
                      }
										}
										$firstFile = $rootpath . '/' . $image1;

										echo do_shortcode( $wr_shortcode ); ?>

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

								<?php endif;

							} ?>

						</div><!-- .meta-wrapper -->
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .cell -->
		</div><!-- .inner -->
	</div><!-- #tour-overlay -->

</div><!-- #hero-products -->