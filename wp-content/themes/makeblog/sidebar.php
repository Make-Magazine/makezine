<?php
/**
 * The generic sidebar template
 *
 * We use this template for just about everything.
 * // TODO: Consolidate the other files into this one using some conditionals.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 */
?>

					<div class="span4 sidebar">

						<div class="sidebar-ad">

							<?php global $make; print $make->ads->ad_300x250_atf; ?>

						</div>

						<?php dynamic_sidebar( 'sidebar_top' ); ?>

						<div class="maker-camp-promo">
							<?php

								if( is_single( array( '53649' ))) {
									echo '<a href="http://www.makershed.com/products/el-wire-starter-packs-10ft?utm_source=makezine.com&utm_medium=ads&utm_campaign=maker-camp&utm_keyword=El_Wire_Starter_Packs_10ft" target="_blank"><img src="https://makezineblog.files.wordpress.com/2014/07/elwire.gif" alt="EL-Wire Starter Pack from Maker Shed" /></a>';
								}
							 ?>
						</div>

						<div class="new-dotw widget">
							<?php global $make; print $make->ads->ad_300x250_shed; ?>
						</div>

						<div class="sidebar-ad">
							<div id="pubexchange_rail"></div>
						</div>
						
						<div class="sidebar-ad">

							<?php global $make; print $make->ads->ad_300x250_house; ?>

						</div>

						<?php dynamic_sidebar( 'sidebar_bottom' ); ?>


				</div>