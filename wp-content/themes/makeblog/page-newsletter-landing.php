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
            <input type="email" id="nlp-input" class="form-control" placeholder="Enter your email address" required />

          </div>

        </div>

      </div>


      <div class="row nlp-bottom">

        <div class="container">

          <div class="col-sm-8 col-md-6 col-lg-4 col-sm-offset-2 col-md-offset-3 col-lg-offset-4">

            <form id="nlp-form" class="nlp-form" action="http://whatcounts.com/bin/listctrl" method="POST">
              <input type="hidden" name="slid_1" value="6B5869DC547D3D46B52F3516A785F101"/><!-- Make: Newsletter -->
              <input type="hidden" name="slid_2" value="6B5869DC547D3D46941051CC68679543" /><!-- Maker Media Newsletter -->
              <input type="hidden" name="cmd" value="subscribe" />
              <input type="hidden" name="multiadd" value="1" />
              <input type="hidden" id="email" name="email" value="" />
              <input type="hidden" id="format_mime" name="format" value="mime" />
              <input type="hidden" name="goto" value="" />
              <input type="hidden" name="custom_source" value="landing-page_signup" />
              <input type="hidden" name="custom_incentive" value="none" />
              <input type="hidden" name="custom_url" value="makezine.com/join" />
              <input type="hidden" id="format_mime" name="format" value="mime" />
              <input type="hidden" name="custom_host" value="makezine.com" />

              <label class="list-radio pull-right" data-toggle="tooltip" data-placement="right" title="Please choose at least one checkbox">
                <input type="checkbox" id="list_6B5869DC547D3D467B33E192ADD9BE4B_yes" name="slid_3" value="6B5869DC547D3D467B33E192ADD9BE4B" />
                <span for="list_6B5869DC547D3D467B33E192ADD9BE4B_yes" class="newcheckbox"></span>
              </label>
              <h4>Make:</h4><p>The best stuff each week from Make: magazine</p>
              <hr />

              <label class="list-radio pull-right" data-toggle="tooltip" data-placement="right" title="Please choose at least one checkbox">
                <input type="checkbox" id="list_6B5869DC547D3D467B33E192ADD9BE4B_yes" name="slid_4" value="6B5869DC547D3D467B33E192ADD9BE4B" />
                <span for="list_6B5869DC547D3D467B33E192ADD9BE4B_yes" class="newcheckbox"></span>
              </label>
              <h4>Maker Pro</h4><p>The latest news about startups, products, incubators, and innovators</p>
              <hr />

              <label class="list-radio pull-right" data-toggle="tooltip" data-placement="right" title="Please choose at least one checkbox">
                <input type="checkbox" id="list_6B5869DC547D3D46E66DEF1987C64E7A_yes" name="slid_5" value="6B5869DC547D3D46E66DEF1987C64E7A" />
                <span for="list_6B5869DC547D3D46E66DEF1987C64E7A_yes" class="newcheckbox"></span>
              </label>
              <h4>Maker Faire</h4><p>Keep up with the Greatest Show (&amp; tell) on Earth</p>
              <hr />

              <label class="list-radio pull-right" data-toggle="tooltip" data-placement="right" title="Please choose at least one checkbox">
                <input type="checkbox" id="list_6B5869DC547D3D46510F6AB3E701BA0A_yes" name="slid_6" value="6B5869DC547D3D46510F6AB3E701BA0A" />
                <span for="list_6B5869DC547D3D46510F6AB3E701BA0A_yes" class="newcheckbox"></span>
              </label>
              <h4>Maker Shed</h4><p>Be the first to learn about new products, plus exclusive discounts</p>
              <hr />

              <input class="btn-cyan" type="submit" value="Submit" />
              <div class="clearfix"></div>
            </form>
            <script>
              $(document).on('submit', '#nlp-form', function (e) {
                e.preventDefault();
                // First check if any checkboxes are checked
                var anyBoxesChecked = false;
                $('#nlp-form input[type="checkbox"]').each(function() {
                  if ($(this).is(":checked")) {
                    anyBoxesChecked = true;
                  }
                });
                if (anyBoxesChecked == false) {
                  $('[data-toggle="tooltip"]').tooltip()
                  $('[data-toggle="tooltip"]').tooltip('show')
                  return false;
                }
                // Now get the email into the form and send
                else {
                  var nlpEmail = $('#nlp-input').val();
                  $('#nlp-form #email').val(nlpEmail);
                  $.post('http://whatcounts.com/bin/listctrl', $('#nlp-form').serialize());
                  var nlpDomain = document.domain;
                  window.location.href = nlpDomain+'/?subscribed-to-make-newsletter';
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