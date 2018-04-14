$(document).ready(function(){
    $("#my-panel-group").click(function(event) {
           $(this).hide("slow");
    });
});


// GET URL
function getURL(key){
  var result = new RegExp(key + "=([^&]*)", "i" ).exec(window.location.search);
  return result && unescape(result[1]) || "";
};

// $(document).ready(function() {
// 	var getController = (getURL('controller') == '') ? 'index' : getURL('controller');
// 	var getAction     = (getURL('action') == '') ? 'index' : getURL('action');
// 	var className     = getController + '-' + getAction;
//
// 	$("#menuList li a." + className).addClass('active');
// });

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
