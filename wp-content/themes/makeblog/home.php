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

<?php if(!isset($_COOKIE['cookielawinfo-checkbox-non-necessary']) || $_COOKIE['cookielawinfo-checkbox-non-necessary'] == "yes" ) { ?>
	<div class="ad-unit adds">
		<?php
		global $make;
		print $make->ads->ad_leaderboard;
		?>
	</div>
<?php } ?>

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

					&nbsp;

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
