
// chang status
function changeStatus(url) {
    $.get(url, function (data1) {
        console.log(data1);

        // 1-> remove -> add 0;
        // var classRemove = 'fa-check-square';// 1;
        // var classAdd    = 'fa-dot-circle-o';// 0;
        // var id          = data[0];
        // var element     = 'a#status-'+ id;
        // var link        = data[2];
        // if(data[1] == 1){
        //     classRemove = 'fa-dot-circle-o';
        //     classAdd    = 'fa-check-square';
        // }
        // $(element + ' span').removeClass(classRemove).addClass(classAdd);
        // $(element).attr('href',"javascript:changeStatus('"+link+"')");
    });
};

// chang group_acp
function changeGroupACP(url) {
    $.get(url, function (data) {
        var id = data[0];
        var group_acp = data[1];
        var link = data[2];
        var element = 'a#group_acp-' + id;
        var classRemove = 'fa-check-square';// 1;
        var classAdd = 'fa-dot-circle-o';// 0;
        if (group_acp == 1) {
            classRemove = 'fa-dot-circle-o';
            classAdd = 'fa-check-square';
        }
        $(element).attr('href', "javascript:changeGroupACP('" + link + "')");
        $(element + ' span').removeClass(classRemove).addClass(classAdd);
        console.log(element);
        console.log(data);
    }, 'json');
}
// ORDER BY NOTE: DỰA VÀO 2 Ô INPUT ĐỂ TIẾN HÀNH SẮP XẾP CÁC GIÁ TRỊ
function submit($name,$sort) {
    $('input[name=row_order]').val($name);
    $('input[name=sort_order]').val($sort);
    $('form#main-form').submit();
};

// SUBMIT FORM STATIC PUBLIC UNPUBLIC
function submitForm(url) {
    $('form#main-form').attr('action', url);
    $('form#main-form').submit();

    console.log(url);
    $('form#form-add').attr('action', url);
    $('form#form-add').submit();
    //form-add

    $('form#form-submit').submit();

}
// CHECK ALL
