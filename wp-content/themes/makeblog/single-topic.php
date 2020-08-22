<?php
/**
 * Topic
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Rio Roth-Barreiro <rio@make.co>
 *
 */
get_header('universal');

wp_reset_postdata();

$tag = get_the_tags();
$featuredPostsArray = [];
$i = 0;
$featured_posts = get_field('featured_posts');
$featured_posts_grid_num = get_field('featured_post_display_number');

if(!isset($_COOKIE['cookielawinfo-checkbox-non-necessary']) || $_COOKIE['cookielawinfo-checkbox-non-necessary'] == "yes" ) { ?>
	<div class="ad-unit tag-page">
		<?php global $make;
		print $make->ads->ad_leaderboard;
		?>
	</div>
<?php } ?>

	<div class="topic">

		<div class="container-fluid">
			<div class="row">

				<div class="col-sm-12">
					<div class="topic-content">
						<h1><?php echo get_the_title(); ?></h1>
						<?php the_content(); ?>
					</div>
            
					<?php
					if( $featured_posts ){ ?>
					<div id="featured-posts-grid" class="featured-posts-count<?php echo $featured_posts_grid_num; ?>">
						<?php foreach( $featured_posts as $post ) {
							// Setup this post for WP functions (variable must be named $post).
							setup_postdata($post); 
							if (++$i <= $featured_posts_grid_num) {
								array_push($featuredPostsArray, get_the_ID()); // make a list of the featured post ids that have already been used on the page 
								$image = wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), 'project-thumb' );
								$authors = get_coauthors( get_the_ID() );
								$author_names = array();
								foreach ( $authors as $author ) {
									array_push($author_names, $author->display_name);
								} ?>
								<div class="mz-single-post-wrap">
									<div class="mz-single-post">
										<div class="mz-post-thumb">
											<a href="<?php the_permalink(); ?>">
												<figure><?php echo $image; ?></figure>
											</a>
										</div><!-- .mz-post-thumb -->
										<div class="mz-post-content">
											<?php if( get_categories() != 1 ) { news_vibrant_post_categories_list( 1 ); } ?>
											<h3 class="mz-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
											<div class="mz-post-meta">
												<span class="byline">
													<a class="url fn n" href="<?php the_permalink(); ?>">by <?php echo $author_names[0]; ?></a>
												</span>
												<span class="posted-on"> 
													<a href="<?php the_permalink(); ?>" rel="bookmark">
														<time class="entry-date published updated" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
													</a>
												</span>
												
											</div>
										</div>
									</div>
								</div>
						<?php }
						}?>
					</div>
					<br style="clear:both;" />
					<div id="featured-posts-remnant">
						<?php // for all the featured post that don't fit in the grid above
							foreach( array_slice($featured_posts, $featured_posts_grid_num) as $post ) {
								array_push($featuredPostsArray, get_the_ID()); // make a list of the featured post ids that have already been used on the page
								get_template_part( 'includes/single-article-layout' );
							} 
						?>
					</div>
						<?php 
						// Reset the global post object so that the rest of the page works correctly.
						wp_reset_postdata(); ?>
					<?php } ?>
			
				</div>
				
			</div>
			
			<div class="row">
			<?php if($tag[0]->slug) { // if category is provided, do the whole scroll with a sidebar ?>
				<div class="col-md-9 col-sm-7 col-xs-12 all-stories">
					<ul class="post-list">
						<li class="row">
							<div class="post">
								<?php tags_pulling($offset = 0, $current_slug = $tag[0]->slug, $featuredPostsArray); ?>
							</div>
						</li>
					</ul>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-12 aside">
					<div class="sidebar-wrapper tags_sidebar sidebar">
						<?php dynamic_sidebar('sidebar_tags_page'); ?>
					</div>
				</div>
			<?php } ?>
			</div>
			
		</div>

	</div>

<?php 

get_footer(); 
?>
