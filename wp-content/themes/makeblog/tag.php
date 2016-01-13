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
        <div class="row">
            <h1 class="tag-title"><?php echo $tag_name; ?></h1>

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