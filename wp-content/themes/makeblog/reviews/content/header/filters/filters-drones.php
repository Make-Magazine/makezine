<?php
/**
 * The Reviews section filters header
 */
?>
<div class="row">
	<section class="review-filters col-xs-12" aria-labelledby="show-filters-btn">

		<nav class="fl-filters-nav clearfix">

			<div class="fl-filters-header col-sm-12 col-md-3 hidden-xs">
				<h2 class="fl-header-title">Find the Right Drone</h2>

				<div class="fl-header-description">Use the filters to determine the best fit</div>
			</div>

			<form id="rf-filters-form" action="" class="fl-filters-list col-xs-12 col-md-9 col-lg-8 col-lg-offset-1">

				<div class="fl-group">

					<div class="fl-filter  dropdown">
						<button id="fl-recommended-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true"
						        aria-expanded="false">
							<span>Make:</span> Recommendations <i class="fa fa-chevron-down"></i>
						</button>
						<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-recommended-btn">
							<label for="overall">
               	<input id="overall" type="checkbox" name="winners" value="overall">
								<span>Best Overall</span>
							</label>
							<label for="beginners">
								<input id="beginners" type="checkbox" name="winners" value="beginners">
								<span>Best for Beginners</span>
							</label>
							<label for="hackable">
								<input id="hackable" type="checkbox" name="winners" value="hackable">
								<span>Most Hackable</span>
							</label>
						</div>
					</div>
					

				</div>
          <!-- Camera Type 'builtin' => 'Built-In',
						'gopro'   => 'GoPro', -->
				<div id="more-filters" class="more-filters" aria-labelledby="fl-more-options-btn">
					<div class="fl-group">

						<div class="fl-filter fl-cameratype dropdown">
							<button id="fl-cameratype-btn" class="dropdown-toggle btn btn-link"
                      data-toggle="dropdown" type="button" aria-haspopup="true"
							        aria-expanded="false">
								Camera Type<i class="fa fa-chevron-down"></i>
							</button>
							<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-cameratype-btn">
								<label for="builtin">
									<input id="builtin" type="checkbox" name="builtin" value="1">
									<span>Built-In</span>
								</label>
								<label for="gopro">
									<input id="gopro" type="checkbox" name="gopro" value="1">
                  <span>GoPro</span>
								</label>
							</div>
						</div>
						<!-- .fl-materials -->
            <!-- Camera Resolution 
            '4k'   => '4K',
						'variable'  => 'Variable',
						'27k'  => '2.7K',
						'1080p' => '1080p', -->
						<div class="fl-filter fl-filament-size dropdown">
							<button id="fl-filament-size-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true"
							        aria-expanded="false">
								Camera Resolution<i class="fa fa-chevron-down"></i>
							</button>
							<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-filament-size-btn">
								<label for="4k">
									<input id="4k" type="checkbox" name="cameraresolution" value="4k">
									<span>4K</span>
								</label>
								<label for="variable">
									<input id="variable" type="checkbox" name="cameraresolution" value="variable">
									<span>Variable</span>
								</label>
								<label for="27k">
									<input id="27k" type="checkbox" name="cameraresolution" value="27k">
									<span>2.7K</span>
								</label>
								<label for="1080p">
									<input id="1080p" type="checkbox" name="cameraresolution" value="1080p">
									<span>1080p</span>
								</label>
							</div>
						</div>
						<!-- .fl-filament-size -->

					</div>
          <!-- batterylife '0'           => '0-7 minutes',
						'1'           => '7-15 minutes',
						'2'           => '15-20 minutes',
						'3'           => '20+ minutes', -->
					<!-- .fl-group -->
					<div class="fl-group">

						<div class="fl-filter fl-bedstyle dropdown">
							<button id="fl-pinsd-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true"
							        aria-expanded="false">
								Battery Life<i class="fa fa-chevron-down"></i>
							</button>
							<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-pinsd-btn">
								<label for="batterylife-0">
									<input id="batterylife-0" type="checkbox" name="batterylife" value="0">
									<span>0-7 minutes</span>
								</label>
								<label for="batterylife-1">
									<input id="batterylife-1" type="checkbox" name="batterylife" value="1">
									<span>7-15 minutes</span>
								</label>
								<label for="batterylife-2">
									<input id="batterylife-2" type="checkbox" name="batterylife" value="2">
									<span>15-20 minutes</span>
								</label>
								<label for="batterylife-3">
									<input id="batterylife-3" type="checkbox" name="batterylife" value="3">
									<span>20+ minutes</span>
								</label>
								
							</div>
						</div>
						<!-- .fl-bedstyle -->
            <!-- .fl-recommended -->
          <!-- '0'               => "0-600'",
						'1'               => "601'-1200'",
						'2'               => "1201'-3000'",
						'3'               => "3001+", -->
					<div class="fl-filter fl-bedstyle dropdown">
						<button id="fl-bedstyle-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true"
						        aria-expanded="false">
							Range<i class="fa fa-chevron-down"></i>
						</button>
						<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-bedstyle-btn">
							<label for="range-0">
								<input id="range-0" type="checkbox" name="range" value="0">
								<span>0-600'</span>
							</label>
							<label for="range-1">
								<input id="range-1" type="checkbox" name="range" value="1">
								<span>601'-1200'</span>
							</label>
							<label for="range-2">
								<input id="range-2" type="checkbox" name="range" value="2">
								<span>1201'-3000'</span>
							</label>
              <label for="range-3">
								<input id="range-3" type="checkbox" name="range" value="3">
								<span>3001+</span>
							</label>
						</div>
					</div>
					<!-- .fl-bedstyle -->

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