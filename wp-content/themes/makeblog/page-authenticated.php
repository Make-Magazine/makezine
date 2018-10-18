<?php
/**
 * Template Name: Authenticated
 */

get_header('universal'); ?>
<div class="single">
  <div id="authenticated-redirect"  class="container">
    <div class="row">
        <div class="col-xs-12">
          <h2 class="text-center">Please wait while we complete the login process.</h2>
          <h3 class="text-center">You will be redirected to the page you were trying to access shortly.</h3>
          <h3 class="text-center billboard">Please wait while we get you back to the right place.</h3>
        </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <?php // theloop
        if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
          <?php endwhile; ?>
        <?php else: ?>
          <?php get_404_template(); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php get_footer();