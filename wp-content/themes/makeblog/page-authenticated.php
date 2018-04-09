<?php
/**
 * Template Name: Authenticated
 */

get_header('universal'); ?>
<div class="container page-content">
  <div class="row">
    <div class="col-xs-12">
      <?php // theloop
      if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <h1 class="page-title"><?php the_title() ;?></h1>

        <?php the_content(); ?>

      <?php endwhile; ?>
      <?php else: ?>

        <?php get_404_template(); ?>

      <?php endif; ?>

    </div>
  </div>
</div><!-- end .page-content -->

<?php get_footer(); ?>