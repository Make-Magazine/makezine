<?php
/**
 * This is a blog page template
 */ ?>
<div class="container">
	<div class="row">
		<h1 class="all-stories">All stories</h1>
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 post-wrapper">
			<ul class="post-list">
				<li class="row">

				<?php
			$arguments = array(
				'post_type' => 'post',
				'posts_per_page' => 200,
				'post_status' => 'publish',
			);
			$query = new WP_Query($arguments);
			$post_weight = 0;
			$row_weight = 0;
			while ($query->have_posts())  : $query->the_post();?>
				<?php


				$post_id = get_the_ID();
				$type_array = get_post_meta($post_id, 'story_type');
				$story_type[] = $type_array[0];
				if ( ( $type_array[0] == 'News & Features' ) or ( $type_array[0] == 'Skill Builders' ) or ( $type_array[0] == 'Reviews' ) ) {
					$post_weight = 2;
					$bootstrap_class = 'col-lg-6 col-md-6 col-sm-12 col-xs-12';
				} else {
					$post_weight = 1;
					$bootstrap_class = 'col-lg-3 col-md-3 col-sm-6 col-xs-6';

				}
				$row_weight = $row_weight + $post_weight;
				if ( $row_weight > 4 ) { ?>
				</li>
				<li class="row">
					<?php
					$row_weight = $post_weight;
					}
				?>

				<div class="post <?php echo $bootstrap_class; ?>">
					<?php echo '<pre>';
					var_dump($type_array[0], get_the_title());
					echo '</pre>'; ?>
				</div>


<?php
			endwhile;

			do_action('custom_page_hook', $query);
			wp_reset_query();
			?>
				</li>
			</ul>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 sidebar-wrapper">
			sidebar
		</div>
	</div>
</div>
