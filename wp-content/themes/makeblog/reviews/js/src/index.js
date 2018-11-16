/**
 * Product Reviews theme JavaScript
 */

var ReviewsFilters = {
	filters_data: {},
	remote_data: {},
	ajax_url: MakeReviews.ajax_url, // jshint ignore:line
	ajax_action: MakeReviews.ajax_action, // jshint ignore:line
	post_id: MakeReviews.post_id, // jshint ignore:line
	form_id: '#rf-filters-form',
	selected_class: '.fl-filters-selected .fs-selected',
	selected: '.fl-filters-selected',
	apply_button:'#filters-apply-btn',
	sort_apply_button:'#sort-apply-btn',
	no_results:'.no-results',
	items:'.reviews-items',
	item:'.reviews-item',
	model:'.reviews-item.reviews-model',
	sort_form_id:'#rl-sort-form',
	sortby:'recent',
   order: 'desc',
	loading_class: 'filters-loading'
};

(function ($, filters) {

	'use strict';

	filters.update_records = function () {
		$(filters.item + ":visible").remove();

		if (! filters.remote_data.length) {
			$(filters.no_results).show();
		} else {
			$(filters.no_results).hide();
			
			$('#count').html("(" + filters.remote_data.length + ")");
			
			$.each(filters.remote_data, function(i,v){
				var row = $(filters.model).clone();
				row.removeClass('reviews-model');
				row.find('.ri-item-title').html(v.title);
            row.find('.ri-item-subtitle').html(v.subtitle);
				row.find('.ri-score-price').find('.ri-price span').html(v.price);
				if(v.most_recent) {
					var date = new Date(v.most_recent);
					var formattedDate = (date.getMonth() + 1) + '/' + date.getDate() + '/' +  date.getFullYear();
					row.find('.ri-date').html(formattedDate);
				}
				row.find('.ri-type').html(v.type);
				row.find('.ri-score-price').find('.ri-score span').html(v.score + '%');
				if (v.buy_url) {
					row.find('.ri-score-price').find('.ri-buy-now a').attr("href", v.buy_url);
					row.find('.ri-score-price').find('.ri-buy-now').show().css('display', 'flex');
				}
				row.find('.ri-feature-image a').css('background-image', 'url(' + v.thumbnail + ')');
				row.find('.ri-link').attr('href', v.link);

				if (v.winner) {
					row.find('.ri-item-meta').append(v.winner);
					row.addClass('winner');
				}

				$(filters.items).append(row);
			});

		}

	};

	filters.update = function () {
		sessionStorage.setItem("filters_data", JSON.stringify(filters.filters_data));
		filters._update_selected_filter_list();
		filters._update_from_remote();
	};


	filters.reset = function () {
		filters.filters_data = [];
		filters.update();
	};

	filters.form_change = function () {
		var data = {};
		var form = $(filters.form_id);

		$.each(form.serializeArray(), function (i, field) {

			if (! data[field.name]) {
				data[field.name] = [];
			}

			data[field.name].push(field.value);
		});

		filters.filters_data = data;
		filters.update();
	};

	filters.delete_selected_filter = function () {
		var button = $(this),
			option = button.attr('data-option'),
			value = button.attr('data-value');

		$('input[name="' + option + '"][value="' + value + '"]').attr('checked', false);

		var index = filters.filters_data[option].indexOf(value);
		filters.filters_data[option].splice(index, 1);

		if (! filters.filters_data[option].length) {
			delete filters.filters_data[option];
		}

		filters.update();
	};

	filters.sort_change = function(){
    var ascSorted = false;
    //find current sort order
    if ($(this).hasClass('asc')){
      ascSorted = true;
    }

    //remove sort icons from all sort headers
    $(filters.sort_form_id + ' .rl-sort-choice').removeClass('asc');
    $(filters.sort_form_id + ' .rl-sort-choice').removeClass('dsc');

    //set sort order. if not set, set it to ascending. if previously ascending, set to descending
    if (ascSorted){
      $(this).addClass('dsc');
      filters.order = 'desc';
    } else {
      $(this).addClass('asc');
      filters.order = 'asc';
    }

		filters.sortby = $(this).find(':input').val();
		sessionStorage.setItem("sort", filters.sortby);

		filters._update_from_remote();
    return false;
	};

	filters._update_selected_filter_list = function () {
		var container = $(filters.selected_class);
		container.empty();

		var callback = function (_, v) {
			var option_name = $('input[name="' + item + '"][value="' + v + '"]').parent().find('span').html();

			container.append(
				$('<button>').addClass('fs-selected-btn btn btn-link')
				.attr('data-option', item)
				.attr('data-value', v)
				.html('<i class="fa fa-times"></i>' + option_name)
			);
		};

		if (Object.keys(filters.filters_data).length) {
			for (var item in filters.filters_data) {

				if (! filters.filters_data.hasOwnProperty(item)) {
					continue;
				}

				$.each(filters.filters_data[item], callback);

			}
			container.parent().show();
		} else {
			container.parent().hide();
		}

	};

	filters._update_from_remote = function () {

		var opts = {
			action: 'reviews-filters',
			post_id: filters.post_id,
			filters: filters.filters_data,
			sort: filters.sortby,
      order: filters.order
		};

		$('body').addClass(filters.loading_class);
		$.post(filters.ajax_url, opts, function (response) {

			if (response.success) {
				filters.remote_data = response.data;
				filters.update_records();
			}

			$('body').removeClass(filters.loading_class);

		});
	};

	filters.load_stored_data = function () {
		var stored_filters = sessionStorage.getItem("filters_data");

		if (stored_filters) {
			filters.filters_data = JSON.parse(stored_filters);
		}

		var stored_sort = sessionStorage.getItem("sort");
		if (stored_sort) {
			filters.sortby = stored_sort;
			$('input[name="sort"][value="' + stored_sort + '"]').attr('checked', true);
		}

	};

	$(document).ready(function () {
		$(filters.sort_form_id + ' span.rl-sort-choice').on('click', filters.sort_change);

		$(filters.form_id + ' :input').on('change', filters.form_change);
		$(filters.form_id).on('reset', filters.reset);
		$(filters.selected_class).on('click', 'button', filters.delete_selected_filter);

		$(filters.apply_button).on('click', function(e){
			e.preventDefault();
			e.stopPropagation();
			filters.update();
			$('#show-filters-btn').click();
		});

		$(filters.sort_apply_button).on('click', function (e) {
			e.preventDefault();
			e.stopPropagation();
			filters.update();
			//$('#show-sort-btn').click();
		});

		filters.load_stored_data();
    //add icon to default sort
    if(filters.order == 'desc') {
      $(filters.sort_form_id + ' .'+filters.sortby+ ' .rl-sort-choice').addClass('dsc');
    } else {
      $(filters.sort_form_id + ' .'+filters.sortby+ ' .rl-sort-choice').addClass('asc');
    }

		filters.update();
	});

})(jQuery, ReviewsFilters);


