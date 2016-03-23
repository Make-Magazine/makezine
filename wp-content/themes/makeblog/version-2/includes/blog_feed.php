<?php
function blog_feeds_output( $type = '', $tag_slug = '' ) {
  switch ( $type ) {
    case 'Project':
      $args  = array(
        'post_type'      => 'projects',
        'posts_per_page' => 5,
        'post_status'    => 'publish',
      );
      $title = 'Latest Projects';
      $allProjects = 'See All Projects';
      break;
    case 'Reviews':
      $meta_query = array(
        'relation' => 'AND',
        array(
          'key'     => 'story_type',
          'value'   => 'Reviews',
          'compare' => '=',
        ),
      );
      $args       = array(
        'post_type'      => 'post',
        'posts_per_page' => 5,
        'post_status'    => 'publish',
        'meta_query'     => $meta_query,
      );
      $title      = 'Latest Reviews';
      $allReviews = 'See All Reviews';
      break;
    case 'Builders':
      $meta_query = array(
        'relation' => 'AND',
        array(
          'key'     => 'story_type',
          'value'   => 'Skill Builders',
          'compare' => '=',
        ),
      );
      $args       = array(
        'post_type'      => 'post',
        'posts_per_page' => 5,
        'post_status'    => 'publish',
        'meta_query'     => $meta_query,
      );
      $title      = 'Latest Skill Builders';
      $allBuilders = 'See All Skill Builders';
      break;
    case 'Post':
      $args       = array(
        'post_type'      => array( 'post', 'projects' ),
        'posts_per_page' => 5,
        'post_status'    => 'publish',
        'tag'						 => $tag_slug,
      );
      $title      = 'Latest Posts';
      $allPosts = 'See All Posts';
      break;
    default:
      $args  = array(
        'post_type'      => 'post',
        'posts_per_page' => 5,
        'post_status'    => 'publish',
      );
      $title = 'Latest Posts';
  }
  $tagName = get_term_by('slug', $tag_slug, 'post_tag');
  $query = new WP_Query( $args ); ?>
  <div class="posts-feeds-wrapper">
    <h3 class="feed-title">
      <?php if ( $type == 'Project' ) { ?>
        <a href="<?php echo get_home_url() . '/projects' ?>" class="full-feed-title-link"><i
            class="fa fa-newspaper-o feed-icon"></i><?php echo $title ?></a>
      <?php } else if ( $type == 'Post' ) { ?>
        <i class="fa fa-newspaper-o feed-icon"></i>Latest <?php echo $tagName->name; ?> Stories</a>
      <?php } else { ?>
        <i class="fa fa-newspaper-o feed-icon"></i> <?php echo $title;
      } ?>
    </h3>
    <ul class="posts-feeds">
      <?php while ( $query->have_posts() )  :
        $query->the_post(); ?>
        <li class="post-feed">
          <a href="<?php the_permalink(); ?>" class="full-link"></a>
          <?php
          $post_id = get_the_ID();
          $arg     = array(
            'resize' => '79, 50',
          );
          $url     = wp_get_attachment_image( get_post_thumbnail_id( $post_id ), 'project-thumb' );
          $re      = "/^(.*? src=\")(.*?)(\".*)$/m";
          preg_match_all( $re, $url, $matches );
          $str    = $matches[2][0];
          $photon = jetpack_photon_url( $str, $arg );
          ?>
          <!-- <div class="post-thumbnail"><img src="--><?php //echo $photon ?><!--" alt="thumbnail"></div>-->
          <div class="title"><img src="<?php echo $photon ?>" alt="thumbnail"><p class="p-title"><?php the_title(); ?></p></div>
        </li>
      <?php endwhile; ?>
      <?php if (!empty($allProjects)){ ?>
        <h3 class="all-projects-title"><a href="<?php echo site_url( '/projects', 'http' ); ?>">See All Projects</a></h3>
      <?php } ?>
      <?php if (!empty($allReviews)){ ?>
        <h3 class="all-projects-title"><a href="<?php echo site_url( '/tag/reviews', 'http' ); ?>">See All Reviews</a></h3>
      <?php } ?>
      <?php if (!empty($allBuilders)){ ?>
        <h3 class="all-projects-title"><a href="<?php echo site_url( '/tag/skill-builder', 'http' ); ?>">See All Skill Builders</a></h3>
      <?php } ?>
      <?php if (!empty($allPosts)){ ?>
        <h3 class="all-projects-title"><a href="<?php echo site_url( '/tag/' . $tag_slug .'', 'http' ); ?>">See All <?php echo $tagName->name; ?> Stories</a></h3>
      <?php } ?>
    </ul>
  </div>
<?php }