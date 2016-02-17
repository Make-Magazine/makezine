<?php
/**
 * Single Page Template
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 *
 */
get_header( 'version-2' );
global $post; ?>
<?php $main_post_id = get_the_ID(); ?>
<?php $current_user = wp_get_current_user();
if ( user_can( $current_user, 'administrator' ) ) {
	$login_admin = 'admin_is_login';
}
?>
<div class="mz-story-infinite-view <?php echo $login_admin ?>">

	<div class="container wrapper">
		<div class="ad-unit first-ad">
			<?php global $make;
			print $make->ads->ad_leaderboard;
			?>
		</div>
		<div class="row navigator">
			<div class="hamburger">
				<div class="hamburger-navigator">
					<img class="initial" src="<?php echo get_template_directory_uri() . '/version-2/img/bitmap.png' ?>"
						 scale="0">
					<img class="x" src="<?php echo get_template_directory_uri() . '/version-2/img/x.png' ?>" scale="0">
					<img class="x-hover" src="<?php echo get_template_directory_uri() . '/version-2/img/x-hover.png' ?>"
						 scale="0">

					<h2>Latest 10</h2>
				</div>
			</div>
			<div class="thumbnails">
				<div class=" posts-navigator">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<div class="latest-story first" id="0">

							<a href="#<?php echo get_the_ID(); ?>" class="pull-left highlighted"
							   id="<?php echo str_replace( home_url(), '', get_permalink() ); ?>">
								<?php
								$args = array(
									'resize' => '370,240',
								);
								$url = wp_get_attachment_image(get_post_thumbnail_id(), 'project-thumb');
								$re = "/^(.*? src=\")(.*?)(\".*)$/m";
								preg_match_all($re, $url, $matches);
								$str = $matches[2][0];
								$photon = jetpack_photon_url($str, $args);
								if(strlen($url) == 0){
									$photon = catch_first_image_story_nav();
									$photon = jetpack_photon_url( $photon, $args );
								} ?>
								<div class="thumbnail-image"
									 style="background: url(<?php echo $photon; ?>) no-repeat center center;"></div>
								<h3><?php the_title(); ?></h3></a>

						</div>
					<?php endwhile; ?>
					<?php else: ?>
					<?php endif; ?>
					<?php wp_reset_query(); ?>
					<?php $i   = 1;
					$the_query = new WP_Query( array( 'showposts'    => '9',
						'post_status'  => 'publish',
						'post__not_in' => array( $main_post_id )
					) ); ?>
					<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<div class="latest-story" id="<?php echo $i; ?>">

							<a href="#<?php echo get_the_ID(); ?>" class="pull-left"
							   id="<?php echo str_replace( home_url(), '', get_permalink() ); ?>">
								<?php
								$args = array(
									'resize' => '370,240',
								);
								$url = wp_get_attachment_image(get_post_thumbnail_id(), 'project-thumb');
								$re = "/^(.*? src=\")(.*?)(\".*)$/m";
								preg_match_all($re, $url, $matches);
								$str = $matches[2][0];
								$photon = jetpack_photon_url($str, $args);
								if(strlen($url) == 0){
									$photon = catch_first_image_story_nav();
									$photon = jetpack_photon_url( $photon, $args );
								} ?>
								<div class="thumbnail-image"
									 style="background: url(<?php echo $photon; ?>) no-repeat center center;"></div>
								<h3><?php the_title(); ?></h3></a>

						</div>
						<?php $i ++; ?>
					<?php endwhile; ?>

					<?php else: ?>
						<?php echo '<h1>No content found</h1>' ?>
					<?php endif; ?>
					<?php wp_reset_query(); ?>
					<a href="<?php echo site_url( '/blog', 'http' ); ?>" class="see-all-stories"><h3 class="heading">See all stories</h3><div class="arrow-right"></div></a>
				</div>
			</div>
		</div>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="row story-header first-story" id="<?php echo get_the_ID(); ?>">

				<div class="story-title">
					<h1><?php the_titlesmall( '', '', true, '90' ); ?></h1>
				</div>
				<div class="author-info">
					<?php
					if ( function_exists( 'coauthors_posts_links' ) ) {
						get_author_profile();
					} else {
						the_author_posts_link();
					} ?>
					<?php
					$post_time  = get_post_time( 'U', true, $post, true );
					$time_now   = date( 'U' );
					$difference = $time_now - $post_time;
					if ( $difference > 86400 ) { ?>
						<time itemprop="startDate"
							  datetime="<?php the_time( 'c' ); ?>"><?php the_time( 'F j\, Y, g:i a T' ); ?></time>
					<?php } else { ?>
						<time itemprop="startDate"
							  datetime="<?php the_time( 'c' ); ?>"><?php echo human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . ' ago'; ?></time>
					<?php }
					?>
				</div>
        <?php
        //Hero Image
        $hero_id = get_field('hero_image');
        // Featured Image
        $args = array('resize' => '1200,670',);
        $url = wp_get_attachment_image(get_post_thumbnail_id(), 'story-thumb');
        $re = "/^(.*? src=\")(.*?)(\".*)$/m";
        preg_match_all($re, $url, $matches);
        $str = $matches[2][0];
        $photon = jetpack_photon_url($str, $args);

        if(get_field('hero_image')) { ?>
            <img class="story-hero-image" src="<?php echo $hero_id['url']; ?>" alt="Article Featured Image">
            <div class="story-hero-image-l-xl"
                 style="background: url(<?php echo $hero_id['url']; ?>) no-repeat center center;"></div>
        <?php }
        elseif(strlen($url) == 0){ ?>
            <div class="hero-wrapper-clear"></div>
        <?php } else { ?>
            <img class="story-hero-image" src="<?php echo $photon ?>" alt="Article Featured Image">
            <div class="story-hero-image-l-xl"
                 style="background: url(<?php echo $photon ?>) no-repeat center center;"></div>
        <?php } ?>

			</div>
			<div class="content-wrapper">
				<div class="row content first-story">
					<div class="col-sm-7 col-md-8">
						<article <?php post_class(); ?>>
							<?php
							$url   = str_replace( home_url(), 'http://makezine.com', get_permalink() );
							$title = get_the_title();
							echo do_shortcode( '[easy-social-share buttons="facebook,twitter,google,reddit,pinterest,more" morebutton="2" morebutton_icon="dots" counters=1 counter_pos="bottom" total_counter_pos="hidden" style="button" nospace="yes" fullwidth="yes" template="metro-retina" url="' . $url . '" text="' . $title . '"]' );
							echo do_shortcode( '[easy-social-share buttons="facebook,twitter,google,reddit,pinterest,more" morebutton="2" morebutton_icon="dots" counters=0 total_counter_pos="hidden" style="button" nospace="yes" template="dark-retina" sidebar="yes" sidebar_pos="right" url="' . $url . '" text="' . $title . '"]' );
							?>
							<?php the_content(); ?>
						</article>

						<div class="comments">

							<button type="button" class="btn btn-info btn-lg"
									data-toggle="modal" data-target="#disqus-modal"
									onclick="reset('<?php echo get_the_ID(); ?>',
										'<?php echo 'http://makezine.com' . str_replace( home_url(), '', get_permalink() ); ?>',
										'<?php echo get_the_title(); ?>', 'en');">
								Show comments
							</button>

							<!-- Modal -->
							<div id="disqus-modal" class="modal fade" role="dialog">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
						</div>
					</div>
					<aside class="col-sm-7 col-md-4 sidebar">
						<div class="author-info">
							<?php
							get_author_profile();
							?>
						</div>
						<div class="date-time">
							<?php
							$post_time  = get_post_time( 'U', true, $post, true );
							$time_now   = date( 'U' );
							$difference = $time_now - $post_time;
							if ( $difference > 86400 ) { ?>
								<time itemprop="startDate"
									  datetime="<?php the_time( 'c' ); ?>"><?php the_time( 'F j\, Y, g:i a T' ); ?></time>
							<?php } else { ?>
								<time itemprop="startDate"
									  datetime="<?php the_time( 'c' ); ?>"><?php echo human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . ' ago'; ?></time>
							<?php }
							?>
						</div>
						<?php
						$posttags = get_the_tags();
						if ( $posttags ) { ?>
							<h3 class="related-topics">Related Topics</h3>
							<ul class="post-tags">
								<?php foreach ( $posttags as $tag ) { ?>
									<li>
										<a href="<?php echo get_tag_link( $tag ); ?>"><?php echo '# ' . $tag->name . ' ' ?></a>
									</li>
								<?php } ?>
							</ul>
						<?php }
						?>
						<div class="ad-unit">
							<p id="ads-title">Advertisement</p>
							<?php global $make;
							print $make->ads->ad_300x250; ?>
						</div>
						<div class="ad-unit">
							<p id="ads-title">Advertisement</p>
							<?php global $make;
							print $make->ads->ad_300x600; ?>
						</div>
						<div class="ctx-siderail-container"></div>
						<div class="pubexchange_module" id="pubexchange_rail" data-pubexchange-module-id="1525"></div>

					</aside>
					<div class="ctx-social-container"></div>
					<div class="essb_right_flag"></div>
				</div>
			</div>
		<?php endwhile; ?>
		<?php else: ?>

			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>

		<?php endif; ?>
		<div class="line-separator"></div>
		<div class="row more">
			<h3><?php _e( 'Explore More From Make:', 'makezine' ); ?></h3>
			<i class="fa fa-spinner fa-pulse more-button-spinner"></i>
		</div>
		<div class="row infinity"><i class="fa fa-spinner fa-pulse fa-5x"></i></div>
	</div>

</div>
<div class="ad-unit">
	<?php
	global $make;
	print $make->ads->ad_leaderboard_alt;
	?>
</div>

<script type="text/javascript">
	/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
	var disqus_shortname = 'makezine';
	var disqus_identifier;
	var disqus_url;
	var disqus_config = function () {
		this.language = "en";
	};
	/* * * DON'T EDIT BELOW THIS LINE * * */
	(function () {
		var dsq = document.createElement('script');
		dsq.type = 'text/javascript';
		dsq.async = true;
		dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
		(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
	})();
	/* * * Disqus Reset Function * * */
	var reset = function (newIdentifier, newUrl, newTitle, newLanguage) {
		$('#disqus_thread').remove();
		$('#disqus-modal').append('<div id="disqus_thread"></div>');
		DISQUS.reset({
			reload: true,
			config: function () {
				this.page.identifier = newIdentifier;
				this.page.url = newUrl;
				this.page.title = newTitle;
				this.language = newLanguage;
			}
		});
	};
</script>

<?php get_footer(); ?>
