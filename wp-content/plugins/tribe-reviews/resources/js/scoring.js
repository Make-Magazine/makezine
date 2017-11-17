(function ($) {
    'use strict';


    var total_score = function () {
        var label = $('.total_score_label');

        $.each(label, function (_i, v) {
            var row_label = $(v);
            var scores = row_label.parent().parent().find('input:not(.single_score_percent)');
            var possibleScore = row_label.parent().parent().find('input.single_score_percent');
            var total = 0.0;

            $.each(scores, function (__i, total_field) {
                total += parseFloat($(total_field).val());
            });
            $.each(possibleScore, function (__i, total_field) {
                possibleScoreNumber = parseFloat($(total_field).val());
            });

            var totalPercent = (total * 100) / possibleScoreNumber;

            row_label.html(totalPercent);
        });

    };

    $(document).ready(function () {
        $('.single_score_field').change(total_score).keyup(total_score);
    });

})(jQuery);