<?php
/**
 * The generic footer template.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     The Make Team webmaster@makermedia.com
 *
 */
?>

</div></div></div>
</div></div></div>

<?php
   $context = null;
   if(UNIVERSAL_ASSET_USER && UNIVERSAL_ASSET_PASS) {
      $context = stream_context_create(array(
            'http' => array(
               'header'  => "Authorization: Basic " . base64_encode(UNIVERSAL_ASSET_USER.':'.UNIVERSAL_ASSET_PASS)
            )
      ));
   }
   echo file_get_contents( UNIVERSAL_ASSET_URL_PREFIX . '/wp-content/themes/memberships/universal-nav/universal-footer.html', false, $context);
?>
</div> <!-- /container -->

<?php wp_footer(); ?>

<div class="fancybox-thx" style="display:none;">
  <div class="nl-modal-cont nl-thx-p2">
    <div class="col-sm-4 hidden-xs nl-modal">
      <span class="fa-stack fa-4x">
        <i class="fa fa-circle-thin fa-stack-2x"></i>
        <i class="fa fa-thumbs-o-up fa-stack-1x"></i>
      </span>
    </div>
    <div class="col-sm-8 col-xs-12 nl-modal">
      <h3>Awesome!</h3>
      <p style="color:#333;text-align:center;margin-top:20px;">Thanks for signing up.</p>
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="nl-modal-error" style="display:none;">
  <div class="col-xs-12 nl-modal padtop">
    <p class="lead">The reCAPTCHA box was not checked. Please try again.</p>
  </div>
  <div class="clearfix"></div>
</div>


<!-- Start Survey Gizmo Beacon -->
<script type="text/javascript">
(function(d,e,j,h,f,c,b){d.SurveyGizmoBeacon=f;d[f]=d[f]||function()
{(d[f].q=d[f].q||[]).push(arguments)}
;c=e.createElement(j),b=e.getElementsByTagName(j)[0];c.async=1;c.src=h;b.parentNode.insertBefore(c,b)})(window,document,'script','//d2bnxibecyz4h5.cloudfront.net/runtimejs/intercept/intercept.js','sg_beacon');
sg_beacon('init','Mjg4MjQzLTJiMjdlNGU0NmM3ZDM3YWQ2YWJiOTEwNWRhNDM0ZGQ1NTFlZTdhN2Q3Y2E4Y2M0ZTlh');
</script>
<!-- End Survey Gizmo Beacon -->


</body>
</html>