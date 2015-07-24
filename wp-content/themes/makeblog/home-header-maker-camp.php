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

								<?php if ( make_get_cap_option( 'camp_ribbon_title_display' ) ) :
									$ribbon_class = 'attachment-p1'; ?>
									<div class="ribbon"><?php echo esc_html( make_get_cap_option( 'camp_ribbon_title' ) ); ?></div>
								<?php else : $ribbon_class = ''; endif; ?>

								<a href="<?php echo esc_html( make_get_cap_option( 'camp_main_link' ) ); ?>">

									<?php
										$mainurl = (make_get_cap_option( 'camp_main_url' ));
										if ( make_get_cap_option( 'camp_main_id' ) ) {
											echo wp_get_attachment_image( absint( make_get_cap_option( 'camp_main_id' ) ), 'p1', 0, array( 'class' => $ribbon_class ) );
										} else {
											echo '<img src="'.get_resized_remote_image_url($mainurl,301,400).'" height="400" width="301" alt=""';
											if ( make_get_cap_option( 'camp_ribbon_title_display' ) )
												echo 'id="top-left" ';
											echo '/>';

										}
									?>

								</a>

								<div class="caption">

									<h3><a href="<?php echo esc_html( make_get_cap_option( 'camp_main_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'camp_main_title' ) ); ?></a></h3>
									<p><a href="<?php echo esc_html( make_get_cap_option( 'camp_main_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'camp_main_subtitle' ) ); ?></a></p>

								</div>

							</div>

						</div>

						<div class="span4 middle-featured">

							<div class="row">

								<div class="span4">

									<div class="paddme small">

										<a href="<?php echo esc_url( make_get_cap_option( 'camp_top_link' ) ); ?>">

											<?php
												$topurl = make_get_cap_option( 'camp_top_url' );
												if ( make_get_cap_option( 'camp_top_url_id' ) ) {
													echo wp_get_attachment_image( absint( make_get_cap_option( 'camp_top_url_id' ) ), 'p2' );
												} else {
													echo '<img src="'.get_resized_remote_image_url($topurl,290,180).'" height="180" width="290" alt="" />';
												}
											?>

										</a>

										<div class="caption">

											<h3><a href="<?php echo esc_url( make_get_cap_option( 'camp_top_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'camp_top_title' ) ); ?></a></h3>
											<p><a href="<?php echo esc_url( make_get_cap_option( 'camp_top_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'camp_top_subtitle' ) ); ?></a></p>

										</div>

									</div>

								</div>

								<div class="span4">

									<div class="paddme small">

										<a href="<?php echo esc_url( make_get_cap_option( 'bottom_link' ) ); ?>">

											<?php
												$bottomurl = make_get_cap_option( 'camp_bottom_url' );
												if ( make_get_cap_option( 'camp_bottom_url_id' ) ) {
													echo wp_get_attachment_image( absint( make_get_cap_option( 'camp_bottom_url_id' ) ), 'p2' );
												} else {
													echo '<img src="'.get_resized_remote_image_url($bottomurl,290,180).'" height="180" width="290" alt="" />';
												}
											?>

										</a>

										<div class="caption">

											<h3><a href="<?php echo esc_url( make_get_cap_option( 'camp_bottom_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'camp_bottom_title' ) ); ?></a></h3>
											<p><a href="<?php echo esc_url( make_get_cap_option( 'camp_bottom_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'camp_bottom_subtitle' ) ); ?></a></p>

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

		<div class="row">
			
			<div class="span12 maker-camp">
					
					<div class="paddme-maker-camp">

						<div class="hr"></div>	

							<div class="row">

							<div class="span">
								
								<div class="paddme-maker-camp-left">

									<img src="<?php echo get_template_directory_uri(); ?>/images/maker-camp/makercamp_logo.jpg" alt="Maker-Camp Logo" />
								
								</div>

							</div>

							<div class="span5">
								
								<div class="paddme-maker-camp-left">

									<?php
										echo '<p class="maker-camp-small-text">';
										if ( make_get_cap_option( 'camp_live_from' ) ) {
											echo make_get_cap_option( 'camp_live_from' );
										}
										echo '</p>';
									?>

									<?php
										echo '<h3>';
										if ( make_get_cap_option( 'camp_day_x' ) ) {
											echo '<a href="' . make_get_cap_option( 'camp_video_url' ) . '">' . make_get_cap_option( 'camp_day_x' ) . '</a>';
										}
										echo '</h3>';
									?>

									<?php
										$camp_first_line = make_get_cap_option( 'camp_paragraph' );
										echo '<p>';
										if ( make_get_cap_option( 'camp_paragraph' ) ) {
											echo make_get_cap_option( 'camp_paragraph' );
										}
										echo '</p>';
									?>

								</div>	

							</div>

							<div class="span4 pull-right">

								<div class="paddme-maker-camp-right pull-right">
								
									<?php
										$camp_video_img = make_get_cap_option( 'camp_video_right' );
										echo '<a href="' . make_get_cap_option( 'camp_video_url' ) . '">' . '<img src="'.get_resized_remote_image_url($camp_video_img,300,170).'" />' . '</a>';
									?>

								</div>

							</div>

						</div>
				
						<div class="hr"></div>

					</div>

			</div>
			
		</div>

		<div class="row">
		
			<div class="home-waist-banner">
		
				<div id="div-gpt-ad-664089004995786621-6" class="banner-canvas">
					
					 <script type='text/javascript'>
					  googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-6')});
					 </script>
		
				</div>
		
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