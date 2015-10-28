<?php
/**
 * Single Page Template
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 *
 */
get_header('version-2'); ?>
<?php $main_post_id = get_the_ID();?>
	<div class="single">

		<div class="container">
			<div style="visibility: hidden" class="row navigator">
				<div class="row hamburger">
					<div class="hamburger-navigator col-lg-2 col-sm-2 col-xs-2">
						<img src="<?php echo get_template_directory_uri().'/version-2/img/hamburger.png' ?>" scale="0">
						<h2>Reading list</h2>
					</div>
				</div>
				<div class="row thumbnails">
					<div class=" posts-navigator col-lg-2 col-sm-2 col-xs-2">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<div class="latest-story first">

							<a href="#<?php echo get_the_ID(); ?>" class="pull-left highlighted">
								<?php
								$args = array(
									'resize' => '370,240',
								);
								$url = wp_get_attachment_image(get_post_thumbnail_id(), 'project-thumb');
								$re = "/^(.*? src=\")(.*?)(\".*)$/m";
								preg_match_all($re, $url, $matches);
								$str = $matches[2][0];
								$photon = jetpack_photon_url($str, $args);?>
								<img src="<?php echo $photon; ?>" alt="thumbnail">
							<h3><?php the_title(); ?></h3></a>

						</div>
					<?php endwhile; ?>
					<?php else: ?>
					<?php endif; ?>
					<?php wp_reset_query(); ?>

					<?php query_posts(array('showposts' => '9', 'post__not_in' => array($main_post_id)));?>
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<div class="latest-story">

							<a href="#<?php echo get_the_ID(); ?>" class="pull-left">
								<?php
								$args = array(
									'resize' => '370,240',
								);
								$url = wp_get_attachment_image(get_post_thumbnail_id(), 'project-thumb');
								$re = "/^(.*? src=\")(.*?)(\".*)$/m";
								preg_match_all($re, $url, $matches);
								$str = $matches[2][0];
								$photon = jetpack_photon_url($str, $args);?>
								<img src="<?php echo $photon; ?>" alt="thumbnail">
							<h3><?php the_title(); ?></h3></a>

						</div>
					<?php endwhile; ?>

					<?php else: ?>
						<?php echo '<h1>No content found</h1>' ?>
					<?php endif; ?>
					<?php wp_reset_query(); ?>
					</div>
				</div>
			</div>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="row story-header" id="<?php echo get_the_ID(); ?>">

				<div class="span12">

					<div class="projects-masthead">

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
						<li>
							<time itemprop="startDate" datetime="<?php the_time( 'c' ); ?>"><?php the_time( 'F jS\, Y g:i a' ); ?></time>
						</li>
						<?php edit_post_link( 'Edit', '<li>', '</li>' ); ?>
					</ul>

				</div>
			</div>
			<div class="row">
				<div class="span8">

					<article <?php post_class(); ?>>

						<?php the_content(); ?>

					</article>



					<div class="comments">
						<?php comments_template(); ?>
					</div>
					
					<div id="contextly"></div>



				</div>
				<?php get_sidebar(); ?>
			</div>

			<?php endwhile; ?>
			<?php else: ?>

				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

			<?php endif; ?>
			<?php query_posts(array('showposts' => '9', 'post__not_in' => array($main_post_id)));?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<div class="row story-header" id="<?php echo get_the_ID(); ?>">
					<div class="span12">

						<div class="projects-masthead">

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
							<li>
								<time itemprop="startDate" datetime="<?php the_time( 'c' ); ?>"><?php the_time( 'F jS\, Y g:i a' ); ?></time>
							</li>
							<?php edit_post_link( 'Edit', '<li>', '</li>' ); ?>
						</ul>

					</div>

				</div>

				<div class="row">
					<div class="span8">

						<article <?php post_class(); ?>>

							<?php the_content(); ?>

						</article>



						<div class="comments">
							<?php comments_template(); ?>
						</div>

						<div id="contextly"></div>



					</div>
					<?php get_sidebar(); ?>
				</div>

			<?php endwhile; ?>
			<?php else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
		</div>

	</div>

<?php get_footer(); ?>
