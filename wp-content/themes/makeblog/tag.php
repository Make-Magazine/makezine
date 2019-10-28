<?php
/** Adding enqueue here to prevent projects.js from loading on every page. */
wp_enqueue_script('make-projects', get_stylesheet_directory_uri() . '/version-2/js/projects.js', array('jquery'), false, true);
get_header('universal');
?>
<div class="ad-unit tag-page">
    <?php global $make;
    print $make->ads->ad_leaderboard;
    ?>
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

						<form class="sub-form mailchimp-signupTagArchive" action="https://make.us9.list-manage.com/subscribe/post?u=4e536d5744e71c0af50c0678c&amp;id=609e43360a" method="post" target="_blank">

							<div class="tag-nl-floats">
								<input value="SIGN UP" class="btn-red" type="submit">
								<div class="tag-nl-floats-r">
									<h5>Make: Newsletter</h5>
									<p>The latest news from Make:</p>
								</div>
							</div>
							<br />
							<div class="float-label-control">
								<input name="mce-EMAIL" class="form-control" placeholder="your email here" required type="email">
					         <span class="error-message hidden">Please enter a valid email</span>
							</div>
							<input src="<?php echo get_stylesheet_directory_uri() . '/img/Makey-tag-newlsetter.svg'; ?>" class="btn-makey-tag" type="image" alt="Makey tag page newsletter">
						</form>
						
						<!-- reCaptcha element -->
						<div id="recaptcha" class="g-recaptcha"
							data-sitekey="6Lf_-kEUAAAAAHtDfGBAleSvWSynALMcgI1hc_tP"
							data-callback="onRecaptchaValid"
							data-size="invisible">
						</div>

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