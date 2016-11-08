<?php

/**
 * The template for displaying the author profiles
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 *
 */
get_header('version-2'); ?>

	<div class="category-top author-page" itemprop="author" itemscope itemtype="http://schema.org/Person">

		<div class="container">

			<div class="row">

				<?php make_author_profile(); ?>

			</div>

		</div>

	</div>

	<div class="grey child author-page">

		<div class="container">

			<div class="row">

				<div class="col-sm-12 col-md-8">

					<h2>Latest from <?php echo make_author_name(); ?></h2>
					<hr/>

				</div>

			</div>

			<div class="row top15">

				<div class="col-sm-12 col-md-8" id="content">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<article <?php post_class('media'); ?>>

							<a href="<?php the_permalink(); ?>" class="pull-left">
								<?php echo the_post_thumbnail('archive-thumb'); ?>
							</a>

							<div class="media-body">

								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								
								<div class="meta"><?php the_time('m/d/Y'); ?></div>

								<div class="media-body">
									<p><?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?> <a href="<?php the_permalink(); ?>"></a></p>
								</div>

							</div>
						
						</article>

					<?php endwhile; else: ?>

						<p><?php echo 'No posts found.' ?></p>

					<?php endif; ?>

						<div class="clear"></div>

				</div>

				<?php get_sidebar(); ?>

			</div>

		</div>

	<?php get_footer();	?>
