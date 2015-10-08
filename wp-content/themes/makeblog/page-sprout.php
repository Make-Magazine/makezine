<?php
/**
 * HP Sprout Template
 *
 * Template Name: HP Sprout Template
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Matt Abernathy <matt@makermedia.com>
 * 
 */
get_header('version-2'); ?>

<div class="container">

<header class="header-dom">

<div class="row">
	
	<div class="span12">

		<img src="<?php echo get_template_directory_uri(); ?>/images/sprout/sproutBanner.jpg" alt="" />
	
	</div>
	
</div>

<div class="hr"></div>

</header>

<!-- Grab posts from hp-sprout tag -->
<?php
//get all terms (e.g. categories or post tags), then display all posts in each term
$taxonomy = 'post_tag';//  e.g. post_tag, category
$param_type = 'tag__in'; //  e.g. tag__in, category__in
$term_args=array(
  'orderby' => 'id',
  'order' => 'DESC',
  'include' => '24817'
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

<div class="row">

	<div class="span8">

		<div class="row">
			
			<div class="span8">
				
				<div class="sprout-story sprout-feature-story">
				
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
						$output .= '<div class="sprout-read-more sprout-read-more-featured">';
						$output .= '<a href="' . get_permalink() . '" class="sprout-read-article">' . 'READ ARTICLE' . '</a>';
						$output .= '<a href="' . get_permalink() . '">' . '<img src="' . get_template_directory_uri() . '/images/day-of-making/arrow.png" class="sprout-arrow-featured" alt="Arrow"/></a></div>';
					}
					echo $output;
				?>
				
				</div>

			</div>

		</div>

		<div class="row">

			<div class="span4">

				<div class="sprout-story">
				
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
						$output1 .= '<div class="sprout-read-more">';
						$output1 .= '<a href="' . get_permalink() . '" class="sprout-read-article">' . 'READ ARTICLE' . '</a>';
						$output1 .= '<a href="' . get_permalink() . '">' . '<img src="' . get_template_directory_uri() . '/images/day-of-making/arrow.png" class="sprout-arrow" alt="Arrow"/></a></div>';
					}
					echo $output1;
				?>

				</div>

			</div>

			<div class="span4">
				

				<div class="sprout-story">

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
						$output2 .= '<div class="sprout-read-more">';
						$output2 .= '<a href="' . get_permalink() . '" class="sprout-read-article">' . 'READ ARTICLE' . '</a>';
						$output2 .= '<a href="' . get_permalink() . '">' . '<img src="' . get_template_directory_uri() . '/images/day-of-making/arrow.png" class="sprout-arrow" alt="Arrow"/></a></div>';
					}
					echo $output2;
				?>
				
				</div>

			</div>

		</div>

		<div class="row">

			<div class="span4">
			

			<div class="sprout-story">

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
					$output3 .= '<div class="sprout-read-more">';
					$output3 .= '<a href="' . get_permalink() . '" class="sprout-read-article">' . 'READ ARTICLE' . '</a>';
					$output3 .= '<a href="' . get_permalink() . '">' . '<img src="' . get_template_directory_uri() . '/images/day-of-making/arrow.png" class="sprout-arrow" alt="Arrow"/></a></div>';
				}
				echo $output3;
			?>

			</div>

			</div>

			<div class="span4">
				

				<div class="sprout-story">

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
						$output4 .= '<div class="sprout-read-more">';
						$output4 .= '<a href="' . get_permalink() . '" class="sprout-read-article">' . 'READ ARTICLE' . '</a>';
						$output4 .= '<a href="' . get_permalink() . '">' . '<img src="' . get_template_directory_uri() . '/images/day-of-making/arrow.png" class="sprout-arrow" alt="Arrow"/></a></div>';
					}
					echo $output4;
				?>

				</div>

			</div>

		</div>

		<div class="row">

			<div class="span4">
				
				<div class="sprout-story">

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
						$output5 .= '<div class="sprout-read-more">';
						$output5 .= '<a href="' . get_permalink() . '" class="sprout-read-article">' . 'READ ARTICLE' . '</a>';
						$output5 .= '<a href="' . get_permalink() . '">' . '<img src="' . get_template_directory_uri() . '/images/day-of-making/arrow.png" class="sprout-arrow" alt="Arrow"/></a></div>';							
					}
					echo $output5;
				?>

				</div>

			</div>

			<div class="span4">
				

				<div class="sprout-story">

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
						$output6 .= '<div class="sprout-read-more">';
						$output6 .= '<a href="' . get_permalink() . '" class="sprout-read-article">' . 'READ ARTICLE' . '</a>';
						$output6 .= '<a href="' . get_permalink() . '">' . '<img src="' . get_template_directory_uri() . '/images/day-of-making/arrow.png" class="sprout-arrow" alt="Arrow"/></a></div>';
					}
					echo $output6;
				?>

				</div>

			</div>		

		</div>

	</div>

	<div class="span4">
		<div class="row">
			<div class="span4">
				<a class="twitter-timeline" href="https://twitter.com/hashtag/sproutbyhp" data-widget-id="632328929018167296">#sproutbyhp Tweets</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>
		</div>
		<div class="row">
			<div class="span4">
				<a href="http://www.marketwired.com/press-release/makershedcom-adds-sprout-by-hp-to-growing-list-of-maker-tools-2030035.htm" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/sprout/marketWired.jpg" class="ad-market-wired" alt="Market Wired"/></a>
			</div>
		</div>
		<div class="row">
			<div class="span4">
				<a href="http://www.makershed.com/products/hp-sprout?utm_source=homepage&utm_medium=slideshow&utm_content=hpsproutnew&utm_campaign=slide3"><img src="<?php echo get_template_directory_uri(); ?>/images/sprout/sproutAd.jpg" class="ad-sprout" alt="Sprout Ad"/></a>
			</div>
		</div>		
	</div>

</div>

<?php get_footer(); ?>