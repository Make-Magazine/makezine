<?php
/**
 * Home Page Template
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 *
 */
$pagename = get_query_var( 'pagename' );

get_header( 'version-2' ); ?>
<?php
global $make;
//var_dump($make->ads);
print $make->ads->ad_leaderboard_alt;
print $make->ads->ad_leaderboard_alt;
print $make->ads->ad_leaderboard_alt;
$current_user = wp_get_current_user();
if (user_can( $current_user, 'administrator' )) {
	$login_admin = 'admin_is_login';
}
?>

<div class="container all-stories <?php echo $login_admin ?>">
	<div class="row">
		<h1 class="all-story">All Stories</h1>

		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 all-post-wrapper">
			<ul class="post-list">
				<li class="row post">
					<?php blog_output( $offset = 0 ); ?>
				</li>
			</ul>
			<?php
			global $make;
			print $make->ads->ad_leaderboard_alt;
			?>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 aside">
			<div class="sidebar-wrapper blog">
<!--				--><?php
//				global $make;
//				print $make->ads->ad_300x250;
//				print $make->ads->ad_300x250;
//				?>
				<?php dynamic_sidebar( 'sidebar_blog_page' ); ?>
			</div>
		</div>

	</div>
</div>

<?php get_footer(); ?>
