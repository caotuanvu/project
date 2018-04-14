/* quantity buttons */
var $input = $('.cart input[name="quantity"]');

function up() {
    var val = parseInt($input.val(), 10) + 1;
    $input.val(val);
}
function down() {
    var val = parseInt($input.val(), 10) - 1 || 0;
    var min = parseInt($input.attr('data-min-value'), 10) || 1;
    $input.val(Math.max(val, min));
}

$('a#click-down').click(function () {
    alert(1);
});
$('<a href="javascript:;" class="journal-stepper">+</a>').insertAfter($input).click(up);
