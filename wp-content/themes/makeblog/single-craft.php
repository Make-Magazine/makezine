<?php
/**
 * Craft Custom Post Type Single Page Template
 * This will be depracated when we move the craft posts into the posts cpt. Coming soon...
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 *
 */
get_header(); ?>

	<div class="single craft">

		<div class="container">

			<div class="row">

				<div class="span12">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

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
						<li>
							Category <?php the_category(', '); ?>
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

					<?php endwhile; ?>

					<div id="contextly"></div>						

					<div class="comments">
						<?php comments_template(); ?>
					</div>				

					<?php endif; ?>
				</div>


				<?php get_sidebar(); ?>


			</div>

		</div>

	</div>

<?php get_footer(); ?>
