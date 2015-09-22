<?php
/**
 * Index Page
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * 
 */
global $wp_query;
get_header('version-2'); ?>
		
	<div class="single">
	
		<div class="container">

			<div class="row">

				<div class="span12">

					<div class="results well">

						<h1>
							Search Results for
							<form role="search" method="get" class="form-search" id="searchform" action="<?php echo home_url( '/' ); ?>">
								<input type="text" class="input-medium search-query span3" value="" name="s" id="s" placeholder="<?php echo get_search_query(); ?>" />
								<input type="submit" class="btn" id="searchsubmit" value="Search" />
							</form>
						</h1>

					</div>

				</div>

			</div>

			<div class="row">

				<?php  get_sidebar( 'search' ); ?>

				<div class="span8">

					<div class="search-results">

						<div class="heading">

							<!-- Sort By: Relevance | Newest | Oldest -->
							<h3>Search Results</h3>

						</div>

						<div class="count">

							<div class="pull-left">

								<?php  echo makezine_search_count( $wp_query ); ?>

							</div>

							<div class="pull-right">

								<?php  echo makezine_search_pagination( $wp_query ); ?>

							</div>

							<div class="clearfix"></div>

						</div>

						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

							<article <?php post_class('media'); ?>>

								<a href="<?php the_permalink(); ?>" class="pull-left">
									<?php 
										$args = array(
											'image_scan' => true,
											'size' => 'search-thumb',
											'image_class' => 'thumbnail',
											'link_to_post' => false,
											);
										get_the_image( $args ); 
									?>
								</a>

								<div class="media-body">

									<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
									
									<div class="meta"><?php the_time('m/d/Y \@ g:i a'); ?> | <?php echo ucfirst( make_post_type_better_name( get_post_type() ) ); ?></div>

									<div class="media-body">
										<p><?php echo wp_trim_words( get_the_excerpt(), 16, '...' ); ?> <a href="<?php the_permalink(); ?>"></a></p>
									</div>

								</div>
							
							</article>

						<?php endwhile; ?>

						<div class="count bottom">

							<div class="pull-left">

								<?php  echo makezine_search_count( $wp_query ); ?>

							</div>

							<div class="pull-right">

								<?php  echo makezine_search_pagination( $wp_query ); ?>

							</div>

							<div class="clearfix"></div>

						</div>

					</div>
					
					<ul class="pager">
							
						<li class="previous"><?php previous_posts_link('&larr; Previous Page'); ?></li>
						<li class="next"><?php next_posts_link('Next Page &rarr;'); ?></li>
					
					</ul>

					<?php else: ?>
					
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					
					<?php endif; ?>
				</div>
					
					
			</div>

		</div>

	</div>

<?php get_footer(); 



/**
 * Getting the post count for a given loop.
 * There is probably a WordPress function that does this for ya, but this works for now.
 */
function makezine_search_count( $wp_query ) {
	$output = '<div class="results_count">';
	if ( $wp_query->found_posts > 10 ) {
		$paged = ( $wp_query->query_vars['paged'] === 0 ) ? 1 : $wp_query->query_vars['paged'];
		$post_count = ( ( $paged * $wp_query->query_vars['posts_per_page'] ) - $wp_query->query_vars['posts_per_page'] + 1 );
		$output .= '<span class="bold">' . absint( $post_count ) . '</span>';
		$output .= ' - ';
		$output .= '<span class="bold">' . ( $post_count + $wp_query->post_count - 1 ) . '</span>';
		$output .= ' of <span class="bold">' . $wp_query->found_posts . '</span> results';
	}
	$output .= '</div>';

	return $output;
}

/**
 * Build the output pagination for the search page.
 */
function makezine_search_pagination( $wp_query ) {
	$big = 999999999; // need an unlikely integer

	return paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, $wp_query->query_vars['paged'] ),
		'total' => $wp_query->max_num_pages,
		'prev_text'    => __('<span class="prev">«</span>'),
		'next_text'    => __('<span class="next">»</span>'),
		'add_args'     => false,
	) );
}

?>