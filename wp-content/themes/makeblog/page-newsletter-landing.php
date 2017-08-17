<?php
/**
 * Template Name: Newsletter Subscribe Landing Page
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * 
 */
get_header('version-2'); ?>

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="newsletter-landing-page">

      <div class="row nlp-top">

        <div class="container">

          <div class="col-sm-8 col-md-6 col-lg-4 col-sm-offset-2 col-md-offset-3 col-lg-offset-4">

            <h2>Welcome to the Make Community!</h2>
            <p>Enter your email address, pick your interests, and start getting the best of Make: in your inbox.</p>
            <input type="email" id="nlp-input" class="form-control" placeholder="Enter your email address" data-toggle="tooltip" data-placement="right" title="Please enter your email" />

          </div>

        </div>

      </div>

      <div class="row nlp-bottom">

        <div class="container">

          <div class="col-sm-8 col-md-6 col-lg-4 col-sm-offset-2 col-md-offset-3 col-lg-offset-4">

            <form id="nlp-form" class="nlp-form" action="http://whatcounts.com/bin/listctrl" method="POST">
              <input type="hidden" name="slid" value="6B5869DC547D3D4690C43FE9E066FBC6" /><!-- Confirmation -->
              <input type="hidden" name="custom_list_makermedia" value="yes" />
              <input type="hidden" name="cmd" value="subscribe" />
              <input type="hidden" id="email" name="email" value="" />
              <input type="hidden" id="format_mime" name="format" value="mime" />
              <input type="hidden" name="goto" value="" />
              <input type="hidden" name="custom_source" value="landing-page_signup" />
              <input type="hidden" name="custom_incentive" value="none" />
              <input type="hidden" name="custom_url" value="makezine.com/join" />
              <input type="hidden" id="format_mime" name="format" value="mime" />
              <input type="hidden" name="custom_host" value="makezine.com" />

              <label class="list-radio pull-right" data-toggle="tooltip" data-placement="right" title="Please choose at least one checkbox">
                <input type="checkbox" id="list_6B5869DC547D3D46B52F3516A785F101_yes" name="custom_list_makenewsletter" value="yes" />
                <span for="list_6B5869DC547D3D46B52F3516A785F101_yes" class="newcheckbox"></span>
              </label>
              <h4>Make:</h4><p>The best stuff each week from Make: magazine</p>
              <hr />

              <label class="list-radio pull-right" data-toggle="tooltip" data-placement="right" title="Please choose at least one checkbox">
                <input type="checkbox" id="list_6B5869DC547D3D467B33E192ADD9BE4B_yes" name="custom_list_makerpro" value="yes" />
                <span for="list_6B5869DC547D3D467B33E192ADD9BE4B_yes" class="newcheckbox"></span>
              </label>
              <h4>Maker Pro</h4><p>The latest news about startups, products, incubators, and innovators</p>
              <hr />

              <label class="list-radio pull-right" data-toggle="tooltip" data-placement="right" title="Please choose at least one checkbox">
                <input type="checkbox" id="list_6B5869DC547D3D46E66DEF1987C64E7A_yes" name="custom_list_makerfaire" value="yes" />
                <span for="list_6B5869DC547D3D46E66DEF1987C64E7A_yes" class="newcheckbox"></span>
              </label>
              <h4>Maker Faire</h4><p>Keep up with the Greatest Show (&amp; Tell) on Earth</p>
              <hr />

              <label class="list-radio pull-right" data-toggle="tooltip" data-placement="right" title="Please choose at least one checkbox">
                <input type="checkbox" id="list_6B5869DC547D3D4637EA6E33C6C8170D_yes" name="custom_list_makeeducation" value="yes" />
                <span for="list_6B5869DC547D3D4637EA6E33C6C8170D_yes" class="newcheckbox"></span>
              </label>
              <h4>Make: Education</h4><p>How making is transforming learning</p>
              <hr />

              <label class="list-radio pull-right" data-toggle="tooltip" data-placement="right" title="Please choose at least one checkbox">
                <input type="checkbox" id="list_6B5869DC547D3D46072290AE725EC932_yes" name="custom_list_maker_share" value="yes" />
                <span for="list_6B5869DC547D3D46072290AE725EC932_yes" class="newcheckbox"></span>
              </label>
              <h4>Maker Share Community Updates</h4><p>Create. Connect. Learn.</p>
              <hr />

              <input class="btn-cyan" type="submit" value="Submit" />
              <div class="clearfix"></div>
            </form>
            <script>
              jQuery(document).on('submit', '#nlp-form', function (e) {
                e.preventDefault();
                // First check if any checkboxes are checked
                var anyBoxesChecked = false;
                jQuery('#nlp-form input[type="checkbox"]').each(function() {
                  if (jQuery(this).is(":checked")) {
                    anyBoxesChecked = true;
                  }
                });
                if (anyBoxesChecked == false) {
                  jQuery('.list-radio[data-toggle="tooltip"]').tooltip()
                  jQuery('.list-radio[data-toggle="tooltip"]').tooltip('show')
                  return false;
                }
                // Now get the email into the form and send
                else {
                  var nlpEmail = jQuery('#nlp-input').val();
                  jQuery('#nlp-form #email').val(nlpEmail);
                  if (jQuery('#nlp-form #email').val() == '') {
                    jQuery('#nlp-input').tooltip()
                    jQuery('#nlp-input').tooltip('show')
                    return false;
                  }
                  else {
                    jQuery.post('http://whatcounts.com/bin/listctrl', jQuery('#nlp-form').serialize());
                    var nlpDomain = document.domain;
                    location.href = '/?subscribed-to-make-newsletter';
                  }
                }
              });
            </script>

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