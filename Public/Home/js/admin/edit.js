
$(document).ready(function(){
    if($('#shop-value').is(':checked')) {
        $("#show-id").show();
    }
    else {
        $("#qqq").hide();
    }
    $(".form-group ,col-xs-12 input").click(function(){
        if($('#shop-value').is(':checked')) {
            $("#show-id").show();
        }
        else {
            $("#show-id").hide();
        }
    });
});
