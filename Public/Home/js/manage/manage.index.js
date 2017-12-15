
$(function(){

    //门店资料修改
    $(".manage-index #noticeBtn").click(function(){
        $("#shopInfo").modal("show");
    });

    //订单管理
    $("#order_manage").click(function(){
        redirect("Manage/order");
    });

    //请求新订单
    var interval = setInterval(getNewGroup,8000);
});


