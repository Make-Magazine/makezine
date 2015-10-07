<?php
$current_category = get_query_var('category_name');      
$type = (isset($current_category)) ? sanitize_title($current_category) : '';
if ($type != '') { ?>
    <div class="project-navigation">
        <div class="project-navigation-wrapp">
        <?php
        $current_cat_id = get_query_var('cat');
        $current_cat_name = get_cat_name($current_cat_id);
        $parent_cat = get_queried_object();
        $parent_cat = $parent_cat->parent;
        $parent_name = get_cat_name($parent_cat);
        $args = array(
            'post_type' => 'projects',
            'parent' => $current_cat_id,
            'exclude' => array(25624, 12, 8, 24794, 13, 1),
        );
        $categories = get_categories($args);
        $alignment_counter = count($categories);
        $space_counter = 0;
        $counter = 0;
        ?>
        <div class="cat-list-wrapp row">
            <div class="title-wrapp col-lg-7 col-md-7 col-sm-4">
                <div class="breadcrump">
                    <a href="<?php echo get_home_url() . '/projects' ?>">All projects</a> <?php
                    if ($parent_cat != 0) {
                        echo '/'; ?>
                        <a href="<?php echo get_category_link($parent_cat) . '?post_type=projects' ?>">
                            <?php echo $parent_name ?>
                        </a>
                    <?php } ?>
                </div>
                <h1 data-value="<?php echo $current_cat_id ?>"><?php single_cat_title(); ?></h1>
            </div>
            <?php if ( $alignment_counter > 0 ) { ?>
            <div class="cat-nav-wrapp col-lg-5 col-md-5 col-sm-8">
                <ul class="cat_list row">
                    <?php
                    foreach ($categories as $category) {
                        $cat_name = $category->cat_name;
                        $cat_link = get_category_link($category->cat_ID);
                        if ($counter == 0) {
                            echo '<li class="row"> <ul>';
                        }
                        $counter++;
                        $space_counter++;
                        ?>
                        <li class="col-sm-4 col-lg-4 col-md-4">
                            <a href="<?php echo get_category_link($category->term_id) . '?post_type=projects' ?>"><?php echo $cat_name ?></a>
                        </li>
                        <?php
                        if ($space_counter == 1) {
                            if (($alignment_counter - 1) % 3 == 0) { ?>
                                <li class="col-sm-4 col-lg-4 col-md-4">
                                </li>
                                <li class="col-sm-4 col-lg-4 col-md-4">
                                </li>
                                <?php
                                $counter = 0;
                            }

                        }
                        if ($space_counter == 2) {
                            if (($alignment_counter - 2) % 3 == 0) { ?>
                                <li class="col-sm-4 col-lg-4 col-md-4">
                                </li>
                                <?php
                                $counter = 0;
                            }
                        }

                        if ($counter == 3) {
                            $counter = 0;
                        }
                        if ($counter == 0) {
                            echo '</ul> </li>';
                        }
                        ?>
                    <?php }
                    if ($counter != 0) {
                        echo '</ul> </li>';
                    }
                    ?>
                </ul>
            </div>
        <?php } ?>
        </div>
        <?php filter_list_output(); ?>
        </div>
    </div>

<?php } else { ?>

    <div class="project-navigation">
    <div class="project-navigation-wrapp">
        <div class="cat-list-wrapp row">
            <div class="title-wrapp col-lg-7 col-md-7 col-sm-4">
                <h1>All projects</h1>
            </div>
            <div class="cat-nav-wrapp col-lg-5 col-md-5 col-sm-8">
                <ul class="cat_list row">
                    <?php
                    $args = array(
                        'post_type' => 'projects',
                        'parent' => '0',
                        'exclude' => array(25624, 12, 8, 24794, 13, 1),
                    );
                    $categories = get_categories($args);
                    $alignment_counter = count($categories);
                    $space_counter = 0;
                    $counter = 0;
                    foreach ($categories as $category) {
                        $cat_name = $category->cat_name;
                        $cat_link = get_category_link($category->cat_ID);
                        if ($counter == 0) {
                            echo '<li class="row"> <ul>';
                        }
                        $counter++;
                        $space_counter++;
                        ?>
                        <li class="col-sm-4 col-lg-4 col-md-4">
                            <a href="<?php echo get_category_link($category->term_id) . '?post_type=projects' ?>">
                                <?php echo $cat_name ?>
                            </a>
                        </li>

                        <?php
                        if ($space_counter == 1) {
                            if (($alignment_counter - 1) % 3 == 0) { ?>
                                <li class="col-sm-4 col-lg-4 col-md-4">
                                </li>
                                <li class="col-sm-4 col-lg-4 col-md-4">
                                </li>
                                <?php
                                $counter = 0;
                            }

                        }
                        if ($space_counter == 2) {
                            if (($alignment_counter - 2) % 3 == 0) { ?>
                                <li class="col-sm-4 col-lg-4 col-md-4">
                                </li>
                                <?php
                                $counter = 0;
                            }
                        }

                        if ($counter == 3) {
                            $counter = 0;
                        }
                        if ($counter == 0) {
                            echo '</ul> </li>';
                        }
                        ?>
                    <?php }
                    if ($counter != 0) {
                        echo '</ul> </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php filter_list_output(); ?>
    </div>
    </div>
<?php } ?>