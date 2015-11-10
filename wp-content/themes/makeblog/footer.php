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

						<?php global $make; print $make->ads->ad_leaderboard_alt_btf; ?>

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
							<li><a href="/category/workshop/3d-printing-workshop/">3D Printing Projects</a></li>
							<li><a href="/category/technology/arduino/">Arduino Projects</a></li>
							<li><a href="/category/technology/raspberry-pi/">Raspberry Pi Projects</a></li>
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
					<div class="col-xs-12 social-foot-col">
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


 			<div class="col-xs-12 panel-group" id="accordion" role="tablist" aria-multiselectable="true">
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
								<li><a href="/category/workshop/3d-printing-workshop/">3D Printing Projects</a></li>
								<li><a href="/category/technology/arduino/">Arduino Projects</a></li>
								<li><a href="/category/technology/raspberry-pi/">Raspberry Pi Projects</a></li>
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

		<!-- Subscribe return path overlay -->
		<?php echo subscribe_return_path_overlay(); ?>

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

<!--YOUTUBE FOR FANCYBOX MODALS-->
<script>
$(document).ready(function() {
  $(".fancytube").fancybox({
    maxWidth  : 800,
    maxHeight : 600,
    fitToView : false,
    width   : '70%',
    height    : '70%',
    autoSize  : false,
    closeClick  : false,
    openEffect  : 'none',
    closeEffect : 'none',
    padding : 0
  });
});
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $(".fancytube").fancybox();
  });
</script>

<script>
  $(".fancybox3D").fancybox({
      autoSize : false,
      width  : 630,
      autoHeight : true,
      padding : 0,
      afterLoad   : function() {
          this.content = this.content.html();
      }
  });
  $(document).ready(function () {
    $( "click target goes here" ).click(function() {
      $(".fancybox3D").trigger('click');
    });
  });
</script>
<div class="fancybox3D" style="display:none;">
  <div class="nl-modal-no-bg">
    <div class="col-sm-8 col-xs-12 nl-modal">
      <h3>Yes, I would like my free PDF copy of the 3D Fabricator Quick Guide.</h3>
      <form class="whatcounts-signup-footer" action="https://secure.whatcounts.com/bin/listctrl" method="POST">
        <input type="hidden" name="slid" value="6B5869DC547D3D46B52F3516A785F101" />
        <input type="hidden" name="cmd" value="subscribe" />
        <input type="hidden" name="custom_source" value="modal-3Dpdf" />
        <input type="hidden" name="custom_incentive" value="3Dpdf" />
        <input type="hidden" name="custom_url" value="" />
        <input type="hidden" id="format_mime" name="format" value="mime" />
        <input type="hidden" name="goto" value="" />
        <input type="hidden" name="errors_to" value="" />
        <div class="mz-form-horizontal">
          <input name="email" placeholder="Enter your Email" required type="email"><br>
          <input value="GO" class="btn-cyan" type="submit">
        </div>
      </form>
      <p class=""><small>This is offered with a subscription to the Make: weekly newsletter; you can unsubscribe at any time.</small></p>
    </div>
    <div class="col-sm-4 hidden-xs nl-modal">
      <img class="img-responsive" src="//makezine.com/wp-content/uploads/2015/11/3D-Fabricator-Quick-Guide-Cover.jpg" alt="3D Fabricator Quick Guide Cover" />
    </div>
  </div>
</div>
<!-- END NEWSLETTER MODAL -->

<style>
.nl-modal-no-bg form div label {
    text-align: center;
}
.nl-modal-no-bg #subForm {
    margin-top: 10px;
}
.nl-modal-no-bg .mz-form-horizontal {
    margin-left: auto;
    margin-right: auto;
}
.nl-modal-no-bg {
    margin-left: 0;
    margin-right: 0;
    min-height: 180px;
    display: flex;
    background-color: #fff;
}
.nl-modal-no-bg form {
	margin-bottom: 0;
}
.nl-modal-no-bg .col-sm-4 {
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 0;
}
.nl-modal-no-bg .col-sm-8 {
    justify-content: space-around;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding-top: 30px!important;
    padding-bottom: 30px !important;
}
.fancybox-inner .nl-modal-no-bg h3 {
    font-family: 'Roboto';
    font-style: normal;
    font-size: 24px;
    line-height: 1.2em;
    margin-bottom: 0px;
    margin-top: 0;
    color: #333;
}
.fancybox-inner .nl-modal-no-bg small {
	color: #555;
}
.nl-modal-no-bg .mz-form-horizontal {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    border: 2px solid #cccccc;
    border-radius: 4px;
    max-width: 295px;
}
.nl-modal-no-bg .mz-form-horizontal .btn-cyan {
    font-weight: normal;
    color: #fff;
}
.nl-modal-no-bg .mz-form-horizontal input[name=email] {
    padding: 8px;
    margin-bottom: 0;
    font-size: 15px;
    line-height: 1em;
    height: auto;
    width: 100%;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    -ms-flex: 1;
    flex: 1;
    border-radius-top-left: 4px;
    border-radius-bottom-left: 4px;
    border: none;
    background: transparent;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    color: #555;
    font-weight: normal;
    font-style: normal;
}
@media all and (max-width: 767px) {
    .nl-modal-no-bg .mz-form-horizontal {
        margin-top: 15px;
        margin-bottom: 0;
    }
}
@media all and (max-width: 371px) {
    .fancybox-inner {
        overflow: visible;
    }
    .nl-modal-no-bg h3 {
        font-size: 18px;
        line-height: 1.2em;
        margin-bottom: 10px;
    }
}
</style>

	</body>
</html>
