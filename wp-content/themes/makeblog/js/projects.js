jQuery( document ).ready( function( $ ) {

	// Handle the click actions on the list items in the steps box
	$( 'body' ).on( 'click', '#tabs li.steps', function() {
		var id = $(this).attr('id');

		// Progress the slider
		$( '#steppers' ).find( '.jstep#js-' + id ).slideDown().removeClass( 'hide' );
		$( '#steppers' ).find( '.jstep:not( #js-' + id + ')' ).slideUp();

		// Update the side navigation list
		$( this ).addClass( 'current' );
		$( '#tabs li:not(#' + id + ')' ).removeClass( 'current' );

		// Run our trackers
		googletag.pubads().refresh();
		ga('send', 'pageview');
	});

	// Allows us to advance in the slider
	$( 'body' ).on( 'click', '.nexter', function() {
		var id = $(this).attr('id');

		// Progress the slider
		$( '#steppers' ).find( '.jstep#js-' + id ).slideDown().removeClass( 'hide' );
		$( '#steppers' ).find( '.jstep:not( #js-' + id + ')' ).slideUp();

		// Update side navigation list
		$( '#tabs').find( ' li#' + id ).addClass( 'current' );
		$( '#tabs' ).find( 'li:not( #' + id + ')' ).removeClass( 'current' );

		// Run our trackers
		googletag.pubads().refresh();
		ga('send', 'pageview');
	});

	// Display all projects when we click "View All"
	$( 'body' ).on( 'click', '.aller', function() {
		// Display all the slides
		$( '#steppers' ).find( '.jstep' ).each( function() {
			$( this ).removeClass( 'hide' );
			$( this ).slideDown();
		});

		// Hide the next/previous buttons
		$( '#steppers .nexter, #steppers .disabled' ).hide();

		// Run our trackers
		googletag.pubads().refresh();
		ga('send', 'pageview');
	});

	jQuery('.carousel').on('slid', function () {
		jQuery('.slide').find('iframe').each( function(){
			jQuery(this).attr('src', '');
			var url = jQuery(this).attr('data-src');
			jQuery(this).delay(1000).attr('src', url);
		});
		// Find the active slide, and then add an active class to the thumb.
		var index = jQuery(this).find('.active').data('index');
		jQuery('.inner-thumbs .active').removeClass('active');
		jQuery('*[data-slide-to="' + index + '"]').addClass('active');
		if ( ! jQuery( this ).hasClass('huffington')) {
			googletag.pubads().refresh();
		}
		ga('send', 'pageview');
		var urlref = location.href;
		PARSELY.beacon.trackPageView({
			url: urlref,
			urlref: urlref,
			js: 1,
			action_name: "Next Slide"
		});
		return true;
	});
	if ( jQuery('.item.active') ) {
		jQuery('.slide').find('iframe').each( function(){
			var url = jQuery(this).attr('src');
			jQuery(this).attr('data-src', url);
		});
	} else {
		jQuery('.slide').find('iframe').each( function(){
			var url = jQuery(this).attr('src');
			jQuery(this).attr('data-src', url);
		});
	}

	jQuery('.thumbs').click(function () {
		var mydata = jQuery(this).data();
		jQuery('#' + mydata.loc + ' .main').attr('src', mydata.src );
	});

	jQuery('.modal').on('show', function () {
		// Check to see if we have shown the video. If so, bail so that we don't embed multiples.
		if ( jQuery(this).attr('data-shown') !== 'true' ) {
			// Get the URL of the video.
			var id = jQuery(this).attr('data-video');
			// Create a link in the modal body.
			jQuery('.modal-body .link', this).append( '<a href="' + id + '" class="oembed">Video Link</a>' );
			// Trigger the jQuery Oembed
			jQuery("a.oembed").oembed();
		}
	});

	jQuery('.modal').on('hide', function () {
		// Add a data-shown="true" to the modal. Will prevent further lookups.
		jQuery(this).attr('data-shown', 'true' );
		// Look for the iframe tag, and clear the video SRC out.
		var video = jQuery('.modal-body', this).find('iframe');
		var url = video.attr('src');
		// Empty the src attribute so we can stop the video when it closes. Then we'll put it back right after.
		video.attr('src', '');
		video.attr('src', url);
	});
	jQuery('.huff .starter').click(function() {
		jQuery( '.huff' ).removeClass('small');
		jQuery( this ).hide();
		jQuery( '.nexus' ).show();

		// Open external links inside gallery into new window
		jQuery( '.scroller a' ).each( function() {
			var link = new RegExp( '/' + window.location.host + '/' );
			if ( ! link.test( this.href ) ) {
				jQuery( this ).click( function( e ) {
					e.preventDefault();
					e.stopPropagation();
					window.open( this.href, '_blank' );
				});
			}
		});

		// Listen for a keydown event and run the proper action.
		jQuery( document ).keydown( function( event ) {
			switch ( event.which ) {
				case 37:
					jQuery( '.carousel' ).carousel( 'prev' );
					jQuery( '.carousel' ).on( 'slid', function() {
						jQuery( this ).carousel( 'pause' );
					});
					break;
				case 39:
					jQuery( '.carousel' ).carousel( 'next' );
					jQuery( '.carousel' ).on( 'slid', function() {
						jQuery( this ).carousel( 'pause' );
					});
					break;
				case 27:
					jQuery( '.huff' ).addClass( 'small' );
					jQuery( '.huff .starter' ).show();

					// Disable our event listener
					jQuery( document ).off( 'keydown' );
					break;
			}
		});

	});
	jQuery( ".huff .close" ).click(function() {
		jQuery('.huff').addClass('small');
		jQuery('.huff .starter').show();

		// Disable our event listener
		jQuery( document ).off( 'keydown' );
	});
	( function( $ ) {
		$( document.body ).on( 'post-load', function () {
			googletag.pubads().refresh();
			ga('send', 'pageview');
			} );
	} )( jQuery );

	( function( $ ) {
		$( document.body ).on( 'post-load', function () {
			googletag.pubads().refresh();
			ga('send', 'pageview');
			} );
	} )( jQuery );

	jQuery('.print-page').on('click', function() {
		window.print();
	});

	var currentDataDiff = '';
	jQuery('.all-lvl').hover(function(){
		jQuery('.all-lvl').toggleClass('diff-hover');
	}).click(function(){
		jQuery('.diff-item li span').removeClass('diff-selected filter_selected');
		jQuery('.all-lvl').addClass('diff-selected');
		$(this).addClass('filter_selected');
	});
	jQuery('.moderate').hover(function(){
		jQuery('.all-lvl').toggleClass('diff-hover');
		jQuery('.moderate').toggleClass('diff-hover');
	}).click(function(){
		jQuery('.diff-item li span').removeClass('diff-selected filter_selected');
		jQuery('.all-lvl').addClass('diff-selected');
		jQuery('.moderate').addClass('diff-selected');
		$(this).addClass('filter_selected');
	});
	jQuery('.spec-skill').hover(function(){
		jQuery('.spec-skill').toggleClass('diff-hover');
		jQuery('.all-lvl').toggleClass('diff-hover');
		jQuery('.moderate').toggleClass('diff-hover');
	}).click(function(){
		jQuery('.diff-item li span').removeClass('diff-selected filter_selected');
		jQuery('.spec-skill').addClass('diff-selected');
		jQuery('.all-lvl').addClass('diff-selected');
		jQuery('.moderate').addClass('diff-selected');
		$(this).addClass('filter_selected');

	});
	jQuery('.1-3h').hover(function(){
		jQuery('.1-3h').toggleClass('dur-hover');
	}).click(function(){
		jQuery('.duration-item li span').removeClass('dur-selected filter_selected');
		jQuery('.1-3h').addClass('dur-selected');
		$(this).addClass('filter_selected');
	});
	jQuery('.3-8h').hover(function(){
		jQuery('.1-3h').toggleClass('dur-hover');
		jQuery('.3-8h').toggleClass('dur-hover');
	}).click(function(){
		jQuery('.duration-item li span').removeClass('dur-selected filter_selected');
		jQuery('.3-8h').addClass('dur-selected');
		jQuery('.1-3h').addClass('dur-selected');
		$(this).addClass('filter_selected');
	});
	jQuery('.8-16h').hover(function(){
		jQuery('.8-16h').toggleClass('dur-hover');
		jQuery('.1-3h').toggleClass('dur-hover');
		jQuery('.3-8h').toggleClass('dur-hover');
	}).click(function(){
		jQuery('.duration-item li span').removeClass('dur-selected filter_selected');
		jQuery('.8-16h').addClass('dur-selected');
		jQuery('.1-3h').addClass('dur-selected');
		jQuery('.3-8h').addClass('dur-selected');
		$(this).addClass('filter_selected');
	});
	jQuery('.16h').hover(function(){
		jQuery('.8-16h').toggleClass('dur-hover');
		jQuery('.1-3h').toggleClass('dur-hover');
		jQuery('.3-8h').toggleClass('dur-hover');
		jQuery('.16h').toggleClass('dur-hover');
	}).click(function(){
		jQuery('.duration-item li span').removeClass('dur-selected filter_selected');
		jQuery('.8-16h').addClass('dur-selected');
		jQuery('.1-3h').addClass('dur-selected');
		jQuery('.3-8h').addClass('dur-selected');
		jQuery('.16h').addClass('dur-selected');
		$(this).addClass('filter_selected');
	});
	jQuery('.clear').click(function() {
		jQuery('.duration-item li span').removeClass('dur-selected dur-hover filter_selected');
		jQuery('.diff-item li span').removeClass('diff-selected diff-hover filter_selected');
		jQuery('div.post-filter p').removeClass('current');
		jQuery('div.post-filter p.recent').addClass('current filter_selected');
	});
	jQuery('.recent').click(function() {
		jQuery('.popular').removeClass('current filter_selected');
		jQuery('.recent').addClass('current');
		$(this).addClass('filter_selected');
	});
	jQuery('.popular').click(function() {
		jQuery('.recent').removeClass('current filter_selected');
		jQuery('.popular').addClass('current');
		$(this).addClass('filter_selected');
	});


	var indikator = ".fa-chevron-down";
	var cat_wrapp_indicator = 0;
	jQuery(window).scroll(function(){
		var scrollTop = $(window).scrollTop();
			if (scrollTop >= '530') {
				jQuery('.project-navigation').addClass('sticky');
				jQuery(indikator).show();
				if (cat_wrapp_indicator == 0) {
					jQuery('.cat-list-wrapp').hide();
				} else {
					jQuery('.cat-list-wrapp').show();
				}
			} else {
				jQuery('.project-navigation').removeClass('sticky');
					jQuery(".fa-chevron-up").hide();
					jQuery(".fa-chevron-down").hide();
				jQuery('.cat-list-wrapp').show();
			}
	});

	jQuery(".fa-chevron-down").hide();
	jQuery(".fa-chevron-up").click(function() {
		jQuery('.cat-list-wrapp').toggle('slow');
		jQuery(".fa-chevron-up").hide();
		jQuery(".fa-chevron-down").show();
		indikator = ".fa-chevron-down";
		cat_wrapp_indicator = 0;
	});
	jQuery(".fa-chevron-down").click(function() {
		jQuery('.cat-list-wrapp').toggle('slow');
		jQuery(".fa-chevron-down").hide();
		jQuery(".fa-chevron-up").show();
		indikator = ".fa-chevron-up";
		cat_wrapp_indicator = 1;
	});
	jQuery(".ads").addClass('first-use');
	$.ajax({
		url: '/ajax_get_shopify_featured_products.php',
		data: {
			'action':'make_shopify_featured_products'
		},
		success:function(data) {
			jQuery(".before-ads").after(data);
			jQuery(".ads").addClass('first-use');
		},
		error: function(errorThrown){
		}
	});

		$('.clicks').live('click', function () {
			var DataDiff = $('.filter-item ul li ul.diff-item li span.filter_selected').data('value');
            var DataDur = $('.filter-item ul li ul.duration-item li span.filter_selected').data('value');
            var DataSort = $('.post-filter .filter_selected').data('value');
			var DataCat = $('h1').data('value');
			$('.spinner').show();
				$.ajax({
					type: 'POST',
					url: vars.ajaxurl,
					data: {action: 'sorting_posts', diff: DataDiff, dur: DataDur, sort: DataSort, cat: DataCat },
					success: function(data) {
                        $('.selected-posts-list').hide('slow', function(){
							$('.spinner').hide();
                            $('.selected-posts-list').remove();
                            $(".posts-list").append(data);
                        });
					},
                    error: function(errorThrown){
                        console.log('error');
                    }
				});
			});
});