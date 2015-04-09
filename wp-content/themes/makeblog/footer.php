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

				<div class="footer-ad <?php echo ( make_is_parent_page() && ! is_category( 'maker-pro' ) ) ? 'grey' : '' ; ?>" style="clear:both;">

					<div class="ad-slot">

						<!-- Beginning Sync AdSlot 4 for Ad unit header ### size: [[728,90]]  -->
						<div id='div-gpt-ad-664089004995786621-4'>
							<script type='text/javascript'>
								googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-4')});
							</script>
						</div>
						<!-- End AdSlot 4 -->

					</div></div>

				</div></div></div>

			</div></div></div>
			<!-- These extra closing divs are to close all the divs opened by the functions that pull in cat posts -->

		<section id="footer" class="new-footer">
			<div class="container">
				<div class="row social-foot-desktop">
					<div class="span3 social-foot-col" >
						<a href="/"><img class="footer_logo" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/make-logo.png" alt="MAKE Logo"></a>
						<ul class="unstyled">
							<li><a href="//www.pubservice.com/MK/subscribe.aspx?PC=MK&PK=M3AMZB" target="_blank">Subscribe to Make:</a></li>
							<li><a href="/projects">Make: Projects</a></li>
							<li><a href="/weekendprojects">Weekend Projects</a></li>
							<li><a href="/video">Make: Videos</a></li>
							<li><a href="/category/maker-pro">Maker Pro News</a></li>
						</ul>
					</div>

					<div class="span3 social-foot-col" >
						<h4>Explore Making</h4>
						<ul class="unstyled">
							<li><a href="/blog">Make: News</a></li>
							<li><a href="//makerfaire.com" target="_blank">Maker Faire</a></li>
							<li><a href="//www.makershed.com" target="_blank">Maker Shed</a></li>
							<li><a href="//makercon.com" target="_blank">MakerCon</a></li>
							<li><a href="//makercamp.com" target="_blank">Maker Camp</a></li>
						</ul>
					</div>
					<!-- div class="clearfix visible-phone"></div--><!-- ADD THIS BACK IN WHEN SITE IS RESPONSIVE -->
					<div class="span3 social-foot-col">
						<h4>Our Company</h4>
						<ul class="unstyled">
							<li><a href="//makermedia.com" target="_blank">About Us</a></li>
							<li><a href="//makermedia.com/work-with-us/advertising" target="_blank">Advertise with Us</a></li>
							<li><a href="//makermedia.com/work-with-us/job-openings" target="_blank">Careers</a></li>
							<li><a href="//help.makermedia.com/hc/en-us" target="_blank">Help</a></li>
							<li><a href="//makermedia.com/privacy" target="_blank">Privacy</a></li>
						</ul>
					</div>

					<div class="span3 social-foot-col">
						<h4 class="stay-connected">Stay Connected</h4>
						<div class="social-profile-icons">
							<a class="sprite-facebook-32" href="http://facebook.com/makemagazine" title="Facebook" target="_blank">
								<div class="social-profile-cont">	
									<span class="sprite"></span>
								</div>
							</a>
							<a class="sprite-twitter-32" href="http://twitter.com/make" title="Twitter" target="_blank">
								<div class="social-profile-cont">	
									<span class="sprite"></span>
								</div>
							</a>
							<a class="sprite-pinterest-32" href="http://pinterest.com/makemagazine/" title="Pinterest" target="_blank">
								<div class="social-profile-cont">	
									<span class="sprite"></span>
								</div>
							</a>
							<a class="sprite-googleplus-32" href="https://plus.google.com/+MAKE/posts" rel="publisher" title="Google+" target="_blank">
								<div class="social-profile-cont">	
									<span class="sprite"></span>
								</div>
							</a>
						</div>
						<?php
							$isSecure = "http://";
							if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
								$isSecure = "https://";
							}
						?>
			    	    <form class="sub-form" action="http://whatcounts.com/bin/listctrl" method="POST">
							<input type="hidden" name="slid" value="6B5869DC547D3D46B52F3516A785F101" />
							<input type="hidden" name="cmd" value="subscribe" />
							<input type="hidden" name="custom_source" value="footer" /> 
							<input type="hidden" name="custom_incentive" value="none" /> 
							<input type="hidden" name="custom_url" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
							<input type="hidden" id="format_mime" name="format" value="mime" />
							<input type="hidden" name="goto" value="<?php  echo $isSecure. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>?thankyou=true" />
							<input type="hidden" name="custom_host" value="<?php echo $_SERVER["HTTP_HOST"]; ?>" />
							<input type="hidden" name="errors_to" value="" />
							<div>
								<input name="email" placeholder="Enter your Email" required="required" type="text"><br>
								<input value="Sign Up for our Newsletter" class="btn-cyan" type="submit">
							</div>
					    </form>
					</div>
				</div><!-- END desktop row -->
				<div class="row social-foot-mobile">
					<div class="span12 social-foot-col">
						<h4 class="stay-connected">Stay Connected</h4>
						<div class="social-profile-icons">
							<a class="sprite-facebook-32" href="http://facebook.com/makemagazine" title="Facebook" target="_blank">
								<div class="social-profile-cont">	
									<span class="sprite"></span>
								</div>
							</a>
							<a class="sprite-twitter-32" href="http://twitter.com/make" title="Twitter" target="_blank">
								<div class="social-profile-cont">	
									<span class="sprite"></span>
								</div>
							</a>
							<a class="sprite-pinterest-32" href="http://pinterest.com/makemagazine/" title="Pinterest" target="_blank">
								<div class="social-profile-cont">	
									<span class="sprite"></span>
								</div>
							</a>
							<a class="sprite-googleplus-32" href="https://plus.google.com/+MAKE/posts" rel="publisher" title="Google+" target="_blank">
								<div class="social-profile-cont">	
									<span class="sprite"></span>
								</div>
							</a>
						</div>
						<?php
							$isSecure = "http://";
							if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
								$isSecure = "https://";
							}
						?>
			    	    <form class="sub-form" action="http://whatcounts.com/bin/listctrl" method="POST">
							<input type="hidden" name="slid" value="6B5869DC547D3D46B52F3516A785F101" />
							<input type="hidden" name="cmd" value="subscribe" />
							<input type="hidden" name="custom_source" value="footer" /> 
							<input type="hidden" name="custom_incentive" value="none" /> 
							<input type="hidden" name="custom_url" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
							<input type="hidden" id="format_mime" name="format" value="mime" />
							<input type="hidden" name="goto" value="<?php  echo $isSecure. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>?thankyou=true" />
							<input type="hidden" name="custom_host" value="<?php echo $_SERVER["HTTP_HOST"]; ?>" />
							<input type="hidden" name="errors_to" value="" />
							<div>
								<input name="email" placeholder="Enter your Email" required="required" type="text"><br>
								<input value="Sign Up for our Newsletter" class="btn-cyan" type="submit">
							</div>
					    </form>
					</div>
					<div class="span12 accordion" id="accordionF">
					  <div class="accordion-group">
					    <div class="accordion-heading">
					      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionF" href="#collapseOneF">
					        <h3>Make:</h3>
					      </a>
					    </div>
					    <div id="collapseOneF" class="accordion-body collapse">
					      <div class="accordion-inner">
					        <ul class="nav nav-pills nav-stacked">
								<li><a href="//www.pubservice.com/MK/subscribe.aspx?PC=MK&PK=M3AMZB" target="_blank">Subscribe to Make:</a></li>
								<li><a href="/projects">Make: Projects</a></li>
								<li><a href="/weekendprojects">Weekedn Projects</a></li>
								<li><a href="/video">Make: Videos</a></li>
								<li><a href="/category/maker-pro">Maker Pro News</a></li>
							</ul>
					      </div>
					    </div>
					  </div>
					  <div class="accordion-group">
					    <div class="accordion-heading">
					      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionF" href="#collapseTwoF">
					        <h3>Explore Making</h3>
					      </a>
					    </div>
					    <div id="collapseTwoF" class="accordion-body collapse">
					      <div class="accordion-inner">
					        <ul class="nav nav-pills nav-stacked">
								<li><a href="/blog">Make: News</a></li>
								<li><a href="//makerfaire.com" target="_blank">Maker Faire</a></li>
								<li><a href="//www.makershed.com" target="_blank">Maker Shed</a></li>
								<li><a href="//makercon.com" target="_blank">MakerCon</a></li>
								<li><a href="//makercamp.com" target="_blank">Maker Camp</a></li>
							</ul>
					      </div>
					    </div>
					  </div>
					  <div class="accordion-group">
					    <div class="accordion-heading">
					      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionF" href="#collapseThreeF">
					        <h3>Our Company</h3>
					      </a>
					    </div>
					    <div id="collapseThreeF" class="accordion-body collapse">
					      <div class="accordion-inner">
					        <ul class="nav nav-pills nav-stacked">
								<li><a href="//makermedia.com" target="_blank">About Us</a></li>
								<li><a href="//makermedia.com/work-with-us/advertising" target="_blank">Advertise with Us</a></li>
								<li><a href="//makermedia.com/work-with-us/job-openings" target="_blank">Careers</a></li>
								<li><a href="//help.makermedia.com/hc/en-us" target="_blank">Help</a></li>
								<li><a href="//makermedia.com/privacy" target="_blank">Privacy</a></li>
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

		<!-- Le javascript -->
		<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery(".scroll").click(function(event){
				//prevent the default action for the click event
				event.preventDefault();
				//get the full url - like mysitecom/index.htm#home
				var full_url = this.href;
				//split the url by # and get the anchor target name - home in mysitecom/index.htm#home
				var parts = full_url.split("#");
				var trgt = parts[1];
				//get the top offset of the target anchor
				var target_offset = jQuery("#"+trgt).offset();
				var target_top = target_offset.top;
				//goto that anchor by setting the body scroll top to anchor top
				jQuery('html, body').animate({scrollTop:target_top - 50}, 1000);
				//Style the pagination links
				jQuery('a span.badge').addClass('badge-info');
			});
			jQuery('.hide-thumbnail').removeClass('thumbnail');
		});
		</script>

		<?php wp_footer(); ?>

		<!-- AddRoll Retargeting Pixel -->
		<script type="text/javascript">
		adroll_adv_id = "KNRSJHIPMNCYTPL6CH6ZAM";
		adroll_pix_id = "65IC7MDQJVEX5LW2ZNA7YF";
		(function () {
		var oldonload = window.onload;
		window.onload = function(){
		   __adroll_loaded=true;
		   var scr = document.createElement("script");
		   var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
		   scr.setAttribute('async', 'true');
		   scr.type = "text/javascript";
		   scr.src = host + "/j/roundtrip.js";
		   ((document.getElementsByTagName('head') || [null])[0] ||
		    document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
		   if(oldonload){oldonload()}};
		}());
		</script>

		<script type="text/javascript">
			setTimeout(function(){var a=document.createElement("script");
			var b=document.getElementsByTagName("script")[0];
			a.src=document.location.protocol+"//dnn506yrbagrg.cloudfront.net/pages/scripts/0013/2533.js?"+Math.floor(new Date().getTime()/3600000);
			a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
		</script>
	<!-- Hidden Stuff -->
    <div class="fancybox popup" style="display:none;">
	    <h3>Don't Miss Out!</h3>
	    <p>Get our free weekly newsletter and keep up with the latest Make: news and information</p>
						<?php
							$isSecure = "http://";
							if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
								$isSecure = "https://";
							}
						?>
	    	    <form action="http://whatcounts.com/bin/listctrl" method="POST">
						<input type="hidden" name="slid" value="6B5869DC547D3D46B52F3516A785F101" />
						<input type="hidden" name="cmd" value="subscribe" />
						<input type="hidden" name="custom_source" value="modal_light_blue" /> 
						<input type="hidden" name="custom_incentive" value="none" /> 
						<input type="hidden" name="custom_url" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
						<input type="hidden" id="format_mime" name="format" value="mime" />
						<input type="hidden" name="goto" value="<?php  echo $isSecure. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>?thankyou=true" />
						<input type="hidden" name="custom_host" value="<?php echo $_SERVER["HTTP_HOST"]; ?>" />
						<input type="hidden" name="errors_to" value="" />
	      <div>
	        <input name="email" id="makezinemain" placeholder="Email Address" required="required" type="text"><br>
	        <input value="Start Making!" class="btn-modal newsletter-set-cookie" id="newsletter-set-cookie" type="submit">
	      </div>
	    </form>
    </div>

	<!-- Begin Chartbeat Tracker -->
	<script type='text/javascript'>
	    var _sf_async_config={};
	    /** CONFIGURATION START **/
	    _sf_async_config.uid = 53627;
	    _sf_async_config.domain = 'makezine.com';
	    _sf_async_config.useCanonical = true;
	    _sf_async_config.sections = 'Change this to your Section name';  //CHANGE THIS
	    _sf_async_config.authors = 'Change this to your Author name';    //CHANGE THIS
	    /** CONFIGURATION END **/
	    (function(){
	      function loadChartbeat() {
	        window._sf_endpt=(new Date()).getTime();
	        var e = document.createElement('script');
	        e.setAttribute('language', 'javascript');
	        e.setAttribute('type', 'text/javascript');
	        e.setAttribute('src', '//static.chartbeat.com/js/chartbeat.js');
	        document.body.appendChild(e);
	      }
	      var oldonload = window.onload;
	      window.onload = (typeof window.onload != 'function') ?
	         loadChartbeat : function() { oldonload(); loadChartbeat(); };
	    })();
	</script>
	<!-- End Chartbeat Tracker -->

	</body>
</html>
