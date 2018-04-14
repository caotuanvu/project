$(document).ready(function(){
    $('form#main-form input[name=checked-toggle]').change(function () {
        var checked = this.checked;
        console.log(checked);
        $('form#main-form').find(':checkbox').each(function () {
            this.checked = checked;
        })
    });
});
