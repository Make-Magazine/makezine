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
<!-- These extra closing divs are to close all the divs opened by the functions that pull in cat posts -->

<section id="footer" class="new-footer">
	<div class="container">
		<div class="row social-foot-desktop hidden-xs">
			<div class="col-sm-12 col-sm-6 col-md-3 social-foot-col" >
				<a href="/"><img class="footer_logo" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/make-logo.png" alt="MAKE Logo"></a>
					<button class="footer-feedback-btn btn-cyan pull-center">Send Us Feedback</button>
			</div>

			<div class="col-sm-12 col-sm-6 col-md-3 social-foot-col" >
				<h4>Explore Making</h4>
				<ul class="list-unstyled">
					<li><a href="//makerfaire.com/?utm_source=makezine.com&utm_medium=footer&utm_term=makerfaire" target="_blank">Maker Faire</a></li>
					<li><a href="//www.makershed.com/?utm_source=makezine.com&utm_medium=footer&utm_term=makershed" target="_blank">Maker Shed</a></li>
					<li><a href="//makercamp.com/?utm_source=makezine.com&utm_medium=footer&utm_term=makercamp" target="_blank">Maker Camp</a></li>
					<li><a href="//readerservices.makezine.com/mk/default.aspx?pc=MK&pk=M5BMKZ" target="_blank">Subscribe to Make:</a></li>
					<li><a href="/join/" target="_blank">Join the Community</a></li>
				</ul>
			</div>
			<div class="clearfix visible-sm-block"></div>
			<div class="col-sm-12 col-sm-6 col-md-3 social-foot-col">
				<h4>Our Company</h4>
				<ul class="list-unstyled">
					<li><a href="//makermedia.com" target="_blank">About Us</a></li>
					<li><a href="//makermedia.com/work-with-us/advertising" target="_blank">Advertise with Us</a></li>
					<li><a href="//makermedia.com/work-with-us/job-openings" target="_blank">Careers</a></li>
					<li><a href="//help.makermedia.com/hc/en-us" target="_blank">Help</a></li>
					<li><a href="//help.makermedia.com/hc/en-us/categories/200341459-Make-Magazine" target="_blank">Make: Subscription Services</a></li>
				</ul>
			</div>

			<div class="col-sm-12 col-sm-6 col-md-3 social-foot-col">
				<h4 class="stay-connected">Follow Us</h4>
        <div class="social-network-container">
          <ul class="social-network social-circle">
            <li><a href="//facebook.com/makemagazine" class="icoFacebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a href="//twitter.com/make" class="icoTwitter" title="Twitter" target="_blank"><i class="fa fa-twitter" target="_blank"></i></a></li>
            <li><a href="//pinterest.com/makemagazine" class="icoPinterest" title="Pinterest" target="_blank"><i class="fa fa-pinterest-p" target="_blank"></i></a></li>
            <li><a href="//instagram.com/makemagazine" class="icoInstagram" title="Instagram" target="_blank"><i class="fa fa-instagram" target="_blank"></i></a></li>
          </ul>    
        </div>
        <div class="clearfix"></div>
        
        <div class="fancybox-feedback" style="display:none;">
          <div class="fancybox-feedback-inner">
            <div class="fancybox-feedback-inner1">
              <h3>Makers, we want to hear from you!</h3>
              <p>Send us feedback on our site design, bugs, story ideas, maker community events and any other share-worthy thoughts.</p>
              <form id="form13" name="form13" accept-charset="UTF-8" enctype="multipart/form-data" method="post" novalidate action="//makemagazine.wufoo.com/forms/zzv65kl0b09v1f/#public">
                <div class="form-group">
                  <label for="exampleInputName1">Name</label>
                  <input type="text" class="form-control" id="Field1" name="Field1" placeholder="Name">
                  <p class="help-block">*Not Required</p>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email Address For Follow Up</label>
                  <input type="email" class="form-control" id="Field2" name="Field2" placeholder="Email">
                  <p class="help-block">*Not Required</p>
                </div>
                <div class="form-group">
                  <label>Write Your Feedback Here</label>
                  <textarea class="form-control" id="Field3" name="Field3" spellcheck="true" rows="3" required></textarea>
                </div>
                <input id="saveForm" name="saveForm" class="footer-feedback-submit btn-cyan" type="submit" value="Submit" />
                <input type="hidden" id="idstamp" name="idstamp" value="WH028EiOADf/hZl3yIPszD+rnU6UVQ2++DXf7i7lt38=" />
              </form>
            </div>
            <div class="fancybox-feedback-inner2" style="display:none;">
              <h3>Thank you for the feedback!</h3>
              <p>We can't guarantee a response to each submission, but we promise to think about every one.</p>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>

				<div class="mz-footer-subscribe">
					<?php
					$isSecure = "http://";
					if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
						$isSecure = "https://";
					}
					?>
					<h4>Sign Up</h4>
					<p>Stay inspired with the Make: newsletter</p>
					<form class="sub-form whatcounts-signup1" action="http://whatcounts.com/bin/listctrl" method="POST">
						<input type="hidden" name="slid_1" value="6B5869DC547D3D46B52F3516A785F101" /><!-- Make: Newsletter -->
            <input type="hidden" name="slid_2" value="6B5869DC547D3D46941051CC68679543" /><!-- Maker Media Newsletter -->
            <input type="hidden" name="multiadd" value="1" />
						<input type="hidden" name="cmd" value="subscribe" />
						<input type="hidden" name="custom_source" value="footer" />
						<input type="hidden" name="custom_incentive" value="none" />
						<input type="hidden" name="custom_url" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
						<input type="hidden" id="format_mime" name="format" value="mime" />
						<input type="hidden" name="goto" value="" />
						<input type="hidden" name="custom_host" value="<?php echo $_SERVER["HTTP_HOST"]; ?>" />
						<input type="hidden" name="errors_to" value="" />
						<div class="mz-form-horizontal">
							<input id="wc-email" name="email" placeholder="Enter your Email" required type="text">
							<input value="GO" class="btn-cyan" type="submit">
						</div>
					</form>
				</div><!-- end .mz-footer-subscribe -->
			</div>
		</div><!-- END desktop row -->

		<div class="row social-foot-mobile visible-xs-block">
			<div class="col-xs-12 social-foot-col">
				<h4 class="stay-connected">Follow Us</h4>
        <div class="social-network-container">
          <ul class="social-network social-circle">
            <li><a href="//facebook.com/makemagazine" class="icoFacebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a href="//twitter.com/make" class="icoTwitter" title="Twitter" target="_blank"><i class="fa fa-twitter" target="_blank"></i></a></li>
            <li><a href="//pinterest.com/makemagazine" class="icoPinterest" title="Pinterest" target="_blank"><i class="fa fa-pinterest-p" target="_blank"></i></a></li>
            <li><a href="//instagram.com/makemagazine" class="icoInstagram" title="Instagram" target="_blank"><i class="fa fa-instagram" target="_blank"></i></a></li>
          </ul>    
        </div>
        <div class="clearfix"></div>

				<div class="mz-footer-subscribe">
					<?php
					$isSecure = "http://";
					if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
						$isSecure = "https://";
					}
					?>
					<h4>Sign Up</h4>
					<p>Stay inspired with the Make: newsletter</p>
					<form class="sub-form whatcounts-signup1m" action="http://whatcounts.com/bin/listctrl" method="POST">
						<input type="hidden" name="slid_1" value="6B5869DC547D3D46B52F3516A785F101" /><!-- Make: Newsletter -->
            <input type="hidden" name="slid_2" value="6B5869DC547D3D46941051CC68679543" /><!-- Maker Media Newsletter -->
            <input type="hidden" name="multiadd" value="1" />
						<input type="hidden" name="cmd" value="subscribe" />
						<input type="hidden" name="custom_source" value="footer" />
						<input type="hidden" name="custom_incentive" value="none" />
						<input type="hidden" name="custom_url" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
						<input type="hidden" id="format_mime" name="format" value="mime" />
						<input type="hidden" name="goto" value="" />
						<input type="hidden" name="custom_host" value="<?php echo $_SERVER["HTTP_HOST"]; ?>" />
						<input type="hidden" name="errors_to" value="" />
						<div class="mz-form-horizontal">
							<input id="wc-email-m" name="email" placeholder="Enter your Email" required type="text">
							<input value="GO" class="btn-cyan" type="submit">
						</div>
					</form>
				</div><!-- end .mz-footer-subscribe -->
			</div>


			<div class="col-xs-12 panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="heading1">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="false" aria-controls="collapse1">
							<h4 class="panel-title">Make:</h4>
						</a>
					</div>
					<div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
						<div class="panel-body">
							<button class="footer-feedback-btn btn-cyan pull-center">Send Us Feedback</button>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="heading2">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
							<h4 class="panel-title">Explore Making</h4>
						</a>
					</div>
					<div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
								<li><a href="//makerfaire.com/?utm_source=makezine.com&utm_medium=footer&utm_term=makerfaire" target="_blank">Maker Faire</a></li>
								<li><a href="//www.makershed.com/?utm_source=makezine.com&utm_medium=footer&utm_term=makershed" target="_blank">Maker Shed</a></li>
								<li><a href="//makercamp.com/?utm_source=makezine.com&utm_medium=footer&utm_term=makercamp" target="_blank">Maker Camp</a></li>
								<li><a href="//readerservices.makezine.com/mk/default.aspx?pc=MK&pk=M5BMKZ" target="_blank">Subscribe to Make:</a></li>
								<li><a href="/join/" target="_blank">Join the Community</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="heading3">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
							<h4 class="panel-title">Our Company</h4>
						</a>
					</div>
					<div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
								<li><a href="//makermedia.com" target="_blank">About Us</a></li>
								<li><a href="//makermedia.com/work-with-us/advertising" target="_blank">Advertise with Us</a></li>
								<li><a href="//makermedia.com/work-with-us/job-openings" target="_blank">Careers</a></li>
								<li><a href="//help.makermedia.com/hc/en-us" target="_blank">Help</a></li>
								<li><a href="//help.makermedia.com/hc/en-us/categories/200341459-Make-Magazine" target="_blank">Make: Subscription Services</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!-- End social-foot-mobile -->
	</div><!-- END container -->
	<?php echo make_copyright_footer(); ?>
</section><!-- END new-footer -->
</div> <!-- /container -->

<?php wp_footer(); ?>

<!-- Checks the URL for which thank you modal to how -->
<?php echo display_thank_you_modal_if_signed_up(); ?>

<!-- Subscribe return path overlay -->
<?php echo subscribe_return_path_overlay(); ?>

</body>
</html>