<?php
/**
 * Template Name: Authenticated
 */
?>
<?php get_header(); ?>
<div class="container page-content">
  <div class="row">
    <div class="col-xs-12">
      <h2>You are authenticated! Please wait while we redirect you.</h2>
    </div>
  </div>
</div><!-- end .page-content -->

<?php get_footer(); ?>
<script type="text/javascript">
  var redirect_url = localStorage.getItem('redirect_to');
  setTimeout(function(){location.href=redirect_url} , 1000);
</script>