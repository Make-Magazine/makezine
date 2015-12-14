(function ($) {
    'use strict';


    var total_score = function () {
        var label = $('.total_score_label');

        $.each(label, function (_i, v) {
            var row_label = $(v);
            var scores = row_label.parent().parent().find('input');
            var total = 0;

            $.each(scores, function (__i, total_field) {
                total += parseInt($(total_field).val());
            });

            row_label.html(total);
        });

    };

    $(document).ready(function () {
        $('.single_score_field').change(total_score).keyup(total_score);
    });

})(jQuery);