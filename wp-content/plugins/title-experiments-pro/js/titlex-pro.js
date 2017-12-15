(function($) {
	window.wpexproSetupInput = function(trow, $input) {
		var $parent = $("#postimagediv");
		var $elm = $("div.inside:first", $parent);
		if(trow.title == '__WPEX_MAIN__') {
			var title = $("#title").val();
			var $title = $("<h4 style='margin-bottom: 0'>" + title + "</h4>");
			$input.keyup(function() {
				$title.text($input.val());
			});
			$elm.prepend($title);
		} else {
			var $clone = $("<div class='wpex-inside' wpex-image-id='" + trow.id + "'></div>");
			var $link = $("<a title='Set featured image' href='/wp-admin/media-upload.php?post_id="+trow.post_id+"&type=image&amp;TB_iframe=1' class='thickbox'>Set featured image</a>");
			$clone.append($link);

			if(trow.thumbnail_id) {
				$link.html("<img src='" + trow.thumbnail + "' style='max-width: 100%; margin: 1em 0;' />");
				$link.append("<input type='hidden' name='wpex-images["+(trow.id ? "_"+trow.id:"")+"]' value='" + trow.thumbnail_id + "' />");
				var $remove = $("<a href='' style='display: block;'>Remove featured image</a>");
				$remove.insertAfter($link);
				$remove.click(function(ev) {
					event.preventDefault();
					event.stopPropagation();
					$remove.prev().html("Set featured image");
					$remove.prev().append("<input type='hidden' name='wpex-images["+(trow.id ? "_"+trow.id:"")+"]' value='null' />");
					$remove.remove();
				});
			}

			$clone.find("h4").remove();
			var $title = $("<h4 style='margin-bottom: 0'>" + trow.title + "</h4>");
			$input.keyup(function() {
				$title.text($input.val());
			});
			$clone.prepend($title);
			$parent.append($clone);
			var obj = featuredImage(trow, $link);
			$(obj.init);
		}
	};

	window.wpexproRemoved = function(id) {
		$("[wpex-image-id='" + id + "']").remove();
	};

	var featuredImage = function(trow, $link) {
		var obj = {};

		obj.get = function() {
			return trow.post_id;
		};

		/**
		 * Set the featured image id, save the post thumbnail data and
		 * set the HTML in the post meta box to the new featured image.
		 *
		 * @param {number} id The post ID of the featured image, or -1 to unset it.
		 */
		obj.set = function( id ) {
			console.log('Set featured image id', id);
		};

		/**
		 * The Featured Image workflow
		 */
		obj.frame = function() {
			if ( this._frame ) {
				wp.media.frame = this._frame;
				return this._frame;
			}

			this._frame = wp.media({
				state: 'featured-image',
				states: [ new wp.media.controller.FeaturedImage() , new wp.media.controller.EditImage() ]
			});

			this._frame.on( 'toolbar:create:featured-image', function( toolbar ) {
				/**
				 * @this wp.media.view.MediaFrame.Select
				 */
				this.createSelectToolbar( toolbar, {
					text: wp.media.view.l10n.setFeaturedImage
				});
			}, this._frame );

			this._frame.on( 'content:render:edit-image', function() {
				var selection = this.state('featured-image').get('selection'),
					view = new wp.media.view.EditImage( { model: selection.single(), controller: this } ).render();

				this.content.set( view );

				// after bringing in the frame, load the actual editor via an ajax call
				view.loadEditor();

			}, this._frame );

			this._frame.state('featured-image').on( 'select', this.select );
			return this._frame;
		};

		/**
		 * 'select' callback for Featured Image workflow, triggered when
		 *  the 'Set Featured Image' button is clicked in the media modal.
		 */
		obj.select = function() {
			var selection = this.get('selection').single();
			var src = selection.attributes.url;
			$link.html("<img src='" + src + "' style='max-width: 100%; margin: 1em 0;' />");
			$link.append("<input type='hidden' name='wpex-images["+(trow.id ? "_"+trow.id:"")+"]' value='" + selection.attributes.id + "' />");

			$link.next("a").remove();
			var $remove = $("<a href='' style='display: block;'>Remove featured image</a>");
			$remove.insertAfter($link);
			$remove.click(function(ev) {
				event.preventDefault();
				event.stopPropagation();
				$remove.prev().html("Set featured image");
				$remove.prev().append("<input type='hidden' name='wpex-images["+(trow.id ? "_"+trow.id:"")+"]' value='null' />");
				$remove.remove();
			})
		};

		/**
		 * Open the content media manager to the 'featured image' tab when
		 * the post thumbnail is clicked.
		 */
		obj.init = function() {
			$link.click(function( event ) {
				event.preventDefault();
				event.stopPropagation();

				obj.frame().open();
			});
		};

		return obj;
	};
	
	window.wpexproEditPage = function(id) {
	    var path = window.location.href.replace(/^(.*)\/wp-admin\/.*$/, '$1');
		path += "/wp-admin/post.php?post="+id+"&action=edit";
		window.location = path;
		return false;
	};

	window.wpexproPage = function(page, search) {
		var path = window.location.pathname;
		path += "?page=title-experiments-pro%2Ftitle-experiments.php-menu&p="+page;
		if (search) {
			path += '&search=' + escape(search);
		}
		window.location = path;
		return false;
	};
	window.wpexproPageStats = function(id) {
		var path = window.location.pathname;
		path += "?page=title-experiments-pro%2Ftitle-experiments.php-menu&id="+id;
		window.location = path;
		return false;
	};
	window.wpexproViewAll = function() {
		var path = window.location.pathname;
		path += "?page=title-experiments-pro%2Ftitle-experiments.php-menu";
		window.location = path;
		return false;
	};
})(jQuery);
