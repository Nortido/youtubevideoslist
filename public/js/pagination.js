/**
 * Created by Nortido on 07/04/2017.
 */

$(document).ready(function () {
    $('.js-paginationBtn').on('click', function (e) {
        e.preventDefault();

        $('input[name="pageToken"]').val($(this).data('token'));
        $('form').submit();
    });
});
