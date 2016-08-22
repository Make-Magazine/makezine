<?php
/**
 * Template Name: Project Page
 */
get_header('version-2'); ?>

<div class="all-projects">
    <div class="content">
        <div class="project-navigation">
            <div class="cat-list-wrapp">
                <div class="title-wrapp">
                    <h1><?php the_title(); ?></h1>
                </div>
                <div class="cat-nav-wrapp">
                    <ul class="cat_list">
                        <?php
                        $args = array(
                            'post_type' => 'projects',
                            'parent' => '0',
                        );
                        $categories = get_categories($args);
                        foreach ($categories as $category) {
                            $cat_name = $category->cat_name;
                            $cat_link = get_category_link($category->cat_ID);
                            ?>
                            <li>
                                <a href="<?php echo get_category_link($category->term_id) . '' ?>"
                                   title="<?php echo 'View all posts in ' . $cat_name; ?>"><?php echo $cat_name ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div id="flist" class="filter-list">
                <div class="filter-item">
                    <ul>
                        <li class="difficulty">
                            <p>difficulty</p>
                            <ul class="diff-item">
                                <li><span class="all-lvl fa fa-wrench" title="For All Levels"></span></li>
                                <li><span class="moderate fa fa-wrench"
                                          title="Moderate Difficulty. But You Can Totally Make This"></span></li>
                                <li><span class="spec-skill fa fa-wrench"
                                          title="Calls For Some Specific Skills...Nothing You Can't Learn!"></span></li>
                            </ul>
                        </li>
                        <li class="duration">
                            <p>duration</p>
                            <ul class="duration-item">
                                <li><span class="1-3h fa fa-clock-o" title="Build time 1-3 hours"></span></li>
                                <li><span class="3-8h fa fa-clock-o" title="Build time 3-8 hours"></span></li>
                                <li><span class="8-16h fa fa-clock-o" title="Build time 8-16 hours (A Weekend)"></span>
                                </li>
                                <li><span class="16h fa fa-clock-o" title="Build time >16 hours"></span></li>
                            </ul>
                        </li>
                    </ul>
                   
                </div>
            </div>
        </div>
        <div class="posts-list">
            <ul class="selected-posts-list list-unstyled">
                <?php
                $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                $args = array(
                    'post_type' => 'projects',
                    'posts_per_page' => '15',
                    'paged' => $paged,
                );
                $query = new WP_Query($args);
                $counter = 0;
                if ($query->have_posts()) {
                    while ($query->have_posts())  : $query->the_post(); ?>
                        <li class="post <?php if ($counter == 5) {echo 'before-ads'; }?>">
                            <a href="<?php the_permalink() ?>">
                                <?php

                                the_post_thumbnail(array(370, 240));
                                ?>
                            </a>
                            <?php
                            $post_duration = get_post_meta($post->ID, 'project_duration');
                            $post_difficulty = get_post_meta($post->ID, 'project_difficulty');
                            $post_video = get_post_meta($post->ID, 'ga_youtube_embed');
                            $post_flag = get_post_meta($post->ID, 'flag_taxonomy');
                            ?>
                            <div class="filter-display-wrapper">
                                <div class="red-box-category">
                                    <?php
                                    if ($post_flag[0] != '') {
                                        $red_cat_name = get_cat_name(intval($post_flag[0]));
                                    } else {
                                        $post_categories = get_the_category();
                                        foreach ($post_categories as $post_category) {
                                            if ($post_category->category_parent == 0) {
                                                $parent_cat[] = $post_category->name;
                                            }
                                        }
                                        $parent_cat_length = count($parent_cat);
                                        $parent_cat_length--;
                                        $random_cat_number = rand(0, $parent_cat_length);
                                        $red_cat_name = $parent_cat[$random_cat_number];
                                    }
                                    ?>
                                    <p><span class="fa fa-wrench"></span><?php echo $red_cat_name; ?></p>
                                    <?php
                                    if ($post_video[0] != 0) { 
                                        $output .= '<div class="videoblock"><a href="';
                                        $link = get_the_permalink($post->ID);
                                        $output .= $link;
                                        $output .= '">';
                                        $output .= '';
                                        $output .= '<span class="video fa fa-video-camera"></span>';
                                        $output .= '</a></div>';
                                        echo $output;
                                    } ?>
                                </div>

                                <?php
                                switch ($post_difficulty[0]) {
                                    case 'Easy':
                                        $duration_counter = 1;
                                        break;
                                    case 'Moderate':
                                        $duration_counter = 2;
                                        break;
                                    case 'Hard':
                                        $duration_counter = 3;
                                        break;
                                    default:
                                        $duration_counter = 1;
                                }
                                switch ($post_duration[0]) {
                                    case '1-3 Hours?':
                                        $difficulty_counter = 1;
                                        break;
                                    case '3-8 Hours?':
                                        $difficulty_counter = 2;
                                        break;
                                    case '8-16 Hours?':
                                        $difficulty_counter = 3;
                                        break;
                                    case '>16 Hours':
                                        $difficulty_counter = 4;
                                        break;
                                    default:
                                        $difficulty_counter = 1;
                                }
                                ?>

                                <div class="difficulty-lvl">
                                    <?php while ($difficulty_counter > 0) { ?>
                                        <span class="difficulty-level-image fa fa-wrench"></span>
                                        <?php
                                        $difficulty_counter--;
                                    }
                                    ?>
                                </div>
                                <div class="duration-lvl">
                                    <?php while ($duration_counter > 0) { ?>
                                        <span class="duration-level-image fa fa-clock-o"></span>
                                        <?php
                                        $duration_counter--;
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php the_excerpt(); ?>

                            <h2>
                                <a href="<?php the_permalink() ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                        </li>
                        <?php
                        var_dump($counter);
                        $counter++;
                    endwhile;
                    do_action('custom_page_hook', $query);
                    wp_reset_query();
                } else {
                    echo 'Darn: we haven\'t created any projects like this for all projets (yet). But keep browsing!';
                }
                ?>

            </ul>
        </div>
    </div>
    
    <div class="home-ads bottom">
      <?php global $make; print $make->ads->ad_728x90; ?>
    </div>

    <div id="temp_post_list" style="display: none">

    </div>
</div>

<?php get_footer(); ?>
