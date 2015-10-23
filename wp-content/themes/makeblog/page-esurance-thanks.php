<?php
/**
 * Template Name: Esurance Thanks
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * 
 */
get_header('version-2'); ?>
		
	<div class="single">
	
		<div class="container">

			<div class="row">
				
				<div class="span8">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					
					<img src="http://makezineblog.files.wordpress.com/2013/06/620x250-landing-page.jpg" alt="Road to Maker Faire Challenge">
					
				</div>
				
				<div class="span4">
					
					<div class="sidebar-ad">
						
						<?php global $make; print $make->ads->ad_300x250_atf; ?>

					</div>
					
				</div>
				
			</div>

				<div class="row">
			
				<div class="span12">

					<h1><?php the_title(); ?></h1>
				
					<article <?php post_class(); ?>>

						<?php the_content(); ?>
					
					</article>
					
					<?php endwhile; ?>
					
					<?php else: ?>
					
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					
					<?php endif; ?>
				</div> <!-- END span12 -->				
					
			</div> <!-- END row -->	

		</div>

	</div>
	
<script>

	jQuery('a[data-toggle="tab"]').on('shown', function (e) {
		googletag.pubads().refresh();
		ga('send', 'pageview');
	});

</script>

<?php get_footer(); ?>
