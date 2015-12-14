<?php
/**
 * The search sidebar template
 *
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 */
?>
					<div class="span4">

						<?php dynamic_sidebar( 'search' ); ?>

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

					</div>