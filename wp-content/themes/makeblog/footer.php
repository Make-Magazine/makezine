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
  $username = 'makeco';
  $password = 'memberships';
  $context = stream_context_create(array(
		'http' => array(
			 'header'  => "Authorization: Basic " . base64_encode("$username:$password")
		)
  ));
  if(strpos($_SERVER['SERVER_NAME'], 'staging') !== false || $_SERVER['SERVER_PORT'] == "8888"){
	 echo file_get_contents('https://makeco.staging.wpengine.com/wp-content/themes/memberships/universal-nav/universal-footer.html', false, $context);
  }else{
	 echo file_get_contents('https://make.co/wp-content/themes/memberships/universal-nav/universal-footer.html');
  }
?>
</div> <!-- /container -->

<?php wp_footer(); ?>

<!-- Start Survey Gizmo Beacon -->
<script type="text/javascript">
(function(d,e,j,h,f,c,b){d.SurveyGizmoBeacon=f;d[f]=d[f]||function()
{(d[f].q=d[f].q||[]).push(arguments)}
;c=e.createElement(j),b=e.getElementsByTagName(j)[0];c.async=1;c.src=h;b.parentNode.insertBefore(c,b)})(window,document,'script','//d2bnxibecyz4h5.cloudfront.net/runtimejs/intercept/intercept.js','sg_beacon');
sg_beacon('init','Mjg4MjQzLTJiMjdlNGU0NmM3ZDM3YWQ2YWJiOTEwNWRhNDM0ZGQ1NTFlZTdhN2Q3Y2E4Y2M0ZTlh');
</script>
<!-- End Survey Gizmo Beacon -->

<!-- Checks the URL for which thank you modal to how -->
<?php echo display_thank_you_modal_if_signed_up(); ?>

<!-- Subscribe return path overlay -->
<?php echo subscribe_return_path_overlay(); ?>

<script>
  //Temporary GA tracking for clicks to header magazine subsciption cover image
  // jQuery('#mz-mag-cover').on( "click", function() {
  //   ga('send', 'event', 'Subscription', 'Click', 'Header mag cover click', 1);
  // });
</script>

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

</body>
</html>