<?php
/**
 * The Reviews section filters header
 */
?>
<div class="row">
	<section class="review-filters col-xs-12" aria-labelledby="show-filters-btn">

		<nav class="fl-filters-nav clearfix">

			<div class="fl-filters-header col-sm-12 col-md-3 hidden-xs">
				<h2 class="fl-header-title">Find the Right Board</h2>

				<div class="fl-header-description">Use the filters to determine the best fit for your project</div>
			</div>

			<form id="rf-filters-form" action="" class="fl-filters-list col-xs-12 col-md-9 col-lg-8 col-lg-offset-1">

				<div class="fl-group">

					<div class="fl-filter  dropdown">
						<button id="fl-recommended-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true"
						        aria-expanded="false">
							<span>Make:</span> Recommendations <i class="fa fa-chevron-down"></i>
						</button>
						<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-recommended-btn">
							<label for="robotics">
								<input id="robotics" type="checkbox" name="winners" value="robotics">
								<span>Robotics</span>
							</label>
							<label for="wearables">
								<input id="wearables" type="checkbox" name="winners" value="wearables">
								<span>Wearables</span>
							</label>
							<label for="education">
								<input id="education" type="checkbox" name="winners" value="education">
								<span>Education</span>
							</label>
							<label for="light-and-sound">
								<input id="light-and-sound" type="checkbox" name="winners" value="light-and-sound">
								<span>Light and Sound</span>
							</label>
							<label for="home-automation">
								<input id="home-automation" type="checkbox" name="winners" value="home-automation">
								<span>Home Automation</span>
							</label>
							<label for="sub-10">
								<input id="sub-10" type="checkbox" name="winners" value="sub-10">
								<span>Dirt Cheap</span>
							</label>
						</div>
					</div>
					<!-- .fl-recommended -->

					<div class="fl-filter fl-bedstyle dropdown">
						<button id="fl-bedstyle-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true"
						        aria-expanded="false">
							Type<i class="fa fa-chevron-down"></i>
						</button>
						<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-bedstyle-btn">
							<label for="microcontroller">
								<input id="microcontroller" type="checkbox" name="type" value="microcontroller">
								<span>Microcontroller</span>
							</label>
							<label for="single-board-computer">
								<input id="single-board-computer" type="checkbox" name="type" value="single-board-computer">
								<span>Single Board Computer</span>
							</label>
							<label for="fpga">
								<input id="fpga" type="checkbox" name="type" value="fpga">
								<span>FPGA</span>
							</label>
						</div>
					</div>
					<!-- .fl-bedstyle -->

				</div>

				<div id="more-filters" class="more-filters" aria-labelledby="fl-more-options-btn">
					<div class="fl-group">

						<div class="fl-filter fl-materials dropdown">
							<button id="fl-materials-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true"
							        aria-expanded="false">
								Software<i class="fa fa-chevron-down"></i>
							</button>
							<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-materials-btn">
								<label for="arduino">
									<input id="arduino" type="checkbox" name="software" value="arduino">
									<span>Arduino</span>
								</label>
								<label for="linux">
									<input id="linux" type="checkbox" name="software" value="linux">
									<span>Linux</span>
								</label>
								<label for="other">
									<input id="other" type="checkbox" name="software" value="other">
									<span>Other</span>
								</label>
							</div>
						</div>
						<!-- .fl-materials -->

						<div class="fl-filter fl-filament-size dropdown">
							<button id="fl-filament-size-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true"
							        aria-expanded="false">
								Clock Speed<i class="fa fa-chevron-down"></i>
							</button>
							<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-filament-size-btn">
								<label for="8MHz">
									<input id="8MHz" type="checkbox" name="clock_speed" value="8MHz">
									<span>8 MHz+</span>
								</label>
								<label for="16MHz">
									<input id="16MHz" type="checkbox" name="clock_speed" value="16MHz">
									<span>16 MHz+</span>
								</label>
								<label for="32MHz">
									<input id="32MHz" type="checkbox" name="clock_speed" value="32MHz">
									<span>32 MHz+</span>
								</label>
								<label for="100MHz">
									<input id="100MHz" type="checkbox" name="clock_speed" value="100MHz">
									<span>100 MHz+</span>
								</label>
								<label for="1GHz">
									<input id="1GHz" type="checkbox" name="clock_speed" value="1GHz">
									<span>1 GHz+</span>
								</label>

							</div>
						</div>
						<!-- .fl-filament-size -->

					</div>
					<!-- .fl-group -->
					<div class="fl-group">

						<div class="fl-filter fl-bedstyle dropdown">
							<button id="fl-pinsd-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true"
							        aria-expanded="false">
								I/O Pins Digital<i class="fa fa-chevron-down"></i>
							</button>
							<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-pinsd-btn">
								<label for="1-10">
									<input id="1-10" type="checkbox" name="pins_digital" value="1-10">
									<span>1-10</span>
								</label>
								<label for="11-20">
									<input id="11-20" type="checkbox" name="pins_digital" value="11-20">
									<span>11-20</span>
								</label>
								<label for="21-50">
									<input id="21-50" type="checkbox" name="pins_digital" value="21-50">
									<span>21-50</span>
								</label>
								<label for="50+">
									<input id="50+" type="checkbox" name="pins_digital" value="50+">
									<span>50+</span>
								</label>
							</div>
						</div>
						<!-- .fl-bedstyle -->

						<div class="fl-filter fl-bedstyle dropdown">
							<button id="fl-pinsa-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true"
							        aria-expanded="false">
								I/O Pins Analog<i class="fa fa-chevron-down"></i>
							</button>
							<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-pinsa-btn">
								<label for="none">
									<input id="none" type="checkbox" name="pins_analog" value="">
									<span>None</span>
								</label>
								<label for="1-3">
									<input id="1-3" type="checkbox" name="pins_analog" value="1-3">
									<span>1-3</span>
								</label>
								<label for="4-6">
									<input id="4-6" type="checkbox" name="pins_analog" value="4-6">
									<span>4-6</span>
								</label>
								<label for="7-12">
									<input id="7-12" type="checkbox" name="pins_analog" value="7-12">
									<span>7-12</span>
								</label>
								<label for="13+">
									<input id="13+" type="checkbox" name="pins_analog" value="13+">
									<span>13+</span>
								</label>
							</div>
						</div>
						<!-- .fl-bedstyle -->


					</div>
					<!-- .fl-group -->
					<div class="fl-group">

						<div class="fl-filter fl-hotend dropdown">
							<button id="fl-hotend-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true"
							        aria-expanded="false">
								Processor<i class="fa fa-chevron-down"></i>
							</button>
							<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-hotend-btn">
								<label for="8bit">
									<input id="8bit" type="checkbox" name="processor" value="8bit">
									<span>8-bit</span>
								</label>
								<label for="32bit">
									<input id="32bit" type="checkbox" name="processor" value="32bit">
									<span>32-bit</span>
								</label>
								<label for="64bit">
									<input id="64bit" type="checkbox" name="processor" value="64bit">
									<span>64-bit</span>
								</label>

							</div>
						</div>
						<!-- .fl-hotend -->

						<div class="fl-filter fl-more-options dropdown">
							<button id="fl-more-options-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true"
							        aria-expanded="false">
								More Options<i class="fa fa-chevron-down"></i>
							</button>
							<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-more-options-btn">
								<label for="wifi">
									<input id="wifi" type="checkbox" name="wifi" value="1">
									<span>WiFi</span>
								</label>
								<label for="video">
									<input id="video" type="checkbox" name="video" value="1">
									<span>Video</span>
								</label>
								<label for="bluetooth">
									<input id="bluetooth" type="checkbox" name="bluetooth" value="1">
									<span>Bluetooth</span>
								</label>
								<label for="ethernet">
									<input id="ethernet" type="checkbox" name="ethernet" value="1">
									<span>Ethernet</span>
								</label>
							</div>
						</div>
						<!-- .fl-more-options -->

					</div>
					<!-- .fl-group -->
				</div>
				<!-- .more-filters -->

				<button id="more-filters-btn" class="more-filters-btn btn btn-default visible-xs-block" type="button" aria-haspopup="true"
				        aria-expanded="false">More Filters
				</button>

				<div class="fl-actions visible-xs-block">
					<div class="fl-actions-wrap">
						<button id="filters-cancel-btn" type="button" class="filters-cancel-btn btn btn-default">Cancel</button>
						<button id="filters-apply-btn" type="submit" class="filters-apply-btn btn btn-primary">Apply</button>
					</div>
				</div>
				<!-- .fl-actions -->

			</form>
			<!-- .filters-list -->

		</nav>
		<!-- .filters-nav -->

		<div class="fl-filters-selected hidden-xs clearfix">
			<h3 class="screen-reader-text sr-only">Selected Filters:</h3>

			<div class="fs-selected">

			</div>
			<!-- .fs-seletcted -->
			<button id="rf-reset-btn" type="reset" class="rf-reset-btn btn btn-link">Reset Filters</button>
		</div>

	</section>
	<!-- .review-filters -->
</div>