$(function () {
    $('input[name=submit-keyword]').click(function () {
        $('form#main-form').submit();
    });

    $('input[name=submit-clear]').click(function () {
        $('input[name=filter_val]').val('');
    });
})