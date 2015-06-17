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
get_header(); ?>

<header class="header-dom">

<div class="row">
	
	<div class="span6 offset2">

		<h1>Make: Day of Making</h1>

		<p>The Maker Movement today encourages everyone to think of themselves as makers, and see themselves as producers, not just consumers. We want to ensure that more and more people have access to the tools.</p>
	
	</div>

	<div class="span4 offset2">

		<img src="<?php echo get_template_directory_uri(); ?>/images/day-of-making/day-of-making.png" alt="">

	</div>
	
</div>

<div class="hr"></div>

</header>

<div class="row"> <!-- Main Container Row -->

	<div class="span8 offset2">
			
			<div class="row first-row">
			
				<div class="span dom-main-story">

						<?php 
							$featuredposts = make_get_cap_option( 'dom_featured' );
							$posts = array_map( 'get_post', explode( ',', $featuredposts ) );
							
							foreach ( $posts as $post ) {
								$thumbnail_id = get_post_thumbnail_id($post->ID);
								$thumbnail_object = wp_get_attachment_image_src($thumbnail_id);
								$output .= '<div class="dom-featured-thumb"><a href="' . get_permalink() . '"><img src="'.get_resized_remote_image_url($thumbnail_object[0],630,250).'" height="250" width="630" alt=""></a></div>';
								$output .= '<div class="date">Posted ' . get_the_date('d F Y') . '</div>';
								$output .= '<h4><a href="' . get_permalink() . '">' . make_get_short_title( 78 ) . '</a></h4>';
								$output .= '<p>' . wp_trim_words(strip_shortcodes( get_excerpt_by_id($post_id) ), 30, '') . '</p>';
								$output .= '<div class="clearfix"></div>';
							}
							echo $output;
						?>

				</div>
			
			</div>
			
			<div class="row second-row">
			
				<div class="span4 dom-story">

					<?php 
						$featuredposts1 = make_get_cap_option( 'dom_1' );
						$posts1 = array_map( 'get_post', explode( ',', $featuredposts1 ) );
						
						foreach ( $posts1 as $post1 ) {
							$thumbnail_id1 = get_post_thumbnail_id($post1->ID);
							$thumbnail_object1 = wp_get_attachment_image_src($thumbnail_id1);
							$output1 .= '<div class="dom-featured-thumb"><a href="' . get_permalink() . '"><img src="'.get_resized_remote_image_url($thumbnail_object1[0],343,198).'" height="198" width="343" alt=""></a></div>';
							$output1 .= '<div class="date">Posted ' . get_the_date('d F Y') . '</div>';
							$output1 .= '<h4><a href="' . get_permalink() . '">' . make_get_short_title( 78 ) . '</a></h4>';
							$output1 .= '<p>' . wp_trim_words(strip_shortcodes( get_excerpt_by_id($post_id1) ), 30, '') . '</p>';
							$output1 .= '<div class="clearfix"></div>';
						}
						echo $output1;
					?>

				</div>

				<div class="span4 dom-story">

					<?php 
						$featuredposts2 = make_get_cap_option( 'dom_2' );
						$posts2 = array_map( 'get_post', explode( ',', $featuredposts2 ) );
						
						foreach ( $posts2 as $post2 ) {
							$thumbnail_id2 = get_post_thumbnail_id($post2->ID);
							$thumbnail_object2 = wp_get_attachment_image_src($thumbnail_id2);
							$output2 .= '<div class="dom-featured-thumb"><a href="' . get_permalink() . '"><img src="'.get_resized_remote_image_url($thumbnail_object2[0],343,198).'" height="198" width="343" alt=""></a></div>';
							$output2 .= '<div class="date">Posted ' . get_the_date('d F Y') . '</div>';
							$output2 .= '<h4><a href="' . get_permalink() . '">' . make_get_short_title( 78 ) . '</a></h4>';
							$output2 .= '<p>' . wp_trim_words(strip_shortcodes( get_excerpt_by_id($post_id2) ), 30, '') . '</p>';
							$output2 .= '<div class="clearfix"></div>';
						}
						echo $output2;
					?>

				</div>
			
			</div>
			
			<div class="row third-row">
			
				<div class="span4 dom-story">

					<?php 
						$featuredposts3 = make_get_cap_option( 'dom_3' );
						$posts3 = array_map( 'get_post', explode( ',', $featuredposts3 ) );
						
						foreach ( $posts3 as $post3 ) {
							$thumbnail_id3 = get_post_thumbnail_id($post3->ID);
							$thumbnail_object3 = wp_get_attachment_image_src($thumbnail_id3);
							$output3 .= '<div class="dom-featured-thumb"><a href="' . get_permalink() . '"><img src="'.get_resized_remote_image_url($thumbnail_object3[0],343,198).'" height="198" width="343" alt=""></a></div>';
							$output3 .= '<div class="date">Posted ' . get_the_date('d F Y') . '</div>';
							$output3 .= '<h4><a href="' . get_permalink() . '">' . make_get_short_title( 78 ) . '</a></h4>';
							$output3 .= '<p>' . wp_trim_words(strip_shortcodes( get_excerpt_by_id($post_id3) ), 30, '') . '</p>';
							$output3 .= '<div class="clearfix"></div>';
						}
						echo $output3;
					?>

				</div>

				<div class="span4 dom-story">

					<?php 
						$featuredposts4 = make_get_cap_option( 'dom_4' );
						$posts4 = array_map( 'get_post', explode( ',', $featuredposts4 ) );
						
						foreach ( $posts4 as $post4 ) {
							$thumbnail_id4 = get_post_thumbnail_id($post4->ID);
							$thumbnail_object4 = wp_get_attachment_image_src($thumbnail_id4);
							$output4 .= '<div class="dom-featured-thumb"><a href="' . get_permalink() . '"><img src="'.get_resized_remote_image_url($thumbnail_object4[0],343,198).'" height="198" width="343" alt=""></a></div>';
							$output4 .= '<div class="date">Posted ' . get_the_date('d F Y') . '</div>';
							$output4 .= '<h4><a href="' . get_permalink() . '">' . make_get_short_title( 78 ) . '</a></h4>';
							$output4 .= '<p>' . wp_trim_words(strip_shortcodes( get_excerpt_by_id($post_id4) ), 30, '') . '</p>';
							$output4 .= '<div class="clearfix"></div>';
						}
						echo $output4;
					?>

				</div>

			</div>

			<div class="row fourth-row">
			
				<div class="span4 dom-story">

					<?php 
						$featuredposts5 = make_get_cap_option( 'dom_5' );
						$posts5 = array_map( 'get_post', explode( ',', $featuredposts5 ) );
						
						foreach ( $posts5 as $post5 ) {
							$thumbnail_id5 = get_post_thumbnail_id($post5->ID);
							$thumbnail_object5 = wp_get_attachment_image_src($thumbnail_id5);
							$output5 .= '<div class="dom-featured-thumb"><a href="' . get_permalink() . '"><img src="'.get_resized_remote_image_url($thumbnail_object5[0],343,198).'" height="198" width="343" alt=""></a></div>';
							$output5 .= '<div class="date">Posted ' . get_the_date('d F Y') . '</div>';
							$output5 .= '<h4><a href="' . get_permalink() . '">' . make_get_short_title( 78 ) . '</a></h4>';
							$output5 .= '<p>' . wp_trim_words(strip_shortcodes( get_excerpt_by_id($post_id5) ), 30, '') . '</p>';
							$output5 .= '<div class="clearfix"></div>';
						}
						echo $output5;
					?>

				</div>

				<div class="span4 dom-story">

					<?php 
						$featuredposts6 = make_get_cap_option( 'dom_6' );
						$posts6 = array_map( 'get_post', explode( ',', $featuredposts6 ) );
						
						foreach ( $posts6 as $post6 ) {
							$thumbnail_id6 = get_post_thumbnail_id($post6->ID);
							$thumbnail_object6 = wp_get_attachment_image_src($thumbnail_id6);
							$output6 .= '<div class="dom-featured-thumb"><a href="' . get_permalink() . '"><img src="'.get_resized_remote_image_url($thumbnail_object6[0],343,198).'" height="198" width="343" alt=""></a></div>';
							$output6 .= '<div class="date">Posted ' . get_the_date('d F Y') . '</div>';
							$output6 .= '<h4><a href="' . get_permalink() . '">' . make_get_short_title( 78 ) . '</a></h4>';
							$output6 .= '<p>' . wp_trim_words(strip_shortcodes( get_excerpt_by_id($post_id6) ), 30, '') . '</p>';
							$output6 .= '<div class="clearfix"></div>';
						}
						echo $output6;
					?>

				</div>

			</div>

	</div> <!-- End span8 -->		

	<div class="span4">
		
		<div class="row first-row">
			
			<div class="domWH">
				
			</div>
		
		</div>

		<div class="row second-row">
			
			<a class="twitter-timeline" href="https://twitter.com/search?q=%23NationOfMakers" width="275" height="750" data-widget-id="476445295467704320">Tweets about "#NationOfMakers"</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		
		</div>
		
		<div class="row third-row second-column">
		
			<div class="span4 dom-story">

						<?php 
							$featuredposts7 = make_get_cap_option( 'dom_7' );
							$posts7 = array_map( 'get_post', explode( ',', $featuredposts7 ) );
							
							foreach ( $posts7 as $post7 ) {
								$thumbnail_id7 = get_post_thumbnail_id($post7->ID);
								$thumbnail_object7 = wp_get_attachment_image_src($thumbnail_id7);
								$output7 .= '<div class="dom-featured-thumb"><a href="' . get_permalink() . '"><img src="'.get_resized_remote_image_url($thumbnail_object7[0],343,198).'" height="198" width="343" alt=""></a></div>';
								$output7 .= '<div class="date">Posted ' . get_the_date('d F Y') . '</div>';
								$output7 .= '<h4><a href="' . get_permalink() . '">' . make_get_short_title( 78 ) . '</a></h4>';
								$output7 .= '<p>' . wp_trim_words(strip_shortcodes( get_excerpt_by_id($post_id7) ), 30, '') . '</p>';
								$output7 .= '<div class="clearfix"></div>';
							}
							echo $output7;
						?>

			</div>

		</div>
	
	</div> <!-- End span8 -->

</div> <!-- End Main Container Row -->

<?php get_footer(); ?>