<?php
/**
 * Archive page template for projects custom post type.
 * Template name: Weekend Projects Wide
 * 
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Cole Geissinger <cgeissinger@makermedia.com>
 * 
 */
get_header(); ?>

	<div class="projects-home">

		<div class="container">

			<div class="row">

				<div class="span12">

					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/projects-banner.png" alt="Weekend Projects" style="margin-top:-20px;margin-bottom:-20px;">

				</div>

			</div>

		</div>

	</div>

	<div class="grey">

		<div class="container">

			<div class="row">

				<div class="span12">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; endif; ?>

				</div>

			</div>

		</div>

	</div>

<?php get_footer(); ?>
