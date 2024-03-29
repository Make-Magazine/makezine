<?php
/**
 * The Reviews section filters header
 */

$filter = get_field('filter_group');

if($filter != "none") {

	$field_group = acf_get_fields($filter);
	// These two groupings of select fields will be treated differently
	$more_options = [];
	$boolean_options = [];
	
?>
<section class="review-filters">

	<nav class="fl-filters-nav clearfix" aria-labelledby="show-filters-btn">

		<div class="fl-filters-header hidden-xs col-xs-12 col-lg-3">
			<h2 class="fl-header-title"><?php echo(get_field('filter_title')); ?></h2>

			<div class="fl-header-description"><?php echo(get_field('filter_description')); ?></div>
		</div>

		<form id="rf-filters-form" action="" class="fl-filters-list col-xs-12 col-lg-9">

			<div class="fl-group">
				
			  <?php 
				foreach ($field_group as &$field) {
					if($field['wrapper']['class'] == "more-options") { // fields with the more-options class will be grouped last
						array_push($more_options, $field); 
					} else {
			  ?>
				<div class="fl-filter fl-<?php echo($field['name']); ?> dropdown">
					<button id="fl-recommended-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
						<?php echo($field['label']); ?> <i class="fa fa-chevron-down"></i>
					</button>
					<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-more-options-btn">
				  <?php 
					 $options = $field['choices'];
					 foreach ($options as $key => $value) {
				  ?>
					  <label for="<?php echo($key); ?>">
							<input id="<?php echo($key); ?>" type="checkbox" name="<?php echo($field['name']); ?>" value="<?php echo($key); ?>">
							<span><?php echo($value); ?></span>
					  </label>
				  <?php
					 }
				  ?>
				   </div>
				</div>
			  <?php
					}
				}
				if(!empty($more_options)){ 
			  ?>
				<div id="more-filters" class="fl-filter more-filters" aria-labelledby="fl-more-options-btn">
					<div class="fl-sub-group">
						<div class="fl-more-options dropdown">
							<button id="fl-more-options-btn" class="dropdown-toggle btn btn-link" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="true">
								More Options<i class="fa fa-chevron-down"></i>
							</button>
							<div class="fl-filter-options dropdown-menu dropdown-menu-right" aria-labelledby="fl-more-options-btn">
							<?php
							  foreach ($more_options as &$sub_select) {
								  $sub_options = $sub_select['choices'];
							?>
								 <div class="option-wrapper <?php echo($sub_select['name']); ?> <?php if($sub_select['wrapper']['id']) { echo($sub_select['wrapper']['id']); } ?>" >
							<?php
								  foreach ($sub_options as $key => $value) { 
									  if($key != "0" && $key != "1") {
							?>
									  <label for="<?php echo($key); ?>" class="non-boolean">
											<input id="<?php echo($key); ?>" type="checkbox" name="<?php echo($sub_select['name']); ?>" value="<?php echo(str_replace("os-","",$key)); ?>">
											<span><?php echo($value); ?></span>
									  </label>
							<?php
									  }else if($key != "0"){
							?>
								     <label for="<?php echo($sub_select['name']); ?>">
											<input id="<?php echo($sub_select['name']); ?>" type="checkbox" name="<?php echo($sub_select['name']); ?>" value="<?php echo($key); ?>">
											<span><?php echo($sub_select['label']); ?></span>
									  </label>
							<?php
									  }
								  }
								  ?>
								</div>
								<?php 
							  }
							?>
							</div>
						</div>
					</div>
				</div>
			  <?php
				}
			  ?>

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
	
<?php } //end if filter = none ?>