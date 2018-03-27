<?php
/**
 * Template Name: Calendar page /calendar
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Cole Geissinger <cgeissinger@makermedia.com>
 * 
 */
get_header('universal'); ?>
    
  <div class="single calendar-page">
  
    <div class="container">

      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                  
        <div class="row">
        
          <div class="col-xs-12">
          
            <article <?php post_class(); ?>>

              <?php the_content(); ?>

              <button class="recommend-event-btn btn-cyan hidden">Have an event to recommend?</button>
            
            </article>
            
          </div>
          
        </div>
      
      <?php endwhile; else: ?>

        <div class="row">
        
          <div class="col-xs-12">
            
              <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
            
          </div>
            
        </div>

      <?php endif; ?>

    </div>

    <div class="fancybox-recommend-event" style="display:none;">
      <div class="fancybox-recommend-event-inner">
        <div class="fancybox-recommend-event-inner1">
          <h3>Tell us about your event!</h3>
          <p>Be sure to include the location, date, time, a brief description of what the event is, and any website links where people can learn more</p>
          <form id="form15" name="form15" accept-charset="UTF-8" enctype="multipart/form-data" method="post" novalidate action="//makemagazine.wufoo.com/forms/zrlckye0ok7ijr/#public">
            <div class="form-group">
              <label for="exampleInputName1">Name</label>
              <input type="text" class="form-control" id="Field1" name="Field1" placeholder="Name">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address for follow up</label>
              <input type="email" class="form-control" id="Field2" name="Field2" placeholder="Email">
            </div>
            <div class="form-group">
              <label>Tell us about your event</label>
              <textarea class="form-control" id="Field3" name="Field3" spellcheck="true" rows="3" required></textarea>
            </div>
            <input id="saveForm" name="saveForm" class="recommend-event-submit btn-cyan" type="submit" value="Submit" />
            <input type="hidden" id="idstamp" name="idstamp" value="IY4kuvhYZT1VvyaShPNoKbpogvZnZNDXkrQnPb4sQZg=" />
          </form>
        </div>
        <div class="fancybox-recommend-event-inner2" style="display:none;">
          <h3>Thank you</h3>
          <p>We can't guarantee a response to each submission, but we promise to think about every one.</p>
        </div>
      </div>
    </div>

  </div>

  <script>
    // Recommend event for calendar, submits to Wufoo
    jQuery(".recommend-event-btn").click(function() {
      jQuery(".fancybox-recommend-event").fancybox({
        autoSize : false,
        width  : 560,
        autoHeight : true,
        padding : 0,
        openEffect : 'elastic',
        afterLoad   : function() {
          this.content = this.content.html();
        }
      });
      jQuery(".fancybox-recommend-event").trigger('click');
    });

    // Feedback form submit event handler
    jQuery(document).on('submit', '#form15', function (e) {
      event.preventDefault();
      jQuery.ajax({
        url:'//makemagazine.wufoo.com/forms/zrlckye0ok7ijr/#public',
        type:'POST',
        data:jQuery(this).serialize()
      });
      jQuery('.fancybox-recommend-event-inner1').hide();
      jQuery('.fancybox-recommend-event-inner2').show();
    });

    // Next month button message if no future events
    jQuery( document ).ready(function() {
      jQuery('.tribe-events-nav-next:not(:has(a))').text('no more future events').addClass('btnEmpty');
    });
    </script>

<?php get_footer(); ?>