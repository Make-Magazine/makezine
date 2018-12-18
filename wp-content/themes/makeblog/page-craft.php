<?php
/*
Template Name: Craft Home Page
*/
?>

<?php get_header('craft'); ?>

		<div class="waist">

			<div class="container">

				<div class="row">

					<div class="span8">

						<div class="checkers">

							<div class="row">

								<div class="span4">

									<div class="paddme">

										<div class="ribbon"><?php echo esc_html( make_get_cap_option( 'craft_ribbon_title' ) ); ?></div>

										<a href="<?php echo esc_html( make_get_cap_option( 'craft_main_link' ) ); ?>">

											<img src="<?php echo esc_url( make_get_cap_option( 'craft_main_url' ) ); ?>" id="top-left" />

										</a>

										<div class="caption">

											<h3><a href="<?php echo esc_html( make_get_cap_option( 'craft_main_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'craft_main_title' ) ); ?></a></h3>
											<p><a href="<?php echo esc_html( make_get_cap_option( 'craft_main_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'craft_main_subtitle' ) ); ?></a></p>

										</div>

									</div>

								</div>

								<div class="span4">

									<div class="row">

										<div class="span4">

											<div class="paddme small">

												<a href="<?php echo esc_url( make_get_cap_option( 'craft_top_link' ) ); ?>">

													<img class="home-biggest" src="<?php echo esc_url( make_get_cap_option( 'craft_top_url' ) ); ?>" />

												</a>

												<div class="caption">

													<h3><a href="<?php echo esc_url( make_get_cap_option( 'craft_top_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'craft_top_title' ) ); ?></a></h3>
													<p><a href="<?php echo esc_url( make_get_cap_option( 'craft_top_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'craft_top_subtitle' ) ); ?></a></p>

												</div>

											</div>

										</div>

										<div class="span4">

											<div class="paddme small">

												<a href="<?php echo esc_url( make_get_cap_option( 'craft_bottom_link' ) ); ?>">

													<img class="home-biggest" src="<?php echo esc_url( make_get_cap_option( 'craft_bottom_url' ) ); ?>" />

												</a>

												<div class="caption">

													<h3><a href="<?php echo esc_url( make_get_cap_option( 'craft_bottom_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'craft_bottom_title' ) ); ?></a></h3>
													<p><a href="<?php echo esc_url( make_get_cap_option( 'craft_bottom_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'craft_bottom_subtitle' ) ); ?></a></p>

												</div>


											</div>

										</div>

									</div>

								</div>
								
								<div class="row-fluid">

									<div class="span12">

										<div class="featured">

											<?php echo make_featured_post(); ?>

										</div>

									</div>

								</div>

							</div>

						</div>

					</div>

						<div class="span4">

							<div class="home-ads">

								<!-- Beginning Sync AdSlot 2 for Ad unit header ### size: [[300,250]]  -->
								<div id='div-gpt-ad-664089004995786621-2'>
									<script type='text/javascript'>
										googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-2')});
									</script>
								</div>
								<!-- End AdSlot 2 -->

							</div>

							<div class="home-ads bottom">

								<!-- Beginning Sync AdSlot 2 for Ad unit header ### size: [[300,250]]  -->
								<div id='div-gpt-ad-664089004995786621-3'>
									<script type='text/javascript'>
										googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-3')});
									</script>
								</div>
								<!-- End AdSlot 2 -->

							</div>

						</div>

				</div>

			</div>

		</div>

		<div class="sand new-sand">

			<div class="container">

				<div class="row">

					<div class="span4 posts">

						<h3><a href="http://makezine.com/craft/">Blog Feed</a></h3>

						<?php
							$args = array(
								'posts_per_page'  => 6,
								'no_found_rows' => true,
								'post_type' => 'craft'
							);

							$the_query = new WP_Query( $args );
						?>

						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

						<article <?php post_class(); ?>>

							<div class="entry-content">

								<a href="<?php the_permalink(); ?>">
									<?php get_the_image( array( 'image_scan' => true, 'size' => 'left-rail-home-thumb' ) ); ?>
								</a>

								<h4>
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
										<span class="blurb">
											<?php echo wp_trim_words(strip_shortcodes(get_the_content()), 8, '...') ; ?>
										</span>
									</a>
								</h4>

							</div>

						</article>

						<?php endwhile; wp_reset_postdata(); ?>

						<p><a href="http://makezine.com/craft/"><span class="pull-right light aqua seeall right">Read More News</span></a></p>

					</div>
					<!--<div class="shadow"></div>-->

					<div class="span8">

						<h3 class="red"><?php echo esc_html( make_get_cap_option( 'youtube_feature_heading' ) ); ?></h3>

						<div class="new-grid">

							<?php
							$cap_youtube = make_get_cap_option( 'craft_youtube' );
							if ( $cap_youtube ) {
								echo '<div class="small-youtube">';
								echo do_shortcode('[youtube='. wp_kses_post( $cap_youtube ) .'&w=590&h=332]');
								echo '</div>';
							}; ?>

						</div>

						<div class="clear"></div>

						<div class="row">

							<div class="span4">

								<h3><a class="red" href="http://makezine.com/tag/craft-projects/">Craft Projects</a></h3>

								<div class="grid-box boxy">

									<?php

										$args = array(
											'tag_id'			=> 1469,
											'posts_per_page'	=> 1,
											'no_found_rows'		=> true,
											'post_type'			=> 'craft'
										);

										echo make_post_card( $args );

									?>

								</div>

							</div>


							<div class="span4">

								<div class="new-dotw">
									<div id="div-gpt-ad-664089004995786621-9" class="text-center">
										 <script type='text/javascript'>
										  googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-9')});
										 </script>
									</div>
								</div>

							</div>

						</div>

						<div class="row">

							<div class="span4">

								<h3 class="red"><a href="http://makezine.com/category/craft/knitting/" class="red">Fiber Crafts</a></h3>

								<div class="grid-box boxy">

									<?php

										$args = array(
											'category__in'		=> array( 4, 11 ),
											'posts_per_page'	=> 1,
											'no_found_rows'		=> true,
											'post_type'			=> 'craft'
										);

										echo make_post_card( $args );

									?>

								</div>

							</div>


							<div class="span4">

								<h3 class="red"><a href="http://makezine.com/category/home/food-beverage/" class="red">Food &amp; Beverage</a></h3>

								<div class="grid-box boxy">

									<?php

										$args = array(
											'cat'				=> 32,
											'posts_per_page'	=> 1,
											'no_found_rows'		=> true,
											'post_type'			=> 'craft'
										);

										echo make_post_card( $args );

									?>

								</div>

							</div>

						</div>

						<div class="row">

							<div class="span4">

								<h3 class="red"><a href="http://makezine.com/category/craft-2/101/" class="red">Craft 101</a></h3>

								<div class="grid-box boxy">

									<?php echo make_craft_101(); ?>

								</div>

							</div>


							<div class="span4">

								<h3 class="red"><a href="http://makezine.com/category/woodworking/?post_type=craft" class="red">Woodworking</a></h3>

								<div class="grid-box boxy">

									<?php

										$args = array(
											'cat'				=> 40,
											'posts_per_page'	=> 1,
											'no_found_rows'		=> true,
											'post_type'			=> 'craft'
										);

										echo make_post_card( $args );

									?>

								</div>

							</div>

						</div>


					</div>

				</div>

			</div>

		<div class="clear"></div>

		<?php get_footer(); ?>
