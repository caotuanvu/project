function changePages(page) {
    $('input[name=filter_page]').val(page);
    $('form#main-form').submit();
}