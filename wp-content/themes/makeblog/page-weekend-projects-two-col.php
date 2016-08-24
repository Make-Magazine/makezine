<?php
/**
 * Archive page template for projects custom post type.
 * Template name: Weekend Projects 2-col
 * 
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Cole Geissinger <cgeissinger@makermedia.com>
 * 
 */
get_header('version-2'); ?>

<!-- 	<div class="projects-home">

		<div class="container">

			<div class="row">

				<div class="col-xs-12">

					<img src="<?php /*echo get_stylesheet_directory_uri(); */?>/img/projects-banner.png" alt="Weekend Projects" style="margin-top:-20px;margin-bottom:-20px;">

				</div>

			</div>

		</div>

	</div> -->

	<div class="grey">

		<div class="container">

			<div class="row">

				<div class="col-sm-7 col-md-8">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; endif; ?>

				</div>

				<?php get_sidebar(); ?>

			</div>

		</div>

	</div>

<?php get_footer(); ?>
