<?php
/**
 * @package MakeZine
  Template Name: Home Page Include
*/
?>

<!-- home page include file -->

<h2>More from the World of MAKE</h2>
<p class="byline" style="float: left;"><span>with the editors and authors of MAKE</span> <?php the_date("1 F j Y", "<span class='date'>", "</span>"); ?></p>

<p class="button" style="float: right;">
  <a href="http://blog.makezine.com/">More Posts</a> 
  <a href="http://makezine.com/cs/user/create/link?x-t=suggest.form">Suggest a Site!</a>
</p>
<div class="clear"></div>
<?php 
$args=array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'posts_per_page' => 10,
  'ignore_sticky_posts'=> 1
);
$temp = $wp_query;  // assign orginal query to temp variable for later use   
$wp_query = null;
$wp_query = new WP_Query($args); 
?>

<?php
  if( have_posts() ) : 
    while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

<h2 style="border-bottom: 0px;"><a href="<?php the_permalink(); ?>" style="font-size: 15px; font-weight:bold;"><?php the_title(); ?></a></h2>
<div class="rss-img">
<?php
if ( has_post_thumbnail() ) {
  the_post_thumbnail( 'left-rail-home-thumb' );
}
?>
</div>

<div class="entry-content">

<p class="nfo"><?php echo get_the_excerpt() ; ?></p>



<div class="nfo" style="margin-top:10px;margin-bottom:10px;">

<strong><a href="<?php the_permalink(); ?>">Read full story</a></strong>

</div>


<p class="nfo">Posted by <?php the_author_posts_link(); ?> | <?php the_time('F jS, Y g:i A') ?> <?php edit_post_link('Fix me...'); ?></p>
<p class="nfo">Categories: <?php the_category(', ') ?> | <?php comments_popup_link(); ?></p>

</div>

<div style="margin-bottom: 12px; margin-top: 12px; border-top: 1px solid #ccc;clear:both;" /></div>
 <?php endwhile; endif; ?>
 
 <p class="button" style="float: right; margin: 0px -12px 12px 12px;">
  <a href="http://blog.makezine.com/">More Posts</a> 
  <a href="http://makezine.com/cs/user/create/link?x-t=suggest.form">Suggest a Site!</a>
</p>

