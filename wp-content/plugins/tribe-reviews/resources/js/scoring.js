(function ($) {
    'use strict';


    var total_score = function () {
        var label = $('.total_score_label');

        $.each(label, function (_i, v) {
            var row_label = $(v);
            var scores = row_label.parent().parent().find('input:not(.single_score_percent)');
            var possibleScore = row_label.parent().parent().find('input.single_score_percent');
            var possibleScoreNumber = 0.0;
            var total = 0.0;

            $.each(scores, function (__i, total_field) {
                total += parseFloat($(total_field).val());
            });
            $.each(possibleScore, function (__i, total_field) {
                possibleScoreNumber = parseFloat($(total_field).val());
            });

            var totalPercent = (total * 100) / possibleScoreNumber;
            var totalPercentRounded = Math.round(totalPercent);

            row_label.html(totalPercentRounded + '%');
        });

    };

    $(document).ready(function () {
        $('.single_score_field').change(total_score).keyup(total_score);
    });

})(jQuery);