<?php

function get_story_with_ajax2() {
	function jetpackme_custom_related( $atts ) {
		 $posts_titles = array();
		 if ( class_exists( 'Jetpack_RelatedPosts' ) && method_exists( 'Jetpack_RelatedPosts', 'init_raw' ) ) {
			  $related = Jetpack_RelatedPosts::init_raw()
					->set_query_name( 'jetpackme-shortcode' ) // Optional, name can be anything.
					->get_for_post_id(
						 get_the_ID(),
						 array( 'size' => 4 )
					);
			  if ( $related ) {
				   $return = '<div class="jp-relatedposts">
									  <h3 class="jp-relatedposts-headline"><em>Related Stories from Make:</em></h3>
									  <div class="jp-relatedposts-items jp-relatedposts-items-visual jp-relatedposts-grid">';
					foreach ( $related as $result ) {
						 $related_post = get_post( $result['id'] );
						 $related_image = get_resized_remote_image_url(get_the_post_thumbnail_url($related_post), 173, 99);
						 if(!file_exists(get_the_post_thumbnail_url($related_post))) {
							 $related_image = get_template_directory_uri() . '/img/default-related-article.png';
						 }
						 $return .= '<div class="jp-relatedposts-post jp-relatedposts-post-thumbs" data-post-id="'.$related_post->ID.'" data-post-format="false">
						               <a href="'.get_permalink($related_post).'" class="jp-relatedposts-post-a">
						 					  <img class="jp-relatedposts-post-img" src="'.$related_image.'" alt="'.$related_post->post_title.'" />
											</a>
											<h4 class="jp-relatedposts-post-title">
											  <a class="jp-relatedposts-post-a" href="'.get_permalink($related_post).'" title="'.$related_post->post_title.'">'
											   .$related_post->post_title.
											' </a>
											</h4>
										</div>';
						 $posts_titles[] = $related_post->post_title;
					}
				   $return .= '   </div>
					           </div>';
			  }
		 }
		 // Return a list of post titles separated by commas.
		 return $return;
	}
	add_shortcode( 'jprel', 'jetpackme_custom_related' );
    add_shortcode('contextly_auto_sidebar', function($attrs) {
        if ( isset( $attrs[ 'id' ] ) ) {
            return "<div class='" . esc_attr( 'ctx-sidebar-container' ) . " " . esc_attr( 'ctx-sidebar-container--' . $attrs[ 'id' ] ) ."' sidebar-type='auto'></div>";
        } else {
            return '';
        }
    } );
    add_shortcode('contextly_sidebar', function($attrs) {
    // We will display sidebar only if we have id for this sidebar
        /*if ( isset( $attrs[ 'id' ] ) ) {
            return "<div class='" . esc_attr( 'ctx-sidebar-container' ) . " " . esc_attr( 'ctx-sidebar-container--' . $attrs[ 'id' ] ) ."'></div>";
        } else {
            return '';
        }*/
        //We disabled contextly but need to return blanks for old shortcodes that are hard coded in the post
    return '';
    } );
    $exclude = $_GET['excludeId'];
    $offset = $_GET['offset'];
    $number = $_GET['number'];
    $the_query = new WP_Query(array('offset' => $offset ,'post_status' => 'publish', 'showposts' => $number, 'post__not_in' => array($exclude)));
    if ( $the_query->have_posts()) : while ( $the_query->have_posts()) :  $the_query->the_post();
    // Set Ads.
    global $make;
    $make->ad_vars = new MakeAdVars;
    $make->ad_vars->getVars();
    ?>

    <div class="ad-unit">
        <div class="js-ad scroll-load" data-size='[[728,90],[970,90]]' data-size-map='[[[1000,0],[[728,90],[970,90]]],[[730,0],[[728,90]]]]' data-pos='"btf"' data-ad-vars=<?php print str_replace("&amp;", "&", json_encode($make->ad_vars, JSON_UNESCAPED_SLASHES)); ?>></div>
    </div>

    <article itemscope itemtype="https://schema.org/ScholarlyArticle">
      <div class="story-header" id="<?php echo get_the_ID(); ?>">
          <div class="container">
              <div class="row">
                  <div class="col-xs-12">
                      <div class="story-title">
                          <h1 itemprop="name"><?php echo get_the_title(); ?></h1>
                      </div>
                  </div>
              </div>
          </div>
          <?php
          //Hero Image
          $hero_id = get_field('hero_image');
          // Featured Image
          $args = array(
              'resize' => '1200,670',
              'strip' => 'all',
          );
          $url = wp_get_attachment_image(get_post_thumbnail_id(), 'story-thumb');
          $re = "/^(.*? src=\")(.*?)(\".*)$/m";
          preg_match_all($re, $url, $matches);
          $str = $matches[2][0];
          $photon = jetpack_photon_url($str, $args);

          if(get_field('hero_image')) { ?>
              <img class="story-hero-image" src="<?php echo $hero_id['url']; ?>" alt="Article Featured Image" />
              <div class="story-hero-image-l-xl"
                   style="background: url(<?php echo $hero_id['url']; ?>) no-repeat center center;"></div>
          <?php }
          elseif(strlen($url) == 0){ ?>
              <div class="hero-wrapper-clear"></div>
          <?php } else { ?>
              <img class="story-hero-image" src="<?php echo $photon; ?>" alt="Article Featured Image" />
              <div class="story-hero-image-l-xl"
                   style="background: url(<?php echo $photon; ?>) no-repeat center center;"></div>
          <?php } ?>
      </div>
      <meta itemprop="name" content="Make: Magazine">
      <div class="container">
          <div class="row content <?php echo get_the_ID(); ?>">
              <div class="col-sm-7 col-md-8">
                  <div <?php post_class(); ?>>
                      <?php
                      $url = str_replace(home_url(), 'https://makezine.com', get_permalink());
                      $title = get_the_title();
                      echo do_shortcode('[easy-social-share buttons="facebook,twitter,reddit,pinterest,love,more" morebutton="2" morebutton_icon="dots" counters=1 counter_pos="bottom" total_counter_pos="hidden" style="button" nospace="yes" fullwidth="yes" template="metro-retina" url="'.$url.'" text="'.$title.'"]');
                      ?>
                      <div class="article-body" itemprop="articleBody">
                        <?php the_content(); 
								   if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
										 echo do_shortcode( '[jprel]' );
									}?>
								 
                        <div id="nativobelow"></div>
                      </div>
                  </div>
                  <!--<div class="comments">
                      <button type="button" class="btn btn-info btn-lg"
                        data-toggle="modal" data-target="#disqus-modal"
                        onclick="reset('<?php //echo get_the_ID(); ?>',
                          '<?php //echo 'https://makezine.com'. str_replace(home_url(), '', get_permalink()); ?>',
                          '<?php //echo get_the_title(); ?>', 'en');">
                        Show comments
                      </button>
                  </div> -->
              </div>
              <aside class="col-sm-5 col-md-4 sidebar">
                  <div class="row author-info">
                      <?php
                      if (function_exists('coauthors_posts_links')) {
                          get_author_profile();
                      }else {
                          the_author_posts_link();
                      } ?>
                  </div>
                  <div class="date-time">
                      <?php
                      $post_time = get_post_time('U', true);
                      $post_time_contextley = get_post_time('Y/m/d g:i:s');
                      $time_now = date('U');
                      $difference = $time_now - $post_time;
                      if ( $difference > 86400 ) { ?>
                          <time itemprop="datePublished" datetime="<?php the_time('c'); ?>"><?php the_time('F j\, Y, g:i a T'); ?></time>
                      <?php } else { ?>
                          <time itemprop="datePublished" datetime="<?php the_time('c'); ?>"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></time>
                      <?php }
                      ?>
                  </div>
                  <?php
                  $posttags = get_the_tags();
                  if ($posttags) { ?>
                      <h3>Related Topics</h3>
                      <ul class="row post-tags">
                          <?php foreach($posttags as $tag) { ?>
                              <li><a href="<?php echo get_tag_link($tag); ?>"><?php echo '' . $tag->name . ' ' ?></a></li>
                          <?php } ?>
                      </ul>
                  <?php }
                  ?>
                  <div class="ad-unit">
                      <p id="ads-title">ADVERTISEMENT</p>
                      <div class='js-ad scroll-load' data-size='[[300,250]]' data-pos='"btf"' data-ad-vars=<?php print str_replace("&amp;", "&", json_encode($make->ad_vars, JSON_UNESCAPED_SLASHES)); ?>></div>
                  </div>
                  <div class="ad-unit">
                      <p id="ads-title">ADVERTISEMENT</p>
                      <div class='js-ad scroll-load' data-size='[[300,250],[300,600]]' data-size-map='[[[730,0],[[300,600]]],[[0,0],[[300,250]]]]' data-pos='"btf"' data-ad-vars=<?php print str_replace("&amp;", "&", json_encode($make->ad_vars, JSON_UNESCAPED_SLASHES)); ?>></div>
                  </div>
              </aside>
              <div class="essb_right_flag"></div>
          </div>
      </div>
      <!--
      <script>
      Contextly.ready('widgets', [
        {
          context: '.post-<?php the_ID() ?>',
          metadata: {
            title: '<?php echo $title;?>',
            pub_date: '<?php echo $post_time_contextley;?>',
            url: '<?php echo $url;?>',
          }
        }
      ]);
      </script>-->
    </article>
  <?php
  endwhile;
  else:
  endif;
  die();
}

