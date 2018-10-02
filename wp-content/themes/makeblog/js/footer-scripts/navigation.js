(function($) { 

	jQuery(window).load(function () {
		var sumoHeight = jQuery(".sumome-react-wysiwyg-popup-container").height();
	});


	// forcing some issues - avatar dropdown to open in same tab and search links to actually link
	$(".dropdown-item").attr('target', '_self');
	$(".pop-links-list li a").click(function() {
		window.location.href = $(this).attr('href');
	});
	
	jQuery('.sumome-react-wysiwyg-popup-container').on('DOMNodeRemoved', function(e) {
		if (typeof sumoHeight !== 'undefined') { 
			sumomeActive(); 
			jQuery(".nav-hamburger").css('margin-top', '');
		}
	});
  
  $("#search-modal").fancybox({
        wrapCSS : 'search-modal-wrapper',
        autoSize : true,
        //width  : 400,
        autoHeight : true,
        padding : 0,
        overlay: {
            opacity: 0.8, // or the opacity you want 
            css: {'background-color': '#ff0000'} // or your preferred hex color value
        }, // overlay 
        closeClick  : false, 
        afterShow   : function() {
            // keep it from reloading upon clicks
            $('#search-modal').bind('click', false);
            $(".sb-search-submit").click(function(e){
                if($("#search").val() && $("#search").val() != ""){
                    var searchForm = $(".search-form");
                    window.location.href = searchForm.attr("action") +"?s=" + $("#search").val();
                }else{
                    $("#search").attr('placeholder', "Please enter in some text to search for...");            
                }
            });
            $(".sb-search-input").focus();
        },
        afterClose: function () {
            $('#search-modal').unbind('click', false);
        }
  });

  $(".fa-search").click(function(e){
       $("#search-modal").trigger('click');
       // essb sharing popup is being triggered when logged in to admin
       $(".essb-live-customizer-main, .essb-live-buttons-customizer").attr('style', 'display: none !important');
  });

  // just in case, make sure that nav-share is visible
  $(".nav-level-1-nav .nav-share").css("display", "block");
})(jQuery);