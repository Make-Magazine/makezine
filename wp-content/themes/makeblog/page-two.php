<?php
/*
 * Template name: Page 2
 */

get_header('version-2'); ?>

<?php
global $query_string;
query_posts($query_string . "post_type=page_2&post_status=publish&posts_per_page=10");
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>	
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>				

					<div class="entry-content">
						<?php the_content(); ?>
						
					</div><!-- .entry-content -->


				</div><!-- #post-## -->

				<?php comments_template( '', true ); ?>

<?php endwhile;
endif; ?>
<div class="navigation">
	<div class="alignleft"><?php next_posts_link('Previous entries') ?></div>
	<div class="alignright"><?php previous_posts_link('Next entries') ?></div>
</div>
<?php wp_reset_query(); ?>


<?php get_footer(); ?>