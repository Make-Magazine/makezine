<?php
/**
 * @package MakeZine
 * Template Name: Maker Faire Sidebar
 */
 ?>
<?php 
$args = array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'posts_per_page' => 2,
  'ignore_sticky_posts' => 1,
  'tag_id' => '785128'
);
$wp_query = new WP_Query($args); 
?>
<?php function makeblog_shorten($string, $length) {
	// By default, an ellipsis will be appended to the end of the text.
	$suffix = '&hellip;';

	// Convert 'smart' punctuation to 'dumb' punctuation, strip the HTML tags,
	// and convert all tabs and line-break characters to single spaces.
	$short_desc = trim(str_replace(array("\r","\n", "\t"), ' ', strip_tags($string)));

	// Cut the string to the requested length, and strip any extraneous spaces 
	// from the beginning and end.
	$desc = trim(substr($short_desc, 0, $length));

	// Find out what the last displayed character is in the shortened string
	$lastchar = substr($desc, -1, 1);

	// If the last character is a period, an exclamation point, or a question 
	// mark, clear out the appended text.
	if ($lastchar == '.' || $lastchar == '!' || $lastchar == '?') $suffix='';

	// Append the text.
	$desc .= $suffix;

	// Send the new description back to the page.
	return $desc;
} ?>
<div class="newsies">
	<h3>Latest Maker News</h3>
	<div class="news post">

		<?php if( have_posts() ) : 	while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		
			<div class="shorty">
		
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				
				<div class="post_thumb pull-left">
			
					<a href="<?php the_permalink(); ?>">
						
						<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'attachment-thumb' ); } ?>
						
					</a>
				
				</div>
				
				<p><?php echo makeblog_shorten(get_the_excerpt(), 120); ?></p>
				
				<p class="read_more"><strong><a href="<?php the_permalink(); ?>">Read full story &rarr;</a></strong></p>
			
			</div>
	
			<div class="clear"></div>

			<?php endwhile; endif; ?>

		<h3 class="pull-right"><a href="http://blog.makezine.com/tag/maker-faire/">More Maker Faire News &rsaquo;</a></h3>
	
	</div>

</div>
