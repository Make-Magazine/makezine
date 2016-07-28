<?php
/**
 * Index Page
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * 
 */
get_header('version-2'); 
global $wp_query;
$args = array(
	'posts_per_page' => 20
);
query_posts(
	array_merge(
		$args,
		$wp_query->query
	)
); ?>
		
	<div class="single search-results-page">
	
		<div class="container">

			<div class="row">

				<div class="col-xs-12">

					<div class="well">

						<h1>Search Results for</h1>
							<form role="search" method="get" class="form-inline" id="searchform" action="<?php echo home_url( '/' ); ?>">
		            <div id="custom-search-input">
	                <div class="input-group col-xs-12">
                    <input type="text" class="form-control input-lg" <?php if(is_search()) { ?>value="<?php the_search_query(); ?>" <?php } else { ?>value="" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"<?php } ?> name="s" id="s" placeholder="<?php echo get_search_query(); ?>" />
                    <span class="input-group-btn text-center">
                      <button class="btn btn-info btn-lg" type="submit">
                        <i class="fa fa-search" aria-hidden="true"></i></i> SEARCH
                      </button>
                    </span>
	                </div>
		            </div>
                <p class="padtop">Search by type:</p>
                <?php $query_types = get_query_var('post_type'); ?>
                <label class="checkbox-inline">
                  <input type="checkbox" name="post_type[]" value="post" <?php if (in_array('post', $query_types)) { echo 'checked="checked"'; } ?> />
                  Stories
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox" name="post_type[]" value="projects" <?php if (in_array('projects', $query_types)) { echo 'checked="checked"'; } ?> />
                  Projects
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox" name="post_type[]" value="products" <?php if (in_array('products', $query_types)) { echo 'checked="checked"'; } ?> />
                  Product Reviews
                </label>
							</form>

					</div>

				</div>

			</div>

			<div class="row">

				<div class="col-xs-12 col-sm-12 col-md-8">

					<div class="search-results">

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
									<?php echo get_the_post_thumbnail($post_id, 'thumbnail'); ?>
								</a>

								<div class="media-body">

									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									
									<div class="meta"><?php the_time('m/d/Y \@ g:i a'); ?> | <?php echo ucfirst( make_post_type_better_name( get_post_type() ) ); ?></div>

									<div class="media-body">
										<p><?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?> <a href="<?php the_permalink(); ?>"></a></p>
									</div>

								</div>
							
							</article>

						<?php endwhile; ?>

						<div class="count bottom">

							<div class="pull-left">

								<?php  echo makezine_search_count( $wp_query ); ?>

							</div>

							<div class="pull-right">

								<nav>

								<?php  echo makezine_search_pagination( $wp_query ); ?>

							</nav>

							</div>

							<div class="clearfix"></div>

						</div>

					<?php else: ?>
					
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					
					<?php endif; ?>

          </div>

				</div>

				<?php  get_sidebar( 'search' ); ?>
					
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
  $pages = paginate_links( array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'current' => max( 1, $wp_query->query_vars['paged'] ),
    'total' => $wp_query->max_num_pages,
    'prev_next' => false,
    'type'  => 'array',
    'prev_next'   => TRUE,
		'prev_text'    => __('«'),
		'next_text'    => __('»'),
   ) );
  if( is_array( $pages ) ) {
      $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
      echo '<ul class="pagination">';
      foreach ( $pages as $page ) {
        echo "<li>$page</li>";
      }
     echo '</ul>';
  }
}

?>