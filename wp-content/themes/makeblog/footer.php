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
					<li><a href="//makerfaire.com/?utm_source=makezine.com&utm_medium=footer&utm_term=makerfaire" target="_blank">Maker Faire</a></li>
					<li><a href="//www.makershed.com/?utm_source=makezine.com&utm_medium=footer&utm_term=makershed" target="_blank">Maker Shed</a></li>
					<li><a href="//makercamp.com/?utm_source=makezine.com&utm_medium=footer&utm_term=makercamp" target="_blank">Maker Camp</a></li>
					<li><a href="//readerservices.makezine.com/mk/default.aspx?pc=MK&pk=M5BMKZ" target="_blank">Subscribe to Make:</a></li>
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
						<input type="hidden" name="goto" value="<?php  echo $isSecure. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>?thankyou=true&subscribed-to=make-newsletter" />
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
					<form class="sub-form whatcounts-signup1" action="http://whatcounts.com/bin/listctrl" method="POST">
						<input type="hidden" name="slid_1" value="6B5869DC547D3D46B52F3516A785F101" /><!-- Make: Newsletter -->
            <input type="hidden" name="slid_2" value="6B5869DC547D3D46941051CC68679543" /><!-- Maker Media Newsletter -->
            <input type="hidden" name="multiadd" value="1" />
						<input type="hidden" name="cmd" value="subscribe" />
						<input type="hidden" name="custom_source" value="footer" />
						<input type="hidden" name="custom_incentive" value="none" />
						<input type="hidden" name="custom_url" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
						<input type="hidden" id="format_mime" name="format" value="mime" />
						<input type="hidden" name="goto" value="<?php  echo $isSecure. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>?thankyou=true&subscribed-to=make-newsletter" />
						<input type="hidden" name="custom_host" value="<?php echo $_SERVER["HTTP_HOST"]; ?>" />
						<input type="hidden" name="errors_to" value="" />
						<div class="mz-form-horizontal">
							<input id="wc-email" name="email" placeholder="Enter your Email" required type="text">
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
								<li><a href="//makermedia.com/privacy" target="_blank">Privacy</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!-- End social-foot-mobile -->
		<button class="footer-feedback-btn btn-cyan pull-center">Send Us Feedback</button>
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

<!-- Checks the URL for which thank you modal to how -->
<?php echo display_thank_you_modal_if_signed_up(); ?>

<!-- Subscribe return path overlay -->
<?php echo subscribe_return_path_overlay(); ?>

<!-- Feedback form submit event handler -->
<script>
  $(document).on('submit', '#form13', function (e) {
    event.preventDefault();
    $.ajax({
      url:'//makemagazine.wufoo.com/forms/zzv65kl0b09v1f/#public',
      type:'POST',
      data:$(this).serialize()
    });
    $('.fancybox-feedback-inner1').hide();
    $('.fancybox-feedback-inner2').show();
  });
</script>

<!-- Feedback form modal -->
<script>
  $(".footer-feedback-btn").click(function() {
    $(".fancybox-feedback").fancybox({
      autoSize : false,
      width  : 560,
      autoHeight : true,
      padding : 0,
      openEffect : 'elastic',
      afterLoad   : function() {
        this.content = this.content.html();
      }
    });
    $(".fancybox-feedback").trigger('click');
  });
</script>

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

</body>
</html>
