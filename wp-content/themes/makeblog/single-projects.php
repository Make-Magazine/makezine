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
wp_enqueue_script( 'make-projects', get_stylesheet_directory_uri() . '/version-2/js/projects.js', array( 'jquery', 'lazyload' ), false, true );
get_header('version-2');
$time = get_post_custom_values('TimeRequired');
$post_duration = get_post_meta($post->ID, 'project_duration');
$post_difficulty = get_post_meta($post->ID, 'project_difficulty');
$post_price_group = get_post_meta($post->ID, 'price_group');
$post_price_custom = get_post_meta($post->ID, 'custom_price_value'); ?>
	
<div class="home-ads">
 	<?php global $make; print $make->ads->ad_leaderboard_alt; ?>
</div>

<div class="container">

	<div class="row" style="position:relative;">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<div <?php post_class('col-xs-12'); ?> itemscope itemtype="http://schema.org/TechArticle">

			<div class="projects-masthead">

				<h3>
					<a href="//makezine.com/projects/" itemprop="publisher">Make: Projects</a>
				</h3>

				<h1 itemprop="name">
					<?php the_title(); ?>
				</h1>

				<?php
					$desc = get_post_custom_values('Description');
					if (!empty($desc[0])) {
						echo '<p itemprop="description">' . wp_kses_post( $desc[0] ) . '</p>';
					}
				?>

			</div>

			<ul class="projects-meta list-unstyled">
				<li>
					By <span itemprop="author"><?php
					if( function_exists( 'coauthors_posts_links' ) ) {
						coauthors_posts_links();
					} else {
						the_author_posts_link();
					} ?></span>
				</li>

				<?php
					if ($time[0]) {
						echo '<li>Time Required: <span>' . esc_html( $time[0] ) . '</span></li>';
					} else if ($post_duration[0]) {
						echo '<li>Time Required: <span>' . $post_duration[0] . '</span></li>';
					}

					if ($post_difficulty[0]) {
						echo '<li>Difficulty: <span itemprop="proficiencyLevel">' . $post_difficulty[0] . '</span></li>';
					}

					if ($post_price_custom[0]) {
						echo '<li>Price: <span>' . esc_html( $post_price_custom[0] ) . '</span></li>';
					} else if ($post_price_group[0]) {
						echo '<li>Price: <span>' . $post_price_group[0] . '</span></li>';
					}
				?>

				<meta itemprop="datePublished" content="<?php the_date(); ?>" />

				<li class="pull-right">
					<a class="project-print-btn btn btn-xs btn-default print-page">
						<i class="fa fa-print" aria-hidden="true"></i> Print this Project
					</a>
				</li>
			</ul>

			<div class="row">

				<div class="col-xs-12 col-sm-8 project-content" >

					<a id="sumome-project-sharing" data-sumome-share-id="002914e1-bbce-4a58-b59e-8846991ae71c"></a>

					<?php
			 			$image = get_post_custom_values('Image');
						if ( !empty( $image[0] ) ) {
							echo '<img itemprop="image" src="' . wpcom_vip_get_resized_remote_image_url( make_projects_to_s3( $image[0] ), 620, 465 ) . '" alt="' . esc_attr( the_title('', '', false ) ) . '" />';
						}
					?>

					<div class="article-body" itemprop="articleBody">
						<?php the_content(); ?>
					</div>

				</div>

				<div class="col-xs-12 col-sm-4 sidebar">
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
						$old_parts = get_the_terms( $post->ID, 'parts' );
						$parts = get_post_meta( $post->ID , 'parts' );
						$old_tools = get_the_terms( $post->ID, 'tools' );
						$tools = get_post_meta( $post->ID, 'Tools' );

						if ( ! empty( $old_parts ) || ! empty( $parts ) || ! empty( $old_tools ) || ! empty( $tools[0] ) ) {
					?>

						<div class="parts-tools">

							<ul class="top">
								<?php
									if ( $parts || $old_parts ) {
										echo '<li class="active"><a href="#1" data-toggle="tab">Parts</a></li>';
									}
									if ( ( $parts || $old_parts ) && ( $tools[0] || $old_tools ) ) {
										echo '<li class="divider"> / </li>';
									}
									if ( ( $tools[0] || $old_tools ) && ( $parts || $old_parts ) ) {
										echo '<li><a href="#2" data-toggle="tab">Tools</a></li>';
									} 
									elseif ( ( $tools[0] || $old_tools ) && !( $parts || $old_parts ) ) {
										echo '<li class="active"><a href="#2" data-toggle="tab">Tools</a></li>';
									}
								?>
							</ul>

							<div class="tab-content">
								<?php
									if ( $parts ) {
										echo '<div class="tab-pane active" id="1">';
										echo make_projects_parts( $parts );
										echo '</div>';
									}

									// If our parts are empty, we want to default to tools
									if ( empty( $parts ) && !empty( $tools ) ) {
										echo '<div class="tab-pane active" id="2">';
										echo make_projects_tools( $tools );
										echo '</div>';
									} elseif ( !empty( $parts ) && !empty( $tools ) ) {
										echo '<div class="tab-pane" id="2">';
										echo make_projects_tools( $tools );
										echo '</div>';
									}
								?>
							</div>

						</div>

					<?php } ?>

					<div class="projects-ad">
						<p id="ads-title">Advertisement</p>
						<?php global $make; print $make->ads->ad_300x250_flex_atf; ?>
					</div>

					<div class="sidebar-ad">
						<p id="ads-title">Advertisement</p>
						<?php global $make; print $make->ads->ad_300x250_house; ?>
					</div>

					<div class="projects-ad">
						<p id="ads-title">Advertisement</p>
						<?php global $make; print $make->ads->ad_300x600; ?>
					</div>

				</div><?php //END SIDEBAR ?>

			</div><?php //END ROW ?>

			<?php
				$stepscount = unserialize( $steps[0] );
				if ( !empty( $stepscount ) ) {
			?>

			<div class="row">

				<div class="col-xs-12">

					<div class="row">

						<div class="col-xs-12">

							<h2 class="new-heading">Steps</h2>

						</div>

					</div>

					<div class="bottom-steps" id="target">

						<div class="row">

							<div class="col-xs-12 col-sm-4">

								<?php make_projects_steps_list( $steps ); ?>

								<div class="projects-understeps-ad">
									<p id="ads-title">Advertisement</p>
									<?php global $make; print $make->ads->ad_300x250_house; ?>
								</div>

							</div>

							<div class="col-xs-12 col-sm-8">

								<div class="tab-content" id="steppers">

									<?php make_projects_steps( $steps ); ?>

								</div>

							</div>

						</div>


						<?php
							$conclusion = get_post_custom_values('Conclusion');
							if ( !empty( $conclusion[0] ) ) {
						?>

						<div class="row">

							<div class="col-xs-12 col-sm-8">

								<?php
									echo '<div class="conclusion">';
									echo '<h2 class="new-heading">Conclusion</h2>';
									echo wp_kses_post( $conclusion[0] ) ;
									echo '</div>';
								?>

							</div>

							<div class="col-xs-12 col-sm-4">
							</div>

						</div>

						<?php } ?>

					</div>

				</div>

			</div>

			<?php } ?>

			<?php endwhile; ?>


			<?php
				if ( function_exists( 'coauthors_posts_links' ) ) {
					get_author_profile('project');
				} ?>
						
			<div class="row padtop">

				<div class="col-xs-12 col-sm-8">

					<div class="ad-unit">
						<p id="ads-title">Advertisement</p>
						<?php global $make; print $make->ads->ad_728x90; ?>
					</div>

					<div id="contextly">

						<?php echo do_shortcode('[contextly_main_module]'); ?>

					</div>

					<?php else: ?>

						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

					<?php endif; ?>

					<div class="comments">
						
						<?php comments_template(); ?>
					
					</div>

				</div>

				<?php if ( empty( $stepscount ) ) { ?>

					<div class="col-xs-12 col-sm-4" style="margin-top:20px;">
					</div>

				<?php } else {
					get_sidebar('projects');
				} ?>

			</div>

		</div><?php //post_class('col-xs-12') ?>	

	</div><?php //.row ?>	

</div><?php //.container ?>	

<?php get_footer(); ?>
