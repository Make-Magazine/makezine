<?php
// Infinite scroll story thumbnail API
function get_story_thumbnail_with_ajax() {
    $exclude = $_POST && $_POST['excludeId'];
    $offset = $_POST && $_POST['offset'];
    $story = '';
    $story .='<div class="row more-thumbnails">';
    $story .='<div class="posts-navigator col-lg-2 col-sm-2 col-xs-2">';
    $the_query = new WP_Query(array('offset' => $offset ,'post_status' => 'publish','showposts' => '9', 'post__not_in' => array($exclude)));
    if ( $the_query->have_posts()) : while ( $the_query->have_posts()) :  $the_query->the_post();  
        $story .='<div class="latest-story">';
        $story .= '<a href="';
        $story .= get_the_permalink();
        $story .= '"class="pull-left">';
        $args = array(
            'resize' => '370,240',
        );
        $url = wp_get_attachment_image(get_post_thumbnail_id(), 'project-thumb');
        $re = "/^(.*? src=\")(.*?)(\".*)$/m";
        preg_match_all($re, $url, $matches);
        $str = $matches[2][0];
        $photon = jetpack_photon_url($str, $args);
        if(strlen($url) == 0){
            $photon = catch_first_image_story();
            $photon = jetpack_photon_url( $photon, $args );
        }
        $story .= '<div class="thumbnail-image" style="background: url(';
        $story .= $photon;
        $story .= ')no-repeat center center;"></div>';
        $story .= '<h3>';
        $story .= get_the_title();
        $story .='</h3></a>';
        $story .= '</div>';
    endwhile;
    else:
        $story .= '<p>';
        $story .= 'Sorry, no posts matched your criteria.';
        $story .= '</p>';
    endif;
    $story .= '</div>';
    $story .= '</div>';
    $story .= '<div class="row infinity"></div>';
    echo $story;
    die();
}
add_action('wp_ajax_get_story_thumbnail_with_ajax', 'get_story_thumbnail_with_ajax');
add_action('wp_ajax_nopriv_get_story_thumbnail_with_ajax', 'get_story_thumbnail_with_ajax');

function get_story_thumbnail_with_ajax2() {
    $exclude = $_GET && $_GET['excludeId'];
    $offset = $_GET && $_GET['offset'];
    $story = '';
    $story .='<div class="row more-thumbnails">';
    $story .='<div class="posts-navigator col-lg-2 col-sm-2 col-xs-2">';
    $the_query = new WP_Query(array('offset' => $offset ,'post_status' => 'publish','showposts' => '9', 'post__not_in' => array($exclude)));
    if ( $the_query->have_posts()) : while ( $the_query->have_posts()) :  $the_query->the_post();  
        $story .='<div class="latest-story">';
        $story .= '<a href="';
        $story .= get_the_permalink();
        $story .= '"class="pull-left">';
        $args = array(
            'resize' => '370,240',
        );
        $url = wp_get_attachment_image(get_post_thumbnail_id(), 'project-thumb');
        $re = "/^(.*? src=\")(.*?)(\".*)$/m";
        preg_match_all($re, $url, $matches);
        $str = $matches[2][0];
        $photon = jetpack_photon_url($str, $args);
        if(strlen($url) == 0){
            $photon = catch_first_image_story();
            $photon = jetpack_photon_url( $photon, $args );
        }
        $story .= '<div class="thumbnail-image" style="background: url(';
        $story .= $photon;
        $story .= ')no-repeat center center;"></div>';
        $story .= '<h3>';
        $story .= get_the_title();
        $story .='</h3></a>';
        $story .= '</div>';
    endwhile;
    else:
        $story .= '<p>';
        $story .= 'Sorry, no posts matched your criteria.';
        $story .= '</p>';
    endif;
    $story .= '</div>';
    $story .= '</div>';
    $story .= '<div class="row infinity"></div>';
    echo $story;
    die();
}
?>
