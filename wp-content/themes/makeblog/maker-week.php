<div class="maker-week-takeover">
	<div class="flags">

	<div class="container">

		<div class="row">

			<div class="span12 mw-promotion">

				<div class="mw-makerfaire">

					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/makerfaire.png" alt="Makerfaire">

				</div>

				<div class="mw-10th">

					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/10th-annual-high-res.png" alt="10th Annual Bay Area Makerfaire">

				</div>

				<div class="mw-makey">

					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/2015-makey.png" alt="2015 Makey">

				</div>				

			</div>

			<div class="span8">

				<div class="slider">

					<?php echo do_shortcode("[metaslider id=471480]"); ?>

				</div>
				
				<?php 
				$featuredposts = make_get_cap_option( 'make_week_takeover_posts' );
				$posts = array_map( 'get_post', explode( ',', $featuredposts ) );
				$output = '<div class="span8 mw-news">';
				foreach ( $posts as $post ) {
					$thumbnail_id = get_post_thumbnail_id($post->ID);
					$thumbnail_object = wp_get_attachment_image_src($thumbnail_id);
					$output .= '<div class="thumb slider">';
					$output .= '<img src="'.get_resized_remote_image_url($thumbnail_object[0],328,128).'" height="128" width="328" alt="">';
					$output .= '<div class="mw-content">';
					$output .= '<h4><a href="' . get_permalink() . '">' . make_get_short_title( 78 ) . '</a></h4>';
					$output .= '<div class="clearfix"></div></div></div>';
				}
				$output .= '</div>';
				echo $output;
				?>

			</div>

			<div class="span4">
					<div id="div-gpt-ad-664089004995786621-9" class="text-center">
						 <script type='text/javascript'>
						  googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-9')});
						 </script>
					</div>
					<div id='div-gpt-ad-664089004995786621-3' class='mw-adslot'>
								<script type='text/javascript'>
									googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-3')});
								</script>
							</div>	


			</div>

		</div>
		
		

	</div>
	<div id="mw-flags-btm"></div>
	</div>
</div>

