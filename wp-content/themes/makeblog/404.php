
<?php

/*
Template Name: 404
*/

get_header( 'version-2' );

?>

<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8">
      <div class="caption404">
        <p class="headline404">This is not the page you're looking for.</p>
        <p class="body404">It must have moved or mysteriously departed. Use search in the top navigation to find a related story or head straight to the <em>Make:</em> <a href="<?php echo get_site_url(); ?>" alt="Makezine Home" class="link404">home page</a>.</p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-offset-1 col-sm-offset-4">
      <img src="<?php echo get_template_directory_uri(). '/images/404-makey.png' ?>" alt="Makey 404" />
    </div>
  </div>
</div>

<?php get_footer(); ?>