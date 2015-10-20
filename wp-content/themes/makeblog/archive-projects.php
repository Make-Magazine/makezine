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

get_header('version-2'); ?>
<div class="header-ad">
	<li class="post col-lg-4 col-md-4 col-sm-6 col-xs-12 own_ads">
        <div class="own">
            <div class="home-ads">
                <?php print $make->ads->leaderboard; ?>
                <!-- <div id="div-gpt-ad-664089004995786621-1">
                <script type="text/javascript">
                googletag.cmd.push(function(){googletag.display("div-gpt-ad-664089004995786621-1")});
                </script>
                </div> -->
            </div>
        </div>
	</li>
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
        <div class="posts-list container">
            <?php
            sorting_posts($current_cat_id);  //TODO Rename Function
            ?>
        </div>
    </div>
    <div id="temp_post_list" style="display: none">

    </div>
</div>

<?php get_footer(); ?>