jQuery( document ).ready(function($) {
	
  // Clear out the filters if on the list page
  if ( $('#rf-filters-form').length ) {
  	$('#rf-filters-form')[0].reset();
  }

	// Init the filter dropdowns on desktop
	$('.fl-filter .dropdown-toggle').dropdown();

	// Filters Show/Hide on mobile
	$('#show-filters-btn').click(function(){
		if( 'true' === $(this).attr('aria-expanded') ) {
			$('html').removeClass('filters-open');
			$(this).attr('aria-expanded', 'false' );
		} else {
			$('html').addClass('filters-open');
			$(this).attr('aria-expanded', 'true' );
		}
	});

	// Filters cancel (hide) button on mobile
	$('#filters-cancel-btn').click(function(){
		$('html').removeClass('filters-open');
		$('#show-filters-btn').attr('aria-expanded', 'false' );
	});

	// Reset the filters on Desktop
	$('#rf-reset-btn').click(function(){
		$('#rf-filters-form')[0].reset();
	});

	// Nav Show/Hide on Mobile
	$('#reviews-nav-btn').click(function(e){
		e.preventDefault();
		$('html').toggleClass('review-nav-open');
	});

	$('#virtual-placeholder').click(function(){
		$(this).fadeOut();
		$('.virtual-tour .webrotate360').addClass('show');
	});
	
	if($("#compare").hasClass("active")) {
		$("#category-picker").click(function(e){
			e.preventDefault();
			$("#category-dropdown").toggle();
		});
	}

});