// Everything below here can be removed?
function get_story_with_ajax() {
	function jetpackme_custom_related( $atts ) {
		 $posts_titles = array();
		 if ( class_exists( 'Jetpack_RelatedPosts' ) && method_exists( 'Jetpack_RelatedPosts', 'init_raw' ) ) {
			  $related = Jetpack_RelatedPosts::init_raw()
					->set_query_name( 'jetpackme-shortcode' ) // Optional, name can be anything.
					->get_for_post_id(
						 get_the_ID(),
						 array( 'size' => 4 )
					);
			  if ( $related ) {
				   $return = '<div id="jp-related-posts" class="jp-related-posts" style="display:block;">
									  <h3 class="jp-relatedposts-headline"><em>Related Stories from Make:</em></h3>
									  <div class="jp-relatedposts-items jp-relatedposts-items-visual jp-relatedposts-grid">';
					foreach ( $related as $result ) {
						 $related_post = get_post( $result['id'] );
						 error_log(print_r($related_post, TRUE));
						 $posts_titles[] = $related_post->post_title;
					}
				   $return = '   </div>
					           </div>';
			  }
		 }
		 // Return a list of post titles separated by commas.
		 return $return;
	}
	add_shortcode( 'jprel', 'jetpackme_custom_related' );
    
  add_shortcode('contextly_auto_sidebar', function($attrs) {
    if ( isset( $attrs[ 'id' ] ) ) {
      return "<div class='" . esc_attr( 'ctx-sidebar-container' ) . " " . esc_attr( 'ctx-sidebar-container--' . $attrs[ 'id' ] ) ."' sidebar-type='auto'></div>";
    } else {
      return '';
    }
  } );
  add_shortcode('contextly_sidebar', function($attrs) {
  // We will display sidebar only if we have id for this sidebar
      /*
    if ( isset( $attrs[ 'id' ] ) ) {
      return "<div class='" . esc_attr( 'ctx-sidebar-container' ) . " " . esc_attr( 'ctx-sidebar-container--' . $attrs[ 'id' ] ) ."'></div>";
    } else {
      return '';
    }*/
    //We disabled contextly but need to return blanks for old shortcodes that are hard coded in the post
    return '';
  } );
  $exclude = $_POST['excludeId'];
  $offset = $_POST['offset'];
  $number = $_POST['number'];
  $the_query = new WP_Query(array('offset' => $offset ,'post_status' => 'publish', 'showposts' => $number, 'post__not_in' => array($exclude)));
  if ( $the_query->have_posts()) : while ( $the_query->have_posts()) :  $the_query->the_post();
  // Set Ads.
  global $make;
  $make->ad_vars = new MakeAdVars;
  $make->ad_vars->getVars();
  ?>

  <div class="ad-unit">
      <div class="js-ad scroll-load" data-size='[[728,90],[970,90]]' data-size-map='[[[1000,0],[[728,90],[970,90]]],[[730,0],[[728,90]]]]' data-pos='"btf"' data-ad-vars=<?php print str_replace("&amp;", "&", json_encode($make->ad_vars, JSON_UNESCAPED_SLASHES)); ?>></div>
  </div>

  <article itemscope itemtype="https://schema.org/ScholarlyArticle">
    <div class="story-header" id="<?php echo get_the_ID(); ?>">
        <div class="container">
            <div class="story-title">
                <h1 itemprop="name"><?php echo get_the_title(); ?></h1>
            </div>
        </div>
        <?php
        //Hero Image
        $hero_id = get_field('hero_image');
        // Featured Image
        $args = array(
            'resize' => '1200,670',
            'strip' => 'all',
        );
        $url = wp_get_attachment_image(get_post_thumbnail_id(), 'story-thumb');
        $re = "/^(.*? src=\")(.*?)(\".*)$/m";
        preg_match_all($re, $url, $matches);
        $str = $matches[2][0];
        $photon = jetpack_photon_url($str, $args);

        if(get_field('hero_image')) { ?>
            <img class="story-hero-image" src="<?php echo $hero_id['url']; ?>" alt="Article Featured Image" />
            <div class="story-hero-image-l-xl"
                 style="background: url(<?php echo $hero_id['url']; ?>) no-repeat center center;"></div>
        <?php }
        elseif(strlen($url) == 0){ ?>
            <div class="hero-wrapper-clear"></div>
        <?php } else { ?>
            <img class="story-hero-image" src="<?php echo $photon; ?>" alt="Article Featured Image" />
            <div class="story-hero-image-l-xl"
                 style="background: url(<?php echo $photon; ?>) no-repeat center center;"></div>
        <?php } ?>
    </div>
    <meta itemprop="name" content="Make: Magazine">
    <div class="container">
        <div class="row content <?php echo get_the_ID(); ?>">
            <div class="col-sm-7 col-md-8">
                <div <?php post_class(); ?>>
                    <?php
                    $url = str_replace(home_url(), 'https://makezine.com', get_permalink());
                    $title = get_the_title();
                    echo do_shortcode('[easy-social-share buttons="facebook,twitter,reddit,pinterest,love,more" morebutton="2" morebutton_icon="dots" counters=1 counter_pos="bottom" total_counter_pos="hidden" style="button" nospace="yes" fullwidth="yes" template="metro-retina" url="'.$url.'" text="'.$title.'"]');
                    ?>
                    <div class="article-body" itemprop="articleBody">
                      <?php the_content(); ?>
                      <div id="nativobelow"></div>
                    </div>
                </div>
                <!-- remove disqus
                <div class="comments">
                    <button type="button" class="btn btn-info btn-lg"
                      data-toggle="modal" data-target="#disqus-modal"
                      onclick="reset('<?php /* echo get_the_ID(); */ ?>',
                        '<?php /* echo 'https://makezine.com'. str_replace(home_url(), '', get_permalink()); */?>',
                        '<?php /* echo get_the_title(); */?>', 'en');">
                      Show comments
                    </button>
                </div>-->
            </div>
            <aside class="col-sm-5 col-md-4 sidebar">
                <div class="row author-info">
                    <?php
                    if (function_exists('coauthors_posts_links')) {
                        get_author_profile();
                    }else {
                        the_author_posts_link();
                    } ?>
                </div>
                <div class="date-time">
                    <?php
                    $post_time = get_post_time('U', true, $post, true);
                    $post_time_contextley = get_post_time('Y/m/d g:i:s');
                    $time_now = date('U');
                    $difference = $time_now - $post_time;
                    if ( $difference > 86400 ) { ?>
                        <time itemprop="datePublished" datetime="<?php the_time('c'); ?>"><?php the_time('F j\, Y, g:i a T'); ?></time>
                    <?php } else { ?>
                        <time itemprop="datePublished" datetime="<?php the_time('c'); ?>"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></time>
                    <?php }
                    ?>
                </div>
                <?php
                $posttags = get_the_tags();
                if ($posttags) { ?>
                    <h3>Related Topics</h3>
                    <ul class="row post-tags">
                        <?php foreach($posttags as $tag) { ?>
                            <li><a href="<?php echo get_tag_link($tag); ?>"><?php echo '' . $tag->name . ' ' ?></a></li>
                        <?php } ?>
                    </ul>
                <?php }
                ?>
                <div class="ad-unit">
                    <p id="ads-title">ADVERTISEMENT</p>
                    <div class="js-ad scroll-load" data-size='[300,250]' data-pos='"btf"' data-ad-vars=<?php print str_replace("&amp;", "&", json_encode($make->ad_vars, JSON_UNESCAPED_SLASHES)); ?>></div>
                </div>
                <div class="ctx-siderail-wrapper"></div>
                <div class="ad-unit">
                    <p id="ads-title">ADVERTISEMENT</p>
                    <div class="js-ad scroll-load" data-size='[300,600]' data-pos='"btf"' data-ad-vars=<?php print str_replace("&amp;", "&", json_encode($make->ad_vars, JSON_UNESCAPED_SLASHES)); ?>></div>
                </div>
            </aside>
            <div class="essb_right_flag"></div>
        </div>
    </div>
    <!--<script>
    Contextly.ready('widgets', [
      {
        context: '.post-<?php the_ID() ?>',
        metadata: {
          title: '<?php echo $title;?>',
          pub_date: '<?php echo $post_time_contextley;?>',
          url: '<?php echo $url;?>',
        }
      }
    ]);
    </script>-->
  </article>
  <?php
  endwhile;
  else:
  endif;
  die();
}
add_action('wp_ajax_get_story_with_ajax', 'get_story_with_ajax');
add_action('wp_ajax_nopriv_get_story_with_ajax', 'get_story_with_ajax');

?>
