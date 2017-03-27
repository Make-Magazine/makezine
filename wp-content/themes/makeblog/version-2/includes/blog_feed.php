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
      $args  = array(
        'post_type'      => 'products',
        'posts_per_page' => 5,
        'post_status'    => 'publish',
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
        <i class="fa fa-newspaper-o feed-icon"></i>The Latest on <?php echo $tagName->name; ?></a>
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
            'quality' => get_photon_img_quality(),
            'strip' => 'all',
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
        <a class="all-projects-title" href="<?php echo site_url( '/projects', 'http' ); ?>">See all Projects</a>
      <?php } ?>
      <?php if (!empty($allReviews)){ ?>
        <a class="all-projects-title" href="<?php echo site_url( '/tag/guides', 'http' ); ?>">See all Reviews</a>
      <?php } ?>
      <?php if (!empty($allBuilders)){ ?>
        <a class="all-projects-title" href="<?php echo site_url( '/tag/skill-builder', 'http' ); ?>">See all Skill Builders</a>
      <?php } ?>
      <?php if (!empty($allPosts)){ ?>
        <a class="all-projects-title" href="<?php echo site_url( '/tag/' . $tag_slug .'', 'http' ); ?>">See all on <?php echo $tagName->name; ?></a>
      <?php } ?>
    </ul>
  </div>
<?php }