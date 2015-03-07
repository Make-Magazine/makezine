function titlexproShouldRunExp() {
	var sample_cookie_name = '_titlex_in_sample';
    var in_sample = jQuery.cookie(sample_cookie_name);
    if(typeof in_sample === "undefined") {
        //include the user in the sample?
        var $sample_size = jQuery("[data-wpex-sample-size]:first");
        if($sample_size.length > 0) {
            var sample_size = $sample_size.data("wpex-sample-size");
            in_sample = (sample_size == 1 || Math.random() < sample_size) ? "true" : "false";
            jQuery.cookie(sample_cookie_name, in_sample, { expires: 7 }); //for one day
        } else {
            in_sample = "false"; //nothing to sample
        }
    }
    if(in_sample == "false") {
        //replace all titles
        var $_titles = jQuery("[data-wpex-title-id]");
        for(var idx = $_titles.length -1; idx>=0; idx--) {
            var $_title = jQuery($_titles[idx]);
            $_title.html(Base64.decode($_title.data("original")));
        }
    }

    return in_sample == "true";
}