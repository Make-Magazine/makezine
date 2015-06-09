<?php
/**
 * Single Page Template
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 *
 */
get_header(); ?>

	<div class="single">

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
						
						<div class="tag-cloud">
							
							<p>Related Topics</p>
							<?php 
								echo '<ul class="tag-cloud-ul">'; // Begin list
								// Get ID of current page
								$postid = get_the_ID();
								// Select term_taxonomy_id from relationships table
								$term_tax = $wpdb->get_col("SELECT term_taxonomy_id
								FROM $wpdb->term_relationships WHERE object_id = '$postid'" );
								// Gather terms to relate
								foreach($term_tax as $term_tax_id) {
								// Get term ids
								$term_id2 = $wpdb->get_col("SELECT term_id
								FROM $wpdb->term_taxonomy WHERE term_taxonomy_id = '$term_tax_id' and taxonomy = 'post_tag'" );
									// Gets rid of empty variables
									if (empty($term_id2)) {
										continue;
									}
									else {
										$term_id3 = [$term_id2[0]];
									}
								// Get tag names
								foreach($term_id3 as $cats) 
								$the_cats = $wpdb->get_col("SELECT name
								FROM $wpdb->terms WHERE term_id = '$cats'" );
								// Get tag URLs
								$tag_url = get_tag_link($term_id3[0]);
								// Generate list of tags with links								
								echo '<li><a href="' . $tag_url . '">#' . $the_cats[0] . '</a></li>';
								}
								echo '</ul>'; // End list
							?>

						</div>

					</article>

					<?php endwhile; ?>

					<div class="comments">
						<?php comments_template(); ?>
					</div>
					
					<div id="contextly"></div>

					<?php else: ?>

						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

					<?php endif; ?>
				</div>


				<?php get_sidebar(); ?>


			</div>

		</div>

	</div>

<?php get_footer(); ?>
