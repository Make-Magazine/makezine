<?php
/**
 * The Reviews section filters header
 */
?>
<section class="review-filters">

	<nav class="fl-filters-nav clearfix" aria-labelledby="show-filters-btn">

		<div class="fl-filters-header hidden-xs col-xs-12 col-lg-3">
			<h2 class="fl-header-title">Find the Perfect 3D Printer</h2>

			<div class="fl-header-description">Use the filters to find the perfect printer for your needs</div>
		</div>

		<form id="rf-filters-form" action="" class="fl-filters-list col-xs-12 col-lg-9">

			<div class="fl-group">

				<div class="fl-filter dropdown">
					<button id="fl-recommended-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
						<span>Make:</span> Recommendations <i class="fa fa-chevron-down"></i>
					</button>
					<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-recommended-btn">
						<label for="best-overall">
							<input id="best-overall" type="checkbox" name="winners" value="best-overall">
							<span>Best Overall</span>
						</label>
						<label for="best-value">
							<input id="best-value" type="checkbox" name="winners" value="best-value">
							<span>Best Value</span>
						</label>
						<label for="best-for-schools">
							<input id="best-for-schools" type="checkbox" name="winners" value="best-for-schools">
							<span>Best For Schools</span>
						</label>
						<label for="most-portable">
							<input id="most-portable" type="checkbox" name="winners" value="most-portable">
							<span>Most Portable</span>
						</label>
						<label for="outstanding-open-source">
							<input id="outstanding-open-source" type="checkbox" name="winners" value="outstanding-open-source">
							<span>Outstanding Open Source</span>
						</label>
						<label for="best-large-format">
							<input id="best-large-format" type="checkbox" name="winners" value="best-large-format">
							<span>Best Large Format</span>
						</label>
					</div>
				</div>

				<div class="fl-filter fl-build-volume dropdown">
					<button id="fl-build-volume-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
						Build Volume<i class="fa fa-chevron-down"></i>
					</button>
					<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-build-volume-btn">
						<label for="large">
							<input id="large" type="checkbox" name="build_volume_filter" value="large">
							<span>Large</span>
						</label>
						<label for="medium">
							<input id="medium" type="checkbox" name="build_volume_filter" value="medium">
							<span>Medium</span>
						</label>
						<label for="small">
							<input id="small" type="checkbox" name="build_volume_filter" value="small">
							<span>Small</span>
						</label>
					</div>
				</div><!-- .fl-build-volume -->

			</div>

			<div id="more-filters" class="more-filters" aria-labelledby="fl-more-options-btn">

				<div class="fl-group">

					<div class="fl-filter fl-bedstyle dropdown">
						<button id="fl-bedstyle-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
							Bed Style<i class="fa fa-chevron-down"></i>
						</button>
						<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-bedstyle-btn">
							<label for="heated">
								<input id="heated" type="checkbox" name="bed_style" value="heated">
								<span>Heated</span>
							</label>
							<label for="unheated">
								<input id="unheated" type="checkbox" name="bed_style" value="unheated">
								<span>Not Heated</span>
							</label>
						</div>
					</div><!-- .fl-bedstyle -->

					<div class="fl-filter fl-materials dropdown">
						<button id="fl-materials-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
							Materials<i class="fa fa-chevron-down"></i>
						</button>
						<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-materials-btn">
							<label for="proprietary">
								<input id="proprietary" type="checkbox" name="materials" value="proprietary">
								<span>Proprietary</span>
							</label>
							<label for="open">
								<input id="open" type="checkbox" name="materials" value="open">
								<span>Open</span>
							</label>
						</div>
					</div><!-- .fl-materials -->

				</div>
				<div class="fl-group">

						<div class="fl-filter fl-filament-size dropdown">
							<button id="fl-filament-size-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
								Filament Size<i class="fa fa-chevron-down"></i>
							</button>
							<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-filament-size-btn">
								<label for="mm175">
									<input id="mm175" type="checkbox" name="filament_size" value="1.75mm">
									<span>1.75 mm</span>
								</label>
								<label for="mm300">
									<input id="mm300" type="checkbox" name="filament_size" value="3mm">
									<span>3.00 mm</span>
								</label>
							</div>
						</div><!-- .fl-filament-size -->

						<div class="fl-filter fl-hotend dropdown">
							<button id="fl-hotend-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
								Hotend<i class="fa fa-chevron-down"></i>
							</button>
							<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-hotend-btn">
								<label for="standard">
									<input id="standard" type="checkbox" name="hot_end" value="standard">
									<span>Standard</span>
								</label>
								<label for="high-temp">
									<input id="high-temp" type="checkbox" name="hot_end" value="high-temp">
									<span>High Temp</span>
								</label>
							</div>
						</div><!-- .fl-hotend -->

					</div>
					<div class="fl-group">

						<div class="fl-filter fl-more-options dropdown">
							<button id="fl-more-options-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
								More Options<i class="fa fa-chevron-down"></i>
							</button>
							<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-more-options-btn">
								<label for="open-source-hardware">
									<input id="open-source-hardware" type="checkbox" name="open_source_hardware" value="1">
									<span>Open Source Hardware</span>
								</label>
								<label for="open-source-software">
									<input id="open-source-software" type="checkbox" name="open_source_software" value="1">
									<span>Open Source Software</span>
								</label>
								<hr />
								<label for="print-untethered">
									<input id="print-untethered" type="checkbox" name="print_untethered" value="1">
									<span>Print Untethered</span>
								</label>
								<label for="onboard-controls">
									<input id="onboard-controls" type="checkbox" name="onboard_controls" value="1">
									<span>Onboard Controls</span>
								</label>
								<label for="temp-controls">
									<input id="temp-controls" type="checkbox" name="temperature_control" value="1">
									<span>Temp Controls</span>
								</label>
								<hr />
								<label for="os-mac">
									<input id="os-mac" type="checkbox" name="os" value="mac">
									<span>OS: Mac</span>
								</label>
								<label for="os-windows">
									<input id="os-windows" type="checkbox" name="os" value="windows">
									<span>OS: Windows</span>
								</label>
								<label for="os-linux">
									<input id="os-linux" type="checkbox" name="os" value="linux">
									<span>OS: Linux</span>
								</label>
							</div>
						</div><!-- .fl-more-options -->
            <div style="display:none" class="fl-filter fl-extruder dropdown">
							<button id="fl-extruder-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
								EXTRUDER<i class="fa fa-chevron-down"></i>
							</button>
							<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-extruder-btn">
								<label for="single">
									<input id="single" type="checkbox" name="extruder" value="single">
									<span>Single</span>
								</label>
								<label for="multi">
									<input id="multi" type="checkbox" name="extruder" value="multi">
									<span>
                  Multi</span>
								</label>
							</div>
						</div><!-- .fl-hotend -->


					</div><!-- .fl-group -->

				</div><!-- .more-filters -->

			<div class="fl-actions visible-xs-block">
				<div class="fl-actions-wrap">
					<button id="filters-cancel-btn" type="button" class="filters-cancel-btn btn btn-default">Cancel</button>
					<button id="filters-apply-btn" type="submit" class="filters-apply-btn btn btn-primary">Apply</button>
				</div>
			</div><!-- .fl-actions -->

		</form><!-- .filters-list -->

	</nav><!-- .filters-nav -->

	<div class="fl-filters-selected clearfix">
		<h3 class="screen-reader-text sr-only">Selected Filters:</h3>

		<div class="fs-selected">

		</div><!-- .fs-seletcted -->
		<button id="rf-reset-btn" type="reset" class="rf-reset-btn btn btn-link">Reset Filters</button>
	</div>

</section><!-- .review-filters -->