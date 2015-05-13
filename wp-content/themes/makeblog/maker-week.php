<div class="maker-week-takeover">
	<div class="flags">

	<div class="container">

		<div class="row">

			<div class="span12 mw-promotion">

				<div class="mw-makerfaire">

					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/makerfaire.png" alt="Makerfaire">

				</div>

				<div class="mw-10th">

					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/10th-annual.png" alt="10th Annual Bay Area Makerfaire">

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
					$output .= '<div class="thumb slider">';
					$output .= get_the_image( array( 'image_scan' => true, 'size' => 'maker-week-thumb', 'image_class' => 'hide-thumbnail pull-left', 'echo' => false ) );
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
					<div id="div-gpt-ad-664089004995786621-1" class="text-center">
						<script type='text/javascript'>
							googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-1')});
						</script>
					</div>		


			</div>

		</div>
		
		

	</div>
	</div>
</div>

