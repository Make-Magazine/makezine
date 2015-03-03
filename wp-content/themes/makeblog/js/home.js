// Handle Error checking on the forms

function validateForm(theForm){

	var isValid = [];

	if( jQuery(theForm).attr('id') == 'articleform' ) {

		jQuery(theForm).children().each(function(index, value){

			if( jQuery(this).hasClass('control-group') && jQuery(this).hasClass('required') ){

				if( !jQuery(this).find(':input').val() || !jQuery(this).find(':input').is(':checked') ){

					if(jQuery(this).hasClass('success'))
						jQuery(this).removeClass('success');

					jQuery(this).addClass('error');

					isValid[index] = false;

				}

				if( jQuery(this).hasClass('error') && jQuery(this).find(':input').val() ) {

					if(jQuery(this).find(':input').prop('type') === 'radio' && !jQuery(this).find(':input').is(':checked'))
						return true;

					jQuery(this).removeClass('error').addClass('success');

					isValid[index] = true;

				}

			}

		});

	}

	else {

		jQuery(theForm).children().each(function(index, value){

			if( jQuery(this).hasClass('control-group') ){

				if( !jQuery(this).find(':input').val() || !jQuery(this).find(':input').is(':checked') ){

					if(jQuery(this).hasClass('success'))
						jQuery(this).removeClass('success');

					jQuery(this).addClass('error');

					isValid[index] = false;

				}

				if( jQuery(this).hasClass('error') && jQuery(this).find(':input').val() ) {

					if(jQuery(this).find(':input').prop('type') === 'radio' && !jQuery(this).find(':input').is(':checked'))
						return true;

					jQuery(this).removeClass('error').addClass('success');

					isValid[index] = true;

				}

			}

		});

	}

	return isValid.every(function(x) { return x === true; });

}

/*

	Handle Ajax uploads and Modal window

*/

