/*对象*/
var that = null;
var Home = "/index.php/Home/";

//文档加载完就执行
$(function () {

    //订单列表点击
    var mineOrderDetail = $(".shop-order .detail");
    mineOrderDetail.on("click", ".goods,.money", function () {
        var groupId = $(this).parent().attr("goods-id");
        redirect("Shop/order_detail/group_id/" + groupId);
    });
    mineOrderDetail.on("click", ".shop", function () {
        var shopId = $(this).parent().attr("shop-id");
        redirect("Shop/detail/shop_id/" + shopId);
    });

    //取消订单
    mineOrderDetail.on("click", ".cancel-order", function () {
        if (confirm("您确认要取消吗？")) {
            var groupId = $(this).attr("group-id");
            $.post(
                Home + "Ajax/cancelGroup", {
                    group_id: groupId
                }, function (result) {
                    if (result['status'] == 2)
                        alert("卖家已经接单，不能取消！");
                    else if (result['status'] != 1) {
                        alert("取消失败！");
                    }
                    redirect("Shop/order");
                }
            );
        }
    });

    //删除订单
    mineOrderDetail.on("click", ".delete-order", function () {
        if (confirm("您确认要删除吗？")) {
            var groupId = $(this).attr("group-id");
            $.post(
                Home + "Ajax/deleteGroup", {
                    group_id: groupId
                }, function (result) {
                    if (result['status'] != 1)
                        alert("删除失败！");
                    else
                        redirect("Shop/order");
                }
            );
        }
    });

});

