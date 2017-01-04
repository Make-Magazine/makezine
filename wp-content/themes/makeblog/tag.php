<?php
/** Adding enqueue here to prevent projects.js from loading on every page. */
wp_enqueue_script( 'make-projects', get_stylesheet_directory_uri() . '/version-2/js/projects.js', array( 'jquery' ), false, true );
get_header('version-2'); ?>
	<div class="ad-unit tag-page">
		<?php global $make;
		print  $make->ads->ad_leaderboard; ?>
	</div>
<?php

$tag_name = single_tag_title("", false);
$tag = get_queried_object();
$tag_slug = $tag->slug;
$current_user = wp_get_current_user();
if (user_can($current_user, 'administrator')) {
	$login_admin = 'admin_is_login';
}
?>
	<div class="container all-stories tags <?php echo $login_admin ?>" data-slug="<?php echo $tag_slug; ?>">
		<div class="row tags-header">
			<div class="col-xs-12 col-md-7">
				<h1 class="tag-title"><?php echo $tag_name; ?></h1>
				<?php if (!empty('tag_description')) {
					echo '<h2>' . tag_description() . '</h2>';
				} ?>
			</div>
			<div class="col-xs-12 col-md-5">
				<div class="row">
					<div class="col-xs-12">

						<form class="sub-form whatcounts-signupTagArchive" action="http://whatcounts.com/bin/listctrl" method="POST">
							<?php
							if ( $tag_slug == 'maker-pro' ) {
							  echo '<input type="hidden" name="slid_1" value="6B5869DC547D3D467B33E192ADD9BE4B" /><!-- Maker Pro Newsletter -->';
							} elseif ( $tag_slug == 'education' ) {
							  echo '<input type="hidden" name="slid_1" value="6B5869DC547D3D4637EA6E33C6C8170D" /><!-- Education Newsletter -->';
							} else {
								echo '<input type="hidden" name="slid_1" value="6B5869DC547D3D46B52F3516A785F101" /><!-- Make: Newsletter -->';
							} ?>
	            <input type="hidden" name="slid_2" value="6B5869DC547D3D46941051CC68679543" /><!-- Maker Media Newsletter -->
	            <input type="hidden" name="multiadd" value="1" />
							<input type="hidden" name="cmd" value="subscribe" />
							<input type="hidden" name="custom_source" value="tag page" />
							<input type="hidden" name="custom_incentive" value="none" />
							<input type="hidden" name="custom_url" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
							<input type="hidden" id="format_mime" name="format" value="mime" />
							<input type="hidden" name="goto" value="" />
							<input type="hidden" name="custom_host" value="<?php echo $_SERVER["HTTP_HOST"]; ?>" />
							<input type="hidden" name="errors_to" value="" />

							<div class="tag-nl-floats">
								<input value="SIGN UP" class="btn-red" type="submit">
								<div class="tag-nl-floats-r">
									<?php
									if ( $tag_slug == 'maker-pro' ) {
									  echo '<h5>Maker Pro Newsletter</h5>
													<p>Weekly news on startups, incubators + innovators</p>';
									} elseif ( $tag_slug == 'education' ) {
									  echo '<h5>Education Newsletter</h5>
													<p>Regular news from the world of educators and lifelong learners</p>';
									} else {
									  echo '<h5>Maker: Newsletter</h5>
													<p>The latest news from Make:</p>';
									} ?>
								</div>
							</div>
							<br />
							<div class="float-label-control">
								<input name="email" class="form-control" placeholder="your email here" required type="email">
							</div>
							<input src="<?php echo get_stylesheet_directory_uri() . '/img/Makey-tag-newlsetter.svg'; ?>" class="btn-makey-tag" type="image" alt="Makey tag page newsletter">
						</form>

					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="wrapper">
				<div class="col-md-9 col-sm-7 col-xs-12 all-post-wrapper">
					<ul class="post-list">
						<li class="row">
							<div class="post">
								<?php tags_pulling($offset = 0, $current_slug = $tag_slug); ?>
							</div>
						</li>
					</ul>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-12 aside">
					<div class="sidebar-wrapper tags_sidebar sidebar">
						<?php dynamic_sidebar('sidebar_tags_page'); ?>
					</div>
				</div>
			</div>

		</div>
	</div>

<?php get_footer(); ?>