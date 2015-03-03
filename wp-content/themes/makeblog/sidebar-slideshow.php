				<div class="span4">

					<div class="slide-side affix">

						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

							<?php the_title('<h1>', '</h1>'); ?>
						
							<?php edit_post_link($link = null, $before = '', $after = '', $id = 0); ?>

						<?php endwhile; else: endif; ?>

						<div class="sidebar-ad">

							<!-- Beginning Sync AdSlot 2 for Ad unit header ### size: [[300,250]]  -->
							<div id='div-gpt-ad-664089004995786621-2'>
								<script type='text/javascript'>
									googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-2')});
								</script>
							</div>
							<!-- End AdSlot 2 -->

						</div>
						
						<div class="sidebar-ad">

							<a href="http://makezine.com" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/more-from-make.png" alt="More from MAKE"></a>

						</div>
						

					</div>

				</div>
