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

							<?php global $make; print $make->ads->ad_300x250_atf; ?>

						</div>

						<div class="new-dotw widget">
							<?php global $make; print $make->ads->ad_300x250_shed; ?>
						</div>

						<div class="sidebar-ad">

							<!-- Beginning Sync AdSlot 3 for Ad unit header ### size: [[300,250]]  -->
							<?php global $make; print $make->ads->ad_300x250; ?>