jQuery(document).ready(function() {

	var DEBUG = false;

	jQuery("#page2form").submit(function(e) {

		// Prevents the page form reloading on submit
		e.preventDefault();

		if( validateForm(this) ){

			// stringify the form data
			var hidden = jQuery(this).serialize();

			//#page2form div.controls > *:not(span,p)

			var fields = '&';

			jQuery('*[id^="page2_"]').each(function(index){

					if( index > 0 ) fields += '&';
					fields += jQuery(this).attr('id');
					fields += '=';
					fields += jQuery(this).val();

			});

			// report to console for debugging
			if( DEBUG === true ) console.log(hidden);

			if( DEBUG === true ) console.log(fields);

			jQuery.ajax({

				type: "POST",
				cache: false,
				url: MakeAjax.makeajaxurl,
				data: hidden + fields, // + '&page2Nonce=' + MakeAjax.uploadNonce,
				success: makeOpenModal,
				error: makeUploadError

			});
		} else {

			if ( DEBUG === true ) alert("Valid: " + console.log( jQuery("#page2form").valid() ) );

			makeRequiredFields('#page2');


		}

	});

	jQuery('input[id^="ug_photo"]').live("change", function(){

		var isSet = [];

		var label = jQuery('label[for^="ug_photo"]');

		var maxImages = 5;

		label.each( function(index, value){

			if(jQuery(this).children().val()){
				isSet[index] = true;
			} else {
				isSet[index] = false;
			}

		});

		if(isSet.every(function(x){return x === true;}) && isSet.length < maxImages){

			var rndNum = randomLabel();
			
			var id = 'ug_photo' + rndNum;

			var name = 'photo' + rndNum;
		
			var dupe = label.last().clone().attr('for', id).children().attr('name', name).attr('id', id).parent();

			label.last().after(dupe);

		}

	});

	function randomLabel(){
		temp = Math.floor((Math.random()*100)+1);
		return temp !== 1 ? temp : randomLabel();
	}

	jQuery('#linksubform').submit(function(e){

		e.preventDefault();

		if( validateForm(this) ){
			// stringify the form data
			var hidden = jQuery(this).serialize();

			//#page2form div.controls > *:not(span,p)

			var fields = '&';

			jQuery('*[id^="linksub_"]').each(function(index){

					if( index > 0 ) fields += '&';
					fields += jQuery(this).attr('id');
					fields += '=';
					fields += jQuery(this).val();

			});

			// report to console for debugging
			if( DEBUG === true ) console.log(hidden);

			if( DEBUG === true ) console.log(fields);

			jQuery.ajax({

				type: "POST",
				cache: false,
				url: MakeAjax.makeajaxurl,
				data: hidden + fields, // + '&page2Nonce=' + MakeAjax.uploadNonce,
				success: makeLinkSucess,
				error: makeLinkError

			});

		} else {

			if ( DEBUG === true ) alert("Valid: " + console.log( jQuery("#linksubform").valid() ) );

			makeRequiredFields('#linksub');

		}

	});

	jQuery('#articleform').submit(function(e){

		e.preventDefault();

		if( validateForm(this) ){

			// stringify the form data
			var hidden = jQuery(this).serialize();

			//#page2form div.controls > *:not(span,p)

			var fields = '&';

			jQuery('*[id^="article_"]').each(function(index){

					if( !(jQuery(this).prop('type') === 'radio' || jQuery(this).is('select')) ){
						if( index > 0 ) fields += '&';
						fields += jQuery(this).attr('id');
						fields += '=';
						fields += jQuery(this).val();
					}

			});

			// report to console for debugging
			if( DEBUG === true ) console.log(hidden);

			if( DEBUG === true ) console.log(fields);

			jQuery.ajax({

				type: "POST",
				cache: false,
				url: MakeAjax.makeajaxurl,
				data: hidden + fields, // + '&page2Nonce=' + MakeAjax.uploadNonce,
				success: makeArticleSucess,
				error: makeArticleError

			});

		} else {

			if ( DEBUG === true ) alert("Valid: " + console.log( jQuery("#articleform").valid() ) );

			makeRequiredFields('#article');

		}

	});


	jQuery('#xclose').click(function(){

		jQuery('#modal-uploader').modal('hide');

	});

	function makeOpenModal(data, textStatus, jqXHR){

		if( DEBUG === true ) alert('jqXHR: ' + jqXHR.responseText  + ' textStatus: ' + textStatus + ' data: ' + data);

		jQuery('div.controls > *:not(span,p)').val("");

		jQuery('.ugc-inner-wrapper > input[name="post_ID"]').attr({value: data});

		jQuery('#modal-uploader').modal({
			show: true,
			backdrop: 'static'
		});

		makeSucessAlert('#page2');
	}

	function makeUploadError(jqXHR, textStatus, errorThrown){

		if( DEBUG === true ) alert('jqXHR: ' + jqXHR + ' textStatus: ' + textStatus + ' errorThrown: ' + errorThrown);

		makeFailAlert('#page2');

	}

	function makeLinkSucess(data, textStatus, jqXHR){

		if( DEBUG === true ) alert('jqXHR: ' + jqXHR.responseText  + ' textStatus: ' + textStatus + ' data: ' + data);

		jQuery('*[id^="linksub_"]').val("");

		makeSucessAlert('#linksub');

		makeRedirectOnSucess();

	}

	function makeLinkError(jqXHR, textStatus, errorThrown){

		if( DEBUG === true ) alert('jqXHR: ' + jqXHR + ' textStatus: ' + textStatus + ' errorThrown: ' + errorThrown);

		makeFailAlert('#linksub');

	}

	function makeArticleSucess(data, textStatus, jqXHR){

		if( DEBUG === true ) alert('jqXHR: ' + jqXHR.responseText  + ' textStatus: ' + textStatus + ' data: ' + data);

				jQuery('#articleform').find(':input').each(function() {
				switch(this.type) {
						case 'password':
						case 'select-multiple':
						case 'select-one':
						case 'text':
						case 'textarea':
								jQuery(this).val('');
								break;
						case 'checkbox':
						case 'radio':
								this.checked = false;
				}
		});

		makeSucessAlert('#article');

		makeRedirectOnSucess();

	}

	function makeArticleError(jqXHR, textStatus, errorThrown){

		if( DEBUG === true ) alert('jqXHR: ' + jqXHR + ' textStatus: ' + textStatus + ' errorThrown: ' + errorThrown);

		makeFailAlert('#article');

	}

	function makeSucessAlert(formId){

		var sucessAlert = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Well done!</strong> You successfully submitted content to MAKE.</div>';

		jQuery(formId).append(sucessAlert);

	}

	function makeFailAlert(formId){

		var failAlert = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Whoa!</strong> Something went wrong with this submission, please try again.</div>';

		jQuery(formId).append(failAlert);

	}

	function makeRequiredFields(formId){

		var failAlert = '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">×</button><strong>Oops</strong> There are some required fields which need to be filled in above, highlighted in red.</div>';

		jQuery(formId).append(failAlert);

	}

	function makeRedirectOnSucess(){

		window.location = 'http://makezine.com/submission/';

	}

});