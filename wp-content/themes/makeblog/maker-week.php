<div class="maker-week-takeover">
	<div class="flags">

	<div class="container">

		<div class="row">

			<div class="span12 mw-promotion">

				<div class="mw-makerfaire">

					<a href="http://makerfaire.com" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/makerfaire.png" alt="Makerfaire"></a>

				</div>

				<div class="mw-10th">

					<a href="http://makerfaire.com" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/10th-annual-high-res.png" alt="10th Annual Bay Area Makerfaire"></a>

				</div>

				<div class="mw-makey">

					<a href="http://www.eventbrite.com/e/maker-faire-bay-area-2015-tickets-5938495199" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/2015-makey.png" alt="2015 Makey"></a>

				</div>				

			</div>

			<div class="span8">

				<div class="slider">

					<?php echo do_shortcode("[metaslider id=480811]"); ?>

				</div>
				
				<?php 
				$featuredposts = make_get_cap_option( 'make_week_takeover_posts' );
				$posts = array_map( 'get_post', explode( ',', $featuredposts ) );
				$output = '<div class="span8 mw-news">';
				foreach ( $posts as $post ) {
					$thumbnail_id = get_post_thumbnail_id($post->ID);
					$thumbnail_object = wp_get_attachment_image_src($thumbnail_id);
					$output .= '<div class="thumb slider">';
					$output .= '<a href="' . get_permalink() . '"><img src="'.get_resized_remote_image_url($thumbnail_object[0],328,128).'" height="128" width="328" alt=""></a>';
					$output .= '<div class="mw-content">';
					$output .= '<h4><a href="' . get_permalink() . '">' . make_get_short_title( 78 ) . '</a></h4>';
					$output .= '<div class="clearfix"></div></div></div>';
				}
				$output .= '</div>';
				echo $output;
				?>

			</div>

			<div class="span4">
					<div id="div-gpt-ad-664089004995786621-2" class="text-center">
						<script type='text/javascript'>
						googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-2')});
						</script>
					</div>
					<div id="div-gpt-ad-664089004995786621-9" class="text-center mw-adslot">
						 <script type='text/javascript'>
						  googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-9')});
						 </script>
					</div>

			</div>

		</div>
		
		

	</div>
	<div id="mw-flags-btm"></div>
	</div>
</div>

<div class="row leaderboard">
	<div class="home-waist-banner">
		<div id="div-gpt-ad-664089004995786621-6" class="banner-canvas">
			
			 <script type='text/javascript'>
			  googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-6')});
			 </script>
		</div>
	</div>
</div>

