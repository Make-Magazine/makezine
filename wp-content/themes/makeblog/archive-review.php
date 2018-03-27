<?php
/**
 * Archive page template for review custom post type.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Cole Geissinger <colegeissinger@makermedia.com>
 * 
 */
global $catslugs;
get_header('universal'); ?>
		
	<div class="content-type">
	
		<div class="container">

			<div class="row">

				<div class="col-xs-12">
				
					<div class="content-type-top">
					
						<div class="row">
							
							<div class="col-md-9">
								
								<h1>Make: Reviews</h1>
								
								<p>Is that new microcontroller the bee's knees or a bust? What's the best 3D printer for your workshop? How well does that toolbox really hold up? MAKE reviews all the tools, boards, kits, and more, and shares the results with you.</p>
								
								<h3>Find Reviews by Category:</h3>
								
								<ul class="subs">
									
									<?php echo make_category_li( 'review' ); ?>		
									
								</ul>
								
							</div>
							
							<div class="col-md-3"></div>
							
						</div>
					
					</div>
					
				</div>
				
			</div>
		
		</div>

	</div>
					
	<div class="grey">

		<div class="container">
		
			<div class="row">
			
				<div class="col-md-8">
					
					<?php
						$args = array(
							'post_type'			=> 'review',
							'title'				=> 'Featured Reviews',
							'limit'				=> 2,
							'tag'				=> 'Featured',
							'projects_landing'	=> false,
							'all'				=> false
						);
						echo make_carousel( $args ); ?>
					
				</div>
				
				<div class="col-md-4">
					
					<div class="sidebar-ad">

						<?php global $make; print $make->ads->ad_300x250_atf; ?>

					</div>
					
				</div>
				
			</div>
								
			<div class="row">
			
				<div class="col-xs-12">
				
					<?php 

						$args = array(
							'post_type'			=> 'review',
							'title'				=> 'New Reviews',
							'projects_landing'	=> false,
							'all'				=> false,
						);
						
						echo make_carousel($args);
					?>
					
				</div>
			
			</div>
			
		</div>
		
	</div>
				
	<?php

		if ($catslugs) {
			echo '<div class="grey topper"><div class="container"><div class="row"><div class="col-xs-12"><h2>Reviews by Category</h2></div></div></div></div>';
			foreach ($catslugs as $category) {
				$category = wpcom_vip_get_term_by('name', $category, 'category');
				echo '<div class="grey"><div class="container"><div class="row"><div class="col-xs-12">';							
				$args = array(
					'post_type'			=> 'review',
					'category__in'		=> $category->term_id,
					'title'				=> $category->name,
					'projects_landing'	=> false,
					'all'				=> false

				);
				echo make_carousel( $args );
				echo '</div></div></div>';
			} 
		} 
	?>

	<?php get_footer(); ?>