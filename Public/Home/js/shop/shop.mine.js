/*对象*/
var that = null;
var Home = "/index.php/Home/";

//文档加载完就执行
$(function () {

    //个人中心按钮
    $(".shop-mine .body .row div").click(function () {
        var mineNo = $(this).attr("mine-no");
        switch (mineNo) {
            case "1":
                redirect("Mine/discount");//优惠
                break;
            case "2":
                redirect("Mine/order");//订单
                break;
            case "3":
                redirect("Mine/collect");//收藏
                break;
            case "4":
                redirect("Mine/help");//帮助与服务
                break;
            case "5":
                redirect("Mine/address");//地址管理
                break;
            case "7":
                redirect("Mine/join");//加入我们
                break;
            case "8":
                redirect("Mine/courier");//我是骑手
                break;
            case "11":
                redirect("Manage/index");//我的店铺
                break;
            case "12":
                redirect("Manage/apply");//申请开店
                break;
            case "13":
                redirect("Manage/ourselves");//自营店
                break;
            case "14":
                redirect("admin/index");//管理员
                break;
            default:
                console.log(mineNo);
                break;
        }
    });

    //个人信息弹框
    $("#courierBtn").click(function(){
        $("#courier").modal("show");
    });

});
