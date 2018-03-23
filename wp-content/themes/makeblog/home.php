<?php
/**
 * Blog Page Template
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 *
 */
$pagename = get_query_var('pagename');
/** Adding enqueue here to prevent projects.js from loading on every page. */
wp_enqueue_script( 'make-projects', get_stylesheet_directory_uri() . '/version-2/js/projects.js', array( 'jquery' ), false, true );
get_header('universal'); ?>
<div class="ad-unit adds">
	<?php
	global $make;
	print $make->ads->ad_leaderboard;
	?>
</div>
<?php $current_user = wp_get_current_user();
if (user_can($current_user, 'administrator')) {
	$login_admin = 'admin_is_login';
}
?>

<div class="container all-stories <?php echo $login_admin ?>">
	<div class="row tags-header">
		<div class="col-xs-12 col-md-7">
			<h1 class="all-story">All Stories</h1>
		</div>
		<div class="col-xs-12 col-md-5">
			<div class="row">
				<div class="col-xs-12">

					<form class="sub-form whatcounts-signupTagArchive" action="https://secure.whatcounts.com/bin/listctrl" method="POST">
						<input type="hidden" name="slid" value="6B5869DC547D3D46B52F3516A785F101" /><!-- Makezine -->
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
								<h5>Make: Newsletter</h5>
								<p>The latest news from Make:</p>
							</div>
						</div>
						<br />
						<div id="recapcha-tag" class="g-recaptcha" data-size="invisible"></div>
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
							<?php story_pulling($offset = 0); ?>
						</div>
					</li>
				</ul>
			</div>
			<div class="col-md-3 col-sm-5 col-xs-12 aside">
				<div class="sidebar-wrapper blog">
					<?php dynamic_sidebar('sidebar_blog_page'); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
