<?php
/**
 * Instagram/Twitter class
 */
class Make_Instagram {

  /**
   * THE CONSTRUCT.
   *
   * @return  void
   */
  public function __construct() {

    add_action( 'wp_enqueue_scripts', array( $this, 'load_resources' ), 30 );

  }

  /**
   * Let's add all of our resouces to make our magic happen.
   */
  public function load_resources() {

  }

  /**
   * Load the Sprout data feed.
   *
   * @return OBJECT Instagram response
   */
  public function load_data() {

    $base_url = 'https://api.instagram.com/v1/tags/sproutbyhp/media/recent';
    $params = array(
      'access_token' => '227901753.5b9e1e6.7b46b974b69e434e9d3322f1e4463894',
      'count' => 6
    );

    // Build the URL
    $url = add_query_arg( $params, $base_url );
    // Request the data
    $response = wp_remote_get( $url );
    $json = wp_remote_retrieve_body( $response );
    
    // Parse the JSON
    $data = json_decode( $json );

    // Send it off...
    return $data->data;
  }

        public function getFirstImage() {
          $ps = $this->load_data(); 

          // make sure $output exists, otherwise we may get an error in local environment
    if(!isset($output) || !is_string($output)) {
             $output = "";
    }

          $img = $ps[0];
          
          $output .= "<li><a href=\"" . esc_url( $img->link ) . "\" target=\"_blank\" class=\"instagram-link\">"
                  .  "  <img src=\"" . esc_url( $img->images->standard_resolution->url ) . "\" height=\"182\" width=\"180\" alt=\"image description\">"    
                  .  "</a></li>";
       
          return $output;
        }

  public function show_images() {
    // TODO:  This whole function is a bit of a mess of entangled php and html.
    //      Would do a lot cleaner with some sort of templating engine.

    $ps  = $this->load_data('https://api.instagram.com/v1/tags/sproutbyhp/media/recent');
                $ps2 = $this->load_data('https://api.instagram.com/v1/tags/gomakethings/media/recent');
                                                                             
                $ps = array_merge($ps,$ps2);
                
                //sort by created
                usort($ps, array($this, "cmp"));

    // make sure $output exists, otherwise we may get an error in local environment
    if(!isset($output) || !is_string($output)) {
      $output = "";
    }


    $images_per_page = 6;
        array_splice($ps, $images_per_page);
    $num_images = count($ps);
        $pages = array_chunk($ps, $images_per_page);
        $num_pages = count($pages);
    ?>
    <?php
    // Twitter post
    $output ="<div class=\"twitter-holder\"><div class=\"container\"><div class=\"row\"><div class=\"col-xs-12\"><div class=\"social-holder twitter\"><div class=\"title\"><h1><a href=\"https://twitter.com/hashtag/sproutbyhp\" target=\"_blank\" alt=\"Twitter\">#sproutbyhp</a>, <a href=\"https://twitter.com/hashtag/gomakethings\" target=\"_blank\" alt=\"Twitter\">#gomakethings</a></h1></div></div><div id=\"recent-twitter\"></div></div></div></div></div>";
    return $output;
  }

}

$instagram = new Make_Instagram();

function make_show_images() {
  $instagram = new Make_Instagram();
  return $instagram->show_images();
}

add_shortcode( 'show_twitter_instagram', 'make_show_images' );