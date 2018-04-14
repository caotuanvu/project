$(function () {
   $('#select_status select[name=filter_select]').change(function () {
       $('form#main-form').submit();
   });

    $('#group_acp select[name=group_acp]').change(function () {
        $('form#main-form').submit();
    });

    $('#select_status select[name=filter_group]').change(function () {
        $('form#main-form').submit();
    });

})