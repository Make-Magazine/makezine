<?php
/**
 * Day of Making Template
 *
 * Template Name: Day of Making 2
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Matt Abernathy <matt@makermedia.com>
 * 
 */
get_header('version-2'); ?>

<div class="container">

<header class="header-dom">

<div class="row">
	
	<div class="span6">

		<h1>Make: Day of Making</h1>

		<p class="dom-mf-movement">We are a nation of makers, hackers, and out-of-the-box thinkers.  We don’t just consume, we create. It’s in our nature as individuals to take the materials around us and make them into things that are completely new. We support the national Day of Making, and we want to ensure that everybody who wants to participate has access to all the tools and techniques they need.</p>
	
	</div>

	<div class="span4 offset2">

		<img src="<?php echo get_template_directory_uri(); ?>/images/day-of-making/day-of-making.png" alt="">

	</div>
	
</div>

<div class="hr"></div>

</header>

<!-- Grab posts from day-of-making tag -->
<?php
//get all terms (e.g. categories or post tags), then display all posts in each term
$taxonomy = 'post_tag';//  e.g. post_tag, category
$param_type = 'tag__in'; //  e.g. tag__in, category__in
$term_args=array(
  'orderby' => 'id',
  'order' => 'DESC',
  'include' => '1687'
);
$terms = get_terms($taxonomy,$term_args);
$dom_posts = array();
if ($terms) {
  foreach( $terms as $term ) {
    $args=array(
      "$param_type" => array($term->term_id),
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'caller_get_posts'=> 1
      );
    $my_query = null;
    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) {
      while ($my_query->have_posts()) : $my_query->the_post(); ?>
        <?php $dom_posts[] = get_the_ID(); ?>
       <?php
      endwhile;
    }
  }
}
wp_reset_query();  // Restore global post data stomped by the_post().
?>

<div class="dom-container">

