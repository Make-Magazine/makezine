// The number of the next page to load (/page/x/).
var pageNum = parseInt(pbd_alp.startPage) + 1;

// The maximum number of pages the current query can return.
var max = parseInt(pbd_alp.maxPages);

// The link of the next page of posts.
var nextLink = pbd_alp.nextLink;

jQuery(document).ready(function($) {
	
	/**
	 * Replace the traditional navigation with our own,
	 * but only if there is at least one page of new posts to load.
	 */
	if(pageNum <= max) {
		// Insert the "More Posts" link.
		$('.selected-posts-list')
			.append('<div class="good_aligment pbd-alp-placeholder-'+ pageNum +'"></div>')
			.append('<p id="pbd-alp-load-posts" class="row"><a href="#">More</a></p>');

		// Remove the traditional navigation.
		$('.navigation').remove();
	}
	
	
	/**
	 * Load new posts when the link is clicked.
	 */
	$(document).on('click', '#pbd-alp-load-posts a', function() {

		// Are there more posts to load?
		if(pageNum <= max) {
		
			// Show that we're working.
			$(this).text('Loading posts...');
			
			$('.pbd-alp-placeholder-'+ pageNum).load(nextLink + ' .post_rows',
				function() {
					// Update page number and nextLink.
					pageNum++;
					nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);
					
					// Add a new placeholder, for when user clicks again.
					$('#pbd-alp-load-posts')
						.before('<div class="good_aligment pbd-alp-placeholder-'+ pageNum +'"></div>');
					$(".before-ads:first").removeClass('before-ads');

					// Update the button message.
					if(pageNum <= max) {
						$('#pbd-alp-load-posts a').text('More');
					} else {
						//$('#pbd-alp-load-posts a').text('No more posts to load.');
					}
				}
			);
		} else {
			$('#pbd-alp-load-posts a').append('.');
		}	
		
		return false;
	});
});