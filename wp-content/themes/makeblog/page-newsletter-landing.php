<?php
/**
 * Template Name: Newsletter Subscribe Landing Page
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * 
 */
get_header('universal'); ?>

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="newsletter-landing-page">

      <div class="row nlp-top">

        <div class="container">

          <div class="col-sm-8 col-md-6 col-lg-6 col-sm-offset-2 col-md-offset-3 col-lg-offset-3">

            <h2 class="text-center">Subscribe to the Make: Community Newsletter!</h2>

          </div>

        </div>

      </div>

      <div class="row nlp-bottom">

        <div class="container">

          <div class="col-sm-8 col-md-6 col-lg-6 col-sm-offset-2 col-md-offset-3 col-lg-offset-3">

				<!-- Begin Mailchimp Signup Form -->
				<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
				<style type="text/css">
					#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
					/* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
					   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
				</style>
				<style type="text/css">
					#mc-embedded-subscribe-form input[type=checkbox]{display: inline; width: auto;margin-right: 10px;}
					#mergeRow-gdpr {margin-top: 20px;}
					#mergeRow-gdpr fieldset label {font-weight: normal;}
					#mc-embedded-subscribe-form .mc_fieldset{border:none;min-height: 0px;padding-bottom:0px;}
					#mc-embedded-subscribe-form .checkbox input[type="checkbox"] { position:relative;margin-left:0px;}
				</style>
				<div id="mc_embed_signup">
				<form action="https://make.us9.list-manage.com/subscribe/post?u=4e536d5744e71c0af50c0678c&amp;id=609e43360a" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
					<div id="mc_embed_signup_scroll">
						<div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
						<div class="mc-field-group">
							<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
						</label>
							<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
						</div>
						<div class="mc-field-group">
							<label for="mce-FNAME">First Name </label>
							<input type="text" value="" name="FNAME" class="" id="mce-FNAME">
						</div>
						<div class="mc-field-group">
							<label for="mce-LNAME">Last Name </label>
							<input type="text" value="" name="LNAME" class="" id="mce-LNAME">
						</div>
						<div class="mc-field-group">
							<label for="mce-MMERGE12">Zip </label>
							<input type="text" value="" name="MMERGE12" class="" id="mce-MMERGE12">
						</div>
						<div class="mc-field-group">
							<label for="mce-MMERGE13">Country </label>
							<input type="text" value="" name="MMERGE13" class="" id="mce-MMERGE13">
						</div>
						<div class="mc-field-group">
							<label for="mce-MMERGE16">newsletter_list </label>
							<input type="text" value="" name="MMERGE16" class="" id="mce-MMERGE16">
						</div>
						<div class="mc-field-group input-group">
							<strong>Make: Community Newsletter </strong>
							<ul><li><input type="checkbox" value="1" name="group[38209][1]" id="mce-group[38209]-38209-0"><label for="mce-group[38209]-38209-0"><span for="mce-group[38209]-38209-0" class="newcheckbox"></span>Bi-Monthly</label></li>
						</ul>
						</div>
						<div id="mergeRow-gdpr" class="mergeRow gdpr-mergeRow content__gdprBlock mc-field-group">
							<div class="content__gdpr">
								<label>Marketing Permissions</label>
								<p>Please select all the ways you would like to hear from Maker Media:</p>
								<fieldset class="mc_fieldset gdprRequired mc-field-group" name="interestgroup_field">
								<label class="checkbox subfield" for="gdpr_11165">
									<input type="checkbox" id="gdpr_11165" name="gdpr[11165]" value="Y" class="av-checkbox ">
									<span for="gdpr_11165" class="newcheckbox"></span>
									<span>Email</span> 
								</label>
									<label class="checkbox subfield" for="gdpr_11169">
										<input type="checkbox" id="gdpr_11169" name="gdpr[11169]" value="Y" class="av-checkbox ">
										<span for="gdpr_11169" class="newcheckbox"></span>
										<span>Direct Mail</span> 
									</label>
									<label class="checkbox subfield" for="gdpr_11173">
										<input type="checkbox" id="gdpr_11173" name="gdpr[11173]" value="Y" class="av-checkbox ">
										<span for="gdpr_11173" class="newcheckbox"></span>
										<span>Customized online advertising</span> 
									</label>
								</fieldset>
								<p>You can unsubscribe at any time by clicking the link in the footer of our emails. For information about our privacy practices, please visit our website.</p>
							</div>
							<div class="content__gdprLegal">
								<p>We use Mailchimp as our marketing platform. By clicking below to subscribe, you acknowledge that your information will be transferred to Mailchimp for processing. <a href="https://mailchimp.com/legal/" target="_blank">Learn more about Mailchimp's privacy practices here.</a></p>
							</div>
						</div>
						<div id="mce-responses" class="clear">
							<div class="response" id="mce-error-response" style="display:none"></div>
							<div class="response" id="mce-success-response" style="display:none"></div>
						</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
						<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_4e536d5744e71c0af50c0678c_609e43360a" tabindex="-1" value=""></div>
						<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn universal-btn">
					</div>
				</form>
				</div>
				<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='MMERGE5';ftypes[5]='text';fnames[6]='MMERGE6';ftypes[6]='text';fnames[7]='MMERGE7';ftypes[7]='text';fnames[8]='MMERGE8';ftypes[8]='text';fnames[9]='MMERGE9';ftypes[9]='text';fnames[10]='MMERGE10';ftypes[10]='text';fnames[11]='MMERGE11';ftypes[11]='text';fnames[12]='MMERGE12';ftypes[12]='text';fnames[13]='MMERGE13';ftypes[13]='text';fnames[16]='MMERGE16';ftypes[16]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
				<!--End mc_embed_signup-->

          </div>

        </div>

      </div>

    </div>

  <?php endwhile; else: ?>
  
    <div class="container">
      <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
    </div>  
  
  <?php endif; ?>

<?php get_footer(); ?>