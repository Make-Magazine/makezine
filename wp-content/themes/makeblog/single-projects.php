<?php
/**
 * Single page template for projects custom post type.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Maker Media Web Team <webmaster@makermedia.com>
 *
 */
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

				<div class="span12">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<div <?php post_class(); ?>>

							<div class="projects-masthead">

								<h3><a href="//makezine.com/projects/">Make: Projects</a></h3>

								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

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

								<div class="span8">

									<?php
							 			$image = get_post_custom_values('Image');
										if ( !empty( $image[0] ) ) {
											echo '<img src="' . wpcom_vip_get_resized_remote_image_url( make_projects_to_s3( $image[0] ), 620, 465 ) . '" alt="' . esc_attr( the_title('', '', false ) ) . '" />';
										}
									?>

									<?php the_content(); ?>

								</div>

								<div class="span4 sidebar">

									<div class="projects-ad">

										<?php global $make; print $make->ads->ad_300x250_atf; ?>

									</div>

									<div class="sidebar-ad">

										<!-- Beginning Sync AdSlot 3 for Ad unit sidebar ### size: [[300,250]]  -->
										<?php global $make; print $make->ads->ad_300x250; ?>

			<?php get_footer(); ?>