<div class="row"> <!-- Main Container Row -->

	<div class="span8">
			
			<div class="row first-row">
			
				<div class="span8 dom-main-story">

						<?php 
							$featuredposts = $dom_posts[0];
							$posts = array_map( 'get_post', explode( ',', $featuredposts ) );
							
							foreach ( $posts as $post ) {
								$thumbnail_id = get_post_thumbnail_id($post->ID);
								$thumbnail_object = wp_get_attachment_image_src($thumbnail_id);
								$output .= '<div class="dom-featured-thumb"><a href="' . get_permalink() . '"><img src="'.get_resized_remote_image_url($thumbnail_object[0],630,250).'" height="250" width="630" alt=""></a></div>';
								$output .= '<div class="date">Posted ' . get_the_date('d F Y') . '</div>';
								$output .= '<h4><a href="' . get_permalink() . '">' . make_get_short_title( 78 ) . '</a></h4>';
								$output .= '<p class="dom-feature-excerpt">' . wp_trim_words(strip_shortcodes( get_excerpt_by_id($post_id) ), 20, '...') . '</p>';
								$output .= '<div class="clearfix"></div>';
								$output .= '<div class="dom-rm-featured">';
								$output .= '<a href="' . get_permalink() . '">' . 'READ MORE' . '</a>';
								$output .= '<a href="' . get_permalink() . '">' . '<img src="' . get_template_directory_uri() . '/images/day-of-making/arrow.png" class="dom-feature-arrow" alt="Arrow"/></a></div>';
							}
							echo $output;
						?>

				</div>
			
			</div>
			
			<div class="row second-row">
			
				<div class="span4 dom-story">

					<?php 
						$featuredposts1 = $dom_posts[1];
						$posts = array_map( 'get_post', explode( ',', $featuredposts1 ) );
						
						foreach ( $posts as $post ) {
							$thumbnail_id1 = get_post_thumbnail_id($post->ID);
							$thumbnail_object1 = wp_get_attachment_image_src($thumbnail_id1);
							$output1 .= '<div class="dom-featured-thumb"><a href="' . get_permalink() . '"><img src="'.get_resized_remote_image_url($thumbnail_object1[0],343,198).'" height="198" width="343" alt=""></a></div>';
							$output1 .= '<div class="date">Posted ' . get_the_date('d F Y') . '</div>';
							$output1 .= '<h4><a href="' . get_permalink() . '">' . make_get_short_title( 78 ) . '</a></h4>';
							$output1 .= '<p>' . wp_trim_words(strip_shortcodes( get_excerpt_by_id($post_id1) ), 15, '...') . '</p>';
							$output1 .= '<div class="clearfix"></div>';
							$output1 .= '<div class="dom-read-more">';
							$output1 .= '<a href="' . get_permalink() . '">' . 'READ MORE' . '</a>';
							$output1 .= '<a href="' . get_permalink() . '">' . '<img src="' . get_template_directory_uri() . '/images/day-of-making/arrow.png" class="dom-arrow" alt="Arrow"/></a></div>';
						}
						echo $output1;
					?>

				</div>

				<div class="span4 dom-story">

					<?php 
						$featuredposts2 = $dom_posts[2];
						$posts = array_map( 'get_post', explode( ',', $featuredposts2 ) );
						
						foreach ( $posts as $post ) {
							$thumbnail_id2 = get_post_thumbnail_id($post->ID);
							$thumbnail_object2 = wp_get_attachment_image_src($thumbnail_id2);
							$output2 .= '<div class="dom-featured-thumb"><a href="' . get_permalink() . '"><img src="'.get_resized_remote_image_url($thumbnail_object2[0],343,198).'" height="198" width="343" alt=""></a></div>';
							$output2 .= '<div class="date">Posted ' . get_the_date('d F Y') . '</div>';
							$output2 .= '<h4><a href="' . get_permalink() . '">' . make_get_short_title( 78 ) . '</a></h4>';
							$output2 .= '<p>' . wp_trim_words(strip_shortcodes( get_excerpt_by_id($post_id2) ), 15, '...') . '</p>';
							$output2 .= '<div class="clearfix"></div>';
							$output2 .= '<div class="dom-read-more">';
							$output2 .= '<a href="' . get_permalink() . '">' . 'READ MORE' . '</a>';
							$output2 .= '<a href="' . get_permalink() . '">' . '<img src="' . get_template_directory_uri() . '/images/day-of-making/arrow.png" class="dom-arrow" alt="Arrow"/></a></div>';
						}
						echo $output2;
					?>

				</div>
			
			</div>
			
			<div class="row third-row">
			
				<div class="span4 dom-story">

					<?php 
						$featuredposts3 = $dom_posts[3];
						$posts = array_map( 'get_post', explode( ',', $featuredposts3 ) );
						
						foreach ( $posts as $post ) {
							$thumbnail_id3 = get_post_thumbnail_id($post->ID);
							$thumbnail_object3 = wp_get_attachment_image_src($thumbnail_id3);
							$output3 .= '<div class="dom-featured-thumb"><a href="' . get_permalink() . '"><img src="'.get_resized_remote_image_url($thumbnail_object3[0],343,198).'" height="198" width="343" alt=""></a></div>';
							$output3 .= '<div class="date">Posted ' . get_the_date('d F Y') . '</div>';
							$output3 .= '<h4><a href="' . get_permalink() . '">' . make_get_short_title( 78 ) . '</a></h4>';
							$output3 .= '<p>' . wp_trim_words(strip_shortcodes( get_excerpt_by_id($post_id3) ), 15, '...') . '</p>';
							$output3 .= '<div class="clearfix"></div>';
							$output3 .= '<div class="dom-read-more">';
							$output3 .= '<a href="' . get_permalink() . '">' . 'READ MORE' . '</a>';
							$output3 .= '<a href="' . get_permalink() . '">' . '<img src="' . get_template_directory_uri() . '/images/day-of-making/arrow.png" class="dom-arrow" alt="Arrow"/></a></div>';
						}
						echo $output3;
					?>

				</div>

				<div class="span4 dom-story">

					<?php 
						$featuredposts4 = $dom_posts[4];
						$posts = array_map( 'get_post', explode( ',', $featuredposts4 ) );
						
						foreach ( $posts as $post ) {
							$thumbnail_id4 = get_post_thumbnail_id($post->ID);
							$thumbnail_object4 = wp_get_attachment_image_src($thumbnail_id4);
							$output4 .= '<div class="dom-featured-thumb"><a href="' . get_permalink() . '"><img src="'.get_resized_remote_image_url($thumbnail_object4[0],343,198).'" height="198" width="343" alt=""></a></div>';
							$output4 .= '<div class="date">Posted ' . get_the_date('d F Y') . '</div>';
							$output4 .= '<h4><a href="' . get_permalink() . '">' . make_get_short_title( 78 ) . '</a></h4>';
							$output4 .= '<p>' . wp_trim_words(strip_shortcodes( get_excerpt_by_id($post_id4) ), 15, '...') . '</p>';
							$output4 .= '<div class="clearfix"></div>';
							$output4 .= '<div class="dom-read-more">';
							$output4 .= '<a href="' . get_permalink() . '">' . 'READ MORE' . '</a>';
							$output4 .= '<a href="' . get_permalink() . '">' . '<img src="' . get_template_directory_uri() . '/images/day-of-making/arrow.png" class="dom-arrow" alt="Arrow"/></a></div>';
						}
						echo $output4;
					?>

				</div>

			</div>

			<div class="row fourth-row">
			
				<div class="span4 dom-story">

					<?php 
						$featuredposts5 = $dom_posts[5];
						$posts = array_map( 'get_post', explode( ',', $featuredposts5 ) );
						
						foreach ( $posts as $post ) {
							$thumbnail_id5 = get_post_thumbnail_id($post->ID);
							$thumbnail_object5 = wp_get_attachment_image_src($thumbnail_id5);
							$output5 .= '<div class="dom-featured-thumb"><a href="' . get_permalink() . '"><img src="'.get_resized_remote_image_url($thumbnail_object5[0],343,198).'" height="198" width="343" alt=""></a></div>';
							$output5 .= '<div class="date">Posted ' . get_the_date('d F Y') . '</div>';
							$output5 .= '<h4><a href="' . get_permalink() . '">' . make_get_short_title( 78 ) . '</a></h4>';
							$output5 .= '<p>' . wp_trim_words(strip_shortcodes( get_excerpt_by_id($post_id5) ), 15, '...') . '</p>';
							$output5 .= '<div class="clearfix"></div>';
							$output5 .= '<div class="dom-read-more">';
							$output5 .= '<a href="' . get_permalink() . '">' . 'READ MORE' . '</a>';
							$output5 .= '<a href="' . get_permalink() . '">' . '<img src="' . get_template_directory_uri() . '/images/day-of-making/arrow.png" class="dom-arrow" alt="Arrow"/></a></div>';							
						}
						echo $output5;
					?>

				</div>

				<div class="span4 dom-story">

					<?php 
						$featuredposts6 = $dom_posts[6];
						$posts = array_map( 'get_post', explode( ',', $featuredposts6 ) );
						
						foreach ( $posts as $post ) {
							$thumbnail_id6 = get_post_thumbnail_id($post->ID);
							$thumbnail_object6 = wp_get_attachment_image_src($thumbnail_id6);
							$output6 .= '<div class="dom-featured-thumb"><a href="' . get_permalink() . '"><img src="'.get_resized_remote_image_url($thumbnail_object6[0],343,198).'" height="198" width="343" alt=""></a></div>';
							$output6 .= '<div class="date">Posted ' . get_the_date('d F Y') . '</div>';
							$output6 .= '<h4><a href="' . get_permalink() . '">' . make_get_short_title( 78 ) . '</a></h4>';
							$output6 .= '<p>' . wp_trim_words(strip_shortcodes( get_excerpt_by_id($post_id6) ), 15, '...') . '</p>';
							$output6 .= '<div class="clearfix"></div>';
							$output6 .= '<div class="dom-read-more">';
							$output6 .= '<a href="' . get_permalink() . '">' . 'READ MORE' . '</a>';
							$output6 .= '<a href="' . get_permalink() . '">' . '<img src="' . get_template_directory_uri() . '/images/day-of-making/arrow.png" class="dom-arrow" alt="Arrow"/></a></div>';
						}
						echo $output6;
					?>

				</div>

			</div>

	</div> <!-- End span8 -->		

	<div class="span4 dom-middle-section">
		
		<div class="row first-row">
			
			<div class="domWH">
				<p>In recognition of the history of American innovation, craftsmanship and entrepreneurship, President Barack Obama in 2014 declared June 18 the National Day of Making. The President's <a href="https://www.whitehouse.gov/nation-of-makers" target="_blank">Nation of Makers</a> initiative is a call to action for companies, colleges, communities and citizens to join the White House in lifting up makers and builders and doers across the country. In 2015, the Obama White House expanded these activities to a <i>Week of Making</i> from June 12-18, an event that coincides with the National Maker Faire in Washington D.C.</p>
				<a href="http://nationalmakerfaire.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/day-of-making/national-mf-badge.png" alt="National MakerFaire Badge" class="mf-badge" /></a>
			</div>
		
		</div>

		<div class="row second-row">
			
			<a class="twitter-timeline" href="https://twitter.com/search?q=%23NationOfMakers" width="275" height="770" data-widget-id="476445295467704320">Tweets about "#NationOfMakers"</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		
		</div>
		
		<div class="row third-row second-column">
		
			<div class="span4 dom-story dom-final-story">

						<?php 
							$featuredposts7 = $dom_posts[7];
							$posts = array_map( 'get_post', explode( ',', $featuredposts7 ) );
							
							foreach ( $posts as $post ) {
								$thumbnail_id7 = get_post_thumbnail_id($post->ID);
								$thumbnail_object7 = wp_get_attachment_image_src($thumbnail_id7);
								$output7 .= '<div class="dom-featured-thumb"><a href="' . get_permalink() . '"><img src="'.get_resized_remote_image_url($thumbnail_object7[0],343,198).'" height="198" width="343" alt=""></a></div>';
								$output7 .= '<div class="date">Posted ' . get_the_date('d F Y') . '</div>';
								$output7 .= '<h4><a href="' . get_permalink() . '">' . make_get_short_title( 78 ) . '</a></h4>';
								$output7 .= '<p>' . wp_trim_words(strip_shortcodes( get_excerpt_by_id($post_id7) ), 15, '...') . '</p>';
								$output7 .= '<div class="clearfix"></div>';
								$output7 .= '<div class="dom-read-more">';
								$output7 .= '<a href="' . get_permalink() . '">' . 'READ MORE' . '</a>';
								$output7 .= '<a href="' . get_permalink() . '">' . '<img src="' . get_template_directory_uri() . '/images/day-of-making/arrow.png" class="dom-arrow" alt="Arrow"/></a></div>';
							}
							echo $output7;
						?>

			</div>

		</div>

		<div class="row"><div class="read-more-stories"><a href="http://makezine.com/tag/day-of-making/">Read More Stories</a></div></div>
	
	</div> <!-- End span8 -->

</div> <!-- End main container row -->

</div> <!-- End dom-container -->

</div> <!-- End container -->

<?php get_footer(); ?>