<div class="waist">

	<div class="container">

		<div class="row">

			<?php if ( get_theme_mod( 'make_home_banner' ) === 'on' ) : ?>

				<div class="span12 home-banner">
			
					<a href="<?php echo esc_url( get_theme_mod( 'make_home_banner_link', 'http://www.makershed.com/SearchResults.asp?Cat=227&Click=174124' ) ); ?>">
						<img src="<?php echo esc_url( get_theme_mod( 'make_home_takeover_image', get_stylesheet_directory_uri() . '/img/cnc.jpg' ) ); ?>">
					</a>
			
				</div>

			<?php endif; ?>

			<div class="span8">

				<div class="checkers">

					<div class="row">
						
						<div class="span4">

							<div class="paddme">

								<?php if ( make_get_cap_option( 'ribbon_title_display' ) ) :
									$ribbon_class = 'attachment-p1'; ?>
									<div class="ribbon"><?php echo esc_html( make_get_cap_option( 'ribbon_title' ) ); ?></div>
								<?php else : $ribbon_class = ''; endif; ?>

								<a href="<?php echo esc_html( make_get_cap_option( 'main_link' ) ); ?>">

									<?php
										$mainurl = (make_get_cap_option( 'main_url' ));
										if ( make_get_cap_option( 'main_id' ) ) {
											echo wp_get_attachment_image( absint( make_get_cap_option( 'main_id' ) ), 'p1', 0, array( 'class' => $ribbon_class ) );
										} else {
											echo '<img src="'.get_resized_remote_image_url($mainurl,301,400).'" height="400" width="301" alt=""';
											if ( make_get_cap_option( 'ribbon_title_display' ) )
												echo 'id="top-left" ';
											echo '/>';

										}
									?>

								</a>

								<div class="caption">

									<h3><a href="<?php echo esc_html( make_get_cap_option( 'main_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'main_title' ) ); ?></a></h3>
									<p><a href="<?php echo esc_html( make_get_cap_option( 'main_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'main_subtitle' ) ); ?></a></p>

								</div>

							</div>

						</div>

						<div class="span4 middle-featured">

							<div class="row">

								<div class="span4">

									<div class="paddme small">

										<a href="<?php echo esc_url( make_get_cap_option( 'top_link' ) ); ?>">

											<?php
												$topurl = make_get_cap_option( 'top_url' );
												if ( make_get_cap_option( 'top_url_id' ) ) {
													echo wp_get_attachment_image( absint( make_get_cap_option( 'top_url_id' ) ), 'p2' );
												} else {
													echo '<img src="'.get_resized_remote_image_url($topurl,290,180).'" height="180" width="290" alt="" />';
												}
											?>

										</a>

										<div class="caption">

											<h3><a href="<?php echo esc_url( make_get_cap_option( 'top_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'top_title' ) ); ?></a></h3>
											<p><a href="<?php echo esc_url( make_get_cap_option( 'top_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'top_subtitle' ) ); ?></a></p>

										</div>

									</div>

								</div>

								<div class="span4">

									<div class="paddme small">

										<a href="<?php echo esc_url( make_get_cap_option( 'bottom_link' ) ); ?>">

											<?php
												$bottomurl = make_get_cap_option( 'bottom_url' );
												if ( make_get_cap_option( 'bottom_url_id' ) ) {
													echo wp_get_attachment_image( absint( make_get_cap_option( 'bottom_url_id' ) ), 'p2' );
												} else {
													echo '<img src="'.get_resized_remote_image_url($bottomurl,290,180).'" height="180" width="290" alt="" />';
												}
											?>

										</a>

										<div class="caption">

											<h3><a href="<?php echo esc_url( make_get_cap_option( 'bottom_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'bottom_title' ) ); ?></a></h3>
											<p><a href="<?php echo esc_url( make_get_cap_option( 'bottom_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'bottom_subtitle' ) ); ?></a></p>

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

					<?php global $make; print $make->ads->ad_300x250_atf; ?>

				</div>

				<div class="home-ads bottom">

					<?php global $make; print $make->ads->ad_300x250_house; ?>

				</div>

			</div>
		
		</div>

		<div class="row">
		
			<div class="home-waist-banner">
		
				<?php global $make; print $make->ads->ad_940x39; ?>
		
			</div>
		
		</div>
		
		<div class="row">

			<?php if ( get_theme_mod( 'make_waist_banner' ) === 'on' ) : ?>

				<div class="container home-waist-banner" style="margin-bottom:10px;">
		
					<div class="span12">
		
					<a href="<?php echo esc_url( get_theme_mod( 'make_waist_banner_link', 'http://makezine.com/2014/03/24/enter-to-win-the-maker-faire-rome-arduino-challenge/' ) ); ?>">
						<img src="<?php echo esc_url( get_theme_mod( 'make_waist_banner_image', get_stylesheet_directory_uri() . '/img/arduio_month.jpg' ) ); ?>">
					</a>
		
				</div>
		
				</div>

			<?php endif; ?>
	    
	    </div>
		
	</div>

</div>
