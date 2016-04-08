<?php
/*
Plugin Name: WordPress Scheduled Time
Plugin URI: http://www.willen.net/wordpress-scheduled-time/
Description: This plugin makes it possible to see the scheduled post time of a post.
Version: 0.9
Author: Paul Willen
Author URI: http://www.willen.net
*/ 

global $post;

add_filter( 'manage_edit-post_sortable_columns', 'wst_sortable_column');
add_filter('manage_posts_columns', 'wst_set_post_columns');
add_action('manage_posts_custom_column',  'wst_show_columns');

function wst_sortable_column( $columns ) {
	$columns['published-time'] = 'date';
	return $columns;
}

function wst_set_post_columns($columns) {
  $columns['published-time'] = 'Post Status';
  unset($columns['date']);
  return $columns;
}

function wst_show_columns($columnname) {
	global $post;
	switch ($columnname) {
		case 'published-time':
		if ($post->post_status == 'future')
		{
			?>
			<p style="color:#2EC63F">Scheduled <br /><?php the_time(get_option('date_format')); ?> @ <?php the_time(get_option('time_format')); ?></p>
			<?php
		}
		elseif ($post->post_status == 'publish')
		{
			?>
			<p style="color:black">Published <br /><?php the_time(get_option('date_format')); ?> @ <?php the_time(get_option('time_format')); ?></p>
			<?php
		}
		elseif ($post->post_status == 'draft')
		{
			?>
			<p style="color:orange">Draft <br /><?php the_time(get_option('date_format')); ?> @ <?php the_time(get_option('time_format')); ?></p>
			<?php
		}
		elseif ($post->post_status == 'pending')
		{
			?>
			<p style="color:red">Pending <br /><?php the_time(get_option('date_format')); ?> @ <?php the_time(get_option('time_format')); ?></p>
			<?php
		}
		elseif ($post->post_status = 'trash')
		{
		?>
			<p style="color:brown">Trash <br /><?php the_time(get_option('date_format')); ?> @ <?php the_time(get_option('time_format')); ?></p>
			<?php
		}
		else {
		}      
	}
}

?>