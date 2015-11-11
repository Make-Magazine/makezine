<?php
get_header('version-2');
global $make;
print $make->ads->ad_leaderboard_alt_btf;
print $make->ads->ad_leaderboard_alt_btf;
$tag_name = single_tag_title("", false);
$tag = get_queried_object();
$tag_slug = $tag->slug;
?>
<div class="container all-stories tags" data-slug="<?php echo $tagSlug; ?>">
	<div class="row">
		<h1 class="tag-title"><?php echo $tag_name; ?></h1>
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 all-post-wrapper">
			<ul class="post-list">
				<li class="row post">

					<?php tag_output($offset=0, $current_slug = $tag_slug); ?>
				</li>
			</ul>
			<?php
			global $make;
			print $make->ads->ad_leaderboard_alt;
			?>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 aside">
			<div class="sidebar-wrapper tags_sidebar">
				<?php dynamic_sidebar('sidebar_tags_page'); ?>
			</div>
		</div>

	</div>
</div>
<?php get_footer(); ?>