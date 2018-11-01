jQuery(window).load(function() {
	if(!jQuery('html').hasClass('mobile')){
		jQuery(".filter-container").addClass("scrolling");
		jQuery(window).on('resize', function(){
			filterHeight = jQuery(".filter-container").height();
		});
		jQuery(document).scroll(function() {
			var filterHeight = jQuery(".filter-container").outerHeight();
			var scrollTop = jQuery(this).scrollTop();
			if ( jQuery(".gift-guide .item-list").offset().top <= (scrollTop + filterHeight + 55)) {		
			   jQuery(".filter-container").addClass("scrolling");
				jQuery(".gift-guide .item-list").css("margin-top",filterHeight);
			} else  {
			   jQuery(".filter-container").removeClass("scrolling");
				jQuery(".gift-guide .item-list").css("margin-top",0);
			}
		});
	}
});

