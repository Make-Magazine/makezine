<?php
/**
 * Category page template for projects custom post type.
 *
 */
require_once 'version-2/includes/Mobile_Detect.php';
$detect = new Mobile_Detect;
$post_per_page = 15;
$device = 'pc';
if ( $detect->isMobile() ) {
    $post_per_page = 5;
    $device = 'mobile';
}

if( $detect->isTablet() ){
    $post_per_page = 10;
    $device = 'tablet';
}

wp_enqueue_script( 'make-projects', get_stylesheet_directory_uri() . '/version-2/js/projects.js', array( 'jquery' ), false, true );
get_header('universal'); ?>

<div class="home-ads">
    <?php global $make; print $make->ads->ad_leaderboard; ?>
</div>

<div class="projects-cat <?php echo $device ?>">
    <div class="content container">
        <?php
        $current_cat_id = get_query_var('cat');
        if ($device == 'mobile') {
            get_template_part('version-2/includes/project_mobile_navigation');
        } else {
            get_template_part('version-2/includes/project_pc_tablet_navigation');
            get_template_part('version-2/includes/project_mobile_navigation');
        }
        ?>
        <div class="posts-list">
            <?php
            sorting_posts($current_cat_id);  //TODO Rename Function
            ?>
        </div>
    </div>

    <div class="home-ads bottom">
      <?php global $make; print $make->ads->ad_728x90; ?>
    </div>
    
    <div id="temp_post_list" style="display: none">

    </div>
</div>

<?php get_footer(); ?>
