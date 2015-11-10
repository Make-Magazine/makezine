					<div class="span4 sidebar">

						<div class="sidebar-ad">

							<?php global $make; print $make->ads->ad_300x250_atf; ?>

						</div>

						<div class="plus_forum widget">
							<a href="https://plus.google.com/communities/105413589856236995389">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/Make_Forum_join_banner_mini.jpg" alt="Join the MAKE Forum">
							</a>
						</div>

						<div class="new-dotw">

							<?php

								$the_query = new WP_Query( 'post_type=from-the-maker-shed&posts_per_page=1' );

								while ( $the_query->have_posts() ) : $the_query->the_post();
									$ftms_link = get_post_custom_values( 'ftms_link' );
									if( !isset($ftms_link[0]) ){
										$ftms_link[0] = 'http://www.makershed.com/';
									}
									echo '<a href="'. esc_url( $ftms_link[0] ).'">';
									the_post_thumbnail('ftms-thumb');
									echo '</a>';
								endwhile;

								// Reset Post Data
								wp_reset_postdata();

							?>

						</div>

						<div class="sidebar-ad">

							<?php global $make; print $make->ads->ad_300x250_house; ?>

						</div>

				</div>
