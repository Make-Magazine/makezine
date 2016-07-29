<?php
/**
 * Single page template for projects custom post type.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Maker Media Web Team <webmaster@makermedia.com>
 *
 */
wp_enqueue_script( 'make-projects', get_stylesheet_directory_uri() . '/version-2/js/projects.js', array( 'jquery' ), false, true );
$steps = get_post_custom_values('Steps');
get_header('version-2'); ?>

	<div class="category-top">

		<div class="container">

			<div class="row" style="position:relative;">

				<?php /* if( has_term( 'Weekend Project', 'flags' ) ) : ?>

					<div style="position:absolute; right:0; top:-15px;">

						<a href="http://pubads.g.doubleclick.net/gampad/clk?id=42844138&amp;iu=/11548178/Makezine"><img src="<?php echo get_template_directory_uri(); ?>/images/weekend-projects-btn.png" title="Weekend Projects Powered by Radio Shack" /></a>
					</div>

				<?php endif; */?>

				<div class="col-xs-12">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<div <?php post_class(); ?>>

							<div class="projects-masthead">

								<h3><a href="//makezine.com/projects/">Make: Projects</a></h3>

								<h1><?php the_title(); ?></h1>

								<?php
									$desc = get_post_custom_values('Description');
									if (isset($desc[0])) {
										echo Markdown( wp_kses_post( $desc[0] ) );
									}
								?>

							</div>

							<ul class="projects-meta">
								<li>
									By <?php
									if( function_exists( 'coauthors_posts_links' ) ) {
										coauthors_posts_links();
									} else {
										the_author_posts_link();
									} ?>
								</li>
								<li>
									Category: <?php the_category(', '); ?>
								</li>

								<?php
									$time = get_post_custom_values('TimeRequired');
									if ($time[0]) {
										echo '<li>Time Required: <span>' . esc_html( $time[0] ) . '</span></li>';
									}
									$terms = get_the_terms( $post->ID, 'difficulty' );
									if ($terms) {
										foreach ($terms as $term) {
											echo '<li>Difficulty: <span>' . esc_html( $term->name ) . '</span></li>';
										}
									}
								?>

								<?php edit_post_link( 'Edit', '<li>', '</li>' ); ?>
							</ul>

							<div class="row">

								<div class="col-xs-12 col-sm-8">

									<?php
							 			$image = get_post_custom_values('Image');
										if ( !empty( $image[0] ) ) {
											echo '<img src="' . wpcom_vip_get_resized_remote_image_url( make_projects_to_s3( $image[0] ), 620, 465 ) . '" alt="' . esc_attr( the_title('', '', false ) ) . '" />';
										}
									?>

									<?php the_content(); ?>


								</div>

								<div class="col-xs-12 col-sm-4 sidebar">

									<div class="projects-ad">
										<p id="ads-title">Advertisement</p>
										<?php global $make; print $make->ads->ad_300x250_atf; ?>
									</div>

									<div class="sidebar-ad">
										<p id="ads-title">Advertisement</p>
										<?php global $make; print $make->ads->ad_300x250_house; ?>
									</div>

									<div class="maker-camp-promo">
										<?php
											if( is_single( array( '414218', '403102' ))) {
												echo '<a href="http://www.makershed.com/products/rocket-glider-kit?utm_source=makezine.com&utm_medium=ads&utm_campaign=maker-camp&utm_keyword=Rocket_Glider" target="_blank"><img src="https://makezineblog.files.wordpress.com/2014/07/7july_rocketglider.jpg" alt="Rocket Glider Kit from Maker shed" /></a>';
											}
											 if( is_single( array( '414377', '267502' ))) {
												echo '<a href="http://www.makershed.com/products/brushbots?utm_source=makezine.com&utm_medium=ads&utm_campaign=maker-camp&utm_keyword=brushbots" target="_blank"><img src="https://makezineblog.files.wordpress.com/2014/07/brushbots_300x305.jpg" alt="BrushBots from Maker Shed" /></a>';
											}
											if( is_single( array( '267724', '53649' ))) {
												echo '<a href="http://www.makershed.com/products/littlebits-nasa-kit?utm_source=makezine.com&utm_medium=ads&utm_campaign=maker-camp&utm_keyword=LittleBitsFan" target="_blank"><img src="https://makezineblog.files.wordpress.com/2014/07/littlebitsfan_300x305.jpg" alt="littleBits NASA Kit from Maker Shed" /></a>';
											}
											if( is_single( array( '377366', '270116' ))) {
												echo '<a href="http://www.makershed.com/products/el-wire-starter-packs-10ft?utm_source=makezine.com&utm_medium=ads&utm_campaign=maker-camp&utm_keyword=El_Wire_Starter_Packs_10ft" target="_blank"><img src="https://makezineblog.files.wordpress.com/2014/07/elwire.gif" alt="EL-Wire Starter Pack from Maker Shed" /></a>';
											}
										 ?>
									</div>

									<?php
										$old_parts = get_the_terms( $post->ID, 'parts' );
										$parts = get_post_meta( $post->ID , 'parts' );
										$old_tools = get_the_terms( $post->ID, 'tools' );
										$tools = get_post_meta( $post->ID, 'Tools' );

										if ( ! empty( $old_parts ) || ! empty( $parts ) || ! empty( $old_tools ) || ! empty( $tools ) ) {
									?>

									<div class="parts-tools">

										<ul class="top">
											<?php
												if ( $parts || $old_parts ) {
													echo '<li class="active"><a href="#1" data-toggle="tab">Parts</a></li>';
												}
												if ( ( $parts || $old_parts ) && ( $tools || $old_tools ) ) {
													echo '<li class="divider"> / </li>';
												}
												if ( $tools || $old_tools && ( ! empty( $old_parts ) || ! empty( $parts ) ) ) {
													echo '<li><a href="#2" data-toggle="tab">Tools</a></li>';
												} else {
													echo '<li class="active"><a href="#2" data-toggle="tab">Tools</a></li>';
												}
											?>

										</ul>
										<div class="tab-content">
											<?php
												if ( $parts ) {
													echo '<div class="tab-pane active" id="1">';
													echo make_projects_parts( $parts );
													echo '</div>';
												}

												// If our parts are empty, we want to default to tools
												if ( empty( $parts ) ) {
													echo '<div class="tab-pane active" id="2">';
												} else {
													echo '<div class="tab-pane" id="2">';
												}
												if ( $tools ) {
													echo make_projects_tools( $tools );
												}
												?>
											</div>

										</div>

									</div>

									<?php } ?>

									<a class="project-print-btn btn btn-xs btn-danger pull-left print-page"><i class="icon-print icon icon-white"></i> Print Project</a>

									<div class="projects-ad">
										<p id="ads-title">Advertisement</p>
										<?php global $make; print $make->ads->ad_300x600; ?>
									</div>

								</div>

							</div>

						</div>

							<?php
								$stepscount = unserialize( $steps[0] );
								if ( !empty( $stepscount ) ) {
							?>

							<div class="row">

								<div class="col-xs-12">

									<div class="row">

										<div class="col-xs-12">

											<h2 class="new-heading">Steps</h2>

										</div>

									</div>

									<div class="bottom-steps" id="target">

										<div class="row">

											<div class="col-xs-12 col-sm-4">

												<?php make_projects_steps_list( $steps ); ?>

												<div class="projects-understeps-ad">
													<p id="ads-title">Advertisement</p>
													<?php global $make; print $make->ads->ad_300x250_house; ?>
												</div>

											</div>

											<div class="col-xs-12 col-sm-8">

												<div class="tab-content" id="steppers">

													<?php make_projects_steps( $steps ); ?>

												</div>

											</div>

										</div>


										<?php
											$conclusion = get_post_custom_values('Conclusion');
											if ( !empty( $conclusion[0] ) ) {
										?>

										<div class="row">

											<div class="col-xs-12 col-sm-8">

												<?php
													echo '<div class="conclusion">';
													echo '<h2 class="new-heading">Conclusion</h2>';
													echo wp_kses_post( $conclusion[0] ) ;
													echo '</div>';
												?>

											</div>

											<div class="col-xs-12 col-sm-4">
											</div>

										</div>

										<?php } ?>

									</div>

								</div>

							</div>

					<?php } ?>

					<?php endwhile; ?>

							<div class="row">

								<div class="col-xs-12 col-sm-8">

									<?php echo make_author(); ?>

									<div class="ad-unit">
										<p id="ads-title">Advertisement</p>
										<?php global $make; print $make->ads->ad_728x90; ?>
									</div>

									<div id="contextly">

										<?php echo do_shortcode('[contextly_main_module]'); ?>

									</div>

									<?php else: ?>

										<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

									<?php endif; ?>

									<div class="comments">
										
										<?php comments_template(); ?>
									
									</div>

								</div>

								<?php if ( empty( $stepscount ) ) { ?>

									<div class="col-xs-12 col-sm-4" style="margin-top:20px;">
									</div>

								</div>

								<?php } else {
									get_sidebar('projects');
								} ?>

							</div>

						</div>

					</div>

			<?php get_footer(); ?>
