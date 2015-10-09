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
				<div class="row social-foot-desktop hidden-xs">
					<div class="col-sm-12 col-sm-6 col-md-3 social-foot-col" >
						<a href="/"><img class="footer_logo" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/make-logo.png" alt="MAKE Logo"></a>
						<ul class="list-unstyled">
							<li><a href="/projects/">Make: Projects</a></li>
							<li><a href="/category/workshop/3d-printing-workshop/?post_type=projects">3D Printing Projects</a></li>
							<li><a href="/category/technology/arduino/?post_type=projects">Arduino Projects</a></li>
							<li><a href="/category/technology/raspberry-pi/?post_type=projects">Raspberry Pi Projects</a></li>
							<li><a href="https://help.makermedia.com/hc/en-us/categories/200341459-Make-Magazine" target="_blank">Subscription Services</a></li>
						</ul>
					</div>

					<div class="col-sm-12 col-sm-6 col-md-3 social-foot-col" >
						<h4>Explore Making</h4>
						<ul class="list-unstyled">
							<li><a href="//makerfaire.com" target="_blank">Maker Faire</a></li>
							<li><a href="//www.makershed.com" target="_blank">Maker Shed</a></li>
							<li><a href="//makercon.com" target="_blank">MakerCon</a></li>
							<li><a href="//makercamp.com" target="_blank">Maker Camp</a></li>
							<li><a href="//readerservices.makezine.com/mk/" target="_blank">Subscribe to Make:</a></li>
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
							<li><a href="//makermedia.com/privacy" target="_blank">Privacy</a></li>
						</ul>
					</div>

				<div class="col-sm-12 col-sm-6 col-md-3 social-foot-col">
					<h4 class="stay-connected">Follow Us</h4>
					<div class="mz-footer-social">
						<div class="col-xs-3">
							<a href="http://facebook.com/makemagazine">
								<span class="fa-stack fa-mz">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
								</span> 
							</a>
						</div>

						<div class="col-xs-3">
							<a href="http://twitter.com/make">
								<span class="fa-stack fa-mz">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
								</span> 
							</a>
						</div>

						<div class="col-xs-3">
							<a href="http://pinterest.com/makemagazine/">
								<span class="fa-stack fa-mz">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-pinterest-p fa-stack-1x fa-inverse"></i>
								</span> 
							</a> 
						</div>

						<div class="col-xs-3">
							<a href="https://instagram.com/makemagazine/">
								<span class="fa-stack fa-mz">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
								</span> 
							</a> 
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
								<div class="mz-form-horizontal">
									<input name="email" placeholder="Enter your Email" required="required" type="text">
									<input value="GO" class="btn-cyan" type="submit">
								</div>
						  </form>
						</div><!-- end .mz-footer-subscribe -->
					</div>
				</div><!-- END desktop row -->

				<div class="row social-foot-mobile visible-xs-block">
					<div class="hidden-xs social-foot-col">
					<h4 class="stay-connected">Follow Us</h4>
					 <div class="mz-footer-social">
						<div> 
							<a href="http://facebook.com/makemagazine">
								<span class="fa-stack fa-mz">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
								</span> 
							</a>
						</div>

						<div> 
							<a href="http://twitter.com/make">
								<span class="fa-stack fa-mz">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
								</span> 
							</a>
						</div>

						<div>
							<a href="http://pinterest.com/makemagazine/">
								<span class="fa-stack fa-mz">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-pinterest-p fa-stack-1x fa-inverse"></i>
								</span> 
							</a> 
						</div>

						<div>
							<a href="https://instagram.com/makemagazine/">
								<span class="fa-stack fa-mz">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
								</span> 
							</a> 
						</div>
				</div>
          	
          <div class="clearfix"></div>

          <div class="hidden-xs mz-footer-subscribe"> 
						<?php
							$isSecure = "http://";
							if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
								$isSecure = "https://";
							}
						?>
						<h4>Sign Up</h4>
						<p>Stay inspired with the Make: newsletter</p>
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
							<div class="mz-form-horizontal">
								<input name="email" placeholder="Enter your Email" required="required" type="text">
								<input value="GO" class="btn-cyan" type="submit">
							</div>
					  </form>
					</div><!-- end .mz-footer-subscribe -->
			</div>


 			<div class="hidden-xs panel-group" id="accordion" role="tablist" aria-multiselectable="true">
 			<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="heading1">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="false" aria-controls="collapse1">Make:</a>
						</h4>
					</div>
					<div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
								<li><a href="/projects/">Make: Projects</a></li>
								<li><a href="/category/workshop/3d-printing-workshop/?post_type=projects">3D Printing Projects</a></li>
								<li><a href="/category/technology/arduino/?post_type=projects">Arduino Projects</a></li>
								<li><a href="/category/technology/raspberry-pi/?post_type=projects">Raspberry Pi Projects</a></li>
								<li><a href="https://help.makermedia.com/hc/en-us/categories/200341459-Make-Magazine" target="_blank">Subscription Services</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="heading2">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">Explore Making</a>
						</h4>
					</div>
					<div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
								<li><a href="//makerfaire.com" target="_blank">Maker Faire</a></li>
								<li><a href="/blog">Make: News</a></li>
								<li><a href="//www.makershed.com" target="_blank">Maker Shed</a></li>
								<li><a href="//makercon.com" target="_blank">MakerCon</a></li>
								<li><a href="//makercamp.com" target="_blank">Maker Camp</a></li>
								<li><a href="//readerservices.makezine.com/mk/default.aspx?" target="_blank">Subscribe to Make:</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="heading3">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3">Our Company</a>
						</h4>
					</div>
					<div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
						<div class="panel-body">
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

	<!-- Video Tracker -->
	<script type="text/javascript">
	// note: this will cause the Youtube player to "flash" on the page when reloading to enable the JS API
	for (var e = document.getElementsByTagName("iframe"), x = e.length; x--;)
	  if (/youtube.com\/embed/.test(e[x].src))
	    if(e[x].src.indexOf('enablejsapi=') === -1)
	        e[x].src += (e[x].src.indexOf('?') ===-1 ? '?':'&') + 'enablejsapi=1';

	var gtmYTListeners = []; // support multiple players on the same page
	// attach our YT listener once the API is loaded
	function onYouTubeIframeAPIReady() {
	    for (var e = document.getElementsByTagName("iframe"), x = e.length; x--;) {
	        if (/youtube.com\/embed/.test(e[x].src)) {
	            gtmYTListeners.push(new YT.Player(e[x], {
	                events: {
	                    onStateChange: onPlayerStateChange,
	                    onError: onPlayerError
	                }
	            }));
	            YT.gtmLastAction = "p";
	        }
	    }
	}

	// listen for play/pause, other states such as rewind and end could also be added
	// also report % played every second
	function onPlayerStateChange(e) {
	    e["data"] == YT.PlayerState.PLAYING && setTimeout(onPlayerPercent, 1000, e["target"]);
	    var video_data = e.target["getVideoData"](),
	        label = video_data.title;
	    if (e["data"] == YT.PlayerState.PLAYING && YT.gtmLastAction == "p") {
	        dataLayer.push({
	            event: "videos",
	            action: "play",
	            label: label
	        });
	        YT.gtmLastAction = "";
	    }
	    if (e["data"] == YT.PlayerState.PAUSED) {
	        dataLayer.push({
	            event: "videos",
	            action: "pause",
	            label: label
	        });
	        YT.gtmLastAction = "p";
	    }
	}

	// catch all to report errors through the GTM data layer
	// once the error is exposed to GTM, it can be tracked in UA as an event!
	function onPlayerError(e) {
	    dataLayer.push({
	        event: "error",
	        action: "GTM",
	        label: "videos:" + e["target"]["src"] + "-" + e["data"]
	    })
	}

	// report the % played if it matches 0%, 25%, 50%, 75% or completed
	function onPlayerPercent(e) {
	    if (e["getPlayerState"]() == YT.PlayerState.PLAYING) {
	        var t = e["getDuration"]() - e["getCurrentTime"]() <= 1.5 ? 1 : (Math.floor(e["getCurrentTime"]() / e["getDuration"]() * 4) / 4).toFixed(2);        if (!e["lastP"] || t > e["lastP"]) {
	            var video_data = e["getVideoData"](),
	                label = video_data.title;
	            e["lastP"] = t;
	            dataLayer.push({
	                event: "videos",
	                action: t * 100 + "%",
	                label: label
	            })
	        }
	        e["lastP"] != 1 && setTimeout(onPlayerPercent, 1000, e);
	    }
	}

	// load the Youtube JS api and get going
	var j = document.createElement("script"),
	    f = document.getElementsByTagName("script")[0];
	j.src = "//www.youtube.com/iframe_api";
	j.async = true;
	f.parentNode.insertBefore(j, f);
</script>

<script>(function(d, s, id) {
  var js, pjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id; js.async = true;
  js.src = "//cdn.pubexchange.com/modules/partner/make";
  pjs.parentNode.insertBefore(js, pjs);
}(document, "script", "pubexchange-jssdk"));</script>

	</body>
</html>
