<?php
/**
 * The Email Capture Modal
 */
?>
<!-- 3D GUIDE NEWSLETTER MODAL -->
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
    $( "#modal-capture-btn" ).click(function() {
      $(".fancybox3D").trigger('click');
    });
  });
</script>
<div class="fancybox3D" style="display:none;">
  <div class="nl-modal-no-bg">
    <div class="col-sm-8 col-xs-12 nl-modal">
      <?php
        $isSecure = "http://";
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
          $isSecure = "https://";
        }
      ?>
      <h3>Yes, I would like my free PDF copy of the 3D Fabricator Quick Guide.</h3>
      <form class="whatcounts-signup-footer" action="http://secure.whatcounts.com/bin/listctrl" method="POST">
        <input type="hidden" name="slid" value="6B5869DC547D3D46B52F3516A785F101" />
        <input type="hidden" name="cmd" value="subscribe" />
        <input type="hidden" name="custom_source" value="modal-3Dpdf" />
        <input type="hidden" name="custom_incentive" value="3Dpdf" />
        <input type="hidden" name="custom_url" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
        <input type="hidden" id="format_mime" name="format" value="mime" />
        <input type="hidden" name="goto" value="<?php  echo $isSecure. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>?thankyou=true&subscribed-to=3d-printer" />
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
<!-- END 3D GUIDE NEWSLETTER MODAL -->