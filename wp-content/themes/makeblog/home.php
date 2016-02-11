<?php
/**
 * Home Page Template
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 *
 */
$pagename = get_query_var('pagename');
/** Adding enqueue here to prevent projects.js from loading on every page. */
wp_enqueue_script( 'make-projects', get_stylesheet_directory_uri() . '/version-2/js/projects.js', array( 'jquery', 'lazyload' ), false, true );
get_header('version-2'); ?>
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
	<div class="row">
		<h1 class="all-story">All Stories</h1>

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
