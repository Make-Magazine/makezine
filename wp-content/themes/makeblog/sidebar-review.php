<?php
/**
 * Sidebar for Projects Page
 *
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 */
?>
<div class="col-md-4 sidebar">
   <div class="sidebar-ad">
      <?php if(!isset($_COOKIE['cookielawinfo-checkbox-non-necessary']) || $_COOKIE['cookielawinfo-checkbox-non-necessary'] == "yes" ) { 
				global $make;
      			print $make->ads->ad_300x250_atf; 
			} ?>
   </div>

   <?php
   global $post;
   $meta = get_post_meta(get_the_ID(), 'hide');
   if ('review' == get_post_type() && (empty($meta[0]) == 'on')) {
      ?>
      <div class="drill side">
         <div class="inner">
            <h3>Narrow Your Search</h3>
            <ul id="sidebar">
   <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar()) : ?>
   <?php endif; ?>
            </ul>
         </div>
      </div>

<?php } ?>

   <div class="sidebar-ad">
      <?php global $make;
      print $make->ads->ad_300x250_atf; ?>
   </div>
</div>
