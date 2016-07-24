<?php 

/*
Template Name: Make: Projects
*/

get_header('version-2'); ?>
    <div class="clear"></div>
    <div class="sand">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="content">
              <div class="page-header">
                <h1 style="border:0px;">Make: Projects</h1>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-4">
                  <?php
                  $args = array(
                    'tax_query' => array(
                      array(
                        'taxonomy' => 'flags',
                        'field' => 'slug',
                        'terms' => 'featured-guide'
                      )
                    ),
                    'post_type' => 'projects',
                    'post_status' => 'publish',
                    'posts_per_page' => 1,
                    'ignore_sticky_posts' => 1,
                  );
                  $proj_query = new WP_Query($args);

                  while ( $proj_query->have_posts() ) : $proj_query->the_post();
                    $url = get_post_custom_values('Image');
                    echo '<img src="' . wpcom_vip_get_resized_remote_image_url( $url[0], 293, 200 ) . '" alt="Image" />';
                    echo '<div class="overlay"><h4><a class="red" href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
                    $description = get_post_custom_values('Description');
                    echo $description[0];
                    echo '</div>';
                  endwhile;
                  ?>

                </div>
                <div class="col-xs-12 col-sm-8">
                  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                  <?php endwhile; else: endif; ?>
                </div>
              </div>
              <?php echo make_projects_grid( 'Featured Projects', 4, 'flags', 'featured-guide' ); ?>
              <div class="mag">
                <div class="page-header">
                  <h3>From MAKE magazine</h3>
                </div>
                <div class="row">
                    <?php
                    $args = array(
                      'tax_query' => array(
                        array(
                          'taxonomy' => 'flags',
                          'field' => 'slug',
                          'terms' => 'from-make-magazine'
                        )
                      ),
                      'post_type' => 'projects',
                      'post_status' => 'publish',
                      'posts_per_page' => 2,
                      'ignore_sticky_posts' => 1,
                    );
                    $proj_query = new WP_Query($args);

                    while ( $proj_query->have_posts() ) : $proj_query->the_post();
                      echo '<div class="col-md-4">';
                      $url = get_post_custom_values('Image');
                      echo '<img src="' . wpcom_vip_get_resized_remote_image_url( $url[0], 293, 200 ) . '" alt="Image" />';
                      echo '<div class="overlay"><h4><a class="red" href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
                      $description = get_post_custom_values('Description');
                      echo $description[0];
                      echo '</div></div>';
                    endwhile;
                    ?>
                    <div class="ad" style="margin-right:0px; text-align:right;">

                      <?php global $make; print $make->ads->ad_300x250_atf; ?>

                    </div>
                </div>
              </div><!--From the Magazine-->
              <?php echo make_projects_grid( 'Electronics', 4, 'category', 'electronics' ); ?>
              <?php echo make_projects_grid( 'Workshop', 4, 'category', 'workshop' ); ?>
              <?php echo make_projects_grid( 'Craft', 4, 'category', 'paper-crafts' ); ?>
              <?php echo make_projects_grid( 'Science', 4, 'category', 'science' ); ?>
              <?php echo make_projects_grid( 'Electronics', 4, 'category', 'electronics' ); ?>
              <?php echo make_projects_grid( 'Getting Started', 4, 'difficulty', 'easy' ); ?>
            </div>
          </div>
        </div>
      <?php get_footer(); ?>