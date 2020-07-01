<?php
/**
 * The search sidebar template
 *
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 */
?>
					<div class="hidden-xs col-sm-12 col-md-4">

						<?php dynamic_sidebar( 'search' ); ?>
						<?php if(!isset($_COOKIE['cookielawinfo-checkbox-non-necessary']) || $_COOKIE['cookielawinfo-checkbox-non-necessary'] == "yes" ) { ?>
							<div class="sidebar-ad">
								<p id="ads-title">Advertisement</p>
								<?php global $make; print $make->ads->ad_300x250_atf; ?>
							</div>

							<div class="new-dotw widget">
								<p id="ads-title">Advertisement</p>
								<?php global $make; print $make->ads->ad_300x250_shed; ?>
							</div>

							<div class="sidebar-ad">
								<p id="ads-title">Advertisement</p>
								<?php global $make; print $make->ads->ad_300x250_house; ?>
							</div>
						<?php } // end cookie law if ?>

					</div>